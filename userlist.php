<?php require_once("includes/session.php"); ?>
<?php confirm_logged_in(); ?>
<?php
$xID = $_SESSION["ustcode"];
?>
<?php
	$userID = $_SESSION["ustcode"];
	$select_content1=("select * from systemusers WHERE id='$userID'");
	$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
	$content1 = mysqli_fetch_assoc($content_result1);
	$num_chk1 = mysqli_num_rows ($content_result1);
	$vv = $content1['system_users'];
	if ($vv  == 1)
	{
?>
<?php
	$pg = mysqli_real_escape_string($db, $_GET['pg']);
	$pv = mysqli_real_escape_string($db, $_GET['pv']);
	$sql = mysqli_real_escape_string($db, $_GET['sql']);
?>

<?php
	if ($pg == 12)
	{
		$adminid   = mysqli_real_escape_string($db, $_POST['adminid']);
		$classes = $_POST['category']; 
		$xdate = date("Y-m-d");
		
		/*$n = count($classes);
		$nn =0;
		mysqli_query($db, "delete from bursary_access where adminid ='$adminid'") or die(mysqli_error($db));	
	   
		for($i=0; $i < $n; $i++)
		{
			$class=$classes[$i];
				
			mysqli_query($db, "insert into bursary_access SET classid='$class', adminid ='$adminid', user='$xID', xdate='$xdate'") or die(mysqli_error($db));			
		}*/
		
		foreach($classes as $value){
			 $classes .= mysqli_real_escape_string($db, $value).", ";
		}
		$class = substr($classes,5,-2);
		$select_content3=("select * from bursary_access where adminid ='$adminid'");
		$content_result3= mysqli_query($db, $select_content3) or die(mysqli_error($db));
		$content3 = mysqli_fetch_assoc($content_result3);
		$num_chk3 = mysqli_num_rows ($content_result3);
		
		if($num_chk3 == 0){
			mysqli_query($db, "insert into bursary_access SET classid='$class', adminid ='$adminid', user='$xID', xdate='$xdate'") or die(mysqli_error($db));
		}
		else {
			mysqli_query($db, "UPDATE bursary_access SET classid='$class', user='$xID', xdate='$xdate' where adminid ='$adminid'") or die(mysqli_error($db));
		}		
		
		$sql= "<b>Operation was Successful<b>";
		
		echo "
			<script language='javascript'>
				location.href='userlist?pg=31&id=$adminid&sql=$sql'
			</script>
		";	
	}
?>



<?php
	if ($pg == 8)
		{
			$TXTid = mysqli_real_escape_string($db, $_GET['id']);
			$email = mysqli_real_escape_string($db, $_GET['m']);
			
			 $var1 = mt_rand(1,10);
			  $var2 = mt_rand(1,10);
			  $var3 = mt_rand(1,10);
			  $var4 = mt_rand(1,10);
			  
			  $rand = $var1."".$var2."".$var3."".$var4;
			  $pass = $var3."".$rand;
			  $encPass = md5($pass);
			mysqli_query($db, "UPDATE systemusers SET `password` = '$encPass' WHERE id = '$TXTid'");
			$sql= "<b>Operation was Successful: Password Reset to ".$pass;
			
			//change this to your email.
    $to = "$email";
    $from = "admin@stgregoryscollege.com";
    $subject = "Password Reset was successful";
	$mailimg = '
		<img src="http://www.example.com/images/sample.jpg"</a>
		';
    //begin of HTML message
    $message = <<<EOF
					
					<html>
					<head>
					<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
					<title>Govt</title>
					</head>
					<body bgcolor="#e5e5e5">
					<table width="945" border="0" align="center" cellpadding="0" cellspacing="0">
						  <tr>
						  	<td valign="top">
								Hi,<br><br>
								
								Your Password has just been reset and a new password has been given to you<br><br>
								
								Here is your new Password: <u><b>$pass</b></u>.<br><br>
								
								Please login into the portal to change this default password to a New Password<br><br>
								
								Regards,
								
								Administrator.
								
								
							</td>
						  </tr>
						
						</table>

					</body>
					</html>

EOF;
   //end of message
    $headers  = "From: $from\r\n";
    $headers .= "Content-type: text/html\r\n";
    mail($to, $subject, $message, $headers);
	echo "
			<script language='javascript'>
				location.href='userlist.php?sql=$sql'
			</script>
		";			
		}
?>


<?php
	if ($pg == 7)
	
		{
			$TXTid = mysqli_real_escape_string($db, $_GET['id']);
			$Txtstatus = mysqli_real_escape_string($db, $_GET['v']);
			mysqli_query($db, "UPDATE systemusers SET `status`= '$Txtstatus' WHERE id = '$TXTid'");
			$sql= "<b>Operation was Successful: Changes made<b>";
			echo "
				<script language='javascript'>
					location.href='userlist.php?sql=$sql'
				</script>
			";
		}
?>

<?php

	if ($pg == 2)
		{	
		
			$txt1 = mysqli_real_escape_string($db, $_POST['txt1']);
				if ($txt1 == "on")
					{
						$txt1 = 1;	
					}
				else
					{
						$txt1 = 0;
					}

			$txt2 = mysqli_real_escape_string($db, $_POST['txt2']);
			
				if ($txt2 == "on")
					{
						$txt2 = 1;	
					}
				else
					{
						$txt2 = 0;
					}
			$txt3 = mysqli_real_escape_string($db, $_POST['txt3']);
			
					if ($txt3 == "on")
					{
						$txt3 = 1;	
					}
				else
					{
						$txt3 = 0;
					}
			$txt4 = mysqli_real_escape_string($db, $_POST['txt4']);
			
				if ($txt4 == "on")
					{
						$txt4 = 1;	
					}
				else
					{
						$txt4 = 0;
					}
					
			$txt5 = mysqli_real_escape_string($db, $_POST['txt5']);
				
					if ($txt5 == "on")
					{
						$txt5 = 1;	
					}
				else
					{
						$txt5 = 0;
					}
					
			$txt6 = mysqli_real_escape_string($db, $_POST['txt6']);
			
					if ($txt6 == "on")
					{
						$txt6 = 1;	
					}
				else
					{
						$txt6 = 0;
					}
					
			$txt7 = mysqli_real_escape_string($db, $_POST['txt7']);
			
					if ($txt7 == "on")
					{
						$txt7 = 1;	
					}
				else
					{
						$txt7 = 0;
					}
				
			$txt8 = mysqli_real_escape_string($db, $_POST['txt8']);
			
				
					if ($txt8 == "on")
					{
						$txt8 = 1;	
					}
				else
					{
						$txt8 = 0;
					}
					
			$txt9 = mysqli_real_escape_string($db, $_POST['txt9']);
				
					if ($txt9 == "on")
					{
						$txt9 = 1;	
					}
				else
					{
						$txt9 = 0;
					}
			$txt10 = mysqli_real_escape_string($db, $_POST['txt10']);
					
					if ($txt10 == "on")
					{
						$txt10 = 1;	
					}
				else
					{
						$txt10 = 0;
					}
				
				//Representing CBT Module
			$cbt = mysqli_real_escape_string($db, $_POST['cbt']);
			
					if ($cbt == "on")
					{
						$cbt = 1;	
					}
				else
					{
						$cbt = 0;
					}
					
				
			$txt11 = mysqli_real_escape_string($db, $_POST['txt11']);
					
					if ($txt11 == "on")
					{
						$txt11 = 1;	
					}
				else
					{
						$txt11 = 0;
					}
					
			$txt12 = mysqli_real_escape_string($db, $_POST['txt12']);
			
					if ($txt12 == "on")
					{
						$txt12 = 1;	
					}
				else
					{
						$txt12 = 0;
					}
					
			$txt13 = mysqli_real_escape_string($db, $_POST['txt13']);
			
					if ($txt13 == "on")
					{
						$txt13 = 1;	
					}
				else
					{
						$txt13 = 0;
					}
					
			$txt14 = mysqli_real_escape_string($db, $_POST['txt14']);
			
					if ($txt14 == "on")
					{
						$txt14 = 1;	
					}
				else
					{
						$txt14 = 0;
					}
					
			$txt15 = mysqli_real_escape_string($db, $_POST['txt15']);
			
					if ($txt15 == "on")
					{
						$txt15 = 1;	
					}
				else
					{
						$txt15 = 0;
					}
			
			$txt16 = mysqli_real_escape_string($db, $_POST['txt16']);
			
				if ($txt16 == "on")
					{
						$txt16 = 1;	
					}
				else
					{
						$txt16 = 0;
					}
					
			
			$txt17 = mysqli_real_escape_string($db, $_POST['txt17']);
					if ($txt17 == "on")
					{
						$txt17 = 1;	
					}
				else
					{
						$txt17 = 0;
					}
					
			$website = mysqli_real_escape_string($db, $_POST['website']);
			
					if ($website == "on")
					{
						$website = 1;	
					}
				else
					{
						$website = 0;
					}
					
			$txt18 = mysqli_real_escape_string($db, $_POST['txt18']);
			
			if ($txt18 == "on")
					{
						$txt18 = 1;	
					}
				else
					{
						$txt18 = 0;
					}
			
		
		// 07030259205
		
			$txtsname =mysqli_real_escape_string($db, $_POST['sname']);
			$txtoname =mysqli_real_escape_string($db, $_POST['oname']);
			$txtusername =mysqli_real_escape_string($db, $_POST['username']);
			$txtpassword = md5(mysqli_real_escape_string($db, $_POST['password']));
			$txtemail = mysqli_real_escape_string($db, $_POST['email']);
			$xdate = date("Y/m/d");
			$image = $_FILES['image']['name'];
			
			$sql= "insert into systemusers(userName, password, xdate, surname, fname, controlpanel, students, parents, staff, messaging, students_attendance, time_table, school_calendar, result_management, busary, cbt, book_shop, medical_records, dormitories_mgt, library_mgt, file_upload, system_users, reports, website, db_backp) values('$txtusername', '$txtpassword', '$xdate', '$txtsname', '$txtoname', '$txt1', '$txt2', '$txt3', '$txt4', '$txt5', '$txt6', '$txt7', '$txt8', '$txt9', '$txt10', '$cbt', '$txt11', '$txt12', '$txt13', '$txt14', '$txt15', '$txt16', '$txt17', '$website', '$txt18')";
			$result=mysqli_query($db, $sql);
			$sql = "Operation was Successful";
			echo "
				<script language='javascript'>
					location.href='userlist.php?sql=$sql'
				</script>
				";
			}
?>



<?php

	if ($pg == 5)
		{	
			$id = mysqli_real_escape_string($db, $_POST['id']);
			$txt1 = mysqli_real_escape_string($db, $_POST['txt1']);
				if ($txt1 == "on")
					{
						$txt1 = 1;	
					}
				else
					{
						$txt1 = 0;
					}

			$txt2 = mysqli_real_escape_string($db, $_POST['txt2']);
			
				if ($txt2 == "on")
					{
						$txt2 = 1;	
					}
				else
					{
						$txt2 = 0;
					}
			$txt3 = mysqli_real_escape_string($db, $_POST['txt3']);
			
					if ($txt3 == "on")
					{
						$txt3 = 1;	
					}
				else
					{
						$txt3 = 0;
					}
			$txt4 = mysqli_real_escape_string($db, $_POST['txt4']);
			
				if ($txt4 == "on")
					{
						$txt4 = 1;	
					}
				else
					{
						$txt4 = 0;
					}
					
			$txt5 = mysqli_real_escape_string($db, $_POST['txt5']);
				
					if ($txt5 == "on")
					{
						$txt5 = 1;	
					}
				else
					{
						$txt5 = 0;
					}
					
			$txt6 = mysqli_real_escape_string($db, $_POST['txt6']);
			
					if ($txt6 == "on")
					{
						$txt6 = 1;	
					}
				else
					{
						$txt6 = 0;
					}
					
			$txt7 = mysqli_real_escape_string($db, $_POST['txt7']);
			
					if ($txt7 == "on")
					{
						$txt7 = 1;	
					}
				else
					{
						$txt7 = 0;
					}
				
			$txt8 = mysqli_real_escape_string($db, $_POST['txt8']);
			
				
					if ($txt8 == "on")
					{
						$txt8 = 1;	
					}
				else
					{
						$txt8 = 0;
					}
					
			$txt9 = mysqli_real_escape_string($db, $_POST['txt9']);
				
					if ($txt9 == "on")
					{
						$txt9 = 1;	
					}
				else
					{
						$txt9 = 0;
					}
			$txt10 = mysqli_real_escape_string($db, $_POST['txt10']);
					
					if ($txt10 == "on")
					{
						$txt10 = 1;	
					}
				else
					{
						$txt10 = 0;
					}
				
			//Representing CBT Module
			$cbt = mysqli_real_escape_string($db, $_POST['cbt']);
			
					if ($cbt == "on")
					{
						$cbt = 1;	
					}
				else
					{
						$cbt = 0;
					}
					
			$txt11 = mysqli_real_escape_string($db, $_POST['txt11']);
					
					if ($txt11 == "on")
					{
						$txt11 = 1;	
					}
				else
					{
						$txt11 = 0;
					}
					
			$txt12 = mysqli_real_escape_string($db, $_POST['txt12']);
			
					if ($txt12 == "on")
					{
						$txt12 = 1;	
					}
				else
					{
						$txt12 = 0;
					}
					
			$txt13 = mysqli_real_escape_string($db, $_POST['txt13']);
			
					if ($txt13 == "on")
					{
						$txt13 = 1;	
					}
				else
					{
						$txt13 = 0;
					}
					
			$txt14 = mysqli_real_escape_string($db, $_POST['txt14']);
			
					if ($txt14 == "on")
					{

						$txt14 = 1;	
					}
				else
					{
						$txt14 = 0;
					}
					
			$txt15 = mysqli_real_escape_string($db, $_POST['txt15']);
			
					if ($txt15 == "on")
					{
						$txt15 = 1;	
					}
				else
					{
						$txt15 = 0;
					}
			
			$txt16 = mysqli_real_escape_string($db, $_POST['txt16']);
			
				if ($txt16 == "on")
					{
						$txt16 = 1;	
					}
				else
					{
						$txt16 = 0;
					}
			$txt17 = mysqli_real_escape_string($db, $_POST['txt17']);
			
					if ($txt17 == "on")
					{
						$txt17 = 1;	
					}
				else
					{
						$txt17 = 0;
					}
					
			$website = mysqli_real_escape_string($db, $_POST['website']);
			
					if ($website == "on")
					{
						$website = 1;	
					}
				else
					{
						$website = 0;
					}
					
			$txt18 = mysqli_real_escape_string($db, $_POST['txt18']);
			
			if ($txt18 == "on")
					{
						$txt18 = 1;	
					}
				else
					{
						$txt18 = 0;
					}
					$txtsname =mysqli_real_escape_string($db, $_POST['sname']);
			$txtoname =mysqli_real_escape_string($db, $_POST['oname']);
				mysqli_query($db, "UPDATE systemusers Set surname= '$txtsname', fname='$txtoname', controlpanel='$txt1', students= '$txt2', parents='$txt3', staff='$txt4', messaging='$txt5', students_attendance='$txt6', time_table='$txt7', school_calendar='$txt8', result_management='$txt9', busary='$txt10', cbt='$cbt', book_shop='$txt11', medical_records='$txt12', dormitories_mgt='$txt13', library_mgt='$txt14', file_upload='$txt15', system_users='$txt16', reports='$txt17',  website='$website', db_backp='$txt18' WHERE id = '$id'") or die(mysqli_error($db));

					$sql= "<b>Operation was Successful: Changes made<b>";
					echo "
						<script language='javascript'>
						  location.href='userlist.php?sql=$sql'
						</script>
					";
				}
?>

<?php	
	include("header.php");
?>

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>User's Information</h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right top_search">
                            	 <a href="dashboard" class="btn btn-sm btn-success"><i class="fa fa-home"></i>Dashboard</a>
                                 
                                 <a href="userlist?pg=1" class="btn btn-sm btn-dark"><i class="fa fa-plus"></i> New User</a>
                                 <a href="userlist" class="btn btn-sm btn-warning"><i class="fa fa-search"></i> View Users</a>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel" >
                              <?php
				if ($pg == 1)
					{
			?> 			 <form action="userlist?pg=2" name="frmReg" method="post" enctype="multipart/form-data" onSubmit="return loginCheck(this);" ID="Form1">
						<table style="width:100%">
							 
							 <tr>
								<td ><b>Surname</b></td>
								<td  valign="top" colspan="3">
									<input type="text" name="sname" class="form-control" style="width:200px;"/>
								</td>
								<td ><b>Othernames</b></td>
								<td  valign="top" colspan="3">
									<input type="text" name="oname" class="form-control" style="width:200px;"/>
								</td>
							</tr>
							
							<tr>
								<td ><b>UserName</b></td>
								<td  valign="top" colspan="3">
									<input type="text" name="username" class="form-control" style="width:200px;"/>
								</td>
								<td ><b>Password</b></td>
								<td  valign="top" colspan="3">
									<input type="password" name="password" class="form-control" style="width:200px;"/>
								</td>
							</tr>
							
                            
                            <tr>
					<td height="5" colspan="6" style="padding-top:10px;">&nbsp;</td>
				</tr>
                
                <tr>
					<td colspan="6">
                    	<font face="verdana" style="font-size: 12px;">
                        <b> Assign User Roles / Access</b>
                     </td>
				</tr>
                
                <tr>
					<td height="5" colspan="6" style="border-top:1px solid #F00"></td>
				</tr>
                <tr>
					<td colspan="6">
							<table border="0" style="width:100%">
								<tr>
									<td valign="middle">
                                    	<input type="checkbox" name="txt1" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff"> Control Panel
                                     </td>
									<td valign="middle">
                                    	<input type="checkbox" name="txt2" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff"> Students
                                     </td>
									<td valign="middle">
                                    	<input type="checkbox" name="txt3" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff"> Parents
                                    </td>
                                    <td valign="middle">
                                    	<input type="checkbox" name="txt4" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff"> Staff
                                    </td>
								</tr>
								<tr>
									<td height="6" colspan="3"></td>
								</tr>
								<tr >
									<td colspan="4"><b>&nbsp;</b></td>
								</tr>
								<tr>
									<td valign="middle"><input type="checkbox"  name="txt5" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff" ID="Checkbox4">
                                    	Messaging
                                    </td>
									<td valign="middle"><input type="checkbox" name="txt6" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff" ID="Checkbox5">
                                    	Student Attendance
                                    </td>
                                    <td valign="middle"><input type="checkbox" name="txt7" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff" ID="Checkbox5">
                                    	Time-Table
                                    </td>
                                    <td valign="middle"><input type="checkbox" name="txt8" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff" ID="Checkbox5">
                                    	School Calender
                                    </td>
								</tr>
								<tr >
									<td colspan="3"><b>&nbsp;</b></td>
								</tr>
								<tr>
									<td valign="middle"><input type="checkbox" name="txt9" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff">
                                    	Result Management
                                    </td>
									<td valign="middle"><input type="checkbox" name="txt10" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff">
                                    	Busary
                                    </td>
                                     <td valign="middle"><input type="checkbox" name="cbt" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff">
                                    	CBT
                                    </td>
                                    <td valign="middle"><input type="checkbox" name="txt11" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff">
                                    	Book Shop
                                    </td>
                                   
								</tr>
                               
                                <tr >
									<td colspan="3"><b>&nbsp;</b></td>
								</tr>
								<tr>
                                 <td valign="middle"><input type="checkbox" name="txt12" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff">
                                    	Medical Records
                                    </td>
									<td valign="middle">
                                    <input type="checkbox" name="txt13" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff"> Domitories management
                                    </td>
									<td valign="middle">
                                    <input type="checkbox" name="txt14" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff"> Library management
                                    </td>
                                    <td valign="middle">
                                    <input type="checkbox" name="txt15" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff"> File Upload
                                    </td>
								</tr>
                                <tr >
									<td colspan="3"><b>&nbsp;</b></td>
								</tr>
								<tr>
									<td valign="middle">
                                    <input type="checkbox" name="txt16" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff"> System Users
                                    </td>
									<td valign="middle">
                                    <input type="checkbox" name="txt17" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff"> Reports
                                    </td>
                                    <td valign="middle">
                                    <input type="checkbox" name="website" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff"> Website
                                    </td>
									<td valign="middle">
                                    <input type="checkbox" name="txt18" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff"> Database backup
                                    </td>
								</tr>
                              
                                <tr>
                                    <td height="5" colspan="6">&nbsp;</td>
                                </tr>
								<tr>
									<td align="right" colspan="3"><input type="button" value="Select All" name="btnsubmit" onClick="fnAll(this.form)" style="border:1px solid black">&nbsp;&nbsp;<input type="button" value="DeSelect All" name="btnsubmit" onClick="fnNotAll(this.form)" style="border:1px solid black">
                                    </td>
								</tr>
                               </table>
					</td>
				</tr>
                <tr>
                    <td height="5" colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6">						
                            <input type="submit" value="Submit" class="btn btn-primary">
                    </td>
                </tr>
            </table>	
					</form>
			<?php	
					}
				
			?>
           
            
            <div class="block">
			<?php
				if ($pg == 3)
					{
					$TXTid = mysqli_real_escape_string($db, $_GET['id']);
//exit;
			$select_content1=("select * from systemusers WHERE id='$TXTid'");
			$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
			$content1 = mysqli_fetch_assoc($content_result1);
			$num_chk1 = mysqli_num_rows ($content_result1);
			?> 			 <form action="userlist?pg=5" name="frmReg" method="post" enctype="multipart/form-data" onSubmit="return loginCheck(this);" ID="Form1">
						<table style="width:100%">
							 
							 <tr>
								<td ><b>Surname</b></td>
								<td  valign="top" colspan="3">
									<input type="text" name="sname" class="form-control" style="width:200px;" value="<?php echo $content1['surname']; ?>" />
								</td>
								<td ><b>Othernames</b></td>
								<td  valign="top" colspan="3">
									<input type="text" name="oname" class="form-control" style="width:200px;"  value="<?php echo $content1['fname']; ?>" />
								</td>
							</tr>
							
							<tr>
								<td ><b>UserName</b></td>
								<td  valign="top" colspan="3">
									<input type="text" name="username" class="form-control" style="width:200px;" value="<?php echo $content1['username']; ?>" disabled="disabled" />
								</td>
								<td ><b>Password</b></td>
								<td  valign="top" colspan="3">
									<input type="password" name="password" class="form-control" style="width:200px;" value="<?php echo $content1['password']; ?>" disabled="disabled"/>
								</td>
							</tr>
							
                            
                            <tr>
					<td height="5" colspan="6" style="padding-top:10px;">&nbsp;</td>
				</tr>
                
                <tr>
					<td colspan="6">
                    	<font face="verdana" style="font-size: 12px;">
                            	<b> Edit User Roles / Access</b>
                         
                     </td>
				</tr>
                
                <tr>
					<td height="5" colspan="6" style="border-top:1px solid #F00"></td>
				</tr>
                <tr>
					<td colspan="6">
							<table border="0" style="width:100%">
								
								<tr>
									<td valign="middle">
                                    	<input type="hidden" name="id" value="<?php echo $TXTid;?>" />
                                    	<input type="checkbox" name="txt1" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff" <?php if ($content1['controlpanel']  == 1){?> checked="checked" <?php } ?>> Control Panel
                                     </td>
									<td valign="middle">
                                    	<input type="checkbox" name="txt2" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff" <?php if ($content1['students']  == 1){?> checked="checked" <?php } ?>> Students
                                     </td>
									<td valign="middle">
                                    	<input type="checkbox" name="txt3" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff" <?php if ($content1['parents']  == 1){?> checked="checked" <?php } ?>> Parents
                                    </td>
                                    <td valign="middle">
                                    	<input type="checkbox" name="txt4" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff" <?php if ($content1['staff']  == 1){?> checked="checked" <?php } ?>> Staff
                                    </td>
								</tr>
								
								<tr >
									<td colspan="4"><b>&nbsp;</b></td>
								</tr>
								<tr>
									<td valign="middle"><input type="checkbox" name="txt5" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff" <?php if ($content1['messaging']  == 1){?> checked="checked" <?php } ?>>
                                    	Messaging
                                    </td>
									<td valign="middle"><input type="checkbox" name="txt6" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff" <?php if ($content1['students_attendance']  == 1){?> checked="checked" <?php } ?>>
                                    	Student Attendance
                                    </td>
                                    <td valign="middle"><input type="checkbox" name="txt7" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff" <?php if ($content1['time_table']  == 1){?> checked="checked" <?php } ?>>
                                    	Time-Table
                                    </td>
                                    <td valign="middle"><input type="checkbox" name="txt8" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff" <?php if ($content1['school_calendar']  == 1){?> checked="checked" <?php } ?>>
                                    	School Calender
                                    </td>
								</tr>
								
								<tr >
									<td colspan="3"><b>&nbsp;</b></td>
								</tr>
								<tr>
									<td valign="middle"><input type="checkbox" name="txt9" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff" <?php if ($content1['result_management']  == 1){?> checked="checked" <?php } ?>>
                                    	Result Management
                                    </td>
									<td valign="middle"><input type="checkbox" name="txt10" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff" <?php if ($content1['busary']  == 1){?> checked="checked" <?php } ?>>
                                    	Busary
                                    </td>
                                    <td valign="middle"><input type="checkbox" name="cbt" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff" <?php if ($content1['cbt']  == 1){?> checked="checked" <?php } ?>>
                                    	CBT
                                    </td>
                                    <td valign="middle"><input type="checkbox" name="txt11" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff" <?php if ($content1['book_shop']  == 1){?> checked="checked" <?php } ?>>
                                    	Book Shop
                                    </td>
                              
								</tr>
                               
                                <tr >
									<td colspan="3"><b>&nbsp;</b></td>
								</tr>
								<tr>
                                      <td valign="middle"><input type="checkbox" name="txt12" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff" <?php if ($content1['medical_records']  == 1){?> checked="checked" <?php } ?>>
                                    	Medical Records
                                    </td>
									<td valign="middle">
                                    <input type="checkbox" name="txt13" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff" <?php if ($content1['dormitories_mgt']  == 1){?> checked="checked" <?php } ?>> Domitories management
                                    </td>
									<td valign="middle">
                                    <input type="checkbox" name="txt14" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff" <?php if ($content1['library_mgt']  == 1){?> checked="checked" <?php } ?>> Library management
                                    </td>
                                    <td valign="middle">
                                    <input type="checkbox" name="txt15" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff" <?php if ($content1['file_upload']  == 1){?> checked="checked" <?php } ?>> File Upload
                                    </td>
								</tr>
                                
								<tr >
									<td colspan="3"><b>&nbsp;</b></td>
								</tr>
								<tr>
									<td valign="middle">
                                    <input type="checkbox" name="txt16" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff" <?php if ($content1['system_users']  == 1){?> checked="checked" <?php } ?>>System Users
                                    </td>
									<td valign="middle">
                                    <input type="checkbox" name="txt17" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff" <?php if ($content1['reports']  == 1){?> checked="checked" <?php } ?>>Reports
                                    </td>
                                    
                                    <td valign="middle">
                                    <input type="checkbox" name="website" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff" <?php if ($content1['website']  == 1){?> checked="checked" <?php } ?>>Website
                                    </td>
									<td valign="middle">
                                    <input type="checkbox" name="txt18" style="border-left-color: #ffffff; border-bottom-color: #ffffff; border-top-color: #ffffff; border-right-color: #ffffff" <?php if ($content1['db_backp']  == 1){?> checked="checked" <?php } ?>>Database backup
                                    </td>
								</tr>
                                <tr>
                                <tr>
                                    <td height="5" colspan="6">&nbsp;</td>
                                </tr>
								<tr>
									<td align="right" colspan="3"><input type="button" value="Select All" name="btnsubmit" onClick="fnAll(this.form)" style="border:1px solid black">&nbsp;&nbsp;<input type="button" value="DeSelect All" name="btnsubmit" onClick="fnNotAll(this.form)" style="border:1px solid black">
                                    </td>
								</tr>
                               </table>
					</td>
				</tr>
							<tr>
								<td height="5" colspan="6">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="6">						
										<input type="submit" value="Update" class="btn btn-primary">
								</td>
							</tr>
						</table>	
					</form>
			<?php	
					}
				
			?>
            
                    
      <?php
            if ($pg == 31)
                {
                                    
                $TXTid = mysqli_real_escape_string($db, $_GET['id']);
                $select_content2=("select * from systemusers where id  = '$TXTid'");
                $content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
                $content2 = mysqli_fetch_assoc($content_result2);
                                    
            ?>
            <h2> <?php echo  $content2['surname'] ." ". $content2['fname']?></h2>
            <p style="padding-top:20px; color:#F00"><?php echo $sql ?></p>
            <?php
				$select_content22=("select * from classes order by rank asc");
				$content_result22= mysqli_query($db, $select_content22) or die(mysqli_error($db));
				$content22 = mysqli_fetch_assoc($content_result22);
				$num_chk22 = mysqli_num_rows ($content_result22);
				
				if ($num_chk22 > 0)
				{

	?>
    					 <form method="post" action="?pg=12" name="frmReg">
    <?php
						
						do { 
							$select_content3=("select * from bursary_access  where adminid = '$TXTid'");
							$content_result3= mysqli_query($db, $select_content3) or die(mysqli_error($db));
							$content3 = mysqli_fetch_assoc($content_result3);
							$num_chk3 = mysqli_num_rows ($content_result3);
							
							$i =0;	
								$pp = false	;
								
								if($num_chk3 != 0){
									$cat = $content3["classid"];
									$splitted = explode(',',$cat);  
									$cnt = count($splitted); 
										 
									while($cnt > $i)  
										{  
											$val = mysqli_real_escape_string($db,$splitted[$i]);
											//echo $splitted[$i];
											if(intval($val) == intval($content22['id'])){
												$pp = true;
											
											}
											
										$i++; 
									}
									
								} 	
	?>						
							<p style="padding-top:20px;">
							<input style="border:0px" type="checkbox" name="category[]" value="<?php echo $content22['id']?>" <?php if($pp == true ){ ?> checked="checked"<?php }?>  /><?php echo $content22['class']?>
                            </p>
                            
                           
<?php				
				 			} while ($content22 = mysqli_fetch_assoc($content_result22)); 							
?>
							<p>
                            <input type="hidden"  value="<?php echo $TXTid; ?>" name="adminid"/>
                            <input type="submit" name="Submit" value="Update" class="btn btn-primary" />  
                            
                            </p>
						 </form>
<?php
				
					}

				}

?>
            
			
			<?php
			
				if ($pg == "")
				
						{
			
			?>
							<span style="font-family:Arial, Helvetica, sans-serif;font-size:11px;color:#FF0000"><?php echo $sql; ?></span>
							<table class="table table-striped responsive-utilities jambo_table" id="dataTables-example">
								<thead>
								<tr>
									<th>S/N</th>
									<th>User Name</th>
									<th>Date Created</th>
                                    <th>Access/Role</th>
                                    <th>Bursary Classes</th>
									<th>&nbsp;</th>
									<th>&nbsp;</th>
								</tr>
								</thead>
								<tbody>
			
			
			<?php
						$select_content=("select * from systemusers order by id desc");
						$content_result= mysqli_query($db, $select_content) or die(mysqli_error($db));
						$content = mysqli_fetch_assoc($content_result);
						$num_chk = mysqli_num_rows ($content_result);
						$k = 0
			?>
			<?php
			if ($num_chk == 0)
				{
			?>
								<tr height="23" onMouseOver="this.style.backgroundColor='#FFCC66';" onMouseOut="this.style.backgroundColor='';" bgcolor="#EFEFEF">
									<td colspan="5"  align="center">No Record Found</td>
								</tr>	
			<?php
			}
				else
			{
			?>
			<?php do { 
						$color = "#f5f5f5";
						$x < $num_chk;
						$x=$x+1;
						
							if($x%2 == 0)
								{
									$color = "#ffffff";
								}
								
						$k = $k + 1;
						?>
								<tr>
									<td><?php echo $k  ?></td>
									<td><?php  echo ucfirst($content['username'])?></td>
									<td><?php  echo ucfirst($content ['xdate'])?></td>
                                    <td>
                                    	<a style="color:#FF0000" href="userlist?id=<?php  echo ($content ['id'])?>&pg=3">
                                        	Edit user role
                                         </a>
                                     </td>
                                     <td>
                                     <?php if ($content['busary'] == 1)
												{
					
										?>
                                    	<a style="color:#03C" href="userlist?id=<?php  echo ($content ['id'])?>&pg=31">
                                        	Edit Bursary
                                         </a>
                                         <?php
												}
										?>
                                     </td>
									<td>
										<?php if ($content['status'] == 1)
												{
					
										?>
											<a style="color:#FF0000" href="userlist.php?id=<?php  echo ($content ['id'])?>&v=0&pg=7" target="_parent">Activate</a>
										<?php 
												}
												
											else
												{
										?>
												<a style="color:#FF0000" href="userlist.php?id=<?php  echo ($content ['id'])?>&v=1&pg=7" target="_parent">De-Activate</a>
										<?php
												
												}
										?>
									</td>
									<td>
											<a style="color:#FF0000" href="userlist.php?id=<?php  echo ($content['id'])?>&pg=8&m=<?php  echo ($content ['email'])?>" target="_parent">
													Reset Password
											</a>
									</td>
								</tr>
						 <?php } while ($content = mysqli_fetch_assoc($content_result)); ?>
			<?php 
				}
			?>
			<?php
			}
			?>
			</tbody>
			</table>
                            </div>
                        </div>
                    </div>
                </div>
                
                
              
                
 <!-- footer content -->
               <?php include("includes/footer.php")?>

<script LANGUAGE="JavaScript">
	
function fnAll(obj)
		{
			for(var i = 0; i < obj.elements.length; i++){
				if(obj.elements[i].type == "checkbox")
				{
					obj.elements[i].checked=true;
				}
			}
		}
		
		function fnNotAll(obj)
		{
			for(var i = 0; i < obj.elements.length; i++){
				if(obj.elements[i].type == "checkbox" && obj.elements[i].name != "password")
				{
					obj.elements[i].checked=false;
				}
			}
		}
</script>	


<script language="javascript">
function loginCheck() {

if(document.frmReg.sname.value == "") {
alert ("Please enter SurName")
document.frmReg.sname.focus();
return false
}
if(document.frmReg.oname.value == "") {
alert ("Please enter OtherNames")
document.frmReg.oname.focus();
return false
}
if(document.frmReg.username.value == "") {
alert ("Please enter UserName")
document.frmReg.username.focus();
return false
}
if(document.frmReg.password.value == "") {
alert ("Please enter Password")
document.frmReg.password.focus();
return false
}

if(document.frmReg.email.value == "") {
alert ("Please enter Email Address")
document.frmReg.email.focus();
return false
}

if(document.frmReg.cat.value == "") {
alert ("Please select User's Category")
document.frmReg.cat.focus();
return false
}
else {
return true
}

}
</script>
<script language="JavaScript" type="text/javascript">

function confirmDel(){ // to confirm delete action before url is sent
	//confirm("Do you want to delete this item?");
	if (confirm("Do you want to delete this?")) {
       return true;
    }	
	return false;
}
</script>

<?php
}
else
	{
		$sql= "<b>Warning: You do not have access to the module you clicked on.... Contact System administrator<b>";
		
		echo "
			<script language='javascript'>
				location.href='dashboard?logout=1&sql=$sql'
			</script>
		";
		exit();
			
}
?>
