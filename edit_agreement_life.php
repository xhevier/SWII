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
		
			
			$("#newUserOneYear").click(function(){
				if ($('#newLifeName').val()!='') {
					var a = $("#newLifeDateFrom").val().substr(0,9);
					var b = Number($("#newLifeDateFrom").val().substr(9,1))+1;
					$("#newLifeDateTo").val(a.concat(b));
				};				
			});
			$("#newUserTwoYear").click(function(){
				if ($('#newLifeName').val()!='') {
					var a = $("#newLifeDateFrom").val().substr(0,9);
					var b = Number($("#newLifeDateFrom").val().substr(9,1))+2;
					$("#newLifeDateTo").val(a.concat(b));
				};				
			});
			$("#newUserTreeYear").click(function(){
				if ($('#newLifeName').val()!='') {
					var c = Number($("#newLifeDateFrom").val().substr(9,1))+3;
					if (c >= 10) {c=0;}
					$("#newLifeDateTo").val($("#newLifeDateFrom").val().substr(0,8).concat('2').concat(c));
				};				
			});
		});	
	</script>
	
    <h1>Editace žívotního pojištení</h1>
	<?php echo form_open('Admin/editLifeAgreement/'.$agreement->LIFE_ID)?>
    <div>
         <table class="form_table">  
			<tr>
				<td>
					Rodné číslo
				</td>
				<td width="1000px">					
					<div class="button-group" style="float:left">
						<?php echo form_input('newLifePIN',substr($user->USER_PIN,0,6).substr($user->USER_PIN,7,4),'class="myTextAreaNoEdit" readonly style="width:110px; float: left" id="newLifePIN"');?>			
					</div>
					<p style="color: red; float:left; margin-top: 6px; margin-left:10px; font-weight: bold;">
						<?php echo ''?>
					</p>
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Titul, jméno a příjmení
				</td>
				<td>
					<?php 
					echo form_input('newLifeName',$user->USER_TITLE.' '.$user->USER_FNAME.' '.$user->USER_LNAME,'class="myTextAreaNoEdit" readonly id="newLifeName"'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Datum narození
				</td>
				<td>
					<?php 
					echo form_input('newLifeBirthDate',substr($user->USER_PIN,4,2).'.'.substr($user->USER_PIN,2,2).'.19'.substr($user->USER_PIN,0,2),'class="myTextAreaNoEdit" readonly style="width:100px"'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Věk
				</td>
				<td>
					<?php 
					echo form_input('newLiveYears',round((((strtotime(date('d.m.Y')))-(strtotime(substr($user->USER_PIN,4,2).'.'.substr($user->USER_PIN,2,2).'.19'.substr($user->USER_PIN,0,2))))/60/60/24/365),0),'class="myTextAreaNoEdit" readonly style="width:40px"'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Trvalý pobyt
				</td>
				<td>
					<?php 
					echo form_input('newLiveAdress',$user->ADRESS_STREET.' '.$user->ADRESS_NUMBER.', '.$user->ADRESS_CITY,'class="myTextAreaNoEdit" readonly'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Stát
				</td>
				<td>
					<?php 
					echo form_input('newLiveState','('.$user->STATE_SHORT.') '.$user->STATE_NAME,'class="myTextAreaNoEdit" readonly'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Bankovní spojení
				</td>
				<td>
					<?php 
					echo form_input('newLiveBank',$user->BANK_NUMBER.'/'.$user->BANK_CODE.' ('.$user->BANK_NAME.')','class="myTextAreaNoEdit" readonly style="width:305px"'); ?> 
				</td>
			</tr>
			<tr>
				<td width="200px">
					&nbsp
				</td>						
			</tr>
			<tr>
				<td width="200px">
					Doložení lékařské zprávy
				</td>			
				<td>
					<label class="switch">
						  <input type="checkbox" name="newLifeDoctor" value="<?php echo ''?>">
						  <div class="slider round"></div>
					</label>
				</td>
			</tr>
			<tr>
				<td>
					Výše pojistného
				</td>
				<td>
					<?php 
					echo '<div style="float:left">';
						echo form_input('editLifePrice',$agreement->LIFE_PRICE,'class="myTextArea" id="newLifePrice" style="width:100px"'); 
						$options = array(
							'Eur' => 'Eur',
							'Kč' => 'Kč',
						);
						echo form_dropdown('editLifeCurrency',$options,$agreement->LIFE_CURRENCY,'class="myTextArea" style="width:70px" id="newLifeCurrency"'); 
					echo '</div>';?> 
					<p style="color: red; float:left; margin-top: 6px; margin-left:10px; font-weight: bold;">
						<?php echo ''?>
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
							echo form_input('newLifeDateFrom',date('d.m.Y',strtotime($agreement->LIFE_DATE_FROM)),'class="myTextAreaNoEdit" readonly style="width:100px; float:left" id="newLifeDateFrom"'); 
							echo form_input('newLifeDateTo',date('d.m.Y',strtotime($agreement->LIFE_DATE_TO)),'class="myTextAreaNoEdit" readonly style="width:100px; float:left; margin-left:5px" id="newLifeDateTo"');
						echo '</div>';
					?>	
					<p style="color: red; float:left; margin-top: 6px; margin-left:10px; font-weight: bold;">
						<?php echo ''?>
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
					echo form_dropdown('editLifeFrequency', $options2, $agreement->LIFE_FREQUENCY , 'class="myTextArea" style="width:120px" id="newLifeFrequency"');	?>					
                </td>				
			</tr>
		</table>
		
		<div class="div_lane" style="margin-top:230px;"></div>
		<?php echo '<div class="button-group" style="float:left; margin-top:15px; margin-left: 15px">'; ?>
			<a href="<?php echo base_url('Admin/redirectDetailUser/'.$agreement->LIFE_USER_ID)?>" onclick="" class="button" id="newUserTrace">Zpět</a>
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
