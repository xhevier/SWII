<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ($this->session->userdata('permisson')==0  OR $this->session->userdata('permisson')==1) {
    $this->load->helper('header');
    showHeader();
    $this->load->helper('menu');
    showMenuAdmin();

    ?>
        <script>
            $(document).ready(function(){
				$("#menuInsurants").css("background-color", "#00B4D7");
				$("#menuInsurantsW").css("color", "white");
			});                          
        </script>
    <?php

    echo form_open('Admin/createNewClient',  'id="register-form"');
    ?>
    <h1>Prihlášení klienta</h1>
    <div>
        <table class="form_table">
            <tr>
                <td width="200">
                    Titul
                </td>
                <td>
                    <?php echo form_input('newEmployeeTitle',$newEmployeeTitle,'class="myTextArea"'); ?>
                </td>
                <td  width="50">
                </td>
				<td  width="200">
                    Ulice
                </td>
                <td>
                    <?php echo form_input('newEmployeeStreet',$newEmployeeStreet,'class="myTextArea"'); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    Jméno
                </td>
                <td>
                    <?php echo form_input('newEmployeeFirstName',$newEmployeeFirstName,'id="newFirstName" class="myTextArea"'); ?>
                </td>
				<td>
                </td>
				<td>
                    Číslo domu
                </td>
                <td>
                    <?php echo form_input('newEmployeeStreetNumber',$newEmployeeStreetNumber,'class="myTextArea"'); ?>
                </td>
                <td>
            </tr>
            <tr>
                <td>
                    Příjmení
                </td>
                <td>
                    <?php echo form_input('newEmployeeLastName',$newEmployeeLastName,'id="newLastName" class="myTextArea"'); ?>
                </td>
				<td>
                </td>
				<td>
                    PSČ
                </td>
                <td>
                    <?php echo form_input('newEmployeePostCode',$newEmployeePostCode,'class="myTextArea"'); ?>
                </td>
                <td>
            </tr>
            <tr>
                <td>
                    Datum narození
                </td>
                <td>
                    <?php echo form_input('newEmployeeBirthDate',$newEmployeeBirthDate,'id="newBirthDate" class="myTextArea"'); ?>
                </td>
				<td>
                </td>
				<td>
                    Město
                </td>
                <td>
                    <?php echo form_input('newEmployeeCity',$newEmployeeCity,'class="myTextArea"'); ?>
                </td>
                <td>
            </tr>
            <tr>
                <td>
                    Rodné číslo
                </td>
                <td>
                    <?php echo form_input('newEmployeePIN',$newEmployeePIN,'class="myTextArea"'); ?>
                </td>
				<td>
                </td>
				<td>
                    Stát
                </td>
                <td>
					<?php 
					$options2 = array(
							'1'         => 'Česká republika',
							'2'         => 'Slovenská republika',
					);

					?>
                    <?php echo form_dropdown('newEmployeeState',$options2,'1','class="myTextArea"'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Mobilní telefon
                </td>
                <td>
                    <?php echo form_input('newEmployeePhoneNumber',$newEmployeePhoneNumber,'class="myTextArea"'); ?>
                </td>	
				<td>
				</td>
				<td>
                    Platnost smlouvy od
                </td>
                <td>
                    <?php echo form_input('newEmployeeHireFrom',$newEmployeeHireFrom,'class="myTextArea"'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Email
                </td>
                <td>
                    <?php echo form_input('newEmployeeEmail',$newEmployeeEmail,'class="myTextArea"'); ?>
                </td>
				<td>
				</td>
				<td>
                    Platnost smlouvy do
                </td>
                <td>
                    <?php echo form_input('newEmployeeHireTo',$newEmployeeHireTo,'class="myTextArea"'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Číslo občanského průkazu
                </td>
                <td>
                    <?php echo form_input('newEmployeePinNumber',$newEmployeePinNumber,'class="myTextArea"'); ?>
                </td>
				<td>
				</td>
				<td>
                    Pozice
                </td>
                <td>
					<?php 
					$options = array(
							'5'         => 'Klient',
					);

					?>
                    <?php echo form_dropdown('newEmployeePosition',$options,'2','class="myTextArea"'); ?>
                </td>
            </tr>
			<tr>
				<td>&nbsp </td>
			</tr>
            <tr>         
                <td>
                    Přihlašovací jméno
                </td>
                <td>
                    <?php echo form_input('newEmployeeLogin',$newEmployeeLogin,'class="myTextAreaReadOnly" readonly'); ?>
                </td>
				<td>
                </td>
                <td>
                    Číslo bankovního účtu
                </td>
                <td>
                    <?php echo form_input('newEmployeeBankNumber',$newEmployeeBankNumber,'class="myTextArea"'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Přihlašovací heslo
                </td>
                <td>
                    <?php echo form_password('newEmployeePassword',$newEmployeePassword,'class="myTextAreaReadOnly" readonly'); ?>
                </td>
                <td>
                </td>
				<td>
                    Kód banky
                </td>
                <td>
                    <?php echo form_input('newEmployeeBankCode',$newEmployeeBankCode,'class="myTextArea"'); ?>
                </td>               
            </tr>
            <tr>
                <td>
                    Registrován uživatelem
                </td>
                <td>
                    <?php echo form_input('newEmployeeRegisterUser',$newEmployeeRegisterUser,'class="myTextAreaReadOnly" readonly'); ?>
                </td>
                <td>

                </td>	
				 <td>
                    IBAN
                </td>
                <td>
                    <?php echo form_input('newEmployeeIban',$newEmployeeIban,'class="myTextArea"'); ?>
                </td>            
            </tr>
			<tr>
				<td>
				</td>
				<td>
				</td>
				<td>
				</td>
				<td>
                    <?php /*Název banky*/?>
                </td>
                <td>
                    <?php echo form_input('newEmployeeBankName',$newEmployeeBankName,'class="myTextAreaReadOnly" readonly hidden'); ?>
                </td>  
				
			</tr>
        </table>
		<div class="div_for_errors_new_employee">
			<?php echo $newEmployeeErrors; ?>
		</div>
    <div class="div_lane">
        <div class="button-group" style="padding-top: 15px; margin-left: 15px">
            <a href="" class="button">Vyčistit</a>
            <a href="" class="button">Zrušit</a>           
            <?php echo form_submit('submitNewClient', 'Uložit', 'class="button"'); ?>
        </div>
    </div>
    </div>
    <?php echo form_close();
    $this->load->helper('footer');
} else {
    echo "error, neplatné privilégia";
}
