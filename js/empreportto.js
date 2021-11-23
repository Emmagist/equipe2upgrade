$(function() {
  loadreportto1();
  loadreportto2();
  reporttoreloadA();
});

function loadreportto1(){
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      action: '626'
    },
    success: function(response){
      $('#reporttosup-table').html(response);
    }
  });  
}
function loadreportto2(){
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      action: '627'
    },
    success: function(response){
      $('#reporttosub-table').html(response);
    }
  });  
}

function addreportto(){
  var newT = $('#assign-reportto').serialize();
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: newT,
    dataType: 'json',
    beforeSend: function(){$(".overlay").show();},
    success: function(response){
      if(response.error){
        $('.showMsgerr span').html(response.message);
        $('.showMsgsuccess').hide();
        $('.showMsgerr').show();
        
      }
      else{
        $('#e-reportto').modal('hide');
        $('.showMsgsuccess span').html(response.message);
        $('#assign-reportto')[0].reset();
        loadreportto1();
        loadreportto2();
        $('.showMsgerr').hide();
        $('.showMsgsuccess').show();
        $(".showMsgsuccess").fadeOut(3000);
      }
      setInterval(function() {$(".overlay").hide(); },500);
    }
  });
}
function delreportto() {
  var newT = $('#del-reportto').serialize();
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: newT,
    dataType: 'json',
    beforeSend: function(){$(".overlay").show();},
    success: function(response){
      if(response.error){
        $('.showMsgerr span').html(response.message);
        $('.showMsgsuccess').hide();
        $('.showMsgerr').show();
        
      }
      else{
        $('#delete-reportto').modal('hide');
        $('.showMsgsuccess span').html(response.message);
        loadreportto1();
        loadreportto2();
        $('.showMsgerr').hide();
        $('.showMsgsuccess').show();
        $(".showMsgsuccess").fadeOut(3000);
      }
      setInterval(function() {$(".overlay").hide(); },500);
    }
  });
}
function add_reportto(which){
  $('#assign-reportto')[0].reset();
  if (which==0) {
    $('.whichreportto').val('0');
  }
  if (which==1) {
    $('.whichreportto').val('1');
  }
  $('.action').val('622');
  $('#e-reportto').modal('show');
}
function edit_reportto(id){
  var id = $(id).data('id');
  $('#e-reportto').modal('show');
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      id:id,
      action: '625'
    },
    dataType: 'json',
    success: function(response){
      $('#action1').val('623');
      $('.ovid').val(response.aid);
      $('#reportingmethod').html(response.reportingmethod);
      $('#emp_name').val(response.name);
      $('#emp_id').val(response.reportname);
      $('#reportspecify').val(response.reportspecify);
      if (response.reportspecify=='reportto') {
        $('.reportspec').hide();
      }else{
        $('.reportspec').show();
      }
    }
  });
}
function del_reportto(id){
  var id = $(id).data('id');
  $('.ovid').val(id);
  $('#delete-reportto').modal('show');
}

function reporttoreloadA(){
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      action: '628'
    },
    dataType: 'json',
    success: function(response){
      $('#reporttoattach').html(response.reporttoAttach);
    }
  });  
}

function reportspecify(){
  $('#reportspecify').val('');
  $('.reportspec').show();
}
function noreportspecify(){
  $('#reportspecify').val('reportto');
  $('.reportspec').hide();
}

function empforreport(){
   $('.employee').autocomplete({
       source: function(request, response) {
           $.ajax({
               url: "../../getDetails.php",
               type: 'post',
               dataType: "json",
               data: {
                   search: request.term,
                   request: 12
               },
               success: function(data) {
                   response(data);
                   //console.log(data)
               }
           });
       },
       appendTo : $('#e-reportto'),
       select: function(event, ui) {
           $(this).val(ui.item.label); // display the selected text
           $('.emp_id').val(ui.item.value);
           return false;
       }
   });

}