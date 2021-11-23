<?php require_once("includes/session.php"); ?>
<?php confirm_logged_in(); ?>
<?php
require_once '..'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'loader.php';
$aLoader = new Loader($db);
?>
<?php
	$pg = mysqli_real_escape_string($db, $_GET['pg']);
	$sql = mysqli_real_escape_string($db, $_GET['sql']);
	$cid =0;
?>


<?php
	if ($pg == 8)
	
		{			
			$subject = mysqli_real_escape_string($db, $_POST['subject']);
			$class = mysqli_real_escape_string($db, $_POST['class']);
			$term = mysqli_real_escape_string($db, $_POST['term']);
			$year = mysqli_real_escape_string($db, $_POST['year']);
			$gid = mysqli_real_escape_string($db, $_POST['group']);
			$xdate = date("Y-m-d");
			
			
			$students = $_POST["students"];
	
		    $n = count($students); 
			$nn =0;
		   
			for($i=0; $i < $n; $i++)
			{
				$status = false;
				$student=$students[$i];
				//$gid=$groups[$i];
				
				$select_content3=("select subjectid, id from studentsubjects where studentid ='$student' and studentclass ='$class' and term='$term' and year = '$year' limit 1");
				$content_result3= mysqli_query($db, $select_content3) or die(mysqli_error($db));
				$content3 = mysqli_fetch_assoc($content_result3);
				$subjectid = $content3['subjectid'];
				$idss = $content3['id'];
				
				$splitted = explode(',',$subjectid);  
				$cnt = count($splitted); 
				$ii =0;
				while($cnt > $ii)  
				{  
				  $subid = mysqli_real_escape_string($db,$splitted[$ii]);
				  
				  if(intval($subject) == intval($subid)){
					  $status = true;
					  $ii += $cnt;
				  }
				  $ii++;
				}
			
					
				if($status == false){

					if($subjectid == ""){				
						mysqli_query($db, "insert into studentsubjects SET studentid='$student', studentclass='$class', subjectid = '$subject', xdate='$xdate', year = '$year', term ='$term', user='$xID', group_id='$gid' ")  or die(mysqli_error($db));	
						$nn = $nn + 1;		
					}
					else{
						$nn = $nn + 1;
						$subjectid .= ', '.$subject; 
						mysqli_query($db, "UPDATE studentsubjects SET subjectid = '$subjectid', xdate='$xdate', user='$xID', group_id='$gid' where id='$idss'") or die(mysqli_error($db));
					}
				}

				
			}
			$sql2="SELECT subject FROM subjects where sid='$subject' ";
			  $query2=mysqli_query($db, $sql2)or die(mysqli_error($db));
			  $content11 = mysqli_fetch_assoc($query2);
			if($nn > 0) $sql= "<b>Operation was Successful: ".$nn." Student(s) Were Assigned ".$content11['subject']." <b> " ;
			else $sql= "<b>Operation was not Successful: Subject Might have been assigned to these Student(s)<b> " ;

	echo "
			<script language='javascript'>
				location.href='assign-subject?pg=1&sql=$sql'
			</script>
		";			
		}
?>


<?php
	if ($pg == 4)
	
		{			
			$subject = mysqli_real_escape_string($db, $_POST['subject']);
			$class = mysqli_real_escape_string($db, $_POST['class']);
			$term = mysqli_real_escape_string($db, $_POST['term']);
			$year = mysqli_real_escape_string($db, $_POST['year']);
			$gid = mysqli_real_escape_string($db, $_POST['group']);
			$xdate = date("Y-m-d");
			
			$students = $_POST["students"];
	
		    $n = count($students); 
			$nn =0;
		   
			for($i=0; $i < $n; $i++)
			{
				$status = false;
				$student=$students[$i];
				
				$select_content3=("select subjectid, id from studentsubjects where studentid ='$student' and studentclass ='$class' and term='$term' and year = '$year' limit 1");
				$content_result3= mysqli_query($db, $select_content3) or die(mysqli_error($db));
				$content3 = mysqli_fetch_assoc($content_result3);
				$subjectid = $content3['subjectid'];
				$idss = $content3['id'];
				
				$splitted = explode(',',$subjectid);  
				$cnt = count($splitted); 
				$ii =0;
				 $subjectid ='';
				while($cnt > $ii)  
				{  
				  $subid = mysqli_real_escape_string($db,$splitted[$ii]);
				  
				  if(intval($subject) != intval($subid)){
					  $status = true;
					  $subjectid .= $subid.', '; 
				  }
				  $ii++;
				}
			
	
				if($status == true){
					$nn = $nn + 1;
					$subjectidss = substr($subjectid,0,-2);
					mysqli_query($db, "UPDATE studentsubjects SET subjectid = '$subjectidss', xdate='$xdate', user='$xID', group_id='$gid' where id='$idss'") or die(mysqli_error($db));
					
				}
				elseif(($subjectid == "" || $subjectid == 0) && $cnt == 1){
					$nn = $nn + 1;
					mysqli_query($db, "delete from studentsubjects where id='$idss'") or die(mysqli_error($db));
					mysqli_query($db, "delete from resultposition WHERE sid = '$student' and term='$term' and year='$year' and cgroup='$gid' and class='$class'") or die(mysqli_error($db));
					
				}
				mysqli_query($db, "delete from scores WHERE sid = '$student' and term='$term' and year='$year' and subject='$subject' and cgroup='$gid' and class='$class'") or die(mysqli_error($db));
				mysqli_query($db, "delete from results WHERE sid = '$student' and term='$term' and year='$year' and subject='$subject' and cgroup='$gid' and class='$class'") or die(mysqli_error($db));
				
			}
			$sql2="SELECT subject FROM subjects where sid='$subject' ";
			  $query2=mysqli_query($db, $sql2)or die(mysqli_error($db));
			  $content11 = mysqli_fetch_assoc($query2);
			if($nn > 0) $sql= "<b>Operation was Successful: ".$nn." Student(s) Were Unassigned From ".$content11['subject']." <b> " ;
			else $sql= "<b>Operation was not Successful: Subject Might Not have been assigned to these Student(s)<b> " ;

	echo "
			<script language='javascript'>
				location.href='assign-subject?pg=2&sql=$sql'
			</script>
		";			
		}
