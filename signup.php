<?php 



    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname']; 
    $email = $_POST['email'];
    $age = $_POST['age'];
    $password = $_POST['password']; 
    $category = $_POST['category'];
    $field = $_POST['field'];
    $topics = $_POST['topics'];
    

    include "conn.php";


    $email_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn, $email_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) 
        {
            if ($user['email'] === $email) 
            {
                echo " <h1>Email already exists</h1> ";
                echo'  <meta http-equiv="refresh" content="2; URL=signup.html"> ';
            }
        } 
        else
        {
            $query = "INSERT INTO users (fname,lname,email, age,password,Category, Field)
            VALUES ('$firstname','$lastname', '$email', '$age','$password', '$category', '$field')";
            if (mysqli_query($conn, $query)) {
                echo "<h1>New record created successfully</h1>";
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }

            $query2 = "SELECT id FROM users WHERE email = '$email'";
            $result= mysqli_query($conn, $query2);
            $row= mysqli_fetch_assoc($result);
            $user_id= $row['id'];

            

            foreach ($topics as $topic) 
            {
                $query3 = "INSERT INTO topics (user_id,name)
            VALUES ('$user_id','$topic')";
                if (mysqli_query($conn, $query3)) 
                {
                    
                    echo'  <meta http-equiv="refresh" content="0.5; URL=login.html"> ';
                } else 
                {
                    echo "Error: " . $query . "<br>" . mysqli_error($conn);
                }

            
            }

        }



    










    // Print all variables
// echo "First Name: " . $firstname . "<br>";
// echo "Last Name: " . $lastname . "<br>";
// echo "Email: " . $email . "<br>";
// echo "Age: " . $age . "<br>";
// echo "Password: " . $password . "<br>";
// echo "Password: " . $hash . "<br>";
// echo "Category: " . $category . "<br>";
// echo "Field: " . $field . "<br>";
// echo "Topics:<br>";
// foreach ($topics as $topic) {
    
//   echo $topic . "<br>"; 
    
// }



?>