<?php require_once("includes/session.php"); ?>
<?php confirm_logged_in(); ?>
<?php
require_once ('../connection.php');
$xID = $_SESSION["ustcode"];
?>
<?php
	$pg = $_GET['pg'];
	$pp = $_GET['pp'];
	$pv = $_GET['pv'];
	$sql = $_GET['sql'];
	
	if ($pg == 9){	
		$xdate = date("Y-m-d");
		if(isset($_POST["upload"])){
			$fp = fopen($_FILES['image']['tmp_name'], "r");
			$no = 0;
			while($line = fgets($fp))
			{
				if($no != 0){
					list($sn, $on, $oc, $phone, $email, $employdate, $username) = split("\t", $line, 7);
					$passkey = md5("password");
					$username = strtolower($username);
					mysqli_query($db, "insert into staff_records SET class='1', surname='$sn', othername='$on', employdate='$employdate', Position='$oc',  phone='$phone', xdate='$xdate', password = '$passkey',  username='$username', email='$email', user='$xID' ") or die(mysqli_error($db));
				}
				$no++;
			}
		$pg = "";
		$sql= "<b>Operation was Successful: Record Inserted<b>";
		}
	}
?>

<?php
	if ($pg == 8)
	
		{
			$sn = mysqli_real_escape_string($db, $_POST['sn']);
			$on = mysqli_real_escape_string($db, $_POST['on']);
			$ra = mysqli_real_escape_string($db, $_POST['ra']);
			$oc = mysqli_real_escape_string($db, $_POST['oc']);
			$email = mysqli_real_escape_string($db, $_POST['email']);
			$phone = mysqli_real_escape_string($db, $_POST['phone']);
			$username = mysqli_real_escape_string($db, $_POST['user']);
			$pass = mysqli_real_escape_string($db, $_POST['pass']);
			$typeid = mysqli_real_escape_string($db, $_POST['typeid']);
			$class = mysqli_real_escape_string($db, $_POST['class']);
			$nname = mysqli_real_escape_string($db, $_POST['nname']);
			$naddress = mysqli_real_escape_string($db, $_POST['naddress']);
			$nemail = mysqli_real_escape_string($db, $_POST['nemail']);
			$nphone = mysqli_real_escape_string($db, $_POST['nphone']);
			$sex = mysqli_real_escape_string($db, $_POST['sex']);
			$employdate = mysqli_real_escape_string($db, $_POST['employdate']);
			$webcampPic = mysqli_real_escape_string($db, $_POST['webcampPic']);
			
			$bdate =mysqli_real_escape_string($db, $_POST['bdate']);
			$state = mysqli_real_escape_string($db, $_POST['stateo']);
			$lga = mysqli_real_escape_string($db, $_POST['lga']);
			$mstatus = mysqli_real_escape_string($db, $_POST['mstatus']);
			$town = mysqli_real_escape_string($db, $_POST['town']);
			$bvn = mysqli_real_escape_string($db, $_POST['bvn']);
			$acctype = mysqli_real_escape_string($db, $_POST['acctype']);
			$dept =mysqli_real_escape_string($db, $_POST['dept']);
			$eid =mysqli_real_escape_string($db, $_POST['eid']);
			$eposition = mysqli_real_escape_string($db, $_POST['eposition']);
			$accno = mysqli_real_escape_string($db, $_POST['accno']);
			$bank = mysqli_real_escape_string($db, $_POST['bank']);
			$tin =mysqli_real_escape_string($db, $_POST['tin']);
			$taxamount = str_replace(",", "", mysqli_real_escape_string($db, $_POST['taxamount']));
			$taxable =mysqli_real_escape_string($db, $_POST['taxable']);
			$nhn =mysqli_real_escape_string($db, $_POST['nhn']);
			$dater = mysqli_real_escape_string($db, $_POST['dater']);
			$grade = mysqli_real_escape_string($db, $_POST['grade']);
			$class = mysqli_real_escape_string($db, $_POST['class']);
			$salarys = mysqli_real_escape_string($db, $_POST['salarys']);
			$location = mysqli_real_escape_string($db, $_POST['location']);
			
			$xdate = date("Y-m-d");
			
		  $var1 = mt_rand(1,19);
		  $var2 = mt_rand(1,15);
		  $var3 = mt_rand(1,10);
			  
		  $rand = $var1."".$var2."".$var3."".$var4;
			  
		  $fVariable = time();
		  //$pass = substr($fVariable,2, 5)."".$rand;
		  if($pass == '') $pass = "password";
		  $passkey = md5($pass);
		  
			
			
			  
		 if($_FILES['image']['name']){
			$errors= array();
			$file_name = $_FILES['image']['name'];
			$file_size =$_FILES['image']['size'];
			$file_tmp =$_FILES['image']['tmp_name'];
			$file_type=$_FILES['image']['type'];   
			$file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));		
			$expensions= array("jpeg","jpg","png","gif"); 		
			if(in_array($file_ext,$expensions)=== false){
				$errors[]="extension not allowed, please choose a JPEG or PNG file.";
			}
			if($file_size > 2097152){
			$errors[]='File size must be excately 2 MB';
			}				
			if(empty($errors)==true){
				move_uploaded_file($file_tmp,"uploads/staff/".$file_name);
				//echo "Success ". $file_name;
			}else{
				print_r($errors);
			}
			$webcampPic = $_FILES['image']['name'];
		}
			
		mysqli_query($db, "insert into staff_records SET class='$class', surname='$sn', othername='$on', sex='$sex', typeid='$typeid', qualification='$oc',  residential='$ra', email='$email', phone='$phone', xdate='$xdate', password = '$passkey', passport='$webcampPic', username='$username', employdate='$employdate', nname='$nname', naddress='$naddress', nemail='$nemail', nphone='$nphone', user='$xID', bdate='$bdate', state='$state', dept='$dept', employeeid='$eid', position='$eposition', locat='$location', accno='$accno', bank='$bank', acctype='$acctype', bvn='$bvn', taxid='$tin', taxamount='$taxamount', not_taxable = '$taxable', nationalHouseNo='$nhn', lga='$lga', married_status='$mstatus', town='$town', dateRetired='$dater', grade='$grade', step='$class', salaryStru='$salarys' ") or die(mysqli_error($db));
			
			$sql= "<b>Operation was Successful: Record Inserted<b> Your Password is: ".$pass ;

	echo "
			<script language='javascript'>
				location.href='staff?sql=$sql'
			</script>
		";			
		}
?>


