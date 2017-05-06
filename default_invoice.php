<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ($this->session->userdata('permisson')==4) {
    $this->load->helper('header');
    showHeader();
    $this->load->helper('menu');
    showMenuAdviser(); ?>
    
	<script>
		$(document).ready(function(){
			$("#menuInvoices").css("background-color", "#00B4D7");
			$("#menuInvoicesW").css("color", "white");
		});	
	</script>
	
	<h1>Modul faktúry</h1>

    <div>
        <table class="form_table">
			<tr>
                <td>
					V tomto modulu se nacházejí akce, které je možné vykonávat pouze s modulem faktúr a je rozdělený do následujících submodulů:
				</td>
			</tr>
			<tr>
				<td>
					<ul class="list_ul">
						<li> Vyhledání faktúry
						<li> Seznam faktúr
					<ul>
				</td>
			</tr>
		</table>
    </div>


    <?php echo form_close();
    $this->load->helper('footer');
} else {
    echo "error, neplatné privilégia";
}
