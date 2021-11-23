<?php 
require_once("includes/session.php"); 
confirm_logged_in(); 

require_once '..'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'loader.php';
$aLoader = new Loader($db);
$xID = $_SESSION["ustcode"];
$page = '2';
?>
<?php
	$pg = mysqli_real_escape_string($db, $_GET['pg']);
	$r = mysqli_real_escape_string($db, $_GET['r']);
	$pv = mysqli_real_escape_string($db, $_GET['pv']);
	$sql = mysqli_real_escape_string($db, $_GET['sql']);
	
	$select_content4=("select * from schsession where status='1'");
    $content_result4= mysqli_query($db, $select_content4) or die(mysqli_error($db));
    $content4 = mysqli_fetch_assoc($content_result4);
    $session = $content4["sid"];
  
    $select_content2=("select * from terms where status ='1'");
	$content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
	$content2 = mysqli_fetch_assoc($content_result2);
	$num_chk2 = mysqli_num_rows ($content_result2);
    $term = $content2["tid"];
?>

<?php include("header.php"); ?>
<!-- page content -->
    <div class="right_col" role="main">
        <div class="">
			<div class="page-title" style="height:100px">
                <div class="alert alert-info">
                    <a href="index"><b>Home</b></a> >>
                    <a href="index?action=home"><b><?php echo $aLoader->getClassName($_SESSION["t_class_id"]) ." ".$aLoader->getGroupName($_SESSION["t_group_id"]). " ".$aLoader->getSubjectName($_SESSION["t_subject_id"]); ?></b></a> >>
                    <strong>Score Template</strong>
					<div class="pull-right">
                        <a href="score-batch-upload" class="btn btn-primary pull-right"><i class="fa fa-file-excel-o"></i> Batch Upload</a>
                    </div> 
                </div>
            </div>
            <div class="clearfix"></div>
    
            <div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel" >
				<?php
					$select_content= sprintf("select * from studentsubjects where studentclass ='%d' and term ='%d' and year='%d' and group_id ='%d'", $_SESSION["t_class_id"], $term, $session, $_SESSION["t_group_id"]);
					$content_result= mysqli_query($db, $select_content) or die(mysqli_error($db));
					$content = mysqli_fetch_assoc($content_result);
					$num_chk = mysqli_num_rows ($content_result);
					?>
					<?php
					if ($num_chk == 0)
						{
					?>
						<tr>
							<td align="center">Subject Not Yet Assign to Student(s)</td>
						</tr>	
					<?php
                    }
                        else
                    {
                    ?>
					<div class="col-md-12 col-sm-12 col-xs-12">
						<p class="pull-right">
						<button id="csv" class="btn btn-info btn-xs">TO Excel</button> 
						<button class="btn btn-primary pull-right btn-xs" onclick="printer('printableArea')"><i class="fa fa-print"></i> Print</button>
						</p>
					</div>
					<div id="printableArea">
					<div class="col-md-12 col-sm-12 col-xs-12 table-con" id="table">
                        <table class="table data-table" id="ttexample">
                    	<thead>
                            <tr>
                                <th style="height:40px;" valign="middle">S/N</th>
                                <th style="width:180px" valign="middle">Student Name</th>
                                <th style="height:40px;" valign="middle">Reg No</th>
                            <?php
                            $totalsubject = 0;
							$select_content1= sprintf("select * from classes WHERE id='%d'", $_SESSION["t_class_id"]);
						    $content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
						    $content1 = mysqli_fetch_assoc($content_result1);
						    $schoolid = $content1["schoolid"];
  
                            $select_content2= sprintf("select * from subjects where sid ='%d' order by sid desc", $_SESSION["t_subject_id"]);
                            $content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
                            $content2 = mysqli_fetch_assoc($content_result2);
                            $num_chk2 = mysqli_num_rows ($content_result2);
                            
							$select_content5= sprintf("select * from assessment where schoolid ='%d' and termid ='%d' and yearid ='%d' ", $schoolid, $term, $session);
                            $content_result5= mysqli_query($db, $select_content5) or die(mysqli_error($db));							 
							$content5 = mysqli_fetch_assoc($content_result5);
							if(mysqli_num_rows($content_result5) > 0){
								$i= 1;
								do{
									if($content5["per".$i] >0){
								?>
                            		<th style=" text-align:center"> <?php echo $content5["type".$i]; ?></th>
                             <?php 
									}
									$i++;
									$max_mark += $content5["per".$i];
								} while ($i <= $content5['no_of_assessment']);
							}
							else{
								echo "Admmin have NOT setup assesement types";
							}
							 ?>
                            
                            </tr>
						</thead>
						<tbody>
                    
                    <?php 
					$n = 1;
					$scount = 0;
					do { 
						$k = $k + 1;
						$i =0;
						$pp = false;
						
						$cat = $content["subjectid"];
						$splitted = explode(',',$cat);  
						$cnt = count($splitted); 
							 
						while($cnt > $i)  
							{  
								$val = mysqli_real_escape_string($db,$splitted[$i]);
								if(intval($val) == intval($_SESSION["t_subject_id"])){
									$pp = true;
								}
							$i++; 
						}
						
						$stid = $content['studentid'];
						
						if($pp == true){
							$select_contents=("select * from students s INNER JOIN classes c ON s.class = c.id where stid ='$stid'");
							$content_results= mysqli_query($db, $select_contents) or die(mysqli_error($db));
							$contents = mysqli_fetch_assoc($content_results);
							$num_chks = mysqli_num_rows ($content_results);
						?>
								<tr>
									<td><?php  echo $n; $n++;?></td>  
                                    <td ><?php  echo $contents['surname']." ". $contents['othername']?></td>
									<td><?php  echo ucfirst($contents ['regno'])?></td>                                
                                    
                                      <?php
                                      $select_content1= sprintf("select * from scores where sid='%d' AND year = '%d' AND term='%d' AND subject='%d'", $stid, $session, $term, $_SESSION["t_subject_id"]);
                                      $content_result1= mysqli_query($db, $select_content1) or die (mysqli_error($db));
                                      $content1 = mysqli_fetch_assoc($content_result1);
                                      $num_chk1 = mysqli_num_rows ($content_result1);
										if(mysqli_num_rows($content_result5) > 0){
											$i= 1;
											do{
												if($content5["per".$i] >0){
											?>
												<td><?php echo $content1["score".$i]; ?></td>
										<?php 
												}
												$i++;
												$max_mark += $content5["per".$i];
											} while ($i <= $content5['no_of_assessment']);
										}
										else{
											echo "Admmin have NOT setup assesement types";
										}
											?>
												
								</tr>
						 <?php 
							$scount++;
							}
						} while ($content = mysqli_fetch_assoc($content_result)); 
					?>
						</tbody>
					</table>
					</div>
					</div>
					<?php	 
					if($scount == 0){
						$num_chk5 = $num_chk5 + 3; 
					?>
                         <tr height="23" onMouseOver="this.style.backgroundColor='#FFCC66';" onMouseOut="this.style.backgroundColor='';" bgcolor="#EFEFEF">
									<td colspan="<?php echo $num_chk5 ?>"  align="center">Subject Not Yet Assign to Student(s)</td>
							</tr>
					<?php 
					}
				}
			?>

				</div>
			</div>
		</div>

   </div>
 </div>

<?php include("includes/footer.php") ?>
