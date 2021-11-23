<?php 
    require_once("includes/session.php");
    confirm_logged_in(); 

    // $xID=$_SESSION["teacherlog"]; 
	// $select_content1=("select * from systemusers WHERE id='$userID'");
	// $content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
	// $content1 = mysqli_fetch_assoc($content_result1);
	// $num_chk1 = mysqli_num_rows ($content_result1);
	
 
	
	include("header.php");
?>

    <!-- /top navigation -->

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
                <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="bs-glyphicons contentd">
                            <?php
                             if($_GET["action"] == "home"){
                                $classid = $_SESSION["t_class_id"];
                                $groupid = $_SESSION["t_group_id"];
                                $subid = $_SESSION["t_subject_id"];
                                //include("functions.php");
                             }
                             else{
                            ?>
                            <ul class="bs-glyphicons-list ">
                            <?php
                                    $gid = $_SESSION["teacherlog"];
                                    $select_content=("select * from classes");
                                    $content_result= mysqli_query($db, $select_content) or die(mysqli_error($db));
                                    $content = mysqli_fetch_assoc($content_result);
                                    $num_chk = mysqli_num_rows ($content_result);
                                    if ($num_chk > 0)
                                    {
                                        do{
                                    ?>
                                            <?php 
                                            $classid = $content['schoolid'];
                                            $select_content1=("select * from schools where schoolid  ='$classid'");
                                            $content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
                                            $content1 = mysqli_fetch_assoc($content_result1); 
                                            
                                            $subid = $content['id'];
                                            ?>
                                            <li class="dropdown">
                                                <a href="contents?refno=<?php echo $classid ?>&s=<?php echo $subid ?>" class="loadfx" data-class="<?php echo $classid ?>" data-group="<?php echo $groupid ?>" data-sub="<?php echo $subjectid ?>" style="text-decoration:none; color:#000"> 
                                                    <img src="icons/subject-icon.png" /> <br />
                                                    <?php echo $content['class']?> <?php  echo $content2["class"] ?>
                                                    
                                                </a>
                                            </li>
                                    <?php 
                                    } while ($content = mysqli_fetch_assoc($content_result)); 
                                }
                                ?>
                            </ul>
                            <?php  
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer content -->
    <?php include("includes/footer.php")?>
    