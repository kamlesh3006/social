<?php
include_once("db.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST["password"];
    $Cpassword = $_POST["Cpassword"];
    
if (strlen($newPassword) < 6) {
        echo "<script>alert('Password must be at least 6 characters long.');
              window.location.href = 'profile.php';</script>";
        exit();
    }

    if ($newPassword == $Cpassword) {
        // Hash the new password
        $hashedNew = password_hash($newPassword, PASSWORD_DEFAULT);

        // Get user_id from session
        $user_id = $_SESSION["user_id"];

        // Prepare the SQL statement
        $updateQuery = "UPDATE users SET password = ? WHERE user_id = ?";

        // Create a prepared statement
        $stmt = $conn->prepare($updateQuery);

        // Bind parameters
        $stmt->bind_param("si", $hashedNew, $user_id);

        // Execute the statement
        $stmt->execute();

        // Close the statement
        $stmt->close();

        // Close the connection
        $conn->close();

        echo "<script>alert('Password changed successfully.');
              window.location.href = 'profile.php';</script>";
        exit();
    } else {
        echo "<script>alert('Passwords don\'t match');
        window.location.href = 'profile.php';</script>";
        exit();
    }
}
?>
