<!DOCTYPE html>
<?php
  include 'includes/header.php';
  include '../config/connection.php';

  session_start();
  $search_book_category = $_SESSION['search_book_category'];

  $searching_category_query = "SELECT * FROM book WHERE book_category LIKE '%$search_book_category%';";
  $searching_book = mysqli_query($conn, $searching_category_query);

  $num_rows = mysqli_num_rows($searching_book);

  if(isset($_POST['search_category_btn'])){
    $search_book_category = $_POST['search_book_category'];
  
    session_start();
    $_SESSION['search_book_category'] = $search_book_category;
    header('Location: searching_category.php');
  }

  if(isset($_POST['view_btn'])){
    $view_book_id = $_POST['book_id'];
  
    session_start();
    $_SESSION['view_book_id'] = $view_book_id;
    header('Location:  view.php');
  }

?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/style.css">

  <title>Searching Books</title>
</head>
<body>
  <div class="container">
    <br>
    <div class="container-fluid">
    <div class="container-fluid flex-row">

      <div class="d-flex justify-content-end">
        <form class="d-flex" role="search" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <input class="form-control me-2" type="search" value="<?php echo $search_book_category;?>" aria-label="Search" name="search_book_category">
          <button class="btn btn-outline-success" type="submit" name="search_category_btn">Search</button>
        </form>
      </div>

      <br>

      <div class="d-flex justify-content-start">
        <h3>Searching "<?php echo $search_book_category;?>"</h3>
      </div>
      <br>
        <?php echo "{$num_rows} results";?>
      <br>

    </div>

    <br>

    <div class="row row-cols-1 row-cols-md-3 g-4">
<?php
  if (mysqli_num_rows($searching_book) > 0){
    while($row = mysqli_fetch_assoc($searching_book)){
?>
  <div class="col">
  <div class="card mb-3" style="max-width: 400px;">
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="card-info">
    <div class="row g-0">
      <div class="col-md-4">
        <!-- <?php //echo $row['book_cover_link'];?> -->
        <img src="<?php echo $row['book_cover_link']; ?>" class="img-fluid rounded-start" alt="<?php echo $row['book_name'];?>">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <input type="hidden" name="book_id"  value="<?php echo $row['book_id'];?>">
          
            <h5 class="card-title"><?php echo $row['book_name'];?></h5>


          <h6 class="card-title">Author: <?php echo $row['book_author'];?></h6>
          <p class="card-text">Price: <?php echo $row['book_price'];?></p>
          <p class="card-text">
            <?php // echo $row['book_pages'];?>
            <?php // echo $row['book_isbn_13'];?>
            <?php // echo $row['book_publication_date'];?>
            <br>
            <small class="text-body-secondary">Category: <?php echo $row['book_category'];?></small>
          </p>
        </div>
      </div>
    </div>
    </div>
    <div class="card-footer">
          <button type="submit" class="btn btn-info" name="view_btn">View</button>
          <button type="submit" class="btn btn-warning" name="add_cart">Add to Cart</button>
    </div>
    </form>

  </div>
  </div>
<?php
    }
  } else {
      echo "0 books available.";
  }
?>
    </div>

    </div>
  </div>
</body>
</html>