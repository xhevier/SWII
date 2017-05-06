<?php
	function IsEmpty($text){		
		if (strlen($text) == 0 ){
			return TRUE;
		}		
		else {
			return FALSE;
		}
	}
	
	function IsLowThenThree($text){		
		if (strlen($text) < 3 ){
			return TRUE;
		}		
		else {
			return FALSE;
		}
	}
	
	function ContainsNumbers($text){
		return preg_match('/\\d/', $text) > 0;
	}
	
	function IsPostCode($text){
		if (strlen($text) == 5) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	function IsDate($text){
		if (!$text) {
			return false;
		}
		try {
			new \DateTime($text);
			return true;
		} catch (\Exception $e) {
			return false;
		}
	}
	
	function IsPIN($text){
		if (strlen($text) == 11 ){
			return TRUE;
		}		
		else {
			return FALSE;
		}
	}
	
	function alreadyExistEmployeeByPIN($text){		
		$CI =& get_instance();	
		$CI->load->model('Users');
		return $CI->Users->findUserPin($text);
	}
	
	function removeDiacritics($text) {
		return preg_replace('/&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml|caron);/i','$1',htmlentities($text));
	}
	
	function getUserIdForAgreement($user_id){
		if (strlen($user_id)==1) {
			return '000'.$user_id;
		} else if (strlen($user_id)==2) {
			return '00'.$user_id;
		} else if (strlen($user_id)==3) {
			return '0'.$user_id;
		} else {
			return $user_id;
		}
	}
	
	function getClientNameById($client_id){
		$CI =& get_instance();	
		$CI->load->model('Clients');
		return $CI->Clients->getClientNameById($client_id);
	}
  
	function getLifePlatnost($agreement_id){
		$CI =& get_instance();	
		$CI->load->model('Agreements');
		return $CI->Agreements->getLifePlatnost($agreement_id);
	}
	
	function getAgreementLife($agreement_id){
		$CI =& get_instance();	
		$CI->load->model('Agreements');
		return $CI->Agreements->getUserAgreement($agreement_id);
	}

