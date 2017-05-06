<?php

	function getAgreemenetTravelPlatna($agreement_id){
		$CI =&get_instance();	
		$CI->load->model('Agreements');
		$agreement = $CI->Agreements->getUserAgreementTravel($agreement_id);
		return $agreement;
	}
	
	function getCountNewLifeAgreements($type){
		$CI =&get_instance();	
		$CI->load->model('AratorModel');
		$agreement = $CI->AratorModel->getCountNewLifeAgreements($type);
		return $agreement;
	}
	
	function getCorrectID($text){
		if (strlen($text)==1){
			return "00000".$text;
		} else if (strlen($text)==2){
			return "0000".$text;
		} else if (strlen($text)==3){
			return "000".$text;
		} else if (strlen($text)==4){
			return "00".$text;
		} else if (strlen($text)==5){
			return "0".$text;
		} else {
			return $text;
		}
	}
	
	function CIS_T_BANK(){
		$CI =&get_instance();	
		$CI->load->model('AratorModel');
		$agreement = $CI->AratorModel->CIS_T_BANK();
		return $agreement;
	}
	
	function CIS_T_STATE(){
		$CI =&get_instance();	
		$CI->load->model('AratorModel');
		$agreement = $CI->AratorModel->CIS_T_STATE();
		return $agreement;
	}
	
	function POJ_T_AGREEMENT_LIFE(){
		$CI =&get_instance();	
		$CI->load->model('AratorModel');
		$agreement = $CI->AratorModel->POJ_T_AGREEMENT_LIFE();
		return $agreement;
	}
	
	function POJ_T_AGREEMENT_TRAVEL(){
		$CI =&get_instance();	
		$CI->load->model('AratorModel');
		$agreement = $CI->AratorModel->POJ_T_AGREEMENT_TRAVEL();
		return $agreement;
	}
	
	function POJ_T_BILLS(){
		$CI =&get_instance();	
		$CI->load->model('AratorModel');
		$agreement = $CI->AratorModel->POJ_T_BILLS();
		return $agreement;
	}
	
	function POJ_T_USER(){
		$CI =&get_instance();	
		$CI->load->model('AratorModel');
		$agreement = $CI->AratorModel->POJ_T_USER();
		return $agreement;
	}
	function POJ_T_USER_ADRESS(){
		$CI =&get_instance();	
		$CI->load->model('AratorModel');
		$agreement = $CI->AratorModel->POJ_T_USER_ADRESS();
		return $agreement;
	}
	function POJ_T_USER_BANK(){
		$CI =&get_instance();	
		$CI->load->model('AratorModel');
		$agreement = $CI->AratorModel->POJ_T_USER_BANK();
		return $agreement;
	}
	function POJ_T_USER_HIRE(){
		$CI =&get_instance();	
		$CI->load->model('AratorModel');
		$agreement = $CI->AratorModel->POJ_T_USER_HIRE();
		return $agreement;
	}
	function POJ_T_USER_LOGIN(){
		$CI =&get_instance();	
		$CI->load->model('AratorModel');
		$agreement = $CI->AratorModel->POJ_T_USER_LOGIN();
		return $agreement;
	}

	function SET_T_GENERAL(){
		$CI =&get_instance();	
		$CI->load->model('AratorModel');
		$agreement = $CI->AratorModel->SET_T_GENERAL();
		return $agreement;
	}
	
	function getAllAgreementsForClient($client_id){
		$CI =&get_instance();	
		$CI->load->model('Clients');
		$agreement = $CI->Clients->getAllAgreementsForClient($client_id);
		return $agreement;
	}
	
	function getAllBillsForLife($agreement_id){
		$CI =&get_instance();	
		$CI->load->model('Agreements');
		$bills = $CI->Agreements->getAllBillsForLife($agreement_id);
		return $bills;
	}
	
	function getAllBillsForTravel($agreement_id){
		$CI =&get_instance();	
		$CI->load->model('Agreements');
		$bills = $CI->Agreements->getAllBillsForTravel($agreement_id);
		return $bills;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
?>