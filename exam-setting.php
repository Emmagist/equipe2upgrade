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
        $_SESSION["class_id"] = mysqli_real_escape_string($db, $_POST["class"]);
        $_SESSION["subject"] = mysqli_real_escape_string($db, $_POST["subject"]);
        $_SESSION["cgroup"] = mysqli_real_escape_string($db, $_POST["cgroup"]);
    }
    else if($_GET["pgs"]){
        $_SESSION["class_id"] = mysqli_real_escape_string($db, $_GET["refno"]);
        $_SESSION["subject"] = mysqli_real_escape_string($db, $_GET["s"]);
        $_SESSION["cgroup"] = mysqli_real_escape_string($db, $_GET["g"]);
    }
       
        
    $classid = $_SESSION["class_id"];
    $subject_id = $_SESSION["subject"];
    $groupid = $_SESSION["cgroup"];
        
    $select_contenttt=("select * from terms where status ='1'");
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
                            <h3>Exams</h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right top_search">
                                <a href="index" class="btn btn-sm btn-success"><i class="fa fa-home"></i>Dashboard</a>
                            </div>
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
                                            <option value="">Select Class </option>
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
                                                $where = " WHERE classid='$classid' and teacherid='".$_SESSION["teacherlog"]."' and groupid='$groupid'";
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
                                <span style="font-family:Arial, Helvetica, sans-serif;font-size:11px;color:#FF0000" id="msg_info"><?php echo getMessage(); ?></span>
                                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered">
                                    <div class="alert alert-info">Page Name : Regulate Test >> <strong><a href="exam-parameter.php?_mode=setup&id=9&refno=<?php echo $classid ?>&g=<?php echo $groupid?>&s=<?php echo $subject_id ?>"><b>Setup Timetable</b></a></strong> </div>
                                        <?php
                                        if($pg == 2){
                                            $query = mysqli_query($db, "select * from ada_contents where user_guid='$xID' and class_id='$classid' AND page_link='quiz'") or die(mysqli_error($db));
                                        }
                                        else{
                                            $query = mysqli_query($db, "select * from ada_contents where user_guid='$xID' AND page_link='quiz'") or die(mysqli_error($db));
                                        }
                                        $nu10 = mysqli_num_rows($query);
                                        if($nu10 > 0){ ?>

                                        <thead>
                                            <tr>
                                                <th width="4%">S/N</th>
                                                <th width="21%">Subject</th>
                                                <th width="7%">Class</th>
                                                <th width="8%">Term</th>
                                                <th width="8%">Total</th>
                                                <th width="7%">Time</th>
                                                <th width="8%">AnsNo</th>
                                                <th width="7%">Status</th>
                                                <th width="22%">Action</th>
                                                <th width="22%">Result</th>
                                            </tr>
                                        </thead>
                                        <tbody class="td1">
                                        <?php                        
                                        while ($row = mysqli_fetch_array($query)) {
                                            $id = $row['content_id'];
                                            $k = $k + 1;
                                            ?>
                                            <tr class="del<?php echo $id ?>">
                                                <td><input value="<?php echo $k; ?>" type="checkbox"/></td> 
                                                <td><?php  
                                                $subject=("select * from subjects WHERE sid='".$row["subject"]."' LIMIT 1");
                                                $csubject= mysqli_query($db, $subject) or die(mysqli_error($db));
                                                $contcsubject = mysqli_fetch_assoc($csubject);
                                                echo $contcsubject["subject"];
                                                ?></td>
                                                <td><?php  $query1 = mysqli_query($db, "select * from classes where id ='".$row["class_id"]."'") 
                                                or die(mysqli_error($db)); 
                                                $row1 = mysqli_fetch_array($query1);
                                                echo $row1['class'];?></td>
                                                <td><?php  
                                                $term=("select * from subjects WHERE sid='".$row["term"]."' ");
                                                $cterm= mysqli_query($db, $term) or die(mysqli_error($db));
                                                $conterm = mysqli_fetch_assoc($cterm);
                                                
                                                $ses=("select * from schsession WHERE sid='".$row["sessionid"]."' ");
                                                $sess= mysqli_query($db, $ses) or die(mysqli_error($db));
                                                $sesss = mysqli_fetch_assoc($sess);
                                                echo $conterm["term"].' '.$sesss["sesion"];
                                                
                                                ?></td>
                                                <td><?php  echo ($row['total_score'])?>/<?php  echo ($row['no_of_qtn'])?></td>
                                                <td><?php  echo ($row['time_min'])?></td>
                                                <td><?php  echo ($row['no_of_qtn'])?></td>
                                                <td>
                                                    <?php   if($row['status']==0){
                                                        echo" <strong>Not Set</strong>";} else {echo" <strong>Set</strong>";}
                                                        ?>
                                                </td>
                                                <td align="left">
                                                    <div class="btn-group">
                                                       
                                                        <a href="question-view?pg=13&id=<?php echo $id; ?>&refno=<?php echo $classid ?>&g=<?php echo $groupid?>&s=<?php echo $subject_id ?>" class="btn btn-success btn-xs" title="Exam Question">Question</a>

                                                        <a href="quiz?pg=13&refno=<?php echo $row['entity_guid']; ?>&action=edit" class="btn btn-warning btn-xs" title="Edit Record">Edit</a>
                                                        
                                                    </div>
                                                </td>
                                                <td>
                                                <a href="cbt-result?pg=20&id=<?php echo $id; ?>&refno=<?php echo $classid ?>&g=<?php echo $groupid?>&s=<?php echo $subject_id ?>"  title="View Result" class="btn btn-success btn-xs">Result</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <?php } 
                                    else{?>
                                    <tbody class="td1">
                                    <tr>
                                    <td colspan="7">No Record Found </td>
                                    </tr>
                                    </tbody>
                                    <?php } ?>
                                </table>
                            </div>
                            <!-- CBT Ends here -->
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