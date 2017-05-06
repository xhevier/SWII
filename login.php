<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <title>Mendelu Pojišťovna</title>
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url('css/style.css')?>">
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url('css/buttons.css')?>">
</head>
<body>
    <div id="container">
<style type="text/css">
    #container {
        width: 335px;
        height: auto;
    };
</style>



<h1 style="background-color: white">Přihlášení</h1>


    <?php
	echo '<div style="margin-top:15px; color: red; text-align:center; font-weight: bold;">';
		echo validation_errors();
	echo '</div>';
    echo form_open(base_url()."main/canLogin");
        echo '<table style="margin-left:15px";>';
            echo '<tr>';
                echo '<td>';
                    echo '<p align="left">Login &nbsp &nbsp</p>';
                echo '</td>';
                echo '<td>';
                    echo form_input('username', '', 'class="myTextArea"');
                echo '</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td>';
                    echo '<p align="left">Heslo &nbsp &nbsp</p>';
                echo '</td>';
                echo '<td>';
                    echo form_password('password', '', 'class="myTextArea"');
                echo '</td>';
            echo '</tr>';
        echo '</table>';
		echo '<div class="div_lane" style="margin-top:15px; background-color: white">';
        echo '<div class="button-group" style="padding-top: 15px; padding-bottom: 15px; margin-right: 3px; margin-left: 69px;">';
            echo '<a href="'.base_url('Main/redirectLostPassword') .'" class="button">Zapomenuté heslo</a>';
            echo form_submit('submitIndex', 'Přihlásit', 'class="button"');
        echo '</div>';
		echo '</div>';
    echo form_close();
    ?>


<?php
/*$this->load->helper('footer');*/
?>