<?php
	if ($pg == 2)
	
		{ 
			$sn = mysqli_real_escape_string($db, $_POST['sn']);
			$on = mysqli_real_escape_string($db, $_POST['on']);
			$ra = mysqli_real_escape_string($db, $_POST['ra']);
			$oc = mysqli_real_escape_string($db, $_POST['oc']);
			$email = mysqli_real_escape_string($db, $_POST['email']);
			$phone = mysqli_real_escape_string($db, $_POST['phone']);
			$username = mysqli_real_escape_string($db, $_POST['user']);
			$pass = mysqli_real_escape_string($db, $_POST['pass']);
			$typeid = mysqli_real_escape_string($db, $_POST['typeid']);
			$class = mysqli_real_escape_string($db, $_POST['class']);
			$nname = mysqli_real_escape_string($db, $_POST['nname']);
			$naddress = mysqli_real_escape_string($db, $_POST['naddress']);
			$nemail = mysqli_real_escape_string($db, $_POST['nemail']);
			$nphone = mysqli_real_escape_string($db, $_POST['nphone']);
			$sex = mysqli_real_escape_string($db, $_POST['sex']);
			$employdate = mysqli_real_escape_string($db, $_POST['employdate']);
			$webcampPic = mysqli_real_escape_string($db, $_POST['webcampPic']);
			
			$bdate =mysqli_real_escape_string($db, $_POST['bdate']);
			$state = mysqli_real_escape_string($db, $_POST['stateo']);
			$lga = mysqli_real_escape_string($db, $_POST['lga']);
			$mstatus = mysqli_real_escape_string($db, $_POST['mstatus']);
			$town = mysqli_real_escape_string($db, $_POST['town']);
			$bvn = mysqli_real_escape_string($db, $_POST['bvn']);
			$acctype = mysqli_real_escape_string($db, $_POST['acctype']);
			$dept =mysqli_real_escape_string($db, $_POST['dept']);
			$eid =mysqli_real_escape_string($db, $_POST['eid']);
			$eposition = mysqli_real_escape_string($db, $_POST['eposition']);
			$accno = mysqli_real_escape_string($db, $_POST['accno']);
			$bank = mysqli_real_escape_string($db, $_POST['bank']);
			$tin =mysqli_real_escape_string($db, $_POST['tin']);
			$taxamount = str_replace(",", "", mysqli_real_escape_string($db, $_POST['taxamount']));
			$taxable =mysqli_real_escape_string($db, $_POST['taxable']);
			$nhn =mysqli_real_escape_string($db, $_POST['nhn']);
			$dater = mysqli_real_escape_string($db, $_POST['dater']);
			$grade = mysqli_real_escape_string($db, $_POST['grade']);
			$class = mysqli_real_escape_string($db, $_POST['class']);
			$salarys = mysqli_real_escape_string($db, $_POST['salarys']);
			$location = mysqli_real_escape_string($db, $_POST['location']);
			
			$xdate = date("Y-m-d");
			$webcampPic = $_POST['webcampPic'];
			 $TXTid = $_POST['id'];
			
			if($_FILES['image']['name']){
				// Delete Old Image first
				$file = "uploads/staff/$webcampPic";
				unlink($file);
				
				$errors= array();
				$file_name = $_FILES['image']['name'];
				$file_size =$_FILES['image']['size'];
				$file_tmp =$_FILES['image']['tmp_name'];
				$file_type=$_FILES['image']['type'];   
				$file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));		
				$expensions= array("jpeg","jpg","png","gif"); 		
				if(in_array($file_ext,$expensions)=== false){
					$errors[]="extension not allowed, please choose a JPEG or PNG file.";
				}
				if($file_size > 2097152){
				$errors[]='File size must be excately 2 MB';
				}				
				if(empty($errors)==true){
					move_uploaded_file($file_tmp,"uploads/staff/".$file_name);
					//echo "Success ". $file_name;
				}else{

					print_r($errors);
				}
				$webcampPic = $_FILES['image']['name'];
			}				
				mysqli_query($db, "UPDATE staff_records SET class='$class', surname='$sn', othername='$on', sex='$sex', typeid='$typeid', qualification='$oc',  residential='$ra', email='$email', phone='$phone', xdate='$xdate', passport='$webcampPic', username='$username', employdate='$employdate', nname='$nname', naddress='$naddress', nemail='$nemail', nphone='$nphone', user='$xID', bdate='$bdate', state='$state', dept='$dept', employeeid='$eid', position='$eposition', locat='$location', accno='$accno', bank='$bank', acctype='$acctype', bvn='$bvn', taxid='$tin', taxamount='$taxamount', not_taxable = '$taxable', nationalHouseNo='$nhn', lga='$lga', married_status='$mstatus', town='$town', dateRetired='$dater', grade='$grade', step='$class', salaryStru='$salarys' WHERE gid = '$TXTid'") or die(mysqli_error($db));
			
			$sql= "<b>Operation was Successful: Changes made<b>";
			$p = $_GET["p"]; 
			if($pp != 1){
			echo "
				<script language='javascript'>
					location.href='staff?sql=$sql'
				</script>
			";	
			}
			else{
				echo "
				<script language='javascript'>
					location.href='staff-information?sql=$sql&id=$TXTid'
				</script>
			";	
			}
		}
?>

<?php
	if ($pg == 9)
	{
		$TXTid = $_GET['id'];
		$xdate = date("Y-m-d");
		$pass = md5("password");
		mysqli_query($db, "UPDATE staff_records SET  password = '$pass', user='$xID' WHERE gid = '$TXTid'") or die(mysqli_error($db));

		$sql= "<b>Operation was Successful: Password Reset to password. Login and change it<b>";
		echo "
			<script language='javascript'>
				location.href='staff?sql=$sql'
			</script>
		";
	}
	
	if ($pg == 5)
	{
		$TXTid = $_GET['id'];
		if ($_GET['st'] == 0){$sta =1; } else {$sta = 0;}
		mysqli_query($db, "Update staff_records SET status='$sta' where gid = '$TXTid' ") or die(mysqli_error($db)) ;
		$sql = "Operation was Successful";
		echo "
			<script language='javascript'>
				location.href='staff?sql=$sql'
			</script>
		";
	}
?>

<?php
	if ($pg == 7)
		{
			$TXTid = $_GET['id'];
			$select_content1=("select * from staff_records WHERE gid='$TXTid'");
			$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
			$content1 = mysqli_fetch_assoc($content_result1);
			$num_chk1 = mysqli_num_rows ($content_result1);
			
			}
