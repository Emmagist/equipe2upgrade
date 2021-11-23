<?php require_once("includes/session.php"); ?>
<?php confirm_logged_in(); ?>
<?php
$xID = $_SESSION["ustcode"];

$select_user=("select * from systemusers where id = '$xID'");
$user_result= mysqli_query($db, $select_user) or die(mysqli_error($db));
$user = mysqli_fetch_assoc($user_result);
$user_rows= mysqli_num_rows($user_result);
$xEmail = $user['email'];
$xPassword = $user['password'];
$userID = $user['id'];

?>
<?php
	$pg = mysqli_real_escape_string($db, $_GET['pg']);
	$pv = mysqli_real_escape_string($db, $_GET['pv']);
	$sql = mysqli_real_escape_string($db, $_GET['sql']);
?>

<?php

	if ($pg == 2)
		{	
			$txtpassword =mysqli_real_escape_string($db, $_POST['txtpass']);
			$txtoldpassword = md5(mysqli_real_escape_string($db, $_POST['txtoldpass']));
			$txtnewpassword = md5(mysqli_real_escape_string($db, $_POST['txtnewpass']));
			
			if ($txtpassword != $txtoldpassword)
			
				{
					$sql = "<b>Operation Aborted: Password Match Failed<b>";
					echo "
						<script language='javascript'>
							location.href='changepass.php?sql=$sql'
						</script>
					";
				}
			else
				{
						
				
					mysqli_query($db, "UPDATE systemusers SET password= '$txtnewpassword' WHERE id = '$userID'");
					$sql= "<b>Operation was Successful: Password changed<b>";
					echo "
						<script language='javascript'>
							location.href='changepass.php?sql=$sql'
						</script>
					";
			}
		}
?>

<?php include("header.php");?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Change Password</h3>
            </div>

            <div class="title_right">
                <div class="col-md-7 col-sm-7 col-xs-12 form-group pull-right top_search">
                     <a href="dashboard" class="btn btn-sm btn-success">Dashboard</a>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" >
<?php

	if ($pg == "")
	
			{

?>
				<span style="font-family:Arial, Helvetica, sans-serif;font-size:11px;color:#FF0000"><?php echo $sql; ?></span>
			<form action="changepass.php?pg=2" name="frmReg" method="post" onSubmit="return loginCheck(this);" ID="Form1">
			
        	<table style="border:0px solid" cellspacing="0" cellpadding="3" width="100%">
			    
				<tr>
					<td ><b>Old Password</b></td>
					<td >
                        <input type="hidden" name="txtpass"  value="<?php echo $xPassword ?>">
                        <input type="password" name="txtoldpass" class="form-control">
                    </td>
				</tr>
                <tr>
                	<td ><b>New Password</b></td>
					<td >					   						
                   		 <input type="password"class="form-control"  name="txtnewpass" >
                    </td>

                </tr>
                <tr>
                	<td ><b>Confirm Password</b></td>
					<td >					   						
                   		 <input type="password" class="form-control"  name="txtnewpass2" >
                    </td>

                </tr>                
                <tr>
					<td height="3" colspan="2"></td>
				</tr>
				<tr>
					<td colspan="2">						
							<input type="submit" value="Change Password" class="btn btn-primary">
					</td>
				</tr>
             </table>
		</form>
 <?php
 }
 ?>
</table>
		</div>
	</div>
   </div>
 </div>
<?php include("includes/footer.php") ?>

<script language="javascript">
function loginCheck() {

if(document.frmReg.txtoldpass.value == "") {
alert ("Please Enter old Password")
document.frmReg.txtoldpass.focus();
return false
}
else if(document.frmReg.txtnewpass.value == "") {
alert ("Please Enter New Password to change")
document.frmReg.txtnewpass.focus();
return false
}
else if(document.frmReg.txtnewpass.value != document.frmReg.txtnewpass2.value) {
alert ("Password not match")
document.frmReg.txtnewpass.focus();
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