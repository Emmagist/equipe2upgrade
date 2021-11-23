<?php require_once("includes/session.php"); ?>
<?php confirm_logged_in(); ?>
<?php
$xID = $_SESSION["ustcode"];
?>
<?php
	$pg = mysqli_real_escape_string($db, $_GET['pg']);
	$sql = mysqli_real_escape_string($db, $_GET['sql']);
	$cid =0;
	
	$TXTid = mysqli_real_escape_string($db, $_GET['id']);
	$select_content1=("select * from staff_records s INNER JOIN stafftype t ON s.typeid = t.sid WHERE gid='$TXTid'");
	$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
	$content1 = mysqli_fetch_assoc($content_result1);
	$num_chk1 = mysqli_num_rows ($content_result1);
?>

<?php
include("header.php");	
 ?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left" style="padding-top:20px" >
            <strong><?php echo $content1["surname"]." ".$content1["othername"] ?></strong><br /><br />
            <a href="staff" class="btn btn-sm btn-success"><i class="fa fa-search"></i> 	Back </a>
            </div>

            <div class="title_right">
               <?php if($content1["passport"] !=""){ ?><img src="uploads/staff/<?php echo $content1["passport"] ?>" style="width:90px; height: 80px; border-radius:7px; box-shadow:2px 1px 2px 2px #CCCCCC;"> <?php } else{ ?><img src="images/user.png" width="80px" height="80px">  <?php }?>
            </div>
        </div>
        <div class="clearfix"></div>
     <div class="">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                 <div class="x_content">
                 	<span style="font-family:Arial, Helvetica, sans-serif;font-size:11px;color:#FF0000"><?php echo $sql; ?></span>
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">PROFILE</a>
                            </li>
                            <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">NEXT OF KIN</a>
                            </li>
                            <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">CLASS</a>
                            </li>
                            <li role="presentation" class=""><a href="staff?id=<?php echo $TXTid ?>&pg=7&pp=1">EDIT RECORD</a>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                <table class="table table-striped responsive-utilities jambo_table">
                                  <tr>
                                        <td>
                                            <label>
                                                Gender</label>
                                        </td>
                                        <td>
                                            <?php echo  $content1['sex'] ?>
                                        </td>
                                  </tr>
                                  <tr>
                                    <td>
                                        <label>
                                            Employment Date</label>
                                    </td>
                                    <td>
                                        <?php echo $content1["employdate"] ?>
                                        
                                    </td>
                                  </tr>
                                  <tr>
                                        <td>
                                            <label>Qualification</label>
                                        </td>
                                        <td>
                                            <?php echo $content1["Position"] ?>
                                        </td>
                                  </tr>
                                    <tr>
                                        <td>
                                            
                                            <label>Address</label>
                                        </td>
                                        <td>
                                            <?php echo $content1["residential"] ?>
                                        </td>
                                  </tr>
                                    <tr>
                                        <td>
                                            <label>Email</label>
                                        </td>
                                        <td>
                                            <?php echo $content1["email"] ?>
                                        </td>
                                  </tr>
                                <tr>
                                    <td>
                                        <label>Phone No:</label>
                                    </td>
                                    <td>
                                        <?php echo $content1["phone"] ?>
                                    </td>
                                  </tr>
                                  <tr>
                                        <td>
                                            <label>Staff Type</label>
                                        </td>
                                        <td>
                                           <?php echo $content1["type"] ?>
                                        </td>
                                  </tr>
                               </table>
                            </div>
                            
                            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                            	 <table class="table table-striped responsive-utilities jambo_table">
								  <tr>
									<td height="29" align="left">
										<label>Name:</label>
									</td>
									<td>
										<?php echo $content1["nname"] ?>
									</td>
								  </tr>
								  <tr>
									<td height="27" align="left">
										<label>Address:</label>
									</td>
									<td>
										<?php echo $content1["naddress"] ?>
									</td>
								  </tr>
								  <tr>
									<td height="24" align="left">
										<label>Phone No:</label>
									</td>
									<td>
										<?php echo $content1["nphone"] ?>
									</td>
								  </tr>
								  <tr>
									<td align="left">
										<label>Email:</label>
									</td>
									<td>
										<?php echo $content1["nemail"] ?>
									</td>
								  </tr>
                                  
								</table>
                            </div>
                            
                            <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                            	 <table class="table table-striped responsive-utilities jambo_table">
									<?php
                                        $id =  $_SESSION["pt"];
                                        $select_content=("select * from teacherclasses t INNER JOIN subjects s ON t.subjectid=s.sid INNER JOIN groups g ON t.groupid=g.gid where teacherid='$TXTid'");
                                        $content_result= mysqli_query($db, $select_content) or die(mysqli_error($db));
                                        $content = mysqli_fetch_assoc($content_result);
                                        $num_chk = mysqli_num_rows ($content_result);
                                       
                                        if ($num_chk == 0)
                                            {
                                    ?>
                                    <tr height="23" onMouseOver="this.style.backgroundColor='#FFCC66';" onMouseOut="this.style.backgroundColor='';" bgcolor="#EFEFEF">
                                        <td colspan="3"  align="center">No Record Found</td>
                                    </tr>	
                                    <?php
                                    }
                                        else
                                    {
                                    ?>
                                        <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Class</th>
                                            <th>Group</th>
                                            <th>Subject</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                     <?php
                                     do { 
                                            
                                            $k = $k + 1;
                                            ?>
                            
                                            <tr style="height:10px">
                                                <td><?php echo $k  ?></td>
                                                <td><?php  
                                                $cid = $content['classid'];
                                                $select_content1=("select * from classes WHERE id='$cid'");
                                                $content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
                                                $content3 = mysqli_fetch_assoc($content_result1);
                                                
                                                echo $content3['class']?></td>
                                                <td><?php  echo $content['groupname']?></td>
                                                <td><?php  echo $content['subject']?></td>
                                                
                                            </tr>
                                            
                                     <?php 
                                            
                                       } while ($content = mysqli_fetch_assoc($content_result)); ?> 
                                       
                                    <tr style="height:10px">
                                        <td><a href="teacher-classes?id=<?php echo $content1['gid']?>&pg=12" class="btn btn-primary" ><i class="fa fa-edit">	Manage Teacher Class</i>	</a> </td>
                                    </tr>
                            <?php 
                                }
                            ?>
                </tbody>
                </table>
                            </div>
                            
                            <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                                <form method="post" action="staff?pg=2&p=2" name="frmReg" onsubmit="return loginCheck()" enctype="multipart/form-data">
									<table class="form">
										<tr>
											<td>
												<label>Title </label>
											</td>
											<td>
												<input type="hidden"  name="id" value="<?php echo $content1["gid"] ?>"/>
												<input type="hidden"  name="pcode" value="<?php echo $content1["passport"] ?>"/>
												 <select name="class" class="form-control" >
													  <option value="">--Select Title</option>
													  <?php
															$select_content2=("select * from title  order by class asc");
															$content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
															$content2 = mysqli_fetch_assoc($content_result2);
															$num_chk2 = mysqli_num_rows ($content_result2);
															$k = 0
														?>
													  <?php do { 	?>
													  <option value="<?php echo  $content2['id']?>" <?php if($content2['id'] == $content1['class']){?> selected="selected" <?php } ?>><?php echo  $content2['class']?></option>
													  <?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
													</select>
											</td>
										</tr>
										<tr>
											<td>
												<label>Staff Type </label>
											</td>
											<td>
												 <select name="typeid" class="form-control" >
													  <option value="">--Select Type</option>
													  <?php
															$select_content2=("select * from stafftype  order by sid asc");
															$content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
															$content2 = mysqli_fetch_assoc($content_result2);
															$num_chk2 = mysqli_num_rows ($content_result2);
															$k = 0
														?>
													  <?php do { 	?>
													  <option value="<?php echo  $content2['sid']?>" <?php if($content2['sid'] == $content1['typeid']){?> selected="selected" <?php } ?>><?php echo  $content2['type']?></option>
													  <?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
													</select>
											</td>
										</tr>
										 <tr>
											<td>
												<label>Surname</label>
											</td>
											<td>
												<input type="text" class="form-control" name="sn" value="<?php echo $content1["surname"] ?>"/>
											</td>
										</tr>
										<tr>
											<td>
												<label>Othername</label>
											</td>
											<td>
												<input type="text" class="form-control" name="on" value="<?php echo $content1["othername"] ?>" />
											</td>
										</tr>
										<tr>
                                            <td>
                                                <label>
                                                    Gender</label>
                                            </td>
                                            <td>
                                                <select id="select" name="sex" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="Male" <?php if("Male" == $content1['sex']){?> selected="selected" <?php } ?>>Male</option>
                                                    <option value="Female" <?php if("Female" == $content1['sex']){?> selected="selected" <?php } ?>>Female</option>
                                                </select>
                                               
                                            </td>
                                        </tr>
										 <tr>
											<td>
												<label>
													Qualification</label>
											</td>
											<td>
												<input type="text"  name="oc" value="<?php echo $content1["Position"] ?>" class="form-control" />
											</td>
										</tr>
										<tr>
											<td>
												<label>
													Employment Date</label>
											</td>
											<td>
												<input type="date"  name="employdate" value="<?php echo $content1["employdate"] ?>" class="form-control" />
											</td>
										</tr>
										 <tr>
											<td>
												<label>Contact  Address</label>
											</td>
											<td>
												<input type="text" class="form-control" name="ra" value="<?php echo $content1["residential"] ?>"/>
											</td>
										</tr>
										<tr>
											<td>
												<label>Eamil</label>
											</td>
											<td>
												<input type="email" class="form-control" name="email" value="<?php echo $content1["email"] ?>"/>
											</td>
										</tr>
										<tr>
											<td>
												<label>Phone</label>
											</td>
											<td>
												<input type="text" class="form-control" name="phone" value="<?php echo $content1["phone"] ?>"/>
											</td>
										</tr>                                             
										<tr>
											<td>
											   <label> Username</label>
											</td>
											<td>
												<input type="text" class="form-control" name="user" value="<?php echo $content1["username"] ?>" onkeydown="return digistOnly()" />
											</td>
										</tr>
										<tr>
											<td>
												<label>
													Passport Photograph</label>
											</td>
											<td valign="middle">
												<input type="file" name="image"/>
                                                <input type="hidden" name="webcampPic" value="<?php echo $content1["passport"] ?>" />
												 <?php if($content1["passport"] ==""){ ?>
                                                      <div id="photos"> <img src="images/user.png" height="40px" width="70px" style="border-radius:7px; box-shadow:2px 1px 2px 2px #CCCCCC;"/> </div>
                                                <?php
                                                }else{
                                                ?>
                                                    <div id="photos"> <img src="uploads/studentpassport/<?php echo $content1["passport"] ?>" height="70px" width="70px" style="border-radius:7px; box-shadow:2px 1px 2px 2px #CCCCCC;"/> </div>
                                                <?php
                                                }
                                                ?>
											</td>
										</tr>
                                       <tr><td colspan="2"> <h5 style="color:#039; font-weight:bold">NEXT OF KIN INFORMATION</h5><hr /></td></tr>
                                       <tr>
											<td>
											   <label> Name</label>
											</td>
											<td>
												<input type="text" class="form-control" name="nname" value="<?php echo $content1["nname"] ?>" />
											</td>
										</tr>
                                        <tr>
											<td>
											   <label> Address</label>
											</td>
											<td>
												<input type="text" class="form-control" name="naddress" value="<?php echo $content1["naddress"] ?>" />
											</td>
										</tr>
                                        <tr>
											<td>
											   <label> Phone Number</label>
											</td>
											<td>
												<input type="text" class="form-control" name="nphone" value="<?php echo $content1["nphone"] ?>" />
											</td>
										</tr>
                                        <tr>
											<td>
											   <label> Email</label>
											</td>
											<td>
												<input type="text" class="form-control" name="nemail" value="<?php echo $content1["nemail"] ?>" />
											</td>
										</tr>
										<tr>
											<td>
											  
											</td>
											<td>
												<input  type="submit" class="btn btn-primary" value="  Update  " />
											</td>
										</tr>
									</table>
									</form>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
    </div>
 </div>
                
 <!-- footer content -->                
<?php include("includes/footer.php") ?>

<script language="JavaScript" type="text/javascript">

	function selectall() 
	{ 
  //        var formname=document.getElementById(formname); 
  
		//var recslen = document.forms[0].length; 
		var recslen = document.forms[0].length; 
		  
	 if(document.forms[0].topcheckbox.checked==true) 
	 { 
		for(i=1;i<recslen;i++) { 
			document.forms[0].elements[i].checked=true; 
		} 
	  } 
	  else 
	  { 
		  for(i=1;i<recslen;i++) 
		  document.forms[0].elements[i].checked=false; 
	  } 
	}
</script>

<script type="text/javascript">
//#################################################################################################
function mySearch(){
		$('#errmsg33').html("<strong> Select the parent name</strong>");
		return false;
}
//########################################################################################################

function mySearch2(){
	//declaare a variable that collects the value in the select button
	var facultyfield=$('#gid').val();
	//checks if the variable is empty
	if( facultyfield=="")
	{
		$('#errmsg').html("<strong>  Select the parent name</strong>");
		return false;
	}
}
//########################################################################################################
</script>