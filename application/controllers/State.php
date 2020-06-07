<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class State extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('State_model');
	}

	public function index()
	{

		$data['rms_user_info'] =$userinfo= $this->session->userdata('auth_session_v');
		
		
			$this->load->library('form_validation');
			if ($postData =$this->input->post()) 
	{
			 $this->form_validation->set_rules('rms_state_n', 'State', 'trim|required|min_length[1]|max_length[25]');

		if ($this->form_validation->run() == true)
                {
                    $count_state = $this->State_model->getStateList(array('rms_state_name' => $postData['rms_state_n'],'count'=>true ));
                    if ($count_state == 1) {
                    	$data['error_message'] = "State allready exist";
                    	
                    }else{

                    	$count_state = $this->State_model->addRow('rms_States',array('rms_state_name' => $postData['rms_state_n'],'state_status'=>'1','State_added_by'=>$userinfo->rms_id));
                    	if (is_integer($count_state)) {
                    		$data['succeess_msg'] = 'State added successfully';
                    	}
                    }
                }
     }           
         $data['all_states']= $this->State_model->getStateList();
		 $this->load->view('header');
		$this->load->view('main_header',$data);
		$this->load->view('state',$data);

	}
}