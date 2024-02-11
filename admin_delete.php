<?php
session_start();
include("db.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["user_role"] != 2) {
    echo "<script>alert('You are not authorized.')</script>";
    echo "<script>window.location.href = './login.php';</script>";
    exit();
}

if (!isset($_GET["post_id"])) {
    echo "<script>alert('Post ID not provided.')</script>";
    echo "<script>window.location.href = './admin.php';</script>";
    exit();
}

$post_id = $_GET["post_id"];

$sql = "DELETE FROM posts WHERE post_id = $post_id";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Post deleted successfully.')</script>";
    echo "<script>window.history.back();</script>";
} else {
    echo "<script>alert('Error deleting post: " . $conn->error . "')</script>";
    echo "<script>window.history.back();</script>";
}


$conn->close();
?>
