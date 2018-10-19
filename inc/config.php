<?php
	// define("HOST","localhost");
	// define("DB_USER","root");
	// define("DB_PASS","root");
	// define("DB_NAME","PawTrails_inventory");
	//
	// $conn = mysqli_connect(HOST,DB_USER,DB_PASS,DB_NAME);
	//
	// if(!$conn)
	// {
	// 	die(mysqli_error());
	// }
	//
	// function getUserAccessRoleByID($id)
	// {
	// 	global $conn;
	//
	// 	$query = "select user_role from tbl_user_role where  id = ".$id;
	//
	// 	$rs = mysqli_query($conn,$query);
	// 	$row = mysqli_fetch_assoc($rs);
	//
	// 	return $row['user_role'];
	// }
?>

<?php

/**
 * Configuration for database connection
 */

$host       = "localhost:8889";

$username   = "root";
$password   = "root";
$dbname     = "Pawtrails_inventory"; // will use later
$dsn        = "mysql:host=$host;dbname=$dbname"; // will use later
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );


try  {
  $connection = new PDO($dsn, $username, $password, $options);
  // // Set the PDO error mode to exception
  // $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $error) {
  die("ERROR: Could not connect. " . $error->getMessage());
}

		if(!$connection)
		{
			die(mysqli_error());
		}

		function getUserAccessRoleByID($id)
		{
			global $connection;

			$query = "select user_role from tbl_user_role where  id = ".$id;
			//
			// $rs = mysqli_query($connection,$query);
			// $row = mysqli_fetch_assoc($rs);

			// return $row['user_role'];
		}
?>
