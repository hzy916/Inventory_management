<?php
	session_start();

	if(!isset($_SESSION['id'],$_SESSION['user_role_id']))
	{
		header('location:index.php?lmsg=true');
		exit;
	}

	require_once('inc/config.php');
	require_once('inc/common.php');
	require_once('layouts/header.php');
	require_once('layouts/left_sidebar.php');
?>

<?php

try {

	$connection = new PDO($dsn, $username, $password, $options);

	$sql = "SELECT *
					FROM pawtrails";

	$statement = $connection->prepare($sql);
	$statement->bindParam(':location', $location, PDO::PARAM_STR);
	$statement->execute();

	$result = $statement->fetchAll();
} catch(PDOException $error) {
	echo $sql . "<br>" . $error->getMessage();
}

?>


  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
				<li class="breadcrumb-item active">Overview</li>
      </ol>
      <h1>Welcome to Dashboard</h1>
      <hr>
      <p>You are login as <strong><?php echo getUserAccessRoleByID($_SESSION['user_role_id']); ?></strong></p>

		<ul>
			<li><strong>John Doe</strong> has <strong>Administrator</strong> rights so all the left bar items are visible to him</li>
			<li><strong>Ahsan</strong> has <strong>Editor</strong> rights and he doesn't have access to Settings</li>
			<li><strong>Sarah</strong> has <strong>Author</strong> rights and she can't have access to Appearance, Components and Settings</li>
			<li><strong>Salman</strong> has <strong>Contributor</strong> rights and he has only access Posts</li>
		</ul>
		<!-- DataTables Example -->

<?php
	if ($result && $statement->rowCount() > 0) { ?>

				<div class="card mb-3">
					<div class="card-header">
						<i class="fas fa-table"></i>
						Data Table Example</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Id</th>
										<th>ItemName</th>
										<th>Color</th>
										<th>Size</th>
										<th>Amount</th>
										<th>Date</th>
										<th>Edit</th>
									</tr>
								</thead>

								<tbody>
									<?php foreach ($result as $row) { ?>
										<tr>
											<td><?php echo escape($row["id"]); ?></td>
											<td><?php echo escape($row["itemname"]); ?></td>
											<td contenteditable="true"><?php echo escape($row["color"]); ?></td>
											<td><?php echo escape($row["size"]); ?></td>
											<td><?php echo escape($row["amount"]); ?></td>
											<td><?php echo escape($row["date"]); ?> </td>
										  <td><a href="update-single.php?id=<?php echo escape($row["id"]); ?>">Edit</a></td>
										</tr>
									<?php } ?>
								</tbody>
		          </table>

							<?php } else { ?>
								<blockquote>No results found.</blockquote>
							<?php }
?>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>
		<!-- /.container-fluid -->
		</div>
	 <!-- /.content-wrapper -->

		<!-- Bootstrap core JavaScript-->
		<script src="assets/vendor/jquery/jquery.min.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- Core plugin JavaScript-->
		<script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
		<!-- Custom scripts for all pages-->
		<script src="assets/js/sb-admin.min.js"></script>
		<!-- Custom scripts for this page-->
		<!-- Toggle between fixed and static navbar-->
		<!-- Demo scripts for this page-->

		<!-- Page level plugin JavaScript-->
		<script src="assets/vendor/datatables/jquery.dataTables.js"></script>
		<script src="assets/vendor/datatables/dataTables.bootstrap4.js"></script>

	  <script src="assets/js/datatables-demo.js"></script>


<?php require_once('layouts/footer.php'); ?>
