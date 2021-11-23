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
	
	$studentsno = 0;
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
?>
<?php
	if ($pg == 12)
	{
		$studentID   = $_POST['studentID'];
		$term   = $_POST['term'];
		$year   = $_POST['year'];
		$group_id   = $_POST['group_id'];
		$studentClass   = $_POST['studentClass'];
		$subjectss   = $_POST['subjectss'];
		$save =$_POST['category'];
		foreach($save as $value){
			 $save .= $value.", ";
        }
        
        $studentSubjects = substr($save,5,-2);
        
        $select_content3=("select subjectid, id from studentsubjects where studentid ='$studentID' and studentclass ='$studentClass' and term='$term' and year = '$year' limit 1");
        $content_result3= mysqli_query($db, $select_content3) or die(mysqli_error($db));
        $content3 = mysqli_fetch_assoc($content_result3);
        $subjectid = $content3['subjectid'];
        $idss = $content3['id'];
        
		
		
        $splitted = explode(',',$subjectss);  
        $cnt = count($splitted); 
        $ii =0;
        while($cnt > $ii)  
        {  
            $status = 0;
            $subid = mysqli_real_escape_string($db,$splitted[$ii]);

            $splitted2 = explode(',',$studentSubjects);  
            $cnt2 = count($splitted2); 
            $iii =0;
            while($cnt2 > $iii){
                $subid2 = mysqli_real_escape_string($db,$splitted2[$iii]);
                if(intval($subid2) == intval($subid)){
                    $status++;  
                }
                $iii++;
            }
            if($status > 0){
                mysqli_query($db, "delete from scores WHERE sid = '$studentID' and term='$term' and year='$year' and subject='$subid' and cgroup='$group_id' and class='$studentClass'") or die(mysqli_error($db));
                mysqli_query($db, "delete from results WHERE sid = '$studentID' and term='$term' and year='$year' and subject='$subid' and cgroup='$group_id' and class='$studentClass'") or die(mysqli_error($db));
            }
            else{
                $subject_key .= $subid.', '; 
            }
            $ii++;
        }

        mysqli_query($db, "UPDATE studentsubjects SET subjectid = '$subject_key', xdate='$xdate', user='$xID', group_id ='$group_id' where id='$idss'") or die(mysqli_error($db));
        
        echo  $studentSubjects. " == ".$subjectid . " == ".$subject_key;

		$sql= "<b>Operation was Successful<b>";
		echo "
			<script language='javascript'>
				location.href='unassign_subject?sql=$sql'
			</script>
		";	
	}
?>



<?php
	if ($pg == 7)
	{
			$TXTid = $_GET['id'];
			$select_content1=("select * from students WHERE stid='$TXTid'");
			$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
			$content1 = mysqli_fetch_assoc($content_result1);
			$num_chk1 = mysqli_num_rows ($content_result1);
	}
?>



