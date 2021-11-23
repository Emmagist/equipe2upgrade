    <style>
	#ques	{ 
		border-radius:12px;
		-o-border-radius:12px;
		-ms-border-radius:12px;
		-webkit-border-radius:12px;
		-moz-border-radius:12px;
	}
	</style>
<div class="row" style="padding-bottom:0px; border-bottom:4px solid rgba(0,0,51,1); box-shadow:0px 5px 0px 0px #0066CC;" id="ques">
<ul class="nav nav-pills nav-stacked" style="background:#f5f5f5; color:#0C0; font-size:12px;" id="ques">
<?php
	$select_contenttt=("select * from subjects where status ='1'");
	$content_resulttt= mysqli_query($db, $select_contenttt) or die(mysqli_error($db));
	$contenttt = mysqli_fetch_assoc($content_resulttt);
	$termid =  $contenttt["tid"];
	
	$select_contentts=("select * from schsession where status ='1'");
	$content_resultts= mysqli_query($db, $select_contentts) or die(mysqli_error($db));
	$contentts = mysqli_fetch_assoc($content_resultts);
	$yid =  $contentts["sid"];
	
	$gid = $_SESSION["teacherlog"];
	$parentid = $_GET['parentid'];

	$select_content=("select * from teacherclasses where teacherid ='$gid' order by classid");
	$content_result= mysqli_query($db, $select_content) or die(mysqli_error($db));
	$content = mysqli_fetch_assoc($content_result);
	$num_chk = mysqli_num_rows ($content_result);

	if ($num_chk > 0)
	 {
		do{
?>
		<?php 
		$classid = $content['classid'];
		$select_content1=("select * from classes where id='$classid'");
		$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
		$content1 = mysqli_fetch_assoc($content_result1);
		
		$groupid = $content['groupid'];
		$select_content2=("select * from groups where gid='$groupid'");
		$content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
		$content2 = mysqli_fetch_assoc($content_result2); 
		$content2['groupname'];
		
		$subjectid = $content['subjectid'];
		$select_content3=("select * from subjects where sid='$subjectid'");
		$content_result3= mysqli_query($db, $select_content3) or die(mysqli_error($db));
		$content3 = mysqli_fetch_assoc($content_result3); 
		?>
		 <li>
         <?php if($page=='result'){?>
			   <ul class="nav" >
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#000;" onMouseOver="this.style.color='#FFF';" onMouseOut="this.style.color='#000';">
                    <i class="glyphicon glyphicon-folder-open"></i> <?php echo $content1['class'] ." ".$content2["groupname"].":: ".$content3["subject"]?><b class="caret"></b>
                  </a>
                   <ul class="dropdown-menu">
                        <li><a href="../students?refno=<?php echo $content['classid'] ?>&g=<?php echo $content['groupid'] ?>&s=<?php echo $content['subjectid'] ?>&pgs=subt"> <i class="glyphicon glyphicon-user"></i> Students</a></li>
                        <li><a href="../lesson-plan?pg=22&refno=<?php echo $content['classid'] ?>&g=<?php echo $content['groupid'] ?>&s=<?php echo $content['subjectid'] ?>"> <i class="glyphicon glyphicon-book"></i> Lesson Plan</a></li>
                        <?php	   		
                       
                        $select_content10=("select * from class_teacher where teacherid ='$gid' and classid ='$classid' and groupid='$groupid'");
                        $content_result10= mysqli_query($db, $select_content10) or die(mysqli_error($db));
                        $num_chk10 = mysqli_num_rows ($content_result10);
                        if ($num_chk10 > 0)
                         {	
                         ?>
                            
                            <li> <a href="../assign-subject?refno=<?php echo $classid; ?>&cg=<?php echo $groupid; ?>&yyy=<?php echo $yid; ?>&ttt=<?php echo $termid; ?>&pg=1"> <i class="glyphicon glyphicon-book"></i> Assign Subject</a></li>
                            
                                <li> <a href="../single-student-subject?refno=<?php echo $classid; ?>&cg=<?php echo $groupid; ?>&yyy=<?php echo $yid; ?>&ttt=<?php echo $termid; ?>"> <i class="glyphicon glyphicon-book"></i> Single Student Subject</a></li>
                            
                        <?php }
						else{
						?>
                         <li> <a href="../assign-subject?refno=<?php echo $classid; ?>&cg=<?php echo $groupid; ?>&yyy=<?php echo $yid; ?>&ttt=<?php echo $termid; ?>&pg=21"> <i class="glyphicon glyphicon-book"></i> Assign Subject</a></li>
                            <?php
						}
						if($termid != 4){?>
                        <li><a href="../Question-papers?refno=<?php echo $content['classid'] ?>&g=<?php echo $content['groupid'] ?>&parentid=<?php echo $parentid  ?>"> <i class="glyphicon glyphicon-upload"></i> Exam Question Papers</a></li>
                        <li> <a href="../online_test?refno=<?php echo $content['classid'] ?>&g=<?php echo $content['groupid'] ?>&s=<?php echo $content['subjectid'] ?>&parentid=<?php echo $parentid  ?>"> <i class="glyphicon glyphicon-random"></i> CBT</a></li>
                         <?php }
						 if($termid == 4){
							 	$select_content4=("select * from summer ");
								$content_result4= mysqli_query($db, $select_content4) or die(mysqli_error($db));
								$content4 = mysqli_fetch_assoc($content_result4);
								if($content4["status"] == '1' and $content4["id"] == 1){ ?>

                        <li> <a href="summer-score?pg=22&refno=<?php echo $content['classid']?>&c=<?php echo $content['classid']?>&g=<?php echo $content['groupid']?>&s=<?php echo $content['subjectid'] ?>&parentid=<?php echo $parentid  ?>"> <i class="glyphicon glyphicon-ok-circle"></i> Summer Score Upload</a> </li>
                        <?php 
                          } 
						 }?>
                          
                            <?php 
							if($termid != 4){
							 	$select_contenttt=("select * from midterm where name = 'Midterm 1'");
								$content_resulttt= mysqli_query($db, $select_contenttt) or die(mysqli_error($db));
								$contenttt = mysqli_fetch_assoc($content_resulttt);
								if($contenttt["status"] == '1'){ ?>

                        <li> <a href="midterm-score?pg=22&refno=<?php echo $content['classid']?>&c=<?php echo $content['classid']?>&g=<?php echo $content['groupid']?>&s=<?php echo $content['subjectid'] ?>&parentid=<?php echo $parentid  ?>"> <i class="glyphicon glyphicon-ok-circle"></i> Mid-Term Score Upload</a> </li>
                        <?php 
                          } ?>
                              
                             <?php 
							 	$select_contenttt2=("select * from midterm where name = 'Midterm 2'");
								$content_resulttt2= mysqli_query($db, $select_contenttt2) or die(mysqli_error($db));
								$contenttt2 = mysqli_fetch_assoc($content_resulttt2);
								if($contenttt2["status"] == '1'){ ?>
                                <li> <a href="midterm-score2?pg=22&refno=<?php echo $content['classid']?>&c=<?php echo $content['classid']?>&g=<?php echo $content['groupid']?>&s=<?php echo $content['subjectid'] ?>&parentid=<?php echo $parentid  ?>"> <i class="glyphicon glyphicon-upload"></i>  Mid-Term Score Upload 2</a> </li>
                             <?php }
							   ?>
                                                         
                        <li><a href="term-score?pg=22&refno=<?php echo $content['classid']?>&c=<?php echo $content['classid']?>&g=<?php echo $content['groupid']?>&s=<?php echo $content['subjectid'] ?>&parentid=<?php echo $parentid  ?>"> <i class="glyphicon glyphicon-upload"></i> Term Score Upload</a> </li>
                        
                        
                        <li><a href="../../backend/result/score-template?pg=22&refno=<?php echo $content['classid']?>&c=<?php echo $content['classid']?>&g=<?php echo $content['groupid']?>&s=<?php echo $content['subjectid'] ?>&parentid=<?php echo $parentid  ?>" target="_blank"> <i class="glyphicon glyphicon-upload"></i> Batch Score Template</a> </li>
                        
                        <li><a href="term-batch-score?pg=22&refno=<?php echo $content['classid']?>&c=<?php echo $content['classid']?>&g=<?php echo $content['groupid']?>&s=<?php echo $content['subjectid'] ?>&parentid=<?php echo $parentid  ?>"> <i class="glyphicon glyphicon-upload"></i> Term Batch Score Upload</a> </li>
                        <?php 
							}?>
                        
                        <li> <a href="../Class-Material?pg=22&refno=<?php echo $content['classid'] ?>&g=<?php echo $content['groupid'] ?>&s=<?php echo $content['subjectid'] ?>&parentid=<?php echo $parentid  ?>" > <i class="glyphicon glyphicon-book"></i> Class Material</a></li>
                        <li> <a href="../feedback?pg=22&refno=<?php echo $content['classid'] ?>&g=<?php echo $content['groupid'] ?>&s=<?php echo $content['subjectid'] ?>&parentid=<?php echo $parentid  ?>" > <i class="glyphicon glyphicon-book"></i> Students Feedback</a></li>
                    </ul>
                </li>
              </ul>
    	 <?php } else{?>
              <ul class="nav ">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#000;">
                    <i class="glyphicon glyphicon-folder-open"></i> <?php echo $content1['class'] ." ".$content2["groupname"].":: ".$content3["subject"]?><b class="caret"></b>
                  </a>
                   <ul class="dropdown-menu">
                        <li><a href="students?refno=<?php echo $content['classid'] ?>&g=<?php echo $content['groupid'] ?>&s=<?php echo $content['subjectid'] ?>&pgs=subt"> <i class="glyphicon glyphicon-user"></i> Students</a></li>
                        <li><a href="lesson-plan?pg=22&refno=<?php echo $content['classid'] ?>&g=<?php echo $content['groupid'] ?>&s=<?php echo $content['subjectid'] ?>"> <i class="glyphicon glyphicon-book"></i> Lesson Plan</a></li>
                        <?php	   		
                        $gid = $_SESSION["teacherlog"];
                        $select_content10=("select * from class_teacher where teacherid ='$gid' and classid ='$classid' and groupid='$groupid'");
                        $content_result10= mysqli_query($db, $select_content10) or die(mysqli_error($db));
                        $num_chk10 = mysqli_num_rows ($content_result10);
                        if ($num_chk10 > 0)
                         {	
                         ?>
                            
                            <li> <a href="assign-subject?refno=<?php echo $classid; ?>&cg=<?php echo $groupid; ?>&yyy=<?php echo $yid; ?>&ttt=<?php echo $termid; ?>&pg=1"> <i class="glyphicon glyphicon-book"></i> Assign Subject</a></li>
                            
                                <li> <a href="single-student-subject?refno=<?php echo $classid; ?>&cg=<?php echo $groupid; ?>&yyy=<?php echo $yid; ?>&ttt=<?php echo $termid; ?>"> <i class="glyphicon glyphicon-book"></i> Single Student Subject</a></li>
                            
                        <?php }else{ ?>
                         <li> <a href="assign-subject?refno=<?php echo $classid; ?>&cg=<?php echo $groupid; ?>&yyy=<?php echo $yid; ?>&ttt=<?php echo $termid; ?>&pg=21"> <i class="glyphicon glyphicon-book"></i> Assign Subject</a></li>
                          <?php } ?>
                          
                        <li><a href="Question-papers?refno=<?php echo $content['classid'] ?>&g=<?php echo $content['groupid'] ?>&parentid=<?php echo $parentid  ?>"> <i class="glyphicon glyphicon-upload"></i> Exam Question Papers</a></li>
                        <li> <a href="online_test?refno=<?php echo $content['classid'] ?>&g=<?php echo $content['groupid'] ?>&s=<?php echo $content['subjectid'] ?>&parentid=<?php echo $parentid  ?>"> <i class="glyphicon glyphicon-random"></i> CBT</a></li>
                        
                        <?php 
							 	$select_content4=("select * from summer ");
								$content_result4= mysqli_query($db, $select_content4) or die(mysqli_error($db));
								$content4 = mysqli_fetch_assoc($content_result4);
								if($content4["status"] == '1' and $content4["id"] == 1){ ?>

                        <li> <a href="result/summer-score?pg=22&refno=<?php echo $content['classid']?>&c=<?php echo $content['classid']?>&g=<?php echo $content['groupid']?>&s=<?php echo $content['subjectid'] ?>&parentid=<?php echo $parentid  ?>"> <i class="glyphicon glyphicon-ok-circle"></i> Summer Score Upload</a> </li>
                        <?php 
                          } ?>
                         <?php 
							 	$select_contenttt=("select * from midterm where name = 'Midterm 1'");
								$content_resulttt= mysqli_query($db, $select_contenttt) or die(mysqli_error($db));
								$contenttt = mysqli_fetch_assoc($content_resulttt);
								if($contenttt["status"] == '1'){ ?>

                        <li> <a href="result/midterm-score?pg=22&refno=<?php echo $content['classid']?>&c=<?php echo $content['classid']?>&g=<?php echo $content['groupid']?>&s=<?php echo $content['subjectid'] ?>&parentid=<?php echo $parentid  ?>"> <i class="glyphicon glyphicon-ok-circle"></i> Mid-Term Score Upload</a> </li>
                        <?php 
                          } ?>
                          
                              
                             <?php 
							 	$select_contenttt2=("select * from midterm where name = 'Midterm 2'");
								$content_resulttt2= mysqli_query($db, $select_contenttt2) or die(mysqli_error($db));
								$contenttt2 = mysqli_fetch_assoc($content_resulttt2);
								if($contenttt2["status"] == '1'){ ?>
                                <li> <a href="result/midterm-score2?pg=22&refno=<?php echo $content['classid']?>&c=<?php echo $content['classid']?>&g=<?php echo $content['groupid']?>&s=<?php echo $content['subjectid'] ?>&parentid=<?php echo $parentid  ?>"> <i class="glyphicon glyphicon-upload"></i>  Mid-Term Score Upload 2</a> </li>
                             <?php }
							   ?>
                        <li> <a href="result/term-score?pg=22&refno=<?php echo $content['classid']?>&c=<?php echo $content['classid']?>&g=<?php echo $content['groupid']?>&s=<?php echo $content['subjectid'] ?>&parentid=<?php echo $parentid  ?>"> <i class="glyphicon glyphicon-upload"></i> Term Score Upload</a> </li>
                        
                        <li><a href="../backend/result/score-template?pg=22&refno=<?php echo $content['classid']?>&c=<?php echo $content['classid']?>&g=<?php echo $content['groupid']?>&s=<?php echo $content['subjectid'] ?>&parentid=<?php echo $parentid  ?>" target="_blank"> <i class="glyphicon glyphicon-upload"></i> Batch Score Template</a> </li>
                        
                        <li> <a href="result/term-batch-score?pg=22&refno=<?php echo $content['classid']?>&c=<?php echo $content['classid']?>&g=<?php echo $content['groupid']?>&s=<?php echo $content['subjectid'] ?>&parentid=<?php echo $parentid  ?>"> <i class="glyphicon glyphicon-upload"></i> Term Batch Score Upload</a> </li>
                        
                        <li> <a href="Class-Material?pg=22&refno=<?php echo $content['classid'] ?>&g=<?php echo $content['groupid'] ?>&s=<?php echo $content['subjectid'] ?>&parentid=<?php echo $parentid  ?>" > <i class="glyphicon glyphicon-book"></i> Class Material</a></li>
                        <li> <a href="feedback?pg=22&refno=<?php echo $content['classid'] ?>&g=<?php echo $content['groupid'] ?>&s=<?php echo $content['subjectid'] ?>&parentid=<?php echo $parentid  ?>" > <i class="glyphicon glyphicon-book"></i> Students Feedback</a></li>
                    </ul>
                </li>
              </ul>
		</li>
        <?php }?>

<?php 	} while ($content = mysqli_fetch_assoc($content_result)); 
	}
	else{
		echo "No Class have been registered under you";
	}
?>
<?php if($page=='result'){?>
<li><a href="../../logout" style="color:#000;"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
    <?php } else{?>
<li><a href="../logout" style="color:#000;"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
    <?php }?>
</ul>

</div>