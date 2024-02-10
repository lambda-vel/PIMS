<!DOCTYPE html>
<?php
  include "includes/header.php";
  include '../config/connection.php';

  $book_query = "SELECT * FROM book ORDER BY book_name ASC LIMIT 6";
  $book = mysqli_query($conn, $book_query);

  $author_query = "SELECT DISTINCT(book_author) FROM book ORDER BY book_author ASC LIMIT 6";
  $author = mysqli_query($conn, $author_query);

  $category_query = "SELECT DISTINCT(book_category) FROM book ORDER BY book_category ASC LIMIT 6";
  $category = mysqli_query($conn, $category_query);

if(isset($_POST['search_book_btn'])){
  $search_book_name = $_POST['search_book_name'];

  session_start();
  $_SESSION['search_book_name'] = $search_book_name;
  header('Location: searching_book.php');
}

if(isset($_POST['author_btn'])){
  $search_book_author = $_POST['book_author'];
  
  session_start();
  $_SESSION['search_book_author'] = $search_book_author;
  header('Location: searching_author.php');
}

if(isset($_POST['category_btn'])){
  $search_book_category = $_POST['book_category'];
  
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

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Style Sheet -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/style.css">

  <title>X Publishers</title>
</head>

<body>
  <div class="container">

    <!-- Books Part --------------------------------------------------------------------------------------------------->
    <br>
    <div class="container-fluid flex-row">

      <div class="d-flex justify-content-end">
        <form class="d-flex" role="search" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <input class="form-control me-2" type="search" placeholder="Search Books" aria-label="Search" name="search_book_name">
          <button class="btn btn-outline-success" type="submit" name="search_book_btn">Search</button>
        </form>
      </div>

      <div class="d-flex justify-content-start"><h3>Books</h3></div>

    </div>

    <br>

    <div class="row row-cols-1 row-cols-md-3 g-4">
<?php
  if (mysqli_num_rows($book) > 0){
    while($row = mysqli_fetch_assoc($book)){
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

    <!-- Authors Part ------------------------------------------------------------------------------------>
    <br><br><br>
    <div class="container-fluid flex-row">
      <div class="d-flex justify-content-start"><h3>Authors</h3></div>
    </div>

    <br>

    <div class="row row-cols-1 row-cols-md-3 g-4">
<?php
  if (mysqli_num_rows($author) > 0){
    while($row = mysqli_fetch_assoc($author)){
?>

  <div class="col">
    <div class="card text-center">
      <div class="card-body">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" name="book_author"  value="<?php echo $row['book_author'];?>">
        <button type="submit" class="btn btn-transparent stretched-link" name="author_btn">
          <h4 class="card-title text-center"><?php echo $row['book_author'];?></h4>
        </button>
        </form>
      </div>
    </div>
  </div>
<?php
    }
  } else {
      echo "0 author available.";
  }
?>
    </div>


    <!-- Category Part -------------------------------------------------------------------------------------------------->
    <br><br><br>
    <div class="container-fluid flex-row">
      <div class="d-flex justify-content-start"><h3>Category</h3></div>
    </div>

    <br>

    <div class="row row-cols-1 row-cols-md-3 g-4">
<?php
  if (mysqli_num_rows($category) > 0){
    while($row = mysqli_fetch_assoc($category)){
?>

  <div class="col">
    <div class="card text-center">
      <div class="card-body">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" name="book_category"  value="<?php echo $row['book_category'];?>">
        <button type="submit" class="btn btn-transparent stretched-link" name="category_btn">
          <h4 class="card-title text-center"><?php echo $row['book_category'];?></h4>
        </button>
        </form>
      </div>
    </div>
  </div>
<?php
    }
  } else {
      echo "0 category available.";
  }
?>
    </div>


    <?php include 'includes/footer.php'; ?>

  </div>
</body>