<?php
	include("header.php");
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  
  <script>
  $(function() {
    $( "#sn" ).autocomplete({
      source: 'autocomplet.php'
    });
  });
  
  $(function() {
    $( "#on" ).autocomplete({
      source: 'autocomplet.php'
    });
  });
  </script>
            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Students Record</h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right top_search">
                            	 <a href="dashboard" class="btn btn-sm btn-success">Dashboard</a>
                                
                                 <a href="assign-subject?pg=1" class="btn btn-sm btn-warning"><i class="fa fa-book"></i> Assign Subject</a>
                                 <!--<a href="student-id-card?pg=1" class="btn btn-sm btn-primary"><i class="fa fa-image"></i> Generate ID Card</a>-->
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
					<div class="row">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                    	<div class="x_content">
                 <?php
                if ($pg == 10)
                {
                $studentID = $_GET['id'];
                $display = "Register";
                $select_content2=("select * from students where stid  = '$studentID '");
                $content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
                $content2 = mysqli_fetch_assoc($content_result2);
                $num_chk2 = mysqli_num_rows ($content_result2);
                $studentClass  = $content2['class'];
				$group_id  = $content2['group_id'];
                                    
            ?>
            <h2> <?php echo  $content2['surname'] ." ". $content2['othername']?>'s Subject Assignment </h2>
            <?php
				$select_content=("select * from classes where id  = '$studentClass '");
				$content_result= mysqli_query($db, $select_content) or die(mysqli_error($db));
				$content = mysqli_fetch_assoc($content_result);
				$schoolid  = $content['schoolid'];
				
				$select_content22=("select * from subjects where class = '$schoolid' and status='' order by hirarchy asc");
				$content_result22= mysqli_query($db, $select_content22) or die(mysqli_error($db));
				$content22 = mysqli_fetch_assoc($content_result22);
				$num_chk22 = mysqli_num_rows ($content_result22);
				if ($num_chk22 == 0)
                {
                    $msg = "Student does not have any subject assigned to his/her class ---- Contact System Administrator";
                }
				else
					{
                    $select_content25=("select * from subjects where status ='1'");
                    $content_result25= mysqli_query($db, $select_content25) or die(mysqli_error($db));
                    $content25 = mysqli_fetch_assoc($content_result25);
                    
                        $select_content45=("select * from schsession where status='1'");
                        $content_result45= mysqli_query($db, $select_content45) or die(mysqli_error($db));
                        $content45 = mysqli_fetch_assoc($content_result45);
                        $year = $content45["sid"];
                        $term = $content25["tid"];
	?>
    					 <form method="post" action="?pg=12&p=1" name="frmReg">
    <?php
						do { 						
                            $studentSubjects = $content22['subject'];
                            $studentSubjectsID = $content22['sid'];
                            
                            $select_content3=("select * from studentsubjects where studentid  = '$studentID' and studentclass  = '$studentClass'  and year = '$year' and term ='$term'");
                            $content_result3= mysqli_query($db, $select_content3) or die(mysqli_error($db));
                            $content3 = mysqli_fetch_assoc($content_result3);
                            $num_chk3 = mysqli_num_rows ($content_result3);
                            $i =0;	
                            $pp = false	;
                            if($num_chk3 != 0){
                                $cat = $content3["subjectid"];
                                $splitted = explode(',',$cat);  
                                $cnt = count($splitted); 
                                while($cnt > $i)  
                                    {  
                                        $val = mysqli_real_escape_string($db,$splitted[$i]);
                                        //echo $splitted[$i];
                                        if(intval($val) == intval($content22['sid'])){
                                            $pp = true;
                                        
                                        }
                                        
                                    $i++; 
                                }
                                
                            } 
?>
							<p style="padding-top:20px;">
							<input style="border:0px" type="checkbox" name="category[]" value="<?php echo $content22['sid']?>" <?php if($pp == true ){ ?> checked="checked"<?php $display = "Update"; }?> /><?php echo $content22['subject']?>
                            </p>
                                                       
<?php									
				 			} while ($content22 = mysqli_fetch_assoc($content_result22)); 							
?>
							<p>
                            <input type="hidden"  value="<?php echo $studentID; ?>" name="studentID"/>
                            <input type="hidden"  value="<?php echo $studentClass; ?>" name="studentClass"/>
                            <input type="hidden"  value="<?php echo $year; ?>" name="year"/>
                            <input type="hidden"  value="<?php echo $term; ?>" name="term"/>
                            <input type="hidden"  value="<?php echo $term; ?>" name="group_id"/>
                            <input type="hidden"  value="<?php echo $content3["subjectid"]; ?>" name="subjectss"/>
                            <input type="submit" name="Submit" value="DELETE SUBJECT" class="btn btn-primary" onclick="return confirmSubject()" />  
                            
                            </p>
						 </form>
<?php
				
					}
								
?>
   		<p style="padding-top:20px;"><?php echo $msg ?></p>
<?php
					}

