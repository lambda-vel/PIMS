<!DOCTYPE html>
<?php
  include "includes/header.php";
  include "../config/connection.php";

//On page 1
//$_SESSION['varname'] = $var_value;

//On page 2
//$var_value = $_SESSION['varname'];

  $update_user_id = $_SESSION['update_user_id'];

  $sql = "SELECT * FROM users WHERE user_id = '$update_user_id'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $user_id = $row['user_id'];
    $user_name = $row['user_name'];
    $username = $row['username'];
    $user_phone = $row['user_phone'];
    $user_email = $row['user_email'];
    $user_address = $row['user_address'];
  }


if(isset($_POST['update_btn'])){
  $update_user_name = $_POST['update_user_name'];
  $update_username = $_POST['update_username'];
  $update_user_phone = $_POST['update_user_phone'];
  $update_user_email = $_POST['update_user_email'];
  $update_user_address = $_POST['update_user_address'];

  $query = "UPDATE users SET username='$update_username', user_name = '$update_user_name', user_phone='$update_user_phone', user_email='$update_user_email', user_address='$update_user_address' WHERE user_id = '$user_id'";
  $update_query = mysqli_query($conn, $query);
  if($update_query){
     header('Location: user.php');
  }
};

if(isset($_POST['cancel_btn'])){
  header('Location: user.php');
}

if(isset($_GET['remove'])){
  $remove_id = $_GET['remove'];
  
  $remove_user_query = "DELETE FROM users WHERE user_id = '$remove_id'";
  $remove_user = mysqli_query($conn, $remove_user_query);

  if ($remove_user){
    $remove_login_query = "DELETE FROM login WHERE username = '$username'";
    $remove_login = mysqli_query($conn, $remove_login_query);

    if ($remove_login){
      header('Location: user.php');
    } else {
      $query = "UPDATE users SET user_name = '$update_user_name', username='$update_username', user_phone='$update_user_phone', user_email='$update_user_email', user_address='$update_user_address' WHERE user_id = '$update_user_id'";
      $update_query = mysqli_query($conn, $query);
    }
  }
};
?>


<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update User Info | PIMS</title>
    
    <!-- Style Sheet -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <br>
  <div class="container">

    <div class="container-fluid">
    <h3>User Details >> <?php echo $row['username'];?></h3>
    <br>
    <div class="align-items-center justify-content-center">
    <div class="scrollme">
    <table class="table table-striped table-bordered table-hover table-responsive align-middle width:70% display nowrap">

  <tbody>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

    <tr>
      <th scope="col">Name</th>
      <td><input type="text" name="update_user_name" class="form-control" value="<?php echo $user_name;?>"></td>
    </tr>
    <tr>
      <th scope="col">Username</th>
      <td><input type="text" name="update_username" class="form-control" value="<?php echo $username;?>"></td>
    </tr>
    <tr>
      <th scope="col">Phone</th>
      <td><input type="text" name="update_user_phone" class="form-control" pattern="+880" placeholder="+8801XXXXXXXXX" value="<?php echo $user_phone;?>"></td>
    </tr>
    <tr>
      <th scope="col">Email</th>
      <td><input type="email" name="update_user_email" class="form-control" value="<?php echo $user_email;?>"></td>
    </tr>
    <tr>
      <th scope="col">Address</th>
      <td><input type="text" name="update_user_address" class="form-control" value="<?php echo $user_address;?>"></td>
    </tr>
    
    <tr>
      <td colspan="2" class="">
        <button type="submit" class="btn btn-primary" name="cancel_btn">Cancel</button>
        <button type="submit" class="btn btn-warning" name="update_btn">Update</button>
        <a class="btn btn-danger" href="update_user.php?remove=<?php echo $row['user_id']; ?>">Delete</a>
      </td>
    </tr>
  </form>
  </tbody>

    </table>
    </div>

    </div>
  </div>
  </div>
</body>
</html>