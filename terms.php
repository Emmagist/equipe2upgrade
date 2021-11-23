<?php require_once("includes/session.php"); ?>
<?php confirm_logged_in(); ?>
<?php
$xID = $_SESSION["ustcode"];
?>
<?php
	$pg = mysqli_real_escape_string($db, $_GET['pg']);
	$pv = mysqli_real_escape_string($db, $_GET['pv']);
	$sql = mysqli_real_escape_string($db, $_GET['sql']);
?>


<?php
	if ($pg == 2)
	
		{
			$TXTid = mysqli_real_escape_string($db, $_POST['id']);
			$class  = mysqli_real_escape_string($db, $_POST['class']);
			mysqli_query($db, "UPDATE subjects SET term = '$class' WHERE tid = '$TXTid'");
			$sql= "<b>Operation was Successful: Changes made<b>";
			echo "
				<script language='javascript'>
					location.href='subjects.php?sql=$sql'
				</script>
			";
		}
		
		if ($pg == 9)
	
		{
			$TXTid = mysqli_real_escape_string($db, $_GET['id']);
			mysqli_query($db, "UPDATE subjects SET status = '0'");
			
			mysqli_query($db, "UPDATE subjects SET status = '1' WHERE tid = '$TXTid'");
			
			/*$select_contentts=("select * from schsession where status ='1'");
			$content_resultts= mysqli_query($db, $select_contentts) or die(mysqli_error($db));
			$contentss = mysqli_fetch_assoc($content_resultts);
			$yid =  $contentss["sid"];
			
			$select_contenttt=("select * from subjects where status ='1'");
			$content_resulttt= mysqli_query($db, $select_contenttt) or die(mysqli_error($db));
			$contenttt = mysqli_fetch_assoc($content_resulttt);
			$termid =  $contenttt["tid"];
											
			$select_content3=("select * from midterm_assessment where yearid='$yid' and termid='$termid'");
			$content_result3= mysqli_query($db, $select_content3) or die(mysqli_error($db));
			$num_chk3 = mysqli_num_rows($content_result3);
			if($num_chk3 == 0){
				$select_content32=("select * from midterm_assessment where termid='$termid' order by schoolid asc ");
				$content_result32= mysqli_query($db, $select_content32) or die(mysqli_error($db));
				$content32 = mysqli_fetch_assoc($content_result32);
				$num_chk32 = mysqli_num_rows($content_result32);
				if($num_chk32 > 0){
					do{
						$schoolid = $content32['schoolid'];
						$typename = $content32['type'];
						$per = $content32['per'];
						$user = $content32['user'];
						$orderID = $content32['orderID'];
						$sid = $content32['sid'];
						mysqli_query($db, "insert into midterm_assessment set schoolid='$schoolid', type = '$typename', per='$per', orderID='$orderID', user='$user', xdate='$xdate', yearid='$yearid', termid='$termid'") or die(mysqli_error($db));
						
					}while($content32 = mysqli_fetch_assoc($content_result32));
				}
			}*/
			
			$sql= "<b>Operation was Successful: Changes made<b>";
			$pg = 0;
			echo "
				<script language='javascript'>
					location.href='subjects.php?sql=$sql'
				</script>
			";
		}
?>

<?php
	if ($pg == 6)
	
		{
		
			$TXTid = mysqli_real_escape_string($db, $_GET['id']);
			mysqli_query($db, "delete from subjects where tid = '$TXTid' ") or die(mysqli_error($db)) ;
			$sql = "Operation was Successful: 1 Item deleted";
			header ("location:subjects.php?sql=$sql");
		}
?>

