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
    

    if (isset($_GET['cls'])) {
        $class = $_GET['cls'];
    }

    $select_content4= sprintf("select * from classes where schoolid = '$class'");
    $content_result4= mysqli_query($db, $select_content4) or die(mysqli_error($db));
    $content4 = mysqli_fetch_assoc($content_result4); //var_dump($content3);exit;
    $num_chk4 = mysqli_num_rows ($content_result4);
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
                        <?php if($class): echo "<a href='school'>School</a>";  if( $num_chk4 > 1): echo" >> Classess"; else: echo " >> Class"; endif;  else : echo "School"; endif;?>  </strong> 
                        <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".cart-example-modal-sm"><i class="fa fa-plus"></i>School</button>
                    </div>
                    <?php if($school) : 
                        if ($num_chk3 > 0){ do { ?>
                            <div class="col-md-55 justify-content-center mr-4" style="cursor: pointer;">
                                <a href="sub_category?cls=<?=$content3['schoolid'] ?>" class="" style="color: black;">
                                    <img src="icons/subject.jpg" / class="" style="width: 50px; margin-left:35px"> <br /> <?=ucwords($content3["school"]) ?>
                                </a>
                            </div>
                        <?php } while ($content3 = mysqli_fetch_assoc($content_result3)); 
                        }else{echo "No school has been added";};
                    elseif($class) : 
                        if ($num_chk4 > 0){ do { ?>
                            <div class="col-md-55 justify-content-center mr-4" style="cursor: pointer;">
                                <a href="contents?refno=<?=$content4['schoolid'] ?>&s=<?=$content4['id'] ?>" class="" style="color: black;">
                                    <img src="icons/subject.jpg" / class="" style="width: 50px; margin-left:35px"> <br /> <?=ucwords($content4["class"]) ?>
                                </a>
                            </div>
                        <?php } while ($content4 = mysqli_fetch_assoc($content_result4)); 
                        }else{echo "No school has been added";}?>
                    <?php else :
                
                            $select_content= sprintf("select * from schools");
                            $content_result= mysqli_query($db, $select_content) or die(mysqli_error($db));
                            $content = mysqli_fetch_assoc($content_result);
                            $num_chk = mysqli_num_rows ($content_result);
                            // $id = $content['category_id'];
                            if ($num_chk > 0){
                            do { ?>
                                <div class="col-md-55">
                                    <a href="school?cls=<?=$content['schoolid']?>">
                                        <div class="thumbnail">
                                            <div class="image view view-first" id="subject-content">
                                                <img src="icons/subject.jpg" alt="image" id="myImage" style="width: 80px; align-items:center;">
                                            </div>
                                            <div class="caption subject-topic">
                                                <p>
                                                    <strong><?=ucwords($content["school"]) ?></strong>
                                                </p>
                                                <div class="" style="display: flex;">
                                                    <p> <a href="#" class="pull-right faEdit btn btn-sm btn-warning" title="Edit <?=$content['sub_category']?>" data-toggle="modal" data-target="#exampleModal"id="" data-id="<?=$content['schoolid']?>" data-name="<?=$content['school']?>"> <i class="fa fa-edit"></i></a></p>
                                                    <p><a href="#" class="faTrash btn btn-sm btn-danger" data-id="<?=$content['schoolid']?>"><i class="fa fa-trash" ></i></a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                        <?php } while ($content = mysqli_fetch_assoc($content_result)); 
                        }
                        else{
                            echo "No school has been added";
                        }
                        ?>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
          
        </div>
    </div>

    <!-- Small modal -->
    
    <div class="modal fade cart-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" id="modalHide">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form  id="scholForm" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2">New Sub-category</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <select name="select_category" id="selectCategory" class="form-control">
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
                       <div id="secondDisplay">
                            <div class="form-group">
                                    <select name="select_subcategory" id="optionValue" class="form-control"></select>
                            </div>
                                <p><input type="text" class="form-control mt-5" name="school" id="catInput" placeholder="Add Sub-category"></p>
                                <input type="hidden" name="token" value="<?=$_SESSION["user"];?>" />
                            </div>
                            <div class="modal-footer">
                                <!-- <input type="text" name="formaction" value="create-new" /> -->
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <input  type="submit" class="btn btn-primary" value="  Create Category  " />
                            </div>
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
      <form action="" method="post" id="editSchoolForm">
        <div class="modal-body">
        
            <div class="form-group"><input type="text" class="form-control" placeholder="Edit Category" name="edit_school" title="Edit Category" id="editCategory"></div>
            <div class="form-group"><input type="hidden" class="form-control" name="current_id" id="editCategoryId"></div>
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
            "addSchool": admin+"/subject_topics/controller.php?pg=add_school_course",
            "editSchool": admin+"/subject_topics/controller.php?pg=edit_school",
            "deleteSchool": admin+"/subject_topics/controller.php?pg=delete_school",
            "siteUrl":"<?php echo SITEURL;?>",
        };

        $(".active_btn").click(function(){
            $("#topic_id").val($(this).attr("data-id"))
            $(".bs-example-modal-lg").modal()
        })

        $(".directPage").click(function(){
            location.href = $(this).attr("data-page")+ "?action=new&refno="+ $("#topic_id").val();
        });

          // input Cat to Modal
          $('.faEdit').click(function (e) {
            e.preventDefault();
            var id = $(this).attr('data-id'); //alert(id);
            var cat = $(this).attr('data-name'); //alert(cat);

            $('#editCategoryId').val(id);
            $('#editCategory').val(cat);
        })

        function editSchool(id) {
            // alert(id)
            $('#editCategory').val(id);
            
        };

        $('#editSchoolForm').submit(function name(e) {
            e.preventDefault;
            var formData = new FormData(this);
            // alert(formData);
            pageUrl = pageDetails.editSchool;
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
                            title: "Successful...",
                            text: data.message,
                            icon: "success", 
                        });
                        location.reload();
                    }else{
                        swal({
                            title: "Error...",
                            text: data.message,
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
           pageUrl = pageDetails.deleteSchool+'&deleteschool='+id;
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
       })
    </script>

    