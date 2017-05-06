<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (($this->session->userdata('permisson')==4)) {
    $this->load->helper('header');
    showHeader();
    $this->load->helper('menu');
    showMenuAdviser(); 
	$this->load->helper('vypis');
	?>
    
	<script>
		$(document).ready(function(){
			$("#menuInsurants").css("background-color", "#00B4D7");
			$("#menuInsurantsW").css("color", "white");
		});	
	</script>
	
	
	<h1>Editace klienta</h1>
	
	<?php echo form_open(base_url('Adviser/validateModifyClient/'.$USER_ID)); ?>
    <div>
        <table class="form_table">
            <tr>
                <td width="200">
                    Titul
                </td>
                <td>
                    <?php echo form_input('USER_TITLE',$USER_TITLE,'class="myTextArea"'); ?>
                </td>
				<td width="80">
                    &nbsp
                </td>
				<td width="200">
                    Přihlašovací jméno
                </td>
                <td>
                    <?php echo form_input('LOGIN_NAME',$LOGIN_NAME,'class="myTextAreaNoEdit" readonly'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Jméno
                </td>
                <td>
                    <?php echo form_input('USER_FNAME',$USER_FNAME,'class="myTextArea"'); ?>
                </td>
				<td>
                    &nbsp
                </td>
				<td>
                    Registrován uživatelem
                </td>
                <td>
                    <?php echo form_input('USER_CREATE_USER',$USER_CREATE_USER,'class="myTextAreaNoEdit" readonly'); ?>
                </td>
                <td>
            </tr>
            <tr>
                <td>
                    Příjmení
                </td>
                <td>
                    <?php echo form_input('USER_LNAME',$USER_LNAME,'class="myTextArea"'); ?>
                </td>
				<td>
                    &nbsp
                </td>
				<td>
                    Registrován dne
                </td>
                <td>
                    <?php echo form_input('USER_CREATE_DATE',$USER_CREATE_DATE,'class="myTextAreaNoEdit" readonly'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Datum narození
                </td>
                <td>
					<?php
                    echo form_input('USER_YEAR', $USER_YEAR ,'class="myTextArea"'); ?>
                </td>
				<td>
                    &nbsp
                </td>
				<td>
                    Změnen uživatelem
                </td>
                <td>
                    <?php 
						if ($USER_MODIFY_USER == null OR $USER_MODIFY_USER=='jestě nezměneno'){
							echo form_input('USER_MODIFY_USER','jestě nezměneno','class="myTextAreaNoEdit" readonly');
						} else {
							echo form_input('USER_MODIFY_USER',$USER_MODIFY_USER,'class="myTextAreaNoEdit" readonly');
						}
					 ?>
                </td>
            </tr>
            <tr>
                <td>
                    Rodné číslo
                </td>
                <td>
                    <?php echo form_input('USER_PIN',$USER_PIN,'class="myTextArea"'); ?>
                </td>	
				<td>
                    &nbsp
                </td>
				<td>
                    Změnen dne
                </td>
                <td>
					<?php 
						if ($USER_MODIFY_DATE == null OR $USER_MODIFY_DATE=='jestě nezměneno'){
							echo form_input('USER_MODIFY_DATE','jestě nezměneno','class="myTextAreaNoEdit" readonly');
						} else {
							echo form_input('USER_MODIFY_DATE',$USER_MODIFY_DATE,'class="myTextAreaNoEdit" readonly');
						}
					?>
                </td>				
            </tr>
            <tr>
                <td>
                    Mobilní telefon
                </td>
                <td>
                    <?php echo form_input('USER_MNUMBER',$USER_MNUMBER,'class="myTextArea"'); ?>
                </td>				
				<td>
                    &nbsp
                </td>
				<td>
                    Platnost smlouvy od
                </td>
                <td>
                    <?php echo form_input('HIRE_FROM',$HIRE_FROM,'class="myTextAreaNoEdit" readonly'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Email
                </td>
                <td>
                    <?php echo form_input('USER_EMAIL',$USER_EMAIL,'class="myTextArea"'); ?>
                </td>
				<td>
                    &nbsp
                </td>
				<td>
                    Platnost smlouvy do
                </td>
                <td>
                    <?php echo form_input('HIRE_TO',$HIRE_TO,'class="myTextAreaNoEdit" readonly'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Číslo občanského průkazu
                </td>
                <td>
                    <?php 
					echo form_input('USER_PIN2',$USER_PIN2,'class="myTextArea"'); ?>
                </td>
				<td>
                    &nbsp
                </td>
				<td>
                    Pozice
                </td>
                <td>
                    <?php 				
					echo form_input('LOGIN_PERMISSON',$LOGIN_PERMISSON,'class="myTextAreaNoEdit" readonly'); ?>
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
                    <?php echo form_input('ADRESS_STREET',$ADRESS_STREET,'class="myTextArea"'); ?>
                </td>
				<td>
                    &nbsp
                </td>
				<td>
                    Číslo bankovního účtu
                </td>
                <td>
                    <?php echo form_input('BANK_NUMBER',$BANK_NUMBER,'class="myTextArea"'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Číslo domu
                </td>
                <td>
                    <?php echo form_input('ADRESS_NUMBER',$ADRESS_NUMBER,'class="myTextArea" '); ?>
                </td>
				<td>
                    &nbsp
                </td>
				<td>
                    Kód banky
                </td>
                <td>
					<?php $options = getAllBanksToArray();?>
					<?php echo form_dropdown('BANK_ID',$options, $BANK_ID,'class="myTextArea" style="width:400px" id="editEmployeeBankCode"'); ?>
             
                </td>
            </tr>
            <tr>
                <td>
                    PSČ
                </td>
                <td>
                    <?php echo form_input('ADRESS_POST',$ADRESS_POST,'class="myTextArea" '); ?>
                </td>
				<td>
                    &nbsp
                </td>
				<td>
                    Název banky
                </td>
                <td>
                    <?php echo form_input('BANK_NAME',$BANK_NAME,'class="myTextAreaNoEdit" id="editEmployeeBankName" readonly hidden'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Město
                </td>
                <td>
                    <?php echo form_input('ADRESS_CITY',$ADRESS_CITY,'class="myTextArea"'); ?>
                </td>
				<td>
                    &nbsp
                </td>
				<td>
                    IBAN
                </td>
                <td>
                    <?php echo form_input('BANK_IBAN',$BANK_IBAN,'class="myTextArea"'); ?>
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
						echo form_dropdown('ADRESS_STATE',$options, $ADRESS_STATE,'class="myTextArea" style="width:70px" id="newLifeCurrency"'); 
					?>                  
                </td>
            </tr>
			</table>
	<div class="pdfActionDivName" style="height:120px">
		<span style="color:#C94C4C;margin-left:15px;">
			</br>
			<?php echo $employeeModifyError?> 
		</span>
	</div>
  
    <div class="div_lane" style="">
        <div class="button-group" style="padding-top: 15px; margin-left: 15px">
            <a href="" onclick="history.go(-1)" class="button">Zpět</a>
            <a href="" class="button">Zmazat a archivovat</a> 
			<?php echo form_submit('validateModifyClient', 'Uložit', 'class="button"')?>								
        </div>
    </div>
	</div>

    <?php echo form_close();
    $this->load->helper('footer');
} else {
    echo "error, neplatné privilégia";
}
