<?php
require_once( dirname(__FILE__).'/form.lib.php' );

define( 'PHPFMG_USER', "info@bigideasupply.com" ); // must be a email address. for sending password to you.
define( 'PHPFMG_PW', "20111104-2883" );

?>
<?php
/**
 * Copyright (C) : http://www.formmail-maker.com
*/

# main
# ------------------------------------------------------
error_reporting( E_ERROR ) ;
phpfmg_admin_main();
# ------------------------------------------------------




function phpfmg_admin_main(){
    $mod  = isset($_REQUEST['mod'])  ? $_REQUEST['mod']  : '';
    $func = isset($_REQUEST['func']) ? $_REQUEST['func'] : '';
    $function = "phpfmg_{$mod}_{$func}";
    if( !function_exists($function) ){
        phpfmg_admin_default();
        exit;
    };

    // no login required modules
    $public_modules   = false !== strpos('|captcha|', "|{$mod}|");
    $public_functions = false !== strpos('|phpfmg_mail_request_password||phpfmg_filman_download||phpfmg_image_processing||phpfmg_dd_lookup|', "|{$function}|") ;   
    if( $public_modules || $public_functions ) { 
        $function();
        exit;
    };
    
    return phpfmg_user_isLogin() ? $function() : phpfmg_admin_default();
}

function phpfmg_admin_default(){
    if( phpfmg_user_login() ){
        phpfmg_admin_panel();
    };
}



function phpfmg_admin_panel()
{    
    phpfmg_admin_header();
    phpfmg_writable_check();
?>    
<table cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td valign=top style="padding-left:280px;">

<style type="text/css">
    .fmg_title{
        font-size: 16px;
        font-weight: bold;
        padding: 10px;
    }
    
    .fmg_sep{
        width:32px;
    }
    
    .fmg_text{
        line-height: 150%;
        vertical-align: top;
        padding-left:28px;
    }

</style>

<script type="text/javascript">
    function deleteAll(n){
        if( confirm("Are you sure you want to delete?" ) ){
            location.href = "admin.php?mod=log&func=delete&file=" + n ;
        };
        return false ;
    }
</script>


<div class="fmg_title">
    1. Email Traffics
</div>
<div class="fmg_text">
    <a href="admin.php?mod=log&func=view&file=1">view</a> &nbsp;&nbsp;
    <a href="admin.php?mod=log&func=download&file=1">download</a> &nbsp;&nbsp;
    <?php 
        if( file_exists(PHPFMG_EMAILS_LOGFILE) ){
            echo '<a href="#" onclick="return deleteAll(1);">delete all</a>';
        };
    ?>
</div>


<div class="fmg_title">
    2. Form Data
</div>
<div class="fmg_text">
    <a href="admin.php?mod=log&func=view&file=2">view</a> &nbsp;&nbsp;
    <a href="admin.php?mod=log&func=download&file=2">download</a> &nbsp;&nbsp;
    <?php 
        if( file_exists(PHPFMG_SAVE_FILE) ){
            echo '<a href="#" onclick="return deleteAll(2);">delete all</a>';
        };
    ?>
</div>

<div class="fmg_title">
    3. Form Generator
</div>
<div class="fmg_text">
    <a href="http://www.formmail-maker.com/generator.php" onclick="document.frmFormMail.submit(); return false;" title="<?php echo htmlspecialchars(PHPFMG_SUBJECT);?>">Edit Form</a> &nbsp;&nbsp;
    <a href="http://www.formmail-maker.com/generator.php" >New Form</a>
</div>
    <form name="frmFormMail" action='http://www.formmail-maker.com/generator.php' method='post' enctype='multipart/form-data'>
    <input type="hidden" name="uuid" value="<?php echo PHPFMG_ID; ?>">
    <input type="hidden" name="external_ini" value="<?php echo function_exists('phpfmg_formini') ?  phpfmg_formini() : ""; ?>">
    </form>

		</td>
	</tr>
</table>

<?php
    phpfmg_admin_footer();
}



function phpfmg_admin_header( $title = '' ){
    header( "Content-Type: text/html; charset=" . PHPFMG_CHARSET );
?>
<html>
<head>
    <title><?php echo '' == $title ? '' : $title . ' | ' ; ?>PHP FormMail Admin Panel </title>
    <meta name="keywords" content="PHP FormMail Generator, PHP HTML form, send html email with attachment, PHP web form,  Free Form, Form Builder, Form Creator, phpFormMailGen, Customized Web Forms, phpFormMailGenerator,formmail.php, formmail.pl, formMail Generator, ASP Formmail, ASP form, PHP Form, Generator, phpFormGen, phpFormGenerator, anti-spam, web hosting">
    <meta name="description" content="PHP formMail Generator - A tool to ceate ready-to-use web forms in a flash. Validating form with CAPTCHA security image, send html email with attachments, send auto response email copy, log email traffics, save and download form data in Excel. ">
    <meta name="generator" content="PHP Mail Form Generator, phpfmg.sourceforge.net">

    <style type='text/css'>
    body, td, label, div, span{
        font-family : Verdana, Arial, Helvetica, sans-serif;
        font-size : 12px;
    }
    </style>
</head>
<body  marginheight="0" marginwidth="0" leftmargin="0" topmargin="0">

<table cellspacing=0 cellpadding=0 border=0 width="100%">
    <td nowrap align=center style="background-color:#024e7b;padding:10px;font-size:18px;color:#ffffff;font-weight:bold;width:250px;" >
        Form Admin Panel
    </td>
    <td style="padding-left:30px;background-color:#86BC1B;width:100%;font-weight:bold;" >
        &nbsp;
<?php
    if( phpfmg_user_isLogin() ){
        echo '<a href="admin.php" style="color:#ffffff;">Main Menu</a> &nbsp;&nbsp;' ;
        echo '<a href="admin.php?mod=user&func=logout" style="color:#ffffff;">Logout</a>' ;
    }; 
?>
    </td>
</table>

<div style="padding-top:28px;">

<?php
    
}


function phpfmg_admin_footer(){
?>

</div>

<div style="color:#cccccc;text-decoration:none;padding:18px;font-weight:bold;">
	:: <a href="http://phpfmg.sourceforge.net" target="_blank" title="Free Mailform Maker: Create read-to-use Web Forms in a flash. Including validating form with CAPTCHA security image, send html email with attachments, send auto response email copy, log email traffics, save and download form data in Excel. " style="color:#cccccc;font-weight:bold;text-decoration:none;">PHP FormMail Generator</a> ::
</div>

</body>
</html>
<?php
}


function phpfmg_image_processing(){
    $img = new phpfmgImage();
    $img->out_processing_gif();
}


# phpfmg module : captcha
# ------------------------------------------------------
function phpfmg_captcha_get(){
    $img = new phpfmgImage();
    $img->out();
    $_SESSION[PHPFMG_ID.'fmgCaptchCode'] = $img->text ;
}



function phpfmg_captcha_generate_images(){
    for( $i = 0; $i < 50; $i ++ ){
        $file = "$i.png";
        $img = new phpfmgImage();
        $img->out($file);
        $data = base64_encode( file_get_contents($file) );
        echo "'{$img->text}' => '{$data}',\n" ;
        unlink( $file );
    };
}


function phpfmg_dd_lookup(){
    $paraOk = ( isset($_REQUEST['n']) && isset($_REQUEST['lookup']) && isset($_REQUEST['field_name']) );
    if( !$paraOk )
        return;
        
    $base64 = phpfmg_dependent_dropdown_data();
    $data = @unserialize( base64_decode($base64) );
    if( !is_array($data) ){
        return ;
    };
    
    
    foreach( $data as $field ){
        if( $field['name'] == $_REQUEST['field_name'] ){
            $nColumn = intval($_REQUEST['n']);
            $lookup  = $_REQUEST['lookup']; // $lookup is an array
            $dd      = new DependantDropdown(); 
            echo $dd->lookupFieldColumn( $field, $nColumn, $lookup );
            return;
        };
    };
    
    return;
}


