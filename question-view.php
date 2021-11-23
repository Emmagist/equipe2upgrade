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
    if (isset($_GET["id"]) and $_GET["pg"]==16)
    {
        //get the exam ID
        $id=$_GET["id"];
        
        mysqli_query($db, "delete from quiz_question where id = '$id' ") or die(mysqli_error($db)) ;
        
        echo"<script type='text/javascript'>
        alert('Operation was Successful: 1 Item deleted');
                location.href='question-view.php?pg=11&action=view_question&g=$groupid&s=$subject_id&refno=$classid';
            </script>
                "; 
        
        
    }
    //############################################################################################
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
                            <h3>Exam Question</h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right top_search">
                                <a href="index" class="btn btn-sm btn-success"><i class="fa fa-home"></i>Dashboard</a>
                                <a href="exam-setting?pg=7" class="btn btn-primary ">View Exam</a>
                            </div>
                            </div>
                        </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <!-- CBT Start Here-->

                            <div class="x_panel" >
                            <div class="x_title">
                                Question Bank
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <span style="font-family:Arial, Helvetica, sans-serif;font-size:11px;color:#FF0000" id="msg_info"><?php echo getMessage(); ?></span>
                                
                                <table class="table" style="background-color:rgb(204,255,255);">
                                    <tr>
                                        <td colspan="6"> <strong><i class="glyphicon glyphicon-folder-open"></i>&nbsp; Question for:</strong>
                                        <?php  echo $_SESSION['c'] ." ".$content2["groupname"] ." ".$_SESSION['s'].", for ".$termname . " Term ".$contentss["sesion"].' Academic Session'; ?></td>
                                    </tr>
                                </table>
                                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered"  id="example">
					            <div>
                                 <strong>Page Name : Setup Questions >> 
                                     <a data-toggle="modal" href='#modal-id' class="btn btn-primary"><b>Add Question</b></a>
                                     
                                </strong> 
                                </div>
                                <?php
                                if($_GET["pg"] != 2){
                                    if(isset($_GET["id"])){
                                        $_SESSION["quiz_id"]= $_GET["id"];
                                    }
                                    $idno = $_SESSION["quiz_id"];
                                    $query = mysqli_query($db, sprintf("select * from quiz_question where quiz_ID ='%d' order by id asc",$idno)) or die(mysqli_error($db));
                                }
                                else{
                                    $query = mysqli_query($db, "select * from quiz_question where sessionid='$yr' && class_id='$classid' && group_id='$groupid' && subject_id='$subject_id' && term_id='$term'  order by id asc") or die(mysqli_error($db));
                                }
                                    $nu11 = mysqli_num_rows($query);
								    if($nu11 > 0){
								?>
                                    <thead>
                                        <tr>
                                            <th width="5%">S/N</th>
                                            <th width="35%">Question</th>
                                            <!-- <th width="10%">Answer</th> -->
                                            <th width="10%">Point</th>
                                            <th width="30%">Type</th>
                                            <th width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                <?php                                
                                    while ($row = mysqli_fetch_array($query)) {
                                    $id = $row['id'];
                                    $k = $k + 1;
                                ?>
                                    <tr class="del<?php echo $id ?>">
                                        <td><?php echo $k; ?></td> 
                                        <td><?php if($row['que'] !=''){echo ucfirst($row['question']).' ('.$row['que'].')';}
                                                    else echo ($row['question']); ?></td>								
                                        <!-- <td><?php echo ucfirst($row['ans']) ?></td> -->
                                        <td><?php echo ucfirst($row['anspoint']) ?></td>
                                        <td>
                                            <?php  echo $aLoader->getExamType($row['question_type']);  ?>  
                                        </td>
                                        <td>
                                                <a href="<?php  echo $aLoader->getQuestionLink($row['question_type']);  ?> ?id=<?php  echo ($row['id'])?>&pg=3" title="Edit" class="btn btn-success btn-xs"><i class="glyphicon  glyphicon-edit"></i></a>	

                                                <a href="question-view.php?id=<?php  echo ($row['id'])?>&pg=16&refno=<?php echo $classid ?>&g=<?php echo $groupid?>&s=<?php echo $subject_id ?>" onclick="return confirmDel()" class="btn btn-danger btn-xs"><i class="glyphicon  glyphicon-remove"></i></a>
                                        </td>
                                        
                                    </tr>
                             <?php }  ?>
                                </tbody>
						    <?php		}
							else{	?>
							<tbody>
                            <tr>
                            <td colspan="6">No Record Found </td>
                            </tr>
                            </tbody>
                        <?php } 
						?>                   
                        </table>
                   
                            </div>
                            <!-- CBT Ends here -->
                        </div>
                    </div>
                </div>
            </div>
                
<div class="modal fade" id="modal-id">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Select Question Type</h4>
         </div>
         
         <div class="modal-body">
            <!-- <ul class="list-group">     -->
               <!-- <li class="list-group-item font-weight-bold mb-3">  -->
                  <div class="radio">
                     <label>
                        <input type="radio" name="quiz" class="input" id="input" value="m_choice" > Multiple Choice
                     </label>
                  </div>
                  
               <!-- </li> -->
               <!-- <li class="list-group-item font-weight-bold mb-3">  -->
                  <div class="radio">
                     <label>
                        <input type="radio" name="quiz" class="input" id="input" value="type-true"> True/False
                     </label>
                  </div>
                 
               <!-- </li> -->
               <!-- <li class="list-group-item font-weight-bold mb-3">  -->
                  <div class="radio">
                     <label>
                        <input type="radio" name="quiz" class="input" id="input" value="essay" > Essay                     
                     </label>
                  </div>
                 
               <!-- </li>
               <li class="list-group-item font-weight-bold mb-3">  -->
                 
               
               <!-- </li>
               <li class="list-group-item font-weight-bold mb-3">  -->
                  
                
               <!-- </li> -->
               <a id="submit" class="btn btn-block btn-sm btn-primary" href="">Add</a>
            <!-- </ul> -->
         </div>
         <div class="modal-footer">
           
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

<script language="javascript">
    function cbtFunction(){
    alert("This Module is available when you login as a teacher");   
    }

    var submit = document.getElementById('submit');
    $(".input").click(function(e){
        
        // e.preventDefault();
        var radioValue = $("input[name='quiz']:checked").val();
        submit.setAttribute("href",radioValue);
      
    })
    </script>