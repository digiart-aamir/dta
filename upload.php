<?php

  include 'session.php';

  // Check file is provided
if($_FILES['photo']['name']) {

    // Upload directory
    $uploadDir = 'C:\xampp\htdocs\dta\images';
  
    // Generate random filename
    $fileName = rand(10000,99999).'.jpg';
  
    // Move uploaded file to directory
    move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir.'/'.$fileName);
  
  }
  // Load image
  $profile = 'images/'.$fileName;
  $sql = "UPDATE users SET profile = '$profile' 
        WHERE id = {$id}";

if(mysqli_query($conn,$sql) === TRUE) {
  echo "Record updated successfully"; 
} else {
  echo "Error updating record: " . $conn->error;
}





 ?>