<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ($this->session->userdata('permisson')==4) {
    $this->load->helper('header');
    showHeader();
    $this->load->helper('menu');
    showMenuAdviser();
	$this->load->helper('vypis_helper');
	?>
	
	<script>
		$(document).ready(function(){
			$("#menuInvoices").css("background-color", "#00B4D7");
			$("#menuInvoicesW").css("color", "white");
		});
	</script>
	<style>
		tr:hover td{
			background-color: #00B4D7 !important;
			color: white;
			cursor: pointer;
		}
	</style><?php echo $headline; 
		if ($this->uri->segment(5) == ''){
			$uri_segment = '0';
		} else {
			$uri_segment = $this->uri->segment(5);
		}
	echo '<div>';
		echo '<table class="list_table" style="margin-top: -14px; border-bottom: 1px solid #D0D0D0">';
			echo '<thead style="background-color:#00B4D7; color: white; border-bottom: 1px solid #D0D0D0;">';
				echo '<tr>';
    				echo '<td style="padding-left:15px; width:220px;">';
						if ($this->uri->segment(3) == 1) {
							if ($this->uri->segment(4) == 1) {
								echo '<a style="color:white" href="'.base_url('Adviser/redirectAllInvoices/1/2/'.$uri_segment).'"><b>KOD SMLOUVY</b></a>';
							} else {
								echo '<a style="color:white" href="'.base_url('Adviser/redirectAllInvoices/1/1/'.$uri_segment).'"><b>KOD SMLOUVY</b></</a>';
							}					
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllInvoices/1/'.$this->uri->segment(4).'/'.$uri_segment).'">KOD SMLOUVY</a>';
						}
    				echo '</td>';
					echo '<td style="width:120px">';
						if ($this->uri->segment(3) == 2) {
						if ($this->uri->segment(4) == 1) {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllInvoices/2/2/'.$uri_segment).'"><b>Č. SEKVENCE</b></</a>';
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllInvoices/2/1/'.$uri_segment).'"><b>Č. SEKVENCE</b></</a>';
						}					
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllInvoices/2/'.$this->uri->segment(4).'/'.$uri_segment).'">Č. SEKVENCE</a>';
						}
    				echo '</td>';
    				echo '<td style="width:160px">';
						if ($this->uri->segment(3) == 3) {
							if ($this->uri->segment(4) == 1) {
								echo '<a style="color:white" href="'.base_url('Adviser/redirectAllInvoices/3/2/'.$uri_segment).'"><b>TYP POISTENIA</b></</a>';
							} else {
								echo '<a style="color:white" href="'.base_url('Adviser/redirectAllInvoices/3/1/'.$uri_segment).'"><b>TYP POISTENIA</b></</a>';
							}					
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllInvoices/3/'.$this->uri->segment(4).'/'.$uri_segment).'">TYP POISTENIA</a>';
						}	
    				echo '</td>';
    				echo '<td style="width:180px">';
						if ($this->uri->segment(3) == 4) {
							if ($this->uri->segment(4) == 1) {
								echo '<a style="color:white" href="'.base_url('Adviser/redirectAllInvoices/4/2/'.$uri_segment).'"><b>KOD POISTENIA</b></</a>';
							} else {
								echo '<a style="color:white" href="'.base_url('Adviser/redirectAllInvoices/4/1/'.$uri_segment).'"><b>KOD POISTENIA</b></</a>';
							}					
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllInvoices/4/'.$this->uri->segment(4).'/'.$uri_segment).'">KOD POISTENIA</a>';
						}
    				echo '</td>';
					echo '<td style="text-align:left;width:170px; padding-left:45px">';
						if ($this->uri->segment(3) == 5) {
							if ($this->uri->segment(4) == 1) {
								echo '<a style="color:white" href="'.base_url('Adviser/redirectAllInvoices/5/2/'.$uri_segment).'"><b>OBDOBIE</b></</a>';
							} else {
								echo '<a style="color:white" href="'.base_url('Adviser/redirectAllInvoices/5/1/'.$uri_segment).'"><b>OBDOBIE</b></</a>';
							}					
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllInvoices/5/'.$this->uri->segment(4).'/'.$uri_segment).'">OBDOBIE</a>';
						}
    				echo '</td>';
    				echo '<td style="text-align:center; width:140px">';
						if ($this->uri->segment(3) == 6) {
							if ($this->uri->segment(4) == 1) {
								echo '<a style="color:white" href="'.base_url('Adviser/redirectAllInvoices/6/2/'.$uri_segment).'"><b>CENA</b></</a>';
							} else {
								echo '<a style="color:white" href="'.base_url('Adviser/redirectAllInvoices/6/1/'.$uri_segment).'"><b>CENA</b></</a>';
							}					
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllInvoices/6/'.$this->uri->segment(4).'/'.$uri_segment).'">CENA</a>';
						}
    				echo '</td>';
    				echo '<td style="text-align:left;width:400px; padding-left:20px;">';
						if ($this->uri->segment(3) == 7) {
							if ($this->uri->segment(4) == 1) {
								echo '<a style="color:white" href="'.base_url('Adviser/redirectAllInvoices/7/2/'.$uri_segment).'"><b>UHRAZENO</b></</a>';
							} else {
								echo '<a style="color:white" href="'.base_url('Adviser/redirectAllInvoices/7/1/'.$uri_segment).'"><b>UHRAZENO</b></</a>';
							}					
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllInvoices/7/'.$this->uri->segment(4).'/'.$uri_segment).'">UHRAZENO</a>';
						}
    				echo '</td>';
				echo '</tr>';
			echo '</thead>';
			echo '<tbody>';
			$counts = 0;
			foreach($bills as $bill){
				$counts = $counts+1;
				?><tr onclick="document.location = '<?php echo base_url('PdfMaker/showBill/'.$bill->BILL_ID) ?>';"><?php
					echo '<td style="padding-left:15px;">';
						echo $bill->BILL_CODE;
					echo '</td>';
					echo '<td style="text-align:right; padding-right:85px;">';
						echo $bill->BILL_SEQUENCE.'.';
					echo '</td>';
					echo '<td>';
						if ($bill->BILL_AGREEMENT_TYPE=="L"){
							echo 'Životní pojištení';
						} else {
							echo 'Cestovní pojištení';
						};
					echo '</td>';
					echo '<td>';
						echo $bill->BILL_AGREEMENT_CODE;
						/*echo getAgreementCode($bill->BILL_AGREEMENT_TYPE, $bill->BILL_AGREEMENT_ID);*/
					echo '</td>';
					echo '<td>';						
						if ($bill->BILL_AGREEMENT_TYPE=="L"){
							if (intval($bill->BILL_SEQUENCE)==1){
								$agreement = getLifeAgreement($bill->BILL_AGREEMENT_ID);
								echo (date("d.m.Y",strtotime($agreement->LIFE_DATE_FROM))).' - 05.'.date("m.Y",strtotime($bill->BILL_DATE_CREATE));
							} else {
								$firstDate = new DateTime(date("Y-m-d",strtotime($bill->BILL_DATE_CREATE)));
								$secondDate = date("Y-m-d", strtotime('+1 month', strtotime($firstDate->format("Y-m-d"))));
								echo '06.'.(date("m.Y",strtotime($firstDate->format("Y-m-d")))).' - 05.'.date("m.Y",strtotime($secondDate));
							}
						} else {
							echo getTravelFromTo($bill->BILL_AGREEMENT_ID);
						};
					echo '</td>';
					echo '<td style="text-align:right; padding-right:45px">';
						if ($bill->BILL_PAY_CURRENCY=='Kč'){
							echo $bill->BILL_PAY_PRICE.',00 <span style="padding-right:4px">Kč</span>';
						} else {
							echo $bill->BILL_PAY_PRICE.',00 Eur';
						};
					echo '</td>';
					echo '<td style="padding-left:20px">';
						if ($bill->BILL_PAY_DONE=='N'){
							echo '<span style="color: darkred"><b>neuhrazeno</b></span>';
						} else {
							echo '<span style="color: darkgreen"><b>uhrazeno</b></span>';
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
	if  ($this->session->userdata('billsDefaultWhere')!='(1=1)'){
		?>
		<div class="button-group">
			<a href="<?php echo base_url('Adviser/clearBillsFilter/'.$this->uri->segment(3).'/'.$this->uri->segment(4))?>" onclick="" class="button" style="margin-left:15px;margin-top:-28px" id="newUserTrace">Zrušení vyhledání faktúry</a>
			<a href="<?php echo base_url('Adviser/redirectFindInvoice')?>" onclick="" class="button" style="margin-left:176px;margin-top:-28px" id="newUserTrace">Nové vyhledání faktúry</a>
		</div>
		<?php
	} else {
		?>
		<div class="button-group">
			<a href="<?php echo base_url('Adviser/redirectFindInvoice')?>" onclick="" class="button" style="float:left; margin-left:15px;margin-top:-28px" id="newUserTrace">Vyhledání faktúry</a>
		</div>
		<?php
	};	
    echo '</div>';		
    echo '</div>';
	echo form_close();
    $this->load->helper('footer');
} else {
    echo "error, neplatné privilégia";
}
