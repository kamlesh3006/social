<?php
include_once("db.php");
session_start();

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $reported_userid = $_GET['userid'];
    $user_id = $_SESSION["user_id"];
    $report_data = nl2br($_GET["comment"]);
    $alreadyReported = "SELECT user_id, post_id, reported_user FROM reports WHERE user_id = $user_id, post_id = $post_id, reported_user = $reported_userid";
    if(mysqli_num_rows(mysqli_query($conn, $alreadyReported)) > 0){
        echo "<script>alert('You have already reported the post once!')</script>";
        echo "<script>window.location.href = './home.php';</script>";
    } else {
        
    }
    
} else {
    echo "<script>alert('No post_id provided for deletion.')</script>";
    echo "<script>window.location.href = './home.php';</script>";
}
?>

