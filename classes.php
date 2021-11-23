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
			$class  = mysqli_real_escape_string($db, $_POST['class']);
			$rank  = mysqli_real_escape_string($db, $_POST['rank']);
			$school  = mysqli_real_escape_string($db, $_POST['school']);
			$result_comment  = mysqli_real_escape_string($db, $_POST['result_comment']);
			$xdate = date("Y-m-d");
		
			$select_content1=("select * from classes WHERE rank='$rank' and schoolid='$school'");
			$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
			$num_chk1 = mysqli_num_rows ($content_result1);
			if($num_chk1 == 0){
				mysqli_query($db, "insert into classes SET class = '$class', rank = '$rank', schoolid ='$school', xdate='$xdate', user='$xID' ") or die(mysqli_error($db));
				$select_content1=("select * from resultcommenting WHERE schoolid='$school'");
				$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
				$num_chk1 = mysqli_num_rows ($content_result1);
				if($num_chk1 == 0){
					mysqli_query($db, "insert into resultcommenting SET schoolid ='$school', status='$result_comment'") or die(mysqli_error($db));
				}
				else{
					mysqli_query($db, "UPDATE resultcommenting SET status='$result_comment' WHERE schoolid ='$school'") or die(mysqli_error($db));
				}
			$sql= "<b>Operation was Successful: Record Inserted<b>";
			}
			else {
				$sql= "<b>Operation was not Successful: 2(Two) Class can not have the same Rank<b>";	
			}
	echo "
			<script language='javascript'>
				location.href='classes.php?sql=$sql'
			</script>
		";			
		}
?>

<?php
	if ($pg == 2)
		{
			$TXTid = mysqli_real_escape_string($db, $_POST['id']);
			$class  = mysqli_real_escape_string($db, $_POST['class']);
			$rank  = mysqli_real_escape_string($db, $_POST['rank']);
			$school  = mysqli_real_escape_string($db, $_POST['school']);
			$result_comment  = mysqli_real_escape_string($db, $_POST['result_comment']);
			$select_content1=("select * from classes WHERE rank='$rank' and schoolid='$school' and id != '$TXTid'");
			$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
			$num_chk1 = mysqli_num_rows ($content_result1);
			if($num_chk1 == 0){
				mysqli_query($db, "UPDATE classes SET class = '$class', rank = '$rank', result_comment='$result_comment', schoolid ='$school' WHERE id = '$TXTid'");
				$select_content1=("select * from resultcommenting WHERE schoolid='$school'");
				$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
				$num_chk1 = mysqli_num_rows ($content_result1);
				if($num_chk1 == 0){
					mysqli_query($db, "insert into resultcommenting SET schoolid ='$school', status='$result_comment'") or die(mysqli_error($db));
				}
				else{
					mysqli_query($db, "UPDATE resultcommenting SET status='$result_comment' WHERE schoolid ='$school'") or die(mysqli_error($db));
				}
				$sql= "<b>Operation was Successful: Changes made<b>";
			}
			else {
				$sql= "<b>Operation was not Successful: 2(Two) Class can not have the same Rank<b>";	
			}
			echo "
				<script language='javascript'>
					location.href='classes.php?sql=$sql'
				</script>
			";
		}
?>

<?php
	if ($pg == 6)
	{
		$TXTid = mysqli_real_escape_string($db, $_GET['id']);
		mysqli_query($db, "delete from classes where id = '$TXTid' ") or die(mysqli_error($db)) ;
		$sql = "Operation was Successful: 1 Item deleted";
		header ("location:classes.php?sql=$sql");
	}
?>

