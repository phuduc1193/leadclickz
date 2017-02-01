// To make Pace works on Ajax calls
$(document).ajaxStart(function() { Pace.restart(); });
	
function renderDashboard() {
  $('.content-wrapper').load('dashboard.php');
}

function renderUsers() {
  $('.content-wrapper').load('user.php');
}

function renderServices() {
  $('.content-wrapper').load('service.php');
}

function renderAccounts() {
  $('.content-wrapper').load('account.php');
}

function renderProjects() {
  $('.content-wrapper').load('project.php');
}

$(document).on('show.bs.modal','#editUserModal', function (e) {
  $('.fetched-data').empty();
  var user_id = $(e.relatedTarget).data('id');
  $.ajax({
    type : 'post',
    url : 'api.php', //Here you will fetch records 
    data :  'process=editUser&user_id='+ user_id, //Pass $id
    success : function(data){
      $('.fetched-data').html(data);//Show fetched data from database
    }
  });
})

$(document).on('show.bs.modal','#editClientModal', function (e) {
  $('.fetched-data').empty();
  var client_id = $(e.relatedTarget).data('id');
  $.ajax({
    type : 'post',
    url : 'api.php', //Here you will fetch records 
    data :  'process=editClient&client_id='+ client_id, //Pass $id
    success : function(data){
      $('.fetched-data').html(data);//Show fetched data from database
    }
  });
})

$(document).on('show.bs.modal','#editServiceModal', function (e) {
  $('.fetched-data').empty();
  var service_id = $(e.relatedTarget).data('id');
  $.ajax({
    type : 'post',
    url : 'api.php', //Here you will fetch records 
    data :  'process=editService&service_id='+ service_id, //Pass $id
    success : function(data){
      $('.fetched-data').html(data);//Show fetched data from database
    }
  });
})

function addEmptyUser(){
  $.ajax({
    type : 'POST',
    url : 'editUser.php',
    data :  'process=newUser',
    success : function(){
      renderUsers();
    }
  });
}

function addEmptyClient(){
  $.ajax({
    type : 'POST',
    url : 'editClient.php',
    data :  'process=newClient',
    success : function(){
      renderUsers();
    }
  });
}

function addEmptyService(){
  $.ajax({
    type : 'POST',
    url : 'editService.php',
    data :  'process=newService',
    success : function(){
      renderServices();
    }
  });
}

function editUser() {
  $.ajax({
    type: 'POST',
    url: 'editUser.php',
    data: $('#editUserForm').serialize(),
    success: function(){
      renderUsers();
      $('body').removeClass('modal-open');
      $('.modal-backdrop').remove();
    }
  });
  return false;
}

function editClient() {
  $.ajax({
    type: 'POST',
    url: 'editClient.php',
    data: $('#editClientForm').serialize(),
    success: function(){
      renderUsers();
      $('body').removeClass('modal-open');
      $('.modal-backdrop').remove();
    }, error: function() {alert('Error');}
  });
  return false;
}

function editService() {
  $.ajax({
    type: 'POST',
    url: 'editService.php',
    data: $('#editServiceForm').serialize(),
    success: function(){
      renderServices();
      $('body').removeClass('modal-open');
      $('.modal-backdrop').remove();
    }
  });
  return false;
}

$(document).ready(function() {
    $('#users').DataTable();
    $('#clients').DataTable();
} );