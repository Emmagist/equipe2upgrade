<?php 
require_once("includes/session.php"); 
require_once '..'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'loader.php';
?>
<?php confirm_logged_in(); ?>
<?php
$xID = $_SESSION["ustcode"];
$pg = $_GET["pg"];
?>
<?php
		$xID=$_SESSION["teacherlog"];
        $parentid = $_SESSION['parentid'];
        
    if($pg == 2){
        $_SESSION["class_id"] = mysqli_real_escape_string($db, $_GET["class"]);
        $_SESSION["subject"] = mysqli_real_escape_string($db, $_GET["subject"]);
        $_SESSION["cgroup"] = mysqli_real_escape_string($db, $_GET["cgroup"]);
    }
       
        
    $classid = $_SESSION["class_id"];
    $subject_id = $_SESSION["subject"];
    $groupid = $_SESSION["cgroup"];
        
    $select_contenttt=("select * from subjects where status ='1'");
    $content_resulttt= mysqli_query($db, $select_contenttt) or die(mysqli_error($db));
    $contenttt = mysqli_fetch_assoc($content_resulttt);
    $termname =  $contenttt["term"];
    $term =  $contenttt["tid"];
    
    $select_contentss=("select * from schsession where status =1");
    $content_resultss= mysqli_query($db, $select_contentss) or die(mysqli_error($db));
    $contentss = mysqli_fetch_assoc($content_resultss);	
    $yr =  $contentss["sid"];
 	
    
?>

<?php 
    include("header.php");
    $aLoader = new Loader($db);
?>

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Result</h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right top_search">
                               <a href="dashboard" class="btn btn-sm btn-success"><i class="fa fa-home"></i>Dashboard</a>
                                <a href="exam-setting?pg=7" class="btn btn-primary ">View Quiz</a>
                                <a href="cbt_question?action=set_question" class="btn btn-info">Set Questions</a>
                                <a href="question-view?pg=11&action=view_question" class="btn btn-success">View Questions</a>                            </div>
                            </div>
                        </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <!-- CBT Start Here-->
                           
                            <div class="x_panel" >
                            <div class="x_title">
                                <form method="post" action="?pg=2" name="frmReg" onsubmit="return loginCheck()" >
                                    <div class="col-md-3 col-sm-4 col-xs-12">
                                        <input type="hidden" name="pg" value="<?php echo $pg; ?> " id="pg">
                                        <input type="hidden" name="teacherid" value="<?php echo $_SESSION["teacherlog"]; ?> " id="teacherid">
                                        <select name="class" id='class' class="form-control input-sm" style="width:150px" onChange="return deselectGroup();">
                                            <option value="">Select Level</option>
                                            <?php
                                                echo $aLoader->getTeacherClass($_SESSION["teacherlog"], $classid);
                                            ?>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-4 col-xs-12">
                                        <select name="cgroup" id='cgroup' class="form-control input-sm" style="width:150px" onChange="return mySearch2();">
                                            <option value="0">Select Group</option>
                                            <?php
                                                echo $aLoader->getTeacherGroup($_SESSION["teacherlog"], $groupid);
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-12">
                                        <select name="subject" id='sub' class="form-control input-sm" style="width:250px">
                                            <option value="">Select Subject</option>
                                            <?php
                                                $where = " WHERE levelid='$classid' and lectuer_id='".$_SESSION["teacherlog"]."' and groupid='$groupid'";
                                                echo $aLoader->getSubjectBase($where, $subject_id);
                                            ?>
                                        </select>
                                    </div>
                                        
                                    <div class="col-md-3 col-sm-4 col-xs-12">
                                        <input  type="submit" class="btn btn-primary" value="  Search  " />
                                    </div>
                                </form>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <span style="font-family:Arial, Helvetica, sans-serif;font-size:11px;color:#FF0000" id="msg_info"><?php echo $sql; ?></span>
                                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="example">
                                    <thead>
                                        <tr>
                                            <th width="5px">S/N</th>
                                            <th width="23%">Student</th>
                                            <th width="23%">Course</th>
                                            <th width="13%">My Score</th>
                                            <th width="13%">Grade </th>
                                            <th width="15%">No of Qtn</th>
                                            <th width="10%">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody class="td1">

                                        <?php
                                            if($pg == 20){
                                               $_SESSION["cl_rt"] = mysqli_real_escape_string($db, $_GET["id"]);
                                            }
                                             $sql=mysqli_query($db, " select * from quiz_result q INNER JOIN students s ON q.sid=s.student_id where q.testID='".$_SESSION["cl_rt"]."'")or die(mysqli_error($db));
                                            if(mysqli_num_rows($sql) ==0)
                                            {
                                            ?>
                                                <tr>
                                                    <td style="color:rgb(204,0,0);" colspan="7"> <strong>No Report of Test written yet.</td>
                                                </tr>
                                            <?php
                                            }
                                            else
                                                while($row=mysqli_fetch_array($sql))
                                                {
                                                    $k = $k + 1;
                                            ?>
                                                <tr class="del<?php echo $id ?>" title=" <?php  echo"Written Date: ". ucfirst($row['date_written']);?>" onmouseover="this.style.backgroundColor='#BDDDB9';" onmouseout="this.style.backgroundColor='';">
                                                    <td>   <b><?php echo $k; ?></td> 
                                                    <td>    <?php  echo $row['surname']." ".$row['othername'] ;?></td>
                                                    <td>    <?php 
                                                    $select_content=("select * from subjects where sid ='".$row['sub_id']."'");
                                                    $content_result= mysqli_query($db, $select_content) or die(mysqli_error($db));
                                                    $content = mysqli_fetch_assoc($content_result);
                                                    echo $content['subject'];?></td>
                                                    <td>    <?php  echo $row['score'];?></td>
                                                    <td>    <?php  if($row['score'] >=50 ){echo ucfirst("Pass"); } else echo ucfirst("Fail");?></td>
                                                    <td>     <?php  echo ucfirst($row['total_question']);?>
                                                    </td>
                                                    <td>
                                                    <!-- <a href="reprint-acknowledgement.php?sid=<?php echo $row["student_id"]; ?>&refno=<?php echo $row["classid"];?>&s=<?php echo $row["sub_id"];?>&testid=<?php echo $row['testID'];?>" target="_blank" class="btn btn-primary btn-xs">Veiw Result</a> -->
                                                    <a href="student-result.php?xid=<?php echo $row["student_id"]; ?>&pg=2&mtid=<?php echo $row['testID'];?>" target="_blank" class="btn btn-primary btn-xs">Veiw Result</a> 
                                                </td>
                                                                                                            
                                        </tr>
                                        <?php  }?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- CBT Ends here -->
                        </div>
                    </div>
                </div>
            </div>
                
                
              
                
 <!-- footer content -->
               <?php include("includes/footer.php")?>




<script language="javascript">
function loginCheck() {

if(document.frmReg.group.value == "") {
alert ("Please enter group name")
document.frmReg.group.focus();
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

<script language="JavaScript" type="text/javascript">
//#################################################################################################
function mySearch(){
	//declaare a variable that collects the value in the select button
	var nos = $('#nos').val();

	//checks if the variable is empty

	mypath='mode=groups&nos='+nos;
			$.ajax({
			type:'POST',
			url:'<?php echo SITEURL; ?>/backend/loaddata.php',
			data:mypath,
			cache:false,
			success:function(resps){
			$('#addGroups').append(resps);
			return false;
		}
	});
	return false;
}
//########################################################################################################
</script>