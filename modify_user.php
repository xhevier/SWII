<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ($this->session->userdata('permisson')==0) {
    $this->load->helper('header');
    showHeader();
    $this->load->helper('menu');
    showMenuAdmin(); 
	$this->load->helper('vypis');
	?>
    
	<script>
		$(document).ready(function(){
			$("#menuEmployees").css("background-color", "#00B4D7");
			$("#menuEmployeesW").css("color", "white");
		});	
	</script>
	
	
	<h1>Editace zaměstnance</h1>
	
    <div>
        <table class="form_table">
            <tr>
                <td width="200">
                    Titul
                </td>
                <td>
                    <?php echo form_input('editEmployeeTitle',$user->USER_TITLE,'class="myTextArea"'); ?>
                </td>
				<td width="80">
                    &nbsp
                </td>
				<td width="200">
                    Přihlašovací jméno
                </td>
                <td>
                    <?php echo form_input('',$user->LOGIN_NAME,'class="myTextAreaNoEdit" readonly'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Jméno
                </td>
                <td>
                    <?php echo form_input('editEmployeeLName',$user->USER_FNAME,'class="myTextArea"'); ?>
                </td>
				<td>
                    &nbsp
                </td>
				<td>
                    Registrován uživatelem
                </td>
                <td>
                    <?php echo form_input('',getUserName($user->USER_CREATE_USER_ID),'class="myTextAreaNoEdit" readonly'); ?>
                </td>
                <td>
            </tr>
            <tr>
                <td>
                    Příjmení
                </td>
                <td>
                    <?php echo form_input('editEmployeeLNAME',$user->USER_LNAME,'class="myTextArea"'); ?>
                </td>
				<td>
                    &nbsp
                </td>
				<td>
                    Registrován dne
                </td>
                <td>
                    <?php echo form_input('',date('d.m.Y',strtotime($user->USER_CREATE_DATE)),'class="myTextAreaNoEdit" readonly'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Datum narození
                </td>
                <td>
					<?php
					$year = substr($user->USER_PIN,4,2).'.'.substr($user->USER_PIN,2,2).'.19'.substr($user->USER_PIN,0,2);
                    echo form_input('editEmployeeBirthDate',$year ,'class="myTextArea"'); ?>
                </td>
				<td>
                    &nbsp
                </td>
				<td>
                    Změnen uživatelem
                </td>
                <td>
                    <?php 
						if ($user->USER_MODIFY_USER_ID == null){
							echo form_input('','jestě nezměneno','class="myTextAreaNoEdit" readonly');
						} else {
							echo form_input('',$user->USER_MODIFY_USER_ID,'class="myTextAreaNoEdit" readonly');
						}
					 ?>
                </td>
            </tr>
            <tr>
                <td>
                    Rodné číslo
                </td>
                <td>
                    <?php echo form_input('editEmployeePIN',$user->USER_PIN,'class="myTextArea"'); ?>
                </td>	
				<td>
                    &nbsp
                </td>
				<td>
                    Změnen dne
                </td>
                <td>
					<?php 
						if ($user->USER_MODIFY_DATE == null){
							echo form_input('','jestě nezměneno','class="myTextAreaNoEdit" readonly');
						} else {
							echo form_input('',date('d-m-Y',strtotime($user->USER_MODIFY_DATE)),'class="myTextAreaNoEdit" readonly');
						}
					?>
                </td>				
            </tr>
            <tr>
                <td>
                    Mobilní telefon
                </td>
                <td>
                    <?php echo form_input('editEmployeeMNumber',$user->USER_MNUMBER,'class="myTextArea"'); ?>
                </td>				
				<td>
                    &nbsp
                </td>
				<td>
                    Platnost smlouvy od
                </td>
                <td>
                    <?php echo form_input('',date('d.m.Y',strtotime($user->HIRE_FROM)),'class="myTextAreaNoEdit" readonly'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Email
                </td>
                <td>
                    <?php echo form_input('editEmployeeEmail',$user->USER_EMAIL,'class="myTextArea"'); ?>
                </td>
				<td>
                    &nbsp
                </td>
				<td>
                    Platnost smlouvy do
                </td>
                <td>
                    <?php echo form_input('',date('d.m.Y',strtotime($user->HIRE_TO)),'class="myTextAreaNoEdit" readonly'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Číslo občanského průkazu
                </td>
                <td>
                    <?php 
					$onumber = 'SL'.substr($user->USER_PIN,4,2).substr($user->USER_PIN,5,1).substr($user->USER_PIN,7,2).substr($user->USER_PIN,4,1);
					echo form_input('',$onumber,'class="myTextArea"'); ?>
                </td>
				<td>
                    &nbsp
                </td>
				<td>
                    Pozice
                </td>
                <td>
                    <?php 				
					echo form_input('',getFunction($user->LOGIN_PERMISSON),'class="myTextAreaNoEdit" readonly'); ?>
                </td>
            </tr>           
            <tr>
                <td width="200">
                    &nbsp
                </td>
                <td>
                    &nbsp
                </td>
            </tr>
            <tr>
                <td>
                    Ulice
                </td>
                <td>
                    <?php echo form_input('editEmployeeStreet',$user->ADRESS_STREET,'class="myTextArea"'); ?>
                </td>
				<td>
                    &nbsp
                </td>
				<td>
                    Číslo bankovního účtu
                </td>
                <td>
                    <?php echo form_input('editEmployeeBankNumber',$user->BANK_NUMBER,'class="myTextArea"'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Číslo domu
                </td>
                <td>
                    <?php echo form_input('editEmployeeAdressNumber',$user->ADRESS_NUMBER,'class="myTextArea" '); ?>
                </td>
				<td>
                    &nbsp
                </td>
				<td>
                    Kód banky
                </td>
                <td>
					<?php $options = getAllBanksToArray();?>
					<?php echo form_dropdown('editEmployeeBankCode',$options, $user->BANK_ID,'class="myTextArea" style="width:400px" id="editEmployeeBankCode"'); ?>
             
                </td>
            </tr>
            <tr>
                <td>
                    PSČ
                </td>
                <td>
                    <?php echo form_input('editEmployeeAdressPost',$user->ADRESS_POST,'class="myTextArea" '); ?>
                </td>
				<td>
                    &nbsp
                </td>
				<td>
                    Název banky
                </td>
                <td>
                    <?php echo form_input('',$user->BANK_NAME,'class="myTextAreaNoEdit" id="editEmployeeBankName" readonly hidden'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Město
                </td>
                <td>
                    <?php echo form_input('editEmployeeCity',$user->ADRESS_CITY,'class="myTextArea"'); ?>
                </td>
				<td>
                    &nbsp
                </td>
				<td>
                    IBAN
                </td>
                <td>
                    <?php echo form_input('editEmployeeIban',$user->BANK_IBAN,'class="myTextArea"'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Stát
                </td>
                <td>
					<?php
						$options = array(
							'1' => ' (CZ) Česká republika',
							'2' => ' (SK) Slovenská republika',
						);
						echo form_dropdown('editEmployeeState',$options, $user->ADRESS_STATE,'class="myTextArea" style="width:70px" id="newLifeCurrency"'); 
					?>                  
                </td>
            </tr>
			</table>
	<div class="pdfActionDivName" style="height:120px">
		<span style="color:red; padding-top:15px; margin-left:15px;">
			<?php echo $employeeModifyError?> 
		</span>
	</div>
  
    <div class="div_lane" style="">
        <div class="button-group" style="padding-top: 15px; margin-left: 15px">
            <a href="" onclick="history.go(-1)" class="button">Zpět</a>
            <a href="" class="button">Zmazat a archivovat</a>  
			<a href="" class="button">Uložit</a>					
        </div>
    </div>
	</div>

    <?php echo form_close();
    $this->load->helper('footer');
} else {
    echo "error, neplatné privilégia";
}
