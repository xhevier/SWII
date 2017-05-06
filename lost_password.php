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

<h1 style="background-color: white">Změna hesla</h1>

<?php
	echo '<div style="margin-top:15px; color: red; text-align:center; font-weight: bold;">';
		if (form_error('lostUsername') == '') {
			if (form_error('lostEmail') == '') {
				if (form_error('lostFirstNumber') == '') {
					if (form_error('lostSecondNumber') == '') {
					
				} else {
					echo form_error('lostSecondNumber');
				};
				} else {
					echo form_error('lostFirstNumber');
				};
			}else{
				echo form_error('lostEmail');
			};
		} else {
			echo form_error('lostUsername');
		};

	echo '</div>';
	echo form_open(base_url()."Main/canIResetPassword");
        echo '<table style="margin-left:15px;">';
			echo '<tr>';
				echo '<td width="57">';
					echo '<p align="left">Login</p>';
				echo '</td>';
				echo '<td>';
					echo form_input('lostUsername', $data['meno'], 'class="myTextArea" style="margin-right:15px;"');
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td width="57">';
					echo '<p align="left">E-mail</p>';
				echo '</td>';
				echo '<td>';
					echo form_input('lostEmail', $data['heslo'], 'class="myTextArea" style="margin-right:15px;"');
				echo '</td>';
			echo '</tr>';
		echo '</table>';
		echo '<table style="margin-left:15px;">';
			echo '<tr>';
				echo '<td width="231">';
					echo '<p align="left"><b>2.</b> a <b>6.</b> číslice vašeho rodného čísla</p>';
				echo '</td>';
				echo '<td>';
					echo form_input('lostFirstNumber', $data['prvaCislica'], 'class="myTextArea" maxlength="1" style="width:18px"');
				echo '</td>';
				echo '<td>';
					echo form_input('lostSecondNumber', $data['druhaCislica'], 'class="myTextArea" maxlength="1" style="width:18px"');
				echo '</td>';
			echo '</tr>';
			
        echo '</table>';
		echo '<div class="div_lane" style="margin-top:15px; background-color: white">';
        echo '<div class="button-group" style="padding-top: 15px; padding-bottom: 15px; margin-right: 3px; margin-left: 57px;">';
            echo '<a href="'.base_url('Main/redirectLogin') .'" class="button ">Zpět na přihlášení</a>';
            echo form_submit('submitIndex', 'Změnit heslo', 'class="button" ');
        echo '</div>';
		echo '</div>';
    echo form_close();
?>

<?php
/*echo '<tr>';
                echo '<td width="200"style="border:1px solid black">';
                    echo '<p align="left">Login &nbsp &nbsp</p>';
                echo '</td>';
                echo '<td colspan="2" width="100" style="border:1px solid black">';
                    echo form_input('username', '', 'class="myTextArea" style="margin-right:15px;"');
                echo '</td>';
				echo '<td style="border:1px solid black">';
				echo '</td>';
            echo '</tr>';
			
			
            echo '<tr>';
                echo '<td colspan="3" style="border:1px solid black">';
                    echo '<p align="left"><b>3.</b> a <b>4.</b> číslice vašeho rodného čísla</p>';
                echo '</td>';
				echo '<td style="border:1px solid black">';
				echo '</td>';
                echo '<td style="border:1px solid black">';
                    echo form_input('password', '', 'class="myTextArea" style="width:20px"');
                echo '</td>';
            echo '</tr>';*/
?>
