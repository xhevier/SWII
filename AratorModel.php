<?php
Class AratorModel extends CI_Model {

	public function getAllAgreements(){
		$sql = 'SELECT * FROM (
				SELECT LIFE_ID AS AGREEMENT_ID,
					   "L" AS AGREEMENT_TYPE,
					   LIFE_DATE_FROM AS AGREEMENT_DATE_FROM,
					   LIFE_DATE_TO AS AGREEMENT_DATE_TO,
					   LIFE_PRICE AS AGREEMENT_PRICE,
					   LIFE_CURRENCY as AGREEMENT_CURRENCY
				  FROM POJ_T_AGREEMENT_LIFE WHERE LIFE_PLATNA="A"
				UNION		
				SELECT TRAVEL_ID AS AGREEMENT_ID,
					   "T" AS AGREEMENT_TYPE,
					   TRAVEL_DATE_FROM AS AGREEMENT_DATE_FROM,
					   TRAVEL_DATE_TO AS AGREEMENT_DATE_TO,
					   TRAVEL_PRICE AS AGREEMENT_PRICE,
					   TRAVEl_CURRENCY as AGREEMENT_CURRENCY
				  FROM POJ_T_AGREEMENT_TRAVEL WHERE TRAVEL_PLATNA="A"
				) AS x
				ORDER BY x.AGREEMENT_DATE_FROM';
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public function getCountNewLifeAgreements($type){
		$sql = 'SELECT * FROM (
				SELECT LIFE_ID AS AGREEMENT_ID,
					   "L" AS AGREEMENT_TYPE,
					   LIFE_DATE_FROM AS AGREEMENT_DATE_FROM,
					   LIFE_DATE_TO AS AGREEMENT_DATE_TO,
					   LIFE_PRICE AS AGREEMENT_PRICE,
					   LIFE_CURRENCY as AGREEMENT_CURRENCY
				  FROM POJ_T_AGREEMENT_LIFE WHERE LIFE_PLATNA="A"
				UNION		
				SELECT TRAVEL_ID AS AGREEMENT_ID,
					   "T" AS AGREEMENT_TYPE,
					   TRAVEL_DATE_FROM AS AGREEMENT_DATE_FROM,
					   TRAVEL_DATE_TO AS AGREEMENT_DATE_TO,
					   TRAVEL_PRICE AS AGREEMENT_PRICE,
					   TRAVEl_CURRENCY as AGREEMENT_CURRENCY
				  FROM POJ_T_AGREEMENT_TRAVEL WHERE TRAVEL_PLATNA="A"
				) AS x
				ORDER BY x.AGREEMENT_DATE_FROM';
		$query1 = $this->db->query($sql); 
		$query1 = $query1->result();
		$count_life = 0;
		$count_travel = 0;
		foreach ($query1 as $agreement){					
			if ($agreement->AGREEMENT_TYPE=='L'){
				if ((substr(date("Y-m-d",strtotime($agreement->AGREEMENT_DATE_FROM)),0,8))!=(substr(date("Y-m-d",strtotime("now")),0,8))) {
					$sql_life = 'SELECT * FROM POJ_T_BILLS WHERE BILL_AGREEMENT_TYPE="L" AND BILL_AGREEMENT_ID='.$agreement->AGREEMENT_ID;
					$query = $this->db->query($sql_life);
					if ($query->num_rows() == 0){
						$query2 = $query->row();				
						$count_life = $count_life+1;						
					}
				}
							
			} else if ($agreement->AGREEMENT_TYPE=='T'){
				$sql_travel = 'SELECT * FROM POJ_T_BILLS WHERE BILL_AGREEMENT_TYPE="T" AND BILL_AGREEMENT_ID='.$agreement->AGREEMENT_ID;
				$query = $this->db->query($sql_travel);
				if ($query->num_rows() == 0){
					$count_travel = $count_travel+1;
				}	
			}
		}
		if ($type==1){
			return $count_life;
		} else {
			return $count_travel;
		}
	}
	
	public function checkIfExistsLifeBill($agreement_id, $agreement_date){
		$sql = 'SELECT * FROM POJ_T_BILLS WHERE BILL_AGREEMENT_TYPE="L" AND BILL_AGREEMENT_ID='.$agreement_id;
		$query = $this->db->query($sql);
		$arator_date_cut = substr(date('Y-m-d',strtotime($agreement_date)),0,7);
		$stav = FALSE;
		
		if ($query->num_rows() == 0){
            return FALSE;
        } else {
			$query = $query->result();
			foreach ($query as $q){
				$agreement_date_cut = substr(date('Y-m-d',strtotime($q->BILL_DATE_CREATE)),0,7);
				if ($agreement_date_cut==$arator_date_cut){
					$stav = TRUE;	
				}
			}
			return $stav;
        }	
	}
	
	public function checkIfExistsTravelBill($agreement_id){
		$sql = 'SELECT * FROM POJ_T_BILLS WHERE BILL_AGREEMENT_TYPE="T" AND BILL_AGREEMENT_ID='.$agreement_id;
		$query = $this->db->query($sql);
		if ($query->num_rows() == 0){
            return FALSE;
        } else {
			return TRUE;
		}
	}
	
	public function setNewLifeBill($agreement_id,$date_create_final,$agreement_price,$agreement_currency,$serial_number,$sequence,$serial_number_agreement){
		$now = new DateTime(date("Y-m-d",strtotime("now")));
		$date = new DateTime(date("Y-m-d",strtotime($date_create_final))); 
		if ($date<$now){
			$pay_done = 'A';
		} else {
			$pay_done = 'N';
		}
		$sql = 'INSERT INTO POJ_T_BILLS (BILL_AGREEMENT_TYPE, BILL_AGREEMENT_ID, BILL_DATE_CREATE, BILL_PAY_DONE, BILL_PAY_PRICE, BILL_PAY_CURRENCY,BILL_CODE,BILL_SEQUENCE,BILL_AGREEMENT_CODE)
				VALUES ("L",'.$agreement_id.',"'.$date_create_final.'","'.$pay_done.'",'.$agreement_price.',"'.$agreement_currency.'","'.$serial_number.'",'.$sequence.',"'.$serial_number_agreement.'")';
		$this->db->query($sql);
	}
	
	public function setNewTravelBill($agreement_id,$date_create_final,$agreement_price,$agreement_currency,$serial_number,$sequence,$serial_number_agreement){
		$now = new DateTime(date("Y-m-d",strtotime("now")));
		$date = new DateTime(date("Y-m-d",strtotime($date_create_final))); 
		if ($date<$now){
			$pay_done = 'A';
		} else {
			$pay_done = 'N';
		}
		$sql = 'INSERT INTO POJ_T_BILLS (BILL_AGREEMENT_TYPE, BILL_AGREEMENT_ID, BILL_DATE_CREATE, BILL_PAY_DONE, BILL_PAY_PRICE, BILL_PAY_CURRENCY,BILL_CODE,BILL_SEQUENCE,BILL_AGREEMENT_CODE)
				VALUES ("T",'.$agreement_id.',"'.$date_create_final.'","'.$pay_done.'",'.$agreement_price.',"'.$agreement_currency.'","'.$serial_number.'",'.$sequence.',"'.$serial_number_agreement.'")';
		$this->db->query($sql);
	}
	
	public function CIS_T_BANK(){
		$sql = 'SELECT COUNT(*) AS V_POC FROM CIS_T_BANK';
		$query = $this->db->query($sql);
		$query = $query->row();
		return $query->V_POC;
	}
	
	public function CIS_T_STATE(){
		$sql = 'SELECT COUNT(*) AS V_POC FROM CIS_T_STATE';
		$query = $this->db->query($sql);
		$query = $query->row();
		return $query->V_POC;
	}
	
	public function POJ_T_AGREEMENT_LIFE(){
		$sql = 'SELECT COUNT(*) AS V_POC FROM POJ_T_AGREEMENT_LIFE';
		$query = $this->db->query($sql);
		$query = $query->row();
		return $query->V_POC;
	}
	
	public function POJ_T_AGREEMENT_TRAVEL(){
		$sql = 'SELECT COUNT(*) AS V_POC FROM POJ_T_AGREEMENT_TRAVEL';
		$query = $this->db->query($sql);
		$query = $query->row();
		return $query->V_POC;
	}
	
	public function POJ_T_BILLS(){
		$sql = 'SELECT COUNT(*) AS V_POC FROM POJ_T_BILLS';
		$query = $this->db->query($sql);
		$query = $query->row();
		return $query->V_POC;
	}
	
	public function POJ_T_USER(){
		$sql = 'SELECT COUNT(*) AS V_POC FROM POJ_T_USER';
		$query = $this->db->query($sql);
		$query = $query->row();
		return $query->V_POC;
	}
	public function POJ_T_USER_ADRESS(){
		$sql = 'SELECT COUNT(*) AS V_POC FROM POJ_T_USER_ADRESS';
		$query = $this->db->query($sql);
		$query = $query->row();
		return $query->V_POC;
	}
	public function POJ_T_USER_BANK(){
		$sql = 'SELECT COUNT(*) AS V_POC FROM POJ_T_USER_BANK';
		$query = $this->db->query($sql);
		$query = $query->row();
		return $query->V_POC;
	}
	public function POJ_T_USER_HIRE(){
		$sql = 'SELECT COUNT(*) AS V_POC FROM POJ_T_USER_HIRE';
		$query = $this->db->query($sql);
		$query = $query->row();
		return $query->V_POC;
	}
	public function POJ_T_USER_LOGIN(){
		$sql = 'SELECT COUNT(*) AS V_POC FROM POJ_T_USER_LOGIN';
		$query = $this->db->query($sql);
		$query = $query->row();
		return $query->V_POC;
	}
	public function SET_T_ARATOR(){
		$sql = 'SELECT COUNT(*) AS V_POC FROM SET_T_ARATOR';
		$query = $this->db->query($sql);
		$query = $query->row();
		return $query->V_POC;
	}
	public function SET_T_GENERAL(){
		$sql = 'SELECT COUNT(*) AS V_POC FROM SET_T_GENERAL';
		$query = $this->db->query($sql);
		$query = $query->row();
		return $query->V_POC;
	}
	
	public function getSerialNumberLife($agreement_id){
		$sql = 'SELECT * FROM POJ_T_AGREEMENT_LIFE WHERE LIFE_ID='.$agreement_id;
		$query = $this->db->query($sql);
		$query = $query->row();
		return $query->LIFE_CODE;
	}
	
	public function getSerialNumberTravel($agreement_id){
		$sql = 'SELECT * FROM POJ_T_AGREEMENT_TRAVEL WHERE TRAVEL_ID	='.$agreement_id;
		$query = $this->db->query($sql);
		$query = $query->row();
		return $query->TRAVEL_CODE;
	}

}
