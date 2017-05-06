<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ($this->session->userdata('permisson')==0 OR $this->session->userdata('permisson')==1) {
$this->load->helper('header');
showHeader();
$this->load->helper('menu');
showMenuAdmin(); 
$this->load->helper('agreement_helper');

	?>	
	<script>
		$(document).ready(function(){
			$("#menuArator").css("background-color", "#00B4D7");
			$("#menuAratorW").css("color", "white");	
			$("#dialogRefresh").hide();
			$("#dialogArator").hide();
		});

		function alertRefresh(){
			$("#dialogRefresh").show();
		}
		
		function alertRefreshHide(){
			$("#dialogRefresh").hide();
		}	

		function alertArator(){
			$("#dialogArator").show();
		}
		
		function alertAratorHide(){
			$("#dialogArator").hide();
		}	

		function loading(){
			$("#changed").html('<img src="http://mendelupojistovna.studenthosting.sk/images/loading.gif" style="height:33px;margin-top:-10px; margin-bottom:-10px">');
			$("#thisDelete").html(' ');
		}
		
		function loadingAktual(){
			$("#changedAktual").html('<img src="http://mendelupojistovna.studenthosting.sk/images/loading.gif" style="height:33px;margin-top:-10px; margin-bottom:-10px">');
			$("#thisDeleteAktual").html(' ');
		}
			
	</script>
	
	<div id="dialogRefresh" class="dialogEmployee">
		<div style="margin-top:20px">
			<p><img src="<?php echo base_url('images/alert.png');?>" style="width:40px; height:40px; float: left; margin-left:235px"><span style="float:left; font-size:25px; margin-top:5px; margin-left:20px">Potvrdenie</span></p>
		</div>
		<div class="div_lane" style="margin-top:80px"></div>
		<div style="margin-top:15px; text-align:center" id="changedAktual">
			<p>Chystáte sa aktualizovať údaje ktoré vstupujú do výpočtu. Táto operácia môže trvať aj niekoľko minút.</p>
		</div>
		<div class="div_lane" style="margin-top:15px"></div>
		<div style=" text-align:center;">
			<div class="button-group" style="padding-top: 15px;" id="thisDeleteAktual">
				<a onclick="alertRefreshHide();" class="button">Nie, nechcem aktualizovať údaje</a>
				<a onclick="loadingAktual();" href="<? echo base_url('Arator/redirectDefaultArator/'); ?>" class="button">Rozumiem, chcem aktualizovať údaje</a>
			</div>
		</div>
	</div>
	
	<div id="dialogArator" class="dialogEmployee">
		<div style="margin-top:20px">
			<p><img src="<?php echo base_url('images/alert.png');?>" style="width:40px; height:40px; float: left; margin-left:235px"><span style="float:left; font-size:25px; margin-top:5px; margin-left:20px">Potvrdenie</span></p>
		</div>
		<div class="div_lane" style="margin-top:80px"></div>
		<div style="margin-top:15px; text-align:center" id="changed">
			<p>Chystáte sa aktualizovať údaje ktoré vstupujú do výpočtu. Táto operácia môže trvať aj niekoľko minút.</p>
		</div>
		<div class="div_lane" style="margin-top:15px"></div>
		<div style=" text-align:center;">
			<div class="button-group" style="padding-top: 15px;" id="thisDelete">
				<a onclick="alertAratorHide();" class="button">Nie, nechcem spustiť výpočet</a>
				<a onclick="loading();" href="<? echo base_url('Arator/generateArator/'); ?>" class="button">Rozumiem, chcem spustiť výpočet</a>
			</div>
		</div>
	</div>
	
	<h1 style="margin-bottom:0px">Arator - výpočet faktúr</h1>
	<div style="padding-left:15px; padding-top:15px; padding-bottom:15px; background-color:white">
		<table class="form_table">
            <tr>
                <td width="400">
                    <b>Štatistiky objektů které vstupují do výpočtu</b>
                </td>
            </tr>
		</table>
		<table class="form_table">
			<tr>
                <td width="185">
                    <b>Životní pojištení</b>
                </td>
            </tr>
			<tr>
                <td style="padding-left:10px">
                     Počet aktuálných záznamů: 
                </td> 
				<td>
                     <span style="color:darkgreen;"><b><?php echo POJ_T_AGREEMENT_LIFE() ?></b></span></p>
                </td> 
			</tr>
			<tr>
				<td style="padding-left:10px">
                     Z nich nových záznamů: 
                </td> 
				<td>
					<?php
						$countAgreements = getCountNewLifeAgreements(1);
						if($countAgreements==0){
							echo '<span style="color:darkgreen;"><b>'.$countAgreements.'</b></span></p>';
						} else {
							echo '<span style="color:orange;"><b>'.$countAgreements.'</b></span></p>';
						}
					?>
                </td> 
            </tr>
			<tr>
                <td>
                    <b>Cestovní pojištení</b>
                </td>
            </tr>
			<tr>
                <td style="padding-left:10px">
                     Počet aktuálných záznamů: 
                </td> 
				<td>
                     <span style="color:darkgreen;"><b><?php echo POJ_T_AGREEMENT_TRAVEL() ?></b></span></p>
                </td> 
			</tr>
			<tr>
				<td style="padding-left:10px">
                     Z nich nových záznamů: 
                </td> 
				<td>
                    <?php
						$countAgreements = getCountNewLifeAgreements(2);
						if($countAgreements==0){
							echo '<span style="color:darkgreen;"><b>'.$countAgreements.'</b></span></p>';
						} else {
							echo '<span style="color:orange;"><b>'.$countAgreements.'</b></span></p>';
						}
					?>
                </td> 
            </tr>
	</table>
	</div>
	<div class="div_lane" style="margin-top:0px"></div>
	<div class="button-group" style="padding-top: 15px; margin-left: 15px">
		<a onclick="alertRefresh();" class="button">Aktualizovat údaje</a>
		<a onclick="alertArator();" class="button">Spustit výpočet ručně</a>
	</div>

<?php 

	




	echo '</div>';
    $this->load->helper('footer');
} else {
    echo "error, neplatné privilégia";
}
