<!DOCTYPE html>
<?php
  include 'includes/header.php';
  include '../config/connection.php';

  $user_query = "SELECT * FROM login LEFT JOIN users ON users.username = login.username ORDER BY user_id ASC";
  $user = mysqli_query($conn, $user_query);

  if(isset($_POST['search_user_btn'])){
    $search_user_name = $_POST['search_user_name'];
  
    //session_start();
    $_SESSION['search_user_name'] = $search_user_name;
    header('Location: searching_user.php');
  }

  if(isset($_POST['update_btn'])){
    //$update_username = $_POST['username'];
    $update_user_id = $_POST['user_id'];

    if($update_user_id == 2){
      echo '<script>alert("Insufficient Privilege!")</script>';
      //header('Location: user.php');
    } elseif ($update_user_id == 1){
      echo '<script>alert("Insufficient Privilege!")</script>';
    } else {
      $update_user_id = $_POST['user_id'];

      $_SESSION['update_user_id'] = $update_user_id;
      header('Location: update_user.php');
    }
  }

  if(isset($_POST['print_btn'])){
    $_SESSION['action'] = "print";
    header('Location: report_user.php');
  }

?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <title>Users | PIMS</title>
</head>
<body>
  <br>
  <div class="container">
    <br>
    <div class="container-fluid">
      <div class="container-fluid flex-row">
        <div class="d-flex justify-content-end">
          <form class="d-flex" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <!-- button class="btn btn-secondary" type="submit" name="save_btn">Save</button>
            &nbsp; &nbsp; -->
            <button class="btn btn-secondary" type="submit" name="print_btn">Print Report</button>
          </form>
        </div>

        <div class="d-flex justify-content-start"><h3>Users</h3></div>

        <div class="d-flex justify-content-end">
          <form class="d-flex" role="search" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <input class="form-control me-2" type="search" placeholder="Search Users" aria-label="Search" name="search_user_name">
          <button class="btn btn-outline-success" type="submit" name="search_user_btn">Search</button>
        </form>
        </div>
        <br>
      </div>

      <br>

      <div class="scrollme">
        <table class="table table-striped table-hover table-responsive align-middle width:100% display nowrap">
          <thead>
            <tr>
              <!--<th scope="col">#</th>-->
              <th scope="col">Name</th>
              <th scope="col">Username</th>
              <th scope="col">Phone</th>
              <th scope="col">Email</th>
              <th scope="col">Address</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
       
          <?php
            if (mysqli_num_rows($user) > 0) {
              // output data of each row
              while($row = mysqli_fetch_assoc($user)) {
          ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
              <tr>
                <input type="hidden" name="user_id"  value="<?php echo $row['user_id'];?>">
                <td><?php echo $row['user_name'];?></td>
                <td><?php echo $row['username'];?></td>
                <td><?php echo $row['user_phone'];?></td>
                <td><?php echo $row['user_email'];?></td>
                <td><?php echo $row['user_address'];?></td>
                <td><button type="submit" class="btn btn-warning" name="update_btn">Update</button></td>
                <!-- td><a class="btn btn-danger" href="book.php?remove=<?php //echo $row['book_id']; ?>">Delete</a></td -->
              </tr>
            </form>
          <?php }
            } else {
              echo "0 Users Found.";
            }
          ?>


          </tbody>
        </table>


    </div>
  </div>


</body>
</html>