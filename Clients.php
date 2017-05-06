<?php
Class Clients extends CI_Model {

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
				  AND (LOGIN_PERMISSON = 5)AND '.$this->session->userdata['clientDefaultWhere'].'
	   ';
	   $query = $this->db->query($sql);
	   return $query->row()->V_COUNT;
   }
   
   public function fetchClients($limit, $offset, $orderBy, $orientation){
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
				  AND (LOGIN_PERMISSON = 5) AND ('.$this->session->userdata['clientDefaultWhere'].')
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
   
   public function findSpecificClient($string) {
	   if (strpos($this->input->post('findEmployeeClient'),'%') == TRUE){
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
   
   public function getClientNameById($client_id){
	   $sql = 'SELECT USER_TITLE, USER_FNAME, USER_LNAME
				 FROM POJ_T_USER
				WHERE USER_ID ='.$client_id;
		$query = $this->db->query($sql);
		$query = $query->row();
		if ($query->USER_TITLE=='' OR $query->USER_TITLE==NULL){
			return $query->USER_FNAME.' '.$query->USER_LNAME;
		} else {
			return $query->USER_TITLE.' '.$query->USER_FNAME.' '.$query->USER_LNAME;
		}
   }
   
	public function getAllAgreementsForClient($client_id){
		$sql = 'SELECT * 
				  FROM
					(SELECT "L" AS AGREEMENT_TYPE,
						   LIFE_CODE AS AGREEMENT_CODE,
						   LIFE_ID AS AGREEMENT_ID,
						   LIFE_USER_ID AS AGREEMENT_USER_ID,
						   LIFE_DATE_FROM AS AGREEMENT_DATE_FROM,
						   LIFE_PLATNA AS AGREEMENT_PLATNA
					  FROM POJ_T_AGREEMENT_LIFE
					 WHERE LIFE_USER_ID='.$client_id.'
					UNION
					SELECT "T" AS AGREEMENT_TYPE,
					       TRAVEL_CODE AS AGREEMENT_CODE,
						   TRAVEL_ID AS AGREEMENT_ID,
						   TRAVEL_USER_ID AS AGREEMENT_USER_ID,
						   TRAVEL_DATE_FROM AS AGREEMENT_DATE_FROM,
						   TRAVEL_PLATNA AS AGREEMENT_PLATNA
					  FROM POJ_T_AGREEMENT_TRAVEL
					 WHERE  TRAVEL_USER_ID='.$client_id.') AS DEFAULT_AGREEMENT
				 ORDER BY AGREEMENT_DATE_FROM DESC
				 LIMIT 7
				';
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public function getAllAgreementsForClientNoLimit($client_id){
		$sql = 'SELECT * 
				  FROM
					(SELECT "L" AS AGREEMENT_TYPE,
						   LIFE_CODE AS AGREEMENT_CODE,
						   LIFE_ID AS AGREEMENT_ID,
						   LIFE_USER_ID AS AGREEMENT_USER_ID,
						   LIFE_DATE_FROM AS AGREEMENT_DATE_FROM,
						   LIFE_PLATNA AS AGREEMENT_PLATNA
					  FROM POJ_T_AGREEMENT_LIFE
					 WHERE LIFE_USER_ID='.$client_id.'
					UNION
					SELECT "T" AS AGREEMENT_TYPE,
					       TRAVEL_CODE AS AGREEMENT_CODE,
						   TRAVEL_ID AS AGREEMENT_ID,
						   TRAVEL_USER_ID AS AGREEMENT_USER_ID,
						   TRAVEL_DATE_FROM AS AGREEMENT_DATE_FROM,
						   TRAVEL_PLATNA AS AGREEMENT_PLATNA
					  FROM POJ_T_AGREEMENT_TRAVEL
					 WHERE  TRAVEL_USER_ID='.$client_id.') AS DEFAULT_AGREEMENT
				 ORDER BY AGREEMENT_DATE_FROM DESC
				 LIMIT 48
				';
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public function stornoClient($user_id){
		$sql = 'UPDATE POJ_T_AGREEMENT_LIFE 
				SET 
				LIFE_MODIFY_USER='.$this->session->userdata('id').',
				LIFE_MODIFY_DATE="'.date("Y-m-d",strtotime("now")).'",
				LIFE_PLATNA="S",
				LIFE_ACCEPT_PDF="A"	
				WHERE LIFE_USER_ID='.$user_id.' AND LIFE_PLATNA="A"
				';
		$this->db->query($sql);
		
		$sql = 'UPDATE POJ_T_AGREEMENT_TRAVEL
				SET 
				TRAVEL_MODIFY_USER='.$this->session->userdata('id').',
				TRAVEL_MODIFY_DATE="'.date("Y-m-d",strtotime("now")).'",
				TRAVEL_PLATNA="S",
				TRAVEL_ACCEPT_PDF="A"
				WHERE TRAVEL_USER_ID='.$user_id.' AND TRAVEL_PLATNA="A"
				';
		$this->db->query($sql);
		
		$sql = 'UPDATE POJ_T_USER
				SET
				USER_MODIFY_USER_ID='.$this->session->userdata('id').',
				USER_ACCEPT_USER_ID='.$this->session->userdata('id').',
				USER_ACCEPT_DATE="'.date("Y-m-d h:m:s",strtotime("now")).'",
				USER_MODIFY_DATE="'.date("Y-m-d h:m:s",strtotime("now")).'",
				USER_PLATNA="S",
				USER_ACCEPT_PDF="A"	
				WHERE USER_ID='.$user_id.'
				';		
		$this->db->query($sql);
	}
	
	public function fireClient($user_id){
		$sql = 'UPDATE POJ_T_AGREEMENT_LIFE 
				SET 
				LIFE_MODIFY_USER='.$this->session->userdata('id').',
				LIFE_MODIFY_DATE="'.date("Y-m-d",strtotime("now")).'",
				LIFE_PLATNA="N",
				LIFE_ACCEPT_PDF="A"	
				WHERE LIFE_USER_ID='.$user_id.' AND LIFE_PLATNA="A"
				';
		$this->db->query($sql);
		
		$sql = 'UPDATE POJ_T_AGREEMENT_TRAVEL
				SET 
				TRAVEL_MODIFY_USER='.$this->session->userdata('id').',
				TRAVEL_MODIFY_DATE="'.date("Y-m-d",strtotime("now")).'",
				TRAVEL_PLATNA="N",
				TRAVEL_ACCEPT_PDF="A"
				WHERE TRAVEL_USER_ID='.$user_id.' AND TRAVEL_PLATNA="A"
				';
		$this->db->query($sql);
		
		$sql = 'UPDATE POJ_T_USER
				SET
				USER_MODIFY_USER_ID='.$this->session->userdata('id').',
				USER_ACCEPT_USER_ID='.$this->session->userdata('id').',
				USER_ACCEPT_DATE="'.date("Y-m-d h:m:s",strtotime("now")).'",
				USER_MODIFY_DATE="'.date("Y-m-d h:m:s",strtotime("now")).'",
				USER_PLATNA="N",
				USER_ACCEPT_PDF="A"	
				WHERE USER_ID='.$user_id.'
				';		
		$this->db->query($sql);
	}

}

















