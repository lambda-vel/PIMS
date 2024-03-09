<!DOCTYPE html>
<?php
    include "includes/header.php";
    include "../config/connection.php";

  $review_id = $_SESSION['review_id'];

  $sql = "SELECT * FROM publish WHERE id = '$review_id'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $id = $row['id'];
    $book_name = $row['book_name'];
    $book_author = $row['book_author'];
    $book_category = $row['book_category'];
    $book_intro = $row['book_intro'];
    $book_script = $row['book_script'];
    $author_comment = $row['author_comment'];
    $status = $row['status'];
  }

if(isset($_POST['pending_btn'])){
  $update_review_id = $_POST['review_id'];
  $query = "UPDATE publish SET status = 0 WHERE id = '$update_review_id'";
  $update_query = mysqli_query($conn, $query);
  if($update_query){
     header('Location: publish_request.php');
  }
};

if(isset($_POST['denied_btn'])){
  $update_review_id = $_POST['review_id'];
  $query = "UPDATE publish SET status = -1 WHERE id = '$update_review_id'";
  $update_query = mysqli_query($conn, $query);
  if($update_query){
     header('Location: publish_request.php');
  }
};

if(isset($_POST['approved_btn'])){
  $update_review_id = $_POST['review_id'];
  $query = "UPDATE publish SET status = 1 WHERE id = '$update_review_id'";
  $update_query = mysqli_query($conn, $query);
  if($update_query){
     header('Location: publish_request.php');
  }
};

if(isset($_POST['cancel_btn'])){
  header('Location: publish_request.php');
}

if(isset($_POST['publish_btn'])){
  $publish_id = $_POST['review_id'];
  $_SESSION['publish_id'] = $publish_id;
  header('Location: publish_book.php');
}

if(isset($_POST['print_btn'])){
  $_SESSION['action'] = "print";
  header('Location: report_review.php');
}

?>


<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Review Publish Requests | PIMS</title>
    
    <!-- Style Sheet -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <br>
  <div class="container">

    <div class="container-fluid">
    <div class="container-fluid flex-row">
  <div class="d-flex justify-content-end">
  <form class="d-flex" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <!-- button class="btn btn-secondary" type="submit" name="save_btn">Save</button>
    &nbsp; &nbsp; -->
    <button class="btn btn-secondary" type="submit" name="print_btn">Print Report</button>
  </form>
  </div>

        <div class="d-flex justify-content-start"><h4>Book Details : <em><?php echo $row['book_name'];?></em></h4></div>

        <br>
      </div>
    <br>
    <div class="align-items-center justify-content-center">
    <div class="scrollme">
    <table class="table table-striped table-bordered table-hover table-responsive align-middle width:70% display nowrap">

  <tbody>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <tr>   <!--<th scope="col">#</th>-->
      <th scope="col">Request ID</th>
      <td><?php echo $id;?></td>
      <input type="hidden" name="review_id" value="<?php echo $id;?>">
    </tr>
    <tr>
      <th scope="col">Book Name</th>
      <td><?php echo $book_name;?></td>
    </tr>
    <tr>
      <th scope="col">Authors Name</th>
      <td><?php echo $book_author;?></td>
    </tr>
    <tr>
      <th scope="col">Category</th>
      <td><?php echo $book_category;?></td>
    </tr>
    <tr>
      <th scope="col">Book Intro</th>
      <td><?php echo $book_intro;?></td>
    </tr>
    <tr>
      <th scope="col">Authors Comment</th>
      <td><?php echo $author_comment;?></td>
    </tr>
    <tr>
      <th scope="col">Status</th>
      <td>
        <div class="dropdown">
          <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <?php 
          if($row['status'] == "0"){
            echo "Pending";
          } elseif ($row['status'] == "-1"){
            echo "Denied";
          } elseif ($row['status'] == "1"){
            echo "Approved";
          } elseif ($row['status'] == "2"){
            echo "Published";
          } else {
            echo "Unknown";
          }
          ?>
          </button>
          <ul class="dropdown-menu">
            <li><button type="submit" class="dropdown-item" name="pending_btn">Pending</button></li>
            <li><button type="submit" class="dropdown-item" name="denied_btn">Denied</button></li>
            <li><button type="submit" class="dropdown-item" name="approved_btn">Approved</button></li>
          </ul>
        </div>
      </td>
    </tr>

    <tr>
      <td>
        <button type="submit" class="btn btn-primary" name="cancel_btn">Cancel</button>
      </td>
      <td>
        <button type="submit" class="btn btn-warning" name="publish_btn">Proceed to Publish</button>
      </td>
    </tr>

    <tr>
      <th scope="col" colspan="2">Book Script</th>
    </tr>
    <tr>
      <td colspan="2">
        <textarea class="form-control" rows="5" readonly="readonly" onkeyup="textAreaAdjust(this)"><?php echo $book_script;?></textarea>
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