<?php
	if ($pg == 7)
	{
		$TXTid = mysqli_real_escape_string($db, $_GET['id']);
		$select_content1=("select * from classes WHERE id='$TXTid'");
		$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
		$content1 = mysqli_fetch_assoc($content_result1);
		$num_chk1 = mysqli_num_rows ($content_result1);
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
                            <h3>Classes</h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right top_search">
                             <a href="dashboard" class="btn btn-sm btn-success"><i class="fa fa-home"></i>Dashboard</a>
                             
                             <a href="classes?pg=1" class="btn btn-sm btn-dark"><i class="fa fa-plus"></i> Add Class</a>
                             <a href="classes" class="btn btn-sm btn-warning"><i class="fa fa-search"></i> View Classes</a>
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
							?> 			 <form method="post" action="?pg=8" name="frmReg" onsubmit="return loginCheck()" >
									<table class="form">
										<tr>
											<td>
												<label>School</label>
											</td>
											<td>
												 <select name="school" class="form-control">
													<option value="">--Select School</option>
													<?php
														  $select_content2=("select * from schools  order by school asc");
														  $content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
														  $content2 = mysqli_fetch_assoc($content_result2);
														  $num_chk2 = mysqli_num_rows ($content_result2);
														  $k = 0
													  ?>
													<?php do { 	?>
													<option value="<?php echo  $content2['schoolid']?>" <?php if($content2['schoolid'] == $school){?> selected="selected" <?php } ?>><?php echo  $content2['school']?></option>
													<?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
												  </select>
											</td>
										</tr>
										 <tr>
											<td>
												<label>Class Name</label>
											</td>
											<td>
												<input type="text" class="form-control" name="class"/>
											</td>
										</tr>
										<tr>
											<td>
												<label>Result Type</label>
											</td>
											<td>
												 <select name="result_comment" class="form-control">
													<option value="0" <?php if(0 == $content1["result_comment"]){?> selected="selected" <?php } ?>>Use of Score</option>
													<option value="1" <?php if(1 == $content1["result_comment"]){?> selected="selected" <?php } ?>>Commenting</option>
												  </select>
											</td>
										</tr>
										<tr>
											<td>
												<label>Class Rank</label>
											</td>
											<td>
												<input type="text" class="form-control" name="rank"/>
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
							?> 			 <form method="post" action="?pg=2" name="frmReg" onsubmit="return loginCheck()" >
									<table class="form">
										<tr>
											<td>
												<label>School</label>
											</td>
											<td>
												 <select name="school" class="form-control">
													<option value="">--Select School</option>
													<?php
														  $select_content2=("select * from schools  order by school asc");
														  $content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
														  $content2 = mysqli_fetch_assoc($content_result2);
														  $num_chk2 = mysqli_num_rows ($content_result2);
														  $k = 0
													  ?>
													<?php do { 	?>
													<option value="<?php echo $content2['schoolid']?>" <?php if($content2['schoolid'] == $content1["schoolid"]){?> selected="selected" <?php } ?>><?php echo  $content2['school']?></option>
													<?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
												  </select>
											</td>
										</tr>
										 <tr>
											<td>
												<label>Class Name</label>
											</td>
											<td>
												<input type="text" class="form-control" name="class" value="<?php echo $content1["class"] ?>"/>
												<input type="hidden" class="form-control" name="id" value="<?php echo $content1["id"] ?>"/>
											</td>
										</tr>
										<tr>
											<td>
												<label>Result Type</label>
											</td>
											<td>
												 <select name="result_comment" class="form-control">
													<option value="0" <?php if(0 == $content1["result_comment"]){?> selected="selected" <?php } ?>>Use of Score</option>
													<option value="1" <?php if(1 == $content1["result_comment"]){?> selected="selected" <?php } ?>>Commenting</option>
												  </select>
											</td>
										</tr>
										<tr>
											<td>
												<label>Class Rank</label>
											</td>
											<td>
												<input type="text" class="form-control" name="rank" value="<?php echo $content1["rank"] ?>" />
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
							
								if ($pg == "")
								
										{
							
							?>
                                <span style="font-family:Arial, Helvetica, sans-serif;font-size:11px;color:#FF0000"><?php echo $sql; ?></span>
                                <table class="table table-striped responsive-utilities jambo_table" id="dataTables-example">
												
							
							
							<?php
										$select_content=("select * from classes c INNER JOIN schools s ON c.schoolid = s.schoolid order by c.rank asc");
										$content_result= mysqli_query($db, $select_content) or die(mysqli_error($db));
										$content = mysqli_fetch_assoc($content_result);
										$num_chk = mysqli_num_rows ($content_result);
										$k = 0
							?>
							<?php
							if ($num_chk == 0)
								{
							?>
												<tr>
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
                                        <th>School</th>
                                        <th>Class name</th>
                                        <th>Rank</th>
										<th>Result Type</th>
                                        <th>Date Created</th>
                                        <th>Edit</th>
                                        <!--<th>&nbsp;</th>-->
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
												<tr>
													<td><?php echo $k  ?></td>
													<td><?php  echo $content['school']?></td>
													<td><?php  echo $content['class']?></td>
													<td><?php  echo $content['rank']?></td>
													<td><?php  if($content['result_comment'] == 0){ echo "Score";} else{ echo "Commenting";} ?></td>
													<td><?php  echo ucfirst($content ['xdate'])?></td>
													
													<td width="5%"  style="font-weight:normal"><a href="classes?id=<?php echo ($content ['id'])?>&pg=7" target="_parent" class="btn btn-dark"><i class="fa fa-edit"></i></a></td>                                                  <!-- <td width="8%" align="center"><a href="classes?id=<?php  echo ($content ['id'])?>&pg=6" target="_parent" onClick="return confirmDel();"><img src="images/deletes.gif" width="20" height="19" border="0" /></a> </td>-->
												</tr>
										 <?php } while ($content = mysqli_fetch_assoc($content_result)); ?>
							<?php 
								}
							?>
								</tbody>
								</table>
							<?php
							}
							?>
			
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
	if(document.frmReg.school.value == "") {
		alert ("Please Select School")
		document.frmReg.school.focus();
		return false
	}
	if(document.frmReg.class.value == "") {
	alert ("Please enter Class name")
	document.frmReg.class.focus();
	return false
	}
	if(document.frmReg.rank.value == "") {
	alert ("Please enter class rank")
	document.frmReg.rank.focus();
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