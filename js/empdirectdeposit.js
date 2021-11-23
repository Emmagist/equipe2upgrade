$(function() {
  loaddirectdeposit();
  dreloadA();
});

function loaddirectdeposit(){
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      action: '620'
    },
    success: function(response){
      $('#directdeposit-table').html(response);
    }
  });  
}

function adddirectdeposit(){
  var newT = $('#assign-directdeposit').serialize();
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
        $('#e-directdeposit').modal('hide');
        $('.showMsgsuccess span').html(response.message);
        $('#assign-directdeposit')[0].reset();
        loaddirectdeposit();
        $('.showMsgerr').hide();
        $('.showMsgsuccess').show();
        $(".showMsgsuccess").fadeOut(3000);
      }
      setInterval(function() {$(".overlay").hide(); },500);
    }
  });
}
function deldirectdeposit() {
  var newT = $('#del-directdeposit').serialize();
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
        $('#delete-directdeposit').modal('hide');
        $('.showMsgsuccess span').html(response.message);
        loaddirectdeposit();
        $('.showMsgerr').hide();
        $('.showMsgsuccess').show();
        $(".showMsgsuccess").fadeOut(3000);
      }
      setInterval(function() {$(".overlay").hide(); },500);
    }
  });
}
function add_directdeposit(){
  $('#assign-directdeposit')[0].reset();
  $('.action').val('616');
  $('#e-directdeposit').modal('show');
}
function edit_directdeposit(id){
  var id = $(id).data('id');
  $('#e-directdeposit').modal('show');
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      id:id,
      action: '619'
    },
    dataType: 'json',
    success: function(response){
      $('.action').val('617');
      $('.ovid').val(response.aid);
      $('#branchlocation').val(response.branchlocation);
      $('#financialinstitiution').val(response.financialinstitution);
      $('#accounttype').html(response.accounttype);
      $('#depositamount').val(response.amount);
      $('#accountno').val(response.accountno);
      $('#routingno').val(response.routingno);
    }
  });
}
function del_directdeposit(id){
  var id = $(id).data('id');
  $('.ovid').val(id);
  $('#delete-directdeposit').modal('show');
}

function dreloadA(){
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      action: '621'
    },
    dataType: 'json',
    success: function(response){
      $('#directdepositattach').html(response.directdepositAttach);
    }
  });  
}
