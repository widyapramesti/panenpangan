<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Login extends CI_Model {

    public function __construct(){
		parent::__construct();
	}

	public function readUsername($username,$password)
  	{
 	   $result = $this->db->where('UPPER(email)', strtoupper($username))->where('password',md5($password))->limit(1)->get('login');
		return $result->row();
	}

}