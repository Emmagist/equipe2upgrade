<?php 
	require_once("includes/session.php");
	confirm_logged_in(); 
	$xID = $_SESSION["ustcode"];
?>


<?php
	if ($pg == "")
	{
		$select_content4=("select * from schsession where sid ='$yeardb'");
		$content_result4= mysqli_query($db, $select_content4) or die(mysqli_error($db));
		$content4 = mysqli_fetch_assoc($content_result4);
		
		$select_contents=("select * from school");
		$content_results= mysqli_query($db, $select_contents) or die(mysqli_error($db));
		$contents = mysqli_fetch_assoc($content_results);
?>
			<table width="100%">
                <tr>
                    <td align="right" width="200px"><img src="<?php echo SITEURL; ?>/backend/logos/<?php echo $contents["logo"] ?>" width="200" height="200"></td>
                    <td  align="left" style="padding-left:30px"> <h1><?php echo $contents["sname"] ?></h1>
                    	<?php echo $contents["address"] ?>
                    </td>
                </tr>
                
            </table>
            <table border="1" cellspacing="0" width="100%">
								
			
			
			<?php
						$select_content=("select * from staff_records where status!='1' order by surname desc");
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
									<th align="center">S/N</th>
									<th align="center">Staff Name</th>
                                    <th align="center">Username</th>
                                    <th align="center">Password</th>
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
							$TXTid  = $content ['class'];
							$select_content1=("select * from title WHERE id='$TXTid'");
								$content_result1= mysqli_query($db, $select_content1) or die(mysqli_error($db));
								$content1 = mysqli_fetch_assoc($content_result1);
								$num_chk1 = mysqli_num_rows ($content_result1);
						?>
								<tr>
									<td align="center">
									<?php echo $k; ?></td>
									<td align="left"><?php  echo strtoupper($content['surname']." ". $content['othername']);?></td>
                                    <td align="left"><?php  echo $content ['username']?></td>
                                    <td align="left"><?php  echo 'password'?></td>
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
                           
<footer > 
    <div class="">
        <p class="pull-right">Designed by <a href="http://noraktech.com" target="_blank" style="color:#003366; font-weight:bold">Norak Technologies Limited. | 
             <img src="images/norak-logo.png" /> </a> 
        </p>
    </div>
    <div class="clearfix"></div>
</footer>

               <!-- /footer content -->
            </div>
            <!-- /page content -->

        </div>

    </div>


</body>

</html>


			   
