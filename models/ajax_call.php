<?php 
session_start();
require_once("../connection.php"); 

if($_POST["mode"]=="daily_report_search"){
	$rdate = date("Y-m-d", strtotime($_POST["rdate"]));
	$studentid = mysqli_real_escape_string($db, $_POST["studentid"]);
	$select_content2=sprintf("select * from daily_report where student_id='%d' and rdate='%s'",
	$studentid, $rdate); 
	$content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
	$content2 = mysqli_fetch_assoc($content_result2);
	$num_chk2 = mysqli_num_rows ($content_result2);
	$retArr = array();
	if($num_chk2 > 0){
		$retArr["status"] = 1;
		$retArr["report_id"] = $content2["report_id"];
		$retArr["rdate"] = $rdate;
		$retArr["studentid"] = $studentid;
	}
	else{
		$retArr["status"] = 0;
	}
    echo json_encode($retArr);
    exit;
}

if($_POST["mode"]=="daily_report"){
	$rdate = date("Y-m-d", strtotime($_POST["rdate"]));
	$studentid = mysqli_real_escape_string($db, $_POST["studentid"]);
	$point = mysqli_real_escape_string($db, $_POST["point"]);
	$class = mysqli_real_escape_string($db, $_POST["class"]);
	$group = mysqli_real_escape_string($db, $_POST["group"]);
	$reportids = $_POST["reportid"];
	$questions = $_POST["question"];
    $bno = count($reportids); 
	$retArr = array();
	$retArr["classid"] = $class;
	$retArr["groupid"] = $group;
	if($bno > 0){
		for($i=0; $i < $bno; $i++){
			$reportid = mysqli_real_escape_string($db, $reportids[$i]);
			$question = mysqli_real_escape_string($db, $questions[$i]);
			$select_content2=sprintf("select * from daily_report where student_id='%d' and rdate='%s' and report_cat='%d'",
			$studentid, $rdate, $reportid); 
			$content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
			$content2 = mysqli_fetch_assoc($content_result2);
			$num_chk2 = mysqli_num_rows ($content_result2);
			if($num_chk2 > 0){
                mysqli_query($db, sprintf("update daily_report SET student_id='%d', rdate='%s', report_cat='%d', report='%s',  user='%d' where report_id ='%d'",$studentid, $rdate, $reportid, $question,  $_SESSION["teacherlog"], $content2["report_id"])) or die(mysqli_error($db));
                $retArr["status"] = 2;
			}
			else{
				$retArr["status"] = 1;
				mysqli_query($db, sprintf("INSERT INTO daily_report SET classid='%s', groupid='%s', student_id='%d', rdate='%s', report_cat='%d', report='%s',   user='%d'", $class, $group, $studentid, $rdate, $reportid, $question, $_SESSION["teacherlog"])) or die(mysqli_error($db));
				$report = "Report updated successfully!";
			}
		}
	}
	else{
        $retArr["status"] = 0;
		$report = "Report NOT save!";
	}
	echo json_encode($retArr);
}


if($_POST["mode"]=="daily_reportlist"){
	$rdate = mysqli_real_escape_string($db, $_POST["rdate"]);
	$class = mysqli_real_escape_string($db, $_POST["class"]);
	$group = mysqli_real_escape_string($db, $_POST["group"]);
	$select_content = sprintf("select * from students where class='%d' and group_id='%d'",
	$class, $group);
	$content_result= mysqli_query($db, $select_content) or die(mysqli_error($db));
	$content = mysqli_fetch_assoc($content_result);
	$num_chk = mysqli_num_rows ($content_result);
	$k = 0;
	if($num_chk == 0){
?>
	<tr height="23" onMouseOver="this.style.backgroundColor='#FFCC66';" onMouseOut="this.style.backgroundColor='';" bgcolor="#EFEFEF">
		<td colspan="5"  align="center">No Record Found</td>
	</tr>	
<?php
	}
	else {
		do { 
			$studentid = $content['stid'];
			$select_content2=sprintf("select * from daily_report where student_id='%d' and rdate='%s'",
			$studentid, $rdate); 
			$content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
			$content2 = mysqli_fetch_assoc($content_result2);
			$num_chk2 = mysqli_num_rows ($content_result2);
?>
		<tr>
			<td align="center"><?php echo ucfirst($content ['regno'])?></td>
			<td align="left"><?php echo $content['surname']." ". $content['othername']?></td>
			<td align="center"><?php if($num_chk2 > 0){ echo $content2['report'];} else{ echo "No Report";} ?></td>
			<td align="center"><?php  echo $content2['rdate']?></td>
			<td width="8%" align="center"> 
				<?php if($num_chk2 > 0){ ?>
					<a href="daily-report-edit?d=<?php echo $rdate ?>&r=<?php echo $content2['report_id'] ?>&id=<?php echo $studentid ?>" class="btn btn-primary btn-sm"><i class="fa fa-file"></i></a> 
				<?php } ?>
			</td>
		</tr>
	<?php 
		} while ($content = mysqli_fetch_assoc($content_result)); 
	}
}
?>
