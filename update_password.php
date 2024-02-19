<?php
include("db.php");

session_start();

if(isset($_SESSION['reset_email'])) {
    if(isset($_POST["password"]) && isset($_POST["confirm_password"])) {
        // Retrieve the new password and confirm password from the form
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        // Validate if passwords match
        if($password !== $confirm_password) {
            echo "<script>alert('Passwords do not match!')</script>";
        } else {
            // Hash the new password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Retrieve the email from the session
            $email = $_SESSION["reset_email"];

            // Update the password in the database
            $update_sql = "UPDATE users SET password='$hashed_password' WHERE email='$email'";
            $update_result = mysqli_query($conn, $update_sql);

            if($update_result) {
                echo "<script>alert('Password updated successfully!')</script>";
                echo"<script>window.location.href='./login.php'</script>";
                exit();
            } else {
                echo "<script>alert('Failed to update password.')</script>";
                echo"<script>window.location.href='./login.php'</script>";
                exit();
            }
        }
    }
} else {
    // Redirect the user back to the forgot password page if session email is not set
    header("Location: forgot_password.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MuseWords - Update Password</title>
    <style>
        button {
            background-color: rgb(62, 62, 63) !important;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: rgb(42, 42, 42) !important;
            cursor: pointer;
        }
        .hidden {
            display: none;
        }
        .content {
            flex: 1;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body style="background-color: #FAFBFB; min-height: 100vh; display: flex; flex-direction: column;">
<div class="content">
<nav class="fixed top-0 w-full bg-white p-4 flex justify-center items-center shadow-lg">
  <a class="navbar-brand" href="./index.html">
    <img src="./logo1.png" alt="Logo" width="40%" height="auto">
  </a>
</nav>

<div class=" mt-56 bg-white flex flex-col border rounded-lg w-full md:w-1/2 lg:w-1/3 justify-center items-center m-auto">
    <h2 class="text-2xl text-gray-800 font-semibold my-12">Change Password</h2>
    <form class="w-2/3 border-t flex flex-col justify-center items-center" method="post" action="">
        <label class="mt-4 mb-2 text-gray-600 font-semibold" for="password">New Password : </label>
        <input class="border w-full rounded py-1 px-2 mt-2 focus:outline " placeholder="example@email.com" type="password" id="password" name="password" required>
        <label class="mt-4 mb-2 text-gray-600 font-semibold" for="confirm_password">Confirm New Password : </label>
        <input class="border w-full rounded py-1 px-2 mt-2 focus:outline " placeholder="Answer is case sensitive." type="password" id="confirm_password" name="confirm_password" required>
        <button type="submit" class="w-1/2 my-4 text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center">Submit</button>
    </form>
</div>
    </div>
<footer class="text-gray-600 body-font">
  <div class="container px-5 py-8 mx-auto flex items-center sm:flex-row flex-col">
    <a class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900">
      <img src="./sqlogo.png" height="26" width="26" alt="">
      <span class="ml-3 text-xl">MuseWords</span>
    </a>
    <p class="text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">© 2024 MuseWords —
      <a href="https://github.com/kamlesh3006" class="text-gray-600 ml-1" rel="noopener noreferrer" target="_blank">@kamlesh3006</a>
    </p>
    <span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
      <a class="text-gray-500" href="https://github.com/kamlesh3006" target="_blank">
      <svg width="20" height="20" viewBox="0 -3.5 256 256" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin meet">

<g fill="currentColor">

<path d="M127.505 0C57.095 0 0 57.085 0 127.505c0 56.336 36.534 104.13 87.196 120.99 6.372 1.18 8.712-2.766 8.712-6.134 0-3.04-.119-13.085-.173-23.739-35.473 7.713-42.958-15.044-42.958-15.044-5.8-14.738-14.157-18.656-14.157-18.656-11.568-7.914.872-7.752.872-7.752 12.804.9 19.546 13.14 19.546 13.14 11.372 19.493 29.828 13.857 37.104 10.6 1.144-8.242 4.449-13.866 8.095-17.05-28.32-3.225-58.092-14.158-58.092-63.014 0-13.92 4.981-25.295 13.138-34.224-1.324-3.212-5.688-16.18 1.235-33.743 0 0 10.707-3.427 35.073 13.07 10.17-2.826 21.078-4.242 31.914-4.29 10.836.048 21.752 1.464 31.942 4.29 24.337-16.497 35.029-13.07 35.029-13.07 6.94 17.563 2.574 30.531 1.25 33.743 8.175 8.929 13.122 20.303 13.122 34.224 0 48.972-29.828 59.756-58.22 62.912 4.573 3.957 8.648 11.717 8.648 23.612 0 17.06-.148 30.791-.148 34.991 0 3.393 2.295 7.369 8.759 6.117 50.634-16.879 87.122-64.656 87.122-120.973C255.009 57.085 197.922 0 127.505 0"/>

<path d="M47.755 181.634c-.28.633-1.278.823-2.185.389-.925-.416-1.445-1.28-1.145-1.916.275-.652 1.273-.834 2.196-.396.927.415 1.455 1.287 1.134 1.923M54.027 187.23c-.608.564-1.797.302-2.604-.589-.834-.889-.99-2.077-.373-2.65.627-.563 1.78-.3 2.616.59.834.899.996 2.08.36 2.65M58.33 194.39c-.782.543-2.06.034-2.849-1.1-.781-1.133-.781-2.493.017-3.038.792-.545 2.05-.055 2.85 1.07.78 1.153.78 2.513-.019 3.069M65.606 202.683c-.699.77-2.187.564-3.277-.488-1.114-1.028-1.425-2.487-.724-3.258.707-.772 2.204-.555 3.302.488 1.107 1.026 1.445 2.496.7 3.258M75.01 205.483c-.307.998-1.741 1.452-3.185 1.028-1.442-.437-2.386-1.607-2.095-2.616.3-1.005 1.74-1.478 3.195-1.024 1.44.435 2.386 1.596 2.086 2.612M85.714 206.67c.036 1.052-1.189 1.924-2.705 1.943-1.525.033-2.758-.818-2.774-1.852 0-1.062 1.197-1.926 2.721-1.951 1.516-.03 2.758.815 2.758 1.86M96.228 206.267c.182 1.026-.872 2.08-2.377 2.36-1.48.27-2.85-.363-3.039-1.38-.184-1.052.89-2.105 2.367-2.378 1.508-.262 2.857.355 3.049 1.398"/>

</g>

</svg>
      </a>
      <a class="ml-3 text-gray-500" href="https://twitter.com/kamleshkhatod30" target="_blank">
        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
          <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
        </svg>
      </a>
      <a class="ml-3 text-gray-500" href="https://www.instagram.com/_kamlesh_khatod_/" target="_blank">
        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
          <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
          <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
        </svg>
      </a>
      <a class="ml-3 text-gray-500" href="https://www.linkedin.com/in/kamlesh-khatod/" target="_blank">
        <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
          <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
          <circle cx="4" cy="4" r="2" stroke="none"></circle>
        </svg>
      </a>
    </span>
  </div>
</footer>
</body>
</html>
<?php
$conn->close();
?>
