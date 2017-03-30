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
				$("#menuEmployees").css("background-color", "#00B4D7");
				$("#menuEmployeesW").css("color", "white");
				
                $("#newFirstName").focusout(function (){
                    if ($(this).val().length == 0){
                        $("#newFirstNameErrorArrow").hide(); 
                        $("#newFirstNameError").hide();
                        $("#newFirstNameError").text("");
                    } else if($(this).val().length < 3){
                        $("#newFirstNameErrorArrow").show();                        
                        $("#newFirstNameError").text("Minimálně 3 znaky");
						$("#newFirstNameError").width(100);
						$("#newFirstNameError").show();
                    } else if ($(this).val().length > 50) {
                        $("#newFirstNameErrorArrow").show();
                        $("#newFirstNameError").show();
                        $("#newFirstNameError").text("Maximálně 50 znaků");
						$("#newFirstNameError").width(100);
                    } else if (!($(this).val().match(/^[a-zA-ZÁáČčĎďÉéĚěÍíŇňÓóŘřŠšŤťŮůÝýŽžĽľôä]+$/))) {
                        $("#newFirstNameErrorArrow").show();
                        $("#newFirstNameError").show();
                        $("#newFirstNameError").text("Iba písmená");
						$("#newFirstNameError").width(65);
                    } else {
                        $("#newFirstNameErrorArrow").hide();
                        $("#newFirstNameError").hide();
                        $("#newFirstName").val($(this).val().charAt(0).toUpperCase() + $(this).val().slice(1).toLowerCase());
                        $("#newFirstNameError").text("");
                    }
                });

                $("#newLastName").focusout(function (){
                    if ($(this).val().length == 0){
                        $("#newLastNameErrorArrow").hide();
                        $("#newLastNameError").hide();
                        $("#newLastNameError").text("");
                    } else if($(this).val().length < 3){
                        $("#newLastNameErrorArrow").show();
                        $("#newLastNameError").show();
                        $("#newLastNameError").text("Minimálně 3 znaky");
						$("#newLastNameError").width(100);
                    } else if ($(this).val().length > 50) {
                        $("#newLastNameErrorArrow").show();
                        $("#newLastNameError").show();
                        $("#newLastNameError").text("Maximálně 50 znaků");
						$("#newLastNameError").width(100);
                    } else if (!($(this).val().match(/^[a-zA-ZÁáČčĎďÉéĚěÍíŇňÓóŘřŠšŤťŮůÝýŽžĽľôä]+$/))) {
                        $("#newLastNameErrorArrow").show();
                        $("#newLastNameError").show();
                        $("#newLastNameError").text("Iba písmená");
						$("#newLastNameError").width(65);
                    } else {
                        $("#newLastNameErrorArrow").hide();
                        $("#newLastNameError").hide();
                        $("#newLastName").val($(this).val().charAt(0).toUpperCase() + $(this).val().slice(1).toLowerCase());
                        $("#newLastNameError").text("");
                    }
                });
                
                $("#newBirthDate").focusout(function (){
                    if($(this).val().length == 0) {
                        $("#newBirthDayNameErrorArrow").hide();
                        $("#newBirthDayNameError").hide();
                        $("#newBirthDayNameError").text("");
                    } else if (!($(this).val().match(/^[0-9./-]+$/))) {
                        $("#newBirthDayNameErrorArrow").show();
                        $("#newBirthDayNameError").show();
                        $("#newBirthDayNameError").text("Povolenými znaky jsou číslice (0-9) a oddelovače (. / -)");
						$("#newBirthDayNameError").width(290);
                    } else if ((($(this).val().length != 10)) || (!($(this).val().charAt(2).match(/^[./-]+$/))) || (!($(this).val().charAt(5).match(/^[./-]+$/)))){
                        $("#newBirthDayNameErrorArrow").show();
                        $("#newBirthDayNameError").show();
                        $("#newBirthDayNameError").text("Nesprávní formát dátumu. (DD.MM.YYYY)");
						$("#newBirthDayNameError").width(220);
                    } else if ($(this).val().charAt(2) != $(this).val().charAt(5)) {
                        $("#newBirthDayNameErrorArrow").show();
                        $("#newBirthDayNameError").show();
                        $("#newBirthDayNameError").text("Použijte prosím rovnaké oddelovače");
						$("#newBirthDayNameError").width(250);
                    } else if ((parseInt($(this).val().substring(3, 5)) > 12) || (parseInt($(this).val().substring(3, 5)) < 1)) {
                        $("#newBirthDayNameErrorArrow").show();
                        $("#newBirthDayNameError").show();
                        $("#newBirthDayNameError").text("Rok má 12 mesiacov");
						$("#newBirthDayNameError").width(110);
                    } else if (parseInt($(this).val().substring(6, 10)) > 1998){   
                        $("#newBirthDayNameErrorArrow").show();
                        $("#newBirthDayNameError").show();
                        $("#newBirthDayNameError").text("Maximálne rok 1998");
						$("#newBirthDayNameError").width(100);
                    } else if (parseInt($(this).val().substring(6, 10)) < 1950){   
                        $("#newBirthDayNameErrorArrow").show();
                        $("#newBirthDayNameError").show();
                        $("#newBirthDayNameError").text("Minimálne rok 1950");
						$("#newBirthDayNameError").width(100);
                    } else {               
                        switch (parseInt($(this).val().substring(3, 5))) {
                          case 1:                          
                            if ((parseInt($(this).val().substring(0, 2)) < 1) || (parseInt($(this).val().substring(0, 2)) > 31)) {
                              $("#newBirthDayNameErrorArrow").show();
                              $("#newBirthDayNameError").show();
                              $("#newBirthDayNameError").text("Január má 31 dní"); 
							  $("#newBirthDayNameError").width(90);
                            } else {
                              $("#newBirthDayNameErrorArrow").hide();
                              $("#newBirthDayNameError").hide();
                              $("#newBirthDayNameError").text("");  
                            };
                            break;
                          case 2:                          
                            if ((parseInt($(this).val().substring(0, 2)) < 1) || (parseInt($(this).val().substring(0, 2)) > 28)) {
                              $("#newBirthDayNameErrorArrow").show();
                              $("#newBirthDayNameError").show();
                              $("#newBirthDayNameError").text("Február má 28 dní"); 
							  $("#newBirthDayNameError").width(95);
                            } else {
                              $("#newBirthDayNameErrorArrow").hide();
                              $("#newBirthDayNameError").hide();
                              $("#newBirthDayNameError").text("");  
                            };
                            break;
                          case 3:                          
                            if ((parseInt($(this).val().substring(0, 2)) < 1) || (parseInt($(this).val().substring(0, 2)) > 31)) {
                              $("#newBirthDayNameErrorArrow").show();
                              $("#newBirthDayNameError").show();
                              $("#newBirthDayNameError").text("Marec má 31 dní");
							  $("#newBirthDayNameError").width(85);
                            } else {
                              $("#newBirthDayNameErrorArrow").hide();
                              $("#newBirthDayNameError").hide();
                              $("#newBirthDayNameError").text("");  
                            };
                            break;
                          case 4:                          
                            if ((parseInt($(this).val().substring(0, 2)) < 1) || (parseInt($(this).val().substring(0, 2)) > 30)) {
                              $("#newBirthDayNameErrorArrow").show();
                              $("#newBirthDayNameError").show();
                              $("#newBirthDayNameError").text("Apríl má 30 dní"); 
 							  $("#newBirthDayNameError").width(80);
                            } else {
                              $("#newBirthDayNameErrorArrow").hide();
                              $("#newBirthDayNameError").hide();
                              $("#newBirthDayNameError").text("");  
                            };
                            break; 
                          case 5:                          
                            if ((parseInt($(this).val().substring(0, 2)) < 1) || (parseInt($(this).val().substring(0, 2)) > 31)) {
                              $("#newBirthDayNameErrorArrow").show();
                              $("#newBirthDayNameError").show();
                              $("#newBirthDayNameError").text("Máj má 31 dní");
							  $("#newBirthDayNameError").width(75);
                            } else {
                              $("#newBirthDayNameErrorArrow").hide();
                              $("#newBirthDayNameError").hide();
                              $("#newBirthDayNameError").text("");  
                            };
                            break;
                          case 6:                          
                            if ((parseInt($(this).val().substring(0, 2)) < 1) || (parseInt($(this).val().substring(0, 2)) > 30)) {
                              $("#newBirthDayNameErrorArrow").show();
                              $("#newBirthDayNameError").show();
                              $("#newBirthDayNameError").text("Jún má 30 dní");
							  $("#newBirthDayNameError").width(75);
                            } else {
                              $("#newBirthDayNameErrorArrow").hide();
                              $("#newBirthDayNameError").hide();
                              $("#newBirthDayNameError").text("");  
                            };
                            break;
                          case 7:                          
                            if ((parseInt($(this).val().substring(0, 2)) < 1) || (parseInt($(this).val().substring(0, 2)) > 31)) {
                              $("#newBirthDayNameErrorArrow").show();
                              $("#newBirthDayNameError").show();
                              $("#newBirthDayNameError").text("Júl má 31 dní");
							  $("#newBirthDayNameError").width(75);
                            } else {
                              $("#newBirthDayNameErrorArrow").hide();
                              $("#newBirthDayNameError").hide();
                              $("#newBirthDayNameError").text("");  
                            };
                            break;
                          case 8:                          
                            if ((parseInt($(this).val().substring(0, 2)) < 1) || (parseInt($(this).val().substring(0, 2)) > 31)) {
                              $("#newBirthDayNameErrorArrow").show();
                              $("#newBirthDayNameError").show();
                              $("#newBirthDayNameError").text("August má 31 dní"); 
							  $("#newBirthDayNameError").width(90);
                            } else {
                              $("#newBirthDayNameErrorArrow").hide();
                              $("#newBirthDayNameError").hide();
                              $("#newBirthDayNameError").text("");  
                            };
                            break;
                          case 9:                          
                            if ((parseInt($(this).val().substring(0, 2)) < 1) || (parseInt($(this).val().substring(0, 2)) > 30)) {
                              $("#newBirthDayNameErrorArrow").show();
                              $("#newBirthDayNameError").show();
                              $("#newBirthDayNameError").text("September má 30 dní"); 
							  $("#newBirthDayNameError").width(110);
                            } else {
                              $("#newBirthDayNameErrorArrow").hide();
                              $("#newBirthDayNameError").hide();
                              $("#newBirthDayNameError").text("");  
                            };
                            break;
                          case 10:                          
                            if ((parseInt($(this).val().substring(0, 2)) < 1) || (parseInt($(this).val().substring(0, 2)) > 31)) {
                              $("#newBirthDayNameErrorArrow").show();
                              $("#newBirthDayNameError").show();
                              $("#newBirthDayNameError").text("Október má 31 dní");
							  $("#newBirthDayNameError").width(95);
                            } else {
                              $("#newBirthDayNameErrorArrow").hide();
                              $("#newBirthDayNameError").hide();
                              $("#newBirthDayNameError").text("");  
                            };
                            break;
                          case 11:                          
                            if ((parseInt($(this).val().substring(0, 2)) < 1) || (parseInt($(this).val().substring(0, 2)) > 30)) {
                              $("#newBirthDayNameErrorArrow").show();
                              $("#newBirthDayNameError").show();
                              $("#newBirthDayNameError").text("November má 30 dní");
							  $("#newBirthDayNameError").width(110);
                            } else {
                              $("#newBirthDayNameErrorArrow").hide();
                              $("#newBirthDayNameError").hide();
                              $("#newBirthDayNameError").text("");  
                            };
                            break;
                          case 12:                          
                            if ((parseInt($(this).val().substring(0, 2)) < 1) || (parseInt($(this).val().substring(0, 2)) > 31)) {
                              $("#newBirthDayNameErrorArrow").show();
                              $("#newBirthDayNameError").show();
                              $("#newBirthDayNameError").text("December má 31 dní"); 
							  $("#newBirthDayNameError").width(110);
                            } else {
                              $("#newBirthDayNameErrorArrow").hide();
                              $("#newBirthDayNameError").hide();
                              $("#newBirthDayNameError").text("");  
                            };
                            break;    
                        };                        
                    };   
                }); 
            });
        </script>
    <?php

    echo form_open('',  'id="register-form"');
    ?>
    <h1>Prihlášení zaměstnance</h1>
    <div>
        <table class="form_table">
            <tr>
                <td width="200">
                    Titul
                </td>
                <td>
                    <?php echo form_input('newTitle','','class="myTextArea"'); ?>
                </td>
                <td>
                </td>                
            </tr>
            <tr>
                <td>
                    Jméno
                </td>
                <td>
                    <?php echo form_input('newFirstName','','id="newFirstName" class="myTextArea"'); ?>
                </td>
                <td  class="myTextAreaErrorArrow">
                  <div class="newArrowClass" id="newFirstNameErrorArrow" hidden></div>
                </td>
                <td>
                  <div id="newFirstNameError" class="myTextAreaError" hidden>
                </td>
            </tr>
            <tr>
                <td>
                    Příjmení
                </td>
                <td>
                    <?php echo form_input('newLastName','','id="newLastName" class="myTextArea"'); ?>
                </td>
                <td  class="myTextAreaErrorArrow">
                  <div class="newArrowClass" id="newLastNameErrorArrow" hidden></div>
                </td>
                <td>
                  <div id="newLastNameError" class="myTextAreaError" hidden>
                </td>
            </tr>
            <tr>
                <td>
                    Datum narození
                </td>
                <td>
                    <?php echo form_input('newBirthDate','','id="newBirthDate" class="myTextArea"'); ?>
                </td>
                <td  class="myTextAreaErrorArrow">
                  <div class="newArrowClass" id="newBirthDayNameErrorArrow" hidden></div>
                </td>
                <td class="myTextAreaErrorText">
                  <div id="newBirthDayNameError"  class="myTextAreaError" hidden>
                </td>
            </tr>
            <tr>
                <td>
                    Rodné číslo
                </td>
                <td>
                    <?php echo form_input('newPIN','','class="myTextArea"'); ?>
                </td>
                <td  class="myTextAreaErrorArrow">
                  <div class="newArrowClass" id="newFirstNameErrorArrow" hidden></div>
                </td>
                <td class="myTextAreaErrorText">
                  <div id=""  class="myTextAreaError" hidden>
                </td>
            </tr>
            <tr>
                <td>
                    Mobilní telefon
                </td>
                <td>
                    <?php echo form_input('newPhoneNumber','','class="myTextArea"'); ?>
                </td>
                <td  class="myTextAreaErrorArrow">
                  <div class="newArrowClass" id="newFirstNameErrorArrow" hidden></div>
                </td>
                <td class="myTextAreaErrorText">
                  <div id="" class="myTextAreaError" hidden>
                </td>
            </tr>
            <tr>
                <td>
                    Email
                </td>
                <td>
                    <?php echo form_input('newPhoneNumber','','class="myTextArea"'); ?>
                </td>
                <td  class="myTextAreaErrorArrow">
                  <div class="newArrowClass" id="newFirstNameErrorArrow" hidden></div>
                </td>
                <td class="myTextAreaErrorText">
                  <div id="" class="myTextAreaError" hidden>
                </td>
            </tr>
            <tr>
                <td>
                    Číslo občanského průkazu
                </td>
                <td>
                    <?php echo form_input('newPhoneNumber','','class="myTextArea"'); ?>
                </td>
                <td  class="myTextAreaErrorArrow">
                  <div class="newArrowClass" id="newFirstNameErrorArrow" hidden></div>
                </td>
                <td class="myTextAreaErrorText">
                  <div id="" class="myTextAreaError" hidden>
                </td>
            </tr>
          </table>
          <table class="form_table">            
            <tr>
                <td width="200">
                    &nbsp
                </td>
                <td>
                    &nbsp
                </td>
            </tr>
            <tr>
                <td>
                    Ulice
                </td>
                <td>
                    <?php echo form_input('newStreet','','class="myTextArea"'); ?>
                </td>
				<td class="myTextAreaErrorArrow" >
                  <div class="newArrowClass" id="newStreetErrorArrow" hidden></div>
                </td>
                <td style="width:200px">
                  <div id="newStreetError" class="myTextAreaError" hidden>
                </td>
            </tr>
            <tr>
                <td>
                    Číslo domu
                </td>
                <td>
                    <?php echo form_input('newStreetNumber','','class="myTextArea"'); ?>
                </td>
                <td>

                </td>
                <td>
                    Platnost smlouvy od
                </td>
                <td>
                    <?php echo form_input('newHireFrom','','class="myTextArea"'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    PSČ
                </td>
                <td>
                    <?php echo form_input('newPostCode','','class="myTextArea"'); ?>
                </td>
                <td>

                </td>
                <td>
                    Platnost smlouvy do
                </td>
                <td>
                    <?php echo form_input('newHireFrom','','class="myTextArea"'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Město
                </td>
                <td>
                    <?php echo form_input('newCity','','class="myTextArea"'); ?>
                </td>
                <td>

                </td>
                <td>
                    Pozice
                </td>
                <td>
                    <?php echo form_input('newHireFrom','','class="myTextArea"'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Stát
                </td>
                <td>
                    <?php echo form_input('newState','','class="myTextArea"'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    &nbsp
                </td>
                <td>
                    &nbsp
                </td>
                <td>

                </td>
                <td>
                    Číslo bankovního účtu
                </td>
                <td>
                    <?php echo form_input('newPermisson','','class="myTextArea"'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Přihlašovací jméno
                </td>
                <td>
                    <?php echo form_input('newLogin','','class="myTextAreaReadOnly" readonly'); ?>
                </td>
                <td>
                    <?php echo '<a href="" class="button">Generovat</a>'; ?>
                </td>

                <td>
                    Kód banky
                </td>
                <td>
                    <?php echo form_input('newPermisson','','class="myTextArea"'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Přihlašovací heslo
                </td>
                <td>
                    <?php echo form_password('newLogin','','class="myTextAreaReadOnly" readonly'); ?>
                </td>
                <td>

                </td>
                <td>
                    Název banky
                </td>
                <td>
                    <?php echo form_input('newPermisson','','class="myTextAreaReadOnly" readonly'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Registrován uživatelem
                </td>
                <td>
                    <?php echo form_input('newLogin',$this->session->userdata('username'),'class="myTextAreaReadOnly" readonly'); ?>
                </td>
                <td>

                </td>
                <td>
                    IBAN
                </td>
                <td>
                    <?php echo form_input('newPermisson','','class="myTextArea"'); ?>
                </td>
            </tr>
        </table>
    <div class="div_lane" style="margin-top:40px">
        <div class="button-group" style="padding-top: 15px; margin-left: 15px">
            <a href="" class="button">Vyčistit</a>
            <a href="" class="button">Zrušit</a>           
            <?php echo form_submit('submitIndex', 'Uložit', 'class="button danger" disabled'); ?>
        </div>
    </div>
    </div>
    <?php echo form_close();
    $this->load->helper('footer');
} else {
    echo "error, neplatné privilégia";
}
