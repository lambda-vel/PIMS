<!DOCTYPE html>
<?php
  include "includes/header.php";
  include '../config/connection.php';

$book_query = "SELECT * FROM book ORDER BY book_name ASC";
$book = mysqli_query($conn, $book_query);

if(isset($_POST['search_book_btn'])){
  $search_book_name = $_POST['search_book_name'];

  //session_start();
  $_SESSION['search_book_name'] = $search_book_name;
  header('Location:  searching_book.php');
}

if(isset($_POST['view_btn'])){
  $view_book_id = $_POST['book_id'];

  //session_start();
  $_SESSION['view_book_id'] = $view_book_id;
  header('Location:  view.php');
}
?>

<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Books | X Publications</title>
    
    <!-- Style Sheet -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
  <div class="container">
    <br>
    <div class="container-fluid">
      <div class="container-fluid flex-row">

        <div class="d-flex justify-content-end">
          <form class="d-flex" role="search" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input class="form-control me-2" type="search" placeholder="Search Books" aria-label="Search" name="search_book_name">
            <button class="btn btn-outline-success" type="submit" name="search_book_btn">Search</button>
          </form>
        </div>

        <div class="d-flex justify-content-start"><h3>Books</h3></div>
        <br>

      </div>
    <br>

    <div class="row row-cols-1 row-cols-md-3 g-4">
<?php
  if (mysqli_num_rows($book) > 0){
    while($row = mysqli_fetch_assoc($book)){
?>
  <div class="col">
  <div class="card mb-3" style="max-width: 400px;">

  <div class="card-info">
    <div class="row g-0">
      <div class="col-md-4">
        <!-- <?php //echo $row['book_cover_link'];?> -->
        <img src="<?php echo $row['book_cover_link']; ?>" class="img-fluid rounded-start" alt="<?php echo $row['book_name'];?>">
      </div>
      <div class="col-md-8">
        <div class="card-body">

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
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" name="book_id"  value="<?php echo $row['book_id'];?>">
        <button type="submit" class="btn btn-info" name="view_btn">View</button>
        <button type="submit" class="btn btn-warning" name="add_cart">Add to Cart</button>
      </form>
    </div>


  </div>
  </div>
<?php
    }
  } else {
      echo "0 books available.";
  }
?>
    </div>



<!--
  <table class="table table-striped table-hover table-responsive align-middle width:100% display nowrap">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Book ID</th>
      <th scope="col">Name</th>
      <th scope="col">Author</th>
      <th scope="col">Price</th>
      <th scope="col">Category</th>
    </tr>
  </thead>
  <tbody>
  

  <?php /*
          if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
              ?>
             <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <tr>
                <!-- <input type="hidden" name="book_id"  value="<?php echo $row['book_id'];?>"> -->
                <td><?php echo $row['book_id'];?></td>
                <td><?php echo $row['book_name'];?></td>
                <td><?php echo $row['book_author'];?></td>
                <td><?php echo $row['book_price'];?></td>
                <td><?php echo $row['book_category'];?></td>
                </tr>
              </form>
                <?php }
        } else {
            echo "0 results";
        }
        */
        ?>

  </tbody>
</table>
-->

</div>
</div>
</body>
</html>