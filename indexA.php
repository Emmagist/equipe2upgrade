<?php
//N;/path
require_once("includes/session.php"); 
require_once('includes/connection.php'); 
?>

<?php
	$user = trim($_POST['user']);
	$staffID = trim($_POST['password']);
	$passkey = password_hash($staffID, PASSWORD_DEFAULT);
		
	$select_user=("select * from systemusers where username = '$user'");//var_dump($select_user);exit;
	$user_result= mysqli_query($db, $select_user) or die(mysqli_error($db));//var_dump($user_result);exit;
	// $user_result = mysqli_query($db, $select_user); //var_dump($user_result);exit;
	$user = mysqli_fetch_assoc($user_result);//var_dump($user);exit;
	$user_rows= mysqli_num_rows($user_result);//var_dump($user_rows);exit;
	$status = $user ['status'];
	if ($user_rows > 0 and $status == 0)
	{
		$_SESSION["ustcode"] = $user['id'];
		$_SESSION["user"] = $user['entity_guid'];
		$_SESSION['admin']= $user['id'];
		$_SESSION["username"] = $user ['userName'];
		
		echo "
			<script language='javascript'>
				location.href='home1';
			</script>
		";
		
	}
	else {	
		echo "
			<script language='javascript'>
				location.href='index?log=$acct_type&pg=1';
			</script>
		";
	}
	
?>