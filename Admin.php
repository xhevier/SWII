<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function logOut(){
		$this->session->sess_destroy();
		$this->load->view('login');
	}
		
	/*************************************************************************************/
	/*SEKCIA DOMU******************************************************************/
	/*************************************************************************************/
	
	public function redirectHome(){
		$this->load->view('admin/home');
	}
	
	/*************************************************************************************/
	/*SEKCIA ZAMESTNANCI******************************************************************/
	/*************************************************************************************/
	
	public function redirectDefaultUser(){
		$this->load->view('admin/users/default_user');
	 }
	
	public function redirectFindUser(){
		$data['input']='';
		$data['searchEmployeeError'] = '';
        $this->load->view('admin/users/find_user',$data);
    }
	
	public function redirectDetailUser($user_id){
		$this->load->model('Users');
		$this->load->model('Agreements');
		$data['modifyPermisson'] = TRUE;/*$this->Users->canIModifyUser($user_id);*/
		$data['user'] = $this->Users->getUserDetailInfo($user_id);
		$data['agreements'] = $this->Agreements->getAllUserAgreements($user_id);
        $this->load->view('admin/users/detail_user',$data);
    }
	
	public function acceptEmployeePDF($user_id){
		$this->load->model('Users');
		$this->Users->acceptEmployeePDF($user_id);
		redirect (base_url('Admin/redirectDetailUser/'.$user_id));
	}
	
	public function acceptKlientPDF($user_id){
		$this->load->model('Users');
		$this->Users->acceptEmployeePDF($user_id);
		redirect (base_url('Admin/redirectDetailClient/'.$user_id));
	}
	
	public function stronoEmployee($user_id){
		$this->load->model('Users');
		$this->Users->stronoEmployee($user_id);
		redirect (base_url('Admin/redirectDetailUser/'.$user_id));
	}
	
	public function fireEmployee($user_id){
		$this->load->model('Users');
		$this->Users->fireEmployee($user_id);
		redirect (base_url('Admin/redirectDetailUser/'.$user_id));
	}
	
	public function redirectNewUser(){	
		$data['newEmployeeErrors'] = '';
		$data['newEmployeeTitle'] = '';
		$data['newEmployeeStreet'] = '';
		$data['newEmployeeFirstName'] = '';
		$data['newEmployeeStreetNumber'] = '';
		$data['newEmployeeLastName'] = '';
		$data['newEmployeePostCode'] = '';
		$data['newEmployeeBirthDate'] = '';
		$data['newEmployeeCity'] = '';
		$data['newEmployeePIN'] = '';
		$data['newEmployeeState'] = '';
		$data['newEmployeePhoneNumber'] = '';
		$data['newEmployeeHireFrom'] = date("d.m.Y",strtotime("now"));
		$data['newEmployeeEmail'] = '';
		$data['newEmployeeHireTo'] = '31.12.'.(substr(date("d.m.Y",strtotime("now")),6,4));	 
		$data['newEmployeePinNumber'] =	'';
		$data['newEmployeePosition'] = '';	
		$data['newEmployeeLogin'] =	'';
		$data['newEmployeeBankNumber'] = '';
		$data['newEmployeePassword'] = substr( str_shuffle( 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789' ), 0, 8 );
		$data['newEmployeeBankCode'] = '';
		$data['newEmployeeRegisterUser'] =	strtolower($this->session->userdata('username'));
		$data['newEmployeeBankName'] = '';
		$data['newEmployeeIban'] = '';
		$this->load->view('admin/users/new_user',$data);
    }
	
	public function createNewEmployee(){
		$this->load->helper('validation_helper');
		
	$data['newEmployeeErrors'] = '';
	$data['newEmployeeTitle'] = $this->input->post('newEmployeeTitle');
	$data['newEmployeeStreet'] = $this->input->post('newEmployeeStreet');
	$data['newEmployeeFirstName'] = $this->input->post('newEmployeeFirstName');
	$data['newEmployeeStreetNumber'] = $this->input->post('newEmployeeStreetNumber');
	$data['newEmployeeLastName'] = $this->input->post('newEmployeeLastName');
	$data['newEmployeePostCode'] = $this->input->post('newEmployeePostCode');
	$data['newEmployeeBirthDate'] = $this->input->post('newEmployeeBirthDate');
	$data['newEmployeeCity'] = $this->input->post('newEmployeeCity');
	$data['newEmployeePIN'] = $this->input->post('newEmployeePIN');
	$data['newEmployeeState'] = $this->input->post('newEmployeeState');
	$data['newEmployeePhoneNumber'] = $this->input->post('newEmployeePhoneNumber');
	$data['newEmployeeHireFrom'] = $this->input->post('newEmployeeHireFrom');
	$data['newEmployeeEmail'] = $this->input->post('newEmployeeEmail');
	$data['newEmployeeHireTo'] = $this->input->post('newEmployeeHireTo'); 
	$data['newEmployeePinNumber'] = $this->input->post('newEmployeePinNumber');
	$data['newEmployeePosition'] = $this->input->post('newEmployeePosition');
	$data['newEmployeeLogin'] = $this->input->post('newEmployeeLogin');
	$data['newEmployeeBankNumber'] = $this->input->post('newEmployeeBankNumber');
	$data['newEmployeePassword'] = substr( str_shuffle( 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789' ), 0, 8 );
	$data['newEmployeeBankCode'] = $this->input->post('newEmployeeBankCode');
	$data['newEmployeeRegisterUser'] =	strtolower($this->session->userdata('username'));
	$data['newEmployeeBankName'] = $this->input->post('newEmployeeBankName');
	$data['newEmployeeIban'] = $this->input->post('newEmployeeIban');
		
		$count = 0;
		$numberOfErrors = 8;
	/* validation Title */	
		if (ContainsNumbers($data['newEmployeeTitle'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Titul</b>  nového zaměstnance <b>se musí skládat jenom ze znaků</b>.';};
		}
	/* validation Street */
		if (IsEmpty($data['newEmployeeStreet'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Ulice</b>  nového zaměstnance <b>musí být vyplněna</b>.';};
		} elseif (IsLowThenThree($data['newEmployeeStreet'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Ulice</b>  nového zaměstnance <b>musí obsahovat minimálně tři znaky</b>.';};
		} elseif (ContainsNumbers($data['newEmployeeStreet'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Ulice</b>  nového zaměstnance <b>se musí skládat jenom ze znaků</b>.';};
		}
	/* validation First Name */
		if (IsEmpty($data['newEmployeeFirstName'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <bJméno</b>  nového zaměstnance <b>musí být vyplněna</b>.';};
		} elseif (IsLowThenThree($data['newEmployeeFirstName'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Jméno</b>  nového zaměstnance <b>musí obsahovat minimálně tři znaky</b>.';};
		} elseif (ContainsNumbers($data['newEmployeeFirstName'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Jméno</b>  nového zaměstnance <b>se musí skládat jenom ze znaků</b>.';};
		}
	/* validation Street number */
		if (IsEmpty($data['newEmployeeStreetNumber'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <Číslo domu</b>  nového zaměstnance <b>musí být vyplněna</b>.';};
		} elseif (!(is_numeric($data['newEmployeeStreetNumber']))) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Číslo domu</b>  nového zaměstnance <b>se musí skládat jenom z číslic</b>.';};
		}
	/* validation newEmployeeLastName */
		if (IsEmpty($data['newEmployeeLastName'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Příjmení</b>  nového zaměstnance <b>musí být vyplněno</b>.';};
		} elseif (IsLowThenThree($data['newEmployeeLastName'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Příjmení</b>  nového zaměstnance <b>musí obsahovat minimálně tři znaky</b>.';};
		} elseif (ContainsNumbers($data['newEmployeeLastName'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Příjmení</b>  nového zaměstnance <b>se musí skládat jenom ze znaků</b>.';};
		}
	/* validation newEmployeePostCode */
		if (IsEmpty($data['newEmployeePostCode'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Smerovací číslo adresy</b>  nového zaměstnance <b>musí být vyplněno</b>.';};
		} elseif (!(IsPostCode($data['newEmployeePostCode']))) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Smerovací číslo adresy</b>  nového zaměstnance <b>musí obsahovat práve pět číslic</b>.';};
		} elseif (!(is_numeric($data['newEmployeePostCode']))) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Smerovací číslo adresy</b>  nového zaměstnance <b>se musí skládat jenom z číslic</b>.';};
		}
	/* validation $data['newEmployeeBirthDate']*/
		if (IsEmpty($data['newEmployeeBirthDate'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Datum narození</b>  nového zaměstnance <b>musí být vyplněno</b>.';};
		} elseif (!(IsDate($data['newEmployeeBirthDate']))) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Datum narození</b>  nového zaměstnance <b>musí být ve formátu DD.MM.YYYY nebo YYYY-MM-DD nebo YYYY/MM/DD</b>.';};
		}
	/* validation $data['newEmployeeCity']*/
		if (IsEmpty($data['newEmployeeCity'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Město</b>  nového zaměstnance <b>musí být vyplněno</b>.';};
		} elseif (IsLowThenThree($data['newEmployeeCity'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Město</b>  nového zaměstnance <b>musí obsahovat minimálně tři znaky</b>.';};
		} elseif (ContainsNumbers($data['newEmployeeCity'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Město</b>  nového zaměstnance <b>se musí skládat jenom ze znaků</b>.';};
		}
	/* validation $data['newEmployeePIN']*/
		if (IsEmpty($data['newEmployeePIN'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Rodní číslo</b>  nového zaměstnance <b>musí být vyplněno</b>.';};
		} elseif (!(IsPIN($data['newEmployeePIN']))) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Rodní číslo</b>  nového zaměstnance <b>se musí být ve formátu 900101/9876</b>.';};
		} elseif (alreadyExistEmployeeByPIN($data['newEmployeePIN'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>JIŽ EXISTUJE UŽIVATEL S RODNÍM ČÍSLEM '.$data['newEmployeePIN'].'</b>.';};
		}
	/* validation $data['newEmployeePhoneNumber']*/
		if (IsEmpty($data['newEmployeePhoneNumber'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Telefónní číslo</b>  nového zaměstnance <b>musí být vyplněno</b>.';};
		} 
	/* validation $data['newEmployeeHireFrom']*/
		if (IsEmpty($data['newEmployeeHireFrom'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Datum počátku závazku</b>  nového zaměstnance <b>musí být vyplněno</b>.';};
		} 
	/* validation $data['newEmployeeEmail']*/
		if (IsEmpty($data['newEmployeeEmail'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Email</b>  nového zaměstnance <b>musí být vyplněno</b>.';};
		}
	/* validation $data['newEmployeeHireTo']*/
		if (IsEmpty($data['newEmployeeHireTo'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Datum ukončení závazku</b>  nového zaměstnance <b>musí být vyplněno</b>.';};
		}
	/* validation $data['newEmployeePinNumber']*/
		if (IsEmpty($data['newEmployeePinNumber'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Číslo občianského průkazu</b>  nového zaměstnance <b>musí být vyplněno</b>.';};
		}
	/* validation $data['newEmployeeBankNumber']*/
		if (IsEmpty($data['newEmployeeBankNumber'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Číslo účtu/b>  nového zaměstnance <b>musí být vyplněno</b>.';};
		}
	/* validation $data['newEmployeeBankCode']*/
		if (IsEmpty($data['newEmployeeBankCode'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Kód banky</b>  nového zaměstnance <b>musí být vyplněn</b>.';};
		}
	/* validation $data['newEmployeeIban']*/
				
		if (IsEmpty($data['newEmployeeErrors'])) {
			$this->load->model('Users');
			$new_user_id = $this->Users->insertNewUser();
			redirect (base_url('Admin/redirectDetailUser/'.$new_user_id));
		} else {
			$this->load->view('admin/users/new_user',$data);
		}
	}
	
	
	
	public function redirectModifyEmployee($user_id){
		$this->load->helper('vypis');
		$this->load->model('Users');
		$this->load->model('Agreements');
		$user = $this->Users->getUserDetailInfo($user_id);
		$data['employeeModifyError'] = '';
		$data['USER_ID'] = $user_id;
		$data['USER_TITLE'] = $user->USER_TITLE;
		$data['LOGIN_NAME'] = $user->LOGIN_NAME;
		$data['USER_FNAME'] = $user->USER_FNAME;
		$data['USER_CREATE_USER'] = getUserName($user->USER_CREATE_USER_ID);
		$data['USER_LNAME'] = $user->USER_LNAME;
		if ($user->USER_CREATE_DATE!=null){
			$data['USER_CREATE_DATE'] = date('d.m.Y',strtotime($user->USER_CREATE_DATE));
		} else {
			$data['USER_CREATE_DATE'] = null;
		}		
		$data['USER_YEAR'] = substr($user->USER_PIN,4,2).'.'.substr($user->USER_PIN,2,2).'.19'.substr($user->USER_PIN,0,2);
		if ($user->USER_MODIFY_USER_ID!=null) {
			$data['USER_MODIFY_USER']=getUserName($user->USER_MODIFY_USER_ID);
		}else{
			$data['USER_MODIFY_USER']=null;
		}
		$data['USER_PIN'] = $user->USER_PIN;
		if ($user->USER_MODIFY_DATE!=null){
			 $data['USER_MODIFY_DATE']= date('d-m-Y',strtotime($user->USER_MODIFY_DATE));
		} else {
			$data['USER_MODIFY_DATE']=null;
		}		
		$data['USER_MNUMBER'] = $user->USER_MNUMBER;
		$data['HIRE_FROM'] = date('d.m.Y',strtotime($user->HIRE_FROM));
		$data['USER_EMAIL'] = $user->USER_EMAIL;
		$data['HIRE_TO'] = date('d.m.Y',strtotime($user->HIRE_TO));
		$data['USER_PIN2'] = 'SL'.substr($user->USER_PIN,4,2).substr($user->USER_PIN,5,1).substr($user->USER_PIN,7,2).substr($user->USER_PIN,4,1);
		$data['LOGIN_PERMISSON'] = getFunction($user->LOGIN_PERMISSON);
		$data['ADRESS_STREET'] = $user->ADRESS_STREET;
		$data['BANK_NUMBER'] = $user->BANK_NUMBER;
		$data['ADRESS_NUMBER'] = $user->ADRESS_NUMBER;
		$data['BANK_ID'] = $user->BANK_ID;
		$data['ADRESS_POST'] = $user->ADRESS_POST;
		$data['BANK_NAME'] = $user->BANK_NAME;
		$data['ADRESS_CITY'] = $user->ADRESS_CITY;
		$data['BANK_IBAN'] = $user->BANK_IBAN;
		$data['ADRESS_STATE'] = $user->ADRESS_STATE;
        $this->load->view('admin/users/modify_user',$data);
	}
	
	public function validateModifyEmployee($user_id){
		$count_errors = 0;
		$this->load->model('Users');
		$data['employeeModifyError'] = '';
		if (strlen($this->input->post('USER_FNAME'))<3){
			$count_errors=$count_errors+1;
			if ($count_errors<6){
				$data['employeeModifyError'] = $data['employeeModifyError'].'&nbsp&nbsp&nbsp&nbsp&nbsp <b>'.$count_errors.'. Jméno zaměstnance</b> musí obsahovat minimálně <b>3 znaky.</b><br>';
			}
		}
		if (strlen($this->input->post('USER_LNAME'))<3){
			$count_errors=$count_errors+1;
			if ($count_errors<6){
				$data['employeeModifyError'] = $data['employeeModifyError'].'&nbsp&nbsp&nbsp&nbsp&nbsp <b>'.$count_errors.'. Příjmení zaměstnance</b> musí obsahovat minimálně <b>3 znaky.</b><br>';
			}
		}
		if (strlen($this->input->post('USER_YEAR'))==''){			
			$count_errors=$count_errors+1;
			if ($count_errors<6){
				$data['employeeModifyError'] = $data['employeeModifyError'].'&nbsp&nbsp&nbsp&nbsp&nbsp <b>'.$count_errors.'. Datum narození</b> musí být <b>vyplněn.</b><br>';
			}		
		}
		if (strlen($this->input->post('USER_YEAR'))!=10){			
			$count_errors=$count_errors+1;
			if ($count_errors<6){
				$data['employeeModifyError'] = $data['employeeModifyError'].'&nbsp&nbsp&nbsp&nbsp&nbsp <b>'.$count_errors.'. Datum narození</b> musí být <b>ve formátu DD.MM.YYYY.</b><br>';
			}		
		}
		if ($this->input->post('USER_PIN')==''){
			$count_errors=$count_errors+1;
			if ($count_errors<6){
				$data['employeeModifyError'] = $data['employeeModifyError'].'&nbsp&nbsp&nbsp&nbsp&nbsp <b>'.$count_errors.'. Rodní číslo</b> musí být <b>vyplněno.</b><br>';
			}
		}
		if ($this->input->post('USER_MNUMBER')==''){
			$count_errors=$count_errors+1;
			if ($count_errors<6){
				$data['employeeModifyError'] = $data['employeeModifyError'].'&nbsp&nbsp&nbsp&nbsp&nbsp <b>'.$count_errors.'. Číslo mobilního telefónu</b> musí být <b>vyplněno.</b><br>';
			}
		}
		if ($this->input->post('USER_EMAIL')==''){
			$count_errors=$count_errors+1;
			if ($count_errors<6){
				$data['employeeModifyError'] = $data['employeeModifyError'].'&nbsp&nbsp&nbsp&nbsp&nbsp <b>'.$count_errors.'. E-mail zaměnstnance</b> musí být <b>vyplněn.</b><br>';
			}
		}
		if (strlen($this->input->post('USER_EMAIL'))<8){
			$count_errors=$count_errors+1;
			if ($count_errors<6){
				$data['employeeModifyError'] = $data['employeeModifyError'].'&nbsp&nbsp&nbsp&nbsp&nbsp <b>'.$count_errors.'. E-mail zaměnstnance</b> musí být <b>vyplňen ve formátu abc@abc.org .</b><br>';
			}
		}
		if ($this->input->post('USER_PIN2')==''){
			$count_errors=$count_errors+1;
			if ($count_errors<6){
				$data['employeeModifyError'] = $data['employeeModifyError'].'&nbsp&nbsp&nbsp&nbsp&nbsp <b>'.$count_errors.'. Číslo občianského průkazu</b> musí být <b>vyplněno.</b><br>';
			}
		}
		if ($this->input->post('ADRESS_STREET')==''){
			$count_errors=$count_errors+1;
			if ($count_errors<6){
				$data['employeeModifyError'] = $data['employeeModifyError'].'&nbsp&nbsp&nbsp&nbsp&nbsp <b>'.$count_errors.'. Ulice</b> trvalého bydliska zaměstnanca musí být <b>vyplněna.</b><br>';
			}
		}
		if ($count_errors == 0) {
			$this->Users->updateUser($user_id);
			redirect(base_url('Admin/redirectDetailUser/'.$user_id));
		} else {
			$data['employeeModifyError'] = '&nbsp&nbsp&nbsp&nbsp&nbsp<b><div style="margin-top:-15px; margin-left:24px; margin-bottom:5px">NA FORMULÁRI BOLI ZISTENÉ CHYBY</b> - počet nájdených chýb je ( <b>'.$count_errors.'</b> ).</div>'.$data['employeeModifyError'];
			if ($count_errors>5){
				$data['employeeModifyError'] =	$data['employeeModifyError'].'&nbsp&nbsp&nbsp&nbsp&nbsp ... <span style="color:#B20000">nezobrazeno posledných ( <b>'.($count_errors-5).'  </b>) chýb ...</span>';
			}
			$data['USER_ID'] = $user_id;
			$data['USER_TITLE'] = $this->input->post('USER_TITLE');
			$data['LOGIN_NAME'] = $this->input->post('LOGIN_NAME');
			$data['USER_FNAME'] = $this->input->post('USER_FNAME');
			$data['USER_CREATE_USER'] = $this->input->post('USER_CREATE_USER');
			$data['USER_LNAME'] = $this->input->post('USER_LNAME');
			$data['USER_CREATE_DATE'] = $this->input->post('USER_CREATE_DATE');
			$data['USER_YEAR'] = $this->input->post('USER_YEAR');
			$data['USER_MODIFY_USER']= $this->input->post('USER_MODIFY_USER');
			$data['USER_PIN'] = $this->input->post('USER_PIN');
			$data['USER_MODIFY_DATE']= $this->input->post('USER_MODIFY_DATE');
			$data['USER_MNUMBER'] = $this->input->post('USER_MNUMBER');
			$data['HIRE_FROM'] = $this->input->post('HIRE_FROM');
			$data['USER_EMAIL'] = $this->input->post('USER_EMAIL');
			$data['HIRE_TO'] = $this->input->post('HIRE_TO');
			$data['USER_PIN2'] = $this->input->post('USER_PIN2');
			$data['LOGIN_PERMISSON'] = $this->input->post('LOGIN_PERMISSON');
			$data['ADRESS_STREET'] = $this->input->post('ADRESS_STREET');
			$data['BANK_NUMBER'] = $this->input->post('BANK_NUMBER');
			$data['ADRESS_NUMBER'] = $this->input->post('ADRESS_NUMBER');
			$data['BANK_ID'] = $this->input->post('BANK_ID');
			$data['ADRESS_POST'] = $this->input->post('ADRESS_POST');
			$data['BANK_NAME'] = $this->input->post('BANK_NAME');
			$data['ADRESS_CITY'] = $this->input->post('ADRESS_CITY');
			$data['BANK_IBAN'] = $this->input->post('BANK_IBAN');
			$data['ADRESS_STATE'] = $this->input->post('ADRESS_STATE');
			$this->load->view('admin/users/modify_user',$data);
		}
		/*$this->load->model('Users');
		$this->load->model('Agreements');
		$data['employeeModifyError'] = '';
		$data['user'] = $this->Users->getUserDetailInfo($user_id);
		$data['agreements'] = $this->Agreements->getAllUserAgreements($user_id);
        $this->load->view('admin/users/modify_user',$data);*/
	}
	
	public function redirectAllUsers($orderBy, $orientation){
		$this->load->model('Users');
		$this->load->library('Pagination');		
		$pageLimit = 25;
		$totalRows = $this->Users->getCountUsers();
		if ($totalRows < $pageLimit) {
			$zobrazenoZaznamov = '<b>1</b> až <b>'.$totalRows.'</b>';
		} else {
			if ($this->uri->segment(5)==''){
				$zobrazenoZaznamov = '<b>1 až 25</b>';
			} else {
				if (($this->uri->segment(5)+25)>$totalRows){
					$zobrazenoZaznamov = '<b>'.$this->uri->segment(5).'</b> až <b>'.$totalRows.'</b>';
				} else {
					$zobrazenoZaznamov = '<b>'.$this->uri->segment(5).'</b> až <b>'.($this->uri->segment(5)+25).'</b>';
				}
			}			
		}
		if ($this->session->userdata('employeeDefaultWhere')!='(1=1)'){
			$zobrazenoFilter = ', dle zadaného filtrovacího kritéria.';
		} else {
			$zobrazenoFilter = '.';
		}
		$data['headline'] = '<h1>Seznam zaměstnaců <span style="font-size:12px">- zobrazeno '.$zobrazenoZaznamov. ' záznamů z <b>'.$totalRows.'</b> nájdených'.$zobrazenoFilter.'</span></h1>';
		$data['users'] = $this->Users->fetchUsers($pageLimit, $this->uri->segment(5),$orderBy, $orientation);
        $configuration=$this->getConfigurationForPagination($pageLimit, base_url('Admin/redirectAllUsers/'.$orderBy.'/'.$orientation.'/'), $totalRows, 5);	 
		$this->pagination->initialize($configuration);
		$this->load->view('admin/users/show_all_users',$data);
    }
	
	public function findEmployee(){
		$this->load->model('Users');
		if (strlen($this->input->post('findEmployeeText'))<2){
			$data['input']=$this->input->post('findEmployeeText');
			$data['searchEmployeeError'] = 'Pro vyhledání je nutno zadat alespoň dva znaky.';
			$this->load->view('admin/users/find_user',$data);
		} else {
			$query = $this->Users->findSpecificEmployee($this->input->post('findEmployeeText'));
			if ($query->num_rows() == 0 ) {
				$data['input']=$this->input->post('findEmployeeText');
				$data['searchEmployeeError'] = 'Litujeme, pro zadaný reťazec "<b>'.$this->input->post('findEmployeeText').'"</b> nebyl nalezen žádny záznam.';
				$this->load->view('admin/users/find_user',$data);
			} else if ($query->num_rows() == 1) {
				$query = $query->row();
				redirect(base_url('Admin/redirectDetailUser/'.$query->USER_ID));
			} else {
				$query = $query->row();
				if (strpos($this->input->post('findEmployeeText'),'%') == TRUE){
					$findConstantPrefix = null;
					$findConstantPostfix = null;
				} else {
					$findConstantPrefix = null;
					$findConstantPostfix = null;
				}
				$this->session->set_userdata('employeeDefaultWhere', ' (
						USER_TITLE LIKE "'.$findConstantPrefix.$this->input->post('findEmployeeText').$findConstantPostfix.'" OR 
						USER_FNAME LIKE "'.$findConstantPrefix.$this->input->post('findEmployeeText').$findConstantPostfix.'" OR
						USER_LNAME LIKE "'.$findConstantPrefix.$this->input->post('findEmployeeText').$findConstantPostfix.'" OR
						USER_PIN LIKE "'.$findConstantPrefix.$this->input->post('findEmployeeText').$findConstantPostfix.'" OR
						USER_MNUMBER LIKE "'.$findConstantPrefix.$this->input->post('findEmployeeText').$findConstantPostfix.'" OR
						USER_EMAIL LIKE "'.$findConstantPrefix.$this->input->post('findEmployeeText').$findConstantPostfix.'" OR
						ADRESS_STREET LIKE "'.$findConstantPrefix.$this->input->post('findEmployeeText').$findConstantPostfix.'" OR
						ADRESS_NUMBER LIKE "'.$findConstantPrefix.$this->input->post('findEmployeeText').$findConstantPostfix.'" OR
						ADRESS_CITY LIKE "'.$findConstantPrefix.$this->input->post('findEmployeeText').$findConstantPostfix.'" OR
						ADRESS_POST LIKE "'.$findConstantPrefix.$this->input->post('findEmployeeText').$findConstantPostfix.'" OR
						LOGIN_NAME LIKE "'.$findConstantPrefix.$this->input->post('findEmployeeText').$findConstantPostfix.'" OR
						BANK_NUMBER LIKE "'.$findConstantPrefix.$this->input->post('findEmployeeText').$findConstantPostfix.'" OR
						BANK_IBAN LIKE "'.$findConstantPrefix.$this->input->post('findEmployeeText').$findConstantPostfix.'" OR
						BANK_CODE LIKE "'.$findConstantPrefix.$this->input->post('findEmployeeText').$findConstantPostfix.'" OR
						BANK_NAME LIKE "'.$findConstantPrefix.$this->input->post('findEmployeeText').$findConstantPostfix.'" OR
						STATE_NAME LIKE "'.$findConstantPrefix.$this->input->post('findEmployeeText').$findConstantPostfix.'" OR
						STATE_SHORT LIKE "'.$findConstantPrefix.$this->input->post('findEmployeeText').$findConstantPostfix.'")');	
							
				redirect(base_url('Admin/redirectAllUsers/1/1'));
			}		
		}
	}
	
	public function clearEmployeeFilter($orderBy,$orientation){
		$this->session->set_userdata('employeeDefaultWhere', '(1=1)');
		redirect(base_url('Admin/redirectAllUsers/'.$orderBy.'/'.$orientation));
	}     

	/*************************************************************************************/
	/*SEKCIA POISTENCI******************************************************************/
	/*************************************************************************************/
	
	public function redirectDefaultClient(){
		$this->load->view('admin/clients/default_client');
	 }
	 
	public function redirectFindClient(){
		$data['input']='';
		$data['searchClientError'] = '';
        $this->load->view('admin/clients/find_client',$data);
    }
	
	public function redirectDetailClient($user_id){
		$this->load->model('Users');
		$this->load->model('Agreements');
		$data['modifyPermisson'] = TRUE;/*$this->Users->canIModifyUser($user_id);*/
		$data['user'] = $this->Users->getUserDetailInfo($user_id);
		$data['agreements'] = $this->Agreements->getAllUserAgreements($user_id);
        $this->load->view('admin/clients/detail_client',$data);
    }
	
	public function stornoClient($user_id){
		$this->load->model('Clients');
		$this->Clients->stornoClient($user_id);
		redirect(base_url('Admin/redirectDetailClient/'.$user_id));
	}
	
	public function fireClient($user_id){
		$this->load->model('Clients');
		$this->Clients->fireClient($user_id);
		redirect(base_url('Admin/redirectDetailClient/'.$user_id));
	}
	
	public function redirectNewClient(){	
		$data['newEmployeeErrors'] = '';
		$data['newEmployeeTitle'] = '';
		$data['newEmployeeStreet'] = '';
		$data['newEmployeeFirstName'] = '';
		$data['newEmployeeStreetNumber'] = '';
		$data['newEmployeeLastName'] = '';
		$data['newEmployeePostCode'] = '';
		$data['newEmployeeBirthDate'] = '';
		$data['newEmployeeCity'] = '';
		$data['newEmployeePIN'] = '';
		$data['newEmployeeState'] = '';
		$data['newEmployeePhoneNumber'] = '';
		$data['newEmployeeHireFrom'] = date("d.m.Y",strtotime("now"));
		$data['newEmployeeEmail'] = '';
		$data['newEmployeeHireTo'] = '31.12.'.(substr(date("d.m.Y",strtotime("now")),6,4));	 
		$data['newEmployeePinNumber'] =	'';
		$data['newEmployeePosition'] = '';	
		$data['newEmployeeLogin'] =	'';
		$data['newEmployeeBankNumber'] = '';
		$data['newEmployeePassword'] = substr( str_shuffle( 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789' ), 0, 8 );
		$data['newEmployeeBankCode'] = '';
		$data['newEmployeeRegisterUser'] =	strtolower($this->session->userdata('username'));
		$data['newEmployeeBankName'] = '';
		$data['newEmployeeIban'] = '';
		$this->load->view('admin/clients/new_client',$data);
    }
	
	public function redirectAllClients($orderBy, $orientation){
		$this->load->model('Clients');
		$this->load->library('Pagination');		
		$pageLimit = 25;
		$totalRows = $this->Clients->getCountUsers();
		if ($totalRows < $pageLimit) {
			$zobrazenoZaznamov = '<b>1</b> až <b>'.$totalRows.'</b>';
		} else {
			if ($this->uri->segment(5)==''){
				$zobrazenoZaznamov = '<b>1 až 25</b>';
			} else {
				if (($this->uri->segment(5)+25)>$totalRows){
					$zobrazenoZaznamov = '<b>'.$this->uri->segment(5).'</b> až <b>'.$totalRows.'</b>';
				} else {
					$zobrazenoZaznamov = '<b>'.$this->uri->segment(5).'</b> až <b>'.($this->uri->segment(5)+25).'</b>';
				}
			}			
		}
		if ($this->session->userdata('employeeDefaultWhere')!='(1=1)'){
			$zobrazenoFilter = ', dle zadaného filtrovacího kritéria.';
		} else {
			$zobrazenoFilter = '.';
		}
		$data['headline'] = '<h1>Seznam klientů <span style="font-size:12px">- zobrazeno '.$zobrazenoZaznamov. ' záznamů z <b>'.$totalRows.'</b> nájdených'.$zobrazenoFilter.'</span></h1>';
		$data['users'] = $this->Clients->fetchClients($pageLimit, $this->uri->segment(5),$orderBy, $orientation);
        $configuration=$this->getConfigurationForPagination($pageLimit, base_url('Admin/redirectAllClients/'.$orderBy.'/'.$orientation.'/'), $totalRows, 5);	 
		$this->pagination->initialize($configuration);
		$this->load->view('admin/clients/show_all_clients',$data);
    }
	
	public function redirectModifyClient($user_id){
		$this->load->helper('vypis');
		$this->load->model('Users');
		$this->load->model('Agreements');
		$user = $this->Users->getUserDetailInfo($user_id);
		$data['employeeModifyError'] = '';
		$data['USER_ID'] = $user_id;
		$data['USER_TITLE'] = $user->USER_TITLE;
		$data['LOGIN_NAME'] = $user->LOGIN_NAME;
		$data['USER_FNAME'] = $user->USER_FNAME;
		$data['USER_CREATE_USER'] = getUserName($user->USER_CREATE_USER_ID);
		$data['USER_LNAME'] = $user->USER_LNAME;
		if ($user->USER_CREATE_DATE!=null){
			$data['USER_CREATE_DATE'] = date('d.m.Y',strtotime($user->USER_CREATE_DATE));
		} else {
			$data['USER_CREATE_DATE'] = null;
		}		
		$data['USER_YEAR'] = substr($user->USER_PIN,4,2).'.'.substr($user->USER_PIN,2,2).'.19'.substr($user->USER_PIN,0,2);
		if ($user->USER_MODIFY_USER_ID!=null) {
			$data['USER_MODIFY_USER']=getUserName($user->USER_MODIFY_USER_ID);
		}else{
			$data['USER_MODIFY_USER']=null;
		}
		$data['USER_PIN'] = $user->USER_PIN;
		if ($user->USER_MODIFY_DATE!=null){
			 $data['USER_MODIFY_DATE']= date('d-m-Y',strtotime($user->USER_MODIFY_DATE));
		} else {
			$data['USER_MODIFY_DATE']=null;
		}		
		$data['USER_MNUMBER'] = $user->USER_MNUMBER;
		$data['HIRE_FROM'] = date('d.m.Y',strtotime($user->HIRE_FROM));
		$data['USER_EMAIL'] = $user->USER_EMAIL;
		$data['HIRE_TO'] = date('d.m.Y',strtotime($user->HIRE_TO));
		$data['USER_PIN2'] = 'SL'.substr($user->USER_PIN,4,2).substr($user->USER_PIN,5,1).substr($user->USER_PIN,7,2).substr($user->USER_PIN,4,1);
		$data['LOGIN_PERMISSON'] = getFunction($user->LOGIN_PERMISSON);
		$data['ADRESS_STREET'] = $user->ADRESS_STREET;
		$data['BANK_NUMBER'] = $user->BANK_NUMBER;
		$data['ADRESS_NUMBER'] = $user->ADRESS_NUMBER;
		$data['BANK_ID'] = $user->BANK_ID;
		$data['ADRESS_POST'] = $user->ADRESS_POST;
		$data['BANK_NAME'] = $user->BANK_NAME;
		$data['ADRESS_CITY'] = $user->ADRESS_CITY;
		$data['BANK_IBAN'] = $user->BANK_IBAN;
		$data['ADRESS_STATE'] = $user->ADRESS_STATE;
        $this->load->view('admin/clients/modify_client',$data);
	}
	
	public function validateModifyClient($user_id){
		$count_errors = 0;
		$this->load->model('Users');
		$data['employeeModifyError'] = '';
		if (strlen($this->input->post('USER_FNAME'))<3){
			$count_errors=$count_errors+1;
			if ($count_errors<6){
				$data['employeeModifyError'] = $data['employeeModifyError'].'&nbsp&nbsp&nbsp&nbsp&nbsp <b>'.$count_errors.'. Jméno zaměstnance</b> musí obsahovat minimálně <b>3 znaky.</b><br>';
			}
		}
		if (strlen($this->input->post('USER_LNAME'))<3){
			$count_errors=$count_errors+1;
			if ($count_errors<6){
				$data['employeeModifyError'] = $data['employeeModifyError'].'&nbsp&nbsp&nbsp&nbsp&nbsp <b>'.$count_errors.'. Příjmení zaměstnance</b> musí obsahovat minimálně <b>3 znaky.</b><br>';
			}
		}
		if (strlen($this->input->post('USER_YEAR'))==''){			
			$count_errors=$count_errors+1;
			if ($count_errors<6){
				$data['employeeModifyError'] = $data['employeeModifyError'].'&nbsp&nbsp&nbsp&nbsp&nbsp <b>'.$count_errors.'. Datum narození</b> musí být <b>vyplněn.</b><br>';
			}		
		}
		if (strlen($this->input->post('USER_YEAR'))!=10){			
			$count_errors=$count_errors+1;
			if ($count_errors<6){
				$data['employeeModifyError'] = $data['employeeModifyError'].'&nbsp&nbsp&nbsp&nbsp&nbsp <b>'.$count_errors.'. Datum narození</b> musí být <b>ve formátu DD.MM.YYYY.</b><br>';
			}		
		}
		if ($this->input->post('USER_PIN')==''){
			$count_errors=$count_errors+1;
			if ($count_errors<6){
				$data['employeeModifyError'] = $data['employeeModifyError'].'&nbsp&nbsp&nbsp&nbsp&nbsp <b>'.$count_errors.'. Rodní číslo</b> musí být <b>vyplněno.</b><br>';
			}
		}
		if ($this->input->post('USER_MNUMBER')==''){
			$count_errors=$count_errors+1;
			if ($count_errors<6){
				$data['employeeModifyError'] = $data['employeeModifyError'].'&nbsp&nbsp&nbsp&nbsp&nbsp <b>'.$count_errors.'. Číslo mobilního telefónu</b> musí být <b>vyplněno.</b><br>';
			}
		}
		if ($this->input->post('USER_EMAIL')==''){
			$count_errors=$count_errors+1;
			if ($count_errors<6){
				$data['employeeModifyError'] = $data['employeeModifyError'].'&nbsp&nbsp&nbsp&nbsp&nbsp <b>'.$count_errors.'. E-mail zaměnstnance</b> musí být <b>vyplněn.</b><br>';
			}
		}
		if (strlen($this->input->post('USER_EMAIL'))<8){
			$count_errors=$count_errors+1;
			if ($count_errors<6){
				$data['employeeModifyError'] = $data['employeeModifyError'].'&nbsp&nbsp&nbsp&nbsp&nbsp <b>'.$count_errors.'. E-mail zaměnstnance</b> musí být <b>vyplňen ve formátu abc@abc.org .</b><br>';
			}
		}
		if ($this->input->post('USER_PIN2')==''){
			$count_errors=$count_errors+1;
			if ($count_errors<6){
				$data['employeeModifyError'] = $data['employeeModifyError'].'&nbsp&nbsp&nbsp&nbsp&nbsp <b>'.$count_errors.'. Číslo občianského průkazu</b> musí být <b>vyplněno.</b><br>';
			}
		}
		if ($this->input->post('ADRESS_STREET')==''){
			$count_errors=$count_errors+1;
			if ($count_errors<6){
				$data['employeeModifyError'] = $data['employeeModifyError'].'&nbsp&nbsp&nbsp&nbsp&nbsp <b>'.$count_errors.'. Ulice</b> trvalého bydliska zaměstnanca musí být <b>vyplněna.</b><br>';
			}
		}
		if ($count_errors == 0) {
			$this->Users->updateUser($user_id);
			redirect(base_url('Admin/redirectDetailClient/'.$user_id));
		} else {
			$data['employeeModifyError'] = '&nbsp&nbsp&nbsp&nbsp&nbsp<b><div style="margin-top:-15px; margin-left:24px; margin-bottom:5px">NA FORMULÁRI BOLI ZISTENÉ CHYBY</b> - počet nájdených chýb je ( <b>'.$count_errors.'</b> ).</div>'.$data['employeeModifyError'];
			if ($count_errors>5){
				$data['employeeModifyError'] =	$data['employeeModifyError'].'&nbsp&nbsp&nbsp&nbsp&nbsp ... <span style="color:#B20000">nezobrazeno posledných ( <b>'.($count_errors-5).'  </b>) chýb ...</span>';
			}
			$data['USER_ID'] = $user_id;
			$data['USER_TITLE'] = $this->input->post('USER_TITLE');
			$data['LOGIN_NAME'] = $this->input->post('LOGIN_NAME');
			$data['USER_FNAME'] = $this->input->post('USER_FNAME');
			$data['USER_CREATE_USER'] = $this->input->post('USER_CREATE_USER');
			$data['USER_LNAME'] = $this->input->post('USER_LNAME');
			$data['USER_CREATE_DATE'] = $this->input->post('USER_CREATE_DATE');
			$data['USER_YEAR'] = $this->input->post('USER_YEAR');
			$data['USER_MODIFY_USER']= $this->input->post('USER_MODIFY_USER');
			$data['USER_PIN'] = $this->input->post('USER_PIN');
			$data['USER_MODIFY_DATE']= $this->input->post('USER_MODIFY_DATE');
			$data['USER_MNUMBER'] = $this->input->post('USER_MNUMBER');
			$data['HIRE_FROM'] = $this->input->post('HIRE_FROM');
			$data['USER_EMAIL'] = $this->input->post('USER_EMAIL');
			$data['HIRE_TO'] = $this->input->post('HIRE_TO');
			$data['USER_PIN2'] = $this->input->post('USER_PIN2');
			$data['LOGIN_PERMISSON'] = $this->input->post('LOGIN_PERMISSON');
			$data['ADRESS_STREET'] = $this->input->post('ADRESS_STREET');
			$data['BANK_NUMBER'] = $this->input->post('BANK_NUMBER');
			$data['ADRESS_NUMBER'] = $this->input->post('ADRESS_NUMBER');
			$data['BANK_ID'] = $this->input->post('BANK_ID');
			$data['ADRESS_POST'] = $this->input->post('ADRESS_POST');
			$data['BANK_NAME'] = $this->input->post('BANK_NAME');
			$data['ADRESS_CITY'] = $this->input->post('ADRESS_CITY');
			$data['BANK_IBAN'] = $this->input->post('BANK_IBAN');
			$data['ADRESS_STATE'] = $this->input->post('ADRESS_STATE');
			$this->load->view('admin/users/modify_user',$data);
		}
	}
	
	public function findClient(){
		$this->load->model('Clients');
		if (strlen($this->input->post('findClientText'))<2){
			$data['input']=$this->input->post('findClientText');
			$data['searchClientError'] = 'Pro vyhledání je nutno zadat alespoň dva znaky.';
			$this->load->view('admin/clients/find_client',$data);
		} else {
			$query = $this->Clients->findSpecificClient($this->input->post('findClientText'));
			if ($query->num_rows() == 0 ) {
				$data['input']=$this->input->post('findClientText');
				$data['searchClientError'] = 'Litujeme, pro zadaný reťazec "<b>'.$this->input->post('findClientText').'"</b> nebyl nalezen žádny záznam.';
				$this->load->view('admin/clients/find_client',$data);
			} else if ($query->num_rows() == 1) {
				$query = $query->row();
				redirect(base_url('Admin/redirectDetailClient/'.$query->USER_ID));
			} else {
				$query = $query->row();
				if (strpos($this->input->post('findClientText'),'%') == TRUE){
					$findConstantPrefix = null;
					$findConstantPostfix = null;
				} else {
					$findConstantPrefix = null;
					$findConstantPostfix = null;
				}
				$this->session->set_userdata('clientDefaultWhere', ' (
						USER_TITLE LIKE "'.$findConstantPrefix.$this->input->post('findClientText').$findConstantPostfix.'" OR 
						USER_FNAME LIKE "'.$findConstantPrefix.$this->input->post('findClientText').$findConstantPostfix.'" OR
						USER_LNAME LIKE "'.$findConstantPrefix.$this->input->post('findClientText').$findConstantPostfix.'" OR
						USER_PIN LIKE "'.$findConstantPrefix.$this->input->post('findClientText').$findConstantPostfix.'" OR
						USER_MNUMBER LIKE "'.$findConstantPrefix.$this->input->post('findClientText').$findConstantPostfix.'" OR
						USER_EMAIL LIKE "'.$findConstantPrefix.$this->input->post('findClientText').$findConstantPostfix.'" OR
						ADRESS_STREET LIKE "'.$findConstantPrefix.$this->input->post('findClientText').$findConstantPostfix.'" OR
						ADRESS_NUMBER LIKE "'.$findConstantPrefix.$this->input->post('findClientText').$findConstantPostfix.'" OR
						ADRESS_CITY LIKE "'.$findConstantPrefix.$this->input->post('findClientText').$findConstantPostfix.'" OR
						ADRESS_POST LIKE "'.$findConstantPrefix.$this->input->post('findClientText').$findConstantPostfix.'" OR
						LOGIN_NAME LIKE "'.$findConstantPrefix.$this->input->post('findClientText').$findConstantPostfix.'" OR
						BANK_NUMBER LIKE "'.$findConstantPrefix.$this->input->post('findClientText').$findConstantPostfix.'" OR
						BANK_IBAN LIKE "'.$findConstantPrefix.$this->input->post('findClientText').$findConstantPostfix.'" OR
						BANK_CODE LIKE "'.$findConstantPrefix.$this->input->post('findClientText').$findConstantPostfix.'" OR
						BANK_NAME LIKE "'.$findConstantPrefix.$this->input->post('findClientText').$findConstantPostfix.'" OR
						STATE_NAME LIKE "'.$findConstantPrefix.$this->input->post('findClientText').$findConstantPostfix.'" OR
						STATE_SHORT LIKE "'.$findConstantPrefix.$this->input->post('findClientText').$findConstantPostfix.'")');	
							
				redirect(base_url('Admin/redirectAllClients/1/1'));
			}		
		}
	}
	
	
	public function clearClientFilter($orderBy,$orientation){
		echo "tu si";
		$this->session->set_userdata('clientDefaultWhere', '(1=1)');
		redirect(base_url('Admin/redirectAllClients/'.$orderBy.'/'.$orientation));
	} 
	
	
	public function createNewClient(){
		$this->load->helper('validation_helper');
		
		$data['newEmployeeErrors'] = '';
		$data['newEmployeeTitle'] = $this->input->post('newEmployeeTitle');
		$data['newEmployeeStreet'] = $this->input->post('newEmployeeStreet');
		$data['newEmployeeFirstName'] = $this->input->post('newEmployeeFirstName');
		$data['newEmployeeStreetNumber'] = $this->input->post('newEmployeeStreetNumber');
		$data['newEmployeeLastName'] = $this->input->post('newEmployeeLastName');
		$data['newEmployeePostCode'] = $this->input->post('newEmployeePostCode');
	$data['newEmployeeBirthDate'] = $this->input->post('newEmployeeBirthDate');
	$data['newEmployeeCity'] = $this->input->post('newEmployeeCity');
	$data['newEmployeePIN'] = $this->input->post('newEmployeePIN');
	$data['newEmployeeState'] = $this->input->post('newEmployeeState');
	$data['newEmployeePhoneNumber'] = $this->input->post('newEmployeePhoneNumber');
	$data['newEmployeeHireFrom'] = $this->input->post('newEmployeeHireFrom');
	$data['newEmployeeEmail'] = $this->input->post('newEmployeeEmail');
	$data['newEmployeeHireTo'] = $this->input->post('newEmployeeHireTo'); 
	$data['newEmployeePinNumber'] = $this->input->post('newEmployeePinNumber');
	$data['newEmployeePosition'] = $this->input->post('newEmployeePosition');
	$data['newEmployeeLogin'] = $this->input->post('newEmployeeLogin');
	$data['newEmployeeBankNumber'] = $this->input->post('newEmployeeBankNumber');
	$data['newEmployeePassword'] = substr( str_shuffle( 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789' ), 0, 8 );
	$data['newEmployeeBankCode'] = $this->input->post('newEmployeeBankCode');
	$data['newEmployeeRegisterUser'] =	strtolower($this->session->userdata('username'));
	$data['newEmployeeBankName'] = $this->input->post('newEmployeeBankName');
	$data['newEmployeeIban'] = $this->input->post('newEmployeeIban');
		
		$count = 0;
		$numberOfErrors = 8;
	/* validation Title */	
		if (ContainsNumbers($data['newEmployeeTitle'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Titul</b>  nového zaměstnance <b>se musí skládat jenom ze znaků</b>.';};
		}
	/* validation Street */
		if (IsEmpty($data['newEmployeeStreet'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Ulice</b>  nového zaměstnance <b>musí být vyplněna</b>.';};
		} elseif (IsLowThenThree($data['newEmployeeStreet'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Ulice</b>  nového zaměstnance <b>musí obsahovat minimálně tři znaky</b>.';};
		} elseif (ContainsNumbers($data['newEmployeeStreet'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Ulice</b>  nového zaměstnance <b>se musí skládat jenom ze znaků</b>.';};
		}
	/* validation First Name */
		if (IsEmpty($data['newEmployeeFirstName'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <bJméno</b>  nového zaměstnance <b>musí být vyplněna</b>.';};
		} elseif (IsLowThenThree($data['newEmployeeFirstName'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Jméno</b>  nového zaměstnance <b>musí obsahovat minimálně tři znaky</b>.';};
		} elseif (ContainsNumbers($data['newEmployeeFirstName'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Jméno</b>  nového zaměstnance <b>se musí skládat jenom ze znaků</b>.';};
		}
	/* validation Street number */
		if (IsEmpty($data['newEmployeeStreetNumber'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <Číslo domu</b>  nového zaměstnance <b>musí být vyplněna</b>.';};
		} elseif (!(is_numeric($data['newEmployeeStreetNumber']))) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Číslo domu</b>  nového zaměstnance <b>se musí skládat jenom z číslic</b>.';};
		}
	/* validation newEmployeeLastName */
		if (IsEmpty($data['newEmployeeLastName'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Příjmení</b>  nového zaměstnance <b>musí být vyplněno</b>.';};
		} elseif (IsLowThenThree($data['newEmployeeLastName'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Příjmení</b>  nového zaměstnance <b>musí obsahovat minimálně tři znaky</b>.';};
		} elseif (ContainsNumbers($data['newEmployeeLastName'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Příjmení</b>  nového zaměstnance <b>se musí skládat jenom ze znaků</b>.';};
		}
	/* validation newEmployeePostCode */
		if (IsEmpty($data['newEmployeePostCode'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Smerovací číslo adresy</b>  nového zaměstnance <b>musí být vyplněno</b>.';};
		} elseif (!(IsPostCode($data['newEmployeePostCode']))) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Smerovací číslo adresy</b>  nového zaměstnance <b>musí obsahovat práve pět číslic</b>.';};
		} elseif (!(is_numeric($data['newEmployeePostCode']))) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Smerovací číslo adresy</b>  nového zaměstnance <b>se musí skládat jenom z číslic</b>.';};
		}
	/* validation $data['newEmployeeBirthDate']*/
		if (IsEmpty($data['newEmployeeBirthDate'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Datum narození</b>  nového zaměstnance <b>musí být vyplněno</b>.';};
		} elseif (!(IsDate($data['newEmployeeBirthDate']))) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Datum narození</b>  nového zaměstnance <b>musí být ve formátu DD.MM.YYYY nebo YYYY-MM-DD nebo YYYY/MM/DD</b>.';};
		}
	/* validation $data['newEmployeeCity']*/
		if (IsEmpty($data['newEmployeeCity'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Město</b>  nového zaměstnance <b>musí být vyplněno</b>.';};
		} elseif (IsLowThenThree($data['newEmployeeCity'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Město</b>  nového zaměstnance <b>musí obsahovat minimálně tři znaky</b>.';};
		} elseif (ContainsNumbers($data['newEmployeeCity'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Město</b>  nového zaměstnance <b>se musí skládat jenom ze znaků</b>.';};
		}
	/* validation $data['newEmployeePIN']*/
		if (IsEmpty($data['newEmployeePIN'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Rodní číslo</b>  nového zaměstnance <b>musí být vyplněno</b>.';};
		} elseif (!(IsPIN($data['newEmployeePIN']))) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Rodní číslo</b>  nového zaměstnance <b>se musí být ve formátu 900101/9876</b>.';};
		} elseif (alreadyExistEmployeeByPIN($data['newEmployeePIN'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>JIŽ EXISTUJE UŽIVATEL S RODNÍM ČÍSLEM '.$data['newEmployeePIN'].'</b>.';};
		}
	/* validation $data['newEmployeePhoneNumber']*/
		if (IsEmpty($data['newEmployeePhoneNumber'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Telefónní číslo</b>  nového zaměstnance <b>musí být vyplněno</b>.';};
		} 
	/* validation $data['newEmployeeHireFrom']*/
		if (IsEmpty($data['newEmployeeHireFrom'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Datum počátku závazku</b>  nového zaměstnance <b>musí být vyplněno</b>.';};
		} 
	/* validation $data['newEmployeeEmail']*/
		if (IsEmpty($data['newEmployeeEmail'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Email</b>  nového zaměstnance <b>musí být vyplněno</b>.';};
		}
	/* validation $data['newEmployeeHireTo']*/
		if (IsEmpty($data['newEmployeeHireTo'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Datum ukončení závazku</b>  nového zaměstnance <b>musí být vyplněno</b>.';};
		}
	/* validation $data['newEmployeePinNumber']*/
		if (IsEmpty($data['newEmployeePinNumber'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Číslo občianského průkazu</b>  nového zaměstnance <b>musí být vyplněno</b>.';};
		}
	/* validation $data['newEmployeeBankNumber']*/
		if (IsEmpty($data['newEmployeeBankNumber'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Číslo účtu/b>  nového zaměstnance <b>musí být vyplněno</b>.';};
		}
	/* validation $data['newEmployeeBankCode']*/
		if (IsEmpty($data['newEmployeeBankCode'])) {
			if ($count <= $numberOfErrors) { $count = $count+1; $data['newEmployeeErrors'] = $data['newEmployeeErrors'].'<br>'.$count.'. <b>Kód banky</b>  nového zaměstnance <b>musí být vyplněn</b>.';};
		}
	/* validation $data['newEmployeeIban']*/
				
		if (IsEmpty($data['newEmployeeErrors'])) {
			$this->load->model('Clients');
			$new_user_id = $this->Users->insertNewUser();
			redirect (base_url('Admin/redirectDetailClient/'.$new_user_id));
		} else {
			$this->load->view('admin/clients/new_client',$data);
		}
	}
	
	/*************************************************************************************/
	/*SEKCIA ZMLUVY******************************************************************/
	/*************************************************************************************/
	
	public function redirectDefaultAgreement(){
		$this->load->view('admin/agreements/default_agreement');
	}
	
	public function redirectFindAgreement(){
		$data['input']='';
		$data['searchEmployeeError'] = '';
		$this->load->view('admin/agreements/find_agreement',$data);
	}
	
	public function redirectAllAgreements($order_by, $orientation){
		$this->load->model('Agreements');
		$this->load->library('Pagination');
		$pageLimit = 25;
		$totalRows = $this->Agreements->getCountAllAgreements();
		if ($totalRows < $pageLimit) {
			$zobrazenoZaznamov = '<b>1</b> až <b>'.$totalRows.'</b>';
		} else {
			if ($this->uri->segment(5)==''){
				$zobrazenoZaznamov = '<b>1 až 25</b>';
			} else {
				if (($this->uri->segment(5)+25)>$totalRows){
					$zobrazenoZaznamov = '<b>'.$this->uri->segment(5).'</b> až <b>'.$totalRows.'</b>';
				} else {
					$zobrazenoZaznamov = '<b>'.$this->uri->segment(5).'</b> až <b>'.($this->uri->segment(5)+25).'</b>';
				}
			}			
		}
		
		if ($this->session->userdata('agreementDefaultWhere')!='(1=1)'){
			$zobrazenoFilter = ', dle zadaného filtrovacího kritéria.';
		} else {
			$zobrazenoFilter = '.';
		}
		
		$data['headline'] = '<h1>Seznam smluv <span style="font-size:12px">- zobrazeno '.$zobrazenoZaznamov. ' záznamů z <b>'.$totalRows.'</b> nájdených'.$zobrazenoFilter.'</span></h1>';
		$data['agreements'] = $this->Agreements->getAllTypesAgreements($pageLimit,$this->uri->segment(5),$order_by, $orientation);
		$configuration=$this->getConfigurationForPagination($pageLimit, base_url('Admin/redirectAllAgreements/'.$order_by.'/'.$orientation), $totalRows, 5);
		$this->pagination->initialize($configuration);
		$this->load->view('admin/agreements/all_agreements',$data);
	}
  
	public function redirectNewAgreements(){
        $this->load->view('admin/agreements/new_agreement_sports');
    }
	
	public function findAgreement(){
		$this->load->model('Agreements');
		if (strlen($this->input->post('findAgreementText'))<2){
			$data['input']=$this->input->post('findAgreementText');
			$data['searchEmployeeError'] = 'Pro vyhledání je nutno zadat alespoň dva znaky.';
			$this->load->view('admin/agreements/find_agreement',$data);
		} else {
			$query = $this->Agreements->findSpecificAgreement($this->input->post('findAgreementText'));
			if ($query->num_rows() == 0 ) {
				$data['input']=$this->input->post('findAgreementText');
				$data['searchEmployeeError'] = 'Litujeme, pro zadaný reťazec "<b>'.$this->input->post('findAgreementText').'"</b> nebyl nalezen žádny záznam.';
				$this->load->view('admin/agreements/find_agreement',$data);
			} else {
				$query = $query->row();
				if (strpos($this->input->post('findAgreementText'),'%') == TRUE){
					$findConstantPrefix = null;
					$findConstantPostfix = null;
				} else {
					$findConstantPrefix = null;
					$findConstantPostfix = null;
				}
				$this->session->set_userdata('agreementDefaultWhere', ' (
						a.AGREEMENT_DATE_FROM LIKE "'.$findConstantPrefix.$this->input->post('findAgreementText').$findConstantPostfix.'" OR 
						a.AGREEMENT_DATE_TO LIKE "'.$findConstantPrefix.$this->input->post('findAgreementText').$findConstantPostfix.'" OR
						a.AGREEMENT_PLATNA LIKE "'.$findConstantPrefix.$this->input->post('findAgreementText').$findConstantPostfix.'" OR
						a.AGREEMENT_USER_ID LIKE "'.$findConstantPrefix.$this->input->post('findAgreementText').$findConstantPostfix.'" OR
						a.AGREEMENT_CURRENCY LIKE "'.$findConstantPrefix.$this->input->post('findAgreementText').$findConstantPostfix.'" OR
						a.AGREEMENT_PRICE LIKE "'.$findConstantPrefix.$this->input->post('findAgreementText').$findConstantPostfix.'" OR
						a.AGREEMENT_TYPE LIKE "'.$findConstantPrefix.$this->input->post('findAgreementText').$findConstantPostfix.'" OR
						a.AGREEMENT_USER_NAME LIKE "'.$findConstantPrefix.$this->input->post('findAgreementText').$findConstantPostfix.'" OR
						a.AGREEMENT_CODE LIKE "'.$findConstantPrefix.$this->input->post('findAgreementText').$findConstantPostfix.'"
						)');	
							
				redirect(base_url('Admin/redirectAllAgreements/1/1'));
			}		
		}
	}
	
	public function resetAgreementFilter(){
		$this->session->set_userdata('agreementDefaultWhere', '(1=1)');
		redirect(base_url('Admin/redirectAllAgreements/1/1'));
	}
	
	/*public function redirectExtensionAgreement(){
    $data['newAgreementUser'] = array ('NewNumber' =>'' ,'newPIN' => '','errorMessage' => '','errorMessagePrice' => '','errorMessageDateTo' => '','userName' => '','userBirth' => '','userAge' => '','userAdress' => '','userState' => '','userBank' => '','userPrice' => '','userCurrency' => '','userDateTo' => '','userFrequency' => '');
		$this->load->view('admin/agreements/agreement_extension', $data);
	}

	public function redirectCancelAgreement(){
    $data['newAgreementUser'] = array ('NewNumber' =>'' ,'newPIN' => '','errorMessage' => '','errorMessagePrice' => '','errorMessageDateTo' => '','userName' => '','userBirth' => '','userAge' => '','userAdress' => '','userState' => '','userBank' => '','userPrice' => '','userCurrency' => '','userDateTo' => '','userFrequency' => '', '');
		$this->load->view('admin/agreements/agreement_cancel', $data);
	}*/

	public function redirectChooseNewAgreement($type){	
				
		switch ($type){
			case 0:	
				$this->load->view('admin/agreements/choose_new_agreement');
			break;
			case 1: 
				$data['newAgreementUser'] = array ('newPIN' => '','errorMessage' => '','errorMessagePrice' => '','errorMessageDateTo' => '','userName' => '','userBirth' => '','userAge' => '','userAdress' => '','userState' => '','userBank' => '','userDoctor' => '','userPrice' => '','userCurrency' => '','userDateTo' => '','userFrequency' => '');
				$this->load->view('admin/agreements/new_agreement_life',$data);
			break;
			case 2:
				$data['newAgreementUser'] = array ('newTravelPIN' => '','errorTravelMessage' => '','errorMessageDate' => '','errorMessageCurrency' => '','newTravelName' => '','newTravelBirthDate' => '','newTravelYears' => '','newTravelAdress' => '','newTravelState' => '','newTravelBank' => '','newTravelDateFrom' => '','newTravelDateTo' => '','newTravelPrice' => '','newTravelCurrency' => '','newTravelDestination' => '','newTravelPayType' => '');
				$this->load->view('admin/agreements/new_agreement_travel',$data);
			break;
			case 3: 
				$data['newAgreementUser'] = array ('newPIN' => '', 'errorMessage' => '','errorMessagePrice' => '','errorMessageDateTo' => '','userName' => '','userBirth' => '','userAge' => '','userAdress' => '','userState' => '','userBank' => '','userPrice' => '','userCurrency' => '','userDateTo' => '','userDateFrom' => '','userDestination' => '','userPayType' => '','userFrequency' => '');
				$this->load->view('admin/agreements/new_agreement_pension',$data);
			break;
			case 4: 
				$data['newAgreementUser'] = array ('newPIN' => '', 'errorMessage' => '','errorMessagePrice' => '','errorMessageDateTo' => '','userName' => '','userBirth' => '','userAge' => '','userAdress' => '','userState' => '','userBank' => '','userPrice' => '','userCurrency' => '','userDateTo' => '','userDateFrom' => '','userDestination' => '','userPayType' => '','userFrequency' => '', 'userDoctor' => '');
				$this->load->view('admin/agreements/new_agreement_sports',$data);
			break;
		}	
	}
	
/* Zivotne poistenie */
	  public function redirectEditLifeAgreement($agreement_id){
		$this->load->model('Agreements');
			$this->load->model('Users');
		$data['agreement'] = $this->Agreements->getUserAgreement($agreement_id);
		$user_id = $data['agreement']->LIFE_USER_ID;
		$data['user'] = $this->Users->getUserDetailInfo($user_id);
		
		$this->load->view('admin/agreements/edit_agreement_life', $data);
	  }
	  
	public function newLifeAgreement(){
		$this->load->model('Agreements');
		$this->load->model('Users');
		
		if ($this->input->post('newLifeTrace') == "Dohledat"){
				$data['newAgreementUser'] = array ('newPIN' => $this->input->post('newLifePIN'),
												   'errorMessage' => '',
												   'errorMessagePrice' => '',
												   'errorMessageDateTo' => '',
												   'userName' => '',
												   'userBirth' => '',
												   'userAge' => '',
												   'userAdress' => '',
												   'userState' => '',
												   'userBank' => '',
												   'userDoctor' => '',
												   'userPrice' => '',
												   'userCurrency' => '',
												   'userDateTo' => '',
												   'userFrequency' => ''
												   );	
				if (strlen($this->input->post('newLifePIN'))=='') {
					$data['newAgreementUser']['errorMessage']='Pro dohledání je nutné vyplnit rodní číslo.';
				} else if (strlen($this->input->post('newLifePIN'))!=10){
					$data['newAgreementUser']['errorMessage']='Zadejete prosím rodní číslo ve tvaru 9201011234.';
				} else if(!(ctype_digit ( $this->input->post('newLifePIN') ))){
					$data['newAgreementUser']['errorMessage']='Rodní číslo se musí skládat jenom z číslic.';
				} else {
					$data['newAgreementUser']['errorMessage']='';
					$this->load->model('Users');
					$userName = $this->Users->getUserInfoByPIN($this->input->post('newLifePIN'));
					if ($userName == FALSE) {
						$data['newAgreementUser']['errorMessage']='Nebyl nalezen klient s rodním číslem '.$this->input->post('newLifePIN').'.';
					} else {
						$data['newAgreementUser'] = array ('newPIN' => $this->input->post('newLifePIN'),
									   'errorMessage' => '',
									   'errorMessagePrice' => '',
										'errorMessageDateTo' => '',
									   'userName' => $userName,
									   'userBirth' => substr($this->input->post('newLifePIN'),4,2).'.'.substr($this->input->post('newLifePIN'),2,2).'.19'.substr($this->input->post('newLifePIN'),0,2),
									   'userAge' => round((((strtotime(date('d.m.Y')))-(strtotime(substr($this->input->post('newLifePIN'),4,2).'.'.substr($this->input->post('newLifePIN'),2,2).'.19'.substr($this->input->post('newLifePIN'),0,2))))/60/60/24/365),0),   
									   'userAdress' => $this->Users->getUserAdressByPIN($this->input->post('newLifePIN')),
									   'userState' => $this->Users->getUserStateByPIN($this->input->post('newLifePIN')),
									   'userBank' => $this->Users->getUserBankByPIN($this->input->post('newLifePIN')),
									   'userDoctor' => $this->input->post('newLifeDoctor'),
										'userPrice' => $this->input->post('newLifePrice'),
										'userCurrency' => $this->input->post('newLifeCurrency'),
										'userDateTo' => $this->input->post('newLifeDateTo'),
										'userFrequency' => $this->input->post('newLifeFrequency')
									   );	
					}
				}
				$this->load->view('admin/agreements/new_agreement_life',$data);
		} else {
			$data['newAgreementUser'] = array (
				'newPIN' => $this->input->post('newLifePIN'),
				'errorMessage' => '',
				'errorMessagePrice' => '',
				'errorMessageDateTo' => '',
				'userName' => $this->input->post('newLifeName'),
				'userBirth' => $this->input->post('newLifeBirthDate'),
				'userAge' => $this->input->post('newLiveYears'),
				'userAdress' => $this->input->post('newLiveAdress'),
				'userState' => $this->input->post('newLiveState'),
				'userBank' => $this->input->post('newLiveBank'),
				'userDoctor' => $this->input->post('newLifeDoctor'),
				'userPrice' => $this->input->post('newLifePrice'),
				'userCurrency' => $this->input->post('newLifeCurrency'),
				'userDateTo' => $this->input->post('newLifeDateTo'),
				'userFrequency' => $this->input->post('newLifeFrequency')
			);
			
			if ($this->input->post('newLifeName')!=''){
				if ($this->input->post('newLifePrice')==''){
				$data['newAgreementUser']['errorMessagePrice']='Je nutné vyplnit výši pojistného.';
				} else if (!(ctype_digit ( $this->input->post('newLifePrice')))) {
					$data['newAgreementUser']['errorMessagePrice']='Výše pojistného se musí skládat jenom z číslic.';
				};			
				if ($this->input->post('newLifeDateTo')==''){
					$data['newAgreementUser']['errorMessageDateTo']='Je nutné vyplnit datum platnosti do.';
				} else {
					$user_id = $this->Users->getUserIdByPIN($this->input->post('newLifePIN'));
					$data['newAgreementUser']['errorMessageDateTo']=$this->Agreements->canICreateLifeAgreement($user_id, date('Y-m-d',strtotime($this->input->post('newLifeDateFrom'))), date('Y-m-d',strtotime($this->input->post('newLifeDateFrom'))));
				}
				
				if (($data['newAgreementUser']['errorMessagePrice']=='')AND($data['newAgreementUser']['errorMessage']=='')AND($data['newAgreementUser']['errorMessageDateTo']=='')){								
					$agreement_id = $this->Agreements->setNewLifeAgreement($user_id);
					redirect(base_url('Admin/redirectEditLifeAgreement/'.$agreement_id));
				} else {
					$this->load->view('admin/agreements/edit_agreement_life',$data);
				}	
			} else {
				$this->load->view('admin/agreements/new_agreement_life',$data);
			}			
				
		}          
	}
  
   public function editLifeAgreement($agreement_id){
      $this->load->model('Agreements');
      $this->Agreements->updateLifeAgreement($agreement_id); 
      $agreement = $this->Agreements->getUserAgreement($agreement_id);
      $user_id = $agreement->LIFE_USER_ID;
      redirect(base_url('Admin/redirectEditLifeAgreement/'.$agreement_id));
    }

	public function acceptLifeAgreementPDF($agreement_id){
		$this->load->model('Agreements');
		$this->Agreements->acceptLifeAgreementPDF($agreement_id); 
		redirect(base_url('Admin/redirectEditLifeAgreement/'.$agreement_id));
	}
	
	public function stornoLifeAgreement($agreement_id){
		$this->load->model('Agreements');
		$this->Agreements->stornoLifeAgreement($agreement_id);
		redirect(base_url('Admin/redirectEditLifeAgreement/'.$agreement_id));
	}
	
	public function fireLifeAgreement($agreement_id){
		$this->load->model('Agreements');
		$this->Agreements->fireLifeAgreement($agreement_id);
		redirect(base_url('Admin/redirectEditLifeAgreement/'.$agreement_id));
	}
	
/* cestovne poistenie */
	public function acceptTravelAgreementPDF($agreement_id){
		$this->load->model('Agreements');
		$this->Agreements->acceptTravelAgreementPDF($agreement_id); 
		redirect(base_url('Admin/redirectEditTravelAgreement/'.$agreement_id));
	}
	
	public function stornoTravelAgreement($agreement_id){
		$this->load->model('Agreements');
		$this->Agreements->stornoTravelAgreement($agreement_id);
		redirect(base_url('Admin/redirectEditTravelAgreement/'.$agreement_id));
	}
	
	public function fireTravelAgreement($agreement_id){
		$this->load->model('Agreements');
		$this->Agreements->fireTravelAgreement($agreement_id);
		redirect(base_url('Admin/redirectEditTravelAgreement/'.$agreement_id));
	}
	
	public function redirectEditTravelAgreement($agreement_id){
		$this->load->model('Agreements');
		$this->load->model('Users');
		$data['agreement'] = $this->Agreements->getUserAgreementTravel($agreement_id);
		$user_id = $data['agreement']->TRAVEL_USER_ID;
		$data['user'] = $this->Users->getUserDetailInfo($user_id);
		$this->load->helper('validation_helper');
		$data['newAgreementUser'] = array ('newTravelPIN' => $data['user']->USER_PIN,
										   'errorTravelMessage' => '',
										   'errorMessageDate' => '',
										   'errorMessageCurrency' => '',
										   'newTravelName' => getClientNameById($data['user']->USER_ID),
										   'newTravelBirthDate' => substr($data['user']->USER_PIN,4,2).'.'.substr($data['user']->USER_PIN,2,2).'.19'.substr($data['user']->USER_PIN,0,2),
										   'newTravelYears' => (2017-(intval('19'.substr($data['user']->USER_PIN,0,2)))),
										   'newTravelAdress' => $data['user']->ADRESS_STREET.' '.$data['user']->ADRESS_NUMBER.', '.$data['user']->ADRESS_CITY, 
										   'newTravelState' => '( '.$data['user']->STATE_SHORT.' ) '.$data['user']->STATE_NAME,
										   'newTravelBank' =>  $data['user']->BANK_NUMBER.'/'.$data['user']->BANK_CODE.' ('.$data['user']->BANK_NAME.') ',
										   'newTravelDateFrom' => date("d.m.Y",strtotime($data['agreement']->TRAVEL_DATE_FROM)),
										   'newTravelDateTo' => date("d.m.Y",strtotime($data['agreement']->TRAVEL_DATE_TO)),
										   'newTravelPrice' => $data['agreement']->TRAVEL_PRICE,
										   'newTravelCurrency' => $data['agreement']->TRAVEL_CURRENCY,
										   'newTravelDestination' => $data['agreement']->TRAVEL_DESTINATION,
										   'newTravelPayType' => $data['agreement']->TRAVEL_PAY_TYPE,
										   'newTravelPlatna' => $data['agreement']->TRAVEL_PLATNA,
										   'newTravelId' => $data['agreement']->TRAVEL_ID
										   );
		$this->load->view('admin/agreements/edit_agreement_travel', $data);
	}
	
	public function editTravelAgreement($agreement_id){
		$this->load->model('Users');
		$this->load->helper('validation_helper');
		$this->load->model('Agreements');
		$data['newAgreementUser'] = array (
				'newTravelPIN' => $this->input->post('newTravelPIN'),
				'errorTravelMessage' => '',
				'errorMessageDate' => '',
				'errorMessageCurrency' => '',
				'newTravelName' => $this->input->post('newTravelName'),
				'newTravelBirthDate' => $this->input->post('newTravelBirthDate'),
				'newTravelYears' => $this->input->post('newTravelYears'),
				'newTravelAdress' => $this->input->post('newTravelAdress'),
				'newTravelState' => $this->input->post('newTravelState'),
				'newTravelBank' => $this->input->post('newTravelBank'),
				'newTravelDateFrom' => $this->input->post('newTravelDateFrom'),
				'newTravelDateTo' => $this->input->post('newTravelDateTo'),
				'newTravelPrice' => $this->input->post('newTravelPrice'),
				'newTravelCurrency' => $this->input->post('newTravelCurrency'),
				'newTravelDestination' => $this->input->post('newTravelDestination'),
				'newTravelPayType' => $this->input->post('newTravelPayType'),
				'newTravelPlatna' =>  $this->input->post('newTravelPlatna'),
				'newTravelId' =>  $this->input->post('newTravelId'));
				
		$user_id = $this->Users->getUserIdByPIN($this->input->post('newTravelPIN'));
				if (IsEmpty($this->input->post('newTravelDateFrom')) and IsEmpty($this->input->post('newTravelDateTo'))){
					$data['newAgreementUser']['errorMessageDate']='Je nutné vyplnit datum <b>platnosti od</b> a <b>platnost do</b>.';
				} else if (IsEmpty($this->input->post('newTravelDateFrom'))) {
					$data['newAgreementUser']['errorMessageDate']='Je nutné vyplnit datum <b>platnosti od</b>.';
				} else if (IsEmpty($this->input->post('newTravelDateTo'))) {
					$data['newAgreementUser']['errorMessageDate']='Je nutné vyplnit datum <b>platnosti do</b>.';
				} else if ((!(IsDate($this->input->post('newTravelDateFrom')))) and (!(IsDate($this->input->post('newTravelDateTo'))))) {
					$data['newAgreementUser']['errorMessageDate']='Datum <b>platnosti od</b> a datum <b> platnost do</b> musí být ve formátu <b>DD.MM.YYYY</b> nebo <b>YYYY/MM/DD</b> nebo <b>YYYY-MM-DD</b>.';
				} else if (!(IsDate($this->input->post('newTravelDateFrom')))) {
					$data['newAgreementUser']['errorMessageDate']='Datum <b>platnosti od</b> musí být ve formátu <b>DD.MM.YYYY</b> nebo <b>YYYY/MM/DD</b> nebo <b>YYYY-MM-DD</b>.';
				} else if (!(IsDate($this->input->post('newTravelDateTo')))) {
					$data['newAgreementUser']['errorMessageDate']='Datum <b>platnosti do</b> musí být ve formátu <b>DD.MM.YYYY</b> nebo <b>YYYY/MM/DD</b> nebo <b>YYYY-MM-DD</b>.';
				} else if ((strtotime($this->input->post('newTravelDateFrom'))) < (strtotime("now"))) {
					$data['newAgreementUser']['errorMessageDate']='Datum <b>platnosti od</b> nemůže být menší alebo rovný ako dnešný datum.';
				} else if ((strtotime($this->input->post('newTravelDateFrom'))) > (strtotime($this->input->post('newTravelDateTo')))) {
					$data['newAgreementUser']['errorMessageDate']='Datum <b>platnosti od</b> musí být menší jako datum <b>platnost do</b>.';
				} else if (IsEmpty($this->input->post('newTravelPrice'))) {
					$data['newAgreementUser']['errorMessageCurrency']='<b>Výše pojistného</b> musí být vyplňena.';
				} else if (!(ctype_digit($this->input->post('newTravelPrice')))) {
					$data['newAgreementUser']['errorMessageCurrency']='<b>Výše pojistného</b> musí být vyplňena numerickou hodnotou.';
				} else if (intval($this->input->post('newTravelPrice')) < 1){
					$data['newAgreementUser']['errorMessageCurrency']='<b>Výše pojistného</b> musí být vyšší jako hodnota "1"';
				} else if (!($this->Agreements->canIEditAgreementTravel($user_id,$this->input->post('newTravelDateFrom'),$this->input->post('newTravelDateTo'),$this->input->post('newTravelId')))) {
					$data['newAgreementUser']['errorMessageDate']='Pro klienta s rodním číslem <b>'.$this->input->post('').'</b> již existuje <b>platné cestovné pojištení</b> pro zadané období.';
				};
				
				if (($data['newAgreementUser']['errorMessageCurrency']=='') AND ($data['newAgreementUser']['errorMessageDate']=='')){
					$agreement_id = $this->Agreements->setEditTravelAgreement($this->input->post('newTravelId'));	
					redirect(base_url('Admin/redirectEditTravelAgreement/'.$this->input->post('newTravelId')));
				} else {
					$this->load->view('admin/agreements/edit_agreement_travel',$data);
				}
	}

	public function newTravelAgreement(){
		$this->load->model('Agreements');
		$this->load->model('Users');
		
		if ($this->input->post('newTravelTrace') == "Dohledat"){
				$data['newAgreementUser'] = array ('newTravelPIN' => $this->input->post('newTravelPIN'),
												   'errorTravelMessage' => '',
												   'errorMessageDate' => '',
												   'errorMessageCurrency' => '',
												   'newTravelName' => '',
												   'newTravelBirthDate' => '',
												   'newTravelYears' => '',
												   'newTravelAdress' => '',
												   'newTravelState' => '',
												   'newTravelBank' => '',
												   'newTravelDateFrom' => '',
												   'newTravelDateTo' => '',
												   'newTravelPrice' => '',
												   'newTravelCurrency' => '',
												   'newTravelDestination' => '',
												   'newTravelPayType' => ''
												   );	
				if (strlen($this->input->post('newTravelPIN'))=='') {
					$data['newAgreementUser']['errorTravelMessage']='Pro dohledání je nutné vyplnit rodní číslo.';
				} else if (strlen($this->input->post('newTravelPIN'))!=10){
					$data['newAgreementUser']['errorTravelMessage']='Zadejete prosím rodní číslo ve tvaru 9201011234.';
				} else if(!(ctype_digit ( $this->input->post('newTravelPIN') ))){
					$data['newAgreementUser']['errorTravelMessage']='Rodní číslo se musí skládat jenom z číslic.';
				} else {
					$data['newAgreementUser']['errorTravelMessage']='';
					$this->load->model('Users');
					$userName = $this->Users->getUserInfoByPIN($this->input->post('newTravelPIN'));
					if ($userName == FALSE) {
						$data['newAgreementUser']['errorTravelMessage']='Nebyl nalezen klient s rodním číslem '.$this->input->post('newTravelPIN').'.';
					} else {
						$data['newAgreementUser'] = array ('newTravelPIN' => $this->input->post('newTravelPIN'),
														   'errorTravelMessage' => '',
														   'errorMessageDate' => '',
														   'errorMessageCurrency' => '',
														   'newTravelName' => $userName,
														   'newTravelBirthDate' => substr($this->input->post('newTravelPIN'),4,2).'.'.substr($this->input->post('newTravelPIN'),2,2).'.19'.substr($this->input->post('newTravelPIN'),0,2),
														   'newTravelYears' => round((((strtotime(date('d.m.Y')))-(strtotime(substr($this->input->post('newTravelPIN'),4,2).'.'.substr($this->input->post('newTravelPIN'),2,2).'.19'.substr($this->input->post('newTravelPIN'),0,2))))/60/60/24/365),0),   
														   'newTravelAdress' => $this->Users->getUserAdressByPIN($this->input->post('newTravelPIN')),
														   'newTravelState' => $this->Users->getUserStateByPIN($this->input->post('newTravelPIN')),
														   'newTravelBank' => $this->Users->getUserBankByPIN($this->input->post('newTravelPIN')),
														   'newTravelDateFrom' => $this->input->post('newTravelDateFrom'),
														   'newTravelDateTo' => $this->input->post('newTravelDateTo'),
														   'newTravelPrice' => $this->input->post('newTravelPrice'),
														   'newTravelCurrency' => $this->input->post('newTravelCurrency'),
														   'newTravelDestination' => $this->input->post('newTravelDestination'),
														   'newTravelPayType' => $this->input->post('newTravelPayType')
														   );	
					}
				}
				$this->load->view('admin/agreements/new_agreement_travel',$data);
		} else {
			$data['newAgreementUser'] = array (
				'newTravelPIN' => $this->input->post('newTravelPIN'),
				'errorTravelMessage' => '',
				'errorMessageDate' => '',
				'errorMessageCurrency' => '',
				'newTravelName' => $this->input->post('newTravelName'),
				'newTravelBirthDate' => $this->input->post('newTravelBirthDate'),
				'newTravelYears' => $this->input->post('newTravelYears'),
				'newTravelAdress' => $this->input->post('newTravelAdress'),
				'newTravelState' => $this->input->post('newTravelState'),
				'newTravelBank' => $this->input->post('newTravelBank'),
				'newTravelDateFrom' => $this->input->post('newTravelDateFrom'),
				'newTravelDateTo' => $this->input->post('newTravelDateTo'),
				'newTravelPrice' => $this->input->post('newTravelPrice'),
				'newTravelCurrency' => $this->input->post('newTravelCurrency'),
				'newTravelDestination' => $this->input->post('newTravelDestination'),
				'newTravelPayType' => $this->input->post('newTravelPayType')
			);
			
			$this->load->helper('validation_helper');
			
			if ($this->input->post('newTravelName')!=''){	
				$user_id = $this->Users->getUserIdByPIN($this->input->post('newTravelPIN'));
				if (IsEmpty($this->input->post('newTravelDateFrom')) and IsEmpty($this->input->post('newTravelDateTo'))){
					$data['newAgreementUser']['errorMessageDate']='Je nutné vyplnit datum <b>platnosti od</b> a <b>platnost do</b>.';
				} else if (IsEmpty($this->input->post('newTravelDateFrom'))) {
					$data['newAgreementUser']['errorMessageDate']='Je nutné vyplnit datum <b>platnosti od</b>.';
				} else if (IsEmpty($this->input->post('newTravelDateTo'))) {
					$data['newAgreementUser']['errorMessageDate']='Je nutné vyplnit datum <b>platnosti do</b>.';
				} else if ((!(IsDate($this->input->post('newTravelDateFrom')))) and (!(IsDate($this->input->post('newTravelDateTo'))))) {
					$data['newAgreementUser']['errorMessageDate']='Datum <b>platnosti od</b> a datum <b> platnost do</b> musí být ve formátu <b>DD.MM.YYYY</b> nebo <b>YYYY/MM/DD</b> nebo <b>YYYY-MM-DD</b>.';
				} else if (!(IsDate($this->input->post('newTravelDateFrom')))) {
					$data['newAgreementUser']['errorMessageDate']='Datum <b>platnosti od</b> musí být ve formátu <b>DD.MM.YYYY</b> nebo <b>YYYY/MM/DD</b> nebo <b>YYYY-MM-DD</b>.';
				} else if (!(IsDate($this->input->post('newTravelDateTo')))) {
					$data['newAgreementUser']['errorMessageDate']='Datum <b>platnosti do</b> musí být ve formátu <b>DD.MM.YYYY</b> nebo <b>YYYY/MM/DD</b> nebo <b>YYYY-MM-DD</b>.';
				} else if ((strtotime($this->input->post('newTravelDateFrom'))) < (strtotime("now"))) {
					$data['newAgreementUser']['errorMessageDate']='Datum <b>platnosti od</b> nemůže být menší alebo rovný ako dnešný datum.';
				} else if ((strtotime($this->input->post('newTravelDateFrom'))) > (strtotime($this->input->post('newTravelDateTo')))) {
					$data['newAgreementUser']['errorMessageDate']='Datum <b>platnosti od</b> musí být menší jako datum <b>platnost do</b>.';
				} else if (IsEmpty($this->input->post('newTravelPrice'))) {
					$data['newAgreementUser']['errorMessageCurrency']='<b>Výše pojistného</b> musí být vyplňena.';
				} else if (!(ctype_digit($this->input->post('newTravelPrice')))) {
					$data['newAgreementUser']['errorMessageCurrency']='<b>Výše pojistného</b> musí být vyplňena numerickou hodnotou.';
				} else if (intval($this->input->post('newTravelPrice')) < 1){
					$data['newAgreementUser']['errorMessageCurrency']='<b>Výše pojistného</b> musí být vyšší jako hodnota "1"';
				} else if (!($this->Agreements->canICreateNewAgreementTravel($user_id,$this->input->post('newTravelDateFrom'),$this->input->post('newTravelDateTo')))) {
					$data['newAgreementUser']['errorMessageDate']='Pro klienta s rodním číslem <b>'.$this->input->post('').'</b> již existuje <b>platné cestovné pojištení</b> pro zadané období.';
				}; 

				if (($data['newAgreementUser']['errorMessageCurrency']=='') AND ($data['newAgreementUser']['errorMessageDate']=='')){
					$agreement_id = $this->Agreements->setNewTravelAgreement($user_id);	
					redirect(base_url('Admin/redirectEditTravelAgreement/'.$agreement_id));
				} else {
					$this->load->view('admin/agreements/new_agreement_travel',$data);
				}

			} else {
				$this->load->view('admin/agreements/new_agreement_life',$data);
			}			
				
		}          
	}

	
	/*************************************************************************************/
	/*SEKCIA FAKTURY******************************************************************/
	/*************************************************************************************/
	
	public function redirectDefaultInvoice(){
		$this->load->view('admin/invoices/default_invoice');
	}
	
	public function redirectFindInvoice(){
		$data['input']='';
		$data['searchBillError'] = '';
        $this->load->view('admin/invoices/find_bill',$data);
    }
	
	public function clearBillsFilter($orderBy,$orientation){
		$this->session->set_userdata('billsDefaultWhere', '(1=1)');
		redirect(base_url('Admin/redirectAllInvoices/'.$orderBy.'/'.$orientation));
	}
	
	public function findInvoice(){
		$this->load->model('Bills');
		if (strlen($this->input->post('findBillText'))<1){
			$data['input']=$this->input->post('findBillText');
			$data['searchBillError'] = 'Pro vyhledání je nutno zadat alespoň jeden znak.';
			$this->load->view('admin/invoices/find_bill',$data);
		} else {
			$query = $this->Bills->findSpecificBill($this->input->post('findBillText'));
			if ($query->num_rows() == 0 ) {
				$data['input']=$this->input->post('findBillText');
				$data['searchBillError'] = 'Litujeme, pro zadaný reťazec "<b>'.$this->input->post('findBillText').'"</b> nebyl nalezen žádny záznam.';
				$this->load->view('admin/invoices/find_bill',$data);
			}  else {
				$query = $query->row();
				if (strpos($this->input->post('findBillText'),'%') == TRUE){
					$findConstantPrefix = null;
					$findConstantPostfix = null;
				} else {
					$findConstantPrefix = null;
					$findConstantPostfix = null;
				}
				$this->session->set_userdata('billsDefaultWhere', ' (
						BILL_CODE LIKE "'.$findConstantPrefix.$this->input->post('findBillText').$findConstantPostfix.'" OR 
						BILL_SEQUENCE LIKE "'.$findConstantPrefix.$this->input->post('findBillText').$findConstantPostfix.'" OR
						BILL_AGREEMENT_TYPE LIKE "'.$findConstantPrefix.$this->input->post('findBillText').$findConstantPostfix.'" OR
						BILL_AGREEMENT_CODE LIKE "'.$findConstantPrefix.$this->input->post('findBillText').$findConstantPostfix.'" OR
						BILL_DATE_CREATE LIKE "'.$findConstantPrefix.$this->input->post('findBillText').$findConstantPostfix.'" OR
						BILL_PAY_DONE LIKE "'.$findConstantPrefix.$this->input->post('findBillText').$findConstantPostfix.'" OR
						BILL_PAY_PRICE LIKE "'.$findConstantPrefix.$this->input->post('findBillText').$findConstantPostfix.'" OR
						BILL_PAY_CURRENCY LIKE "'.$findConstantPrefix.$this->input->post('findBillText').$findConstantPostfix.'")');	
							
				redirect(base_url('Admin/redirectAllInvoices/1/1'));
			}		
		}
	}
	
	public function redirectAllInvoices($orderBy, $orientation){
		$this->load->model('Bills');
		$this->load->library('Pagination');		
		$pageLimit = 25;
		$totalRows = $this->Bills->getCountAllBills();
		if ($totalRows < $pageLimit) {
			$zobrazenoZaznamov = '<b>1</b> až <b>'.$totalRows.'</b>';
		} else {
			if ($this->uri->segment(5)==''){
				$zobrazenoZaznamov = '<b>1 až 25</b>';
			} else {
				if (($this->uri->segment(5)+25)>$totalRows){
					$zobrazenoZaznamov = '<b>'.$this->uri->segment(5).'</b> až <b>'.$totalRows.'</b>';
				} else {
					$zobrazenoZaznamov = '<b>'.$this->uri->segment(5).'</b> až <b>'.($this->uri->segment(5)+25).'</b>';
				}
			}			
		}
		if ($this->session->userdata('billsDefaultWhere')!='(1=1)'){
			$zobrazenoFilter = ', dle zadaného filtrovacího kritéria.';
		} else {
			$zobrazenoFilter = '.';
		}
		$data['headline'] = '<h1>Seznam faktúr <span style="font-size:12px">- zobrazeno '.$zobrazenoZaznamov. ' záznamů z <b>'.$totalRows.'</b> nájdených'.$zobrazenoFilter.'</span></h1>';
		$data['bills'] = $this->Bills->fetchBills($pageLimit, $this->uri->segment(5),$orderBy, $orientation);
        $configuration=$this->getConfigurationForPagination($pageLimit, base_url('Admin/redirectAllInvoices/'.$orderBy.'/'.$orientation.'/'), $totalRows, 5);	 
		$this->pagination->initialize($configuration);
		$this->load->view('admin/invoices/all_invoices',$data);
    }
	
	/*************************************************************************************/
	/*SEKCIA ARCHIV***********************************************************************/
	/*************************************************************************************/
	
	
	/*************************************************************************************/
	/*SEKCIA NASTAVENIE*******************************************************************/
	/*************************************************************************************/

  public function redirectSettings(){
    $this->load->model('Settings');
    $data['settings'] = $this->Settings->getAllSettings();
    $data['newSettings'] = array (
			'datum' => date('d.m.Y h:m:s'),
			'mzda_vedouci' => '',
			'mzda_revizni' => '',
			'mzda_ucetni' => '',
      'mzda_poradce' => '',
      'ulice' => $data['settings'][0]->GENERAL_STREET,
      'cislo' => $data['settings'][0]->GENERAL_STREET_NUMBER,
      'psc' => $data['settings'][0]->GENERAL_POST_CODE,
      'mesto' => $data['settings'][0]->GENERAL_CITY,
		);
    $this->load->view('admin/settings/settings',$data);   
  }

	/*************************************************************************************/
	/*SEKCIA NASTAVENIE STRANKOVANIA******************************************************/
	/*************************************************************************************/
	public function getConfigurationForPagination($pageLimit, $base_url, $totalRows, $uriSegment){
		$configuration=array();
		$configuration['per_page'] = $pageLimit;
		$configuration['base_url'] = $base_url;	
		$configuration['total_rows'] = $totalRows;
		$configuration['uri_segment'] = intval($uriSegment);
		
		$configuration['full_tag_open'] = '<ul class="pagination">';
  	$configuration['full_tag_close'] = '</ul></div><!--pagination-->';
		$configuration['first_link'] = '&laquo;';
		$configuration['first_tag_open'] = '<li>';
		$configuration['first_tag_close'] = '</li>';
		$configuration['last_link'] = '&raquo;';
		$configuration['last_tag_open'] = '<li>';
		$configuration['last_tag_close'] = '</li>';
		$configuration['next_link'] = '&rarr;';
		$configuration['next_tag_open'] = '<li>';
		$configuration['next_tag_close'] = '</li>';
		$configuration['prev_link'] = '&larr;';
		$configuration['prev_tag_open'] = '<li>';
		$configuration['prev_tag_close'] = '</li>';
		$configuration['cur_tag_open'] = '<li id="active"><a href="">';
		$configuration['cur_tag_close'] = '</a></li>';
		$configuration['num_tag_open'] = '<li class="page">';
		$configuration['num_tag_close'] = '</li>';
		
		return $configuration;
	} 
	
	public function opravKody(){
		$this->load->model('Vypocet');
		$this->Vypocet->opravKody();
		echo "OK";
	}	
	
	public function dorobLogin(){
		$this->load->model('Vypocet');
		$this->Vypocet->dorobLogin();
		echo "OK";
	}
	
	public function opravPIN(){
		$this->load->model('Vypocet');
		$this->Vypocet->opravPIN();
		echo "OK";
	}
	
	public function generujZmluvy(){
		$this->load->model('Vypocet');
		$this->Vypocet->generujZmluvy();
		echo "OK";
	}
}
