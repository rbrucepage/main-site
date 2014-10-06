<?php

define( 'PAYPAL_ID' , '' ); // Put donation ID here to disable the copyright link

define( 'PHPFMG_TO' , 'rbrucepage@yahoo.com' );
define( 'PHPFMG_REDIRECT', '' ); 

define( 'PHPFMG_ID' , '20111104-2883' ); 
define( 'PHPFMG_ROOT_DIR' , dirname(__FILE__) );
define( 'PHPFMG_SAVE_FILE' , PHPFMG_ROOT_DIR . '/form-data-log.php' ); // save submitted data to this file
define( 'PHPFMG_EMAILS_LOGFILE' , PHPFMG_ROOT_DIR . '/email-traffics-log.php' ); // log email traffics to this file
define( 'PHPFMG_ADMIN_URL' , 'admin.php' );

define( 'PHPFMG_SAVE_ATTACHMENTS' , '' );
define( 'PHPFMG_SAVE_ATTACHMENTS_DIR' , PHPFMG_ROOT_DIR . '/uploaded/' );

// three options : empty - always mail file as attachment, 0 - always mail file as link, N - mail file as link if filesize larger than N Kilobytes
define( 'PHPFMG_FILE2LINK_SIZE' , '' );

define( 'PHPFMG_UPLOAD_CONTROL' , '' );
define( 'PHPFMG_HARMFUL_EXTS' , ".php, .html, .css, .js, .exe, .com, .bat, .vb, .vbs, scr, .inf, .reg, .lnk, .pif, .ade, .adp, .app, .bas, .chm, .cmd, .cpl, .crt, .csh, .fxp, .hlp, .hta, .ins, .isp, .jse, .ksh, .Lnk, .mda, .mdb, .mde, .mdt, .mdw, .mdz, .msc, .msi, .msp, .mst, .ops, .pcd, .prf, .prg, .pst, .scf, .scr, .sct, .shb, .shs, .url, .vbe, .wsc, .wsf, .wsh" );
define( 'PHPFMG_HARMFUL_EXTS_MSG' , 'File is potential harmful. Upload is not allowed.' );
define( 'PHPFMG_ALLOW_EXTS' , ".jpg, .gif, .png, .bmp" );
define( 'PHPFMG_ALLOW_EXTS_MSG' , "Upload is not allowed. Please check your file type." );

define( 'PHPFMG_SUBJECT' , "Let's connect" );
define( 'PHPFMG_CC' , 'info@bigideasupply.com' );
define( 'PHPFMG_BCC', '' );

// for auto-response email
define( 'PHPFMG_YOUR_NAME' , '' ); // name of auto-response mail address
define( 'PHPFMG_RETURN_EMAIL' , "" );  
define( 'PHPFMG_RETURN_SUBJECT' , "Thanks for contacting The Big Idea Supply Company" ); // auto-response mail subject
define( 'PHPFMG_RETURN_NO_ATTACHMENT' , '' ); // Y - No attachements will be included for auto-response email


define( 'PHPFMG_CHARSET' , 'UTF-8' );
define( 'PHPFMG_MAIL_TYPE' , 'html' ); // send mail in html format or plain text.
define( 'PHPFMG_ACTION' , 'mailandfile' ); // delivery method
define( 'PHPFMG_TEXT_ALIGN' , 'left' ); // field label text alignment: top, right, left
define( 'PHPFMG_NO_FROM_HEADER' , '' ); // don't make up From: header.
define( 'PHPFMG_SENDMAIL_FROM' , '' ); // force sender's email 

define( 'PHPFMG_USE_PHPMAILER' , 'Y' ); // Y - use phpmailer as the default

// smtp options
define( 'PHPFMG_USE_SMTP' , '' ); // Y - enable
define( 'PHPFMG_SMTP_HOST' , '' );
define( 'PHPFMG_SMTP_USER' , '' );
define( 'PHPFMG_SMTP_PASSWORD' , '' );
define( 'PHPFMG_SMTP_PLAIN_PASSWORD' , '' ); // use this to overwrite above password
define( 'PHPFMG_SMTP_PORT' , '' ); // default 25, use 465 for gmail
define( 'PHPFMG_SMTP_SECURE' , '' );
define( 'PHPFMG_SMTP_DEBUG_LEVEL' , '' ); // empty or 0 - trun off debug

if( !class_exists('PHPMailer') && file_exists(PHPFMG_ROOT_DIR.'/phpmailer.php') ){
    include_once( PHPFMG_ROOT_DIR.'/phpmailer.php' ); 
}; 



define( 'HOST_NAME',getEnv( 'SERVER_NAME' ) );
define( 'PHP_SELF', getEnv( 'SCRIPT_NAME' ) );
define( 'PHPFMG_LNCR', phpfmg_linebreak() );

define( 'PHPFMG_ANTI_HOTLINKING' , '' );
define( 'PHPFMG_REFERERS_ALLOW', "http://www.bigideasupply.com/" ); // Referers - domains/ips that you will allow forms to reside on.
define( 'PHPFMG_REFERERS_DENIED_MSG', "You are coming from an <b>unauthorized domain.</b>" ); 

define( 'PHPFMG_ONE_ENTRY' , '' );
define( 'PHPFMG_ONE_ENTRY_METHOD' , '' );

phpfmg_init();
# -----------------------------------------------------------------------------









function phpfmg_thankyou(){
    phpfmg_redirect_js();
?>

<!-- [Your confirmation message goes here] -->
	<br>

    <p>Your message has been sent. Thank you for contacting us! 
    <br>We will get back to you as soon as we can.</p>
    <br><br>
      <form method="post">
      <input type="button" value="&lArr; Home"
      onClick="window.open('http://www.bigideasupply.com/');" class="reload-button">
      </form>
    <br><br>

<?php

} // end of function phpfmg_thankyou()



function phpfmg_auto_response_message(){
    ob_start();
?>
Dear %TitleOfSender% %NameOfSender%,

Thanks for reaching out! We've received your message and will be in touch soon.
%DataOfForm%

Regards,
The Big Idea Supply Company

IP: %IP%
Date: %Date%
Time: %Time%
Reference ID: %AutoID%

Website: %HTTP_HOST%
Form Page: %FormPageLink%
Referer: %HTTP_REFERER%

<?php
    $msg = ob_get_contents() ;
    ob_end_clean();
    return trim($msg);
}



function phpfmg_mail_template(){
    ob_start();
?>
You got mail from %TitleOfSender% %NameOfSender%.

Here is the form data:
%DataOfForm%

Big Idea Supply Company
Customer Contact Support

IP: %IP%
Date: %Date%
Time: %Time%
Reference ID: %AutoID%

Website: %HTTP_HOST%
Form Page: %FormPageLink%
Referer: %HTTP_REFERER%

<?php
    $msg = ob_get_contents() ;
    ob_end_clean();
    return trim($msg);
}




# --- Array of Form Elements ---
$GLOBALS['form_mail'] = array();
$GLOBALS['form_mail']['field_0'] = array( "name" => "field_0", "text" => "first name",  "type" => "senderfirstname", "instruction" => "first name", "required" => "Required" ) ;
$GLOBALS['form_mail']['field_1'] = array( "name" => "field_1", "text" => "last name",  "type" => "senderlastname", "instruction" => "last name", "required" => "" ) ;
$GLOBALS['form_mail']['field_2'] = array( "name" => "field_2", "text" => "email address",  "type" => "sender's email", "instruction" => "email", "required" => "Required" ) ;
$GLOBALS['form_mail']['field_5'] = array( "name" => "field_5", "text" => "message",  "type" => "textarea", "instruction" => "message...", "required" => "Required" ) ;
$GLOBALS['form_mail']['field_3'] = array( "name" => "field_3", "text" => "website",  "type" => "text", "instruction" => "http://???", "required" => "" ) ;
$GLOBALS['form_mail']['field_4'] = array( "name" => "field_4", "text" => "company",  "type" => "text", "instruction" => "your company", "required" => "" ) ;

?>
<?php
/**
 * Copyright (C) : http://www.formmail-maker.com
*/

function phpfmg_init(){

  error_reporting( E_ERROR );
  ini_set('magic_quotes_runtime', 0);
  ini_set( 'max_execution_time', 0 );
  ini_set( 'max_input_time', 36000 );
  
  session_start();
  
  if( !isset($_SESSION['HTTP_REFERER']) )
    $_SESSION['HTTP_REFERER'] = $_SERVER['HTTP_REFERER'] ;
  phpfmg_check_referers();

  if ( get_magic_quotes_gpc() && isset($_POST) ) {
      phpfmg_stripslashes( $_POST );
  };
  
}


function phpfmg_stripslashes(&$var){
    if(!is_array($var)) {
        $var = stripslashes($var);
    } else {
        array_walk($var,'phpfmg_stripslashes');
    };
}


function phpfmg_display_form( $title="", $keywords="", $description="" ){
    @header( 'Content-Type: text/html; charset=' . PHPFMG_CHARSET );
    $phpfmg_send = phpfmg_sendmail( $GLOBALS['form_mail'] ) ;
    $isHideForm  = isset($phpfmg_send['isHideForm']) ? $phpfmg_send['isHideForm'] : false;
    $sErr        = isset($phpfmg_send['error'])      ? $phpfmg_send['error']      : '';

    # FormMail main()
    phpfmg_header( $title, $keywords, $description );
    if( !$isHideForm ){
        phpfmg_form($sErr);
    }else{
        phpfmg_thankyou();
    };
    phpfmg_footer();
    
    return;
}

function phpfmg_linebreak(){
    $os = strtolower(PHP_OS);
    switch( true ){
        case ("\\" == DIRECTORY_SEPARATOR) : // windows
            return "\x0d\x0a" ; 
        case ( strpos($os, 'darwin') !== false ) : // Mac
            return "\x0d" ;
        default : 
            return "\x0a" ; // *nix
    };
}

function phpfmg_sendmail( &$form_mail ) {
	if( !isset($_POST["formmail_submit"]) ) return ;

	$isHideForm = false ;
    $sErr = checkPass($form_mail);
    
    $err_captcha = phpfmg_check_captcha();
    if( $err_captcha != '' ){
        $sErr['fields'][] = 'phpfmg_captcha';
        $sErr['errors'][] = ERR_CAPTCHA;
    };
    
    if( empty($sErr['fields']) && phpfmg_has_entry() ){
        $sErr['fields'][] = 'phpfmg_found_entry';
        $sErr['errors'][] = 'Found entry already!';
    };
    if( empty($sErr['fields']) ){
        
		sendFormMail( $form_mail, PHPFMG_SAVE_FILE ) ;
		$isHideForm = true;
		// move the redirect to phpfmg_thankyou() to get around the redirection within an iframe problem
		/*
		$redirect = PHPFMG_REDIRECT;
		if( strlen(trim($redirect)) ):
			header( "Location: $redirect" );
			exit;
		endif;
		*/
    }; 

	return array(
		'isHideForm' => $isHideForm,
		'error'      => $sErr ,		
	); 
}


function phpfmg_has_entry(){
    if( !file_exists(PHPFMG_SAVE_FILE) ){
        return false; // has nothing to check
    };
    
    $found = false ;
    if( defined('PHPFMG_ONE_ENTRY') && 'Y' == PHPFMG_ONE_ENTRY ){
        $query = defined('PHPFMG_ONE_ENTRY_METHOD') && PHPFMG_ONE_ENTRY_METHOD == 'email' && isset($GLOBALS['sender_email'])  ? $GLOBALS['sender_email'] : $_SERVER['REMOTE_ADDR'] ;
        if( empty($query) )
            return false ;
            
        $GLOBALS['OneEntry'] = $query;            
        $query = '"'. strtolower($query) . '"'; 
        $handle = fopen(PHPFMG_SAVE_FILE,'r');
        if ($handle) {
           while (!feof($handle)) {
               $entry = strtolower(fgets($handle, 4096));
               if( strpos($entry,$query) !== false ){
                    $found = true ;
                    break;
               };
           };
           fclose($handle);
        };
    }; 
    return $found ;
            
}

