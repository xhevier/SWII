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
			$("#menuEmployees").css("background-color", "#00B4D7");
			$("#menuEmployeesW").css("color", "white");
		});		
	</script>
	
    <h1>Modul zaměstnanci</h1>

    <div>
		<table class="form_table">
			<tr>
                <td>
					V tomto modulu se nacházejí akce, které je možné vykonávat pouze s modulem zaměstnanců a je rozdělený do následujících submodulů:
				</td>
			</tr>
			<tr>
				<td>
					<ul class="list_ul">
						<li> Vyhledání zaměnstnance
						<li> Seznam zaměstnanců
						<li> Vytvoření zaměstnace
						<li> Změna údajů zaměstnance
						<li> Detail údajů zaměstnance
						<li> Zobrazení pracovní smlouvy zaměstnance
						<li> Zobrazení poistných smluv zaměstnance
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