<?php 
    require_once("includes/session.php");
    confirm_logged_in(); 
    require_once ('../connection.php');
    $xID=$_SESSION["teacherlog"]; 
    
    require_once '..'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'loader.php';
    $aLoader = new Loader($db);
    
    $select_content4=("select * from schsession where status='1'");
    $content_result4= mysqli_query($db, $select_content4) or die(mysqli_error($db));
    $content4 = mysqli_fetch_assoc($content_result4);
    $session = $content4["sid"];
  
    $select_content2=("select * from terms where status ='1'");
	$content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
	$content2 = mysqli_fetch_assoc($content_result2);
	$num_chk2 = mysqli_num_rows ($content_result2);
    $term = $content2["tid"];
	
	include("header.php");
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
<style>
   .mb-3{
      margin-bottom: 10px;
   }
</style>
    <!-- /top navigation -->

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="alert alert-info">
                    <a href="index"><b>Home</b></a> >>
                    <a href="index?action=home"><b><?php echo $aLoader->getClassName($_SESSION["t_class_id"]) ." ".$aLoader->getGroupName($_SESSION["t_group_id"]). " ".$aLoader->getSubjectName($_SESSION["t_subject_id"]); ?></b></a> >>
                    <strong>Score Batch Upload</strong> 
                    <div class="pull-right">
                        <a href="score-template" class="btn btn-warning pull-right"><i class="fa fa-table"></i> Download Template</a>
                        <a href="score" class="btn btn-primary pull-right"><i class="fa fa-table"></i> Enter Scores Direct</a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                    <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_content">
                        <div class="row">
                           <p style="color:#f00">
                           Ensure you are uploading score for <br>
                           <?php echo $aLoader->getClassName($_SESSION["t_class_id"]) ." ".$aLoader->getGroupName($_SESSION["t_group_id"]). " ".$aLoader->getSubjectName($_SESSION["t_subject_id"]); ?>
                           </p>
                            <?php
                                include_once("../packages/batch-upload/new.php");
                            ?>
                            
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    </div>

    <!-- Small modal -->
    

    
    <!-- footer content -->
    <?php include("includes/footer.php")?>
    <script>
        var admin = "<?php echo SITEURL; ?>";
        var pageDetails = {
            "addnew": admin+"/packages/batch-upload/controller.php?pg=add_content",
            "editrecord": admin+"/packages/batch-upload/controller.php?pg=edit_content",
            "siteUrl":"<?php echo SITEURL;?>",
        };
    </script>

    