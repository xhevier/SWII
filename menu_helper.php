<?php

function showMenuAdmin()
{
    ?>
	
    <div>
        <nav role='navigation'>
            <ul>
                <li id="menuHome"><a href="<?php echo base_url('Admin/redirectHome')?>" id="menuHomeW">Domů</a></li>
                <li id="menuEmployees"><a href="<?php echo base_url('Admin/redirectDefaultUser')?>" id="menuEmployeesW">Zaměstnanci</a>                                                                                    
                    <ul>
                        <li><a href="<?php echo base_url('Admin/redirectFindUser')?>">Vyhledat</a></li>
                        <li><a href="<?php echo base_url('Admin/redirectAllUsers/1/1')?>">Seznam</a></li>
                        <li><a href="<?php echo base_url('Admin/redirectNewUser')?>">Vytvořit</a></li>
                    </ul>
                </li>
                <li id="menuInsurants"><a href="<?php echo base_url('Admin/redirectDefaultClient')?>" id="menuInsurantsW">Pojištěnci</a>
                    <ul>
                        <li><a href="<?php echo base_url('Admin/redirectFindClient')?>">Vyhledat</a></li>
                        <li><a href="<?php echo base_url('Admin/redirectAllClients/1/1')?>">Seznam</a></li>
                        <li><a href="<?php echo base_url('Admin/redirectNewClient')?>">Přihlášení pojištění </a></li>                        
                    </ul>
                </li>
                <li id="menuAgreements"><a href="<?php echo base_url('Admin/redirectDefaultAgreement')?>" id="menuAgreementsW">Smlouvy</a>
                    <ul>
                        <li><a href="<?php echo base_url('Admin/redirectFindAgreement')?>">Vyhledat</a></li>
                        <li><a href="<?php echo base_url('Admin/redirectAllAgreements/1/1')?>">Seznam</a></li>
                        <li><a href="<?php echo base_url('Admin/redirectChooseNewAgreement/0')?>">Pojistná smlouva</a></li>
                        <?php /*<li><a href="<?php echo base_url('Admin/redirectExtensionAgreement')?>">Prodloužení smlouvy</a></li>
                        <li><a href="<?php echo base_url('Admin/redirectCancelAgreement')?>">Smlouva o zrušení­</a></li>*/ ?>
                    </ul>
                </li>
                <li id="menuInvoices"><a href="<?php echo base_url('Admin/redirectDefaultInvoice')?>" id="menuInvoicesW">Faktury</a>
                    <ul>
                        <li><a href="<?php echo base_url('Admin/redirectFindInvoice')?>">Vyhledat</a></li>
                        <li><a href="<?php echo base_url('Admin/redirectAllInvoices/5/2')?>">Seznam</a></li>
                        <?php /*<li><a href="<?php echo base_url('Admin/redirectNewInvoice')?>">Nová faktura</a></li>*/ ?>
                    </ul>
                </li>
                <?php /*<li><a href="#">Archiv</a>
                    <ul>
                        <li><a href="">Vyhledat</a></li>
                        <li><a href="">Seznam</a></li>
                    </ul>
                </li>*/ ?>
                <li id="menuSettings"><a href="<?php echo base_url('Admin/redirectSettings')?>" id="menuSettingsW">Nastavení­</a>
                </li>
				<li id="menuArator"><a href="<?php echo base_url('Arator/redirectDefaultArator')?>" id="menuAratorW">Arator</a>
                </li>
				<li><a href="<?php echo base_url('Admin/logOut')?>">Odhlásit</a>
                </li>
            </ul>
        </nav>
    </div>
	
    <?php
}

function showMenuLeader(){
	?>
    <div>
        <nav role='navigation'>
            <ul>
                <li id="menuHome"><a href="<?php echo base_url('Admin/redirectHome')?>" id="menuHomeW">Domů</a></li>
                <li id="menuEmployees"><a href="<?php echo base_url('Admin/redirectDefaultUser')?>" id="menuEmployeesW">Zaměstnanci</a>                                                                                    
                    <ul>
                        <li><a href="<?php echo base_url('Admin/redirectFindUser')?>">Vyhledat</a></li>
                        <li><a href="<?php echo base_url('Admin/redirectAllUsers/1/1')?>">Seznam</a></li>
                        <li><a href="<?php echo base_url('Admin/redirectNewUser')?>">Vytvořit</a></li>
                    </ul>
                </li>
                <li id="menuInsurants"><a href="<?php echo base_url('Admin/redirectDefaultClient')?>" id="menuInsurantsW">Pojištěnci</a>
                    <ul>
                        <li><a href="<?php echo base_url('Admin/redirectFindClient')?>">Vyhledat</a></li>
                        <li><a href="<?php echo base_url('Admin/redirectAllClients/1/1')?>">Seznam</a></li>
                        <li><a href="<?php echo base_url('Admin/redirectNewClient')?>">Přihlášení pojištění </a></li>                        
                    </ul>
                </li>
                <li id="menuAgreements"><a href="<?php echo base_url('Admin/redirectDefaultAgreement')?>" id="menuAgreementsW">Smlouvy</a>
                    <ul>
                        <li><a href="<?php echo base_url('Admin/redirectFindAgreement')?>">Vyhledat</a></li>
                        <li><a href="<?php echo base_url('Admin/redirectAllAgreements/1/1')?>">Seznam</a></li>
                        <li><a href="<?php echo base_url('Admin/redirectChooseNewAgreement/0')?>">Pojistná smlouva</a></li>
                        <?php /*<li><a href="<?php echo base_url('Admin/redirectExtensionAgreement')?>">Prodloužení smlouvy</a></li>
                        <li><a href="<?php echo base_url('Admin/redirectCancelAgreement')?>">Smlouva o zrušení­</a></li>*/ ?>
                    </ul>
                </li>
                <li id="menuInvoices"><a href="<?php echo base_url('Admin/redirectDefaultInvoice')?>" id="menuInvoicesW">Faktury</a>
                    <ul>
                        <li><a href="<?php echo base_url('Admin/redirectFindInvoice')?>">Vyhledat</a></li>
                        <li><a href="<?php echo base_url('Admin/redirectAllInvoices/5/2')?>">Seznam</a></li>
                        <?php /*<li><a href="<?php echo base_url('Admin/redirectNewInvoice')?>">Nová faktura</a></li>*/ ?>
                    </ul>
                </li>
                <?php /*<li><a href="#">Archiv</a>
                    <ul>
                        <li><a href="">Vyhledat</a></li>
                        <li><a href="">Seznam</a></li>
                    </ul>
                </li>*/ ?>
                <li id="menuSettings"><a href="<?php echo base_url('Admin/redirectSettings')?>" id="menuSettingsW">Nastavení­</a>
                </li>
				<li id="menuArator"><a href="<?php echo base_url('Arator/redirectDefaultArator')?>" id="menuAratorW">Arator</a>
                </li>
				<li><a href="<?php echo base_url('Admin/logOut')?>">Odhlásit</a>
                </li>
            </ul>
        </nav>
    </div>
    <?php
}

