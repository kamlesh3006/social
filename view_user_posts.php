<?php
    session_start();
    include("db.php");
    
    // Check if the user is logged in and has admin privileges
    if(!isset($_SESSION["user_id"]) || $_SESSION["user_role"] != 2) {
        echo "<script>alert('You are not authorized.')</script>";
        echo "<script>window.location.href = './login.php';</script>";
        exit();
    }

    // Check if user ID is provided in the URL
    if(!isset($_GET["user_id"])) {
        echo "<script>alert('User ID not provided.')</script>";
        echo "<script>window.location.href = './admin.php';</script>";
        exit();
    }

    $user_id = $_GET["user_id"];

    $sql = "SELECT u.*, COUNT(p.post_id) AS total_posts, COUNT(r.report_id) AS total_reports
            FROM users u 
            LEFT JOIN posts p ON u.user_id = p.user_id 
            LEFT JOIN reports r ON p.post_id = r.post_id
            WHERE u.user_id = $user_id";

    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        echo "<script>alert('User not found.')</script>";
        echo "<script>window.location.href = './admin.php';</script>";
        exit();
    }

    $user_data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Posts & Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .button1 {
            background-color: #3E3E3F;
        }

        .button1:hover {
            background-color: rgb(42, 42, 42);
            cursor: pointer;
        }
    </style>
</head>
<body>
<nav class="fixed top-0 w-full bg-white p-4 flex justify-between px-24 items-center shadow-lg">
  <a class="navbar-brand" href="./index.html">
    <img src="./logo1.png" alt="Logo" width="300px" height="auto">
  </a>
  <a href="./admin.php" class="font-bold mr-6 underline underline-offset-2">Admin Panel</a>
  <a href="logout.php" class="button1 text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center">LOGOUT</a>
</nav>
<section class="mt-24 lg:hidden flex justify-center">
    Admin panel is only available on Large Screens (Desktop or Laptop Monitors).
</section>
<section>
    <div class="mt-24 text-gray-600 hidden lg:flex lg:flex-col lg:justify-center lg:items-center p-6">
        <h1 class="text-3xl w-full font-bold mb-2 rounded-2xl border-2 text-center py-2  shadow-lg">User Data</h1>
        <div class="w-full rounded-2xl border-2 text-center py-2  shadow-lg">
        <h2 class="text-xl pt-4 font-semibold underline mb-2">User Information</h2>
        <p class="mb-1"><strong>User ID:</strong> <?php echo $user_data["user_id"]; ?></p>
        <p class="mb-1"><strong>Name:</strong> <?php echo $user_data["name"]; ?></p>
        <p class="mb-2"><strong>Email:</strong> <?php echo $user_data["email"]; ?></p>
        </div>
    </div>
        <section class="hidden lg:block lg:mx-6">
    <div class="overflow-x-auto py-4 flex justify-center w-full">
        <table class="table-auto shadow-lg border border-separate border-spacing-1 w-5/6">
            <thead>
                <tr>
                    <th class="px-4 py-2 bg-gray-600 text-gray-100 border">Sr. No.</th>
                    <th class="px-4 py-2 bg-gray-600 text-gray-100 border">Post id</th>
                    <th class="px-4 py-2 bg-gray-600 text-gray-100 border">Post Data</th>
                    <th class="px-4 py-2 bg-gray-600 text-gray-100 border">Date Posted</th>
                    <th class="px-4 py-2 bg-gray-600 text-gray-100 border">Reports</th>
                    <th class="px-4 py-2 bg-gray-600 text-gray-100 border">Report Data</th>
                    <th class="px-4 py-2 bg-gray-600 text-gray-100 border">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
$sql = "SELECT u.user_id, u.name, u.email, p.post_id, p.quote, p.date, r.report_data, 
COUNT(r.report_id) AS total_reports,
CASE WHEN p.post_id = r.post_id THEN 'Reported' ELSE '-' END AS report_status
FROM users u 
LEFT JOIN posts p ON u.user_id = p.user_id 
LEFT JOIN reports r ON p.post_id = r.post_id
WHERE u.user_role != 2 AND u.user_id = $user_id
GROUP BY p.post_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $count = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr class='bg-gray-200'>";
        echo "<td class='text-center px-4 py-2 border'>" . $count . "</td>";
        echo "<td class='text-center px-4 py-2 border'>" . $row["post_id"] . "</td>";
        echo "<td class='text-center px-4 py-2 border'>" . $row["quote"] . "</td>";
        echo "<td class='text-center px-4 py-2 border'>" . $row["date"] . "</td>";
        echo "<td class='text-center px-4 py-2 border text-red-700'>" . $row["report_status"] . "</td>";
        if($row["report_data"]){
            echo "<td class='text-center px-4 py-2 border text-red-700'>" . $row["report_data"] . "</td>";
            echo "<td class='text-center flex justify-between px-4 py-2 border text-red-700'><a href='cancel_report.php?post_id=" . $row["post_id"] . "' class='text-red-700 hover:text-red-600'>Cancel Report</a><a href='admin_delete.php?post_id=" . $row["post_id"] . "' class='text-red-700 hover:text-red-600'>Delete Post</a></td>";
        } else{
            echo "<td class='text-center px-4 py-2 border text-red-700'>-</td>";
            echo "<td class='text-center flex justify-center px-4 py-2 border text-red-700'><a href='admin_delete.php?post_id=" . $row["post_id"] . "' class='text-red-700 hover:text-red-600'>Delete Post</a></td>";
        }
        echo "</tr>";
        $count++;
    }
} else {
    echo "<tr><td colspan='5' class='px-4 py-2 text-center'>0 results</td></tr>";
}

$conn->close();
?>

            </tbody>
        </table>
</section>
        
    </div>
</section>
</body>
</html>
