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
   
   public function getUserIdByPIN($user_pin){
	   $user_pin_formated = substr($user_pin, 0, 6).'/'.substr($user_pin, 6, 4);
	   $sql = 'SELECT USER_ID
			     FROM POJ_T_USER
			    WHERE USER_PIN = "'.$user_pin_formated.'"';
		$query = $this->db->query($sql);
		return $query->row()->USER_ID;
   }
   
   public function getUserInfoByPIN($user_pin){
	   $user_pin_formated = substr($user_pin, 0, 6).'/'.substr($user_pin, 6, 4);
	   $sql = 'SELECT USER_TITLE, USER_FNAME, USER_LNAME
				 FROM POJ_T_USER
				 WHERE USER_PIN = "'.$user_pin_formated.'"';
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


}

















