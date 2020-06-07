<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/CreatorJwt.php';
require APPPATH.'libraries/REST_Controller.php';

class Master extends CI_Controller{

	public function __construct(){

		parent::__construct();
		$this->objOfJwt = new CreatorJwt();
		header('Content-Type: application/json');
		$this->load->model(array("District_model","State_model","Users_model"));
		$this->load->library(array("form_validation"));
	}

	
	public function create_state()
	{

		$received_Token = $this->input->request_headers();
		$aResponce = array('success'=>'false','status' => REST_Controller::HTTP_NOT_FOUND,'message' => 'Invalid Request');

		$method = $_SERVER['REQUEST_METHOD'];
		$check = true;

		if ($method != 'POST' && $check) {

			$check = false;

			$aResponce = array('success'=>'false','status' => REST_Controller::HTTP_BAD_REQUEST,'message' => 'methode not allowed');
		}

		if ($check) {
			$this->form_validation->set_rules("state_name", "state name", "trim|required|min_length[1]|max_length[25]");
			
		    // checking form submittion have any error or not
			if($this->form_validation->run() === FALSE){
				$aResponce = array('success'=>'false','status' => REST_Controller::HTTP_NOT_FOUND,'message' => 'Invalid Parameters');
				$check = false;
			}
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

				if ($check) {//to check state is already exist
					$state_name = $this->input->post('state_name', true);
					$check_user = $this->State_model->getStateList(array('rms_state_name' => $state_name,'count'=>true));
					if ($check_user == 1) {
						$check = false;
						$aResponce = array('success'=>'false','status' => REST_Controller::HTTP_OK
							,'message' => 'This State is already exist');
					}
				}

				if ($check) {
					
					$user_id = $jwtData['uniqueId'];
					
					$state_info = array(
						"rms_state_name" => $state_name,
						"state_status" => '1',
						"rms_createdate" => date('d-m-y'),
						"State_added_by" => $user_id

					);
					$last_id = $this->State_model->addRow('rms_state',$state_info);
					if (is_numeric($last_id)) {
						$aResponce = array('success'=>'true','status' => REST_Controller::HTTP_OK,'message' => 'Operation performed successfully');
					}
				}

				echo json_encode($aResponce);
				exit();
			}

			public function get_state()
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
						$filter = array('state_status'=>'1','order_by'=>'rms_state_id DESC','offset'=>$offset,'limit'=>$limit);
					}else{
						$filter = array('state_status'=>'1','order_by'=>'rms_state_id DESC','join'=>true);
					}

					$state_profile = $this->State_model->getStateList($filter);

					$aResponce = array('success'=>true,'status' => REST_Controller::HTTP_OK,'message' => 'State Detail.','timestamp'=>time(),'state_profile'=>$state_profile); 
				}

				echo json_encode($aResponce);
				exit();
			}

			public function get_district()
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
						$filter = array('district_status'=>'1','order_by'=>'rms_state_id DESC','offset'=>$offset,'limit'=>$limit);
					}else{
						$filter = array('district_status'=>'1','order_by'=>'rms_state_id DESC','join'=>true);
					}

					$district_list = $this->District_model->getDistrictList($filter);

					$aResponce = array('success'=>true,'status' => REST_Controller::HTTP_OK,'message' => 'District Detail.','timestamp'=>time(),'district_list'=>$district_list); 
				}

				echo json_encode($aResponce);
				exit();
			}
		}