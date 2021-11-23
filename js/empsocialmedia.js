$(function() {
  loadsocialmedia();
});

function loadsocialmedia(){
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      action: '74'
    },
    success: function(response){
      $('#socialmedia-table').html(response);
    }
  });  
}
function addsocialmedia(){
  var newT = $('#assign-socialmedia').serialize();
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
        $('#e-socialmedia').modal('hide');
        $('.showMsgsuccess span').html(response.message);
        $('#assign-socialmedia')[0].reset();
        loadsocialmedia();
        $('.showMsgerr').hide();
        $('.showMsgsuccess').show();
        $(".showMsgsuccess").fadeOut(3000);
      }
      setInterval(function() {$(".overlay").hide(); },500);
    }
  });
}
function delsocialmedia() {
  var newT = $('#del-socialmedia').serialize();
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
        $('#delete-socialmedia').modal('hide');
        $('.showMsgsuccess span').html(response.message);
        loadsocialmedia();
        $('.showMsgerr').hide();
        $('.showMsgsuccess').show();
        $(".showMsgsuccess").fadeOut(3000);
      }
      setInterval(function() {$(".overlay").hide(); },500);
    }
  });
}
function add_sm(){
  $('#assign-socialmedia')[0].reset();
  $('.action').val('70');
  $('#e-socialmedia').modal('show');
}
function edit_sm(id){
  var id = $(id).data('id');
  $('#e-socialmedia').modal('show');
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      id:id,
      action: '73'
    },
    dataType: 'json',
    success: function(response){
      $('.action').val('71');
      $('.ovid').val(response.aid);
      $('#socialmediatype').html(response.socialmedia);
      $('#link').val(response.link);
      $('#profilename').val(response.profilename);
    }
  });
}
function del_socialmedia(id){
  var id = $(id).data('id');
  $('.ovid').val(id);
  $('#delete-socialmedia').modal('show');
}

