<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PdfMaker extends CI_Controller {
	
	public function employeeAgreementDefualtPDF ($user_id) {
		$this->load->model('Users');
		$this->load->library('m_pdf'); 
		$this->load->helper('vypis_helper');
		$this->load->model('Settings');
		
		$pdf = $this->m_pdf->load(); 
		$pdf->setFooter('{PAGENO}');
		$pdf->setTitle('ZMZ/'.$user_id.'/2017');		
		$userLoaderFunction = getFunction($this->session->userdata('permisson'));
		$userAgreementer = $this->Users->getUserDetailInfo($user_id);
		$userLoader = $this->Users->getUserDetailInfo($userAgreementer->USER_CREATE_USER_ID);
		$userAgreementerFunction = getFunction($userAgreementer->LOGIN_PERMISSON);
		$settings = $this->Settings->getSettingsByTime($userAgreementer->HIRE_FROM);
    switch ($userAgreementer->LOGIN_PERMISSON) {
			case 0:
				$sallary = 50000;
				break;
			case 1:
				$sallary = $settings->GENERAL_SALARY_LEADER;
				break;
			case 2:
				$sallary = $settings->GENERAL_SALARY_AUDITOR;
				break;
			case 3:
				$sallary = $settings->GENERAL_SALARY_BILLER;
				break;
			case 4:
				$sallary = $settings->GENERAL_SALARY_ADVISER;
				break;
			case 5:
				$sallary = 0;
				break;
		} 

		if ($userLoaderFunction == 'Admin'){
			$userLoaderFunction = 'Vedoucí zaměstnanec';
		}
		
		$this->load->helper('agreement_helper');
		$formatted_user_id=getCorrectID($userAgreementer->USER_ID);
		
		$data['title'] = "items"; 
		ini_set('memory_limit', '256M'); 		
		$html = '
		<body style="font-family: serif; font-size: 9pt;">
    <div style="font-family: "Times New Roman", Georgia, Serif; color: #4F5155; font-size:10px">
			<div style="width:330px; float:left">
				<img src="'.base_url('images/barcode.png').'" width="300px" height="20px">
			</div>
			<div style="width:310px; float: right">
				<img src="'.base_url('images/logo.png').'" width="300px">
			</div>
			<div style="width:330px; float:left">
				<span style="font-size:22px;"><br>Pracovní smlouva číslo<br>
				ZMZ'.$formatted_user_id.''.substr($userAgreementer->HIRE_FROM,0,4).''.substr($userAgreementer->HIRE_FROM,5,2).''.substr($userAgreementer->HIRE_FROM,8,2).'<br></span>
			</div>
			<div style="border-bottom: 1px solid #4F5155; width: 100%"><br></div>
			<br>
			<div>
				<b>Mendelu pojišťovna, a.s.</b><br>
				IČ: 12585478, se sídlem Brno, Zemědelská 1, PSČ 630 00<br>
				jejímž jménem jedná: <b>'.$userLoader->USER_TITLE.' '.$userLoader->USER_FNAME.' '.$userLoader->USER_LNAME.'</b>,  na pozici '.$userLoaderFunction.',<br>
				jednajíci na základe plné moci ze dne <b>'.date('d.m.Y', strtotime($userLoader->HIRE_FROM)).'</b><br>
				(dále jako „<b>zaměstnavatel</b>“)
			</div>
			<div>
				<br>
				a
				<br>
				<br>
			</div>
			<div>
				Titul, příjmení, jméno zaměstnance: <b>'.$userAgreementer->USER_TITLE.' '.$userAgreementer->USER_FNAME.' '.$userAgreementer->USER_LNAME.'</b><br>
				Datum narození: <b>'.substr($userAgreementer->USER_PIN,4,2).'.'.substr($userAgreementer->USER_PIN,2,2).'.19'.substr($userAgreementer->USER_PIN,0,2).'</b><br>
				Adresa: (platná v den nástupu): '.$userAgreementer->ADRESS_STREET.' '.$userAgreementer->ADRESS_NUMBER.', '.$userAgreementer->ADRESS_POST.' '.$userAgreementer->ADRESS_CITY.', ('.$userAgreementer->STATE_SHORT.') '.$userAgreementer->STATE_NAME.'<br>
				(dále jako „<b>zaměstnanec</b>“)<br><br><br>
			</div>
			<div style="text-align:center">
				<span style="font-size:18px;"><b>uzavírají tuto pracovní smlouvu:</b></span>
			</div>
			<div style="text-align: center">
				<br>
				<b>I.</b><br>
				<b>Základní podmínky</b><br><br>
			</div>
			<div>
				1. Druh práce: <br>
				   <span>Zaměstnanec bude vykonávat práci <b>'.$userAgreementerFunction.'</b>.</span><br>
				2. Místo výkonu práce:<br> 
				    <span>Místem výkonu práce je <b>Brno</b>.</span><br>
				3. Den nástupu do práce: <br>
				    <span>Zaměstnanec nastoupí do práce dne <b>'.date('d.m.Y', strtotime($userAgreementer->HIRE_FROM)).'</b>.</span><br>
				4. Doba trvání pracovního poměru: <br> 
				    <span>Pracovní poměr se uzavírá na dobu <b>neurčitou</b>.</span><br>
				5. Smluvní strany si sjednávají zkušební dobu v délce trvání tří měsíců počínaje dnem, který byl sjednán jako den nástupu do práce.<br>
			</div>
			<div style="text-align: center">
				<br>
				<b>II.</b><br>
				<b>Mzdové podmínky</b><br><br>
			</div>
			<div>
				1. Způsob odměňování:<br>
				Za vykonanou práci zaměstnanci přísluší měsíční mzda, která činí <b>'.$sallary.'.00 Kč</b>.<br>
				2.	Splatnost mzdy:<br>
				Mzda je splatná v kalendářním měsíci následujícím po měsíci, ve kterém na ni zaměstnanci vznikl nárok.<br>
				3.	Termín výplaty:<br>
				Pravidelným termínem výplaty je <b>10</b>. den v kalendářním měsíci, v němž je mzda splatná. Připadne-li tento termín na sobotu, neděli nebo svátek, mzda bude vyplacena nejbližší následující pracovní den.<br>
				4.	Místo a způsob výplaty mzdy:<br>
				Splatná mzda bude zaměstnanci vyplácena převodem na účet zaměstnance s číslem <b>'.$userAgreementer->BANK_NUMBER.'/'.$userAgreementer->BANK_CODE.'</b><br>
				5.	Mzda v případě práce přesčas:<br>
				Zaměstnavatel a zaměstnanec se dohodli, že při výkonu práce přesčas nařízené zaměstnavatelem zaměstnanci za každou hodinu takové práce přesčas náleží příplatek ve výši <b>200.00 Kč</b> (minimálně ve výši <b>50%</b> průměrného hodinového výdělku), nedohodne-li se zaměstnavatel se zaměstnancem na poskytnutí náhradního volna v rozsahu práce konané přesčas.<br>
			</div>
			<br>
			<br>
			<br><br>
			<br><br>
			<br>
			<div style="width:330px; float:left">
				<img src="'.base_url('images/barcode.png').'" width="300px" height="20px">
			</div>
			<div style="width:310px; float: right">
				<img src="'.base_url('images/logo.png').'" width="300px">
			</div>
			<div style="width:330px; float:left">
				<span style="font-size:22px;"><br>Pracovní smlouva číslo ZMZ'.$formatted_user_id.''.substr($userAgreementer->HIRE_FROM,0,4).''.substr($userAgreementer->HIRE_FROM,5,2).''.substr($userAgreementer->HIRE_FROM,8,2).'<br></span>
			</div>
			<div style="border-bottom: 1px solid #4F5155; width: 100%"><br></div>
			<br>	
			<div style="text-align: center">
				<b>III.</b><br>
				<b>Údaje o nároku na délku dovolené, výpovědních dobách <br>a stanovení týdenní pracovní doby a rozvržení pracovní doby</b><br><br>
			</div>
			<div>
				1.	Údaje o nároku na délku:<br>
				Nárok na délku dovolené na zotavenou se řídí ustanoveními <b>§ 211 a násl. zákoníku práce.</b><br>
				2.	Údaje o výpovědních dobách:<br>
				Výpovědní doby jsou upraveny v ustanovení <b>§ 51 a násl. zákoníku práce.</b><br>
				3.	Údaje o stanovení týdenní pracovní doby a rozvržení pracovní doby:<br>
				Délka pracovní doby činí <b>40</b> hodin týdně. Týdenní pracovní doba je rozvržena rovnoměrně do pětidenního pracovního týdne, tj. na pět pracovních dnů v kalendářním týdnu, kterými jsou pondělí až pátek kalendářního týdne.<br>
			</div>	
			<div style="text-align: center">
				<br>
				<b>IV.</b><br>
				<b>Povinnosti zaměstnavatele</b><br><br>
			</div>
			<div>
				1. Zaměstnavatel je povinen přidělovat zaměstnanci práci podle pracovní smlouvy, platit mu za vykonanou práci mzdu, vytvářet podmínky pro úspěšné plnění jeho pracovních úkolů a dodržovat ostatní pracovní podmínky stanovené právními a ostatními předpisy, vnitřními předpisy zaměstnavatele a pracovní smlouvou.<br>
			</div>
			<div style="text-align: center">
				<br>
				<b>V.</b><br>
				<b>Povinnosti zaměstnance</b><br><br>
			</div>
			<div>
				1.	Zaměstnanec je zejména povinen:
				2.	pracovat svědomitě a řádně podle svých sil, znalostí a schopností, plnit pokyny nadřízených a dodržovat zásady spolupráce s ostatními zaměstnanci;<br>
				3.	plně využívat pracovní doby a výrobních prostředků k vykonávání pracovních úkolů, plnit tyto úkoly kvalitně, hospodárně a včas;<br>
				4.	dodržovat právní a ostatní předpisy vztahující se k práci jím vykonávané, včetně vnitřních předpisů zaměstnavatele;<br>
				5.	řádně hospodařit s prostředky svěřenými mu zaměstnavatelem a střežit a ochraňovat majetek zaměstnavatele před poškozením, ztrátou, zničením a zneužitím a nejednat v rozporu s oprávněnými zájmy zaměstnavatele; je povinen upozornit svého nadřízeného na škodu hrozící zdraví nebo majetku a zakročit k odvrácení škody, je-li toho neodkladně třeba a nebrání-li v tom zaměstnanci důležitá okolnost;<br>
				6.	zachovávat mlčenlivost o skutečnostech o nichž se dozvěděl při výkonu zaměstnání a které v zájmu zaměstnavatele nelze sdělovat jiným osobám.<br>
				7.	Zaměstnanec nesmí vedle svého zaměstnání vykonávaného v pracovněprávním vztahu k zaměstnavateli vykonávat bez předchozího písemného souhlasu zaměstnavatele výdělečnou činnost, která je shodná s předmětem činnosti zaměstnavatele.<br>
			</div>
			<div style="text-align: center">
				<br>
				<b>VI.</b><br>
				<b>Závěrečná ujednání</b><br><br>
			</div>
			<div>
				1.	Zaměstnanec prohlašuje, že jej zaměstnavatel před uzavřením pracovní smlouvy seznámil s právy a povinnostmi, které pro něj z této pracovní smlouvy vyplývají, a s pracovními a mzdovými podmínkami, za nichž má sjednanou práci konat.<br>
				2.	Není-li v pracovní smlouvě stanoveno jinak, řídí se práva a povinnosti zaměstnance a zaměstnavatele zákoníkem práce a souvisejícími právními předpisy.<br>
				3.	Pracovní smlouva byla sepsána ve dvou vyhotoveních, z nichž jedno obdrží zaměstnanec a jedno zaměstnavatel.<br>
			</div>
			<br>
			<br>
			V Brně dne '.date('d.m.Y',strtotime($userAgreementer->HIRE_FROM)).'<br>
			<br><br>
		</div>
		<div>
			<div style="float:left; padding-left:50px; width:250px">			
				<img src="'.base_url('images/vzor.png').'" width="120px">
			</div>
			<div style="float:left; padding-left:50px; width:250px">			
				<img src="'.base_url('images/vzor2.png').'" width="120px">
			</div>
			<div style="float:left; padding-left:55px; width:150px">			
				<b>'.$userLoader->USER_TITLE.' '.$userLoader->USER_FNAME.' '.$userLoader->USER_LNAME.'</b>
			</div>	
			<div style="float:left; padding-left:265px; width:150px">			
				<b>'.$userAgreementer->USER_TITLE.' '.$userAgreementer->USER_FNAME.' '.$userAgreementer->USER_LNAME.'</b>
			</div>				
		</div>
		</body>
		';
		$pdf->WriteHTML($html); 
		$pdf->Output("$output", 'I'); 
		exit(); 
	
		exit;
	}
	
	
	
	public function employeeAgreementDeletedPDF($user_id){
		$this->load->model('Users');
		$this->load->library('m_pdf'); 
		$this->load->helper('vypis_helper');
		$this->load->model('Settings');
		
		$pdf = $this->m_pdf->load(); 
		$pdf->setFooter('{PAGENO}');
		$pdf->setTitle('ZMD/'.$user_id.'/2017');		
		$userLoaderFunction = getFunction($this->session->userdata('permisson'));
		$userAgreementer = $this->Users->getUserDetailInfo($user_id);
		$userLoader = $this->Users->getUserDetailInfo($userAgreementer->USER_CREATE_USER_ID);
		$userAgreementerFunction = getFunction($userAgreementer->LOGIN_PERMISSON);
		$settings = $this->Settings->getSettingsByTime($userAgreementer->HIRE_FROM);
		$this->load->helper('agreement_helper');
		$formatted_user_id=getCorrectID($userAgreementer->USER_ID);
    switch ($userAgreementer->LOGIN_PERMISSON) {
			case 0:
				$sallary = 50000;
				break;
			case 1:
				$sallary = $settings->GENERAL_SALARY_LEADER;
				break;
			case 2:
				$sallary = $settings->GENERAL_SALARY_AUDITOR;
				break;
			case 3:
				$sallary = $settings->GENERAL_SALARY_BILLER;
				break;
			case 4:
				$sallary = $settings->GENERAL_SALARY_ADVISER;
				break;
			case 5:
				$sallary = 0;
				break;
		} 

		if ($userLoaderFunction == 'Admin'){
			$userLoaderFunction = 'Vedoucí zaměstnanec';
		}
		
		$data['title'] = "items"; 
		ini_set('memory_limit', '256M'); 		
		$html = '
		<body style="font-family: serif; font-size: 9pt;">
    <div style="font-family: "Times New Roman", Georgia, Serif; color: #4F5155; font-size:10px">
			<div style="width:330px; float:left">
				<img src="'.base_url('images/barcode.png').'" width="300px" height="20px">
			</div>
			<div style="width:310px; float: right">
				<img src="'.base_url('images/logo.png').'" width="300px">
			</div>
			<div style="width:330px; float:left">
				<span style="font-size:20px;"><br>Rozviazanie pracovnej zmluvy číslo<br>
				ZMD'.$formatted_user_id.''.substr($userAgreementer->HIRE_FROM,0,4).''.substr($userAgreementer->HIRE_FROM,5,2).''.substr($userAgreementer->HIRE_FROM,8,2).'<br></span>
			</div>
			<div style="border-bottom: 1px solid #4F5155; width: 100%"><br></div>
			<br>
			<div>
				<b>Mendelu pojišťovna, a.s.</b><br>
				IČ: 12585478, se sídlem Brno, Zemědelská 1, PSČ 630 00<br>
				jejímž jménem jedná: <b>'.$userLoader->USER_TITLE.' '.$userLoader->USER_FNAME.' '.$userLoader->USER_LNAME.'</b>,  na pozici '.$userLoaderFunction.',<br>
				jednajíci na základe plné moci ze dne <b>'.date('d.m.Y', strtotime($userLoader->HIRE_FROM)).'</b><br>
				(dále jako „<b>zaměstnavatel</b>“)
			</div>
			<div>
				<br>
				a
				<br>
				<br>
			</div>
			<div>
				Titul, příjmení, jméno zaměstnance: <b>'.$userAgreementer->USER_TITLE.' '.$userAgreementer->USER_FNAME.' '.$userAgreementer->USER_LNAME.'</b><br>
				Datum narození: <b>'.substr($userAgreementer->USER_PIN,4,2).'.'.substr($userAgreementer->USER_PIN,2,2).'.19'.substr($userAgreementer->USER_PIN,0,2).'</b><br>
				Adresa: (platná v den nástupu): '.$userAgreementer->ADRESS_STREET.' '.$userAgreementer->ADRESS_NUMBER.', '.$userAgreementer->ADRESS_POST.' '.$userAgreementer->ADRESS_CITY.', ('.$userAgreementer->STATE_SHORT.') '.$userAgreementer->STATE_NAME.'<br>
				(dále jako „<b>zaměstnanec</b>“)<br><br><br>
			</div>
			<div style="text-align:center">
				<span style="font-size:18px;"><b>uzavírají dle ustanovení § 49 zákoníku práce tuto zmluvu o rozvázání pracovního poměru: </b></span>
			</div>
			<div style="text-align: center">
				<br>
				<b>I.</b><br>
				<b>Základní podmínky</b><br><br>
			</div>
			<div>
				1. Druh práce: <br>
				   <span>Zaměstnanec bude vykonávat práci <b>'.$userAgreementerFunction.'</b>.</span><br>
				2. Místo výkonu práce:<br> 
				    <span>Místem výkonu práce je <b>Brno</b>.</span><br>
				3. Den nástupu do práce: <br>
				    <span>Zaměstnanec nastoupil do práce dne <b>'.date('d.m.Y', strtotime($userAgreementer->HIRE_FROM)).'</b>.</span><br>
			</div>
			<br><br><br>
			<div style="text-align:center">
				<span style="font-size:18px;"><b>K rozvázání pracovního poměru došlo na žádost zaměstnavatele.</b></span>
			</div>
			<br><br><br>
			<br><br><br><br><br><br><br><br>
			<div style="text-align:center">
				<span>Zmluva byla sepsána ve dvou vyhotoveních, z nichž jedno převzal Zaměstnavatel a jedno Zaměstnanec. </span><br>
			</div>
			<br><br><br>
			<div>
			<div style="float:left; padding-left:50px; width:250px">			
				<img src="'.base_url('images/vzor.png').'" width="120px">
			</div>
			<div style="float:left; padding-left:50px; width:250px">			
				<img src="'.base_url('images/vzor2.png').'" width="120px">
			</div>
			<div style="float:left; padding-left:55px; width:150px">			
				<b>'.$userLoader->USER_TITLE.' '.$userLoader->USER_FNAME.' '.$userLoader->USER_LNAME.'</b>
			</div>	
			<div style="float:left; padding-left:265px; width:150px">			
				<b>'.$userAgreementer->USER_TITLE.' '.$userAgreementer->USER_FNAME.' '.$userAgreementer->USER_LNAME.'</b>
			</div>				
		</div>
		</body>
			';
			$pdf->WriteHTML($html); 
		$pdf->Output("$output", 'I'); 
		exit(); 
	
		exit;
	}
		
		
	
	
	public function employeeAgreementTravelDefault($user_id, $agreement_id){
		$this->load->model('Users');
		$this->load->model('Agreements');
		$this->load->library('m_pdf'); 
		$this->load->helper('vypis_helper');
		
		$agreement = $this->Agreements->getUserAgreementTravel($agreement_id);
		$userLoader = $this->Users->getUserDetailInfo($user_id);
		$userLoaderFunction = getFunction($userLoader->LOGIN_PERMISSON);
		$userAgreementer = $this->Users->getUserDetailInfo($agreement->TRAVEL_USER_ID);
		$userAgreementerFunction = getFunction($userAgreementer->LOGIN_PERMISSON);
		$destination = getDestinationName($agreement->TRAVEL_DESTINATION);
		if ($agreement->TRAVEL_CURRENCY==2){
			$agreementPrice='<b>'.$agreement->TRAVEL_PRICE.' €</b> ('.(intval($agreement->TRAVEL_PRICE)*26.920).' CZK, přepočet CNB ke dni 29.4.2017)';
		} else {
			$agreementPrice='<b>'.$agreement->TRAVEL_PRICE.' CZE</b>';
		}
		$payType = getPayType($agreement->TRAVEL_PAY_TYPE);
		
		$pdf = $this->m_pdf->load(); 
		$pdf->setFooter('{PAGENO}');
		$pdf->setTitle('ZTP/'.$user_id.'/2017');

		$data['title'] = "items"; 
		ini_set('memory_limit', '256M'); 		
		$html = '
		<body style="font-family: serif; font-size: 9pt;">
		<div style="font-family: "Times New Roman", Georgia, Serif; color: #4F5155; font-size:10px">
			<div style="width:330px; float:left">
				<img src="'.base_url('images/barcode.png').'" width="300px" height="20px">
			</div>
			<div style="width:310px; float: right">
				<img src="'.base_url('images/logo.png').'" width="300px">
			</div>
			<div style="width:330px; float:left">
				<span style="font-size:22px;"><br>Cestovní pojištení<br>
				'.$agreement->TRAVEL_CODE.'<br></span>
			</div>
			<div style="border-bottom: 1px solid #4F5155; width: 100%"><br></div>
			<br>
			<div>
				<b>Mendelu pojišťovna, a.s.</b><br>
				IČ: 12585478, se sídlem Brno, Zemědelská 1, PSČ 630 00<br>
				jejímž jménem jedná: <b>'.$userLoader->USER_TITLE.' '.$userLoader->USER_FNAME.' '.$userLoader->USER_LNAME.'</b>,<br>
				jednajíci na základe plné moci ze dne <b>'.date('d.m.Y', strtotime($userLoader->HIRE_FROM)).'</b><br>
				(dále jako „<b>pojišťovatel</b>“)
			</div>
			<div>
				<br>
				a
				<br>
				<br>
			</div>
			<div>
				Titul, příjmení, jméno pojištence: <b>'.$userAgreementer->USER_TITLE.' '.$userAgreementer->USER_FNAME.' '.$userAgreementer->USER_LNAME.'</b><br>
				Datum narození: <b>'.substr($userAgreementer->USER_PIN,4,2).'.'.substr($userAgreementer->USER_PIN,2,2).'.19'.substr($userAgreementer->USER_PIN,0,2).'</b><br>
				Adresa: (platná v den založení pojištení): '.$userAgreementer->ADRESS_STREET.' '.$userAgreementer->ADRESS_NUMBER.', '.$userAgreementer->ADRESS_POST.' '.$userAgreementer->ADRESS_CITY.', ('.$userAgreementer->STATE_SHORT.') '.$userAgreementer->STATE_NAME.'<br>
				(dále jako „<b>pojištenec</b>“)<br><br><br>
			</div>
			<div style="text-align:center">
				<span style="font-size:18px;"><b>uzavírají smlouvu o cestovním pojištení</b></span>
			</div>
			
			<div style="text-align: center">
				<br>
				<b>I.</b><br>
				<b>Základní podmínky</b><br><br>
			</div>
			<div>
				1. Oblast platnosti smlouvy: <b>'.$destination.'</b><br>
				2. Datum začátku platnosti smlouvy: <b>'.date("d.m.Y",strtotime($agreement->TRAVEL_DATE_FROM)).'</b> (včetně).<br>
				3. Datum ukončení platnosti smlouvy: <b>'.date("d.m.Y",strtotime($agreement->TRAVEL_DATE_TO)).'</b> (včetně).<br>
			</div>
			<div style="text-align: center">
				<br>
				<b>II.</b><br>
				<b>Platební podmínky</b><br><br>
			</div>
			<div>
				1. Výše pojistného: '.$agreementPrice.'.<br>
				2. Způsob platby: <b>'.$payType.'</b> a to <b>jednorázově</b></b><br> 
				3. Výše pojistného a délka pojistného období jsou uvedeny v pojistné smlouvě. Běžné pojistné je splatné prvního dne pojistného období a jednorázové pojistné dnem počátku pojištění. <br>
				4. Není-li v pojistné smlouvě ujednáno jinak, považuje se pojistné za uhrazené dnem jeho připsáním na pojistitelem určený účet vedený u peněžního ústavu a pod pojistitelem určeným variabilním symbolem. Předchází-li tento den dni splatnosti pojistného, považuje se pojistné za uhrazené až dnem jeho splatnosti.  <br>
				5. Je-li výše pojistného závislá též na věku pojištěného, považuje se za jeho věk rozdíl mezi kalendářním rokem počátku pojištění a kalendářním rokem, v němž se pojištěný narodil. <br>
				6. Pojistitel má právo na pojistné za dobu do zániku pojištění, na jednorázové pojistné má právo za celou pojistnou dobu. <br>
				7. Nastala-li pojistná událost, v důsledku které pojištění zaniklo, náleží pojistiteli pojistné do konce pojistného období, v němž pojistná událost nastala; jednorázové pojistné náleží pojistiteli za celou dobu, na kterou bylo pojištění sjednáno. <br>
				8. Nebylo-li pojistné, na něž má pojistitel v souladu s odst. 4 a 5 tohoto článku právo,zaplaceno do tří měsíců od data zániku pojištění, je pojistník povinen zaplatit pojistiteli smluvní pokutu ve výši patnáct procent z pojistného, které k tomuto datu pojistiteli ještě dluží. <br>
			</div>
			<div style="text-align: center">
				<br>
				<b>III.</b><br>
				<b>Základní ustanovení</b><br><br>
			</div>
			<div>
				1. Pojištění vzniká na základě písemné pojistné smlouvy. <br>
				2. Jako písemné potvrzení o uzavření pojistné smlouvy vydá pojistitel pojistníkovi pojistku. <br>
				3. Dojde-li ke ztrátě, poškození nebo zničení pojistky, vydá pojistitel pojistníkovi na jeho žádost a náklady druhopis pojistky. Vystavením druhopisu pojistky pozbývá originál nebo již dříve vydané druhopisy platnosti. <br>
				4. Pojištění se sjednává na dobu vymezenou v pojistné smlouvě (pojistná doba). <br>
				5. Počátek pojištění je v 00:00 hodin dne sjednaného v pojistné smlouvě jako počátek pojištění.  <br>
				6. Konec pojištění je ve 24:00 hodin dne sjednaného v pojistné smlouvě jako konec pojištění, nezanikne-li pojištění v souladu s pojistnou smlouvou dříve. <br>
				7. Pojištění se z důvodu nezaplacení pojistného během pojistné doby nepřerušuje. <br>
			</div>
			
			
			
			<div style="width:330px; float:left">
				<img src="'.base_url('images/barcode.png').'" width="300px" height="20px">
			</div>
			<div style="width:310px; float: right">
				<img src="'.base_url('images/logo.png').'" width="300px">
			</div>
			<div style="width:330px; float:left">
				<span style="font-size:22px;"><br>Cestovní pojištení<br>
				'.$agreement->TRAVEL_CODE.'
			</div>
			<div style="border-bottom: 1px solid #4F5155; width: 100%"><br></div>
			<br>
			<div style="text-align: center">
				<br>
				<b>IV.</b><br>
				<b>Rozsah pojištění</b><br><br>
			</div>
			<div>
			1. Pojištění se sjednává jako cestovní pojištění, které je určeno k zabezpečení pojištěných při jejich cestách a pobytu mimo Českou republiku. <br>
			2. Cestovní pojištění se automaticky sjednává pro studijní, turistické cesty a pracovní cesty - administrativní činnosti. Pokud bylo v pojistné smlouvě sjednáno připojištění pracovních manuálních cest, vztahuje se pojištění i na pracovní manuální činnosti. <br>
			3. Cestovní pojištění v závislosti na pojistném programu obsahuje tato pojištění: a) pojištění léčebných výloh (PLV); b) pojištění asistenčních služeb (PAS); c) úrazové pojištění (ÚP); d) pojištění odpovědnosti (ODP); e) pojištění zavazadel (ZAV); f) pojištění cestování letadlem (PCL); <br>
			4. K cestovnímu pojištění lze sjednat jedno nebo více z následujících připojištění. Jednotlivá připojištění rozšiřují platnost cestovního pojištění, ke kterému jsou sjednána a nelze je sjednat samostatně.<br>
			a) připojištění rizikových sportů; <br>
			b) připojištění pracovních manuálních cest; <br>
			c) připojištění chronických onemocnění; <br>
			d) připojištění storna. <br> 
			5. Je-li k cestovnímu pojištění sjednáno připojištění storna, obsahuje pojištění rovněž pojištění storna cesty a dále se tímto připojištěním rozšiřuje platnost sjednaného cestovního pojištění o pojištění předčasného návratu a pojištění nevyužité dovolené. <br>
			</div>
			<div style="text-align: center">
				<br>
				<b>V.</b><br>
				<b>Územní platnost</b><br><br>
			</div>
			<div>
			1. Cestovní pojištění se vztahuje na pojistné události, které vznikly na území oblasti uvedené v pojistné smlouvě.  <br>
			2. Pojištění lze sjednat pro jednu z následujících územních oblastí: <br>
			a) Evropa: zeměpisná oblast Evropy, dále pak Turecko, Izrael, Tunisko, Kanárské ostrovy, Egypt a Gruzie <br>
			nebo <br>
			b) Celý svět: všechny státy a území světa. <br>
			3. Cestovní pojištění se nevztahuje na události, které vznikly na území: <br>
			a) České republiky, není-li dále v pojistných podmínkách uvedeno jinak; <br>
			b) státu, jehož je pojištěný státním občanem nebo ve kterém má pojištěný trvalé bydliště nebo je účastníkem veřejného zdravotního pojištění, není-li pojistitelem stanoveno jinak; výjimkou je případ, kdy má pojištěný trvalý nebo přechodný pobyt v České republice a současně je účastníkem veřejného zdravotního nebo obdobného pojištění v České republice, potom se cestovní pojištění vztahuje i na události, které vznikly v zemi, jejímž je státním občanem; <br>
			c) státu, na jehož území se pojištěný zdržuje nelegálně; <br>
			d) státu, jenž není předmětem pojištění. <br>
			4. Pokud bylo sjednáno připojištění storna, vztahuje se pojištění storna na pojistné události, které vznikly na území celého světa; pojištění nevyužité dovolené a pojištění předčasného návratu se vztahuje na pojistné události, které vznikly na území oblasti uvedené v pojistné smlouvě. <br>
			5. Pojistit lze občany ČR i cizí státní příslušníky. <br>
			</div>
			<div style="text-align: center">
				<br>
				<b>VI.</b><br>
				<b>Změny pojištění</b><br><br>
			</div>
			<div>
			1. Není-li v pojistné smlouvě nebo v obecně závazných právních předpisech stanoveno jinak, realizují se jakékoliv změny týkající se pojištění již sjednaného včetně změn jeho rozsahu na základě vzájemné dohody smluvních stran. Dohoda mezi smluvními stranami musí mít písemnou formu, jinak je neplatná. <br>
			</div>
			<br>
			<br>
			<br>
			<br>
			
			
			<div style="width:330px; float:left">
				<img src="'.base_url('images/barcode.png').'" width="300px" height="20px">
			</div>
			<div style="width:310px; float: right">
				<img src="'.base_url('images/logo.png').'" width="300px">
			</div>
			<div style="width:330px; float:left">
				<span style="font-size:22px;"><br>Cestovní pojištení<br>
				'.$agreement->TRAVEL_CODE.'
			</div>
			<div style="border-bottom: 1px solid #4F5155; width: 100%"><br></div>
			<br>
			<div style="text-align: center">
				<br>
				<b>VII.</b><br>
				<b>Zánik pojištění</b><br><br>
			</div>
			<div>
			1.Pojištění zaniká: <br>
			a) uplynutím pojistné doby; <br>
			b) písemnou dohodou smluvních stran; <br>
			c) výpovědí pojistitele nebo pojistníka; <br>
			d) dalšími způsoby uvedenými v občanském zákoníku. <br>
			2. Písemnou dohodou je možné ukončit pojištění pouze za předpokladu, že písemná dohoda bude uzavřena nejpozději v den uvedený v pojistné smlouvě jako den po- čátku cestovního pojištění; dohoda musí obsahovat způsob vzájemného vyrovnání závazků smluvních stran. V případě zániku pojištění dohodou je pojistitel oprávněn snížit vracené pojistné o náklady o náklady spojené s uzavřením pojistné smlouvy a její správou, jež činí 20% předepsaného pojistného. Pojistník a pojištěný jsou povinni vrátit pojistiteli všechny dokumenty stvrzující sjednání cestovního pojištění. <br>
			3. Zanikne-li cestovní pojištění před uplynutím pojistné doby z jiného důvodu než uvedeného v předchozím odstavci, náleží pojistiteli pojistné do konce pojistné doby, není-li v občanském zákoníku nebo v pojistné smlouvě uvedeno jinak. <br>
			4. Pojištění nemůže být během pojistné doby přerušeno. <br>
			</div>
			<div style="text-align: center">
				<br>
				<b>VIII.</b><br>
				<b>Práva a povinnosti</b><br><br>
			</div>
			<div>
			1. Kromě povinností stanovených občanským zákoníkem a pojistnou smlouvou má pojistitel dále tyto povinnosti: <br>
			a) projednávat s pojištěným nebo osobou, která uplatňuje právo na pojistné plnění výsledky šetření události nebo mu tyto výsledky bez zbytečného odkladu oznámit; <br>
			b) požadovat dle vlastního uvážení originální doklady potřebné pro poskytnutí pojistného plnění, zejména originály účtů a další originální doklady prokazující skutečné náklady vynaložené pojištěným; <br>
			c) vrátit pojištěnému originály dokladů předaných pojistiteli, jejichž navrácení si pojištěný vyžádá, s výjimkou originálních dokladů o zaplacení, na základě kterých bylo poskytnuto pojistné plnění. <br>
			2. Pojistitel je oprávněn zejména: <br>
			a) prověřit vznik, průběh a rozsah škodné události (včetně vyžádání svědeckých výpovědí zúčastněných osob, znaleckých posudků, případně dalších dokladů); <br>
			b) požadovat a prověřit lékařské zprávy, výpisy z individuálního účtu pojištěnce ze zdravotních pojišťoven. <br>
			3. Pokud pojištěný porušil povinnosti stanovené v těchto VPPCP, je pojistitel oprávněn pojistné plnění úměrně tomu snížit nebo odmítnout. <br>
			4. Pokud pojištěný porušil povinnosti uvedené v těchto VPPCP a v důsledku tohoto porušení byly vyvolány nebo zvýšeny náklady šetření škodné události vynaložené pojistitelem, je pojistitel oprávněn požadovat po pojištěném náhradu těchto nákladů. <br>
			</div>
			<div>
			<br><br><br><br><br><br><br><br><br><br><br><br>
			<div style="float:left; padding-left:50px; width:250px">			
				<img src="'.base_url('images/vzor.png').'" width="120px">
			</div>
			<div style="float:left; padding-left:50px; width:250px">			
				<img src="'.base_url('images/vzor2.png').'" width="120px">
			</div>
			<div style="float:left; padding-left:55px; width:150px">			
				<b>'.$userLoader->USER_TITLE.' '.$userLoader->USER_FNAME.' '.$userLoader->USER_LNAME.'</b>
			</div>	
			<div style="float:left; padding-left:265px; width:150px">			
				<b>'.$userAgreementer->USER_TITLE.' '.$userAgreementer->USER_FNAME.' '.$userAgreementer->USER_LNAME.'</b>
			</div>				
		</div>

		';
		$pdf->WriteHTML($html); 
		$pdf->Output("$output", 'I'); 
		exit(); 
	
		exit;
		
	}
	
	
	public function employeeAgreementTravelDeaktivated($user_id, $agreement_id){
		$this->load->model('Users');
		$this->load->model('Agreements');
		$this->load->library('m_pdf'); 
		$this->load->helper('vypis_helper');
		
		
		$agreement = $this->Agreements->getUserAgreementTravel($agreement_id);
		$userLoader = $this->Users->getUserDetailInfo($user_id);
		$userLoaderFunction = getFunction($userLoader->LOGIN_PERMISSON);
		$userAgreementer = $this->Users->getUserDetailInfo($agreement->TRAVEL_USER_ID);
		$userAgreementerFunction = getFunction($userAgreementer->LOGIN_PERMISSON);
		$destination = getDestinationName($agreement->TRAVEL_DESTINATION);
		if ($agreement->TRAVEL_CURRENCY==2){
			$agreementPrice='<b>'.$agreement->TRAVEL_PRICE.' €</b> ('.(intval($agreement->TRAVEL_PRICE)*26.920).' CZK, přepočet CNB ke dni 29.4.2017)';
		} else {
			$agreementPrice='<b>'.$agreement->TRAVEL_PRICE.' CZE</b>';
		}
		$userDeleter = $this->Users->getUserDetailInfo($agreement->TRAVEL_MODIFY_USER);
		
		$this->load->helper('agreement_helper');
		$formatted_user_id=getCorrectID($agreement->TRAVEL_USER_ID);
		
		$pdf = $this->m_pdf->load(); 
		$pdf->setFooter('{PAGENO}');
		$pdf->setTitle('ZMD/'.$user_id.'/2017');

		$data['title'] = "items"; 
		ini_set('memory_limit', '256M'); 		
		$html = '
		<body style="font-family: serif; font-size: 9pt;">
		<div style="font-family: "Times New Roman", Georgia, Serif; color: #4F5155; font-size:10px">
			<div style="width:330px; float:left">
				<img src="'.base_url('images/barcode.png').'" width="300px" height="20px">
			</div>
			<div style="width:310px; float: right">
				<img src="'.base_url('images/logo.png').'" width="300px">
			</div>
			<div style="width:330px; float:left">
				<span style="font-size:22px;"><br>Odstúpení cestovního pojištení<br>
				ZTD'.$formatted_user_id.''.substr($agreement->TRAVEL_DATE_FROM,0,4).''.substr($agreement->TRAVEL_DATE_FROM,5,2).''.substr($agreement->TRAVEL_DATE_FROM,8,2).'<br></span>
			</div>
			<div style="border-bottom: 1px solid #4F5155; width: 100%"><br></div>
			<br>
			<div>
				<b>Mendelu pojišťovna, a.s.</b><br>
				IČ: 12585478, se sídlem Brno, Zemědelská 1, PSČ 630 00<br>
				jejímž jménem jedná: <b>'.$userLoader->USER_TITLE.' '.$userLoader->USER_FNAME.' '.$userLoader->USER_LNAME.'</b>,<br>
				jednajíci na základe plné moci ze dne <b>'.date('d.m.Y', strtotime($userLoader->HIRE_FROM)).'</b><br>
				(dále jako „<b>pojišťovatel</b>“)
			</div>
			<div>
				<br>
				a
				<br>
				<br>
			</div>
			<div>
				Titul, příjmení, jméno pojištence: <b>'.$userAgreementer->USER_TITLE.' '.$userAgreementer->USER_FNAME.' '.$userAgreementer->USER_LNAME.'</b><br>
				Datum narození: <b>'.substr($userAgreementer->USER_PIN,4,2).'.'.substr($userAgreementer->USER_PIN,2,2).'.19'.substr($userAgreementer->USER_PIN,0,2).'</b><br>
				Adresa: (platná v den založení pojištení): '.$userAgreementer->ADRESS_STREET.' '.$userAgreementer->ADRESS_NUMBER.', '.$userAgreementer->ADRESS_POST.' '.$userAgreementer->ADRESS_CITY.', ('.$userAgreementer->STATE_SHORT.') '.$userAgreementer->STATE_NAME.'<br>
				(dále jako „<b>pojištenec</b>“)<br><br><br>
			</div>
			<div style="text-align:center">
				<span style="font-size:18px;"><b>uzavírají dle ustanovení § 800 ods. 1 Občianskeho zákonníka tuhle smlouvu o rozvázaní poistního poměru:</b></span>
			</div>
			<br>
			<div style="text-align: center">
				<br>
				<b>I.</b><br>
				<b>Návaznosti smlouvy</b><br><br>
			</div>
			<div>
				1. Identifikační číslo smlouvy na kterú se tahle smlouva váže: <b>'.$agreement->TRAVEL_CODE.'</b><br>
			</div>
			<div style="text-align: center">
				<br>
				<b>II.</b><br>
				<b>Dodatečné informace</b><br><br>
			</div>
			<div>
			1. Oblast platnosti smlouvy: <b>'.$destination.'</b><br>
			2. Datum začátku platnosti smlouvy: <b>'.date("d.m.Y",strtotime($agreement->TRAVEL_DATE_FROM)).'</b> (včetně).<br>
			3. Datum ukončení platnosti smlouvy: <b>'.date("d.m.Y",strtotime($agreement->TRAVEL_DATE_TO)).'</b> (včetně).<br>
			4. Výše pojištění: '.$agreementPrice.'
			</div>
			<br><br>
			<div style="text-align:center">
				<span style="font-size:18px;"><b>K rozvázání pracovního poměru došlo na žádost pojištence,</b></span><br>
			</div>
			<br>
			<div style="text-align:center">
			pojištěnec se tímto vzdává všech plateb které uhradil pojišťovně.
			</div>
			<br><br><br><br><br><br><br><br><br><br><br>
			<div style="float:left; padding-left:50px; width:250px">			
				<img src="'.base_url('images/vzor.png').'" width="120px">
			</div>
			<div style="float:left; padding-left:50px; width:250px">			
				<img src="'.base_url('images/vzor2.png').'" width="120px">
			</div>
			<div style="float:left; padding-left:55px; width:150px">			
				<b>'.$userDeleter->USER_TITLE.' '.$userDeleter->USER_FNAME.' '.$userDeleter->USER_LNAME.'</b>
			</div>	
			<div style="float:left; padding-left:265px; width:150px">			
				<b>'.$userAgreementer->USER_TITLE.' '.$userAgreementer->USER_FNAME.' '.$userAgreementer->USER_LNAME.'</b>
			</div>	
		';
		$pdf->WriteHTML($html); 
		$pdf->Output("$output", 'I'); 
		exit(); 
	
		exit;
	}
	
	
	
	
	
	public function employeeAgreementLifeDefault($user_id, $agreement_id){
		$this->load->model('Users');
		$this->load->model('Agreements');
		$this->load->library('m_pdf'); 
		$this->load->helper('vypis_helper');
		
		$agreement = $this->Agreements->getUserAgreementLife($agreement_id);
		$userLoader = $this->Users->getUserDetailInfo($user_id);
		$userLoaderFunction = getFunction($userLoader->LOGIN_PERMISSON);
		$userAgreementer = $this->Users->getUserDetailInfo($agreement->LIFE_USER_ID);
		$userAgreementerFunction = getFunction($userAgreementer->LOGIN_PERMISSON);
		
		if ($agreement->LIFE_CURRENCY=='Eur'){
			$agreementPrice='<b>'.$agreement->LIFE_PRICE.' €</b> ('.(intval($agreement->LIFE_PRICE)*26.920).' CZK, přepočet CNB ke dni 29.4.2017)';
		} else {
			$agreementPrice='<b>'.$agreement->LIFE_PRICE.' CZE</b>';
		}
		$payFrequency = getLifeFrequency($agreement->LIFE_FREQUENCY);
		
		$pdf = $this->m_pdf->load(); 
		$pdf->setFooter('{PAGENO}');
		$pdf->setTitle('ZLP/'.$user_id.'/2017');
		
		$html = '
		<body style="font-family: serif; font-size: 9pt;">
		<div style="font-family: "Times New Roman", Georgia, Serif; color: #4F5155; font-size:10px">
			<div style="width:330px; float:left">
				<img src="'.base_url('images/barcode.png').'" width="300px" height="20px">
			</div>
			<div style="width:310px; float: right">
				<img src="'.base_url('images/logo.png').'" width="300px">
			</div>
			<div style="width:330px; float:left">
				<span style="font-size:22px;"><br>Cestovní pojištení<br>
				'.$agreement->LIFE_CODE.'<br></span>
			</div>
			<div style="border-bottom: 1px solid #4F5155; width: 100%"><br></div>
			<br>
			<div>
				<b>Mendelu pojišťovna, a.s.</b><br>
				IČ: 12585478, se sídlem Brno, Zemědelská 1, PSČ 630 00<br>
				jejímž jménem jedná: <b>'.$userLoader->USER_TITLE.' '.$userLoader->USER_FNAME.' '.$userLoader->USER_LNAME.'</b>,<br>
				jednajíci na základe plné moci ze dne <b>'.date('d.m.Y', strtotime($userLoader->HIRE_FROM)).'</b><br>
				(dále jako „<b>pojišťovatel</b>“)
			</div>
			<div>
				<br>
				a
				<br>
				<br>
			</div>
			<div>
				Titul, příjmení, jméno pojištence: <b>'.$userAgreementer->USER_TITLE.' '.$userAgreementer->USER_FNAME.' '.$userAgreementer->USER_LNAME.'</b><br>
				Datum narození: <b>'.substr($userAgreementer->USER_PIN,4,2).'.'.substr($userAgreementer->USER_PIN,2,2).'.19'.substr($userAgreementer->USER_PIN,0,2).'</b><br>
				Adresa: (platná v den založení pojištení): '.$userAgreementer->ADRESS_STREET.' '.$userAgreementer->ADRESS_NUMBER.', '.$userAgreementer->ADRESS_POST.' '.$userAgreementer->ADRESS_CITY.', ('.$userAgreementer->STATE_SHORT.') '.$userAgreementer->STATE_NAME.'<br>
				(dále jako „<b>pojištenec</b>“)<br><br><br>
			</div>
			<div style="text-align:center">
				<span style="font-size:18px;"><b>uzavírají smlouvu o životním pojištení</b></span>
			</div>
			
			<div style="text-align: center">
				<br>
				<b>I.</b><br>
				<b>Základní podmínky</b><br><br>
			</div>
			<div>
				1. Datum začátku platnosti smlouvy: <b>'.date("d.m.Y",strtotime($agreement->LIFE_DATE_FROM)).'</b> (včetně).<br>
				2. Datum ukončení platnosti smlouvy: <b>'.date("d.m.Y",strtotime($agreement->LIFE_DATE_TO)).'</b> (včetně).<br>
				3. Výše platby: '.$agreementPrice.'<br>
				4. Frekvence plateb: <b>'.$payFrequency.'</b>
			</div>
			<div style="text-align: center">
				<br>
				<b>II.</b><br>
				<b>Základní ustanovení</b><br><br>
			</div>
			1. Pojištění vzniká na základě písemné pojistné smlouvy. <br>
			2. Jako písemné potvrzení o uzavření pojistné smlouvy vydá pojistitel pojistníkovi pojistku. <br>
			3. Dojde-li ke ztrátě, poškození nebo zničení pojistky, vydá pojistitel pojistníkovi na jeho žádost a náklady druhopis pojistky. Vystavením druhopisu pojistky pozbývá originál nebo již dříve vydané druhopisy platnosti. <br>
			4. Pojištění se sjednává na dobu vymezenou v pojistné smlouvě (pojistná doba). <br>
			5. Počátek pojištění je v 00:00 hodin dne sjednaného v pojistné smlouvě jako počátek pojištění.  <br>
			6. Konec pojištění je ve 24:00 hodin dne sjednaného v pojistné smlouvě jako konec pojištění, nezanikne-li pojištění v souladu s pojistnou smlouvou dříve. <br>
			7. Pojištění se z důvodu nezaplacení pojistného během pojistné doby nepřerušuje. <br>
			<div style="text-align: center">
				<br>
				<b>III.</b><br>
				<b>Pojistné</b><br><br>
			</div>
			<div>
			1. Výše pojistného a délka pojistného období jsou uvedeny v pojistné smlouvě. Běžné pojistné je splatné prvního dne pojistného období a jednorázové pojistné dnem počátku pojištění. <br>
			2. Není-li v pojistné smlouvě ujednáno jinak, považuje se pojistné za uhrazené dnem jeho připsáním na pojistitelem určený účet vedený u peněžního ústavu a pod pojistitelem určeným variabilním symbolem. Předchází-li tento den dni splatnosti pojistného, považuje se pojistné za uhrazené až dnem jeho splatnosti.  <br>
			3. Je-li výše pojistného závislá též na věku pojištěného, považuje se za jeho věk rozdíl mezi kalendářním rokem počátku pojištění a kalendářním rokem, v němž se pojištěný narodil. <br>
			4. Pojistitel má právo na pojistné za dobu do zániku pojištění, na jednorázové pojistné má právo za celou pojistnou dobu. <br>
			5. Nastala-li pojistná událost, v důsledku které pojištění zaniklo, náleží pojistiteli pojistné do konce pojistného období, v němž pojistná událost nastala; jednorázové pojistné náleží pojistiteli za celou dobu, na kterou bylo pojištění sjednáno. <br>
			6. Nebylo-li pojistné, na něž má pojistitel v souladu s odst. 4 a 5 tohoto článku právo,zaplaceno do tří měsíců od data zániku pojištění, je pojistník povinen zaplatit pojistiteli smluvní pokutu ve výši patnáct procent z pojistného, které k tomuto datu pojistiteli ještě dluží. <br>
			</div>
			<div style="width:330px; float:left">
				<img src="'.base_url('images/barcode.png').'" width="300px" height="20px">
			</div>
			<div style="width:310px; float: right">
				<img src="'.base_url('images/logo.png').'" width="300px">
			</div>
			<div style="width:330px; float:left">
				<span style="font-size:22px;"><br>Cestovní pojištení<br>
				'.$agreement->LIFE_CODE.'<br></span>
			</div>
			<div style="border-bottom: 1px solid #4F5155; width: 100%"><br></div>
			<div style="text-align: center">
				<br>
				<b>IV.</b><br>
				<b>Rozsah pojištění</b><br><br>
			</div>
			<div>
			1. Pojištění smrti z jakýchkoliv příčin a dožití <br>
			2. Pojištění smrti následkem úrazu <br>
			3. Pojištění trvalých následků úrazu <br>
			4. Pojištění vážných nemocí a úrazů <br>
			</div>
			<div style="text-align: center">
				<br>
				<b>V.</b><br>
				<b>Změny pojištění</b><br><br>
			</div>
			<div>
			1. Není-li v pojistné smlouvě nebo v obecně závazných právních předpisech stanoveno jinak, realizují se jakékoliv změny týkající se pojištění již sjednaného včetně změn jeho rozsahu na základě vzájemné dohody smluvních stran. Dohoda mezi smluvními stranami musí mít písemnou formu, jinak je neplatná. <br>
			</div>
			<div style="text-align: center">
				<br>
				<b>VI.</b><br>
				<b>Zánik pojištění</b><br><br>
			</div>
			<div>
			Pojištění zaniká:<br> 
			a) uplynutím pojistné doby, není-li v pojistné smlouvě ujednáno jinak, <br>
			b) smrtí pojištěného, není-li v pojistné smlouvě ujednáno jinak, <br>
			c) písemnou dohodou smluvních stran; v dohodě musí být určen okamžik zániku pojištění a způsob vzájemného vyrovnání závazků, <br>
			d) dnem následujícím po marném uplynutí lhůty stanovené pojistitelem v upomínce k zaplacení pojistného nebo jeho části, doručené pojistníkovi, není-li v pojistné smlouvě ujednáno jinak, <br>
			e) odstoupením pojistníka nebo pojistitele od pojistné smlouvy ve smyslu zákona o pojistné smlouvě,  <br> 
			f) odmítnutím plnění ze strany pojistitele ve smyslu zákona o pojistné smlouvě, <br>
			g) výpovědí dle čl. 6 těchto VPP,  <br>
			h) jiným způsobem uvedeným v pojistné smlouvě nebo v zákoně o pojistné smlouvě. 2. Veškerá pojištění sjednaná dle odst. 2 Úvodních ustanovení těchto VPP v jedné pojistné smlouvě s životním pojištěním zanikají nejpozději zánikem tohoto životního pojištění. <br>
			</div>
			<div style="text-align: center">
				<br>
				<b>VII.</b><br>
				<b>Práva a povinnosti</b><br><br>
			</div>
			<div>
			1. Pojistník a pojištěný jsou povinni pravdivě a úplně odpovědět na všechny písemné dotazy pojistitele týkající se sjednávaného pojištění. To platí i v případě, že jde o změnu pojištění. Stejnou povinnost má pojistitel vůči pojistníkovi a pojištěnému. <br>
			2. Pojistník má právo kdykoliv během trvání pojištění písemně požadovat na pojistiteli sdělení o tom, kolik by činila výše odkupného. Pojistitel výši odkupného sdělí ve lhůtě jednoho měsíce ode dne obdržení písemné žádosti pojistníka. Pojistitel má právo na úhradu nákladů, které mu sdělením výše odkupného pojistníkovi vzniknou. <br>
			3. Pojistník je povinen bez zbytečného odkladu pojistiteli oznámit, že nastala pojistná událost, podat pravdivé vysvětlení o vzniku a rozsahu následků této události, předložit k tomu potřebné doklady a postupovat způsobem dohodnutým v pojistné smlouvě. Není-li pojistník současně pojištěným, má tuto povinnost pojištěný; je-li pojistnou událostí smrt pojištěného, má tuto povinnost oprávněná osoba. <br>
			4. Ujednává se, že osoba, která je dle odst. 3 tohoto článku povinna bez zbytečného odkladu pojistiteli oznámit, že pojistná událost nastala, tuto povinnost splní až písemným oznámením pojistné události na příslušném tiskopisu pojistitele. Tato osoba je povinna předložit i další doklady požadované pojistitelem, pokud mají vliv na stanovení povinnosti pojistitele plnit a/nebo na výši pojistného plnění. Pojistitel rovněž může provést šetření pojistné události sám. 2 <br>
			5. Je-li pojistnou událostí smrt pojištěného, pojistitel při oznámení pojistné události dle odst. 3 tohoto článku vždy požaduje i předložení pojistky, ověřené kopie úmrtního listu a podrobné lékařské nebo úřední zprávy o příčině smrti; v případě dožití se dne konce pojištění pojištěným požaduje pojistitel vždy i předložení pojistky. <br>
			<br><br>
			<div style="width:330px; float:left">
				<img src="'.base_url('images/barcode.png').'" width="300px" height="20px">
			</div>
			<div style="width:310px; float: right">
				<img src="'.base_url('images/logo.png').'" width="300px">
			</div>
			<div style="width:330px; float:left">
				<span style="font-size:22px;"><br>Cestovní pojištení<br>
				'.$agreement->LIFE_CODE.'<br></span>
			</div>
			<div style="border-bottom: 1px solid #4F5155; width: 100%"><br></div>
			<br>
			6. Pojistitel je povinen po oznámení pojistné události v souladu s odst. 3 a 4 tohoto článku bez zbytečného odkladu zahájit šetření nutné ke zjištění rozsahu jeho povinnosti plnit a ukončit je do 3 měsíců po tom, co mu byla tato událost oznámena. Nemůže-li ukončit šetření v této lhůtě, je povinen sdělit osobě, které má vzniknout právo na pojistné plnění, důvody, pro které nelze šetření ukončit, a poskytnout jí na její písemnou žádost přiměřenou zálohu. Výše uvedenou lhůtu 3 měsíců lze dohodou prodloužit. Tato lhůta neběží, je-li šetření znemožněno nebo ztíženo z viny oprávněné osoby, pojistníka nebo pojištěného. <br>
			7. Oprávněná osoba je povinna podrobit se identifikaci v souladu se zákonem č. 61/1996 Sb., o některých opatřeních proti legalizaci výnosů z trestné činnosti, ve znění pozdějších předpisů. <br>
			8. Pojistitel má právo na pojistné za sjednané pojištění a pojistník je povinen hradit je řádně a včas. <br>
			9. Pojistník je dále povinen: a) bez zbytečného odkladu pojištěnému oznámit, že v jeho prospěch bylo sjednáno pojištění, a seznámit pojištěného s právy a povinnostmi, které pro něho ze sjednaného pojištění vyplývají, b) bez zbytečného odkladu pojistiteli písemně oznámit všechny změny osobních a jiných identifikačních údajů, které byly zjišťovány při sjednávání pojištění nebo jeho změně, jakož i jiné údaje, na které byl v této souvislosti tázán. <br>
			10. Pojistitel je povinen zachovávat mlčenlivost o skutečnostech týkajících se pojištění fyzických a právnických osob, jakož i o skutečnostech, které se dozví při sjednávání pojištění, jeho správě a při likvidaci pojistných událostí. Poskytnout tuto informaci může jen se souhlasem pojištěného, nebo pokud tak stanoví obecně závazné právní předpisy. <br>
			11. Účastníci pojištění mají dále kromě práv a povinností uvedených v těchto VPP práva a povinnosti uvedené v pojistné smlouvě a stanovené obecně závaznými právními předpisy. <br>
			</div>
			<div style="text-align: center">
				<br>
				<b>VIII.</b><br>
				<b>Nároky z pojištění pro případ smrti nebo dožití</b><br><br>
			</div>
			<div>
			1. Dožije-li se pojištěný sjednaného konce pojištění, vyplatí mu pojistitel hodnotu pojištění ve výši určené k datu ukončení šetření pojistné události pojistitelem. <br>
			2. Zemře-li pojištěný v době trvání základního pojištění a není-li v pojistné smlouvě v rámci základního pojištění sjednána pojistná částka pro případ smrti, pojistitel vyplatí tomu, komu smrtí pojištěného vznikne právo na pojistné plnění, hodnotu pojištění ve výši určené k datu ukončení šetření pojistné události pojistitelem. <br>
			3. Zemře-li pojištěný v době trvání základního pojištění a je-li v pojistné smlouvě v rámci základního pojištění sjednána pojistná částka pro případ smrti ve variantě P, pojistitel vyplatí tomu, komu smrtí pojištěného vznikne právo na pojistné plnění, pojistnou částku pro případ smrti sjednanou v pojistné smlouvě k datu úmrtí pojištěného a hodnotu pojištění ve výši určené k datu ukončení šetření pojistné události pojistitelem. <br>
			4. Zemře-li pojištěný v době trvání základního pojištění a je-li v pojistné smlouvě v rámci základního pojištění sjednána pojistná částka pro případ smrti ve variantě D, pojistitel vyplatí tomu, komu smrtí pojištěného vznikne právo na pojistné plnění, <br>
			a) pojistnou částku pro případ smrti sjednanou v pojistné smlouvě k datu úmrtí pojištěného nebo hodnotu pojištění vytvořenou na základě zaplacení běžného a dodatečného běžného pojistného ve výši určené k datu ukončení šetření pojistné události pojistitelem, je-li tato vyšší než sjednaná pojistná částka a dále pak vyplatí. <br>
			b) hodnotu pojištění vytvořenou na základě zaplacení mimořádného pojistného ve výši určené k datu ukončení šetření pojistné události pojistitelem. <br>
			</div>

			<br><br><br><br><br><br><br>
			<div style="float:left; padding-left:50px; width:250px">			
				<img src="'.base_url('images/vzor.png').'" width="120px">
			</div>
			<div style="float:left; padding-left:50px; width:250px">			
				<img src="'.base_url('images/vzor2.png').'" width="120px">
			</div>
			<div style="float:left; padding-left:55px; width:150px">			
				<b>'.$userLoader->USER_TITLE.' '.$userLoader->USER_FNAME.' '.$userLoader->USER_LNAME.'</b>
			</div>	
			<div style="float:left; padding-left:265px; width:150px">			
				<b>'.$userAgreementer->USER_TITLE.' '.$userAgreementer->USER_FNAME.' '.$userAgreementer->USER_LNAME.'</b>
			</div>	
		</div>

		';
		$pdf->WriteHTML($html); 
		$pdf->Output("$output", 'I'); 
		exit(); 
	
		exit;
	}
	
	
	
	
	public function employeeAgreementLifeDeaktivated($user_id, $agreement_id){
		$this->load->model('Users');
		$this->load->model('Agreements');
		$this->load->library('m_pdf'); 
		$this->load->helper('vypis_helper');
		
		$agreement = $this->Agreements->getUserAgreementLife($agreement_id);
		$userLoader = $this->Users->getUserDetailInfo($user_id);
		$userLoaderFunction = getFunction($userLoader->LOGIN_PERMISSON);
		$userAgreementer = $this->Users->getUserDetailInfo($agreement->LIFE_USER_ID);
		$userAgreementerFunction = getFunction($userAgreementer->LOGIN_PERMISSON);
		
		if ($agreement->LIFE_CURRENCY=='Eur'){
			$agreementPrice='<b>'.$agreement->LIFE_PRICE.' €</b> ('.(intval($agreement->LIFE_PRICE)*26.920).' CZK, přepočet CNB ke dni 29.4.2017)';
		} else {
			$agreementPrice='<b>'.$agreement->LIFE_PRICE.' CZE</b>';
		}
		$payFrequency = getLifeFrequency($agreement->LIFE_FREQUENCY);
		$userDeleter = $this->Users->getUserDetailInfo($agreement->LIFE_MODIFY_USER);
		$destination = "Česká republika";
		$this->load->helper('agreement_helper');
		$formatted_user_id=getCorrectID($agreement->LIFE_USER_ID);
		$pdf = $this->m_pdf->load(); 
		$pdf->setFooter('{PAGENO}');
		$pdf->setTitle('ZM/'.$user_id.'/2017');
		
		$data['title'] = "items"; 
		ini_set('memory_limit', '256M'); 		
		$html = '
		<body style="font-family: serif; font-size: 9pt;">
		<div style="font-family: "Times New Roman", Georgia, Serif; color: #4F5155; font-size:10px">
			<div style="width:330px; float:left">
				<img src="'.base_url('images/barcode.png').'" width="300px" height="20px">
			</div>
			<div style="width:310px; float: right">
				<img src="'.base_url('images/logo.png').'" width="300px">
			</div>
			<div style="width:330px; float:left">
				<span style="font-size:22px;"><br>Odstúpení životního pojištení<br>
				ZLD'.$formatted_user_id.''.substr($agreement->LIFE_DATE_FROM,0,4).''.substr($agreement->LIFE_DATE_FROM,5,2).''.substr($agreement->LIFE_DATE_FROM,8,2).'<br></span>
			</div>
			<div style="border-bottom: 1px solid #4F5155; width: 100%"><br></div>
			<br>
			<div>
				<b>Mendelu pojišťovna, a.s.</b><br>
				IČ: 12585478, se sídlem Brno, Zemědelská 1, PSČ 630 00<br>
				jejímž jménem jedná: <b>'.$userLoader->USER_TITLE.' '.$userLoader->USER_FNAME.' '.$userLoader->USER_LNAME.'</b>,<br>
				jednajíci na základe plné moci ze dne <b>'.date('d.m.Y', strtotime($userLoader->HIRE_FROM)).'</b><br>
				(dále jako „<b>pojišťovatel</b>“)
			</div>
			<div>
				<br>
				a
				<br>
				<br>
			</div>
			<div>
				Titul, příjmení, jméno pojištence: <b>'.$userAgreementer->USER_TITLE.' '.$userAgreementer->USER_FNAME.' '.$userAgreementer->USER_LNAME.'</b><br>
				Datum narození: <b>'.substr($userAgreementer->USER_PIN,4,2).'.'.substr($userAgreementer->USER_PIN,2,2).'.19'.substr($userAgreementer->USER_PIN,0,2).'</b><br>
				Adresa: (platná v den založení pojištení): '.$userAgreementer->ADRESS_STREET.' '.$userAgreementer->ADRESS_NUMBER.', '.$userAgreementer->ADRESS_POST.' '.$userAgreementer->ADRESS_CITY.', ('.$userAgreementer->STATE_SHORT.') '.$userAgreementer->STATE_NAME.'<br>
				(dále jako „<b>pojištenec</b>“)<br><br><br>
			</div>
			<div style="text-align:center">
				<span style="font-size:18px;"><b>uzavírají dle ustanovení § 800 ods. 1 Občianskeho zákonníka tuhle smlouvu o rozvázaní poistního poměru:</b></span>
			</div>
			<br>
			<div style="text-align: center">
				<br>
				<b>I.</b><br>
				<b>Návaznosti smlouvy</b><br><br>
			</div>
			<div>
				1. Identifikační číslo smlouvy na kterú se tahle smlouva váže: <b>'.$agreement->LIFE_CODE.'</b><br>
			</div>
			<div style="text-align: center">
				<br>
				<b>II.</b><br>
				<b>Dodatečné informace</b><br><br>
			</div>
			<div>
			1. Oblast platnosti smlouvy: <b>'.$destination.'</b><br>
			2. Datum začátku platnosti smlouvy: <b>'.date("d.m.Y",strtotime($agreement->LIFE_DATE_FROM)).'</b> (včetně).<br>
			3. Datum ukončení platnosti smlouvy: <b>'.date("d.m.Y",strtotime($agreement->LIFE_DATE_TO)).'</b> (včetně).<br>
			4. Výše pojištění: '.$agreementPrice.'
			</div>
			<br><br>
			<div style="text-align:center">
				<span style="font-size:18px;"><b>K rozvázání pracovního poměru došlo na žádost pojištence,</b></span><br>
			</div>
			<br>
			<div style="text-align:center">
			pojištěnec se tímto vzdává všech plateb které uhradil pojišťovně.
			</div>
			<br><br><br><br><br><br><br><br><br><br><br>
			<div style="float:left; padding-left:50px; width:250px">			
				<img src="'.base_url('images/vzor.png').'" width="120px">
			</div>
			<div style="float:left; padding-left:50px; width:250px">			
				<img src="'.base_url('images/vzor2.png').'" width="120px">
			</div>
			<div style="float:left; padding-left:55px; width:150px">			
				<b>'.$userDeleter->USER_TITLE.' '.$userDeleter->USER_FNAME.' '.$userDeleter->USER_LNAME.'</b>
			</div>	
			<div style="float:left; padding-left:265px; width:150px">			
				<b>'.$userAgreementer->USER_TITLE.' '.$userAgreementer->USER_FNAME.' '.$userAgreementer->USER_LNAME.'</b>
			</div>	
		';
		$pdf->WriteHTML($html); 
		$pdf->Output("$output", 'I'); 
		exit(); 
	
		exit;
	}
	
	
	public function showBill($bill_id){
		$this->load->model('Users');
		$this->load->model('Agreements');
		$this->load->library('m_pdf'); 
		$this->load->helper('vypis_helper');
		$this->load->model('Bills');
		$this->load->model('Settings');
		
		$bill = $this->Bills->getBill($bill_id);
		if ($bill->BILL_AGREEMENT_TYPE=="L"){
			$agreement = $this->Agreements->getUserAgreementLife($bill->BILL_AGREEMENT_ID);
			$userLoader = $this->Users->getUserDetailInfo($agreement->LIFE_CREATE_USER);
			$userAgreementer = $this->Users->getUserDetailInfo($agreement->LIFE_USER_ID);
			$userDeleter = $this->Users->getUserDetailInfo($agreement->LIFE_CREATE_USER);
		} else {
			$agreement = $this->Agreements->getUserAgreementTravel($bill->BILL_AGREEMENT_ID);
			$userLoader = $this->Users->getUserDetailInfo($agreement->TRAVEL_CREATE_USER);
			$userAgreementer = $this->Users->getUserDetailInfo($agreement->TRAVEL_USER_ID);
			$userDeleter = $this->Users->getUserDetailInfo($agreement->TRAVEL_CREATE_USER);
		}	
		$userLoaderFunction = getFunction($userLoader->LOGIN_PERMISSON);		
		$userAgreementerFunction = getFunction($userAgreementer->LOGIN_PERMISSON);
		
		if ($bill->BILL_AGREEMENT_TYPE=="L"){
			$const_smybol = '9588';
			$typ_polozky='Životní pojištení';
			$sequence = '<b>'.$bill->BILL_SEQUENCE.'.</b> platba v poradí';
			if (intval($bill->BILL_SEQUENCE)==1){
				$agreement = getLifeAgreement($bill->BILL_AGREEMENT_ID);
				$date_range =  (date("d.m.Y",strtotime($agreement->LIFE_DATE_FROM))).' - 05.'.date("m.Y",strtotime($bill->BILL_DATE_CREATE));
			} else {
				$firstDate = new DateTime(date("Y-m-d",strtotime($bill->BILL_DATE_CREATE)));
				$secondDate = date("Y-m-d", strtotime('+1 month', strtotime($firstDate->format("Y-m-d"))));
				$date_range = '06.'.(date("m.Y",strtotime($firstDate->format("Y-m-d")))).' - 05.'.date("m.Y",strtotime($secondDate));
			}
		} else {
			$const_smybol = '9688';
			$sequence = '<b>jednorázová platba</b>';
			$typ_polozky='Cestovní pojištení';
			$date_range =  getTravelFromTo($bill->BILL_AGREEMENT_ID);
		};
		
		$pdf = $this->m_pdf->load(); 
		$pdf->setFooter('{PAGENO}');
		$pdf->setTitle('ZB/'.$userAgreementer->USER_ID.'/2017');
		
		$data['title'] = "items"; 
		ini_set('memory_limit', '256M'); 		
		$html = '
		<body style="font-family: serif; font-size: 9pt;">
		<div style="font-family: "Times New Roman", Georgia, Serif; color: #4F5155; font-size:10px">
			<div style="width:330px; float:left">
				<img src="'.base_url('images/barcode.png').'" width="300px" height="20px">
			</div>
			<div style="width:310px; float: right">
				<img src="'.base_url('images/logo.png').'" width="300px">
			</div>
			<div style="width:330px; float:left">
				<span style="font-size:22px;"><br>Faktúra<br>
				'.$bill->BILL_CODE.'</span>
			</div>
			<div style="border-bottom: 1px solid #4F5155; width: 100%"><br></div>
			<br>
			<div>
				<b>Poskytovateľ:</b><br>
				Mendelu pojišťovna, a.s.<br>
				IČO: 12585478,<br>
				Zemědelská 1,Brno,<br>
				630 00<br>
			</div>
			<br>
			<div>
				<b>Poistenec</b><br>
				Titul, příjmení, jméno pojištence: <b>'.$userAgreementer->USER_TITLE.' '.$userAgreementer->USER_FNAME.' '.$userAgreementer->USER_LNAME.'</b><br>
				Datum narození: <b>'.substr($userAgreementer->USER_PIN,4,2).'.'.substr($userAgreementer->USER_PIN,2,2).'.19'.substr($userAgreementer->USER_PIN,0,2).'</b><br>
				Adresa: (platná v den založení pojištení): '.$userAgreementer->ADRESS_STREET.' '.$userAgreementer->ADRESS_NUMBER.', '.$userAgreementer->ADRESS_POST.' '.$userAgreementer->ADRESS_CITY.', ('.$userAgreementer->STATE_SHORT.') '.$userAgreementer->STATE_NAME.'<br>
			</div>
			<br>
			<div style="background-color:white; border: 1px solid #4F5155; padding-top:4px; padding-bottom:4px; padding-left: 15px">
				<b>Faktúračné obdobie:</b> '.$date_range.', '.$sequence.'
			</div>
			<table style="width:100%; border: 1px solid #4F5155; border-top:0px">
				<tr>
					<td style="padding-left:15px; width:150px">
						<b>Název položky
					</td>
					<td style="width:100px">
						<b>Daňový základ
					</td>
					<td style="width:100px">
						<b>DPH (%)
					</td>
					<td style="width:100px">
						<b>DPH
					</td>
					<td style="width:100px">
						<b>Celkom s DPH
					</td>
				</tr>
				</table>
				<table style="width:100%; border: 1px solid #4F5155; border-top:0px">
				<tr>
					<td style="padding-left:15px; width:150px">
						'.$typ_polozky.'
					</td>
					<td style="width:100px">
						'.number_format(($bill->BILL_PAY_PRICE*0.8), 2, ',', ' ').' '.$bill->BILL_PAY_CURRENCY.'
					</td>
					<td style="width:100px">
						20,00
					</td>
					<td style="width:100px">
						'.number_format(($bill->BILL_PAY_PRICE-($bill->BILL_PAY_PRICE*0.8)), 2, ',', ' ').' '.$bill->BILL_PAY_CURRENCY.'
					</td>
					<td style="width:100px">
						'.number_format($bill->BILL_PAY_PRICE, 2, ',', ' ').' '.$bill->BILL_PAY_CURRENCY.'
					</td>
				</tr>
				<tr>
					<td style="padding-left:15px; width:150px">
						Vystavenie faktúry
					</td>
					<td style="width:100px">
						0,00 '.$bill->BILL_PAY_CURRENCY.'
					</td>
					<td style="width:100px">
						20,00
					</td>
					<td style="width:100px">
						0,00 '.$bill->BILL_PAY_CURRENCY.'
					</td>
					<td style="width:100px">
						0,00 '.$bill->BILL_PAY_CURRENCY.'
					</td>
				</tr>
				<tr>
					<td style="padding-left:15px; width:150px">
						Zľavy
					</td>
					<td style="width:100px">
						0,00 '.$bill->BILL_PAY_CURRENCY.'
					</td>
					<td style="width:100px">
						20,00
					</td>
					<td style="width:100px">
						0,00 '.$bill->BILL_PAY_CURRENCY.'
					</td>
					<td style="width:100px">
						0,00 '.$bill->BILL_PAY_CURRENCY.'
					</td>
				</tr>
				<tr>
					<td style="padding-left:15px; width:150px">
						Ostatné poplatky
					</td>
					<td style="width:100px">
						0,00 '.$bill->BILL_PAY_CURRENCY.'
					</td>
					<td style="width:100px">
						20,00
					</td>
					<td style="width:100px">
						0,00 '.$bill->BILL_PAY_CURRENCY.'
					</td>
					<td style="width:100px">
						0,00 '.$bill->BILL_PAY_CURRENCY.'
					</td>
				</tr>
			</table>
			<table style="width:100%; border: 1px solid #4F5155; border-top:0px">
				<tr>
					<td style="padding-left:15px; width:150px">
						<b>Spolu vyúčtované
					</td>
					<td style="width:100px">
						<b>'.number_format(($bill->BILL_PAY_PRICE*0.8), 2, ',', ' ').' '.$bill->BILL_PAY_CURRENCY.'
					</td>
					<td style="width:100px">
						<b>20,00
					</td>
					<td style="width:100px">
						<b>'.number_format(($bill->BILL_PAY_PRICE-($bill->BILL_PAY_PRICE*0.8)), 2, ',', ' ').' '.$bill->BILL_PAY_CURRENCY.'
					</td>
					<td style="width:100px">
						<b>'.number_format($bill->BILL_PAY_PRICE, 2, ',', ' ').' '.$bill->BILL_PAY_CURRENCY.'
					</td>
				</tr>
			</table>
			<br>
			<div style="background-color:white; border: 1px solid #4F5155; padding-top:4px; padding-bottom:4px; padding-left: 15px">
				<b>Pri úhrade uvádzajte:</b>
			</div>
			<table style="width:100%; border: 1px solid #4F5155; border-top:0px">
				<tr>
					<td style="padding-left:15px; width: 200px">
						Číslo účtu (povinné):
					</td>
					<td>
						1641516418165
					</td>
				</tr>
				<tr>
					<td style="padding-left:15px; width: 200px">
						Kód banky (povinné):
					</td>
					<td>
						0300
					</td>
				</tr>
				<tr>
					<td style="padding-left:15px; width: 200px">
						Variabilný symbol (povinné):
					</td>
					<td>
						'.substr($bill->BILL_CODE,3,20).'
					</td>
				</tr>
				<tr>
					<td style="padding-left:15px; width: 200px">
						Konstantný symbol:
					</td>
					<td>
						'.$const_smybol.'
					</td>
				</tr>
				<tr>
					<td style="padding-left:15px; width: 200px">
						Čiastka:
					</td>
					<td>
						'.$bill->BILL_PAY_PRICE.'
					</td>
				</tr>
				<tr>
					<td style="padding-left:15px; width: 200px">
						Mena:
					</td>
					<td>
						'.$bill->BILL_PAY_CURRENCY.'
					</td>
				</tr>
			</table>
			<div style="text-align: center">
				<br>
				<b>I.</b><br>
				<b>Základné stanovy</b><br><br>
			</div>
			1. Faktúra na poistenie je uhradená dňom pripísania peňažných prostriedkov na účet Mendelu Pojištovně, a.s.<br>
			2. Cena za dané zložky sú v zmysle ďanových zákonov.<br>
			3. V prípade omeškania budú vyúčtované dodatočné úroky a to podľa stanovenej zmluvy. <br>
			4. V prípade z bodu 3 bude následujúca platba započítaná v tomto poradí:<br>
			a) neuhradené úroky z omeškania,<br>
			b) neuhradené zmluvné pokuty,<br>
			c) neuhradené poplatky,<br>
			d) vyúčtovaná faktúra,<br>
			e) zálohová platba<br><br><br><br><br><br>
			<div style="margin-left:50px; width:250px">			
				<img src="'.base_url('images/vzor.png').'" width="120px">
			</div>
			<div style="margin-left:50px;  width:150px">			
				<b>'.$userDeleter->USER_TITLE.' '.$userDeleter->USER_FNAME.' '.$userDeleter->USER_LNAME.'</b>
			</div>	
		</div>
		</body>
		';
		$pdf->WriteHTML($html); 
		$pdf->Output("$output", 'I'); 
		exit(); 
	
		exit;
		
	}
	
	
	public function clientAgreementDefaultPDF($user_id){
		
		$this->load->model('Users');
		$this->load->library('m_pdf'); 
		$this->load->helper('vypis_helper');
		$this->load->model('Settings');
		
		$pdf = $this->m_pdf->load(); 
		$pdf->setFooter('{PAGENO}');
		$pdf->setTitle('ZPZ/'.$user_id.'/2017');		
		$userLoaderFunction = getFunction($this->session->userdata('permisson'));
		$userAgreementer = $this->Users->getUserDetailInfo($user_id);
		$userLoader = $this->Users->getUserDetailInfo($userAgreementer->USER_CREATE_USER_ID);
		$userAgreementerFunction = getFunction($userAgreementer->LOGIN_PERMISSON);
		$settings = $this->Settings->getSettingsByTime($userAgreementer->HIRE_FROM);	
		$this->load->helper('agreement_helper');
		$formatted_user_id=getCorrectID($user_id);
		$data['title'] = "items"; 
		ini_set('memory_limit', '256M'); 		
		$html = '
		<body style="font-family: serif; font-size: 9pt;">
    <div style="font-family: "Times New Roman", Georgia, Serif; color: #4F5155; font-size:10px">
			<div style="width:330px; float:left">
				<img src="'.base_url('images/barcode.png').'" width="300px" height="20px">
			</div>
			<div style="width:310px; float: right">
				<img src="'.base_url('images/logo.png').'" width="300px">
			</div>
			<div style="width:330px; float:left">
				<span style="font-size:22px;"><br>Smlouva přihlášení pojištence<br>
				ZPZ'.$formatted_user_id.''.substr($userAgreementer->HIRE_FROM,0,4).''.substr($userAgreementer->HIRE_FROM,5,2).''.substr($userAgreementer->HIRE_FROM,8,2).'<br></span>
			</div>
			<div style="border-bottom: 1px solid #4F5155; width: 100%"><br></div>
			<br>
			<div>
				<b>Mendelu pojišťovna, a.s.</b><br>
				IČ: 12585478, se sídlem Brno, Zemědelská 1, PSČ 630 00<br>
				jejímž jménem jedná: <b>'.$userLoader->USER_TITLE.' '.$userLoader->USER_FNAME.' '.$userLoader->USER_LNAME.'</b>,  na pozici '.$userLoaderFunction.',<br>
				jednajíci na základe plné moci ze dne <b>'.date('d.m.Y', strtotime($userLoader->HIRE_FROM)).'</b><br>
				(dále jako „<b>zaměstnavatel</b>“)
			</div>
			<div>
				<br>
				a
				<br>
				<br>
			</div>
			<div>
				Titul, příjmení, jméno zaměstnance: <b>'.$userAgreementer->USER_TITLE.' '.$userAgreementer->USER_FNAME.' '.$userAgreementer->USER_LNAME.'</b><br>
				Datum narození: <b>'.substr($userAgreementer->USER_PIN,4,2).'.'.substr($userAgreementer->USER_PIN,2,2).'.19'.substr($userAgreementer->USER_PIN,0,2).'</b><br>
				Adresa: (platná v den nástupu): '.$userAgreementer->ADRESS_STREET.' '.$userAgreementer->ADRESS_NUMBER.', '.$userAgreementer->ADRESS_POST.' '.$userAgreementer->ADRESS_CITY.', ('.$userAgreementer->STATE_SHORT.') '.$userAgreementer->STATE_NAME.'<br>
				(dále jako „<b>zaměstnanec</b>“)<br><br><br>
			</div>
			<div style="text-align:center">
				<span style="font-size:18px;"><b>uzavírají tuto kartu poistenca:</b></span>
			</div>
			<br>
			<div>
			1. Pojištěný je povinen: 
			a. učinit veškerá možná opatření k odvrácení či zamezení zvětšení rozsahu jakékoli pojistné události; <br>b. bez zbytečného odkladu pojistiteli písemně či telefonicky oznámit, že nastala pojistná událost, podat o ní pravdivé vysvětlení a podat důkazy o jejím vzniku a rozsahu; <br>
			c. spolu s oznámením o pojistné události zaslat pojistiteli řádně vyplněný škodní protokol s originály dokladů, jež jsou uvedeny v záhlaví tohoto protokolu, případně předložit další doklady, které si vyžádá asistenční centrála; případné náklady s tím související nese pojistník, příp. oprávněná osoba; <br> 
			d. oznámit pojistiteli, je-li totéž riziko pojištěno zároveň u jiného pojistitele, uvést jeho jméno a údaje o sjednaném pojištění asistenčních služeb; <br>
			e. zabezpečit vůči jinému právo na náhradu újmy způsobené pojistnou událostí. <br> 
			2. Doklady vystavené osobou, která je manželem, rodičem, dítětem pojištěného nebo jinou osobou pojištěnému blízkou, nestačí k doložení pojistné události. Totéž platí o dokladech, které si pojištěný vystavil sám. <br>
			3. Mělo-li porušení povinnosti pojistníka, pojištěného nebo jiné osoby, která má na pojistné plnění právo, podstatný vliv na vznik pojistné události, její průběh, na zvětšení rozsahu jejích následků nebo na zjištění či určení výše pojistného plnění, má pojistitel prostřednictvím asistenční centrály právo snížit pojistné plnění úměrně k tomu, jaký vliv mělo toto porušení na rozsah pojistitelovy povinnosti plnit. <br>
			4. Pojistitel je oprávněn, prostřednictvím asistenční centrály, odmítnout pojistné plnění v celém rozsahu, jestliže příčinou pojistné události byla skutečnost, o které se dozvěděl až po vzniku pojistné události a Strana 4/7 kterou nemohl zjistit při sjednávání pojištění nebo jeho změně v důsledku úmyslně nebo z nedbalosti nepravdivě nebo neúplně zodpovězených písemných dotazů na skutečnosti, které mají význam pro pojistitelovo rozhodnutí, jak ohodnotí pojistné riziko, zda je pojistí a za jakých podmínek, a jestliže by při znalosti této skutečnosti v době uzavření pojistné smlouvy tuto smlouvu neuzavřel, nebo ji uzavřel za jiných podmínek. Dnem doručení oznámení o odmítnutí pojistného plnění z výše uvedených důvodů pojištění zanikne. <br>
			<br>
			</div>
			<div>
			<b>Souhlas se zpracováním osobních údajů podle zákona č. 101/2000 Sb., zákon o ochraně osobních údajů a o změně některých zákonů, v platném znění (dále jen zákon)</b><br>
			1. Prohlašuji, že souhlasím se zpracováním, mých osobních údajů, které jsem poskytl pojišťovně, které budou zpracovávány a uchovávány v rozsahu potřebném pro účel pojišťovny. Svým podpisem potvrzuji, že jsem byl informován ve smyslu § 11 zákona, že poskytnutí osobních údajů je dobrovolné a že mohu svůj souhlas kdykoli odvolat a požadovat tak vrácení písemných materiálů a dokumentů ze strany pojišťovny. 
			</div>
			<br>
			<br>
			<div style="float:left; padding-left:50px; width:250px">			
				<img src="'.base_url('images/vzor.png').'" width="120px">
			</div>
			<div style="float:left; padding-left:50px; width:250px">			
				<img src="'.base_url('images/vzor2.png').'" width="120px">
			</div>
			<div style="float:left; padding-left:55px; width:150px">			
				<b>'.$userLoader->USER_TITLE.' '.$userLoader->USER_FNAME.' '.$userLoader->USER_LNAME.'</b>
			</div>	
			<div style="float:left; padding-left:265px; width:150px">			
				<b>'.$userAgreementer->USER_TITLE.' '.$userAgreementer->USER_FNAME.' '.$userAgreementer->USER_LNAME.'</b>
			</div>
		';
		$pdf->WriteHTML($html); 
		$pdf->Output("$output", 'I'); 
		exit(); 
	
		exit;
	}
	
	
	
	
	public function clientAgreementDeletedPDF($user_id){
		$this->load->model('Users');
		$this->load->library('m_pdf'); 
		$this->load->helper('vypis_helper');
		$this->load->model('Settings');
		
		$pdf = $this->m_pdf->load(); 
		$pdf->setFooter('{PAGENO}');
		$pdf->setTitle('ZTD/'.$user_id.'/2017');		
		$userLoaderFunction = getFunction($this->session->userdata('permisson'));
		$userAgreementer = $this->Users->getUserDetailInfo($user_id);
		$userLoader = $this->Users->getUserDetailInfo($userAgreementer->USER_CREATE_USER_ID);
		$userAgreementerFunction = getFunction($userAgreementer->LOGIN_PERMISSON);
		$settings = $this->Settings->getSettingsByTime($userAgreementer->HIRE_FROM);
		$this->load->helper('agreement_helper');
		$formatted_user_id=getCorrectID($userAgreementer->USER_ID);

		$data['title'] = "items"; 
		ini_set('memory_limit', '256M'); 		
		
		$html = '
		<body style="font-family: serif; font-size: 9pt;">
		<div style="font-family: "Times New Roman", Georgia, Serif; color: #4F5155; font-size:10px">
			<div style="width:330px; float:left">
				<img src="'.base_url('images/barcode.png').'" width="300px" height="20px">
			</div>
			<div style="width:310px; float: right">
				<img src="'.base_url('images/logo.png').'" width="300px">
			</div>
			<div style="width:330px; float:left">
				<span style="font-size:22px;"><br>Odstúpení evidence pojištěnce<br>
				ZTD'.$formatted_user_id.''.substr($userAgreementer->HIRE_FROM,0,4).''.substr($userAgreementer->HIRE_FROM,5,2).''.substr($userAgreementer->HIRE_FROM,8,2).'<br></span>
			</div>
			<div style="border-bottom: 1px solid #4F5155; width: 100%"><br></div>
			<br>
			<div>
				<b>Mendelu pojišťovna, a.s.</b><br>
				IČ: 12585478, se sídlem Brno, Zemědelská 1, PSČ 630 00<br>
				jejímž jménem jedná: <b>'.$userLoader->USER_TITLE.' '.$userLoader->USER_FNAME.' '.$userLoader->USER_LNAME.'</b>,<br>
				jednajíci na základe plné moci ze dne <b>'.date('d.m.Y', strtotime($userLoader->HIRE_FROM)).'</b><br>
				(dále jako „<b>pojišťovatel</b>“)
			</div>
			<div>
				<br>
				a
				<br>
				<br>
			</div>
			<div>
				Titul, příjmení, jméno pojištence: <b>'.$userAgreementer->USER_TITLE.' '.$userAgreementer->USER_FNAME.' '.$userAgreementer->USER_LNAME.'</b><br>
				Datum narození: <b>'.substr($userAgreementer->USER_PIN,4,2).'.'.substr($userAgreementer->USER_PIN,2,2).'.19'.substr($userAgreementer->USER_PIN,0,2).'</b><br>
				Adresa: (platná v den založení pojištení): '.$userAgreementer->ADRESS_STREET.' '.$userAgreementer->ADRESS_NUMBER.', '.$userAgreementer->ADRESS_POST.' '.$userAgreementer->ADRESS_CITY.', ('.$userAgreementer->STATE_SHORT.') '.$userAgreementer->STATE_NAME.'<br>
				(dále jako „<b>pojištenec</b>“)<br><br><br>
			</div>
			<div style="text-align:center">
				<span style="font-size:18px;"><b>uzavírají dle ustanovení § 800 ods. 1 Občianskeho zákonníka tuhle smlouvu o rozvázaní poistního poměru:</b></span>
			</div>
			<br>
			<div style="text-align: center">
				<br>
				<b>I.</b><br>
				<b>Návaznosti smlouvy</b><br><br>
			</div>
			<div>
				1. Identifikační číslo smlouvy na kterú se tahle smlouva váže: <b>'.$agreement->TRAVEL_CODE.'</b><br>
			</div>
			<div style="text-align: center">
				<br>
				<b>II.</b><br>
				<b>Dodatečné informace</b><br><br>
			</div>
			<div>
			1. Oblast platnosti smlouvy: <b>'.$destination.'</b><br>
			2. Datum začátku platnosti smlouvy: <b>'.date("d.m.Y",strtotime($agreement->TRAVEL_DATE_FROM)).'</b> (včetně).<br>
			3. Datum ukončení platnosti smlouvy: <b>'.date("d.m.Y",strtotime($agreement->TRAVEL_DATE_TO)).'</b> (včetně).<br>
			</div>
			<br><br>
			<div style="text-align:center">
				<span style="font-size:18px;"><b>K rozvázání pracovního poměru došlo na žádost pojištence,</b></span><br>
			</div>
			<br>
			<div style="text-align:center">
			pojištěnec se tímto vzdává všech plateb které uhradil pojišťovně.
			</div>
			<br><br><br><br><br><br><br><br><br><br><br>
			<div style="float:left; padding-left:50px; width:250px">			
				<img src="'.base_url('images/vzor.png').'" width="120px">
			</div>
			<div style="float:left; padding-left:50px; width:250px">			
				<img src="'.base_url('images/vzor2.png').'" width="120px">
			</div>
			<div style="float:left; padding-left:55px; width:150px">			
				<b>'.$userLoader->USER_TITLE.' '.$userLoader->USER_FNAME.' '.$userLoader->USER_LNAME.'</b>
			</div>	
			<div style="float:left; padding-left:265px; width:150px">			
				<b>'.$userAgreementer->USER_TITLE.' '.$userAgreementer->USER_FNAME.' '.$userAgreementer->USER_LNAME.'</b>
			</div>	
		';
			$pdf->WriteHTML($html); 
		$pdf->Output("$output", 'I'); 
		exit(); 
	
		exit;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}