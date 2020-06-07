<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/CreatorJwt.php';
require APPPATH.'libraries/REST_Controller.php';

class User extends CI_Controller{

	public function __construct(){

		parent::__construct();
		$this->objOfJwt = new CreatorJwt();
		header('Content-Type: application/json');

		
		$this->load->model(array("Users_model"));
		$this->load->library(array("form_validation"));
	}

	//Login Api
	public function login(){
		//defoult Response
		$aResponce = array('success'=>'false','status' => REST_Controller::HTTP_NOT_FOUND,'message' => 'Invalid Request');

		$method = $_SERVER['REQUEST_METHOD'];
		$check = true;
		if($method != 'POST' && $check){
			$aResponce = array('success'=>'false','status' => REST_Controller::HTTP_BAD_REQUEST,'message' => 'methode not allowed');
			
		} 


		if ($check) { //input validate 
			$this->form_validation->set_rules("username", "username", "trim|required|min_length[1]|max_length[25]");
			$this->form_validation->set_rules("password", "password", "trim|required|min_length[1]|max_length[25]");
			
		    // checking form submittion have any error or not
			if($this->form_validation->run() === FALSE){
				$aResponce = array('success'=>'false','status' => REST_Controller::HTTP_NOT_FOUND,'message' => 'Invalid Parameters');
				$check = false;
			}
		}

		if ($check) {
			$password = $this->input->post('password', true);
			$username = $this->input->post('username', true);

			$count = $this->Users_model->getUserList(array('rms_user' => $username,'rms_password'=>md5($password),'rms_status'=>'1','count'=>true));
			if ($count!=1) {
				$aResponce = array('success'=>'false','status' => REST_Controller::HTTP_UNAUTHORIZED,'message' => 'Authentication Failed');
				$check = false;
			}
		}

		if ($check) {
			
			$user = $this->Users_model->getUserList(array('rms_user' => $username,'rms_password'=>md5($password),'rms_status'=>'1','single'=>true));

			$login_id =  $this->Users_model->addRow('rms_login',array('login_user_id'=>$user->rms_id,'login_time'=>time()));
			$tokenData['uniqueId'] = $user->rms_id;
			$tokenData['user'] = 'user';
			$tokenData['login_id'] = $login_id;
			$tokenData['timeStamp'] = Date('Y-m-d h:i:s');
			$jwtToken = $this->objOfJwt->GenerateToken($tokenData);

			$last_login_info= $this->Users_model->getLoginlist(array(
				'order_by'=>'login_id DESC',
				'limit'=>'1',
				'offset'=>'0',
				'rms_login_id'=>$user->rms_id,
				'single'=>true
			));
			$last_login = $last_login_info->login_time ?? '0';


			$aResponce = array('success'=>true,'status' => REST_Controller::HTTP_OK,'message' => 'Login successfull.','token'=>$jwtToken,'login_id'=>$login_id,'last_login'=>$last_login,'timestamp'=>time());
		}
		echo json_encode($aResponce);
		exit();
	}


	//logut api
	public function logout()
	{

		$received_Token = $this->input->request_headers();

		$aResponce = array('success'=>'false','status' => REST_Controller::HTTP_NOT_FOUND,'message' => 'Invalid Request');

		$method = $_SERVER['REQUEST_METHOD'];
		$check = true;

		if ($method != 'GET' && $check) {

			$check = false;

			$aResponce = array('success'=>'false','status' => REST_Controller::HTTP_BAD_REQUEST,'message' => 'methode not allowed');
		}

		if (empty($received_Token['token']) && $check) {

			$check = false;
			$aResponce = array('success'=>'false','status' => REST_Controller::HTTP_BAD_REQUEST,'message' => 'token is required');
		}

                if ($check) { //to check user is login or not

                	$jwtData = $this->objOfJwt->DecodeToken($received_Token['token']);
                	$isUserLogin =  $this->Users_model->getLoginlist(array('login_user_id' =>$jwtData['uniqueId'],'login_id'=> $jwtData['login_id'],'login_status'=>'1','count'=>true));

                	if ($isUserLogin != 1) 
                	{
                		$check = false;
                		$aResponce = array('success'=>true,'status' => REST_Controller::HTTP_OK,'message' => 'User allready logged out');
                	}
                }
				if ($check) {//to check user valid or not
					$check_user = $this->Users_model->getUserList(array('rms_id' => $jwtData['uniqueId'],'rms_status'=>'1','count'=>true));
					if ($check_user != 1) {
						$check = false;
						$aResponce = array('success'=>'false','status' => REST_Controller::HTTP_UNAUTHORIZED,'message' => 'Incorrect user id');
					}
				}

				if ($check) { 
					$this->Users_model->updateRow('rms_login',
						array('login_status'=>'0'),
						array('login_user_id' =>$jwtData['uniqueId'],
							'login_id'=> $jwtData['login_id'],
						));
					$aResponce = array('success'=>true,'status' => REST_Controller::HTTP_OK,'message' => 'Successfully logged out.');
				}

				echo json_encode($aResponce);
				exit();
			}


		}