<!DOCTYPE html>
<?php
  include 'includes/header.php';
  include '../config/connection.php';

  $search_user_name = $_SESSION['search_user_name'];

  $searching_user_query = "SELECT * FROM users WHERE user_name LIKE '%$search_user_name%';";
  $searching_user = mysqli_query($conn, $searching_user_query);

  $num_rows = mysqli_num_rows($searching_user);

  if(isset($_POST['search_user_btn'])){
    $search_user_name = $_POST['search_user_name'];
  
    $_SESSION['search_user_name'] = $search_user_name;
    header('Location: searching_user.php');
  }

  if(isset($_POST['view_btn'])){
    $view_user_id = $_POST['user_id'];
  
    $_SESSION['view_user_id'] = $view_user_id;
    header('Location: view.php');
  }

?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Searching Users</title>
</head>
<body>
  <div class="container">
    <br>
    <div class="container-fluid">
    <div class="container-fluid flex-row">

    <div class="container-fluid flex-row">

<div class="d-flex justify-content-end">
  <form class="d-flex" role="search" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <input class="form-control me-2" type="search" placeholder="Search Users" aria-label="Search" name="search_user_name" value="<?php echo $search_user_name;?>">
  <button class="btn btn-outline-success" type="submit" name="search_user_btn">Search</button>
</form>
</div>

<div class="d-flex justify-content-start"><h3>Users</h3></div>
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
    if (mysqli_num_rows($searching_user) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($searching_user)) {
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
        <!-- td><a class="btn btn-danger" href="book.php?remove=<?php // echo $row['book_id']; ?>">Delete</a></td -->
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