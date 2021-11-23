<?php 
require_once("includes/session.php"); 
confirm_logged_in(); 

require_once '..'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'loader.php';
$aLoader = new Loader($db);
$xID = $_SESSION["ustcode"];
$page = '2';
?>
<?php
	$pg = mysqli_real_escape_string($db, $_GET['pg']);
	$r = mysqli_real_escape_string($db, $_GET['r']);
	$pv = mysqli_real_escape_string($db, $_GET['pv']);
	$sql = mysqli_real_escape_string($db, $_GET['sql']);
	
?>

<?php include("header.php"); ?>
<!-- page content -->
    <div class="right_col" role="main">
        <div class="">
			<div class="page-title">
                <div class="alert alert-info">
                    <a href="index"><b>Home</b></a> >>
                    <a href="index?action=home"><b><?php echo $aLoader->getClassName($_SESSION["t_class_id"]) ." ".$aLoader->getGroupName($_SESSION["t_group_id"]). " ".$aLoader->getSubjectName($_SESSION["t_subject_id"]); ?></b></a> >>
                    <strong>Score Upload</strong> 
                    <div class="pull-right">
                        <a href="score-batch-upload" class="btn btn-primary pull-right"><i class="fa fa-file-excel-o"></i> Batch Upload</a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
    
            <div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel" >
					<form method="post" action="?pg=8" name="frmReg" id="frmReg" onsubmit="return markStudents()">
						<div class="x_title">
							<table >
								<input name="school" id="school"  type="hidden" value="2" />
								<tr>
									
									<td>Class: </td>
									<td style="padding-right:10px"> 
									<input name="assper" id="assper"  type="hidden" value="<?php echo $per ?>" />
									<select name="class" id="class" class="form-control" style="width:130px" required onChange='return mySearch();'>
										<option value="">-- Class</option>
										<?php
											echo $aLoader->getTeacherClass($_SESSION["teacherlog"], $classid);
										?>
									</select>
									</td>
									<td>Arm: </td>
									<td style="padding-right:10px">
										<select name="cgroup" class="form-control" required style="width:100px">
											<?php
                                                echo $aLoader->getTeacherGroup($_SESSION["teacherlog"], $groupid);
                                            ?>
										</select>
									</td>
									<td>Subject: </td>
									<td style="padding-right:10px">
										<select name="subject" class="form-control" required style="width:200px" id="subject" >
											<option value="">--Select Subject <?php echo $classv ?></option>
											<?php
											$select_content2=("select * from subjects where class ='$schoolid'  order by subject asc");
											$content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
											$content2 = mysqli_fetch_assoc($content_result2);
											$num_chk2 = mysqli_num_rows ($content_result2);
											$k = 0
										?>
										<?php do { 	?>
										<option value="<?php echo  $content2['sid']?>" <?php if($content2['sid'] == $subject){?> selected="selected" <?php } ?>><?php echo  $content2['subject']?></option>
										<?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
										</select>
									</td> 
								
									<td>Term: </td> 
									<td style="padding-right:10px">
										<select name="term" class="form-control" required style="width:80px">
										<?php
											$select_content2=("select * from terms order by status desc");
											$content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
											$content2 = mysqli_fetch_assoc($content_result2);
											$num_chk2 = mysqli_num_rows ($content_result2);
											$k = 0
										?>
										<?php do { 	?>
										<option value="<?php echo  $content2['tid']?>" <?php if($content2['tid'] == $term){?> selected="selected" <?php } ?>><?php echo  $content2['term']?></option>
										<?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
									</select>
									</td>
									<td>Session: </td>
									<td style="padding-right:10px">
										<select name="year" id="year" class="form-control" required style="width:110px">
											<?php
											$select_content1=("select * from schsession order by status desc");
											$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
											$content1 = mysqli_fetch_assoc($content_result1);
										?>
										<?php do { 	?>
										<option value="<?php echo  $content1['sid']?>" <?php if($content1['sid'] == $yr){?> selected="selected" <?php } ?>><?php echo  $content1['sesion']?></option>
										<?php } while ($content1 = mysqli_fetch_assoc($content_result1)); ?>
										</select>
									</td>
									<td colspan="3"> <input  type="button" class="btn btn-primary" value="Load" onclick="return laodstudents();" /></td>
								</tr>
								
							</table>
							<div class="clearfix"></div>
						</div>
						<div class="x_content" id="contentd">
						
							
						</div>
					</form>
				</div>
			</div>
		</div>

   </div>
 </div>

<?php include("includes/footer.php") ?>

<script language="javascript">
	var admin = "<?php echo SITEURL;?>";
	var pageDetails = {
		"addnew": admin+"/package.result/save-score.php?pg=add",
		"update": admin+"/package.result/save-score.php?pg=add",
        "siteUrl":"<?php echo SITEURL;?>",
	};


	


	function checkPer(i,perc){
		var inp = eval(document.getElementById(i).value);
		//var perc = eval(document.frmReg.elements["assper"].value);	 
		if (inp > perc){
			alert("Invalid Input! The score cannot be more than "+perc);
			document.getElementById(i).value = "";
			document.getElementById(i).focus();
			return false
		}
	}
	
	function checkPer2(){
		
		var inp = eval(document.frmReg.score.value);	
		var perc = eval(document.frmReg.asVal.value);	 
		if (inp > perc){
			alert("Invalid Input! The score cannot be morethan "+perc);
			document.frmReg.score.value = "";
			document.frmReg.score.focus();
			return false
		}
	}

</script>

<script type="text/javascript">
		function updateScores(){
			document.frmReg.action="save-term-score-upload?pg=4&refno=<?php echo $refno;?>&c=<?php echo $classv?>&g=<?php echo $cgroup?>&s=<?php echo $subject?>&t=<?php echo $term?>&y=<?php echo $yr?>"
			document.frmReg.method = "post";
			document.frmReg.submit() 	
		}

		function finalScores(){
			document.frmReg.action="save-term-score-upload?pg=4&refno=<?php echo $refno;?>&c=<?php echo $classv?>&g=<?php echo $cgroup?>&s=<?php echo $subject?>&t=<?php echo $term?>&y=<?php echo $yr?>&status=1"
			document.frmReg.method = "post";
			document.frmReg.submit() 	
		}

		function finalScores2(){
			document.frmReg.action="save-term-score-upload?pg=8&refno=<?php echo $refno;?>&c=<?php echo $classv?>&g=<?php echo $cgroup?>&s=<?php echo $subject?>&t=<?php echo $term?>&y=<?php echo $yr?>&status=1"
			document.frmReg.method = "post";
			document.frmReg.submit() 
		}
</script>
