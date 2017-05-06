<?php
	function getUserName($user_id){		
		$CI =& get_instance();	
		$CI->load->model('Users');
		$userName = $CI->Users->getUserName($user_id);
		if ($userName == 'null null') {
			$userName = 'Admin';
		}
		return $userName;	
	}
	
	function getFunction($type) {
		$result = "";
		switch ($type) {
			case 0:
				$result = "Admin";
				break;
			case 1:
				$result = "Vedouci pobočky";
				break;
			case 2:
				$result = "Revízní zamměstnanec";
				break;
			case 3:
				$result = "Účetní";
				break;
			case 4:
				$result = "Klientský poradce";
				break;
			case 5:
				$result = "Klient";
				break;
		}
		return $result;	
	}
	
	function getMoneyPay($type) {
		$result = 0;
		switch ($type) {
			case 0:
				$result = 50000;
				break;
			case 1:
				$result = 40000;
				break;
			case 2:
				$result = 30000;
				break;
			case 3:
				$result = 20000;
				break;
			case 4:
				$result = 10000;
				break;
			case 5:
				$result = 0;
				break;
		}
		return $result;
	}

	function getAllBanksToArray(){
		$CI =&get_instance();	
		$CI->load->model('Settings');
		$banks = $CI->Settings->getAllBanks();
		$optionBank = Array();
		foreach ($banks as $bank) {
		$optionBank[$bank->BANK_ID] = '( '.$bank->BANK_CODE.' ) '.$bank->BANK_NAME;
		}
		return $optionBank;
	}
	
	function removeDiacritics($text) {
		return preg_replace('/&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml|caron);/i','$1',htmlentities($text));
	}
	
	function getDestinationName($type){
		switch ($type) {
			case 1:
				$result = 'Česká republika';
				break;
			case 2:
				$result = 'Slovenská republika';
				break;
			case 3:
				$result = 'Poľsko';
				break;
			case 4:
				$result = 'Nemecko';
				break;
			case 5:
				$result = 'Rakúsko';
				break;
			case 6:
				$result = 'Ostatní krajiny Európy';
				break;
			case 7:
				$result = 'Ázia';
				break;
			case 8:
				$result = 'Afrika';
				break;
			case 9:
				$result = 'Austrália';
				break;
			case 10:
				$result = 'Severná Amerika';
				break;
			case 11:
				$result = 'Južná Amerika';
				break;
		}
		return $result;
	}
	
	function getPayType($type){
		switch ($type) {
			case 1:
				$result = 'Převodem na účet';
				break;
			case 2:
				$result = 'Hotově na pokladně';
				break;
			case 3:
				$result = 'Kartou online';
				break;
			case 4:
				$result = 'Kartou na pokladně';
				break;
			case 5:
				$result = 'Poštovní poukázkou';
				break;
			case 6:
				$result = 'SIPO';
				break;
		}
		return $result;
	}
	
	function getLifeFrequency($type){
		switch ($type) {
			case 1:
				$result = 'Měsíčně';
				break;
			case 2:
				$result = 'Čtvrtletně';
				break;
			case 3:
				$result = 'Pololetně';
				break;
			case 4:
				$result = 'Ročně';
				break;
		}
		return $result;
	}
	
	function getAgreementCode($agreement_type, $agreement_id){
		$CI =&get_instance();	
		$CI->load->model('Agreements');
		if ($agreement_type == 'L') {
			$agreement = $CI->Agreements->getUserAgreementLife($agreement_id);
			$agreement_code = '<b>ZLP</b>'.$agreement->LIFE_USER_ID.substr($agreement->LIFE_DATE_FROM,0,4).substr($agreement->LIFE_DATE_FROM,5,2).substr($agreement->LIFE_DATE_FROM,8,2);
		} else {
			$agreement = $CI->Agreements->getUserAgreementTravel($agreement_id);
			$agreement_code = '<b>ZCP</b>'.$agreement->TRAVEL_USER_ID.substr($agreement->TRAVEL_DATE_FROM,0,4).substr($agreement->TRAVEL_DATE_FROM,5,2).substr($agreement->TRAVEL_DATE_FROM,8,2);
		}
		return $agreement_code;		
	}
	
	function getTravelFromTo($agreement_id){
		$CI =&get_instance();	
		$CI->load->model('Agreements');
		$agreement = $CI->Agreements->getTravelFromTo($agreement_id);
		return $agreement;
	}
	
	function getLifeAgreement($agreement_id){
		$CI =&get_instance();	
		$CI->load->model('Agreements');
		$agreement = $CI->Agreements->getUserAgreementLife($agreement_id);
		return $agreement;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
?>