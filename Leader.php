<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leader extends CI_Controller {
	
	public function logOut(){
		$this->session->sess_destroy();
		$this->load->view('login');
	}
	
	public function redirectHome(){
		$this->load->view('leader/home');
	}
}