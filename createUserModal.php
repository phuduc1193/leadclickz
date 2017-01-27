
            <!----------------->
            <!-- CREATE USER -->
            <!----------------->

<?php if($_POST['process'] == 'createUser'){ ?>

<!-- form start -->
<form role="form" id="createUserForm" class="form-horizontal">
  <div class="box-body">
    <div class="form-group">
      <label for="id" class="col-sm-2 control-label">ID</label>
      <div class="col-md-10">
        <input type="text" class="form-control" id="id" disabled>
      </div>
    </div>
    <div class="form-group">
      <label for="username" class="col-sm-2 control-label">Username</label>
      <div class="col-md-10">
        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
      </div>
    </div>
    <div class="form-group">
      <label for="password" class="col-sm-2 control-label">Password</label>
      <div class="col-md-10">
        <input type="text" class="form-control" id="password" name="password" placeholder="Password">
      </div>
    </div>
    <div class="form-group">
      <label for="is_admin" class="col-sm-2 control-label">Admin</label>
      <div class="col-md-10">
        <select name="is_admin" class="form-control">
          <option value=0>No</option>
          <option value=1>Yes</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="client" class="col-sm-2 control-label">Client</label>
      <div class="col-md-10">
        <select name="client" class="form-control">
<?php $clients = Client::find_all();
      while($client = $clients->fetch_array(MYSQLI_ASSOC)){
        echo '<option value= "' . $client['id'] . '">' . $client['name'] . '</option>';
      } ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="created_at" class="col-sm-2 control-label">Created At</label>
      <div class="col-md-10">
        <input type="text" class="form-control" id="created_at" disabled>
      </div>
    </div>
    <div class="form-group">
      <label for="updated_at" class="col-sm-2 control-label">Updated At</label>
      <div class="col-md-10">
        <input type="text" class="form-control" id="updated_at" disabled>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
  <div class="box-footer text-right">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Create User</button>
  </div>
  <!-- /.box-footer -->
</form>
<script type="text/javascript">
$("#createUserForm").submit(function(e) {
  $.ajax({
         type: "POST",
         url: "createUser.php",
         data: $("#createUserForm").serialize(), // serializes the form's elements.
         success: function(data)
         {
             renderUser(); // show response from the php script.
             $('#createUserModal').modal('hide');
             $('body').removeClass('modal-open');
             $('.modal-backdrop').remove();
         }
       });

  e.preventDefault(); // avoid to execute the actual submit of the form.
}); 
</script>
<?php
  }
?>