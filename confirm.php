<?php
include_once("db.php");
session_start();

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    
    $deleteQuery = "DELETE FROM posts WHERE post_id = ?";
    
    $stmt = mysqli_prepare($conn, $deleteQuery);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $post_id);
        
        if (mysqli_stmt_execute($stmt)) {
            header("Location: profile.php");
            exit();
        } else {
            echo "<script>alert('Error executing deletion query: " . mysqli_error($conn)."')</script>";
            echo "<script>window.location.href = './home.php';</script>";
        }
        
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Error preparing deletion statement: " . mysqli_error($conn)."')</script>";
        echo "<script>window.location.href = './home.php';</script>";
    }
} else {
    echo "<script>alert('No post_id provided for deletion.')</script>";
    echo "<script>window.location.href = './home.php';</script>";
}
?>
