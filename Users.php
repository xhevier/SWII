<?php
Class Users extends CI_Model {

	public function setNewTitle($hodnota){
		
	}
	
	public function getName($hodnota){
		$sql = 'SELECT * FROM POJ_T_USER WHERE USER_ID='.$hodnota;
		$query = $this->db->query($sql);
		$query = $query->row();
		return ($query->USER_FNAME.' '.$query->USER_LNAME);
	}

   public function getAllUsers(){
	   $sql = 'SELECT * 
				 FROM POJ_T_USER
				 LEFT JOIN POJ_T_USER_ADRESS ON POJ_T_USER.USER_ADRESS_ID = POJ_T_USER_ADRESS.ADRESS_ID
				 LEFT JOIN POJ_T_USER_HIRE ON POJ_T_USER.USER_HIRE_ID = POJ_T_USER_HIRE.HIRE_ID
				 LEFT JOIN POJ_T_USER_LOGIN ON POJ_T_USER.USER_LOGIN_ID = POJ_T_USER_LOGIN.LOGIN_ID
			    WHERE (POJ_T_USER.USER_ID > 1) 
				  AND (LOGIN_PERMISSON < 5)
	   ';
	   $query = $this->db->query($sql);
	   return $query->result();
   }
   
   public function fetchUsers($limit, $offset, $orderBy, $orientation){
		if ($offset==''){
			$offset=0;
		} 	
		switch ($orderBy){
			case 1: $orderBy = 'USER_ID'; break;
			case 2: $orderBy = 'LOGIN_NAME'; break;
			case 3: $orderBy = 'USER_LNAME'; break;
			case 4: $orderBy = 'USER_MNUMBER'; break;
			case 5: $orderBy = 'USER_EMAIL'; break;
			case 6: $orderBy = 'STATE_SHORT'; break;
			case 7: $orderBy = 'ADRESS_CITY'; break;
			case 8: $orderBy = 'USER_CREATE_USER_ID'; break;
			case 9: $orderBy = 'USER_CREATE_DATE'; break;
			case 10: $orderBy = 'USER_MODIFY_USER_ID'; break;
			case 11: $orderBy = 'USER_MODIFY_DATE'; break;
		}
		
		switch ($orientation){
			case 1: $orientation = 'ASC'; break;
			case 2: $orientation = 'DESC'; break;
		}

		$sql = 'SELECT * 
				 FROM POJ_T_USER
				 LEFT JOIN POJ_T_USER_ADRESS ON POJ_T_USER.USER_ADRESS_ID = POJ_T_USER_ADRESS.ADRESS_ID
				 LEFT JOIN POJ_T_USER_HIRE ON POJ_T_USER.USER_HIRE_ID = POJ_T_USER_HIRE.HIRE_ID
				 LEFT JOIN POJ_T_USER_LOGIN ON POJ_T_USER.USER_LOGIN_ID = POJ_T_USER_LOGIN.LOGIN_ID
				 LEFT JOIN POJ_T_USER_BANK ON POJ_T_USER.USER_BANK_ID = POJ_T_USER_BANK.BANK_ID
				 LEFT JOIN CIS_T_BANK ON POJ_T_USER_BANK.BANK_CIS_ID = CIS_T_BANK.BANK_ID
				 LEFT JOIN CIS_T_STATE ON POJ_T_USER_ADRESS.ADRESS_STATE = CIS_T_STATE.STATE_ID
			    WHERE (POJ_T_USER.USER_ID > 1) 
				  AND (LOGIN_PERMISSON < 5) AND '.$this->session->userdata['employeeDefaultWhere'].'
			 ORDER BY '.$orderBy.' '.$orientation.'
				LIMIT '. $limit .' 
			   OFFSET '. $offset
				;
	   
		$query = $this->db->query($sql);
		 
		 if($query->num_rows()>0){
			 foreach($query->result() as $row) {
				 $data[] = $row;
			 }
			 return $data;
		 } else {
			 return false;	
		 }
   }
   
   public function getCountUsers(){
	   $sql = 'SELECT COUNT(POJ_T_USER.USER_ID) V_COUNT
				 FROM POJ_T_USER
				 LEFT JOIN POJ_T_USER_ADRESS ON POJ_T_USER.USER_ADRESS_ID = POJ_T_USER_ADRESS.ADRESS_ID
				 LEFT JOIN POJ_T_USER_HIRE ON POJ_T_USER.USER_HIRE_ID = POJ_T_USER_HIRE.HIRE_ID
				 LEFT JOIN POJ_T_USER_LOGIN ON POJ_T_USER.USER_LOGIN_ID = POJ_T_USER_LOGIN.LOGIN_ID
				 LEFT JOIN POJ_T_USER_BANK ON POJ_T_USER.USER_BANK_ID = POJ_T_USER_BANK.BANK_ID
				 LEFT JOIN CIS_T_BANK ON POJ_T_USER_BANK.BANK_CIS_ID = CIS_T_BANK.BANK_ID
				 LEFT JOIN CIS_T_STATE ON POJ_T_USER_ADRESS.ADRESS_STATE = CIS_T_STATE.STATE_ID
				WHERE (POJ_T_USER.USER_ID > 1) 
				  AND (LOGIN_PERMISSON < 5)AND '.$this->session->userdata['employeeDefaultWhere'].'
	   ';
	   $query = $this->db->query($sql);
	   return $query->row()->V_COUNT;
   }
   
   public function getUserName($user_id){
	   $sql = 'SELECT USER_FNAME, USER_LNAME
				 FROM POJ_T_USER
				WHERE USER_ID = '.$user_id;
		$query = $this->db->query($sql);
		$query = $query->row();
		return ($query->USER_FNAME.' '.$query->USER_LNAME);
   }
   
   public function getUserDetailInfo($user_id){
		$sql = 'SELECT * 
				 FROM POJ_T_USER
				 LEFT JOIN POJ_T_USER_ADRESS ON POJ_T_USER.USER_ADRESS_ID = POJ_T_USER_ADRESS.ADRESS_ID
				 LEFT JOIN POJ_T_USER_HIRE ON POJ_T_USER.USER_HIRE_ID = POJ_T_USER_HIRE.HIRE_ID
				 LEFT JOIN POJ_T_USER_LOGIN ON POJ_T_USER.USER_LOGIN_ID = POJ_T_USER_LOGIN.LOGIN_ID
				 LEFT JOIN POJ_T_USER_BANK ON POJ_T_USER.USER_BANK_ID = POJ_T_USER_BANK.BANK_ID
				 LEFT JOIN CIS_T_BANK ON POJ_T_USER_BANK.BANK_CIS_ID = CIS_T_BANK.BANK_ID
				 LEFT JOIN CIS_T_STATE ON POJ_T_USER_ADRESS.ADRESS_STATE = CIS_T_STATE.STATE_ID
			    WHERE POJ_T_USER.USER_ID = '.$user_id;
		$query = $this->db->query($sql);
		return $query->row();
   }
   
   public function stronoEmployee($user_id){
		$sql = 'UPDATE POJ_T_USER SET 	USER_MODIFY_DATE="'.date('Y-m-d',strtotime("now")).'", 
										USER_MODIFY_USER_ID='.$this->session->userdata('id').', 
										USER_PLATNA="S", 
										USER_ACCEPT_PDF="A",
										USER_ACCEPT_DATE="'.date('Y-m-d',strtotime("now")).'",
										USER_ACCEPT_USER_ID='.$this->session->userdata('id').'
								  WHERE USER_ID='.$user_id;
		$this->db->query($sql);
	}
	
	public function fireEmployee($user_id){
		$sql = 'UPDATE POJ_T_USER SET 	USER_MODIFY_DATE="'.date('Y-m-d',strtotime("now")).'", 
										USER_MODIFY_USER_ID='.$this->session->userdata('id').', 
										USER_PLATNA="N", 
										USER_ACCEPT_PDF="A",
										USER_ACCEPT_DATE="'.date('Y-m-d',strtotime("now")).'",
										USER_ACCEPT_USER_ID='.$this->session->userdata('id').'
								  WHERE USER_ID='.$user_id;
		$this->db->query($sql);
	}
   
   public function getUserIdByPIN($user_pin){	   
	   if (strlen($user_pin)==10){		    
		$user_pin_formated = substr($user_pin, 0, 6).'/'.substr($user_pin, 6, 4);   
	   } else {		   
		$user_pin_formated =$user_pin;
	   }
	  
	   $sql = 'SELECT USER_ID
			     FROM POJ_T_USER
			    WHERE USER_PIN = "'.$user_pin_formated.'"';
		$query = $this->db->query($sql);
		$query = $query->row();
		return $query->USER_ID;
   }
   
   public function getUserInfoByPIN($user_pin){
	   $user_pin_formated = substr($user_pin, 0, 6).'/'.substr($user_pin, 6, 4);
	   $sql = 'SELECT USER_TITLE, USER_FNAME, USER_LNAME FROM POJ_T_USER
				 LEFT JOIN POJ_T_USER_LOGIN ON POJ_T_USER.USER_LOGIN_ID = POJ_T_USER_LOGIN.LOGIN_ID
				 WHERE LOGIN_PERMISSON = 5 AND 
						USER_PIN = "'.$user_pin_formated.'"';
		$query = $this->db->query($sql);

		if($query->num_rows()>0){
			$query = $query->row();
			return ($query->USER_TITLE.' '.$query->USER_FNAME.' '.$query->USER_LNAME);
		} else {
			return false;
		}						 
   }
   
   public function getUserAdressByPIN($user_pin){
		$user_pin_formated = substr($user_pin, 0, 6).'/'.substr($user_pin, 6, 4);
		$sql = 'SELECT *
				FROM POJ_T_USER
				LEFT JOIN POJ_T_USER_ADRESS ON USER_ADRESS_ID=ADRESS_ID
				WHERE USER_PIN = "'.$user_pin_formated.'"';
		$query = $this->db->query($sql);
		$query = $query->row();
		return ($query->ADRESS_STREET.' '.$query->ADRESS_NUMBER.', '.$query->ADRESS_CITY);
   }
   
   public function getUserBankByPIN($user_pin){
		$user_pin_formated = substr($user_pin, 0, 6).'/'.substr($user_pin, 6, 4);
		$sql = 'SELECT *
				FROM POJ_T_USER
				LEFT JOIN POJ_T_USER_BANK ON POJ_T_USER.USER_BANK_ID=POJ_T_USER_BANK.BANK_ID
				LEFT JOIN CIS_T_BANK ON POJ_T_USER_BANK.BANK_CIS_ID=CIS_T_BANK.BANK_ID
				WHERE USER_PIN = "'.$user_pin_formated.'"';
		$query = $this->db->query($sql);
		$query = $query->row();
		return ($query->BANK_NUMBER.'/'.$query->BANK_CODE.' ('.$query->BANK_NAME.')');
   }
   
   public function getUserStateByPIN($user_pin){
		$user_pin_formated = substr($user_pin, 0, 6).'/'.substr($user_pin, 6, 4);
		$sql = 'SELECT *
				FROM POJ_T_USER
				LEFT JOIN POJ_T_USER_ADRESS ON USER_ADRESS_ID=ADRESS_ID
				LEFT JOIN CIS_T_STATE ON ADRESS_STATE=STATE_ID
				WHERE USER_PIN = "'.$user_pin_formated.'"';
		$query = $this->db->query($sql);
		$query = $query->row();
		return ('('.$query->STATE_SHORT.') '.$query->STATE_NAME);
   }
   
   public function findSpecificEmployee($string) {
	   if (strpos($this->input->post('findEmployeeText'),'%') == TRUE){
			$findConstantPrefix = null;
			$findConstantPostfix = null;
	   } else {
			$findConstantPrefix = null;
			$findConstantPostfix = null;
	   }
	   $sql = 'SELECT * 
				FROM POJ_T_USER
				LEFT JOIN POJ_T_USER_ADRESS ON POJ_T_USER.USER_ADRESS_ID = POJ_T_USER_ADRESS.ADRESS_ID
				LEFT JOIN POJ_T_USER_HIRE ON POJ_T_USER.USER_HIRE_ID = POJ_T_USER_HIRE.HIRE_ID
				LEFT JOIN POJ_T_USER_LOGIN ON POJ_T_USER.USER_LOGIN_ID = POJ_T_USER_LOGIN.LOGIN_ID
				LEFT JOIN POJ_T_USER_BANK ON POJ_T_USER.USER_BANK_ID = POJ_T_USER_BANK.BANK_ID
				LEFT JOIN CIS_T_BANK ON POJ_T_USER_BANK.BANK_CIS_ID = CIS_T_BANK.BANK_ID
				LEFT JOIN CIS_T_STATE ON POJ_T_USER_ADRESS.ADRESS_STATE = CIS_T_STATE.STATE_ID
				WHERE 	USER_TITLE LIKE "'.$findConstantPrefix.$string.$findConstantPostfix.'" OR 
						USER_FNAME LIKE "'.$findConstantPrefix.$string.$findConstantPostfix.'" OR
						USER_LNAME LIKE "'.$findConstantPrefix.$string.$findConstantPostfix.'" OR
						USER_PIN LIKE "'.$findConstantPrefix.$string.$findConstantPostfix.'" OR
						USER_MNUMBER LIKE "'.$findConstantPrefix.$string.$findConstantPostfix.'" OR
						USER_EMAIL LIKE "'.$findConstantPrefix.$string.$findConstantPostfix.'" OR
						ADRESS_STREET LIKE "'.$findConstantPrefix.$string.$findConstantPostfix.'" OR
						ADRESS_NUMBER LIKE "'.$findConstantPrefix.$string.$findConstantPostfix.'" OR
						ADRESS_CITY LIKE "'.$findConstantPrefix.$string.$findConstantPostfix.'" OR
						ADRESS_POST LIKE "'.$findConstantPrefix.$string.$findConstantPostfix.'" OR
						LOGIN_NAME LIKE "'.$findConstantPrefix.$string.$findConstantPostfix.'" OR
						BANK_NUMBER LIKE "'.$findConstantPrefix.$string.$findConstantPostfix.'" OR
						BANK_IBAN LIKE "'.$findConstantPrefix.$string.$findConstantPostfix.'" OR
						BANK_CODE LIKE "'.$findConstantPrefix.$string.$findConstantPostfix.'" OR
						BANK_NAME LIKE "'.$findConstantPrefix.$string.$findConstantPostfix.'" OR
						STATE_NAME LIKE "'.$findConstantPrefix.$string.$findConstantPostfix.'" OR
						STATE_SHORT LIKE "'.$findConstantPrefix.$string.$findConstantPostfix.'"
				LIMIT 25';
		$query = $this->db->query($sql);
		return $query;		
   }
   
   public function canIModifyUser($user_id) {
		$sql = 'SELECT HIRE_FROM
				 FROM POJ_T_USER 
			LEFT JOIN POJ_T_USER_HIRE ON POJ_T_USER.USER_HIRE_ID = POJ_T_USER_HIRE.HIRE_ID
				WHERE POJ_T_USER.USER_ID = 	'.$user_id;
		$query = $this->db->query($sql);
		$query =  $query->row();
		$date = strtotime("+7 day", strtotime($query->HIRE_FROM));
		if (date("Y-m-d",$date) >= date("Y-m-d")){
			return TRUE;
		} else {
			return FALSE;
		}
   }

   public function findUserPin($user_pin){
	$sql = 'SELECT *
			  FROM POJ_T_USER
			 WHERE POJ_T_USER.USER_PIN = "'.$user_pin.'"';	
	$query = $this->db->query($sql);
	if($query->num_rows()>0){
		return true;
	} else {
		return false;	
	}
   }
   
   public function insertNewUser(){
	   $new_user_id = null;
	   $new_user_login_id = null;
	   $new_user_adress_id = null;
	   $new_user_hire_id = null;
	   $new_user_bank_id = null;
	   $this->load->helper('validation_helper');
	   /* sekcia noveho uvitacieho emailu */
	   
	   $configuration = Array (
		'protocol' => 'smtp',
		'smtp_host' => 'smtp.webglobe.sk',
		'smtp_port' =>	2525,
		'smtp_user' => 'no-reply@mendelupojistovna.studenthosting.sk',
		'smtp_pass' => 'r18n8UmN',
		'mailtype' => 'html'
		);
		
			$this->load->library('email', $configuration);			
			$this->email->set_newline("\r\n");
			$this->email->from('no-reply@mendelupojistovna.studenthosting.sk', 'no reply');
			$this->email->to($this->input->post('newEmployeeEmail'));
			$this->email->subject('Registrace');
			$this->email->message('


<body style="font-family: Verdana; font-size: 13px;">
	<img src="'.base_url('images/logo.png').'" style="width:500px; margin-left:180px">
	<br>
	<br>
	<br>
	<div style="margin-left:280px">
		<div class="div_lane"></div>
		<p>Dobrý deň,</p>
		<p>vítajte v informačním systému Pojištovny Mendlovej Univerzity.</p>
		<p>Vaše přihlašovací údaje jsou:</p>
		<p style="margin-left:60px;">login: u'.(strtolower(removeDiacritics($this->input->post('newEmployeeLastName')))).'</p>
		<p style="margin-left:60px;">heslo: '.$this->input->post('newEmployeePassword').'</p>				
		<p>Teraz sa môžete prihlásiť na adrese:</p>
		<p style="color:#00B4D7;margin-left:60px;"><a href="http://mendelupojistovna.studenthosting.sk/main/redirectLogin"> Informačního systému</p>
		<p>S pozdravom, Váš tím Mendelu Pojištovny.</p>
		<div class="div_lane"></div>
	</div>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
</body>');
 
		if($this->email->send()) {
			$this->load->helper('validation_helper');

				$sql = 'INSERT INTO POJ_T_USER_LOGIN (LOGIN_NAME, LOGIN_PASSWORD, LOGIN_PERMISSON) 
						VALUES (
								"u'.(strtolower(removeDiacritics($this->input->post('newEmployeeLastName')))).'",
								"'.md5($this->input->post('newEmployeePassword')).'",
								"'.$this->input->post('newEmployeePosition').'"
								)';
				$query = $this->db->query($sql);				
				$sql = 'SELECT MAX(LOGIN_ID) LOGIN_ID FROM POJ_T_USER_LOGIN';
				$query = $this->db->query($sql);
				$query2 = $query->row();
				$new_user_login_id = $query2->LOGIN_ID;

				$sql = 'INSERT INTO POJ_T_USER_HIRE (HIRE_FROM, HIRE_TO)
						VALUES (
								"'.date("Y-m-d",strtotime($this->input->post('newEmployeeHireFrom'))).'",
								"'.date("Y-m-d",strtotime($this->input->post('newEmployeeHireTo'))).'"
								)';
				$query = $this->db->query($sql);				
				$sql = 'SELECT MAX(HIRE_ID) HIRE_ID FROM POJ_T_USER_HIRE';
				$query = $this->db->query($sql);
				$query = $query->row();
				$new_user_hire_id = $query->HIRE_ID;
	
				$sql = 'INSERT INTO POJ_T_USER_ADRESS (ADRESS_STREET, ADRESS_NUMBER, ADRESS_CITY, ADRESS_POST, ADRESS_STATE)
						VALUES (
								"'.$this->input->post('newEmployeeStreet').'",
								"'.$this->input->post('newEmployeeStreetNumber').'",
								"'.$this->input->post('newEmployeeCity').'",
								"'.$this->input->post('newEmployeePostCode').'",
								 '.$this->input->post('newEmployeeState').'
								)';
				$query = $this->db->query($sql);				
				$sql = 'SELECT MAX(ADRESS_ID) ADRESS_ID FROM POJ_T_USER_ADRESS';
				$query = $this->db->query($sql);
				$query = $query->row();
				$new_user_adress_id = $query->ADRESS_ID;
	
				$bank_id = null;
				$sql = 'SELECT MAX(BANK_ID) BANK_ID FROM CIS_T_BANK WHERE BANK_CODE = "'.$this->input->post('newEmployeeBankCode').'"';
				$query = $this->db->query($sql);
				$query = $query->row();
				$bank_id = $query->BANK_ID;
				$sql = 'INSERT INTO POJ_T_USER_BANK (BANK_NUMBER, BANK_CIS_ID, BANK_IBAN)
						VALUES (
								"'.$this->input->post('newEmployeeBankNumber').'",
								'.$bank_id.',
								"'.$this->input->post('newEmployeeIban').'"
								)';
				$query = $this->db->query($sql);				
				$sql = 'SELECT MAX(BANK_ID) BANK_ID FROM POJ_T_USER_BANK';
				$query = $this->db->query($sql);
				$query = $query->row();
				$new_user_bank_id = $query->BANK_ID;
		
				$sql = 'INSERT INTO POJ_T_USER (
							USER_LOGIN_ID, 
							USER_ADRESS_ID, 
							USER_HIRE_ID, 
							USER_BANK_ID,
							USER_TITLE, 
							USER_FNAME, 
							USER_LNAME, 
							USER_PIN, 
							USER_MNUMBER, 
							USER_EMAIL, 
							USER_CREATE_USER_ID,
							USER_CREATE_DATE,
							USER_ACCEPT_USER_ID,
							USER_ACCEPT_DATE,
							USER_ACCEPT_PDF,
							USER_PLATNA
						) VALUES (
							 '.$new_user_login_id.',
							 '.$new_user_adress_id.',
							 '.$new_user_hire_id.',
							 '.$new_user_bank_id.',
							"'.$this->input->post('newEmployeeTitle').'",
							"'.$this->input->post('newEmployeeFirstName').'",
							"'.$this->input->post('newEmployeeLastName').'",
							"'.$this->input->post('newEmployeePIN').'",
							 '.$this->input->post('newEmployeePhoneNumber').',
							"'.$this->input->post('newEmployeeEmail').'",
							 '.$this->session->userdata('id').',
							"'.date("d.m.Y",strtotime("now")).'",
							  NULL,
							  NULL,
							  "N",
							  "A"
						)';
				$query = $this->db->query($sql);				
				$sql = 'SELECT MAX(USER_ID) USER_ID FROM POJ_T_USER';
				$query = $this->db->query($sql);
				$query = $query->row();
				$new_user_id = $query->USER_ID;		
				return $new_user_id;
			} else {
				show_error($this->email->print_debugger());
		}
   }
   
   public function updateUser($user_id){
	$sql = 'SELECT USER_LOGIN_ID, USER_ADRESS_ID, USER_HIRE_ID, USER_BANK_ID FROM POJ_T_USER WHERE USER_ID='.$user_id;
	$user_ids = $this->db->query($sql);
	$user_ids = $user_ids->row();
	   
	$sql = 'UPDATE POJ_T_USER_ADRESS
			   SET ADRESS_STREET="'.$this->input->post('ADRESS_STREET').'",
				   ADRESS_NUMBER="'.$this->input->post('ADRESS_NUMBER').'",
				   ADRESS_CITY="'.$this->input->post('ADRESS_CITY').'",
				   ADRESS_POST="'.$this->input->post('ADRESS_POST').'",
				   ADRESS_STATE='.$this->input->post('ADRESS_STATE').'
			 WHERE ADRESS_ID='.$user_ids->USER_ADRESS_ID;
	$this->db->query($sql);
	
	$sql = 'UPDATE POJ_T_USER_BANK
			   SET BANK_NUMBER='.$this->input->post('BANK_NUMBER').',
			       BANK_CIS_ID='.$this->input->post('BANK_ID').',
				   BANK_IBAN="'.$this->input->post('BANK_IBAN').'"
			 WHERE BANK_ID='.$user_ids->USER_BANK_ID;
	$this->db->query($sql);
	
	$sql = 'UPDATE POJ_T_USER
			   SET USER_TITLE="'.$this->input->post('USER_TITLE').'",
				   USER_FNAME="'.$this->input->post('USER_FNAME').'",
				   USER_LNAME="'.$this->input->post('USER_LNAME').'",
				   USER_PIN="'.$this->input->post('USER_PIN').'",
				   USER_MNUMBER='.$this->input->post('USER_MNUMBER').',
				   USER_EMAIL="'.$this->input->post('USER_EMAIL').'",
				   USER_MODIFY_USER_ID='.$this->session->userdata['id'].',
				   USER_MODIFY_DATE="'.date("Y-m-d h:m:s",strtotime("now")).'"
		     WHERE USER_ID='.$user_id;
	$this->db->query($sql);	
   }
   
	public function acceptEmployeePDF($user_id){
		$sql = 'UPDATE POJ_T_USER SET USER_ACCEPT_PDF="A" WHERE USER_ID='.$user_id;
		$this->db->query($sql);
	}

}

















