<?php
$db = mysqli_connect("localhost", "root", "", "equip2upgrade");
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}
function escape($data){
    global $db;
    return mysqli_real_escape_string($db, $data);
}

$context_system = 10;
	$context_personal = 20;
	$context_user = 30;
	$context_category = 40;
	$context_course= 50;
	$context_group = 60;
	$context_module = 70;
	$context_block = 80;
	$currency = "&#8358;";
	
	function logging($msg) {
		error_log($msg);
	}
	
	function cleanse($data){
		 return  htmlspecialchars(strip_tags(addslashes($data)));
	}
	
	function cleanse2($data){
		 return  stripslashes(stripslashes(stripslashes(stripslashes(stripslashes(stripslashes(stripslashes($data)))))));
	}
	
	
	
	function formatDate($date){
		 if($date ==""){
			  return date("d-m-Y");
		 }
		 if($date == "0000-00-00" or $date == "00-00-0000" or $date == "1970-01-01"){
			  return "";
		 }
		 else{
			  return date("d-m-Y", strtotime($date));
		 }
	}

	function formatDateM($date){
		return date("d-m-Y", $date);
	}
	
	function formatDateTime($date){
		 if($date =="" or $date =="0000-00-00" or $date =="00-00-0000" or $date =="1970-01-01"){
			  return "";
		 }
		 else{
			  return date("d-m-Y h:i:s", strtotime($date));
		 }
	}
	
	function formatDateDB($date){
		 return date("Y-m-d", strtotime($date));
	}
	
	function formatDateTimeDB($date){
		 return date("Y-m-d h:i:s", strtotime($date));
	}

	function GenerateUrl ($s) {

		// Convert accented characters, and remove parentheses and apostrophes
		$from = explode (',', "ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u,(,),[,],'");
		$to   = explode (',', 'c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u,,,,,,');
	
		// Do the replacements, and convert all other non-alphanumeric characters to spaces
		$s = preg_replace ('~[^\w\d]+~', '-', str_replace ($from, $to, trim ($s)));
	
		// Remove a - at the beginning or end and make lowercase
		return strtolower (preg_replace ('/^-/', '', preg_replace ('/-$/', '', $s)));
	}

	function getBaseUrl() 
	{
		$uri = $_SERVER['REQUEST_URI']; // $uri == example.com/sub
		$exploded_uri = explode('/', $uri); //$exploded_uri == array('example.com','sub')
		$domain_name = $exploded_uri[1]; //
		// output: localhost
		$hostName = $_SERVER['HTTP_HOST']; 
   
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
   
		// return: http://localhost/myproject/
		return $protocol.$hostName.'/'.$domain_name;
	}

	define("SITEURL", getBaseUrl()."/");
	define("SITEURL2", getBaseUrl()."/");
	// define("ADMINURL", getBaseUrl()."/myschool");
	// define("SCHOOL_FOLDER", '../../schools/'.$contents["sch_folder"]);
	// define("SCHOOL_FOLDER2", '../../../schools/'.$contents["sch_folder"]);
	// define("SCHOOL_FOLDER_GALLERY", '../../../../../../schools/'.$contents["sch_folder"].'/images/');
	// define("SCHL_FOLDER_NAME", $contents["sch_folder"]);
	define("ROOT_FOLDER", getBaseUrl());
	// define("SCHOOL__ROOT_FOLDER", getBaseUrl().'/schools/'.$contents["sch_folder"]);

?>