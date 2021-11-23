$(function() {
  loadimmigration();
  ireloadA();
});

function loadimmigration(){
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      action: '614'
    },
    success: function(response){
      $('#immigration-table').html(response);
    }
  });  
}

function addimmigration(){
  var newT = $('#assign-immigration').serialize();
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
        $('#e-immigration').modal('hide');
        $('.showMsgsuccess span').html(response.message);
        $('#assign-immigration')[0].reset();
        loadimmigration();
        $('.showMsgerr').hide();
        $('.showMsgsuccess').show();
        $(".showMsgsuccess").fadeOut(3000);
      }
      setInterval(function() {$(".overlay").hide(); },500);
    }
  });
}
function delimmigration() {
  var newT = $('#del-immigration').serialize();
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
        $('#delete-immigration').modal('hide');
        $('.showMsgsuccess span').html(response.message);
        loadimmigration();
        $('.showMsgerr').hide();
        $('.showMsgsuccess').show();
        $(".showMsgsuccess").fadeOut(3000);
      }
      setInterval(function() {$(".overlay").hide(); },500);
    }
  });
}
function add_immigration(){
  $('#assign-immigration')[0].reset();
  $('.action').val('610');
  $('#e-immigration').modal('show');
}
function edit_immigration(id){
  var id = $(id).data('id');
  $('#e-immigration').modal('show');
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      id:id,
      action: '613'
    },
    dataType: 'json',
    success: function(response){
      $('.action').val('611');
      $('.ovid').val(response.aid);
      $('#documentno').val(response.number);
      $('#eligiblestatus').val(response.eligiblestatus);
      $('#issueby').html(response.issueby);
      $('#immiissuedate').val(response.issuedate);
      $('#immiexpirydate').val(response.expirydate);
      $('#immiexpirydate').val(response.expirydate);
      $('#immcomment').val(response.comment);
      if (response.immigrationdocument=='Passport') {
        $('#immipassport').prop('checked', true);
      }else{
        $('#immivisa').prop('checked', true);
      }
    }
  });
}
function del_immigration(id){
  var id = $(id).data('id');
  $('.ovid').val(id);
  $('#delete-immigration').modal('show');
}

function ireloadA(){
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      action: '615'
    },
    dataType: 'json',
    success: function(response){
      $('#immigrationattach').html(response.immigrationAttach);
    }
  });  
}
