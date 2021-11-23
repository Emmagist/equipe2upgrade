$(function() {

  $('#jAll').click(function(e){
    iscliked(this);
  });
    
  //add new
  $('#empgrp').submit(function(e){
    e.preventDefault();
    var newT = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: '../controller/performance.php',
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
          $('#addnew').modal('hide');
          $('.showMsgsuccess span').html(response.message);
          //reload();
          $('.showMsgerr').hide();
          $('.showMsgsuccess').show();
          $(".showMsgsuccess").fadeOut(3000);
        }
        setInterval(function() {$(".overlay").hide(); },500);
      }
    });
  });

  //edit
  $('#empgrpEdit').submit(function(e){
    e.preventDefault();
    var newT = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: '../controller/performance.php',
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
          $('#addnew').modal('hide');
          $('.showMsgsuccess span').html(response.message);
          //reload();
          $('.showMsgerr').hide();
          $('.showMsgsuccess').show();
          $(".showMsgsuccess").fadeOut(3000);
        }
        setInterval(function() {$(".overlay").hide(); },500);
      }
    });
  });
});

function iscliked(id) {
  if ($(id).prop('checked')==true) {
    $('.jOne').prop( "checked", true );
  }else{
    $('.jOne').prop( "checked", false ); 
  }
}

function isclikedOne() {
  var isAllC = $('.jOne:checked').length;
  var isAll = $('.jOne').length;
  if(isAllC < isAll){
    $('#jAll').prop( "checked", false );
  }else{
    $('#jAll').prop( "checked", true );
  }
}

function enC(id) {
  var aid=$(id).attr('id');
  //check if lead checkbox is checked
  if ($(id).prop('checked')==true) {
    $('#'+aid+'main').prop( "checked", true );
    $('#'+aid+'sup').prop( "disabled", false );
    $('#'+aid+'peers').prop( "disabled", false );
    $('#'+aid+'self').prop( "disabled", false );
    $('#'+aid+'weight').prop( "disabled", false );
  }else{
    $('#'+aid+'main').prop( "checked", false );
    $('#'+aid+'sup').prop( "checked", false );
    $('#'+aid+'peers').prop( "checked", false );
    $('#'+aid+'self').prop( "checked", false );
    $('#'+aid+'weight').val('');

    $('#'+aid+'sup').prop( "disabled", true );
    $('#'+aid+'peers').prop( "disabled", true );
    $('#'+aid+'self').prop( "disabled", true );
    $('#'+aid+'weight').prop( "disabled", true );
  }
}