?>

<?php
	if($pg == 3){
		///////////////////////////		Get Term and Session	/////////////////////////////////////////
		$select_contenttt=("select * from subjects where status ='1'");
		$content_resulttt= mysqli_query($db, $select_contenttt) or die(mysqli_error($db));
		$contenttt = mysqli_fetch_assoc($content_resulttt);
		$term =  $contenttt["tid"];
		
		$select_contentss=("select * from schsession where status =1");
		$content_resultss= mysqli_query($db, $select_contentss) or die(mysqli_error($db));
		$contentss = mysqli_fetch_assoc($content_resultss);
		$year =  $contentss["sid"];
		///////////////////////////////////////////////////////////////////////////////
		
		$nn =0;
		if($term != 1){ // Check if its First Term
			$prev_term = $term - 1;
			
			$select_content1=("select * from students s INNER JOIN studentsubjects ss ON s.stid=ss.studentid WHERE s.status='0' and ss.year ='$year' and ss.term='$prev_term' order by ss.studentclass asc");
			$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
			$content1 = mysqli_fetch_assoc($content_result1);
			$num_chk1 = mysqli_num_rows ($content_result1);
			
			if($num_chk1 > 0){
				///////////		Begin To Duplicate Records	For the current Term	/////////////////////
				do{
					$subject = $content1['subjectid'];
					$idss = $content1['id'];
					$class = $content1['studentclass'];
					$student = $content1['studentid'];
					$gid = $content1['group_id'];
					$xdate = date("Y-m-d");
					
					/////		Check If Record Has been Inserted Before		/////////////////////////
					$select_content3=("select * from studentsubjects where studentid ='$student' and studentclass ='$class' and term='$term' and year = '$year'");
					$content_result3= mysqli_query($db, $select_content3) or die(mysqli_error($db));
					$content3 = mysqli_fetch_assoc($content_result3);
					$num_chk3 = mysqli_num_rows ($content_result3);
					////	Insert if Record Doesn't Exist	//////////////////////////////
					if($num_chk3 == 0){
						mysqli_query($db, "insert into studentsubjects SET studentid='$student', studentclass='$class', subjectid = '$subject', xdate='$xdate', year = '$year', term ='$term', user='$xID', group_id='$gid' ")  or die(mysqli_error($db));	
						$nn = $nn + 1;
					}
					
				}while($content1 = mysqli_fetch_assoc($content_result1));
				///		End Record Duplication	////////////////////////////////////////
				
				if($nn > 0){
					$sql= "<b>Operation was Successful: ".$nn." Record(s) Were Updated out of ".$num_chk1."<b>" ;
					echo "
					<script language='javascript'>
						location.href='assign-subject?pg=1&sql=$sql'
					</script>
					";
				}
				else{
					$sql= "<b>Students Subjects Has Already Been Updated For This Current Term and Session<b> " ;
					echo "
					<script language='javascript'>
						location.href='assign-subject?pg=1&sql=$sql'
					</script>
					";					
				}
				
			}
			
			else{
				$sql= "<b>Operation fail! No Student(s) Found<b> " ;

				echo "
				<script language='javascript'>
					location.href='assign-subject?pg=1&sql=$sql'
				</script>
				";
			}
			
		}
		//////		End of Check if its first term	////////////////////////////////
		
		//		Subject must be assign class by class
		else{
			$sql= "<b>Operation fail! Subject Must be Assign Class By Class<b> " ;
			echo "
			<script language='javascript'>
				location.href='assign-subject?pg=1&sql=$sql'
			</script>
			";
		}
		//	Its First Term
		
	}
