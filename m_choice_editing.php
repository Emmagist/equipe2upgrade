<?php 
   ini_set('display_errors',0); 
   require_once("includes/session.php"); 
   confirm_logged_in();
   require_once ('../connection.php');
   include("header.php"); 
?>

<!-- include summernote -->
<link rel="stylesheet" href="../editor/dist/summernote-bs4.css">
<script type="text/javascript" src="../editor/dist/summernote-bs4.js"></script>

<!-- KaTeX -->
<link href="../editor/dist/katex.min.css" rel="stylesheet">
<script src="../editor/dist/katex.min.js"></script>

<script src="../editor/summernote-math.js"></script>
<!--<link href="../summernote-math.css" rel="stylesheet">-->
<script type="text/javascript">
    $(document).ready(function() {
      $('.summernote').summernote({
        height: 200,
        tabsize: 2,
		placeholder: 'Type here',
		
		callbacks: {
            onImageUpload: function(files, editor, welEditable) {
                sendFile(files[0], editor, welEditable);
			},
			// onMediaDelete : function($target, editor, $editable) {
			// 	alert($target.context.dataset.filename);         
			// 	$target.remove();
			// }
			onMediaDelete : function(target) {
                // alert(target[0].src) 
                deleteFile(target[0].src);
            }
		}

	  });
	  
	  function deleteFile(src) {
		$.ajax({
			data:{src : src, pg:2},
			type: "POST",
			url: "../editor/saveimage.php", // replace with your url
			cache: false,
			success: function(resp) {
				alert(resp);
			}
		});
	}

    });
</script>
<style>
   .mb-3{
      margin-bottom: 20px;
   }
</style>

