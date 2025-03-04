<?php

  include 'db_connect.php';
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cnfm_password = $_POST['cnfm_password'];

    $result = $conn->query("");

    while ($row = ) {
      # code...
    }



    if ($password === $cnfm_password){
      $password_hash = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?,?,?)");
      $stmt->bind_param("sss", $username, $email, $password_hash);
      if ($stmt->execute()){
        header('Location: profile_info.php');
      }else{
        $error_message = "Registration failed";
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
      <?php

        if ( isset($error_message) ) {
            echo '<div class="alert alert-warning mx-auto col-11 col-md-10 col-lg-8">'.$error_message.'</div>';
            unset($error_message);
        }
    ?>
      <form method="POST" class="row col-9 mx-auto">
        <label class="my-1">Your username:</label>
        <input type="text" name="username" class="form-control col-9 input">

        <label class="my-1">Your E-mail:</label>
        <input type="email" name="email" class="form-control col-9 input">

        <label class="my-1">Your password:</label>
        <input type="password" name="password" class="form-control col-9 input">

        <label class="my-1">Confirm password:</label>
        <input type="password" name="cnfm_password" class="form-control col-9 input">

        <!--
        <label class="my-2 fw-bold">Additional information:</label>

        <label class="my-2">Gender:</label>
        <select class="form-control col-9 me-1 input" name="gender">
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>

        <label class="my-2">Relationship status:</label>
        <select class="form-control col-9 input" name="rel-status">
          <option>Single</option>
          <option>Taken</option>
          <option>Married</option>
          <option>Others</option>
        </select>
        
        <label class="my-1">Location:</label>
        <input type="text" class="form-control col-9 input" name="location">
      -->
        <button type="submit" class="btn btn-primary my-4">Submit</button>
      </form>
    </div>
  </body>
</html>