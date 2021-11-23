$(function() {
  loadlanguage();
  loadworkexp();
  loadskill();
  loadeducation();
  loadlicense();
  qreloadA();
});

//for assign language
function loadlanguage(){
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      action: '250'
    },
    success: function(response){
      $('#language-table').html(response);
    }
  });  
}
function addlanguage(){
  var newT = $('#assign-language').serialize();
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
        $('#e-language').modal('hide');
        $('.showMsgsuccess span').html(response.message);
        $('#assign-language')[0].reset();
        loadlanguage();
        $('.showMsgerr').hide();
        $('.showMsgsuccess').show();
        $(".showMsgsuccess").fadeOut(3000);
      }
      setInterval(function() {$(".overlay").hide(); },500);
    }
  });
}
function add_language(){
  $('#assign-language')[0].reset();
  $('.action').val('201');
  $('#e-language').modal('show');
}
function edit_language(id){
  var id = $(id).data('id');
  $('#e-language').modal('show');
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      id:id,
      action: '203'
    },
    dataType: 'json',
    success: function(response){
      $('.action').val('202');
      $('.ovid').val(response.aid);
      $('#language').html(response.language);
      $('#languageskill').html(response.languageskill);
      $('#fluencylevel').html(response.fluencylevel);
      $('#languagecomment').html(response.languagecomment);
    }
  });
}

//for assign workexp
function loadworkexp(){
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      action: '251'
    },
    success: function(response){
      $('#workexp-table').html(response);
    }
  });  
}
function addworkexp(){
  var newT = $('#assign-workexp').serialize();
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
        $('#e-workexp').modal('hide');
        $('.showMsgsuccess span').html(response.message);
        $('#assign-workexp')[0].reset();
        loadworkexp();
        $('.showMsgerr').hide();
        $('.showMsgsuccess').show();
        $(".showMsgsuccess").fadeOut(3000);
      }
      setInterval(function() {$(".overlay").hide(); },500);
    }
  });
}
function add_workexp(){
  $('#assign-workexp')[0].reset();
  $('.action').val('204');
  $('#e-workexp').modal('show');
}
function edit_workexp(id){
  var id = $(id).data('id');
  $('#e-workexp').modal('show');
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      id:id,
      action: '206'
    },
    dataType: 'json',
    success: function(response){
      $('.action').val('205');
      $('.ovid').val(response.aid);
      $('#company').val(response.company);
      $('#workexpjobtitle').val(response.jobtitle);
      $('#workexpfrom').val(response.workexpfrom);
      $('#workexpto').val(response.workexpto);
      $('#workexpcomment').html(response.workexpcomment);
      if (response.creditable=='0') {
        $('#workexprr').prop('checked', false);
      }else{
        $('#workexprr').prop('checked', true);
      }
    }
  });
}

//for assign skill
function loadskill(){
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      action: '252'
    },
    success: function(response){
      $('#skill-table').html(response);
    }
  });  
}
function addskill(){
  var newT = $('#assign-skill').serialize();
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
        $('#e-skill').modal('hide');
        $('.showMsgsuccess span').html(response.message);
        $('#assign-skill')[0].reset();
        loadskill();
        $('.showMsgerr').hide();
        $('.showMsgsuccess').show();
        $(".showMsgsuccess").fadeOut(3000);
      }
      setInterval(function() {$(".overlay").hide(); },500);
    }
  });
}
function add_skill(){
  $('#assign-skill')[0].reset();
  $('.action').val('207');
  $('#e-skill').modal('show');
}
function edit_skill(id){
  var id = $(id).data('id');
  $('#e-skill').modal('show');
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      id:id,
      action: '209'
    },
    dataType: 'json',
    success: function(response){
      $('.action').val('208');
      $('.ovid').val(response.aid);
      $('#skill').html(response.skill);
      $('#expY').val(response.expY);
      $('#skillcomment').html(response.skillcomment);
    }
  });
}

//for assign education
function loadeducation(){
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      action: '253'
    },
    success: function(response){
      $('#education-table').html(response);
    }
  });  
}
function addeducation(){
  var newT = $('#assign-education').serialize();
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
        $('#e-education').modal('hide');
        $('.showMsgsuccess span').html(response.message);
        $('#assign-education')[0].reset();
        loadeducation();
        $('.showMsgerr').hide();
        $('.showMsgsuccess').show();
        $(".showMsgsuccess").fadeOut(3000);
      }
      setInterval(function() {$(".overlay").hide(); },500);
    }
  });
}
function add_education(){
  $('#assign-education')[0].reset();
  $('.action').val('210');
  $('#e-education').modal('show');
}
function edit_education(id){
  var id = $(id).data('id');
  $('#e-education').modal('show');
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      id:id,
      action: '212'
    },
    dataType: 'json',
    success: function(response){
      $('.action').val('211');
      $('.ovid').val(response.aid);
      $('#eduL').html(response.level);
      $('#eyear').val(response.eyear);
      $('#edusdate').val(response.efrom);
      $('#eduedate').val(response.eto);
      $('#score').val(response.score);
      $('#major').val(response.major);
      $('#institute').val(response.institute);
    }
  });
}

//for assign license
function loadlicense(){
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      action: '254'
    },
    success: function(response){
      $('#license-table').html(response);
    }
  });  
}
function addlicense(){
  var newT = $('#assign-license').serialize();
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
        $('#e-license').modal('hide');
        $('.showMsgsuccess span').html(response.message);
        $('#assign-license')[0].reset();
        loadlicense();
        $('.showMsgerr').hide();
        $('.showMsgsuccess').show();
        $(".showMsgsuccess").fadeOut(3000);
      }
      setInterval(function() {$(".overlay").hide(); },500);
    }
  });
}
function add_license(){
  $('#assign-license')[0].reset();
  $('.action').val('213');
  $('#e-license').modal('show');
}
function edit_license(id){
  var id = $(id).data('id');
  $('#e-license').modal('show');
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      id:id,
      action: '215'
    },
    dataType: 'json',
    success: function(response){
      $('.action').val('214');
      $('.ovid').val(response.aid);
      $('#license').html(response.license);
      $('#licensenum').val(response.licensenum);
      $('#issuedate').val(response.issuedate);
      $('#expirydate').val(response.expirydate);
    }
  });
}

//For all qualification delete
function del_qualification(id){
  var tb = $(id).attr('id');
  var id = $(id).data('id');
  $('.ovid').val(id);
  $('#tb').val(tb);
  $('#delete-qualification').modal('show');
}
function delqualification() {
  var newT = $('#del-qualification').serialize();
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
        $('#delete-qualification').modal('hide');
        $('.showMsgsuccess span').html(response.message);
        loadlanguage();
        loadworkexp();
        loadskill();
        loadeducation();
        loadlicense();
        $('.showMsgerr').hide();
        $('.showMsgsuccess').show();
        $(".showMsgsuccess").fadeOut(3000);
      }
      setInterval(function() {$(".overlay").hide(); },500);
    }
  });
}

//file Attachment
function qreloadA(){
  $.ajax({
    type: 'POST',
    url: '../controller/employee.php',
    data: {
      action: '600'
    },
    dataType: 'json',
    success: function(response){
      $('#qualificationattach').html(response.qualificationAttach);
    }
  });  
}