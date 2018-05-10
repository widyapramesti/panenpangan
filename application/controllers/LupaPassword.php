<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LupaPassword extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_Customer');
	}

	public function index()
	{
		echo "<script type='text/javascript'>
               alert ('Silahkan Cek Email Anda Untuk Ubah Password Baru !');
               window.location.replace('Login');
      			</script>";
	}

	public function email()
	{
		$this->load->view('view_email');
	}

	public function kirim()
	{

		$email = $this->input->post('email');

		$username = $this->M_Customer->getEmail($email);
	
		foreach($username as $data){	
			$encrypted_id = md5($data->username);
		}

		$this->load->library('email');
		$config = array();
	    $config['charset'] = 'utf-8';
	    $config['useragent'] = 'Codeigniter';
	    $config['protocol']= "smtp";
	    $config['mailtype']= "html";
	    $config['smtp_host']= "ssl://smtp.gmail.com";
	    $config['smtp_port']= "465";
	    $config['smtp_timeout']= "400";
	    $config['smtp_user']= "zackyburhani2@gmail.com";
	    $config['smtp_pass']= "zacky130997"; 
	    $config['crlf']="\r\n"; 
	    $config['newline']="\r\n"; 
	    $config['wordwrap'] = TRUE;

	    $this->email->initialize($config);
	    //konfigurasi pengiriman
	    $this->email->from($config['smtp_user']);
	    $this->email->to($email);
	    $this->email->subject("Lupa Password");
	    $this->email->message(
	     "Pilih Halaman Ini Untuk Input Ulang Password Anda<br><br>".
	      site_url('LupaPassword/verification/'.$encrypted_id)
	    );

	    if($this->email->send())
	    {
	       echo "<script type='text/javascript'>
               alert ('Silahkan Cek Email Anda Untuk Ubah Password Baru !');
               window.location.replace('Login');
      			</script>";
	    }else
	    {
	       echo "gagal";
	    }
	  
	    echo "<br><br><a href='".site_url("Login")."'>Kembali ke Menu Login</a>";
	}

	public function verification($key)
	{
		$this->load->helper('url');
		$username = $this->M_Customer->changeActiveState($key);

		$dataa['username'] = $username

		$this->load->view('view_lupapas',$data);
	}

}