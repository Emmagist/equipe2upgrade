<?php 
   ini_set('display_errors',0); 
   require_once("includes/session.php"); 
   confirm_logged_in();
   require_once '..'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'loader.php';
    $aLoader = new Loader($db);;
   include("header.php"); 
?>

<link rel="stylesheet" href="../css/drag_drop_style.css">
<script type="text/javascript" src="../js/drag_drop_script.js"></script>

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

<div class="right_col" role="main">
    <?php
        $select_content=sprintf("select * from ada_topics  where entity_guid='%s'", $_GET['refno']);
        $content_result= mysqli_query($db, $select_content) or die(mysqli_error($db));
        $content = mysqli_fetch_assoc($content_result);
        $num_chk = mysqli_num_rows ($content_result);
    ?>
	<div class="page-title">
		<div class="title_left">
        <a href="index" class="pagelink">Home</a> >>
        <a href="contents" class="pagelink"><?php echo $aLoader->getClassName($_SESSION["t_class_id"]) ." ".$aLoader->getGroupName($_SESSION["t_group_id"]). " ".$aLoader->getSubjectName($_SESSION["t_subject_id"]); ?>  </a>  >>
        <?php echo $content["topic"]; ?>
		</div>
		<div class="title_right">
			<div class="col-md-7 col-sm-7 col-xs-12 form-group pull-right top_search">
				<a href="index" class="btn btn-sm btn-success"><i class="fa fa-home"></i> Dashboard</a>
                <a href="contents" class="btn btn-warning">Topic</a> 
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="row">
		<div class="x_panel">
			<div class="x_content">
                    <?php
                    if($_GET["action"] == "new"){
                        include_once("../package.page/new-google-meet.php");
                    }
                    else if($_GET["action"] == "edit"){
                        include_once("../package.page/edit-google-meet.php");
                    }
                    else{
                        include_once("../package.page/view-record.php");
                    }
                    ?>
			</div>
		</div>
	</div> 
	
</div>	

<?php include("includes/footer.php")?>
<script>
    var admin = "<?php echo SITEURL; ?>";
    var pageDetails = {
        "addnew": admin+"/package.page/controller.php?pg=add_content",
        "editrecord": admin+"/package.page/controller.php?pg=edit_content",
        "siteUrl":"<?php echo SITEURL;?>",
    };  
    
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
</script>