function phpfmg_filman_download(){
    if( !isset($_REQUEST['filelink']) )
        return ;
        
    $info =  @unserialize(base64_decode($_REQUEST['filelink']));
    if( !isset($info['recordID']) ){
        return ;
    };
    
    $file = PHPFMG_SAVE_ATTACHMENTS_DIR . $info['recordID'] . '-' . $info['filename'];
    phpfmg_util_download( $file, $info['filename'] );
}


class phpfmgDataManager
{
    var $dataFile = '';
    var $columns = '';
    var $records = '';
    
    function phpfmgDataManager(){
        $this->dataFile = PHPFMG_SAVE_FILE; 
    }
    
    function parseFile(){
        $fp = @fopen($this->dataFile, 'rb');
        if( !$fp ) return false;
        
        $i = 0 ;
        $phpExitLine = 1; // first line is php code
        $colsLine = 2 ; // second line is column headers
        $this->columns = array();
        $this->records = array();
        $sep = chr(0x09);
        while( !feof($fp) ) { 
            $line = fgets($fp);
            $line = trim($line);
            if( empty($line) ) continue;
            $line = $this->line2display($line);
            $i ++ ;
            switch( $i ){
                case $phpExitLine:
                    continue;
                    break;
                case $colsLine :
                    $this->columns = explode($sep,$line);
                    break;
                default:
                    $this->records[] = explode( $sep, phpfmg_data2record( $line, false ) );
            };
        }; 
        fclose ($fp);
    }
    
    function displayRecords(){
        $this->parseFile();
        echo "<table border=1 style='width=95%;border-collapse: collapse;border-color:#cccccc;' >";
        echo "<tr><td>&nbsp;</td><td><b>" . join( "</b></td><td>&nbsp;<b>", $this->columns ) . "</b></td></tr>\n";
        $i = 1;
        foreach( $this->records as $r ){
            echo "<tr><td align=right>{$i}&nbsp;</td><td>" . join( "</td><td>&nbsp;", $r ) . "</td></tr>\n";
            $i++;
        };
        echo "</table>\n";
    }
    
    function line2display( $line ){
        $line = str_replace( array('"' . chr(0x09) . '"', '""'),  array(chr(0x09),'"'),  $line );
        $line = substr( $line, 1, -1 ); // chop first " and last "
        return $line;
    }
    
}
# end of class



# ------------------------------------------------------
class phpfmgImage
{
    var $im = null;
    var $width = 73 ;
    var $height = 33 ;
    var $text = '' ; 
    var $line_distance = 8;
    var $text_len = 4 ;

    function phpfmgImage( $text = '', $len = 4 ){
        $this->text_len = $len ;
        $this->text = '' == $text ? $this->uniqid( $this->text_len ) : $text ;
        $this->text = strtoupper( substr( $this->text, 0, $this->text_len ) );
    }
    
    function create(){
        $this->im = imagecreate( $this->width, $this->height );
        $bgcolor   = imagecolorallocate($this->im, 255, 255, 255);
        $textcolor = imagecolorallocate($this->im, 0, 0, 0);
        $this->drawLines();
        imagestring($this->im, 5, 20, 9, $this->text, $textcolor);
    }
    
    function drawLines(){
        $linecolor = imagecolorallocate($this->im, 210, 210, 210);
    
        //vertical lines
        for($x = 0; $x < $this->width; $x += $this->line_distance) {
          imageline($this->im, $x, 0, $x, $this->height, $linecolor);
        };
    
        //horizontal lines
        for($y = 0; $y < $this->height; $y += $this->line_distance) {
          imageline($this->im, 0, $y, $this->width, $y, $linecolor);
        };
    }
    
    function out( $filename = '' ){
        if( function_exists('imageline') ){
            $this->create();
            if( '' == $filename ) header("Content-type: image/png");
            ( '' == $filename ) ? imagepng( $this->im ) : imagepng( $this->im, $filename );
            imagedestroy( $this->im ); 
        }else{
            $this->out_predefined_image(); 
        };
    }

    function uniqid( $len = 0 ){
        $md5 = md5( uniqid(rand()) );
        return $len > 0 ? substr($md5,0,$len) : $md5 ;
    }
    
    function out_predefined_image(){
        header("Content-type: image/png");
        $data = $this->getImage(); 
        echo base64_decode($data);
    }
    
