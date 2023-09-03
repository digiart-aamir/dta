
 <form method="post" enctype="multipart/form-data">
  <input type="file" name="photo">
  <button type="submit">Upload Photo</button> 
</form>


<?php



  // Check file is provided
if($_FILES['photo']['name']) {

    // Upload directory
    $uploadDir = '/images';
  
    // Generate random filename
    $fileName = rand(10000,99999).'.jpg';
  
    // Move uploaded file to directory
    move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir.'/'.$fileName);
  
  }


 ?>


