<?php
// Start the session

session_start();
$email = $_SESSION['email'];

if (!isset($_SESSION['email'])) {
  // If not, redirect to the login page
  header("Location: login.php");
  exit;
}


// Connect to the database
include "conn.php";

// Query the database for the user data
$query = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $query);


// Fetch the user data
$user = mysqli_fetch_assoc($result);

// Access the user data
$id = $user['id'];
$fname = $user['fname'];
$lname = $user['lname'];
$age = $user['age'];
$category = $user['Category'];
$field = $user['Field'];
$profile = $user['profile'];

$query2 = "SELECT name FROM topics WHERE user_id = '$id'";
$result2 = mysqli_query($conn, $query2);

$topics = array();

while ($row = mysqli_fetch_assoc($result2)) {
  $topics[] = $row['name'];
}



// ...

?>