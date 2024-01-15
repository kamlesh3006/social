<?php
include_once("db.php");
session_start();

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    
    
} else {
    echo "<script>alert('No post_id provided for deletion.')</script>";
    echo "<script>window.location.href = './home.php';</script>";
}
?>

