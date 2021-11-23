$(function() {
  loademergency();
  ereloadA();
});

function loademergency(){
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      action: '605'
    },
    success: function(response){
      $('#emergency-table').html(response);
    }
  });  
}

function addemergency(){
  var newT = $('#assign-emergency').serialize();
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
        $('#e-emergency').modal('hide');
        $('.showMsgsuccess span').html(response.message);
        $('#assign-emergency')[0].reset();
        loademergency();
        $('.showMsgerr').hide();
        $('.showMsgsuccess').show();
        $(".showMsgsuccess").fadeOut(3000);
      }
      setInterval(function() {$(".overlay").hide(); },500);
    }
  });
}
function delemergency() {
  var newT = $('#del-emergency').serialize();
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
        $('#delete-emergency').modal('hide');
        $('.showMsgsuccess span').html(response.message);
        loademergency();
        $('.showMsgerr').hide();
        $('.showMsgsuccess').show();
        $(".showMsgsuccess").fadeOut(3000);
      }
      setInterval(function() {$(".overlay").hide(); },500);
    }
  });
}
function add_emergency(){
  $('#assign-emergency')[0].reset();
  $('.action').val('601');
  $('#e-emergency').modal('show');
}
function edit_emergency(id){
  var id = $(id).data('id');
  $('#e-emergency').modal('show');
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      id:id,
      action: '604'
    },
    dataType: 'json',
    success: function(response){
      $('.action').val('602');
      $('.ovid').val(response.aid);
      $('#emername').val(response.name);
      $('#relationship').val(response.relationship);
      $('#hphone').val(response.homephone);
      $('#wphone').val(response.workphone);
    }
  });
}
function del_emergency(id){
  var id = $(id).data('id');
  $('.ovid').val(id);
  $('#delete-emergency').modal('show');
}

function ereloadA(){
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      action: '606'
    },
    dataType: 'json',
    success: function(response){
      $('#emergencyattach').html(response.emergencyAttach);
    }
  });  
}
