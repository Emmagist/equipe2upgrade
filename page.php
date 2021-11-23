<?php 
   ini_set('display_errors',0); 
   require_once("includes/session.php"); 
   confirm_logged_in();
   require_once 'models'.DIRECTORY_SEPARATOR.'loader.php';
    $aLoader = new Loader($db);;
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
        // echo $content['topic'];exit;
        $num_chk = mysqli_num_rows ($content_result);
    ?>
	<div class="page-title">
		<div class="title_left">
        <a href="index" class="pagelink">Home</a> >>
        <a href="contents" class="pagelink"><?php echo $aLoader->getClassName($_SESSION["t_class_id"]) ?>  </a>  >>
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
                <table class="table">
                    <thead>
                        <tr>
                            <td col="30">Topic</td>
                            <td col="30">Title</td>
                            <td col="30" >Summary</td>
                            <td col="30">Content</td>
                            <td col="30">Video</td>
                            <td col="30">Date</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        do{
                            $topic_id = $content['topic'];
                            $select_content2=sprintf("select * from ada_contents  where topic_id='$topic_id'");
                            $content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
                            $content2 = mysqli_fetch_assoc($content_result2);
                    ?>
                        <tr>
                            <td><?=$content['topic'];?></td>
                            <td><?=$content2['title']?></td>
                            <td><?=$content['content'];?></td>
                            <td><?=$content2['contents']?></td>
                            <td><?=$content2['pdf_link']?></td>
                            <td><?=$content['xdate'];?></td>
                        </tr>
                        <?php }while($content = mysqli_fetch_assoc($content_result));?>
                    </tbody>
                </table>
			</div>
		</div>
	</div> 
	
</div>	

<!-- Large modal -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Select an activity or resource</h4>
            </div>
            <div class="modal-body">
                <div class="bs-glyphicons contentd">
                    <input type="hidden" name="" id="topic_id" value="<?php echo $_GET['refno'] ?>">
                    <ul class="bs-glyphicons-list ">
                        <li>
                            <a href="#" data-page="page" class="directPage" style="text-decoration:none; color:#000"> 
                                <img src="../icons/page.png" /> <br />
                                Page
                            </a>
                        </li>

                        <li>
                            <a href="#" data-page="quiz" class="directPage" style="text-decoration:none; color:#000"> 
                                <img src="../icons/quiz.png" /> <br />
                            Quiz
                            </a>
                        </li>
                        

                        <li>
                            <a href="#" data-page="document" class="directPage" style="text-decoration:none; color:#000"> 
                                <img src="../icons/document.png" /> <br />
                                Document
                            </a>
                        </li>

                        <li>
                            <a href="#" data-page="zoom-meeting" class="directPage" style="text-decoration:none; color:#000"> 
                                <img src="../icons/zoom-meeting.png" /> <br />
                            Live Class (Zoom)
                            </a>
                        </li>
                        <li>
                            <a href="#" data-page="google-meet" class="directPage" style="text-decoration:none; color:#000"> 
                                <img src="../icons/google-meet.png" /> <br />
                                Live Class (Google Meet)
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /modals -->

<?php include("includes/footer.php")?>
<script>
    var admin = "<?php echo SITEURL; ?>";
    var pageDetails = {
        "addnew": admin+"/package.page/controller.php?pg=add_content",
        "editrecord": admin+"/package.page/controller.php?pg=edit_content",
        "siteUrl":"<?php echo SITEURL;?>",
    };

    $(".active_btn").click(function(){
        $(".bs-example-modal-lg").modal()
    })

    $(".directPage").click(function(){
        location.href = $(this).attr("data-page")+ "?action=new&refno="+ $("#topic_id").val();
    })
</script>