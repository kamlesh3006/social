<?php
include_once("db.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["comment"])) {
        $quote = nl2br($_POST["comment"]);
        $date = new DateTime();
        $formatDate = $date->format("M. j, Y");

        if (isset($_SESSION["user_id"])) {
            $user_id = $_SESSION["user_id"];

            // Use prepared statement to insert data safely
            $postQuoteQuery = "INSERT INTO posts(quote, date, user_id) VALUES (?, ?, ?)";
            $statement = mysqli_prepare($conn, $postQuoteQuery);

            if ($statement) {
                mysqli_stmt_bind_param($statement, "ssi", $quote, $formatDate, $user_id);

                if (mysqli_stmt_execute($statement)) {
                    mysqli_stmt_close($statement);
                    echo "<script>alert('Quote posted successfully!')
                        window.location.href = 'home.php';</script>";
                    exit();
                } else {
                    echo "<script>alert('Error executing statement: " . mysqli_error($conn) . "')
                        window.location.href = 'home.php';</script>";
                    exit();
                }
            } else {
                echo "<script>alert('Error preparing statement: " . mysqli_error($conn) . "')
                    window.location.href = 'home.php';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Login to post quotes!')
            window.location.href = 'home.php';</script>";
        }
    }
}
?>
