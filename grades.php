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
	if($pg == 8){
		$no =0;
		$school = $_POST["school"];
		$sn = mysqli_real_escape_string($db, $_POST['sn']);
		$on = mysqli_real_escape_string($db, $_POST['on']);
		$oc = mysqli_real_escape_string($db, $_POST['oc']);
		$grade = mysqli_real_escape_string($db, $_POST['grade']);
		$xdate = date("Y-m-d");
		
		foreach($school as $value){
			$schoolid= $value; 
			$select_content4r=("select * from grades where schoolid ='$schoolid' and low = '$sn' and high ='$on'");
			$content_result4r= mysqli_query($db, $select_content4r) or die(mysqli_error($db));
			$content4r = mysqli_fetch_assoc($content_result4r);
			$ncount = mysqli_num_rows ($content_result4r);
			if($ncount == 0){ 
				mysqli_query($db, "insert into grades SET schoolid='$schoolid', low='$sn', high='$on', grade='$grade', remark='$oc',  xdate='$xdate',  user='$xID' ") or die(mysqli_error($db));
				$no++;
			}
		}
		if($no > 0){
			$sql= "<b>Operation was Successful: Record(s) Inserted<b> " ;
		}
		else{
			$sql= "<b>Operation failed<b> " ;
		}
			

		echo "
			<script language='javascript'>
				location.href='grades?sql=$sql'
			</script>
		";			
	}
?>


<?php
	if ($pg == 2)
	
		{
			$schoolid =  $_POST["schoolid"];
			$lowv = mysqli_real_escape_string($db, $_POST['lowv']);
			$highv = mysqli_real_escape_string($db, $_POST['highv']);
			$oc = mysqli_real_escape_string($db, $_POST['oc']);
			$grade = mysqli_real_escape_string($db, $_POST['grade']);
			
			$xdate = date("Y-m-d");
			$TXTid = mysqli_real_escape_string($db, $_POST['id']);

			$select_content4r=("select * from grades where schoolid ='$schoolid' and (low <= '$lowv' and high >='$highv') and gradeid !='$TXTid'");
			$content_result4r= mysqli_query($db, $select_content4r) or die(mysqli_error($db));
			$content4r = mysqli_fetch_assoc($content_result4r);
			$ncount = mysqli_num_rows ($content_result4r);
			if($ncount > 0){ 
				$sql= "<b>Operation Failed!: The value range you entered exist<b>";
			} 
			else{
				mysqli_query($db, "UPDATE grades Set schoolid='$schoolid', low='$lowv', high='$highv', remark='$oc', xdate='$xdate', grade='$grade', user='$xID' WHERE gradeid = '$TXTid'") or die(mysqli_error($db));
				$sql= "<b>Operation was Successful: Changes made<b>";
			}
			
			
			echo "
				<script language='javascript'>
					location.href='grades?sql=$sql'
				</script>
			";
		}
?>

<?php
	if ($pg == 7)
		{
			$TXTid = mysqli_real_escape_string($db, $_GET['id']);
			$select_content1=("select * from grades WHERE gradeid='$TXTid'");
			$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
			$content1 = mysqli_fetch_assoc($content_result1);
			$num_chk1 = mysqli_num_rows ($content_result1);
			
			}
?>

<?php
	if ($pg == 6)
	
		{
		
			$TXTid = mysqli_real_escape_string($db, $_GET['id']);
			mysqli_query($db, "delete from grades where gradeid = '$TXTid' ") or die(mysqli_error($db)) ;
			$sql = "Operation was Successful: 1 Item deleted";
			echo "
				<script language='javascript'>
					location.href='grades?sql=$sql'
				</script>
			";
		}
?>

