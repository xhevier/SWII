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
			$("#menuEmployees").css("background-color", "#00B4D7");
			$("#menuEmployeesW").css("color", "white");
		});		
	</script>
	
    <h1>Modul zaměstnanci</h1>

    <div>
		<table class="form_table">
			<tr>
                <td>
					V tomto module sa nachádzajú akcie, ktoré je možné vykonávať iba s modulom zamestnancov a je rozdelený do následujúcich submodulov:
				</td>
			</tr>
			<tr>
				<td>
					<ul class="list_ul">
						<li> Vyhľadanie zamenstnanca
						<li> Zoznam zamestnancov
						<li> Vytvorenie zamestnaca
						<li> Zmena údajov zamestnanca
						<li> Detail údajov zamestnanca
						<li> Zobrazenie pracovnej zmluvy zamestnanca
						<li> Zobrazenie poistných zmlúv zamestnanca
					<ul>
				</td>
			</tr>
		</table>
        <? /*<table class="form_table">            
            <tr>
                <td>
                    <?php echo '<a href="'.base_url('Admin/redirectFindUser').'" class="button">Vyhledat</a>'; ?>
                </td>
                <td>
                    <?php echo '<a href="'.base_url('Admin/redirectAllUsers/1/1').'" class="button">Seznam</a>'; ?>
                </td>              
                <td>
                    <?php echo '<a href="'.base_url('Admin/redirectNewUser').'" class="button">Vytvořit</a>'; ?>
                </td>
            </tr>
       </table>*/?>
    </div>


    <?php
    $this->load->helper('footer');
} else {
    echo "error, neplatné privilégia";
}
