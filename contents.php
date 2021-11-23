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
                            <?php echo $aLoader->getClassName($_SESSION["t_subject_id"]) ?>  </strong> 
                            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-plus"></i> Add Topic</button>
                        </div>
                        
                        <?php
                            $select_content= sprintf("select * from ada_topics WHERE schoolid='$classid' AND class_id='$subid'  order by topic_id asc");
                            $content_result= mysqli_query($db, $select_content) or die(mysqli_error($db));
                            $content = mysqli_fetch_assoc($content_result);
                            $num_chk = mysqli_num_rows ($content_result);
                            // echo $content['entity_guid'];exit;
                            if ($num_chk > 0){
                                do { ?>
                                <div class="col-md-55">
                                    <a href="#" style="text-decoration: none; cursor:block;">
                                        <div class="thumbnail">
                                            <div class="image view view-first" id="subject-content">
                                                <img src="images/subject.jpg" alt="image" id="myImage" />
                                            </div>
                                            <div class="caption subject-topic">
                                                <p>
                                                    <strong><?php echo  $content["topic"] ?></strong>
                                                    
                                                </p>
                                                <div class="" style="display:flex">
                                                    <p><a href="title-contents?tp=<?=$content['entity_guid']?>" class="btn btn-sm btn-success"  title="Add Contents"><i class="fa fa-plus"></i></a> </p>
                                                    <p><a href="view-content?cnt=<?php echo $content['topic_id'] ?>" class="btn btn-sm btn-info"  title="View Contents"><i class="fa fa-eye"></i></a> </p>
                                                    <p><a href="#" class="btn btn-sm btn-warning faEdit" title="Edit Topic" data-toggle="modal" data-target="#exampleModal" data-id="<?=$content['topic_id']?>" data-name="<?=$content['topic'];?>"><i class="fa fa-edit"></i></a></p>
                                                    <p><a href="#" class="btn btn-sm btn-danger faTrash"  title="Delete Contents" data-id="<?=$content['topic_id']?>"><i class="fa fa-trash"></i></a> </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                        <?php } while ($content = mysqli_fetch_assoc($content_result)); 
                        }
                        else{
                            echo "No topic has been added";
                        }
                        ?>
                       
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
            <div class="form-group"><input type="text" class="form-control" placeholder="Edit Topic" name="edit_topic" title="Edit Topic" id="currentTopic"></div>
            <div class="form-group"><input type="hidden" class="form-control" placeholder="Edit Title" name="topic_id" title="Edit Title" id="currentId"></div>
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
<script>
    var admin = "<?php echo SITEURL; ?>";
    var pageDetails = {
        "addnew": admin+"/subject_topics/controller.php?pg=add_content",
        "editrecords": admin+"/subject_topics/controller.php?pg=edit_record",
        "deleterecords": admin+"/subject_topics/controller.php?pg=delete_record",
        "siteUrl":"<?php echo SITEURL;?>",
    };

    $(".active_btn").click(function(){
        $("#topic_id").val($(this).attr("data-id"))
        $(".bs-example-modal-lg").modal()
    })

    $(".directPage").click(function(){
        location.href = $(this).attr("data-page")+ "?action=new&refno="+ $("#topic_id").val();
    })

        // input Cat to Modal
        $('.faEdit').click(function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id'); //alert(id);
        var cat = $(this).attr('data-name');//alert(cat);

        $('#currentId').val(id);
        $('#currentTopic').val(cat);
    })

    // saveChangesForm
    $('#saveChangesForm').submit(function (e) {
        // alert("YES");
        e.preventDefault();
        pageUrl = pageDetails.editrecords;

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
                    $('#exampleModal').modal('hide');
                    swal({
                        title: "Success!",
                        text: data,
                        icon: "success", 
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                    
                }else{
                    swal({
                        title: "Error!",
                        text: 'Error!!!',
                        icon: "error", 
                    });
                }
                
                // }else if(data.valid == 1){
                // swal({
                //     title: "Successful",
                //     text: data.message,
                //     icon: "success", 
                // });
                // // windows.load
                // if(data.link){
                //     setTimeout(function(){
                //     location.href = data.link;
                //     },1500);
                // }else{
                //     document.getElementById('subform').reset()
                // }
                
                // }
            }
        })
    });

    $('.faTrash').click(function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id'); //alert(id);
        pageUrl = pageDetails.deleterecords+'&deletetopic='+id;
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
</script>

    