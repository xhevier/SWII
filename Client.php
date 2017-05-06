<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {
	
	
	
	public function logOut(){
		$this->session->sess_destroy();
		$this->load->view('login');
	}

	public function redirectHome(){
		$this->load->view('client/home');
	}
	
	public function redirectDefaultAgreement(){
		$this->load->model('Clients');
		$this->load->model('Users');
		$data['user'] = $this->Users->getUserDetailInfo($this->session->userdata('id'));
		$data['agreements'] = $this->Clients->getAllAgreementsForClientNoLimit($this->session->userdata('id'));
		$this->load->view('client/agreements/client_agreements',$data);
	}
	
	public function redirectDefaultInvoice(){
		$this->load->model('Bills');
		$this->load->model('Users');
		$data['user'] = $this->Users->getUserDetailInfo($this->session->userdata('id'));
		$data['bills'] = $this->Bills->getAllUserBillsNoLimit($this->session->userdata('id'));
		$this->load->view('client/invoices/client_bills',$data);
	}
	
}