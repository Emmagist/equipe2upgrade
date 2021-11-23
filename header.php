<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Acadasuite | School Management Solution <?php echo SITEURL; ?></title>

    <!-- Bootstrap core CSS -->
	<link rel="shortcuticon icon" type="image/x-icon" href="<?php echo SITEURL; ?>/images/icon.png">
    <link href="<?php echo SITEURL; ?>/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo SITEURL; ?>/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo SITEURL; ?>/css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?php echo SITEURL; ?>/css/custom.css" rel="stylesheet">
    <link href="<?php echo SITEURL; ?>/css/icheck/flat/green.css" rel="stylesheet">
    
    <!-- Datatable  -->
    <link href="<?php echo SITEURL; ?>/css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">
    
    <!-- bootstrap-datetimepicker -->
    <link href="<?php echo SITEURL; ?>/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

    <!-- Web camp -->
	<link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>/assets/css/styles.css" />
    
    <link href="<?php echo SITEURL; ?>/css/select/select2.min.css" rel="stylesheet">
 <!-- Sweetalert Css -->
     <link href="<?php echo SITEURL ?>/sweetalert/sweetalert.css" rel="stylesheet" />
    <script src="<?php echo SITEURL; ?>/js/jquery.min.js"></script>
    <script src="<?php echo SITEURL; ?>/js/nprogress.js"></script>

    <link rel="stylesheet" href="<?php echo SITEURL ?>/css/bootstrapValidator.min.css"/>
    
    <script>
        NProgress.start();
    </script>
    
    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>


<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <!-- <a href="index" class="site_title"><img src="<?php echo SITEURL; ?>/images/acadasuite-logo.png"></a> -->
                        <h2 class="title" style="padding-left:20px; color:#fff; font-weight:bold; font-size:24px"><?php echo $contents["sname"] ?></h2>
                    </div>
                    <div class="clearfix"></div>
                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="assets/img/user-avatar.png" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?php echo $_SESSION["username"] ?></h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <h3><?php //echo $_SESSION["branch"] ?></h3>
                            <ul class="nav side-menu">
                                <li><a href="home1"><i class="fa fa-home"></i> Home </a></li>
                                <li><a href="category"><i class="fa fa-calendar"></i> Category </a></li>
                                <li><a href="sub_category"><i class="fa fa-book"></i>  Sub-category </a></li>
                                <li><a href="school"><i class="fa fa-upload"></i> School </a></li>
                                
                                <li><a href="course"><i class="fa fa-book"></i> Course </a></li>
                                <li><a href="buyers"><i class="fa fa-dollar"></i> Incomes </a></li>
                                <li><a href="activation"><i class="fa fa-dollar"></i> Activation </a></li>
                                <!-- <li><a href="exam-setting"><i class="fa fa-check"></i> Online Exam </a>
                               
                                
                                <li><a><i class="fa fa-envelope"></i> Messaging <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="#?pg=1">Compose SMS</a></li>
                                        <li><a href="#">Sent SMS</a> </li>

                                    </ul>
                                </li> -->
                            </ul>
                        </div>
                       

                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a href="changepass" data-toggle="tooltip" data-placement="top" title="Change password">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a href="changepass" data-toggle="tooltip" data-placement="top" title="Change password">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a href="logout" data-toggle="tooltip" data-placement="top" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                        <?php
                        $select_contentst=sprintf("select * from staff_records WHERE gid='%d'", $_SESSION["teacherlog"]);
						$content_resultst= mysqli_query($db, $select_contentst) or die(mysqli_error($db));
                        $contentst = mysqli_fetch_assoc($content_resultst);
                        ?>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <?php if(!empty($contentst["passport"])){ ?>
                                    <img src="../uploads/staff/<?php echo $contentst["passport"]; ?>" >
                                <?php } else {?>
                                    <img src="assets/img/user-avatar.png">
                                <?php } ?>
                                   
                                    <?php echo $_SESSION["username"] ?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <!-- <li><a href="profile"> <i class="fa fa-user"></i> Profile</a>
                                    </li> -->
                                    <li>
                                        <a href="changepass">
                                            <span><i class="fa fa-lock"></i> Change Password</span>
                                        </a>
                                    </li>
                                    <!-- <li>
                                        <a href="javascript:;"><i class="fa fa-book"></i> Help</a>
                                    </li> -->
                                    <li><a href="logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>

                            <!--<li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green">6</span>
                                </a>
                               
                            </li>-->
                            
							<li style="padding-top:20px; color:#CCC"> Last Login:  <?php echo $_SESSION["loginLast"] ?></li>
                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->