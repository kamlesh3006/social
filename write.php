<?php
    include_once("db.php");
    
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $quote = $_POST["comment"];
        $date = new DateTime();
        $formatDate =  $date->format("M. j, Y");
        if (isset($_SESSION["user_id"])) {
            $user_id = $_SESSION["user_id"];
            $postQuoteQuery = "INSERT INTO posts(quote, date, user_id) VALUES ('$quote', '$formatDate', '$user_id')";
            if (mysqli_query($conn, $postQuoteQuery)) {
                echo "<script>alert('Quote posted successfully!')
                window.location.href = 'home.php';</script>";
                exit();
            } else {
                echo "<script>alert('Error posting quote.')
                window.location.href = 'home.php';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Login to post quotes!')</script>";
        }
    }
?>