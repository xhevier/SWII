<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arator extends CI_Controller {
	
	public function redirectDefaultArator(){
		$this->load->view('admin/arator/arator_default');
	}
	
	public function generateArator(){
		$this->load->helper('header');
		$this->load->helper('menu');
		$this->load->helper('validation_helper');
		$this->load->helper('agreement_helper');
		$this->load->model('AratorModel');
		$agreements = $this->AratorModel->getAllAgreements();
		$count_created = 0;
		showHeader_arator();
		showMenuAdmin(); 
		echo '<script>$(document).ready(function(){$("#menuArator").css("background-color", "#00B4D7");$("#menuAratorW").css("color", "white");});	</script>';
		echo '<h1>Arator changelog</h1>';
		echo '<div style="margin-top:15px; margin-left:15px;">';
		echo '<div class="button-group" style="padding-top: 15px;">';
		echo '<a href="'.base_url('Arator/redirectDefaultArator').'" class="button">Späť</a>';
		echo '</div>';
		echo '<br><br>';
		echo '===================================================================================================================================================================<br><br>';
		echo '<p style="color:DarkGreen">POWERING UP BUILDER ../DEV/URANDOM.sql</p><br>';
		echo '===================================================================================================================================================================<br><br>';
		foreach ($agreements as $agreement){
			if ($agreement->AGREEMENT_TYPE=='L'){
				$agreement_end_date = new DateTime(date("Y-m-d",strtotime($agreement->AGREEMENT_DATE_TO)));
				$agreement_create_date = new DateTime(date("Y-m-d",strtotime($agreement->AGREEMENT_DATE_FROM)));
				
				$number_months = $agreement_create_date->diff($agreement_end_date)->m + ($agreement_create_date->diff($agreement_end_date)->y*12);			
				
				if ($number_months==0){
					$months_agreement = date("m",strtotime($agreement_create_date->format("Y-m-d"))); 
					$months_now = date("m",strtotime("now")); 
					if ($months_agreement=='12' AND ($months_agreement!=$months_now)){
						$number_months=1; 
					}else{
						if (intval($months_now) > intval($months_agreement)){
							$number_months=1; 
						}
					}
				}
						
					if (intval($number_months)!=0){
						$sequence_number = 0;
						for ($i = 1; $i <= $number_months; $i++) {
							$sequence_number=$sequence_number+1;
							$pom_month_string='+'.$i.' month'; 
							$pom_date = date("Y-m-d", strtotime($pom_month_string, strtotime($agreement->AGREEMENT_DATE_FROM)));
							$status_exists = $this->AratorModel->checkIfExistsLifeBill($agreement->AGREEMENT_ID, $pom_date);
							if ($status_exists==FALSE){
								$date_create_final = substr($pom_date,0,7).'-'.substr(date("Y-m-d",strtotime("now")),8,2);
								if ((substr($date_create_final,5,2)=='02') AND ((substr($date_create_final,8,2)=='29') OR (substr($date_create_final,8,2)=='30') OR (substr($date_create_final,8,2)=='31'))) {
									$date_create_final = substr($date_create_final,0,7).'-28';
								}
								$correctId = getCorrectID($agreement->AGREEMENT_ID);
								$serial_number= 'ZBL'.$correctId.substr($agreement->AGREEMENT_DATE_FROM,8,2).substr($agreement->AGREEMENT_DATE_FROM,5,2).substr($agreement->AGREEMENT_DATE_FROM,0,4).substr($date_create_final,5,2).substr($date_create_final,2,2);
								$serial_number_agreement=$this->AratorModel->getSerialNumberLife($agreement->AGREEMENT_ID);
								if ($sequence_number==1){
									$number_of_days = intval(date("d",strtotime($agreement->AGREEMENT_DATE_FROM)));
									$price = ($agreement->AGREEMENT_PRICE)+(($agreement->AGREEMENT_PRICE/30)*$number_of_days);
								} else {
									$price = ($agreement->AGREEMENT_PRICE);
								}
								$this->AratorModel->setNewLifeBill($agreement->AGREEMENT_ID,$date_create_final,$price,$agreement->AGREEMENT_CURRENCY,$serial_number,$sequence_number,$serial_number_agreement);
								$count_created = $count_created+1;
								$count_formatted = getCorrectID($count_created);
							
								echo '<p>'.$count_formatted.'. / ZBL'.$correctId.substr($agreement->AGREEMENT_DATE_FROM,8,2).substr($agreement->AGREEMENT_DATE_FROM,5,2).substr($agreement->AGREEMENT_DATE_FROM,0,4).substr($date_create_final,5,2).substr($date_create_final,2,2).' / <span style="color:DarkGreen">CREATED SUCCESSFULLY</span><br>';
							}	
						} 
					}
	
			} else if ($agreement->AGREEMENT_TYPE=='T'){
				$sequence_number = 1;
				$now_date = new DateTime(date("Y-m-d",strtotime("now")));
				$status_exists = $this->AratorModel->checkIfExistsTravelBill($agreement->AGREEMENT_ID);
				if ($status_exists==FALSE){
					$count_created = $count_created+1;
					$count_formatted = getCorrectID($count_created);
					$final_date = substr(date("Y-m-d",strtotime($agreement->AGREEMENT_DATE_FROM)),0,7).'-'.substr(date("Y-m-d",strtotime("now")),8,2);					
					if ($agreement->AGREEMENT_CURRENCY==1){
						$currency = 'Kč';
					} else {
						$currency = 'Eur';
					}
					$correctId = getCorrectID($agreement->AGREEMENT_ID);
					$serial_number = 'ZBT'.$correctId.substr($agreement->AGREEMENT_DATE_FROM,8,2).substr($agreement->AGREEMENT_DATE_FROM,5,2).substr($agreement->AGREEMENT_DATE_FROM,0,4).substr($final_date,5,2).substr($final_date,2,2);
					$serial_number_agreement=$this->AratorModel->getSerialNumberTravel($agreement->AGREEMENT_ID);
					$this->AratorModel->setNewTravelBill($agreement->AGREEMENT_ID,$final_date,$agreement->AGREEMENT_PRICE,$currency,$serial_number,$sequence_number,$serial_number_agreement);
					echo '<p>'.$count_formatted.'. / ZBT'.$correctId.substr($agreement->AGREEMENT_DATE_FROM,8,2).substr($agreement->AGREEMENT_DATE_FROM,5,2).substr($agreement->AGREEMENT_DATE_FROM,0,4).substr($final_date,5,2).substr($final_date,2,2).' / <span style="color:DarkGreen">CREATED SUCCESSFULLY</span><br>';
				}
			}									
		}
		if ($count_created==0){
			echo '<p style="color:DarkGreen">NO CHANGES CREATED</p><br>';
			echo '===================================================================================================================================================================<br><br>';
			echo '<p>TABLE CIS_T_BANK IS <span style="color:orange">UP-TO-DATE</span></p>';
			echo '<p>TABLE CIS_T_STATE IS <span style="color:orange">UP-TO-DATE</span></p>';
			echo '<p>TABLE POJ_T_AGREEMENT_LIFE IS <span style="color:orange">UP-TO-DATE</span></p>';
			echo '<p>TABLE POJ_T_AGREEMENT_TRAVEL IS <span style="color:orange">UP-TO-DATE</span></p>';
			echo '<p>TABLE POJ_T_BILLS IS <span style="color:orange">UP-TO-DATE</span></p>';
			echo '<p>TABLE POJ_T_USER IS <span style="color:orange">UP-TO-DATE</span></p>';
			echo '<p>TABLE POJ_T_USER_ADRESS IS <span style="color:orange">UP-TO-DATE</span></p>';
			echo '<p>TABLE POJ_T_USER_BANK IS <span style="color:orange">UP-TO-DATE</span></p>';
			echo '<p>TABLE POJ_T_USER_HIRE IS <span style="color:orange">UP-TO-DATE</span></p>';
			echo '<p>TABLE POJ_T_USER_LOGIN IS <span style="color:orange">UP-TO-DATE</span></p>';
			echo '<p>TABLE SET_T_GENERAL IS <span style="color:orange">UP-TO-DATE</span><p></br>';
			echo '===================================================================================================================================================================<br><br>';
			echo '<p style="color:DarkGreen">SUCCESSFULLY INCREASED SET_T_ARATOR</p><br>';
			echo '===================================================================================================================================================================<br><br>';
			echo '<p>DATABASE STATICTICS</p><br>';
			echo '<p>CIS_T_BANK->GET_NUM_ROWS = <span style="color:orange">'.($this->AratorModel->CIS_T_BANK()).'</span></p>';
			echo '<p>CIS_T_STATE->GET_NUM_ROWS = <span style="color:orange">'.($this->AratorModel->CIS_T_STATE()).'</span></p>';
			echo '<p>POJ_T_AGREEMENT_LIFE->GET_NUM_ROWS = <span style="color:orange">'.($this->AratorModel->POJ_T_AGREEMENT_LIFE()).'</span></p>';
			echo '<p>POJ_T_AGREEMENT_TRAVEL->GET_NUM_ROWS = <span style="color:orange">'.($this->AratorModel->POJ_T_AGREEMENT_TRAVEL()).'</span></p>';
			echo '<p>POJ_T_BILLS->GET_NUM_ROWS = <span style="color:orange">'.($this->AratorModel->POJ_T_BILLS()).'</span></p>';
			echo '<p>POJ_T_USER->GET_NUM_ROWS = <span style="color:orange">'.($this->AratorModel->POJ_T_USER()).'</span></p>';
			echo '<p>POJ_T_USER_ADRESS->GET_NUM_ROWS = <span style="color:orange">'.($this->AratorModel->POJ_T_USER_ADRESS()).'</span></p>';
			echo '<p>POJ_T_USER_BANK->GET_NUM_ROWS = <span style="color:orange">'.($this->AratorModel->POJ_T_USER_BANK()).'</span></p>';
			echo '<p>POJ_T_USER_HIRE->GET_NUM_ROWS = <span style="color:orange">'.($this->AratorModel->POJ_T_USER_HIRE()).'</span></p>';
			echo '<p>POJ_T_USER_LOGIN->GET_NUM_ROWS = <span style="color:orange">'.($this->AratorModel->POJ_T_USER_LOGIN()).'</span></p>';
			echo '<p>SET_T_GENERAL->GET_NUM_ROWS = <span style="color:orange">'.($this->AratorModel->SET_T_GENERAL()).'</span></p><br>';
			echo '===================================================================================================================================================================<br><br>';
			echo '<p style="color:DarkGreen">DATABASE IS CORRECT - NO ERRORS DETECTED</p><br>';
			echo '===================================================================================================================================================================<br><br>';
		} else {
			echo '<br>';
			echo '===================================================================================================================================================================<br><br>';
			echo '<p style="color:DarkGreen">CHANGES CREATED SUCCESSFULLY</p><br>';
			echo '===================================================================================================================================================================<br><br>';
			echo '<p>TABLE CIS_T_BANK IS <span style="color:orange">UP-TO-DATE</span></p>';
			echo '<p>TABLE CIS_T_STATE IS <span style="color:orange">UP-TO-DATE</span></p>';
			echo '<p>TABLE POJ_T_AGREEMENT_LIFE IS <span style="color:orange">UP-TO-DATE</span></p>';
			echo '<p>TABLE POJ_T_AGREEMENT_TRAVEL IS <span style="color:orange">UP-TO-DATE</span></p>';
			echo '<p>TABLE POJ_T_BILLS IS <span style="color:DarkGreen">SUCCESSFULLY UPDATED</span></p>';
			echo '<p>TABLE POJ_T_USER IS <span style="color:orange">UP-TO-DATE</span></p>';
			echo '<p>TABLE POJ_T_USER_ADRESS IS <span style="color:orange">UP-TO-DATE</span></p>';
			echo '<p>TABLE POJ_T_USER_BANK IS <span style="color:orange">UP-TO-DATE</span></p>';
			echo '<p>TABLE POJ_T_USER_HIRE IS <span style="color:orange">UP-TO-DATE</span></p>';
			echo '<p>TABLE POJ_T_USER_LOGIN IS <span style="color:orange">UP-TO-DATE</span></p>';
			echo '<p>TABLE SET_T_GENERAL IS <span style="color:orange">UP-TO-DATE</span></p><br>';
			echo '===================================================================================================================================================================<br><br>';
			echo '<p style="color:DarkGreen">SUCCESSFULLY INCREASED SET_T_ARATOR</p><br>';
			echo '===================================================================================================================================================================<br><br>';
			echo '<p>DATABASE STATICTICS</p><br>';
			echo '<p>CIS_T_BANK->GET_NUM_ROWS = <span style="color:orange">'.($this->AratorModel->CIS_T_BANK()).'</span></p>';
			echo '<p>CIS_T_STATE->GET_NUM_ROWS = <span style="color:orange">'.($this->AratorModel->CIS_T_STATE()).'</span></p>';
			echo '<p>POJ_T_AGREEMENT_LIFE->GET_NUM_ROWS = <span style="color:orange">'.($this->AratorModel->POJ_T_AGREEMENT_LIFE()).'</span></p>';
			echo '<p>POJ_T_AGREEMENT_TRAVEL->GET_NUM_ROWS = <span style="color:orange">'.($this->AratorModel->POJ_T_AGREEMENT_TRAVEL()).'</span></p>';
			echo '<p>POJ_T_BILLS->GET_NUM_ROWS = <span style="color:orange">'.($this->AratorModel->POJ_T_BILLS()).'</span></p>';
			echo '<p>POJ_T_USER->GET_NUM_ROWS = <span style="color:orange">'.($this->AratorModel->POJ_T_USER()).'</span></p>';
			echo '<p>POJ_T_USER_ADRESS->GET_NUM_ROWS = <span style="color:orange">'.($this->AratorModel->POJ_T_USER_ADRESS()).'</span></p>';
			echo '<p>POJ_T_USER_BANK->GET_NUM_ROWS = <span style="color:orange">'.($this->AratorModel->POJ_T_USER_BANK()).'</span></p>';
			echo '<p>POJ_T_USER_HIRE->GET_NUM_ROWS = <span style="color:orange">'.($this->AratorModel->POJ_T_USER_HIRE()).'</span></p>';
			echo '<p>POJ_T_USER_LOGIN->GET_NUM_ROWS = <span style="color:orange">'.($this->AratorModel->POJ_T_USER_LOGIN()).'</span></p>';
			echo '<p>SET_T_GENERAL->GET_NUM_ROWS = <span style="color:orange">'.($this->AratorModel->SET_T_GENERAL()).'</span></p><br>';
			echo '===================================================================================================================================================================<br><br>';
			echo '<p style="color:DarkGreen">DATABASE IS CORRECT - NO ERRORS DETECTED</p><br>';
			echo '===================================================================================================================================================================<br><br>';
		}
		
	
	}
	
	
}