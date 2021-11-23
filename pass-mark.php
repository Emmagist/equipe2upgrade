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
	if ($pg == 8){
		
			$classes  =  $_POST['class'];
			$subject  = mysqli_real_escape_string($db, $_POST['subject']);
			$xdate = date("Y-m-d");
			$n = 0;
		foreach($classes as $value){
			$class = $value; 
			
			$select_content1=("select * from passmark WHERE classid='$class'");
			$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
			$num_chk1 = mysqli_num_rows ($content_result1);
			if($num_chk1 == 0){
				mysqli_query($db, "insert into passmark SET classid = '$class', mark='$subject', xdate='$xdate', user='$xID' ") or die(mysqli_error($db));
				$n++;
			}
			
		}
		if($n > 0){
			$sql= "<b>Operation was Successful: Record Inserted<b>";
		}
		else{
				$sql= "<b>Operation failed<b>";	
			}
		echo "
			<script language='javascript'>
				location.href='pass-mark?sql=$sql'
			</script>
		";			
	}
?>

<?php
	if ($pg == 2)
	
		{
			$TXTid = mysqli_real_escape_string($db, $_POST['id']);
			$class  =  $_POST['class'];
			$subject  = mysqli_real_escape_string($db, $_POST['subject']);
			
			$xdate = date("Y-m-d");
			
			mysqli_query($db, "UPDATE passmark SET classid = '$class', mark='$subject', xdate='$xdate', user='$xID' WHERE pid = '$TXTid'");
			$sql= "<b>Operation was Successful: Changes made<b>";
			echo "
				<script language='javascript'>
					location.href='pass-mark?sql=$sql'
				</script>
			";
		}
?>

<?php
	if ($pg == 6)
	
		{
		
			$TXTid = mysqli_real_escape_string($db, $_GET['id']);
			mysqli_query($db, "delete from passmark where pid = '$TXTid' ") or die(mysqli_error($db)) ;
			$sql = "Operation was Successful: 1 Item deleted";
			header ("location:pass-mark?sql=$sql");
		}
?>

<?php
	if ($pg == 7)
		{
			$TXTid = mysqli_real_escape_string($db, $_GET['id']);
			$select_content1=("select * from passmark WHERE pid='$TXTid'");
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
                            <h3>Class Pass Mark</h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right top_search">
                            	 <a href="dashboard" class="btn btn-sm btn-success"><i class="fa fa-home"></i>Dashboard</a>
                                  
                                  <a href="pass-mark?pg=1" class="btn btn-sm btn-dark"><i class="fa fa-plus"></i> New Pass mark</a>
                                 <a href="pass-mark" class="btn btn-sm btn-warning"><i class="fa fa-search"></i> View Pass mark</a>
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
												<label>Affected Class(es):</label>
											</td>
											<td valign="middle">
                                            <input type="button" value="Select All" name="btnsubmit" onClick="fnAll(this.form)" style="border:1px solid black">&nbsp;&nbsp;<input type="button" value="DeSelect All" name="btnsubmit" onClick="fnNotAll(this.form)" style="border:1px solid black"><br>
                                            <?php
												$select_content22=("select * from classes");
												$content_result22= mysqli_query($db, $select_content22) or die(mysqli_error($db));
												$content22 = mysqli_fetch_assoc($content_result22);
												$num_chk22 = mysqli_num_rows ($content_result22);
												if ($num_chk22 > 0){
													do { 
											?>
														<input style="border:0px" type="checkbox" name="class[]" value="<?php echo $content22['id']?>"  /><?php echo $content22['class']?> &nbsp;&nbsp;&nbsp;&nbsp;
							<?php
														} while ($content22 = mysqli_fetch_assoc($content_result22)); 
												}
											?>
											</td>
										</tr>
										 <tr>
											<td>
												<label>Class Pass Mark %</label>
											</td>
											<td>
												<input type="text" class="form-control" name="subject" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )"/>
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
							?> 			 <form method="post" action="?pg=2" name="frmReg" onsubmit="return loginCheck()" >
									<table class="form">
										<tr>
											<td>
												<label>Class Name</label>
											</td>
											<td>
												 <select name="class"  class="form-control">
													  <option value="">--Select Class</option>
													  <?php
															$select_content2=("select * from classes  order by class asc");
															$content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
															$content2 = mysqli_fetch_assoc($content_result2);
															$num_chk2 = mysqli_num_rows ($content_result2);
															$k = 0
														?>
													  <?php do { 	?>
													  <option value="<?php echo  $content2['id']?>" <?php if($content2['id'] == $content1['classid']){?> selected="selected" <?php } ?> ><?php echo  $content2['class']?></option>
													  <?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
													</select>
											</td>
										</tr>
                                        
										 <tr>
											<td>
												<label>Class Pass Mark %</label>
											</td>
											<td>
												<input type="text" class="form-control" name="subject" value="<?php echo $content1["mark"] ?>" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )"/>
												<input type="hidden" class="form-control" name="id" value="<?php echo $content1["pid"] ?>"/>
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
										$select_content=("select * from passmark p INNER JOIN classes c ON p.classid = c.id order by pid desc");
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
													<td colspan="6"  align="center">No Record Found</td>
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
											<th>Pass Mark %</th>
											<th>Date Created</th>
											<th>Edit</th>
											<th>Delete</th>
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
													<td><?php  echo $content['class']?></td>
													<td><?php  echo $content['mark']?></td>
													<td><?php  echo $content ['xdate']?></td>
													<td width="5%"  style="font-weight:normal"><a href="pass-mark?id=<?php echo ($content ['pid'])?>&pg=7" target="_parent" class="btn btn-dark"><i class="fa fa-edit"></i></a></td>                                                   
													<td width="8%" align="center"><a href="pass-mark?id=<?php  echo ($content ['pid'])?>&pg=6" target="_parent" onClick="return confirmDel();" class="btn btn-danger"><i class="fa fa-close"></i></a> </td>
												</tr>
										 <?php } while ($content = mysqli_fetch_assoc($content_result)); ?>
							<?php 
								}
							?>
							</tbody>
							</table>
							<?php
							}
							?>
                            </div>
                        </div>
                    </div>
                </div>
                
                
              
                
 <!-- footer content -->
               <?php include("includes/footer.php")?>

<script language="javascript">
function loginCheck() {

if(document.frmReg.class.value == "") {
alert ("Please Select Class")
document.frmReg.class.focus();
return false
}
if(document.frmReg.subject.value == "") {
alert ("Please enter Pass Mark")
document.frmReg.subject.focus();
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

<script LANGUAGE="JavaScript">
	
	function fnAll(obj)
	{
		for(var i = 0; i < obj.elements.length; i++){
			if(obj.elements[i].type == "checkbox")
			{
				obj.elements[i].checked=true;
			}
		}
	}
	
	function fnNotAll(obj)
	{
		for(var i = 0; i < obj.elements.length; i++){
			if(obj.elements[i].type == "checkbox" && obj.elements[i].name != "password")
			{
				obj.elements[i].checked=false;
			}
		}
	}
</script>