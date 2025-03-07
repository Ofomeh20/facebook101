<?php

  session_start();
  include "db_connect.php";
  $stmt= $conn->prepare("SELECT * FROM profile WHERE user_id=?");
  $stmt->bind_param('s', $_SESSION['user_id']);
  $stmt->execute();

  $result = $stmt->get_result();
  $row= $result->fetch_assoc();



?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile Page</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="index.css" />
    <style>
      body {
        font-family: Arial, sans-serif;
      }

      #profile_pic {
        background: url("<?php
           if ($row['profile_pic'] != null || $row['profile_pic'] != "") {
            echo $row['profile_pic'];
           } else {
            echo "profile_pics/67ca1ac3cb03a.png";
           } ?>");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        height: 8rem;
        width: 8rem;
        border-radius: 50%;
      }
    </style>
  </head>
  <body class="pt-4">
      <div class="col-10 col-md-7 mx-auto p-4 my-auto border input">
        <div id="profile_pic"></div>
        <button class="btn btn-primary col-5 mt-2">
          <a href="changepfp.php" class="nav-link">Edit Profile picture</a>
        </button>

        <p class="fs-4 fw-bold my-2 ms-4"><?php echo $row['username'] ?><p>
          <hr>
        <ul class="text-nowrap">
          <?php
        
            if($row['location'] !== "" && $row['location'] !== null) {
              echo "<li>Lives in " . $row['location'] . "</li>";
            }

            if($row['rel_status'] !== "" && $row['rel_status'] !== null) {
              echo "<li>Is " . $row['rel_status'] . "</li>";
            }

            if($row['gender'] !== "" && $row['gender'] !== null) {
              if ($row['gender'] == "male") {
                $gender = "Boy";
              } else {
                $gender = "Girl";
              }
              echo "<li>Is a " . $gender . "</li>";
            }

          ?>
        </ul>
        <button class="btn btn-primary col-5 mt-5">
          <a href="profile_info.php" class="nav-link">Edit Profile</a>
        </button>
      </div>
  </body>
</html>
