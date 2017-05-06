<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ($this->session->userdata('permisson')==0 OR $this->session->userdata('permisson')==1) {
    $this->load->helper('header');
    showHeader();
    $this->load->helper('menu');
    showMenuAdmin(); 
	$this->load->helper('vypis');
	?>
    
	<script>
		$(document).ready(function(){
			$("#menuEmployees").css("background-color", "#00B4D7");
			$("#menuEmployeesW").css("color", "white");	
			$("#dialogEmployeePDF").hide();	
			$("#dialogEmployeeStorno").hide();	
			$("#dialogEmployeeFire").hide();			
		});	
		
		function alertShowPdf(){
			$("#dialogEmployeePDF").show();
		}
		
		function hidePdfAlert(){
			$("#dialogEmployeePDF").hide();
		}
		
		function alertShowStorno(){
			$("#dialogEmployeeStorno").show();
		}
		
		function hideStornoAlert(){
			$("#dialogEmployeeStorno").hide();
		}
		
		function alertShowFire(){
			$("#dialogEmployeeFire").show();
		}
		
		function hideFireAlert(){
			$("#dialogEmployeeFire").hide();
		}
		

	</script>
	
	<div id="dialogEmployeePDF" class="dialogEmployee">
		<div style="margin-top:20px">
			<p><img src="<?php echo base_url('images/alert.png');?>" style="width:40px; height:40px; float: left; margin-left:235px"><span style="float:left; font-size:25px; margin-top:5px; margin-left:20px">Potvrdenie</span></p>
		</div>
		<div class="div_lane" style="margin-top:80px"></div>
		<div style="margin-top:15px; text-align:center">
			<p> V prípade že <b>vygenerujete PDF zmluvu</b> prihlásenia zamestnanca, už <b>nebudete môcť edivať</b> údaje zamestnanca. </p>
		</div>
		<div class="div_lane" style="margin-top:15px"></div>
		<div style=" text-align:center;">
			<div class="button-group" style="padding-top: 15px;">
				<a onclick="hidePdfAlert();" onclick="history.go(-1)" class="button">Údaje chcem ešte prekontrolovať</a>
				<a href="<? echo base_url('Admin/acceptEmployeePDF/'.$user->USER_ID); ?>" class="button">Udáje sú prekontrolované a chcem vygenerovať zmluvu</a>
			</div>
		</div>
	</div>
	
	<div id="dialogEmployeeStorno" class="dialogEmployee">
		<div style="margin-top:20px">
			<p><img src="<?php echo base_url('images/alert.png');?>" style="width:40px; height:40px; float: left; margin-left:235px"><span style="float:left; font-size:25px; margin-top:5px; margin-left:20px">Potvrdenie</span></p>
		</div>
		<div class="div_lane" style="margin-top:80px"></div>
		<div style="margin-top:15px; text-align:center">
			<p> Chystáte sa <b>stornovať</b> zamestnanca. Zoberte prosím na vedomie že táto akcia je <b>nenávratná</b>. </p>
		</div>
		<div class="div_lane" style="margin-top:15px"></div>
		<div style=" text-align:center;">
			<div class="button-group" style="padding-top: 15px;">
				<a onclick="hideStornoAlert();" onclick="history.go(-1)" class="button">Nie, nechcem stornovať zamestnanca</a>
				<a href="<? echo base_url('Admin/stronoEmployee/'.$user->USER_ID); ?>" class="button">Áno, chcem stornovať zamestnanca</a>
			</div>
		</div>
	</div>
	
	<div id="dialogEmployeeFire" class="dialogEmployee">
		<div style="margin-top:20px">
			<p><img src="<?php echo base_url('images/alert.png');?>" style="width:40px; height:40px; float: left; margin-left:235px"><span style="float:left; font-size:25px; margin-top:5px; margin-left:20px">Potvrdenie</span></p>
		</div>
		<div class="div_lane" style="margin-top:80px"></div>
		<div style="margin-top:15px; text-align:center">
			<p> Chystáte sa <b>prepustiť</b> zamestnanca. Zoberte prosím na vedomie že táto akcia je <b>nenávratná</b>. </p>
		</div>
		<div class="div_lane" style="margin-top:15px"></div>
		<div style=" text-align:center;">
			<div class="button-group" style="padding-top: 15px;">
				<a onclick="hideFireAlert();" onclick="history.go(-1)" class="button">Nie, nechcem prepustiť zamestnanca</a>
				<a href="<? echo base_url('Admin/fireEmployee/'.$user->USER_ID); ?>" class="button">Áno, chcem prepustiť zamestnanca</a>
			</div>
		</div>
	</div>
	
	<? if ($modifyPermisson){
		if ($user->USER_PLATNA=='N'){
			echo '<h1>Detail zaměstnance - <span style="color:red">prepustený dňa '.date("d.m.Y",strtotime($user->USER_MODIFY_DATE)).'</span></h1>';
		} else if ($user->USER_PLATNA=='S'){
			echo '<h1>Detail zaměstnance - <span style="color:red">stornovaný dňa '.date("d.m.Y",strtotime($user->USER_MODIFY_DATE)).'</span></h1>';
		} else {
			echo '<h1>Detail zaměstnance</h1>';
		}
		
	} else {
		echo '<h1>Detail zaměstnance <span style="font-size:12px; color: red">- není možné modifikovat, prekročená doba expirace pro editaci zaměstnance.</span></h1>';
	}?>
    <div>
        <table class="form_table">
            <tr>
                <td width="200">
                    Titul
                </td>
                <td>
                    <?php echo form_input('',$user->USER_TITLE,'class="myTextAreaNoEdit" readonly ID="employeeEditTitle"'); ?>
                </td>
				<td width="80">
                    &nbsp
                </td>
				<td width="200">
                    Přihlašovací jméno
                </td>
                <td>
                    <?php echo form_input('',$user->LOGIN_NAME,'class="myTextAreaNoEdit" readonly'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Jméno
                </td>
                <td>
                    <?php echo form_input('',$user->USER_FNAME,'class="myTextAreaNoEdit" readonly'); ?>
                </td>
				<td>
                    &nbsp
                </td>
				<td>
                    Registrován uživatelem
                </td>
                <td>
                    <?php echo form_input('',getUserName($user->USER_CREATE_USER_ID),'class="myTextAreaNoEdit" readonly'); ?>
                </td>
                <td>
            </tr>
            <tr>
                <td>
                    Příjmení
                </td>
                <td>
                    <?php echo form_input('',$user->USER_LNAME,'class="myTextAreaNoEdit" readonly'); ?>
                </td>
				<td>
                    &nbsp
                </td>
				<td>
                    Registrován dne
                </td>
                <td>
                    <?php echo form_input('',date('d.m.Y',strtotime($user->USER_CREATE_DATE)),'class="myTextAreaNoEdit" readonly'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Datum narození
                </td>
                <td>
					<?php
					$year = substr($user->USER_PIN,4,2).'.'.substr($user->USER_PIN,2,2).'.19'.substr($user->USER_PIN,0,2);
                    echo form_input('',$year ,'class="myTextAreaNoEdit" readonly'); ?>
                </td>
				<td>
                    &nbsp
                </td>
				<td>
                    Změnen uživatelem
                </td>
                <td>
                    <?php 
						if ($user->USER_MODIFY_USER_ID == null){
							echo form_input('','jestě nezměneno','class="myTextAreaNoEdit" readonly');
						} else {
							echo form_input('',getUserName($user->USER_MODIFY_USER_ID),'class="myTextAreaNoEdit" readonly');
						}
					 ?>
                </td>
            </tr>
            <tr>
                <td>
                    Rodné číslo
                </td>
                <td>
                    <?php echo form_input('',$user->USER_PIN,'class="myTextAreaNoEdit" readonly'); ?>
                </td>	
				<td>
                    &nbsp
                </td>
				<td>
                    Změnen dne
                </td>
                <td>
					<?php 
						if ($user->USER_MODIFY_DATE == null){
							echo form_input('','jestě nezměneno','class="myTextAreaNoEdit" readonly');
						} else {
							echo form_input('',date('d.m.Y',strtotime($user->USER_MODIFY_DATE)),'class="myTextAreaNoEdit" readonly');
						}
					?>
                </td>				
            </tr>
            <tr>
                <td>
                    Mobilní telefon
                </td>
                <td>
                    <?php echo form_input('',$user->USER_MNUMBER,'class="myTextAreaNoEdit" readonly'); ?>
                </td>				
				<td>
                    &nbsp
                </td>
				<td>
                    Platnost smlouvy od
                </td>
                <td>
                    <?php echo form_input('',date('d.m.Y',strtotime($user->HIRE_FROM)),'class="myTextAreaNoEdit" readonly'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Email
                </td>
                <td>
                    <?php echo form_input('',$user->USER_EMAIL,'class="myTextAreaNoEdit" readonly'); ?>
                </td>
				<td>
                    &nbsp
                </td>
				<td>
                    Platnost smlouvy do
                </td>
                <td>
                    <?php echo form_input('',date('d.m.Y',strtotime($user->HIRE_TO)),'class="myTextAreaNoEdit" readonly'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Číslo občanského průkazu
                </td>
                <td>
                    <?php 
					$onumber = 'SL'.substr($user->USER_PIN,4,2).substr($user->USER_PIN,5,1).substr($user->USER_PIN,7,2).substr($user->USER_PIN,4,1);
					echo form_input('',$onumber,'class="myTextAreaNoEdit" readonly'); ?>
                </td>
				<td>
                    &nbsp
                </td>
				<td>
                    Pozice
                </td>
                <td>
                    <?php 				
					echo form_input('',getFunction($user->LOGIN_PERMISSON),'class="myTextAreaNoEdit" readonly'); ?>
                </td>
            </tr>           
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
                    <?php echo form_input('',$user->ADRESS_STREET,'class="myTextAreaNoEdit" readonly'); ?>
                </td>
				<td>
                    &nbsp
                </td>
				<td>
                    Číslo bankovního účtu
                </td>
                <td>
                    <?php echo form_input('',$user->BANK_NUMBER,'class="myTextAreaNoEdit" readonly'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Číslo domu
                </td>
                <td>
                    <?php echo form_input('',$user->ADRESS_NUMBER,'class="myTextAreaNoEdit" readonly'); ?>
                </td>
				<td>
                    &nbsp
                </td>
				<td>
                    Kód banky
                </td>
                <td>
                    <?php echo form_input('',$user->BANK_CODE,'class="myTextAreaNoEdit" readonly'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    PSČ
                </td>
                <td>
                    <?php echo form_input('',$user->ADRESS_POST,'class="myTextAreaNoEdit" readonly'); ?>
                </td>
				<td>
                    &nbsp
                </td>
				<td>
                    Název banky
                </td>
                <td>
                    <?php echo form_input('',$user->BANK_NAME,'class="myTextAreaNoEdit" readonly'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Město
                </td>
                <td>
                    <?php echo form_input('newCity',$user->ADRESS_CITY,'class="myTextAreaNoEdit" readonly'); ?>
                </td>
				<td>
                    &nbsp
                </td>
				<td>
                    IBAN
                </td>
                <td>
                    <?php echo form_input('newPermisson',$user->BANK_IBAN,'class="myTextAreaNoEdit" readonly'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Stát
                </td>
                <td>
                    <?php echo form_input('newState','('.$user->STATE_SHORT.') '.$user->STATE_NAME,'class="myTextAreaNoEdit" readonly'); ?>
                </td>
            </tr>
			</table>
		<div class="pdfActionDivName" style="height:120px">
			<?php if ($user->USER_ACCEPT_PDF=='A'){ 
				$this->load->helper('agreement_helper');
				$formatted_user_id=getCorrectID($user->USER_ID);
				?>
				<div class="divBlocksName" style="margin-right:30px; width:90px; font-size:10px; ">
					<?php echo '<b>ZMZ</b>'.$formatted_user_id.''.substr($user->HIRE_FROM,0,4).''.substr($user->HIRE_FROM,5,2).''.substr($user->HIRE_FROM,8,2); ?>
					<a href="<?php echo base_url('PdfMaker/employeeAgreementDefualtPDF/'.$user->USER_ID) ?>">
						<img border="0" width="80" style="margin-left:12px; margin-top:5px" src="<?php echo base_url("images/pdf_icon.png")?>">
					</a>
				</div>
			<?php } else { 
				$this->load->helper('agreement_helper');
				$formatted_user_id=getCorrectID($user->USER_ID);
				?>
				<div class="divBlocksName" style="margin-right:30px; width:90px; font-size:10px; ">
					<?php echo '<b>ZMZ</b>'.$formatted_user_id.''.substr($user->HIRE_FROM,0,4).''.substr($user->HIRE_FROM,5,2).''.substr($user->HIRE_FROM,8,2); ?>
					<span style="cursor: pointer" onclick="alertShowPdf();">
						<img border="0" id="employee_agreement" onclick="alertShowPdf();" width="80" style="margin-left:25px; margin-top:5px" src="<?php echo base_url("images/pdf_icon_acc.png")?>">
					</span>
				</div>
			<?php }
		
			if ($user->USER_PLATNA=='N') { 
				$this->load->helper('agreement_helper');
				$formatted_user_id=getCorrectID($user->USER_ID);
			?>				
				<div class="divBlocksName" style="margin-right:30px; width:90px; font-size:10px; ">
					<?php echo '<b>ZMD</b>'.$formatted_user_id.''.substr($user->HIRE_FROM,0,4).''.substr($user->HIRE_FROM,5,2).''.substr($user->HIRE_FROM,8,2); ?>
					<a href="<?php echo base_url('PdfMaker/employeeAgreementDeletedPDF/'.$user->USER_ID) ?>">
						<img border="0" width="80" style="margin-left:25px; margin-top:5px" src="<?php echo base_url("images/pdf_icon.png")?>">
					</a>
				</div>
			<?php } 
		
		?>
		
	</div>
  
    <div class="div_lane" style="">
        <div class="button-group" style="padding-top: 15px; margin-left: 15px">
            <a href=<?php echo base_url('Admin/redirectAllUsers/1/1')?> class="button">Zpět</a>
			<?php if($user->USER_PLATNA=="A") { ?>
            <a onclick="alertShowStorno();" class="button">Stornovat</a>  
			<a onclick="alertShowFire();" class="button">Prepustiť</a>
			<?php 
			}
			if ($modifyPermisson) {
				if ($user->USER_ACCEPT_PDF=='N'){
					echo '<a href="'.base_url('Admin/redirectModifyEmployee/'.$user->USER_ID).'" class="button">Upravit</a>';
				}			
			}
			?>
						
        </div>
    </div>
	</div>

    <?php echo form_close();
    $this->load->helper('footer');
} else {
    echo "error, neplatné privilégia";
}
