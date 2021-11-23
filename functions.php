
<?php 
if(!empty($_POST["class"]) AND !empty($_POST["group"]) AND !empty($_POST["subject"])){
    require_once("includes/session.php"); 
    confirm_logged_in(); 
    require_once ('../connection.php');

    $classid = mysqli_real_escape_string($db, $_POST["class"]);
    $groupid = mysqli_real_escape_string($db, $_POST["group"]);
    $subid = mysqli_real_escape_string($db, $_POST["subject"]);

    $select_content=sprintf("select schoolid from classes  where id='%d'", $classid);
    $content_result= mysqli_query($db, $select_content) or die(mysqli_error($db));
    $content = mysqli_fetch_assoc($content_result);
    $num_chk = mysqli_num_rows ($content_result);

    $_SESSION["t_class_id"] = $classid;
    $_SESSION["t_group_id"] = $groupid;
    $_SESSION["t_subject_id"] = $subid;
    $_SESSION["t_sch_id"] = $content['schoolid'];
}
require_once '..'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'loader.php';
$aLoader = new Loader($db);
?>
<div class="alert alert-info">
    <a href="index"><b>Home</b></a>>>
    <strong>
    <?php echo $aLoader->getClassName($classid) ." ".$aLoader->getGroupName($groupid). " ".$aLoader->getSubjectName($subid); ?>  </strong> 
</div>
<ul class="bs-glyphicons-list ">
    <li>
        <a href="contents?refno=<?php echo $classid ?>&g=<?php echo $groupid ?>&s=<?php echo $subid ?>" data-link="Class-Material?pg=22&refno=" style="text-decoration:none; color:#000"> 
            <img src="../icons/students-icon.png" /> <br />
            LMS & Virtual Classroom
        </a>
    </li>
    <li>
        <a href="students-daily-report?refno=<?php echo $classid ?>&g=<?php echo $groupid ?>&s=<?php echo $subid ?>&pgs=subt" style="text-decoration:none; color:#000"> 
            <img src="../icons/report-icon.png" /> <br />
            Students Daily Report
        </a>
    </li>
    
    <li>
        <a href="students?refno=<?php echo $classid ?>&g=<?php echo $groupid ?>&s=<?php echo $subid ?>&pgs=subt" style="text-decoration:none; color:#000"> 
            <img src="../icons/parents-icon.png" /> <br />
            Students
        </a>
    </li>

    <li>
        <a href="exam-setting?refno=<?php echo $classid ?>&g=<?php echo $groupid ?>&s=<?php echo $subid ?>&pgs=subt" style="text-decoration:none; color:#000"> 
            <img src="../icons/quiz.png" /> <br />
            Online Exam
        </a>
    </li>

    <li>
        <a href="Attendance?refno=<?php echo $classid ?>&g=<?php echo $groupid ?>&s=<?php echo $subid ?>"  style="text-decoration:none; color:#000"> 
            <img src="../icons/attendance.png" /> <br />
            Attendance
        </a>
    </li>
    
    <li>
        <a  href="assign-subject?refno=<?php echo $classid ?>&g=<?php echo $groupid ?>&s=<?php echo $subid ?>" data-link="?ttt=<?php echo $termid; ?>&yyy=<?php echo $yid; ?>&refno=" style="text-decoration:none; color:#000"> 
            <img src="../icons/library-management-icon.png" /> <br />
            Assign Subject
        </a>
    </li>

    <li>
        <a href="score?refno=<?php echo $classid ?>&g=<?php echo $groupid ?>&s=<?php echo $subid ?>" style="text-decoration:none; color:#000"> 
            <img src="../icons/score-icon.png" /> <br />
            Score Upload
        </a>
    </li>

    <li>
        <a href="score-sheet" style="text-decoration:none; color:#000"> 
            <img src="../icons/report-icon.png" /> <br />
            Score Sheet
        </a>
    </li>
    
    <li>
        <a  href="studentsresult?refno=<?php echo $classid ?>&g=<?php echo $groupid ?>&s=<?php echo $subid ?>" style="text-decoration:none; color:#000"> 
            <img src="../icons/result-management.png" /> <br />
                Term Result
        </a>
    </li>

    <li>
        <a href="lesson-plan?pg=22&refno=" style="text-decoration:none; color:#000"> 
            <img src="../icons/library-mgt-icon.png" /> <br />
            Lesson Plan
        </a>
    </li>
    <!-- <li>
        <a onclick="return load(this,1)" data-link="single-student-subject?ttt=<?php //echo $termid; ?>&yyy=<?php // echo $yid; ?>&refno=" style="text-decoration:none; color:#000"> 
            <img src="../backend/icons/staff.png" /> <br />
            Single Student Subject
        </a>
    </li> -->
    
    
    

    <li>
        <a  href="question-paper" style="text-decoration:none; color:#000"> 
            <img src="../icons/result.png"/> <br />
            Exam Question Paper
        </a>
    </li>

    <li>
        <a href="score?refno=<?php echo $classid ?>&g=<?php echo $groupid ?>&s=<?php echo $subid ?>" style="text-decoration:none; color:#000"> 
            <img src="../icons/score-icon.png" /> <br />
            Mid-Term Score Upload
        </a>
    </li>
    
    <li>
        <a href="score-template" style="text-decoration:none; color:#000"> 
            <img src="../icons/excel.png" /> <br />
            Batch Score Template
        </a>
    </li>
    <li>
        <a href="score-batch-upload" style="text-decoration:none; color:#000"> 
            <img src="../icons/upload-icon.png" /> <br />
                Batch Score Upload
        </a>
    </li>
    
    
    <li>
        <a href="students-feedback" style="text-decoration:none; color:#000"> 
            <img src="../icons/database-backup.png" /> <br />
            Messager
        </a>
    </li>
</ul>

