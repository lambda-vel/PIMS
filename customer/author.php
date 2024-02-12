<!DOCTYPE html>
<?php
  include 'includes/header.php';
  include '../config/connection.php';

  $author_query = "SELECT DISTINCT(book_author) FROM book ORDER BY book_author ASC;";
  $author = mysqli_query($conn, $author_query);

  $num_rows = mysqli_num_rows($author);

  if(isset($_POST['search_author_btn'])){
    $search_book_author = $_POST['search_book_author'];
  
    //session_start();
    $_SESSION['search_book_author'] = $search_book_author;
    header('Location: searching_author.php');
  }

  if(isset($_POST['author_btn'])){
    $search_book_author = $_POST['book_author'];
    
    //session_start();
    $_SESSION['search_book_author'] = $search_book_author;
    header('Location: searching_author.php');
  }

?>


<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Style Sheet -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/style.css">

  <title>Authors | X Publications</title>
</head>
<body>
  <div class="container">
    <br>
    <div class="container-fluid">
      <div class="container-fluid flex-row">

        <div class="d-flex justify-content-end">
          <form class="d-flex" role="search" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input class="form-control me-2" type="search" placeholder="Search Authors" aria-label="Search" name="search_book_author">
            <button class="btn btn-outline-success" type="submit" name="search_author_btn">Search</button>
          </form>
        </div>

        <div class="d-flex justify-content-start"><h3>Authors</h3></div>
        <br>

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


    </div>
  </div>
</body>
</html>