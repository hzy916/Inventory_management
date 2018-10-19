<?php
session_start();

require_once('inc/config.php');

if(isset($_POST['login']))
{

    //Retrieve the field values from our login form.
    $useremail = !empty($_POST['useremail']) ? trim($_POST['useremail']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;


    if(empty($_POST["useremail"]) || empty($_POST["password"]))  
    {  
      $errorMsg = "All fields are required"; 
    }  
    else  
    {  
        //Retrieve the user account information for the given username.
        $sql = "SELECT * FROM tbl_users WHERE email = :useremail AND password = :password";  
        
        $stmt = $connection->prepare($sql);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        unset($result['password']);
        //Execute.
        $stmt->execute(
          array(  
            'useremail'     =>     $_POST["useremail"],  
            'password'     =>     $_POST["password"]  
          )  
        );
        
        //Fetch row.
        $count = $stmt->rowCount();  

        if($count > 0)  
        {  
            $_SESSION = $result;
             header("location:login_success.php");  
        }  
        else  
        {  
          $errorMsg = "Wrong email or password";
        } 
      }
      //If $row is FALSE.
      // if($user === false){
      //   //Could not find a user with that username!
      //     $errorMsg = "No user found with this email";
      //   } else{
      //     //User account found. Check to see if the given password matches the
      //     //password hash that we stored in our users table.
          
      //     //Compare the passwords.
      //     $validPassword = password_verify($passwordAttempt, $user['password']);
          
      //     //If $validPassword is TRUE, the login has been successful.
      //     if($validPassword){
              
      //         //Provide the user with a login session.
      //         $_SESSION['user_id'] = $user['id'];
      //         $_SESSION['logged_in'] = time();
              
      //         //Redirect to our protected page, which we called home.php
      //         header('Location: dashboard.php');
      //         exit;
              
      //     } else{
      //         //$validPassword was FALSE. Passwords do not match.
      //         $errorMsg = "Wrong email or password";
      //     }
      //   }
      // }
  
    // if($user == 1)
		// {
		// 	$getUserRow = mysqli_fetch_assoc($results);
		// 	unset($getUserRow['password']);

		// 	$_SESSION = $getUserRow;

		// 	header('location:dashboard.php');
		// 	exit;
		// }
		// else
		// {
		// 	$errorMsg = "Wrong email or password";
		// }

}

// if(isset($_GET['logout']) && $_GET['logout'] == true)
// {
// 	session_destroy();
// 	header("location:login.php");
// 	exit;
// }
 
 
// if(isset($_GET['lmsg']) && $_GET['lmsg'] == true)
// {
// 	$errorMsg = "Login required to access dashboard";
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Simple role based access control example using php and mysqli</title>
  <!-- Bootstrap core CSS-->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
		<?php
			if(isset($errorMsg))
			{
				echo '<div class="alert alert-danger">';
				echo $errorMsg;
				echo '</div>';
				unset($errorMsg);
			}
		?>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" id="useremail" name="useremail" type="email" placeholder="Enter email" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" id="exampleInputPassword1" name="password" type="password" placeholder="Password" required>
          </div>
          <button class="btn btn-primary btn-block" type="submit" name="login">Login</button>
        </form>

      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
