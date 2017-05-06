<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ($this->session->userdata('permisson')==4) {
$this->load->helper('header');
showHeader();
$this->load->helper('menu');
showMenuAdviser(); 
$this->load->helper('validation_helper');
$this->load->helper('agreement_helper');
$agreement_life = getAgreementLife($agreement->LIFE_ID);
$bills = getAllBillsForLife($agreement_life->LIFE_ID);
	?>	
	<script>
		$(document).ready(function(){
			$("#menuAgreements").css("background-color", "#00B4D7");
			$("#menuAgreementsW").css("color", "white");			
			$("#dialogEmployeePDF").hide();		
			$("#dialogEmployeeStorno").hide();	
			$("#dialogEmployeeFire").hide();
			
			$("#newUserOneYear").click(function(){
				if ($('#newLifeName').val()!='') {
					var a = $("#newLifeDateFrom").val().substr(0,9);
					var b = Number($("#newLifeDateFrom").val().substr(9,1))+1;
					$("#newLifeDateTo").val(a.concat(b));
				};				
			});
			$("#newUserTwoYear").click(function(){
				if ($('#newLifeName').val()!='') {
					var a = $("#newLifeDateFrom").val().substr(0,9);
					var b = Number($("#newLifeDateFrom").val().substr(9,1))+2;
					$("#newLifeDateTo").val(a.concat(b));
				};				
			});
			$("#newUserTreeYear").click(function(){
				if ($('#newLifeName').val()!='') {
					var c = Number($("#newLifeDateFrom").val().substr(9,1))+3;
					if (c >= 10) {c=0;}
					$("#newLifeDateTo").val($("#newLifeDateFrom").val().substr(0,8).concat('2').concat(c));
				};				
			});
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
	
    <?php
      if ($agreement_life->LIFE_PLATNA=='A'){
        echo '<h1>Detail žívotního pojištení</h1>';
      }else if ($agreement_life->LIFE_PLATNA=='N'){
        echo '<h1>Detail žívotního pojištení - <span style="color:red">zrušené dne '.date("d.m.Y",strtotime($agreement_life->LIFE_MODIFY_DATE)).'</span></h1>';
      }else if ($agreement_life->LIFE_PLATNA=='S'){
        echo '<h1>Detail žívotního pojištení - <span style="color:red">stornované dne '.date("d.m.Y",strtotime($agreement_life->LIFE_MODIFY_DATE)).'</span></h1>';
      }
    ?>  
	
	<div id="dialogEmployeePDF" class="dialogEmployee">
			<div style="margin-top:20px">
				<p><img src="<?php echo base_url('images/alert.png');?>" style="width:40px; height:40px; float: left; margin-left:235px"><span style="float:left; font-size:25px; margin-top:5px; margin-left:20px">Potvrdenie</span></p>
			</div>
			<div class="div_lane" style="margin-top:80px"></div>
			<div style="margin-top:15px; text-align:center">
				<p> V prípade že <b>vygenerujete PDF zmluvu</b> životního poistenca, už <b>nebudete môcť edivať</b> túto zmluvu. </p>
			</div>
			<div class="div_lane" style="margin-top:15px"></div>
			<div style=" text-align:center;">
				<div class="button-group" style="padding-top: 15px;">
					<a onclick="hidePdfAlert();" onclick="history.go(-1)" class="button">Údaje chcem ešte prekontrolovať</a>
					<a href="<? echo base_url('Adviser/acceptLifeAgreementPDF/'.$agreement_life->LIFE_ID); ?>" class="button">Udáje sú prekontrolované a chcem vygenerovať zmluvu</a>
				</div>
			</div>
		</div>
		
		<div id="dialogEmployeeStorno" class="dialogEmployee">
			<div style="margin-top:20px">
				<p><img src="<?php echo base_url('images/alert.png');?>" style="width:40px; height:40px; float: left; margin-left:235px"><span style="float:left; font-size:25px; margin-top:5px; margin-left:20px">Potvrdenie</span></p>
			</div>
			<div class="div_lane" style="margin-top:80px"></div>
			<div style="margin-top:15px; text-align:center">
				<p> Chystáte sa <b>stornovať</b> zmluvu. Zoberte prosím na vedomie že táto akcia je <b>nenávratná</b>. </p>
			</div>
			<div class="div_lane" style="margin-top:15px"></div>
			<div style=" text-align:center;">
				<div class="button-group" style="padding-top: 15px;">
					<a onclick="hideStornoAlert();" onclick="history.go(-1)" class="button">Nie, nechcem stornovať zmluvu</a>
					<a href="<? echo base_url('Adviser/stornoLifeAgreement/'.$agreement_life->LIFE_ID); ?>" class="button">Áno, chcem stornovať zmluvu</a>
				</div>
			</div>
		</div>
		
		<div id="dialogEmployeeFire" class="dialogEmployee">
			<div style="margin-top:20px">
				<p><img src="<?php echo base_url('images/alert.png');?>" style="width:40px; height:40px; float: left; margin-left:235px"><span style="float:left; font-size:25px; margin-top:5px; margin-left:20px">Potvrdenie</span></p>
			</div>
			<div class="div_lane" style="margin-top:80px"></div>
			<div style="margin-top:15px; text-align:center">
				<p> Chystáte sa <b>deaktivovať</b> zmluvu. Zoberte prosím na vedomie že táto akcia je <b>nenávratná</b>. </p>
			</div>
			<div class="div_lane" style="margin-top:15px"></div>
			<div style=" text-align:center;">
				<div class="button-group" style="padding-top: 15px;">
					<a onclick="hideFireAlert();" onclick="history.go(-1)" class="button">Nie, nechcem deaktivovať zmluvu</a>
					<a href="<? echo base_url('Adviser/fireLifeAgreement/'.$agreement_life->LIFE_ID); ?>" class="button">Áno, chcem deaktivovať zmluvu</a>
				</div>
			</div>
		</div>
	
    
	<?php echo form_open('Adviser/editLifeAgreement/'.$agreement->LIFE_ID)?>
    <div>
         <table class="form_table">  
			<tr>
				<td>
					Rodné číslo
				</td>
				<td width="1000px">					
					<div class="button-group" style="float:left">
						<?php echo form_input('newLifePIN',substr($user->USER_PIN,0,6).substr($user->USER_PIN,7,4),'class="myTextAreaNoEdit" readonly style="width:110px; float: left" id="newLifePIN"');?>			
					</div>
					<p style="color: red; float:left; margin-top: 6px; margin-left:10px; font-weight: bold;">
						<?php echo ''?>
					</p>
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Titul, jméno a příjmení
				</td>
				<td>
					<?php 
					echo form_input('newLifeName',$user->USER_TITLE.' '.$user->USER_FNAME.' '.$user->USER_LNAME,'class="myTextAreaNoEdit" readonly id="newLifeName"'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Datum narození
				</td>
				<td>
					<?php 
					echo form_input('newLifeBirthDate',substr($user->USER_PIN,4,2).'.'.substr($user->USER_PIN,2,2).'.19'.substr($user->USER_PIN,0,2),'class="myTextAreaNoEdit" readonly style="width:100px"'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Věk
				</td>
				<td>
					<?php 
					echo form_input('newLiveYears',round((((strtotime(date('d.m.Y')))-(strtotime(substr($user->USER_PIN,4,2).'.'.substr($user->USER_PIN,2,2).'.19'.substr($user->USER_PIN,0,2))))/60/60/24/365),0),'class="myTextAreaNoEdit" readonly style="width:40px"'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Trvalý pobyt
				</td>
				<td>
					<?php 
					echo form_input('newLiveAdress',$user->ADRESS_STREET.' '.$user->ADRESS_NUMBER.', '.$user->ADRESS_CITY,'class="myTextAreaNoEdit" readonly'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Stát
				</td>
				<td>
					<?php 
					echo form_input('newLiveState','('.$user->STATE_SHORT.') '.$user->STATE_NAME,'class="myTextAreaNoEdit" readonly'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Bankovní spojení
				</td>
				<td>
					<?php 
					echo form_input('newLiveBank',$user->BANK_NUMBER.'/'.$user->BANK_CODE.' ('.$user->BANK_NAME.')','class="myTextAreaNoEdit" readonly style="width:305px"'); ?> 
				</td>
			</tr>
			<tr>
				<td width="200px">
					&nbsp
				</td>						
			</tr>
			<tr>
				<td width="200px">
					Doložení lékařské zprávy
				</td>			
				<td>
					<label class="switch">
						  <input type="checkbox" name="newLifeDoctor" value="<?php echo ''?>">
						  <div class="slider round"></div>
					</label>
				</td>
			</tr>
			<tr>
				<td>
					Výše pojistného
				</td>
				<td>
					<?php 
					echo '<div style="float:left">';
            if ($agreement_life->LIFE_ACCEPT_PDF=='N'){
              echo form_input('editLifePrice',$agreement->LIFE_PRICE,'class="myTextArea" id="newLifePrice" style="width:100px"'); 
            }else{
              echo form_input('editLifePrice',$agreement->LIFE_PRICE,'class="myTextAreaNoEdit" readonly id="newLifePrice" style="width:100px"'); 
            }						
						$options = array(
							'Eur' => 'Eur',
							'Kč' => 'Kč',
						);
            if ($agreement_life->LIFE_ACCEPT_PDF=='N'){
              echo form_dropdown('editLifeCurrency',$options,$agreement->LIFE_CURRENCY,'class="myTextArea" style="width:70px" id="newLifeCurrency"');
            }else{
              echo form_dropdown('editLifeCurrency',$options,$agreement->LIFE_CURRENCY,'class="myTextAreaNoEdit" readonly style="width:70px" id="newLifeCurrency"');
            }							 
					echo '</div>';?> 
					<p style="color: red; float:left; margin-top: 6px; margin-left:10px; font-weight: bold;">
						<?php echo ''?>
					</p>
				</td>
			</tr>
			<tr>
                <td>
					Platnost od | do
                </td>
                <td>					
					<?php 					
						echo '<div class="button-group" style="float:left">';
							echo form_input('newLifeDateFrom',date('d.m.Y',strtotime($agreement->LIFE_DATE_FROM)),'class="myTextAreaNoEdit" readonly style="width:100px; float:left" id="newLifeDateFrom"'); 
							echo form_input('newLifeDateTo',date('d.m.Y',strtotime($agreement->LIFE_DATE_TO)),'class="myTextAreaNoEdit" readonly style="width:100px; float:left; margin-left:5px" id="newLifeDateTo"');
						echo '</div>';
					?>	
					<p style="color: red; float:left; margin-top: 6px; margin-left:10px; font-weight: bold;">
						<?php echo ''?>
					</p>
                </td>				
			</tr>
			<tr>
                <td>
					Frekvence plateb
                </td>
                <td>					
					<?php $options2 = array(
						'1' => 'Měsíčně',
					);
          if ($agreement_life->LIFE_ACCEPT_PDF=='N'){
              echo form_dropdown('editLifeFrequency', $options2, $agreement->LIFE_FREQUENCY , 'class="myTextArea" style="width:120px" id="newLifeFrequency"');
            }else{
              echo form_dropdown('editLifeFrequency', $options2, $agreement->LIFE_FREQUENCY , 'class="myTextAreaNoEdit" readonly style="width:120px" id="newLifeFrequency"');
            }		
						?>					
                </td>				
			</tr>
		</table>
		<p style="padding-top:85px; padding-left:15px"> <b>Zoznam vygenerovaných dokumentov:</b></p>
		<div class="pdfActionDivName" style="height:120px; margin-top:15px">
			<div class="divBlocksName" style="margin-right:30px; width:90px; font-size:10px;">
				<?php 		
				if ($agreement_life->LIFE_ACCEPT_PDF=='A'){
					$this->load->helper('agreement_helper');
					$formatted_user_id=getCorrectID($agreement_life->LIFE_USER_ID);
					echo '<b style="margin-left:13px">ZLP</b>'.$formatted_user_id.''.substr(date("Y-m-d",strtotime($agreement_life->LIFE_DATE_FROM)),0,4).''.substr(date("Y-m-d",strtotime($agreement_life->LIFE_DATE_FROM)),5,2).''.substr(date("Y-m-d",strtotime($agreement_life->LIFE_DATE_FROM)),8,2); ?>
						<a href="<?php echo base_url('PdfMaker/employeeAgreementLifeDefault/'.$agreement_life->LIFE_CREATE_USER.'/'.$agreement_life->LIFE_ID) ?>">
							<img border="0" width="80" style="margin-left:20px; margin-top:5px" src="<?php echo base_url("images/pdf_icon.png")?>">
						</a><?php
				} else {
					$this->load->helper('agreement_helper');
					$formatted_user_id=getCorrectID($agreement_life->LIFE_USER_ID);
					echo '<b style="margin-left:13px">ZLP</b>'.$formatted_user_id.''.substr(date("Y-m-d",strtotime($agreement_life->LIFE_DATE_FROM)),0,4).''.substr(date("Y-m-d",strtotime($agreement_life->LIFE_DATE_FROM)),5,2).''.substr(date("Y-m-d",strtotime($agreement_life->LIFE_DATE_FROM)),8,2); ?>
						<a onclick="alertShowPdf();" style="cursor:pointer">
							<img border="0" width="80" style="margin-left:20px; margin-top:5px" src="<?php echo base_url("images/pdf_icon_acc.png")?>">
						</a><?php
				}
			echo '</div>';
				if ($agreement_life->LIFE_PLATNA=='N') { 
				$this->load->helper('agreement_helper');
				$formatted_user_id=getCorrectID($agreement_life->LIFE_USER_ID);
				?>			
				<div class="divBlocksName" style="margin-right:30px; width:92px;font-size:10px;">
					<?php echo '<b style="margin-left:13px">ZLD</b>'.$formatted_user_id.''.substr(date("Y-m-d",strtotime($agreement_life->LIFE_DATE_FROM)),0,4).''.substr(date("Y-m-d",strtotime($agreement_life->LIFE_DATE_FROM)),5,2).''.substr(date("Y-m-d",strtotime($agreement_life->LIFE_DATE_FROM)),8,2); ?>
					<a href="<?php echo base_url('PdfMaker/employeeAgreementLifeDeaktivated/'.$agreement_life->LIFE_CREATE_USER.'/'.$agreement_life->LIFE_ID) ?>">
						<img border="0" width="80" style="margin-left:25px; margin-top:5px" src="<?php echo base_url("images/pdf_icon.png")?>">
					</a>
				</div>
				<?php } 
				$counter=0;
				if ($bills != false) {			
					foreach ($bills as $bill) {
						if ($counter<10){
							?><div class="divBlocksName" style="padding-left:20px; border-left:1px solid #D0D0D0; height: 107px; margin-right:60px; width:71px; font-size:10px">
							<?php 
									echo '<a style="margin-left:-11px" href="">'.$bill->BILL_CODE.'</a>'; ?>
									<a href="<?php echo base_url('PdfMaker/showBill/'.$bill->BILL_ID) ?>">
										<img border="0" width="80" style="margin-left:12px; margin-top:5px" src="<?php echo base_url("images/fomr2.png")?>">
									</a> <?php							
						}							
							  ?>	
							</div><?php
					}
				}										
			 ?>
		</div>
		<div class="div_lane" style="margin-top:0px;"></div>
		<?php echo '<div class="button-group" style="float:left; margin-top:15px; margin-left: 15px">'; ?>
				<?php if ($this->uri->segment(4)==1){
					?> <a href="<?php echo base_url('Adviser/redirectDetailClient/'.$user->USER_ID)?>" class="button">Zpět</a> <?php
				} else {
					?> <a href="<?php echo base_url('Adviser/redirectAllAgreements/1/1')?>" class="button">Zpět</a> <?php
				}
	
			if ($agreement_life->LIFE_PLATNA=='A'){
			?> <a onclick="alertShowStorno();" class="button">Stornovat</a> <?php
			?> <a onclick="alertShowFire();" class="button">Deaktivovať</a> <?php		
				if ($agreement_life->LIFE_ACCEPT_PDF=='N'){
					echo form_submit('newLifeTrace', 'Uložit', 'class="button"');
				}
			}								
			?>
      <?php
        if ($agreement_life->LIFE_PLATNA=='A'){
          null; 
        }
      ?>
		</div>
		<?php 
			echo form_close();
		?>
    </div>


    <?php
    $this->load->helper('footer');
} else {
    echo "error, neplatné privilégia";
}
