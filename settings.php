<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ($this->session->userdata('permisson')==0) {
    $this->load->helper('header');
    showHeader();
    $this->load->helper('menu');
    showMenuAdmin(); ?>
    
	<script>
		$(document).ready(function(){
			$("#menuSettings").css("background-color", "#00B4D7");
			$("#menuSettingsW").css("color", "white");
		});	
	</script>
  
  
	
	<h1>Nastavení systému - přehled</h1>

    <div>
    <?php
        echo '<table class="list_table" style="margin-top: -14px; border-bottom: 1px solid #D0D0D0";>';
          echo '<thead style="background-color:#00B4D7; color: white; border-bottom: 1px solid #D0D0D0"">';
            echo '<tr>';
              echo '<td style="padding-left:15px; width:80px">';
					       echo "<b>ID</b>";
				      echo '</td>';
              echo '<td style="width:130px">';
					       echo "<b>Datum vydání</b>";
				      echo '</td>';
              echo '<td style="width:200px">';
					       echo "<b>Mzda vedoucí pobočky</b>";
				      echo '</td>';
              echo '<td style="width:200px">';
					       echo "<b>Mzda revízní zaměstnanec</b>";
				      echo '</td>';
              echo '<td style="width:200px">';
					       echo "<b>Mzda účetní</b>";
				      echo '</td>';
              echo '<td style="width:200px">';
					       echo "<b>Mzda klientský poradce</b>";
				      echo '</td>';
              echo '<td>';
					       echo "<b>Adresa společnosti</b>";
				      echo '</td>';             
            echo '</tr>';				
		      echo '</thead>';
          echo '<tbody>';
          $counter = 0;
            foreach($settings as $setting){
              $counter = $counter + 1;
              
  			      echo '<tr onclick="">';
                  echo '<td style="padding-left:15px; width:40px">';
  					         if ($counter==1) {
                        echo '<b>'.$setting->GENERAL_ID.'</b>';
                      } else {
                        echo $setting->GENERAL_ID;
                      }                    
  				        echo '</td>';
                  echo '<td>';
                      if ($counter==1) {
                        echo '<b>'.date('d.m.Y',strtotime($setting->GENERAL_DATE)).'</b>';
                      } else {
                        echo date('d.m.Y',strtotime($setting->GENERAL_DATE));
                      } 
  				        echo '</td>';
                  echo '<td>';
                      if ($counter==1) {
                        echo '<b>'.$setting->GENERAL_SALARY_LEADER.',00 Kč'.'</b>';
                      } else {
                        echo $setting->GENERAL_SALARY_LEADER.',00 Kč';
                      }
  				        echo '</td>';
                  echo '<td>';
                      if ($counter==1) {
                        echo '<b>'.$setting->GENERAL_SALARY_AUDITOR.',00 Kč'.'</b>';
                      } else {
                        echo $setting->GENERAL_SALARY_AUDITOR.',00 Kč';
                      }
  				        echo '</td>';
                  echo '<td>';
                      if ($counter==1) {
                        echo '<b>'.$setting->GENERAL_SALARY_BILLER.',00 Kč'.'</b>';
                      } else {
                        echo $setting->GENERAL_SALARY_BILLER.',00 Kč';
                      }
  				        echo '</td>';
                  echo '<td>';
                      if ($counter==1) {
                        echo '<b>'.$setting->GENERAL_SALARY_ADVISER.',00 Kč'.'</b>';
                      } else {
                        echo $setting->GENERAL_SALARY_ADVISER.',00 Kč';
                      }
  				        echo '</td>';
                  echo '<td>';
                      if ($counter==1) {
                        echo '<b>'.$setting->GENERAL_STREET.' '.$setting->GENERAL_STREET_NUMBER.', '.$setting->GENERAL_POST_CODE.' '.$setting->GENERAL_CITY.' ,Česká republika (CZ)</b>';
                      } else {
                        echo $setting->GENERAL_STREET.' '.$setting->GENERAL_STREET_NUMBER.', '.$setting->GENERAL_POST_CODE.' '.$setting->GENERAL_CITY.' ,Česká republika (CZ)';
                      }
  				        echo '</td>';
  			      echo '</tr>';	
            }
          
          echo '</tbody>';
        echo '</table>';
    ?>
    </div>
    
    <h1>Nastavení systému - nový</h1>
    
    
    <div>
        <table class="list_table" style="margin-top: -14px; border-bottom: 1px solid #D0D0D0">
          <tr>    
            <td width="230px" style="padding-left:15px; padding-top:25px">
              Datum vydání
            <td>
            <td width="300px" style="padding-left:15px; padding-top:25px">
              <?php echo form_input('newSettingDate',$newSettings['datum'],'class="myTextAreaNoEdit" readonly style="width:229px"'); ?>
            <td>
            <td width="230px" style="padding-left:15px; padding-top:25px">
              Ulice sídla společnosti
            <td>
            <td style="padding-left:15px; padding-top:25px">
              <?php echo form_input('newSettingDate',$newSettings['ulice'],'class="myTextArea"'); ?>
            <td>
          </tr>
          <tr>    
            <td style="padding-left:15px; padding-top:10px">
              Mzda vedoucího pobočky
            <td>
            <td style="padding-left:15px; padding-top:10px">
              <?php echo form_input('newSettingSalaryLeader',$newSettings['mzda_vedouci'],'class="myTextArea"'); ?>
            <td>
            <td style="padding-left:15px; padding-top:10px">
              Číslo ulice sídla společnosti
            <td>
            <td style="padding-left:15px; padding-top:10px">
              <?php echo form_input('newSettingSalaryLeader',$newSettings['cislo'],'class="myTextArea"'); ?>
            <td>
          </tr>
          <tr>    
            <td style="padding-left:15px; padding-top:10px">
              Mzda revizního zaměstnance
            <td>
            <td style="padding-left:15px; padding-top:10px">
              <?php echo form_input('newSettingSalaryAuditor',$newSettings['mzda_revizni'],'class="myTextArea"'); ?>
            <td> 
            <td style="padding-left:15px; padding-top:10px">
              Smerovací č. města sídla společnosti
            <td>
            <td style="padding-left:15px; padding-top:10px">
              <?php echo form_input('newSettingSalaryAuditor',$newSettings['psc'],'class="myTextArea"'); ?>
            <td>
          </tr>
          <tr>    
            <td style="padding-left:15px; padding-top:10px">
              Mzda účetního
            <td>
            <td style="padding-left:15px; padding-top:10px">
              <?php echo form_input('newSettingSalaryAuditor',$newSettings['mzda_ucetni'],'class="myTextArea"'); ?>
            <td>
            <td style="padding-left:15px; padding-top:10px">
              Město sídla spoločnosti
            <td>
            <td style="padding-left:15px; padding-top:10px">
              <?php echo form_input('newSettingSalaryAuditor',$newSettings['mesto'],'class="myTextArea"'); ?>
            <td>
          </tr>
          <tr>    
            <td style="padding-left:15px; padding-top:10px; padding-bottom:25px">
              Mzda klientského poradce
            <td>
            <td style="padding-left:15px; padding-top:10px; padding-bottom:25px">
              <?php echo form_input('newSettingSalaryAuditor',$newSettings['mzda_poradce'],'class="myTextArea"'); ?>
            <td>
            <td style="padding-left:15px; padding-top:10px; padding-bottom:25px">
              Stát sídla společnosti
            <td>
            <td style="padding-left:15px; padding-top:10px; padding-bottom:25px">
              <?php echo form_input('newSettingSalaryAuditor','Česká republika (CZ)','class="myTextAreaNoEdit" readonly style="width:229px"' ); ?>
            <td>
          </tr>
        </table> 
    </div>
    <div class="div_lane" style="margin-top:-1px">
        <div class="button-group" style="padding-top: 20px; margin-left: 15px">
            <a href="" class="button">Vyčistit</a>
            <a href="" class="button">Zrušit</a>           
            <?php echo form_submit('submitIndex', 'Uložit', 'class="button" disabled'); ?>
        </div>
    </div>

    

    <?php echo form_close();
    $this->load->helper('footer');
} else {
    echo "error, neplatné privilégia";
}
