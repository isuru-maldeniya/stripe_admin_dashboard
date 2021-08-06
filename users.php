<?php require_once("codeblocks/session.php"); ?>
<?php require_once('database/connection.php'); ?>
<?php require_once("codeblocks/login.php"); ?>
<?php require_once("codeblocks/functions.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php require_once("codeblocks/meta.php"); ?>

  <title>Users</title>
  <?php require_once("codeblocks/css.php"); ?>

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <?php require_once("codeblocks/navigation.php"); ?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item active">Users</li>
      </ol>
      <div class="row">
        <div class="col-12">
          <h1>Manage Users</h1>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-12">
          <div class="card mb-12">
            <div class="card-header">Add User</div>
            <div class="card-body">
              <form class="form-horizontal" id="formAddNew" method="POST">
                <div class="form-group row">
                  <label class="control-label col-sm-2">User Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="usr_name" class="form-control" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-2">User Email</label>
                  <div class="col-sm-10">
                    <input type="email" name="usr_email" class="form-control" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-2">Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="usr_password" class="form-control" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-2">User Type</label>
                  <div class="col-sm-10">
                    <select name="usr_type" class="form-control single-select" required>
                      <option value="0">Editor</option>
                      <option value="1">Administrator</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-12 float-right">
                    <button type="submit" class="btn btn-primary">Add New</button>
                  </div>
                </div>
              </form> 
            </div>
          </div>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-12">
          <div class="card mb-12">
            <div class="card-header">Users List</div>
            <div class="card-body">
              <table id="dt-table" cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Operations</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
      <br>
      <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="defaultModalLabel">Edit User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <form id="formEdit" method="POST">
            <div class="modal-body">
              <div class="form-group row">
                <label class="control-label col-sm-3">User Name</label>
                <div class="col-sm-9">
                  <input type="text" name="usr_name" id="usr_name" class="form-control" required>
                  <input type="text" name="usr_id" id="usr_id" class="form-control" hidden>
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-sm-3">User Email</label>
                <div class="col-sm-9">
                  <input type="email" name="usr_email" id="usr_email" class="form-control" required>
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-sm-3">User Type</label>
                <div class="col-sm-9">
                  <select id="usr_type" name="usr_type" class="form-control single-select" required>
                    <option value="0">Editor</option>
                    <option value="1">Administrator</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="col-md-6" align="right">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="defaultModalLabel">Reset Password</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <form id="formReset" method="POST">
            <div class="modal-body">
              <div class="form-group row">
                <label class="control-label col-sm-3">Password</label>
                <div class="col-sm-9">  
                  <input type="password" name="usr_password" id="usr_password" class="form-control" required>
                  <input type="text" name="usr_reset_id" id="usr_reset_id" class="form-control" hidden>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="col-md-6" align="right">
                <button type="submit" class="btn btn-primary">Reset</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php require_once("codeblocks/footer.php"); ?>

    <?php require_once("codeblocks/javascript.php"); ?>
    <script type="text/javascript">
      $(document).ready(function() {
				var dataTable = $('#dt-table').DataTable( {
					"scrollX": true,
					"processing": true,
					"serverSide": true,
					"order": [[ 0, "asc" ]],
					"columnDefs": [{"className": "dt-center", "targets": "_all"}],
					"ajax":{
						url :"serverscripts/users/dt_laod.php",
						type: "post",
						error: function(){
							$(".dt-table-error").html("");
							$("#dt-table").append('<tbody class="dt-table-error"><tr><th colspan="5">No Data Found in the Server</th></tr></tbody>');
							$("#dt-table_processing").css("display","none");
						}
					}
				} );
			} );
      $('#formAddNew').submit(function(event) {
				var formData = $(this).serialize();
				$.ajax({
					type        : 'POST',
					url         : 'serverscripts/users/add.php', 
					data        : formData,
					dataType    : 'json', 
					encode      : true
				}).done(function(data) {
          $('#dt-table').DataTable().ajax.reload();
          showToast(data.status, data.msg);
          if(data.status == "SUCCESS"){
            $('#formAddNew').each(function(){
              this.reset();
            });
            $('.single-select').val(null).trigger('change');
            $('.find-select').val(null).trigger('change');
          }
				}).fail(function(data) {
					console.error(data);
				});
        event.preventDefault();
			});
      $('#formEdit').submit(function(event) {
				var formData = $(this).serialize();
				$.ajax({
					type        : 'POST',
					url         : 'serverscripts/users/update.php', 
					data        : formData,
					dataType    : 'json', 
					encode      : true
				}).done(function(data) {
          $('#dt-table').DataTable().ajax.reload();
          showToast(data.status, data.msg);
          if(data.status == "SUCCESS"){
            $('#editModal').modal("hide");
            $('#formEdit').each(function(){
              this.reset();
            });
          }
				}).fail(function(data) {
					console.error(data);
				});
        event.preventDefault();
      });
      $('#formReset').submit(function(event) {
				var formData = $(this).serialize();
				$.ajax({
					type        : 'POST',
					url         : 'serverscripts/users/reset.php', 
					data        : formData,
					dataType    : 'json', 
					encode      : true
				}).done(function(data) {
          $('#dt-table').DataTable().ajax.reload();
          showToast(data.status, data.msg);
				}).fail(function(data) {
					console.error(data);
				});
        event.preventDefault();
        $('#resetModal').modal("hide");
        $('#formReset').each(function(){
          this.reset();
        });
			});
      function editModal(id){
        $.ajax({
					type        : 'POST',
					url         : 'serverscripts/users/get.php', 
					data        : {id: id},
					dataType    : 'json', 
					encode      : true
				}).done(function(data) {
					$('#usr_id').val(data.usr_id);
					$('#usr_name').val(data.usr_name);
          $('#usr_email').val(data.usr_email);
          $('#usr_type').val(data.usr_type).trigger('change');
					$('#editModal').modal("show");
				}).fail(function(data) {
					console.error(data);
				});
      }
      function resetModal(id){
        $('#usr_reset_id').val(id);
        $('#resetModal').modal("show");
      }
      function deleteModal(id){
				bootbox.confirm({
					title: 'Confirm Action',
					closeButton: false,
					message: "Are you sure do you want to delete this user?",
					buttons: {
						cancel: {
							label: 'No',
							className: 'btn-default'
						},
						confirm: {
							label: 'Yes',
							className: 'btn-danger'
						}
					},
					callback: function (result) {
						if (result){
							$.ajax({
								type        : 'POST',
								url         : 'serverscripts/users/delete.php', 
								data        : {id: id},
								dataType    : 'json', 
								encode      : true
							}).done(function(data) {
								$('#dt-table').DataTable().ajax.reload();
								showToast(data.status, data.msg);
							}).fail(function(data) {
								console.error(data);
							});
						}
					}
				});
			}
    </script>
  </div>
</body>

</html>
