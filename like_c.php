<?php

    include "session.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        // Handle form submission and database insertion here
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the values from the form
            $c_id = $_POST['c_id'];
            $user_id = $id;
        
            // Prepare and execute the SQL INSERT statement
            $sql = "INSERT INTO islike_c (c_id, user_id) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
        
            if ($stmt) 
            {
                $stmt->bind_param("ii", $c_id, $user_id); // "ii" means two integer parameters
                if ($stmt->execute()) 
                {
                    $c_id = intval($c_id);
                    $sql2 = "UPDATE comments SET c_likes = c_likes + 1 WHERE c_id = ?";
                    $stmt2 = $conn->prepare($sql2);
                    if ($stmt2) {
                        $stmt2->bind_param("i", $c_id); // "i" means an integer parameter
                        if ($stmt2->execute()) {
                            echo '<meta http-equiv="refresh" content="0.1; URL=dashboard.php">';
                        } else {
                            echo "Error: " . $stmt2->error;
                        }
                        $stmt2->close();
                    } else {
                        echo "Error: " . $conn->error;
                    }
                    
                    
                } 
                else 
                {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error: " . $conn->error;
            }
        }
        
    }
?>