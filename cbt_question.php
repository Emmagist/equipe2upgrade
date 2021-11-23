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
 	
    //#####################################################################
    $jjj = $_POST["upload"];
    if(isset($jjj) and $pg==5)
    {		
        $subject_id = mysqli_real_escape_string($db, $_POST["subject"]);
        $groupid = mysqli_real_escape_string($db, $_POST["cgroup"]);
        $classid = mysqli_real_escape_string($db, $_POST["class"]);

        $select_content11=("select qid from student_quiz WHERE sessionid='$yr' && class_id='$classid' && group_id='$groupid' && subject_id='$subject_id' && term='$term'");
        $content_result11= mysqli_query($db, $select_content11) or die(mysqli_error($db));
        $content11 = mysqli_fetch_assoc($content_result11);
        $quiz_ID = $content11['qid'];
       
        $question = mysqli_real_escape_string($db, $_POST["question"]);
        $a1 = mysqli_real_escape_string($db, $_POST["a"]);
        $b1 = mysqli_real_escape_string($db, $_POST["b"]);
        $c1 = mysqli_real_escape_string($db, $_POST["c"]);
        $d1 = mysqli_real_escape_string($db, $_POST["d"]);
        $ans = mysqli_real_escape_string($db, $_POST["ans"]);
        $point = mysqli_real_escape_string($db, $_POST["point"]);
        
        if($_FILES['que']['name']){
            $errors= array();
            $question2 = $_FILES['que']['name'];
            $file_size =$_FILES['que']['size'];
            $file_tmp =$_FILES['que']['tmp_name'];
            $file_type=$_FILES['que']['type'];   
            $file_ext=strtolower(end(explode('.',$_FILES['que']['name'])));		
            $expensions= array("jpg","png","gif"); 		
            if(in_array($file_ext,$expensions)=== false){
                $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            }
            if($file_size >100097152){
                $errors[]='File size must be excately 20 MB';
            }				
            if(empty($errors)==true){
                move_uploaded_file($file_tmp,"../backend/questions/".$question2);
            }
            else{
                print_r($errors);
            }
        }
        
        if($_FILES['optA']['name']){
            $errors= array();
            $a2 = $_FILES['optA']['name'];
            $file_size =$_FILES['optA']['size'];
            $file_tmp =$_FILES['optA']['tmp_name'];
            $file_type=$_FILES['optA']['type'];   
            $file_ext=strtolower(end(explode('.',$_FILES['optA']['name'])));		
            $expensions= array("jpg","png","gif"); 		
            if(in_array($file_ext,$expensions)=== false){
                $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            }
            if($file_size >100097152){
                $errors[]='File size must be excately 20 MB';
            }				
            if(empty($errors)==true){
                move_uploaded_file($file_tmp,"../backend/questions/".$a2);
            }
            else{
                print_r($errors);
            }
        }
        
        if($_FILES['optB']['name']){
            $errors= array();
            $b2 = $_FILES['optB']['name'];
            $file_size =$_FILES['optB']['size'];
            $file_tmp =$_FILES['optB']['tmp_name'];
            $file_type=$_FILES['optB']['type'];   
            $file_ext=strtolower(end(explode('.',$_FILES['optB']['name'])));		
            $expensions= array("jpg","png","gif"); 		
            if(in_array($file_ext,$expensions)=== false){
                $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            }
            if($file_size >100097152){
                $errors[]='File size must be excately 20 MB';
            }				
            if(empty($errors)==true){
                move_uploaded_file($file_tmp,"../backend/questions/".$b2);
            }
            else{
                print_r($errors);
            }
        }
    
        if($_FILES['optC']['name']){
            $errors= array();
            $c2 = $_FILES['optC']['name'];
            $file_size =$_FILES['optC']['size'];
            $file_tmp =$_FILES['optC']['tmp_name'];
            $file_type=$_FILES['optC']['type'];   
            $file_ext=strtolower(end(explode('.',$_FILES['optC']['name'])));		
            $expensions= array("jpg","png","gif"); 		
            if(in_array($file_ext,$expensions)=== false){
                $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            }
            if($file_size >100097152){
                $errors[]='File size must be excately 20 MB';
            }				
            if(empty($errors)==true){
                move_uploaded_file($file_tmp,"../backend/questions/".$c2);
            }
            else{
                print_r($errors);
            }
        }
    
        if($_FILES['optD']['name']){
            $errors= array();
            $d2 = $_FILES['optD']['name'];
            $file_size =$_FILES['optD']['size'];
            $file_tmp =$_FILES['optD']['tmp_name'];
            $file_type=$_FILES['optD']['type'];   
            $file_ext=strtolower(end(explode('.',$_FILES['optD']['name'])));		
            $expensions= array("jpg","png","gif"); 		
            if(in_array($file_ext,$expensions)=== false){
                $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            }
            if($file_size >100097152){
                $errors[]='File size must be excately 20 MB';
            }				
            if(empty($errors)==true){
                move_uploaded_file($file_tmp,"../backend/questions/".$d2);
            }
            else{
                print_r($errors);
            }
        }
        
        if($quiz_ID != ""){
            $result2 = mysqli_query($db, "SELECT question FROM quiz_question where question ='$question' && sessionid='$yr' && class_id='$classid' && group_id='$groupid' && subject_id='$subject_id' && term_id='$term'")or die(mysqli_error($db));
            if(mysqli_num_rows($result2) == 0) // table is empty    
            {
                echo $sql = "INSERT INTO quiz_question set question = '$question', A = '$a1', B='$b1', C= '$c1', D = '$d1', que = '$question2', A2 = '$a2', B2='$b2', C2= '$c2', D2 = '$d2', ans = '$ans', anspoint='$point', quiz_ID='$quiz_ID', subject_id='$subject_id',teacher_id='$xID',sessionid='$yr',term_id='$term',group_id='$groupid',class_id='$classid'";
               
                mysqli_query($db, $sql) or die("could not insert, reason: ".	mysqli_error($db));
                
                
                echo"<script type='text/javascript'>
                    alert('Operation was Successful $sql ');
                    location.href='question-view?pg=1';
                </script>
                "; 
            }
            else
            {
                echo"<script type='text/javascript'>
                    alert('Question Exit! Set Another Question');
                    location.href='question-view?pg=1';
                </script>
                ";
            }
            
        }
        else
        {
            
            echo"<script type='text/javascript'>
                alert('Set Question Parameter First');
                    location.href='exam-parameter?pg=1';
                </script>
                ";
        }
    
        
    }
    //############################################################################################

    //#############################################################
    if(isset($_GET["id"]) and $_GET["pg"]== 3)
    {
    
        $TXTid = $_GET['id'];
        $select_content12=("select * from  quiz_question WHERE id='$TXTid'");
        $content_result12= mysqli_query($db, $select_content12) or die(mysqli_error($db));
        $content12 = mysqli_fetch_assoc($content_result12);
    }
    //#############################################################

    //update Question
