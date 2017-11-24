<?php
// Starting session
session_start();

  // Storing session data
   $_SESSION["firstname"] = “Attendance”;
    echo ‘Let’s Take ' . $_SESSION["firstname"] . ' ' . $_SESSION["lastname"];
// Check connection
    if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
}

    // Attempt create table query execution
    $sql = "CREATE TABLE persons(
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        first_name VARCHAR(30) NOT NULL,
        last_name VARCHAR(30) NOT NULL,
   )";
   if(mysqli_query($link, $sql)){
            echo "Table created successfully.";
        } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
           }
             /* Attempt MySQL server connection. Assuming you are running MySQL
                  25    server with default setting (user 'root' with no password) */
    $link = mysqli_connect("localhost", "root", "", "demo");

   // Check connection
   if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    // Attempt insert query execution
   $sql = "INSERT INTO persons (first_name, last_name) VALUES
               (‘Bruce’, ‘Wayne’),
               ('Clark', 'Kent),
            ('John', 'Carter'),
            ('Harry', 'Potter')";
                      if(mysqli_query($link, $sql)){
                               echo "Records added successfully.";
                           } else{
                                   echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                              }
                
                       // Close connection
                      mysqli_close($link);
                       ?>