<?php
	if($pg == 5){
		$n =0;
		echo $recsno = mysqli_real_escape_string($db, $_GET["recsno"]); exit;
		$data=trim($recsno); 
		$ex=explode(" ",$data); 
		$size=sizeof($ex); 
		for($i=0;$i<$size;$i++){ 
			$id=trim($ex[$i]); 
			if($id > 0){
				mysqli_query($db, "delete from grades where gradeid = '$TXTid' ") or die(mysqli_error($db)) ;
				$n++;
			}
		}
		if($n > 0){
			$sql = "Operation was Successful: ".$n." Item deleted";
		}
		else{
			$sql = "Operation failed";
		}
		echo "
			<script language='javascript'>
				location.href='grades?sql=$sql'
			</script>
		";
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
                            <h3>Grading System</h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right top_search">
                            	 <a href="dashboard" class="btn btn-sm btn-success"><i class="fa fa-home"></i>Dashboard</a>
                                  
                                  <a href="grades?pg=1" class="btn btn-sm btn-dark"><i class="fa fa-plus"></i> New Grades</a>
                                 <a href="grades" class="btn btn-sm btn-warning"><i class="fa fa-search"></i> View Grades</a>
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
							?> 			 <form method="post" action="?pg=8" name="frmReg" onSubmit="return loginCheck2()" enctype="multipart/form-data">
									<table class="form">
                                    	
										 <tr>
											<td>
												<label>From:</label>
											</td>
											<td>
												<input type="text" class="form-control" name="sn"/>
											</td>
										</tr>
										<tr>
											<td>
												<label>To:</label>
											</td>
											<td>
												<input type="text" class="form-control" name="on"/>
											</td>
										</tr>
										<tr>
											<td>
												<label>Grade:</label>
											</td>
											<td>
												<input type="text" class="form-control" name="grade" style="width:100px"/> Eg. A or B or C, etc.
											</td>
										</tr>
										<tr>
											<td>
												<label>
													Remark:</label>
											</td>
											<td>
												<input type="text" class="form-control" name="oc"/>
											   
											</td>
										</tr>
									  
										<tr>
											<td>
												<label>Affected School(s):</label>
											</td>
											<td valign="middle">
                                            <input type="button" value="Select All" name="btnsubmit" onClick="fnAll(this.form)" style="border:1px solid black">&nbsp;&nbsp;<input type="button" value="DeSelect All" name="btnsubmit" onClick="fnNotAll(this.form)" style="border:1px solid black"><br>
                                            <?php
												$select_content22=("select * from schools");
												$content_result22= mysqli_query($db, $select_content22) or die(mysqli_error($db));
												$content22 = mysqli_fetch_assoc($content_result22);
												$num_chk22 = mysqli_num_rows ($content_result22);
												if ($num_chk22 > 0){
													do { 
											?>
														<input style="border:0px" type="checkbox" name="school[]" value="<?php echo $content22['schoolid']?>"  /><?php echo $content22['school']?> &nbsp;&nbsp;&nbsp;&nbsp;
							<?php
														} while ($content22 = mysqli_fetch_assoc($content_result22)); 
												}
											?>
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
							?> 			 <form method="post" action="?pg=2" name="frmReg" onSubmit="return loginCheck()" enctype="multipart/form-data">
									<table class="form">
										 <tr>
											<td>
												<label>School</label>
											</td>
											<td>
												 <select name="schoolid" >
													  <option value="">--Select School</option>
													  <?php
															$select_content2=("select * from schools  order by school asc");
															$content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
															$content2 = mysqli_fetch_assoc($content_result2);
															$num_chk2 = mysqli_num_rows ($content_result2);
															$k = 0
														?>
													  <?php do { 	?>
													  <option value="<?php echo  $content2['schoolid']?>" <?php if($content2['schoolid'] == $content1['schoolid']){?> selected="selected" <?php } ?> ><?php echo  $content2['school']?></option>
													  <?php } while ($content2 = mysqli_fetch_assoc($content_result2)); ?>
													</select>
											</td>
										</tr>
										 <tr>
											<td>
												<label>From</label>
											</td>
											<td>
												<input type="hidden"  name="id" value="<?php echo $content1["gradeid"] ?>"/>
												<input type="text" class="form-control" name="lowv" value="<?php echo $content1["low"] ?>"/>
											</td>
										</tr>
										<tr>
											<td>
												<label>To</label>
											</td>
											<td>
												<input type="text" class="form-control" name="highv" value="<?php echo $content1["high"] ?>" />
											</td>
										</tr>
										<tr>
											<td>
												<label>Grade:</label>
											</td>
											<td>
												<input type="text" class="form-control" name="grade" value="<?php echo $content1["grade"] ?>" style="width:100px"/> Eg. A or B or C, etc.
											</td>
										</tr>
										 <tr>
											<td>
												<label>
													Remark</label>
											</td>
											<td>
												<input type="text"  name="oc" value="<?php echo $content1["remark"] ?>"/>
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
                            <form method="post" name="frmReg1" onsubmit="return deleteItems()">
                            	<!--<input  type="submit" class="btn btn-primary" value=" Delete Marked " />-->
                                <span style="font-family:Arial, Helvetica, sans-serif;font-size:11px;color:#FF0000"><?php echo $sql; ?></span>
                               
                                <table class="table table-striped responsive-utilities jambo_table" id="dataTables-example">
							<?php
										$select_content=("select * from grades g INNER JOIN schools s where g.schoolid=s.schoolid order by g.schoolid asc");
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
                                                    <!--<th>&nbsp;<input name="topcheckbox" id="topcheckbox" type="checkbox" value=""  onClick="selectall();"/>  <span style="color:#090; font-size:12px; font-weight:bold;">Select all</span></th>-->
                                                    <th>School</th>
													<th>Range</th>
													<th>Grade</th>
													<th>remark</th>
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
												<tr >
													<td><?php echo $k  ?></td>
                                                    <!--<td><input type="checkbox" value="<?php $content['gradeid'];?> " name="<?php echo $content1['gradeid'];?> "/></td>-->
                                                    <td><?php  echo $content ['school']?></td>
													<td><?php  echo $content['low']." - ". $content['high']?></td>
													<td><?php  echo $content ['grade']?></td>
													<td><?php  echo $content ['remark']?></td>
													<td width="5%"  style="font-weight:normal"><a href="grades?id=<?php echo ($content ['gradeid'])?>&pg=7" target="_parent" class="btn btn-dark"><i class="fa fa-edit"></i></a></td>                                                   
													<td width="8%" align="center"><a href="grades?id=<?php  echo ($content ['gradeid'])?>&pg=6" target="_parent" onClick="return confirmDel();" class="btn btn-danger"><i class="fa fa-close"></i></a> </td>
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
                            <!-- <table>
                                    <tr>
                                        <td colspan="8" > <input  type="submit" class="btn btn-primary" value=" Delete Marked " /> </td>
                                    </tr>
                                </table>-->
                            </div>
                        </div>
                    </div>
                </div>
                
                
              
                
 <!-- footer content -->
               <?php include("includes/footer.php")?>
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


<script language="javascript">
function loginCheck() {
if(document.frmReg.schoolid.value == "") {
alert ("Please select School")
document.frmReg.schoolid.focus();
return false
}
if(document.frmReg.sn.value == "") {
alert ("Please enter the range to start")
document.frmReg.sn.focus();
return false
}
if(document.frmReg.on.value == "") {
alert ("Please enter the range to stop")
document.frmReg.on.focus();
return false
}

if(document.frmReg.grade.value == "") {
alert ("Please enter the Grade")
document.frmReg.grade.focus();
return false
}
if(document.frmReg.oc.value == "") {
alert ("Please enter your remark")
document.frmReg.oc.focus();
return false
}

else {
return true
}

}
///////////////////////////////////////////////////////////////////
function loginCheck2() {
	var checkboxes="" 
	var recslen =  document.forms[0].length; 
	
	for(i=1;i<recslen;i++) 
	{ 
		if(document.forms[0].elements[i].checked==true) 
		checkboxes+= " " + document.forms[0].elements[i].name 
	} 
		
	if(document.frmReg.sn.value == "") {
		alert ("Please enter the range to start")
		document.frmReg.sn.focus();
		return false
	}
	if(document.frmReg.on.value == "") {
		alert ("Please enter the range to stop")
		document.frmReg.on.focus();
		return false
	}
	
	if(document.frmReg.grade.value == "") {
		alert ("Please enter the Grade")
		document.frmReg.grade.focus();
		return false
	}
	if(document.frmReg.oc.value == "") {
		alert ("Please enter your remark")
		document.frmReg.oc.focus();
		return false
	}
	if(checkboxes <= 0) {
		alert ("Please Select at least one School")
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
	if (confirm("Do you want to delete this item(s)?")) {
       return true;
    }	
	return false;
}

///////////////////////////////////////////////////
	function deleteItems() 
	{ 
		var recslen =  document.forms[0].length; 
		var checkboxes="" 
		
		for(i=1;i<recslen;i++) 
		{ 
			if(document.forms[0].elements[i].checked==true) 
			checkboxes+= " " + document.forms[0].elements[i].name 
		} 
		
		if(checkboxes.length>0){ 
			alert('k '+checkboxes);
			var con=confirm("Are you sure you want to delete this item(s)"); 
			if(con) 
			{ 
				document.frmReg1.action="grades?pg=5&recsno="+checkboxes
				document.frmReg1.method = "post";
				document.frmReg1.submit() 
			} 
			else return false
		} 
		else 
		{ 
			alert("No record is selected.") 
			return false
		} 
	} 

</script>