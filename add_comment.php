<?php
    include "session.php";

    $user_id = $_POST['user_id']; 
    $t_c_id = $_POST['t_id'];
    $comment = $_POST['comment'];
    
    
    $query = "INSERT INTO comments (user_id,t_c_id,value)
    VALUES ( '$user_id', '$t_c_id','$comment')";
    if (mysqli_query($conn, $query)) 
    {
        echo'  <meta http-equiv="refresh" content="0.1; URL=dashboard.php"> ';
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }



?>