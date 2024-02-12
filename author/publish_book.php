<!DOCTYPE html>
<?php
  include 'includes/header.php';
  include '../config/connection.php';

  if(isset($_POST['request_btn'])){
    $book_name = mysqli_real_escape_string($conn, $_POST['book_name']);
    $book_author = mysqli_real_escape_string($conn, $_SESSION['author_name']);
    $book_category = mysqli_real_escape_string($conn, $_POST['book_category']);
    $book_intro = $_POST['book_intro'];
    $book_script = $_POST['book_script'];
    $author_comment = $_POST['author_comment'];

    $request_query = "INSERT INTO publish (book_name, book_author, book_category, book_intro, book_script, author_comment) VALUES ('$book_name', '$book_author', '$book_category', '$book_intro', '$book_script', '$author_comment')";
    $request = mysqli_query($conn, $request_query);

    if($request){
      header('Location: index.php');
    }
  }

?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Publish Book | X Publishers</title>
</head>
<body>
  <div class="container">
    <div class="container-fluid">
    <br><br>

      <div class="card-container">
        <div class="card">
            <div class="card-header d-flex justify-content-center">
              <h3>Publish a Book</h3>
            </div>
            <div class="card-body">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="input-group form-group">
                        <input type="text" class="form-control" placeholder="Book Name" name="book_name" required>
                    </div>
                    <br>
                    <div class="input-group form-group">
                        <input type="text" class="form-control" placeholder="Book Category" name="book_category" required>
                    </div>
                    <br>
                    <div class="input-group form-group">
                        <textarea class="form-control" name="book_intro" rows="3" placeholder="Book Intro" required></textarea>
                    </div>
                    <br>
                    <div class="input-group form-group">
                        <textarea class="form-control" name="book_script" rows="5" placeholder="Book Script"></textarea>
                    </div>
                    <br>
                    <div class="input-group form-group">
                        <textarea class="form-control" name="author_comment" rows="1" placeholder="Comments"></textarea>
                    </div>

                    <br><br>
                    <div class="form-group submit-btn d-flex justify-content-center">
                        <input type="submit" value="Publish Request" class="btn btn-warning" name="request_btn" name="submit">
                    </div>
                    <br>
                </form>
            </div>
        </div>
      </div>



    </div>
  </div>
</body>
</html>