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
			$("#menuAgreements").css("background-color", "#00B4D7");
			$("#menuAgreementsW").css("color", "white");
		});	
	</script>
	
    <h1>Seznam smlouv</h1>

    <div>
        <?php
    		echo '<table class="list_table" style="margin-top: -14px; border-bottom: 1px solid #D0D0D0">';
    		echo '<thead style="background-color:#00B4D7; color: white; border-bottom: 1px solid #D0D0D0"">';
    			echo '<tr>';
    				echo '<td style="padding-left:15px; width:40px">';
    					echo "<b>ID</b>";
    				echo '</td>';
    				echo '<td>';
    					echo "<b>Login</b>";
    				echo '</td>';
    				echo '<td>';
    					echo "<b>Jméno</b>";
    				echo '</td>';
    				echo '<td>';
    					echo "<b>Telefónní číslo</b>";
    				echo '</td>';
    				echo '<td>';
    					echo "<b>Email</b>";
    				echo '</td>';
    				echo '<td>';
    					echo "<b>Stát</b>";
    				echo '</td>';
    				echo '<td>';
    					echo "<b>Město</b>";
    				echo '</td>';
    				echo '<td>';
    					echo "<b>Přihlášen uživ.</b>";
    				echo '</td>';
    				echo '<td>';
    					echo "<b>Přihlášen dne</b>";
    				echo '</td>';
    				echo '<td>';
    					echo "<b>Změnen uživ.</b>";
    				echo '</td>';
    				echo '<td>';
    					echo "<b>Změnen dne</b>";
    				echo '</td>';
    			echo '</tr>';				
    		echo '</thead>';
    		echo '<tbody>';
        ?>
        
    </div>


    <?php
    $this->load->helper('footer');
} else {
    echo "error, neplatné privilégia";
}
