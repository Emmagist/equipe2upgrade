<?php 
require_once("../includes/session.php");
confirm_logged_in(); ?>
<?php
    $xID = $_SESSION["ustcode"];
    $pg = $_GET['pg'];
?>

<?php 
if ($pg == "add_content"){    
    $error = "";
    $topic = mysqli_real_escape_string($db,  cleanse($_POST["topic"]));
    $school_id = mysqli_real_escape_string($db, cleanse($_POST["school_id"]));
    $class_id = mysqli_real_escape_string($db, $_POST["class_id"]);
    $token = mysqli_real_escape_string($db, $_POST["user"]);
    // $cat_id = mysqli_real_escape_string($db, cleanse($_POST["cat_id"]));
    $date    = date("Y-m-d");

    $sql     = "INSERT INTO ada_topics(class_id, schoolid, topic, content, user_guid, entity_guid, xdate) VALUE('$class_id', '$school_id', '$topic', '$description', '$token', uuid(), '$date')";

    mysqli_query($db, $sql) or die(mysqli_error($db));

    // if (isset($sql)) {
    //     $getSQL = "SELECT * FROM ada_topics WHERE topic = '$topic'";
    //     $result = mysqli_query($db, $getSQL);
    //     $fetch  = mysqli_fetch_assoc($result);
    //     $topicid = $fetch['topic_id'];
    //     $contentSQL   = sprintf("INSERT INTO ada_contents(class_id, title, topic_id, contents, user_guid, entity_guid, xdate) VALUE('$class_id', '$title', '$topicid', '$content', '$token', uuid(), '$date')");
    //     // var_dump($contentSQL);exit;
    //     mysqli_query($db, $contentSQL);
    // }
    //account_logs("Created","affiliate_lada_topicsinks","Created a new Link",$xID,$xdate,"APL",$id,$branch_id);
	$pageContent = json_encode("Topic added Successfully. ");
    
}
?>