$eee = $_POST["update"];
if(isset($eee))
{	
    $subject_id = mysqli_real_escape_string($db, $_POST["subject"]);
    $groupid = mysqli_real_escape_string($db, $_POST["cgroup"]);
    $classid = mysqli_real_escape_string($db, $_POST["class"]);
	$id= mysqli_real_escape_string($db, $_POST["quest_id"]);		
	$question1 = mysqli_real_escape_string($db, $_POST["question"]);
	$a1 = mysqli_real_escape_string($db, $_POST["a"]);
	$b1 = mysqli_real_escape_string($db, $_POST["b"]);
	$c1 = mysqli_real_escape_string($db, $_POST["c"]);
	$d1 = mysqli_real_escape_string($db, $_POST["d"]);
	$ans = mysqli_real_escape_string($db, $_POST["ans"]);
	$point = mysqli_real_escape_string($db, $_POST["point"]);
	$quiz_ID = mysqli_real_escape_string($db, $_POST["quiz_id"]);
	$question2 = mysqli_real_escape_string($db, $_POST['q']);
	$a2 = mysqli_real_escape_string($db, $_POST['a2']);
	$b2 = mysqli_real_escape_string($db, $_POST['b2']);
	$c2 = mysqli_real_escape_string($db, $_POST['c2']);
	$d2 = mysqli_real_escape_string($db, $_POST['d2']);
	
	if($_FILES['que']['name']){
		// Delete Old Image first
		$file = "../backend/questions/".$question2;
		unlink($file);		
		$errors= array();
		$question2 = $_FILES['que']['name'];
		$file_size =$_FILES['que']['size'];
		$file_tmp =$_FILES['que']['tmp_name'];
		$file_type=$_FILES['que']['type'];   
		$file_ext=strtolower(end(explode('.',$_FILES['que']['name'])));		
		$expensions= array("jpg","png","gif"); 		
		if(in_array($file_ext,$expensions)=== false){
			$errors[]="extension not allowed, please choose a JPEG or PNG file.";
		}
		if($file_size >100097152){
			$errors[]='File size must be excately 20 MB';
		}				
		if(empty($errors)==true){
			move_uploaded_file($file_tmp,"../backend/questions/".$question2);
		}
		else{
			print_r($errors);
		}
	}
	
	if($_FILES['optA']['name']){
		// Delete Old Image first
		$file = "../backend/questions/".$a2;
		unlink($file);		
		$errors= array();
		$a2 = $_FILES['optA']['name'];
		$file_size =$_FILES['optA']['size'];
		$file_tmp =$_FILES['optA']['tmp_name'];
		$file_type=$_FILES['optA']['type'];   
		$file_ext=strtolower(end(explode('.',$_FILES['optA']['name'])));		
		$expensions= array("jpg","png","gif"); 		
		if(in_array($file_ext,$expensions)=== false){
			$errors[]="extension not allowed, please choose a JPEG or PNG file.";
		}
		if($file_size >100097152){
			$errors[]='File size must be excately 20 MB';
		}				
		if(empty($errors)==true){
			move_uploaded_file($file_tmp,"../backend/questions/".$a2);
		}
		else{
			print_r($errors);
		}
	}
	
	if($_FILES['optB']['name']){
		// Delete Old Image first
		$file = "../backend/questions/".$b2;
		unlink($file);		
		$errors= array();
		$b2 = $_FILES['optB']['name'];
		$file_size =$_FILES['optB']['size'];
		$file_tmp =$_FILES['optB']['tmp_name'];
		$file_type=$_FILES['optB']['type'];   
		$file_ext=strtolower(end(explode('.',$_FILES['optB']['name'])));		
		$expensions= array("jpg","png","gif"); 		
		if(in_array($file_ext,$expensions)=== false){
			$errors[]="extension not allowed, please choose a JPEG or PNG file.";
		}
		if($file_size >100097152){
			$errors[]='File size must be excately 20 MB';
		}				
		if(empty($errors)==true){
			move_uploaded_file($file_tmp,"../backend/questions/".$b2);
		}
		else{
			print_r($errors);
		}
	}

	if($_FILES['optC']['name']){
		// Delete Old Image first
		$file = "../backend/questions/".$c2;
		unlink($file);		
		$errors= array();
		$c2 = $_FILES['optC']['name'];
		$file_size =$_FILES['optC']['size'];
		$file_tmp =$_FILES['optC']['tmp_name'];
		$file_type=$_FILES['optC']['type'];   
		$file_ext=strtolower(end(explode('.',$_FILES['optC']['name'])));		
		$expensions= array("jpg","png","gif"); 		
		if(in_array($file_ext,$expensions)=== false){
			$errors[]="extension not allowed, please choose a JPEG or PNG file.";
		}
		if($file_size >100097152){
			$errors[]='File size must be excately 20 MB';
		}				
		if(empty($errors)==true){
			move_uploaded_file($file_tmp,"../backend/questions/".$c2);
		}
		else{
			print_r($errors);
		}
	}

	if($_FILES['optD']['name']){
		// Delete Old Image first
		$file = "../backend/questions/".$d2;
		unlink($file);
		$errors= array();
		$d2 = $_FILES['optD']['name'];
		$file_size =$_FILES['optD']['size'];
		$file_tmp =$_FILES['optD']['tmp_name'];
		$file_type=$_FILES['optD']['type'];   
		$file_ext=strtolower(end(explode('.',$_FILES['optD']['name'])));		
		$expensions= array("jpg","png","gif"); 		
		if(in_array($file_ext,$expensions)=== false){
			$errors[]="extension not allowed, please choose a JPEG or PNG file.";
		}
		if($file_size >100097152){
			$errors[]='File size must be excately 20 MB';
		}				
		if(empty($errors)==true){
			move_uploaded_file($file_tmp,"../backend/questions/".$d2);
		}
		else{
			print_r($errors);
		}
	}
	
	if($quiz_ID != ""){
		$result2 = mysqli_query($db, "SELECT question FROM quiz_question where question ='$question' && sessionid='$yr' && class_id='$classid' && group_id='$groupid' && subject_id='$subject_id' && term_id='$term' && id !='$id'")or die(mysqli_error($db));
	
		if(mysqli_num_rows($result2) == 0) // table is empty    
		{
			mysqli_query($db, "Update quiz_question set question = '$question1', A = '$a1', B='$b1', C= '$c1', D = '$d1', que = '$question2', A2 = '$a2', B2='$b2', C2= '$c2', D2 = '$d2', ans = '$ans', anspoint='$point', teacher_id='$xID', subject_id='$subject_id', group_id='$groupid', class_id='$classid' where id ='$id'") or trigger_error("could not insert, reason: ".	mysqli_error());
		 $alert="Update was Successful";
		}
		else
		{
			$alert="Question Exit! Set Another Question";
		}
		
	}
	else
	{
		$alert="Set Question Parameter First";
	}

		
	 echo"<script type='text/javascript'>
 		alert('Operation was Successful: Changes Made');
		 location.href='question-view.php?pg=11&action=view_question&g=$groupid&s=$subject_id&refno=$classid';
	 </script>
		"; 
}	
?>

