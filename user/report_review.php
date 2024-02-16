<!DOCTYPE html>
<?php
session_start();
//include "includes/header.php";
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

?>

<html>
<head>
  <!-- Style Sheet -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/style.css">

  <title>Report | PIMS</title>
</head>
<body>
    <div class="container-fluid">
    <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><h2>X Publishers</h2></a>
    </div>
    </nav>
    <br>
    <div class="container-fluid flex-row">

<div class="d-flex justify-content-start"><a style="text-decoration:none; color:black" href="review_request.php"><h3>Publish Requests</h3></a></div>

<!-- div class="d-flex justify-content-end">
  <form class="d-flex" action="<?php //echo $_SERVER['PHP_SELF']; ?>" method="post">
    <button class="btn btn-outline-success" type="submit" name="insert_btn">Insert Stock</button>
  </form>
</div -->

<br>
</div>
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
      <th scope="col">Book Script</th>
      <td><?php echo $book_script;?></td>
    </tr>
    <tr>
      <th scope="col">Authors Comment</th>
      <td><?php echo $author_comment;?></td>
    </tr>
    <tr>
      <th scope="col">Status</th>
      <td>
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
      </td>
    </tr>
  </form>
  </tbody>

    </table>
    </div>
</div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</body>
</html>

<?php
  if ($_SESSION['action'] == "print"){
    echo '<script> window.print(); </script>';
  } /* elseif($_SESSION['action'] == "save"){
    date_default_timezone_set('Asia/Dhaka');
    $date = date('m/d/Y_h:i:s a', time());
    //$file_name = "report_book_" . $date . ".html";
    //file_put_contents($file_name, ob_get_clean());
    file_put_contents('report.html', ob_get_clean());
  } */
?>