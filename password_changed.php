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
	echo form_open(base_url()."main/redirectLogin");
		echo '<p style= "padding-left:15px">Gratulujeme.</p>';
        echo '<p style= "padding-left:15px">Vaše heslo bylo úspěšne změněno.</p>';
		echo '<p style= "padding-left:15px">Nové heslo bylo zasláno na e-mail <b>'.$email_sended.'</b></p>';
		echo '<p style= "padding-left:15px">Nyní se můžete přihlásit pod novým heslem.</p>';
		
		echo '<div class="div_lane" style="margin-top:15px; background-color: white">';
        echo '<div class="button-group" style="padding-top: 15px; padding-bottom: 15px; margin-right: 3px; margin-left: 100px;">';
            echo form_submit('submitIndex', 'Přejít na přihlášení', 'class="button" ');
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
