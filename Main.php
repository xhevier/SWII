<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$this->load->view('index');
	}

    public function redirectLogin()
    {
        $this->load->view('login');
    }

    public function canLogin(){
        $this->form_validation->set_rules('username', 'username', 'trim|required|trim');
        $this->form_validation->set_rules('password', 'password', 'trim|required|md5|trim|callback_validateUser');

        if ($this->form_validation->run() == TRUE) {
            $this->load->model('login');
            $data = $this->login->getUserPermisson();
            $this->session->set_userdata(
              array ('id' => $data->LOGIN_ID,
                     'username' => $this->input->post('username'),
                     'loggedin' => 1,
                     'permisson' => $data->LOGIN_PERMISSON,
					 'employeeDefaultWhere' => '(1=1)',
					 'clientDefaultWhere' => '(1=1)',
					 'agreementDefaultWhere' => '(1=1)',
					 'billsDefaultWhere' => '(1=1)')
            );
            if ($this->session->userdata('permisson') == 0) {
				redirect(base_url('Admin/redirectHome'));
            } else if ($this->session->userdata('permisson') == 1) {
				redirect(base_url('Admin/redirectHome'));
			} else if ($this->session->userdata('permisson') == 4) {
				redirect(base_url('Adviser/redirectHome'));
			} else if ($this->session->userdata('permisson') == 5) {
				redirect(base_url('Client/redirectHome'));
			} else {
				$this->session->sess_destroy();
				$this->load->view('login');				
			}
              
        } else {
			$this->session->sess_destroy();
            $this->load->view('login');
        }
    }

    public function validateUser(){
        $this->load->model('login');
        if ($this->login->validateUser()){
            return TRUE;
        } else {
            $this->form_validation->set_message('validateUser','Nesprávne jméno nebo heslo!');
            return FALSE;
        }
    }
	
	public function redirectLostPassword(){
		$data['data'] = array (
			'meno' => '',
			'heslo' => '',
			'prvaCislica' => '',
			'druhaCislica' => ''
		);
		$this->load->view('lost_password',$data);
	}
	
	public function canIResetPassword(){
		$this->form_validation->set_message('required', 'Vyplňte prosím všechny položky!');
		$this->form_validation->set_rules('lostUsername', 'Login', 'required');
    $this->form_validation->set_rules('lostEmail', 'E-mail', 'required');
		$this->form_validation->set_rules('lostFirstNumber', '2. číslice', 'required');
    $this->form_validation->set_rules('lostSecondNumber', '6. číslice', 'required|callback_validateChangePassword');
		
		if ($this->form_validation->run() == TRUE) {
			$this->load->model('login');
			$userID = $this->login->getUserID($this->input->post('lostUsername'));
			$newPassword = substr( str_shuffle( 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789' ), 0, 8 );

			$configuration = Array (
					'protocol' => 'smtp',
					'smtp_host' => 'smtp.webglobe.sk',
					'smtp_port' =>	2525,
					'smtp_user' => 'no-reply@mendelupojistovna.studenthosting.sk',
					'smtp_pass' => 'r18n8UmN'
				);
			$this->load->library('email', $configuration);			
			$this->email->set_newline("\r\n");
			
			$this->email->from('no-reply@mendelupojistovna.studenthosting.sk', 'no reply');
			$this->email->to($this->input->post('lostEmail'));
			$this->email->subject('Zmena hesla');
			$this->email->message('
Dobrý deň,
			
na vašu žiadosť vám bolo vygenerované nové heslo.
			
Vaše nové heslo je: '. $newPassword . '
			
Teraz sa môžete prihlásiť a zmeniť heslo v sekcii: Zmena profilu zamestnanca.');
			if($this->email->send()) {
				$this->login->setNewPassword($userID,md5($newPassword));
				$data ['email_sended'] = $this->input->post('lostEmail');
				$this->load->view('password_changed', $data);
			} else {
				show_error($this->email->print_debugger());
			}


		
		} else {
			$data['data'] = array (
			'meno' => $this->input->post('lostUsername'),
			'heslo' => $this->input->post('lostEmail'),
			'prvaCislica' => $this->input->post('lostFirstNumber'),
			'druhaCislica' => $this->input->post('lostSecondNumber')
		);
			$this->load->view('lost_password',$data);
		}
	}
	
	public function validateChangePassword(){
		$this->load->model('login');
		if ($this->login->validateChangePassword()){
            return TRUE;
        } else {
            $this->form_validation->set_message('validateChangePassword','Nesprávne údaje pro změnu hesla!');
            return FALSE;
        }
	}
}
