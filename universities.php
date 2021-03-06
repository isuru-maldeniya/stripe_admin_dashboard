<?php require_once("codeblocks/session.php"); ?>
<?php require_once('database/connection.php'); ?>
<?php require_once("codeblocks/login.php"); ?>
<?php require_once("codeblocks/functions.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php require_once("codeblocks/meta.php"); ?>

  <title>SAMPLE PAGE</title>
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
        <li class="breadcrumb-item active">SAMPLE PAGE</li>
      </ol>
      <div class="row">
        <div class="col-12">
          <h1>API PAGE</h1>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-12">
          <div class="card mb-12">
            <div class="card-header">Add API</div>
            <div class="card-body">
              <form class="form-horizontal" id="formAdd" method="POST">
                <div class="form-group row">
                  <label class="control-label col-sm-2">Title</label>
                  <div class="col-sm-10">
                    <input type="text" name="title" class="form-control" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-2">Api Key</label>
                  <div class="col-sm-10">
                    <input type="text" name="stripe_key" class="form-control" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-2">Status</label>
                  <div class="col-sm-10">

                  <div class="input-group mb-3">
                    <!-- <div class="input-group-prepend">
                      <label class="input-group-text" for="inputGroupSelect01">Select Status</label>
                    </div> -->
                    <select class="custom-select"name="status" required>
                      <option selected disabled>Choose...</option>
                      <option value=1>Active</option>
                      <option value=0>Disable</option>
                      <!-- <option value="3">Three</option> -->
                    </select>
                  </div>




                    <!-- <input type="text" name="uni_logo" class="form-control" required> -->
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
            <div class="card-header">API KEY List</div>
            <div class="card-body">
              <table id="dt-table" cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>API Key</th>
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
              <h4 class="modal-title" id="defaultModalLabel">Edit University</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <form id="formEdit" method="POST">
            <div class="modal-body">
                <div class="form-group row">
                  <label class="control-label col-sm-3">Title</label>
                  <div class="col-sm-9">
                    <input type="text" id="title" name="title_ed" class="form-control" required>
                    <input type="text" id="id" name="id_ed" class="form-control" hidden>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-3">Key</label>
                  <div class="col-sm-9">
                    <input type="text" id="stripe_key" name="stripe_key_ed" class="form-control" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-3">Status</label>




                  <div class="input-group mb-3 col-sm-9">
                    <!-- <div class="input-group-prepend">
                      <label class="input-group-text" for="inputGroupSelect01">Select Status</label>
                    </div> -->
                    <select class="custom-select"id="status" name="status_ed" required>
                      <option selected disabled>Choose...</option>
                      <option value=1>Active</option>
                      <option value=0>Disable</option>
                      <!-- <option value="3">Three</option> -->
                    </select>
                  </div>
                  <!-- <div class="col-sm-9">
                    <input type="text" id="uni_logo" name="uni_logo" class="form-control" required>
                  </div> -->
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
						url :"serverscripts/universities/dt_laod.php",
						type: "post",
						error: function(){
							$(".dt-table-error").html("");
							$("#dt-table").append('<tbody class="dt-table-error"><tr><th colspan="5">No Data Found in the Server</th></tr></tbody>');
							$("#dt-table_processing").css("display","none");
						}
					}
				} );
			} );
      $('#formAdd').submit(function(event) {
				var formData = $(this).serialize();
				$.ajax({
					type        : 'POST',
					url         : 'serverscripts/universities/add.php', 
					data        : formData,
					dataType    : 'json', 
					encode      : true
				}).done(function(data) {
          $('#dt-table').DataTable().ajax.reload();
					showToast(data.status, data.msg);
          if(data.status == "SUCCESS"){
            $('#formAdd').each(function(){
              this.reset();
            });
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
					url         : 'serverscripts/universities/update.php', 
					data        : formData,
					dataType    : 'json', 
					encode      : true
				}).done(function(data) {
          $('#dt-table').DataTable().ajax.reload();
					showToast(data.status, data.msg);
          if(data.status == "SUCCESS"){
            $('#formEdit').each(function(){
              this.reset();
            });
            $('#editModal').modal("hide");
          }
				}).fail(function(data) {
					console.error(data);
				});
        event.preventDefault();
			});
      function editModal(id){
        $.ajax({
					type        : 'POST',
					url         : 'serverscripts/universities/get.php', 
					data        : {id: id},
					dataType    : 'json', 
					encode      : true
				}).done(function(data) {
					// $('#uni_id').val(data.uni_id);
					// $('#uni_name').val(data.uni_name);
					// $('#uni_code').val(data.uni_code);
					// $('#uni_logo').val(data.uni_logo);


          // $('#uni_id').val(data.id);
					// $('#uni_name').val(data.title);
					// $('#uni_code').val(data.stripe_key);
					// $('#uni_logo').val(data.status);

          $('#id').val(data.id);
					$('#title').val(data.title);
					$('#stripe_key').val(data.stripe_key);
					$('#status').val(data.status);

					$('#editModal').modal("show");
				}).fail(function(data) {
					console.error(data);
				});
      }
      function deleteModal(id){
				bootbox.confirm({
					title: 'Confirm Action',
					closeButton: false,
					message: "Are you sure do you want to delete this key?",
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
								url         : 'serverscripts/universities/delete.php', 
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
