<?php require_once("includes/session.php"); ?>
<?php confirm_logged_in(); ?>
<?php
$xID = $_SESSION["ustcode"];
?>
<?php
	$pg = mysqli_real_escape_string($db, $_GET['pg']);
	$pv = mysqli_real_escape_string($db, $_GET['pv']);
	$sql = mysqli_real_escape_string($db, $_GET['sql']);
?>

<?php
	if ($pg == 8)
	{
		$class = mysqli_real_escape_string($db, $_POST['class']);
		$gid = mysqli_real_escape_string($db, $_POST['group']);
		$teacher = mysqli_real_escape_string($db, $_POST['teacher']);
		$xdate = date("Y-m-d");
		
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
				move_uploaded_file($file_tmp,"../uploads/signatures/".$file_name);
				//echo "Success ". $file_name;
			}else{
				print_r($errors);
			}
		}
		$select_content1=("select * from class_teacher WHERE classid='$class' and groupid='$gid' ");
		$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
		$content1 = mysqli_fetch_assoc($content_result1);
		$num_chk1 = mysqli_num_rows ($content_result1);
		if($num_chk1 == 0){
			mysqli_query($db, "insert into class_teacher SET  classid='$class', groupid='$gid', teacherid='$teacher', signature='$file_name', xdate='$xdate',  user='$xID' ") or die(mysqli_error($db));
			$sql= "<b>Operation was Successful: Record Inserted<b> " ;
		} else{
			$sql= "<b>Operation was NOT Successful: You can only Edit already setup class <b> " ;
		}
	
		echo "
			<script language='javascript'>
				location.href='class-teacher?sql=$sql'
			</script>
		";			
	}
?>


<?php
	if ($pg == 2)
	{
		$class = mysqli_real_escape_string($db, $_POST['class']);
		$gid = mysqli_real_escape_string($db, $_POST['group']);
		$teacher = mysqli_real_escape_string($db, $_POST['teacher']);
		$xdate = date("Y-m-d");
		$TXTid = mysqli_real_escape_string($db, $_POST['id']);
		
		$select_content1=("select * from class_teacher WHERE classid='$class' and groupid='$gid' and ctid != '$TXTid'");
		$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
		$content1 = mysqli_fetch_assoc($content_result1);
		$num_chk1 = mysqli_num_rows ($content_result1);
		if($num_chk1 == 0){
			
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
					move_uploaded_file($file_tmp,"../uploads/signatures/".$file_name);
					//echo "Success ". $file_name;
				}else{
					print_r($errors);
				}
				mysqli_query($db, "UPDATE class_teacher Set classid='$class', groupid='$gid', teacherid='$teacher', signature='$file_name', xdate='$xdate', user='$xID' WHERE ctid = '$TXTid'") or die(mysqli_error($db));
			}
			else{
				mysqli_query($db, "UPDATE class_teacher Set classid='$class', groupid='$gid', teacherid='$teacher', xdate='$xdate', user='$xID' WHERE ctid = '$TXTid'") or die(mysqli_error($db));
			}

			$sql= "<b>Operation was Successful: Changes made<b>";
		} else{
			$sql= "<b>Operation was NOT Successful: You can only Edit already setup class <b> " ;
		}
		echo "
				<script language='javascript'>
					location.href='class-teacher?sql=$sql'
				</script>
			";
	}
?>

<?php
	if ($pg == 7)
		{
			$TXTid = mysqli_real_escape_string($db, $_GET['id']);
			$select_content1=("select * from class_teacher WHERE ctid='$TXTid'");
			$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
			$content1 = mysqli_fetch_assoc($content_result1);
			$num_chk1 = mysqli_num_rows ($content_result1);
			
			}
?>

