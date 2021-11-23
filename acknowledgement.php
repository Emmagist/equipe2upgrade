<?php require_once("includes/session.php"); ?>
<?php confirm_logged_in(); ?>
<?php require_once ('../connection.php');
	$quiz_ID=mysqli_real_escape_string($db, $_GET["id"]);
	$classv=mysqli_real_escape_string($db, $_GET["refno"]);
	$group_id=mysqli_real_escape_string($db, $_GET["g"]);
	$subject_id=mysqli_real_escape_string($db, $_GET["s"]);	
	$term=mysqli_real_escape_string($db, $_GET["t"]);
	$yr=mysqli_real_escape_string($db, $_GET["y"]);	
	$stid = mysqli_real_escape_string($db, $_GET["sid"]);

	$select_contents=("select * from school");
	$content_results= mysqli_query($db, $select_contents) or die(mysqli_error($db));
	$contents = mysqli_fetch_assoc($content_results);

	date_default_timezone_set('Africa/Lagos');
	//#####################################################################	
	$cur_date = date("Y-m-d");
	//##########################################################
	
	$select_content22=("select subject from subjects where sid= '$subject_id'");
	$content_result22= mysqli_query($db, $select_content22) or die(mysqli_error($db));
	$content22 = mysqli_fetch_assoc($content_result22);
	$subject = $content22['subject'];	
	
	$select_content21=("select class from classes where id= '$classv'");
	$content_result21= mysqli_query($db, $select_content21) or die(mysqli_error($db));
	$content21 = mysqli_fetch_assoc($content_result21);
	$class = $content21['class'];
	
	$select_content24=("select * from pans where userid= '$stid' and subject_id='$subject_id' and term_id='$term' and sessionid='$yr'");
	$content_result24= mysqli_query($db, $select_content24) or die(mysqli_error($db));
	$content24 = mysqli_fetch_assoc($content_result24);
	$qu = mysqli_num_rows($content_result24);	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Acknowledgement Slip: Acadasuite</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="../css/bootswatch.min.css">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../bower_components/html5shiv/dist/html5shiv.js"></script>
      <script src="../bower_components/respond/dest/respond.min.js"></script>
    <![endif]-->
    <script>

     var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-23019901-1']);
      _gaq.push(['_setDomainName', "bootswatch.com"]);
        _gaq.push(['_setAllowLinker', true]);
      _gaq.push(['_trackPageview']);

     (function() {
       var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
       ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
       var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
     })();

    </script>
    <style>
	#ques	{ 
		border-radius:7px;
		-o-border-radius:7px;
		-ms-border-radius:7px;
		-webkit-border-radius:7px;
		-moz-border-radius:7px;
	}
	#ques2	{ 
		border-radius:12px;
		-o-border-radius:12px;
		-ms-border-radius:12px;
		-webkit-border-radius:12px;
		-moz-border-radius:12px;
		padding-bottom:0px;  
		box-shadow:3px 3px 3px 3px  #2A3F54;
		
	}	
	
	#ques1	{
		width:30px; 
		height:30px; 
		margin:2px 0px;
		}
	#ttt	{ 
		border-radius:10px;
		-o-border-radius:10px;
		-ms-border-radius:10px;
		-webkit-border-radius:10px;
		-moz-border-radius:10px;
		background:#2A3F54;
	}
	#ttt1	{
		width:600px;  
		margin:2px 0px;
		}			

	img.center {
		display: block;
		margin-left: auto;
		margin-right: auto;
	}
	</style>
  </head>
  <body >
  <div style="border-top:3px solid rgba(0,0,51,1);">
       <div class="container">

            <!-- begin of row-->
      <div class="row" id="ques2"><!-- end of row -->
     
             <table width="100%" align="center" id="ttt">
                <tr>
                     <td width="15%" align="left" style="padding-left:2px;"><div id="photos"><img src="../backend/logos/<?php echo $contents["logo"] ?>" width="100px" height="60px" style="border-radius:7px; box-shadow:2px 2px 1px 1px #CCCCCC;"></div></td>
                    <td width="57%" align="center" style="color:#FFF"> <h1 style="color:#FFF"><?php echo $contents["sname"] ?></h1><?php echo $contents["address"] ?><br /><?php echo $contents["phone"] ?></td>
                    <td width="10%" align="right" style="padding-right:5px"><div id="photos"><?php if($_SESSION["passport"] !=""){ ?><img src="../backend/uploads/studentpassport/<?php echo $_SESSION["passport"]?>" width="80px" height="80px" style="border-radius:7px; box-shadow:2px 1px 2px 2px #CCCCCC;"> <?php } else{ ?><img src="../backend/uploads/studentpassport/student.jpg" width="200px" height="150px" style="border-radius:7px; box-shadow:2px 1px 2px 2px #CCCCCC;">  <?php }?> </div></td>
                 </tr>
                
            </table>
			<?php         
				$select_content2=("select SUM(point) AS score, testID, xdate from pans where userid= '$stid' and subject_id='$subject_id' and term_id='$term' and sessionid='$yr' order by aid asc");
				$content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
				$content2 = mysqli_fetch_assoc($content_result2);
				$dates = $content2["xdate"];
				$score = $content2["score"];
				$testID = $content2["testID"];
				
				$select_content32=("select * from quiz_result where sid= '$stid' and classid='$classv' and testID='$testID'");
				$content_result32= mysqli_query($db, $select_content32) or die(mysqli_error($db));
				$numchk32 = mysqli_num_rows($content_result32);
				if($numchk32 == 0){
					mysqli_query($db, "insert into quiz_result set classid='$classv', testID='".$_SESSION["quiz_id"]."',sid='$stid', score='$score', date_written='$dates',sub_id='$subject_id',total_question='$qu'") or trigger_error(mysqli_error().'; ERROR');
				}
            ?>            
             <img src="../backend/logos/<?php echo $contents["logo"] ?>" class="center" style="z-index:-1000; top:200px; position:absolute; width:300px; height:300px; left:400px; opacity:0.2; filter:alpha(opacity=12);"> 
           <table width="100%" style="color:rgba(0,0,102,1);" >  	
             
             <tr>
               <td colspan="3" align="center"><h3><?php echo $_SESSION["fullname"].' ('.$class.')'; ?> </h3><font color="#FF0000">Test ID: <?php echo $testID; ?></font></td>
             </tr>
             <tr>
			<?php         
                ///////////////////////////////////////////
				$select_content41=("select term, sesion from pans p INNER JOIN subjects t ON p.term_id=t.tid INNER JOIN schsession s ON p.sessionid=s.sid where p.userid= '$stid' and p.subject_id='$subject_id' and p.testID='$testID'");
				$content_result41= mysqli_query($db, $select_content41) or die(mysqli_error($db));
				$content41 = mysqli_fetch_assoc($content_result41);
            ?>           
           	<td colspan="3" align="center"> You have successfully completed the online assessment test on <strong><?php echo ucwords($subject); ?></strong> for <?php echo $content41['term'];?> Term <?php echo $content41['sesion'];?> Academic Session and graded with a non-degree grading point</td>
        	</tr>

            <tr>
            <td colspan="3" align="center">
         		<h4><?php echo "Total Score "; echo $score."%" ;?>
			<style>
				#progress-container{
					background:#f00; /* default background */
					width: 100%;
					overflow: hidden; /* fit to the height of span */
				}
				#progress-container span {
					display: block;   /* to enable width and height for this element */
					background: #6f0;
					height: 10px;
					width: <?php echo $score."%" ?>;
				}
            
            </style>
				<?php
                    if($score < 50){
                ?>
                        (<span style="font-size:12px; color:#FF0000"> <?php echo "FAIL";?> </span>)
                <?php
                    }
                    else {
                ?>
                        (<span style="font-size:12px; color:#003399"> <?php echo "PASS";?> </span>)
                <?php
                    }
                ?>	
                </h4>	
              </td>
         </tr>
         </table>
         
         <table width="80%" align="center">
         <tr>
          <td colspan="3" align="center" valign="middle">
          	<div id="progress-container" style="text-align:right">
			  <span style="height:20px; color:#FFF; font-weight:bold"><?php echo $score.'%'; ?></span>
			</div>
                   <table width="100%">
                   <tr>
						<td  width="49%" style="color:#F00; font-weight:bold"> 0% </td>
						<td  width="11%" style="color:#0C6; font-weight:bold">50% </td>
						<td  width="40%" align="right" style="color:#6f0; font-weight:bold">100% </td>
					</tr>
                   </table>
            </td>
         </tr>
         <tr>
           <td colspan="3" align="right">&nbsp;</td>
         </tr>  
         <tr>
         	<td colspan="2">
            	<table width="100%" align="center" border="0"> 
         			<thead>
                    	<th>&nbsp;S/N</th>
                        <th>&nbsp;Questions</th>
                        <th colspan="2">&nbsp;Answers</th>
                        <th colspan="2">&nbsp;Answered</th>
                        <th>&nbsp;Point</th>
                    </thead>
          			<tbody>    
						<?php         
                            ///////////////////////////////////////////
							$select_content2=("select * from pans where userid= '$stid' and subject_id='$subject_id' and term_id='$term' and sessionid='$yr' order by aid asc");
							$content_result2= mysqli_query($db, $select_content2) or die(mysqli_error($db));
							$content2 = mysqli_fetch_assoc($content_result2);
							$dates = $content2["xdate"];
							$q =1;
							$status = false;
							do { 
								$qid = $content2["qid"];
								$ans = $content2["ans"];
								$student_ans = $content2["student_ans"];
								if($ans == $student_ans){
									$ans1 = $ans. 2;
									$select_content12=("select question,que,{$ans},{$ans1} from quiz_question where id='$qid'");
									$status = true;
								}
								else{
									$ans1 = $ans. 2;
									$student_ans1 = $student_ans. 2;
									if($student_ans !=''){
										$select_content12=("select question,que,{$ans},{$ans1},{$student_ans},{$student_ans1} from quiz_question where id='$qid'");
									}
									else{
										$select_content12=("select question,que,{$ans},{$ans1} from quiz_question where id='$qid'");
									}
									
									$status = false;
								}
								$content_result12= mysqli_query($db, $select_content12) or die(mysqli_error($db));
								$content12 = mysqli_fetch_assoc($content_result12);
								$question = $content12["question"];	
                        ?>
                      <tr>
                        <td align="center">
                        	<table id="ques1">
                            	<tr>
                      				<td id="ques" style="background:#ccc; text-align:center"><?php echo $q; $q++;?></td>
                     			</tr> 
         					</table>
         				</td>
          				<td>&nbsp;<?php echo $question; if($content12["que"] !=''){?>
                        	<div id="photos" style="padding-bottom:3px"> <img src="../backend/questions/<?php echo $content12["que"] ?>" height="200px" width="200px" style="border-radius:7px; box-shadow:2px 1px 2px 2px #CCCCCC;"/> </div><?php } ?>
                        </td> 
           				<td align="center">
                        	<table id="ques1">
                            	<tr>
           							<td id="ques" style="background:#6f0; text-align:center; color:#FFF">
										<?php echo $content2['ans'] ?>
                                    </td>
                                </tr> 
                            </table>
         				</td>
         				<td>&nbsp;<?php echo $content12[$ans] ?></td>
           				<td align="center">
                        	<table id="ques1">
                        		<tr>
           							<td id="ques"<?php if($content2['ans']==$content2['student_ans']){?> style="background:#6F0; text-align:center; color:#FFF" <?php } else{?> style="background:#F00; text-align:center; color:#FFF"<?php } ?>>
										<?php echo $content2['student_ans'] ?>
                                     </td>
         						</tr> 
         					</table>
         				</td>
         				<td>&nbsp;<?php if($status == true){ echo $content12[$ans]; } else { echo $content12[$student_ans]; }?>
                        </td>
           				<td align="center">
                        	<table id="ques1">
                            	<tr>
           							<td id="ques" style="background:#ccc; text-align:center">
										<?php echo $content2['point'].'%' ?>
                                    </td>
            					</tr> 
         					</table>
        				 </td>
         			</tr>
   				<?php
					}
					while ($content2 = mysqli_fetch_assoc($content_result2));
				?>
				</table >
              </td>
              <td>&nbsp;</td>
         </tr>        
         
         <tr>
           <td colspan="3" align="right">&nbsp;</td>
         </tr>  
        </tbody>
    </table>

                    
   	<table width="100%" align="center" id="ttt">
    	<tr>
        	<td  colspan="2" align="left" style="padding-left:15px; color:#FFF">
            	Powered By: <a href="http://noraktech.com" target="_blank" style="color:#FFF">Norak Technologies Limited</a>
            </td> 
            <td align="right" style=" color:#FFF; padding-right:15px" ><b>Date Taken: </b><?php echo $dates; ?></td>
        </tr>
    </table>
    <div style="min-height:1px"></div>
	
    </div>
    
  </div>
  	<p align="center" style="padding-top:20px"><a href="dashboard">Go Back to Home</a> </p>
    <script src="js/bootstrap.min.js"></script>
    <script src="ajax/myscript.js"></script>
    </div>
  </body>
  
</html>