    // Use predefined captcha random images if web server doens't have GD graphics library installed  
    function getImage(){
        $images = array(
			'2AEF' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7WAMYAlhDHUNDkMREpjCGsDYwOiCrC2hlbUUXY2gVaXRFiEHcNG3aytTQlaFZyO4LQFEHhowOoqHoYqwNmOpEsIiFhgLFQh1R3TJA4UdFiMV9AC1dySI4sXj/AAAAAElFTkSuQmCC',
			'67F2' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nM3QMQ6AIAxA0TJwA7wPC3sHOshpSiI3QG/g0lNKtxIdNZFuL036A8jtMfxpPunzuFAi3KOx0KEmBkRjuKm5GKwxNK/7pm8tcpwkUkxf7oBjr9ob2Fwc1mAyz8M6TC1BDedmNUf5B//34jz0XUgLzAljV5sBAAAAAElFTkSuQmCC',
			'FD6A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpIn7QkNFQxhCGVqRxQIaRFoZHR2mOqCKNbo2OAQEYIgxOogguS80atrK1Kkrs6YhuQ+sztERpg5Jb2BoCKYYujqgW9D1gtzMiCI2UOFHRYjFfQAkWc2oKAwOugAAAABJRU5ErkJggg==',
			'BAF3' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7QgMYAlhDA0IdkMQCpjCGsDYwOgQgi7WytrICaREUdSKNriAayX2hUdNWpoauWpqF5D40dVDzRENd0c1rhajDtAPVLaEBYHUobh6o8KMixOI+AMUDzoHH/DGxAAAAAElFTkSuQmCC',
			'691D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7WAMYQximMIY6IImJTGFtZQhhdAhAEgtoEWl0BIqJIIs1iDQ6TIGLgZ0UGbV0ada0lVnTkNwXMoUxEEkdRG8rQyOmGAuGGNgtU1DdAnIzY6gjipsHKvyoCLG4DwD7zstPi/D2gAAAAABJRU5ErkJggg==',
			'2863' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7WAMYQxhCGUIdkMREprC2Mjo6OgQgiQW0ijS6Njg0iCDrbmVtZQXJIbtv2sqwpVNXLc1Cdl8AUJ2jQwOyeYwOIPMCUMxjbcAUE2nAdEtoKKabByr8qAixuA8AO/LMSRw3xvYAAAAASUVORK5CYII=',
			'1441' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7GB0YWhkaHVqRxVgdGKYytDpMRRYTdWAIZZjqEIqql9GVIRCuF+yklVlLl67MzFqK7D5GB5FWVjQ7GB1EQ11DA1oJuQWbmGgIWCw0YBCEHxUhFvcBAATAyc84tltFAAAAAElFTkSuQmCC',
			'399E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpIn7RAMYQxhCGUMDkMQCprC2Mjo6OqCobBVpdG0IRBWbgiIGdtLKqKVLMzMjQ7OQ3TeFMdAhBE1vK0OjA7p5rSyNjmhi2NyCzc0DFX5UhFjcBwB0c8n7GIrvswAAAABJRU5ErkJggg==',
			'2706' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAc0lEQVR4nGNYhQEaGAYTpIn7WANEQx2mMEx1QBITmcLQ6BDKEBCAJBbQytDo6OjoIICsu5WhlbUh0AHFfdNWTVu6KjI1C9l9AQwBQHUo5jE6MDqA9IoguwUIGYF2IIuJACEDmltCQ4FiaG4eqPCjIsTiPgDMN8r4RcQeuAAAAABJRU5ErkJggg==',
			'3367' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7RANYQxhCGUNDkMQCpoi0Mjo6NIggq2xlaHRtQBObwtDKClKP5L6VUavClk5dtTIL2X0gdY4OrQwY5gVMwSIWwIDhFkcHLG5GERuo8KMixOI+AIJxy3Qu/+qXAAAAAElFTkSuQmCC',
			'56A1' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7QkMYQximMLQiiwU0sLYyhDJMRRUTaWR0dAhFFgsMEGlgbQiA6QU7KWzatLClq6KWorivVbQVSR1UTKTRNRRVLAAkhqZOZAorhl7WAMYQoFhowCAIPypCLO4DAOS5zPd71HooAAAAAElFTkSuQmCC',
			'B66B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7QgMYQxhCGUMdkMQCprC2Mjo6OgQgi7WKNLI2ODqIoKgTaWBtYISpAzspNGpa2NKpK0OzkNwXMEW0lRWLea4NgajmYRPD4hZsbh6o8KMixOI+AKLpzKNQny+zAAAAAElFTkSuQmCC',
			'8028' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7WAMYAhhCGaY6IImJTGEMYXR0CAhAEgtoZW1lbQh0EEFRJ9Lo0BAAUwd20tKoaSuzVmZNzUJyH1hdKwOaeUCxKYwo5oHsYAhgRLMD6BYHVL0gN7OGBqC4eaDCj4oQi/sAkYPLpO4zPuYAAAAASUVORK5CYII=',
			'37B6' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7RANEQ11DGaY6IIkFTGFodG10CAhAVtkKFGsIdBBAFpvC0Mra6OiA7L6VUaumLQ1dmZqF7L4pDAFAdWjmMTqwAs0TQRFjbUAXC5gi0sCK5hbRAKAYmpsHKvyoCLG4DwBucMxKCOF3hAAAAABJRU5ErkJggg==',
			'0DC1' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXElEQVR4nGNYhQEaGAYTpIn7GB1EQxhCHVqRxVgDRFoZHQKmIouJTBFpdG0QCEUWC2gFiTHA9IKdFLV02srUVauWIrsPTR1OMagd2NyCIgZ1c2jAIAg/KkIs7gMAZgXMa+G6RQQAAAAASUVORK5CYII=',
			'228F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7WAMYQxhCGUNDkMREprC2Mjo6OiCrC2gVaXRtCEQRY2hlaHREqIO4adqqpatCV4ZmIbsvgGEKunmMDgwBrGjmsQJF0cVEQKJoekNDRUMdQhlR3TJA4UdFiMV9AOOLyJhfsX6PAAAAAElFTkSuQmCC',
			'3FBF' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAVUlEQVR4nGNYhQEaGAYTpIn7RANEQ11DGUNDkMQCpog0sDY6OqCobAWKNQSiiqGqAztpZdTUsKWhK0OzkN1HrHlYxLC5RTQAKBbKiKp3gMKPihCL+wDVX8oraGdVTQAAAABJRU5ErkJggg==',
			'9CF0' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYElEQVR4nGNYhQEaGAYTpIn7WAMYQ1lDA1qRxUSmsDa6NjBMdUASC2gVaQCKBQSgibE2MDqIILlv2tRpq5aGrsyahuQ+VlcUdRDYiikmgMUObG4BuxlowmAIPypCLO4DAM5Gy8JE9AisAAAAAElFTkSuQmCC',
			'BD38' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWElEQVR4nGNYhQEaGAYTpIn7QgNEQxhDGaY6IIkFTBFpZW10CAhAFmsVaXRoCHQQQVXX6IBQB3ZSaNS0lVlTV03NQnIfmjrc5mG3A8Mt2Nw8UOFHRYjFfQCbTs+6N60xpwAAAABJRU5ErkJggg==',
			'C9A5' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAc0lEQVR4nGNYhQEaGAYTpIn7WEMYQximMIYGIImJtLK2MoQyOiCrC2gUaXR0dEQVaxBpdG0IdHVAcl/UqqVLU1dFRkUhuS+ggTHQFaQaRS9Do2somlgjC8g8BxE0t7A2BAQguw/kZqDYVIdBEH5UhFjcBwDFCc0Jdrn9yAAAAABJRU5ErkJggg==',
			'49C8' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpI37pjCGMIQ6THVAFgthbWV0CAgIQBJjDBFpdG0QdBBBEmOdAhJjgKkDO2natKVLU1etmpqF5L6AKYyBSOrAMDSUAaiXEcU8hiksGHYwTMF0C1Y3D1T4UQ9icR8ANYHMRyYjPGUAAAAASUVORK5CYII=',
			'A2B8' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7GB0YQ1hDGaY6IImxBrC2sjY6BAQgiYlMEWl0bQh0EEESC2hlaHRFqAM7KWrpqqVLQ1dNzUJyH1DdFHTzQkMZAlgxzGN0wBRjbUDXG9AqGuqK5uaBCj8qQizuAwCR9s2KOFnSZQAAAABJRU5ErkJggg==',
			'607C' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdUlEQVR4nGNYhQEaGAYTpIn7WAMYAlhDA6YGIImJTGEMYWgICBBBEgtoYW1laAh0YEEWaxBpdGh0dEB2X2TUtJVZS1dmIbsvZApQ3RRGB2R7A1qBYgHoYqytjA6MKHaA3MLawIDiFrCbGxhQ3DxQ4UdFiMV9ADW3yy9UxM8GAAAAAElFTkSuQmCC',
			'EE3A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAW0lEQVR4nGNYhQEaGAYTpIn7QkNEQxlDGVqRxQIaRBpYGx2mOqCJAcmAAHSxRkcHEST3hUZNDVs1dWXWNCT3oalDMi8wNARTDEMdK5peiJsZUcQGKvyoCLG4DwCXVM0m9LIFZwAAAABJRU5ErkJggg==',
			'915E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7WAMYAlhDHUMDkMREpjAGsDYwOiCrC2hlxSIG1DsVLgZ20rSpq6KWZmaGZiG5j9WVIYChIRBFL0MrppgAyDw0MZEpDAGMjo4oYkCXhDKEMqK4eaDCj4oQi/sADwbHNbuYZ0MAAAAASUVORK5CYII=',
			'1A04' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7GB0YAhimMDQEIImxOjCGMIQyNCKLiTqwtjI6OrQGoOgVaXRtCJgSgOS+lVnTVqauioqKQnIfRF2gA6pe0VCgWGgImnmOjg4N6HY4hKK6TzQEKIbm5oEKPypCLO4DAATvy5/+3IFRAAAAAElFTkSuQmCC',
			'05C1' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7GB1EQxlCHVqRxVgDRIDiAVORxUSmiDSwNgiEIosFtIqEsDYwwPSCnRS1dOrSpatWLUV2X0ArQ6MrQh1OMaAdQDEBNLewtgLdgiLG6MAYAnRzaMAgCD8qQizuAwBovMupQCPhAAAAAABJRU5ErkJggg==',
			'266D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7WAMYQxhCGUMdkMREprC2Mjo6OgQgiQW0ijSyNjg6iCDrbhVpYG1ghIlB3DRtWtjSqSuzpiG7L0C0ldURVS9QV6NrQyCKGGsDphjQBgy3hIZiunmgwo+KEIv7ALlhyk/yGSRNAAAAAElFTkSuQmCC',
			'4022' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdElEQVR4nM3QwQ2AIAxA0XLoBgxUNygJvTgCU8CBDZAdYErxVtSjJrS3HxJeCv0xEVbaf3wFGAQO0s0bbzZiVs14zBgdWdWw2ESRo1W+WmsLLfRd+fh6lyHpP0RGK5BnC+ahKXMbFhr1ZkZx4le433f74jsB+9vLNl2KzKoAAAAASUVORK5CYII=',
			'6845' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7WAMYQxgaHUMDkMREprC2MrQ6OiCrC2gRaXSYiibWAFQX6OjqgOS+yKiVYSszM6OikNwXAjSPtdGhQQRZb6tIoyvQVnQxh0ZHBxF0tzQ6BCC7D+Jmh6kOgyD8qAixuA8A0s/M7BvG660AAAAASUVORK5CYII=',
			'AB71' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7GB1EQ1hDA1qRxVgDRID8gKnIYiJTRBodGgJCkcUCWoHqGh1gesFOilo6NWzVUiBEch9Y3RQGFDtCQ4HmBaCKAdU1OjpgiLWyNqCLAd3cwBAaMAjCj4oQi/sAQlPNKrxFs1oAAAAASUVORK5CYII=',
			'738D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYElEQVR4nGNYhQEaGAYTpIn7QkNZQxhCGUMdkEVbRVoZHR0dAlDEGBpdGwIdRJDFpjCA1Ykguy9qVdiq0JVZ05Dcx+iAog4MWRswzRPBIhbQgOmWgAYsbh6g8KMixOI+APlNypIdBUJLAAAAAElFTkSuQmCC',
			'C43B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7WEMYWhlDGUMdkMREWhmmsjY6OgQgiQU0MoQyNAQ6iCCLNTC6MiDUgZ0UtWrp0lVTV4ZmIbkvAGQiunkNokA70cxrZGhFtwOosxXdLdjcPFDhR0WIxX0ATuPMVprbqPkAAAAASUVORK5CYII=',
			'B2C4' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nM2QsRGAMAhFSZE+he5DY08RmkyDRTbICmmYUs4qREs95XfvPtw7QC8j8Ke84scUMjAKDYxarAFpd6wu+yap+h4Yg0aDHxftXbWUwc96LYpddPeAjHF2LGCUNLucmyNjWhkn56/+92Bu/A7tQc8i64bIAgAAAABJRU5ErkJggg==',
			'B715' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nM2QsRGAMAhFoXCDuA8W9hTSZJqkyAaYHcyUUhJjqXfhV/z7/HsHtGESzKRf+IRXIUVh57FCpgPJ57hA3p6eQgHFnRyfxFZbvWJ0fJZjUEih67OuwVuS9VHnqW127/mEQ0Khkyb434d64bsBZGrMdmgiotYAAAAASUVORK5CYII=',
			'74C5' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nGNYhQEaGAYTpIn7QkMZWhlCHUMDkEVbGaYyOgQ6MKCKhbI2CKKKTWF0ZW1gdHVAdl/U0qVLV62MikJyH6ODSCsrkBZB0svaIBrqiiYGZLeC7EAWA7qrldEhICAATYwh1GGqwyAIPypCLO4DAPImyrOpU2IiAAAAAElFTkSuQmCC',
			'1476' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nGNYhQEaGAYTpIn7GB0YWllDA6Y6IImxOjBMZWgICAhAEhN1YAhlaAh0EEDRy+jK0OjogOy+lVlLl65aujI1C8l9jA4irQxTGFHMY3QQDXUIAMqguQVoJoYYawMDqltCwGIobh6o8KMixOI+ALpEyIA5vT26AAAAAElFTkSuQmCC',
			'6BC6' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7WANEQxhCHaY6IImJTBFpZXQICAhAEgtoEWl0bRB0EEAWaxBpZW1gdEB2X2TU1LClq1amZiG5L2QKWB2qea0g8xgdRDDEBFHEsLkFm5sHKvyoCLG4DwBZvcxh9REeiQAAAABJRU5ErkJggg==',
			'EDF8' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWElEQVR4nGNYhQEaGAYTpIn7QkNEQ1hDA6Y6IIkFNIi0sjYwBASgijW6NjA6iGCIwdWBnRQaNW1lauiqqVlI7kNTR8A8DDEMt4Dd3MCA4uaBCj8qQizuAwA59M3GGmdWWAAAAABJRU5ErkJggg==',
			'FA0B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7QkMZAhimMIY6IIkFNDCGMIQyOgSgiLG2Mjo6OoigiIk0ujYEwtSBnRQaNW1l6qrI0Cwk96Gpg4qJhoLE0M1zxGKHA4ZbgGJobh6o8KMixOI+ACtYzVBXM4WiAAAAAElFTkSuQmCC',
			'C946' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7WEMYQxgaHaY6IImJtLK2MrQ6BAQgiQU0igBVOToIIIs1AMUCHR2Q3Re1aunSzMzM1Cwk9wU0MAa6NjqimtfA0OgaGugggmIHS6NDoyOKGNgtjahuwebmgQo/KkIs7gMAylXNf6+iBBYAAAAASUVORK5CYII=',
			'91AB' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7WAMYAhimMIY6IImJTGEMYAhldAhAEgtoZQ1gdHR0EEERYwhgbQiEqQM7adrUVVFLV0WGZiG5j9UVRR0EgvSGBqKYJwA1TwTFLZh6WYE6gWIobh6o8KMixOI+AJbuyXamF+PTAAAAAElFTkSuQmCC',
			'2F8E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYElEQVR4nGNYhQEaGAYTpIn7WANEQx1CGUMDkMREpog0MDo6OiCrC2gVaWBtCEQRY2hFUQdx07SpYatCV4ZmIbsvANM8RgdM81gbMMVEGjD1hoaKNDCguXmgwo+KEIv7AFH7yRacXDdwAAAAAElFTkSuQmCC',
			'9ABA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAc0lEQVR4nGNYhQEaGAYTpIn7WAMYAlhDGVqRxUSmMIawNjpMdUASC2hlbWVtCAgIQBETaXRtdHQQQXLftKnTVqaGrsyahuQ+VlcUdRDYKhrq2hAYGoIkJgAyryEQRZ3IFEy9rAFAsVBGVPMGKPyoCLG4DwDKCcy6yfJDDQAAAABJRU5ErkJggg==',
			'2A03' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7WAMYAhimMIQ6IImJTGEMYQhldAhAEgtoZW1ldHRoEEHW3SrS6NoQ0BCA7L5p01amropamoXsvgAUdWDI6CAaChJDNo+1QaTREc0OEaCYA5pbQkOBYmhuHqjwoyLE4j4AuhvM7LiLoGsAAAAASUVORK5CYII=',
			'7F49' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7QkNFQx0aHaY6IIu2igCxQ0AAuthURwcRZLEpQF4gXAzipqipYSszs6LCkNzHCFTBCrQDWS9rA1AsNKABWUwExGt0QLEjACKG4haoGKqbByj8qAixuA8Aqs7MttspyuIAAAAASUVORK5CYII=',
			'8104' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7WAMYAhimMDQEIImJTGEMYAhlaEQWC2hlDWB0dGhFVccQwNoQMCUAyX1Lo1ZFLV0VFRWF5D6IukAHVPPAYqEhaGJAOxrQ7QC6BUWMNYA1FN3NAxV+VIRY3AcAfYHLrsSMyWoAAAAASUVORK5CYII=',
			'0F91' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7GB1EQx1CGVqRxVgDRBoYHR2mIouJTBFpYG0ICEUWC2gFi8H0gp0UtXRq2MrMqKXI7gOpYwgJaEXXy9CAKgaygxFNDOoWFDFGB6DeUIbQgEEQflSEWNwHAEJMy3/skuasAAAAAElFTkSuQmCC',
			'4427' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nM2QMQ6AIAwA24Ef4H9wcK8J/QSvYPEHlR8wwCvFraCjRnvbJU0vhXqZCH/inT6BDRjZa+dhx9lFqxx6YBOpc0ZwgeZI9aWUcy2hBNVHYjc4UbvMEztp18cWagwOHbrRGV5799X/nuOm7wBh6sqVpKcv+AAAAABJRU5ErkJggg==',
			'D311' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAW0lEQVR4nGNYhQEaGAYTpIn7QgNYQximMLQiiwVMEWllCGGYiiLWytDoGMIQiibWiqQX7KSopavCVk1btRTZfWjq4OY5ECMGcguaGMjNjKEOoQGDIPyoCLG4DwBtHM1Tndzi6QAAAABJRU5ErkJggg==',
			'EB42' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7QkNEQxgaHaY6IIkFNIi0MrQ6BASgigFVOTqIoKsLdGgQQXJfaNTUsJWZWauikNwHUsfa6NCIZkeja2hAKwO6HY0OUxjQ7Wh0CMB0s2NoyCAIPypCLO4DAKOVzu3USbLWAAAAAElFTkSuQmCC',
			'FA77' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7QkMZAlhDA0NDkMQCGhhDQKQIihhrK6aYSKNDowOQRrgvNGrayqylq1ZmIbkPrG4KQysDil7RUIcAhikMaOY5OjAEoIu5NjA6EBIbqPCjIsTiPgCaAM34ivCb+wAAAABJRU5ErkJggg==',
			'E951' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7QkMYQ1hDHVqRxQIaWFtZGximooqJNLo2MIRiiE1lgOkFOyk0aunS1MyspcjuC2hgDHRoCECzg6ERU4wFaAe6GGsroyOq+0BuBrokNGAQhB8VIRb3AQDL482EiJ0ESAAAAABJRU5ErkJggg==',
			'F53F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXklEQVR4nGNYhQEaGAYTpIn7QkNFQxmBMARJLKBBpIG10dGBAU2MoSEQXSyEAaEO7KTQqKlLV01dGZqF5L6ABoZGBwzzgGKY5mERY23FdAtjCNDNKGIDFX5UhFjcBwAVUcwRYI9COgAAAABJRU5ErkJggg==',
			'B20B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7QgMYQximMIY6IIkFTGFtZQhldAhAFmsVaXR0dHQQQVHH0OjaEAhTB3ZSaNSqpUtXRYZmIbkPqG4KK0Id1DyGAJAYinmtjA6MGHawNqC7JTRANNQBzc0DFX5UhFjcBwC/vMyWY0RKxgAAAABJRU5ErkJggg==',
			'4502' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAc0lEQVR4nM2QoRGAMAxFU9ENwj4g8BGJYZpUsEHaDTBMScGQHki4a/5988x/F9gfp9BT/vGzQcAgj54xKggQORYqC9M0omPRkKOSovMrJW/bvtTcfmSQZqXkN0QutrYumOqEtSyup0vLAtcK9/C/7/LidwAXzsw1yKegIwAAAABJRU5ErkJggg==',
			'9D7F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7WANEQ1hDA0NDkMREpoi0MjQEOiCrC2gVaXTAJtboCBMDO2na1Gkrs5auDM1Cch+rK1DdFEYUvQwgvQGoYgJAMUcHVDGQW1gbUMXAbkYTG6jwoyLE4j4AYhbKTeUoGCMAAAAASUVORK5CYII=',
			'DA8B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7QgMYAhhCGUMdkMQCpjCGMDo6OgQgi7WytrI2BDqIoIiJNDoi1IGdFLV02sqs0JWhWUjuQ1MHFRMNdcViHobYFEy9oQEijQ5obh6o8KMixOI+AIHuzY1udQwVAAAAAElFTkSuQmCC',
			'CDAF' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7WENEQximMIaGIImJtIq0MoQyOiCrC2gUaXR0dEQVaxBpdG0IhImBnRS1atrK1FWRoVlI7kNThxALDcSwA10dyC2saGIgN6OLDVT4URFicR8Ai43LyLtqOPcAAAAASUVORK5CYII=',
			'6908' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7WAMYQximMEx1QBITmcLayhDKEBCAJBbQItLo6OjoIIIs1iDS6NoQAFMHdlJk1NKlqauipmYhuS9kCmMgkjqI3lYGoN5AVPNaWTDswOYWbG4eqPCjIsTiPgAI68ze72XD6AAAAABJRU5ErkJggg==',
			'1904' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7GB0YQximMDQEIImxOrC2MoQyNCKLiTqINDo6OrQGoOgVaXRtCJgSgOS+lVlLl6auioqKQnIf0I5A14ZAB1S9DEC9gaEhKGIsIDsaUNWB3YIiJhqC6eaBCj8qQizuAwDTlMsosIo2IgAAAABJRU5ErkJggg==',
			'9AB0' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7WAMYAlhDGVqRxUSmMIawNjpMdUASC2hlbWVtCAgIQBETaXRtdHQQQXLftKnTVqaGrsyahuQ+VlcUdRDYKhrq2hCIIiYAMg/NDpEpIL2obmENAIqhuXmgwo+KEIv7AF7/zWCGqS8xAAAAAElFTkSuQmCC',
			'B968' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7QgMYQxhCGaY6IIkFTGFtZXR0CAhAFmsVaXRtcHQQQVEHEmOAqQM7KTRq6dLUqaumZiG5L2AKY6ArhnkMQL2BqOa1smCKYXELNjcPVPhREWJxHwCII84RXP4iJgAAAABJRU5ErkJggg==',
			'6950' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdUlEQVR4nGNYhQEaGAYTpIn7WAMYQ1hDHVqRxUSmsLayNjBMdUASC2gRaXRtYAgIQBZrAIpNZXQQQXJfZNTSpamZmVnTkNwXMoUx0KEhEKYOoreVoRFTjAVoRwCKHSC3MDo6oLgF5GaGUAYUNw9U+FERYnEfAMbyzKzPqebAAAAAAElFTkSuQmCC',
			'3A71' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7RAMYAlhDA1qRxQKmMIYAyakoKltZgWoCQlHEpog0OjQ6wPSCnbQyatrKrKWrlqK4D6RuCkMrqnmioQ4B6GIijY4ODGhuEWl0bUAVEw0Ai4UGDILwoyLE4j4AzFPMx1Q7DI8AAAAASUVORK5CYII=',
			'69CB' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7WAMYQxhCHUMdkMREprC2MjoEOgQgiQW0iDS6Ngg6iCCLNYDEGGHqwE6KjFq6NHXVytAsJPeFTGEMRFIH0dvKANaLYl4rC4Yd2NyCzc0DFX5UhFjcBwDUd8vjdSPXxwAAAABJRU5ErkJggg==',
			'FE52' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7QkNFQ1lDHaY6IIkFNIg0sDYwBARgiDE6iKCLTWVoEEFyX2jU1LClmVmropDcFwBWEdCIbgeQbGXAsCNgCroYo6NDAKqYaChDKGNoyCAIPypCLO4DAGi6zSd6Y7zSAAAAAElFTkSuQmCC',
			'CA2B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdklEQVR4nGNYhQEaGAYTpIn7WEMYAhhCGUMdkMREWhlDGB0dHQKQxAIaWVtZGwIdRJDFGkQaHYBiAUjui1o1bWXWyszQLCT3gdW1MqKa1yAa6jCFEdW8RqC6AFQxkVaRRkcHVL2sISKNrqGBKG4eqPCjIsTiPgCtrMwAfPvFuAAAAABJRU5ErkJggg==',
			'7E11' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXElEQVR4nGNYhQEaGAYTpIn7QkNFQxmmMLSiiLaKNDCEMExFF2MMYQhFEZsCVIfQC3FT1NSwVdNWLUV2H6MDijowZG3AFBPBIhaAVUw0lDHUITRgEIQfFSEW9wEAXnHK+QXvGysAAAAASUVORK5CYII=',
			'4B8C' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpI37poiGMIQyTA1AFgsRaWV0dAgQQRJjDBFpdG0IdGBBEmOdAlLn6IDsvmnTpoatCl2Zhey+AFR1YBgaCjEP1S2YdjBMwXQLVjcPVPhRD2JxHwCGIssDs0DTmgAAAABJRU5ErkJggg==',
			'67BA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdklEQVR4nGNYhQEaGAYTpIn7WANEQ11DGVqRxUSmMDS6NjpMdUASC2gBijUEBAQgizUwtLI2OjqIILkvMmrVtKWhK7OmIbkvZApDAJI6iN5WRgfWhsDQEBQx1gagGIo6kSkiDeh6WQOAYqGMKGIDFX5UhFjcBwALIMyYURWh2gAAAABJRU5ErkJggg==',
			'4F50' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpI37poiGuoY6tKKIhYg0sDYwTHVAEmOEiAUEIImxTgGKTWV0EEFy37RpU8OWZmZmTUNyX8AUkIpAmDowDA3FFGMAmdcQgGIHSIzR0QHFLSAxhlAGVDcPVPhRD2JxHwCE78vAhI6KNAAAAABJRU5ErkJggg==',
			'7E46' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7QkNFQxkaHaY6IIu2igCxQ0AAuthURwcBZLEpQLFARwcU90VNDVuZmZmaheQ+RgeRBtZGRxTzWBuAYqGBQBmEmAgQMjQ6oogFgMVQ3RLQgMXNAxR+VIRY3AcA1HDMDHBKs4wAAAAASUVORK5CYII=',
			'A78E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7GB1EQx1CGUMDkMRYAxgaHR0dHZDViUxhaHRtCEQRC2hlaGVEqAM7KWrpqmmrQleGZiG5D6gugBHNvNBQRgdWDPNYGzDFRBrQ9YLEGNDcPFDhR0WIxX0AgHPKNc2p7P0AAAAASUVORK5CYII=',
			'C430' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7WEMYWhlDGVqRxURaGaayNjpMdUASC2hkCAWSAQHIYg2MrgyNjg4iSO6LWrV06aqpK7OmIbkvAGQiQh1UTDTUoSEQVawR5A5UO4A6W9Hdgs3NAxV+VIRY3AcAQSvNG9EniLAAAAAASUVORK5CYII=',
			'4032' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpI37pjAEMIYyTHVAFgthDGFtdAgIQBIDirQyNAQ6iCCJsU4RaXRodGgQQXLftGnTVmZNXbUqCsl9ARB1jch2hIYCxRoCWlHdArIjYAqqGMQtmG5mDA0ZDOFHPYjFfQDJq8y8iDfUmgAAAABJRU5ErkJggg==',
			'9831' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7WAMYQxhDGVqRxUSmsLayNjpMRRYLaBVpdGgICEUVY21laHSA6QU7adrUlWGrpq5aiuw+VlcUdRAIMQ9FTACLGNQtKGJQN4cGDILwoyLE4j4ABPLM3Rc723EAAAAASUVORK5CYII=',
			'E446' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7QkMYWhkaHaY6IIkFNDBMZWh1CAhAFQtlmOroIIAixujKEOjogOy+0KilS1dmZqZmIbkvoEGklbXREc080VDX0EAHEVQ7gG5xxCKG6hZsbh6o8KMixOI+ALO9zX1h33o+AAAAAElFTkSuQmCC',
			'448C' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpI37pjC0MoQyTA1AFgthmMro6BAggiTGGMIQytoQ6MCCJMY6hdGV0dHRAdl906YtXboqdGUWsvsCpoi0IqkDw9BQ0VBXoHnobkG3AySG7hasbh6o8KMexOI+AHyOyjR1F/b2AAAAAElFTkSuQmCC',
			'82FD' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7WAMYQ1hDA0MdkMREprC2sjYwOgQgiQW0ijS6AsVEUNQxIIuBnbQ0atXSpaErs6YhuQ+obgormt6AVoYATDFGB3QxoFsa0N3CGiAaCrQXxc0DFX5UhFjcBwBKfcqXbrZWrwAAAABJRU5ErkJggg==',
			'81CE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAX0lEQVR4nGNYhQEaGAYTpIn7WAMYAhhCHUMDkMREpjAGMDoEOiCrC2hlDWBtEEQRE5nCABRjhImBnbQ0alXU0lUrQ7OQ3IemDmoeLjFMO9DdAnRJKLqbByr8qAixuA8AqrrHxjRk88QAAAAASUVORK5CYII=',
			'C2EA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7WEMYQ1hDHVqRxURaWVtZGximOiCJBTSKNLo2MAQEIIs1MADFGB1EkNwXtWrV0qWhK7OmIbkPqG4KK0IdTCwAKBYagmIHowO6OqBbGtDFWENEQ11DHVHEBir8qAixuA8AKgfLJIh8OiQAAAAASUVORK5CYII=',
			'C566' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7WENEQxlCGaY6IImJtIo0MDo6BAQgiQU0ijSwNjg6CCCLNYiEsDYwOiC7L2rV1KVLp65MzUJyH9CcRldHR1TzQGINgQ4iqHZgiIm0sraiu4U1hDEE3c0DFX5UhFjcBwA24sxQ6D2upgAAAABJRU5ErkJggg==',
			'C137' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7WEMYAhhDGUNDkMREWhkDWBsdGkSQxAIaWQOAJKpYA0MAA1BdAJL7okBo6qqVWUjug6prZUDX2xAwBUWsESwWwIDiFgagWxwdUN3MCnQxI4rYQIUfFSEW9wEAz5DK3KOjzj0AAAAASUVORK5CYII=',
			'0FCA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpIn7GB1EQx1CHVqRxVgDRIDiAVMdkMREpog0sDYIBAQgiQW0gsQYHUSQ3Be1dGrY0lUrs6YhuQ9NHbJYaAiGHYIo6iBuCUQRA5sU6ogiNlDhR0WIxX0Apy3KxNS1woUAAAAASUVORK5CYII=',
			'0D28' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nGNYhQEaGAYTpIn7GB1EQxhCGaY6IImxBoi0Mjo6BAQgiYlMEWl0bQh0EEESC2gVaXRoCICpAzspaum0lVkrs6ZmIbkPrK6VAcU8sNgURhTzQHY4BKCKgd3igKoX5GbW0AAUNw9U+FERYnEfADX5zCb1DVqyAAAAAElFTkSuQmCC',
			'FDEE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAS0lEQVR4nGNYhQEaGAYTpIn7QkNFQ1hDHUMDkMQCGkRaWRsYHRhQxRpd8YuBnRQaNW1laujK0Cwk9xGhF58YFrdgunmgwo+KEIv7AGvvy5x5A3QiAAAAAElFTkSuQmCC',
			'7FA3' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7QkNFQx2mMIQ6IIu2ijQwhDI6BKCJMTo6NIggi00RaWBtCGgIQHZf1NSwpauilmYhuY/RAUUdGLICTWINDUAxT6QBog5ZLAAsFojiFohYAKqbByj8qAixuA8ATCzNZFxvQtgAAAAASUVORK5CYII=',
			'03D5' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7GB1YQ1hDGUMDkMRYA0RaWRsdHZDViUxhaHRtCEQRC2hlaGVtCHR1QHJf1NJVYUtXRUZFIbkPoi6gQQRVL9A8VDGYHSIYbnEIQHYfxM0MUx0GQfhREWJxHwB/9MvbrAbV3QAAAABJRU5ErkJggg==',
			'D731' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7QgNEQx1DGVqRxQKmMDS6NjpMRRFrZWh0aAgIRRMDicL0gp0UtXTVtFVTVy1Fdh9QXQCSOqgYowNYBkWMtQFDbIpIAyua3tAAkQbGUIbQgEEQflSEWNwHAIR5zsMh7CTEAAAAAElFTkSuQmCC',
			'3F51' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7RANEQ11DHVqRxQKmiDSwNjBMRVHZChYLRREDqZvKANMLdtLKqKlhSzOzlqK4D6gOaGorunnYxFjRxEBuYXREdZ9ogAjIJaEBgyD8qAixuA8Apo3LynQLZcsAAAAASUVORK5CYII=',
			'2C36' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7WAMYQxlDGaY6IImJTGFtdG10CAhAEgtoFWlwaAh0EEDWDRRjaHR0QHHftGmrVk1dmZqF7L4AsDoU8xgdgGJA80SQ3dIAsQNZTKQB0y2hoZhuHqjwoyLE4j4A1JrMujsUdHAAAAAASUVORK5CYII=',
			'7950' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdklEQVR4nGNYhQEaGAYTpIn7QkMZQ1hDHVpRRFtZW1kbGKY6oIiJNLo2MAQEIItNAYpNZXQQQXZf1NKlqZmZWdOQ3MfowBjo0BAIUweGQPMb0cVEGliAdgSg2BHQwNrK6OiA4paABsYQhlAGVDcPUPhREWJxHwDn1MwPYn/ykAAAAABJRU5ErkJggg==',
			'743A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7QkMZWhmBGEW0lWEqa6PDVAdUsVCGhoCAAGSxKYyuDI2ODiLI7otaunTV1JVZ05Dcx+gg0oqkDgxZG0RDHRoCQ0OQxERAtjQEoqgD2tfKiqYXJMYYyogiNlDhR0WIxX0AqzPLwUeExIMAAAAASUVORK5CYII=',
			'E5C3' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7QkNEQxlCHUIdkMQCGkQaGB0CHQLQxFgbBIAkilgIK5hGuC80aurSpatWLc1Cch9QvtEVoQ5FDM08oBi6Hayt6G4JDWEMQXfzQIUfFSEW9wEAiZDOG1eDIX8AAAAASUVORK5CYII=',
			'08BF' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWklEQVR4nGNYhQEaGAYTpIn7GB0YQ1hDGUNDkMRYA1hbWRsdHZDViUwRaXRtCEQRC2hFUQd2UtTSlWFLQ1eGZiG5D00dVAzTPGx2YHML1M0oYgMVflSEWNwHAHsyyfQLtOr6AAAAAElFTkSuQmCC',
			'65E5' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7WANEQ1lDHUMDkMREpog0sDYwOiCrC2jBItYgEgIUc3VAcl9k1NSlS0NXRkUhuS9kCkOjK8hcZL2t2MREgGKMDshiIlNYW1kbGAKQ3ccawBjCGuow1WEQhB8VIRb3AQDsl8tmu6j82QAAAABJRU5ErkJggg==',
			'1BE9' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpIn7GB1EQ1hDHaY6IImxOoi0sjYwBAQgiYk6iDS6AlWLoOgFqYOLgZ20Mmtq2NLQVVFhSO6DqGOYiqYXaB5DAxYxLHaguSUE080DFX5UhFjcBwDbx8jXtfRLTAAAAABJRU5ErkJggg==',
			'1D03' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAX0lEQVR4nGNYhQEaGAYTpIn7GB1EQximMIQ6IImxOoi0MoQyOgQgiYk6iDQ6Ojo0iKDoFWl0bQhoCEBy38qsaStTV0UtzUJyH5o6FDF087DYgemWEEw3D1T4URFicR8AWALKyM7N+4MAAAAASUVORK5CYII=',
			'B049' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7QgMYAhgaHaY6IIkFTGEMYWh1CAhAFmtlbWWY6ugggqJOpNEhEC4GdlJo1LSVmZlZUWFI7gOpcwXagaK3FSgWGtAggm5HowOaHUC3NKK6BZubByr8qAixuA8AhYHOH3BFu6sAAAAASUVORK5CYII='        
        );
        $this->text = array_rand( $images );
        return $images[ $this->text ] ;    
    }
    
