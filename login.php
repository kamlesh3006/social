<?php
    include_once("db.php");
    
    session_start();

if (isset($_SESSION["user_id"])){
  echo "<script>alert('You are already logged in.');</script>";
  if($_SESSION["user_role"] == 2){
    echo "<script>window.location.href = './admin.php';</script>";
  }
  echo "<script>window.location.href = './home.php';</script>";

                exit();
}

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $getPasswordQuery = "SELECT user_id, name, password, user_role FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $getPasswordQuery);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $user_id = $row["user_id"];
            $username = $row["name"];
            $hashedPassword = $row["password"];
            $user_role = $row["user_role"];
            if($user_role == 2){
              $_SESSION["user_id"] = $user_id;
              $_SESSION["email"] = $email;
              $_SESSION["name"] = $username;
              $_SESSION["user_role"] = $user_role;
              header("Location: admin.php");
                exit();
            }
            if (password_verify($password, $hashedPassword)) {
                $_SESSION["user_id"] = $user_id;
                $_SESSION["email"] = $email;
                $_SESSION["name"] = $username;
                $_SESSION["user_role"] = $user_role;
                header("Location: home.php");
                exit();
            } else {
                echo "<script>alert('Incorrect password. Please try again.')</script>";
            }
        } else {
            echo "<script>alert('Email not found. Please register or check your credentials.')</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MuseWords - Login</title>
    <!-- Include Tailwind CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Include Alpine.js via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <style>
        button {
            background-color: #3E3E3F;
        }

        button:hover {
            background-color: rgb(42, 42, 42);
            cursor: pointer;
        }
    </style>
</head>
<body x-data="{ open: false, showModal: false }" x-bind:class="{ 'overflow-hidden': showModal }" style="background-color: #FAFBFB; min-height: 100vh;">

<nav class="fixed top-0 w-full bg-white p-4 flex justify-center items-center shadow-lg">
  <a class="navbar-brand" href="#">
    <img src="./logo1.png" alt="Logo" width="40%" height="auto">
  </a>
</nav>

<section class="bg-gray-50 mt-24 md:mt-0">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
    <div class="w-full bg-white rounded-lg shadow-lg md:mt-0 sm:max-w-md xl:p-0">
      <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
          Sign in to your account
        </h1>
        <form class="space-y-4 md:space-y-6" action="" method="POST">
          <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="name@company.com" required="">
          </div>
          <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
          </div>
          <div class="flex items-center justify-between">
            <div class="flex items-start">
              <div class="flex items-center h-5">
                <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300">
              </div>
              <div class="ml-3 text-sm">
                <label for="remember" class="text-gray-500">Remember me</label>
              </div>
            </div>
            <a href="./forgot_password.php" class="text-sm font-medium text-primary-600 hover:underline">Forgot password?</a>
          </div>
          <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Sign in</button>
          <p class="text-sm font-light text-gray-500">
            Don’t have an account yet? <a href="./signup.php" class="font-medium text-primary-600 hover:underline">Sign up</a>
          </p>
        </form>
      </div>
    </div>
  </div>
</section>



</body>
</html>
