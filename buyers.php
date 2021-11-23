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
                            <?php //echo $aLoader->getClassName($_SESSION["t_class_id"]) . " ".$aLoader->getSubjectName($_SESSION["t_subject_id"]); ?>  Buyers</strong> 
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Students Name</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                    $select_content= sprintf("select * from total_amount  order by amount asc");
                                    $content_result= mysqli_query($db, $select_content) or die(mysqli_error($db));
                                    $content = mysqli_fetch_assoc($content_result);
                                    $num_chk = mysqli_num_rows ($content_result);
                                    // $id = $content['category_id'];
                                    $i++;
                                        
                                    
                                    if ($num_chk > 0){
                                    do { //echo $content['amount'];exit; ?>
                                     <tr>
                                    <th scope="row"><?=$i++?></th>
                                    <td><a href="purchased_details?ord_id=<?=$content['order_id']?>" style="list-style: none;color: blue;cursor:pointer"><?=ucwords($content['full_name'])?></a></td>
                                    <td>&#x20A6;<?=number_format($content['amount'],2)?></td>
                                    <td><?=$content['xdate']?></td>
                                    </tr>
                                <?php } while ($content = mysqli_fetch_assoc($content_result)); 
                                }
                                else{
                                    echo "No Buyer for now";
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

    