    function out_processing_gif(){
        $image = dirname(__FILE__) . '/processing.gif';
        $base64_image = "R0lGODlhFAAUALMIAPh2AP+TMsZiALlcAKNOAOp4ANVqAP+PFv///wAAAAAAAAAAAAAAAAAAAAAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFCgAIACwAAAAAFAAUAAAEUxDJSau9iBDMtebTMEjehgTBJYqkiaLWOlZvGs8WDO6UIPCHw8TnAwWDEuKPcxQml0Ynj2cwYACAS7VqwWItWyuiUJB4s2AxmWxGg9bl6YQtl0cAACH5BAUKAAgALAEAAQASABIAAAROEMkpx6A4W5upENUmEQT2feFIltMJYivbvhnZ3Z1h4FMQIDodz+cL7nDEn5CH8DGZhcLtcMBEoxkqlXKVIgAAibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkphaA4W5upMdUmDQP2feFIltMJYivbvhnZ3V1R4BNBIDodz+cL7nDEn5CH8DGZAMAtEMBEoxkqlXKVIg4HibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpjaE4W5tpKdUmCQL2feFIltMJYivbvhnZ3R0A4NMwIDodz+cL7nDEn5CH8DGZh8ONQMBEoxkqlXKVIgIBibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpS6E4W5spANUmGQb2feFIltMJYivbvhnZ3d1x4JMgIDodz+cL7nDEn5CH8DGZgcBtMMBEoxkqlXKVIggEibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpAaA4W5vpOdUmFQX2feFIltMJYivbvhnZ3V0Q4JNhIDodz+cL7nDEn5CH8DGZBMJNIMBEoxkqlXKVIgYDibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpz6E4W5tpCNUmAQD2feFIltMJYivbvhnZ3R1B4FNRIDodz+cL7nDEn5CH8DGZg8HNYMBEoxkqlXKVIgQCibbK9YLBYvLtHH5K0J0IACH5BAkKAAgALAEAAQASABIAAAROEMkpQ6A4W5spIdUmHQf2feFIltMJYivbvhnZ3d0w4BMAIDodz+cL7nDEn5CH8DGZAsGtUMBEoxkqlXKVIgwGibbK9YLBYvLtHH5K0J0IADs=";
        $binary = is_file($image) ? join("",file($image)) : base64_decode($base64_image); 
        header("Cache-Control: post-check=0, pre-check=0, max-age=0, no-store, no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: image/gif");
        echo $binary;
    }

}
# end of class phpfmgImage
# ------------------------------------------------------
# end of module : captcha


