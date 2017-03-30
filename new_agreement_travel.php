<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ($this->session->userdata('permisson')==0) {
$this->load->helper('header');
showHeader();
$this->load->helper('menu');
showMenuAdmin(); 
	?>	
	<script>
		$(document).ready(function(){
			$("#menuAgreements").css("background-color", "#00B4D7");
			$("#menuAgreementsW").css("color", "white");
		});	
	</script>
	
    <h1>Založení cestovního pojištení</h1>

    <div>
         <table class="form_table">  
			<tr>
				<td>
					Rodné číslo
				</td>
				<td width="1000px">					
					<div class="button-group" style="float:left">
						<?php echo form_input('newTravelPIN',$newAgreementUser['newPIN'],'class="myTextArea" style="width:110px; float: left" id="newTravelPIN"');?>
						<?php echo form_submit('newTravelTrace', 'Dohledat', 'class="button" style="float:left; margin-left:5px"')?>					
					</div>
					<p style="color: red; float:left; margin-top: 6px; margin-left:10px; font-weight: bold;">
						<?php echo $newAgreementUser['errorMessage']?>
					</p>
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Titul, jméno a příjmení
				</td>
				<td>
					<?php 
					echo form_input('newTravelName',$newAgreementUser['userName'],'class="myTextAreaNoEdit" readonly id="newTravelName"'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Datum narození
				</td>
				<td>
					<?php 
					echo form_input('newTravelBirthDate',$newAgreementUser['userBirth'],'class="myTextAreaNoEdit" readonly style="width:100px"'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Věk
				</td>
				<td>
					<?php 
					echo form_input('newTravelYears',$newAgreementUser['userAge'],'class="myTextAreaNoEdit" readonly style="width:40px"'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Trvalý pobyt
				</td>
				<td>
					<?php 
					echo form_input('newTravelAdress',$newAgreementUser['userAdress'],'class="myTextAreaNoEdit" readonly'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Stát
				</td>
				<td>
					<?php 
					echo form_input('newTravelState',$newAgreementUser['userState'],'class="myTextAreaNoEdit" readonly'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Bankovní spojení
				</td>
				<td>
					<?php 
					echo form_input('newTravelBank',$newAgreementUser['userBank'],'class="myTextAreaNoEdit" readonly style="width:305px"'); ?> 
				</td>
			</tr>
			<tr>
				<td width="200px">
					&nbsp
				</td>						
			</tr>			
			<tr>
                <td>
					Platnost od | do
                </td>
                <td>					
					<?php 					
						echo '<div class="button-group" style="float:left">';
							echo form_input('newTravelDateFrom',$newAgreementUser['userDateFrom'],'class="myTextArea" style="width:100px; float:left" id="newTravelDateFrom"'); 
							echo form_input('newTravelDateTo',$newAgreementUser['userDateTo'],'class="myTextArea" style="width:100px; float:left; margin-left:5px" id="newTravelDateTo"');
						echo '</div>';
					?>	
					<p style="color: red; float:left; margin-top: 6px; margin-left:10px; font-weight: bold;">
						<?php echo $newAgreementUser['errorMessageDateTo']?>
					</p>
                </td>				
			</tr>
			<tr>
				<td>
					Výše pojistného
				</td>
				<td>
					<?php 
					echo '<div style="float:left">';
						echo form_input('newTravelPrice',$newAgreementUser['userPrice'],'class="myTextArea" id="newTravelPrice" style="width:100px"'); 
						$options = array(
							'Eur' => 'Eur',
							'Kč' => 'Kč',
						);
						echo form_dropdown('newTravelCurrency',$options, $newAgreementUser['userCurrency'] ,'class="myTextArea" style="width:70px" id="newTravelCurrency"'); 
					echo '</div>';?> 
					<p style="color: red; float:left; margin-top: 6px; margin-left:10px; font-weight: bold;">
						<?php echo $newAgreementUser['errorMessagePrice']?>
					</p>
				</td>
			</tr>
			<tr>
				<td>
					Destinace
				</td>
				<td>
					<?php 
					echo '<div style="float:left">';
						$options = array(
							'1' => 'Česká republika',
							'2' => 'Slovenská republika',
							'3' => 'Poľsko',
							'4' => 'Nemecko',
							'5' => 'Rakúsko',
							'6' => 'Ostatné krajiny Európy',
							'7' => 'Ázia',
							'8' => 'Afrika',
							'9' => 'Austrália',
							'10' => 'Severná Amerika',
							'11' => 'Južná Amerika'
						);
						echo form_dropdown('newTravelDestination',$options, $newAgreementUser['userDestination'] ,'class="myTextArea" style="width:250px" id="newTravelCurrency"'); 
					echo '</div>';?> 
					<p style="color: red; float:left; margin-top: 6px; margin-left:10px; font-weight: bold;">
						<?php echo $newAgreementUser['errorMessagePrice']?>
					</p>
				</td>
			</tr>
			<tr>
				<td>
					Platba
				</td>
				<td>
					<?php 
					echo '<div style="float:left">';
						$options2 = array(
							'1' => 'Prevodem na účet ',
							'2' => 'Hotově na pokladně',
							'3' => 'Kartou online',
							'4' => 'Katrou na pokladně',
							'5' => 'Poštovní poukázkou',
							'6' => 'SIPO'
						);
						echo form_dropdown('newTravelPayType',$options2, $newAgreementUser['userPayType'] ,'class="myTextArea" style="width:250px" id="newTravelPaytype"'); 
					echo '</div>';?> 
					<p style="color: red; float:left; margin-top: 6px; margin-left:10px; font-weight: bold;">
						<?php echo $newAgreementUser['errorMessagePrice']?>
					</p>
				</td>
			</tr>
		</table>
		
		<div class="div_lane" style="margin-top:230px;"></div>
		<?php echo '<div class="button-group" style="float:left; margin-top:15px; margin-left: 15px">'; ?>
			<a href="<?php echo base_url('Admin/redirectChooseNewAgreement/0')?>" onclick="" class="button" id="newUserTrace">Zpět</a>
			<a href="<?php echo base_url('Admin/redirectChooseNewAgreement/1')?>" onclick="" class="button" id="newUserTrace">Vyčistit</a>
			<?php echo form_submit('newLifeTrace', 'Uložit', 'class="button"')?>
		</div>
		<?php 
			echo form_close();
		?>
    </div>


    <?php
    $this->load->helper('footer');
} else {
    echo "error, neplatné privilégia";
}