?>

<?php
/*	if ($pg == 6)
	
		{
		
			$TXTid = $_GET['id'];
			$pcode = $_GET['pcode'];
			if($pcode != ""){
				$file = "uploads/studentpassport/$pcode";
				unlink($file);
			}
			mysqli_query($db, "delete from staff_records where gid = '$TXTid' ") or die(mysqli_error($db)) ;
			$sql = "Operation was Successful: 1 Item deleted";
			header ("location:staff?sql=$sql");
		}*/
	
	include("header.php");
?>
<script type="text/javascript">
	$(document).ready(function () {
		$('#birthday').daterangepicker({
			singleDatePicker: true,
			calender_style: "picker_4"
		}, function (start, end, label) {
			console.log(start.toISOString(), end.toISOString(), label);
		});
	});
	////////////////////////////////////
	
	$(document).ready(function () {
		$('#emdate').daterangepicker({
			singleDatePicker: true,
			calender_style: "picker_4"
		}, function (start, end, label) {
			console.log(start.toISOString(), end.toISOString(), label);
		});
	});
	////////////////////////////////
	
	$(document).ready(function () {
		$('#dater').daterangepicker({
			singleDatePicker: true,
			calender_style: "picker_4"
		}, function (start, end, label) {
			console.log(start.toISOString(), end.toISOString(), label);
		});
	});
