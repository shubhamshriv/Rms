<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Child extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('State_model');
		$this->load->model('Child_model');
	}



	public function index()
	{
		$imageUrl = '';

		$data['rms_user_info'] =$userinfo= $this->session->userdata('auth_session_v');
		
		
			$this->load->library('form_validation');
			if ($postData =$this->input->post()) 
	{
			 $this->form_validation->set_rules('child_name_n', 'Name', 'trim|required|min_length[1]|max_length[25]');

			 $this->form_validation->set_rules('child_sex_n', 'Sex', 'trim|required|min_length[1]|max_length[25]');
			 $this->form_validation->set_rules('child_dob_n', 'Date of beath', 'trim|required|min_length[1]|max_length[25]');
			 $this->form_validation->set_rules('child_father_name_n', 'Father Name', 'trim|required|min_length[1]|max_length[25]');
			 $this->form_validation->set_rules('child_mother_name_n', 'Mother Name', 'trim|required|min_length[1]|max_length[25]');
			 $this->form_validation->set_rules('child_state_n', 'State', 'trim|required|min_length[1]|max_length[25]');
			 $this->form_validation->set_rules('child_district_id', 'District', 'trim|required|min_length[1]|max_length[25]');
			/*	*/

		if ($this->form_validation->run() == true)
                {

					if(isset($_FILES["child_image_n"]["name"]))  
					{  
					$uploadPath = './assets/upload/';  
					if (!is_dir($uploadPath)) 
					{
						mkdir($uploadPath, 0777);
					}
					$config['upload_path'] = './assets/upload/';  
                	$config['allowed_types'] = 'jpg|jpeg|png|gif';  
                	$this->load->library('upload', $config);
                	if($this->upload->do_upload('child_image_n'))  
                {  
                    $data = $this->upload->data();  
                    
                     $file_name_p = $data['file_name'];
                     $imageUrl = "assets/upload/$file_name_p";
                }  
					}
                    $count_state = $this->Child_model->addRow('rms_States',array('child_name' => $postData['child_name_n'],'child_status'=>'1','child_added_by'=>$userinfo->rms_id,'child_sex'=>$postData['child_sex_n'],
                		'child_dob'=>$postData['child_dob_n'],
                		'child_father_name'=>$postData['child_father_name_n'],
                		'child_mother_name'=>$postData['child_mother_name_n'],
                		'child_state'=>$postData['child_state_n'],
                		'child_district'=>$postData['child_district_id'],
                		'child_image'=>$imageUrl,
                		'child_created_date'=>date('d-m-y')

                	));
                    	if (is_integer($count_state)) {
                    		$data['succeess_msg'] = 'Child added successfully';
                    	}
                }
     }           
         $data['all_states']= $this->State_model->getStateList();
		 $this->load->view('header');
		$this->load->view('main_header',$data);
		$this->load->view('add_child',$data);

	}

	private function viewPageButton($id, $url) {
        $id = base64_encode($id);

        $data['url'] = $url . '/' . $id;
        return $this->load->view('view_child_button', $data, true);
    }
	public function getChild(){
		
		 $this->load->view('header');
		$this->load->view('main_header');
		$this->load->view('childtable');
	}

	 public function ajaxChildtList() {
        $searchKey = $this->input->post('search');
        $searchKey = $searchKey['value'];
        $offset = $this->input->post('start');
        $limit = $this->input->post('length');
        $total = $this->Child_model->getChildList(array('count' => true));
        $data['recordsTotal'] = $data['recordsFiltered'] = $total;

        $filter = array('offset' => $offset, 'limit' => $limit, 'searchKey' => $searchKey, 'order_by' => 'id DESC','join'=>true);
        $childList = $this->Child_model->getChildList($filter);
        $stdInfo = array();
        $c = 1;

        foreach ($childList as $child) {
            $stdInfo[] = array($c++,
                $child->name,
                $child->sex,
                $child->dob,
                $child->father_name,
                $child->mother_name,
                $child->district_name,
                $child->rms_state_name,
                $this->viewPageButton($child->id,'Child/childDetails'),
              
            );
        }
        $data['data'] = $stdInfo;
        echo json_encode($data);
        exit();
    }

     public function childDetails($id = 0) {
        $id = base64_decode($id);

      

        $data['child_info'] = $this->Child_model->getChildList(array('child_status' => '1','child_id' => $id, 'single' => true,'join'=>true));
        
   
      
         $this->load->view('header');
		$this->load->view('main_header');
		$this->load->view('View_child_all_info',$data);
    }

}