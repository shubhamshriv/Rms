<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Users_model');
	}

	
	public function index()
	{

		if (!empty($this->session->userdata('auth_session_v'))) {
			redirect(base_url().'dashboard');
		}
		$data['title'] = 'Login';
		$this->load->library('form_validation');

		if ($postData =$this->input->post()) {




          $this->form_validation->set_rules('rms_user_n', 'User name', 'trim|required');
          $this->form_validation->set_rules('rms_password_n', 'Password', 'trim|required');

          if ($this->form_validation->run()==true) {

    			$isEmailExist = $this->Users_model->getUserList(array('rms_user'=>$postData['rms_user_n'],'count'=>true)); //to check user is exist or not

    			if ($isEmailExist == 1) {
    				
                    $isPassMatch = $this->Users_model->getUserList(array('rms_user'=>$postData['rms_user_n'],'rms_password'=>md5($postData['rms_password_n']),'count'=>true));

                    if ($isPassMatch==1) {

                        $login_info = $this->Users_model->getUserList(array('rms_user'=>$postData['rms_user_n'],'rms_password'=>md5($postData['rms_password_n']),'single'=>true));

                        if (!empty($login_info)) {
                           $this->session->set_userdata('auth_session_v',$login_info);
                           redirect(base_url('dashboard'));
                       }

                   }else{
                    $data['error_message'] = "Incorrect id or password";
                }
            }else{
                $data['error_message'] = "Invalid user name";
            }
        }
    }


    $this->load->view('header');
    $this->load->view('login',$data);
    $this->load->view('footer');
}

public function logout(){
   $this->session->unset_userdata('auth_session_v');
   redirect(base_url('Login'));
}
}
