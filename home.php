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
            t.t_type = ''
            OR (t.t_type IN ('" . implode("', '", $topics) . "')) 
            OR tp.name IN ('" . implode("', '", $topics) . "')
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
        echo '<div class="actions">';
        echo '<button class="like-btn">Like Thread</button>';
        echo '</div>';
        echo '<div class="comments">';
        $a=$row['t_id'];

        $sql2 = "SELECT c.user_id, c.value, u.fname, u.lname
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
                echo '<button class="like-btn">Like</button>';
                echo '</div>';
                echo '<p class="comment-content">' . $row2['value'] . '</p>';
                echo '</div>';
            }
        }
       
            
        

        echo '<p>show more comments</p>';

        echo '</div>';
        echo '<div class="add-comment">';
        echo '<h3>Add a Comment</h3>';
        echo '<form class="add-comment-form"';
        echo '<textarea placeholder="Your Comment" class="comment-input" id="comment" name="comment" required></textarea>';
        echo '<button type="submit" class="submit-btn">Submit Comment</button>';
        echo '</form>';
        echo '</div>';
        echo '</section>';

        // $tid2[]= $row['t_id'];
        // echo "Thread ID: " . $row['t_id'] . "<br>";
        // echo "Thread Title: " . $row['t_title'] . "<br>";
        // echo "Thread Content: " . $row['t_content'] . "<br>";
        // echo "User ID: " . $row['user_id'] . "<br>";
        // echo "User Name: " . $row['fname'] . " " . $row['lname'] . "<br>";
        // echo "User Profile: " . $row['profile'] . "<br>";


    }

    // Close the result set
    $result->close();
    
}

// Close the database connection
$conn->close();
?>



</body>
</html>