<?php
	if ($pg == 6)
	
		{
		
			$TXTid = mysqli_real_escape_string($db, $_GET['id']);
			mysqli_query($db, "delete from class_teacher where ctid = '$TXTid' ") or die(mysqli_error($db)) ;
			$sql = "Operation was Successful: 1 Record deleted";
			echo "
				<script language='javascript'>
					location.href='class-teacher?sql=$sql'
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
                            <h3>Class Teachers</h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right top_search">
                            	 <a href="dashboard" class="btn btn-sm btn-success"><i class="fa fa-home"></i>Dashboard</a>
                                  
                                  <a href="class-teacher?pg=1" class="btn btn-sm btn-dark"><i class="fa fa-plus"></i> Add Class Teacher </a>
                                 <a href="class-teacher" class="btn btn-sm btn-warning"><i class="fa fa-search"></i> View Class Teachers </a>
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
							?> 			 <form method="post" action="?pg=8" name="frmReg" onSubmit="return loginCheck()" enctype="multipart/form-data">
									<table class="form">
										 <tr>
											<td>
												<label>Class:</label>
											</td>
											<td>
												<select name="class" id="class" class="form-control" onchange="return mySearch()">
												  <option value="">--Select Class</option>
												  <?php
														$select_content2=("select * from classes  order by class asc");
														$content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
														$content2 = mysqli_fetch_assoc($content_result2);
														$num_chk2 = mysqli_num_rows ($content_result2);
														$k = 0
													?>
												  <?php do { 	?>
												  <option value="<?php echo  $content2['id']?>"><?php echo  $content2['class']?></option>
												  <?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
												</select>
											</td>
										</tr>
										<tr>
											<td><label>Arm:</label> </td>
											  <td style="padding-right:20px">
												 <select name="group" class="form-control">
												  <option value="">--Select Arm</option>
												  <?php
														$select_content2=("select * from groups  order by groupname asc");
														$content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
														$content2 = mysqli_fetch_assoc($content_result2);
														$num_chk2 = mysqli_num_rows ($content_result2);
														$k = 0
													?>
												  <?php do { 	?>
												  <option value="<?php echo  $content2['gid']?>"><?php echo  $content2['groupname']?></option>
												  <?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
												</select>
											 </td>
										</tr>
										<tr>
											<td>
												<label>Teacher:</label>
											</td>
											<td>
												<select name="teacher" id="subject" class="select2_group form-control"  tabindex="-1">
												  <option value="" >--Select Teacher</option>
												  <?php
														$select_content2=("select * from staff_records where typeid='0'  order by surname asc");
														$content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
														$content2 = mysqli_fetch_assoc($content_result2);
														$num_chk2 = mysqli_num_rows ($content_result2);
														$k = 0
													?>
												  <?php do { 	?>
												  <option value="<?php echo  $content2['gid']?>"><?php echo  $content2['surname']." ".$content2['othername']?></option>
												  <?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
												</select>
											</td>
										</tr>
										<tr>
											<td>
												<label>Signature:</label>
											</td>
											<td valign="middle">
												<input type="file" name="image"/>
											</td>
										</tr>
										<tr>
											<td>
											  
											</td>
											<td>
												<input  type="submit" class="btn btn-primary" value="  Submit  " />
											</td>
										</tr>
									</table>
									</form>
							<?php	
									}
							?>
							
							<?php
								if ($pg == 7)
									{
							?> 			 <form method="post" action="?pg=2" name="frmReg" onSubmit="return loginCheck()" enctype="multipart/form-data">
									<table class="form">
										
										 <tr>
											<td>
												<label>Class</label>
											</td>
											<td>
												<input type="hidden"  name="id" value="<?php echo $content1["ctid"] ?>"/>
												<select name="class" id="class" class="form-control" onchange="return mySearch()">
												  <option value="">--Select Class</option>
												  <?php
														$select_content2=("select * from classes  order by class asc");
														$content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
														$content2 = mysqli_fetch_assoc($content_result2);
														$num_chk2 = mysqli_num_rows ($content_result2);
														$k = 0
													?>
												  <?php do { 	?>
												  <option value="<?php echo  $content2['id']?>" <?php if($content2['id'] == $content1['classid']){?> selected="selected" <?php } ?>><?php echo  $content2['class']?></option>
												  <?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
												</select>
											</td>
										</tr>
										<tr>
											<td> <label>Arm: </label></td>
											  <td style="padding-right:20px">
												 <select name="group" class="form-control">
												  <option value="">--Select Arm</option>
												  <?php
														$select_content2=("select * from groups  order by groupname asc");
														$content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
														$content2 = mysqli_fetch_assoc($content_result2);
														$num_chk2 = mysqli_num_rows ($content_result2);
														$k = 0
													?>
												  <?php do { 	?>
												  <option value="<?php echo  $content2['gid']?>" <?php if($content2['gid'] == $content1['groupid']){?> selected="selected" <?php } ?>><?php echo  $content2['groupname']?></option>
												  <?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
												</select>
											 </td>
										</tr>
										<tr>
											<td>
												<label>Teacher:</label>
											</td>
											<td>
												<select name="teacher" id="subject" class="select2_group form-control"  tabindex="-1">
												  <option value="" class="form-control">--Select Teacher</option>
												  <?php
														$select_content2=("select * from staff_records where typeid='0'  order by surname asc");
														$content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
														$content2 = mysqli_fetch_assoc($content_result2);
														$num_chk2 = mysqli_num_rows ($content_result2);
														$k = 0
													?>
												  <?php do { 	?>
												  <option value="<?php echo  $content2['gid']?>" <?php if($content2['gid'] == $content1['teacherid']){?> selected="selected" <?php } ?>><?php echo  $content2['surname']." ".$content2['othername']?></option>
												  <?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
												</select>
											</td>
										</tr>
									   <tr>
											<td>
												<label>Signature:</label>
											</td>
											<td valign="middle">
												<input type="file" name="image"/>
												 <?php if($content1["signature"] != ""){ ?><img src="../uploads/signatures/<?php echo $content1["signature"] ?>" height="78" width="100" /><?php } else{ echo "No Signature"; }?>
											</td>
										</tr>
										<tr>
											<td>
											  
											</td>
											<td>
												<input  type="submit" class="btn btn-primary" value="  Update  " />
											</td>
										</tr>
									</table>
									</form>
							<?php	
									}
								
							?>
							
							
							<?php
								if ($pg == "")
										{
							?>
                                <span style="font-family:Arial, Helvetica, sans-serif;font-size:11px;color:#FF0000"><?php echo $sql; ?></span>
                                <table class="table table-striped responsive-utilities jambo_table" id="dataTables-example">
							<?php
										$select_content=("select * from class_teacher order by classid asc");
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
													<th>Class</th>
													<th>Arm</th>
													<th>Teacher</th>
													<th>Signature</th>
													<th>Edit</th>
													<th>Delete</th>
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
													<td><?php  
														$c = $content['classid'];
														$select_content1=("select * from classes WHERE id ='$c'");
														$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
														$content1 = mysqli_fetch_assoc($content_result1);
														echo $content1["class"];
													?></td>
													<td><?php  
														$c = $content['groupid'];
														$select_content1=("select * from groups WHERE gid ='$c'");
														$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
														$content1 = mysqli_fetch_assoc($content_result1);
														echo $content1["groupname"];
													?></td>
													<td><?php  
														$c = $content['teacherid'];
														$select_content1=("select * from staff_records WHERE gid ='$c'");
														$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
														$content1 = mysqli_fetch_assoc($content_result1);
														echo $content1["surname"]." ".$content1["othername"];
													?></td>
													<td>
														 <?php if($content["signature"] != ""){ ?><img src="../uploads/signatures/<?php echo $content["signature"] ?>" style="width:60px; height:30px" /><?php } else{ echo "No Signature"; }?>
													</td>
													<td width="5%"  style="font-weight:normal"><a href="class-teacher?id=<?php echo ($content ['ctid'])?>&amp;pg=7" target="_parent" class="btn btn-dark"> <i class="fa fa-edit"></i></a></td>                                                   
													<td width="8%" align="center"><a href="class-teacher?id=<?php  echo ($content ['ctid'])?>&amp;pg=6" target="_parent" onClick="return confirmDel();" class="btn btn-danger"> <i class="fa fa-close"></i></a> </td>
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

<script language="javascript">
function loginCheck() {
	if(document.frmReg.class.value == "") {
	alert ("Please select class")
	document.frmReg.class.focus();
	return false
	}
	if(document.frmReg.group.value == "") {
	alert ("Please select group")
	document.frmReg.group.focus();
	return false
	}
	if(document.frmReg.teacher.value == "") {
	alert ("Please select Teacher")
	document.frmReg.teacher.focus();
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