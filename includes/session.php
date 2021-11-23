<?php
session_start();
	require_once('connection.php');
	
	// $select_content2h=("select * from systemusers WHERE entity_guid ='".$_SESSION["user"]."'");
	// $content_result2h= mysqli_query($db, $select_content2h) or die (mysqli_error($db));
	// $content2h = mysqli_fetch_assoc($content_result2h);
	// var_dump($content2h);exit;
	// $num_chk2h = mysqli_num_rows ($content_result2h);
	
	
	
	function logged_in() {
		return isset($_SESSION["ustcode"]);
	}
	
	function confirm_logged_in() {
		if (!logged_in()){
			$_SESSION["fromUrl"] = $_SERVER['HTTP_REFERER'];
			header("Location:index");
		}
	}
	
	//echo formatMoney(1050 , true). "<br>"; # 1,050 
	function formatMoney($number, $fractional=false) { 
		if ($fractional) { 
			$number = sprintf('%.2f', $number); 
		} 
		//$number = round($number);
		while (true) { 
			$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number); 
			if ($replaced != $number) { 
				$number = $replaced; 
			} else { 
				break; 
			} 
		} 
		return $number; 
	} 
	
	//////////////// SMS Format
	function smsContent($smsContent,$name,$regno, $amount,$date){
		$msg = str_replace('{$name}', $name, $smsContent);
		$msg = str_replace('{$regno}', $regno, $msg);
		$msg = str_replace('{$amount}', $amount, $msg);
		$msg = str_replace('{$date}', $date, $msg);	
		return $msg;
	}

	function smsContentBday($smsContent=NULL,$name=NULL){
		$msg = str_replace('{$name}', $name, $smsContent);
		return $msg;
	}

	function logs($operation,$table,$description,$user,$xdate,$branch,$id){
		$description = mysqli_real_escape_string($db, $description);
		$operation = mysqli_real_escape_string($db, $operation);
		$table = mysqli_real_escape_string($db, $table);
		$branch = mysqli_real_escape_string($db, $branch);
		$id = mysqli_real_escape_string($db, $id);
		global $db;
		mysqli_query($db, "insert into logs set branch='$branch', trans_id='$id', operation='$operation', description='$description', otable='$table', user='$user', xdate='$xdate'") or die(mysqli_error($db));
		$logs = 1;
		return $logs;
	}

	
	function my_simple_crypt( $string, $action) {
        // you may change these values to your own
        $secret_key = 'noarktechnologieslimitedACADASUITE';
        $secret_iv = '08062439476+-436574892';
    
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
    
        if( $action == 'e' ) {
            $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
        }
        else if( $action == 'd' ){
            $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
        }
    
        return $output;
	}

	function timeCountDown($expire_time){ 
		$result = "";
		$unix_timestamp = strtotime($expire_time);
		//$pretty_date = date('l, F jS, Y \a\t g:ia', $unix_timestamp);
		$pretty_date = date('F jS, Y', $unix_timestamp);
		$thisyear = date("Y");
		$today = date("d");
		if(date('Y', $unix_timestamp) == $thisyear){
			if(date('d', $unix_timestamp) == $today){
				$result = "Today ".date('g:ia', $unix_timestamp);
			}
			else{
				$result = date('F jS', $unix_timestamp);
			}
		}
		else{
			$result = date('F jS, Y', $unix_timestamp);
		}
		return $result;
	}

	function timeCountDown2($expire_time){ 
		$result = "";
		$unix_timestamp = strtotime($expire_time);
		//$pretty_date = date('l, F jS, Y \a\t g:ia', $unix_timestamp);
		$pretty_date = date('F jS, Y', $unix_timestamp);
		$thisyear = date("Y");
		$today = date("d");
		if(date('Y', $unix_timestamp) == $thisyear){
			if(date('d', $unix_timestamp) == $today){
				$result = date('g:ia', $unix_timestamp);
			}
			else{
				$result = date('F jS', $unix_timestamp);
			}
		}
		else{
			$result = date('F jS, Y', $unix_timestamp);
		}
		return $result;
	}

	function convert_number($number) 
	{ 
		if (($number < 0) || ($number > 999999999)) 
		{ 
		throw new Exception("Number is out of range");
		} 
	
		$Gn = floor($number / 1000000);  /* Millions (giga) */ 
		$number -= $Gn * 1000000; 
		$kn = floor($number / 1000);     /* Thousands (kilo) */ 
		$number -= $kn * 1000; 
		$Hn = floor($number / 100);      /* Hundreds (hecto) */ 
		$number -= $Hn * 100; 
		$Dn = floor($number / 10);       /* Tens (deca) */ 
		$n = $number % 10;               /* Ones */ 
	
		$res = ""; 
	
		if ($Gn) 
		{ 
			$res .= convert_number($Gn) . " Million"; 
		} 
	
		if ($kn) 
		{ 
			$res .= (empty($res) ? "" : " ") . 
				convert_number($kn) . " Thousand"; 
		} 
	
		if ($Hn) 
		{ 
			$res .= (empty($res) ? "" : " ") . 
				convert_number($Hn) . " Hundred"; 
		} 
	
		$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen"); 
		$tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty","Seventy", "Eigthy", "Ninety"); 
	
		if ($Dn || $n) 
		{ 
			if (!empty($res)) 
			{ 
				$res .= " and "; 
			} 
	
			if ($Dn < 2) 
			{ 
				$res .= $ones[$Dn * 10 + $n]; 
			} 
			else 
			{ 
				$res .= $tens[$Dn]; 
	
				if ($n) 
				{ 
					$res .= "-" . $ones[$n]; 
				} 
			} 
		} 
	
		if (empty($res)) 
		{ 
			$res = "zero"; 
		} 
	
		return $res; 
	}

	if(mysqli_real_escape_string($db, @$_GET['pr']) == 5){
		$TXTid = mysqli_real_escape_string($db, my_simple_crypt($_GET['page'] , 'd' ));
		$select_content=("UPDATE account_book SET print='1' WHERE trans_guid='$TXTid'");
		mysqli_query($db, $select_content) or trigger_error(mysqli_error());
	}

	function formatPhone($phone, $country_code){
		if(substr($phone,0,1) == "0"){
			$phone = $country_code.ltrim($phone, '0');
		}else{
			if(substr($phone,0,3) != $country_code){
				$phone = $country_code.$phone;
			}
		}
		return $phone;
	}

	function getContacts(){
		$phoneno =!empty($_SESSION["phoneno"])?$_SESSION["phoneno"]:NULL;
		$contactname =!empty($_SESSION["contactname"])?$_SESSION["contactname"]:NULL;
		return array(
			'phoneno' => $phoneno,
			'names' => $contactname,
		);
	}

	function setContact($honeno=NULL, $name=NULL){		
		$_SESSION["phoneno"] = $honeno;
		$_SESSION["contactname"] = $name;
	}

	function getMessage(){
		$msg =!empty($_SESSION["page-message"])?$_SESSION["page-message"]:NULL;
		unset($_SESSION["page-message"]);
		return $msg;
	}

	function setMessage($msg){		
		$_SESSION["page-message"] = $msg;
	}
	
	

	function passwordGen($lenght){
		$chars = "noraktechnologiesbcdfjlmpquvwxyz0123456789";
		return substr(str_shuffle($chars),0, $lenght);
	}



	function getRequestStatus($value){
	switch ($value) {
		case '1':
		$options='<span class="status-p bg-warning">Quoted</span>';
		break;
		case '0':
		$options='<span class="status-p bg-primary">New</span>';
		break;
		case '3':
		$options='<span class="status-p bg-danger">Cancelled</span>';
		break;
		case '2':
		$options='<span class="status-p bg-success">Completed</span>';
		break;
	}
	return $options;
	}
	
?>
