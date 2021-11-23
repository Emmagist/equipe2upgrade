<?php 
    ini_set('display_errors',0);
    require_once("includes/session.php");
    confirm_logged_in(); 
    $xID=$_SESSION["teacherlog"]; 
    
    require_once 'models'.DIRECTORY_SEPARATOR.'loader.php';
    $aLoader = new Loader($db);
    
	include("header.php");

    if (isset($_GET['cnt'])) {
        $topic_id = $_GET['cnt'];
    }

    if (isset($_GET['tp'])) {
        $tp_id = $_GET['tp'];
    }

    $sql3 = "SELECT * FROM ada_topics WHERE topic_id = '$topic_id'";
   $result3 = mysqli_query($db, $sql3);
   $fetch3 = mysqli_fetch_assoc($result3);

   $sql = "SELECT * FROM ada_contents WHERE topic_id = '$topic_id'";
   $result = mysqli_query($db, $sql);
   $fetch = mysqli_fetch_assoc($result); //echo "<pre></pre>";var_dump($fetch);exit;
    
   if (isset($_GET['edit'])) {
       $edit = $_GET['edit'];
   }

   $sql2 = "SELECT * FROM ada_contents WHERE entity_guid = '$edit'"; //var_dump($sql2);exit;
   $result2 = mysqli_query($db, $sql2);
   $fetch2 = mysqli_fetch_assoc($result2); //var_dump($fetch2);exit;
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
                            <a href="course"><?php echo $aLoader->getClassName($_SESSION["t_subject_id"]); ?></a><?php if($topic_id) {?> >> <a href="contents?refno=<?=$fetch3['schoolid'].'&s='.$fetch['class_id']?>"><?php echo  $aLoader->getTopicById($topic_id) ?></a>  </strong><?php }elseif($tp_id) {?> >> <a href="contents?refno=<?=$fetch3['schoolid'].'&s='.$fetch['class_id']?>"><?php echo  $aLoader->getTopicById($tp_id) ?></a>  </strong><?php }else{''; }?>
                        </div>
                        <?php if($topic_id) : ?>
                            <div class="col-md-8">
                                <?php if($topic_id){ do { ?>
                                <div class="" style="border-bottom: 1px solid gray;padding-bottom:5px; margin-bottom:25px">
                                        <strong><a href="view-content?edit=<?=$fetch['entity_guid'] . '&tp='. $fetch['topic_id']?>" style="color: blue; margin-bottom: 7px;"><?=$fetch['title']?></a></strong>
                                        <p class="mt-3"><?=$fetch['contents']?></p>
                                        <span style="display: flex;"><p><a href="view-content?edit=<?=$fetch['entity_guid'] . '&tp='. $fetch['topic_id']?>" class="btn btn-sm btn-warning faEdit" title="Edit Topic"><i class="fa fa-edit"></i></a></p><p><a href="#" class="btn btn-sm btn-danger faTrash"  title="Delete Contents" data-id="<?=$fetch['content_id']?>"><i class="fa fa-trash"></i></a> </p></span>
                                </div>
                                <?php } while ($fetch = mysqli_fetch_assoc($result)); }else{"<pre style='color:gray'>No Content added yet !</pre>";} ?> 
                            </div>
                        <?php elseif($edit) : ?>
                            <div class="col-md-12">
                                <h4>Edit Contents</h4>
                                <form action="" method="post" id="editContent">
                                    <label for="">Title</label>
                                    <div class="form-group"><input type="text" class="form-control" name="title" value="<?=$fetch2['title']?>"></div>
                                    <div class="form-group"><input type="hidden" class="form-control" value="<?=$_SESSION['user']?>" name="user"></div>
                                    
                                    <div class="form-group"><input type="hidden" class="form-control" value="<?=$fetch2['entity_guid']?>" name="entity_guid"> <input type="hidden" id="topicIdGet" value="<?=$tp_id ?>"></div>
                                    <label for="">Contents</label>
                                    <div class="form-group"><textarea name="mytextarea" id="mytextarea" cols="30" rows="10"><?=$fetch2['contents']?></textarea></div>
                                    <div class="form-group"><button class="btn btn-primary" type="submit">Edit Contents</button></div>
                                </form>
                            </div>
                        <?php else : "<p style='color:gray'>No record found !</p>"; endif; ?>
                    </div>
                </div>
            </div>
          
        </div>
    </div>

    <!-- footer content -->
    <?php include("includes/footer.php")?> 
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      
        var admin = "<?php echo SITEURL; ?>";
        var pageDetails = {
            "editContent": admin+"/subject_topics/controller.php?pg=editcontent",
            "deleteContent": admin+"/subject_topics/controller.php?pg=delete_content",
            "siteUrl":"<?php echo SITEURL;?>",
        };

        $(".active_btn").click(function(){
            $("#topic_id").val($(this).attr("data-id"))
            $(".bs-example-modal-lg").modal()
        })

        $(".directPage").click(function(){
            location.href = $(this).attr("data-page")+ "?action=new&refno="+ $("#topic_id").val();
        })

    // createContent
    $('#editContent').submit(function (e) {
        // alert("YES");
        e.preventDefault();
        pageUrl = pageDetails.editContent;
        var topicIdGet = $('#topicIdGet').val();
        var formdata = new FormData(this);
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
                    location.href="view-content?cnt="+topicIdGet;
                }else {
                    swal({
                        title: "Error!",
                        text: "Contents not successful....",
                        icon: "error", 
                    });
                }
            }
        });
        return false;
    });

    $('.faTrash').click(function (e) {
        // alert("contentssss")
        e.preventDefault();
        var id = $(this).attr('data-id');// alert(id);
        pageUrl = pageDetails.deleteContent+'&deletecontents='+id;
        //    var confirm = confirm("Are you sure?");
        //    if (confirm) {
            $.ajax({
                url: pageUrl,
                type : "post",
                dataType: "json",
                data:id,
                // cache:false,
                contentType: false,
                processData: false,
                success : function(respond){
                    // alert(respond);
                    if (respond) {
                        // alert(respond);
                        swal({
                            title: "Successful...",
                            text: respond,
                            icon: "success", 
                        });
                        location.reload();
                    }else{
                        swal({
                            title: "Error...",
                            text: "Error encantered",
                            icon: "error", 
                        });
                    }
                }
            });
            return false;
        //    }
    });

    tinymce.init({
        selector: '#mytextarea'
    });
</script>