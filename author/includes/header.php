<!DOCTYPE html>

<?php

session_start();
if(!($_SESSION['author'])){
  header('Location: includes/login.php');
}
if(isset($_SESSION['author'])){
  $user = $_SESSION['username'];
  $role = $_SESSION['role_id'];
  $author_name = $_SESSION['author_name'];
} else {
  header('includes/login.php');
}

?>


<html lang="en">
<head>
  <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><h2>X Publishers</h2></a>
      
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

          <!-- li class="nav-item">
            <a class="nav-link" href="book.php">Book</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="category.php">Category</a>
          </li>

          <li class="nav-item">
            <a class="nav-link"  href="author.php">Authors</a>
          </li>

          <li class="nav-item">
            <a class="nav-link"  href="#">Cart</a>
          </li -->

          <li>
            <a class="nav-link" href="my_books.php">My Books</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Publish
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="publish_book.php">Book</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?php echo $author_name; ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" style="color:red!important;"  href="includes/logout.php">Logout</a></li>
            </ul>
          </li>

          <!--
          <li class="nav-item">
            <a class="nav-link"  href="sales_report.php">Sales Report</a>
          </li>
          -->

          <!--
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Login
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">User</a></li>
              <li><a class="dropdown-item" href="#">Author</a></li>
              <li><a class="dropdown-item" href="#">Admin</a></li>
            </ul>
          </li>
          -->

        </ul>
      </div>
    </div>
  </nav>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</body>
</html>