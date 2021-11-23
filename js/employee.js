$(function() {
  loademployees();
  load_marriage_reg();
  getjobinfo();
  jreloadA();
  $('.tab0').click(function(e){
    $('.which').val('0');
  });
  $('.tab1').click(function(e){
    $('.which').val('1');
  });
  $('.tab2').click(function(e){
    $('.which').val('2');
  });
  $('.tab3').click(function(e){
    $('.which').val('3');
  });
  $('.tab4').click(function(e){
    $('.which').val('4');
  });
  $('.tab5').click(function(e){
    $('.which').val('5');
  });
  $('.tab6').click(function(e){
    $('.which').val('6');
  });
  $('.tab7').click(function(e){
    $('.which').val('7');
  });
  $('.tab8').click(function(e){
    $('.which').val('8');
  });
  $('.tab9').click(function(e){
    $('.which').val('9');
  });

  //adding marriage Informations
  $('#marriagereg').submit(function(e){
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
          $('.showMsgsuccess span').html(response.message);
          load_marriage_reg();
          $('.showMsgerr').hide();
          $('.showMsgsuccess').show();
          $(".showMsgsuccess").fadeOut(3000);
        }
        setInterval(function() {$(".overlay").hide(); },500);
      }
    });
  });

});

function load_marriage_reg(){
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      action: '59'
    },
    dataType: 'json',
    success: function(response){
      $('#cert-no').val(response.marriage_cert_no);
      $('#reg-date').val(response.marriage_reg_date);
    }
  });  
}

//get job details info
function getjobinfo(){
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      action: '101'
    },
    success: function(response){
      $('#jobb').html(response);
      $('.datepicker_add').datetimepicker({
        format: 'YYYY-MM-DD'
      });
    }
  });  
}
  //adding job details Informations
function addjobinfo(){
  //let myForm = document.getElementById('myForm');
  var ev=$(".eventf").val();
  var effe=$("#effectivefrom").val();
  var spe=$("#jrspecify").val();
  if (ev=='' || spe=='') {
    $('.showMsgerr').html('Select an Event');
    $('.showMsgsuccess').hide();
    $('.showMsgerr').show();
    
  }else if(effe==''){
    $('.showMsgerr').html('Effective From is Required');
    $('.showMsgsuccess').hide();
    $('.showMsgerr').show();
    
  }else{
    let newT=document.getElementById('jobAdd');
    $.ajax({
      type: 'POST',
      url: '../controller/employee.php',
      data: new FormData(newT),
      processData: false,
      contentType: false,
      dataType: 'json',
      beforeSend: function(){$(".overlay").show();},
      success: function(response){
        if(response.error){
          $('.showMsgerr').html(response.message);
          $('.showMsgsuccess').hide();
          $('.showMsgerr').show();
        }
        else{
          addjobhistory();
          $('.showMsgsuccess').html(response.message);
          $('.showMsgerr').hide();
          $('.showMsgsuccess').show();
          $(".showMsgsuccess").fadeOut(3000);
        }
        setInterval(function() {$(".overlay").hide(); },5000);
      }
    });
  }
}
function loademployees(){
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      action: '5'
    },
    beforeSend: function(){$(".overlay").show();},
    success: function(response){
      $('#emp-table').html(response);
      setInterval(function() {$(".overlay").hide(); },500);
    }
  });  
}

function edit_emp(id){
  var id = $(id).data('id');
  getEmp(id);
}

function getEmp(id){
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      id:id,
      action: '6'
    },
    beforeSend: function(){$(".overlay").show();},
    success: function(response){
      location.href=response;
      $(".overlay").hide();
      // $('.empp').html(response);
    }
  });
}
function viewcontract(id) {
  //var aid=$(id).attr('id');
  if ($(id).prop('checked')==true) {
    $('.contract-info').show();
  }else{
    $('.contract-info').hide();
  }
}
function jreloadA(){
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      action: '60'
    },
    dataType: 'json',
    success: function(response){
      $('#jobattach').html(response.jobAttach);
    }
  });  
}