# module user
# ------------------------------------------------------
function phpfmg_user_isLogin(){
    return ( isset($_SESSION['authenticated']) && true === $_SESSION['authenticated'] );
}


function phpfmg_user_logout(){
    session_destroy();
    header("Location: admin.php");
}

function phpfmg_user_login()
{
    if( phpfmg_user_isLogin() ){
        return true ;
    };
    
    $sErr = "" ;
    if( 'Y' == $_POST['formmail_submit'] ){
        if(
            defined( 'PHPFMG_USER' ) && strtolower(PHPFMG_USER) == strtolower($_POST['Username']) &&
            defined( 'PHPFMG_PW' )   && strtolower(PHPFMG_PW) == strtolower($_POST['Password']) 
        ){
             $_SESSION['authenticated'] = true ;
             return true ;
             
        }else{
            $sErr = 'Login failed. Please try again.';
        }
    };
    
    // show login form 
    phpfmg_admin_header();
?>
<form name="frmFormMail" action="" method='post' enctype='multipart/form-data'>
<input type='hidden' name='formmail_submit' value='Y'>
<br><br><br>

<center>
<div style="width:380px;height:260px;">
<fieldset style="padding:18px;" >
<table cellspacing='3' cellpadding='3' border='0' >
	<tr>
		<td class="form_field" valign='top' align='right'>Email :</td>
		<td class="form_text">
            <input type="text" name="Username"  value="<?php echo $_POST['Username']; ?>" class='text_box' >
		</td>
	</tr>

	<tr>
		<td class="form_field" valign='top' align='right'>Password :</td>
		<td class="form_text">
            <input type="password" name="Password"  value="" class='text_box'>
		</td>
	</tr>

	<tr><td colspan=3 align='center'>
        <input type='submit' value='Login'><br><br>
        <?php if( $sErr ) echo "<span style='color:red;font-weight:bold;'>{$sErr}</span><br><br>\n"; ?>
        <a href="admin.php?mod=mail&func=request_password">I forgot my password</a>   
    </td></tr>
</table>
</fieldset>
</div>
<script type="text/javascript">
    document.frmFormMail.Username.focus();
</script>
</form>
<?php
    phpfmg_admin_footer();
}


