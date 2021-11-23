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
			$schoolid = mysqli_real_escape_string($db, $_POST["schoolid"]);
			$sn = mysqli_real_escape_string($db, $_POST['sn']);
			$on = mysqli_real_escape_string($db, $_POST['on']);
			$termid = mysqli_real_escape_string($db, $_POST['termid']);
			$oc =  mysqli_real_escape_string($db, $_POST['oc']);
			$xdate = date("Y-m-d");
			
			$content_search4 = mysqli_query($db, "select * from teachers_comment where (low='$sn' and high='$on' and schoolid='$schoolid' and termid ='$termid') or (schoolid='$schoolid' and low ='$sn' and termid ='$termid') or (schoolid='$schoolid' and high='$on' and termid ='$termid')") or die(mysqli_error($db));
			$numchk4 = mysqli_num_rows($content_search4);
			if($numchk4 <= 0){
				mysqli_query($db, "insert into teachers_comment SET schoolid='$schoolid', low='$sn', high='$on', remark='$oc',  xdate='$xdate', user='$xID', termid ='$termid'") or die(mysqli_error($db));
				$sql= "<b>Operation was Successful: Record Inserted<b> " ;
			}
			else{
				$sql= "<b>Operation was not Successful: Record Exist<b> " ;
			}
			

	echo "
			<script language='javascript'>
				location.href='teacher-comments?sql=$sql'
			</script>
		";			
		}
?>


<?php
	if ($pg == 2)
	
		{
			$schoolid = mysqli_real_escape_string($db, $_POST["schoolid"]);
			$sn = mysqli_real_escape_string($db, $_POST['sn']);
			$on = mysqli_real_escape_string($db, $_POST['on']);
			$oc = mysqli_real_escape_string($db, $_POST['oc']);
			$termid = mysqli_real_escape_string($db, $_POST['termid']);
			
			$xdate = date("Y-m-d");
			
			 $TXTid = mysqli_real_escape_string($db, $_POST['id']);
			
			$content_search4 = mysqli_query($db, "select * from teachers_comment where (low='$sn' and high='$on' and schoolid='$schoolid' and termid ='$termid' and commentid != '$TXTid') or (schoolid='$schoolid' and low ='$sn' and termid ='$termid' and commentid != '$TXTid') or (schoolid='$schoolid' and high='$on' and termid ='$termid' and commentid != '$TXTid')") or die(mysqli_error($db));
			$numchk4 = mysqli_num_rows($content_search4);
			if($numchk4 <= 0){			
				mysqli_query($db, "UPDATE teachers_comment Set schoolid='$schoolid', low='$sn', high='$on', remark='$oc', xdate='$xdate',  user='$xID', termid ='$termid' WHERE commentid = '$TXTid'") or die(mysqli_error($db));

				$sql= "<b>Operation was Successful: Changes made<b>";
			}
			else{
				$sql= "<b>Operation was not Successful: Record Exist<b> " ;
			}
						
			echo "
				<script language='javascript'>
					location.href='teacher-comments?sql=$sql'
				</script>
			";
		}
?>

<?php
	if ($pg == 7)
		{
			$TXTid = mysqli_real_escape_string($db, $_GET['id']);
			$select_content1=("select * from teachers_comment WHERE commentid='$TXTid'");
			$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
			$content1 = mysqli_fetch_assoc($content_result1);
			$num_chk1 = mysqli_num_rows ($content_result1);
			
			}
?>

