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
			$("#menuAgreements").css("background-color", "#00B4D7");
			$("#menuAgreementsW").css("color", "white");	
		});	
		
		
	</script>
	<div class="comments">
		<?=$comments?>
	</div>
    <?php
    $this->load->helper('footer');
} else {
    echo "error, neplatné privilégia";
}
