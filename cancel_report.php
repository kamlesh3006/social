<?php
session_start();
include("db.php");

// Check if the user is logged in and has admin privileges
if (!isset($_SESSION["user_id"]) || $_SESSION["user_role"] != 2) {
    echo "<script>alert('You are not authorized.')</script>";
    echo "<script>window.location.href = './login.php';</script>";
    exit();
}

// Check if the post ID is provided in the URL
if (!isset($_GET["post_id"])) {
    echo "<script>alert('Post ID not provided.')</script>";
    echo "<script>window.location.href = './admin.php';</script>";
    exit();
}

$post_id = $_GET["post_id"];

// Delete the report associated with the post
$sql = "DELETE FROM reports WHERE post_id = $post_id";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Report canceled successfully.')</script>";
    echo "<script>window.history.back();</script>";
} else {
    echo "<script>alert('Error canceling report: " . $conn->error . "')</script>";
}

$conn->close();
?>
