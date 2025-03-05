<?php

  session_start();
  $_SESSION['username'] = null;
  $_SESSION['user_id'] = null;
  include 'db_connect.php';
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cnfm_password = $_POST['cnfm_password'];
    $alrd_exists = false;

    $result = $conn->query("SELECT * FROM users");

    while ($row = $result->fetch_assoc()) {
      if ($email == $row['email'] && password_verify($password, $row['password'])){
        $alrd_exists = true;
        break;
      } else {
        $alrd_exists = false;
      }
    }



    if ($password === $cnfm_password){
      if($alrd_exists == false){
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?,?,?)");
        $stmt->bind_param("sss", $username, $email, $password_hash);


        if ($stmt->execute()){
          $_SESSION['username'] = $username;
          $_SESSION['user_id'] = $email.$password_hash;


          $stmt = $conn->prepare("INSERT INTO profile (username, user_id) VALUES (?,?)");
          $stmt->bind_param("ss", $_SESSION['username'], $_SESSION['user_id']);
          if ($stmt->execute()){
            header('Location: index.php');
          }else{
            $error_message = "Information could not be added";
          }


          header('Location: profile_info.php');
        }else{
          $error_message = "Registration failed";
        }


      } else {
        $error_message = "Account already exists";
      }
    } else {
      $error_message = "Passwords are not the same";
    }
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
      <h1 class="text-center">Sign up</h1>

      <!--Displays an error message if there is something wrong with the form input-->
      <?php
        if (isset($error_message)) {
            echo '<div class="alert alert-warning mx-auto col-11 col-md-10 col-lg-8">'.$error_message.'</div>';
            unset($error_message);
        }
      ?>

      <!--SIgn up form-->
      <form method="POST" class="row col-9 mx-auto">
        <label class="my-1">Your username:</label>
        <input type="text" name="username" class="form-control col-9 input">

        <label class="my-1">Your E-mail:</label>
        <input type="email" name="email" class="form-control col-9 input">

        <label class="my-1">Your password:</label>
        <input type="password" name="password" class="form-control col-9 input">

        <label class="my-1">Confirm password:</label>
        <input type="password" name="cnfm_password" class="form-control col-9 input">

        <button type="submit" class="btn btn-primary my-4">Submit</button>
      </form>
    </div>
  </body>
</html>