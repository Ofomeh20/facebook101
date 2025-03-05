<?php

  session_start();
  include 'db_connect.php';

  if (isset($_SESSION['username'])){
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      $gender = $_POST['gender'];
      $rel_status = $_POST['rel_status'];
      $location = $_POST['location'];

      $stmt = $conn->prepare("UPDATE profile SET gender=?, rel_status=?, location=? where user_id=?");
      $stmt->bind_param("ssss", $gender, $rel_status, $location, $_SESSION['user_id']);
      if ($stmt->execute()){
        header('Location: index.php');
      }else{
        $error_message = "Information could not be added";
      }
    }
  } else {
    header('Location: signup.php');
  }

?>


<!DOCTYPE html>
<html>
  <head>
    <title>Sign up</title>
    <meta name="viewport" content="width=device-width,user-scalable= no">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="index.css">
  </head>
  <body>

    <div class="container py-3">
      <h1 class="text-center">Additional information:</h1>
      <form method="POST" class="row col-9 mx-auto">

        <label class="my-2">Gender:</label>
        <select class="form-control col-9 me-1 input" name="gender">
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>

        <label class="my-2">Relationship status:</label>
        <select class="form-control col-9 input" name="rel_status">
          <option value="">Select an option</option>
          <option value="single">Single</option>
          <option value="taken">Taken</option>
          <option value="married">Married</option>
          <option value="others">Others</option>
        </select>
        
        <label class="my-1">Location:</label>
        <input type="text" class="form-control col-9 input" name="location">

        <button type="submit" class="btn btn-primary my-4 col-5 mx-auto">Submit</button>
        <button class="btn btn-primary my-4 col-5 mx-auto">
          <a href="index.php" class="nav-link">Skip</a>
        </button>
      </form>
    </div>
  </body>
</html>