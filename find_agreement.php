﻿<?php
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
	
    <h1>Vyhledání zaměstnance</h1>

    <div>
    <?php echo form_open('Admin/findAgreement');

	?>
    
        <table class="form_table">            
            <tr>
                <td width="240">
                    <b>Vyhledávací pole</b> v sekci smluv:
                </td>
                <td>					               
					<?php echo '<div class="button-group">'; ?>	
						<?php echo form_input('findAgreementText',$input,'class="myTextArea" style="width:400px;float:left"'); ?>
						<?php echo form_submit('findagreementSubmit', 'Vyhledat smlouvu', 'class="button" style="margin-left:3px"')?>
					</div>
                </td>
                <td>
                </td>                
            </tr>
            <tr>
                <td>
					
				</td>
				<td>
					<p style="color: red; float:left; margin-top: 6px;">
						<?php echo $searchEmployeeError?>
					</p>
				</td>
            </tr>
		</table>
		<div class="div_lane" style="margin-top:15px; margin-bottom:5px"></div>
	<?php echo form_close();?>
		<table class="form_table">
			<tr>
                <td>
					Pro <b>konkretní</b> vyhledání smlouvy je možné použit jeden z nasledujícich postupov:
				</td>
			</tr>
			<tr>
				<td>
					<ul class="list_ul">
						<li> Zadanie <b>identifikačního čísla</b> smlouvy.
						<li> Zadanie <b>příjmení </b> klienta.
						<li> Zadanie <b>příjmení</b> zaměstnance který smlouvu vytvořtil.
						<li> Zadanie <b>ceny</b> smlouvy.
						<li> Zadanie <b>platnosti</b> smlouvy.
						<li> Zadanie <b>platnosti pojištení</b> smlouvy.
					<ul>
				</td>
			</tr>
		</table>
		<div class="div_lane" style="margin-top:15px; margin-bottom:5px"></div>
		<table class="form_table">
			<tr>
                <td>
					V případe, kdy neznáte konkrétní údaje zaměstnance, můžete zadat:
				</td>
			</tr>
			<tr>
				<td>
					<ul class="list_ul">
						<li> Libovolný reťazec s <b>prefixom</b> a <b>postfixom '%' </b>. Napríklad ( %admin% ) pro vyhledání všech reťazcov obsahujícich reťazec 'admin'.
						<li> Libovolný reťazec s <b>postfixom '%' </b>. Napríklad ( Ab% ) pro vyhledání všech reťazcov začinajících 'Ab'.
						<li> Libovolný reťazec s <b>prefixom '%' </b>. Napríklad ( %ová ) pro vyhledání všech reťazcov končícich 'ová'.
					<ul>
				</td>
			</tr>
		</table>
		<div class="div_lane" style="margin-top:15px; margin-bottom:5px"></div>
		<table class="form_table">
			<tr>
                <td>
					V případe, zadávaní dátumov:
				</td>
			</tr>
			<tr>
				<td>
					<ul class="list_ul">
						<li> Formát dátumu by měl být <b>DD.MM.YYYY</b>, DD/MM/YYYY</b> nebo <b>DD-MM-YYYY</b>. Při zadaní jiných formátov může dojít k chybě vy vyhledávaní.
					<ul>
				</td>
			</tr>
		</table>
		<div class="div_lane" style="margin-top:15px; margin-bottom:5px"></div>
		<table class="form_table">
			<tr>
                <td>
					Výsledky vyhledání:
				</td>
			</tr>
			<tr>
                <td>
					<ul class="list_ul">
						<li>V případe, kdy vyhledáni <b>nevráti ani jeden nájdený záznam</b>, systém vás informuje na tejto stránke.
						<li>V případe, kdy vyhledáni <b>vráti jenom jeden nájdený záznam</b>, budete automaticky přesměrován na <b>detail</b> smlouvy.
						<li>V případe, kdy vyhledáni <b>vráti více ako jeden nájdený záznam</b>, budete automaticky přesměrován na <b>seznam</b> smlouv.
					<ul>
				</td>
			</tr>
       </table>   
		<div class="div_lane" style="margin-top:15px; margin-bottom:5px"></div>
       
        
    </div>


    <?php echo form_close();
    $this->load->helper('footer');
} else {
    echo "error, neplatné privilégia";
}
