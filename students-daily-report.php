<?php 
require_once("includes/session.php");
confirm_logged_in(); 
require_once ('../connection.php');
$xID = $_SESSION["ustcode"];
?>
<?php
	$pg = $_GET['pg'];
	$pv = $_GET['pv'];
	$sql = $_GET['sql'];
	
	$select_content1=("select * from team order by id asc limit 1");
	$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
	$content1 = mysqli_fetch_assoc($content_result1);
	
	$select_content=("select * from students");
	$content_result= mysqli_query($db, $select_content) or die(mysqli_error($db));
	$content = mysqli_fetch_assoc($content_result);
	$num_chk = mysqli_num_rows ($content_result);
	if($content1["nos"] <= $num_chk){
		$studentsno = 2;
    }
	require_once '..'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'loader.php';
    $aLoader = new Loader($db);
	include("header.php");
?>

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="alert alert-info">
                    <a href="index"><b>Home</b></a> >>
                    <a href="index?action=home"><b><?php echo $aLoader->getClassName($_SESSION["t_class_id"]) ." ".$aLoader->getGroupName($_SESSION["t_group_id"]). " ".$aLoader->getSubjectName($_SESSION["t_subject_id"]); ?></b></a> >>
                    <strong>Lesson Plan</strong> 
                    <div class="pull-right">
                        <a href="daily-report?refno=<?php echo $_GET['refno'] ?>&g=<?php echo $_GET['g'] ?>&s=<?php echo $_GET['s'] ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> New Report</a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                
                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" >
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
                    <button type="button" class="btn btn-primary" id="reportbtn" onclick="return reportModalList()" >Load Report</button>
                    </form>
                    <table class="table table-striped responsive-utilities jambo_table" id="example">
                        <thead>
                            <tr>
                                <th align="center">Reg Number</th>
                                <th align="center">Student Name</th>
                                <th align="center">Report</th>
                                <th align="center">Date</th>
                                <th align="center">Edit</th>
                            </tr>
                        </thead>
                        <tbody id="dailreport">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
                
    <br />  <br />        
                
 <!-- footer content -->
 <?php include("includes/footer.php")?>