<?php
	if ($pg == 6)
	
		{
		
			$TXTid = mysqli_real_escape_string($db, $_GET['id']);
			mysqli_query($db, "delete from teachers_comment where commentid = '$TXTid' ") or die(mysqli_error($db)) ;
			$sql = "Operation was Successful: 1 Item deleted";
			echo "
				<script language='javascript'>
					location.href='teacher-comments?sql=$sql'
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
                            <h3>Teacher's Comment</h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right top_search">
                            	 <a href="dashboard" class="btn btn-sm btn-success"><i class="fa fa-home"></i>Dashboard</a>
                                  
                                  <a href="teacher-comments?pg=1" class="btn btn-sm btn-dark"><i class="fa fa-plus"></i> New Comment</a>
                                 <a href="teacher-comments" class="btn btn-sm btn-warning"><i class="fa fa-search"></i> View Comment</a>
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
                                                <label>Term</label>
                                            </td>
                                            <td>
                                                 <select name="termid" class="form-control" >
                                                      <option value="">--Select Term</option>
                                                      <?php
                                                            $select_content2=("select * from subjects order by tid asc");
                                                            $content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
                                                            $content2 = mysqli_fetch_assoc($content_result2);
                                                        ?>
                                                      <?php do { 	?>
                                                      <option value="<?php echo  $content2['tid']?>"><?php echo  $content2['term']?></option>
                                                      <?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
                                                    </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Class</label>
                                            </td>
                                            <td>
                                                 <select name="schoolid" class="form-control" >
                                                      <option value="">--Select Class</option>
                                                      <?php
                                                            $select_content2=("select * from classes  order by rank asc");
                                                            $content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
                                                            $content2 = mysqli_fetch_assoc($content_result2);
                                                        ?>
                                                      <?php do { 	?>
                                                      <option value="<?php echo  $content2['id']?>"><?php echo  $content2['class']?></option>
                                                      <?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
                                                    </select>
                                            </td>
                                        </tr>
										 <tr>
											<td>
												<label>From:</label>
											</td>
											<td>
												<input type="text" class="form-control" name="sn"/>
											</td>
										</tr>
										<tr>
											<td>
												<label>To:</label>
											</td>
											<td>
												<input type="text" class="form-control" name="on"/>
											</td>
										</tr>
										<tr>
											<td>
												<label>
													Remark:</label>
											</td>
											<td>
												<input type="text" class="form-control" name="oc"/>
											   
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
                                                <label>Term</label>
                                            </td>
                                            <td>
                                                 <select name="termid" class="form-control" >
                                                      <option value="">--Select Term</option>
                                                      <?php
                                                            $select_content2=("select * from subjects order by tid asc");
                                                            $content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
                                                            $content2 = mysqli_fetch_assoc($content_result2);
                                                        ?>
                                                      <?php do { 	?>
                                                      <option value="<?php echo  $content2['tid']?>" <?php if($content2['tid'] == $content1['termid']){?> selected="selected" <?php } ?> ><?php echo  $content2['term']?></option>
                                                      <?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
                                                    </select>
                                            </td>
                                        </tr>
                                        <tr>
											<td>
												<label>Class</label>
											</td>
											<td>
												 <select name="schoolid" class="form-control">
													  <option value="">--Select Class</option>
													  <?php
															$select_content2=("select * from classes  order by rank asc");
															$content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
															$content2 = mysqli_fetch_assoc($content_result2);
														?>
													  <?php do { 	?>
													  <option value="<?php echo  $content2['id']?>" <?php if($content2['class'] == $content1['schoolid']){?> selected="selected" <?php } ?> ><?php echo  $content2['class']?></option>
													  <?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
													</select>
											</td>
										</tr>
										 <tr>
											<td>
												<label>From</label>
											</td>
											<td>
												<input type="hidden"  name="id" value="<?php echo $content1["commentid"] ?>"/>
												<input type="text" class="form-control" name="sn" value="<?php echo $content1["low"] ?>"/>
											</td>
										</tr>
										<tr>
											<td>
												<label>To</label>
											</td>
											<td>
												<input type="text" class="form-control" name="on" value="<?php echo $content1["high"] ?>" />
											</td>
										</tr>
										 <tr>
											<td>
												<label>
													Remark</label>
											</td>
											<td>
												<input type="text"  name="oc" value="<?php echo $content1["remark"] ?>" class="form-control"/>
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
										$select_content=("select * from teachers_comment g INNER JOIN classes s INNER JOIN subjects t ON g.termid=t.tid where g.schoolid=s.id order by t.tid asc, s.rank asc, g.low asc");
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
													<td colspan="6"  align="center">No Record Found</td>
												</tr>	
							<?php
							}
								else
							{
							?>
											<thead>
												<tr>
													<th>S/N</th>
                                                    <th>Term</th>
                                                    <th>Class</th>
													<th>Range</th>
													<th>remark</th>
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
                                                    <td><?php  echo $content ['term']?></td>
                                                    <td><?php  echo $content ['class']?></td>
													<td><?php  echo $content['low']." - ". $content['high']?></td>
													<td><?php  echo $content ['remark']?></td>
													<td width="5%"  style="font-weight:normal"><a href="teacher-comments?id=<?php echo ($content ['commentid'])?>&pg=7" target="_parent" class="btn btn-dark"><i class="fa fa-edit"></i></a></td>                                                   
													<td width="8%" align="center"><a href="teacher-comments?id=<?php  echo ($content ['commentid'])?>&pg=6" target="_parent" onClick="return confirmDel();" class="btn btn-danger"><i class="fa fa-close"></i></a> </td>
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
if(document.frmReg.termid.value == "") {
alert ("Please select Term")
document.frmReg.termid.focus();
return false
}
if(document.frmReg.schoolid.value == "") {
alert ("Please select School")
document.frmReg.schoolid.focus();
return false
}
if(document.frmReg.sn.value == "") {
alert ("Please enter the range to start")
document.frmReg.sn.focus();
return false
}
if(document.frmReg.on.value == "") {
alert ("Please enter the range to stop")
document.frmReg.on.focus();
return false
}
if(document.frmReg.oc.value == "") {
alert ("Please enter your remark")
document.frmReg.oc.focus();
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