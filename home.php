<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->helper('header');
showHeader();
$this->load->helper('menu');
showMenuAdviser();
	?>
	<script>
		$(document).ready(function(){
			$("#menuHome").css("background-color", "#00B4D7");
			$("#menuHome").css("color", "white");
		});
	</script>
	<?php
    echo '<div style="height:754px; background-color:white; text-align:center">';
		echo '<img style="margin-top:200px"src="'.base_url('images/logo.png').'">';
    echo '</div>';
$this->load->helper('footer');