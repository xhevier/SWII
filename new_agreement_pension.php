<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ($this->session->userdata('permisson')==0 OR $this->session->userdata('permisson')==1) {
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
	
    <h1>Založení důchodového pojištení</h1>

    <table class="form_table">  
			<tr>
				<td>
					Rodné číslo
				</td>
				<td width="1000px">					
					<div class="button-group" style="float:left">
						<?php echo form_input('newPensionPIN',$newAgreementUser['newPIN'],'class="myTextArea" style="width:110px; float: left" id="newPensionPIN"');?>
						<?php echo form_submit('newPensionTrace', 'Dohledat', 'class="button" style="float:left; margin-left:5px"')?>					
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
					echo form_input('newPensionName',$newAgreementUser['userName'],'class="myTextAreaNoEdit" readonly id="newPensionName"'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Datum narození
				</td>
				<td>
					<?php 
					echo form_input('newPensionBirthDate',$newAgreementUser['userBirth'],'class="myTextAreaNoEdit" readonly style="width:100px"'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Věk
				</td>
				<td>
					<?php 
					echo form_input('newPensionYears',$newAgreementUser['userAge'],'class="myTextAreaNoEdit" readonly style="width:40px"'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Trvalý pobyt
				</td>
				<td>
					<?php 
					echo form_input('newPensionAdress',$newAgreementUser['userAdress'],'class="myTextAreaNoEdit" readonly'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Stát
				</td>
				<td>
					<?php 
					echo form_input('newPensionState',$newAgreementUser['userState'],'class="myTextAreaNoEdit" readonly'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Bankovní spojení
				</td>
				<td>
					<?php 
					echo form_input('newPensionBank',$newAgreementUser['userBank'],'class="myTextAreaNoEdit" readonly style="width:305px"'); ?> 
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
							echo form_input('newPensionDateFrom',date('d.m.Y'),'class="myTextAreaNoEdit" readonly style="width:100px; float:left" id="newPensionDateFrom"'); 
							echo form_input('newPensionDateTo',$newAgreementUser['userDateTo'],'class="myTextAreaNoEdit" readonly style="width:100px; float:left; margin-left:5px" id="newPensionDateTo"');
							echo '<a class="button" style="float:left; margin-left:5px; width:80px; height: 28px" id="newUserOneYear"><span id="spanOne">Deset let<span></a>';
							echo '<a class="button" style="float:left; margin-left:5px; width:95px; height: 28px" id="newUserTwoYear"><span id="spanTwo">Dvacet let<span></a>';
							echo '<a class="button" style="float:left; margin-left:5px; width:80px; height: 28px" id="newUserTreeYear"><span id="spanTree">Třicet let<span></a>';
							echo '<a class="button" style="float:left; margin-left:5px; width:90px; height: 28px" id="newUserTreeYear"><span id="spanTree">Padesát let<span></a>';
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
						echo form_input('newPensionPrice',$newAgreementUser['userPrice'],'class="myTextArea" id="newPensionPrice" style="width:100px"'); 
						$options = array(
							'Eur' => 'Eur',
							'Kč' => 'Kč',
						);
						echo form_dropdown('newPensionCurrency',$options, $newAgreementUser['userCurrency'] ,'class="myTextArea" style="width:70px" id="newPensionCurrency"'); 
					echo '</div>';?> 
					<p style="color: red; float:left; margin-top: 6px; margin-left:10px; font-weight: bold;">
						<?php echo $newAgreementUser['errorMessagePrice']?>
					</p>
				</td>
			</tr>
			<tr>
                <td>
					Frekvence plateb
                </td>
                <td>					
					<?php $options2 = array(
						'1' => 'Měsíčně',
						'2' => 'Čtvrtletně',
						'3' => 'Pololetně',
						'4' => 'Ročně'
					);
					echo form_dropdown('newLifeFrequency', $options2, $newAgreementUser['userFrequency'] , 'class="myTextArea" style="width:120px" id="newLifeFrequency"');	?>					
                </td>				
			</tr>
			<tr>
                <td>
					Typ platby
                </td>
                <td>					
					<?php $options2 = array(
						'1' => 'Prevodem na účet ',
						'2' => 'Hotově na pokladně',
						'3' => 'Kartou online',
						'4' => 'Katrou na pokladně',
						'5' => 'Poštovní poukázkou',
						'6' => 'SIPO'
					);
					echo form_dropdown('newLifeFrequency', $options2, $newAgreementUser['userPayType'] , 'class="myTextArea" style="width:175px" id="newLifeFrequency"');	?>					
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
