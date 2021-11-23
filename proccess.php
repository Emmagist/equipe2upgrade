<?php

   require_once("includes/session.php");
   confirm_logged_in(); 
   //category for school processing
   $cat = mysqli_real_escape_string($db, cleanse($_POST['dataInput']));
   $query = "SELECT * FROM sub_category WHERE category_id = '$cat'";
   $result = mysqli_query($db, $query);
   echo $outPut = "<option>Select Category</option>";
   while ($fetch_result = mysqli_fetch_assoc($result)) {
      echo $outPut = " <option value='".$fetch_result['id']."'>" . $fetch_result['sub_category'] . "</option>";
   };

   // subCat for course processing
   $Subcat = mysqli_real_escape_string($db, cleanse($_POST['dataInputCat']));
   $query = "SELECT * FROM sub_category WHERE category_id = '$Subcat'";
   $result = mysqli_query($db, $query);
   // echo $outPut = "<option>Select Sub-category</option>";
   while ($fetch_result = mysqli_fetch_assoc($result)) {
      echo $outPut = "<option value='".$fetch_result['id']."'>" . $fetch_result['sub_category'] . "</option>";
   };

   //school for course processing
   $school = mysqli_real_escape_string($db, cleanse($_POST['dataInputSubCat']));
   $query = "SELECT * FROM schools WHERE sub_category_id = '$school'";
   $result = mysqli_query($db, $query);
   // echo $outPut = "<option>Select School</option>";
   while ($fetch_result = mysqli_fetch_assoc($result)) {
      echo $outPut = "<option value='".$fetch_result['schoolid']."'>" . $fetch_result['school'] . "</option>";
   };
   

?>