</script>
            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Staff Record</h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-7 col-sm-7 col-xs-12 form-group pull-right top_search">
                            	 <a href="dashboard" class="btn btn-sm btn-success">Dashboard</a>
                                 <a href="staff?pg=1" class="btn btn-sm btn-dark">New Staff</a>
                                 <a href="staff?pg=4" class="btn btn-sm btn-dark">Batch Upload</a>
                                  <a href="staff-list" class="btn btn-sm btn-primary" target="_blank">Staff List</a>
                                 <a href="staff" class="btn btn-sm btn-warning">View Staff</a>
                                 <a href="classes" class="btn btn-sm btn-dark">Classes</a>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">

                        
                                <?php
								if ($pg == 1)
									{
							?> 	
                            <form method="post" action="?pg=8" name="frmReg" onsubmit="return loginCheck()" enctype="multipart/form-data">
                            <div class="col-md-6 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_title">
                                    <h2>Personal Information</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                
                                <div class="x_content">
                                    <br />
										<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Surname" name="sn">
                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                        </div>

                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                            <input type="text" class="form-control" id="inputSuccess3" placeholder="Firstname & Othername" name="on">
                                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                        </div>                                    
                                      <div class="form-group">
                                        	<label class="control-label col-md-3 col-sm-3 col-xs-12">Title </label>
												<div class="col-md-9 col-sm-9 col-xs-12">
												 <select name="class" class="select2_single form-control" tabindex="-1" >
													  <option value="">--Select Title</option>
													  <?php
															$select_content2=("select * from title  order by class asc");
															$content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
															$content2 = mysqli_fetch_assoc($content_result2);
															$num_chk2 = mysqli_num_rows ($content_result2);
															$k = 0
														?>
													  <?php do { 	?>
													  <option value="<?php echo  $content2['id']?>"><?php echo  $content2['class']?></option>
													  <?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
													</select>
                                                 </div>
                                           </div>
                                        
                                         <div class="form-group">
                                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                                             	<div class="col-md-9 col-sm-9 col-xs-12">
                                                <select id="select" name="sex" class="select2_single form-control" tabindex="-1">
                                                    <option value="">Select</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                                </div>
                                           </div>
                                           <div class="form-group">
                                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                                             	<div class="col-md-9 col-sm-9 col-xs-12">
                                                <select id="select" name="mstatus" class="select2_single form-control" tabindex="-1">
                                                    <option value="">Select</option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Divorce">Divorce</option>
                                                </select>
                                                </div>
                                           </div>
                                          <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span>
                                            </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="bdate" id="birthday" class="date-picker form-control col-md-7 col-xs-12" type="text">
                                            </div>
                                        </div>
                                        
                                </div>
                            </div>
                            </div>
                            
                            <div class="col-md-6 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_title">
                                    <h2>Contact Information</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                
                                <div class="x_content">
                                    <br />
                                         
                                         <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                            <input type="email" name="email" class="form-control has-feedback-left" id="inputSuccess4" placeholder="Email">
                                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                        </div>

                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                            <input type="text" name="phone" class="form-control" id="inputSuccess5" placeholder="Phone" onkeydown="return digistOnly()">
                                            <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
												<input type="text" class="form-control" name="ra" />
                                              </div>
                                         </div>
										
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Home Town </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="town" class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                             <label class="control-label col-md-3 col-sm-3 col-xs-12">State</label>
                                             	<div class="col-md-9 col-sm-9 col-xs-12">
                                                <select id="stateid" name="state" class="select2_single form-control" tabindex="-1" onchange="return loadLGA()">
                                                    <option value="">Select</option>
                                                    <?php
															$select_content2=("select * from states order by name asc");
															$content_result2= mysqli_query($db, $select_content2) or die (mysqli_error($db));
															$content2 = mysqli_fetch_assoc($content_result2);
															$num_chk2 = mysqli_num_rows ($content_result2);
															$k = 0
														?>
														<?php do { 	?>
															<option value="<?php echo  $content2['stateid']?>"><?php echo  $content2['name']?></option>
																										
														<?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
                                                </select>
                                                </div>
                                         </div>
                                         <div class="form-group">
                                             <label class="control-label col-md-3 col-sm-3 col-xs-12">L.G.A</label>
                                             	<div class="col-md-9 col-sm-9 col-xs-12">
                                                <select id="lgaid" name="lga" class="select2_single form-control" tabindex="-1">
                                                    <option value="">Select</option>
                                                </select>
                                                </div>
                                         </div>
                                         
                                         <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                            &nbsp;
                                        </div> 
                                </div>
                            </div>
                            </div>
                            
                            
                            <div class="col-md-6 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_title">
                                    <h2>School Information</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                
                                <div class="x_content">
                                    <br />
                                    <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Staff ID </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="eid" class="form-control" type="text">
                                            </div>
                                     </div>
                                    <div class="form-group">
                                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Staff Type</label>
                                             	<div class="col-md-9 col-sm-9 col-xs-12">
                                                <select id="select" name="typeid" class="select2_single form-control" tabindex="-1">
													  <option value="">--Select Type</option>
													  <?php
															$select_content2=("select * from stafftype  order by sid asc");
															$content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
															$content2 = mysqli_fetch_assoc($content_result2);
															$num_chk2 = mysqli_num_rows ($content_result2);
															$k = 0
														?>
													  <?php do { 	?>
													  <option value="<?php echo  $content2['sid']?>"><?php echo  $content2['type']?></option>
													  <?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
													</select>
                                                   </div>
                                            </div>
                                         <div class="form-group">
                                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Department</label>
                                             	<div class="col-md-9 col-sm-9 col-xs-12">
                                                <select id="dept" name="dept" class="select2_single form-control" tabindex="-1">
													  <?php
															$select_content2=("select * from department order by department asc");
															$content_result2= mysqli_query($db, $select_content2) or die (mysqli_error($db));
															$content2 = mysqli_fetch_assoc($content_result2);
															$num_chk2 = mysqli_num_rows ($content_result2);
															$k = 0
														?>
														<?php do { 	?>
															<option value="<?php echo  $content2['did']?>"><?php echo  $content2['department']?></option>
																										
														<?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
													</select>
                                                   </div>
                                            </div>
									<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Qualification </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="oc" class="form-control" type="text">
                                            </div>
                                     </div>
                                     
                                      <div class="form-group">
                                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Position</label>
                                             	<div class="col-md-9 col-sm-9 col-xs-12">
                                                    <select id="position" name="eposition" class="select2_single form-control" tabindex="-1">
													  <?php
															$select_content2= "select * from positions order by position asc";
															$content_result2= mysqli_query($db, $select_content2) or die (mysqli_error($db));
															$content2 = mysqli_fetch_assoc($content_result2);
															$num_chk2 = mysqli_num_rows ($content_result2);
															$k = 0
														?>
														<?php do { 	?>
															<option value="<?php echo  $content2['pid']?>"><?php echo  $content2['position']?></option>
																										
														<?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
													</select>
                                                   </div>
                                            </div>
                                            <div class="form-group">
                                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Location</label>
                                             	<div class="col-md-9 col-sm-9 col-xs-12">
                                                <select name="location" class="select2_single form-control" tabindex="-1"><?php
															$select_content2=("select * from branches order by sname asc");
															$content_result2= mysqli_query($db, $select_content2) or die (mysqli_error($db));
															$content2 = mysqli_fetch_assoc($content_result2);
															$num_chk2 = mysqli_num_rows ($content_result2);
															$k = 0
														?>
													<?php do { 	?>
													<option value="<?php echo  $content2['id']?>"><?php echo  $content2['sname']?></option>
													<?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
													</select>
                                                   </div>
                                            </div>
                                            

                                     <div class="form-group">
                                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Grade</label>
                                             	<div class="col-md-9 col-sm-9 col-xs-12">
                                                <select id="grade" name="grade" class="select2_single form-control" tabindex="-1">
													 <?php 
														$c = 1;
														do { 	?>
															<option value="<?php echo  $c;?>"><?php echo  $c;?></option>
																										
														<?php $c++; } while ($c < 18); ?>
													</select>
                                                   </div>
                                            </div>
                                            <div class="form-group">
                                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Level</label>
                                             	<div class="col-md-9 col-sm-9 col-xs-12">
                                                <select id="class" name="class" class="select2_single form-control" tabindex="-1">
													  <?php 
														$c = 1;
														do { 	?>
															<option value="<?php echo  $c;?>"><?php echo  $c;?></option>
																										
														<?php $c++; } while ($c < 16); ?>
													</select>
                                                   </div>
                                            </div>
                                      <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Retired Date </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="dater" id="dater" class="date-picker form-control col-md-7 col-xs-12" type="text">
                                            </div>
                                     </div>
                                     <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Employment Date </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="employdate" id="emdate" class="date-picker form-control col-md-7 col-xs-12" type="text">
                                            </div>
                                     </div>
                                     <div class="form-group">
                                            &nbsp;
                                     </div>
                                     
                                   <h2>Tax Information</h2>  
                                   
                                   <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">TIN </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="tin" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Tax Identification Number">
                                            </div>
                                     </div>
                                    <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">NH No </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="nhn" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="National Housing No">
                                            </div>
                                     </div>
                                    
                                    <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tax Amount </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="taxamount" id="emdate" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="(If not using Tax General formula)">
                                            </div>
                                     </div>
                                     
                                     <div class="form-group">
                                            &nbsp;
                                     </div>
                                     
                                    <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">No Tax? </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="checkbox" name="taxable" id="taxable" class="flat" /> Check if Tax is not Applicable
                                            </div>
                                     </div>
                                     
                                     <div class="form-group">
                                            &nbsp;
                                     </div>
                                     
                                    <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Attach Salary Structure </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="salarys" type="checkbox" value="1" class="flat" />  Use Grade Level/Step for Salary Structure
                                            </div>
                                     </div>
                                        
                                </div>
                            </div>
                            </div>
                            
                            <div class="col-md-6 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_title">
                                    <h2>Bank Information</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                
                                <div class="x_content">
                                    <br />
                                   <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                            <input type="text" name="bvn" class="form-control has-feedback-left" id="inputSuccess4" placeholder="BVN" onkeydown="return digistOnly()">
                                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                        </div>

                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                            <input type="text" name="accno" class="form-control" id="inputSuccess5" placeholder="Account No." onkeydown="return digistOnly()">
                                            <span class="fa fa-barcode form-control-feedback right" aria-hidden="true"></span>
                                        </div>
                                        
                                        <div class="form-group">
                                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Acc Type</label>
                                             	<div class="col-md-9 col-sm-9 col-xs-12">
                                                <select id="select" name="acctype" class="select2_single form-control" tabindex="-1">
                                                    <option value="">Select</option>
                                                    <option value="Savings">Savings</option>
                                                    <option value="Current">Current</option>
                                                </select>
                                                </div>
                                         </div>
                                         <div class="form-group">
                                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Bank</label>
                                             	<div class="col-md-9 col-sm-9 col-xs-12">
                                                <select id="select" name="bank" class="select2_single form-control" tabindex="-1">
                                                    <option value="">Select</option>
                                                    <?php
                                                            $select_content2=("select * from banks   order by accname asc");
                                                            $content_result2= mysqli_query($db, $select_content2) or trigger_error(mysqli_error());
                                                            $content2 = mysqli_fetch_assoc($content_result2);
                                                            $num_chk2 = mysqli_num_rows ($content_result2);
                                                            $k = 0
                                                        ?>
                                                    <?php do { 	?>
                                                    <option value="<?php echo  $content2['id']?>"><?php echo  $content2['accname']?></option>
                                                    <?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
                                                </select>
                                                </div>
                                         </div>
                                        
                                        
                                </div>
                            </div>
                            </div>
                            
                            <div class="col-md-6 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_title">
                                    <h2>Login Information</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                
                                <div class="x_content">
                                    <br />
                                   <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Username </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="user" class="form-control" type="text">
                                            </div>
                                     </div>
                                    <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Password </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="pass" class="form-control" type="text">
                                            </div>
                                     </div>
                                    <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Re-password </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="pass2" class="form-control" type="text">
                                            </div>
                                     </div>
                                        
                                </div>
                            </div>
                            </div>
                            
                            <div class="col-md-6 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_title">
                                    <h2>Next of Kin Information</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                
                                <div class="x_content">
                                    <br />
                                   <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Fullname </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="nname" class="form-control" type="text">
                                            </div>
                                     </div>
                                   <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Address </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="naddress" class="form-control" type="text">
                                            </div>
                                     </div>
                                   <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Email </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="nemail" class="form-control" type="email">
                                            </div>
                                     </div>
                                    <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="nphone" class="form-control" type="text" onkeydown="return digistOnly()">
                                            </div>
                                     </div>
                                        
                                </div>
                            </div>
                            </div>
                            
                            <div class="col-md-6 col-xs-12">
                            <div class="x_panel">
                                
                                
                                <div class="x_content">
                                    <br />
                                   <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Photo</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="file" name="image" />
                                                <input type="hidden" name="webcampPic"  />
                                                <div id="photos"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                        &nbsp;
                                        </div>
                                        
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                                <input  type="submit" class="btn btn-primary" value="  Submit  " />
                                            </div>
                                        </div>
                                        
                                        
                                        
                                </div>

                                     
									
                                    <div id="camera">
                                            <span class="camTop"></span>
                                            <div id="screen"></div>
                                            <div id="buttons">
                                                <a id="shootButton" href="" class="blueButton">Snap!</a>
                                                <a id="cancelButton" href="" class="blueButton">Cancel</a> <a id="uploadButton" href="" class="greenButton">Upload!</a>
                                                <input  type="hidden" value="3" id="pageid" />
                                            </div>
                                            
                                            <span class="settings"></span>
                                         </div>
                                    </div>
                                  </div></form>
							<?php	
									}
								
							?>
							
							<?php
								if ($pg == 7)
									{
							?>
                            
						<form method="post" action="?pg=2&<?php if($pp == 1){?>pp=1<?php } else{?>pp=2<?php } ?>" name="frmReg" onsubmit="return loginCheck()" enctype="multipart/form-data">
							<input type="hidden"  name="id" value="<?php echo $content1["gid"] ?>"/>
							<input type="hidden"  name="pcode" value="<?php echo $content1["passport"] ?>"/>
                            <div class="col-md-6 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_title">
                                    <h2>Personal Information</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                
                                <div class="x_content">
                                    <br />
										<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                            <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Surname" name="sn" value="<?php echo $content1["surname"] ?>">
                                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                        </div>

                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                            <input type="text" class="form-control" id="inputSuccess3" placeholder="Firstname & Othername" name="on" value="<?php echo $content1["othername"] ?>">
                                            <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                        </div>                                    
                                      <div class="form-group">
                                        	<label class="control-label col-md-3 col-sm-3 col-xs-12">Title </label>
												<div class="col-md-9 col-sm-9 col-xs-12">
												 <select name="class" class="select2_single form-control" tabindex="-1" >
													  <option value="">--Select Title</option>
													  <?php
															$select_content2=("select * from title  order by class asc");
															$content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
															$content2 = mysqli_fetch_assoc($content_result2);
															$num_chk2 = mysqli_num_rows ($content_result2);
															$k = 0
														?>
													  <?php do { 	?>
													  <option value="<?php echo  $content2['id']?>" <?php if($content2['id'] == $content1['class']){?> selected="selected" <?php } ?>><?php echo  $content2['class']?></option>
													  <?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
													</select>
                                                 </div>
                                           </div>
                                        
                                         <div class="form-group">
                                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                                             	<div class="col-md-9 col-sm-9 col-xs-12">
                                                <select id="select" name="sex" class="select2_single form-control" tabindex="-1">
                                                    <option value="">Select</option>
                                                    <option value="Male" <?php if("Male" == $content1['sex']){?> selected="selected" <?php } ?>>Male</option>
                                                    <option value="Female" <?php if("Female" == $content1['sex']){?> selected="selected" <?php } ?>>Female</option>
                                                </select>
                                                </div>
                                           </div>
                                           <div class="form-group">
                                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                                             	<div class="col-md-9 col-sm-9 col-xs-12">
                                                <select id="select" name="mstatus" class="select2_single form-control" tabindex="-1">
                                                    <option value="">Select</option>
                                                    <option value="Single" <?php if("Single" == $content1['married_status']){?> selected="selected" <?php } ?>>Single</option>
                                                    <option value="Married" <?php if("Married" == $content1['married_status']){?> selected="selected" <?php } ?>>Married</option>
                                                    <option value="Divorce" <?php if("Divorce" == $content1['married_status']){?> selected="selected" <?php } ?>>Divorce</option>
                                                </select>
                                                </div>
                                           </div>
                                          <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span>
                                            </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="bdate" id="birthday" class="date-picker form-control col-md-7 col-xs-12" type="text" value="<?php echo $content1["bdate"] ?>">
                                            </div>
                                        </div>
                                        
                                </div>
                            </div>
                            </div>
                            
                            <div class="col-md-6 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_title">
                                    <h2>Contact Information</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                
                                <div class="x_content">
                                    <br />
                                         
                                         <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                            <input type="email" name="email" class="form-control has-feedback-left" id="inputSuccess4" placeholder="Email" value="<?php echo $content1["email"] ?>">
                                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                        </div>

                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                            <input type="text" name="phone" class="form-control" id="inputSuccess5" placeholder="Phone" onkeydown="return digistOnly()" value="<?php echo $content1["phone"] ?>">
                                            <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
												<input type="text" class="form-control" name="ra" value="<?php echo $content1["residential"] ?>" />
                                              </div>
                                         </div>
										
										<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Home Town </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="town" class="form-control" type="text" value="<?php echo $content1["town"] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                             <label class="control-label col-md-3 col-sm-3 col-xs-12">State</label>
                                             	<div class="col-md-9 col-sm-9 col-xs-12">
                                                <select id="stateid" name="state" class="select2_single form-control" tabindex="-1" onchange="return loadLGA()">
                                                    <option value="">Select</option>
                                                    <?php
															$select_content2=("select * from states order by name asc");
															$content_result2= mysqli_query($db, $select_content2) or die (mysqli_error($db));
															$content2 = mysqli_fetch_assoc($content_result2);
															$num_chk2 = mysqli_num_rows ($content_result2);
															$k = 0
														?>
														<?php do { 	?>
                                                        <option value="<?php echo  $content2['stateid']?>" <?php if($content2['stateid'] == $content1['state']){?> selected="selected" <?php } ?>><?php echo  $content2['name']?></option>
																										
														<?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
                                                </select>
                                                </div>
                                         </div>
                                         <div class="form-group">
                                             <label class="control-label col-md-3 col-sm-3 col-xs-12">L.G.A</label>
                                             	<div class="col-md-9 col-sm-9 col-xs-12">
                                                <select id="lgaid" name="lga" class="select2_single form-control" tabindex="-1">
                                                    <option value="">Select</option>
                                                    <?php
                                                        $stateid = $content1['state'];
															$select_content2=("select * from tbl_lga where state='$stateid' order by lga asc");
															$content_result2= mysqli_query($db, $select_content2) or die (mysqli_error($db));
															$content2 = mysqli_fetch_assoc($content_result2);
															$num_chk2 = mysqli_num_rows ($content_result2);
															$k = 0
														?>
														<?php do { 	?>
                                                        <option value="<?php echo  $content2['id']?>" <?php if($content2['id'] == $content1['lga']){?> selected="selected" <?php } ?>><?php echo  $content2['lga']?></option>
																										
														<?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
                                                </select>
                                                </div>
                                         </div>
                                         
                                         <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                            &nbsp;
                                        </div> 
                                </div>
                            </div>
                            </div>
                            
                            
                            <div class="col-md-6 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_title">
                                    <h2>School Information</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                
                                <div class="x_content">
                                    <br />
                                    <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Staff ID </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="eid" class="form-control" type="text" value="<?php echo $content1["employeeid"] ?>">
                                            </div>
                                     </div>
                                    <div class="form-group">
                                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Staff Type</label>
                                             	<div class="col-md-9 col-sm-9 col-xs-12">
                                                <select id="select" name="typeid" class="select2_single form-control" tabindex="-1">
													  <option value="">--Select Type</option>
													  <?php
															$select_content2=("select * from stafftype  order by sid asc");
															$content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
															$content2 = mysqli_fetch_assoc($content_result2);
															$num_chk2 = mysqli_num_rows ($content_result2);
															$k = 0
														?>
													  <?php do { 	?>
                                                   
                                                        <option value="<?php echo  $content2['sid']?>" <?php if($content2['sid'] == $content1['typeid']){?> selected="selected" <?php } ?>><?php echo  $content2['type']?></option>
                                                        
														  <?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
													</select>
                                                   </div>
                                            </div>
                                         <div class="form-group">
                                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Department</label>
                                             	<div class="col-md-9 col-sm-9 col-xs-12">
                                                <select id="dept" name="dept" class="select2_single form-control" tabindex="-1">
													  <?php
															$select_content2=("select * from department order by department asc");
															$content_result2= mysqli_query($db, $select_content2) or die (mysqli_error($db));
															$content2 = mysqli_fetch_assoc($content_result2);
															$num_chk2 = mysqli_num_rows ($content_result2);
															$k = 0
														?>
														<?php do { 	?>
														
                                                            <option value="<?php echo  $content2['did']?>" <?php if($content2['did'] == $content1['dept']){?> selected="selected" <?php } ?>><?php echo  $content2['department']?></option>
																										
														<?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
													</select>
                                                   </div>
                                            </div>
									<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Qualification </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="oc" class="form-control" type="text" value="<?php echo $content1["qualification"] ?>">
                                            </div>
                                     </div>
                                     
                                      <div class="form-group">
                                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Position</label>
                                             	<div class="col-md-9 col-sm-9 col-xs-12">
                                                <select id="position" name="eposition" class="select2_single form-control" tabindex="-1">
													  <?php
															$select_content2=("select * from positions order by position asc");
															$content_result2= mysqli_query($db, $select_content2) or die (mysqli_error($db));
															$content2 = mysqli_fetch_assoc($content_result2);
															$num_chk2 = mysqli_num_rows ($content_result2);
															$k = 0
														?>
														<?php do { 	?>
											
                                                            <option value="<?php echo  $content2['pid']?>" <?php if($content2['pid'] == $content1['position']){?> selected="selected" <?php } ?>><?php echo  $content2['position']?></option>
																										
														<?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
													</select>
                                                   </div>
                                            </div>
                                            <div class="form-group">
                                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Location</label>
                                             	<div class="col-md-9 col-sm-9 col-xs-12">
                                                <select name="location" class="select2_single form-control" tabindex="-1"><?php
															$select_content2=("select * from branches order by sname asc");
															$content_result2= mysqli_query($db, $select_content2) or die (mysqli_error($db));
															$content2 = mysqli_fetch_assoc($content_result2);
															$num_chk2 = mysqli_num_rows ($content_result2);
															$k = 0
														?>
													<?php do { 	?>
													
                                                    <option value="<?php echo  $content2['id']?>" <?php if($content2['id'] == $content1['locat']){?> selected="selected" <?php } ?>><?php echo  $content2['sname']?></option>
													<?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
													</select>
                                                   </div>
                                            </div>
                                            
                                     <div class="form-group">
                                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Grade</label>
                                             	<div class="col-md-9 col-sm-9 col-xs-12">
                                                <select id="grade" name="grade" class="select2_single form-control" tabindex="-1">
													 <?php 
														$c = 1;
														do { 	?>
                                                            <option value="<?php echo  $c; ?>" <?php if($c == $content1['grade']){?> selected="selected" <?php } ?>><?php echo  $c; ?></option>
																										
														<?php $c++; } while ($c < 18); ?>
													</select>
                                                   </div>
                                            </div>
                                            <div class="form-group">
                                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Level</label>
                                             	<div class="col-md-9 col-sm-9 col-xs-12">
                                                <select id="class" name="class" class="select2_single form-control" tabindex="-1">
													  <?php 
														$c = 1;
														do { 	?>
                                                            <option value="<?php echo  $c; ?>" <?php if($c == $content1['step']){?> selected="selected" <?php } ?>><?php echo  $c; ?></option>
																										
														<?php $c++; } while ($c < 16); ?>
													</select>
                                                   </div>
                                            </div>
                                      <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Retired Date </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="dater" id="dater" class="date-picker form-control col-md-7 col-xs-12" type="text" value="<?php echo $content1["dateretired"] ?>">
                                            </div>
                                     </div>
                                     <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Employment Date </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="employdate" id="emdate" class="date-picker form-control col-md-7 col-xs-12" type="text" value="<?php echo $content1["employdate"] ?>">
                                            </div>
                                     </div>
                                     <div class="form-group">
                                            &nbsp;
                                     </div>
                                     
                                   <h2>Tax Information</h2>  
                                   
                                   <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">TIN </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="tin" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Tax Identification Number" value="<?php echo $content1["taxid"] ?>">
                                            </div>
                                     </div>
                                    <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">NH No </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="nhn" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="National Housing No" value="<?php echo $content1["nationalHouseNo"] ?>">
                                            </div>
                                     </div>
                                    
                                    <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tax Amount </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="taxamount" id="emdate" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="(If not using Tax General formula)" value="<?php echo $content1["taxamount"] ?>">
                                            </div>
                                     </div>
                                     
                                     <div class="form-group">
                                            &nbsp;
                                     </div>
                                     
                                    <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">No Tax? </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="checkbox" name="taxable" id="taxable" class="flat" <?php if($content1["not_taxable"] == "on") {?> checked="checked" <?php }?> /> Check if Tax is not Applicable
                                            </div>
                                     </div>
                                     
                                     <div class="form-group">
                                            &nbsp;
                                     </div>
                                     
                                    <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Attach Salary Structure </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="salarys" type="checkbox" value="1" class="flat" <?php if ($content1['salaryStru'] == 1){?> checked="checked"<?php }?> />  Use Grade Level/Step for Salary Structure
                                            </div>
                                     </div>
                                        
                                </div>
                            </div>
                            </div>
                            
                            <div class="col-md-6 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_title">
                                    <h2>Bank Information</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                
                                <div class="x_content">
                                    <br />
                                   <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                            <input type="text" name="bvn" class="form-control has-feedback-left" id="inputSuccess4" placeholder="BVN" onkeydown="return digistOnly()" value="<?php echo $content1["bvn"] ?>">
                                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                                        </div>

                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                            <input type="text" name="accno" class="form-control" id="inputSuccess5" placeholder="Account No." onkeydown="return digistOnly()" value="<?php echo $content1["accno"] ?>">
                                            <span class="fa fa-barcode form-control-feedback right" aria-hidden="true"></span>
                                        </div>
                                        
                                        <div class="form-group">
                                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Acc Type</label>
                                             	<div class="col-md-9 col-sm-9 col-xs-12">
                                                <select id="select" name="acctype" class="select2_single form-control" tabindex="-1">
                                                    <option value="">Select</option>
                                                    <option value="Savings" <?php if("Savings" == $content1['acctype']){?> selected="selected" <?php } ?>>Savings</option>
                                                    <option value="Current" <?php if("Current" == $content1['acctype']){?> selected="selected" <?php } ?>>Current</option>
                                                </select>
                                                </div>
                                         </div>
                                         <div class="form-group">
                                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Bank</label>
                                             	<div class="col-md-9 col-sm-9 col-xs-12">
                                                <select id="select" name="bank" class="select2_single form-control" tabindex="-1">
                                                    <option value="">Select</option>
                                                    <?php
                                                        $select_content2=("select * from banks where status='on'  order by accname asc");
                                                        $content_result2= mysqli_query($db, $select_content2) or trigger_error(mysqli_error());
                                                        $content2 = mysqli_fetch_assoc($content_result2);
                                                        $num_chk2 = mysqli_num_rows ($content_result2);
                                                        $k = 0
                                                    ?>
                                                    <?php do { 	?>
                                                        <option value="<?php echo  $content2['id']?>" <?php if($content2['id'] == $content1['bank']){?> selected="selected" <?php } ?>><?php echo  $content2['accname']?></option>
                                                    <?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
                                                </select>
                                                </div>
                                         </div>
                                        
                                        
                                </div>
                            </div>
                            </div>
                            
                            <div class="col-md-6 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_title">
                                    <h2>Login Information</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                
                                <div class="x_content">
                                    <br />
                                   <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Username </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="user" class="form-control" type="text" value="<?php echo $content1["username"] ?>">
                                            </div>
                                     </div>
                                    <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Password </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="pass" class="form-control" type="text" readonly value="<?php echo $content1["password"] ?>">
                                            </div>
                                     </div>
                                    <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Re-password </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="pass2" class="form-control" type="text" readonly value="<?php echo $content1["password"] ?>">
                                            </div>
                                     </div>
                                        
                                </div>
                            </div>
                            </div>
                            
                            <div class="col-md-6 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_title">
                                    <h2>Next of Kin Information</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                
                                <div class="x_content">
                                    <br />
                                   <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Fullname </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="nname" class="form-control" type="text" value="<?php echo $content1["nname"] ?>">
                                            </div>
                                     </div>
                                   <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Address </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="naddress" class="form-control" type="text" value="<?php echo $content1["naddress"] ?>">
                                            </div>
                                     </div>
                                   <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Email </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="nemail" class="form-control" type="email" value="<?php echo $content1["nemail"] ?>">
                                            </div>
                                     </div>
                                    <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input name="nphone" class="form-control" type="text" onkeydown="return digistOnly()" value="<?php echo $content1["nphone"] ?>">
                                            </div>
                                     </div>
                                        
                                </div>
                            </div>
                            </div>
                            
                            <div class="col-md-6 col-xs-12">
                            <div class="x_panel">
                                
                                
                                <div class="x_content">
                                    <br />
                                   <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Photo</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="hidden" name="webcampPic" value="<?php echo $content1["passport"] ?>" />
												 <?php if($content1["passport"] ==""){ ?>
                                                      <div id="photos"> <img src="uploads/staff/fade.gif" height="150px" width="150px" style="border-radius:7px; box-shadow:2px 1px 2px 2px #CCCCCC;"/> </div>
                                                <?php
                                                }else{
                                                ?>
                                                    <div id="photos"> <img src="uploads/staff/<?php echo $content1["passport"] ?>" height="150px" width="150px" style="border-radius:7px; box-shadow:2px 1px 2px 2px #CCCCCC;"/> </div>
                                                <?php
                                                }
                                                ?>
                                                <!--<div id="photos"></div>-->
                                            </div>

                                            <input type="file" name="image" required="required"/>
                                        </div>
                                        
                                        <div class="form-group">
                                        &nbsp;
                                        </div>
                                        
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                                <input  type="submit" class="btn btn-primary" value="  Update  " />
                                            </div>
                                        </div>
                                        
                                        
                                        
                                </div>

                                     
									
                                    <div id="camera">
                                            <span class="camTop"></span>
                                            <div id="screen"></div>
                                            <div id="buttons">
                                                <a id="shootButton" href="" class="blueButton">Snap!</a>
                                                <a id="cancelButton" href="" class="blueButton">Cancel</a> <a id="uploadButton" href="" class="greenButton">Upload!</a>
                                                <input  type="hidden" value="2" id="pageid" />
                                            </div>
                                            
                                            <span class="settings"></span>
                                         </div>
                                    </div>
                                  </div></form>                            
                            
							<?php	
									}
								
							?>
							
							<?php
								if ($pg == 4)
									{
							?> 			 <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel" >
                            <form method="post" action="?pg=9" name="frmReg" onsubmit="return loginCheck()" enctype="multipart/form-data">
											<table class="form">
												<tr>
													<td>
														<label>Text File</label>
													</td>
													<td valign="middle">
														<input type="file" name="image" required="required"/>
													</td>
												</tr>
												 
												<tr>
													<td>
													  
													</td>
													<td>
														<input name="upload"  type="submit" class="btn btn-primary" value="  Upload  " />
													</td>
												</tr>
											</table>
										  </form>
                                          </div>
                                        </div>
                                          
							<?php	
									}
								
							?>
							
							<?php
								if ($pg == "")
									{
							
							?>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel" >
                            <div class="body table-responsive">
									<span style="font-family:Arial, Helvetica, sans-serif;font-size:11px;color:#FF0000"><?php echo $sql; ?></span>
									<table class="table table-striped responsive-utilities jambo_table" id="example">
							<?php
									$select_content=("select * from staff_records s INNER JOIN title c ON s.class = c.id INNER JOIN stafftype t ON s.typeid = t.sid order by surname asc");
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
									<thead>
									<tr>
										<th>S/N</th>
										<th>Title</th>
										<th>Staff Name</th>
										<th>Type</th>
										<th>Qualification</th>
										<th>Email</th>
										<th>Phone No</th>
                                        <th>Status</th>
										<th>Password Reset</th>
										<th>Classes</th>
										<th>Edit</th>
										<th>Delete</th>
                                        <th>View</th>
									</tr>
									</thead>
									<tbody>
							
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
												<tr >
													<td><?php echo $k  ?></td>
													<td><?php  echo ucfirst($content ['class'])?></td>
													<td><?php  echo $content['surname']." ". $content['othername']?></td>
													<td><?php  echo ucfirst($content ['type'])?></td>
													<td><?php  echo ucfirst($content ['qualification'])?></td>
													<td><?php  echo ($content ['email'])?></td>
													<td><?php  echo ($content ['phone'])?></td>
                                                    <td><a style="color:#FF0000" href="staff?id=<?php  echo ($content['gid'])?>&pg=5&st=<?php echo ($content ['status'])?>" target="_parent"> <?php  if($content ['status'] == 0){echo "<i class='fa fa-unlock'> </i> De-Activate" ;} else{echo "<i class='fa fa-lock'> </i> Activate" ;}?>	</a>
</td>
													<td>
														<a style="color:#FF0000" href="staff?id=<?php  echo ($content['gid'])?>&pg=9&m=<?php  echo ($content ['email'])?>" target="_parent">	Reset Password	</a>
													</td>
													<td>
													<?php if($content ['typeid'] == 0){?>
														<a style="color:#FF0000" href="teacher-classes?id=<?php  echo ($content['gid'])?>&pg=12" target="_parent">	Classes	</a> <?php }?>
													</td>
													<td width="5%"  style="font-weight:normal"><a href="staff?id=<?php echo ($content ['gid'])?>&pg=7" target="_parent" class="btn btn-dark"><i class="fa fa-edit"></i></a></td>                                                   
													<td width="8%" align="center"><a href="staff?id=<?php  echo ($content ['gid'])?>&pg=6&pg=6&pcode=<?php  echo ($content ['passport'])?>" target="_parent" onClick="return confirmDel();" class="btn btn-danger"><i class="fa fa-close"></i></a> </td>
                                                    <td width="8%" align="center"><a href="staff-information?id=<?php  echo ($content ['gid'])?>" class="btn btn-primary"><i class="fa fa-search"></i></a> </td>
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
                </div>
                
                
              
                
 <!-- footer content -->
               <?php include("includes/footer.php")?>
			   


<script language="javascript">
function loginCheck() {
if(document.frmReg.class.value == "") {
alert ("Please select Title")
document.frmReg.class.focus();
return false
}
if(document.frmReg.sn.value == "") {
alert ("Please enter SurName")
document.frmReg.sn.focus();
return false
}
if(document.frmReg.on.value == "") {
alert ("Please enter OtherNames")
document.frmReg.on.focus();
return false
}
/*
if(document.frmReg.oc.value == "") {
alert ("Please enter your Qualification")
document.frmReg.oc.focus();
return false
}
if(document.frmReg.ra.value == "") {
alert ("Please enter Contact Address")
document.frmReg.ra.focus();
return false
}
if(document.frmReg.email.value == "") {
alert ("Please enter Contact Email Address")
document.frmReg.email.focus();
return false
}
if(document.frmReg.phone.value == "") {
alert ("Please enter Contact Phone Number")
document.frmReg.phone.focus();
return false
}*/
if(document.frmReg.user.value == "") {
alert ("Please enter Staff's default Username")
document.frmReg.user.focus();
return false
}
if(document.frmReg.pass.value != "") {
	if(document.frmReg.pass.value != document.frmReg.pass2.value){
		alert ("Password Not Match")
		document.frmReg.pass.focus();
		return false
	}
	else{
		return true
	}	
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

function loadLGA(){
		//declaare a variable that collects the value in the select button
		var stateid=$('#stateid').val();
		//alert(stateid)
		if( stateid=="")
		{
			$('#container').html("<strong> No value selected for the search record");
			return false;
		}
		mypath='mode=lga&stateid='+stateid;
		$.ajax({
		type:'POST',
		url:'loaddata.php',
		data:mypath,
		cache:false,
			success:function(resps){
				$('lgaid').empty();
				//returns the reponse
                //alert(resps)
				$('#lgaid').html(resps);
				return false;
			}
		});
	
		return false;
}
</script>