?>
			
			
			<?php
			
				if ($pg == ""  or $pg == "17"){
                    $cid = $_GET["cid"];
			?>
                        <div class="x_title">
                            <form method="post" action="?pg=8" name="frmReg">
                            <table width="100%">
                                <tr>
                                    <td >Sort By Class:</td>
                                    <td >  
                                        <select name="class" id="classid" class="form-control" onchange="return sortBy()" style="width:230px">
                                        <option value="">-- Class</option>
                                        <?php
                                            $select_content2=("select * from classes order by rank asc");
                                            $content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
                                            $content2 = mysqli_fetch_assoc($content_result2);
                                            $num_chk2 = mysqli_num_rows ($content_result2);
                                            $k = 0
                                        ?>
                                        <?php do { 	?>
                                        <option value="<?php echo  $content2['id']?>" <?php if($content2['id'] == $cid){?> selected="selected" <?php } ?>><?php echo  $content2['class']?></option>
                                        <?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
                                    </select>
                                    </td>
                                </tr>
                            </table>
                        </form>
                            <div class="clearfix"></div>
                        </div>
							<span style="font-family:Arial, Helvetica, sans-serif;font-size:11px;color:#FF0000"><?php echo $sql; ?></span>
							<table class="table table-striped responsive-utilities jambo_table" id="example">
			<?php
                    if ($pg == "17"){
                        if($cid != "000"){
						    $select_content=("select * from students s INNER JOIN classes c ON s.class = c.id INNER JOIN groups g ON s.group_id = g.gid INNER JOIN studenttype st ON s.type = st.tid where s.class='$cid' and s.status != '7' and s.status != '9' order by surname asc");
                        }
                        else{
                            $select_content=("select * from students s INNER JOIN classes c ON s.class = c.id INNER JOIN groups g ON s.group_id = g.gid INNER JOIN studenttype st ON s.type = st.tid where s.status != '7' and s.status != '9' order by surname asc");
                        }
                        $content_result= mysqli_query($db, $select_content) or die(mysqli_error($db));
						$content = mysqli_fetch_assoc($content_result);
						$num_chk = mysqli_num_rows ($content_result);
						$k = 0
			?>
			<?php
			if ($num_chk == 0)
				{
			?>
								<tr height="23" onMouseOver="this.style.backgroundColor='#FFCC66';" onMouseOut="this.style.backgroundColor='';" bgcolor="#EFEFEF">
									<td colspan="5"  align="center">No Record Found</td>
								</tr>	
			<?php
			}
				else
			{
			?>
            				<thead>
								<tr>
									<th align="center">Passport</th>
                                    <th align="center">Reg Number</th>
									<th align="center">Student Name</th>
									<th align="center">Class</th>
                                    <th align="center">Group</th>
                                    <th align="center">Gender</th>
                                    <th align="center">Birthdate</th>
                                    <th align="center">Type</th>
                                    <th align="center">Actions</th>
                                    
							  </tr>
								</thead>
								<tbody>
			<?php do { 
						$k = $k + 1;
						?>
								<tr>
									<td align="center">
									<?php if($content["passport"] == ""){ ?>
                                       <img src="uploads/studentpassport/student.jpg" height="40px" width="40px" style="border-radius:7px; box-shadow:2px 1px 2px 2px #CCCCCC;"/>
                                    <?php
                                    }else{
                                    ?>
                                         <img src="uploads/studentpassport/<?php echo $content["passport"] ?>" height="40px" width="40px" style="border-radius:7px; box-shadow:2px 1px 2px 2px #CCCCCC;"/>
                                    <?php
                                    }
                                    ?>
                                    </td>
                                    <td align="center"><?php  echo ucfirst($content ['regno'])?></td>
									<td align="left"><?php  echo $content['surname']." ". $content['othername']?></td>
									<td align="center"><?php  echo ucfirst($content ['class'])?></td>
                                    <td align="center"><?php  echo ucfirst($content ['groupname'])?></td>
                                    <td align="center"><?php  echo ucfirst($content ['sex'])?></td>
                                    <td align="center"><?php  echo ucfirst($content ['dateofbirth'])?></td>
                                    <td align="center"><?php echo $content ['stype'] ;?></td>
                                    <td  width="8%" align="center"><a href="unassign_subject?id=<?php  echo ($content ['stid'])?>&pg=10" target="_parent"  class="btn btn-danger"><i class="fa fa-close"></i> Un-Assign Subject</a> </td>
								</tr>
						 <?php } while ($content = mysqli_fetch_assoc($content_result)); ?>
			<?php 
				    }
                }
			?>
			<?php
			}
			?>
			</tbody>
			</table>
           
                </div>
            </div>
        </div>
    </div>
                
    <br />  <br />        
                
 <!-- footer content -->
               <?php include("includes/footer.php")?>


<script language="JavaScript" type="text/javascript">


function confirmSubject(){ // to confirm delete action before url is sent
	//confirm("Do you want to delete this item?");
	if (confirm("Are you sure of this action?\n\nWARNING! WARNING!! WARNING!!!\n\nWhen you unassigned a subject from a student, any score associated with the subject will be deleted. Click OK to continue otherwise click CANCEL")) {
       return true;
    }	
	return false;
}


function sortBy(){
    var cid  = $("#classid").val()
    document.frmReg.action="unassign_subject?pg=17&cid="+cid
    document.frmReg.method = "post";
    document.frmReg.submit()
}
	</script>
