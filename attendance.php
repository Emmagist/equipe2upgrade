<?php require_once("includes/session.php"); ?>
<?php confirm_logged_in(); 
require_once '..'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'loader.php';
$aLoader = new Loader($db);
?>
<?php
	$pg = mysqli_real_escape_string($db, $_GET['pg']);
	$pv = mysqli_real_escape_string($db, $_GET['pv']);
	$sql = mysqli_real_escape_string($db, $_GET['sql']);
	$_SESSION["mdate"] = date("Y-m-d");

	$month =0; $year=0;
	if($pg == 1 ){
		$_SESSION["classv"] = mysqli_real_escape_string($db, $_POST["class"]);
		$_SESSION["groupid"] = mysqli_real_escape_string($db, $_POST["group"]) ;
		$_SESSION["month"] = mysqli_real_escape_string($db, $_POST["month"]);
		$_SESSION["year"] = mysqli_real_escape_string($db, $_POST["year"]);
	}
	$mdate = $_SESSION["mdate"] ;
	$classv = $_SESSION["classv"] ;
	$groupid = $_SESSION["groupid"] ;
	$refno = $_SESSION["classv"];
	$month = $_SESSION["month"];
	$year = $_SESSION["year"];

	//echo $month; exit;
	if (empty($month)) {
		$month = date('m');
	}
	if (empty($year)) {
		$year = date('Y');
	}
	$select_contenttt=("select * from terms where status ='1'");
	$content_resulttt= mysqli_query($db, $select_contenttt) or die(mysqli_error($db));
	$contenttt = mysqli_fetch_assoc($content_resulttt);
	$tid =  $contenttt["tid"];
	$termname =  $contenttt["term"];
	
	$select_contentss=("select * from schsession where status =1");
	$content_resultss= mysqli_query($db, $select_contentss) or die(mysqli_error($db));
	$contentss = mysqli_fetch_assoc($content_resultss);
	$sessionid = $contentss["sid"];

	if(mysqli_real_escape_string($db, $_GET['pg']) == 2){
		//exit;
		$aid = mysqli_real_escape_string($db, $_POST['aid']);
		$timemark = mysqli_real_escape_string($db, $_POST['timemark']);
		$reason = mysqli_real_escape_string($db, $_POST['reason']);
		if($timemark == 1){
			mysqli_query($db, "UPDATE attendance SET  morning='0', afternoon='1', reason='$reason', user='$xID',  xdate='$xxdate' WHERE id='$aid'") or die(mysqli_error($db));
		}
		else if($timemark == 2){
			mysqli_query($db, "UPDATE attendance SET  morning='1', afternoon='0', reason='$reason', user='$xID',  xdate='$xxdate' WHERE id='$aid'") or die(mysqli_error($db));
		}
		else if($timemark == 3){
			mysqli_query($db, "UPDATE attendance SET  morning='0', afternoon='0', reason='$reason', user='$xID',  xdate='$xxdate' WHERE id='$aid'") or die(mysqli_error($db));
		}
		else if($timemark == 4){
			mysqli_query($db, "UPDATE attendance SET  morning='1', afternoon='1', reason='$reason', user='$xID',  xdate='$xxdate' WHERE id='$aid'") or die(mysqli_error($db));
		}
		else{
			echo "
			<script language='javascript'>
				alert('Unable to update Register')
			</script>
			";
		}
	}
	
?>


<?php		
	include("header.php");
