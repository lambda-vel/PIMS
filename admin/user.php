<!DOCTYPE html>
<?php
  include 'includes/header.php';
  include '../config/connection.php';

  $user_query = "SELECT * FROM login LEFT JOIN users ON users.username = login.username";
  $user = mysqli_query($conn, $user_query);

  if(isset($_POST['search_user_btn'])){
    $search_user_name = $_POST['search_user_name'];
  
    session_start();
    $_SESSION['search_user_name'] = $search_user_name;
    header('Location:  searching_user.php');
  }

?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Style Sheet -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/style.css">

  <title>Users | PIMS</title>
</head>
<body>
  <br>
  <div class="container">
    <br>
    <div class="container-fluid">
      <div class="container-fluid flex-row">

        <div class="d-flex justify-content-end">
          <form class="d-flex" role="search" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <input class="form-control me-2" type="search" placeholder="Search Users" aria-label="Search" name="search_user_name">
          <button class="btn btn-outline-success" type="submit" name="search_user_btn">Search</button>
        </form>
        </div>

        <div class="d-flex justify-content-start"><h3>Users</h3></div>
        <br>
      </div>


    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>