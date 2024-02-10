<!DOCTYPE html>
<?php
  include 'register_header.php';
  include '../../config/connection.php';

  if(isset($_POST['register_btn'])){
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $user_phone = mysqli_real_escape_string($conn, $_POST['user_phone']);
    $user_address = mysqli_real_escape_string($conn, $_POST['user_address']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if($password != $confirm_password){
      echo '<script>alert("Password does not match.")</script>';
    }

    $secured_password = hash('sha512', $password);

    $verify_username_email = mysqli_query($conn, "SELECT login.username, users.user_email FROM login, users  WHERE users.user_email LIKE '$user_email' OR login.username LIKE '$username'");

    if(mysqli_num_rows($verify_username_email) > 0){
      echo '<script>alert("Username or Email already exists.")</script>';
    } else {
      $login_query = "INSERT INTO login (username, password, role_id) VALUES ('$username', '$secured_password', '400')";
      $login_creation = mysqli_query($conn, $login_query);

      if ($login_creation){
        $user_query = "INSERT INTO users (username, user_name, user_phone, user_email, user_address) VALUES ('$username', '$user_name', '$user_phone', '$user_email', '$user_address')";
        $user_creation = mysqli_query($conn, $user_query);

        if ($user_creation){
          header('Location: login.php');
        } else {
          sleep(2);
          header('Location: register.php');
        }
      } else {
        header('Location: register.php');
      }
    }

  }

?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Style Sheet -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="../../assets/css/style.css">
  
  <title>Register Customer | X Publishers</title>
</head>
<body>
  <div class="container">
    <div class="container-fluid">
      <br><br>
      <!-- div class="container-fluid flex-row">
        <div class="d-flex justify-content-center"><h3>Register as Customer</h3></div>
      </div -->
      <br>

      <div class="card-container">
        <div class="card">
            <div class="card-header d-flex justify-content-center">
              <h3>Register as Customer</h3>
            </div>
            <div class="card-body">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="input-group form-group">
                        <input type="text" class="form-control" placeholder="Name" name="user_name" required>
                    </div>
                    <br>
                    <div class="input-group form-group">
                        <input type="email" class="form-control" placeholder="Email" name="user_email" required>
                    </div>
                    <br>
                    <div class="input-group form-group">
                        <input type="text" class="form-control" placeholder="Phone eg. +8801XXXXXXXXX" name="user_phone" pattern="+880" required>
                    </div>
                    <br>
                    <div class="input-group form-group">
                        <input type="text" class="form-control" placeholder="Address" name="user_address">
                    </div>
                    <br>
                    <div class="input-group form-group">
                        <input type="text" class="form-control" placeholder="Username" name="username" pattern="[a-zA-Z0-9]+" required>
                    </div>
                    <br>
                    <div class="input-group form-group">
                        <input type="password" class="form-control align-middle" placeholder="Password" name="password" required>
                    </div>
                    <br>
                    <div class="input-group form-group">
                        <input type="password" class="form-control align-middle" placeholder="Confirm Password" name="confirm_password" required>
                    </div>
                    <br><br>
                    <div class="form-group submit-btn d-flex justify-content-center">
                        <input type="submit" value="Register" class="btn btn-primary" name="register_btn" name="submit">
                    </div>
                    <br>
                    <p class="d-flex justify-content-center">
                      <small>Already have an account? <a href="login.php">Login</a></small>
                    </p>
                </form>
            </div>
        </div>
      </div>

    </div>
  </div>
</body>
</html>