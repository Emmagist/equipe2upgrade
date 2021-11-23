$(function() {
  loadmembership();
  mreloadA();

  $('#mattach').submit(function(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: '../controller/employee.php',
      data: new FormData(this),
      processData: false,
      contentType: false,
      dataType: 'json',
      beforeSend: function(){$(".overlay").show();},
      success: function(response){
        if(response.error){
          $('.showMsgerr span').html(response.message);
          $('.showMsgsuccess').hide();
          $('.showMsgerr').show();
          
        }
        else{
          $('#maddA').modal('hide');
          $('.showMsgsuccess span').html(response.message);
          $('.showMsgerr').hide();
          $('#mattach')[0].reset();
          mreloadA();
          rreloadA();
          qreloadA();
          jreloadA();
          ereloadA();
          ireloadA();
          dreloadA();
          reporttoreloadA();
          $('.showMsgsuccess').show();
          $(".showMsgsuccess").fadeOut(3000);
        }
        setInterval(function() {$(".overlay").hide(); },500);
      }
    });
  });

  $('#mattachEdit').submit(function(e){
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: '../controller/employee.php',
      data: new FormData(this),
      processData: false,
      contentType: false,
      dataType: 'json',
      beforeSend: function(){$(".overlay").show();},
      success: function(response){
        if(response.error){
          $('.showMsgerr span').html(response.message);
          $('.showMsgsuccess').hide();
          $('.showMsgerr').show();
          
        }
        else{
          $('#meditA').modal('hide');
          $('.showMsgsuccess span').html(response.message);
          $('.showMsgerr').hide();
          mreloadA();
          rreloadA();
          jreloadA();
          qreloadA();
          ereloadA();
          ireloadA();
          dreloadA();
          reporttoreloadA();
          $('.showMsgsuccess').show();
          $(".showMsgsuccess").fadeOut(3000);
        }
        setInterval(function() {$(".overlay").hide(); },500);
      }
    });
  });

  $('#mdelA').submit(function(e){
    e.preventDefault();
    var newT = $(this).serialize();
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
          $('#mdeleteA').modal('hide');
          $('.showMsgsuccess span').html(response.message);
          mreloadA();
          rreloadA();
          jreloadA();
          qreloadA();
          ereloadA();
          ireloadA();
          dreloadA();
          reporttoreloadA();
          $('.showMsgerr').hide();
          $('.showMsgsuccess').show();
          $(".showMsgsuccess").fadeOut(3000);
        }
        setInterval(function() {$(".overlay").hide(); },500);
      }
    });
  });
  
});

function loadmembership(){
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      action: '15'
    },
    success: function(response){
      $('#membership-table').html(response);
    }
  });  
}
function addmembership(){
  var newT = $('#assign-membership').serialize();
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
        $('#e-membership').modal('hide');
        $('.showMsgsuccess span').html(response.message);
        $('#assign-membership')[0].reset();
        loadmembership();
        $('.showMsgerr').hide();
        $('.showMsgsuccess').show();
        $(".showMsgsuccess").fadeOut(3000);
      }
      setInterval(function() {$(".overlay").hide(); },500);
    }
  });
}
function delMem() {
  var newT = $('#del-membership').serialize();
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
        $('#delete-membership').modal('hide');
        $('.showMsgsuccess span').html(response.message);
        loadmembership();
        $('.showMsgerr').hide();
        $('.showMsgsuccess').show();
        $(".showMsgsuccess").fadeOut(3000);
      }
      setInterval(function() {$(".overlay").hide(); },500);
    }
  });
}
function add_membership(){
  $('#assign-membership')[0].reset();
  $('#action').val('10');
  $('#e-membership').modal('show');
}
function edit_membership(id){
  var id = $(id).data('id');
  $('#e-membership').modal('show');
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      id:id,
      action: '13'
    },
    dataType: 'json',
    success: function(response){
      $('#action').val('11');
      $('.ovid').val(response.aid);
      $('#membership-e').html(response.membership);
      $('#paidby').html(response.paidby);
      $('#amount').val(response.amount);
      $('#rdate').val(response.rdate);
      $('#sdate').val(response.sdate);
    }
  });
}
function del_membership(id){
  var id = $(id).data('id');
  $('.ovid').val(id);
  $('#delete-membership').modal('show');
}

function mreloadA(){
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      action: '20'
    },
    dataType: 'json',
    success: function(response){
      $('#memattach').html(response.membershipAttach);
    }
  });  
}

function mgetRowA(id){
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      id:id,
      action: '19'
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

function meditA(id){
  //alert(id);
  mgetRowA(id);
  $('#meditA').modal('show');
}
function mdeletA(id){
  //alert(id);
  mgetRowA(id);
  $('#mdeleteA').modal('show');
}
