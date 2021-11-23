<?php

    require_once("includes/session.php");
    confirm_logged_in(); 
    
    unset($_SESSION["csrf"], $_SESSION["email"]);
    session_destroy();
    header("Location: index.php");

?>