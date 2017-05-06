<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ($this->session->userdata('permisson')==4) {
$this->load->helper('header');
showHeader();
$this->load->helper('menu');
showMenuAdviser(); 
$this->load->helper('validation_helper');
	?>	
	<script>
		$(document).ready(function(){
			$("#menuAgreements").css("background-color", "#00B4D7");
			$("#menuAgreementsW").css("color", "white");
		});	
	</script>
	
	<style>
		tr:hover td{
			background-color: #00B4D7 !important;
			color: white;
			cursor: pointer;
		}
	</style><?php echo $headline; ?>
	
    <div><?php
			if ($this->uri->segment(5) == ''){
				$uri_segment = '0';
			} else {
				$uri_segment = $this->uri->segment(5);
			}
    		echo '<table class="list_table" style="margin-top: -14px; border-bottom: 1px solid #D0D0D0">';
    		echo '<thead style="background-color:#00B4D7; color: white; border-bottom: 1px solid #D0D0D0;">';
    			echo '<tr>';
    				echo '<td style="padding-left:45px; width:235px">';
						if ($this->uri->segment(3) == 1) {
							if ($this->uri->segment(4) == 1) {
								echo '<a style="color:white" href="'.base_url('Adviser/redirectAllAgreements/1/2/'.$uri_segment).'"><b>ID SMLOUVY</b></a>';
							} else {
								echo '<a style="color:white" href="'.base_url('Adviser/redirectAllAgreements/1/1/'.$uri_segment).'"><b>ID SMLOUVY</b></</a>';
							}					
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllAgreements/1/'.$this->uri->segment(4).'/'.$uri_segment).'">ID SMLOUVY</a>';
						}
    				echo '</td>';
					echo '<td>';
						if ($this->uri->segment(3) == 2) {
						if ($this->uri->segment(4) == 1) {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllAgreements/2/2/'.$uri_segment).'"><b>TYP</b></</a>';
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllAgreements/2/1/'.$uri_segment).'"><b>TYP</b></</a>';
						}					
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllAgreements/2/'.$this->uri->segment(4).'/'.$uri_segment).'">TYP</a>';
						}
    				echo '</td>';
    				echo '<td>';
						if ($this->uri->segment(3) == 3) {
							if ($this->uri->segment(4) == 1) {
								echo '<a style="color:white" href="'.base_url('Adviser/redirectAllAgreements/3/2/'.$uri_segment).'"><b>KLIENT</b></</a>';
							} else {
								echo '<a style="color:white" href="'.base_url('Adviser/redirectAllAgreements/3/1/'.$uri_segment).'"><b>KLIENT</b></</a>';
							}					
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllAgreements/3/'.$this->uri->segment(4).'/'.$uri_segment).'">KLIENT</a>';
						}	
    				echo '</td>';
    				echo '<td>';
						if ($this->uri->segment(3) == 4) {
							if ($this->uri->segment(4) == 1) {
								echo '<a style="color:white" href="'.base_url('Adviser/redirectAllAgreements/4/2/'.$uri_segment).'"><b>VYTVOŘIL</b></</a>';
							} else {
								echo '<a style="color:white" href="'.base_url('Adviser/redirectAllAgreements/4/1/'.$uri_segment).'"><b>VYTVOŘIL</b></</a>';
							}					
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllAgreements/4/'.$this->uri->segment(4).'/'.$uri_segment).'">VYTVOŘIL</a>';
						}
    				echo '</td>';
					echo '<td style="text-align:right;">';
						if ($this->uri->segment(3) == 5) {
							if ($this->uri->segment(4) == 1) {
								echo '<a style="color:white; padding-left:15px" href="'.base_url('Adviser/redirectAllAgreements/5/2/'.$uri_segment).'"><b>CENA</b></</a>';
							} else {
								echo '<a style="color:white; padding-left:15px" href="'.base_url('Adviser/redirectAllAgreements/5/1/'.$uri_segment).'"><b>CENA</b></</a>';
							}					
						} else {
							echo '<a style="color:white; padding-left:15px" href="'.base_url('Adviser/redirectAllAgreements/5/'.$this->uri->segment(4).'/'.$uri_segment).'">CENA</a>';
						}
    				echo '</td>';
					echo '<td>';
					echo '</td>';
    				echo '<td style="text-align:center">';
						if ($this->uri->segment(3) == 6) {
							if ($this->uri->segment(4) == 1) {
								echo '<a style="color:white" href="'.base_url('Adviser/redirectAllAgreements/6/2/'.$uri_segment).'"><b>DATUM PLATNOSTI OD</b></</a>';
							} else {
								echo '<a style="color:white" href="'.base_url('Adviser/redirectAllAgreements/6/1/'.$uri_segment).'"><b>DATUM PLATNOSTI OD</b></</a>';
							}					
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllAgreements/6/'.$this->uri->segment(4).'/'.$uri_segment).'">DATUM PLATNOSTI OD</a>';
						}
    				echo '</td>';
    				echo '<td style="text-align:center">';
						if ($this->uri->segment(3) == 7) {
							if ($this->uri->segment(4) == 1) {
								echo '<a style="color:white" href="'.base_url('Adviser/redirectAllAgreements/7/2/'.$uri_segment).'"><b>PŘIHLÁŠEN UŽIV.</b></</a>';
							} else {
								echo '<a style="color:white" href="'.base_url('Adviser/redirectAllAgreements/7/1/'.$uri_segment).'"><b>PŘIHLÁŠEN UŽIV.</b></</a>';
							}					
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllAgreements/7/'.$this->uri->segment(4).'/'.$uri_segment).'">PŘIHLÁŠEN UŽIV.</a>';
						}
    				echo '</td>';
    				echo '<td style="text-align:center">';
						if ($this->uri->segment(3) == 8) {
							if ($this->uri->segment(4) == 1) {
								echo '<a style="color:white" href="'.base_url('Adviser/redirectAllAgreements/8/2/'.$uri_segment).'"><b>PLATNOSŤ POJIŠTENÍ</b></</a>';
							} else {
								echo '<a style="color:white" href="'.base_url('Adviser/redirectAllAgreements/8/1/'.$uri_segment).'"><b>PLATNOSŤ POJIŠTENÍ</b></</a>';
							}					
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllAgreements/8/'.$this->uri->segment(4).'/'.$uri_segment).'">PLATNOSŤ POJIŠTENÍ</a>';
						}
					echo '</td>';
    			echo '</tr>';				
    		echo '</thead>';
    		echo '<tbody>';
			$counts = 0;
			foreach($agreements as $agreement){
						$counts = $counts+1;
						if ($agreement->AGREEMENT_TYPE == 'L') {
							if ($agreement->AGREEMENT_PLATNA=='A'){
								?> <tr onclick="document.location = '<?php echo base_url('Adviser/redirectEditLifeAgreement/'.$agreement->AGREEMENT_ID) ?>';"><?php
							} else if ($agreement->AGREEMENT_PLATNA=='S') {
								?> <tr style="color:#d7d7d7; text-decoration: line-through;" onclick="document.location = '<?php echo base_url('Adviser/redirectEditLifeAgreement/'.$agreement->AGREEMENT_ID) ?>';"><?php
							} else if ($agreement->AGREEMENT_PLATNA=='N') {
								?> <tr style="color:#d7d7d7;" onclick="document.location = '<?php echo base_url('Adviser/redirectEditLifeAgreement/'.$agreement->AGREEMENT_ID) ?>';"><?php
							}
						} else {
							if ($agreement->AGREEMENT_PLATNA=='A'){
								?> <tr onclick="document.location = '<?php echo base_url('Adviser/redirectEditTravelAgreement/'.$agreement->AGREEMENT_ID) ?>';"><?php
							} else if ($agreement->AGREEMENT_PLATNA=='S') {
								?> <tr style="color:#d7d7d7; text-decoration: line-through;" onclick="document.location = '<?php echo base_url('Adviser/redirectEditTravelAgreement/'.$agreement->AGREEMENT_ID) ?>';"><?php
							} else if ($agreement->AGREEMENT_PLATNA=='N') {
								?> <tr style="color:#d7d7d7;" onclick="document.location = '<?php echo base_url('Adviser/redirectEditTravelAgreement/'.$agreement->AGREEMENT_ID) ?>';"><?php
							}
						}						
					echo '<td style="padding-left:45px; width:235px">';
						$user_id=getUserIdForAgreement($agreement->AGREEMENT_USER_ID);
						echo $agreement->AGREEMENT_CODE;
						/*if ($agreement->AGREEMENT_TYPE == 'L') {
							echo '<b>ZLP</b>'.$user_id.substr($agreement->AGREEMENT_DATE_FROM,0,4).substr($agreement->AGREEMENT_DATE_FROM,5,2).substr($agreement->AGREEMENT_DATE_FROM,8,2);
						} else {
							echo '<b>ZCP</b>'.$user_id.substr($agreement->AGREEMENT_DATE_FROM,0,4).substr($agreement->AGREEMENT_DATE_FROM,5,2).substr($agreement->AGREEMENT_DATE_FROM,8,2);
						}*/
					echo '</td>';
					echo '<td style="width:200px">';
						if ($agreement->AGREEMENT_TYPE == 'L') {
							echo 'Životní pojištení';
						} else {
							echo 'Cestovní pojištení';
						}
					echo '</td>';
					echo '<td style="width:220px">';
						echo getClientNameById($agreement->AGREEMENT_USER_ID);
					echo '</td>';
					echo '<td style="width:200px">';
						echo getClientNameById($agreement->AGREEMENT_CREATE_USER);
					echo '</td>';
					echo '<td style="text-align:right;width:50px">';
						if ($agreement->AGREEMENT_CURRENCY=='1' OR $agreement->AGREEMENT_CURRENCY==1){
							echo $agreement->AGREEMENT_PRICE.' Kč&nbsp';
						} else if ($agreement->AGREEMENT_CURRENCY=='2' OR $agreement->AGREEMENT_CURRENCY==2){
							echo $agreement->AGREEMENT_PRICE.' Eur';
						} else {
							if ($agreement->AGREEMENT_CURRENCY=='Kč'){
								echo $agreement->AGREEMENT_PRICE.' '.$agreement->AGREEMENT_CURRENCY.'&nbsp';
							} else {
								echo $agreement->AGREEMENT_PRICE.' '.$agreement->AGREEMENT_CURRENCY;
							}
						}
					echo '</td>';
					echo '<td style=" width:20px">';						
					echo '</td>';
					echo '<td style="width:200px; text-align:center">';
						echo date('d.m.Y', strtotime($agreement->AGREEMENT_DATE_FROM));
					echo '</td>';
					echo '<td style="width:200px; text-align:center">';
						echo date('d.m.Y', strtotime($agreement->AGREEMENT_DATE_TO));
					echo '</td>';
					echo '<td style="width:200px; text-align:center">';
						if ($agreement->AGREEMENT_PLATNA=='A'){
							echo "Platné";
						} else if ($agreement->AGREEMENT_PLATNA=='S') {
							echo "Stornované";
						} else if ($agreement->AGREEMENT_PLATNA=='N') {
							echo "Zrušené";
						}
					echo '</td>';
				echo '</tr>';
			}
		echo '</table>';
		echo '<div class="pagination_links">';
		echo $this->pagination->create_links();
		echo '</div>';
	if ($counts<25){
		echo '<div style="margin-top:40px">';
	} else {
		echo '<div style="margin-top:0px">';
	}	
	if  ($this->session->userdata('agreementDefaultWhere')!='(1=1)'){
		?>
		<div class="button-group">
			<a href="<?php echo base_url('Adviser/resetAgreementFilter/'.$this->uri->segment(3).'/'.$this->uri->segment(4))?>" onclick="" class="button" style="margin-left:15px;margin-top:-28px" id="newUserTrace">Zrušení vyhledání smlouvy</a>
			<a href="<?php echo base_url('Adviser/findAgreement')?>" onclick="" class="button" style="margin-left:185px;margin-top:-28px" id="newUserTrace">Nové vyhledání smlouvy</a>
		</div>
		<?
	} else {
		?>
		<div class="button-group">
			<a href="<?php echo base_url('Adviser/findAgreement')?>" onclick="" class="button" style="float:left; margin-left:15px;margin-top:-28px" id="newUserTrace">Vyhledání smlouvy</a>
		</div>
		<?
	};
	?>
    </div> </div><?php
    $this->load->helper('footer');
} else {
    echo "error, neplatné privilégia";
}
