<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_Login');

		// $email = $this->session->email;

		// if($email == null){
		// 	redirect('Home');
		// } 
	}


	public function index()
	{
		$this->load->view('view_login');
	}

	public function auth()
	{
		$username = $this->input->post('email');
		$password = $this->input->post('password');

		$checkUsername = $this->M_Login->readUsername($username,$password);

		if($checkUsername==NULL){

			echo "<script type='text/javascript'>
               alert ('Maaf Username Dan Password Anda Salah !');
               window.location.replace('');
      			</script>";

		}else{
			$newdata = array(
				'username'  => $checkUsername->username,
				'nm_plg'  => $checkUsername->nm_plg,
				'email' => $checkUsername->email
			  );
			//set seassion
			$this->session->set_userdata($newdata);
			redirect('Home');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Home');
	}
}