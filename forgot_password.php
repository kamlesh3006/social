<?php
include("db.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve input from form
    $favorite_food = $_POST['favorite_food'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Check if passwords match
    if ($new_password != $confirm_password) {
        $error = "Passwords do not match";
    } else {
        // Check if favorite food matches
        $sql = "SELECT * FROM users WHERE favorite_food = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $favorite_food);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            // Update password
            $row = $result->fetch_assoc();
            $user_id = $row['user_id'];
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_sql = "UPDATE users SET password = ? WHERE user_id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("si", $hashed_password, $user_id);
            if ($update_stmt->execute()) {
                $success = "Password changed successfully";
            } else {
                $error = "Error updating password: " . $conn->error;
            }
        } else {
            $error = "Incorrect favorite food";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>
<body>
    <h2>Change Password</h2>
    <?php if(isset($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>
    <?php if(isset($success)) { ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="favorite_food">What is your favorite food?</label><br>
        <input type="text" id="favorite_food" name="favorite_food" required><br><br>
    </form>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
