<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/CreatorJwt.php';
require APPPATH.'libraries/REST_Controller.php';

class Child extends CI_Controller{

	public function __construct(){

		parent::__construct();
		$this->objOfJwt = new CreatorJwt();
		header('Content-Type: application/json');
		$this->load->model(array("Child_model","Users_model"));
		$this->load->library(array("form_validation"));
	}

	
	public function child_profile_create()
	{

		$received_Token = $this->input->request_headers();
		
		$data = json_decode(file_get_contents("php://input"));
		$aResponce = array('success'=>'false','status' => REST_Controller::HTTP_NOT_FOUND,'message' => 'Invalid Request');

		$method = $_SERVER['REQUEST_METHOD'];
		$check = true;

		if ($method != 'POST' && $check) {

			$check = false;

			$aResponce = array('success'=>'false','status' => REST_Controller::HTTP_BAD_REQUEST,'message' => 'methode not allowed');
		}

		if (empty($received_Token['token']) && $check) {

			$check = false;
			$aResponce = array('success'=>'false','status' => REST_Controller::HTTP_BAD_REQUEST,'message' => 'token is required');
		}



		if(!isset($data->name) && !isset($data->sex) && !isset($data->dob) && !isset($data->father_name) && !isset($data->mother_name) && !isset($data->district_id) && !isset($data->state_id) && $check){

			$check = false;
			$aResponce = array('success'=>'false','status' => REST_Controller::HTTP_NOT_FOUND,'message' => 'Invalid Parameters');

		}

				if ($check) { //to check user is login or not

					$jwtData = $this->objOfJwt->DecodeToken($received_Token['token']);
					$isUserLogin =  $this->Users_model->getLoginlist(array('login_user_id' =>$jwtData['uniqueId'],'login_id'=> $jwtData['login_id'],'login_status'=>'1','count'=>true));

					if ($isUserLogin != 1) {
						$check = false;
						$aResponce = array('success'=>'false','status' => REST_Controller::HTTP_UNAUTHORIZED,'message' => 'User logged out');
					}
				}
				if ($check) {//to check valid or not
					$check_user = $this->Users_model->getUserList(array('rms_id' => $jwtData['uniqueId'],'rms_status'=>'1','count'=>true));
					if ($check_user != 1) {
						$check = false;
						$aResponce = array('success'=>'false','status' => REST_Controller::HTTP_UNAUTHORIZED,'message' => 'Incorrect user id');
					}
				}

				if ($check) {
					
					$user_id = $jwtData['uniqueId'];
					$child_info = array(
						"child_name" => $data->name,
						"child_sex" => $data->sex,
						"child_dob" => $data->dob,
						"child_father_name" => $data->father_name,
						"child_mother_name" => $data->mother_name,
						"child_district" => $data->district_id,
						"child_state" => $data->state_id,
						"child_image" => $data->photo,
						"child_status" => '1',
						"child_created_date" => date('d-m-y'),
						"child_added_by" => $user_id

					);
					$last_id = $this->Child_model->addRow('rms_child',$child_info);
					if (is_numeric($last_id)) {
						$aResponce = array('success'=>'true','status' => REST_Controller::HTTP_OK,'message' => 'Operation performed successfully');
					}
				}

				echo json_encode($aResponce);
				exit();
			}

			public function child_profile_list()
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
                		$aResponce = array('success'=>'false','status' => REST_Controller::HTTP_UNAUTHORIZED,'message' => 'User logged out');
                	}
                }
				if ($check) {//to check valid or not
					$check_user = $this->Users_model->getUserList(array('rms_id' => $jwtData['uniqueId'],'rms_status'=>'1','count'=>true));
					if ($check_user != 1) {
						$check = false;
						$aResponce = array('success'=>'false','status' => REST_Controller::HTTP_UNAUTHORIZED,'message' => 'Incorrect user id');
					}
				}

				if ($check) { //limit and offseat is used to filter records
					$limit = $this->input->get('limit', true);
					$offset = $this->input->get('offset', true);
					if (isset($limit) && isset($offset)) {
						$filter = array('child_status'=>'1','order_by'=>'child_id DESC','join'=>true,'offset'=>$offset,'limit'=>$limit);
					}else{
						$filter = array('child_status'=>'1','order_by'=>'child_id DESC','join'=>true);
					}
					$child_profile = $this->Child_model->getChildList($filter);

					$aResponce = array('success'=>true,'status' => REST_Controller::HTTP_OK,'message' => 'Child Profile Detail.','timestamp'=>time(),'child_profile'=>$child_profile); 
				}

				echo json_encode($aResponce);
				exit();
			}
		}