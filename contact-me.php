<?php

# This block must be placed at the very top of page.
# --------------------------------------------------
require_once( dirname(__FILE__).'/form.lib.php' );
phpfmg_display_form();
# --------------------------------------------------

?>
<script type="text/javascript" src="/js/jquery/jquery-1.6.4.js"></script>
<script type="text/javascript" src="/js/site-functions/nav-hover.js"></script>
<div class="contact-me-page">

<div class="container">
  <header><a href="index.html"><img src="images/big-idea-supply-co.png" width="560" height="33" alt="The Big Idea Supply Company"></a><!-- end header --></header>
  
  <div class="center">
  <aside></aside>
  <div class="content">
    <nav>
      <ul>
        <li class="home"><a href="index.html" title="The Big Idea Supply Co. homepage" class="fadehover"><img src="images/home-button.png" width="88" height="24" alt="home" class="a main-nav-align"><img src="images/home-button-over.png" width="88" height="24" alt="home-over" class="b main-nav-align"></a></li>
        <li class="portfolio"><a href="portfolio.html" title="My portfolio" class="fadehover"><img src="images/portfolio-button.png" width="87" height="24" alt="bruce's portfolio" class="a main-nav-align"><img src="images/portfolio-button-over.png" width="87" height="24" alt="Bruce's portfolio over" class="b main-nav-align"></a></li>
        <li class="resume"><a href="resume.html" title="Download my resume" class="fadehover"><img src="images/resume-button.png" width="87" height="24" alt="Bruce'sResume" class="a main-nav-align"><img src="images/resume-button-over.png" width="87" height="24" alt="Bruce's Resume over" class="b main-nav-align"></a></li>
        <li class="about-me"><a href="about-me.html" title="More about Bruce" class="fadehover"><img src="images/about-me-button.png" width="88" height="24" alt="About Bruce" class="a main-nav-align"><img src="images/about-me-button-over.png" width="88" height="24" alt="About Bruce over" class="b main-nav-align"></a></li>
        <li class="contact-me"><a href="contact-me.html" title="Contact Bruce" class="fadehover"><img src="images/contact-me-button.png" width="88" height="24" alt="Contact Bruce" class="a main-nav-align"><img src="images/contact-me-button-over.png" width="88" height="24" alt="Contact Bruce over" class="b main-nav-align"></a><div>&bull;</div></li>
      </ul>
      <div class="clearfloat"></div>
    </nav>
    <article>
    <h2 class="article-top">Need the next big idea? The game changer?</h2>
    <p>The Big Idea Supply Co. has them in bulk. Give me a shout via the <strong>contact methods below</strong>.<br>
      Do yourself a favor. Take your site to the next level. Call the Big Idea Supply Company.</p>
    
    
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
	<input type="text" name="field_0"  id="field_0" value="<?php  phpfmg_hsc("field_0", ""); ?>" class='text_box'>
	<div id='field_0_tip' class='instruction'>first name</div>
	</div>
</li>

<li class='field_block' id='field_1_div'><div class='col_label'>
	<label class='form_field'>last name</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<input type="text" name="field_1"  id="field_1" value="<?php  phpfmg_hsc("field_1", ""); ?>" class='text_box'>
	<div id='field_1_tip' class='instruction'>last name</div>
	</div>
</li>

<li class='field_block' id='field_2_div'><div class='col_label'>
	<label class='form_field'>email address</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<input type="text" name="field_2"  id="field_2" value="<?php  phpfmg_hsc("field_2", ""); ?>" class='text_box'>
	<div id='field_2_tip' class='instruction'>email</div>
	</div>
</li>

<li class='field_block' id='field_5_div'><div class='col_label'>
	<label class='form_field'>message</label> <label class='form_required' >*</label> </div>
	<div class='col_field'>
	<textarea name="field_5" id="field_5" rows=4 cols=25 class='text_area'><?php  phpfmg_hsc("field_5"); ?></textarea>

	<div id='field_5_tip' class='instruction'>message...</div>
	</div>
</li>

<li class='field_block' id='field_3_div'><div class='col_label'>
	<label class='form_field'>website</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<input type="text" name="field_3"  id="field_3" value="<?php  phpfmg_hsc("field_3", ""); ?>" class='text_box'>
	<div id='field_3_tip' class='instruction'>website url</div>
	</div>
</li>

