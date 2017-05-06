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
			
			if($('#newTravelName').val()!=''){
				/*Platnost od*/
				$("#newTravelDateFrom").prop("readonly", false);
				$("#newTravelDateFrom").removeClass("myTextAreaNoEdit");
				$("#newTravelDateFrom").addClass("myTextArea");
				/*Platnost do*/
				$("#newTravelDateTo").prop("readonly", false);
				$("#newTravelDateTo").removeClass("myTextAreaNoEdit");
				$("#newTravelDateTo").addClass("myTextArea");
				/* Price */
				$("#newTravelPrice").prop("readonly", false);
				$("#newTravelPrice").removeClass("myTextAreaNoEdit");
				$("#newTravelPrice").addClass("myTextArea");
				/* Currency */
				$("#newTravelCurrency").css("background-color", "white");
				$("#newTravelCurrency").val('1');
				$("#newTravelCurrency").prop("readonly", false);
				$("#newTravelCurrency").removeClass("myTextAreaNoEdit");
				$("#newTravelCurrency").addClass("myTextArea");
				/* Destinace */
				$("#newTravelDestination").css("background-color", "white");
				$("#newTravelDestination").val('1');
				$("#newTravelDestination").prop("readonly", false);
				$("#newTravelDestination").removeClass("myTextAreaNoEdit");
				$("#newTravelDestination").addClass("myTextArea");
				/* PayType */
				$("#newTravelPayType").css("background-color", "white");
				$("#newTravelPayType").val('1');
				$("#newTravelPayType").prop("readonly", false);
				$("#newTravelPayType").removeClass("myTextAreaNoEdit");
				$("#newTravelPayType").addClass("myTextArea");
				
			}else {
				/*Platnost od*/
				$("#newTravelDateFrom").prop("readonly", true);
				$("#newTravelDateFrom").removeClass("myTextArea");
				$("#newTravelDateFrom").addClass("myTextAreaNoEdit");
				/*Platnost do*/
				$("#newTravelDateTo").prop("readonly", true);
				$("#newTravelDateTo").removeClass("myTextArea");
				$("#newTravelDateTo").addClass("myTextAreaNoEdit");
				/* Price */
				$("#newTravelPrice").prop("readonly", true);
				$("#newTravelPrice").removeClass("myTextArea");
				$("#newTravelPrice").addClass("myTextAreaNoEdit");
				/* Currency */
				$("#newTravelCurrency").css("background-color", "#f9f9f9");
				$("#newTravelCurrency").val('0');
				$("#newTravelCurrency").prop("readonly", false);
				$("#newTravelCurrency").removeClass("myTextAreaNoEdit");
				$("#newTravelCurrency").addClass("myTextArea");
				/* Destinace */
				$("#newTravelDestination").css("background-color", "#f9f9f9");
				$("#newTravelDestination").val('0');
				$("#newTravelDestination").prop("readonly", false);
				$("#newTravelDestination").removeClass("myTextAreaNoEdit");
				$("#newTravelDestination").addClass("myTextArea");
				/* PayType */
				$("#newTravelPaytype").css("background-color", "#f9f9f9");
				$("#newTravelPaytype").val('0');
				$("#newTravelPaytype").prop("readonly", false);
				$("#newTravelPaytype").removeClass("myTextAreaNoEdit");
				$("#newTravelPaytype").addClass("myTextArea");

			};
		});	
	</script>
    <h1>Založení cestovního pojištení</h1>
	<?php echo form_open('Adviser/newTravelAgreement');?>
    <div>
	
         <table class="form_table">  
			<tr>
				<td>
					Rodné číslo
				</td>
				<td width="1000px">					
					<div class="button-group" style="float:left">
						<?php echo form_input('newTravelPIN',$newAgreementUser['newTravelPIN'],'class="myTextArea" style="width:110px; float: left" id="newTravelPIN"');?>
						<?php echo form_submit('newTravelTrace', 'Dohledat', 'class="button" style="float:left; margin-left:5px"')?>					
					</div>
					<p style="color: red; float:left; margin-top: 6px; margin-left:10px; font-weight: bold;">
						<?php echo $newAgreementUser['errorTravelMessage']?>
					</p>
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Titul, jméno a příjmení
				</td>
				<td>
					<?php 
					echo form_input('newTravelName',$newAgreementUser['newTravelName'],'class="myTextAreaNoEdit" readonly id="newTravelName"'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Datum narození
				</td>
				<td>
					<?php 
					echo form_input('newTravelBirthDate',$newAgreementUser['newTravelBirthDate'],'class="myTextAreaNoEdit" readonly style="width:100px"'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Věk
				</td>
				<td>
					<?php 
					echo form_input('newTravelYears',$newAgreementUser['newTravelYears'],'class="myTextAreaNoEdit" readonly style="width:40px"'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Trvalý pobyt
				</td>
				<td>
					<?php 
					echo form_input('newTravelAdress',$newAgreementUser['newTravelAdress'],'class="myTextAreaNoEdit" readonly'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Stát
				</td>
				<td>
					<?php 
					echo form_input('newTravelState',$newAgreementUser['newTravelState'],'class="myTextAreaNoEdit" readonly'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Bankovní spojení
				</td>
				<td>
					<?php 
					echo form_input('newTravelBank',$newAgreementUser['newTravelBank'],'class="myTextAreaNoEdit" readonly style="width:305px"'); ?> 
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
							echo form_input('newTravelDateFrom',$newAgreementUser['newTravelDateFrom'],'class="myTextArea" style="width:100px; float:left" id="newTravelDateFrom"'); 
							echo form_input('newTravelDateTo',$newAgreementUser['newTravelDateTo'],'class="myTextArea" style="width:100px; float:left; margin-left:5px" id="newTravelDateTo"');
						echo '</div>';
					?>	
					<p style="color: red; float:left; margin-top: 6px; margin-left:10px">
						<?php echo $newAgreementUser['errorMessageDate']?>
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
						echo form_input('newTravelPrice',$newAgreementUser['newTravelPrice'],'class="myTextArea" id="newTravelPrice" style="width:100px"'); 
						$options = array(
							'1' => 'Kč',
							'2' => 'Eur',
						);
						echo form_dropdown('newTravelCurrency',$options, $newAgreementUser['newTravelCurrency'] ,'class="myTextArea" style="width:70px" id="newTravelCurrency"'); 
					echo '</div>';?> 
					<p style="color: red; float:left; margin-top: 6px; margin-left:10px;">
						<?php echo $newAgreementUser['errorMessageCurrency']?>
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
						echo form_dropdown('newTravelDestination',$options, $newAgreementUser['newTravelDestination'] ,'class="myTextArea" style="width:250px" id="newTravelDestination"'); 
					echo '</div>';?> 
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
						echo form_dropdown('newTravelPayType',$options2, $newAgreementUser['newTravelPayType'] ,'class="myTextArea" style="width:250px" id="newTravelPaytype"'); 
					echo '</div>';?> 
				</td>
			</tr>
		</table>
		
		<div class="div_lane" style="margin-top:230px;"></div>
		<?php echo '<div class="button-group" style="float:left; margin-top:15px; margin-left: 15px">'; ?>
			<a href="<?php echo base_url('Adviser/redirectChooseNewAgreement/1')?>" onclick="" class="button" id="newUserTrace">Zpět</a>
			<a href="<?php echo base_url('Adviser/redirectChooseNewAgreement/2')?>" onclick="" class="button" id="newUserTrace">Vyčistit</a>
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
