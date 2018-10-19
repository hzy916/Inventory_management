<?php

/**
 * Delete a user
 */

require "inc/config.php";
require "inc/common.php";

if (isset($_GET["id"])) {
 

  try {
    $connection = new PDO($dsn, $username, $password, $options);
  
    $id = $_GET["id"];

    $sql = "DELETE FROM pawtrails WHERE id = :id";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    header("location:login_success.php");  
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}


?>



