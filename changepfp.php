<?php

    session_start();
    include 'db_connect.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $target_dir = "profile_pics/";
        $imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));
        //Generate a unique name for the pic
        $newFileName = uniqid() . '.' . $imageFileType;
        $target_file = $target_dir . $newFileName;
        $uploadOk = 1;
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
            } else {
            echo "File is not an image.";
            $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 10000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Sorry, only JPG, JPEG & PNG files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". $newFileName ." has been uploaded.";
            $ready = true;
            } else {
            echo "Sorry, there was an error uploading your file.";
            }
        }

        if ($ready == true){
            $stmt = $conn->prepare("UPDATE profile SET profile_pic=? where user_id=?");
            $stmt->bind_param("ss", $target_file, $_SESSION['user_id']);
            if ($stmt->execute()){
                header('Location: index.php');
            }else{
                $error_message = "Couldn't upload your image";
            }
        } else {
            $error_message = "Couldn't upload your image";
        }
    }

?>



<!DOCTYPE html>
<html>
  <head>
    <title>Sign up</title>
    <meta name="viewport" content="width=device-width,user-scalable= no" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="index.css" />
  </head>
  <body>
    <div class="container-md py-3">
      <h1 class="text-center">Additional information:</h1>
      <form method="POST" class="row col-11 col-md-9 mx-auto" enctype="multipart/form-data">

        <label class="my-2">Upload a profile picture:</label>
        <input class="form-control" type="file" name="fileToUpload" onchange="imgpreview(event)" required>
        <img src="#" alt="Image preview" id="preview" class="col-8 mx-auto d-none my-2">


        <button type="submit" class="btn btn-primary my-4 col-5 mx-auto" name="submit">Submit</button>
      </form>
    </div>


    <script>
      function imgpreview(event) {
        const file = event.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function (e) {
            const preview = document.getElementById('preview');
            preview.src = e.target.result;
            preview.classList.remove('d-none');
            preview.classList.add('d-block');
          }
          reader.readAsDataURL(file);
        }
      }
    </script>


  </body>
</html>