<?php
	if ($pg == 7)
		{
			$TXTid = mysqli_real_escape_string($db, $_GET['id']);
			$select_content1=("select * from subjects WHERE tid='$TXTid'");
			$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
			$content1 = mysqli_fetch_assoc($content_result1);
			$num_chk1 = mysqli_num_rows ($content_result1);
			
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
                            <h3>Term</h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right top_search">
                            	 <a href="dashboard" class="btn btn-sm btn-success"><i class="fa fa-home"></i>Dashboard</a>
                                  
                                  <!--<a href="#" class="btn btn-sm btn-dark"><i class="fa fa-plus"></i> New Term</a>-->
                                 <a href="subjects" class="btn btn-sm btn-warning"><i class="fa fa-search"></i> View Term</a>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel" >
                              <?php
								if ($pg == 1)
									{
							?> 		<form method="post" action="?pg=8" name="frmReg" onsubmit="return loginCheck()" >
									<table class="form">
										 <tr>
											<td>
												<label>Term Name</label>
											</td>
											<td>
												<input type="text" class="form-control" name="class"/>
											</td>
										</tr>
										 <tr>
											<td>
											  
											</td>
											<td>
												<input  type="submit" class="btn btn-primary" value="  Submit  " />
											</td>
										</tr>
									</table>
									</form>
							<?php	
									}
								
							?>
							
							<?php
								if ($pg == 7)
									{
							?> 		
                            	<form method="post" action="?pg=2" name="frmReg" onsubmit="return loginCheck()" >
									<table class="form">
										 <tr>
											<td>
												<label>Term Name</label>
											</td>
											<td>
												<input type="text" class="form-control" name="class" value="<?php echo $content1["term"] ?>"/>
												<input type="hidden" class="form-control" name="id" value="<?php echo $content1["tid"] ?>"/>
											</td>
										</tr>
										 <tr>
											<td>
											  
											</td>
											<td>
												<input  type="submit" class="btn btn-primary" value="  Submit  " />
											</td>
										</tr>
									</table>
									</form>
							<?php	
									}
								
							?>
							
							
							<?php
							
								if ($pg == "")
								
										{
							
							?>
                                <span style="font-family:Arial, Helvetica, sans-serif;font-size:11px;color:#FF0000"><?php echo $sql; ?></span>
                                <table class="table table-striped responsive-utilities jambo_table" id="dataTables-example">
												
							
							
							<?php
										$select_content=("select * from subjects order by tid desc");
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
													<td colspan="5"  align="center">No Record Found</td>
												</tr>	
							<?php
							}
								else
							{
							?>
								<thead>
									<tr>
										<th>S/N</th>
										<th>Term</th>
										<th>Date Created</th>
										<th>Current Term</th>
										<!--<th>Edit</th>-->
										<!--<th>&nbsp;</th>-->
									</tr>
								</thead>
								<tbody>
							<?php do { 
										$color = "#f5f5f5";
										$x < $num_chk;
										$x=$x+1;
										
											if($x%2 == 0)
												{
													$color = "#ffffff";
												}
												
										$k = $k + 1;
										?>
												<tr>
													<td><?php echo $k  ?></td>
													<td><?php  echo $content['term']?></td>
													<td><?php  echo ucfirst($content ['xdate'])?></td>
													<td> <?php if($content ['status'] == 1){
															$dis = "Current";
															$color = "btn btn-sm btn-danger";
														}else{
															$color = "btn btn-sm btn-primary";
															$dis = "Set Current";
														}
														?>
													<a href="subjects?id=<?php  echo $content ['tid']?>&pg=9" class="<?php echo $color?>" ><?php echo $dis;?> </a> </td>
													
													<!--<td width="5%"  style="font-weight:normal"><a href="subjects?id=<?php echo ($content['tid'])?>&pg=7" target="_parent" class="btn btn-dark"><i class="fa fa-edit"></i></a></td>-->                                                   <!--<td width="8%" align="center"><a href="subjects?id=<?php  echo ($content ['tid'])?>&pg=6" target="_parent" onClick="return confirmDel();"><img src="images/deletes.gif" width="20" height="19" border="0" /></a> </td>-->
												</tr>
										 <?php } while ($content = mysqli_fetch_assoc($content_result)); ?>
							<?php 
								}
							?>
							<?php
							}
							?>
							</tbody>
							</table>
                            </div>
                        </div>
                    </div>
                </div>
                
                
              
                
 <!-- footer content -->
               <?php include("includes/footer.php")?>
<script language="javascript">
function loginCheck() {

if(document.frmReg.class.value == "") {
alert ("Please enter Term")
document.frmReg.class.focus();
return false
}
else {
return true
}

}
</script>
<script language="JavaScript" type="text/javascript">

function confirmDel(){ // to confirm delete action before url is sent
	//confirm("Do you want to delete this item?");
	if (confirm("Do you want to delete this?")) {
       return true;
    }	
	return false;
}
</script>