function phpfmg_mail_request_password(){
    $sErr = '';
    if( $_POST['formmail_submit'] == 'Y' ){
        if( strtoupper(trim($_POST['Username'])) == strtoupper(trim(PHPFMG_USER)) ){
            phpfmg_mail_password();
            exit;
        }else{
            $sErr = "Failed to verify your email.";
        };
    };
    
    $n1 = strpos(PHPFMG_USER,'@');
    $n2 = strrpos(PHPFMG_USER,'.');
    $email = substr(PHPFMG_USER,0,1) . str_repeat('*',$n1-1) . 
            '@' . substr(PHPFMG_USER,$n1+1,1) . str_repeat('*',$n2-$n1-2) . 
            '.' . substr(PHPFMG_USER,$n2+1,1) . str_repeat('*',strlen(PHPFMG_USER)-$n2-2) ;


    phpfmg_admin_header("Request Password of Email Form Admin Panel");
?>
<form name="frmRequestPassword" action="admin.php?mod=mail&func=request_password" method='post' enctype='multipart/form-data'>
<input type='hidden' name='formmail_submit' value='Y'>
<br><br><br>

<center>
<div style="width:580px;height:260px;text-align:left;">
<fieldset style="padding:18px;" >
<legend>Request Password</legend>
Enter Email Address <b><?php echo strtoupper($email) ;?></b>:<br />
<input type="text" name="Username"  value="<?php echo $_POST['Username']; ?>" style="width:380px;">
<input type='submit' value='Verify'><br>
The password will be sent to this email address. 
<?php if( $sErr ) echo "<br /><br /><span style='color:red;font-weight:bold;'>{$sErr}</span><br><br>\n"; ?>
</fieldset>
</div>
<script type="text/javascript">
    document.frmRequestPassword.Username.focus();
</script>
</form>
<?php
    phpfmg_admin_footer();    
}


