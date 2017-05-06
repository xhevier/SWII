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
			$("#menuInsurants").css("background-color", "#00B4D7");
			$("#menuInsurantsW").css("color", "white");
		});		
	</script>
	
    <h1>Modul zaměstnanci</h1>

    <div>
		<table class="form_table">
			<tr>
                <td>
					V tomto modulu se nacházejí akce, které je možné vykonávat pouze s modulem klientů a je rozdělený do následujících submodulů:
				</td>
			</tr>
			<tr>
				<td>
					<ul class="list_ul">
						<li> Vyhledání klienta
						<li> Seznam klientů
						<li> Vytvoření klienta
						<li> Změna údajů klienta
						<li> Detail údajů klienta
						<li> Zobrazení pracovní smlouvy klienta
						<li> Zobrazení poistných smluv klienta
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
