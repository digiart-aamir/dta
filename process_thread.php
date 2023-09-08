<?php 

    include "session.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        
        // Retrieve the thread title and content from the form
        $threadTitle = $_POST["threadTitle"];
        $threadContent = $_POST["threadContent"];
        
        // Check if the checkbox is checked (General Thread)
               // Check if the checkbox is checked (General Thread)
        if (isset($_POST["myCheckbox"]) && $_POST["myCheckbox"] === "true") 
        {
            $t_type=" ";
        } else 
        {
            $t_type=$field;
        }
 
        // Assuming you have already established a database connection

// Define your SQL query with placeholders
$sql = "INSERT INTO threads (t_title, t_content, user_id, t_type) VALUES (?, ?, ?, ?)";

// Create a prepared statement
$stmt = mysqli_prepare($conn, $sql);

// Bind the parameters
mysqli_stmt_bind_param($stmt, "ssis", $threadTitle, $threadContent, $id, $t_type);

// Execute the statement
if (mysqli_stmt_execute($stmt)) {
    echo "<h1>New record created successfully</h1>";
    echo '<meta http-equiv="refresh" content="0.5; URL=dashboard.php">';
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the statement and the database connection
mysqli_stmt_close($stmt);


    }
?>