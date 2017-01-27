  <footer class="main-footer">
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="http://leadclickz.com">Lead Clickz</a>.</strong> All rights reserved.
  </footer>

</div>
<!-- ./wrapper -->

  <!-- Scripts -->
  <script src="assets/js/vendors.min.js"></script>
  <script type="text/javascript" src="assets/js/dataTables.min.js"></script>
  <script>
    $(function(){
      $("#users").DataTable({
        "paging": true,
        "searching": false,
        "ordering": true,
        "info": true,
        "lengthChange" : false
      });
      
      $('#editUser').on('show.bs.modal', function (e) {
        var user_id = $(e.relatedTarget).data('id');
        $.ajax({
          type : 'post',
          url : 'api.php', //Here you will fetch records 
          data :  'process=setClient&user_id='+ user_id, //Pass $id
          success : function(data){
            $('.fetched-data').html(data);//Show fetched data from database
          }
        });
      });
    });
  </script>
  <!-- AdminLTE App -->
  <script src="assets/js/app.min.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="assets/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="assets/js/demo.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>

<!-- page script -->
<script type="text/javascript">
	// To make Pace works on Ajax calls
	$(document).ajaxStart(function() { Pace.restart(); });
	
function renderDashboard() {
  $('.content-wrapper').load('dashboard.php');
}

function renderUser() {
  $('.content-wrapper').load('user.php');
}
</script>
<?php if ($_SERVER[REQUEST_URI] == '/'){ ?>
<script type="text/javascript">
$('.content-wrapper').load('dashboard.php');
</script>
<?php } ?>
</body>
</html>
<?php
  if ($_SERVER[REQUEST_URI] == '/footer.php')
    header('Location: ' . $home_url);
?>