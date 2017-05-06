<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ($this->session->userdata('permisson')==0 OR $this->session->userdata('permisson')==1) {
$this->load->helper('header');
showHeader();
$this->load->helper('menu');
showMenuAdmin(); 
$this->load->helper('agreement_helper');
$this->load->helper('validation_helper');
$this->load->helper('agreement_helper');
$bills = getAllBillsForTravel($newAgreementUser['newTravelId']);
$counter=0;
	?>	
	<script>
		$(document).ready(function(){
			$("#menuAgreements").css("background-color", "#00B4D7");
			$("#menuAgreementsW").css("color", "white");	
			$("#dialogEmployeePDF").hide();		
			$("#dialogEmployeeStorno").hide();	
			$("#dialogEmployeeFire").hide();dialogEmployeeChange
			$("#dialogEmployeeChange").hide();
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
		
		function alertShowChange(){
			$("#dialogEmployeeChange").show();
		}
		
		function hideChangeAlert(){
			$("#dialogEmployeeChange").hide();
		}
	</script>
	
	<?php 	
		
	echo form_open('Admin/editTravelAgreement/'.$newAgreementUser['newTravelId']);
	echo form_input('newTravelId',$newAgreementUser['newTravelId'],'hidden');
	echo form_input('newTravelPlatna',$newAgreementUser['newTravelPlatna'],'hidden');
	$agreement=getAgreemenetTravelPlatna($newAgreementUser['newTravelId']);
	
	if ($agreement->TRAVEL_PLATNA=='S'){
		echo '<h1>Detail cestovního pojištení - <span style="color:red">stornované dňa '.date("d.m.Y", strtotime($agreement->TRAVEL_MODIFY_DATE)).'</span></h1>';
	}else if ($agreement->TRAVEL_PLATNA=='N'){
		echo '<h1>Detail cestovního pojištení - <span style="color:red">deaktivované dňa '.date("d.m.Y", strtotime($agreement->TRAVEL_MODIFY_DATE)).'</span></h1>';
	}else {
		echo '<h1>Detail cestovního pojištení</h1>';
	}
	?>
	
	<div id="dialogEmployeePDF" class="dialogEmployee">
		<div style="margin-top:20px">
			<p><img src="<?php echo base_url('images/alert.png');?>" style="width:40px; height:40px; float: left; margin-left:235px"><span style="float:left; font-size:25px; margin-top:5px; margin-left:20px">Potvrdenie</span></p>
		</div>
		<div class="div_lane" style="margin-top:80px"></div>
		<div style="margin-top:15px; text-align:center">
			<p> V prípade že <b>vygenerujete PDF zmluvu</b> cestovného poistenca, už <b>nebudete môcť edivať</b> túto zmluvu. </p>
		</div>
		<div class="div_lane" style="margin-top:15px"></div>
		<div style=" text-align:center;">
			<div class="button-group" style="padding-top: 15px;">
				<a onclick="hidePdfAlert();" onclick="history.go(-1)" class="button">Údaje chcem ešte prekontrolovať</a>
				<a href="<? echo base_url('Admin/acceptTravelAgreementPDF/'.$newAgreementUser['newTravelId']); ?>" class="button">Udáje sú prekontrolované a chcem vygenerovať zmluvu</a>
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
				<a href="<? echo base_url('Admin/stornoTravelAgreement/'.$agreement->TRAVEL_ID); ?>" class="button">Áno, chcem stornovať zmluvu</a>
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
				<a href="<? echo base_url('Admin/fireTravelAgreement/'.$agreement->TRAVEL_ID); ?>" class="button">Áno, chcem deaktivovať zmluvu</a>
			</div>
		</div>
	</div>
	
	<div id="dialogEmployeeChange" class="dialogEmployee">
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
				<a onclick="hideChangeAlert();" onclick="history.go(-1)" class="button">Nie, nechcem deaktivovať zmluvu</a>
			</div>
		</div>
	</div>
	
	
    <div>
		
         <table class="form_table">  
			<tr>
				<td>
					Rodné číslo
				</td>
				<td width="1000px">					
					<div class="button-group" style="float:left">
						<?php echo form_input('newTravelPIN',$newAgreementUser['newTravelPIN'],'class="myTextAreaNoEdit" readonly style="width:110px; float: left" id="newTravelPIN"');?>					
					</div>
					<p style="color: red; float:left; margin-top: 6px; margin-left:10px; font-weight: bold;">
						<?php echo $newAgreementUser['errorTravelMessage']?>
					</p>
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Titul, jméno a příjmení
				</td>
				<td>
					<?php 
					echo form_input('newTravelName',$newAgreementUser['newTravelName'],'class="myTextAreaNoEdit" readonly id="newTravelName"'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Datum narození
				</td>
				<td>
					<?php 
					echo form_input('newTravelBirthDate',$newAgreementUser['newTravelBirthDate'],'class="myTextAreaNoEdit" readonly style="width:100px"'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Věk
				</td>
				<td>
					<?php 
					echo form_input('newTravelYears',$newAgreementUser['newTravelYears'],'class="myTextAreaNoEdit" readonly style="width:40px"'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Trvalý pobyt
				</td>
				<td>
					<?php 
					echo form_input('newTravelAdress',$newAgreementUser['newTravelAdress'],'class="myTextAreaNoEdit" readonly'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Stát
				</td>
				<td>
					<?php 
					echo form_input('newTravelState',$newAgreementUser['newTravelState'],'class="myTextAreaNoEdit" readonly'); ?> 
				</td>
			</tr>
			<tr>
				<td style="color: grey">
					Bankovní spojení
				</td>
				<td>
					<?php 
					echo form_input('newTravelBank',$newAgreementUser['newTravelBank'],'class="myTextAreaNoEdit" readonly style="width:305px"'); ?> 
				</td>
			</tr>
			<tr>
				<td width="200px">
					&nbsp
				</td>						
			</tr>			
			<tr>
                <td>
					Platnost od | do
                </td>
                <td>					
					<?php 					
						echo '<div class="button-group" style="float:left">';
							if ($agreement->TRAVEL_ACCEPT_PDF=='A'){
								echo form_input('newTravelDateFrom',$newAgreementUser['newTravelDateFrom'],'class="myTextAreaNoEdit" readonly style="width:100px; float:left" id="newTravelDateFrom"'); 
								echo form_input('newTravelDateTo',$newAgreementUser['newTravelDateTo'],'class="myTextAreaNoEdit" readonly style="width:100px; float:left; margin-left:5px" id="newTravelDateTo"');
							} else {
								echo form_input('newTravelDateFrom',$newAgreementUser['newTravelDateFrom'],'class="myTextArea" style="width:100px; float:left" id="newTravelDateFrom"'); 
								echo form_input('newTravelDateTo',$newAgreementUser['newTravelDateTo'],'class="myTextArea" style="width:100px; float:left; margin-left:5px" id="newTravelDateTo"');
							}						
						echo '</div>';
					?>	
					<p style="color: red; float:left; margin-top: 6px; margin-left:10px">
						<?php echo $newAgreementUser['errorMessageDate']?>
					</p>
                </td>				
			</tr>
			<tr>
				<td>
					Výše pojistného
				</td>
				<td>
					<?php 
					echo '<div style="float:left">';
						if ($agreement->TRAVEL_ACCEPT_PDF=='A'){
							echo form_input('newTravelPrice',$newAgreementUser['newTravelPrice'],'class="myTextAreaNoEdit" readonly id="newTravelPrice" style="width:100px"'); 
							$options = array(
								'1' => 'Kč',
								'2' => 'Eur',
							);
							echo form_dropdown('newTravelCurrency',$options, $newAgreementUser['newTravelCurrency'] ,'class="myTextAreaNoEdit" readonly style="width:70px" id="newTravelCurrency"'); 
						} else {
							echo form_input('newTravelPrice',$newAgreementUser['newTravelPrice'],'class="myTextArea" id="newTravelPrice" style="width:100px"'); 
							$options = array(
								'1' => 'Kč',
								'2' => 'Eur',
							);
							echo form_dropdown('newTravelCurrency',$options, $newAgreementUser['newTravelCurrency'] ,'class="myTextArea" style="width:70px" id="newTravelCurrency"'); 
						}
						
					echo '</div>';?> 
					<p style="color: red; float:left; margin-top: 6px; margin-left:10px;">
						<?php echo $newAgreementUser['errorMessageCurrency']?>
					</p>
				</td>
			</tr>
			<tr>
				<td>
					Destinace
				</td>
				<td>
					<?php 
					echo '<div style="float:left">';
						$options = array(
							'1' => 'Česká republika',
							'2' => 'Slovenská republika',
							'3' => 'Poľsko',
							'4' => 'Nemecko',
							'5' => 'Rakúsko',
							'6' => 'Ostatné krajiny Európy',
							'7' => 'Ázia',
							'8' => 'Afrika',
							'9' => 'Austrália',
							'10' => 'Severná Amerika',
							'11' => 'Južná Amerika'
						);
						if ($agreement->TRAVEL_ACCEPT_PDF=='A'){
							echo form_dropdown('newTravelDestination',$options, $newAgreementUser['newTravelDestination'] ,'class="myTextAreaNoEdit" readonly style="width:250px" id="newTravelDestination"');
						}else{
							echo form_dropdown('newTravelDestination',$options, $newAgreementUser['newTravelDestination'] ,'class="myTextArea" style="width:250px" id="newTravelDestination"');
						}
						 
					echo '</div>';?> 
				</td>
			</tr>
			<tr>
				<td>
					Platba
				</td>
				<td>
					<?php 
					echo '<div style="float:left">';
						$options2 = array(
							'1' => 'Prevodem na účet ',
							'2' => 'Hotově na pokladně',
							'3' => 'Kartou online',
							'4' => 'Katrou na pokladně',
							'5' => 'Poštovní poukázkou',
							'6' => 'SIPO'
						);
						if ($agreement->TRAVEL_ACCEPT_PDF=='A'){
							echo form_dropdown('newTravelPayType',$options2, $newAgreementUser['newTravelPayType'] ,'class="myTextAreaNoEdit" readonly style="width:250px" id="newTravelPaytype"'); 	
						}else{
							echo form_dropdown('newTravelPayType',$options2, $newAgreementUser['newTravelPayType'] ,'class="myTextArea" style="width:250px" id="newTravelPaytype"'); 	
						}
						
					echo '</div>';?> 
				</td>
			</tr>
		</table>
		<div class="pdfActionDivName" style="height:120px; margin-top:110px">
			<div class="divBlocksName" style="margin-right:30px; width:90px; font-size:10px;">
				<?php 		
				if ($agreement->TRAVEL_ACCEPT_PDF=='A'){
					$this->load->helper('agreement_helper');
					$formatted_user_id=getCorrectID($user->USER_ID);
					echo '<b style="margin-left:13px">ZTP</b>'.$formatted_user_id.''.substr(date("Y-m-d",strtotime($newAgreementUser['newTravelDateFrom'])),0,4).''.substr(date("Y-m-d",strtotime($newAgreementUser['newTravelDateFrom'])),5,2).''.substr(date("Y-m-d",strtotime($newAgreementUser['newTravelDateFrom'])),8,2); ?>
						<a href="<?php echo base_url('PdfMaker/employeeAgreementTravelDefault/'.$agreement->TRAVEL_CREATE_USER.'/'.$agreement->TRAVEL_ID) ?>">
							<img border="0" width="80" style="margin-left:20px; margin-top:5px" src="<?php echo base_url("images/pdf_icon.png")?>">
						</a><?php
				} else {
					$this->load->helper('agreement_helper');
					$formatted_user_id=getCorrectID($user->USER_ID);
					echo '<b style="margin-left:13px">ZTP</b>'.$formatted_user_id.''.substr(date("Y-m-d",strtotime($newAgreementUser['newTravelDateFrom'])),0,4).''.substr(date("Y-m-d",strtotime($newAgreementUser['newTravelDateFrom'])),5,2).''.substr(date("Y-m-d",strtotime($newAgreementUser['newTravelDateFrom'])),8,2); ?>
						<a onclick="alertShowPdf();" style="cursor:pointer">
							<img border="0" width="80" style="margin-left:20px; margin-top:5px" src="<?php echo base_url("images/pdf_icon_acc.png")?>">
						</a><?php
				}
			echo '</div>';
				if ($agreement->TRAVEL_PLATNA=='N') { 
				$this->load->helper('agreement_helper');
				$formatted_user_id=getCorrectID($user->USER_ID);?>
				<div class="divBlocksName" style="margin-right:30px; width:92px;font-size:10px;">
					<?php echo '<b style="margin-left:13px">ZTD</b>'.$formatted_user_id.''.substr(date("Y-m-d",strtotime($newAgreementUser['newTravelDateFrom'])),0,4).''.substr(date("Y-m-d",strtotime($newAgreementUser['newTravelDateFrom'])),5,2).''.substr(date("Y-m-d",strtotime($newAgreementUser['newTravelDateFrom'])),8,2); ?>
					<a href="<?php echo base_url('PdfMaker/employeeAgreementTravelDeaktivated/'.$agreement->TRAVEL_CREATE_USER.'/'.$agreement->TRAVEL_ID) ?>">
						<img border="0" width="80" style="margin-left:25px; margin-top:5px" src="<?php echo base_url("images/pdf_icon.png")?>">
					</a>
				</div>
				<?php } 
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
				} ?>
		</div>
	</div>
		<div class="div_lane" style="margin-top:0px;"></div>
		<?php echo '<div class="button-group" style="float:left; margin-top:15px; margin-left: 15px">'; ?>
			<?php 
				if ($this->uri->segment(4)==1){
					?> <a href="<?php echo base_url('Admin/redirectDetailClient/'.$user->USER_ID)?>" class="button">Zpět</a> <?php
				} else {
					?> <a href="<?php echo base_url('Admin/redirectAllAgreements/1/1')?>" class="button">Zpět</a> <?php
				}
			?>
			
			<?php 			
			if ($agreement->TRAVEL_PLATNA=='A'){
				?> <a onclick="alertShowStorno();" class="button">Stornovat</a> <?php
				?> <a onclick="alertShowFire();" class="button">Deaktivovať</a> <?php
				if ($agreement->TRAVEL_ACCEPT_PDF=='N'){
					echo form_submit('newLifeTrace', 'Uložit', 'class="button" onclick="alertChangeFire();"');
				}			
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
