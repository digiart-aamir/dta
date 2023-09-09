<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    








<?php


// Construct the SQL query
$sql = "SELECT
            t.t_id,
            t.t_title,
            t.t_content,
            t.user_id,
            u.fname,
            u.lname,
            u.profile
        FROM
            threads t
        LEFT JOIN
            users u ON t.user_id = u.id
        LEFT JOIN
            topics tp ON u.id = tp.user_id
        WHERE
            t.t_type = '' OR t.t_type = '$field'
        GROUP BY
            t.t_id, t.t_title, t.t_content, t.user_id, u.fname, u.lname, u.profile
        ORDER BY
            t.t_likes DESC";

// Execute the query
$result = $conn->query($sql);

// Check for errors
if (!$result) 
{
    echo "Error: " . $conn->error;
} 
else 
{
    // Print the results
    while ($row = $result->fetch_assoc()) 
    {
        echo '<section class="thread">';
        echo '<div class="thread-header">';
        echo '<p class="author"><img src="'. $row['profile'] .'" alt="images/auto.png" class="t_profile"> ' . $row['fname'] . " " . $row['lname'] . '</p>';
        echo '<h2>' . $row['t_title'] . '</h2>';
        echo '</div>';
        echo '<p class="content">' . $row['t_content'] . '</p>';

        $t_id = $row['t_id'];
        $user_id = $row['user_id'];
        $sql_l = "SELECT COUNT(*) AS count FROM islike_t WHERE t_id = $t_id AND user_id = $id";

        // Execute the query
        $result_l = $conn->query($sql_l);

        // Check for errors
        if (!$result_l) 
        {
            echo "Error: " . $conn->error;
        } 
        else 
        {
            // Fetch the result
            $row_l = $result_l->fetch_assoc();

            // Check if a record exists
            if ($row_l['count'] > 0) 
            {
                $sql_likes = "SELECT t_likes FROM threads WHERE t_id = $t_id";
                $result_likes = mysqli_query($conn, $sql_likes);

                if (!$result_likes) 
                {
                    die("Error in executing query: " . $mysqli->error);
                }

                // Check if any rows were returned
                if ($result_likes->num_rows > 0) 
                {
                    $row_likes = $result_likes->fetch_assoc();
                }

                echo '<div class="actions">';
                echo '<h1 class="liked-btn">'.$row_likes['t_likes'].' likes </h1>';
                echo '</div>';
            } 
            else 
            {   echo '<form method="POST" action="like_t.php">';
                echo '<div class="actions">';
                echo '<input type="hidden" name="t_id" value="'. $t_id.'">';
                echo '<button class="like-btn">Like Thread</button>';
                echo '</div>';    
                echo '</form>';  
            }
            
        }




        echo '<div class="comments">';
        $a=$row['t_id'];

        $sql2 = "SELECT c.c_id, c.user_id, c.value, u.fname, u.lname
        FROM comments c
        LEFT JOIN users u ON c.user_id = u.id
        WHERE c.t_c_id = $a
        ORDER BY c.c_likes DESC";

        // Execute the query
        $result2 = $conn->query($sql2);

        // Check for errors
        if (!$result2) {
            echo "Error: " . $conn->error;
        } 
        else 
        {
            // Print the results
            while ($row2 = $result2->fetch_assoc()) 
            {
                echo '<div class="comment">';
                echo '<div class="comment-header">';
                echo '<p class="comment-author">'. $row2['fname'] . " " . $row2['lname'] . '</p>';
                

                
                $c_id = $row2['c_id'];
                $sql_c = "SELECT COUNT(*) AS count FROM islike_c WHERE c_id = $c_id AND user_id = $id";
        
                // Execute the query
                $result_c = $conn->query($sql_c);
        
                // Check for errors
                if (!$result_c) 
                {
                    echo "Error: " . $conn->error;
                } 
                else 
                {
                    // Fetch the result
                    $row_c = $result_c->fetch_assoc();
        
                    // Check if a record exists
                    if ($row_c['count'] > 0) 
                    {
                        echo '<div class="actions">';
                        echo '<h1 class="liked-btn">Liked</h1>';
                        echo '</div>';
                    } 
                    else 
                    {   echo '<form method="POST" action="like_c.php">';
                        echo '<div class="actions">';
                        echo '<input type="hidden" name="c_id" value="'. $c_id.'">';
                        echo '<button class="like-btn">Like</button>';
                        echo '</div>';    
                        echo '</form>';  
                    }
                    
                }


                echo '</div>';
                echo '<p class="comment-content">' . $row2['value'] . '</p>';
                echo '</div>';
            }
        }
       
            
        

        echo '<p>show more comments</p>';

        echo '</div>';
        echo '<div class="add-comment">';
        echo '<h3>Add a Comment</h3>';
        echo '<form class="add-comment-form" action="add_comment.php" method="POST">';
        
        echo '<input type="hidden" name="user_id" value="'.$row['user_id'].'">';
        echo '<input type="hidden" name="t_id" value="'.$row['t_id'].'">';

        echo '<textarea placeholder="Your Comment" class="comment-input" id="comment" name="comment" required></textarea>';
        echo '<button type="submit" class="submit-btn">Submit Comment</button>';
        echo '</form>';
        echo '</div>';
        echo '</section>';

    }

    // Close the result set
    $result->close();
    
}

// Close the database connection
$conn->close();
?>



</body>
</html>