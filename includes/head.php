      <!-- Navbar
      ================================================== -->
      <div class="bs-docs-section clearfix" >
        <div class="row">
          <div class="col-lg-12">
            <div class="page-header">
              <div class="row">
                    <div class="col-lg-12">
                        <div class="col-md-4">
                             <a href="index" style="font-size:24px; color:#002963; vertical-align:bottom; font-weight:bold; padding-bottom:20px"> <img src="<?php if($page=='result'){?>../../backend/logos/<?php echo $contents["logo"] ?> <?php } else{?> ../backend/logos/<?php echo $contents["logo"] ?><?php } ?>" width="100px" height="100px"> </a><a href="index"> 
                        </div>
                        <div class="col-md-4" align="center">
                         	 <a href="#" target="_blank" style="font-size:24px; color:#002963; vertical-align:bottom; font-weight:bold; padding-bottom:20px">   <img src="assets/img/E2U-Logo-design.png" width="270px" /></a> <br />
                             <h4>School Management solution</h4>
                             </a>
                        </div>
                        <div class="col-md-4">
                            <blockquote class="pull-right">
                                <p style="color:rgba(0,0,51,1);"><i class="glyphicon glyphicon-wrench"></i> 100% 24/7 Technical Support</p>
                                <small><i class="glyphicon glyphicon-phone"></i> <?php echo $contents["phone"]; ?> </small>
																<?php if($contents["email"] == ""){ ?>
                                <small><i class="glyphicon glyphicon-envelope"></i> <?php echo $contents["email"]; ?> </small>
																<?php } ?>
                              </blockquote>
                       </div> 
                    </div>
				</div>  
            </div>
<!-- the nav bar -->
            <div class="bs-component">
              <div class="navbar navbar-inverse">
                <div class="navbar-header">
                  <?php if($page=='result'){?>
                  <a class="navbar-brand" href="../index">Home</a>
                  <?php } else {?>
                  <a class="navbar-brand" href="index">Home</a>
                  <?php }?>
                </div>
                <div class="navbar-collapse collapse navbar-inverse-collapse">
                  <ul class="nav navbar-nav">
                  <?php if($page=='result'){?>
                    <li class="active"><a href="../../logout">Logout</a></li>
                  <?php } else {?>
                  <a class="navbar-brand" href="../logout">Logout</a>
                  <?php }?>   
                  <li><h3 style="color:#CCC; padding-left:10px">Welcome to <?php echo $contents["sname"] ?> Portal</h3></li>                 
                  </ul>
                  
                 
                  
                  <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <?php if($_SESSION["passport"] != ""){ ?>
                      	<img src="backend/uploads/<?php echo $_SESSION["passport"]; ?>" width="40px" height="40px" >
                      <?php } else {?>
                      	<i class="glyphicon glyphicon-user"></i><?php echo $_SESSION["username"]; ?> <b class="caret"></b>
                      <?php } ?>
                      </a>
                       <ul class="dropdown-menu">
						  <?php if($page=='result'){?>
                            <li><a href="../view-profile"><i class="glyphicon glyphicon-book"></i> Profile</a></li>
                            <li><a href="../change-password"><i class="glyphicon glyphicon-lock"></i> Change Password</a></li>
                             <li class="divider"></li>
                            <li><a href="../../logout.php"><i class="glyphicon glyphicon-off"></i> Logout</a></li>
                           <?php } else {?>
                           	  <li><a href="view-profile"><i class="glyphicon glyphicon-book"></i> Profile</a></li>
                              <li><a href="change-password"><i class="glyphicon glyphicon-lock"></i> Change Password</a></li>
                              <li class="divider"></li>
                              <li><a href="../logout.php"><i class="glyphicon glyphicon-off"></i> Logout</a></li>
                           <?php } ?>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
            </div><!-- /example -->

          </div>
        </div> 
      </div><!-- end of nav -->

<?php
	$select_contenttt=("select * from subjects where status ='1'");
	$content_resulttt= mysqli_query($db, $select_contenttt) or die(mysqli_error($db));
	$contenttt = mysqli_fetch_assoc($content_resulttt);
  $termid =  $contenttt["tid"];
	
	$select_contentts=("select * from schsession where status ='1'");
	$content_resultts= mysqli_query($db, $select_contentts) or die(mysqli_error($db));
	$contentss = mysqli_fetch_assoc($content_resultts);
  $yid =  $contentts["sid"];
?>      
      <div class="row"><!-- end of row -->
<div class="col-md-12"><center>
<h3 style="color:#F00">Current Term & Session: <?php echo $contenttt['term'].', '.$contentss['sesion']; ?></h3>
</center>
</div>
</div>