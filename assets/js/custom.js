// To make Pace works on Ajax calls
$(document).ajaxStart(function() { Pace.restart(); });

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

$('.datepicker').datepicker();
$('#progressSlider').slider({
	formatter: function(value) {
		return 'Current value: ' + value;
	}
});