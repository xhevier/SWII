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
			
			if($('#newLifeName').val()!=''){
				/*Výše pojistného*/
				$("#newLifePrice").prop("readonly", false);
				$("#newLifePrice").removeClass("myTextAreaNoEdit");
				$("#newLifePrice").addClass("myTextArea");
				/*Mena*/
				$("#newLifeCurrency").prop("readonly", false);
				$("#newLifeCurrency").removeClass("myTextAreaNoEdit");
				$("#newLifeCurrency").addClass("myTextArea");
				/*Frekvence plateb*/
				$("#newLifeFrequency").prop("readonly", false);
				$("#newLifeFrequency").removeClass("myTextAreaNoEdit");
				$("#newLifeFrequency").addClass("myTextArea");	
				$("#newUserOneYear").css("background-color", "white");
				$("#newUserTwoYear").css("background-color", "white");
				$("#newUserTreeYear").css("background-color", "white");
				$("#spanOne").html("Jeden rok");
				$("#spanTwo").html("Dva roky");
				$("#spanTree").html("Tri roky");
			}else {
				/*Výše pojistného*/
				$("#newLifePrice").prop("readonly", true);
				$("#newLifePrice").removeClass("myTextArea");
				$("#newLifePrice").addClass("myTextAreaNoEdit");
				/*Mena*/
				$("#newLifeCurrency").prop("readonly", true);
				$("#newLifeCurrency").removeClass("myTextArea");
				$("#newLifeCurrency").addClass("myTextAreaNoEdit");

				/*Frekvence plateb*/
				$("#newLifeFrequency").prop("readonly", true);
				$("#newLifeFrequency").removeClass("myTextArea");
				$("#newLifeFrequency").addClass("myTextAreaNoEdit");
				$("#newLifeFrequency").val('');
				$("#newLifeDateFrom").val('');
				$("#newLifeCurrency").val('');
				$("#newUserOneYear").css("background-color", "#f9f9f9");
				$("#newUserTwoYear").css("background-color", "#f9f9f9");
				$("#newUserTreeYear").css("background-color", "#f9f9f9");
				$("#spanOne").html(" ");
				$("#spanTwo").html(" ");
				$("#spanTree").html(" ");
			};
			
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
	
    <h1>Založení životního pojištení</h1>
	<?php echo form_open('Admin/newLifeAgreement')?>
    <div>
         <table class="form_table">  
			<tr>
				<td>
					Rodné číslo
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
					Titul, jméno a příjmení
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
					Věk
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
					Doložení lékařské zprávy
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
					Výše pojistného
				</td>
				<td>
					<?php 
					echo '<div style="float:left">';
						echo form_input('newLifePrice',$newAgreementUser['userPrice'],'class="myTextArea" id="newLifePrice" style="width:100px"'); 
						$options = array(
							'Eur' => 'Eur',
							'Kč' => 'Kč',
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
						'1' => 'Měsíčně',
						'2' => 'Čtvrtletně',
						'3' => 'Pololetně',
						'4' => 'Ročně'
					);
					echo form_dropdown('newLifeFrequency', $options2, $newAgreementUser['userFrequency'] , 'class="myTextArea" style="width:120px" id="newLifeFrequency"');	?>					
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
