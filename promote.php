<?php
session_start();
include("db.php");
if (!isset($_SESSION["user_id"]) || $_SESSION["user_role"] != 2) {
    echo "<script>alert('You are not authorized.')</script>";
    echo "<script>window.location.href = './login.php';</script>";
    exit();
}

if (!isset($_GET["user_id"])) {
    echo "<script>alert('User ID not provided.')</script>";
    echo "<script>window.location.href = './admin.php';</script>";
    exit();
}

$user_id = $_GET["user_id"];

$sql = "UPDATE users SET user_role = 1 WHERE user_id = $user_id";
if($result = $conn->query($sql) === TRUE) {
    echo "<script>alert('User promoted to Super-User.')</script>";
    echo "<script>window.history.back();</script>";
} else {
    echo "<script>alert('Error occured: " . $conn->error . "')</script>";
    echo "<script>window.history.back();</script>";
}
?>