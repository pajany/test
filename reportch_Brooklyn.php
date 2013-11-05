<?php
session_start();
ob_start();
require_once 'PHPMailer/class.phpmailer.php';
include_once("config.php");
ini_set('memory_limit','20500M');




$fieldArray = Array ('Boro','State','House Number','Street','Zip Code','Complaint Date','Complaint','SR','Apt','Complaint Condition','Condtion Detail','Location');


/* CH Brooklyn */
$filename_brooklyn = "Brooklyn_Complaint_History.csv";
$file = fopen($filename_brooklyn,"w+");
fputcsv($file,$fieldArray);

$sql3="SELECT house_number,Street,zipcode,Complaint_Date,Complaint,SR,Apt,Complaint_Condition,Condtion_Detail,Location
FROM `CH_Brooklyn` where Complaint_Date!=''";
$dataArray3 = fetchdetails($sql3,'Brooklyn');
if($dataArray3!='')
{
	foreach ($dataArray3 as $line) {	
	    fputcsv($file,$line);
	}
}
$message = "Brooklyn Complaint History Data on " . date('Y-m-d');
$subject = "Brooklyn Complaint History Data on " . date('Y-m-d');
sent_mail($message,$filename_brooklyn,$subject);
fclose($file);
unlink($filename_brooklyn);
/* ENDS CH Brooklyn */

$sql = "select Cron_status from Cronstatus where Contenttype = 'CH' and State='Brooklyn' and Cron_status='S'";
$rs_sql = mysql_query($sql);
$count = mysql_num_rows($rs_sql);
if($count > 0) {
	
	mysql_query("update Cronstatus set StateId='',Cron_status='F',HouseNumber='',Street='',updated_time=now() where Contenttype='CH' and State='Brooklyn'");
	mysql_query("delete from CH_Brooklyn");

}


?>
