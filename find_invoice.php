<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ($this->session->userdata('permisson')==0) {
    $this->load->helper('header');
    showHeader();
    $this->load->helper('menu');
    showMenuAdmin(); ?>
    
	<script>
		$(document).ready(function(){
			$("#menuInvoices").css("background-color", "#00B4D7");
			$("#menuInvoicesW").css("color", "white");
		});
	</script>
	
	<h1>Vyhledání faktúry</h1>

    <div>
        <table class="form_table">            
            <tr>
                <td width="200">
                    Vyhledej fakturu:
                </td>
                <td>
                    <?php echo form_input('newTitle','','class="myTextArea"'); ?>
                </td>
                <td>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo '<a href="" class="button">Vyhledat</a>'; ?>
                </td>
            </tr>
       </table>
    </div>


    <?php echo form_close();
    $this->load->helper('footer');
} else {
    echo "error, neplatné privilégia";
}
