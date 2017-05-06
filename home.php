<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ($this->session->userdata('permisson')==0  OR $this->session->userdata('permisson')==1) {
$this->load->helper('header');
showHeader();
$this->load->helper('menu');
showMenuAdmin();
	?>
	<script>
		$(document).ready(function(){
			$("#menuHome").css("background-color", "#00B4D7");
			$("#menuHomeW").css("color", "white");
		});
	</script>
	<?php
	echo '<div style="height:754px; background-color:white; text-align:center">';
		echo '<img style="margin-top:200px"src="'.base_url('images/logo.png').'">';
    echo '</div>';
	?>

<?php $this->load->helper('footer');



} else {
    echo "error, neplatné privilégia";
}