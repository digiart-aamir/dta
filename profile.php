
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

<div class="profile">
  <div>
    <img src="<?php echo $profile ?>" alt="Profile Picture" class="profile-pic">
    <form method="post" action="upload.php" id="uploadForm" enctype="multipart/form-data">
      
      <input type="file" name="photo" id="imageUpload" required>
      <br>
      <button type="submit">Upload Photo</button> 
    </form>
  </div>
  
  <div class="details">
    <h2 class="name"><?php echo $fname.' '; echo $lname; ?></h2>
    
    <div class="info">
      <p><b>Subjects:</b>
     <?php foreach ($topics as $topic)
     {
       echo '<p class="info_sub">'.$topic.'</p>';
     }?> </p>
    </div>
  </div>
</div>
  <!-- </section>    -->
</body>
</html>


