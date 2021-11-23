<?php 
    require_once("includes/session.php");
    confirm_logged_in(); 
    require_once ('../connection.php');
	$xID=$_SESSION["teacherlog"]; 
	$select_content1=("select * from systemusers WHERE id='$userID'");
	$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
	$content1 = mysqli_fetch_assoc($content_result1);
	$num_chk1 = mysqli_num_rows ($content_result1);
	

    $select_content2=("select * from subjects where status ='1'");
	$content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
	$content2 = mysqli_fetch_assoc($content_result2);
	$num_chk2 = mysqli_num_rows ($content_result2);
    $term = $content2["tid"];
	
	include("header.php");
?>

    <!-- /top navigation -->

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
                <div class="col-md-9">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="bs-glyphicons">
                                <ul class="bs-glyphicons-list">
                                
                                <li>
                                    <a href="exam-setting" style="text-decoration:none; color:#000"> 
                                        <img src="../icons/control-panel.png" /> <br />
                                        Exam Setting
                                    </a>
                                </li>
                                <li>
                                    <a href="question-view" style="text-decoration:none; color:#000"> 
                                        <img src="../icons/broadsheet -icon.png" /> <br />
                                        Question
                                    </a>
                                </li>
                                
                               
                                <li>
                                    <a href="cbt-result" style="text-decoration:none; color:#000"> 
                                        <img src="../icons/report-icon.png" /> <br />
                                        Result
                                    </a>
                                </li>
                                <li>
                                    <a href="students" style="text-decoration:none; color:#000"> 
                                        <img src="../icons/students-icon.png" /> <br />
                                        Students
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="staff" style="text-decoration:none; color:#000"> 
                                        <img src="../icons/staff.png" /> <br />
                                        Staff
                                    </a>
                                </li>
                                
                                
                                <li>
                                    <a href="subjects" style="text-decoration:none; color:#000"> 
                                        <img src="../icons/time.png" /> <br />
                                        Terms
                                    </a>
                                </li>
                                <li>
                                    <a href="school-session" style="text-decoration:none; color:#000"> 
                                        <img src="../icons/school-calender.png" /> <br />
                                        School Session
                                    </a>
                                </li>

                                
                                <li>
                                    <a href="schools" style="text-decoration:none; color:#000"> 
                                        <img src="../icons/inventory-icon.png" /> <br />
                                        Schools
                                    </a>
                                </li>
                                <li>
                                    <a href="classes" style="text-decoration:none; color:#000"> 
                                        <img src="../icons/promotion-icon.png"/> <br />
                                        Classes
                                    </a>
                                </li>

                                <li>
                                    <a href="groups" style="text-decoration:none; color:#000"> 
                                        <img src="../icons/hostel-icon.png" /> <br />
                                        Arms
                                    </a>
                                </li>

                                <li>
                                    <a href="subjects" style="text-decoration:none; color:#000"> 
                                        <img src="../icons/subject-icon.png" /> <br />
                                        Subjects
                                    </a>
                                </li>

                                <li>
                                    <a href="grades" style="text-decoration:none; color:#000"> 
                                        <img src="../icons/grade-icon.png" /> <br />
                                        Grading System
                                    </a>
                                </li>

                                <li>
                                    <a href="pass-mark" style="text-decoration:none; color:#000"> 
                                        <img src="../icons/pass-mark-icon.png" /> <br />
                                        Class Pass Mark
                                    </a>
                                </li>
                                <li>
                                    <a href="school" style="text-decoration:none; color:#000"> 
                                        <img src="../icons/school.png" /> <br />
                                        School Information
                                    </a>
                                </li>
                                <li>
                                    <a href="backup" style="text-decoration:none; color:#000"> 
                                        <img src="../icons/database-backup.png" /> <br />
                                        Database Backup
                                    </a>
                                </li>
                                   
                            </ul>


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="x_panel tile fixed_height_320">
                    <div class="x_title">
                        <h2>Active Exam</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="dashboard-widget-content">
                            <table class="countries_list">
                                <tbody>
                                    <?php
                                    $sql = "select q.*, s.subject, c.class from student_quiz q 
                                    LEFT JOIN subjects s ON s.sid=q.subject_id
                                    LEFT JOIN classes c ON c.id=q.class_id
                                    where teacher_id='$xID' AND q.status=1";
                                    $query = mysqli_query($db, $sql) or die(mysqli_error($db));
                                    $nu10 = mysqli_num_rows($query);
                                    if($nu10 > 0){ 
                                        while ($row = mysqli_fetch_array($query)) {
                                            $id = $row['qid'];
                                    ?>
                                        <tr>
                                            <td style="font-size:12px; font-weight:bold"><?php echo $row['class'] ." ". $row['subject'] ?></td>
                                            <td class="fs15 fw700 text-right"><a href="exam-setting?pg=21&action=unset&id=<?php echo $id; ?>" title="Stop Exam" class="btn btn-danger btn-xs">Stop</a></td>
                                        </tr>
                                <?php } }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer content -->
    <?php include("includes/footer.php")?>
    
    <script language="javascript">
    function cbtFunction(){
    alert("This Module is available when you login as a teacher");   
    }
    </script>