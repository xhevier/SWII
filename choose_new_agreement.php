﻿<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ($this->session->userdata('permisson')==0) {
$this->load->helper('header');
showHeader();
$this->load->helper('menu');
showMenuAdmin(); 

	

	?>	
	<script>
		$(document).ready(function(){
			$("#menuAgreements").css("background-color", "#00B4D7");
			$("#menuAgreementsW").css("color", "white");
			
			$("#a1").mouseover(function(){$("#b1").animate({opacity:"1"});});
			$("#a1").mouseout(function(){$("#b1").animate({opacity:"0"});});
			$("#a2").mouseover(function(){$("#b2").animate({opacity:"1"});});
			$("#a2").mouseout(function(){$("#b2").animate({opacity:"0"});});
			$("#a3").mouseover(function(){$("#b3").animate({opacity:"1"});});
			$("#a3").mouseout(function(){$("#b3").animate({opacity:"0"});});
			$("#a4").mouseover(function(){$("#b4").animate({opacity:"1"});});
			$("#a4").mouseout(function(){$("#b4").animate({opacity:"0"});});
			$("#a5").mouseover(function(){$("#b5").animate({opacity:"1"});});
			$("#a5").mouseout(function(){$("#b5").animate({opacity:"0"});});
			$("#a6").mouseover(function(){$("#b6").animate({opacity:"1"});});
			$("#a6").mouseout(function(){$("#b6").animate({opacity:"0"});});
			$("#a7").mouseover(function(){$("#b7").animate({opacity:"1"});});
			$("#a7").mouseout(function(){$("#b7").animate({opacity:"0"});});

		});	
	</script>
	
    <h1>Vytvoření novej smlouvy</h1>

    <div>
		<a id="a1" href="<?php echo base_url('Admin/redirectChooseNewAgreement/1')?>"><img src="<?php echo base_url('images/agr1.png')?>" class="chose_agreement_img" id="a1"></a>
		<a href="<?php echo base_url('Admin/redirectChooseNewAgreement/2')?>"><img src="<?php echo base_url('images/agr2.png')?>" class="chose_agreement_img" id="a2"></a>
		<a href="<?php echo base_url('Admin/redirectChooseNewAgreement/3')?>"><img src="<?php echo base_url('images/agr3.png')?>" class="chose_agreement_img" id="a3"></a>
		<a href="<?php echo base_url('Admin/redirectChooseNewAgreement/4')?>"><img src="<?php echo base_url('images/agr4.png')?>" class="chose_agreement_img" id="a4"></a>
		<a href=""><img src="<?php echo base_url('images/agr5.png')?>" class="chose_agreement_img" id="a5"></a>
		<a href=""><img src="<?php echo base_url('images/agr6.png')?>" class="chose_agreement_img" id="a6"></a>
		<a href=""><img src="<?php echo base_url('images/agr7.png')?>" class="chose_agreement_img" id="a7"></a>
    </div>
	<div>
		<div id="b1" class="chose_agreement_img_text"> 
			<p class="chose_agreement_img_text_header">Životní pojištení</p>
			<p class="chose_agreement_img_text_header_p">Životní pojištění se uzavírá za účelem, kdy pojistná osoba si přeje mít pojistku sloužící k úhradě finančních výloh v případě pracovní neschopnosti, léčení trvalého úrazu, závažného onemocnění, či výplatu oprávněné osobě v případě úmrtí.</p>
		</div>
		<div id="b2" class="chose_agreement_img_text"> 
			<p class="chose_agreement_img_text_header">Cestovní pojištení</p>
			<p class="chose_agreement_img_text_header_p">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nullam sapien sem, ornare ac, nonummy non, lobortis a enim. Etiam ligula pede, sagittis quis, interdum ultricies, scelerisque eu. Nunc tincidunt ante vitae massa. Sed ac dolor sit amet purus malesuada congue. Fusce tellus. Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. In convallis. Nulla est. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Nullam justo enim, consectetuer nec, ullamcorper ac, vestibulum in, elit. Mauris tincidunt sem sed arcu.</p>
		</div>
		<div id="b3" class="chose_agreement_img_text"> 
			<p class="chose_agreement_img_text_header">Důchodové pojištení</p>
			<p class="chose_agreement_img_text_header_p">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nullam sapien sem, ornare ac, nonummy non, lobortis a enim. Etiam ligula pede, sagittis quis, interdum ultricies, scelerisque eu. Nunc tincidunt ante vitae massa. Sed ac dolor sit amet purus malesuada congue. Fusce tellus. Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. In convallis. Nulla est. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Nullam justo enim, consectetuer nec, ullamcorper ac, vestibulum in, elit. Mauris tincidunt sem sed arcu.</p>
		</div>
		<div id="b4" class="chose_agreement_img_text"> 
			<p class="chose_agreement_img_text_header">Športovné pojištení</p>
			<p class="chose_agreement_img_text_header_p">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nullam sapien sem, ornare ac, nonummy non, lobortis a enim. Etiam ligula pede, sagittis quis, interdum ultricies, scelerisque eu. Nunc tincidunt ante vitae massa. Sed ac dolor sit amet purus malesuada congue. Fusce tellus. Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. In convallis. Nulla est. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Nullam justo enim, consectetuer nec, ullamcorper ac, vestibulum in, elit. Mauris tincidunt sem sed arcu.</p>
		</div>
		<div id="b5" class="chose_agreement_img_text"> 
			<p class="chose_agreement_img_text_header">Pojištení vozidla</p>
			<p class="chose_agreement_img_text_header_p">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nullam sapien sem, ornare ac, nonummy non, lobortis a enim. Etiam ligula pede, sagittis quis, interdum ultricies, scelerisque eu. Nunc tincidunt ante vitae massa. Sed ac dolor sit amet purus malesuada congue. Fusce tellus. Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. In convallis. Nulla est. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Nullam justo enim, consectetuer nec, ullamcorper ac, vestibulum in, elit. Mauris tincidunt sem sed arcu.</p>
		</div>
		<div id="b6" class="chose_agreement_img_text"> 
			<p class="chose_agreement_img_text_header">Pojištení nehnuteľnosti</p>
			<p class="chose_agreement_img_text_header_p">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nullam sapien sem, ornare ac, nonummy non, lobortis a enim. Etiam ligula pede, sagittis quis, interdum ultricies, scelerisque eu. Nunc tincidunt ante vitae massa. Sed ac dolor sit amet purus malesuada congue. Fusce tellus. Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. In convallis. Nulla est. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Nullam justo enim, consectetuer nec, ullamcorper ac, vestibulum in, elit. Mauris tincidunt sem sed arcu.</p>
		</div>
		<div id="b7" class="chose_agreement_img_text"> 
			<p class="chose_agreement_img_text_header">Živelné pojištení</p>
			<p class="chose_agreement_img_text_header_p">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nullam sapien sem, ornare ac, nonummy non, lobortis a enim. Etiam ligula pede, sagittis quis, interdum ultricies, scelerisque eu. Nunc tincidunt ante vitae massa. Sed ac dolor sit amet purus malesuada congue. Fusce tellus. Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. In convallis. Nulla est. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Nullam justo enim, consectetuer nec, ullamcorper ac, vestibulum in, elit. Mauris tincidunt sem sed arcu.</p>
		</div>
	</div>


    <?php
    $this->load->helper('footer');
} else {
    echo "error, neplatné privilégia";
}
