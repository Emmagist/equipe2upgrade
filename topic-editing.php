<?php 
   ini_set('display_errors',0); 
   require_once("includes/session.php"); 
   confirm_logged_in();
   require_once ('../connection.php');
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

<div class="right_col" role="main">
    <?php
        $select_content=sprintf("select * from ada_topics  where entity_guid='%s'", $_GET['refno']);
        $content_result= mysqli_query($db, $select_content) or die(mysqli_error($db));
        $content = mysqli_fetch_assoc($content_result);
        $num_chk = mysqli_num_rows ($content_result);
    ?>
	<div class="page-title">
		<div class="title_left">
			<h3>Editing <?php echo $content["topic"]; ?> </h3>
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
                
				<form class="form-horizontal" name="frmReg" method="post" id="subform" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label"><b>Topic</b> </label>
                        <div class="controls">
                            <input class="form-control" name="title" id="title" type="text" value="<?php echo $content["topic"]; ?>" required style="width:320px" />
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <label class="control-label"><b>Description</b> </label>
                        <div class="controls">
                            <input class="form-control" name="entityc" type="hidden" value="<?php echo $content["entity_guid"]; ?>"/>
                            <textarea name="content" class="summernote"><?php echo $content["content"]; ?></textarea >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <input type="hidden" name="formaction" value="edit-record" />
                        <input type="hidden" name="user" value="<?php echo $_SESSION["teacherlog"] ?>" />
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" value="Update Topic" name="upload" id="submitme" class="btn btn-large btn-primary"/>
                    </div>
				</form>
			</div>
		</div>
	</div> 
	
</div>	

<?php include("includes/footer.php")?>
<script>
    var admin = "<?php echo SITEURL; ?>";
    var pageDetails = {
        "editrecord": admin+"/subject_topics/controller.php?pg=edit_content",
        "siteUrl":"<?php echo SITEURL;?>",
    };
</script>