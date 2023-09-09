<?php

        $conn = mysqli_connect('localhost','root','','dta2');

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
?>