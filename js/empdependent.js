$(function() {
  loadrship();
  rreloadA();
});

function loadrship(){
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      action: '29'
    },
    success: function(response){
      $('#rship-table').html(response);
    }
  });  
}

function addrship(){
  var newT = $('#assign-rship').serialize();
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
        $('#e-rship').modal('hide');
        $('.showMsgsuccess span').html(response.message);
        $('#assign-rship')[0].reset();
        loadrship();
        $('.showMsgerr').hide();
        $('.showMsgsuccess').show();
        $(".showMsgsuccess").fadeOut(3000);
      }
      setInterval(function() {$(".overlay").hide(); },500);
    }
  });
}
function delrship() {
  var newT = $('#del-rship').serialize();
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
        $('#delete-rship').modal('hide');
        $('.showMsgsuccess span').html(response.message);
        loadrship();
        $('.showMsgerr').hide();
        $('.showMsgsuccess').show();
        $(".showMsgsuccess").fadeOut(3000);
      }
      setInterval(function() {$(".overlay").hide(); },500);
    }
  });
}
function add_rship(){
  $('#assign-membership')[0].reset();
  $('#action1').val('25');
  $('#e-rship').modal('show');
}
function edit_rship(id){
  var id = $(id).data('id');
  $('#e-rship').modal('show');
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      id:id,
      action: '28'
    },
    dataType: 'json',
    success: function(response){
      $('#action1').val('26');
      $('.ovid').val(response.aid);
      $('#rship').html(response.rship);
      $('#rname').val(response.rname);
      $('#rspecify').val(response.rspecify);
      $('#dob').val(response.dob);
      if (response.rrship=='Child') {
        $('.spec').hide();
      }else{
        $('.spec').show();
      }
    }
  });
}
function del_rship(id){
  var id = $(id).data('id');
  $('.ovid').val(id);
  $('#delete-rship').modal('show');
}

function rreloadA(){
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      action: '30'
    },
    dataType: 'json',
    success: function(response){
      $('#rshipattach').html(response.rshipAttach);
    }
  });  
}

function rgetRowA(id){
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      id:id,
      action: '30'
    },
    dataType: 'json',
    success: function(response){
      $('.id').val(response.aid);
      //$('#file_edit').val(response.file);
      $('#ddate_edit').val(response.ddate);
      $('#comment_edit').val(response.comment);
    }
  });
}

function specify(){
  $('#rspecify').val('');
  $('.spec').show();
}
function nospecify(){
  $('#rspecify').val('Child');
  $('.spec').hide();
}