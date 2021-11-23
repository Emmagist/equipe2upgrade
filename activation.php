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

    if (isset($_GET['sub_cat'])) {
        $sub_cat = $_GET['sub_cat'];
    }

    if (isset($_GET['sch'])) {
        $school = $_GET['sch'];
    }

    $select_content3= sprintf("select * from schools where sub_category_id = '$school'");
    $content_result3= mysqli_query($db, $select_content3) or die(mysqli_error($db));
    $content3 = mysqli_fetch_assoc($content_result3); //var_dump($content3);exit;
    $num_chk3 = mysqli_num_rows ($content_result3);

    if (isset($_GET['cls'])) {
        $class = $_GET['cls'];
    }

    $select_content4= sprintf("select * from classes where schoolid = '$class'");
    $content_result4= mysqli_query($db, $select_content4) or die(mysqli_error($db));
    $content4 = mysqli_fetch_assoc($content_result4); //var_dump($content3);exit;
    $num_chk4 = mysqli_num_rows ($content_result4);
?>
<style>
    input{
        height: 18px;
        width: 20px;
    }
</style>
    <!-- /top navigation -->

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
                <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_content">
                    <div class="row">
                        <div class="alert alert-info">
                            <a href="index"><b>Home</b></a> >> <strong>Activation</strong>
                            <button type="button" class="btn btn-primary pull-right"> Activation</button>
                        </div>
                        <form action="" method="post" id="activation_form">
                            <h4><strong>ACTIVATION ITEMS</strong></h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="exampleCheck1" name="vote[cummulative_average_method]">
                                        <td><input type="hidden" value="<?=$_SESSION["user"]?>" name="user"></td>
                                        <label class="form-check-label" for="exampleCheck1">
                                        Use Cummulative Average Method
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="exampleCheck2" name="vote[class_average]">
                                        <label class="form-check-label" for="exampleCheck2">
                                        Show Class Average
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="exampleCheck3" name="vote[student_position_on_card]">
                                        <label class="form-check-label" for="exampleCheck3">
                                            Show Student Position On Report Card
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="exampleCheck4" name="vote[student_comment]">
                                        <label class="form-check-label" for="exampleCheck4">
                                            Show Student Comment
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="exampleCheck5" name="vote[position_on_subject]">
                                        <label class="form-check-label" for="exampleCheck5">
                                            Show Position On Each Subject
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="exampleCheck6" name="vote[student_weight]">
                                        <label class="form-check-label" for="exampleCheck6">
                                            Show Student Weight On Report Card
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="exampleCheck7" name="vote[student_conduct]">
                                        <label class="form-check-label" for="exampleCheck7">
                                            Show Student Conduct On Report Card
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="exampleCheck8" name="vote[summer_class_result]">
                                        <label class="form-check-label" for="exampleCheck8">
                                            Summer Class Result
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="exampleCheck9" name="vote[show_key_grading]">
                                        <label class="form-check-label" for="exampleCheck9">
                                            Show Key Grading
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="exampleCheck10" name="vote[show_gpa]">
                                        <label class="form-check-label" for="exampleCheck10">
                                            Show GPA
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="exampleCheck11" name="vote[show_watermark]">
                                        <label class="form-check-label" for="exampleCheck11">
                                            Show Watermark
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="exampleCheck11" name="vote[use_scratch_card]">
                                        <label class="form-check-label" for="exampleCheck11">
                                            Use Scratch Card
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="exampleCheck11" name="vote[sub_subject]">
                                        <label class="form-check-label" for="exampleCheck12">
                                            Sub Subject
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-flat pull-right" style="margin-right: 25%; margin-top:10px" id="activation_button">Activate</button>
                        </form>
                    </div>
                    
                </div>
            </div>
          
        </div>
    </div>

    <!-- footer content -->
    <?php include("includes/footer.php")?>
    <script>
        var admin = "<?php echo SITEURL; ?>";
        var pageDetails = {
            "activation": admin+"/subject_topics/controller.php?pg=activation",
            "siteUrl":"<?php echo SITEURL;?>",
        };

        $(".active_btn").click(function(){
            $("#topic_id").val($(this).attr("data-id"))
            $(".bs-example-modal-lg").modal()
        })

        $(".directPage").click(function(){
            location.href = $(this).attr("data-page")+ "?action=new&refno="+ $("#topic_id").val();
        })
        
        // Edit Modal Ajax
        $('#activation_form').submit(function (e) {
            // alert('activation wooooooo')
            e.preventDefault;
            // var activeData = $('#activation_form');
            var formData = new FormData(this); //alert('stilll')
            // alert(formData);
            pageUrl = pageDetails.activation;
            $.ajax({
                url: pageUrl,
                type : "post",
                dataType: "json",
                data:formData,
                // cache:false,
                contentType: false,
                processData: false,
                success : function(respond){
                    // alert(respond);
                    if (respond) {
                        // alert(respond);
                        swal({
                            title: "Success",
                            text: respond,
                            icon: "success", 
                        });
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                }
            });
            return false;
        });
    </script>

    