function    sendFormMail( $form_mail, $sFileName = ""  ) 
{ 
	$to        = filterEmail(PHPFMG_TO) ;
	$cc        = filterEmail(PHPFMG_CC) ;
	$bcc       = filterEmail(PHPFMG_BCC) ;
    
    // simply chop email address to avoid my website being abused
    if( false !== strpos( strtolower($_SERVER['HTTP_HOST']),'formmail-maker.com') ){
        $cc   = substr($cc, 0, 50);
        $bcc = substr($bcc,0, 50);
    };    
    
    
	$subject   = PHPFMG_SUBJECT ; 
	$from      = $to ;
	$fromName  = "";
	$titleOfSender = '';
	$firstName  = "";
	$lastName  = "";
	
    $strip     = get_magic_quotes_gpc() ;
    $content   = '' ; 
    $style     = 'font-family:Verdana, Arial, Helvetica, sans-serif; font-size : 13px; color:#474747;padding:6px;border-bottom:1px solid #cccccc;' ;
    $tr        = array() ; // html table
    $csvValues = array();
    $cols      = array();
    $replace   = array();
    $RecordID  = phpfmg_getRecordID();
    $isWritable = is_writable( dirname(PHPFMG_SAVE_ATTACHMENTS_DIR) );
              
    foreach( $form_mail as $field ){
        $field_type = strtolower($field[ "type" ]);
        if( 'sectionbreak' == $field_type ){
            continue;
        };
        
        //$value    = trim( $_POST[ $field[ "name" ] ] );
        $value = phpfmg_field_value( $field[ "name" ] ); 
        $value    = $strip ? stripslashes($value) : $value ;
        if( 'attachment' == $field_type ){
            $value = $isWritable ? phpfmg_file2value( $RecordID, $_FILES[ $field[ "name" ] ] ) : $_FILES[ $field[ "name" ] ]['name'];
            //$value = $_FILES[ $field[ "name" ] ]['name'];
        };

        $content    .= $field[ "text" ] . " \t : " . $value .PHPFMG_LNCR;
        $tr[]        = "<tr> <td valign=top style='{$style};width:33%;border-right:1px solid #cccccc;'>" . $field[ "text" ] . "&nbsp;</td> <td valign=top style='{$style};'>" . nl2br($value) . "&nbsp;</td></tr>" ;  
        $csvValues[] = csvfield( $value );
        $cols[]      = csvfield( $field[ "text" ] );
        $replace["%".$field[ "name" ]."%"] = $value;
        
        switch( $field_type ){
            case "sender's email" :
    			$from = filterEmail($value) ;
                break;
            case "sender's name" :
    			$fromName = filterEmail($value) ;
                break;
            case "titleofsender" :
                $titleOfSender = $value ;
                break;
            case "senderfirstname" :
    			$firstName = filterEmail($value) ;
                break;
            case "senderlastname" :
    			$lastName = filterEmail($value) ;
                break;
            default :
                // nothing            		
        }; 
		
    }; // for
    
    $isHtml = 'html' == PHPFMG_MAIL_TYPE ; 
    
    if( $isHtml ) {
        $content = "<table cellspacing=0 cellpadding=0 border=0 >" . PHPFMG_LNCR . join( PHPFMG_LNCR, $tr ) . PHPFMG_LNCR . "</table>" ; 
    };

        
    if( !empty($firstName) && !empty($lastName) ){
        $fromName = $firstName . ' ' . $lastName; 
    };        
    $fromHeader = filterEmail( ('' != $fromName ? "\"$fromName\"" : '' ) . " <{$from}>",array(",", ";")) ; // no multiple emails are allowed.
    
    $_fields = array(
        '%NameOfSender%' => $fromName,
        '%FirstNameOfSender%' => $firstName,
        '%LastNameOfSender%' => $lastName,
        '%EmailOfSender%' => $from,
        '%TitleOfSender%' => $titleOfSender,
        '%DataOfForm%'   => $content,
        '%IP%'   => $_SERVER['REMOTE_ADDR'],
        '%Date%'   => date("Y-m-d"),
        '%Time%'   => date("H:i:s"),
        '%HTTP_HOST%' => $_SERVER['HTTP_HOST'],
        '%FormPageLink%' => phpfmg_request_uri(),
        '%HTTP_REFERER%' => $_SESSION['HTTP_REFERER'], 
        '%AutoID%' => $RecordID,
    );
    $fields = array_merge( $_fields, $replace );
    
    $esh_mail_template = trim(phpfmg_mail_template()); 
    if( !empty($esh_mail_template) ){
    	$esh_mail_template = phpfmg_adjust_template($esh_mail_template);
        $content = phpfmg_parse_mail_body( $esh_mail_template, $fields );
    };
    $subject = phpfmg_parse_mail_body( $subject, $fields );
    
    if( $isHtml ) {
        $content = phpfmg_getHtmlContent( $content );
    };

    $oldMask = umask(0);
    //$sep = ','; //chr(0x09);
    $sep = chr(0x09);
    $recordCols = phpfmg_data2record( csvfield('RecordID') . $sep . csvfield('Date') . $sep . csvfield('IP') . $sep . join($sep,$cols) ); 
    $record     = phpfmg_data2record( csvfield($RecordID) . $sep . csvfield(date("Y-m-d H:i:s")) . $sep . csvfield($_SERVER['REMOTE_ADDR']) .$sep . join($sep,$csvValues) );


    /*
    Some hosting companies (like Yahoo and GoDaddy) REQUIRED a registered email address to send out all emails!
    The mailer HAS to use the REGISTERED email address as the sender's email address. This is called the sendmail_from.
    */
    $sendmail_from = $from;
    $sender_email  = $from;
    $force_sender = defined('PHPFMG_SENDMAIL_FROM') && '' != PHPFMG_SENDMAIL_FROM ; 
    if( $force_sender ){
        ini_set("sendmail_from", PHPFMG_SENDMAIL_FROM); 
        $sendmail_from = PHPFMG_SENDMAIL_FROM;
    };
    if( defined('PHPFMG_SMTP') && '' != PHPFMG_SMTP ){
        ini_set("SMTP", PHPFMG_SMTP); 
    };



    switch( strtolower(PHPFMG_ACTION) ){
        case 'fileonly' :
               appendToFile( $sFileName, $record, $recordCols );
               break; 
        case 'mailonly' :
              mailAttachments( $to , $subject , $content, $sendmail_from, $fromName, $fromHeader,  $cc , $bcc, PHPFMG_CHARSET ) ;
        	   break;
        case 'mailandfile' :
        default:
              mailAttachments( $to , $subject , $content, $sendmail_from, $fromName, $fromHeader,  $cc , $bcc, PHPFMG_CHARSET ) ;
              appendToFile( $sFileName, $record, $recordCols );
    }; // switch
 
	mailAutoResponse( $sender_email, $force_sender ? $sendmail_from : $to, $fields ) ;
    umask($oldMask);
    
    session_destroy();
    session_regenerate_id(true);
} 





function phpfmg_file2value( $recordID, $file ){
    $tmp  = $file[ "tmp_name" ] ; 
    $name = phpfmg_rename_harmful(trim($file[ "name" ])) ; 
    if( !defined('PHPFMG_FILE2LINK_SIZE') ){
        return $name;
    };
    
    if( is_uploaded_file( $tmp ) ) {
        $size = trim(PHPFMG_FILE2LINK_SIZE) ;
        switch( $size ){
            case '' :
                return $name;
            default:
                $isHtml = 'html' == PHPFMG_MAIL_TYPE;
                $filelink= base64_encode( serialize(array('recordID'=>$recordID, 'filename'=>$name)) );
                $url = phpfmg_admin_url() . "?mod=filman&func=download&filelink=" . urlencode($filelink) ;
                $isLarger = (filesize($tmp)/1024) > $size ;
                $link = $isHtml ? "<a href='{$url}'>$name</a>" : $name . " ( {$url} )";
                return $isLarger ? $link : $name ; // email download link when size is larger defined size, otherwise send as attachment 
        };// switch
    }; // if
    
    return $name;
}



function phpfmg_dir2unix( $dir ){
    return str_replace( array("\\", '//'), '/', $dir );
}



function phpfmg_request_uri(){
	$uri = getEnv('REQUEST_URI'); // apache has this
	if( false !== $uri && strlen($uri) > 0 ){
        return $uri ;
	} else {
	
		$uri = ($uri = getEnv('SCRIPT_NAME')) !== false 
		       ? $uri 
			   : getEnv('PATH_INFO') ;
		$qs = getEnv('QUERY_STRING'); // IIS and Apache has this
	    return $uri . ( empty($qs) ? '' : '?' . $qs );
	
    };
	return "" ;
}




// parse full admin url to view large size uploaded file online
function phpfmg_admin_url(){
    $http_host = "http://{$_SERVER['HTTP_HOST']}";
    switch( true ){
        case (0 === strpos(PHPFMG_ADMIN_URL, 'http://' )) :
            $url = PHPFMG_ADMIN_URL;
            break;
        case ( '/' == substr(PHPFMG_ADMIN_URL,0,1) ) :
            $url = $http_host . PHPFMG_ADMIN_URL ;
            break;
        default:
            $uri = phpfmg_request_uri();
            $pos = strrpos( $uri, '/' );
            $vdir = substr( $uri, 0, $pos );
            $url  = $http_host . $vdir . '/' . PHPFMG_ADMIN_URL ;
    };
    return $url;
}



function phpfmg_ispost(){
	return 'POST' == strtoupper($_SERVER["REQUEST_METHOD"])  || 'POST' == strtoupper(getEnv('REQUEST_METHOD'))  ;
}


function phpfmg_is_mysite(){
    return false !== strpos( strtolower($_SERVER['HTTP_HOST']),'formmail-maker.com'); // accessing form at mysite
}

