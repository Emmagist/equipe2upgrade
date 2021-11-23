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

    if (isset($_GET['ord_id'])) {
        $order_id = $_GET['ord_id'];// echo $order_id;exit;
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
                              <a href="buyers">Buyers</a></strong> 
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Order ID</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Course</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total Items</th>
                                <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 20px;">
                                
                                <?php
                                    $select_content= "select * from purchased_courses where order_id = '$order_id'"; //var_dump($select_content);exit;
                                    $content_result= mysqli_query($db, $select_content) or die(mysqli_error($db));
                                    $content = mysqli_fetch_assoc($content_result); //echo "<pre>";var_dump($content);exit;
                                    $num_chk = mysqli_num_rows ($content_result);
                                    // $id = $content['category_id'];
                                    $i++;
                                        
                                    
                                    if ($num_chk > 0){
                                    do { ?>
                                     <tr>
                                    <th scope="row"><?=$i++?></th>
                                    <td>#<?=$content['order_id']?></td>
                                    <td><?=$content['full_name']?></td>
                                    <td><?=$content['class']?></td>
                                    <td><?=$content['price']?></td>
                                    <td><?=$content['total_items']?></td>
                                    <td><?=$content['xdate']?></td>
                                    </tr>
                                <?php } while ($content = mysqli_fetch_assoc($content_result)); 
                                }
                                ?>
    
                            </tbody>
                        </table>

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
            "addCourse": admin+"/subject_topics/controller.php?pg=add_course",
            "siteUrl":"<?php echo SITEURL;?>",
        };

        $(".active_btn").click(function(){
            $("#topic_id").val($(this).attr("data-id"))
            $(".bs-example-modal-lg").modal()
        })

        $(".directPage").click(function(){
            location.href = $(this).attr("data-page")+ "?action=new&refno="+ $("#topic_id").val();
        })
    </script>

    