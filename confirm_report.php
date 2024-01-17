<?php
include_once("db.php");
session_start();

if (isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];
    $reported_userid = $_POST['user_id'];
    $user_id = $_SESSION["user_id"];
    $report_data = nl2br($_POST["comment"]);
    $alreadyReported = "SELECT user_id, post_id, reported_user FROM reports WHERE user_id = $user_id AND post_id = $post_id AND reported_user = $reported_userid";
    if(mysqli_num_rows(mysqli_query($conn, $alreadyReported)) > 0){
        echo "<script>alert('You have already reported the post once!')</script>";
        echo "<script>window.location.href = './home.php';</script>";
    } else {
        $insertReport = "INSERT INTO reports(post_id, user_id, reported_user, report_data) VALUES($post_id, $user_id, $reported_userid, '$report_data')";
        if(mysqli_query($conn, $insertReport)){
            echo "<script>alert('Report submitted.')</script>";
            echo "<script>window.location.href = './home.php';</script>";
        } else {
            echo "<script>alert('Error executing the report query.')</script>";
            echo "<script>window.location.href = './home.php';</script>";
        }
    }
    
} else {
    echo "<script>alert('No post id provided for reporting.')</script>";
    echo "<script>window.location.href = './home.php';</script>";
    
}
?>

