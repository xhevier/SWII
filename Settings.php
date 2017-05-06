<?php
Class Settings extends CI_Model {

   public function getAllSettings(){
      $sql = 'SELECT *
                FROM SET_T_GENERAL
              ORDER BY GENERAL_ID DESC
              LIMIT 12';
      $query = $this->db->query($sql);
      return $query->result();
   } 
   
   public function getSettingsByTime($date){
      $sql = 'SELECT MIN(GENERAL_ID) AS GENERAL_ID
                FROM SET_T_GENERAL
               WHERE GENERAL_DATE >= "'.$date.'"';
      $setting_id = $this->db->query($sql);
      $setting_id2 = $setting_id->row();
      $sql2 = 'SELECT * FROM SET_T_GENERAL WHERE GENERAL_ID = 12';
      $setting = $this->db->query($sql2);
      return $setting->row();
   }
	
	public function getAllBanks(){
		$sql = 'SELECT * 
				  FROM CIS_T_BANK
				ORDER BY BANK_CODE ASC';
		$query = $this->db->query($sql);
		return $query->result();
	}
}