<?php
session_start();
ob_start();
require_once 'PHPMailer/class.phpmailer.php';
include_once("config.php");
ini_set('memory_limit','20500M');




$fieldArray = Array ('Boro','State','House Number','Street','Zip Code','Complaint Date','Complaint','SR','Apt','Complaint Condition','Condtion Detail','Location');



/* CH Bronx */

$filename_bronx = "Bronx_Complaint_History.csv";
$file = fopen($filename_bronx,"w+");
fputcsv($file,$fieldArray);

$sql2="SELECT house_number,Street,zipcode,Complaint_Date,Complaint,SR,Apt,Complaint_Condition,Condtion_Detail,Location
FROM `CH_Bronx` where Complaint_Date!=''";
$dataArray2 = fetchdetails($sql2,'Bronx');
if($dataArray2!='')
{
	foreach ($dataArray2 as $line) {	
	    fputcsv($file,$line);
	}
}
$message = "Bronx Complaint History Data on " . date('Y-m-d');
$subject = "Bronx Complaint History Data on " . date('Y-m-d');
sent_mail($message,$filename_bronx,$subject);
fclose($file);
unlink($filename_bronx);

/* ENDS CH Bronx */


$sql = "select Cron_status from Cronstatus where Contenttype = 'CH' and State='Bronx' and Cron_status='S'";
$rs_sql = mysql_query($sql);
$count = mysql_num_rows($rs_sql);
if($count > 0) {
	
	mysql_query("update Cronstatus set StateId='',Cron_status='F',HouseNumber='',Street='',updated_time=now() where Contenttype='CH' and State='Bronx'");
	echo mysql_query("delete from CH_Bronx");

}
?>
