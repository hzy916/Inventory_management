<?php
/**
 * Use an HTML form to edit an entry in the
 * users table.
 *
 */
require 'inc/config.php';
require 'inc/common.php';
if (isset($_POST['submit'])) {

  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $item =[
      "id"        => $_POST['id'],
      "itemname" => $_POST['itemname'],
      "color"  => $_POST['color'],
      "size"     => $_POST['size'],
      "amount"       => $_POST['amount'],
      "date"  => $_POST['date']
    ];

    $sql = "UPDATE pawtrails
            SET id = :id,
            itemname = :itemname,
            color = :color,
            size = :size,
            amount = :amount,
            date = :date
            WHERE id = :id";

  $statement = $connection->prepare($sql);
  $statement->execute($item);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}

if (isset($_GET['id'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $id = $_GET['id'];
    $sql = "SELECT * FROM pawtrails WHERE id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "layouts/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
	<blockquote><?php echo escape($_POST['itemname']); ?> successfully updated.</blockquote>
<?php endif; ?>


  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Edit Inventory</li>
        </ol>

        <h2>Edit Inventory for Item </h2>

        <form method="post">
            <?php foreach ($user as $key => $value) : ?>
              <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
              <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>"
                <?php echo ($key === 'id' ? 'readonly' : null);
                echo ($key === 'itemname' ? 'readonly' : null);
                echo ($key === 'color' ? 'readonly' : null);
                echo ($key === 'size' ? 'readonly' : null);
                ?>>
            <?php endforeach; ?>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
    
		<!-- /.container-fluid -->
		</div>
	 <!-- /.content-wrapper -->

<?php require "layouts/footer.php"; ?>
