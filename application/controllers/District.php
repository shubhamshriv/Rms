<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class District extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('District_model');
		$this->load->model('State_model');
	}

	public function index()
	{

		
		
		$userinfo= $this->session->userdata('auth_session_v');
			$this->load->library('form_validation');
			if ($postData =$this->input->post()) 
	{
			 $this->form_validation->set_rules('rms_state_id', 'State', 'trim|required|min_length[1]|max_length[25]');

			 $this->form_validation->set_rules('rms_district_n', 'District', 'trim|required|min_length[1]|max_length[25]');

		if ($this->form_validation->run() == true)
                {
                    $count_state = $this->District_model->getDistrictList(array('rms_state_name' => $postData['rms_state_id'],'district_name' => $postData['rms_district_n'],'join'=>true,'count'=>true));
                    	/*echo $this->db->last_query();
                    	exit;*/
                   if ($count_state == 1) {
                    		$data['error_message'] = "District allready exist";
                    	}else{
                    		$count_state = $this->District_model->addRow('rms_district',array('district_name' => $postData['rms_district_n'],'district_status'=>'1','district_added_by'=>$userinfo->rms_id,	'state_id'=>$postData['rms_state_id']));
                    	if (is_integer($count_state)) {
                    		$data['succeess_msg'] = 'District added successfully';
                    	}else{
                    		$data['error_message'] = "Something went wrong";
                    	}
                    	} 	
                    
                }
     }           
         $data['all_states']= $this->State_model->getStateList();
         $data['all_district']= $this->District_model->getDistrictList(array('join'=>true,'join_select'=>true));
		 $this->load->view('header');
		$this->load->view('main_header',$data);
		$this->load->view('District',$data);

	}

	function fetch_district()
 {
 	
  if($this->input->post('rms_state_id'))
  {
   echo $this->District_model->fetch_district($this->input->post('rms_state_id'));
  }
 }
}