function phpfmg_mail_password(){
    phpfmg_admin_header();
    if( defined( 'PHPFMG_USER' ) && defined( 'PHPFMG_PW' ) ){
        $body = "Here is the password for your form admin panel:\n\nUsername: " . PHPFMG_USER . "\nPassword: " . PHPFMG_PW . "\n\n" ;
        if( 'html' == PHPFMG_MAIL_TYPE )
            $body = nl2br($body);
        mailAttachments( PHPFMG_USER, "Password for Your Form Admin Panel", $body, PHPFMG_USER, 'You', "You <" . PHPFMG_USER . ">" );
        echo "<center>Your password has been sent.<br><br><a href='admin.php'>Click here to login again</a></center>";
    };   
    phpfmg_admin_footer();
}


function phpfmg_writable_check(){
 
    if( is_writable( dirname(PHPFMG_SAVE_FILE) ) && is_writable( dirname(PHPFMG_EMAILS_LOGFILE) )  ){
        return ;
    };
?>
<style type="text/css">
    .fmg_warning{
        background-color: #F4F6E5;
        border: 1px dashed #ff0000;
        padding: 16px;
        color : black;
        margin: 10px;
        line-height: 180%;
        width:80%;
    }
    
    .fmg_warning_title{
        font-weight: bold;
    }

</style>
<br><br>
<div class="fmg_warning">
    <div class="fmg_warning_title">Your form data or email traffic log is NOT saving.</div>
    The form data (<?php echo PHPFMG_SAVE_FILE ?>) and email traffic log (<?php echo PHPFMG_EMAILS_LOGFILE?>) will be created aumotically when the form is submitted. 
    However, the script doesn't have writable permission to create those files. In order to save your valuable information, please set the directory to writable.
     If you don't know how to do it, please ask for help from your web Administrator or Technical Support of your hosting company.   
</div>
<br><br>
<?php
}


