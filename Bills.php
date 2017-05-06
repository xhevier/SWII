<?php
Class Bills extends CI_Model {

	public function getCountAllBills(){
	   $sql = 'SELECT COUNT(BILL_ID) V_COUNT
				 FROM POJ_T_BILLS				
				WHERE (1=1) AND '.$this->session->userdata['billsDefaultWhere'];
	   $query = $this->db->query($sql);
	   return $query->row()->V_COUNT;
   }
   
   public function fetchBills($limit, $offset, $orderBy, $orientation){
		if ($offset==''){
			$offset=0;
		} 	
		switch ($orderBy){
			case 1: $orderBy = 'BILL_CODE'; break;
			case 2: $orderBy = 'BILL_SEQUENCE'; break;
			case 3: $orderBy = 'BILL_AGREEMENT_TYPE'; break;
			case 4: $orderBy = 'BILL_AGREEMENT_CODE'; break;
			case 5: $orderBy = 'BILL_DATE_CREATE'; break;
			case 6: $orderBy = 'BILL_PAY_PRICE'; break;
			case 7: $orderBy = 'BILL_PAY_DONE'; break;
		}
		
		switch ($orientation){
			case 1: $orientation = 'ASC'; break;
			case 2: $orientation = 'DESC'; break;
		}

		$sql = 'SELECT *
				 FROM POJ_T_BILLS				
				WHERE (1=1) AND '.$this->session->userdata['billsDefaultWhere'].'
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
   
   public function findSpecificBill($string) {
	   if (strpos($this->input->post('findBillText'),'%') == TRUE){
			$findConstantPrefix = null;
			$findConstantPostfix = null;
	   } else {
			$findConstantPrefix = null;
			$findConstantPostfix = null;
	   }
	   $sql = 'SELECT * 
				FROM POJ_T_BILLS
				WHERE 	BILL_CODE LIKE "'.$findConstantPrefix.$string.$findConstantPostfix.'" OR 
						BILL_SEQUENCE LIKE "'.$findConstantPrefix.$string.$findConstantPostfix.'" OR
						BILL_AGREEMENT_TYPE LIKE "'.$findConstantPrefix.$string.$findConstantPostfix.'" OR
						BILL_AGREEMENT_CODE LIKE "'.$findConstantPrefix.$string.$findConstantPostfix.'" OR
						BILL_DATE_CREATE LIKE "'.$findConstantPrefix.$string.$findConstantPostfix.'" OR
						BILL_PAY_DONE LIKE "'.$findConstantPrefix.$string.$findConstantPostfix.'" OR
						BILL_PAY_PRICE LIKE "'.$findConstantPrefix.$string.$findConstantPostfix.'" OR
						BILL_PAY_CURRENCY LIKE "'.$findConstantPrefix.$string.$findConstantPostfix.'"
				LIMIT 25';
		$query = $this->db->query($sql);
		return $query;		
   }
   
   public function getBill($bill_id){
	  $sql = 'SELECT * FROM POJ_T_BILLS WHERE BILL_ID='.$bill_id;  
	  $query = $this->db->query($sql);
	  return $query->row();
   }
   
   public function getAllUserBillsNoLimit($user_id){
	   $sql = '
			SELECT * FROM (
			(	SELECT BILL_ID, BILL_CODE 
				  FROM POJ_T_BILLS 
				  LEFT JOIN POJ_T_AGREEMENT_LIFE ON LIFE_ID=BILL_AGREEMENT_ID
				 WHERE BILL_AGREEMENT_TYPE="L" AND LIFE_USER_ID='.$user_id.')
				UNION
			(	SELECT BILL_ID, BILL_CODE 
				  FROM POJ_T_BILLS 
				  LEFT JOIN POJ_T_AGREEMENT_TRAVEL ON TRAVEL_ID=BILL_AGREEMENT_ID
				 WHERE BILL_AGREEMENT_TYPE="L" AND TRAVEL_USER_ID='.$user_id.')	   
			) AS A LIMIT 48';
	   $query = $this->db->query($sql);
	   return $query->result();
   }

}
