﻿<?php
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
	
    <h1>Modul smlouvy</h1>

    <div>
        <table class="form_table">            
            <tr>
                <td>
                    <?php echo '<a href="" class="button">Vyhledat</a>'; ?>
                </td>
                <td>
                    <?php echo '<a href="" class="button">Seznam</a>'; ?>
                </td>                
                <td>
                    <?php echo '<a href="" class="button">Pojistna smlouva</a>'; ?>
                </td>                 
                <td>
                    <?php echo '<a href="" class="button">Prodlouzeni smlouvy</a>'; ?>
                </td>                 
                <td>
                    <?php echo '<a href="" class="button">Smlouva o zruseni</a>'; ?>
                </td>
            </tr>
       </table>
    </div>


    <?php
    $this->load->helper('footer');
} else {
    echo "error, neplatné privilégia";
}
