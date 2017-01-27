// To make Pace works on Ajax calls
$(document).ajaxStart(function() { Pace.restart(); });
	
function renderDashboard() {
  $('.content-wrapper').load('dashboard.php');
}

function renderUser() {
  $('.content-wrapper').load('user.php');
}

$(function(){
  $("#users").DataTable({
    "paging": true,
    "searching": false,
    "ordering": true,
    "info": true,
    "lengthChange" : false
  });
});

$(document).on('show.bs.modal','#editUserModal', function (e) {
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

$(document).on('show.bs.modal','#createUserModal', function (e) {
  $.ajax({
    type : 'post',
    url : 'api.php', //Here you will fetch records 
    data :  'process=createUser',
    success : function(data){
      $('.fetched-data').html(data);//Show fetched data from database
    }
  });
})

function addEmptyUser(){
  $.ajax({
    type : 'post',
    url : 'editUser.php',
    data :  'process=newUser',
    success : function(){
      renderUser();
    }
  });
}