function phpfmg_log_view(){
    $n = isset($_REQUEST['file'])  ? $_REQUEST['file']  : '';
    $files = array(
        1 => PHPFMG_EMAILS_LOGFILE,
        2 => PHPFMG_SAVE_FILE,
    );
    
    phpfmg_admin_header();
   
    $file = $files[$n];
    if( is_file($file) ){
        if( 1== $n ){
            echo "<pre>\n";
            echo join("",file($file) );
            echo "</pre>\n";
        }else{
            $man = new phpfmgDataManager();
            $man->displayRecords();
        };
     

    }else{
        echo "<b>No form data found.</b>";
    };
    phpfmg_admin_footer();
}


function phpfmg_log_download(){
    $n = isset($_REQUEST['file'])  ? $_REQUEST['file']  : '';
    $files = array(
        1 => PHPFMG_EMAILS_LOGFILE,
        2 => PHPFMG_SAVE_FILE,
    );

    $file = $files[$n];
    if( is_file($file) ){
        phpfmg_util_download( $file, PHPFMG_SAVE_FILE == $file ? 'form-data.csv' : 'email-traffics.txt', true, 1 ); // skip the first line
    }else{
        phpfmg_admin_header();
        echo "<b>No email traffic log found.</b>";
        phpfmg_admin_footer();
    };

}


function phpfmg_log_delete(){
    $n = isset($_REQUEST['file'])  ? $_REQUEST['file']  : '';
    $files = array(
        1 => PHPFMG_EMAILS_LOGFILE,
        2 => PHPFMG_SAVE_FILE,
    );
    phpfmg_admin_header();

    $file = $files[$n];
    if( is_file($file) ){
        echo unlink($file) ? "It has been deleted!" : "Failed to delete!" ;
    };
    phpfmg_admin_footer();
}


function phpfmg_util_download($file, $filename='', $toCSV = false, $skipN = 0 ){
    if (!is_file($file)) return false ;

    set_time_limit(0);


    $buffer = "";
    $i = 0 ;
    $fp = @fopen($file, 'rb');
    while( !feof($fp)) { 
        $i ++ ;
        $line = fgets($fp);
        if($i > $skipN){ // skip lines
            if( $toCSV ){ 
              $line = str_replace( chr(0x09), ',', $line );
              $buffer .= phpfmg_data2record( $line, false );
            }else{
                $buffer .= $line;
            };
        }; 
    }; 
    fclose ($fp);
  

    
    /*
        If the Content-Length is NOT THE SAME SIZE as the real conent output, Windows+IIS might be hung!!
    */
    $len = strlen($buffer);
    $filename = basename( '' == $filename ? $file : $filename );
    $file_extension = strtolower(substr(strrchr($filename,"."),1));

    switch( $file_extension ) {
        case "pdf": $ctype="application/pdf"; break;
        case "exe": $ctype="application/octet-stream"; break;
        case "zip": $ctype="application/zip"; break;
        case "doc": $ctype="application/msword"; break;
        case "xls": $ctype="application/vnd.ms-excel"; break;
        case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
        case "gif": $ctype="image/gif"; break;
        case "png": $ctype="image/png"; break;
        case "jpeg":
        case "jpg": $ctype="image/jpg"; break;
        case "mp3": $ctype="audio/mpeg"; break;
        case "wav": $ctype="audio/x-wav"; break;
        case "mpeg":
        case "mpg":
        case "mpe": $ctype="video/mpeg"; break;
        case "mov": $ctype="video/quicktime"; break;
        case "avi": $ctype="video/x-msvideo"; break;
        //The following are for extensions that shouldn't be downloaded (sensitive stuff, like php files)
        case "php":
        case "htm":
        case "html": 
                $ctype="text/plain"; break;
        default: 
            $ctype="application/x-download";
    }
                                            

    //Begin writing headers
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: public"); 
    header("Content-Description: File Transfer");
    //Use the switch-generated Content-Type
    header("Content-Type: $ctype");
    //Force the download
    header("Content-Disposition: attachment; filename=".$filename.";" );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$len);
    
    while (@ob_end_clean()); // no output buffering !
    flush();
    echo $buffer ;
    
    return true;
 
    
}
?>