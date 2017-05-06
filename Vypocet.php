<?php
Class Vypocet extends CI_Model {

	public function opravKody(){
		$sql = 'SELECT * FROM POJ_T_AGREEMENT_LIFE;';
		$query = $this->db->query($sql);
		$query = $query->result();
		
		foreach ($query as $q){
			$this->load->helper('agreement_helper');
			$formatted_user_id=getCorrectID($q->LIFE_USER_ID);
			$serial_number = 'ZLP'.$formatted_user_id.substr(date('Y-m-d',strtotime($q->LIFE_DATE_FROM)),0,4).substr(date('Y-m-d',strtotime($q->LIFE_DATE_FROM)),5,2).substr(date('Y-m-d',strtotime($q->LIFE_DATE_FROM)),8,2);
			$sql2 = 'UPDATE POJ_T_AGREEMENT_LIFE SET LIFE_CODE="'.$serial_number.'" WHERE LIFE_ID='.$q->LIFE_ID;
			echo $sql2.'<br>';
			$this->db->query($sql2);
		}
		
		$sql = 'SELECT * FROM POJ_T_AGREEMENT_TRAVEL;';
		$query = $this->db->query($sql);
		$query = $query->result();
		
		foreach ($query as $q){
			$this->load->helper('agreement_helper');
			$formatted_user_id=getCorrectID($q->TRAVEL_USER_ID);
			$serial_number = 'ZTP'.$formatted_user_id.substr(date('Y-m-d',strtotime($q->TRAVEL_DATE_FROM)),0,4).substr(date('Y-m-d',strtotime($q->TRAVEL_DATE_FROM)),5,2).substr(date('Y-m-d',strtotime($q->TRAVEL_DATE_FROM)),8,2);
			$sql2 = 'UPDATE POJ_T_AGREEMENT_TRAVEL SET TRAVEL_CODE="'.$serial_number.'" WHERE TRAVEL_ID='.$q->TRAVEL_ID;
			echo $sql2.'<br>';
			$this->db->query($sql2);
		}
	}	
	
	public function dorobLogin(){
		$this->load->helper('validation_helper');
		$sql = 'UPDATE POJ_T_USER_LOGIN SET LOGIN_NAME=NULL WHERE LOGIN_ID>1';
		$query = $this->db->query($sql);
		$sql = 'SELECT USER_ID, USER_EMAIL FROM POJ_T_USER WHERE USER_ID>1';
		$query = $this->db->query($sql);
		$users = $query->result();
		foreach ($users as $user){
			$newLogin = explode(".", $user->USER_EMAIL);
			$newLogin2 = 'u'.$newLogin['0'];
			$sql = 'SELECT * FROM POJ_T_USER_LOGIN WHERE LOGIN_NAME LIKE "'.$newLogin2.'%" AND LOGIN_ID <> '.$user->USER_ID.' ORDER BY LOGIN_NAME DESC';
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				/*$endNumber = intval(substr($loginDB->LOGIN_NAME,(strlen($loginDB->LOGIN_NAME)-1),1));
				$endNumber = $endNumber+1;*/
				$final_login = $newLogin2.(intval($query->num_rows())+1);
			 } else {
				$final_login = $newLogin2;
			 }
			$sql = 'UPDATE POJ_T_USER_LOGIN SET LOGIN_NAME="'.$final_login.'" WHERE LOGIN_ID='.$user->USER_ID;
			$this->db->query($sql);
		}
	}
	
	
	public function opravPIN(){
		$sql = 'SELECT USER_ID, USER_PIN FROM POJ_T_USER WHERE USER_ID>1';
		$query = $this->db->query($sql);
		$users = $query->result();
		foreach ($users as $user){
			$newPin = substr($user->USER_PIN,2,2).substr($user->USER_PIN,4,7).substr($user->USER_PIN,0,2);
			$sql = 'UPDATE POJ_T_USER SET USER_PIN="'.$newPin.'" WHERE USER_ID='.$user->USER_ID;
			$query = $this->db->query($sql);
		}
	}
	
	public function generujZmluvy(){
		$this->load->helper('agreement_helper');
		$sql = 'DELETE FROM POJ_T_AGREEMENT_LIFE';
		$this->db->query($sql);
		$sql = 'DELETE FROM POJ_T_AGREEMENT_TRAVEL';
		$this->db->query($sql);
		$sql = 'ALTER TABLE POJ_T_AGREEMENT_LIFE AUTO_INCREMENT = 1';
		$this->db->query($sql);
		$sql = 'ALTER TABLE POJ_T_AGREEMENT_TRAVEL AUTO_INCREMENT = 1';
		$this->db->query($sql);
		$sql = 'SELECT LOGIN_ID FROM POJ_T_USER_LOGIN WHERE LOGIN_PERMISSON=5';
		$query = $this->db->query($sql);
		$query = $query->result();
		foreach ($query as $q){
			$sql = 'SELECT * FROM POJ_T_USER WHERE USER_LOGIN_ID='.$q->LOGIN_ID;
			$user = $this->db->query($sql);
			$user = $user->row();
			
			$LIFE_USER_ID = $user->USER_ID;
			$LIFE_DOCTOR = "N";		
			$LIFE_PRICE = rand(150, 2500);
			$LIFE_CURRENCY = "Kč";
			$LIFE_DATE_FROM = date("Y-m-d",strtotime($user->USER_CREATE_DATE));
			$LIFE_DATE_TO = (intval(substr($LIFE_DATE_FROM,0,4))+rand(1,3)).substr($LIFE_DATE_FROM,4,6);
			$LIFE_FREQUENCY = 1;
			$LIFE_CREATE_USER = 2;
			$LIFE_PLATNA = "A";
			$LIFE_ACCEPT_PDF = "A";
			$LIFE_CODE = 'ZLP'.getCorrectID($user->USER_ID).substr(date('Y-m-d',strtotime($user->USER_CREATE_DATE)),0,4).substr(date('Y-m-d',strtotime($user->USER_CREATE_DATE)),5,2).substr(date('Y-m-d',strtotime($user->USER_CREATE_DATE)),8,2);
			
			$sql = 'INSERT INTO POJ_T_AGREEMENT_LIFE (
				LIFE_USER_ID,
				LIFE_DOCTOR,
				LIFE_PRICE,
				LIFE_CURRENCY,
				LIFE_DATE_FROM,
				LIFE_DATE_TO,
				LIFE_FREQUENCY,
				LIFE_CREATE_USER,
				LIFE_MODIFY_USER,
				LIFE_MODIFY_DATE,
				LIFE_PLATNA,
				LIFE_ACCEPT_PDF,
				LIFE_PARENT_ID,
				LIFE_CODE			
				) VALUES (
				'.$LIFE_USER_ID.',
				"'.$LIFE_DOCTOR.'",
				'.$LIFE_PRICE.',
				"'.$LIFE_CURRENCY.'",
				"'.$LIFE_DATE_FROM.'",
				"'.$LIFE_DATE_TO.'",
				'.$LIFE_FREQUENCY.',
				'.$LIFE_CREATE_USER.',
				NULL,
				NULL,
				"A",
				"A",
				NULL,
				"'.$LIFE_CODE.'"
				)';
				$this->db->query($sql);
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}