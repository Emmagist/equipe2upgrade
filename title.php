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
	if ($pg == 8)
		{
		
			$class  = $_POST['class'];
			$j = count($class);
			if(empty($j)){
				echo "<script language='javascript'>
				alert('Please enter Title name')
				</script> ";		
			}
			else{
			$xdate = date("Y-m-d");
			for($i = 0; $i < $j; $i++)
			{
				$class2 = mysqli_real_escape_string($db, $class[$i]);
				mysqli_query($db, "insert into title SET class = '$class2', xdate='$xdate', user='$xID' ") or die(mysqli_error($db));
				
			}
			$sql= "<b>Operation was Successful: Record Inserted<b>";


			echo "
					<script language='javascript'>
						location.href='title?sql=$sql'
					</script>
				";			
		}				
		}
?>

<?php
	if ($pg == 2)
	
		{
			$TXTid = mysqli_real_escape_string($db, $_POST['id']);
			$class  = mysqli_real_escape_string($db, $_POST['class']);
			mysqli_query($db, "UPDATE title SET class = '$class' WHERE id = '$TXTid'");
			$sql= "<b>Operation was Successful: Changes made<b>";
			echo "
				<script language='javascript'>
					location.href='title?sql=$sql'
				</script>
			";
		}
?>

<?php
	if ($pg == 6)
	
		{
		
			$TXTid = mysqli_real_escape_string($db, $_GET['id']);
			mysqli_query($db, "delete from title where id = '$TXTid' ") or die(mysqli_error($db)) ;
			$sql = "Operation was Successful: 1 Item deleted";
			header ("location:title?sql=$sql");
		}
?>

<?php
	if ($pg == 7)
		{
			$TXTid = mysqli_real_escape_string($db, $_GET['id']);
			$select_content1=("select * from title WHERE id='$TXTid'");
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
                            <h3>Titles' Information</h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right top_search">
                            	 <a href="dashboard" class="btn btn-sm btn-success"><i class="fa fa-home"></i>Dashboard</a>
                                  
                                  <a href="title?pg=1" class="btn btn-sm btn-dark"><i class="fa fa-plus"></i> Add Title</a>
                                 <a href="title" class="btn btn-sm btn-warning"><i class="fa fa-search"></i> View Title</a>
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
			?> 			 <form method="post" action="?pg=8" name="frmReg" onsubmit="return loginCheck()" >
                     <table class="form" id="addTitle">
                         <tr>
                            <td>
                                <label>No of Title</label>
                            </td>
                            <td>
								<select name="nos" id="nos" onchange="return mySearch()" class="form-control">
									<option value="">Select No of Title</option>
									<?php $n = 1;
									do{ ?>
									<option value="<?php echo $n; ?>"><?php echo $n; ?></option>
									<?php $n++; }while($n <= 10); ?>
                                </select>
                            </td>
                        </tr>                              


                        </table>
                        <table class="form">

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
                                <label>Title</label>
                            </td>
                            <td>
                            	<input type="text" class="mini" name="class" value="<?php echo $content1["class"] ?>"/>
                                <input type="hidden" class="mini" name="id" value="<?php echo $content1["id"] ?>"/>
                            </td>
                        </tr>
                         <tr>
                            <td>
                              
                            </td>
                            <td>
                                <input  type="submit" class="btn btn-blue" value="  Submit  " />
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
						$select_content=("select * from title order by id desc");
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
                        <th>Class name</th>
                        <th>Date Created</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
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
								<tr bgcolor="<?php echo $color ?>" height="23" onMouseOver="this.style.backgroundColor='#FFCC66';" onMouseOut="this.style.backgroundColor='';">
									<td><?php echo $k  ?></td>
									<td><?php  echo $content['class']?></td>
									<td><?php  echo ucfirst($content ['xdate'])?></td>
									
													<td width="5%"  style="font-weight:normal"><a href="title?id=<?php echo ($content ['id'])?>&pg=7" target="_parent" class="btn btn-dark"><i class="fa fa-edit"></i></a></td>                                                   <td width="8%" align="center"><a href="title?id=<?php  echo ($content ['id'])?>&pg=6" target="_parent" onClick="return confirmDel();"  class="btn btn-danger"><i class="fa fa-close"></i></a> </td>
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

if(document.frmReg.class.value == "") {
alert ("Please enter Title name")
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

<script language="JavaScript" type="text/javascript">
//#################################################################################################
function mySearch(){
	//declaare a variable that collects the value in the select button
	var nos = $('#nos').val();

	//checks if the variable is empty

	mypath='mode=title&nos='+nos;
			$.ajax({
			type:'POST',
			url:'<?php echo SITEURL; ?>/backend/loaddata.php',
			data:mypath,
			cache:false,
			success:function(resps){
			$('#addTitle').append(resps);
			return false;
		}
	});
	return false;
}
//########################################################################################################
</script>