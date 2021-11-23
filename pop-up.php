<?php 
   ini_set('display_errors',0); 
   require_once("includes/session.php"); 
   // confirm_logged_in();
   require_once ('../connection.php');
   include("includes/header.php"); 
?>
<style>
   .mb-3{
      margin-bottom: 10px;
   }
</style>
<div class="right_col" role="main">
		<div class="page-title">
         <div class="title_left">
            <h3>Quiz</h3>
         </div>

         <div class="title_right">
            <div class="col-md-7 col-sm-7 col-xs-12 form-group pull-right top_search">
               <a href="dashboard" class="btn btn-sm btn-success"><i class="fa fa-home"></i> Dashboard</a>
               <!-- <a href="assign-subject?pg=1" class="btn btn-sm btn-primary">Assign Subject</a> -->
               <a href="my-class" class="btn btn-sm btn-warning">My Class(es)</a>
            </div>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="row">
        
         <div class="x_panel">
            <div class="x_title font-weight-bold">
               <h4><strong>Quiz</h4>
               <div class="clearfix"></div>
            </div>
            <div class="x_content">
               <div class="bdy">
                  
               
                  <a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Select Question Type</a>
              
               </div>
            </div>
         </div>
      </div> 
      
   </div>
   <div class="modal fade" id="modal-id">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Select Question Type</h4>
         </div>
         
         <div class="modal-body">
            <ul class="list-group">    
               <li class="list-group-item font-weight-bold mb-3"> 
                  <div class="radio">
                     <label>
                        <input type="radio" name="quiz" class="input" id="input" value="m_choice" > Multiple Choice
                     </label>
                  </div>
                  
               </li>
               <li class="list-group-item font-weight-bold mb-3"> 
                  <div class="radio">
                     <label>
                        <input type="radio" name="quiz" class="input" id="input" value="type-true"> True/False
                     </label>
                  </div>
                 
               </li>
               <li class="list-group-item font-weight-bold mb-3"> 
                  <div class="radio">
                     <label>
                        <input type="radio" name="quiz" class="input" id="input" value="essay" > Essay                     
                     </label>
                  </div>
                 
               </li>
               <li class="list-group-item font-weight-bold mb-3"> 
                  <div class="radio">
                     <label>
                        <input type="radio" name="quiz" class="input" id="input" value="Short Answer"> Short Answer
                     </label>
                  </div>
               
               </li>
               <li class="list-group-item font-weight-bold mb-3"> 
                  <div class="radio">
                     <label>
                        <input type="radio" name="quiz" class="input" id="input" value="Drag and Drop"> Drag and Drop into Text
                     </label>
                  </div>
                
               </li>
            </ul>
         </div>
         <div class="modal-footer">
            <a id="submit" class="btn btn-block btn-sm btn-primary" href="">Select</a>
         </div>
      </div>
   </div>
</div>

<?php include("includes/footer.php")?>
<script>
   var submit = document.getElementById('submit');
   $(".input").click(function(e){
      // e.preventDefault();
      var radioValue = $("input[name='quiz']:checked").val();
      submit.setAttribute("href",radioValue);
      // alert(submit);
   })
</script>
