<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    





    <section class="thread">
        <div class="thread-header">
        <p class="author"> <img src="images/auto.png" alt="profile" class="t_profile"> John Doe</p>
            <h2>Mathematics for Middle School</h2>
            
        </div>
        <p class="content">Discussion on effective teaching strategies for middle school math.</p>
        
        <div class="actions">
            <button class="like-btn">Like Thread</button>
        </div>
        
        <div class="comments">
            <div class="comment">
                <div class="comment-header">
                    <p class="comment-author">Jane Smith</p>
                    <button class="like-btn">Like</button>
                </div>
                <p class="comment-content">Great insights! I've used interactive games to make math fun.</p>
            </div>
            <div class="comment">
                <div class="comment-header">
                    <p class="comment-author">Mark Johnson</p>
                    <button class="like-btn">Like</button>
                </div>
                <p class="comment-content">Thanks for sharing, Jane. I'll try that in my class too!</p>
            </div>
            <p>show more comments</p>
            <!-- More comments can be added here -->
        </div>
        
        <div class="add-comment">
            <h3>Add a Comment</h3>
            <form class="add-comment-form">
                <textarea placeholder="Your Comment" class="comment-input"></textarea>
                <button type="submit" class="submit-btn">Submit Comment</button>
            </form>
        </div>
    </section>


    <?php
// Sample data (you can replace this with actual data from your database)
$threadAuthor = "John Doe";
$threadTitle = "Mathematics for Middle School";
$threadContent = "Discussion on effective teaching strategies for middle school math.";
$comments = [
    ["author" => "Jane Smith", "content" => "Great insights! I've used interactive games to make math fun."],
    ["author" => "Mark Johnson", "content" => "Thanks for sharing, Jane. I'll try that in my class too!"]
];

// Generate the thread content using PHP
echo '<section class="thread">';
echo '<div class="thread-header">';
echo '<p class="author"><img src="images/auto.png" alt="profile" class="t_profile"> ' . $threadAuthor . '</p>';
echo '<h2>' . $threadTitle . '</h2>';
echo '</div>';
echo '<p class="content">' . $threadContent . '</p>';
echo '<div class="actions">';
echo '<button class="like-btn">Like Thread</button>';
echo '</div>';
echo '<div class="comments">';
foreach ($comments as $comment) {
    echo '<div class="comment">';
    echo '<div class="comment-header">';
    echo '<p class="comment-author">' . $comment["author"] . '</p>';
    echo '<button class="like-btn">Like</button>';
    echo '</div>';
    echo '<p class="comment-content">' . $comment["content"] . '</p>';
    echo '</div>';
}
echo '<p>show more comments</p>';
echo '</div>';
echo '<div class="add-comment">';
echo '<h3>Add a Comment</h3>';
echo '<form class="add-comment-form">';
echo '<textarea placeholder="Your Comment" class="comment-input"></textarea>';
echo '<button type="submit" class="submit-btn">Submit Comment</button>';
echo '</form>';
echo '</div>';
echo '</section>';
?>



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
        foreach ($comments as $comment) {
            echo '<div class="comment">';
            echo '<div class="comment-header">';
            echo '<p class="comment-author">' . $comment["author"] . '</p>';
            echo '<button class="like-btn">Like</button>';
            echo '</div>';
            echo '<p class="comment-content">' . $comment["content"] . '</p>';
            echo '</div>';
        }
        echo '<p>show more comments</p>';
        echo '</div>';
        echo '<div class="add-comment">';
        echo '<h3>Add a Comment</h3>';
        echo '<form class="add-comment-form">';
        echo '<textarea placeholder="Your Comment" class="comment-input"></textarea>';
        echo '<button type="submit" class="submit-btn">Submit Comment</button>';
        echo '</form>';
        echo '</div>';
        echo '</section>';

        $tid2[]= $row['t_id'];
        echo "Thread ID: " . $row['t_id'] . "<br>";
        echo "Thread Title: " . $row['t_title'] . "<br>";
        echo "Thread Content: " . $row['t_content'] . "<br>";
        echo "User ID: " . $row['user_id'] . "<br>";
        echo "User Name: " . $row['fname'] . " " . $row['lname'] . "<br>";
        echo "User Profile: " . $row['profile'] . "<br>";


    }

    // Close the result set
    $result->close();
}

// Close the database connection
$conn->close();
?>



</body>
</html>