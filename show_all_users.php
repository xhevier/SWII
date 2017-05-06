<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ($this->session->userdata('permisson')==4) {
    $this->load->helper('header');
    showHeader();
    $this->load->helper('menu');
    showMenuAdviser(); 
	$this->load->helper('vypis');
	?>
    
	<script>
		$(document).ready(function(){
			$("#menuEmployees").css("background-color", "#00B4D7");
			$("#menuEmployeesW").css("color", "white");
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
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/1/2/'.$uri_segment).'"><b>ID</b></a>';
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/1/1/'.$uri_segment).'"><b>ID</b></</a>';
						}					
					} else {
						echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/1/'.$this->uri->segment(4).'/'.$uri_segment).'">ID</a>';
					}
				echo '</td>';
				echo '<td>';
					if ($this->uri->segment(3) == 2) {
						if ($this->uri->segment(4) == 1) {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/2/2/'.$uri_segment).'"><b>LOGIN</b></</a>';
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/2/1/'.$uri_segment).'"><b>LOGIN</b></</a>';
						}					
					} else {
						echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/2/'.$this->uri->segment(4).'/'.$uri_segment).'">LOGIN</a>';
					}
				echo '</td>';
				echo '<td>';
					if ($this->uri->segment(3) == 3) {
						if ($this->uri->segment(4) == 1) {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/3/2/'.$uri_segment).'"><b>JMÉNO</b></</a>';
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/3/1/'.$uri_segment).'"><b>JMÉNO</b></</a>';
						}					
					} else {
						echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/3/'.$this->uri->segment(4).'/'.$uri_segment).'">JMÉNO</a>';
					}					
				echo '</td>';
				echo '<td>';
					if ($this->uri->segment(3) == 4) {
						if ($this->uri->segment(4) == 1) {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/4/2/'.$uri_segment).'"><b>TELEFÓNNÍ ČÍSLO</b></</a>';
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/4/1/'.$uri_segment).'"><b>TELEFÓNNÍ ČÍSLO</b></</a>';
						}					
					} else {
						echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/4/'.$this->uri->segment(4).'/'.$uri_segment).'">TELEFÓNNÍ ČÍSLO</a>';
					}
				echo '</td>';
				echo '<td>';
					if ($this->uri->segment(3) == 5) {
						if ($this->uri->segment(4) == 1) {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/5/2/'.$uri_segment).'"><b>EMAIL</b></</a>';
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/5/1/'.$uri_segment).'"><b>EMAIL</b></</a>';
						}					
					} else {
						echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/5/'.$this->uri->segment(4).'/'.$uri_segment).'">EMAIL</a>';
					}
				echo '</td>';
				echo '<td>';
					if ($this->uri->segment(3) == 6) {
						if ($this->uri->segment(4) == 1) {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/6/2/'.$uri_segment).'"><b>STÁT</b></</a>';
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/6/1/'.$uri_segment).'"><b>STÁT</b></</a>';
						}					
					} else {
						echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/6/'.$this->uri->segment(4).'/'.$uri_segment).'">STÁT</a>';
					}
				echo '</td>';
				echo '<td>';
					if ($this->uri->segment(3) == 7) {
						if ($this->uri->segment(4) == 1) {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/7/2/'.$uri_segment).'"><b>MĚSTO</b></</a>';
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/7/1/'.$uri_segment).'"><b>MĚSTO</b></</a>';
						}					
					} else {
						echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/7/'.$this->uri->segment(4).'/'.$uri_segment).'">MĚSTO</a>';
					}
				echo '</td>';
				echo '<td>';
					if ($this->uri->segment(3) == 8) {
						if ($this->uri->segment(4) == 1) {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/8/2/'.$uri_segment).'"><b>PŘIHLÁŠEN UŽIV.</b></</a>';
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/8/1/'.$uri_segment).'"><b>PŘIHLÁŠEN UŽIV.</b></</a>';
						}					
					} else {
						echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/8/'.$this->uri->segment(4).'/'.$uri_segment).'">PŘIHLÁŠEN UŽIV.</a>';
					}
				echo '</td>';
				echo '<td>';
					if ($this->uri->segment(3) == 9) {
						if ($this->uri->segment(4) == 1) {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/9/2/'.$uri_segment).'"><b>PŘIHLÁŠEN DNE</b></</a>';
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/9/1/'.$uri_segment).'"><b>PŘIHLÁŠEN DNE</b></</a>';
						}					
					} else {
						echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/9/'.$this->uri->segment(4).'/'.$uri_segment).'">PŘIHLÁŠEN DNE</a>';
					}
				echo '</td>';
				echo '<td>';
					if ($this->uri->segment(3) == 10) {
						if ($this->uri->segment(4) == 1) {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/10/2/'.$uri_segment).'"><b>ZMĚNEN UŽIV.</b></</a>';
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/10/1/'.$uri_segment).'"><b>ZMĚNEN UŽIV.</b></</a>';
						}					
					} else {
						echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/10/'.$this->uri->segment(4).'/'.$uri_segment).'">ZMĚNEN UŽIV.</a>';
					}
				echo '</td>';
				echo '<td>';
					if ($this->uri->segment(3) == 11) {
						if ($this->uri->segment(4) == 1) {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/11/2/'.$uri_segment).'"><b>ZMĚNEN DNE</b></</a>';
						} else {
							echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/11/1/'.$uri_segment).'"><b>ZMĚNEN DNE</b></</a>';
						}					
					} else {
						echo '<a style="color:white" href="'.base_url('Adviser/redirectAllUsers/11/'.$this->uri->segment(4).'/'.$uri_segment).'">ZMĚNEN DNE</a>';
					}
				echo '</td>';
			echo '</tr>';				
		echo '</thead>';
		echo '<tbody>';
    
        foreach ($users as $user){ /*redirectDetailUser*/	
			if ($user->USER_PLATNA=='S'){
				?><tr style="color:#d7d7d7; text-decoration: line-through;" ><?php 
			} else if ($user->USER_PLATNA=='N') {
				?><tr style="color:#d7d7d7"><?php 
			} else {
				?><tr><?php 
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
	if  ($this->session->userdata('employeeDefaultWhere')!='(1=1)'){
		?>
		<div class="button-group">
			<a href="<?php echo base_url('Adviser/clearEmployeeFilter/'.$this->uri->segment(3).'/'.$this->uri->segment(4))?>" onclick="" class="button" style="margin-left:15px;margin-top:-28px" id="newUserTrace">Zrušení vyhledání zaměstnance</a>
			<a href="<?php echo base_url('Adviser/redirectFindUser')?>" onclick="" class="button" style="margin-left:210px;margin-top:-28px" id="newUserTrace">Nové vyhledání zaměstnance</a>
		</div>
		<?
	} else {
		?>
		<div class="button-group">
			<a href="<?php echo base_url('Adviser/redirectFindUser')?>" onclick="" class="button" style="float:left; margin-left:15px;margin-top:-28px" id="newUserTrace">Vyhledání zaměstnance</a>
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
