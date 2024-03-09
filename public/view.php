<!DOCTYPE html>
<?php
  include "includes/header.php";
  include '../config/connection.php';

  session_start();
  $view_book_id = $_SESSION['view_book_id'];

  $view_query = "SELECT * FROM book WHERE book_id = '$view_book_id'";
  $view = mysqli_query($conn, $view_query);

  if(isset($_POST['search_book_btn'])){
    $search_book_name = $_POST['search_book_name'];
  
    session_start();
    $_SESSION['search_book_name'] = $search_book_name;
    header('Location: searching_book.php');
  }

  if(isset($_POST['add_cart'])){
    $message = "Login to purchase!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    // header("Location: {$_SERVER['PHP_SELF']}");
  }
  

  if (mysqli_num_rows($view) > 0){
    while($row = mysqli_fetch_assoc($view)){

?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $row['book_name'];?></title>
</head>
<body>
  <div class="container">
    <div class="container-fluid">
      <br>
      <div class="container-fluid flex-row">
        <div class="d-flex justify-content-end">
          <form class="d-flex" role="search" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input class="form-control me-2" type="search" placeholder="Search Books" aria-label="Search" name="search_book_name">
            <button class="btn btn-outline-success" type="submit" name="search_book_btn">Search</button>
          </form>
        </div>
      </div>


      <br><br>
      <h1><?php echo $row['book_name'];?></h1>
      <div class="row">
        <div class="col">
          <br>
          <img src="<?php echo $row['book_cover_link']; ?>" class="img-fluid rounded-start" style= "max-width: 350px;" alt="<?php echo $row['book_name'];?>">
        </div>

        <div class="col">
          <br>
          <h3>Author: <?php echo $row['book_author'];?></h3>
          <h6>Price: <?php echo $row['book_price'];?></h6>
          <p>
            Book Pages: <?php echo $row['book_pages'];?>
            <br>
            ISBN: <?php echo $row['book_isbn_13'];?>
            <br>
            <small>Category: <?php echo $row['book_category'];?></small>
          </p>
          <br><br><br>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="hidden" name="book_id"  value="<?php echo $row['book_id'];?>">
            <button type="submit" class="btn btn-primary" name="add_cart">Purchase</button>
          </form>
        </div>

      </div>





    </div>
  </div>
</body>
</html>
<?php
    }
  }
?>