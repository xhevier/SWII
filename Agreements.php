<?php
Class Agreements extends CI_Model {		
		 
  public function getAllTypesAgreements($limit, $offset, $orderBy, $orientation){
		if ($offset==''){
			$offset=0;
		} 
		switch ($orderBy){
			case 1: $orderBy = 'AGREEMENT_CODE'; break;
			case 2: $orderBy = 'AGREEMENT_TYPE'; break;
			case 3: $orderBy = 'AGREEMENTS_USER_NAME'; break;
			case 4: $orderBy = 'AGREEMENT_CREATE_USER'; break;
			case 5: $orderBy = 'AGREEMENT_PRICE'; break;
			case 6: $orderBy = 'AGREEMENT_DATE_FROM'; break;
			case 7: $orderBy = 'AGREEMENT_DATE_TO'; break;
			case 8: $orderBy = 'AGREEMENT_PLATNA'; break;
		}
		
		switch ($orientation){
			case 1: $orientation = 'ASC'; break;
			case 2: $orientation = 'DESC'; break;
		}
		
		
	  $sql = 'SELECT * FROM 
							(SELECT LIFE_ID AS AGREEMENT_ID,
								   LIFE_DATE_FROM AS AGREEMENT_DATE_FROM,
								   LIFE_DATE_TO AS AGREEMENT_DATE_TO,
								   LIFE_PLATNA AS AGREEMENT_PLATNA,
								   LIFE_USER_ID AS AGREEMENT_USER_ID,
								   LIFE_CREATE_USER AS AGREEMENT_CREATE_USER,
								   LIFE_CURRENCY AS AGREEMENT_CURRENCY,
								   LIFE_PRICE AS AGREEMENT_PRICE,
								   "L" AS AGREEMENT_TYPE,
								   USER_LNAME AS AGREEMENT_USER_NAME,
								   LIFE_CODE AS AGREEMENT_CODE
							FROM POJ_T_AGREEMENT_LIFE
							LEFT JOIN POJ_T_USER ON POJ_T_USER.USER_ID = POJ_T_AGREEMENT_LIFE.LIFE_USER_ID
							UNION
							SELECT TRAVEL_ID AS AGREEMENT_ID,
								   TRAVEL_DATE_FROM AS AGREEMENT_DATE_FROM,
								   TRAVEL_DATE_TO AS AGREEMENT_DATE_TO,
								   TRAVEL_PLATNA AS AGREEMENT_PLATNA,
								   TRAVEL_USER_ID AS AGREEMENT_USER_ID,
								   TRAVEL_CREATE_USER AS AGREEMENT_CREATE_USER,
								   TRAVEL_CURRENCY AS AGREEMENTS_CURRENCY,
								   TRAVEL_PRICE AS AGREEMENT_PRICE,
								   "T" AS AGREEMENT_TYPE,
								   USER_LNAME AS AGREEMENT_USER_NAME,
								   TRAVEL_CODE AS AGREEMENT_CODE
							FROM POJ_T_AGREEMENT_TRAVEL
							LEFT JOIN POJ_T_USER ON POJ_T_USER.USER_ID = POJ_T_AGREEMENT_TRAVEL.TRAVEL_USER_ID
							) AS a
				WHERE (1=1) AND '.$this->session->userdata['agreementDefaultWhere'].'
			    ORDER BY a.'.$orderBy.' '.$orientation.'
				LIMIT '. $limit .' 
			   OFFSET '. $offset;
	 $query = $this->db->query($sql);
	 return $query->result();
  }
  
  public function getCountAllAgreements(){
	   $sql = 'SELECT COUNT(*) V_COUNT FROM 
							(SELECT LIFE_ID AS AGREEMENT_ID,
								   LIFE_DATE_FROM AS AGREEMENT_DATE_FROM,
								   LIFE_DATE_TO AS AGREEMENT_DATE_TO,
								   LIFE_PLATNA AS AGREEMENT_PLATNA,
								   LIFE_USER_ID AS AGREEMENT_USER_ID,
								   LIFE_CREATE_USER AS AGREEMENT_CREATE_USER,
								   LIFE_CURRENCY AS AGREEMENT_CURRENCY,
								   LIFE_PRICE AS AGREEMENT_PRICE,
								   "L" AS AGREEMENT_TYPE,
								   USER_LNAME AS AGREEMENT_USER_NAME,
								   LIFE_CODE AS AGREEMENT_CODE
							FROM POJ_T_AGREEMENT_LIFE
							LEFT JOIN POJ_T_USER ON POJ_T_USER.USER_ID = POJ_T_AGREEMENT_LIFE.LIFE_USER_ID
							UNION
							SELECT TRAVEL_ID AS AGREEMENT_ID,
								   TRAVEL_DATE_FROM AS AGREEMENT_DATE_FROM,
								   TRAVEL_DATE_TO AS AGREEMENT_DATE_TO,
								   TRAVEL_PLATNA AS AGREEMENT_PLATNA,
								   TRAVEL_USER_ID AS AGREEMENT_USER_ID,
								   TRAVEL_CREATE_USER AS AGREEMENT_CREATE_USER,
								   TRAVEL_CURRENCY AS AGREEMENTS_CURRENCY,
								   TRAVEL_PRICE AS AGREEMENT_PRICE,
								   "T" AS AGREEMENT_TYPE,
								   USER_LNAME AS AGREEMENT_USER_NAME,
								   TRAVEL_CODE AS AGREEMENT_CODE
							FROM POJ_T_AGREEMENT_TRAVEL
							LEFT JOIN POJ_T_USER ON POJ_T_USER.USER_ID = POJ_T_AGREEMENT_TRAVEL.TRAVEL_USER_ID
							) AS a
				WHERE (1=1) AND '.$this->session->userdata['agreementDefaultWhere'].'
			    ORDER BY a.AGREEMENT_DATE_FROM DESC';
	   $query = $this->db->query($sql);
	   return $query->row()->V_COUNT;
   }
   
   public function findSpecificAgreement($text){
	   $sql = 'SELECT * 
				 FROM (SELECT LIFE_ID AS AGREEMENT_ID,
								   LIFE_DATE_FROM AS AGREEMENT_DATE_FROM,
								   LIFE_DATE_TO AS AGREEMENT_DATE_TO,
								   LIFE_PLATNA AS AGREEMENT_PLATNA,
								   LIFE_USER_ID AS AGREEMENT_USER_ID,
								   LIFE_CREATE_USER AS AGREEMENT_CREATE_USER,
								   LIFE_CURRENCY AS AGREEMENT_CURRENCY,
								   LIFE_PRICE AS AGREEMENT_PRICE,
								   "L" AS AGREEMENT_TYPE,
								   USER_LNAME AS AGREEMENT_USER_NAME,
								   LIFE_CODE AS AGREEMENT_CODE
							FROM POJ_T_AGREEMENT_LIFE
							LEFT JOIN POJ_T_USER ON POJ_T_USER.USER_ID = POJ_T_AGREEMENT_LIFE.LIFE_USER_ID
							UNION
							SELECT TRAVEL_ID AS AGREEMENT_ID,
								   TRAVEL_DATE_FROM AS AGREEMENT_DATE_FROM,
								   TRAVEL_DATE_TO AS AGREEMENT_DATE_TO,
								   TRAVEL_PLATNA AS AGREEMENT_PLATNA,
								   TRAVEL_USER_ID AS AGREEMENT_USER_ID,
								   TRAVEL_CREATE_USER AS AGREEMENT_CREATE_USER,
								   TRAVEL_CURRENCY AS AGREEMENTS_CURRENCY,
								   TRAVEL_PRICE AS AGREEMENT_PRICE,
								   "T" AS AGREEMENT_TYPE,
								   USER_LNAME AS AGREEMENT_USER_NAME,
								   TRAVEL_CODE AS AGREEMENT_CODE
							FROM POJ_T_AGREEMENT_TRAVEL
							LEFT JOIN POJ_T_USER ON POJ_T_USER.USER_ID = POJ_T_AGREEMENT_TRAVEL.TRAVEL_USER_ID
							) AS a
				WHERE a.AGREEMENT_DATE_FROM LIKE "'.$text.'" OR
					  a.AGREEMENT_DATE_TO LIKE "'.$text.'" OR
					  a.AGREEMENT_PLATNA LIKE "'.$text.'" OR
					  a.AGREEMENT_USER_ID LIKE "'.$text.'" OR
					  a.AGREEMENT_CURRENCY LIKE "'.$text.'" OR
					  a.AGREEMENT_PRICE LIKE "'.$text.'" OR
					  a.AGREEMENT_TYPE LIKE "'.$text.'" OR
					  a.AGREEMENT_USER_NAME LIKE "'.$text.'" OR		
					  a.AGREEMENT_CODE LIKE "'.$text.'"
					  ';
		$query = $this->db->query($sql);
		return $query;
   }
 /* Zivotne positenie */
 
	public function updateLifeAgreement($agreement_id){		
		$sql = 'UPDATE POJ_T_AGREEMENT_LIFE 
				SET LIFE_PRICE = '.$this->input->post('editLifePrice').',
					LIFE_CURRENCY = "'.$this->input->post('editLifeCurrency').'",
					LIFE_FREQUENCY = '.$this->input->post('editLifeFrequency').'
				WHERE LIFE_ID = '.$agreement_id;
		$query = $this->db->query($sql);
	}
	
	public function setNewLifeAgreement($user_id){
		$this->load->helper('agreement_helper');
		$formatted_user_id=getCorrectID($user_id);
		$serial_number = 'ZLP'.$formatted_user_id.substr(date('Y-m-d',strtotime($this->input->post('newLifeDateFrom'))),0,4).substr(date('Y-m-d',strtotime($this->input->post('newLifeDateFrom'))),5,2).substr(date('Y-m-d',strtotime($this->input->post('newLifeDateFrom'))),8,2);
		$sql = 'INSERT INTO POJ_T_AGREEMENT_LIFE(LIFE_USER_ID, LIFE_DOCTOR, LIFE_PRICE, LIFE_CURRENCY, LIFE_DATE_FROM, LIFE_DATE_TO, LIFE_FREQUENCY, LIFE_CREATE_USER, LIFE_PLATNA, LIFE_ACCEPT_PDF, LIFE_MODIFY_USER, LIFE_MODIFY_DATE, LIFE_CODE
				) VALUES ('.$user_id.', 0, '.$this->input->post('newLifePrice').', "'.$this->input->post('newLifeCurrency').'", "'.date('Y-m-d',strtotime($this->input->post('newLifeDateFrom'))).'", "'.date('Y-m-d',strtotime($this->input->post('newLifeDateTo'))).'", '.$this->input->post('newLifeFrequency').', '.$this->session->userdata('id').',"A","N", NULL, NULL,"'.$serial_number.'"
				)';
		$this->db->query($sql);
		$sql = 'SELECT MAX(LIFE_ID) AS LIFE_ID FROM POJ_T_AGREEMENT_LIFE';
		$query = $this->db->query($sql);
		$query = $query->row();
		return $query->LIFE_ID;
	}
	
	public function canICreateLifeAgreement($user_id, $start_date, $end_date){
		$sql = 'SELECT LIFE_ID, LIFE_DATE_FROM, LIFE_DATE_TO 
				  FROM POJ_T_AGREEMENT_LIFE
				 WHERE (LIFE_USER_ID = '.$user_id.' )AND 
				     (("'.$start_date.'" <= LIFE_DATE_FROM AND "'.$end_date.'" >= LIFE_DATE_FROM )
				   OR ("'.$start_date.'" >= LIFE_DATE_FROM AND "'.$end_date.'" <= LIFE_DATE_TO)
				   OR ("'.$start_date.'" <= LIFE_DATE_TO   AND "'.$end_date.'" >= LIFE_DATE_TO)
				   OR ("'.$start_date.'" <= LIFE_DATE_FROM AND "'.$end_date.'" >= LIFE_DATE_TO))
				  LIMIT 1';
		$query = $this->db->query($sql);

		if($query->num_rows()>0) {
			$query = $query->row();
			return "Již existuje platné životní pojištení s platnosťou od ".date('d.m.Y',strtotime($query->LIFE_DATE_FROM))." do ".date('d.m.Y',strtotime($query->LIFE_DATE_TO)).".";
		} else {
			return '';
		}
	}
	
	public function getAllUserAgreements($user_id){
		$sql = 'SELECT *
				  FROM POJ_T_AGREEMENT_LIFE
				 WHERE LIFE_USER_ID = '.$user_id.'
				 ORDER BY LIFE_DATE_FROM DESC';
		$query = $this->db->query($sql);
		
		if($query->num_rows()>0){
			return $query->result();
		} else {
			return FALSE;
		}
	}
	
	public function getUserAgreement($agreement_id) {
		$sql = 'SELECT *
				  FROM POJ_T_AGREEMENT_LIFE
				 WHERE LIFE_ID = '.$agreement_id;
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	
	
	public function getUserIdByAgreement($agreement_id){
		$sql = 'SELECT LIFE_CREATE_USER
				  FROM POJ_T_AGREEMENT_LIFE
				 WHERE LIFE_ID = '.$agreement_id;
		$query = $this->db->query($sql);
		return $query->row();
	}
	
/* Cestovne positenie */

	public function getUserAgreementTravel($agreement_id){
		$sql = 'SELECT *
				  FROM POJ_T_AGREEMENT_TRAVEL
				 WHERE TRAVEL_ID='.$agreement_id;
		$query = $this->db->query($sql);
		return $query->row();
	}

	public function canICreateNewAgreementTravel($user_id, $start_date, $end_date){
		$start_date = date('Y-m-d',strtotime($start_date));
		$end_date = date('Y-m-d',strtotime($end_date));
		$sql = 'SELECT TRAVEL_ID, TRAVEL_DATE_FROM, TRAVEL_DATE_TO 
				  FROM POJ_T_AGREEMENT_TRAVEL
				 WHERE (TRAVEL_USER_ID = '.$user_id.') AND (TRAVEL_PLATNA NOT IN ("Z","S"))AND
				     (("'.$start_date.'" <= TRAVEL_DATE_FROM AND "'.$end_date.'" >= TRAVEL_DATE_FROM )
				   OR ("'.$start_date.'" >= TRAVEL_DATE_FROM AND "'.$end_date.'" <= TRAVEL_DATE_TO)
				   OR ("'.$start_date.'" <= TRAVEL_DATE_TO   AND "'.$end_date.'" >= TRAVEL_DATE_TO)
				   OR ("'.$start_date.'" <= TRAVEL_DATE_FROM AND "'.$end_date.'" >= TRAVEL_DATE_TO))
				  LIMIT 1';
		$query = $this->db->query($sql);

		if($query->num_rows()>0) {
			$query = $query->row();
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	public function canIEditAgreementTravel($user_id, $start_date, $end_date, $agreement_id){
		$start_date = date('Y-m-d',strtotime($start_date));
		$end_date = date('Y-m-d',strtotime($end_date));
		$sql = 'SELECT TRAVEL_ID, TRAVEL_DATE_FROM, TRAVEL_DATE_TO 
				  FROM POJ_T_AGREEMENT_TRAVEL
				 WHERE (TRAVEL_USER_ID = '.$user_id.' )AND(TRAVEL_PLATNA NOT IN("Z","S"))AND(TRAVEL_ID <>'.$agreement_id.')AND
				     (("'.$start_date.'" <= TRAVEL_DATE_FROM AND "'.$end_date.'" >= TRAVEL_DATE_FROM )
				   OR ("'.$start_date.'" >= TRAVEL_DATE_FROM AND "'.$end_date.'" <= TRAVEL_DATE_TO)
				   OR ("'.$start_date.'" <= TRAVEL_DATE_TO   AND "'.$end_date.'" >= TRAVEL_DATE_TO)
				   OR ("'.$start_date.'" <= TRAVEL_DATE_FROM AND "'.$end_date.'" >= TRAVEL_DATE_TO))
				  LIMIT 1';
		$query = $this->db->query($sql);

		if($query->num_rows()>0) {
			$query = $query->row();
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	public function setEditTravelAgreement($agreement_id){
		$sql = 'SELECT TRAVEL_USER_ID FROM POJ_T_AGREEMENT_TRAVEL WHERE TRAVEL_ID='.$agreement_id;
		$query = $this->db->query($sql);
		$query = $query->row();
		$user_id = $query->TRAVEL_USER_ID;
		
		$this->load->helper('agreement_helper');
		$formatted_user_id=getCorrectID($user_id);
		$serial_number = 'ZLP'.$formatted_user_id.substr(date('Y-m-d',strtotime($this->input->post('newTravelDateFrom'))),0,4).substr(date('Y-m-d',strtotime($this->input->post('newTravelDateFrom'))),5,2).substr(date('Y-m-d',strtotime($this->input->post('newTravelDateFrom'))),8,2);
		
		$sql = 'UPDATE POJ_T_AGREEMENT_TRAVEL
				   SET TRAVEL_DATE_FROM = "'.date('Y-m-d',strtotime($this->input->post('newTravelDateFrom'))).'",
				       TRAVEL_DATE_TO = "'.date('Y-m-d',strtotime($this->input->post('newTravelDateTo'))).'",
					   TRAVEL_PRICE = '.$this->input->post('newTravelPrice').',
					   TRAVEL_CURRENCY  = '.$this->input->post('newTravelCurrency').',
					   TRAVEL_DESTINATION  = '.$this->input->post('newTravelDestination').',
					   TRAVEL_PAY_TYPE  = '.$this->input->post('newTravelPayType').',
					   TRAVEL_CREATE_USER  = '.$this->session->userdata('id').',
					   TRAVEL_PLATNA = "A",
					   TRAVEL_CODE = "'.$serial_number.'"
				 WHERE TRAVEL_ID='.$agreement_id;
				$this->db->query($sql);
	}
	
	public function setNewTravelAgreement($user_id){
		$this->load->helper('agreement_helper');
		$formatted_user_id=getCorrectID($user_id);
		$serial_number = 'ZTP'.$formatted_user_id.substr(date('Y-m-d',strtotime($this->input->post('newTravelDateFrom'))),0,4).substr(date('Y-m-d',strtotime($this->input->post('newTravelDateFrom'))),5,2).substr(date('Y-m-d',strtotime($this->input->post('newTravelDateFrom'))),8,2);
		
		$sql = 'INSERT INTO POJ_T_AGREEMENT_TRAVEL (TRAVEL_USER_ID, TRAVEL_DATE_FROM, TRAVEL_DATE_TO, TRAVEL_PRICE, TRAVEL_CURRENCY, TRAVEL_DESTINATION, TRAVEL_PAY_TYPE, TRAVEL_PLATNA, TRAVEL_ACCEPT_PDF,TRAVEL_CREATE_USER, TRAVEL_CODE) 
				VALUES ( '.$user_id.',
						"'.date('Y-m-d',strtotime($this->input->post('newTravelDateFrom'))).'",
						"'.date('Y-m-d',strtotime($this->input->post('newTravelDateTo'))).'",
						 '.intval($this->input->post('newTravelPrice')).',
						 '.intval($this->input->post('newTravelCurrency')).',
						 '.intval($this->input->post('newTravelDestination')).',
						 '.intval($this->input->post('newTravelPayType')).',
						 "A",
						 "N",
						 '.$this->session->userdata('id').',
						 "'.$serial_number.'"
						 )';
		$this->db->query($sql);
		$sql = 'SELECT MAX(TRAVEL_ID) AS TRAVEL_ID FROM POJ_T_AGREEMENT_TRAVEL';
		$query = $this->db->query($sql);
		$query = $query->row();
		return $query->TRAVEL_ID;
	}
	
	public function acceptTravelAgreementPDF($agreement_id){
		$sql = 'UPDATE POJ_T_AGREEMENT_TRAVEL SET TRAVEL_ACCEPT_PDF="A" WHERE TRAVEL_ID='.$agreement_id;
		$this->db->query($sql);
	}
	
	public function acceptLifeAgreementPDF($agreement_id){
		$sql = 'UPDATE POJ_T_AGREEMENT_LIFE SET LIFE_ACCEPT_PDF="A" WHERE LIFE_ID='.$agreement_id;;
		$this->db->query($sql);
	}
	
	public function stornoTravelAgreement($agreement_id){
		$sql = 'UPDATE POJ_T_AGREEMENT_TRAVEL 	SET TRAVEL_MODIFY_USER='.$this->session->userdata('id').',
													TRAVEL_MODIFY_DATE="'.date("Y-m-d",strtotime("now")).'",
													TRAVEL_PLATNA="S",
													TRAVEL_ACCEPT_PDF="A"
												WHERE TRAVEL_ID='.$agreement_id;
		$this->db->query($sql);
	}
	
	public function fireTravelAgreement($agreement_id){
		$sql = 'UPDATE POJ_T_AGREEMENT_TRAVEL 	SET TRAVEL_MODIFY_USER='.$this->session->userdata('id').',
													TRAVEL_MODIFY_DATE="'.date("Y-m-d",strtotime("now")).'",
													TRAVEL_PLATNA="N",
													TRAVEL_ACCEPT_PDF="A"
												WHERE TRAVEL_ID='.$agreement_id;
		$this->db->query($sql);
	}
	
	public function stornoLifeAgreement($agreement_id){
		$sql = 'UPDATE POJ_T_AGREEMENT_LIFE 	SET LIFE_MODIFY_USER='.$this->session->userdata('id').',
													LIFE_MODIFY_DATE="'.date("Y-m-d",strtotime("now")).'",
													LIFE_PLATNA="S",
													LIFE_ACCEPT_PDF="A"
												WHERE LIFE_ID='.$agreement_id;
		$this->db->query($sql);
	}
	
	public function fireLifeAgreement($agreement_id){
		$sql = 'UPDATE POJ_T_AGREEMENT_LIFE 	SET LIFE_MODIFY_USER='.$this->session->userdata('id').',
													LIFE_MODIFY_DATE="'.date("Y-m-d",strtotime("now")).'",
													LIFE_PLATNA="N",
													LIFE_ACCEPT_PDF="A"
												WHERE LIFE_ID='.$agreement_id;
		$this->db->query($sql);
	}
	
	public function getUserAgreementLife($agreement_id){
		$sql = 'SELECT *
				  FROM POJ_T_AGREEMENT_LIFE
				 WHERE LIFE_ID = '.$agreement_id;
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	public function getTravelFromTo($agreement_id){
		$sql = 'SELECT *
				  FROM POJ_T_AGREEMENT_TRAVEL
				 WHERE TRAVEL_ID = '.$agreement_id;
		$query = $this->db->query($sql);
		$result = $query->row();
		$result = date('d.m.Y', strtotime($result->TRAVEL_DATE_FROM)).' - '.date('d.m.Y', strtotime($result->TRAVEL_DATE_TO));
		return $result;
	}
	
	public function getAllBillsForLife($agreement_id){
		$sql = 'SELECT *
				  FROM POJ_T_BILLS WHERE BILL_AGREEMENT_TYPE="L" AND BILL_AGREEMENT_ID='.$agreement_id.' ORDER BY BILL_DATE_CREATE DESC LIMIT 7';
		$query = $this->db->query($sql);
		$result = $query->row();
		return $query->result();
	}
	
	public function getAllBillsForTravel($agreement_id){
		$sql = 'SELECT *
				  FROM POJ_T_BILLS WHERE BILL_AGREEMENT_TYPE="T" AND BILL_AGREEMENT_ID='.$agreement_id.' ORDER BY BILL_DATE_CREATE DESC LIMIT 7';
		$query = $this->db->query($sql);
		$result = $query->row();
		return $query->result();
	}

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

}