<?php
error_reporting(E_ALL | E_STRICT); 
ini_set('display_errors', 1);
//ini_set('open_basedir','none');
//ini_set('mysql.connect_timeout', 28802);
//ini_set('default_socket_timeout', 28802);
ini_set("memory_limit", "1024M"); 
//ini_set("max_execution_time", 1000);
set_time_limit(0);

ini_set('display_errors','1');
ini_set('interactive_timeout', 28800);
ini_set('wait_timeout', 128800);
ini_set('mysql.connect_timeout', 6060);
ini_set('memory_limit','20500M');
//ini_set('mysql.allow_persistent', true);
date_default_timezone_set('America/Chicago');


$conn = mysql_connect('localhost','glesch1','3Mes$hlYzp2e');
mysql_select_db('glesch1_checkhpd',$conn);

if ( !function_exists('sys_get_temp_dir')) {
  function sys_get_temp_dir() {
      if( $temp=getenv('TMP') )        return $temp;
      if( $temp=getenv('TEMP') )        return $temp;
      if( $temp=getenv('TMPDIR') )    return $temp;
      $temp=tempnam(__FILE__,'');
      if (file_exists($temp)) {
          unlink($temp);
          return dirname($temp);
      }
      return null;
  }
 }

function cronmailsent($state,$hn,$id,$message)
{
$to = "pajany@sdi.la";
$from = "pajany@sdi.la";
$subject = "Crawler cron Mail";
 $headers  = "From: $from\r\n";
 $headers .= "Content-type: text/html\r\n";
 if(mail($to, $subject, $message, $headers))
   echo "==>mailsend";
}


function sent_mail($message,$attachement,$subject) {

$mail = new PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch

try {
  $from = "admin@sdi.la";
  $to = "glesch1@aol.com";  //glesch1@aol.com,
 
  $value = $attachement;
  
  
  $today = date("F j, Y, g:i a");
  
  
  
  
//  $toadd1=explode(',',$to);
 // foreach($toadd1 as $toaddress)
  //{
	//  $mail->AddAddress($toaddress);
  //}

  $mail->AddAddress($to);
  $mail->AddAddress("pajany@sdi.la");
  $mail->AddAddress("administrator@cedreporting.com");
  
  $mail->AddReplyTo($from);
  
  $mail->SetFrom($from);
  
  $mail->AddAttachment($value);
  
  $mail->Subject = $subject;
  
  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
  
   $mail->Body = $message;

  $mail->Send();
  echo '<response><result type="success">Success</result>
<message></message>
</response>';
} catch (phpmailerException $e) {
   //Pretty error messages from PHPMailer
   echo '<response><result type="failure">Failure</result>
<message></message>
</response>';
} catch (Exception $e) {
  //Boring error messages from anything else!
   echo '<response><result type="failure">Failure</result>
<message></message>
</response>';
}

}

function fetchdetails($sql,$boroname)
{
	$retArray = '';
	$result  = mysql_query($sql);
	for ($i = 0; $i < mysql_num_rows($result); $i++) {
	    $retArray[$i] = mysql_fetch_assoc($result);
		array_unshift($retArray[$i],$boroname,"New-York");
	}
	return $retArray;
}


?>