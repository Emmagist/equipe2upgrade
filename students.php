<?php 
	require_once("includes/session.php");
	confirm_logged_in(); 
    require_once ('../connection.php');
	$xID = $_SESSION["ustcode"];
?>
<?php
	$pg = $_GET['pg'];
	$pv = $_GET['pv'];
	$sql = $_GET['sql'];
	
	$studentsno = 0;
	$select_content1=("select * from team order by id asc limit 1");
	$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
	$content1 = mysqli_fetch_assoc($content_result1);
	
	$select_content=("select * from students");
	$content_result= mysqli_query($db, $select_content) or die(mysqli_error($db));
	$content = mysqli_fetch_assoc($content_result);
	$num_chk = mysqli_num_rows ($content_result);
	
	if($content1["nos"] <= $num_chk){
		$studentsno = 2;
    }
    

	
	include("header.php");
?>

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Students Record</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right top_search">
                        <a href="index?action=home" class="btn btn-sm btn-success">Dashboard</a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" >
                    <div class="x_content">
                        <span style="font-family:Arial, Helvetica, sans-serif;font-size:11px;color:#FF0000">
                        <?php echo $sql; ?></span>
                        <table class="table table-striped responsive-utilities jambo_table" id="example">
			            <?php
                        if(!empty($_GET['s'])){
						     $select_content=sprintf("select * from students s INNER JOIN classes c ON s.class = c.id INNER JOIN groups g ON s.group_id = g.gid INNER JOIN studenttype st ON s.type = st.tid where s.class='%d' and s.group_id='%d' and s.status != '7' and s.status != '9' order by surname asc", $_GET['refno'],$_GET['g']);
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
									<th align="center">Passport</th>
                                    <th align="center">Reg Number</th>
									<th align="center">Student Name</th>
									<th align="center">Class</th>
                                    <th align="center">Group</th>
                                    <th align="center">Gender</th>
                                    <th align="center">Birthdate</th>
                                    <th align="center">Type</th>
                                    
							  </tr>
								</thead>
								<tbody>
                            <?php do { 
                            $k = $k + 1;
                            ?>
								<tr>
									<td align="center">
									<?php if($content["passport"] == ""){ ?>
                                       <img src="<?php echo SITEURL; ?>backend/uploads/studentpassport/student.jpg" height="40px" width="40px" style="border-radius:7px; box-shadow:2px 1px 2px 2px #CCCCCC;"/>
                                    <?php
                                    }else{
                                    ?>
                                         <img src="<?php echo SITEURL; ?>backend/uploads/studentpassport/<?php echo $content["passport"] ?>" height="40px" width="40px" style="border-radius:7px; box-shadow:2px 1px 2px 2px #CCCCCC;"/>
                                    <?php
                                    }
                                    ?>
                                    </td>
                                    <td align="center"><?php  echo ucfirst($content ['regno'])?></td>
									<td align="left"><?php  echo $content['surname']." ". $content['othername']?></td>
									<td align="center"><?php  echo ucfirst($content ['class'])?></td>
                                    <td align="center"><?php  echo ucfirst($content ['groupname'])?></td>
                                    <td align="center"><?php  echo ucfirst($content ['sex'])?></td>
                                    <td align="center"><?php  echo ucfirst($content ['dateofbirth'])?></td>
                                    <td align="center"><?php echo $content ['stype'] ;?></td>
                                    
								</tr>
						 <?php } while ($content = mysqli_fetch_assoc($content_result)); ?>
                         </tbody>
                        <?php 
                            }
                            }
                            else{
                                echo "Invalid Access";
                            }
                        ?>
                       
                        
                        </table>
            
                    
                </div>
            </div>
        </div>
    </div>
                
    <br />  <br />        
                
 <!-- footer content -->
 <?php include("includes/footer.php")?>

