<?php 
    ini_set('display_errors',0);
    require_once("includes/session.php");
    confirm_logged_in(); 
    $xID=$_SESSION["teacherlog"]; 
    
    require_once 'models'.DIRECTORY_SEPARATOR.'loader.php';
    $aLoader = new Loader($db);
    
	include("header.php");

    if(!empty($_GET["refno"])){
        $classid = mysqli_real_escape_string($db, $_GET["refno"]);
        $_SESSION["t_class_id"] = $classid;
    }
    if(!empty($_GET["s"])){
        $subid = mysqli_real_escape_string($db, $_GET["s"]);
        $_SESSION["t_subject_id"] = $subid;
    }

    if (isset($_GET['tp'])) {
        $entity_guid = $_GET['tp'];
    }

   $sql = "SELECT * FROM ada_topics WHERE entity_guid = '$entity_guid'";
   $result = mysqli_query($db, $sql);
   $fetch = mysqli_fetch_assoc($result);
    $topic_id = $fetch['topic_id'];
?>

    <!-- /top navigation -->

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
                <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_content">
                    <div class="row">
                        <div class="alert alert-info">
                            <a href="index"><b>Home</b></a> >>
                            <strong>
                            <a href="course"><?php echo $aLoader->getClassName($_SESSION["t_subject_id"]); ?></a> >> <a href="contents?refno=<?=$fetch['schoolid'].'&s='.$fetch['class_id']?>"><?php echo  $aLoader->getTopicById($entity_guid) ?></a>  </strong> 
                        </div>
                        <div class="col-md-12">
                            <form action="" method="post" id="createContentForm" enctype="multipart/form-data">
                                <label for="">Title<span class="text-danger">*</span></label>
                                <div class="form-group"><input type="text" class="form-control" name="title"></div>
                                <label for="">Video Link</label>
                                <div class="form-group"><input type="text" class="form-control" name="video_link"></div>
                                <label for="">PDF</label>
                                <div class="form-group"><input type="file" class="form-control" name="mypdffile"></div>
                                <div class="form-group"><input type="hidden" class="form-control" value="<?=$_SESSION['user']?>" name="user"></div>
                                <div class="form-group"><input type="hidden" class="form-control" value="<?=$fetch['class_id']?>" name="class_id"></div>
                                <div class="form-group"><input type="hidden" class="form-control" value="<?=$topic_id?>" name="topic_id" id="topicId"></div>
                                <label for="">Contents<span class="text-danger">*</span></label>
                                <div class="form-group"><textarea name="mytextarea" id="mytextarea" cols="30" rows="10"></textarea></div>
                                <div class="form-group"><button class="btn btn-primary" type="submit" id="createContentButton">Create Contents</button></div>
                            </form>
                        </div>
                       
                    </div>
                </div>
            </div>
          
        </div>
    </div>

    <!-- Small modal -->
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form  id="subform" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2">New Topic</h4>
                    </div>
                    <div class="modal-body">
                        <!-- <p><input type="number" class="form-control" name="noOfTopic" ></p> -->
                        <div class="form-group"><input type="text" class="form-control" placeholder="Topic" name="topic" id="topic_title"></div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="school_id" value="<?php echo $_SESSION["t_class_id"] ?>" />
                        <input type="hidden" name="class_id" value="<?php echo $_SESSION["t_subject_id"] ?>" />
                        <input type="hidden" name="user" value="<?php echo $_SESSION["user"] ?>" />
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input  type="submit" class="btn btn-primary" value="  Create Topic  " />
                    </div>
                </form>
            </div>
        </div>
    </div>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" id="saveChangesForm">
        <div class="modal-body">
        
            <div class="form-group"><input type="text" class="form-control" placeholder="Edit Topic" name="edit_topic" title="Edit Topic"></div>
            <?php
                            $select_content= sprintf("select * from ada_topics WHERE schoolid='$classid' AND class_id='$subid'  order by topic_id asc");
                            $content_result= mysqli_query($db, $select_content) or die(mysqli_error($db));
                            $content = mysqli_fetch_assoc($content_result);
                            $num_chk = mysqli_num_rows ($content_result);
                            // echo $content["topic_id"];exit;
                            if ($num_chk > 0){
                                do { 
                                    $select_content2=sprintf("select * from ada_contents  where topic_id='%s'", $content["topic_id"]);
                                    $content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
                                    $content2 = mysqli_fetch_assoc($content_result2);
                                    $num_chk2 = mysqli_num_rows ($content_result2);
                        ?>
            <div class="form-group"><input type="hidden" class="form-control" placeholder="Edit Title" name="topic_entity" title="Edit Title"  value="<?=$content['entity_guid']?>"></div>
            <div class="form-group"><input type="hidden" class="form-control" placeholder="Edit Title" name="content_entity_guid" title="Edit Title"  value="<?=$content2['entity_guid']?>"></div>
            <?php }while($content = mysqli_fetch_assoc($content_result)); } ?>
            <div class="form-group"><input type="text" class="form-control" placeholder="Edit Title" name="edit_title" title="Edit Title"></div>
            <div class="form-group"><input type="text" class="form-control" placeholder="Edit Summary" name="edit_summary" title="Edit summary"></div>
            <div class="form-group"><textarea name="edit_contents" id="" cols="" rows="" class="form-control" placeholder="Edit Contents" title="Edit contents"></textarea></div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" title="Close">Close</button>
            <button type="submit" class="btn btn-primary" name="save_changes" title="Save Changes">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

    

    <!-- footer content -->
    <?php include("includes/footer.php")?>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
    
      

        var admin = "<?php echo SITEURL; ?>";
        var pageDetails = {
            "createContent": admin+"/subject_topics/controller.php?pg=create_content",
            // "editrecords": admin+"/subject_topics/controller.php?pg=edit_record",
            "siteUrl":"<?php echo SITEURL;?>",
        };

         // createContent
    $('#createContentForm').submit(function (e) {
        // alert("YES");
        e.preventDefault();
        pageUrl = pageDetails.createContent;

        var formdata = new FormData(this);
        // alert(formdata);
        var topicId = $('#topicId').val();
        $.ajax({
            url: pageUrl,
            type : "post",
            dataType: "json",
            data:formdata,
            cache:false,
            contentType: false,
            processData: false,
            success : function(data){
                if(data){
                    swal({
                        title: "Successful",
                        text: data,
                        icon: "success", 
                    });
                    location.href="view-content?cnt=" + topicId;
                }else{
                    swal({
                        title: "Error!",
                        text: "Contents not uploaded",
                        icon: "error", 
                    });
                }
            }
        });
        return false;
    });

    tinymce.init({
        selector: '#mytextarea'
      });
        $(".active_btn").click(function(){
            $("#topic_id").val($(this).attr("data-id"))
            $(".bs-example-modal-lg").modal()
        })

        $(".directPage").click(function(){
            location.href = $(this).attr("data-page")+ "?action=new&refno="+ $("#topic_id").val();
        })

   
</script>

    