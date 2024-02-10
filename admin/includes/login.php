<!DOCTYPE html>
<?php 
  include '../../config/connection.php';
  include 'login_header.php';


  /*
  if(isset($_SESSION['sysadmin'])){ 
    if($_SESSION['sysadmin'] == 000){
      header("Location: ../index.php");
    }
  }
  */

  
  if (isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql_username = mysqli_real_escape_string($conn, $username);
    $sql_password = mysqli_real_escape_string($conn, $password);
    $password_hash = sha1($sql_password);

    $login_query = "SELECT * FROM login WHERE username = '$sql_username' AND password = '$sql_password' AND role_id = 100";
    $login_details = mysqli_query($conn, $login_query);

    $row = mysqli_fetch_assoc($login_details);
    $result = mysqli_num_rows($login_details);

    if($result == 1){
      //$row = mysqli_fetch_row($login_details);
      $user_data_query = "SELECT * FROM users WHERE username = '$sql_username'";
      $user_data = mysqli_query($conn, $user_data_query);

      $data = mysqli_fetch_assoc($user_data);

      if($row['role_id'] == 100){
        session_start();
        $_SESSION['admin'] = true;
        $_SESSION['role_id'] = $row['role_id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['admins_name'] = $data['user_name'];
        header('Location: ../index.php');
      }
    } else {
      echo ">> Invalid Username or Password.";
      sleep(3);
      header('Location: login.php');
    }
  }


?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    
    <title>Admin Login | PIMS</title>

</head>
<body>
<div class="container-fluid">
    <br>
    <div class=""> <br>
        <!-- h2 class="d-flex justify-content-center">Publishers Information Management System</h2 --> <br>
    </div>
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-header d-flex justify-content-center">
                <h3>Admin Login</h3>
            </div>
            <div class="card-body">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="input-group form-group">
                        <input type="text" class="form-control" placeholder="username" name="username">
                    </div>
                    <br>
                    <div class="input-group form-group">
                        <input type="password" class="form-control align-middle" placeholder="password" name="password">
                    </div>
                    <br>
                    <div class="form-group submit-btn d-flex justify-content-center">
                        <input type="submit" value="Login" class="btn btn-primary" name="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>

</body>
</html>