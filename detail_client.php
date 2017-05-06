<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (($this->session->userdata('permisson')==4)) {
    $this->load->helper('header');
    showHeader();
    $this->load->helper('menu');
    showMenuAdviser(); 
	$this->load->helper('vypis');
	$this->load->helper('agreement_helper');
	?>
    
	<script>
		$(document).ready(function(){
			$("#menuInsurants").css("background-color", "#00B4D7");
			$("#menuInsurantsW").css("color", "white");
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
	
	
	<? if ($user->USER_PLATNA=='A'){
        echo '<h1>Detail klienta</h1>';
      }else if ($user->USER_PLATNA=='N'){
        echo '<h1>Detail klienta - <span style="color:red">zrušený dne '.date("d.m.Y",strtotime($user->USER_MODIFY_DATE)).'</span></h1>';
      }else if ($user->USER_PLATNA=='S'){
        echo '<h1>Detail klienta - <span style="color:red">stornovaný dne '.date("d.m.Y",strtotime($user->USER_MODIFY_DATE)).'</span></h1>';
      }
	$agreements = getAllAgreementsForClient($user->USER_ID);
	
	?>
	<div id="dialogEmployeePDF" class="dialogEmployee">
		<div style="margin-top:20px">
			<p><img src="<?php echo base_url('images/alert.png');?>" style="width:40px; height:40px; float: left; margin-left:235px"><span style="float:left; font-size:25px; margin-top:5px; margin-left:20px">Potvrdenie</span></p>
		</div>
		<div class="div_lane" style="margin-top:80px"></div>
		<div style="margin-top:15px; text-align:center">
			<p> V prípade že <b>vygenerujete PDF zmluvu</b> prihlásenia klienta, už <b>nebudete môcť edivať</b> údaje klienta. </p>
		</div>
		<div class="div_lane" style="margin-top:15px"></div>
		<div style=" text-align:center;">
			<div class="button-group" style="padding-top: 15px;">
				<a onclick="hidePdfAlert();" onclick="history.go(-1)" class="button">Údaje chcem ešte prekontrolovať</a>
				<a href="<? echo base_url('Adviser/acceptKlientPDF/'.$user->USER_ID); ?>" class="button">Udáje sú prekontrolované a chcem vygenerovať zmluvu</a>
			</div>
		</div>
	</div>
	
	<div id="dialogEmployeeStorno" class="dialogEmployee">
			<div style="margin-top:20px">
				<p><img src="<?php echo base_url('images/alert.png');?>" style="width:40px; height:40px; float: left; margin-left:235px"><span style="float:left; font-size:25px; margin-top:5px; margin-left:20px">Potvrdenie</span></p>
			</div>
			<div class="div_lane" style="margin-top:80px"></div>
			<div style="margin-top:15px; text-align:center">
				<p> Chystáte sa <b>stornovať</b> klienta. Spolu s klientom budú stornované všetky dokumenty, ktoré sú vo vzťahu k tomúto klientovi! Zoberte prosím na vedomie že táto akcia je <b>nenávratná</b>. </p>
			</div>
			<div class="div_lane" style="margin-top:15px"></div>
			<div style=" text-align:center;">
				<div class="button-group" style="padding-top: 12px;">
					<a onclick="hideStornoAlert();" onclick="history.go(-1)" class="button">Nie, nechcem stornovať klienta</a>
					<a href="<? echo base_url('Adviser/stornoClient/'.$user->USER_ID); ?>" class="button">Áno, chcem stornovať klienta</a>
				</div>
			</div>
		</div>
		
		<div id="dialogEmployeeFire" class="dialogEmployee">
			<div style="margin-top:20px">
				<p><img src="<?php echo base_url('images/alert.png');?>" style="width:40px; height:40px; float: left; margin-left:235px"><span style="float:left; font-size:25px; margin-top:5px; margin-left:20px">Potvrdenie</span></p>
			</div>
			<div class="div_lane" style="margin-top:80px"></div>
			<div style="margin-top:15px; text-align:center">
				<p> Chystáte sa <b>deaktivovať</b> klienta. Spolu s klientom budú deaktivované všetky dokumenty, ktoré sú vo vzťahu k tomúto klientovi! Zoberte prosím na vedomie že táto akcia je <b>nenávratná</b>. </p>
			</div>
			<div class="div_lane" style="margin-top:12px"></div>
			<div style=" text-align:center;">
				<div class="button-group" style="padding-top: 15px;">
					<a onclick="hideFireAlert();" onclick="history.go(-1)" class="button">Nie, nechcem deaktivovať klienta</a>
					<a href="<? echo base_url('Adviser/fireClient/'.$user->USER_ID); ?>" class="button">Áno, chcem deaktivovať klienta</a>
				</div>
			</div>
		</div>
	
    <div>
        <table class="form_table">
            <tr>
                <td width="200">
                    Titul
                </td>
                <td>
                    <?php echo form_input('',$user->USER_TITLE,'class="myTextAreaNoEdit" readonly'); ?>
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
							echo form_input('',$user->USER_MODIFY_USER_ID,'class="myTextAreaNoEdit" readonly');
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
                    <?php echo form_input('','neurčito','class="myTextAreaNoEdit" readonly'); ?>
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
			<p style="padding-top:25px; padding-left:15px"> <b>Zoznam vygenerovaných dokumentov:</b></p>
			<?php $countDivs=1 ?>
	<div class="pdfActionDivName" style="height:120px; margin-top:10px">
		<div class="divBlocksName" style="margin-right:30px; width:90px; font-size:10px; ">
				<?php 
				if ($user->USER_ACCEPT_PDF=='A'){
					$this->load->helper('agreement_helper');
					$formatted_user_id=getCorrectID($user->USER_ID);
					echo '<b style="margin-left:13px">ZPZ</b>'.$formatted_user_id.''.substr($user->HIRE_FROM,0,4).''.substr($user->HIRE_FROM,5,2).''.substr($user->HIRE_FROM,8,2); ?>
					<a id="icon1" href="<?php echo base_url('PdfMaker/clientAgreementDefaultPDF/'.$user->USER_ID) ?>">
						<img border="0" width="80" style="margin-left:25px; margin-top:5px" src="<?php echo base_url("images/pdf_icon.png")?>">
					</a><?php
				} else {
					$this->load->helper('agreement_helper');
					$formatted_user_id=getCorrectID($user->USER_ID);
					echo '<b style="margin-left:13px">ZPZ</b>'.$formatted_user_id.''.substr($user->HIRE_FROM,0,4).''.substr($user->HIRE_FROM,5,2).''.substr($user->HIRE_FROM,8,2); ?>
					<span style="cursor: pointer" onclick="alertShowPdf();">				
						<img border="0" id="employee_agreement" onclick="alertShowPdf();" width="80" style="margin-left:25px; margin-top:5px" src="<?php echo base_url("images/pdf_icon_acc.png")?>">
					</a><?php
				}
		echo '</div>';	
				if ($user->USER_PLATNA=='N') { 
				$this->load->helper('agreement_helper');
				$formatted_user_id=getCorrectID($user->USER_ID);
				$countDivs=$countDivs+1;
				?>				
				<div class="divBlocksName" style="margin-right:30px; width:92px;font-size:10px;">
					<?php echo '<b style="margin-left:13px">ZPD</b>'.$formatted_user_id.''.substr($user->HIRE_FROM,0,4).''.substr($user->HIRE_FROM,5,2).''.substr($user->HIRE_FROM,8,2); ?>
					<a href="<?php echo base_url('PdfMaker/clientAgreementDeletedPDF/'.$user->USER_ID) ?>">
						<img border="0" width="80" style="margin-left:25px; margin-top:5px;" src="<?php echo base_url("images/pdf_icon.png")?>">
					</a>
				</div>
			<?php } 
	
			$counter = 0;
			if ($agreements != false) {	
				$counter = $counter+1;			
					foreach ($agreements as $agreement) {
						$counter = $counter+1;
						if ($counter<10){
							?><div class="divBlocksName" style="padding-left:20px; border-left:1px solid #D0D0D0; height: 107px; margin-right:60px; width:71px; font-size:10px">
							<?php 
							if ($agreement->AGREEMENT_TYPE=='L'){
								if ($agreement->AGREEMENT_PLATNA=='A'){
									echo '<a href="'.base_url('Adviser/redirectEditLifeAgreement/'.$agreement->AGREEMENT_ID).'/1">'.$agreement->AGREEMENT_CODE.'</a>'; ?>
									<a href="<?php echo base_url('Adviser/redirectEditLifeAgreement/'.$agreement->AGREEMENT_ID.'/1') ?>">
										<img border="0" width="80" style="margin-left:12px; margin-top:5px" src="<?php echo base_url("images/form.png")?>">
									</a> <?php
								} else {
									echo '<a href="'.base_url('Adviser/redirectEditLifeAgreement/'.$agreement->AGREEMENT_ID).'/1"><span style="color:red">'.$agreement->AGREEMENT_CODE.'</span></a>'; ?>
									<a href="<?php echo base_url('Adviser/redirectEditLifeAgreement/'.$agreement->AGREEMENT_ID.'/1') ?>">
										<img border="0" width="80" style="margin-left:12px; margin-top:5px" src="<?php echo base_url("images/form.png")?>">
									</a> <?php
								}								
							 } else {
								 if ($agreement->AGREEMENT_PLATNA=='A'){
									 echo '<a href="'.base_url('Adviser/redirectEditTravelAgreement/'.$agreement->AGREEMENT_ID).'/1">'.$agreement->AGREEMENT_CODE.'</a>'; ?>
									<a href="<?php echo base_url('Adviser/redirectEditTravelAgreement/'.$agreement->AGREEMENT_ID.'/1') ?>">
										<img border="0" width="80" style="margin-left:12px; margin-top:5px" src="<?php echo base_url("images/form.png")?>">
									</a> <?php
								 } else {
									 echo '<a href="'.base_url('Adviser/redirectEditTravelAgreement/'.$agreement->AGREEMENT_ID).'/1"><span style="color:red">'.$agreement->AGREEMENT_CODE.'</a>'; ?>
									<a href="<?php echo base_url('Adviser/redirectEditTravelAgreement/'.$agreement->AGREEMENT_ID.'/1') ?>">
										<img border="0" width="80" style="margin-left:12px; margin-top:5px" src="<?php echo base_url("images/form.png")?>">
									</a> <?php 
								 }
								
							 } ?>	
							</div><?php
						}
					}										
			}
		
		?>
		
	</div>
  
    <div class="div_lane" style="">
        <div class="button-group" style="padding-top: 15px; margin-left: 15px">
		<a href="<?php echo base_url('Adviser/redirectAllClients/1/1')?>" class="button">Zpět</a> 
		<?php if ($user->USER_PLATNA=='A'){
			
			?> <a onclick="alertShowStorno();" class="button">Stornovat</a> <?php
			?> <a onclick="alertShowFire();" class="button">Deaktivovať</a> <?php		
				if ($user->USER_ACCEPT_PDF=='N'){
					echo '<a href="'.base_url('Adviser/redirectModifyClient/'.$user->USER_ID).'" class="button">Upravit</a>';
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



			
			