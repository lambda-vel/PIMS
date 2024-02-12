<!DOCTYPE html>
<?php
  include "includes/header.php";
  include "../config/connection.php";

  $publish_id = $_SESSION['publish_id'];

  $book_info_query = "SELECT * FROM publish WHERE id = '$publish_id'";
  $book_info = mysqli_query($conn, $book_info_query);

  if (mysqli_num_rows($book_info) > 0) {
    $info = mysqli_fetch_assoc($book_info);

    $book_id = $info['id'];
    $book_name = $info['book_name'];
    $book_author = $info['book_author'];
    $book_category = $info['book_category'];
  }


if(isset($_POST['publish_btn'])){
  $book_name = $_POST['book_name'];
  $book_author = $_POST['book_author'];
  $book_price = $_POST['book_price'];
  $book_category = $_POST['book_category'];
  $book_cover_link = $_POST['book_cover_link'];
  $book_pages = $_POST['book_pages'];
  $book_isbn_10 = $_POST['book_isbn_10'];
  $book_isbn_13 = $_POST['book_isbn_13'];
  $book_publication_date = $_POST['book_publication_date'];

  $publish_query = "INSERT INTO book (book_name, book_author, book_price, book_category, book_cover_link, book_pages, book_isbn_10, book_isbn_13, book_publication_date) VALUES ('$book_name', '$book_author', '$book_price', '$book_category', '$book_cover_link', '$book_pages', '$book_isbn_10', '$book_isbn_13', '$book_publication_date')";
  $publish = mysqli_query($conn, $publish_query);
  if($publish){
    $publish_id = $_SESSION['publish_id'];
    $update_query = "UPDATE publish SET status = 2 WHERE id = '$publish_id'";
    $update = mysqli_query($conn, $update_query);
    
    if($update){
      header('Location: book.php');
    }
  } else {
    header('Location: publish_book.php');
  }
};

if(isset($_POST['back_btn'])){
  header('Location: review_request.php');
}

?>


<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Book Info | PIMS</title>
    
    <!-- Style Sheet -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <br>
  <div class="container">

    <div class="container-fluid">
    <h4>Publish Book : <em><?php echo $info['book_name'];?></em></h4>
    <br>
    <div class="align-items-center justify-content-center">
    <div class="scrollme">
    <table class="table table-striped table-bordered table-hover table-responsive align-middle width:70% display nowrap">

  <tbody>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <tr>
      <th scope="col">Book Name</th>
      <td><input type="text" name="book_name" class="form-control" value="<?php echo $book_name;?>"></td>
    </tr>
    <tr>
      <th scope="col">Author</th>
      <td><input type="text" name="book_author" class="form-control" value="<?php echo $book_author;?>"></td>
    </tr>
    <tr>
      <th scope="col">Price</th>
      <td><input type="number" name="book_price" class="form-control"></td>
    </tr>
    <tr>
      <th scope="col">Category</th>
      <td><input type="text" name="book_category" class="form-control" value="<?php echo $book_category;?>"></td>
    </tr>
    <tr>
      <th scope="col">Cover Link</th>
      <td><input type="url" name="book_cover_link" class="form-control" pattern="https://.*" placeholder="https://"></td>
    </tr>
    <tr>
      <th scope="col">Pages</th>
      <td><input type="text" name="book_pages" class="form-control"></td>
    </tr>
    <tr>
      <th scope="col">ISBN-10</th>
      <td><input type="text" name="book_isbn_10" class="form-control"></td>
    </tr>
    <tr>
      <th scope="col">ISBN-13</th>
      <td><input type="text" name="book_isbn_13" class="form-control"></td>
    </tr>
    <tr>
      <th scope="col">Publication Date</th>
      <td>
        <input type="date" name="book_publication_date" class="form-control">
      </td>
    </tr>
    <tr>
      <td>
        <button type="submit" class="btn btn-primary" name="back_btn">Back</button>
      </td>
      <td>
        <button type="submit" class="btn btn-warning" name="publish_btn">Publish Book</button>
      </td>
    </tr>
  </form>
  </tbody>

    </table>
    </div>

    </div>
  </div>
  </div>
</body>
</html>