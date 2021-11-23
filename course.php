<?php 
    require_once("includes/session.php");
    confirm_logged_in(); 
    $xID=$_SESSION["teacherlog"]; 
    
    require_once 'models'.DIRECTORY_SEPARATOR.'loader.php';
    $aLoader = new Loader($db);
    
	include("header.php");

    // if(!empty($_GET["refno"])){
    //     $classid = mysqli_real_escape_string($db, $_GET["refno"]);
    //     $_SESSION["t_class_id"] = $classid;
    // }
    // if(!empty($_GET["s"])){
    //     $subid = mysqli_real_escape_string($db, $_GET["s"]);
    //     $_SESSION["t_subject_id"] = $subid;
    // }

    if (isset($_SESSION["user"])) {
        $_SESSION["user"];
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
                            <?php //echo $aLoader->getClassName($_SESSION["t_class_id"]) . " ".$aLoader->getSubjectName($_SESSION["t_subject_id"]); ?>  Course</strong> 
                            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".cart-example-modal-sm"><i class="fa fa-plus"></i> Course</button>
                        </div>
                        
                        <?php
                            $select_content= sprintf("select * from classes");
                            $content_result= mysqli_query($db, $select_content) or die(mysqli_error($db));
                            $content = mysqli_fetch_assoc($content_result);
                            $num_chk = mysqli_num_rows ($content_result);
                            // $id = $content['category_id'];
                            if ($num_chk > 0){
                            do { ?>
                                <div class="col-md-55">
                                    <a href="contents?refno=<?php echo $content['schoolid'] ?>&s=<?php echo $content['id'] ?>">
                                        <div class="thumbnail">
                                            <div class="image view view-first" id="subject-content">
                                                <img src="icons/subject-icon.png" alt="image" id="myImage" style="width: 80px; align-items:center;">
                                            </div>
                                            <div class="caption subject-topic">
                                                <p>
                                                    <strong><?=ucwords($content["class"]) ?></strong>
                                                    
                                                </p>
                                                <div class="" style="display: flex;">
                                                <p><a href="#" class="pull-right faEdit btn btn-warning btn-sm" title="Edit <?=$content['class']?>" data-toggle="modal" data-target="#exampleModal" data-id="<?=$content['id']?>" data-name="<?=$content['class']?>"><i class="fa fa-edit"></i></a></p>
                                                <p>                                                    <a href="#" class="faTrash btn btn-danger btn-sm" data-id="<?=$content['id']?>"><i class="fa fa-trash" ></i></a></p>
                                            </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                        <?php } while ($content = mysqli_fetch_assoc($content_result)); 
                        }
                        else{
                            echo "No course has been added";
                        }
                        ?>
                       
                    </div>
                </div>
            </div>
          
        </div>
    </div>

    <!-- Small modal -->
    
    <div class="modal fade cart-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modalHide">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form  id="submitFormCourse" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2">New Sub-category</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <select name="select_category" id="selectCourseCategoryId" class="form-control">
                                <option value="">Select Category</option>
                                <?php 
                                $select_content= sprintf("select * from category");
                                $content_result= mysqli_query($db, $select_content) or die(mysqli_error($db));
                                $content = mysqli_fetch_assoc($content_result);
                                $num_chk = mysqli_num_rows ($content_result); 
                                if($num_chk > 0) {
                                do{ ?>
                                    <option value="<?=$content['id']?>"><?=$content['category'];?></option>
                                <?php } while ($content = mysqli_fetch_assoc($content_result));
                                } ?>
                            </select>
                        </div>
                        <div class="form-group" id="select_subcategory">
                                <select name="select_subcategory" id="subCatOption" class="form-control">
                                    <option value="">Select Sub-category</option>
                                </select>
                        </div>
                        <div class="form-group" id="select_school">
                            <select name="select_school" id="schoolOption" class="form-control">
                                <option value="">Select School</option>
                            </select>
                        </div>
                        <p><input type="text" class="form-control mt-5" name="course" id="courseInput" placeholder="Add Sub-category"></p>
                        <input type="hidden" name="token" value="<?=$_SESSION["user"];?>" />
                        <div class="form-group" id="priceInput">
                            <input type="number" class="form-control mt-5" name="price" id="" placeholder="Enter Price">
                        </div>
                        <div class="form-group" id="introlLink">
                            <input type="text" class="form-control mt-5" name="intro_link" id="" placeholder="Introduction Video Link">
                        </div>
                        <div class="form-group" id="uploadFile">
                            <input type="file" class="form-control mt-5" name="fileUpload" id="">
                        </div>
                        <div class="form-group" id="uploadFile">
                        <textarea name="mytextarea" id="mytextarea" cols="" rows="" class="form-control" placeholder="Description"></textarea>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <!-- <input type="text" name="formaction" value="create-new" /> -->
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input  type="submit" class="btn btn-primary" value="  Create Category  " /  id="courseButtonDisabled" disabled>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" method="post" id="editClassForm">
            <div class="modal-body">
            
                <div class="form-group"><input type="text" class="form-control" placeholder="Edit Category" name="edit_class" title="Edit Class" id="editClass"></div>
                <div class="form-group"><input type="hidden" class="form-control" name="current_id" id="editClassId"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" title="Close">Close</button>
                <button type="submit" class="btn btn-primary" name="save_changes" title="Save Changes">Save changes</button>
            </div>
        </form>
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
                        <input type="hidden" name="" id="topic_id">
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
                                <a href="#" data-page="webex-class" class="directPage" style="text-decoration:none; color:#000"> 
                                    <img src="../icons/webexmeetings.png" /> <br />
                                Live Class (Webex)
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

    

    <!-- footer content -->
    <?php include("includes/footer.php")?>
    <script>
       
        var admin = "<?php echo SITEURL; ?>";
        var pageDetails = {
            "addCourse": admin+"/subject_topics/controller.php?pg=add_course",
            "editCourse": admin+"/subject_topics/controller.php?pg=edit_course",
            "deleteCourse": admin+"/subject_topics/controller.php?pg=delete_course",
            "siteUrl":"<?php echo SITEURL;?>",
        };

        $(".active_btn").click(function(){
            $("#topic_id").val($(this).attr("data-id"))
            $(".bs-example-modal-lg").modal()
        })

        $(".directPage").click(function(){
            location.href = $(this).attr("data-page")+ "?action=new&refno="+ $("#topic_id").val();
        })


        // Modal Submit 
        $('#select_subcategory').hide();
        $('#select_school').hide();
        $('#courseInput').hide();
        $('#priceInput').hide();
        $('#uploadFile').hide();
        $('#introlLink').hide();
        $('#mytextarea').hide();

        $('#selectCourseCategoryId').change(function () {
            // alert("yes working");
            var category = $('#selectCourseCategoryId').val();
            // alert(category);
            $.ajax({
                type: "POST",
                url: "proccess.php",
                data: "dataInputCat=" + category,
                success: function (data) {
                    $('#subCatOption').html(data);
                    $('#select_subcategory').show();
                    $('$selectCourseCategoryId').addClass('disable');
                    $('#selectCategoryId').addClass('disabled ');
                }
            });
        });

        $('#subCatOption').change(function () {
            // alert("Yes");
            var subCat = $('#subCatOption').val();
            // alert("subCat");
            $.ajax({
                type: "POST",
                url: "proccess.php",
                data: "dataInputSubCat=" + subCat,
                success: function (data) {
                    $('#schoolOption').html(data);
                    $('#select_school').show();
                    $('#courseInput').show();
                    $('#priceInput').show();
                    $('#uploadFile').show();
                    $('#introlLink').show();
                    $('#mytextarea').show();
                    $('#subCatOption').addClass('disabled ');
                    $('#courseButtonDisabled').removeAttr('disabled');
                }
            });
        });

    $("#submitFormCourse").submit(function (e) {
        e.preventDefault()
        // alert("yes");
        pageUrl = pageDetails.addCourse;

        // alert(pageUrl)
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
                if (data) {
                    $('#modalHide').modal('hide');
                    swal({
                        title: "Successful",
                        text: data,
                        icon: "success", 
                    });
                    location.reload();
                }else{
                    swal({
                        title: "Error...",
                        text: 'Error!!!',
                        icon: "error", 
                    });
                }
                
            }
        })
    })

    // input Cat to Modal
    $('.faEdit').click(function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id'); //alert(id);
        var cat = $(this).attr('data-name'); //alert(cat);

        $('#editClassId').val(id);
        $('#editClass').val(cat);
    })

        $('#editClassForm').submit(function name(e) {
            // alert("done");
            e.preventDefault;
            var formData = new FormData(this);
            // alert(formData);
            pageUrl = pageDetails.editCourse;
            $.ajax({
                url: pageUrl,
                type : "post",
                dataType: "json",
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success : function(data){
                    if (data) {
                        $('#exampleModal').modal('hide');
                            swal({
                            title: "Successful",
                            text: data,
                            icon: "success", 
                        });
                        location.reload();
                    }else{
                        swal({
                            title: "Error...",
                            text: 'Error!!!',
                            icon: "error", 
                        });
                    }
                }
            });
            return false;
        });

        $('.faTrash').click(function (e) {
           e.preventDefault();
           var id = $(this).attr('data-id'); //alert(id);
           pageUrl = pageDetails.deleteCourse+'&deletecourse='+id;
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

    