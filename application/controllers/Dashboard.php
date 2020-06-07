<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{

	public function __construct(){

		parent::__construct();
	}

	public function index(){
		$data['rms_user_info'] = $this->session->userdata('auth_session_v');
		$this->load->view('header');
		$this->load->view('main_header',$data);
		$this->load->view('dashboard');
	}
}