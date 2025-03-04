<?php

  $host = "localhost";
  $db_username = "root";
  $db_passkey = "";
  $dbname = "facebook";
  $conn = new mysqli($host, $db_username, $db_passkey, $dbname);

  if($conn->connect_error){
    die("Connection error:". $conn->connect_error);
  }

  // Creates the user table
  $users_query = "
  CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL
    )
  ";
  $conn->query($users_query);

  //Creates table for profile
  $profile_table = "
  CREATE TABLE IF NOT EXISTS profile (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        gender VARCHAR(50) NOT NULL,
        location VARCHAR(50),
        rel_status VARCHAR(50)
    )
  ";
  $conn->query($profile_table);

?>
