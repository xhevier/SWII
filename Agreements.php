<?php
Class Agreements extends CI_Model {

	public function setNewLifeAgreement($user_id){
		$sql = 'INSERT INTO POJ_T_AGREEMENT_LIFE(LIFE_USER_ID, LIFE_DOCTOR, LIFE_PRICE, LIFE_CURRENCY, LIFE_DATE_FROM, LIFE_DATE_TO, LIFE_FREQUENCY, LIFE_CREATE_USER			
				) VALUES ('.$user_id.', 0, '.$this->input->post('newLifePrice').', "'.$this->input->post('newLifeCurrency').'", "'.date('Y-m-d',strtotime($this->input->post('newLifeDateFrom'))).'", "'.date('Y-m-d',strtotime($this->input->post('newLifeDateTo'))).'", '.$this->input->post('newLifeFrequency').', '.$this->session->userdata('id').'
				)';
		$this->db->query($sql);
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
  
  public function updateLifeAgreement($agreement_id){
    $sql = 'UPDATE POJ_T_AGREEMENT_LIFE 
            SET LIFE_PRICE = '.$this->input->post('editLifePrice').',
                LIFE_CURRENCY = "'.$this->input->post('editLifeCurrency').'",
                LIFE_FREQUENCY = '.$this->input->post('editLifeFrequency').'
            WHERE LIFE_ID = '.$agreement_id;
    $query = $this->db->query($sql);
  }
}