<?php
	if ($pg == "edit_content")
	{
        
		$title = mysqli_real_escape_string($db,  cleanse($_POST["title"]));
        $class_id = mysqli_real_escape_string($db, cleanse($_POST["class_id"]));
        $subject = mysqli_real_escape_string($db, $_POST["subject"]);
        $cat_id = mysqli_real_escape_string($db, cleanse($_POST["cat_id"]));
        $subcat_id = mysqli_real_escape_string($db,  cleanse($_POST["subcat_id"]));
        $entity = mysqli_real_escape_string($db, cleanse($_POST["entityc"])); 
        $sql = sprintf("UPDATE ada_topics SET cat_id='%d', class_id='%d', subject='%d', topic='%s', user_guid='%s' WHERE entity_guid='%s'", $cat_id, $class_id, $subject, $title, $xID, $entity); 
        mysqli_query($db, $sql) or die(mysqli_error($db));

        echo $pageContent = json_encode("Topic Updated successfully. ");
        
    }

    if ($pg == "add_category") {
        $cat   = mysqli_real_escape_string($db, cleanse($_POST['Category']));
        $token = mysqli_real_escape_string($db, cleanse($_POST['token']));
        $date = date("Y-m-d");
        $sql = "INSERT INTO category(category, entity_guid, user_guid, xdate) VALUES('$cat', uuid(), '$token', '$date')";
        mysqli_query($db, $sql);

        echo json_encode("Successful...");
        // echo $pageContent;
        // exit();
    }

    if ($pg == "add_sub_category") {
        $sub_cat = mysqli_real_escape_string($db, cleanse($_POST['sub_category']));
        $token   = mysqli_real_escape_string($db, cleanse($_POST['token']));
        $select  = mysqli_real_escape_string($db, cleanse($_POST['select']));
        $date    = date("Y-m-d");
        $sql     = "INSERT INTO sub_category(category_id, user_guid, entity_guid, sub_category, xdate) VALUES('$select', '$token', uuid(), '$sub_cat', '$date')"; //var_dump($sql);
        mysqli_query($db, $sql);

        echo json_encode("Category added successfully...");
    }

    if($pg == "add_school_course"){
        $select_category = mysqli_real_escape_string($db, cleanse($_POST['select_category']));
        $select_subcategory = mysqli_real_escape_string($db, cleanse($_POST['select_subcategory']));
        $token   = mysqli_real_escape_string($db, cleanse($_POST['token']));
        $school  = mysqli_real_escape_string($db, cleanse($_POST['school']));
        $date    = date("Y-m-d");
        $sql     = "INSERT INTO schools(category_id, sub_category_id, user_guid, entity_guid, school, xdate) VALUE('$select_category', '$select_subcategory', '$token', uuid(), '$school', '$date')";
        mysqli_query($db, $sql);

        echo json_encode("Category added successfully.");
    }

    if ($pg == "add_course") {
        $select_category = mysqli_real_escape_string($db, cleanse($_POST['select_category']));
        $select_subcategory = mysqli_real_escape_string($db, cleanse($_POST['select_subcategory']));
        $token   = mysqli_real_escape_string($db, cleanse($_POST['token']));
        $select_school  = mysqli_real_escape_string($db, cleanse($_POST['select_school']));
        $course  = mysqli_real_escape_string($db, cleanse($_POST['course']));
        $price  = mysqli_real_escape_string($db, cleanse($_POST['price']));
        $intro_link = mysqli_real_escape_string($db, cleanse($_POST['intro_link']));
        $mytextarea = mysqli_real_escape_string($db, cleanse($_POST['mytextarea']));
        $fileUpload  = $_FILES['fileUpload'];
        $date    = date("Y-m-d");
        // File upload
        $target_dir = "../img/";
        $target_file  = $target_dir . basename($_FILES["fileUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["fileUpload"]["tmp_name"]);
        if($check == false) {
            $error =  "File is not an image";
            $uploadOk = 0;
        }

        if (file_exists($target_file)) {
            $error = "Sorry, file already exists.";
            $uploadOk = 0;
        }

        if ($_FILES["fileUpload"]["size"] > 500000) {
            $error = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "jfif") {
            $error = "Sorry, only JPG, JPEG, JFIF, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        

        if ($uploadOk == 1) {
            move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file);
        }else{
            echo "Your file was not uploaded";
        }

        $sql     = "INSERT INTO classes(class, entity_guid, user_guid, category_id, sub_category_id, schoolid, price, image, video_link, description, xdate) VALUES('$course', uuid(), '$token', '$select_category', '$select_subcategory', '$select_school', '$price', '$target_file', '$intro_link', '$mytextarea', '$date')"; //var_dump($sql);exit;
        mysqli_query($db, $sql);

        echo json_encode("Course added successfully. ");
    }

    if ($pg == "edit_record") {
        $edit_topic = mysqli_real_escape_string($db, cleanse($_POST['edit_topic']));
        $topic_entity = mysqli_real_escape_string($db, cleanse($_POST['topic_entity']));
        $topic_id  = mysqli_real_escape_string($db, cleanse($_POST['topic_id']));
        $date    = date("Y-m-d");

        
        $sql     = "UPDATE ada_topics SET topic='$edit_topic', xdate='$date' WHERE topic_id = '$topic_id'"; //var_dump($sql);exit;

        mysqli_query($db, $sql) or die(mysqli_error($db));

        // $contentSQL   = sprintf("UPDATE ada_contents SET title='$edit_title', contents='$edit_contents', xdate='$date' WHERE entity_guid = '$content_entity_guid'");
        // // var_dump($contentSQL);exit;
        // mysqli_query($db, $contentSQL);

        echo json_encode("Category added successfully. ");
        // exit();
    }

    if ($pg == 'edit_category') {
        $edit_category = mysqli_real_escape_string($db, cleanse($_POST['edit_category']));
        $current_id = mysqli_real_escape_string($db, cleanse($_POST['current_id']));

        if (isset($edit_category, $current_id)) {
            $contentSQL   = "UPDATE category SET category='$edit_category' WHERE id = '$current_id'";
            // var_dump($contentSQL);exit;
            mysqli_query($db, $contentSQL);
        }
        echo json_encode("Successful....");
    }

    if ($pg == 'edit_sub_category') {
        $edit_sub_category = mysqli_real_escape_string($db, cleanse($_POST['edit_sub_category']));
        $current_id = mysqli_real_escape_string($db, cleanse($_POST['current_id']));
        if (isset($edit_sub_category, $current_id)) {
            $contentSQL   = "UPDATE sub_category SET sub_category='$edit_sub_category' WHERE id = '$current_id'";
            // var_dump($contentSQL);exit;
            mysqli_query($db, $contentSQL);
        }
        echo json_encode("yes");
    }

    if ($pg == 'edit_school') {
        $edit_school = mysqli_real_escape_string($db, cleanse($_POST['edit_school']));
        $current_id = mysqli_real_escape_string($db, cleanse($_POST['current_id']));
        if (isset($edit_school, $current_id)) {
            $contentSQL   = "UPDATE schools SET school='$edit_school' WHERE schoolid = '$current_id'";
            // var_dump($contentSQL);exit;
            mysqli_query($db, $contentSQL);
        }
        echo json_encode("yes");
    }

    if ($pg == 'create_content') {
        $title = mysqli_real_escape_string($db, cleanse($_POST['title']));
        $user = mysqli_real_escape_string($db, cleanse($_POST['user']));
        $content = mysqli_real_escape_string($db, $_POST['mytextarea']);
        $class_id = mysqli_real_escape_string($db, cleanse($_POST['class_id']));
        $topic_id = mysqli_real_escape_string($db, cleanse($_POST['topic_id']));
        $video_link = mysqli_real_escape_string($db, cleanse($_POST['video_link']));
        $date = date("Y-m-d");
        $uploadOk = 1;

        if (isset($user, $content, $class_id, $topic_id)) {
            // if (isset($_FILES["mypdffile"]) || isset($_FILES['fileToUpload'])) {
            //     $destination = '../uploadpdf/';
            //     $pdf_target_file = $destination.basename($_FILES["mypdffile"]["name"]);

            //     $extension = strtolower(pathinfo($pdf_target_file, PATHINFO_EXTENSION));

            //     if ($extension != "pdf" || $extension != "docx") {
            //         echo "You file extension must be .pdf or .docx";
                        //$uploadOk = 0;
            //     }

            //     $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

            //     if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" &&  $imageFileType != "3gp" && $imageFileType != "mpeg")
            //     {
            //         echo "File Format Not Suppoted";
                        //$uploadOk = 0;
            //     }
                //if($uploadOk == 1){
                    //var_dump(move_uploaded_file($_FILES["mypdffile"]["tmp_name"], $pdf_target_file);exit;
            //         move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file);
            //     } 


            //         $contentSQL   = sprintf("INSERT INTO ada_contents(class_id, title, topic_id, contents, page_link, pdf_link, user_guid, entity_guid, xdate) VALUES('$class_id', '$title', '$topic_id', '$content', '$target_file', '$pdf_target_file', '$user', uuid(), '$date')");
            //         mysqli_query($db, $contentSQL);
                    
                

            // } 
            // else {
                $contentSQL   = "INSERT INTO ada_contents(class_id, title, topic_id, contents, page_link, user_guid, entity_guid, xdate) VALUES('$class_id', '$title', '$topic_id', '$content', '$video_link', '$user', uuid(), '$date')";
                // var_dump($contentSQL);exit;
                mysqli_query($db, $contentSQL);
                // echo json_encode("Topic added Successfully...");
            // }
        }
        echo json_encode("Contents Added Successfully...");
    }

    if ($pg == 'editcontent') {
        $title = mysqli_real_escape_string($db, cleanse($_POST['title']));
        $user = mysqli_real_escape_string($db, cleanse($_POST['user']));
        $content = mysqli_real_escape_string($db, $_POST['mytextarea']);
        $entity_guid = mysqli_real_escape_string($db, cleanse($_POST['entity_guid']));
        // $topic_id = mysqli_real_escape_string($db, cleanse($_POST['topic_id']));
        $date = date("Y-m-d");

        if (isset($title, $user, $content, $entity_guid)) {
            $contentSQL   = "UPDATE ada_contents SET title = '$title',  contents = '$content', user_guid = '$user', xdate = '$date' WHERE entity_guid = '$entity_guid'";
            // var_dump($contentSQL);exit;
            mysqli_query($db, $contentSQL);
            echo json_encode("Contents Edited Successfully. ");
        }
    }

    if ($pg == 'edit_course') {
        $edit_class = mysqli_real_escape_string($db, cleanse($_POST['edit_class']));
        $current_id = mysqli_real_escape_string($db, cleanse($_POST['current_id']));
        if (isset($edit_class, $current_id)) {
            $contentSQL   = "UPDATE classes SET class='$edit_class' WHERE id = '$current_id'";
            // var_dump($contentSQL);exit;
            mysqli_query($db, $contentSQL);
        }
        echo json_encode("Done...");
    }

    if ($pg == 'activation') {
        $checked = 0;
        if (isset($_POST['vote'])) {
            $user_token = $_POST['user'];
            $checked = count($_POST['vote']);
            $vote = $_POST['vote'];
            $class_average = $vote["class_average"];
            $cummulative_average_method = $vote['cummulative_average_method'];
            $student_position_on_card = $vote['student_position_on_card'];
            $student_comment = $vote['student_comment'];
            $position_on_subject = $vote['position_on_subject'];
            $student_weight = $vote['student_weight'];
            $student_conduct = $vote['student_conduct'];
            $summer_class_result = $vote['summer_class_result'];
            $show_key_grading = $vote['show_key_grading'];
            $show_gpa = $vote['show_gpa'];
            $show_watermark = $vote['show_watermark'];
            $use_scratch_card = $vote['use_scratch_card'];
            $sub_subject = $vote['sub_subject'];
            
            if ($checked > 0) {
                $sql1 = "SELECT * FROM activation";
                $result = mysqli_query($db, $sql1);
                $fetch = mysqli_fetch_assoc($result);
                $user = $fetch['entity_guid'];
                if ($user == $user_token) {
                    $sql2 = "UPDATE activation SET cummulative_avarag_methode = '$cummulative_average_method', show_class_avarage = '$class_average', show_student_position = '$student_position_on_card', show_subject_comment = '$student_comment', show_position_subject = '$position_on_subject', show_student_weight = '$student_weight', show_student_conduct = '$student_conduct', summer_class_result = '$summer_class_result', show_key_grading = '$show_key_grading', show_gpa = '$show_gpa', show_watermark = '$show_watermark', use_scratch_card = '$use_scratch_card', sub_subject = '$sub_subject' WHERE entity_guid = '$user_token'";
                    mysqli_query($db, $sql2);
                    echo json_encode("Changes Updated Successfully...");
                }else {
                    $sql3 = "INSERT INTO activation(entity_guid, cummulative_avarag_methode, show_class_avarage, show_student_position, show_subject_comment, show_position_subject, show_student_weight, show_student_conduct, summer_class_result, show_key_grading, show_gpa, show_watermark, use_scratch_card, sub_subject) VALUES('$user_token', '$cummulative_average_method', '$class_average', '$student_position_on_card', '$student_comment', '$position_on_subject', '$student_weight', '$student_conduct', '$summer_class_result', '$show_key_grading', '$show_gpa', '$show_watermark', '$use_scratch_card', '$sub_subject')";
                    mysqli_query($db, $sql3);
                    echo json_encode("Activated");
                }
            }
        }else {
            echo json_encode("Please Check a Box!");
        }
    }
    
    if ($pg == 'delete_category' && $_GET['deletecat']) {
        $id = $_GET['deletecat'];
        $sql = "DELETE FROM category WHERE id = '$id'";
        mysqli_query($db, $sql);
        echo json_encode("Category Deleted Successfully...");
    }

    if ($pg == 'delete_sub_category' && $_GET['deletesubcate']) {
        $id = $_GET['deletesubcate'];
        $sql = "DELETE FROM sub_category WHERE id = '$id'";
        mysqli_query($db, $sql);
        echo json_encode("Sub-category Deleted Successfully...");
    }

    if ($pg == 'delete_school' && $_GET['deleteschool']) {
        $id = $_GET['deleteschool'];
        $sql = "DELETE FROM schools WHERE schoolid = '$id'";
        mysqli_query($db, $sql);
        echo json_encode("School Deleted Successfully...");
    }

    if ($pg == 'delete_course' && $_GET['deletecourse']) {
        $id = $_GET['deletecourse'];
        $sql = "DELETE FROM classes WHERE id = '$id'";
        mysqli_query($db, $sql);
        echo json_encode("Course Deleted Successfully...");
    }
    
    if ($pg == 'delete_record' && $_GET['deletetopic']) {
        $id = $_GET['deletetopic'];
        $sql = "DELETE FROM ada_topics WHERE topic_id = '$id'";
        mysqli_query($db, $sql);
        echo json_encode("Course Deleted Successfully...");
    }

    if ($pg == 'delete_content' && $_GET['deletecontents']) {
        $id = $_GET['deletecontents'];
        $sql = "DELETE FROM ada_contents WHERE content_id = '$id'";
        mysqli_query($db, $sql);
        echo json_encode("Course Deleted Successfully...");
    }
?>