?>


<?php
include("header.php");
$state = 0;
 ?>
            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
					<div class="page-title" style="height:100px">
						<div class="alert alert-info" >
							<a href="index"><b>Home</b></a> >>
							<a href="index?action=home"><b><?php echo $aLoader->getClassName($_SESSION["t_class_id"]) ." ".$aLoader->getGroupName($_SESSION["t_group_id"]). " ".$aLoader->getSubjectName($_SESSION["t_subject_id"]); ?></b></a> >>
							<strong>Student Daily Report</strong> 
							
						</div>
					</div>
                    
                    <div class="clearfix"></div>
                    
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <span style="font-family:Arial, Helvetica, sans-serif;font-size:14px;color:#FF0000"><?php echo $sql; ?></span>
                            <div class="x_panel" >
                            <div class="x_title">
                        <a href="assign-subject?pg=1" class="btn btn-sm btn-dark"><i class="fa fa-plus"></i> Assign Subject To Student(s)</a>
                        <a href="assign-subject?pg=2" class="btn btn-sm btn-warning"><i class="fa fa-plus"></i> Unassign Subject From Student(s)</a>
                        <a href="assign-subject?pg=3" class="btn btn-sm btn-danger" onClick="return confirmAssign();" ><i class="fa fa-plus"></i> Update Students Subject</a>
                        <div class="clearfix"></div>
                    </div>
            	<?php
				if ($pg == '2' or $pg == 1)
					{
					?> 
					 <form method="post" action="?pg=8" name="frmReg" onsubmit="return loginCheck()" enctype="multipart/form-data">
                    <table class="form" >
                    	<tr>
                            <td>
                                <input type="hidden" name="pg" value="<?php echo $pg; ?> " id="pg">
                                <label>Select Class </label>
                            </td>
                            <td>                                
                            	 <select name="class" id='class'  class="form-control" onChange='return mySearch2();'>
								 	<?php
										echo $aLoader->getTeacherClass($_SESSION["teacherlog"], $_SESSION["t_class_id"]);
									?>
								</select> <span id="container"> </span>
                            </td>
                           
                        </tr>
                        <tr>
                            <td>
                                <label>Select Group </label>
                            </td>
                            <td>                                
                            	 <select name="group" id='group'  class="form-control" onChange='return mySearch3();'>
								 	<?php
										echo $aLoader->getTeacherGroup($_SESSION["teacherlog"], $_SESSION["t_group_id"]);
									?>
                                </select> <span id="container"> </span>
                            </td>
                           
                        </tr>
                    	<tr>
                            <td>
                                <label>Select Subject </label>
                            </td>
                            <td>                                
                            	 <select name="subject" id='sub'  class="form-control" onChange='return mySearch();'>
								 <option value=""> Select Subject</option>
                                 <?php
									$where = " WHERE classid='".$_SESSION["t_class_id"]."' and teacherid='".$_SESSION["teacherlog"]."' and groupid='".$_SESSION["t_group_id"]."'";
									echo $aLoader->getSubjectBase($where, "");
								?>
                                </select> <span id="container"> </span>
                            </td>
                           
                        </tr>                        
                        
                        </table>
                        <div id="wait" style="display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;"><img src='<?php echo SITEURL; ?>/backend/images/demo_wait.gif' width="64" height="64" /><br>Loading..</div>
                        <hr />
                        <table class="form" border="0" style="width:1000px">
                        <tr id="subject">
                             <!--Display subjects here-->
                        </tr>
                        </table>
                         
                        <table class="form" >
                         <tr>
                             <td align="left">
                                <input  type="submit" class="btn btn-primary" value="<?php echo $button; ?> " id="btnsave" <?php if($state == 1){?> onClick="return confirmSubject()" <?php } ?>  />
                            </td>
                        </tr>
                    </table>
                    </form>
			
            <?php
					}
			?> 
            

	
                            </div>
                        </div>
                    </div>
                </div>
                
 <!-- footer content -->                
