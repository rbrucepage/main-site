<?php

# This block must be placed at the very top of page.
# --------------------------------------------------
require_once( dirname(__FILE__).'/form.lib.php' );
phpfmg_display_form();
# --------------------------------------------------



function phpfmg_form( $sErr = false ){
		$style=" class='form_text' ";

?>

<form name="frmFormMail" action='' method='post' enctype='multipart/form-data' onsubmit='return fmgHandler.onsubmit(this);'>
<input type='hidden' name='formmail_submit' value='Y'>
<div id='err_required' class="form_error" style='display:none;'>
    <label class='form_error_title'>Please check the required fields</label>
</div>

            
            
<ol class='phpfmg_form' >

<li class='field_block' id='field_0_div'><div class='col_label'>
	<label class='form_field'>first name</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_0"  id="field_0" value="<?php  phpfmg_hsc("field_0", "First Name"); ?>" class='text_box' onblur="if (this.value == '') {this.value = 'First Name';}"
onfocus="if (this.value == 'First Name') {this.value = '';}">
	</div>
</li>

<li class='field_block' id='field_1_div'><div class='col_label'>
	<label class='form_field'>last name</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<input type="text" name="field_1"  id="field_1" value="<?php  phpfmg_hsc("field_1", "Last Name"); ?>" class='text_box' onblur="if (this.value == '') {this.value = 'Last Name';}" onfocus="if (this.value == 'Last Name') {this.value = '';}">
	</div>
</li>

<li class='field_block' id='field_2_div'><div class='col_label'>
	<label class='form_field'>email address</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="email" name="field_2"  id="field_2" value="<?php  phpfmg_hsc("field_2", "Email Address"); ?>" class='text_box' onblur="if (this.value == '') {this.value = 'Email Address';}" onfocus="if (this.value == 'Email Address') {this.value = '';}">
	</div>
</li>

<li class='field_block' id='field_5_div'><div class='col_label'>
	<label class='form_field'>message</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<textarea name="field_5" id="field_5" rows=4 cols=25 class='text_area' onblur="if (this.value == '') {this.value = 'Message';}" onfocus="if (this.value == 'Message') {this.value = '';}"><?php  phpfmg_hsc("field_5", "Message"); ?></textarea>
	</div>
</li>

<li class='field_block' id='field_3_div'><div class='col_label'>
	<label class='form_field'>website</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<input type="text" name="field_3"  id="field_3" value="<?php  phpfmg_hsc("field_3", "Website?"); ?>" class='text_box' onblur="if (this.value == '') {this.value = 'Website?';}" onfocus="if (this.value == 'Website?') {this.value = '';}">
	</div>
</li>

<li class='field_block' id='field_4_div'><div class='col_label'>
	<label class='form_field'>company</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<input type="text" name="field_4"  id="field_4" value="<?php  phpfmg_hsc("field_4", "Company Name"); ?>" class='text_box' onblur="if (this.value == '') {this.value = 'Company Name';}" onfocus="if (this.value == 'Company Name') {this.value = '';}">
	</div>
</li>


<li class='field_block' id='phpfmg_captcha_div'><div class='col_label'>
	<label class='form_field'>security code:</label> <label class='form_required' >*</label> </div>
    <div class='col_field captcha'>
	<?php phpfmg_show_captcha(); ?>
	</div>
</li>


<li>
<div class='form_submit_block col_field'>

    <input type='submit' value='Submit' class='form_button'>
    <span id='phpfmg_processing' style='display:none;'>
        <img id='phpfmg_processing_gif' src='<?php echo PHPFMG_ADMIN_URL . '?mod=image&amp;func=processing' ;?>' border=0 alt='Processing...'> <label id='phpfmg_processing_dots'></label>
    </span>
</div>
</li>
            
</ol>
            
            


</form>

<?php
			
    phpfmg_javascript($sErr);

} 
# end of form




function phpfmg_form_css(){
?>

	<!-- CSS
  ================================================== -->
<!--
<link rel="stylesheet" href="stylesheets/layout.css">
<link rel="stylesheet" href="stylesheets/skeleton.css">
-->
<link rel="stylesheet" href="stylesheets/base.css">
<link rel="stylesheet" href="stylesheets/skin.css">

<style type='text/css'>


body{
    font-size : 80%;
	font-family:Helvetica, Arial, sans-serif;
    color : #2560a2;
	background:none;
	line-height:1;
}
body {
	background-image:url(images/backgrounds/bisc-v3-960g-background.jpg)\9;
	background-position-y: -259px\9;
	/* background-position-x: -300px\9; */
}

p {
	margin:0px;
	font-size:120%;
	font-family: 'Dosis', Helvetica, serif;
	border:dashed 1px #ddd;
	padding:10px;
	text-align:center;
	line-height:1.3;
	color: #B5B40F;
}

select, option{
    font-size:13px;
}

form ol.phpfmg_form{
    width:100%;
	list-style-type:none;
    padding:0px;
    margin:0px;
}

ol.phpfmg_form li{
    margin-bottom:5px;
    clear:both;
    display:block;
    overflow:hidden;
	width: 100%;
	vertical-align:middle;
}
.field_block div.col_label{
	display: none;
}
.field_block#phpfmg_captcha_div div.col_label{
	display: block;
	color: #fff;
	text-align: left;
	width:100%;
	/* float: left; */
	margin-right: 15px;
	margin-top: 10px;
	clear: both;
}

.field_block#phpfmg_captcha_div div.col_label .form_required {
	display: none;
}

.phpfmg_form li .form_submit_block{
	margin:0;
	padding: 3px 0;
	}
#phpfmg_captcha_div .col_field a {
	display:block;
	padding:5px 5px 20px; 0;
	float:left;
	text-shadow: none;
}
.form_required {
    color:red;
    margin-right:8px;
}

/*
#phpfmg_captcha_div div.captcha {
	float:left;
}
*/

div.col_field a {
	font-size:72%;
	padding-bottom:-10px;
}

.fmgCaptchCode {
	margin:0;
	padding: 0;
}

div.col_field.captcha br {
	display: none;
}

/*
.text_box, .text_area, .text_select{
    width:230px;
}
*/

.text_area{
    height:80px;
}

.form_error_title{
    font-weight: bold;
    color: #5fafea;
}

.form_error{
    background-color: #ecf5fc;
    border: 1px dashed #ddd;
    padding: 10px;
    margin-bottom: 10px;
}

.form_error_highlight{
    background-color: #ecf5fc;
    border-bottom: 1px dashed #ddd;
}

div.instruction_error{
    color: #5fafea;
    font-weight:bold;
}

hr.sectionbreak{
    height:1px;
    color: #ddd;
}

#one_entry_msg{
    background-color: #f5f5f5;
    border: 1px dashed #ddd;
    padding: 10px;
    margin-bottom: 10px;
}
.field_block div.col_field{
	margin-left:0;
	float: none\9 !important;
}

form li .col_field input, form li .col_field textarea {
	background-color: rgba(255,255,255,.65)
}

<?php phpfmg_text_align();?>    

</style>

<?php
}
?>