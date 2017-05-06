<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (($this->session->userdata('permisson')==4)) {
    $this->load->helper('header');
    showHeader();
    $this->load->helper('menu');
    showMenuAdviser(); 
	$this->load->helper('vypis');
	?>
    
	<script>
		$(document).ready(function(){
			$("#menuInsurants").css("background-color", "#00B4D7");
			$("#menuInsurantsW").css("color", "white");
		});	
	</script>
	
	<style>
		tr:hover td{
			background-color: #00B4D7 !important;
			color: white;
			cursor: pointer;
		}
	</style>
	
	<?php echo $headline; ?>

    <div>
	<div style="height: 685px">
		<?php
		if ($this->uri->segment(5) == ''){
			$uri_segment = '0';
		} else {
			$uri_segment = $this->uri->segment(5);
		}
		echo '<table class="list_table" style="margin-top: -14px; border-bottom: 1px solid #D0D0D0">';
		echo '<thead style="background-color:#00B4D7; color: white; border-bottom: 1px solid #D0D0D0"">';
			echo '<tr>';
				echo '<td style="padding-left:15px; width:40px">';
					if ($this->uri->segment(3) == 1) {
						if ($this->uri->segment(4) == 1) {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/1/2/'.$uri_segment).'"><b>ID</b></a>';
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/1/1/'.$uri_segment).'"><b>ID</b></</a>';
						}					
					} else {
						echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/1/'.$this->uri->segment(4).'/'.$uri_segment).'">ID</a>';
					}
				echo '</td>';
				echo '<td>';
					if ($this->uri->segment(3) == 2) {
						if ($this->uri->segment(4) == 1) {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/2/2/'.$uri_segment).'"><b>LOGIN</b></</a>';
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/2/1/'.$uri_segment).'"><b>LOGIN</b></</a>';
						}					
					} else {
						echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/2/'.$this->uri->segment(4).'/'.$uri_segment).'">LOGIN</a>';
					}
				echo '</td>';
				echo '<td>';
					if ($this->uri->segment(3) == 3) {
						if ($this->uri->segment(4) == 1) {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/3/2/'.$uri_segment).'"><b>JMÉNO</b></</a>';
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/3/1/'.$uri_segment).'"><b>JMÉNO</b></</a>';
						}					
					} else {
						echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/3/'.$this->uri->segment(4).'/'.$uri_segment).'">JMÉNO</a>';
					}					
				echo '</td>';
				echo '<td>';
					if ($this->uri->segment(3) == 4) {
						if ($this->uri->segment(4) == 1) {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/4/2/'.$uri_segment).'"><b>TELEFÓNNÍ ČÍSLO</b></</a>';
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/4/1/'.$uri_segment).'"><b>TELEFÓNNÍ ČÍSLO</b></</a>';
						}					
					} else {
						echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/4/'.$this->uri->segment(4).'/'.$uri_segment).'">TELEFÓNNÍ ČÍSLO</a>';
					}
				echo '</td>';
				echo '<td>';
					if ($this->uri->segment(3) == 5) {
						if ($this->uri->segment(4) == 1) {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/5/2/'.$uri_segment).'"><b>EMAIL</b></</a>';
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/5/1/'.$uri_segment).'"><b>EMAIL</b></</a>';
						}					
					} else {
						echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/5/'.$this->uri->segment(4).'/'.$uri_segment).'">EMAIL</a>';
					}
				echo '</td>';
				echo '<td>';
					if ($this->uri->segment(3) == 6) {
						if ($this->uri->segment(4) == 1) {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/6/2/'.$uri_segment).'"><b>STÁT</b></</a>';
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/6/1/'.$uri_segment).'"><b>STÁT</b></</a>';
						}					
					} else {
						echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/6/'.$this->uri->segment(4).'/'.$uri_segment).'">STÁT</a>';
					}
				echo '</td>';
				echo '<td>';
					if ($this->uri->segment(3) == 7) {
						if ($this->uri->segment(4) == 1) {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/7/2/'.$uri_segment).'"><b>MĚSTO</b></</a>';
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/7/1/'.$uri_segment).'"><b>MĚSTO</b></</a>';
						}					
					} else {
						echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/7/'.$this->uri->segment(4).'/'.$uri_segment).'">MĚSTO</a>';
					}
				echo '</td>';
				echo '<td>';
					if ($this->uri->segment(3) == 8) {
						if ($this->uri->segment(4) == 1) {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/8/2/'.$uri_segment).'"><b>PŘIHLÁŠEN UŽIV.</b></</a>';
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/8/1/'.$uri_segment).'"><b>PŘIHLÁŠEN UŽIV.</b></</a>';
						}					
					} else {
						echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/8/'.$this->uri->segment(4).'/'.$uri_segment).'">PŘIHLÁŠEN UŽIV.</a>';
					}
				echo '</td>';
				echo '<td>';
					if ($this->uri->segment(3) == 9) {
						if ($this->uri->segment(4) == 1) {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/9/2/'.$uri_segment).'"><b>PŘIHLÁŠEN DNE</b></</a>';
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/9/1/'.$uri_segment).'"><b>PŘIHLÁŠEN DNE</b></</a>';
						}					
					} else {
						echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/9/'.$this->uri->segment(4).'/'.$uri_segment).'">PŘIHLÁŠEN DNE</a>';
					}
				echo '</td>';
				echo '<td>';
					if ($this->uri->segment(3) == 10) {
						if ($this->uri->segment(4) == 1) {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/10/2/'.$uri_segment).'"><b>ZMĚNEN UŽIV.</b></</a>';
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/10/1/'.$uri_segment).'"><b>ZMĚNEN UŽIV.</b></</a>';
						}					
					} else {
						echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/10/'.$this->uri->segment(4).'/'.$uri_segment).'">ZMĚNEN UŽIV.</a>';
					}
				echo '</td>';
				echo '<td>';
					if ($this->uri->segment(3) == 11) {
						if ($this->uri->segment(4) == 1) {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/11/2/'.$uri_segment).'"><b>ZMĚNEN DNE</b></</a>';
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/11/1/'.$uri_segment).'"><b>ZMĚNEN DNE</b></</a>';
						}					
					} else {
						echo '<a style="color:white" href="'.base_url('Adviser/redirectAllClients/11/'.$this->uri->segment(4).'/'.$uri_segment).'">ZMĚNEN DNE</a>';
					}
				echo '</td>';
			echo '</tr>';				
		echo '</thead>';
		echo '<tbody>';
    
        foreach ($users as $user){ /*redirectDetailUser*/
			if ($user->USER_PLATNA=='S'){
				?><tr style="color:#d7d7d7; text-decoration: line-through;" onclick="document.location = '<?php echo base_url('Adviser/redirectDetailClient/'.$user->USER_ID) ?>';"><?php 
			} else if ($user->USER_PLATNA=='N') {
				?><tr style="color:#d7d7d7"  onclick="document.location = '<?php echo base_url('Adviser/redirectDetailClient/'.$user->USER_ID) ?>';"><?php 
			} else {
				?><tr onclick="document.location = '<?php echo base_url('Adviser/redirectDetailClient/'.$user->USER_ID) ?>';"><?php
			}			
				echo '<td style="padding-left:15px; width:40px">';
					echo $user->USER_ID;
				echo '</td>';
			
				echo '<td width="120">';
					echo $user->LOGIN_NAME;
				echo '</td>';
				
				echo '<td width="220"> ';
					echo $user->USER_TITLE.' '.$user->USER_FNAME.' '.$user->USER_LNAME;
				echo '</td>';
				
				echo '<td width="150">';
					echo $user->STATE_MPREFIX.' '.$user->USER_MNUMBER;
				echo '</td>';
				
				echo '<td width="250"> ';
					echo $user->USER_EMAIL;
				echo '</td>';
				
				echo '<td width="40">';
					echo $user->STATE_SHORT;
				echo '</td>';
				
				echo '<td width="120">';
					echo $user->ADRESS_CITY;
				echo '</td>';
				
				echo '<td width="130">';
					echo getUserName($user->USER_CREATE_USER_ID);
				echo '</td>';
				
				echo '<td width="110">';
					echo date('d.m.Y',strtotime($user->USER_CREATE_DATE));
				echo '</td>';
				
				echo '<td width="130">';
					if ($user->USER_MODIFY_USER_ID == null) {
						echo '<p style="color: grey; font-style: italic">ješte nezměneno</p>';
					} else {
						echo getUserName($user->USER_MODIFY_USER_ID);
					}					
				echo '</td>';
				
				echo '<td width="120" style="padding-right:15px">';
					if ($user->USER_MODIFY_DATE == null) {
						echo '<p style="color: grey; font-style: italic">ješte nezměneno</p>';
					} else {
						echo date('d.m.Y',strtotime($user->USER_MODIFY_DATE));
					}	
				echo '</td>';
	
			echo '</tr>';
		}
		echo '</tbody>';
		echo '</table>';
    echo '<div class="pagination_links">';
		echo $this->pagination->create_links();
    echo '</div>';
	echo '</div>';
	if  ($this->session->userdata('clientDefaultWhere')!='(1=1)'){
		?>
		<div class="button-group">
			<a href="<?php echo base_url('Adviser/clearClientFilter/'.$this->uri->segment(3).'/'.$this->uri->segment(4))?>" onclick="" class="button" style="margin-left:15px;margin-top:-28px" id="newUserTrace">Zrušení vyhledání klienta</a>
			<a href="<?php echo base_url('Adviser/redirectFindClient')?>" onclick="" class="button" style="margin-left:176px;margin-top:-28px" id="newUserTrace">Nové vyhledání klienta</a>
		</div>
		<?
	} else {
		?>
		<div class="button-group">
			<a href="<?php echo base_url('Adviser/redirectFindClient')?>" onclick="" class="button" style="float:left; margin-left:15px;margin-top:-28px" id="newUserTrace">Vyhledání klienta</a>
		</div>
		<?
	};
	?>
</div>
	

    <?php echo form_close();
    $this->load->helper('footer');
} else {
    echo "error, neplatné privilégia";
}
