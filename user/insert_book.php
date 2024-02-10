<!DOCTYPE html>
<?php
    include "includes/header.php";
    include "../config/connection.php";


if(isset($_POST['insert_btn'])){
  //$book_id = $_POST['book_id'];
  $book_name = $_POST['book_name'];
  $book_author = $_POST['book_author'];
  $book_price = $_POST['book_price'];
  $book_category = $_POST['book_category'];
  $book_cover_link = $_POST['book_cover_link'];
  $book_pages = $_POST['book_pages'];
  $book_isbn_10 = $_POST['book_isbn_10'];
  $book_isbn_13 = $_POST['book_isbn_13'];
  $book_publication_date = $_POST['book_publication_date'];

  $query = "INSERT INTO book (book_name, book_author, book_price, book_category, book_cover_link, book_pages, book_isbn_10, book_isbn_13, book_publication_date) VALUES ('$book_name', '$book_author', '$book_price', '$book_category', '$book_cover_link', '$book_pages', '$book_isbn_10', '$book_isbn_13', '$book_publication_date')";
  $update_query = mysqli_query($conn, $query);
  if($update_query){
     header('Location: book.php');
  }
};

if(isset($_POST['cancel_btn'])){
  header('Location: book.php');
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
    <h3>Add Book Details</h3>
    <br>
    <div class="align-items-center justify-content-center">
    <div class="scrollme">
    <table class="table table-striped table-bordered table-hover table-responsive align-middle width:70% display nowrap">

  <tbody>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <br>
    <tr>
      <th scope="col">Book Name</th>
      <td><input type="text" name="book_name" class="form-control" placeholder="Book Name"></td>
    </tr>
    <tr>
      <th scope="col">Author</th>
      <td><input type="text" name="book_author" class="form-control" placeholder="Author Name"></td>
    </tr>
    <tr>
      <th scope="col">Price</th>
      <td><input type="number" name="book_price" class="form-control" placeholder="Price"></td>
    </tr>
    <tr>
      <th scope="col">Category</th>
      <td><input type="text" name="book_category" class="form-control" placeholder="Category"></td>
    </tr>
    <tr>
      <th scope="col">Cover Link</th>
      <td><input type="url" name="book_cover_link" class="form-control" pattern="https://.*" placeholder="https://url"></td>
    </tr>
    <tr>
      <th scope="col">Pages</th>
      <td><input type="text" name="book_pages" class="form-control" placeholder="Pages"></td>
    </tr>
    <tr>
      <th scope="col">ISBN-10</th>
      <td><input type="text" name="book_isbn_10" class="form-control" placeholder="ISBN-10"></td>
    </tr>
    <tr>
      <th scope="col">ISBN-13</th>
      <td><input type="text" name="book_isbn_13" class="form-control" placeholder="ISBN-13"></td>
    </tr>
    <tr>
      <th scope="col">Publication Date</th>
      <td>
        <input type="date" name="book_publication_date" class="form-control">
      </td>
    </tr>
    <tr>
      <td><button type="submit" class="btn btn-primary" name="cancel_btn">Cancel</button></td>
      <td><button type="submit" class="btn btn-warning" name="insert_btn">Add Book</button></td>
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