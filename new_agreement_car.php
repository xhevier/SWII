<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ($this->session->userdata('permisson')==4) {
$this->load->helper('header');
showHeader();
$this->load->helper('menu');
showMenuAdviser(); 
?>
	<script>
		$(document).ready(function(){
			$("#menuAgreements").css("background-color", "#00B4D7");
			$("#menuAgreementsW").css("color", "white");
		});	
	</script>
	
    <h1>Založení pojištìní vozidla</h1>

    <div>
         <table class="form_table">  
			<tr>
				<td>
					Rodné èíslo
				</td>
				<td width="1000px">					
					<div class="button-group" style="float:left">
						<?php echo form_input('newLifePIN',$newAgreementUser['newPIN'],'class="myTextArea" style="width:110px; float: left" id="newLifePIN"');?>
						<?php echo form_submit('newLifeTrace', 'Dohledat', 'class="button" style="float:left; margin-left:5px"')?>
						<?php /*<a href="<?php echo base_url('Adviser/getUserTrace/1/0')?>" onclick="" class="button" style="float:left; margin-left:5px" id="newUserTrace">Dohledat</a>	*/?>						
					</div>
					<p style="color: red; float:left; margin-top: 6px; margin-left:10px; font-weight: bold;">
						<?php echo $newAgreementUser['errorMessage']?>
					</p>
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Titul, jméno a pøíjmení
				</td>
				<td>
					<?php 
					echo form_input('newLifeName',$newAgreementUser['userName'],'class="myTextAreaNoEdit" readonly id="newLifeName"'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Datum narození
				</td>
				<td>
					<?php 
					echo form_input('newLifeBirthDate',$newAgreementUser['userBirth'],'class="myTextAreaNoEdit" readonly style="width:100px"'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Vìk
				</td>
				<td>
					<?php 
					echo form_input('newLiveYears',$newAgreementUser['userAge'],'class="myTextAreaNoEdit" readonly style="width:40px"'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Trvalý pobyt
				</td>
				<td>
					<?php 
					echo form_input('newLiveAdress',$newAgreementUser['userAdress'],'class="myTextAreaNoEdit" readonly'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Stát
				</td>
				<td>
					<?php 
					echo form_input('newLiveState',$newAgreementUser['userState'],'class="myTextAreaNoEdit" readonly'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Bankovní spojení
				</td>
				<td>
					<?php 
					echo form_input('newLiveBank',$newAgreementUser['userBank'],'class="myTextAreaNoEdit" readonly style="width:305px"'); ?> 
				</td>
			</tr>
			<tr>
				<td width="200px">
					&nbsp
				</td>						
			</tr>
			<tr>
				<td width="200px">
					Typ vozidla pro pojištìní
				</td>
				<td>					
					<?php $options = array(
						'1' => 'Osobní automobil',
						'2' => 'Motocykl',
						'3' => 'Nákladní auto',
						'4' => 'Autobus'
					);
					echo form_dropdown('newCarFrequency', $options, $newAgreementUser['userCarFrequency'] , 'class="myTextArea" style="width:120px" id="newCarFrequency"');	?>					
             		 	</td> 
			<tr>
			<td>
					Užití vozidla
              			</td>
             		   <td>					
					<?php $options = array(
						'1' => 'Bìžný provoz',
						'2' => 'Taxislužba',
						'3' => 'Pùjèovna',
						'4' => 'Autoškola'
					);
					echo form_dropdown('newCarUse', $options, $newAgreementUser['userUse'] , 'class="myTextArea" style="width:120px" id="newCarUse"');	?>					
               			 </td>
			<tr>
				<td>
					Datum poèátku platnosti pojištìní
				</td>
				<td>
					<?php 
					echo form_input('newStartDate',$newAgreementUser['userStart'],'class="myTextAreaNoEdit" readonly style="width:100px"'); ?> 
				</td>
			<tr>
				<td width="200px">
					&nbsp
				</td>
			<tr>
				<td>
					Datum registrace vozidla
				</td>
				<td>
					<?php 
					echo form_input('newRegistrationDate',$newAgreementUser['userRegistration'],'class="myTextAreaNoEdit" readonly style="width:100px"'); ?> 
				</td>
			<tr>
				<td>
					Znaèka vozidla
              			</td>
             		   <td>					
					<?php $options = array(
						'1' => 'Škoda',
						'2' => 'Ford',
						'3' => 'Opel',
						'4' => 'BMW'
					);
					echo form_dropdown('newWehimarker', $options, $newAgreementUser['userWehimarker'] , 'class="myTextArea" style="width:120px" id="newCarUse"');	?>					
               			 </td>
			<tr>
				<td>
					Typ vozidla
              			</td>
             		   <td>					
					<?php $options = array(
						'1' => 'Škoda',
						'2' => 'Ford',
						'3' => 'Opel',
						'4' => 'BMW'
					);
					echo form_dropdown('newTypeCar', $options, $newAgreementUser['userTypeCar'] , 'class="myTextArea" style="width:120px" id="newCarUse"');	?>					
               			 </td>
			<tr>
				<td>
					Modelový rok
              			</td>
             		   <td>					
					<?php $options = array(
						'1' => '(2014- ) Benzín',
						'2' => '(2014- ) Diesel',
						'3' => '(1999-2013) Benzín',
						'4' => '(1999-2013) Diesel',
						'5' => 'jiný'
					);
					echo form_dropdown('newModelYear', $options, $newAgreementUser['userModel'] , 'class="myTextArea" style="width:120px" id="newCarUse"');	?>					
               			 </td>
			<tr>
				<td>
					Motor
              			</td>
             		   <td>					
					<?php $options = array(
						'1' => '1.2',
						'2' => '1.4',
						'3' => '2.0',
						'4' => 'jiný'
					);
					echo form_dropdown('newMotor', $options, $newAgreementUser['userMotor'] , 'class="myTextArea" style="width:120px" id="newCarUse"');	?>					
               			 </td>
			<tr>
				<td>
					Typ karoserie
              			</td>
             		   <td>					
					<?php $options = array(
						'1' => '2-dv., osob.',
						'2' => '4-dv., osob.',
						'3' => '5-dv., osob.',
						'4' => 'jiný'
					);
					echo form_dropdown('newMotor', $options, $newAgreementUser['userMotor'] , 'class="myTextArea" style="width:120px" id="newCarUse"');	?>					
               			 </td>
			<tr>

				<td>
					Poèet míst k sezení
              			</td>
             		   <td>
					<?php 
					echo form_input('newNumberSeats',$newAgreementUser['userSeats'],'class="myTextAreaNoEdit" readonly style="width:40px"'); ?> 
				</td>

			<tr>
				<td>
					Kolik kilometrù toto vozidlo roènì najezdí?
              			</td>
             		   <td>					
					<?php $options = array(
						'1' => 'do 5 000',
						'2' => '5 001 - 20 000',
						'3' => '20 001 - 50 000',
						'4' => 'nad 50 001'
					);
					echo form_dropdown('newMotor', $options, $newAgreementUser['userMotor'] , 'class="myTextArea" style="width:120px" id="newCarUse"');	?>					
               			 </td>







 
