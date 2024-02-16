<!DOCTYPE html>
<?php
  session_start();

  include "../config/connection.php";

  if(!($_SESSION['admin'])){
    header('Location: includes/login.php');
  }
  if(isset($_SESSION['admin'])){
    $user = $_SESSION['username'];
    $role = $_SESSION['role_id'];
    $admins_name = $_SESSION['admins_name'];
  } else {
    header('includes/login.php');
  }

  //include "includes/header.php";

  ob_start();

  $user_query = "SELECT * FROM login LEFT JOIN users ON users.username = login.username ORDER BY user_id ASC";
  $user = mysqli_query($conn, $user_query);

?>

<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Style Sheet -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/style.css">

  <title>Report | PIMS</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><h2>X Publishers</h2></a>
    </div>
</nav>
  <br>
    <div class="container-fluid">

      <div class="container-fluid flex-row">

        <div class="d-flex justify-content-start"><a style="text-decoration:none; color:black" href="user.php"><h3>Users</h3></a></div>

        <br>
      </div>

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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</body>
</html>
<?php
  if ($_SESSION['action'] == "print"){
    echo '<script> window.print(); </script>';
  } /* elseif($_SESSION['action'] == "save"){
    date_default_timezone_set('Asia/Dhaka');
    $date = date('m/d/Y_h:i:s a', time());
    //$file_name = "report_book_" . $date . ".html";
    //file_put_contents($file_name, ob_get_clean());
    file_put_contents('report.html', ob_get_clean());
  } */
?>