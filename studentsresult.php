<?php 
require_once("includes/session.php"); ?>
<?php confirm_logged_in(); ?>
<?php
require_once '..'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'loader.php';
$aLoader = new Loader($db);
?>
<?php
	$pg = mysqli_real_escape_string($db, $_GET['pg']);
	$pv = mysqli_real_escape_string($db, $_GET['pv']);
	$sql = mysqli_real_escape_string($db, $_GET['sql']);
	$overAllScore = 0;
	$cnt=0;
	$_SESSION["schoolid"] = "2";
	if($pg == ""){
		$date = date("Y-m-d");
		$_SESSION["classv"] = "";
		$_SESSION["term"] = "";
		$_SESSION["cgroup"] = "";
		$_SESSION["year"]  = "";
	}
	elseif($pg == 1 or $pg == 2){
		$_SESSION["classv"] = mysqli_real_escape_string($db, $_POST["class"]);
		$_SESSION["term"] = mysqli_real_escape_string($db, $_POST["term"]);
		$_SESSION["cgroup"] = mysqli_real_escape_string($db, $_POST["cgroup"]);
		$_SESSION["year"] = mysqli_real_escape_string($db, $_POST["year"]);
		$_SESSION["schoolid"] = mysqli_real_escape_string($db, $_POST["school"]);
	}
	
	$classv = $_SESSION["classv"] ;
	$term = $_SESSION["term"] ;
	$cgroup = $_SESSION["cgroup"] ;
	$yeardb = $_SESSION["year"] ;

	$select_content1=("select * from classes WHERE id='$classv'");
	$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
	$content1 = mysqli_fetch_assoc($content_result1);
	$schoolid = $content1["schoolid"];
	$finalize = 0;
?>

<?php
	if($pg == "1"){
		$select_contents=("select * from resultposition where class ='$classv' and cgroup='$cgroup' and term ='$term' and year='$yeardb'");
		$content_results= mysqli_query($db, $select_contents) or die(mysqli_error($db));
		$contents = mysqli_fetch_assoc($content_results);
		$num_chks = mysqli_num_rows ($content_results);
		if ($num_chks != 0)
		{
			$sql = "You have finalized this Result before";
			$finalize = 1;
		}
	}
?>

<?php
	if($pg == "6"){
		$select_contents=("update resultposition set status ='1' where class ='$classv' and cgroup='$cgroup' and term ='$term' and year='$yeardb'");
		mysqli_query($db, $select_contents) or die(mysqli_error($db));
		$sql = "Result Has Been Publish For Students";
		$finalize = 1;
		
	}
?>

<?php
	if ($pg == 7)
	{
		$TXTid = mysqli_real_escape_string($db, $_GET['id']);
		$select_content1=("select * from students WHERE stid='$TXTid'");
		$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
		$content1 = mysqli_fetch_assoc($content_result1);
		$num_chk1 = mysqli_num_rows ($content_result1);
	}
?>


<style>
	div.vertical
	{
	 margin-left: -85px;
	 position: absolute;
	 width: 200px;
	 transform: rotate(-90deg);
	 -webkit-transform: rotate(-90deg); /* Safari/Chrome */
	 -moz-transform: rotate(-90deg); /* Firefox */
	 -o-transform: rotate(-90deg); /* Opera */
	 -ms-transform: rotate(-90deg); /* IE 9 */
	}
	
	th.vertical
	{
	 height: 200px;
	 line-height: 14px;
	 padding-bottom: 20px;
	 text-align: left;
	 vertical-align:middle;
	 font-size:14px;
	}
</style>

<?php include("header.php"); ?>
<!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Students Result</h3>
                </div>
    
                <div class="title_right">
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right top_search">
						<a href="index?action=home" class="btn btn-sm btn-success">Dashboard</a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <?php include('form.php'); ?>
			<div class="x_content"> 
				<?php include('../package.result/term_result.php'); ?>
         	 </div>
         </div>
	</div>
   </div>
 </div>
<?php include("includes/footer.php") ?>

<script language="javascript">
	function laodstudents(){
		if(document.frmReg.class.value == "") {
			alert ("Please select Class you want to view their result")
			document.frmReg.class.focus();
			return false
		}
		if(document.frmReg.cgroup.value == "") {
			alert ("Please select Group")
			document.frmReg.cgroup.focus();
			return false
		}
		if(document.frmReg.term.value == "") {
			alert ("Please Select Term")
			document.frmReg.term.focus();
			return false
		}
		if(document.frmReg.year.value == "") {
			alert ("Please Select Year")
			document.frmReg.year.focus();
			return false
		}
		else{
			document.frmReg.action="studentsresult?pg=1"
			document.frmReg.method = "post";
			document.frmReg.submit() 
		}
	}
	
	function loadShool(){
		//declaare a variable that collects the value in the select button
		var schoolid=$('#school').val();
		//checks if the variable is empty
		//alert(schoolid)
		if( schoolid=="")
		{
			$('#container').html("<strong> No value selected for the search record");
			return false;
		}
		mypath='mode=school&schoolid='+schoolid;
		$.ajax({
		type:'POST',
		url:'../loaddata.php',
		data:mypath,
		cache:false,
			success:function(resps){
				$('dept_div').empty();
				//returns the reponse
				$('#class').html(resps);
				return false;
			}
		});
	
		return false;
	}
	
	function finalResult(){
		document.frmReg.action="../package.result/ss-result-finalizer?pg=2"
		document.frmReg.target = "_blank"
		document.frmReg.method = "post";
		document.frmReg.submit() 	
	}
	function finalResult2(){
		document.frmReg.action="studentsresult?pg=6"
		document.frmReg.method = "post";
		document.frmReg.submit() 	
	}

</script>


