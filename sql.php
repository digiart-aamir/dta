<?php

        $conn = mysqli_connect('localhost','root','','dta2');

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

     
// Assuming you have a database connection established

// Query to retrieve thread IDs and their like limits
$threadQuery = "SELECT t_id, t_likes FROM threads";

$result = mysqli_query($conn, $threadQuery);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $t_id = $row['t_id'];
        $likeLimit = $row['t_likes'];
        
        // Query to insert likes for the current thread
        $insertLikesQuery = "INSERT INTO islike_t (t_id, user_id)
                             SELECT $t_id AS t_id, id
                             FROM (
                                 SELECT id
                                 FROM users
                                 ORDER BY RAND()
                                 LIMIT $likeLimit
                             ) AS random_users";
        
        mysqli_query($conn, $insertLikesQuery);
    }
    
    mysqli_free_result($result);
}

// Close the database connection
mysqli_close($conn);

        


?>