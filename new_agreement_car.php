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
	
    <h1>Zalo�en� poji�t�n� vozidla</h1>

    <div>
         <table class="form_table">  
			<tr>
				<td>
					Rodn� ��slo
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
					Titul, jm�no a p��jmen�
				</td>
				<td>
					<?php 
					echo form_input('newLifeName',$newAgreementUser['userName'],'class="myTextAreaNoEdit" readonly id="newLifeName"'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Datum narozen�
				</td>
				<td>
					<?php 
					echo form_input('newLifeBirthDate',$newAgreementUser['userBirth'],'class="myTextAreaNoEdit" readonly style="width:100px"'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					V�k
				</td>
				<td>
					<?php 
					echo form_input('newLiveYears',$newAgreementUser['userAge'],'class="myTextAreaNoEdit" readonly style="width:40px"'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Trval� pobyt
				</td>
				<td>
					<?php 
					echo form_input('newLiveAdress',$newAgreementUser['userAdress'],'class="myTextAreaNoEdit" readonly'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					St�t
				</td>
				<td>
					<?php 
					echo form_input('newLiveState',$newAgreementUser['userState'],'class="myTextAreaNoEdit" readonly'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Bankovn� spojen�
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
					Typ vozidla pro poji�t�n�
				</td>
				<td>					
					<?php $options = array(
						'1' => 'Osobn� automobil',
						'2' => 'Motocykl',
						'3' => 'N�kladn� auto',
						'4' => 'Autobus'
					);
					echo form_dropdown('newCarFrequency', $options, $newAgreementUser['userCarFrequency'] , 'class="myTextArea" style="width:120px" id="newCarFrequency"');	?>					
             		 	</td> 
			<tr>
			<td>
					U�it� vozidla
              			</td>
             		   <td>					
					<?php $options = array(
						'1' => 'B�n� provoz',
						'2' => 'Taxislu�ba',
						'3' => 'P�j�ovna',
						'4' => 'Auto�kola'
					);
					echo form_dropdown('newCarUse', $options, $newAgreementUser['userUse'] , 'class="myTextArea" style="width:120px" id="newCarUse"');	?>					
               			 </td>
			<tr>
				<td>
					Datum po��tku platnosti poji�t�n�
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
					Zna�ka vozidla
              			</td>
             		   <td>					
					<?php $options = array(
						'1' => '�koda',
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
						'1' => '�koda',
						'2' => 'Ford',
						'3' => 'Opel',
						'4' => 'BMW'
					);
					echo form_dropdown('newTypeCar', $options, $newAgreementUser['userTypeCar'] , 'class="myTextArea" style="width:120px" id="newCarUse"');	?>					
               			 </td>
			<tr>
				<td>
					Modelov� rok
              			</td>
             		   <td>					
					<?php $options = array(
						'1' => '(2014- ) Benz�n',
						'2' => '(2014- ) Diesel',
						'3' => '(1999-2013) Benz�n',
						'4' => '(1999-2013) Diesel',
						'5' => 'jin�'
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
						'4' => 'jin�'
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
						'4' => 'jin�'
					);
					echo form_dropdown('newMotor', $options, $newAgreementUser['userMotor'] , 'class="myTextArea" style="width:120px" id="newCarUse"');	?>					
               			 </td>
			<tr>

				<td>
					Po�et m�st k sezen�
              			</td>
             		   <td>
					<?php 
					echo form_input('newNumberSeats',$newAgreementUser['userSeats'],'class="myTextAreaNoEdit" readonly style="width:40px"'); ?> 
				</td>

			<tr>
				<td>
					Kolik kilometr� toto vozidlo ro�n� najezd�?
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







 
