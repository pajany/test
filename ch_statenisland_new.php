<?php
//echo phpinfo();
include_once("config.php");
//set_time_limit(50000);

$status_query = mysql_query("select * from Cronstatus where State='StatenIsland'  and Contenttype='CH' order by Id desc limit 1");
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


if($interval_min >= '10' || $cronstatus == 'F' ) {

$today = date('Y-m-d');
$lastrowquery = "select Street,house_number,aid from StatenIsland order by aid desc limit 0,1";
$lastrow_result = mysql_query($lastrowquery);
$lastrow   = mysql_fetch_assoc($lastrow_result);
$lastrowst = $lastrow['Street'];
$lastrowhn = $lastrow['house_number'];
$lastaid   = $lastrow['aid'];
$where_clause = '';
$where_clause = " where aid> '".$aid_failed."' and  CHARACTER_LENGTH(Street) > 4";
$manhattan_query = "select aid,house_number,Street from StatenIsland $where_clause order by aid asc";
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

          $nvpreq='__EVENTTARGET=&__EVENTARGUMENT=&__LASTFOCUS=&__VIEWSTATE=%2FwEPDwUJLTExODE2NzA0D2QWAgIBD2QWAgIBD2QWBmYPZBYCZg9kFgJmD2QWAgIBD2QWBGYPZBYCZg9kFgICAQ9kFgRmD2QWBGYPZBYCAgEPDxYCHgRUZXh0ZWRkAgIPZBYCAgEPDxYCHwAFCDIvNi8yMDEzZGQCAQ9kFgQCAQ9kFgICAQ8PFgIfAAUmSFBEIEJ1aWxkaW5nLCBSZWdpc3RyYXRpb24gJiBWaW9sYXRpb25kZAICD2QWBAIBDxBkZBYBZmQCAw8PFgIeB1Zpc2libGVoZGQCAQ9kFgJmD2QWAgIBDxYCHwFoZAICD2QWAmYPZBYGAgEPZBYEZg9kFgYCAQ9kFgQCAQ8PFgIfAWhkZAIEDw8WBB8AZR8BaGRkAgIPZBYEAgEPDxYCHwFoZGQCBA8PFgQfAGUfAWhkZAIDD2QWAgIFDxBkZBYBZmQCAQ9kFgJmD2QWAgIBDw8WAh8AZWRkAgMPDxYCHwAFlwI8YnIgLz48YnIgLz5Db250ZXh0LlJlcXVlc3QuVXNlckhvc3RBZGRyZXNzID0gMTAuMjAxLjI1NC4xMzA8YnI%2BIE9sZCBQb3J0YWwgSVA9CTEwLjIwMS4yNTQuMTM3IDxicj4gUG9ydGFsIElQPQkgICAgMTAuMjAxLjI1NC4xMzAgPGJyPlJlc3VsdCBvZiBnZXRfc2VydmVyPWV4dHJhbmV0PGJyPlBvcnRhbElQID0gMTAgMjAxIDI1NCAxMzAgPGJyPkludHJhbmV0SVAgPSAxMCAyMjYgOCAwIDxCUj5JbnRyYW5ldE1hc2sgPSAyNTUgMjU1IDI0OCAwIDxicj5Ib3N0ID0gMTAgMjAxIDI1NCAxMzBkZAIFDw8WAh8AZWRkAgMPZBYCZg9kFgICAQ9kFgJmD2QWAmYPZBYEZg8PFgIfAWhkZAICDzwrAAsAZGREVBj5bfCOVV9s%2BJuOsA19fhFl3P9H4B0PF4OtHOp9EQ%3D%3D&__EVENTVALIDATION=%2FwEWFgKB7c3YAQLF0d78BQLVvvSSCQLOvvSSCQLPvvSSCQLMvvSSCQLLvvSSCQLz1PvRDAKzi9SXDgKyi9SXDgKxi9SXDgKwi9SXDgK3i9SXDgLc1arCDgL7nPiqBwLR1viaCQKtkuWiCgK8kOykDQLco6BmAqSg56wBAq%2Fj%2BYkIAt65iBt0WGCOyhJNeXRRbez27HMXNRRVcrg7u60LktEILNk8Og%3D%3D&mymaintable%3AddlServices=0&mymaintable%3Ahf_UserStatus=&ddlBoro=5&txtHouseNo='.$result_row['house_number'].'&txtStreet='.urlencode($result_row['Street']).'&SearchButton=Search&RadioStrOrBlk=Street&hf_phn=&hf_street=&hf_boro=&hf_UserStatus=';
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
	'__EVENTTARGET' => 'lbtnComplaintHistory',
    '__EVENTARGUMENT' => '',
    '__LASTFOCUS' => '',
    '__VIEWSTATE' => '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',
    '__EVENTVALIDATION' => '/wEWKwKZ9/i4AQLF0d78BQLVvvSSCQLOvvSSCQLPvvSSCQLMvvSSCQLLvvSSCQLz1PvRDAKavNWaBQKU/eSsDQK1+ML+DgKJq4jPBgL1uZHnBAKZtcPhCgKh+aagDQLt6K3CDwLBot+1CQLL9aigCQKB27OaCAL5gKtvAtapjJkJAtGRgfAJAoua3ZwOAqO9vm8Cta3d6Q4Cn/aX4wsCuKjr0A4Cx9bd1AcC1pP4igMCt9/r0AcCsNOa6AoC7bPYrgcCma/2ogICyujF+w0C2ZGnIwKE/rOMCQKo05roCgKl05roCgKm05roCgKv4/mJCAKw+IvQBgLs/OKZAgLxwqP6C5iE3eZwUJG8luRSeRZRD74JotNm7ea8zJuwvOQvZkM5',
    'mymaintable:ddlServices' => '0',
    'mymaintable:hf_UserStatus' => '',
    'server' => '',
    'hf_boronum' => '',
    'hf_report_name' => 'complaint history',
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
			if(($curlcontent2!='')&&(strstr($curlcontent2,'id="dgComplaintHistory"')))
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
			$State         = 'StatenIsland';
			$postcode_content = $xpath->query("//*[@id='mymaintable_lblAddr']")->item(0);
			$postcode_string = $xml->saveXML($postcode_content);
			preg_match_all('/<span id="mymaintable_lblAddr" style="font-family:Verdana;font-size:11px;">(.*?)<\/span>/i', $postcode_string, $matches);
			$string = $matches[1][0];
			//echo "string=>" .$string;
			$string = explode(",", $string);
			$string = trim($string[1]);
			$Postcode = trim(substr($string, strlen($State)));
			echo "Postcode=>" .$Postcode;
			
			$table =$xpath->query("//*[@id='dgComplaintHistory']")->item(0);
			
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
			
						$node_value = trim($cell->nodeValue);
						  $insert_value .= "'".addslashes($node_value)."'".',';
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
				echo $insert_query = "insert into CH_StatenIsland (	house_number,Street,Complaint_Date,Complaint,SR,Apt,Complaint_Condition,Condtion_Detail,Location,zipcode) VALUES ".$insert_query_value;
				//echo "==>".$insert_query;
				$insquery = mysql_query($insert_query,$conn1);
				$statename         = 'StatenIsland';
				$endhousenum       = $result_row['house_number'];
				$endhousestreet    =  $result_row['Street'];
				$endaid			    =  $result_row['aid'];
				$status_update     = mysql_query("update Cronstatus set Cron_status ='P',State = '".$statename."',HouseNumber = '".$endhousenum."',Street = '".$endhousestreet."',Contenttype = 'CH',StateId = '".$endaid."', updated_time = '".date('Y-m-d H:i:s')."' where Id = '".$cronid."'",$conn1);
				mysql_close($conn1);
				
				} else {
					$conn2 = mysql_connect('localhost','glesch1','3Mes$hlYzp2e');
					mysql_select_db('glesch1_checkhpd',$conn2);
					$endhousenum       = $result_row['house_number'];
					$endhousestreet    = $result_row['Street'];
					$endaid			    =  $result_row['aid'];
					$statename         = 'StatenIsland';

					echo "update Cronstatus set State = '".$statename."',HouseNumber = '".$endhousenum."',Street = '".$endhousestreet."',Contenttype = 'CH',StateId = '".$endaid."',updated_time = '".date('Y-m-d H:i:s')."' where Id = '".$cronid."'" ;
			
					$status_update     = mysql_query("update Cronstatus set Cron_status ='P',State = '".$statename."',HouseNumber = '".$endhousenum."',Street = '".$endhousestreet."',Contenttype = 'CH',StateId = '".$endaid."',updated_time = '".date('Y-m-d H:i:s')."' where Id = '".$cronid."'",$conn2);
					mysql_close($conn2);


				}
			//}
			
			} else {
				$conn3 = mysql_connect('localhost','glesch1','3Mes$hlYzp2e');
					mysql_select_db('glesch1_checkhpd',$conn3);
				$endhousenum       = $result_row['house_number'];
					$endhousestreet    = $result_row['Street'];
					$endaid			    =  $result_row['aid'];
					$statename         = 'StatenIsland';

					echo "update Cronstatus set State = '".$statename."',HouseNumber = '".$endhousenum."',Street = '".$endhousestreet."',Contenttype = 'CH',StateId = '".$endaid."',updated_time = '".date('Y-m-d H:i:s')."' where Id = '".$cronid."'" ;
			
					$status_update     = mysql_query("update Cronstatus set Cron_status ='P', State = '".$statename."',HouseNumber = '".$endhousenum."',Street = '".$endhousestreet."',Contenttype = 'CH',StateId = '".$endaid."',updated_time = '".date('Y-m-d H:i:s')."' where Id = '".$cronid."'",$conn3);
				mysql_close($conn3);

			}
			
		}
		
} else {
	$conn4 = mysql_connect('localhost','glesch1','3Mes$hlYzp2e');
					mysql_select_db('glesch1_checkhpd',$conn4);
	$endhousenum       = $result_row['house_number'];
					$endhousestreet    = $result_row['Street'];
					$endaid			    =  $result_row['aid'];
					$statename         = 'StatenIsland';

					echo "update Cronstatus set State = '".$statename."',HouseNumber = '".$endhousenum."',Street = '".$endhousestreet."',Contenttype = 'CH',StateId = '".$endaid."',updated_time = '".date('Y-m-d H:i:s')."' where Id = '".$cronid."'" ;
			
					$status_update     = mysql_query("update Cronstatus set Cron_status ='P', State = '".$statename."',HouseNumber = '".$endhousenum."',Street = '".$endhousestreet."',Contenttype = 'CH',StateId = '".$endaid."',updated_time = '".date('Y-m-d H:i:s')."' where Id = '".$cronid."'",$conn4);

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
