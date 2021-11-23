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
                            <h3> Student Grading </h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right top_search">
                               <a href="dashboard" class="btn btn-sm btn-success"><i class="fa fa-home"></i>Dashboard</a>
                                <a href="exam-parameter" class="btn btn-warning">Set Quiz Parameters</a>
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
                            
                            <div class="x_content">
                                <?php if($_GET["pg"] ==2){ ?>
                                <h3><?php  echo $row['surname']." ".$row['othername'] ;?></h3>
                                <form class="form-horizontal" name="frmReg" method="post" onsubmit="return gradeStuent()" id="Form1" enctype="multipart/form-data">
                                <input name="quiz_id" type="hidden" value="<?php echo $_GET["mtid"] ?>"/>
                                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="5px">S/N</th>
                                            <th>Question</th>
                                            <th width="43%">Answer</th>
                                            <th width="20px">Point</th>
                                            <th width="40px">Grade </th>
                                        </tr>
                                    </thead>
                                    <tbody class="td1">
                                        <?php
                                            $s_id = mysqli_real_escape_string($db, $_GET["xid"]);
                                            $mtid = mysqli_real_escape_string($db, $_GET["mtid"]);
                                            $sql=mysqli_query($db, " select * from pans p INNER JOIN quiz_question q ON p.qid=q.id where p.quiz_ID='".$mtid."' AND p.userid='".$s_id."' ")or die(mysqli_error($db));
                                            if(mysqli_num_rows($sql) ==0)
                                            {
                                            ?>
                                                <tr>
                                                    <td style="color:rgb(204,0,0);" colspan="7"> <strong>No record found.</td>
                                                </tr>
                                            <?php
                                            }
                                            else
                                                while($row=mysqli_fetch_array($sql))
                                                {
                                                    $k = $k + 1;
                                            ?>
                                                <tr onmouseover="this.style.backgroundColor='#BDDDB9';" onmouseout="this.style.backgroundColor='';">
                                                    <td><?php echo $k; ?></td> 
                                                    <td> <?php  echo $row['question']; ?></td>
                                                    <td> <?php  echo $row['student_ans'];?></td>
                                                    <td> <?php  echo $row['anspoint'];?>
                                                    <input id="anspoint<?php echo $k ?>" type="hidden" value="<?php  echo $row['anspoint'];?>"/>
                                                    </td>
                                                    <td> 
                                                        <?php 
                                                        if($row['question_type'] == 1) { ?>
                                                            <input type="text" name="grades[]" value="<?php echo $row['point']; ?>" id="grade<?php echo $row['aid']?>" onchange="return checkCBTScore(<?php echo  $k; ?>)">
                                                            <input name="quiz_ids[]" type="hidden" value="<?php echo $row['aid']; ?>"/>
                                                        <?php
                                                        }
                                                        else{  echo $row['point']; }?> 
                                                    </td>
                                                </tr>
                                        <?php  }?>
                                    </tbody>
                                </table>
                                <div class="form-group">
                                    <div class="controls">
                                        <input type="submit" value="Update Result" name="upload" id="submitme" class="btn btn-large btn-primary"/>
                                    </div>
                                </div> 
                                </form>
                                <?php } ?>
                            </div>
                            <!-- CBT Ends here -->
                        </div>
                    </div>
                </div>
            </div>
                
                
              
                
 <!-- footer content -->
               <?php include("includes/footer.php")?>




<script language="javascript">
function checkCBTScore(i){
    var anspoint = eval(document.getElementById("anspoint"+i).value);	
    var grade = eval(document.getElementById('grade' + i).value );	 
    if (grade > anspoint){
        alert("Invalid Input! The score cannot be more than "+anspoint);
        document.getElementById('grade' + i).value = "";
        document.getElementById('grade' + i).focus();
        return false
    }
}
</script>