?>

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Attendance Marking</h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-7 col-sm-7 col-xs-12 form-group pull-right top_search">
                            	 <a href="index" class="btn btn-sm btn-success">Dashboard</a>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    
                    <!--  modals -->
				<div class="modal fade bs-example-modal-sm" id="attendanceModal" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">

							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
								</button>
								<h4 class="modal-title" id="myModalLabel2">Attendance Marking</h4>
							</div>
								<form action="?pg=2" name="frmReg2" method="post" ID="Form1">
									<input type="hidden" value="<?php echo $month; ?>"  name="month"/>
									<input type="hidden" value="<?php echo $year; ?>"  name="year"/>
									<input type="hidden" value="<?php echo $groupid; ?>"  name="groupid"/>
									<input type="hidden" value="<?php echo $classv; ?>"  name="class"/>
								<div class="modal-body" id="getAttendance">
									
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
									<input  type="submit" class="btn btn-primary" value="  Update  " />
								</div>
							</form>
						</div>
					</div>
				</div>
			<!-- /modals -->

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel" >
                               <form method="post" action="?pg=1" name="frmReg" >
                                  <table >
                                      <tr>
                                        <td>Class: </td>
                                          <td style="padding-right:40px"> 
                                          <select name="class" class="form-control" style="width:200px">
                                            <option value="">--Select Class</option>
                                            <?php
												echo $aLoader->getClassTeacher($_SESSION["teacherlog"], $classv);
											?>
                                          </select>
                                          </td>
                                          <td>Arm: </td>
                                          <td style="padding-right:30px">
                                             <select name="group" class="form-control" style="width:150px">
                                                  <option value="">--Select Arm</option>
                                                  <?php
													echo $aLoader->getClassTeacherGroup($_SESSION["teacherlog"], $groupid);
												?>
                                            </select>
                                          </td>
                                          </tr>
                                          
                                          <tr>
                                          <td>Month: </td>
                                          <td style="padding-right:30px">
                                        <select name="month" style="width:150px" required class="form-control">
                                            <option value="01" <?php if($month == 1){?> selected="selected" <?php } ?>> Janunary  </option>
                                            <option value="02" <?php if($month == 2){?>selected="selected" <?php } ?>> Febuary </option>
                                            <option value="03" <?php if($month == 3){?> selected="selected" <?php } ?>> March  </option>
                                            <option value="04" <?php if($month == 4){?>selected="selected" <?php } ?>> April </option>
                                            <option value="05" <?php if($month == 5){?> selected="selected" <?php } ?>> May  </option>
                                            <option value="06" <?php if($month == 6){?>selected="selected" <?php } ?>> June </option>
                                            <option value="07" <?php if($month == 7){?> selected="selected" <?php } ?>> July  </option>
                                            <option value="08" <?php if($month == 8){?>selected="selected" <?php } ?>> August </option>
                                            <option value="09" <?php if($month == 9){?> selected="selected" <?php } ?>> September  </option>
                                            <option value="10" <?php if($month == 10){?>selected="selected" <?php } ?>> October </option>
                                            <option value="11" <?php if($month == 11){?> selected="selected" <?php } ?>> November </option>
                                            <option value="12" <?php if($month == 12){?>selected="selected" <?php } ?>> December </option>
                                        </select>
                                          </td>
                                          <td>Year: </td>
                                          <td>
										  <?php //echo $year; exit;?>
                                            <select name="year" id="year"  style="width:150px;" class="form-control">
                                                <option value=""> Select Year </option>
                                                <?php 
                                                    $c =2015; $y= date("Y");
                                                    do { 	
                                                ?>
                                                <option value="<?php echo  $c;?>" <?php if($year == $c){?> selected="selected"<?php }?> ><?php echo  $c;?></option>
                                                <?php $c++; } while ($c <= $y); ?>
                                            </select>
                                          </td>
                                          
                                          <td > <input type="submit" class="btn btn-info btn-mini" value="Load Register" onClick="return laodstudents()" /></td>
                                      </tr>
                                  </table>
                                 <div class="clearfix"></div>
                                <?php
                                    if ($pg != "")
                                    
                                            {
                                ?>
                             
                                
                                <div class="block">       
                                
                
                           <span style="font-family:Arial, Helvetica, sans-serif;font-size:11px;color:#FF0000"><?php echo $sql; ?></span>
                           <table class="table table-bordered">	
                            <?php
								//echo $chk = $year."-".$month;
								$select_content3=("SELECT * from term_ending_date WHERE Year(termbegin) <= '$year' AND Month(termbegin) <= '$month' AND Year(ends) >= '$year' AND Month(ends) >= '$month' order by id desc limit 2");
							    $content_result3= mysqli_query($db, $select_content3) or die(mysqli_error($db));
								$content3 = mysqli_fetch_assoc($content_result3);
								$num_chk3 = mysqli_num_rows ($content_result3);
								//$termbegin = strtotime($content3["termbegin"]);
								//$termend = strtotime($content3["ends"]);
								
								if($num_chk3 == 0){ //// If there is active TERM
							?>
									<tr height="23" onMouseOver="this.style.backgroundColor='#FFCC66';" onMouseOut="this.style.backgroundColor='';" bgcolor="#EFEFEF">
                                        <td colspan="4"  align="center">Out of TERM! No TERM is setup within Month</td>
                                    </tr>	
							<?php
								}
								else{
									
									
									$select_content=("select * from students s INNER JOIN classes c ON s.class = c.id where s.class ='$classv' and s.group_id= '$groupid' and s.status= '0' order by s.surname asc");
									$content_result= mysqli_query($db, $select_content) or die(mysqli_error($db));
									$content = mysqli_fetch_assoc($content_result);
									$num_chk = mysqli_num_rows ($content_result);
									$k = 0
								?>
									<?php
									if ($num_chk == 0)
										{
									?>
											<tr height="23" onMouseOver="this.style.backgroundColor='#FFCC66';" onMouseOut="this.style.backgroundColor='';" bgcolor="#EFEFEF">
												<td colspan="4"  align="center">No Record Found</td>
											</tr>	
									<?php
									}
										else
									{
                                    
									?>	
									<thead >
                                        <tr style="font-size:12px">
                                            <th>Reg No</th>
                                            <th>Name</th>
                                           <?php
                                            $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                                            $startdate = strtotime("{$year}-{$month}-01");
                                            $startdate2 = strtotime("{$year}-{$month}-01");
                                            $enddate = strtotime("{$year}-{$month}-{$num}");
                                            do {
                                               $date = date("Y-m-d",$startdate); 
                                               if(date("w", $startdate) == 0 or date("w", $startdate) == 6){ //// Is Weekend
                                                $startdate = strtotime('+2 day',$startdate); 
                                             ?>
                                                <th style="background:#9CF; padding:0px; margin:0px"> &nbsp; &nbsp;</th>
                                           <?php
                                                } else{
                                            ?>
                                                <th style="text-align:center; background:#FFC; padding:0px; margin:0px"> <?php echo date('D', strtotime($date)) ." <br>". date("d", $startdate)  ; ?>	</th>
        
                                           <?php
                                                $startdate = strtotime('+1 day',$startdate); 
                                                }
                                            } while ($startdate <= $enddate);
                                            ?>
                                        </tr>
                                    </thead>
                               
                                    <tbody>
									 <?php
									  do{ 
                                            $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                                            $startdate = strtotime("{$year}-{$month}-01");
                                            $startdate2 = strtotime("{$year}-{$month}-01");
                                            $enddate = strtotime("{$year}-{$month}-{$num}");
											$sid =$content ['stid'] ;
                                     ?>
                                        <tr  style="font-size:10px">
                                            <td><b><?php  echo $content ['regno']?></b></td>
                                            <td><b><?php  echo $content['surname']." ". $content['othername']?></b></td>
                                            <?php
												do {
												$date = date("Y-m-d",$startdate2); 
												if(date("w", $startdate2) == 0 or date("w", $startdate2) == 6){ //// Is Weekend
													$startdate2 = strtotime('+2 day',$startdate2); 
												?>
													<td style="background:#999">&nbsp; &nbsp;	</td>
                                           <?php
                                                } else{
                                                    if($startdate2 <= strtotime(date("Y-m-d"))){ ////// Check if above date
                                                        $select_content1=("select * from holiday WHERE hdate='$date'");
                                                        $content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
                                                        $content1 = mysqli_fetch_assoc($content_result1);
                                                        $num_chk1 = mysqli_num_rows ($content_result1);
                                                        if($num_chk1 == 0){ ////////////// Check if date is holiday
															$select_content4=("SELECT * from term_ending_date WHERE termbegin <= '$date' AND ends >= '$date' order by id desc limit 1");
															$content_result4= mysqli_query($db, $select_content4) or die(mysqli_error($db));
															$content4 = mysqli_fetch_assoc($content_result4);
															$termbegin = strtotime($content4["termbegin"]);
															$termend = strtotime($content4["ends"]);
															
																if (($startdate2 >= $termbegin) && ($startdate2 <= $termend)){ ////// Check if date is in between teram begin and Term End
																	$select_content5=("select * from attendance WHERE sdate='$date' and sid='$sid'");
																	$content_result5= mysqli_query($db, $select_content5) or die(mysqli_error($db));
																	$content5 = mysqli_fetch_assoc($content_result5);
																	$num_chk5 = mysqli_num_rows ($content_result5);
																	$id = $content5["id"];
																	if($num_chk5 > 0){ ////////////// Check if student is present
																		if($content5["morning"] == 1 and $content5["afternoon"] == 1){ ////////////// Check if in morn & Aft
												?>
																			<td style="text-align:center"> 
																			
																			<a href="#" onclick="return loadAttendance(<?php echo  $id ?>)"  title="Present"> <img src="../img/fullgood.png" style="width:15px; height:15px"></a>
																			</td>
											<?php		
																		}
																		else if($content5["morning"]== 1 or $content5["afternoon"]== 1){
																			if($content5["morning"]== 0){
																				$result ="Absent in the Morning: ";
																			}
																			if($content5["afternoon"]== 0){
																				$result ="Absent in the Afternoon: ";
																			}
												?>						
																		<td style="text-align:center"> 
																			<a href="#" onclick="return loadAttendance(<?php echo  $id ?>)" title="<?php echo $result." REASON: ".$content5["reason"] ?>"><img src="../img/halfgood.png" style="width:20px; height:20px"></a>
																		</td>
												<?php
																		}
																		else{
												?>
																			<td style="text-align:center"> 
																		<a href="#" onclick="return loadAttendance(<?php echo  $id ?>)" title="Absent, REASON: <?php echo $content5["reason"] ?>"><img src="../img/absent.png" style="width:15px; height:15px"></a>
																			</td>
												<?php
																		}
																	}
																	else{
																		$xxdate = date("Y-m-d");
																		mysqli_query($db, "insert into attendance SET sid = '$sid', sdate = '$date', class='$classv', termid='$tid', sessionid='$sessionid', morning='1', afternoon='1', user='$xID',  xdate='$xxdate'") or die(mysqli_error($db)); 
																		$id = mysqli_insert_id($db);
												?>
																		<td style="text-align:center"> 
																			<a href="#" onclick="return loadAttendance(<?php echo  $id ?>)" title="Present"> <img src="../img/fullgood.png" style="width:15px; height:15px"></a>
																	</td>
												<?php
																	}
																}
																else{
																	echo "<th> </th>";
																}
                                                        }
                                                        else{
															/////////////////Check if there is previous Insert and Delete for holiday
															$select_content1=("delete from attendance WHERE sdate='$date' and sid='$sid'");
                                                            echo "<th> </th>";
                                                        }
                                                    }
                                                    else{
                                                        echo "<th> </th>";
                                                    }
													 $startdate2 = strtotime('+1 day',$startdate2); 
                                                }
                                            } while ($startdate2 <= $enddate);
                                            ?>
                                        </tr>
                                    <?php } while ($content = mysqli_fetch_assoc($content_result)); ?>
                                    </tbody>
                               <?php 
                              	  }
								}
							?>
                    </table>
                                
                         </div>
                            <?php
                                }
                                ?>
                         </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                
              
                
 <!-- footer content -->
               <?php include("includes/footer.php")?>

	<script language="javascript">
	function laodstudents(){
		if(document.frmReg.class.value == "") {
			alert ("Please select Class you want to mark their Attendance")
			document.frmReg.class.focus();
			return false
		}
		else if(document.frmReg.group.value == "") {
			alert ("Please Select Group")
			document.frmReg.group.focus();
			return false
		}
		else if(document.frmReg.month.value == "") {
			alert ("Please Select Month")
			document.frmReg.month.focus();
			return false
		}
		else if(document.frmReg.year.value == "") {
			alert ("Please Select Year")
			document.frmReg.year.focus();
			return false
		}
		else{
			document.frmReg.action="attendance?pg=1"
			document.frmReg.method = "post";
			document.frmReg.submit() 
		}
	}

///////////////////////////////////////////////////////////////////


	function loadAttendance(idvalue){
		if(idvalue != "")
		{
			//alert(idvalue)
			//$.blockUI({ overlayCSS: { backgroundColor: '#00f' } });
			mypath='mode=attendance&id='+idvalue;
				$.ajax({
					type:'POST',
					url:'../backend/loaddata.php',
					data:mypath,
					cache:false,
					success:function(resps){
					$('#getAttendance').empty();
					$('#getAttendance').html(resps);
					$('#attendanceModal').modal('show');
					$.unblockUI();
                	return false;
				}
			});
		
		}
		else{
			alert("Something went wrong! Refresh the page and try again")
		}
		return false;
	}
</script>