function showMenuAdviser(){
	?>
    <div>
        <nav role='navigation'>
            <ul>
                <li id="menuHome"><a href="<?php echo base_url('Adviser/redirectHome')?>" id="menuHomeW">Domů</a></li>
                <li id="menuEmployees"><a href="<?php echo base_url('Adviser/redirectDefaultUser')?>" id="menuEmployeesW">Zaměstnanci</a>                                                                                    
                    <ul>
                        <li><a href="<?php echo base_url('Adviser/redirectFindUser')?>">Vyhledat</a></li>
                        <li><a href="<?php echo base_url('Adviser/redirectAllUsers/1/1')?>">Seznam</a></li>
                        <?php /*<li><a href="<?php echo base_url('Adviser/redirectNewUser')?>">Vytvořit</a></li>*/ ?>
                    </ul>
                </li>
                <li id="menuInsurants"><a href="<?php echo base_url('Adviser/redirectDefaultClient')?>" id="menuInsurantsW">Pojištěnci</a>
                    <ul>
                        <li><a href="<?php echo base_url('Adviser/redirectFindClient')?>">Vyhledat</a></li>
                        <li><a href="<?php echo base_url('Adviser/redirectAllClients/1/1')?>">Seznam</a></li>
                        <li><a href="<?php echo base_url('Adviser/redirectNewClient')?>">Přihlášení pojištění </a></li>                        
                    </ul>
                </li>
                <li id="menuAgreements"><a href="<?php echo base_url('Adviser/redirectDefaultAgreement')?>" id="menuAgreementsW">Smlouvy</a>
                    <ul>
                        <li><a href="<?php echo base_url('Adviser/redirectFindAgreement')?>">Vyhledat</a></li>
                        <li><a href="<?php echo base_url('Adviser/redirectAllAgreements/1/1')?>">Seznam</a></li>
                        <li><a href="<?php echo base_url('Adviser/redirectChooseNewAgreement/0')?>">Pojistná smlouva</a></li>
                        <?php /*<li><a href="<?php echo base_url('Adviser/redirectExtensionAgreement')?>">Prodloužení smlouvy</a></li>
                        <li><a href="<?php echo base_url('Adviser/redirectCancelAgreement')?>">Smlouva o zrušení­</a></li>*/ ?>
                    </ul>
                </li>
                <li id="menuInvoices"><a href="<?php echo base_url('Adviser/redirectDefaultInvoice')?>" id="menuInvoicesW">Faktury</a>
                    <ul>
                        <li><a href="<?php echo base_url('Adviser/redirectFindInvoice')?>">Vyhledat</a></li>
                        <li><a href="<?php echo base_url('Adviser/redirectAllInvoices/5/2')?>">Seznam</a></li>
                        <?php /*<li><a href="<?php echo base_url('Adviser/redirectNewInvoice')?>">Nová faktura</a></li>*/ ?>
                    </ul>
                </li>
				<li><a href="<?php echo base_url('Admin/logOut')?>">Odhlásit</a>
                </li>
            </ul>
        </nav>
    </div>
    <?php
}

function showMenuClient(){
	?>
    <div>
        <nav role='navigation'>
            <ul>
                <li id="menuHome"><a href="<?php echo base_url('Client/redirectHome')?>" id="menuHomeW">Domů</a></li>                              
                <li id="menuAgreements"><a href="<?php echo base_url('Client/redirectDefaultAgreement')?>" id="menuAgreementsW">Smlouvy</a>
                </li>
                <li id="menuInvoices"><a href="<?php echo base_url('Client/redirectDefaultInvoice')?>" id="menuInvoicesW">Faktury</a>
                </li> 
				<li><a href="<?php echo base_url('Admin/logOut')?>">Odhlásit</a>
                </li>				
            </ul>
        </nav>
    </div>
    <?php
}










