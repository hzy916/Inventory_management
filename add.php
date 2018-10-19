

<?php

 if (isset($_POST['submit'])) {  

      require "inc/config.php";
      require "inc/common.php";

      try  {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_item = array(
            "itemname" => $_POST['itemname'],
            "color"     => $_POST['item_color'],
            "size"       => $_POST['item_size'],
            "amount"  => $_POST['item_amount']
        );

        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "pawtrails",
                implode(", ", array_keys($new_item)),
                ":" . implode(", :", array_keys($new_item))
        );
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_item);

    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
 ?>

<?php require "layouts/header.php"; ?>

<script>
    var mysuccess = 0;
    <?php if (isset($_POST['submit']) && $statement) { 
        print("mysuccess = 1;");

    } ?>
</script>


 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="dashboard.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Create an Item</li>
        </ol>

        <h2>Enter new Item details</h2>

        <form method="post">

            <label for="itemname">Item Name</label>
            <input type="text" name="itemname" id="itemname">

            <label for="item_color">Color</label>
            <input type="text" name="item_color" id="item_color">

            <label for="item_size">Size</label>
            <input type="text" name="item_size" id="item_size">

            <label for="item_amount">Amount</label>
            <input type="text" name="item_amount" id="item_amount">

            <input type="submit" class="btn btn-success" name="submit" value="Submit">
        </form>
    </div>
    <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createItemModal">
        Launch demo modal
        </button>
		<!-- /.container-fluid -->
</div>
	 <!-- /.content-wrapper -->


<!-- Modal -->
<div class="modal fade" id="createItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        New Item created successfully.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
      
      </div>
    </div>
  </div>
</div>

<script>
if (mysuccess == 1) {
    alert("New Item Added.");
    // $('#createItemModal').modal('show');
}
</script>


<?php require "layouts/footer.php"; ?>