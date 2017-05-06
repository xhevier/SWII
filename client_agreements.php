<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ($this->session->userdata('permisson')==5) {
    $this->load->helper('header');
    showHeader();
    $this->load->helper('menu');
    showMenuClient(); 
	$this->load->helper('vypis');
	$this->load->helper('agreement_helper');
	?>
    
	<script>
		$(document).ready(function(){
			$("#menuAgreements").css("background-color", "#00B4D7");
			$("#menuAgreementsW").css("color", "white");
		});							
	</script>
	<?php
		if ($user->ADRESS_STATE==1){
			$state="Česká republika";
		} else {
			$state="Slovenská republika";
		}
		
		if ($user->BANK_IBAN == NULL OR $user->BANK_IBAN==''){
			$iban = "nevyplnené";
		} else {
			$iban = $user->BANK_IBAN;
		}
	?>
	<h1> Pojištěnec a smlouvy</h1>
	<div style="margin-left:15px; width:400px; float: left">
		<p><b>Titul, meno a priezvisko: </b><span style="margin-left:10px"><?php echo $user->USER_TITLE.' '.$user->USER_FNAME.' '.$user->USER_LNAME ?></span></p>
		<p><b>Rodné číslo: </b><span style="margin-left:87px"><?php echo $user->USER_PIN ?></span></p>
		<p><b> &nbsp </b> </p>
		<p><b>Mobilný telefón: </b><span style="margin-left:63px"><?php echo $user->USER_MNUMBER ?></span></p>
		<p><b>E-mail: </b><span style="margin-left:120px"><?php echo $user->USER_EMAIL ?></span></p>
	</div>
	
	<div style="margin-left:15px; width:250px; float: left">
		<p><b>Ulica: </b><span style="margin-left:49px"><?php echo $user->ADRESS_STREET.' '.$user->ADRESS_NUMBER ?></span></p>
		<p><b>Mesto: </b><span style="margin-left:42px"><?php echo $user->ADRESS_CITY ?></span></p>
		<p><b>PSČ: </b><span style="margin-left:55px"><?php echo $user->ADRESS_POST ?></span></p>
		<p><b>Štát: </b><span style="margin-left:54px"><?php echo $state ?></span></p>
	</div>
	
	<div style="margin-left:15px; width:500px; float: left">
		<p><b>Registrován od: </b><span style="margin-left:62px"><?php echo date("d.m.Y",strtotime($user->USER_CREATE_DATE)) ?></span></p>
		<p><b>Číslo bankovního účtu: </b><span style="margin-left:18px"><?php echo $user->BANK_NUMBER ?></span></p>
		<p><b>Kód banky</b><span style="margin-left:99px"><?php echo '('.$user->BANK_CODE.') '.$user->BANK_NAME ?></span></p>
		<p><b>IBAN: </b><span style="margin-left:125px"><?php echo $iban ?></span></p>
	</div>
	<div class="div_lane" style="float:left; margin-top:15px">
	</div>
	<div style="width:100%; background-color:white; height:115px; float:left">
			<div class="divBlocksName" style="margin-right:30px; width:90px; font-size:10px; ">
				<?php 
				if ($user->USER_ACCEPT_PDF=='A'){
					$this->load->helper('agreement_helper');
					$formatted_user_id=getCorrectID($user->USER_ID);
					echo '<b style="margin-left:13px">ZPZ</b>'.$formatted_user_id.''.substr($user->HIRE_FROM,0,4).''.substr($user->HIRE_FROM,5,2).''.substr($user->HIRE_FROM,8,2); ?>
					<a id="icon1" href="<?php echo base_url('PdfMaker/clientAgreementDefaultPDF/'.$user->USER_ID) ?>">
						<img border="0" width="80" style="margin-left:25px; margin-top:5px" src="<?php echo base_url("images/pdf_icon.png")?>">
					</a><?php
				} else {
					$this->load->helper('agreement_helper');
					$formatted_user_id=getCorrectID($user->USER_ID);
					echo '<b style="margin-left:13px">ZPZ</b>'.$formatted_user_id.''.substr($user->HIRE_FROM,0,4).''.substr($user->HIRE_FROM,5,2).''.substr($user->HIRE_FROM,8,2); ?>
					<span style="cursor: pointer" onclick="alertShowPdf();">				
						<img border="0" id="employee_agreement" onclick="alertShowPdf();" width="80" style="margin-left:25px; margin-top:5px" src="<?php echo base_url("images/pdf_icon_acc.png")?>">
					</a><?php
				} 
				echo '</div>';	
				if ($user->USER_PLATNA=='N') { 
				$this->load->helper('agreement_helper');
				$formatted_user_id=getCorrectID($user->USER_ID);
				?>				
				<div class="divBlocksName" style="margin-right:30px; width:92px;font-size:10px;">
					<?php echo '<b style="margin-left:13px">ZPD</b>'.$formatted_user_id.''.substr($user->HIRE_FROM,0,4).''.substr($user->HIRE_FROM,5,2).''.substr($user->HIRE_FROM,8,2); ?>
					<a href="<?php echo base_url('PdfMaker/clientAgreementDeletedPDF/'.$user->USER_ID) ?>">
						<img border="0" width="80" style="margin-left:25px; margin-top:5px;" src="<?php echo base_url("images/pdf_icon.png")?>">
					</a>
				</div>
			<?php } ?>
	</div>	
	<div class="div_lane" style="float:left;">
	</div>
	<div style="width:100%; background-color:white; height:479px; float:left">
		<?php
		if ($agreements != false) {			
					foreach ($agreements as $agreement) {
							?>
							<div style="display:inline-block; margin-top:10px">
								<div style="margin-right:30px; width:90px; font-size:10px;"><?php 
								if ($agreement->AGREEMENT_TYPE=='L'){
									if ($agreement->AGREEMENT_PLATNA=='A'){
										echo '<span style="margin-left:13px">'.$agreement->AGREEMENT_CODE.'</span>'; ?>
										<a href="<?php echo base_url('PdfMaker/employeeAgreementLifeDefault/'.$user->USER_ID.'/'.$agreement->AGREEMENT_ID) ?>">
											<img border="0" width="80" style="margin-left:28px; margin-top:5px" src="<?php echo base_url("images/form.png")?>">
										</a> <?php
									} else {
										echo '<span style="margin-left:13px"><span style="color:red">'.$agreement->AGREEMENT_CODE.'</span></span>'; ?>
										<a href="<?php echo base_url('PdfMaker/employeeAgreementLifeDefault/'.$user->USER_ID.'/'.$agreement->AGREEMENT_ID) ?>">
											<img border="0" width="80" style="margin-left:28px; margin-top:5px" src="<?php echo base_url("images/form.png")?>">
										</a> <?php
									}
								} else {
									if ($agreement->AGREEMENT_PLATNA=='A'){
										echo '<span style="margin-left:13px">'.$agreement->AGREEMENT_CODE.'</span>'; ?>
										<a href="<?php echo base_url('PdfMaker/employeeAgreementTravelDefault/'.$user->USER_ID.'/'.$agreement->AGREEMENT_ID) ?>">
											<img border="0" width="80" style="margin-left:28px; margin-top:5px" src="<?php echo base_url("images/form.png")?>">
										</a> <?php
									} else {
										echo '<span style="margin-left:13px"><span style="color:red">'.$agreement->AGREEMENT_CODE.'</span></span>'; ?>
										<a href="<?php echo base_url('PdfMaker/employeeAgreementTravelDefault/'.$user->USER_ID.'/'.$agreement->AGREEMENT_ID) ?>">
											<img border="0" width="80" style="margin-left:28px; margin-top:5px" src="<?php echo base_url("images/form.png")?>">
										</a> <?php
									}
								}	
									
								?>	
								</div>
							</div><?php
						}
					}										
			?>
	</div>

    <?php echo form_close();
    $this->load->helper('footer');
} else {
    echo "error, neplatné privilégia";
}



			
			