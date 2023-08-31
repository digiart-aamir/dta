<?php 

    include "conn.php";

    
    

        // Get username/email and password from POST request
        $email = $_POST['email']; 
        $password = $_POST['password'];
        

        $sql = "SELECT * FROM users WHERE email = '$email'  AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);


        if ($count == 1) 
        {
        
          session_start();
          $_SESSION['email'] = $email;
          header('location:dashboard.php');
          exit;
        }
        else 
        {
            // If there is no match, show an error message
            echo '<p>Invalid email or password</p>';
            echo'  <meta http-equiv="refresh" content="20.1; URL=login.html"> ';
        }

    

?>