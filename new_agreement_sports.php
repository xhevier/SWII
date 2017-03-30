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

 <h1>Zalo�en� sportovn�ho poji�ten�</h1>
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
						<?php /*<a href="<?php echo base_url('Admin/getUserTrace/1/0')?>" onclick="" class="button" style="float:left; margin-left:5px" id="newUserTrace">Dohledat</a>	*/?>						
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
					Dolo�en� l�ka�sk� zpr�vy
				</td>			
				<td>
					<label class="switch">
						  <input type="checkbox" name="newLifeDoctor" value="<?php echo $newAgreementUser['userDoctor'] ?>">
						  <div class="slider round"></div>
					</label>
				</td>
			</tr>

			<tr>
				<td>
					��el uzav�en� pojistky
				</td>
				<td>
					<?php 
					echo '<div style="float:left">';
						$options = array(
							'1' => 'Pracovn� neschopnost',
							'2' => 'Trval� n�sledky',
							'3' => 'Invalidita',
							'4' => 'Smrt n�sledkem �razu',
							'5' => 'Pobyt v nemocnici',
							
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
					V��e pojistn�ho
				</td>
				<td>
					<?php 
					echo '<div style="float:left">';
						echo form_input('newLifePrice',$newAgreementUser['userPrice'],'class="myTextArea" id="newLifePrice" style="width:100px"'); 
						$options = array(
							'Eur' => 'Eur',
							'K�' => 'K�',
						);
						echo form_dropdown('newLifeCurrency',$options, $newAgreementUser['userCurrency'] ,'class="myTextArea" style="width:70px" id="newLifeCurrency"'); 
					echo '</div>';?> 
					<p style="color: red; float:left; margin-top: 6px; margin-left:10px; font-weight: bold;">
						<?php echo $newAgreementUser['errorMessagePrice']?>
					</p>
				</td>
			</tr>
			<tr>
                <td>
					Platnost od | do
                </td>
                <td>					
					<?php 					
						echo '<div class="button-group" style="float:left">';
							echo form_input('newLifeDateFrom',date('d.m.Y'),'class="myTextAreaNoEdit" readonly style="width:100px; float:left" id="newLifeDateFrom"'); 
							echo form_input('newLifeDateTo',$newAgreementUser['userDateTo'],'class="myTextAreaNoEdit" readonly style="width:100px; float:left; margin-left:5px" id="newLifeDateTo"');
							echo '<a class="button" style="float:left; margin-left:5px; width:80px; height: 28px" id="newUserOneYear"><span id="spanOne">Jeden rok<span></a>';
							echo '<a class="button" style="float:left; margin-left:5px; width:75px; height: 28px" id="newUserTwoYear"><span id="spanTwo">Dva roky<span></a>';
							echo '<a class="button" style="float:left; margin-left:5px; width:75px; height: 28px" id="newUserTreeYear"><span id="spanTree">Tri roky<span></a>';
						echo '</div>';
					?>	
					<p style="color: red; float:left; margin-top: 6px; margin-left:10px; font-weight: bold;">
						<?php echo $newAgreementUser['errorMessageDateTo']?>
					</p>
                </td>				
			</tr>
			<tr>
                <td>
					Frekvence plateb
                </td>
                <td>					
					<?php $options2 = array(
						'1' => 'M�s��n�',
						'2' => '�tvrtletn�',
						'3' => 'Pololetn�',
						'4' => 'Ro�n�'
					);
					echo form_dropdown('newLifeFrequency', $options2, $newAgreementUser['userFrequency'] , 'class="myTextArea" style="width:120px" id="newLifeFrequency"');	?>					
                </td>				
			</tr>
		</table>
		
		<div class="div_lane" style="margin-top:230px;"></div>
		<?php echo '<div class="button-group" style="float:left; margin-top:15px; margin-left: 15px">'; ?>
			<a href="<?php echo base_url('Admin/redirectChooseNewAgreement/0')?>" onclick="" class="button" id="newUserTrace">Zp�t</a>
			<a href="<?php echo base_url('Admin/redirectChooseNewAgreement/1')?>" onclick="" class="button" id="newUserTrace">Vy�istit</a>
			<?php echo form_submit('newLifeTrace', 'Ulo�it', 'class="button"')?>
		</div>
		<?php 
			echo form_close();
		?>
    </div>

 <?php
    $this->load->helper('footer');
} else {
    echo "error, neplatn� privil�gia";
}
