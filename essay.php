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
      });
    });
</script>
<style>
   .mb-3{
      margin-bottom: 10px;
   }
</style>

<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>Setup Essay Question</h3>
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
				<form class="form-horizontal" name="frmReg" method="post" onsubmit="return submitQuestion()" id="Form1" enctype="multipart/form-data">
							
				<input class="form-control" name="quiz_type" type="hidden" value="1"/>
					<!-- <div class="alert alert-info">Setup Multiple Choice Question</div> -->
					<!-- <h4>Question</h4> -->
					<div style="margin-bottom: 50px;">
						<div class="form-group">
							<label class="control-label" for="course"><b>Question</b></label>
							<div class="controls">
								<!-- <textarea class="form-control" name="question" id="question" ></textarea>		 -->
								<textarea name="question" class="summernote"> </textarea >
							</div>
						</div>
						<div class="form-group">
							<label class="control-label" for="course"><b>Grader Information</b></label>
							<div class="controls">
								<!-- <textarea class="form-control" name="question" id="question" ></textarea>		 -->
								<textarea name="a" class="summernote"> </textarea >
							</div>
						</div>
					</div>

					
					<ul class="list-group">
						<li class="list-group-item mb-3">
							<div class="form-group">
								<label class="control-label" for="course"><b>Answer Point</b></label>
								<div class="controls">
									<input class="form-control" name="point" type="text" id="point" required  placeholder="Point per Answer"/>           
								</div>
							</div>	
						</li>
					</ul>
					
					<div class="form-group">
						<div class="controls">
							<input type="submit" value="Upload Question" name="upload" id="submitme" class="btn btn-large btn-primary"/>
						</div>
					</div> 		
				</form>
			</div>
		</div>
	</div> 
	
</div>	

<?php include("includes/footer.php")?>