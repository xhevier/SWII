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
	
    <h1>Modul smlouvy</h1>

    <div>
        <table class="form_table">
			<tr>
                <td>
					V tomto modulu se nacházejí akce, které je možné vykonávat pouze s modulem poistných smlouv a je rozdělený do následujících submodulů:
				</td>
			</tr>
			<tr>
				<td>
					<ul class="list_ul">
						<li> Vyhledání smlouvy
						<li> Seznam smlouv
						<li> Vytvoření zaměstnace
						<li> Vytvoření pojistní smlouvy
						<ul style="margin-left:15px;">
							<li> Vytvoření životního pojištení
							<li> Vytvoření cestovního pojištení
							<li> Vytvoření důchodového pojištení
							<li> Vytvoření športového pojištení
							<li> Vytvoření pojištění vozidla
							<li> Vytvoření pojištění nehnutelnosti
							<li> Vytvoření živelního pojištení
						</ul>
					<ul>
				</td>
			</tr>
		</table>
    </div>


    <?php
    $this->load->helper('footer');
} else {
    echo "error, neplatné privilégia";
}
