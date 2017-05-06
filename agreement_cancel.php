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

    <h1>Smlouva o zrušení</h1>
<?php echo form_open('Adviser/CancelAgreement')?>

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
						<?php /*<a href="<?php echo base_url('Adviser/getUserTrace/1/0')?>" onclick="" class="button" style="float:left; margin-left:5px" id="newUserTrace">Dohledat</a>	*/?>						
					</div>
					<p style="color: red; float:left; margin-top: 6px; margin-left:10px; font-weight: bold;">
					</p>
				</td>  
    <div>
			<tr>
				<td style="color: grey">
					Titul, jméno a příjmení
				</td>
				<td> 
			         <?php echo form_input('newLifeName',$newAgreementUser['userName'],'class="myTextAreaNoEdit" readonly id="newLifeName"'); ?> 
				</td>
			</tr>
      <tr>
          <td width="200">
              Číslo pojistné smlouvy
          </td>
          <td>
             <?php 
             	echo form_input('NewNumber',$newAgreementUser['NewNumber'],'class="myTextAreaNoEdit" readonly id="newLifeName"'); ?> 
          </td>                
      </tr>
    <tr>
<tr>
                <td>
	Zrušení platnosti smlouvy od 
                </td>
                <td>					
					<?php 					
						echo '<div class="button-group" style="float:left">';
							echo form_input('newLifeDateFrom',date('d.m.Y'),'class="myTextAreaNoEdit" style="width:100px; float:left" id="newLifeDateFrom"'); 
							echo form_input('newLifeDateTo',$newAgreementUser['userDateTo'],'class="myTextAreaNoEdit" style="width:100px; float:left; margin-left:5px" id="newLifeDateTo"');
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
</table>

<div class="div_lane" style="margin-top:230px;">
		<div class="button-group" style="float:left; margin-top:15px; margin-left: 15px">
			<a href="<?php echo base_url('Adviser/redirectChooseNewAgreement/0')?>" onclick="" class="button" id="newUserTrace">Zpět</a>
			<a href="<?php echo base_url('Adviser/redirectChooseNewAgreement/1')?>" onclick="" class="button" id="newUserTrace">Vyčistit</a>
			<?php echo form_submit('newLifeTrace', 'Uložit', 'class="button"')?>
		</div>
    </div>
		<?php 
			echo form_close();
		?>
    </div>

 <?php
    $this->load->helper('footer');
} else {
    echo "error, neplatné privilegia";
}