<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>Multiple Choice Question</h3>
		</div>

		<div class="title_right">
			<div class="col-md-7 col-sm-7 col-xs-12 form-group pull-right top_search">
				<a href="index" class="btn btn-sm btn-success"><i class="fa fa-home"></i> Dashboard</a>
				<a href="exam-setting?pg=7" class="btn btn-primary ">View Exam</a>
                <a href="question-view?pg=11&action=view_question" class="btn btn-warning">View Questions</a>                            
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="row">
		
		<div class="x_panel">
			<div class="x_title font-weight-bold">
				<h4><strong>Question</h4>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
   				<?php
					if(isset($_GET["id"]) and $_GET["pg"]== 3)
					{
						$TXTid = mysqli_real_escape_string($db, $_GET['id']);
						$select_content12= sprintf("select * from  quiz_question WHERE id='%d'", $TXTid);
						$content_result12= mysqli_query($db, $select_content12) or die(mysqli_error($db));
						$content12 = mysqli_fetch_assoc($content_result12);
					}
				?>
				<form class="form-horizontal" action="?pg=2" method="post" id="Form1" onsubmit="return updateQuestion()" enctype="multipart/form-data">
					<input name="quiz_id" type="hidden" value="<?php echo $TXTid ?>"/>
					<!-- <div class="alert alert-info">Setup Multiple Choice Question</div> -->
					<!-- <h4>Question</h4> -->
					<div style="margin-bottom: 50px;">
						<div class="form-group">
							<label class="control-label" for="course"><b>Question</b></label>
							<div class="controls">
								<textarea name="question" class="summernote"><?php echo $content12['question'] ?></textarea >
								<!-- <textarea class="form-control" name="question" id="question" ></textarea>		 -->
							</div>
						</div>
						<div class="form-group">
							<label class="control-label" for="course"><b>One or Multiple Answers</b></label>
							<div class="controls">
								<select class="form-control" name="quiz_type" id="ans" class="success">
				<option value="3" <?php if($content12['question_type'] == 3){ ?>selected <?php } ?>>One Answer Only</option>
									<option value="4" <?php if($content12['question_type'] == 4){ ?>selected <?php } ?>>Multiple Answers</option>
								</select>
							</div>
						</div>
					</div>

					<div class="x_title font-weight-bold" style="margin-bottom: 30px;">
						<h4><strong>Create Answers</h4>
						<div class="clearfix"></div>
					</div>
					
					<ul class="list-group">
						<li class="list-group-item mb-3">
							<div class="form-group">
								<label class="control-label" for="course"><b>Option A</b></label>
								<div class="controls">
									<input class="form-control" name="a" type="text" id="a"  value="<?php echo $content12['A'] ?>"  /> 
									
							</div>
							</div>
							<div class="controls">
								<select class="form-control" name="a-grade" id="ans" class="success">
									<option value="0">--Grade--</option>
									<?php 
									for($x=100;$x >=0;$x-=5){
										$x = ($x == 0) ? 1 : $x;
										?>
										<option value="<?php echo $x; ?>" <?php if($content12['a_grade'] == $x){ ?>selected <?php } ?>><?php echo $x."%"; ?></option>
										<?php
									}
									?>
								</select>
							</div>
						</li>
						<li class="list-group-item mb-3">
							<div class="form-group">
								<label class="control-label" for="course"><b>Option B</b></label>
								<div class="controls">
									<input class="form-control" name="b" type="text" id="b"  value="<?php echo $content12['B'] ?>"   />   
								</div>
							</div>
							<div class="controls">
										<select class="form-control" name="b-grade" id="ans" class="success">
											<option value="0">--Grade--</option>
											<?php 
											for($x=100;$x >=0;$x-=5){
												$x = ($x == 0) ? 1 : $x;
												?>
												
												<option value="<?php echo $x; ?>" <?php if($content12['b_grade'] == $x){ ?>selected <?php } ?>><?php echo $x."%"; ?></option>
												<?php
											}
											?>
										</select>
									</div>
						</li>
						<li class="list-group-item mb-3">
							<div class="form-group">
								<label class="control-label" for="course"><b>Option C</b></label>
								<div class="controls">
									<input class="form-control" name="c" type="text" id="c"  value="<?php echo $content12['C'] ?>"   />
								</div>
							</div>
							<div class="controls">
										<select class="form-control" name="c-grade" id="ans" class="success">
											<option value="A">--Grade--</option>
											<?php 
											for($x=100;$x >=0;$x-=5){
												$x = ($x == 0) ? 1 : $x;
												?>
												<option value="<?php echo $x; ?>"<?php if($content12['c_grade'] == $x){ ?>selected <?php } ?>><?php echo $x."%"; ?></option>
												<?php
											}
											?>
										</select>
									</div> 
						</li>
						
						<li class="list-group-item mb-3">
							<div class="form-group">
								<label class="control-label" for="course"><b>Option D</b></label>
								<div class="controls">
									<input class="form-control" name="d" type="text" id="ad"  value="<?php echo $content12['D'] ?>"   />
								</div>
							</div>
							<div class="controls">
										<select class="form-control" name="d-grade" id="ans" class="success">
											<option value="A">--Grade--</option>
											<?php 
											for($x=100;$x >=0;$x-=5){
												$x = ($x == 0) ? 1 : $x;
												?>
												
												<option value="<?php echo $x; ?>" <?php if($content12['d_grade'] == $x){ ?>selected <?php } ?>><?php echo $x."%"; ?></option>
												<?php
											}
											?>
										</select>
									</div> 
						</li>
						
						<li class="list-group-item mb-3">
						<div class="form-group">
						<label class="control-label" for="course"><b>Answer Point</b></label>
						<div class="controls">
							<input class="form-control" name="point" type="text" id="point" required  value="<?php echo $content12['anspoint'] ?>" />           
						</div>
					</div>
						</li>
					</ul>
					
					<div class="form-group">
						<div class="controls">
							<input type="submit" value="Update Question" name="upload" id="submitme" class="btn btn-large btn-primary"/>
						</div>
					</div> 		
				</form>
			</div>
		</div>
	</div> 
</div>	
<?php include("includes/footer.php")?>