<li class='field_block' id='field_4_div'><div class='col_label'>
	<label class='form_field'>company</label> <label class='form_required' >&nbsp;</label> </div>
	<div class='col_field'>
	<input type="text" name="field_4"  id="field_4" value="<?php  phpfmg_hsc("field_4", ""); ?>" class='text_box'>
	<div id='field_4_tip' class='instruction'>company name</div>
	</div>
</li>


<li class='field_block' id='phpfmg_captcha_div'>
	<div class='col_label'><label class='form_field'>Security Code:</label> <label class='form_required' >*</label> </div><div class='col_field'>
	<?php phpfmg_show_captcha(); ?>
	</div>
</li>


            <li>
            <div class='col_label'>&nbsp;</div>
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

 
# end of form




function phpfmg_form_css(){
?>    
    
    </article>
    <div class="clearfloat"></div>
    <!-- end .content --></div>
  <div class="clearfloat"></div>
  </div>
  
  <footer>
   
    <div class="left">
    <p>More Ways to Hook Up</p>
    <ul class="social">
      <li class="linkedin"><a href="http://www.linkedin.com/in/rbrucepage" title="Bruce on LinkedIn" target="_blank" class="fadehover"><img src="images/linkedin.png" width="37" height="28" alt="linkedin link" class="a"><img src="images/linkedin-over.png" width="37" height="28" alt="linkedin over" class="b"></a></li>
      <li class="facebook"><a href="http://www.facebook.com/r.bruce.page" title="Bruce on Facebook" target="_blank" class="fadehover"><img src="images/facebook.png" width="37" height="28" alt="Facebook link" class="a"><img src="images/facebook-over.png" width="37" height="28" alt="facebook over" class="b"></a></li>
      <li class="twitter"><a href="http://twitter.com/rbrucepage" title="Bruce on Twitter" target="_blank" class="fadehover"><img src="images/twitter.png" width="37" height="28" alt="twitter link" class="a"><img src="images/twitter-over.png" width="37" height="28" alt="twitter over" class="b"></a></li>
    </ul>
    </div>
    <div class="right">
    <p class="copyright">Copyright 2011. All rights reserved. The Big Idea Supply Company.</p>
    <div class="clearfloat"></div>
     <ul class="tool-box">
      <li><img src="images/jquery.png" width="96" height="32" alt="jQuery"></li>
      <li><img src="images/apple.png" width="25" height="32" alt="Apple hardware"></li>
      <li><img src="images/css3.png" width="26" height="32" alt="CSS3"></li>
      <li><img src="images/html5.png" width="22" height="32" alt="HTML5"></li>
    </ul>
    </div>
    <div class="clearfloat"></div>
    <!-- end .footer --></footer>
  <!-- end .container --></div>
</div>


function phpfmg_form_css(){
?>
<link href="css/bisc-version2.css" rel="stylesheet" type="text/css">

<style type='text/css'>

body{
    margin-left: 18px;
    margin-top: 18px;
}

body{
    font-family : Verdana, Arial, Helvetica, sans-serif;
    font-size : 13px;
    color : #474747;
    background-color: transparent;
}

select, option{
    font-size:13px;
}

ol.phpfmg_form{
    list-style-type:none;
    padding:0px;
    margin:0px;
}

ol.phpfmg_form li{
    margin-bottom:5px;
    clear:both;
    display:block;
    overflow:hidden;
	width: 100%
}


.form_field, .form_required{
    font-weight : bold;
}

.form_required{
    color:red;
    margin-right:8px;
}

.field_block_over{
}

.form_submit_block{
    padding-top: 3px;
}

.text_box, .text_area, .text_select {
    width:300px;
}

.text_area{
    height:80px;
}

.form_error_title{
    font-weight: bold;
    color: red;
}

.form_error{
    background-color: #F4F6E5;
    border: 1px dashed #ff0000;
    padding: 10px;
    margin-bottom: 10px;
}

.form_error_highlight{
    background-color: #F4F6E5;
    border-bottom: 1px dashed #ff0000;
}

div.instruction_error{
    color: red;
    font-weight:bold;
}

hr.sectionbreak{
    height:1px;
    color: #ccc;
}

#one_entry_msg{
    background-color: #F4F6E5;
    border: 1px dashed #ff0000;
    padding: 10px;
    margin-bottom: 10px;
}

<?php phpfmg_text_align();?>    



</style>

<?php
}
# end of css
 
# By: formmail-maker.com
?>