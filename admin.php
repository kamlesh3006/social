<?php
    session_start();
    include("db.php");
    
    if(!isset($_SESSION["user_id"]) || $_SESSION["user_role"] != 2) {
        echo "<script>alert('You are not authorized.')</script>";
        echo "<script>window.location.href = './login.php';</script>";
        exit();
    }
    $user_id = $_SESSION["user_id"];
    $user_name = $_SESSION["name"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MuseWords : Admin</title>
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
<section class="mt-24 hidden lg:block lg:mx-6 flex justify-center">
    <div class="overflow-x-auto flex pb-8 justify-center w-full">
        <table class="table-auto border shadow-lg border-separate border-spacing-1 w-5/6">
            <thead>
                <tr>
                    <th class="px-4 py-2 bg-gray-600 text-gray-100 border">Sr. No.</th>
                    <th class="px-4 py-2 bg-gray-600 text-gray-100 border">User Name</th>
                    <th class="px-4 py-2 bg-gray-600 text-gray-100 border">Email id</th>
                    <th class="px-4 py-2 bg-gray-600 text-gray-100 border">Total Posts</th>
                    <th class="px-4 py-2 bg-gray-600 text-gray-100 border">Reports</th>
                    <th class="px-4 py-2 bg-gray-600 text-gray-100 border">User Role</th>
                    <th class="px-4 py-2 bg-gray-600 text-gray-100 border">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT u.user_id, u.name, u.email, u.user_role, COUNT(p.post_id) AS total_posts, COUNT(r.report_id) AS total_reports
                    FROM users u 
                    LEFT JOIN posts p ON u.user_id = p.user_id 
                    LEFT JOIN reports r ON p.post_id = r.post_id
                    WHERE u.user_role != 2
                    GROUP BY u.user_id";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $count = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class='transition duration-300 transform hover:scale-105 bg-gray-200' onclick=\"window.location='view_user_posts.php?user_id=" . $row["user_id"] . "'\">";
                            echo "<td class='text-center px-4 py-2 border'>" . $count . "</td>";
                            echo "<td class='text-center px-4 py-2 border'>" . $row["name"] . "</td>";
                            echo "<td class='text-center px-4 py-2 border'>" . $row["email"] . "</td>";
                            echo "<td class='text-center px-4 py-2 border'>" . $row["total_posts"] . "</td>";
                            echo "<td class='text-center px-4 py-2 border text-red-700'>" . $row["total_reports"] . "</td>";
                            if($row["user_role"] == 0) {
                                echo "<td class='text-center px-4 py-2 border'>User</td>";
                                echo "<td class='text-center px-4 py-2 border'><a href='./promote.php?user_id=".$row["user_id"]."' class=' underline underline-offset-2'>Promote</a></td>";
                            } elseif($row["user_role"] == 1) {
                                echo "<td class='text-center px-4 py-2 border'>Super-User</td>";
                                echo "<td class='text-center px-4 py-2 border'><a href='./demote.php?user_id=".$row["user_id"]."' class=' underline underline-offset-2'>Demote</a></td>";}
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
    </div>
</section>
</body>
</html>
