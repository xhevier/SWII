<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->helper('header');
showHeader();
?>

<h1>Semestrálny projekt Softwarové inženýrství II</h1>

<div>
    <table style="margin-left:15px; width:1200px">
        <tr>
            <td width="150px"><b>Název projektu:</b></td>
            <td>Informační systém pojištovny</td>
        </tr>
        <tr>
            <td><b>Vedoucí projektu:</b></td>
            <td>doc. Ing. Oldřich Trenz, Ph.D.</td>
        </tr>
        <tr>
            <td><b>Vedoucí týmu:</b></td>
            <td>Bc. Zuzana Jarošová</td>
        </tr>
        <tr>
            <td><b>Řešitelský tým:</b></td>
            <td>Bc. Michaela Metzlová</td>
        </tr>
        <tr>
            <td></td>
            <td>Bc. Marek Hevier</td>
        </tr>
        <tr>
            <td></td>
            <td>Bc. Martin Bendík </td>
        </tr>
        <tr><td><td>&nbsp</td></td></tr>
        <tr valign="top">
            <td><b>Popis domény</b></td>
            <td>Firma se zabývá pojištěním pro občany České Republiky. V nabídce má několik
                typů pojištění jako je stavební, životní, sociální, povinné ručení, majetku. Ke kaž-
                dému pojištění připadá určitá cenová nabídka. Při uzavírání smlouvy je s klientem
                tato cenová nabídka prokonzultována. Klient je poté pravidelně upozorňován k
                úhradě pojistky a kdykoli může zažádat o její zrušení, popř. prodloužení stávající
                smlouvy.</td>
        </tr>
        <tr><td><td>&nbsp</td></td></tr>
        <tr valign="top">
            <td><b>Aktéři</b></td>
            <td>
                <ul>
                    <li><b>Klient</b> žádá u pojišťovny o pojištění. Nový klient musí sepsat smlouvu s klientským
                        poradcem. Stávající klient s poradcem prodlouží smlouvu nebo ji naopak
                        zruší.</li>
                    <li>Prací <b>klientského poradce</b> na přepážce je získávat nové klienty a přihlásit je
                        k pojišťovně, podávat rady stávajícím klientům, sepsat a spravovat jejich
                        smlouvy</li>
                    <li><b>Revizní zaměstnanec</b> se stará o správu smluv, tedy její zrušení, prodloužení
                        či revizi a komunikuje s klientským poradcem.</li>
                    <li><b>Účetní</b> má za úkol zaúčtovat příslušné doklady, kontrolovat faktury, vést evidenci
                        nebo shromažďovat vstupní data. Také je důležité sestavování výkazů
                        práce a na jejich základě vytvoření výplatních pásek. Veškeré písemnosti jsou
                        převedeny do elektronické podoby. </li>
                    <li><b>Vedoucí pobočky</b> a také administrátor informačního systému má přehled
                        nad veškerým děním v pojišťovně. Dohlíží na ostatní zaměstnance. Má za úkol
                        také správu celého systému.</li>
                    <li>Součástí systému je dokumentový <b>server</b>, který obsahuje všechny dokumenty
                        pojišťovny. Mají přístup do něj pouze zaměstnanci pojišťovny.</li>
                </ul>
            </td>
        </tr>
        <tr><td><td>&nbsp</td></td></tr>
        <tr valign="top">
            <td><b>Typy dokumentů</b></td>
            <td>
                <ul>
                    <li><b>Přihlášení pojištěnce</b> (pojistná karta). V podstatě se jedná o dokument, který
                        obsahuje základní informace o pojištěnci, jeho osobní údaje, bydliště, případně
                        platební schopnost nebo pracovní pozice apod.</li>
                    <li><b>Pojistná smlouva</b> je již samotné pojištění, které je sestaveno na dobu určitou,
                        proto obsahuje hlavně datum a je závislé na cenové nabídce, ke které se vztahuje.</li>
                    <li><b>Fakturace</b> je dokumentem, který vytváří účetní na základě pojistné smlouvy a
                        cenové nabídky. Je to prakticky normální faktura, která obsahuje bankovní
                        spojení, variabilní symbol, částku, výpis, datum splatnosti atd.</li>
                    <li><b>Prodloužení smlouvy</b> je dokument, který se vytváří po exspiraci jednotlivých
                        druhů pojistných smluv a odkazuje se na starou pojistnou smlouvu. (Aby byla
                        splněna 3.NF).</li>
                    <li><b>Smlouva o zrušení</b> je dokumentem, který se odkazuje na dokument přihlášení
                        pojištěnce, s tím, že hlavně obsahuje datum ukončení pojištění a případně
                        různé sankce.</li>
                    <li><b>Cenová nabídka</b> je dokumentem, který obsahuje přesně stanovené období,
                        kdy je daná cenová nabídka platná a je obsažen v každém dokumentu pojistné
                        smlouvy (aby fakturace obsahovala přesně dohodnuté ceny z období, na kterém
                        se dohodly při sepsání smlouvy).</li>
                </ul>
            </td>
        </tr>
    </table>
</div>


<div id="body" style="margin-top:100px; margin-left: 170px">
    <?php
    echo form_open(base_url()."main/redirectLogin");
    echo form_submit('submitIndex', 'Zobraziť riešenie projektu', 'class="button"; style="margin-top:250px"');
    echo form_close();
    ?>
</div>

