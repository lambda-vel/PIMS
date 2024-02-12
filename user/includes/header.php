<!DOCTYPE html>
<?php

  session_start();
  if(!($_SESSION['user'])){
    header('Location: includes/login.php');
  }
  if(isset($_SESSION['user'])){
    $user = $_SESSION['username'];
    $role = $_SESSION['role_id'];
    $users_name = $_SESSION['users_name'];
  } else {
    header('includes/login.php');
  }

?>

<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><h3>Publishers Information Management System</h3></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="book.php">Book</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Stocks
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="centralstore.php">Central Store</a></li>
            <li><a class="dropdown-item" href="headoffice.php">Head Office</a></li>
            <li><a class="dropdown-item" href="outlet.php">Outlet</a></li>
          </ul>
        </li>
        <!--
        <li class="nav-item">
          <a class="nav-link" href="purchase.php">Purchase</a>
        </li>
        -->

        <li class="nav-item">
          <a class="nav-link"  href="sales.php">Sales</a>
        </li>

        <li class="nav-item">
          <a class="nav-link"  href="publish_request.php">Requests</a>
        </li>

        <!-- li class="nav-item">
          <a class="nav-link"  href="publish_book.php">Publish</a>
        </li -->

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $users_name; ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" style="color:red!important;"  href="includes/logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>