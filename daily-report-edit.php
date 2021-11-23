<?php 
   ini_set('display_errors',0); 
   require_once("includes/session.php"); 
   confirm_logged_in();
   require_once ('../connection.php');
   include("header.php"); 
?>
<!-- include summernote -->
<link rel="stylesheet" href="../editor/dist/summernote-bs4.css">
<script type="text/javascript" src="../editor/dist/summernote-bs4.js"></script>
<!-- KaTeX -->
<link href="../editor/dist/katex.min.css" rel="stylesheet">
<script src="../editor/dist/katex.min.js"></script>

<script src="../editor/summernote-math.js"></script>
<!--<link href="../summernote-math.css" rel="stylesheet">-->
<script type="text/javascript">
    $(document).ready(function() {
      $('.summernote').summernote({
        height: 200,
        tabsize: 2,
        placeholder: 'Type here',
      });
    });
</script>
<style>
   .mb-3{
      margin-bottom: 10px;
   }
</style>

<?php
    $select_content=sprintf("select surname, othername, regno, s.class, group_id, schoolid from students s INNER JOIN classes c ON s.class = c.id where s.stid='%d' order by surname asc", $_GET['id']);
    $content_result= mysqli_query($db, $select_content) or die(mysqli_error($db));
    $content = mysqli_fetch_assoc($content_result);
    $num_chk = mysqli_num_rows ($content_result);

    $select_content1=sprintf("select * from daily_report where student_id='%d' and rdate='%s' and report_cat='%d'",
    $studentid, $rdate, $reportid); 
    $content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
    $content1 = mysqli_fetch_assoc($content_result1);
    $num_chk1 = mysqli_num_rows ($content_result1);
?>

<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>Student Daily Report</h3>
		</div>
		<div class="title_right">
			<div class="col-md-7 col-sm-7 col-xs-12 form-group pull-right top_search">
				<a href="index" class="btn btn-sm btn-success"><i class="fa fa-home"></i> Dashboard</a>
                <a href="daily-report?refno=<?php echo $content["class"] ?>&g=<?php echo $content["group_id"] ?>"  class="btn btn-warning">View Report</a> 
                <a href="daily-report?refno=<?php echo $content["class"] ?>&g=<?php echo $content["group_id"] ?>" class="btn btn-primary"><i class="fa fa-plus"></i>New Report</a> 
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="row">
        
		<div class="x_panel">
			<div class="x_title font-weight-bold">
				<h4><strong><?php echo $content["surname"]." ".$content["othername"]." (".$content["regno"];  ?> </h4>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
                
				<form class="form-horizontal" name="frmReg" method="post" onsubmit="return submitDailyReport()" id="Form1" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label"><b>Date</b> </label>
                        <div class="controls">
                            <input class="form-control" name="rdate" id="rdate" type="date" value="<?php echo date("Y-m-d", strtotime($_GET['d'])); ?>" required style="width:320px" />
                            <input required name="group" type="hidden" value="<?php echo $content["group_id"]; ?>"/>
                            <input required name="class" type="hidden" value="<?php echo $content["class"]; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><b>Student</b> </label>
                        <div class="controls">
                            <select name="studentid" id="studentid" class="select2_group form-control" required  tabindex="-1" style="width:320px">
                                <option value="">--Select student </option>
                                <?php
                                   $select_content2= sprintf("select * from students where class='%d' and  group_id='%d' and status = '0' order by surname asc", $content["class"], $content["group_id"]);
                                    $content_result2= mysqli_query($db, $select_content2) or trigger_error(mysqli_error());
                                    $content2 = mysqli_fetch_assoc($content_result2);
                                    $num_chk2 = mysqli_num_rows ($content_result2);
                                    $k = 0
                                ?>
                                <?php do { 	?>
                                <option value="<?php echo  $content2['stid']?>" <?php if($content2['stid'] == $_GET['id']){?> selected="selected" <?php } ?>><?php echo $content2['surname']." ". $content2['othername']." (". $content2['regno'] .")"?></option>
                                <?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
                            </select>
                        </div>
                    </div>
                    
              
                    <div style="margin-bottom: 50px;">
                        <?php
                            $schid = $content['schoolid'];
                            $select_content= sprintf("select * from daily_report_category c inner join schools s on c.schoolid=s.schoolid WHERE c.schoolid='%d' order by heading asc",$schid);
                            $content_result= mysqli_query($db, $select_content) or die(mysqli_error($db));
                            $content = mysqli_fetch_assoc($content_result);
                            $num_chk = mysqli_num_rows ($content_result);
                            if ($num_chk > 0){
                                do { 
                                    $select_content2=sprintf("select * from daily_report where student_id='%d' and rdate='%s' and report_cat='%d'", $_GET['id'], $_GET['d'], $content["id"]); 
                                    $content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
                                    $content2 = mysqli_fetch_assoc($content_result2);
                        ?>
                            <div class="form-group">
                                <label class="control-label"><b><?php echo $content["heading"]; ?></b> </label>
                                <div class="controls">
                                    <input class="form-control" name="reportid[]" type="hidden" value="<?php echo $content["id"]; ?>"/>
                                    <textarea name="question[]" class="summernote"><?php echo $content2["report"]; ?></textarea >
                                </div>
                            </div>
                            <?php } while ($content = mysqli_fetch_assoc($content_result)); 
                                }
                            ?>
                    </div>

                    
                    <!-- <ul class="list-group">
                        <li class="list-group-item mb-3">
                            <div class="form-group">
                                <label class="control-label" for="course"><b>Grade Point</b></label>
                                <div class="controls">
                                    <input class="form-control" name="point" type="number" id="point" required  placeholder="Point per Answer"/>           
                                </div>
                            </div>	
                        </li>
                    </ul> -->
                    
                    <div class="form-group">
                        <input type="submit" value="Upload Report" name="upload" id="submitme" class="btn btn-large btn-primary"/>  
                    </div>
				</form>
			</div>
		</div>
	</div> 
	
</div>	

<?php include("includes/footer.php")?>