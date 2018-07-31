<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        $this->load->library('ion_auth');
       
        $this->load->library('form_validation');
        
    }
	public function index(){
        $this->ion_auth->logout();
        $this->load->view('admin/login');
    }
		
	public function dologin()
	{
		$email = $this->input->post('email');
        $password = $this->input->post('password');

         if($this->ion_auth->login($email, $password)){
         	if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
            redirect(base_url() .'Admin');
         }else{
         	$this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url() .'Login');
         }


	}

	public function dologout(){
		$this->ion_auth->logout();
		redirect(base_url() .'Login');
	}
}