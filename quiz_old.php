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
        
    $select_contenttt=("select * from subjects where status ='1'");
    $content_resulttt= mysqli_query($db, $select_contenttt) or die(mysqli_error($db));
    $contenttt = mysqli_fetch_assoc($content_resulttt);
    $termname =  $contenttt["subjects"];
    $term =  $contenttt["tid"];
    
    $select_contentss=("select * from schsession where status =1");
    $content_resultss= mysqli_query($db, $select_contentss) or die(mysqli_error($db));
    $contentss = mysqli_fetch_assoc($content_resultss);	
    $yr =  $contentss["sid"];
     
    if($pg == 3){
        //this action setups the quiz parameter submit
        $testi = mysqli_real_escape_string($db, $_POST["setip"]);
        if(!empty($testi) and $testi ="Save")
        {	
            $classid = mysqli_real_escape_string($db, $_POST['class']);
            $groupid = mysqli_real_escape_string($db, $_POST['cgroup']);
            $subject_id = mysqli_real_escape_string($db, $_POST['subject']);
            $score = mysqli_real_escape_string($db, $_POST['score']);
            $total = mysqli_real_escape_string($db, $_POST['total']);
            $ans = mysqli_real_escape_string($db, $_POST['ans']);
            $time = mysqli_real_escape_string($db, $_POST['time']);
            $date_reg = date("Y-m-d");
            $status=0;
            
            $select_content1=("select * from student_quiz WHERE sessionid='$yr' && class_id='$classid' && group_id='$groupid' && subject_id='$subject_id' && term='$term'");
            $content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
            $content1 = mysqli_fetch_assoc($content_result1);
            $num_chk1 = mysqli_num_rows ($content_result1);
            if($num_chk1>0){
                echo"<script type='text/javascript'>
                    alert('Record exist! Parameter for this Subject Has been Set Before');
                        location.href='exam-setting?pg=1';
                    </script>
                "; 
            }
            else {
                $sql= "insert into student_quiz SET class_id='$classid',group_id='$groupid',term='$term',subject_id='$subject_id',teacher_id='$xID',time='$time',totalscore='$total',score='$score', sessionid='$yr',ansNo='$ans',date_reg='$date_reg',status='$status'";
                mysqli_query($db, $sql)or die(mysqli_error($db));
                echo"<script type='text/javascript'>
                    alert('Parameter Alert! Operation was Successful') ;
                    location.href='exam-setting?pg=1';
                </script>
            "; 
            }
            
        }
    }
    if($pg == 4){
        //this action setups the quiz parameter
        $testi = mysqli_real_escape_string($db, $_POST["setip"]);
        if(!empty($testi) and $testi ="Update")
        {	
            $id=mysqli_real_escape_string($db, $_POST["para_id"]);
            $classid = mysqli_real_escape_string($db, $_POST['class']);
            $groupid = mysqli_real_escape_string($db, $_POST['cgroup']);
            $subject_id = mysqli_real_escape_string($db, $_POST['subject']);
            $score = mysqli_real_escape_string($db, $_POST['score']);
            $total = mysqli_real_escape_string($db, $_POST['total']);
            $ans = mysqli_real_escape_string($db, $_POST['ans']);
            $time = mysqli_real_escape_string($db, $_POST['time']);
            $date_reg = date("Y-m-d");
            
            $sql= "update student_quiz SET class_id='$classid',group_id='$groupid',term='$term',subject_id='$subject_id',teacher_id='$xID',time='$time',totalscore='$total',score='$score',ansNo='$ans', sessionid='$yr',date_reg='$date_reg' where qid='$id'";
            mysqli_query($db, $sql)or die(mysqli_error($db));
            setMessage("Parameter Alert! Operation was Successful");
            echo"<script type='text/javascript'>
                        location.href='exam-setting?pg=1';
                    </script>
                "; 
            
        }
    }
             /// update the date
         //#############################################################################################
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
                            <h3><i class="glyphicon glyphicon-qrcode"></i> Exam Setup Parameters</h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right top_search">
                                <a href="index" class="btn btn-sm btn-success"><i class="fa fa-home"></i>Dashboard</a>
                                <a href="exam-setting?pg=7" class="btn btn-primary ">View Exam</a>
                                <a href="cbt_question?action=set_question" class="btn btn-info">Set Questions</a>
                                <a href="question-view?pg=11&action=view_question" class="btn btn-success">View Questions</a>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <!-- CBT Start Here-->
                           
                            <div class="x_panel" >
                           
                            <div class="x_content">
                                <span style="font-family:Arial, Helvetica, sans-serif;font-size:11px;color:#FF0000" id="msg_info"><?php echo getMessage(); ?></span>
                                <?php
                                if($_GET["pg"]==13) {
                                    $id=$_GET["id"];
                                    $sele=("select * from student_quiz WHERE qid='$id'");
                                    $content1= mysqli_query($db, $sele) or die(mysqli_error($db));
                                    $cont1 = mysqli_fetch_assoc($content1);
                                ?>          
                                <!--######################################################################################################-->
                                <form method="post"  class="form-horizontal" name="frmReg" action="?pg=4">
                                <table class="table" style="background-color:rgb(204,255,255);">
                                    <tr>
                                        <td colspan="8"> <strong><i class="glyphicon glyphicon-folder-open"></i>&nbsp; Question Parameter Upload: </strong>
                                        <?php
                                        $cid =  $cont1['class_id'];
                                        $select_content1=("select * from classes where id='$cid'");
                                        $content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
                                        $content1 = mysqli_fetch_assoc($content_result1); 
                                        
                                        $cid = $cont1['group_id'];
                                        $select_content2=("select * from groups where gid='$cid'");
                                        $content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
                                        $content2 = mysqli_fetch_assoc($content_result2); 
                                        
                                        $cid = $cont1['subject_id'];
                                        $select_content3=("select * from subjects where sid='$cid'");
                                        $content_result3= mysqli_query($db, $select_content3) or die(mysqli_error($db));
                                        $content3 = mysqli_fetch_assoc($content_result3);
                                        $_SESSION['c'] =$content1["class"];
                                        $_SESSION['s'] =$content3["subject"];
                                        if($cont1['id'] > 0){
                                            echo $content1["class"] ." ".$content2["groupname"] ." ".$content3["course"].", for ".$termname . " Semester ".$contentss["sesion"].' Academic Session';
                                        }
                                       ?>
                                        </td>
                                </tr>
                                <tr>
                                    <td colspan="8" style="padding-top:10px"> Note: Please you are to fill in the specified parameter to enable you control the online test. </td>
                                </tr>
                            </table>
                                
                            <!--####################################################### -->
                            <div id="quizsetup">
                                    <?php
                                        if(isset($alert))
                                        {
                                    ?>
                                        <div style="color:#CC0000;"><i class="glyphicon glyphicon-info-sign"></i> <?php echo $alert; ?> </div>
                                    <?php
                                    }
                                    ?>
                                    
                                    <input type="hidden" name="cat_id" value="<?php echo $_SESSION["t_sch_id"] ?>" />
                                    <input type="hidden" name="class" value="<?php echo $_SESSION["t_class_id"] ?>" />
                                    <input type="hidden" name="subject" value="<?php echo $_SESSION["t_subject_id"] ?>" />
                                    <input type="hidden" name="cgroup" value="<?php echo $_SESSION["t_group_id"] ?>" />
                                    <input type="hidden" name="teacherid" value="<?php echo $_SESSION["teacherlog"]; ?> " id="teacherid">
                                    <input type="hidden" name="para_id" value="<?php echo $cont1['qid']; ?> " id="para_id">
                                    <div class="control-group">
                                        <label class="control-label" for="course"><b>Title</b></label>
                                        <div class="controls">
                                        <input name="title" type="text" id="title" class="form-control " style="width:300px" value="<?php echo $cont1['title']; ?>" required  placeholder="Quiz Title" />
                                        </div>
                                    </div>   
                                   	
                                    <div class="control-group">
                                        <label class="control-label" for="course"><b>Answerable Questions</b></label>
                                        <div class="controls">
                                            <font face="verdana" style="font-size: 12px; color:#000000">
                                            <input name="ans" type="text" id="txtChar" class="form-control input-sm" style="width:300px" value="<?php echo $cont1['ansNo']; ?>" onkeypress="return isNumberKey(event)"  required  onkeyup="scoreq()"  placeholder="No of Questions to Ans" />
                                            </font>   
                                        </div>
                                    </div>   
                                    	
                                    <div class="control-group">
                                        <label class="control-label" for="course"><b>Time to spend in Minute (60 = 1hr.)</b></label>
                                        <div class="controls">
                                            <font face="verdana" style="font-size: 12px; color:#000000">
                                            <input name="time" placeholder="Time to spend" class="form-control input-sm" style="width:300px" value="<?php echo $cont1['time']; ?>" type="text" id="time"  required />
                                            </font>   
                                        </div>
                                    </div> 	    
                                    <div class="control-group">
                                        <label class="control-label" for="course"><b>Total Score</b></label>
                                        <div class="controls">
                                            <font face="verdana" style="font-size: 12px; color:#000000">
                                                <input name="total" type="text" id="total" class="form-control input-sm" style="width:300px"  value="100" onkeyup="scoreq()" required/>
                                            </font>   
                                        </div>
                                    </div> 	   
                                    <div class="control-group">
                                        <div class="controls">
                                            <input type="submit" name="setip" value="Update" class="btn btn-info btn-large"/>
                                        </div>
                                    </div> 	
                                </div>  
                                </form>   
                                <?php
                                }
                                ?>
                            </div>

                            <?php
                            if($_GET["pg"] =="") { ?>
                            <form method="post"  class="form-horizontal" name="frmReg" action="?pg=3">
                            <div id="quizsetup">
                                    <?php
                                        if(isset($alert))
                                        {
                                    ?>
                                        <div style="color:#CC0000;"><i class="glyphicon glyphicon-info-sign"></i> <?php echo $alert; ?> </div>
                                    <?php
                                    }
                                    ?>
                                    
                                    <input type="hidden" name="cat_id" value="<?php echo $_SESSION["t_sch_id"] ?>" />
                                    <input type="hidden" name="class" value="<?php echo $_SESSION["t_class_id"] ?>" />
                                    <input type="hidden" name="subject" value="<?php echo $_SESSION["t_subject_id"] ?>" />
                                    <input type="hidden" name="cgroup" value="<?php echo $_SESSION["t_group_id"] ?>" />
                                    <input type="hidden" name="teacherid" value="<?php echo $_SESSION["teacherlog"]; ?> " id="teacherid">
                                    <input type="hidden" name="para_id" value="<?php echo $cont1['qid']; ?> " id="para_id">
                                    <div class="control-group">
                                        <label class="control-label" for="course"><b>Title</b></label>
                                        <div class="controls">
                                        <input name="title" type="text" id="title" class="form-control " style="width:300px" value="<?php echo $cont1['title']; ?>" required  placeholder="Quiz Title" />
                                        </div>
                                    </div>   
                                    <div class="control-group">
                                        <label class="control-label" for="course"><b>Answerable Questions</b></label>
                                        <div class="controls">
                                            <font face="verdana" style="font-size: 12px; color:#000000">
                                            <input name="ans" type="text" id="txtChar" class="form-control input-sm" style="width:300px" value="<?php echo $cont1['ansNo']; ?>" onkeypress="return isNumberKey(event)"  required  onkeyup="scoreq()"  placeholder="No of Questions to Ans" />
                                            </font>   
                                        </div>
                                    </div>   
                                   
                                    <div class="control-group">
                                        <label class="control-label" for="course"><b>Time to spend in Minute (60 = 1hr.)</b></label>
                                        <div class="controls">
                                            <font face="verdana" style="font-size: 12px; color:#000000">
                                            <input name="time" placeholder="Time to spend" class="form-control input-sm" style="width:300px" value="<?php echo $cont1['time']; ?>" type="text" id="time"  required />
                                            </font>   
                                        </div>
                                    </div> 	    
                                    <div class="control-group">
                                        <label class="control-label" for="course"><b>Total Score</b></label>
                                        <div class="controls">
                                            <font face="verdana" style="font-size: 12px; color:#000000">
                                                <input name="total" type="text" id="total" class="form-control input-sm" style="width:300px"  value="100" onkeyup="scoreq()" required/>
                                            </font>   
                                        </div>
                                    </div> 	   
                                    <div class="control-group">
                                        <div class="controls">
                                            <input type="submit" name="setip" value="Save" class="btn btn-info btn-large"/>
                                        </div>
                                    </div> 	
                                </div>    
                                </form> 
                                <?php
                                }
                                ?>
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