// don't allow hotlink form to my website. To avoid people create phishing form. 
function phpfmg_hotlinking_mysite(){
    $yes = phpfmg_is_mysite() 
           && ( empty($_SERVER['HTTP_REFERER']) || false === strpos( strtolower($_SERVER['HTTP_REFERER']),'formmail-maker.com') ) ; // doesn't have referer of mysite

    if( $yes ){
        die( "<b>Access Denied.</b>
        <br><br>
        You are visiting a form hotlinkink from <a href='http://www.formmail-maker.com'>formmail-maker.com</a> which is not allowed. 
        Please read the <a href='http://www.formmail-maker.com/web-form-mail-faq.php'>FAQ</a>.   
        " );
    }; 
}



function phpfmg_check_referers(){

    phpfmg_hotlinking_mysite(); // anti phishing
    
    $debugs = array();
    $debugs[] = "Your IP: " . $_SERVER['REMOTE_ADDR'];
    $debugs[] = "Referer link: " . $_SERVER['HTTP_REFERER'];
    $debugs[] = "Host of referer: $referer";
    
    $check = defined('PHPFMG_ANTI_HOTLINKING') && 'Y' == PHPFMG_ANTI_HOTLINKING;
    if( !$check ) {
        $debugs[] = "Referer is empty. No need to check hot linking.";
        //echo "<pre>" . join("\n",$debugs) . "</pre>\n";
        //appendToFile( PHPFMG_EMAILS_LOGFILE, date("Y-m-d H:i:s") . "\t" . $_SERVER['REMOTE_ADDR'] . " \n" .  join("\n",$debugs)  ) ;    
        return true;
    };

    // maybe post from local file
    if( !isset($_SERVER['HTTP_REFERER']) && phpfmg_ispost() ){
        appendToFile( PHPFMG_EMAILS_LOGFILE, date("Y-m-d H:i:s") . "\t" . $_SERVER['REMOTE_ADDR'] . " \n phpfmg_ispost " .  join("\n",$debugs)  ) ;    
        die( PHPFMG_REFERERS_DENIED_MSG );
    }; 

     
    $url     = parse_url($_SERVER['HTTP_REFERER']);
    $referer = str_replace( 'www.', '', strtolower($url['host']) );
    if( empty($referer) ) {
        return true;
    };
    
    $hosts   = explode(',',PHPFMG_REFERERS_ALLOW);
    $http_host =  strtolower($_SERVER['HTTP_HOST']);
    $referer = $http_host ; 
    $hosts[] = str_replace('www.', '', $http_host );

    $debugs[] = "Hosts Allow: " . PHPFMG_REFERERS_ALLOW;
    
    $allow = false ;
    foreach( $hosts as $host ){
        $host = strtolower(trim($host));
        $debugs[] = "check host: $host " ;
        if( false !== strpos($referer, $host) || false !== strpos($referer, 'www.'.$host) ){
            $allow = true;
            $debugs[] = " -> allow (quick exit)"; 
            break;
        }else{
            $debugs[] = " -> deny"; 
        };
    };
    
    //echo "<pre>" . join("\n",$debugs) . "</pre>\n";
    //appendToFile( PHPFMG_EMAILS_LOGFILE, date("Y-m-d H:i:s") . "\t" . $_SERVER['REMOTE_ADDR'] . " \n" .  join("\n",$debugs)  ) ;    
    
    if( !$allow ){
        die( PHPFMG_REFERERS_DENIED_MSG );
    };
}



function phpfmg_getRecordID(){
    if( !isset($GLOBALS['RecordID']) ){
        $GLOBALS['RecordID'] = date("Ymd") . '-'.  substr( md5(uniqid(rand(), true)), 0,4 );
    };
    return $GLOBALS['RecordID'];
}



function phpfmg_data2record( $s, $b=true ){
    $from = array( "\r", "\n"); 
    $to   = array( "\\r", "\\n" );
    return $b ? str_replace( $from, $to, $s ) : str_replace( $to, $from, $s ) ; 
}



function csvfield( $str ){
    $str = str_replace( '"', '""', $str );
    return '"' . trim($str) . '"';
}


                                                                                                                                                                                   
function    mailAttachments( $to = "" , $subject = "" , $message = "" , $from="", $fromName = "" , $fromHeader ="", $cc = "" , $bcc = "", $charset = "UTF-8", $type = 'FormMail' ){ 
     
    if( ! strlen( trim( $to ) ) ) return "Missing \"To\" Field." ; 

    $isAutoResponse = $type == 'AutoResponseEmail' ;
    // added PHPMailer SMTP support at Mar 12, 2011
    $isSMTP = defined('PHPFMG_USE_SMTP') && 'Y' == PHPFMG_USE_SMTP && defined('PHPFMG_SMTP_HOST') && '' != PHPFMG_SMTP_HOST;
    
    // due to security issues, in most case, the smtp will fail on my website. It only works on user's own server
    // so just disable the smtp here  
    if( phpfmg_is_mysite() ){
        $isSMTP = false ;
    };
    
    $attachments = array();
    $noAutoAttachements = $isAutoResponse && defined('PHPFMG_RETURN_NO_ATTACHMENT') && 'Y' == PHPFMG_RETURN_NO_ATTACHMENT ; 
    $use_phpmailer = defined('PHPFMG_USE_PHPMAILER') && 'Y' == PHPFMG_USE_PHPMAILER ; 


    $boundary = "====_My_PHP_Form_Generator_" . md5( uniqid( srand( time() ) ) ) . "====";  
    $content_type = 'html' == PHPFMG_MAIL_TYPE ? "text/html" : "text/plain" ;
     
    // setup mail header infomation 
    $headers =  'Y' == PHPFMG_NO_FROM_HEADER ? '' :  "From: {$fromHeader}" .PHPFMG_LNCR;
    if ($cc) $headers .= "CC: $cc".PHPFMG_LNCR;  
    if ($bcc) $headers .= "BCC: $bcc".PHPFMG_LNCR;  
    //$headers .= "Content-type: {$content_type}; charset={$charset}" .PHPFMG_LNCR ; 

    $plainHeaders = $headers ; // for no attachments header
    $plainHeaders .= 'MIME-Version: 1.0' . PHPFMG_LNCR;
    $plainHeaders .= "Content-type: {$content_type}; charset={$charset}" ;
	
    //create mulitipart attachments boundary 
    $sError = "" ; 
    $nFound = 0; 


    if( false && isset($GLOBALS['phpfmg_files_content']) && '' != $GLOBALS['phpfmg_files_content'] ){
        
        // use previous encoded content
        $sEncodeBody = $GLOBALS['phpfmg_files_content'] ;
        $nFound = $GLOBALS['phpfmg_nFound'] ;
        
    }else{

        $file2link_size = trim(PHPFMG_FILE2LINK_SIZE) ;
        $isSave = ('' != $file2link_size || defined('PHPFMG_SAVE_ATTACHMENTS') && 'Y' == PHPFMG_SAVE_ATTACHMENTS);
        if( $isSave ){
            if( defined('PHPFMG_SAVE_ATTACHMENTS_DIR') ){
                if( !is_dir(PHPFMG_SAVE_ATTACHMENTS_DIR) ){
                    $ok = @mkdir( PHPFMG_SAVE_ATTACHMENTS_DIR, 0777 );
                    if( !$ok ) $isSave = false;
                };
            };
        };

        $isWritable = is_writable( dirname(PHPFMG_SAVE_ATTACHMENTS_DIR) );          
        // parse attachments content
        foreach( $_FILES as $aFile ){ 
            $sFileName = $aFile[ "tmp_name" ] ; 
            $sFileRealName = phpfmg_rename_harmful($aFile[ "name" ]) ; 
            if( is_uploaded_file( $sFileName ) ): 
                
                $isSkip = '' != $file2link_size && ( (filesize($sFileName)/1024) > $file2link_size );
                // save uploaded file
                if( $isWritable && $isSave ){
                    $tofile = PHPFMG_SAVE_ATTACHMENTS_DIR . phpfmg_getRecordID() . '-' . basename($sFileRealName);
                    if( @copy( $sFileName, $tofile) ) {
                        chmod($tofile,0777);
                    };
                };

                if( $isSkip )
                    continue; // mail file as link
                 
                $attachments[] = array('file' => $sFileName, 'name' => $aFile[ "name" ] );
                
                if( !$use_phpmailer && !$isSMTP && ($fp = @fopen( $sFileName, "rb" )) ) :   
                    $sContent = fread( $fp, filesize( $sFileName ) );
                    fclose($fp); 
                    $sFName = basename( $sFileRealName ) ; 
                    $sMIME = getMIMEType( $sFName ) ; 
                     
                    $bPlainText = ( $sMIME == "text/plain" ) ; 
                    if( $bPlainText ) : 
                        $encoding = "" ; 
                    else: 
                        $encoding = "Content-Transfer-Encoding: base64".PHPFMG_LNCR;  
                        $sContent = chunk_split( base64_encode( $sContent ) );  
                    endif; 
                     
                    $sEncodeBody .=     PHPFMG_LNCR."--$boundary" .PHPFMG_LNCR.  
                                        "Content-Type: $sMIME;" .  PHPFMG_LNCR.
                                        "\tname=\"$sFName\"" . PHPFMG_LNCR. 
                                        $encoding .  
                                        "Content-Disposition: attachment;" . PHPFMG_LNCR.  
                                        "\tfilename=\"$sFName\"" . PHPFMG_LNCR. PHPFMG_LNCR. 
                                        $sContent . PHPFMG_LNCR ; 
                    $nFound ++;                                                 
                else: 
                    $sError .= "<br>Failed to open file $sFileName.\n" ; 
                endif; // if( $fp = fopen( $sFileName, "rb" ) ) : 
                 
            else: 
                $sError .= "<br>File $sFileName doesn't exist.\n" ; 
            endif; //if( file_exists( $sFileName ) ): 
        }; // end foreach
         
        $sEncodeBody .= PHPFMG_LNCR.PHPFMG_LNCR."--$boundary--" ; 
        
        $GLOBALS['phpfmg_files_content'] = $sEncodeBody ;
        $GLOBALS['phpfmg_nFound'] = $nFound ;
        
    }; // if
    
    $headers .= "MIME-Version: 1.0".PHPFMG_LNCR."Content-type: multipart/mixed;".PHPFMG_LNCR."\tboundary=\"$boundary\"";  
    $txtMsg = PHPFMG_LNCR."This is a multi-part message in MIME format." .PHPFMG_LNCR .  
              PHPFMG_LNCR."--$boundary" .PHPFMG_LNCR . 
              "Content-Type: {$content_type};".PHPFMG_LNCR.
              "\tcharset=\"$charset\"" .PHPFMG_LNCR.PHPFMG_LNCR .  
              $message . PHPFMG_LNCR; 
    
    
    if( $noAutoAttachements ) $sEncodeBody = '' ;
    
    $body    = $nFound ? $txtMsg . $sEncodeBody : $message ;
    $headers = $nFound ? $headers : $plainHeaders ; 
    

    $errmsg = "";
    if( $isSMTP || $use_phpmailer ){
        if( $noAutoAttachements ) $attachments = false ;
        $errmsg = phpfmg_phpmailer( $to, $subject, $body, $from, $fromName, $cc  , $bcc , $charset, $attachments );
        
    }else{
    
        if ( !mail( $to, $subject, $body, $headers  ) )
            $errmsg = "Failed to send mail";
    };

    $ok = $errmsg == "" ;
    $status = $ok ? "\n[Email sent]" : "\n[{$errmsg}]" ;
    phpfmg_log_mail( $to, $subject, ($ok ? 'Email sent' : 'Failed to send mail') . "\n" . ($nFound ? $headers  . $txtMsg : $headers . $message), '', $type . $status ); // no log for attachments 
    
    return $sError ;         
} 


function    phpfmg_phpmailer( $to, $subject, $message, $from, $fromName, $cc = "" , $bcc = "", $charset = "UTF-8",$attachments = false ){
    
    $mail             = new PHPMailer();
    $mail->Host       = PHPFMG_SMTP_HOST; // SMTP server
    $mail->Username   = PHPFMG_SMTP_USER;
    $mail->Password   = PHPFMG_SMTP_PLAIN_PASSWORD != '' ? PHPFMG_SMTP_PLAIN_PASSWORD : base64_decode(PHPFMG_SMTP_PASSWORD);
    $mail->SMTPAuth   = PHPFMG_SMTP_PASSWORD != ""; 
    $mail->SMTPSecure = PHPFMG_SMTP_SECURE;                 
    $mail->Port       = PHPFMG_SMTP_PORT == "" ? 25 : PHPFMG_SMTP_PORT;          
    if( defined('PHPFMG_SMTP_DEBUG_LEVEL') && PHPFMG_SMTP_DEBUG_LEVEL != "" ){
        $mail->SMTPDebug  = (int)PHPFMG_SMTP_DEBUG_LEVEL ; 
    };

    $mail->From       = $from;
    $mail->FromName   = $fromName;
    $mail->Subject    = $subject;
    $mail->Body       = $message;
    $mail->CharSet = $charset;
    
    if( !phpfmg_is_mysite() && (defined('PHPFMG_USE_SMTP') && 'Y' == PHPFMG_USE_SMTP) ){
        $mail->IsSMTP(); 
    };
    
    $mail->IsHTML('html' == PHPFMG_MAIL_TYPE);

    $mail->AddAddress($to);
    
    if( ''!= $cc ){
        $CCs = explode(',',$cc);
        foreach($CCs as $c){
            $mail->AddCC( $c );
        };
    };
    
    if( ''!= $bcc ){
        $BCCs = explode(',',$bcc);
        foreach($BCCs as $b){
            $mail->AddBCC( $b );
        };
    };
    
  
    if( is_array($attachments) ){
        foreach($attachments as $f){
            $mail->AddAttachment( $f['file'], basename($f['name']) );
        };
    };
    
    return $mail->Send() ? "" : $mail->ErrorInfo; 
    
} 



function mailAutoResponse( $to, $from, $fields = false ){
    if( !formIsEMail($to) ) return ERR_EMAIL ; // one more check for spam robot
	$body = trim(phpfmg_auto_response_message());
	if( empty($body) ){
	   return false ;
	};
	
	$subject = PHPFMG_RETURN_SUBJECT;
	$isHtml = 'html' == PHPFMG_MAIL_TYPE ;
	$body = phpfmg_adjust_template($body);
	$body = phpfmg_parse_mail_body($body,$fields);
    $subject = phpfmg_parse_mail_body( $subject, $fields );
    if( $isHtml ) {
        $body = phpfmg_getHtmlContent( $body );
    };		
    $body = str_replace( "0x0d", '', $body ); 		
    $body = str_replace( "0x0a", PHPFMG_LNCR, $body );
    
    if( defined('PHPFMG_RETURN_EMAIL') && formIsEMail(PHPFMG_RETURN_EMAIL) ){
        $from = PHPFMG_RETURN_EMAIL;
    };
    $fromHeader = ( PHPFMG_YOUR_NAME == "" ?  "" : "\"".PHPFMG_YOUR_NAME . "\"" ) . " <{$from}>"; 
    return mailAttachments( $to , $subject , $body, filterEmail($from), PHPFMG_YOUR_NAME, $fromHeader, '' , '', PHPFMG_CHARSET, 'AutoResponseEmail' );
	
}


function phpfmg_log_mail( $to='', $subject='', $body='', $headers = '', $type='' ){
    $sep = PHPFMG_LNCR . str_repeat('----',20) . PHPFMG_LNCR ; 
    appendToFile( PHPFMG_EMAILS_LOGFILE, date("Y-m-d H:i:s") . "\t" . $_SERVER['REMOTE_ADDR'] . "\t{$type}"  . $sep . "To: {$to}\r\nSubject: {$subject}\r\n" . $headers . $body  . "<br>" . PHPFMG_LNCR . $sep . PHPFMG_LNCR ) ;
}



function phpfmg_getHtmlContent( $body ){
    $html = "<html><title>Your Form Mail Content | htttp://phpfmg.sourceforge.net</title><style type='text/css'>body, td{font-family : Verdana, Arial, Helvetica, sans-serif;font-size : 13px;}</style><body>"
            . $body ."</body></html>";        
    return $html ;
}  



function phpfmg_adjust_template( $body ){
	$isHtml = 'html' == PHPFMG_MAIL_TYPE ;
    if( $isHtml ){
        $body = preg_match( "/<[^<>]+>/", $body ) ? $body : nl2br($body); 
    };
    return $body;
}



function phpfmg_parse_mail_body( $body, $fields = false ){
    if( !is_array($fields) )
        return $body ;
    
    $yes = function_exists( 'str_ireplace' );
    foreach( $fields as $name => $value ){
        $body = $yes ? str_ireplace( $name, $value ,$body ) 
                     : str_replace ( $name, $value ,$body );
    }; 
    return trim($body);
}



# filter line breaks to avoid emails injecting
function filterEmail($email, $chars = ''){
    $email = trim(str_replace( array("\r","\n"), '', $email ));
    if( is_array($chars) ) $email = str_replace( $chars, '', $email );
    $email = preg_replace( '/(cc\s*\:|bcc\s*\:)/i', '', $email );
    return $email;
}



function mailReport( $content = "", $file = '' ){
	$content = "
Dear Sir or Madam,

Your online form at " . HOST_NAME . PHP_SELF . " failed to save data to file. Please make sure the web user has permission to write to file \"{$file}\". If you don't know how to fix it, please forward this email to technical support team of your web hosting company or your Administrator.

PHPFMG 
- PHP FormMail Generator
";
    mail(PHPFMG_TO, "Error@" . HOST_NAME . PHP_SELF, $content );
}



function	remove_newline( $str = "" ){
    return str_replace( array("\r\n", "\r", "\n"), array('\r\n', '\r', '\n'), $str );
}



function	checkPass( $form_mail = array() )
{

    $names = array();
    $labels = array();
    
    foreach( $form_mail as $field ){
		$type     = strtolower( $field[ "type" ]  );
		//$value    = trim( $_POST[ $field[ "name" ] ] );
        $value = phpfmg_field_value( $field[ "name" ] );
		$required = strtolower($field[ "required" ]) ;
		$text     = stripslashes( $field[ "text" ] );
		
		// simple check the field has something keyed in.
		if( !strlen($value) && (  $required == "required" ) && $type != "attachment" ){
		    $names[] = $field[ "name" ];
		    $labels[]  = $text;
			//return ERR_MISSING . $text  ;
			continue;
        };   

		// verify the special case
		if( 
			( strlen($value) || $type == "attachment" ) 
			&&  $required == "required" 
		):
		
			switch( $type ){
				case 	strtolower("Sender's Name") :
						  break;
				case 	strtolower("Generic email"):
				case 	strtolower("Sender's email"):
						   if( ! formIsEMail($value) )	 {
                    		    $names[] = $field[ "name" ];
                    		    $labels[]  = $text . ERR_EMAIL;
                            //return ERR_EMAIL . $text ;
                           };
                		    // for checking entry limitation
                            if( $type == "sender's email" ){
                		      $GLOBALS['sender_email'] = $value;
                            };
						   break;
				case	"text" :
							break;
				case 	"textarea" :
							break;
				case	"checkbox" :
				case 	"radio" :
							break;
				case 	"select" :
							break;
				case 	"attachment" :
							$upload_file = $_FILES[ $field["name"] ][ "tmp_name" ] ;
							if( ! is_uploaded_file($upload_file)  ){
                    		    $names[] = $field[ "name" ];
                    		    $labels[]  = $text;
								//return  ERR_SELECT_UPLOAD . $text; 
							};
							break;
				case strtolower("Date(MM-DD-YYYY)"):
							break;
				case strtolower("Date(MM-YYYY)"):
							break;
				case strtolower("CreditCard(MM-YYYY)"):
							if( $value < date("Y-m") ) {
                    		    $names[] = $field[ "name" ];
                    		    $labels[]  = $text;
                                //return ERR_CREDIT_CARD_EXPIRED  . $text;
                            }; 
							break;
				case strtolower("CreditCard#"):
							if( !formIsCreditNumber( $value )  ) {
                    		    $names[] = $field[ "name" ];
                    		    $labels[]  = $text;
                                //return ERR_CREDIT_CARD_NUMBER  . $text ;
                            };
							break;
				case strtolower("Time(HH:MM:SS)"):
							break;
				case strtolower("Time(HH:MM)"):
							break;
				default :
					//return $sErrRequired . $form_mail[ $i ][ "text" ];
			}; // switch
		endif;
	}; // for
	
	return array(
	   'fields' => $names,
       'errors' => $labels,  
    );
}



function formSelected( $var, $val ) 
{ 
    echo ( $var == $val ) ? "selected" : ""; 
} 



function formChecked( $var, $val ) 
{ 
    echo ( $var == $val ) ? "checked" : ""; 
} 



function    formIsEMail( $email ){ 
        return ereg( "^(.+)@(.+)\\.(.+)$", $email ); 
} 



function    selectList( $name, $selectedValue, $start, $end, $prompt = "-Select-", $style = "" ) 
{ 
    $tab = "\t" ; 
    print "<select name=\"$name\" $style>\n" ; 
    print $tab . "<option value=''>$prompt</option>\n" ; 
    $nLen = strlen( "$end" ) ; 
    $prefix_zero = str_repeat( "0", $nLen ); 
    for( $i = $start; $i <= $end ; $i ++ ){ 
        $stri = substr( $prefix_zero . $i, strlen($prefix_zero . $i)-$nLen, $nLen ); 
        $selected = ( $stri == $selectedValue ) ? " selected " : "" ; 
        print $tab . "<option value=\"$stri\" $selected >$stri</option>\n" ; 
    } 
    print "</select>\n\n" ; 
} 



# something like CreditCard.pm in perl CPAN 
function formIsCreditNumber( $number ) { 
     
    $tmp = $number; 
    $number = preg_replace( "/[^0-9]/", "", $tmp ); 

    if ( preg_match(  "/[^\d\s]/", $number ) )  return 0; 
    if ( strlen($number) < 13  && 0+$number ) return 0;  

    for ($i = 0; $i < strlen($number) - 1; $i++) { 
        $weight = substr($number, -1 * ($i + 2), 1) * (2 - ($i % 2)); 
        $sum += (($weight < 10) ? $weight : ($weight - 9)); 
    } 

    if ( substr($number, -1) == (10 - $sum % 10) % 10  )  return $number; 
    return $number; 
} 


/* --------------------------------------------------------------------------------------------------- 
    Parameters: $sFileName 
    Return : 
        1. "" :  no extendsion name, or sFileName is empty 
        2. string: MIME Type name of array aMimeType's definition. 
   ---------------------------------------------------------------------------------------------------*/ 
function    getMIMEType( $sFileName = "" ) { 
    $sFileName = strtolower( trim( $sFileName ) ); 
    if( ! strlen( $sFileName  ) ) return ""; 
     
    $aMimeType = array(  
        "txt" => "text/plain" , 
        "pdf" => "application/pdf" , 
        "zip" => "application/x-compressed" , 
        
        "html" => "text/html" , 
        "htm" => "text/html" , 
        
        "avi" => "video/avi" , 
        "mpg" => "video/mpeg " , 
        "wav" => "audio/wav" , 
        
        "jpg" => "image/jpeg " , 
        "gif" => "image/gif" , 
        "tif" => "image/tiff " , 
        "png" => "image/x-png" , 
        "bmp" => "image/bmp"  
    ); 
    $aFile = split( "\.", basename( $sFileName ) ) ; 
    $nDiminson = count( $aFile ) ; 
    $sExt = $aFile[ $nDiminson - 1 ] ; // get last part: like ".tar.zip", return "zip" 
     
    return ( $nDiminson > 1 ) ? $aMimeType[ $sExt ] : "";  
} 



function    appendToFile( $sFileName = "", $line = "", $dataColumnsLine = '' ){ 
    if( !$sFileName || !$line ) return 0;

    $isExists = file_exists( $sFileName );
    $hFile = @fopen( "$sFileName", "a+w" ); 
    $nBytes = 0; 
    if( $hFile ){ 
        if( !$isExists && false !== strpos(strtolower(basename($sFileName)), '.php') ){
            fputs( $hFile, "<?php exit(); /* For security reason. To avoid public user downloading below data! */?>\r\n");
            if( !empty($dataColumnsLine) ){
                fputs($hFile,$dataColumnsLine."\r\n");
            };
        };
        $nBytes = fputs( $hFile , trim($line)."\r\n" ); 
        fclose( $hFile ); 
    }; 
    return $nBytes ; 
} 

function phpfmg_get_csv_header(){
    $csvValues = array();
    foreach( $GLOBALS['form_mail'] as $field ){
        $csvValues[] = csvfield( $field[ "text" ] );
    };
    return join(chr(0x09),/*","*/$csvValues) ;
}

/*
function phpfmg_field_instruction($name, $show = true ){  
    global $form_mail, $sErr;
    $isError = in_array($name,$sErr['fields']);
    $class = $isError ? 'instruction_error' : 'instruction' ;
    if( $show || $isError ) echo "<div class='{$class}'>". htmlspecialchars_decode($form_mail[ $name ]['instruction']) . "</div>";
}
*/

function phpfmg_rand( $len = 4 ){
    $md5 = md5( uniqid(rand()) );
    return $len > 0 ? substr($md5,0,$len) : $md5 ;
}





function phpfmg_check_captcha(){
    $errmsg = '';
    if( phpfmg_is_reCAPTCHA() ){
        $resp = recaptcha_check_answer (reCAPTCHA_PRIVATE_KEY,
                                        $_SERVER["REMOTE_ADDR"],
                                        $_POST["recaptcha_challenge_field"],
                                        $_POST["recaptcha_response_field"]);
        $errmsg = $resp->is_valid ? '' : $resp->error ;
        
    }else{
        
        if( isset($_SESSION[PHPFMG_ID.'fmgCaptchCode']) && strtoupper($_POST['fmgCaptchCode']) != strtoupper($_SESSION[PHPFMG_ID.'fmgCaptchCode']) ){
            $errmsg = ERR_CAPTCHA ;
        };
        
    };
    
    return $errmsg ;
}


function phpfmg_is_reCAPTCHA(){
    return defined('reCAPTCHA_PUBLIC_KEY') && defined('reCAPTCHA_PRIVATE_KEY') && function_exists ("mcrypt_encrypt") && is_file( PHPFMG_ROOT_DIR.'/recaptchalib.php' ) ;
}

function phpfmg_show_captcha(){
    if( phpfmg_is_reCAPTCHA() ){
        echo recaptcha_get_html(reCAPTCHA_PUBLIC_KEY);
        return ;
    };
    $url = PHPFMG_ADMIN_URL . '?mod=captcha&amp;func=get&amp;tid=' ;
    $onclick= "onclick=\"document.getElementById('phpfmg_captcha_image').src='{$url}'+Math.random();return false;\" " ;
    echo "<a href='http://www.formmail-maker.com' {$onclick} title=\"Free Mail Form Tool\"><img id=\"phpfmg_captcha_image\" src=\"". $url . time() ."\"  border=0 style=\"cursor:pointer;\" alt=\"Click the image to reload. PHP FormMail Generator at http://phpfmg.sourceforge.net\"></a>\n";
    echo "<a href='http://phpfmg.sourceforge.net' {$onclick} style=\"color:#ffffff;\" title=\"Reload PHP FormMail Generator Security Image\" >Reload Image</a><br>\n";
    echo "<input type='text' name='fmgCaptchCode' value='' class='fmgCaptchCode' style='width:73px;' >\n";
}


function phpfmg_hsc($field, $default){
    echo isset($_POST[ $field ]) 
         ? HtmlSpecialChars( $_POST[ $field ] ) 
         : $default;
}

function phpfmg_dropdown( $name, $options, $showInputbox = false, $isMultiple = false, $extra = '', $isReturn = false, $class = 'text_select' ){
    //$showInputbox = true;
    $displayLast  = 'none' ;
    $onchange = $showInputbox ? " onchange=\"toggleOtherInputBox('{$name}','select','{$name}');\" " : "" ; 
    $sMultiple = $isMultiple ? 'multiple="multiple"' : '' ;
    $other = "{$name}_other" ;

    $dropdown = array();
    $list = explode( '|', $options );
    $dropdown[] = "<select name='{$name}" . ($isMultiple ? '[]' : '') ."' id='{$name}' class='{$class}' {$extra} {$onchange} {$sMultiple} >";
    if( is_array($list) ){
        $len = count($list);
        $i = 0 ;
        $isPost = isset($_POST) && count($_POST) > 0;
        foreach( $list as $opt ){
            $o = phpfmg_parse_option( $opt );
            if( $showInputbox && $i == $len - 1 ) 
                $o['value'] = 'other';
                
            if( $isPost ){ 
                $selected = ($o['value'] == $_POST[ $name ] || 
                             $isMultiple && is_array($_POST[ $name ]) && in_array($o['value'],$_POST[ $name ]) ) // multiple select
                            ? 'selected' : '' ;
            }else{
                $selected = $o['default'] ? 'selected' : '' ;
            };
            if( $isPost && $i == $len - 1 && $selected == 'selected' ){
                $displayLast = '' ;
            };
            $dropdown[] = "<option value=\"{$o['value']}\" {$selected}>{$o['text']}</option>";
            $i ++ ;
        };
    };
    $dropdown[] = "</select>\n";
    
    if( $showInputbox ){
        $dropdown[] = "<input type='hidden' name='{$name}_other_check' id='{$name}_other_check' value='" . ($displayLast==''? 1:0) . "'>" ;
        $dropdown[] = "<br id='{$other}_br'><input type='text' name='{$other}' id='{$other}' value=\"" . HtmlSpecialChars($_POST[$other]) . "\" style='display:{$displayLast};' class='text_box' >" ;
    };        
         
    $s = join("\t\n",$dropdown);

    if( $isReturn )
        return $s;
    else
        echo $s ;
}


function phpfmg_date_dropdown( $cfgDate, $showSep = true ){
    $sep = $showSep ? $cfgDate['separator'] . "&nbsp;" : "";
    $field_name = $cfgDate['field_name'];
    if( !isset($cfgDate['yyyy']) ){
        $startYear = $cfgDate['startYear'];
        $endYear = $cfgDate['endYear'];
        $year = range( $startYear, $endYear );
        $cfgDate['yyyy'] = $cfgDate['yearPrompt'] . '=,|' . join("|",$year);   
    };
    
    switch( $cfgDate['format'] ){
        case 'mm/dd/yyyy' :
            phpfmg_dropdown( $field_name.'_month', $cfgDate['month'], false, false, '', false, '' );
            echo $sep;
            phpfmg_dropdown( $field_name.'_day', $cfgDate['day'], false, false, '', false, '' );
            echo $sep;
            phpfmg_dropdown( $field_name.'_yyyy', $cfgDate['yyyy'], false, false, '', false, '' );
            break;
        case 'dd/mm/yyyy' :
            phpfmg_dropdown( $field_name.'_day', $cfgDate['day'], false, false, '', false, '' );
            echo $sep;
            phpfmg_dropdown( $field_name.'_month', $cfgDate['month'], false, false, '', false, '' );
            echo $sep;
            phpfmg_dropdown( $field_name.'_yyyy', $cfgDate['yyyy'], false, false, '', false, '' );
            break;
        case 'yyyy/mm/dd' :
            phpfmg_dropdown( $field_name.'_yyyy', $cfgDate['yyyy'], false, false, '', false, '' );
            echo $sep;
            phpfmg_dropdown( $field_name.'_month', $cfgDate['month'], false, false, '', false, '' );
            echo $sep;
            phpfmg_dropdown( $field_name.'_day', $cfgDate['day'], false, false, '', false, '' );
            break;
        case 'mm/yyyy' :
            phpfmg_dropdown( $field_name.'_month', $cfgDate['month'], false, false, '', false, '' );
            echo $sep;
            phpfmg_dropdown( $field_name.'_yyyy', $cfgDate['yyyy'], false, false, '', false, '' );
            break;
        case 'yyyy/mm' :
            phpfmg_dropdown( $field_name.'_yyyy', $cfgDate['yyyy'], false, false, '', false, '' );
            echo $sep;
            phpfmg_dropdown( $field_name.'_month', $cfgDate['month'], false, false, '', false, '' );
            break;
        case 'mm/dd' :
            phpfmg_dropdown( $field_name.'_month', $cfgDate['month'], false, false, '', false, '' );
            echo $sep;
            phpfmg_dropdown( $field_name.'_day', $cfgDate['day'], false, false, '', false, '' );
            break;
        case 'dd/mm' :
            phpfmg_dropdown( $field_name.'_day', $cfgDate['day'], false, false, '', false, '' );
            echo $sep;
            phpfmg_dropdown( $field_name.'_month', $cfgDate['month'], false, false, '', false, '' );
            break;
    };
    echo "\n<input type='hidden' name='{$field_name}_format' value='{$cfgDate['format']}'>\n";
    echo "<input type='hidden' name='{$field_name}_separator' value='{$cfgDate['separator']}'>\n";
    
}


function phpfmg_date_dropdown_require( $field_name ){
    if( !isset($_POST) )
        return ;
    
    $month   = $_POST[$field_name.'_month'];
    $day     = $_POST[$field_name.'_day'];
    $yyyy    = $_POST[$field_name.'_yyyy'];
    $format  = $_POST[$field_name.'_format']; 
    $sep     = isset($_POST[$field_name.'_separator']) ? $_POST[$field_name.'_separator'] : '/'; 

    // make up $_POST[$field_name] value
    $_POST[$field_name] = '';
    switch( $format ){
        case 'mm/dd/yyyy' :
            if( !empty($month) && !empty($day) && !empty($yyyy) )
                $_POST[$field_name] = $month . $sep . $day . $sep . $yyyy;
            break;
        case 'dd/mm/yyyy' :
            if( !empty($month) && !empty($day) && !empty($yyyy) )
                $_POST[$field_name] = $day . $sep . $month . $sep . $yyyy;
            break;
        case 'yyyy/mm/dd' :
            if( !empty($month) && !empty($day) && !empty($yyyy) )
                $_POST[$field_name] = $yyyy . $sep . $month . $sep . $day;
            break;
        case 'mm/yyyy' :
            if( !empty($month) && !empty($yyyy) )
                $_POST[$field_name] = $month . $sep . $yyyy;
            break;
        case 'yyyy/mm' :
            if( !empty($month) && !empty($yyyy) )
                $_POST[$field_name] = $month . $sep . $yyyy;
            break;
        case 'mm/dd' :
            if( !empty($month) && !empty($day) )
                $_POST[$field_name] = $month . $sep . $day;
            break;
        case 'dd/mm' :
            if( !empty($month) && !empty($day) )
                $_POST[$field_name] = $day . $sep . $month;
            break;
    };
    
}

function phpfmg_time_dropdown( $cfgTime ){
    $field_name = $cfgTime['field_name'];
    $sep =":&nbsp;";
    switch( $cfgTime['hourOpt'] ){
        case 'h12' :
            phpfmg_dropdown( $field_name.'_hour', $cfgTime['hour'], false, false, '', false, '' );
            echo $sep;
            phpfmg_dropdown( $field_name.'_minute', $cfgTime['minute'], false, false, '', false, '' );
            phpfmg_dropdown( $field_name.'_amfm', $cfgTime['amfm'], false, false, '', false, '' );
            break;
        case 'h24' :
            phpfmg_dropdown( $field_name.'_hour', $cfgTime['hour'], false, false, '', false, '' );
            echo $sep;
            phpfmg_dropdown( $field_name.'_minute', $cfgTime['minute'], false, false, '', false, '' );
            break;
    };
    echo "\n<input type='hidden' name='{$field_name}_format' value='{$cfgTime['hourOpt']}'>\n";
}


function phpfmg_time_dropdown_require( $field_name ){
    if( !isset($_POST) )
        return ;
    
    $hour   = $_POST[$field_name.'_hour'];
    $minute = $_POST[$field_name.'_minute'];
    $amfm   = $_POST[$field_name.'_amfm'];
    $format = $_POST[$field_name.'_format']; 
    $sep    = ':'; 

    // make up $_POST[$field_name] value
    $_POST[$field_name] = "";
    switch( $format ){
        case 'h12' :
            if( !empty($hour) && !empty($minute) && !empty($amfm) )
                $_POST[$field_name] = $hour . $sep . $minute . ' ' . $amfm;
            break;
        case 'h24' :
            if( !empty($hour) && !empty($minute) )
                $_POST[$field_name] = $hour . $sep . $minute;
            break;
    };
    
}



function phpfmg_dependent_dropdown( $field_name ){
    $field = phpfmg_dependent_dropdown_get_field( $field_name );
    $dd = new DependantDropdown(); 
    $dd->parseFmgField($field);
    $html = $dd->getHtml();
    echo $html;
}

function phpfmg_dependent_dropdown_dynamic_require( $field_name ){
    $field = phpfmg_dependent_dropdown_get_field( $field_name );
    $dd = new DependantDropdown();
    $dd->parseFmgField($field);
    $dd->dynamicRequired(); 
}

function phpfmg_dependent_dropdown_get_field( $field_name ){
    if( !isset($_SESSION[PHPFMG_ID]) ){
        $_SESSION[PHPFMG_ID] = array();
    };
    if( !isset($_SESSION[PHPFMG_ID]['DD_DATA_' . $field_name]) ){
        $base64 = phpfmg_dependent_dropdown_data();
        $data = @unserialize( base64_decode($base64) );
        $_SESSION[PHPFMG_ID]['DD_DATA_' . $field_name] = $data;
    }else{
        $data = $_SESSION[PHPFMG_ID]['DD_DATA_' . $field_name]; 
    };
    
    if( !is_array($data) ){
        return ;
    };
    
    foreach( $data as $field ){
        if( $field['name'] == $field_name ){
            return $field;
        };
    };
}


# ------------------------------------------------------
class DependantDropdown
{
    var $data = '';
    var $sheet = array();
    var $fields = array();
    var $fieldInfo = array( 'label', 'instruction', 'required', 'prompt' ); // describe field information from the first N rows of data
    var $prefix = 'dd'; // in case there is no name for dropdown, it will name the dropdown like dd_0, dd_1, ... 

    var $fmgField = false;
    var $newliner = "<!--esh_newline-->" ; // replace \r\n with $newliner ;
	var $newtaber = "<!--esh_newtaber-->" ; // replace \t with $newtaber ;
    
    function DependantDropdown(){
    }

    
    function lookupFieldColumn( $field, $column, $lookup, $contentType='text/plain', $charset='utf-8' ){
        $this->parseFmgField( $field );
        $this->nocache_headers( $contentType, $charset );
        return join( "\n", $this->getColumn( $column, $lookup ) );
    }

    function parseFmgField( $field ){
        if( !isset($_SESSION[PHPFMG_ID]) ){
            $_SESSION[PHPFMG_ID] = array();
        };
        $this->fmgField = $field;
        $value = $this->newline_back($field['value']);
        $this->data = explode("\r\n",$value);
        if( !isset($_SESSION[PHPFMG_ID][ "DD_".$field['name'] ]) ){
            $this->parseData($field);
            $_SESSION[PHPFMG_ID][ "DD_".$field['name'] ] = $this->fields;
        }else{
            $this->fields = $_SESSION[PHPFMG_ID][ "DD_".$field['name'] ]; 
        };
        $this->makeupFieldsName();
    }
    
	function	newline_back( $str = "" ){
		return str_replace( array($this->newtaber, $this->newliner),  array("\t","\r\n"), $str );
	}
    
    function nocache_headers($contentType='text/plain', $charset='utf-8'){
        header("Expires: Mon, 01 Jan 1970 00:00:01 GMT");
        header("Cache-Control: max-age=0, no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header( "Content-Type: {$contentType}; charset={$charset}" );
    }
  
    
    function setData( $s ){
        $this->data = $s ;
    }
    
    function setPrefix( $s ){
        $this->prefix = $s;
    }
    
    function parseData(){
        $tab = chr(0x09);
        $nFieldInfoRows = count( $this->fieldInfo );
        for( $i = 0, $n = count($this->data); $i < $n; $i ++ ){
            $line = str_replace('"', '', $this->data[$i] );
            $cols = explode( $tab, $line );

            if( is_array($cols) && count($cols) > 1 ){
            
                if( $i < $nFieldInfoRows ){
                    $trims = array();
                    foreach( $cols as $col ){
                        $trims[] = trim($col);
                    };
                    $this->fields[ $this->fieldInfo[$i] ] = $trims;
                }
                else
                    $this->fields['data'][] = $cols;
            
            }; // if
            
            //if ( $i > 1000 ) break;
        }; // for
        
    }
    
    // $quickTest : to see whether a column contains data
    function getColumn( $n, $lookup = array(), $quickTest = false ){ 
        $count = count($lookup);
        if( $n > 0 && empty($count) ){
            return array(); // can not get column without search query  
        };
        
        $col        = array();
        $lastValue  = $lookup[ $count - 1 ];
        $flatLookup = join( '|', $lookup );
        
        foreach( $this->fields['data'] as $r ){
        
            if( !isset($r[$n]) )
                continue;

            $value = trim($r[$n]);
            if( $value == '' )
                continue;
                
            //$value = $r[$n];
            if( $n == 0 ){            
                $col[] = $value;
            }else{
                
                //if( trim($r[$n-1]) == $lastValue ){ // quick check to improve performance 
                if( $r[$n-1] == $lastValue ){ // quick check the last value to improve performance
                    $leftCols       = array_slice( $r, 0, $n );
                    $flatLeftValues = join( '|', $leftCols );
                    if( $flatLeftValues == $flatLookup ){ // show value only by lookuping by joining all its parents' values
                        $col[] = $value;
                    };
                }; // if
                
            }; // if $n == 0
            
            if( $quickTest && count($col) > 0 ) break;
              
        }; // foreach
        
        return array_unique($col);
    }
    
    function getColumnOptions( $n, $lookup = array(), $default = '' ){
        $opts = array();
        foreach( $this->getColumn($n, $lookup) as $v ){
            $selected = $default == $v ? 'selected' : '' ; 
            $opts[] = "<option {$selected} value=\"" . htmlspecialchars($v) . "\">{$v}</option>";
        };
        return join("\n",$opts);
    }
    
    function getHtml(){
        $html = array();
        
        $field_name = $this->fmgField['name'];
        $this->prefix = $field_name;
        $count = count($this->fields['label']);

        // prepare for getting column options after form submitted
        $lookup = array();
        $isPost = isset($_POST[ $this->fields['name'][0] ]);
        if( $isPost ){
            for( $i = 0; $i < $count; $i++  ){
                $label        = $this->fields['label'][$i];
                if( empty($label) )
                    continue;

                $lookup[] = $_POST[ $this->fields['name'][$i] ];  
            };
        };
                
        for( $i = 0; $i < $count; $i++  ){
            $label        = $this->fields['label'][$i];
            if( empty($label) )
                continue;
                
            $name         = $this->fields['name'][$i];
            $instruction  = $this->fields['instruction'][$i];
            $prompt       = $this->fields['prompt'][$i];
            $required     = $this->fields['required'][$i];
            $promptOption = empty($prompt) ? "" : "<option value=''>{$prompt}</option>";
            if( $isPost )
                $options = $this->getColumnOptions( $i, array_slice($lookup,0,$i), $_POST[$name] );
            else
                $options = $this->getColumnOptions( $i, array(), '' );
                                 
            $select = "<select id='{$name}' class='text_select' name='{$name}' onchange=\"dd_change({$i}, {$count}, '{$this->prefix}');\">{$promptOption}" . $options . "</select>";
            $sRequired = "<label class='form_required' >" . (strtolower($required) == 'required'? '*' : '&nbsp;') . "</label>" ;
$li = "
<li class='field_block' id='{$name}_div'>
    <div class='col_label'>
	   <label class='form_field'>{$label}</label>{$sRequired} 
    </div>
	<div class='col_field'>
    	{$select}
    	<div id='{$name}_tip' class='instruction'>{$instruction}</div>
	</div>
</li>
";
            $html[] = $li;
        };

        echo join("\n\n",$html);
        
    }


    function dynamicRequired(){
        if( !isset($_POST) ){
            return ;
        };
        
        $field_name = $this->fmgField['name'];
        $this->prefix = $field_name;
        $count = count($this->fields['label']);

        $lookup = array();
        $isPost = isset($_POST[ $this->fields['name'][0] ]);
        if( $isPost ){
            for( $i = 0; $i < $count; $i++  ){
                $label        = $this->fields['label'][$i];
                if( empty($label) )
                    continue;

                $lookup[] = $_POST[ $this->fields['name'][$i] ];  
            };
        };
                
        for( $i = 0; $i < $count; $i++  ){
            $label        = $this->fields['label'][$i];
            if( empty($label) )
                continue;
                
            $name = $this->fields['name'][$i];
            $required = $this->fields['required'][$i];
            if( strtolower($required) == 'required' ){
                $rows = $this->getColumn( $i, array_slice($lookup,0,$i), true );
                if( empty($rows) ) {
                    $GLOBALS['form_mail'][ $name ]['required'] = '' ; //
                };
            }else{
                $GLOBALS['form_mail'][ $name ]['required'] = '' ;
            };  
        };

    }
    
    
    function getFormMailArrayCode(){
        $code = array();
        for( $i = 0, $n = count($this->fields['label']); $i < $n; $i++  ){
            $label        = $this->fields['label'][$i];
            if( empty($label) )
                continue;
            $name         = $this->fields['name'][$i];
            $instruction  = $this->fields['instruction'][$i];
            $prompt       = $this->fields['prompt'][$i];
            $required     = $this->fields['required'][$i];
			$code[] = "\$GLOBALS['form_mail']['{$name}'] = array( \"name\" => \"$name\", \"text\" => \"" . addslashes( $label ) . "\",  \"type\" => \"select\", \"instruction\" => \"$instruction\", \"required\" => \"$required\" ) ;" ;
        };
        return join("\n",$code);
    }    

    function makeupFieldsName($default='field_99'){
        $field_name = isset($this->fmgField['name']) ? $this->fmgField['name'] : $default;
        $this->prefix = $field_name;
        for( $i = 0, $n = count($this->fields['label']); $i < $n; $i++  ){
            $this->fields['name'][$i] = $this->prefix . '_' . $i;
        };
    }
      
}



function phpfmg_parse_option( $opt ){
    $opt = $opt;
    $a = array(
        'text' => $opt,
        'value' => $opt,
        'default' => false,
    );
    $pos = strrpos( $opt, '=' );
    if( false !== $pos ){
        $a['text'] = substr($opt,0,$pos);
        $part = substr($opt,$pos+1);
        $nv = strrpos( $part, ',' );
        if( false !== $nv ){
            $a['value'] = substr($part,0,$nv);
            $a['default'] = 'default' == strtolower(substr($part,$nv+1));  
        }else{
            $a['value'] = $part;
        };
    };
    $a['text'] = trim($a['text']);
    $a['value'] = trim($a['value']);
    return $a ;
}



function phpfmg_field_value( $name ){
/*
    $value = "" ;
    if( !isset($GLOBALS['form_mail'][$name]) )
        return $value;
*/    
    if( isset($GLOBALS[$name."_value"]) )
        return $GLOBALS[$name."_value"] ;
        
    $field = $GLOBALS['form_mail'][$name];
    $checkOther = isset( $_POST[$name.'_other_check'] ) && 1 == $_POST[$name.'_other_check'] ;
    $otherInputValue = $checkOther ? $_POST[$name.'_other'] : '' ;

    switch( $field['type'] ){
        case 'select' :
            if( $checkOther && $otherInputValue == "" ){
                return $value; 
            };
            
            if( is_array($_POST[$name]) ){
                //array_pop( $_POST[$name] ); // pop the last "other" element
                $value = join(PHPFMG_LNCR,$_POST[$name]) . PHPFMG_LNCR. $otherInputValue ;
                $value = str_replace( PHPFMG_LNCR . "other", "", $value ); 
            }else{
                $value = $checkOther ? $otherInputValue : $_POST[ $name ];
            };
            break;
            
        case 'radio' :
            if( $checkOther ){
                $value = $otherInputValue == '' ? '' : $otherInputValue;                
            }else{
                $value = $_POST[ $name ];
            };   
            break;
            
        case 'checkbox' :
            if( $checkOther && $otherInputValue == "" ){
                return $value; 
            };
            
            $length = isset($_POST[$name.'_length']) ? $_POST[$name.'_length'] : 100;
            $values = array();
            for( $i = 1; $i <= $length; $i ++){
                $newName = 'Checkbox' . ($i<10 ? '0' .$i : $i ) . "_" . $name;
                if( $_POST[ $newName ] != "" && $_POST[ $newName ] != 'other' )
                    $values[] = $_POST[ $newName ];
            };
            $value = ( empty($values) ? "" : join( PHPFMG_LNCR, $values ) ) . ( $otherInputValue != "" ? PHPFMG_LNCR . $otherInputValue : "" );
            break;
            
        default:
            $value = $_POST[ $name ];
            break;
    };
    $GLOBALS[$name."_value"] = $value ;    
    return $value;
}



function phpfmg_choice( $type, $name, $options, $showInputbox = false, $isReturn = false ){
    //$showInputbox = true;
    $displayLast  = 'none' ;
    $radios = array();
    $list = explode( '|', $options );
    if( is_array($list) ){
        $len = count($list);
        $i = 0 ;
        $other = "{$name}_other" ;
        $isPost = isset($_POST) && count($_POST) > 0;
        foreach( $list as $opt ){
            //$value = HtmlSpecialChars( $opt );
            $o = phpfmg_parse_option( $opt );
            if( $showInputbox && $i == $len - 1 ) 
                $o['value'] = 'other';
                
            $id = "{$name}_{$i}";
            $newname = 'checkbox' == $type ? "Checkbox" . substr("00".($i+1), strlen("00".($i+1))-2,2) . "_" . $name : $name;
            if( $isPost ){ 
                $checked = $o['value'] == $_POST[ $newname ]  ? 'checked' : '' ;
            }else{
                $checked = $o['default'] ? 'checked' : '' ;
            };
            //$radios[] = "<input type='{$type}' name='{$newname}' id='{$id}'  value=\"{$o['value']}\"  {$checked} class='form_{$type}' ><label class='form_{$type}_text' onclick=\"fmgHandler.choice_clicked('{$id}');\" onmouseover=\"this.className='form_{$type}_text form_choice_over';\" onmouseout=\"this.className='form_{$type}_text form_choice_out';\">{$o['text']}</label><br>";
            $labelLeft = ''; //0 == $i ? '' : "<div class='form_field'>&nbsp;</div><div class='choice'>&nbsp;</div>" ; // spacer for text algin left
            
            $onclick = '' ;
            if( $showInputbox ){
                if( 'radio' == $type ){
                    $onclick = " onclick=\"toggleOtherInputBox('{$name}','{$type}', '{$id}')\" " ;
                }elseif ('checkbox' == $type && $i == $len - 1 ) {
                    $onclick = " onclick=\"toggleOtherInputBox('{$name}','{$type}', '{$id}')\" " ;
                    $o['value'] = 'other';
                };
                if( $isPost && $i == $len - 1 && $checked == 'checked' ){
                    $displayLast = '' ;
                    $o['value'] = 'other';
                    $checked = 'checked';
                };
            };
            
            //$onclick = ( $showInputbox && ('radio' == $type || 'checkbox' == $type && $i == $len - 1) ) ? " onclick=\"toggleOtherInputBox('{$name}','{$type}')\" " : "" ;
                         
            $radios[] = "{$labelLeft}<input type='{$type}' name='{$newname}' id='{$id}'  value=\"{$o['value']}\"  {$checked} class='form_{$type}' {$onclick} ><label class='form_choice_text' for='{$id}'>{$o['text']}</label><br>";
            $i ++ ;
        };
        
        $radios[] = "<input type='hidden' name='{$name}_length' value='{$len}'>" ;
        
        if( $showInputbox ){
            $radios[] = "<input type='hidden' name='{$name}_other_check' id='{$name}_other_check' value='" . ($displayLast==''? 1:0) . "'>" ;
            $radios[] = "<input type='text' name='{$other}' id='{$other}' value=\"" . HtmlSpecialChars($_POST[$other]) . "\" class='text_box' style='display:{$displayLast};' >" ; 
        };
    };
    $s = join("\t\n",$radios);
    //$s = "<div class='choices'>$s</div>";

    if( $isReturn )
        return $s;
    else
        echo $s ;
}




function phpfmg_radios( $name, $options, $showInputbox = false, $isReturn = false ){
    return phpfmg_choice( 'radio', $name, $options, $showInputbox, $isReturn );
}



function phpfmg_checkboxes( $name, $options, $showInputbox = false, $isReturn = false ){
    return phpfmg_choice( 'checkbox', $name, $options, $showInputbox, $isReturn );
}



function phpfmg_rename_harmful( $name ){
    //if( defined('PHPFMG_BLOCK_HARMFUL') && 'Y' == PHPFMG_BLOCK_HARMFUL ){
		$ext = strrchr(strtolower($name), '.');
		if( $ext !== false ){
            $n = strpos( strtolower(PHPFMG_HARMFUL_EXTS), $ext );
            if( $n !== false ){
                return $name . '.bak' ;
            };
        };
    //};
    
    return $name;
}


function phpfmg_redirect_js(){
    if( defined('PHPFMG_REDIRECT') && '' != PHPFMG_REDIRECT ){
        echo "<script type='text/javascript'>
            function phpfmg_redirect(){
                var redirect = '" . addslashes(PHPFMG_REDIRECT) . "';
                try{
                    if( parent ) parent.location.href = redirect;
                }catch(e){
                    location.href = redirect;
                };
            }
            
            phpfmg_redirect();
        </script>"; 
    };
}


if (!function_exists("htmlspecialchars_decode")) {
   function htmlspecialchars_decode($string, $quote_style = ENT_COMPAT) {
       return strtr($string, array_flip(get_html_translation_table(HTML_SPECIALCHARS, $quote_style)));
   }
}



function phpfmg_text_align(){
    $align = strtolower(defined('PHPFMG_TEXT_ALIGN') ? PHPFMG_TEXT_ALIGN : 'top');
    switch( $align ){
        case 'left' :
        case 'right' :

            $labelWidth = '158px';
            if( false !== strpos( strtolower($_SERVER['HTTP_USER_AGENT']), 'msie') ){
            # ----------- for IE -------
            $css = "
ol.phpfmg_form{
    width: 468px;
}

div.col_field, div.col_label{
    display:inline;
    float:left;
}

div.col_label{
    width:{$labelWidth};
    text-align: {$align};
}
";

            }else{
            
            # ----------- for Firefox -------
            $css = "
div.col_label{
    float:left;
    width:{$labelWidth};
    text-align: {$align};
}

div.col_field{ margin-left:{$labelWidth}; }
";
            }; // if
            break;

        case 'top' :
        default:
            $css = "";
            break;
    }; // switch
    
    echo $css;
}


function phpfmg_header( $title="", $keywords="", $description="" ){
    $t = "PHP FormMail Generator - A free tool to create ready-to-use web email forms with file upload, auto-response email, and dependent dropdowns.";
    $k = "PHP FormMail Generator, Free Form, Form Builder, Form Creator, phpFormMailGen, Customized Web Forms, phpFormMailGenerator,formmail.php, formmail.pl, formMail Generator, ASP Formmail, ASP form, PHP Form, Generator, phpFormGen, phpFormGenerator, anti-spam, web hosting";
    $d = "PHP formMail Generator - A tool to ceate ready-to-use web forms in a flash";
    $formOnly = isset($GLOBALS['formOnly']) && true === $GLOBALS['formOnly'];
if( !$formOnly ){    
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<head>
    <title><?php echo empty($title) ? $t : $title ; ?></title>
    <meta http-equiv="content-type" content="text/html; charset=<?php echo defined('PHPFMG_CHARSET') ? PHPFMG_CHARSET : 'UTF-8'; ?>">
    <meta name="keywords" content="<?php echo empty($keywords) ? $k : $keywords ; ?>">
    <meta name="description" content="<?php echo empty($description) ? $d : $description ; ?>">
    <meta name="generator" content="PHP Mail Form Generator, phpfmg.sourceforge.net">
</head>
<body>

<?php
};// !$formOnly 

phpfmg_form_css();

?>


<div class='form_description'>

</div>


<?php
}




function phpfmg_footer( $formOnly = false ){
?>

<div class='form_footer'>

</div>
<?php
    if( defined('PAYPAL_ID') && '' == PAYPAL_ID ){ 
?>

<?php
};// if

    $formOnly = isset($GLOBALS['formOnly']) && true === $GLOBALS['formOnly'];
    if( !$formOnly ){    
?>
    
</body>
</html>
<?php
    };// !$formOnly
    
     
}




function phpfmg_javascript( $sErr = '' ){
?>
<script type="text/javascript">
 /**
*
*  UTF-8 data encode / decode
*  http://www.webtoolkit.info/
*
**/
 
var Utf8 = {
 
	// public method for url encoding
	encode : function (string) {
		string = string.replace(/\r\n/g,"\n");
		var utftext = "";
 
		for (var n = 0; n < string.length; n++) {
 
			var c = string.charCodeAt(n);
 
			if (c < 128) {
				utftext += String.fromCharCode(c);
			}
			else if((c > 127) && (c < 2048)) {
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}
			else {
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}
 
		}
 
		return utftext;
	},
 
	// public method for url decoding
	decode : function (utftext) {
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;
 
		while ( i < utftext.length ) {
 
			c = utftext.charCodeAt(i);
 
			if (c < 128) {
				string += String.fromCharCode(c);
				i++;
			}
			else if((c > 191) && (c < 224)) {
				c2 = utftext.charCodeAt(i+1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			}
			else {
				c2 = utftext.charCodeAt(i+1);
				c3 = utftext.charCodeAt(i+2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}
 
		}
 
		return string;
	}
 
}

 function dd_change( n, max, prefix ){
    if( n >= max-1 )
        return; // the last dropdown, no need to query
    
    //var prefix = 'dd_' ;
    // reset all other dropdown options
    var next = n+1; 
    for( var i = next; i < max; i ++ ){
        var dd = document.getElementById(prefix +'_' + i );
        if( dd && dd.length >= 1 ) dd.length = 1 ; // keep the first one '- select -'
    };


    // request drop down data from server
    var me = this;
    var http;
    var isIE = navigator.appName == "Microsoft Internet Explorer";
    if(isIE){
        me.http = new ActiveXObject("Microsoft.XMLHTTP");
    }else{
        me.http = new XMLHttpRequest();
    };
    
    
    // build query string
    var lookup = [];
    for( var i = 0; i < next; i ++ ){
        var v = document.getElementById(prefix +'_' +  i ).value ; 
        lookup.push( "lookup[" + i + "]=" + escape( isIE ? Utf8.encode(v) : v ) );
    };
    lookup = lookup.join('&');
    
    var url = '<?php echo PHPFMG_ADMIN_URL . '?mod=dd&func=lookup&' ; ?>n='+next+ '&field_name=' + prefix + '&' + lookup;
    me.http.open('get', url);
    me.http.onreadystatechange = function(){
    
        if( me.http.readyState == 4 ){
            // rebuild the next dropdown options
            var eNext = document.getElementById(prefix +'_' + next );
            if( !eNext )
                return;
            
            var data = me.http.responseText;    
            var opts = String(data).split("\n");
            for( var j = 0, J = opts.length; j < J; j ++ ){
                eNext.options[ eNext.length ] = new Option( opts[j], opts[j], false, false );                
            }; // for
        }; //if
        
    }; 
    me.http.send(null);

 }
 
    
function PHPFMG( formID ){
    var frmID = formID;
    var exts = {
        'upload_control' : '<?php echo PHPFMG_UPLOAD_CONTROL; ?>',
        'harmful_exts'  : '<?php echo PHPFMG_HARMFUL_EXTS; ?>',
        'harmful_errmsg': "<?php echo addslashes(PHPFMG_HARMFUL_EXTS_MSG); ?>",
        'allow_exts'  : '<?php echo PHPFMG_ALLOW_EXTS; ?>',
        'allow_errmsg': "<?php echo addslashes(PHPFMG_ALLOW_EXTS_MSG); ?>"
    };

    var Form = null;
    var err_fields=null;
    
    function $( id ){
        return document.getElementById(id);
    }

    function get_form( id ){
        var frm = 'object' == typeof($(id)) ? $(id) : eval( 'document.' + id ) ;
        return frm ? frm : document.forms[0];
    }
    
    function file_ext( f ){
        var n = f.lastIndexOf(".");
        return -1 == n ? '' : f.substr( n ).toLowerCase();
    }
    
    function addLabelEvents(){
        var labels = document.body.getElementsByTagName('LABEL');
        for( var i = 0, N = labels.length; i < N; i ++ ){
            var e = labels[i];
            if( -1 != String(e.className).indexOf('form_choice_text') ){
                var oid = e.getAttribute('oid'); 
                if( !oid ) continue;

                e.onmouseout = function(){ this.className = 'form_choice_text'; };
                e.onmouseover = function(){ this.className = 'form_choice_text form_choice_over'; };
                e.onclick = function(){
                    try{
                        var oid = this.getAttribute('oid'); 
                        var O = document.getElementById(oid);
                        O.checked = !O.checked;
                    }
                    catch(E){};
                };
            }; // if
        }; // for
    } 


    function addFieldBlockEvents(){
        var divs = document.body.getElementsByTagName('DIV');
        for( var i = 0, N = divs.length; i < N; i ++ ){
            var e = divs[i];
            if( -1 != String(e.className).indexOf('field_block') ){
                e.onmouseout = function(){  if( String(this.className).indexOf('form_error_highlight') == -1 ) this.className = 'field_block'; };
                e.onmouseover = function(){ if( String(this.className).indexOf('form_error_highlight') == -1 ) this.className = 'field_block field_block_over'; };
            }; // if
        }; // for
    } 

    function removeHighlight( elements ){
        var divs = typeof(elements) == 'object' ? elements : document.body.getElementsByTagName('DIV');
        for( var i = 0, N = divs.length; i < N; i ++ ){
            var e = divs[i];
            var cn = String(e.className);
            if( -1 != cn.indexOf('form_error_highlight') ){
                e.className = cn.replace('form_error_highlight','');
            }; // if
        }; // for
    } 
    
    function showProcessing(){
        try{
            var E = $('phpfmg_processing');
            if( !E ) return ;
            if( -1 != navigator.userAgent.toLowerCase().indexOf('msie') ){
                E.style.backgroundColor='#2960AF';
                $('phpfmg_processing_gif').style.display = 'none';
                setInterval( 'fmgHandler.dots()', 380 );
            };
            E.style.display = '' ;
        }catch(e){};
        
    }
    
    
    this.highlight_fields = function( fields ){
        var A = fields.split(',');
        for( var i = 0, N = A.length; i < N; i ++ ){
            var E = $( A[i] + '_div' );
            if( E ){
                E.className += ' form_error_highlight'; 
            };
            var T = $( A[i] + '_tip' );
            if( T ){
                T.className += ' instruction_error'; 
            };
        };
        
        if( A.length > 0 ) {
            $('err_required').style.display= has_entry( fields ) ? 'none' : '';
        };
    }
    
    function has_entry( fields ){
        var div = $('one_entry_msg'); 
        if( !div )
            return false;

        div.style.display = fields.indexOf('phpfmg_found_entry') != -1 ? '' : 'none';
        if( typeof(found_entry) != 'undefined' ){
            div.innerHTML = div.innerHTML.replace(/%Entry%/gi,found_entry);
            return true;
        };
        
        return false ;
    }
    
    
    this.choice_clicked = function( id ){
        $(id).checked = !$(id).checked ;
    }
    
    
    this.init = function(){
        //addLabelEvents();
        addFieldBlockEvents();
    }

    this.harmful = function(e){
        if( 'deny' != exts['upload_control'] || e.value == '' ){
            return true; 
        };
        
        var div = $(e.id+'_div');
        removeHighlight( [div] );
        var ext = file_ext(e.value);
        if( -1 != exts['harmful_exts'].toLowerCase().indexOf(ext) ){
            this.highlight_fields(e.id);
            alert( exts['harmful_errmsg'] );
            return false ;
        };
        return true;
    }
    
     
        
    this.is_allow = function(e){
        if( 'allow' != exts['upload_control'] || e.value == '' ){
            return true; 
        };
        
        var div = $(e.id+'_div');
        removeHighlight( [div] );
        var ext = file_ext(e.value);
        if( -1 == exts['allow_exts'].toLowerCase().indexOf(ext) ){
            this.highlight_fields(e.id);
            alert( exts['allow_errmsg'] );
            return false ;
        };
        return true;
    } 

    this.check_upload = function(e){
        if( '' == exts['upload_control'] )
            return true;
        else
            return ( 'deny' == exts['upload_control'] ) 
                   ? this.harmful(e) 
                   : this.is_allow(e);
    }

    this.dots = function(){
        $('phpfmg_processing_dots').innerHTML += '.';
		if( $('phpfmg_processing_dots').innerHTML.length >= 38 ) {
			$('phpfmg_processing_dots').innerHTML = '.';
		};
    }
    
    this.check_fields = function(){
        if( !Form )
            return true ;

        var pass = true ;
        for( var i=0, n=Form.elements.length; i < n ; i ++ ){
          var field = Form.elements[i];
          var type = field.length != undefined && field.type == undefined ? 'radio' : field.type ;
          switch( type.toLowerCase() ){
            case 'file':
                pass = this.check_upload(field);
                break;
          };
          if( !pass ) return false ;
        };
        
        return true;
    }
    
    this.onsubmit = function( form ){
        Form = form ? form : get_form(frmID) ;
        if( !this.check_fields() )
            return false ;
            
        showProcessing();
        return true;
    }
    
}

function toggleOtherInputBox( name, type, id ){
    var field = document.getElementById(id);
    if( !field ) return ;
    var box = document.getElementById(name+'_other');
    var other_check = document.getElementById(name+'_other_check'); 
    if( !box || !other_check ) return ;
    
    switch( type.toLowerCase() ){
        case 'checkbox':
            box.style.display = field.checked ? '' : 'none';
            other_check.value = field.checked ? 1 : 0 ; 
            break;
        case 'radio':
            for( var i=0,n=document.forms.length; i < n; i ++ ){
                try{
                    var r = eval( 'document.forms['+i+'].'+name );
                    if( r ){
                        box.style.display = r[r.length-1].checked ? '' : 'none';
                        other_check.value = r[r.length-1].checked ? 1 : 0 ; 
                    };
                }catch(err){};
            };
            break;
        case 'select':
            box.style.display = field.options[field.options.length-1].selected ? '' : 'none';
            other_check.value = field.options[field.options.length-1].selected ? 1 : 0 ;
            break;
    };
    
}



var fmgHandler = new PHPFMG();
fmgHandler.init();

<?php
if( isset($sErr['fields']) ){
    if( isset($GLOBALS['OneEntry']) ) echo "\nvar found_entry=\"" . addslashes($GLOBALS['OneEntry']). "\";\n" ;
    echo"
    location.href='#error'; 
    fmgHandler.highlight_fields('" . join(',',$sErr['fields']) ."');
    ";
};
?>

</script>
<?php
} // end of function
?>
<?php

// The form configuration text file in base64 encoding. You can delete it if you want.
function phpfmg_formini(){
    return "ZXNoX2Zvcm1tYWlsX2RvbWFpbm5hbWUJCmVzaF9mb3JtbWFpbF9kZXNjcmlwdGlvbgkKZXNoX2Zvcm1tYWlsX2Zvb3RlcgkKZXNoX2Zvcm1tYWlsX2ZpZWxkX251bXMJMTAKZXNoX2Zvcm1tYWlsX3JlY2lwaWVudAlpbmZvQGJpZ2lkZWFzdXBwbHkuY29tCmVzaF95b3VyX25hbWUJCmVzaF9mb3JtbWFpbF9jYwlyYnJ1Y2VwYWdlQHlhaG9vLmNvbQplc2hfZm9ybW1haWxfYmNjCQplc2hfZm9ybW1haWxfc3ViamVjdAlMZXQncyBjb25uZWN0CmVzaF9tYWlsX3R5cGUJaHRtbAplc2hfZm9ybW1haWxfcmVkaXJlY3QJCmVzaF9mb3JtbWFpbF9yZXR1cm5fZW1haWwJCmVzaF9mb3JtbWFpbF9yZXR1cm5fbXNnCURlYXIgJVRpdGxlT2ZTZW5kZXIlICVOYW1lT2ZTZW5kZXIlLDwhLS1lc2hfbmV3bGluZS0tPjwhLS1lc2hfbmV3bGluZS0tPlRoYW5rcyBmb3IgcmVhY2hpbmcgb3V0LiBJJ3ZlIHJlY2VpdmVkIHlvdXIgbWVzc2FnZSBhbmQgd2lsbCBiZSBpbiB0b3VjaCBzb29uLjwhLS1lc2hfbmV3bGluZS0tPiVEYXRhT2ZGb3JtJTwhLS1lc2hfbmV3bGluZS0tPjwhLS1lc2hfbmV3bGluZS0tPlJlZ2FyZHMsPCEtLWVzaF9uZXdsaW5lLS0+QnJ1Y2U8IS0tZXNoX25ld2xpbmUtLT48IS0tZXNoX25ld2xpbmUtLT5JUDogJUlQJTwhLS1lc2hfbmV3bGluZS0tPkRhdGU6ICVEYXRlJTwhLS1lc2hfbmV3bGluZS0tPlRpbWU6ICVUaW1lJTwhLS1lc2hfbmV3bGluZS0tPlJlZmVyZW5jZSBJRDogJUF1dG9JRCU8IS0tZXNoX25ld2xpbmUtLT48IS0tZXNoX25ld2xpbmUtLT5XZWJzaXRlOiAlSFRUUF9IT1NUJTwhLS1lc2hfbmV3bGluZS0tPkZvcm0gUGFnZTogJUZvcm1QYWdlTGluayU8IS0tZXNoX25ld2xpbmUtLT5SZWZlcmVyOiAlSFRUUF9SRUZFUkVSJTwhLS1lc2hfbmV3bGluZS0tPgplc2hfZm9ybW1haWxfY29uZmlybV9tc2cJWW91ciBtZXNzYWdlIGhhcyBiZWVuIHNlbnQuIFRoYW5rcyBtdWNoISBJJ2xsIGdldCBiYWNrIHRvIHlvdSBzb29uLgplc2hfZm9ybW1haWxfcmV0dXJuX3N1YmplY3QJVGhhbmtzIGZvciBjb250YWN0aW5nIFRoZSBCaWcgSWRlYSBTdXBwbHkgQ29tcGFueQplc2hfcmV0dXJuX25vX2F0dGFjaG1lbnQJCmVzaF9tYWlsX3RlbXBsYXRlCVlvdSBnb3QgbWFpbCBmcm9tICVUaXRsZU9mU2VuZGVyJSAlTmFtZU9mU2VuZGVyJS48IS0tZXNoX25ld2xpbmUtLT48IS0tZXNoX25ld2xpbmUtLT5IZXJlIGlzIHRoZSBmb3JtIGRhdGE6PCEtLWVzaF9uZXdsaW5lLS0+JURhdGFPZkZvcm0lPCEtLWVzaF9uZXdsaW5lLS0+PCEtLWVzaF9uZXdsaW5lLS0+V2h1dD88IS0tZXNoX25ld2xpbmUtLT5ZbyBNYW1tYTwhLS1lc2hfbmV3bGluZS0tPjwhLS1lc2hfbmV3bGluZS0tPklQOiAlSVAlPCEtLWVzaF9uZXdsaW5lLS0+RGF0ZTogJURhdGUlPCEtLWVzaF9uZXdsaW5lLS0+VGltZTogJVRpbWUlPCEtLWVzaF9uZXdsaW5lLS0+UmVmZXJlbmNlIElEOiAlQXV0b0lEJTwhLS1lc2hfbmV3bGluZS0tPjwhLS1lc2hfbmV3bGluZS0tPldlYnNpdGU6ICVIVFRQX0hPU1QlPCEtLWVzaF9uZXdsaW5lLS0+Rm9ybSBQYWdlOiAlRm9ybVBhZ2VMaW5rJTwhLS1lc2hfbmV3bGluZS0tPlJlZmVyZXI6ICVIVFRQX1JFRkVSRVIlPCEtLWVzaF9uZXdsaW5lLS0+CmVzaF9mb3JtbWFpbF9jaGFyc2V0CQplc2hfYWN0aW9uCW1haWxhbmRmaWxlCmVzaF9vbmVfZW50cnkJCmVzaF9vbmVfZW50cnlfbWV0aG9kCQplc2hfb25lX2VudHJ5X21zZwlXZSBmb3VuZCB5b3VyICVFbnRyeSUgaW4gb3VyIHJlY29yZHMuIE11bHRpcGxlIHN1Ym1pc3Npb25zIG5vdCBhY2NlcHRlZC4KZXNoX3RleHRfYWxpZ24JbGVmdAplc2hfc2F2ZUF0dGFjaG1lbnRzCQplc2hfbm9fZnJvbV9oZWFkZXIJCmVzaF9zZWN1cml0eV9pbWFnZQlZCmVzaF91c2VfcmVjYXB0Y2hhCQpzZW5kbWFpbF9mcm9tCQpzZW5kbWFpbF9mcm9tMgkKZXNoX3VzZV9waHBtYWlsZXIJWQplc2hfdXNlX3NtdHAJCmVzaF9zbXRwX2hvc3QJCmVzaF9zbXRwX3VzZXIJCmVzaF9zbXRwX3Bhc3N3b3JkCQplc2hfc210cF9wb3J0CQplc2hfc210cF9zZWN1cml0eQkKZXNoX3NtdHBfZGVidWdfbGV2ZWwJCmVzaF9ibG9ja19oYXJtZnVsCQplc2hfaGFybWZ1bF9leHRzCS5waHAsIC5odG1sLCAuY3NzLCAuanMsIC5leGUsIC5jb20sIC5iYXQsIC52YiwgLnZicywgc2NyLCAuaW5mLCAucmVnLCAubG5rLCAucGlmLCAuYWRlLCAuYWRwLCAuYXBwLCAuYmFzLCAuY2htLCAuY21kLCAuY3BsLCAuY3J0LCAuY3NoLCAuZnhwLCAuaGxwLCAuaHRhLCAuaW5zLCAuaXNwLCAuanNlLCAua3NoLCAuTG5rLCAubWRhLCAubWRiLCAubWRlLCAubWR0LCAubWR3LCAubWR6LCAubXNjLCAubXNpLCAubXNwLCAubXN0LCAub3BzLCAucGNkLCAucHJmLCAucHJnLCAucHN0LCAuc2NmLCAuc2NyLCAuc2N0LCAuc2hiLCAuc2hzLCAudXJsLCAudmJlLCAud3NjLCAud3NmLCAud3NoCmVzaF9hbGxvd19leHRzCS5qcGcsIC5naWYsIC5wbmcsIC5ibXAKZXNoX3VwbG9hZF9jb250cm9sCQplc2hfYW50aV9ob3RsaW5raW5nCQplc2hfcmVmZXJlcnNfYWxsb3cJCmVzaF9yZWZlcmVyc19kZW5pZWRfbXNnCQplc2hfZmlsZTJsaW5rX3NpemUJCmZpcnN0IG5hbWUJZmllbGRfMAlTZW5kZXJGaXJzdE5hbWUJCVJlcXVpcmVkCWZpcnN0IG5hbWUKbGFzdCBuYW1lCWZpZWxkXzEJU2VuZGVyTGFzdE5hbWUJCQlsYXN0IG5hbWUKZW1haWwgYWRkcmVzcwlmaWVsZF8yCVNlbmRlcidzIGVtYWlsCQlSZXF1aXJlZAllbWFpbAptZXNzYWdlCWZpZWxkXzUJVGV4dEFyZWEJCVJlcXVpcmVkCW1lc3NhZ2UuLi4Kd2Vic2l0ZQlmaWVsZF8zCVRleHQJCQl3ZWJzaXRlIHVybApjb21wYW55CWZpZWxkXzQJVGV4dAkJCWNvbXBhbnkgbmFtZQo=";
}

?>