<?php 
    include("header.php");
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
            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Exam Setup Panel</h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right top_search">
                                <a href="dashboard" class="btn btn-sm btn-success"><i class="fa fa-home"></i>Dashboard</a>
                                <a href="exam-parameter" class="btn btn-warning">Set Quiz Parameters</a>
                                <a href="exam-setting?pg=7" class="btn btn-primary ">View Quiz</a>
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
                                <span style="font-family:Arial, Helvetica, sans-serif;font-size:11px;color:#FF0000" id="msg_info"><?php  echo getMessage();  ?></span>
                               <?php
                                if($_GET["action"]=="set_question") {
                                ?>
                                <form class="form-horizontal" action="?pg=5" name="frmReg" method="post" onSubmit="return loginCheck2(this);" ID="Form1" enctype="multipart/form-data">
                                    <table class="table" style="background-color:rgb(204,255,255);">
                                        <tr>
                                            <td colspan="8"> <strong><i class="glyphicon glyphicon-folder-open"></i>&nbsp; Question Upload for:</strong>
                                                <?php
                                                echo $_SESSION['c'] ." ".$content2["groupname"] ." ".$_SESSION['s'].", for ".$termname . " Term ".$contentss["sesion"].' Academic Session';
                                                ?>
                                            </td>
                                        </tr>
                                    </table>              
                                    <div class="alert alert-info">Page Name : Setup Question >> <strong><a href="question-view.php?_pg=9&refno=<?php echo $classid ?>&g=<?php echo $groupid?>&s=<?php echo $subject_id ?>"><b>View question</b></a></strong> </div>
                                
                                    <h4>Add New Question</h4>
                                <div class="col-md-12 col-xs-12">
                                    <div class="x_content">
                                        <div class="control-group">
                                            <label class="control-label" for="course"><b>Question</b></label>
                                            <div class="controls">
                                                <font face="verdana" style="font-size: 12px; color:#000000">
                                                    <textarea name="question" id="question"  class="form-control input-sm"></textarea>
                                                    <input type="file" name="que"/>
                                                </font>   
                                            </div>
                                        </div> 
                                    </div>
                                </div>  
                                <div class="col-md-6 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2>Class & Subject Information</h2>
                                            <ul class="nav navbar-right panel_toolbox">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                            <div class="control-group">
                                                <label class="control-label" for="course"><b>Class</b></label>
                                                <div class="controls">
                                                    <input type="hidden" name="teacherid" value="<?php echo $_SESSION["teacherlog"]; ?> " id="teacherid">
                                                    <input type="hidden" name="para_id" value="<?php echo $cont1['qid']; ?> " id="para_id">
                                                    <select name="class" id='class' class="form-control input-sm" required  onChange="return deselectGroup();">
                                                        <option value="">Select Class</option>
                                                        <?php
                                                            echo $aLoader->getTeacherClass($_SESSION["teacherlog"], $cont1['class_id']);
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>   
                                            <div class="control-group">
                                                <label class="control-label" for="course"><b>Arm</b></label>
                                                <div class="controls">
                                                    <select name="cgroup" id='cgroup' class="form-control input-sm" required  onChange="return mySearch2();">
                                                        <option value="0">Select Group</option>
                                                        <?php
                                                            echo $aLoader->getTeacherGroup($_SESSION["teacherlog"], $cont1['group_id']);
                                                        ?>
                                                    </select>
                                                </div>
                                            </div> 	
                                            <div class="control-group">
                                                <label class="control-label" for="course"><b>Subject</b></label>
                                                <div class="controls">
                                                    <select name="subject" id='sub' class="form-control input-sm" required >
                                                        <option value="">Select Subject</option>
                                                        <?php
                                                            $where = " WHERE classid='".$cont1['class_id']."' and teacherid='".$_SESSION["teacherlog"]."' and groupid='".$cont1['group_id']."'";
                                                            echo $aLoader->getSubjectBase($where, $cont1['subject_id']);
                                                        ?>
                                                    </select>
                                                </div>
                                            </div> 
                                            <div class="control-group">
                                                <label class="control-label" for="course"><b>Correct Answer</b></label>
                                                <div class="controls">
                                                    <font face="verdana" style="font-size: 12px; color:#000000">
                                                        <select name="ans" id="ans"  class="form-control input-sm success">
                                                            <option value="">Answer</option>
                                                            <option value="A">A</option>
                                                            <option value="B">B</option>
                                                            <option value="C">C</option>
                                                            <option value="D">D</option>
                                                        </select>
                                                    </font>   
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="course"><b>Answer Point</b></label>
                                                <div class="controls">
                                                    <font face="verdana" style="font-size: 12px; color:#000000">
                                                        <input name="point" type="text" id="point" required  class="form-control input-sm" placeholder="Point per Answer"  />
                                                    </font>   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>	
                                <div class="col-md-6 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2>Option Information</h2>
                                            <ul class="nav navbar-right panel_toolbox">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                            <div class="control-group">
                                                <label class="control-label" for="course"><b>Option A</b></label>
                                                <div class="controls">
                                                    <font face="verdana" style="font-size: 12px; color:#000000">
                                                        <input name="a" type="text" id="a"  class="form-control input-sm" placeholder="Answer for OptionA"  /><input type="file" name="optA"/>
                                                    </font>   
                                                    
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="course"><b>Option B</b></label>
                                                <div class="controls">
                                                    <font face="verdana" style="font-size: 12px; color:#000000">
                                                        <input name="b" type="text" id="b"  class="form-control input-sm" placeholder="Answer for OptionB"  /><input type="file" name="optB"/>
                                                    </font>   
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="course"><b>Option C</b></label>
                                                <div class="controls">
                                                    <font face="verdana" style="font-size: 12px; color:#000000">
                                                        <input name="c" type="text" id="c"  class="form-control input-sm" placeholder="Answer for OptionC"  /><input type="file" name="optC"/>
                                                    </font>   
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="course"><b>Option D</b></label>
                                                <div class="controls">
                                                    <font face="verdana" style="font-size: 12px; color:#000000">
                                                        <input name="d" type="text" id="ad"  class="form-control input-sm" placeholder="Answer for OptionD"  /><input type="file" name="optD"/>
                                                    </font>   
                                                </div>
                                            </div>
                                            
                                            <div class="control-group">
                                                <div class="controls">
                                                <br>
                                                <input type="submit" value="Upload Question" name="upload" class="btn btn-large btn-info"/>
                                                </div>
                                            </div> 	
                                        </div>
                                    </div>
                                </div>		
                                </form>	
                            <?php
                            }
                            if (isset($_GET["id"]) and $_GET["pg"]== 3)
                                {
                        ?> 			 	  
                                <form class="form-horizontal" name="frmReg" method="post" onSubmit="return loginCheck2(this);" ID="Form1" enctype="multipart/form-data">
                                    <table class="table" style="background-color:rgb(204,255,255);">
                                        <tr>
                                            <td colspan="8"> <strong><i class="glyphicon glyphicon-folder-open"></i>&nbsp; Question Update for:</strong>
                                
                                    <?php
                                    echo $_SESSION['c'] ." ".$content2["groupname"] ." ".$_SESSION['s'].", for ".$termname . " Term ".$contentss["sesion"].' Academic Session';
                                    ?></td>
                                            </tr>

                                        </table>
                                    <div class="alert alert-info">Page Name : Setup Question >> <strong><a href="question-view.php?refno=<?php echo $classid ?>&g=<?php echo $groupid?>&s=<?php echo $subject_id ?>"><b>View question</b></a></strong> </div>
                                    <h4>Edit Question</h4>
                                    <?php
                                    if(isset($alert))
                                    {
                                        ?>
                                        <div class="alert alert-error"><?php echo $alert; ?> </div>
                                        <?php
                                    }
                                    ?>
                                <div class="col-md-12 col-xs-12">
                                    <div class="x_content">
                                        <div class="control-group">
                                            <label class="control-label" for="course"><b>Question</b></label>
                                            <div class="controls">
                                            <font face="verdana" style="font-size: 12px; color:#000000">
                                            <textarea name="question" id="question"> <?php echo $content12['question'] ?></textarea>
                                            <input type="file" name="que"/></font>
                                            <input type="hidden" name="q" value="<?php echo $content12["que"] ?>" />
                                            <?php if($content12["que"] !=""){ ?>
                                                <div id="photos"> <img src="../backend/questions/<?php echo $content12["que"] ?>" height="70px" width="70px" style="border-radius:7px; box-shadow:2px 1px 2px 2px #CCCCCC;"/> </div>
                                            <?php
                                            }
                                            ?>
                                            </div>
                                        </div> 
                                    </div>
                                </div> 
                                <div class="col-md-6 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2>Class & Result Information</h2>
                                            <ul class="nav navbar-right panel_toolbox">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                            <div class="control-group">
                                                <label class="control-label" for="course"><b>Class</b></label>
                                                <div class="controls">
                                                    <input type="hidden" name="teacherid" value="<?php echo $_SESSION["teacherlog"]; ?> " id="teacherid">
                                                    <input type="hidden" name="quest_id" value="<?php echo $content12['id']; ?> " id="quest_id">
                                                    <select name="class" id='class' required class="form-control input-sm"  onChange="return deselectGroup();">
                                                        <option value="">Select Class</option>
                                                        <?php
                                                            echo $aLoader->getTeacherClass($_SESSION["teacherlog"], $content12['class_id']);
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>   
                                            <div class="control-group">
                                                <label class="control-label" for="course"><b>Arm</b></label>
                                                <div class="controls">
                                                    <select name="cgroup" id='cgroup' required class="form-control input-sm"  onChange="return mySearch2();">
                                                        <option value="0">Select Group</option>
                                                        <?php
                                                            echo $aLoader->getTeacherGroup($_SESSION["teacherlog"], $content12['group_id']);
                                                        ?>
                                                    </select>
                                                </div>
                                            </div> 	
                                            <div class="control-group">
                                                <label class="control-label" for="course"><b>Subject</b></label>
                                                <div class="controls">
                                                    <select name="subject" id='sub' required class="form-control input-sm" >
                                                        <option value="">Select Subject</option>
                                                        <?php
                                                            $where = " WHERE classid='".$content12['class_id']."' and teacherid='".$_SESSION["teacherlog"]."' and groupid='".$content12['group_id']."'";
                                                            echo $aLoader->getSubjectBase($where, $content12['subject_id']);
                                                        ?>
                                                    </select>
                                                </div>
                                            </div> 	
                                            <div class="control-group">
                                                <label class="control-label" for="course"><b>Correct Answer</b></label>
                                                <div class="controls">
                                                    <font face="verdana" style="font-size: 12px; color:#000000">
                                                        <select name="ans" id="ans" class="form-control input-sm success"  >
                                                            <option selected value="<?php echo ucfirst($content12['ans']) ?>"><?php echo ucfirst($content12['ans']) ?></option>             <option value="A">A</option>
                                                            <option value="B">B</option>
                                                            <option value="C">C</option>
                                                            <option value="D">D</option>
                                                        </select>
                                                    </font>   
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="course"><b>Answer Point</b></label>
                                                <div class="controls">
                                                    <font face="verdana" style="font-size: 12px; color:#000000">
                                                                    <input name="point" type="text" id="point" required class="form-control input-sm" value="<?php echo ucfirst($content12['anspoint']) ?>"  />
                                                    </font>   
                                                                
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div> 
                                <div class="col-md-6 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2>Option Information</h2>
                                            <ul class="nav navbar-right panel_toolbox">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                            <div class="control-group">
                                                <label class="control-label" for="course"><b>Option A</b></label>
                                                <div class="controls">
                                                <font face="verdana" style="font-size: 12px; color:#000000">
                                                    <input name="a" type="text" id="a" class="form-control input-sm" value="<?php echo $content12['A'] ?>"/><input type="file" name="optA"/></font> <input type="hidden" name="a2" value="<?php echo $content12["a2"] ?>" />
                                                    <?php if($content12["a2"] !=""){ ?>
                                                        <div id="photos"> <img src="../backend/questions/<?php echo $content12["a2"] ?>" height="70px" width="70px" style="border-radius:7px; box-shadow:2px 1px 2px 2px #CCCCCC;"/> </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="course"><b>Option B</b></label>
                                                <div class="controls">
                                                <font face="verdana" style="font-size: 12px; color:#000000">
                                                    <input name="b" type="text" id="b" class="form-control input-sm" value="<?php echo $content12['B'] ?>" /><input type="file" name="optB"/></font><input type="hidden" name="b2" value="<?php echo $content12["b2"] ?>" />
                                                    <?php if($content12["b2"] !=""){ ?>
                                                        <div id="photos"> <img src="../backend/questions/<?php echo $content12["b2"] ?>" height="70px" width="70px" style="border-radius:7px; box-shadow:2px 1px 2px 2px #CCCCCC;"/> </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                                    <div class="control-group">
                                        <label class="control-label" for="course"><b>Option C</b></label>
                                        <div class="controls">
                                            <font face="verdana" style="font-size: 12px; color:#000000">
                                            <input name="c" type="text" id="c" class="form-control input-sm" value="<?php echo $content12['C'] ?>"  /><input type="file" name="optC"/></font> <input type="hidden" name="c2" value="<?php echo $content12["c2"] ?>" />
                                            <?php if($content12["c2"] !=""){ ?>
                                                <div id="photos"> <img src="../backend/questions/<?php echo $content12["c2"] ?>" height="70px" width="70px" style="border-radius:7px; box-shadow:2px 1px 2px 2px #CCCCCC;"/> </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="course"><b>Option D</b></label>
                                            <div class="controls">
                                            <font face="verdana" style="font-size: 12px; color:#000000">
                                            <input name="d" type="text" id="d" class="form-control input-sm" class="form-control input-sm" value="<?php echo ucfirst($content12['D']) ?>" /><input type="file" name="optD"/></font> <input type="hidden" name="d2" value="<?php echo $content12["d2"] ?>" />
                                            <?php if($content12["d2"] !=""){ ?>
                                                <div id="photos"> <img src="../backend/questions/<?php echo $content12["d2"] ?>" height="70px" width="70px" style="border-radius:7px; box-shadow:2px 1px 2px 2px #CCCCCC;"/> </div>
                                            <?php
                                            }
                                            ?>
                                                            
                                                        
                                        </div>
                                        </div>
                                        
                                    </div> 
                                </div>
                            </div> 
                            <input name="quiz_id" type="hidden" id="quiz_id" required  value="<?php echo ucfirst($content12['id']) ?>" />
                                        <div class="control-group">
                            <div class="controls">
                            <input type="submit" value="Update Question" name="update" class="btn btn-large btn-info"/>
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