<?php include("includes/footer.php") ?>

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
	
	var recslen =  document.forms[0].length; 
	var pg = document.frmReg.pg.value;
	var checkboxes="" 
	//alert(pg);
	for(i=1;i<recslen;i++) 
	{ 
		if(document.forms[0].elements[i].checked==true) 
		checkboxes+= " " + document.forms[0].elements[i].name 
	} 	
	if(document.frmReg.class.value == "") {
		alert ("Please Select Class")
		document.frmReg.class.focus();
		return false
	}
	if(document.frmReg.subject.value == "") {
		alert ("Please Select Subject 2")
		document.frmReg.subject.focus();
		return false
	}	

	if(checkboxes.length>0) 
	{ 
		var con=confirm("Are you sure you want to assigned this subject to these student(s)?"); 
		if(con) 
		{ 
			if(pg == 1){
				document.frmReg.action="assign-subject?pg=8"
			}
			else{
				document.frmReg.action="assign-subject?pg=4"
			}
			document.frmReg.method = "post";
			document.frmReg.submit() 
		} 
		else return false
	} 
	else 
	{ 
		alert("No Student Selected.") 
		return false
	}

}

</script>
<script language="JavaScript" type="text/javascript">

	function selectall() 
	{ 
  //        var formname=document.getElementById(formname); 
  
		//var recslen = document.forms[0].length; 
		var recslen = document.forms[0].length; 
		  
	 if(document.forms[0].topcheckbox.checked==true) 
	 { 
		for(i=1;i<recslen;i++) { 
			document.forms[0].elements[i].checked=true; 
		} 
	  } 
	  else 
	  { 
		  for(i=1;i<recslen;i++) 
		  document.forms[0].elements[i].checked=false; 
	  } 
	}
</script>

<script type="text/javascript">
//#################################################################################################
function mySearch(){
	//declaare a variable that collects the value in the select button
	var facultyfield=$('#class').val();
	var subject =$('#sub').val();
	var group =$('#group').val();
	var pg =$('#pg').val();
	//checks if the variable is empty
	if( facultyfield=="")
	{
		$('#container').html("<strong> No value selected for the search record");
		return false;
	}
	$("#btnsave").attr("disabled",true) // Disable Button
	$("#sub").attr("disabled",true) // Disable Button
	$("#wait").css("display", "block"); // Show loader
	
	mypath='mode=assign_subjects2&class='+facultyfield+'&subject='+subject+'&pgs='+pg+'&group='+group;
			$.ajax({
			type:'POST',
			url:'<?php echo SITEURL; ?>/backend/loaddata.php',
			data:mypath,
			cache:false,
			success:function(resps){
			$('#container').html("");
			//returns the reponse
			$('#subject').html(resps);
			$("#wait").css("display", "none"); // Hide loader
			$("#btnsave").attr("disabled",false) // Able Button
			$("#sub").attr("disabled",false) // Disable Button
			return false;
		}
	});
	return false;
}
//########################################################################################################

function mySearch2(){
	//declaare a variable that collects the value in the select button
	var facultyfield=$('#class').val();
	//checks if the variable is empty
	if( facultyfield=="")
	{
		$('#container').html("<strong> No value selected for the search record");
		return false;
	}
	$("#btnsave").attr("disabled",true) // Disable Button
	$("#sub").attr("disabled",true) // Disable Button
	$("#wait").css("display", "block"); // Show loader
	
	mypath='mode=assign_subjects&class='+facultyfield;
			$.ajax({
			type:'POST',
			url:'<?php echo SITEURL; ?>/backend/loaddata.php',
			data:mypath,
			cache:false,
			success:function(resps){
			$('#container').html("");
			//returns the reponse
			$('#sub').html(resps);
			$("#wait").css("display", "none"); // Hide loader
			//$("#btnsave").attr("disabled",false) // Able Button
			//$("#sub").attr("disabled",false) // Disable Button
			return false;
		}
	});
	return false;
}
//########################################################################################################


function mySearch3(){
	//declaare a variable that collects the value in the select button
	var facultyfield=$('#group').val();
	//checks if the variable is empty
	if( facultyfield=="")
	{
		$('#container').html("<strong> No value selected for the search record");
		return false;
	}
	else{
		$("#btnsave").attr("disabled",true) // Disable Button
		$("#wait").css("display", "block"); // Show loader
		$("#sub").attr("disabled",false) // Disable Button
		$("#wait").css("display", "none"); // Hide loader
		
		return false;
	}
}
//########################################################################################################
</script>

<script language="JavaScript" type="text/javascript">

function confirmAssign(){ // to confirm delete action before url is sent
	//confirm("Do you want to delete this item?");
	if (confirm("You're About To Update Students Subject")) {
       return true;
	   
    }	
	return false;
}

function confirmSubject(){ // to confirm delete action before url is sent
	//confirm("Do you want to delete this item?");
	if (confirm("Are you sure of this action?\n\nWARNING! WARNING!! WARNING!!!\n\nWhen you unassigned a subject from student(s), any score associated with the subject will be deleted. Click OK to continue otherwise click CANCEL")) {
       return true;
    }	
	return false;
}
</script>