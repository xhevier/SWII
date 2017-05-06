</div>
<div id="container_footer">
<p class="footer">
    Poslední použitá funkce <b><?php echo $this->uri->segment(2) ?> </b> |
    Načítání stránky trvalo <strong>{elapsed_time}</strong> sekund. <?php echo  (ENVIRONMENT === 'development')?>
    <span style="float:left; margin-left:15px;">Přihlášen jako <b><?php echo strtolower($this->session->userdata('username')) ?></b> | </span>
    <span style="float:left; margin-left:5px"> Privilegia na úrovni <b><?php
 
	     	   if ($this->session->permisson == '0') {
                echo "Administrátor";
            } else if ($this->session->permisson == '1') {
                echo "Vedoucí pobočky";
            } else if ($this->session->permisson == '2') {
                echo "Revízny zaměstnanec";
            } else if ($this->session->permisson == '3') {
                echo "Účetní";
            } else if ($this->session->permisson == '4') {
                echo "Klientský poradce";
            } else if ($this->session->permisson == '5') {
                echo "Klient";
            }
            ?></b></span>
</p>
</div>

</body>
</html>