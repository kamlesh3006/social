<?php
include_once("db.php");
session_start();

if (isset($_POST['post_id']) && isset($_POST["user_id"])) {
    $post_id = $_POST['post_id'];
    $user_id_from_url = $_POST["user_id"];
    $user_id_from_session = $_SESSION["user_id"];

    // Check if the user from the session is the owner of the post
    $checkOwnerQuery = "SELECT user_id FROM posts WHERE post_id = ?";
    $stmt_check = mysqli_prepare($conn, $checkOwnerQuery);

    if ($stmt_check) {
        mysqli_stmt_bind_param($stmt_check, "i", $post_id);
        mysqli_stmt_execute($stmt_check);
        mysqli_stmt_store_result($stmt_check);

        if (mysqli_stmt_num_rows($stmt_check) > 0) {
            mysqli_stmt_bind_result($stmt_check, $owner_id);
            mysqli_stmt_fetch($stmt_check);

            // Check if the owner from the session matches the owner from the database
            if ($owner_id == $user_id_from_session) {
                $deleteQuery = "DELETE FROM posts WHERE post_id = ? AND user_id = ?";
                $stmt = mysqli_prepare($conn, $deleteQuery);

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "ii", $post_id, $user_id_from_session);

                    if (mysqli_stmt_execute($stmt)) {
                        header("Location: profile.php");
                        exit();
                    } else {
                        echo "<script>alert('Error executing deletion query: " . mysqli_error($conn) . "')</script>";
                        echo "<script>window.location.href = './profile.php';</script>";
                    }

                    mysqli_stmt_close($stmt);
                } else {
                    echo "<script>alert('Error preparing deletion statement: " . mysqli_error($conn) . "')</script>";
                    echo "<script>window.location.href = './profile.php';</script>";
                }
            } else {
                // User does not own the post
                echo "<script>alert('Invalid credentials provided for deletion.')</script>";
                echo "<script>window.location.href = './profile.php';</script>";
            }
        } else {
            // Post not found
            echo "<script>alert('Post not found.')</script>";
            echo "<script>window.location.href = './profile.php';</script>";
        }

        mysqli_stmt_close($stmt_check);
    } else {
        echo "<script>alert('Error checking ownership: " . mysqli_error($conn) . "')</script>";
        echo "<script>window.location.href = './profile.php';</script>";
    }
} else {
    echo "<script>alert('Invalid credentials provided for deletion.')</script>";
    echo "<script>window.location.href = './profile.php';</script>";
}
?>
