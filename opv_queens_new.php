<?php
//echo phpinfo();
include_once("config.php");
//set_time_limit(50000);


$status_query = mysql_query("select * from Cronstatus where State='Queens' and Contenttype = 'OPV' order by Id desc limit 1");
$statusrow = mysql_fetch_array($status_query);
$cron_count = mysql_num_rows($status_query);
$cronstatus  = $statusrow['Cron_status'];
$cronid      = $statusrow['Id'];
$contenttype = $statusrow['Contenttype'];
$state_failed = $statusrow['State'];
$street_failed = $statusrow['Street'];
$housenumber_failed = $statusrow['HouseNumber'];
$aid_failed  = $statusrow['StateId'];
$crondate   = $statusrow['Date'];
$updated_time   = strtotime($statusrow['updated_time']);
$current_time = date('Y-m-d H:i:s');
$current_time_convert = strtotime($current_time);
$interval_min = round(abs($current_time_convert - $updated_time) / 60,2);
echo $interval_min;
echo $cronstatus;


if($interval_min >=  10 || $cronstatus == 'F' ) {

$today = date('Y-m-d');
$lastrowquery = "select Street,house_number,aid from Queens order by aid desc limit 0,1";
$lastrow_result = mysql_query($lastrowquery);
$lastrow   = mysql_fetch_assoc($lastrow_result);
$lastrowst = $lastrow['Street'];
$lastrowhn = $lastrow['house_number'];
$lastaid   = $lastrow['aid'];
$where_clause = '';
$where_clause = " where aid> '".$aid_failed."' and  CHARACTER_LENGTH(Street) > 4";
$manhattan_query = "select aid,house_number,Street from Queens $where_clause order by aid asc";
$query_result = mysql_query($manhattan_query);
$num_rows = mysql_num_rows($query_result);

if($num_rows > 0) {
while($result_row_fetch = mysql_fetch_array($query_result)) {
     $result_row_main[] = $result_row_fetch;
}

$k=1;
foreach($result_row_main as $result_row) 
{



	
	

	$k++;

          $nvpreq='__EVENTTARGET=&__EVENTARGUMENT=&__LASTFOCUS=&__VIEWSTATE=%2FwEPDwUJLTExODE2NzA0D2QWAgIBD2QWAgIBD2QWBmYPZBYCZg9kFgJmD2QWAgIBD2QWBGYPZBYCZg9kFgICAQ9kFgRmD2QWBGYPZBYCAgEPDxYCHgRUZXh0ZWRkAgIPZBYCAgEPDxYCHwAFCDIvNi8yMDEzZGQCAQ9kFgQCAQ9kFgICAQ8PFgIfAAUmSFBEIEJ1aWxkaW5nLCBSZWdpc3RyYXRpb24gJiBWaW9sYXRpb25kZAICD2QWBAIBDxBkZBYBZmQCAw8PFgIeB1Zpc2libGVoZGQCAQ9kFgJmD2QWAgIBDxYCHwFoZAICD2QWAmYPZBYGAgEPZBYEZg9kFgYCAQ9kFgQCAQ8PFgIfAWhkZAIEDw8WBB8AZR8BaGRkAgIPZBYEAgEPDxYCHwFoZGQCBA8PFgQfAGUfAWhkZAIDD2QWAgIFDxBkZBYBZmQCAQ9kFgJmD2QWAgIBDw8WAh8AZWRkAgMPDxYCHwAFlwI8YnIgLz48YnIgLz5Db250ZXh0LlJlcXVlc3QuVXNlckhvc3RBZGRyZXNzID0gMTAuMjAxLjI1NC4xMzA8YnI%2BIE9sZCBQb3J0YWwgSVA9CTEwLjIwMS4yNTQuMTM3IDxicj4gUG9ydGFsIElQPQkgICAgMTAuMjAxLjI1NC4xMzAgPGJyPlJlc3VsdCBvZiBnZXRfc2VydmVyPWV4dHJhbmV0PGJyPlBvcnRhbElQID0gMTAgMjAxIDI1NCAxMzAgPGJyPkludHJhbmV0SVAgPSAxMCAyMjYgOCAwIDxCUj5JbnRyYW5ldE1hc2sgPSAyNTUgMjU1IDI0OCAwIDxicj5Ib3N0ID0gMTAgMjAxIDI1NCAxMzBkZAIFDw8WAh8AZWRkAgMPZBYCZg9kFgICAQ9kFgJmD2QWAmYPZBYEZg8PFgIfAWhkZAICDzwrAAsAZGREVBj5bfCOVV9s%2BJuOsA19fhFl3P9H4B0PF4OtHOp9EQ%3D%3D&__EVENTVALIDATION=%2FwEWFgKB7c3YAQLF0d78BQLVvvSSCQLOvvSSCQLPvvSSCQLMvvSSCQLLvvSSCQLz1PvRDAKzi9SXDgKyi9SXDgKxi9SXDgKwi9SXDgK3i9SXDgLc1arCDgL7nPiqBwLR1viaCQKtkuWiCgK8kOykDQLco6BmAqSg56wBAq%2Fj%2BYkIAt65iBt0WGCOyhJNeXRRbez27HMXNRRVcrg7u60LktEILNk8Og%3D%3D&mymaintable%3AddlServices=0&mymaintable%3Ahf_UserStatus=&ddlBoro=4&txtHouseNo='.$result_row['house_number'].'&txtStreet='.urlencode($result_row['Street']).'&SearchButton=Search&RadioStrOrBlk=Street&hf_phn=&hf_street=&hf_boro=&hf_UserStatus=';
	//$nvpreq='__EVENTTARGET=&__EVENTARGUMENT=&__LASTFOCUS=&__VIEWSTATE=/wEPDwUJLTExODE2NzA0D2QWAgIBD2QWAgIBD2QWBmYPZBYCZg9kFgJmD2QWAgIBD2QWBGYPZBYCZg9kFgICAQ9kFgRmD2QWBGYPZBYCAgEPDxYCHgRUZXh0ZWRkAgIPZBYCAgEPDxYCHwAFCDIvNi8yMDEzZGQCAQ9kFgQCAQ9kFgICAQ8PFgIfAAUmSFBEIEJ1aWxkaW5nLCBSZWdpc3RyYXRpb24gJiBWaW9sYXRpb25kZAICD2QWBAIBDxBkZBYBZmQCAw8PFgIeB1Zpc2libGVoZGQCAQ9kFgJmD2QWAgIBDxYCHwFoZAICD2QWAmYPZBYGAgEPZBYEZg9kFgYCAQ9kFgQCAQ8PFgIfAWhkZAIEDw8WBB8AZR8BaGRkAgIPZBYEAgEPDxYCHwFoZGQCBA8PFgQfAGUfAWhkZAIDD2QWAgIFDxBkZBYBZmQCAQ9kFgJmD2QWAgIBDw8WAh8AZWRkAgMPDxYCHwAFlwI8YnIgLz48YnIgLz5Db250ZXh0LlJlcXVlc3QuVXNlckhvc3RBZGRyZXNzID0gMTAuMjAxLjI1NC4xMzA8YnI+IE9sZCBQb3J0YWwgSVA9CTEwLjIwMS4yNTQuMTM3IDxicj4gUG9ydGFsIElQPQkgICAgMTAuMjAxLjI1NC4xMzAgPGJyPlJlc3VsdCBvZiBnZXRfc2VydmVyPWV4dHJhbmV0PGJyPlBvcnRhbElQID0gMTAgMjAxIDI1NCAxMzAgPGJyPkludHJhbmV0SVAgPSAxMCAyMjYgOCAwIDxCUj5JbnRyYW5ldE1hc2sgPSAyNTUgMjU1IDI0OCAwIDxicj5Ib3N0ID0gMTAgMjAxIDI1NCAxMzBkZAIFDw8WAh8AZWRkAgMPZBYCZg9kFgICAQ9kFgJmD2QWAmYPZBYEZg8PFgIfAWhkZAICDzwrAAsAZGREVBj5bfCOVV9s+JuOsA19fhFl3P9H4B0PF4OtHOp9EQ==&__EVENTVALIDATION=/wEWFgKB7c3YAQLF0d78BQLVvvSSCQLOvvSSCQLPvvSSCQLMvvSSCQLLvvSSCQLz1PvRDAKzi9SXDgKyi9SXDgKxi9SXDgKwi9SXDgK3i9SXDgLc1arCDgL7nPiqBwLR1viaCQKtkuWiCgK8kOykDQLco6BmAqSg56wBAq/j+YkIAt65iBt0WGCOyhJNeXRRbez27HMXNRRVcrg7u60LktEILNk8Og==&mymaintable%3AddlServices=0&mymaintable%3Ahf_UserStatus=&ddlBoro=1&txtHouseNo='.$result_row['house_number'].'&txtStreet='.urlencode($result_row['Street']).'&SearchButton=Search&RadioStrOrBlk=Street&hf_phn=&hf_street=&hf_boro=&hf_UserStatus=';
/*$nvpreq ='__EVENTTARGET=&__EVENTARGUMENT=&__LASTFOCUS=&__VIEWSTATE=%2FwEPDwUKLTE1NzI2NjUwNQ9kFgICAQ9kFgICAQ9kFgZmD2QWAmYPZBYCZg9kFgICAQ9kFgRmD2QWAmYPZBYCAgEPZBYEZg9kFgRmD2QWAgIBDw8WAh4EVGV4dGVkZAICD2QWAgIBDw8WAh8ABQk2LzI2LzIwMTJkZAIBD2QWBAIBD2QWAgIBDw8WAh8ABSZIUEQgQnVpbGRpbmcsIFJlZ2lzdHJhdGlvbiAmIFZpb2xhdGlvbmRkAgIPZBYEAgEPEGRkFgFmZAIDDw8WAh4HVmlzaWJsZWhkZAIBD2QWAmYPZBYCAgEPFgIfAWhkAgEPZBYCZg9kFgYCAQ9kFgRmD2QWBgIBD2QWBAIBDw8WAh8BaGRkAgQPDxYEHwBlHwFoZGQCAg9kFgQCAQ8PFgIfAWhkZAIEDw8WBB8AZR8BaGRkAgMPZBYCAgUPEGRkFgFmZAIBD2QWAmYPZBYCZg8PFgIfAGVkZAIDDw8WAh8ABZcCPGJyIC8%2BPGJyIC8%2BQ29udGV4dC5SZXF1ZXN0LlVzZXJIb3N0QWRkcmVzcyA9IDEwLjIwMS4yNTQuMTMwPGJyPiBPbGQgUG9ydGFsIElQPQkxMC4yMDEuMjU0LjEzNyA8YnI%2BIFBvcnRhbCBJUD0JICAgIDEwLjIwMS4yNTQuMTMwIDxicj5SZXN1bHQgb2YgZ2V0X3NlcnZlcj1leHRyYW5ldDxicj5Qb3J0YWxJUCA9IDEwIDIwMSAyNTQgMTMwIDxicj5JbnRyYW5ldElQID0gMTAgMjI2IDggMCA8QlI%2BSW50cmFuZXRNYXNrID0gMjU1IDI1NSAyNDggMCA8YnI%2BSG9zdCA9IDEwIDIwMSAyNTQgMTMwZGQCBQ8PFgIfAGVkZAICD2QWAmYPZBYCAgEPZBYCZg9kFgJmD2QWBGYPDxYCHwFoZGQCAg88KwALAGRkpmKorFI%2BxfAwETwckEnhZouu8vwb0jeh3Jwvfio2KOM%3D&__EVENTVALIDATION=%2FwEWFgKUqMD%2FBgLF0d78BQLVvvSSCQLOvvSSCQLPvvSSCQLMvvSSCQLLvvSSCQLz1PvRDAKzi9SXDgKyi9SXDgKxi9SXDgKwi9SXDgK3i9SXDgLc1arCDgL7nPiqBwLR1viaCQKtkuWiCgK8kOykDQLco6BmAqSg56wBAq%2Fj%2BYkIAt65iBuza56SJ8t5dTMhADdG3SqdCD9C9r3j2Fo%2BMoRbOjyw7w%3D%3D&mymaintable%3AddlServices=0&mymaintable%3Ahf_UserStatus=&ddlBoro=1&txtHouseNo='.$result_row['house_number'].'&txtStreet='.urlencode($result_row['Street']).'&SearchButton=Search&RadioStrOrBlk=Street&hf_phn=&hf_street=&hf_boro=&hf_UserStatus=&rand='.rand();*/



    $curlcontent1 = '';
	
    $ch1 = curl_init();
	$filename = 'cookies.txt';
    if (file_exists($filename)) 
           unlink($filename);
		
		
    //$cookie = tempnam ("/tmp", "CURLCOOKIE");
    curl_setopt( $ch1, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/13.10.1" );
    curl_setopt( $ch1, CURLOPT_URL, "http://167.153.4.70/HPDonline/provide_address.aspx" );
	curl_setopt($ch1, CURLOPT_COOKIEFILE, $filename);
    curl_setopt( $ch1, CURLOPT_COOKIEJAR, $filename );
    curl_setopt( $ch1, CURLOPT_FOLLOWLOCATION, true );
    curl_setopt( $ch1, CURLOPT_ENCODING, "" );
    curl_setopt( $ch1, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch1, CURLOPT_AUTOREFERER, true );
    curl_setopt( $ch1, CURLOPT_CONNECTTIMEOUT, 0 );
    curl_setopt( $ch1, CURLOPT_TIMEOUT, 0  );
    curl_setopt( $ch1, CURLOPT_MAXREDIRS, 10 );
	curl_setopt($ch1, CURLOPT_POST, 1);
	curl_setopt($ch1,CURLOPT_POSTFIELDS,$nvpreq);
	$curlcontent1 = curl_exec($ch1);
	$curlinfo = curl_getinfo($ch1);
	curl_close ($ch1); //die();
	echo "intiated";
	print_r($curlinfo);
	
	

	

	
	
if($curlinfo['url']!='http://167.153.4.70/HPDonline/provide_address.aspx')
{
	
	//ch2
	$post_array = array(
	'__EVENTTARGET' => 'lbtnAllOpenViol',
    '__EVENTARGUMENT' => '',
    '__LASTFOCUS' => '',
    '__VIEWSTATE' => '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',
    '__EVENTVALIDATION' => '/wEWJwL7mpDfAwLF0d78BQLVvvSSCQLOvvSSCQLPvvSSCQLMvvSSCQLLvvSSCQLz1PvRDAKavNWaBQKU/eSsDQK1+ML+DgKJq4jPBgL1uZHnBAKZtcPhCgKh+aagDQLt6K3CDwLBot+1CQLL9aigCQKB27OaCAL5gKtvAtapjJkJAtGRgfAJArio69AOAsfW3dQHAtaT+IoDArff69AHArDTmugKAu2z2K4HApmv9qICAsroxfsNAtmRpyMChP6zjAkCqNOa6AoCpdOa6AoCptOa6AoCr+P5iQgCsPiL0AYC7PzimQIC8cKj+gtxrJtcOTvyrVoyqj3hz4QiSL83hhih0btwAZ4psyqM1g==',
    'mymaintable:ddlServices' => '0',
    'mymaintable:hf_UserStatus' => '',
    'server' => '',
    'hf_boronum' => '',
    'hf_report_name' => '0',
    'hf_server' =>'', 
    'hf_classI' => '',
    'Corp' => '',
    'hf_PayTotal' => '',
    'hf_Transmitted' => '',
    'hf_InvcTotal' => '',
    'hf_MapUrl' => '',
    'hf_classA' => '',
    'hf_classB' => '',
    'hf_classC' => '',
    'hf_boro' => '',
    'hf_QueryMessage' => '',
    'hf_PhoneNumber' => '',
    'hf_Spanish' => 'N'
	);
$encoded = '';
foreach($post_array as $name => $value) {
  $encoded .= urlencode($name).'='.urlencode($value).'&';
}
$encoded  .= 'rand='.rand();
//$encoded = substr($encoded, 0, strlen($encoded)-1);
echo "started";
$ch2 = curl_init();
$curlcontent2 = '';
$cookie1 = tempnam ("/tmp", "CURLCOOKIET");

 curl_setopt( $ch2, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/13.10.1" );
    curl_setopt( $ch2, CURLOPT_URL, "http://167.153.4.70/HPDonline/select_application.aspx" );
	 curl_setopt($ch2, CURLOPT_COOKIEFILE, "cookies.txt");
    curl_setopt( $ch2, CURLOPT_COOKIEJAR, "/cookies.txt" );
    curl_setopt( $ch2, CURLOPT_FOLLOWLOCATION, true );
    curl_setopt( $ch2, CURLOPT_ENCODING, "" );
    curl_setopt( $ch2, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch2, CURLOPT_AUTOREFERER, true );
    curl_setopt( $ch2, CURLOPT_CONNECTTIMEOUT, 0  );
    curl_setopt( $ch2, CURLOPT_TIMEOUT, 0  );
    curl_setopt( $ch2, CURLOPT_MAXREDIRS, 24 );
	//curl_setopt( $ch2, CURLOPT_URL, "javascript:__doPostBack('lbtnComplaintHistory','')" );
	curl_setopt($ch2, CURLOPT_POST, 1);
	curl_setopt($ch2,CURLOPT_POSTFIELDS,$encoded);
	$curlcontent2 = curl_exec($ch2);
	$info = curl_getinfo($ch2);

	
	curl_close ($ch2);

	
	
			echo $info['http_code'];
		if(isset($info['http_code'])&&($info['http_code']==200))
		{
			if(($curlcontent2!='')&&(strstr($curlcontent2,'id="dgViolations"')))
			{
			echo "==>sss".$result_row['Street'];
			$xml = new DOMDocument();
			$xml->validateOnParse = true;
			$xml->strictErrorChecking = true;
			libxml_use_internal_errors(true);
			$xml->loadHTML($curlcontent2);
			//echo $xml->saveHTML();
			libxml_clear_errors();
			
			$xpath = new DOMXPath($xml);
			
			
			//for getting Postcode
			$State         = 'Queens';
			$postcode_content = $xpath->query("//*[@id='mymaintable_lblAddr']")->item(0);
			$postcode_string = $xml->saveXML($postcode_content);
			preg_match_all('/<span id="mymaintable_lblAddr" style="font-family:Verdana;font-size:11px;">(.*?)<\/span>/i', $postcode_string, $matches);
			$string = $matches[1][0];
			//echo "string=>" .$string;
			$string = explode(",", $string);
			$string = trim($string[1]);
			$Postcode = trim(substr($string, strlen($State)));
			echo "Postcode=>" .$Postcode;
			
			$table =$xpath->query("//*[@id='dgViolations']")->item(0);
			
			// for printing the whole html table just type: print $xml->saveXML($table); 
			$insert_query_value = '';
			
				$rows = $table->getElementsByTagName("tr");
				
				//if(is_array()
				$insert_string = '';
				$i=1;
				echo "========================START======================><br/>";
				echo count($rows) . "</br>";
				echo "<========================END========================><br/>";
				foreach ($rows as $row) {
			   $i;
			    echo "<pre>";
				print_r($row);
				echo "</pre>";

				 $cells = $row -> getElementsByTagName('td');
				 if($i!=1)
				 {
				  $insert_string .= '(';
				 	 $j=1;
					 $insert_value = '';
					$insert_value .= "'".$result_row['house_number']."',"."'".$result_row['Street']."',";
					  foreach ($cells as $cell) {
					
						$node_value = '';
			
						$node_value = strip_tags(trim($cell->nodeValue));
					  $insert_value .= "'".str_replace('Â§','�',preg_replace('#[\s]+#', ' ',$node_value))."'".',';
						$j++;
					  }
					  $insert_string .= substr($insert_value,0,-1);
					  $insert_string .= ",'".trim($Postcode)."'";
					  $insert_string .= '),';
				  }
				  
				  $i++;
				}
				$insert_query_value = substr($insert_string,0,-1);
				if($insert_query_value!='')
				{
					$conn1 = mysql_connect('localhost','glesch1','3Mes$hlYzp2e');
					mysql_select_db('glesch1_checkhpd',$conn1);
					//$conn1 = mysql_connect('localhost','glesch1','3Mes$hlYzp2e');
					//mysql_select_db('glesch1_checkhpd');
				 $insert_query = "insert into OPV_Queens (house_number,Street,Apt_story,Reported_novIssuedDate,Hzrd_Class,Order_no,ViolationId_NovId,Violation_Description,Status_StatusDate,CertByDate_ActualCertDate,zipcode) VALUES ".$insert_query_value;
			
				//echo "==>".$insert_query;
				$insquery = mysql_query($insert_query,$conn1);
				$statename         = 'Queens';
				$endhousenum       = $result_row['house_number'];
				$endhousestreet    =  $result_row['Street'];
				$endaid			    =  $result_row['aid'];
				$status_update     = mysql_query("update Cronstatus set Cron_status ='P',State = '".$statename."',HouseNumber = '".$endhousenum."',Street = '".$endhousestreet."',Contenttype = 'OPV',StateId = '".$endaid."', updated_time = '".date('Y-m-d H:i:s')."' where Id = '".$cronid."'",$conn1);
				mysql_close($conn1);
				
				} else {
					$conn2 = mysql_connect('localhost','glesch1','3Mes$hlYzp2e');
					mysql_select_db('glesch1_checkhpd',$conn2);
					$endhousenum       = $result_row['house_number'];
					$endhousestreet    = $result_row['Street'];
					$endaid			    =  $result_row['aid'];
					$statename         = 'Queens';

					echo "update Cronstatus set State = '".$statename."',HouseNumber = '".$endhousenum."',Street = '".$endhousestreet."',Contenttype = 'OPV',StateId = '".$endaid."',updated_time = '".date('Y-m-d H:i:s')."' where Id = '".$cronid."'" ;
			
					$status_update     = mysql_query("update Cronstatus set Cron_status ='P',State = '".$statename."',HouseNumber = '".$endhousenum."',Street = '".$endhousestreet."',Contenttype = 'OPV',StateId = '".$endaid."',updated_time = '".date('Y-m-d H:i:s')."' where Id = '".$cronid."'",$conn2);
					mysql_close($conn2);


				}
			//}
			
			} else {
				$conn3 = mysql_connect('localhost','glesch1','3Mes$hlYzp2e');
					mysql_select_db('glesch1_checkhpd',$conn3);
				$endhousenum       = $result_row['house_number'];
					$endhousestreet    = $result_row['Street'];
					$endaid			    =  $result_row['aid'];
					$statename         = 'Queens';

					echo "update Cronstatus set State = '".$statename."',HouseNumber = '".$endhousenum."',Street = '".$endhousestreet."',Contenttype = 'OPV',StateId = '".$endaid."',updated_time = '".date('Y-m-d H:i:s')."' where Id = '".$cronid."'" ;
			
					$status_update     = mysql_query("update Cronstatus set Cron_status ='P', State = '".$statename."',HouseNumber = '".$endhousenum."',Street = '".$endhousestreet."',Contenttype = 'OPV',StateId = '".$endaid."',updated_time = '".date('Y-m-d H:i:s')."' where Id = '".$cronid."'",$conn3);
				mysql_close($conn3);

			}
			
		}
		
} else {
	$conn4 = mysql_connect('localhost','glesch1','3Mes$hlYzp2e');
					mysql_select_db('glesch1_checkhpd',$conn4);
	$endhousenum       = $result_row['house_number'];
					$endhousestreet    = $result_row['Street'];
					$endaid			    =  $result_row['aid'];
					$statename         = 'Queens';

					echo "update Cronstatus set State = '".$statename."',HouseNumber = '".$endhousenum."',Street = '".$endhousestreet."',Contenttype = 'OPV',StateId = '".$endaid."',updated_time = '".date('Y-m-d H:i:s')."' where Id = '".$cronid."'" ;
			
					$status_update     = mysql_query("update Cronstatus set Cron_status ='P', State = '".$statename."',HouseNumber = '".$endhousenum."',Street = '".$endhousestreet."',Contenttype = 'OPV',StateId = '".$endaid."',updated_time = '".date('Y-m-d H:i:s')."' where Id = '".$cronid."'",$conn4);

mysql_close($conn4);

}

  /*if(($lastrowst==$result_row['Street'])&&($lastrowhn==$result_row['house_number'])&&($info['http_code']==200))
  {
    $houseinfo = 'Complaint History<br>'.$result_row['house_number'].' & '.$result_row['Street'];
    cronmailsent('Manhattan',$houseinfo,$lastaid);
  }*/
}
} else {
$conn5 = mysql_connect('localhost','glesch1','3Mes$hlYzp2e');
mysql_select_db('glesch1_checkhpd',$conn5);
mysql_query("update Cronstatus set Date = '".$today."',Cron_status = 'S',updated_time='".$current_time."' where Id = '". $cronid  . "' ",$conn5);
}
}
?>
