<?php 
   ini_set('display_errors',0); 
   require_once("includes/session.php"); 
   confirm_logged_in();
   require_once ('../connection.php');
   include("header.php"); 

   require_once '..'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'loader.php';
    $aLoader = new Loader($db);
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

<div class="right_col" role="main">
	<div class="page-title">
		<div class="alert alert-info">
            <a href="index"><b>Home</b></a> >>
            <a href="index?action=home"><b><?php echo $aLoader->getClassName($_SESSION["t_class_id"]) ." ".$aLoader->getGroupName($_SESSION["t_group_id"]). " ".$aLoader->getSubjectName($_SESSION["t_subject_id"]); ?></b></a> >>
            <strong>Student Daily Report</strong> 
            <div class="pull-right">
                <a href="daily-report" class="btn btn-warning">View Report</a> 
            </div>
        </div>
	</div>
    
	<div class="clearfix"></div>
	<div class="row">
        <?php
            $select_content=sprintf("select schoolid from classes  where id='%d'", $_GET['refno']);
            $content_result= mysqli_query($db, $select_content) or die(mysqli_error($db));
            $content = mysqli_fetch_assoc($content_result);
            $num_chk = mysqli_num_rows ($content_result);

            $select_content1=sprintf("select * from daily_report where student_id='%d' and rdate='%s' and report_cat='%d'",
			$studentid, $rdate, $reportid); 
			$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
			$content1 = mysqli_fetch_assoc($content_result1);
			$num_chk1 = mysqli_num_rows ($content_result1);
        ?>
		<div class="x_panel">
			
			<div class="x_content">
                
				<form class="form-horizontal" name="frmReg" method="post" onsubmit="return submitDailyReport()" id="Form1" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label"><b>Date</b> </label>
                        <div class="controls">
                            <input class="form-control" name="rdate" id="rdate" type="date" value="<?php echo date("Y-m-d"); ?>" required style="width:320px" />
                            <input required name="group" type="hidden" value="<?php echo  $_GET['g']; ?>"/>
                            <input required name="class" type="hidden" value="<?php echo $_GET['refno']; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><b>Student</b> </label>
                        <div class="controls">
                            <select name="studentid" id="studentid" class="select2_group form-control" required  tabindex="-1" style="width:320px">
                                <option value="">--Select student </option>
                                <?php
                                   echo $select_content2= sprintf("select * from students where class='%d' and  group_id='%d' and status = '0' order by surname asc", $_GET['refno'], $_GET['g']);
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
                    
                    <button type="button" class="btn btn-primary" id="reportbtn" onclick="return reportModal()" >Give Report</button>

                    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Student Daily Report</h4>
                            </div>
                            <div class="modal-body">
                                <div style="margin-bottom: 50px;">
                                    <?php
                                        $schid = $content['schoolid'];
                                        $select_content= sprintf("select * from daily_report_category c inner join schools s on c.schoolid=s.schoolid WHERE c.schoolid='%d' order by heading asc",$schid);
                                        $content_result= mysqli_query($db, $select_content) or die(mysqli_error($db));
                                        $content = mysqli_fetch_assoc($content_result);
                                        $num_chk = mysqli_num_rows ($content_result);
                                        if ($num_chk > 0){
                                            do { 
                                    ?>
                                        <div class="form-group">
                                            <label class="control-label"><b><?php echo $content["heading"]; ?></b> </label>
                                            <div class="controls">
                                                <input class="form-control" name="reportid[]" type="hidden" value="<?php echo $content["id"]; ?>"/>
                                                <textarea name="question[]" class="summernote"> </textarea >
                                            </div>
                                        </div>
                                        <?php } while ($content = mysqli_fetch_assoc($content_result)); 
                                            }
                                        else{
                                            echo "Daily Report Category have not been setup! Contact the system admin";
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
                                
                               	
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="submit" value="Upload Report" name="upload" id="submitme" class="btn btn-large btn-primary"/>
                            </div>

                        </div>
                        </div>
                    </div>

					
				</form>
			</div>
		</div>
	</div> 
	
</div>	

<?php include("includes/footer.php")?>