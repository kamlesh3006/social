<?php
include_once("db.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MuseWords - Delete</title>
    <!-- Include Tailwind CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include Alpine.js via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
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
<body style="background-color: #FAFBFB;">
<!-- <div class="flex justify-center py-6 bg-white shadow-md">
            <a href="./profile.php" class="items-center space-x-3 rtl:space-x-reverse">
                <img src="./logo1.png" class="h-10" alt="Musewords Logo">
            </a>
        </div> -->
<section class="py-8 mt-6 lg:mt-2 lg:py-16 antialiased">
    <div class="max-w-2xl mx-auto px-4 my-8">
        <?php 
        if(isset($_GET['post_id'])) {
            $post_id = $_GET['post_id'];
            $username = $_SESSION['name'];
            $getQuoteQuery = "SELECT * FROM posts WHERE post_id = $post_id";
            $quoteResult = mysqli_query($conn, $getQuoteQuery);
        
            if ($quoteResult && mysqli_num_rows($quoteResult) > 0) {
                $quoteDetails = mysqli_fetch_assoc($quoteResult);
                $quote = $quoteDetails["quote"];
                $date = $quoteDetails["date"];
                echo '<article class="p-6 cursor-default md:mx-8 mt-24 lg:mt-5 border shadow-2xl text-base bg-white rounded-lg">
                    <footer class="flex justify-between items-center mb-2">
                        <div class="flex items-center">
                            <p class="inline-flex items-center mr-3 text-sm text-gray-900 font-semibold"> '.$username.'</p>
                            <p class="text-sm text-gray-600"><time pubdate datetime="2022-02-08"
                                    title="February 8th, 2022">'.$date.'</time></p>
                        </div>';
                echo '
                    </footer>
                    <p class="text-gray-500">'.$quote.'</p>';
                    echo ' <div class="flex items-center mt-8 space-x-4 justify-between">
                    <a href="./home.php" class="items-center space-x-3 rtl:space-x-reverse">
                        <img src="./logo1.png" class="h-4" alt="Musewords Logo">
                    </a>
                    <p class="flex items-center text-xs text-gray-500 dark:text-gray-400 font-small">
                        Delete?
                    </p>
                </div>
                
                
                </article>';
                echo '<article class="p-6 cursor-default md:mx-8 mt-24 lg:mt-5 border shadow-2xl text-base bg-white rounded-lg">
                    <footer class="flex justify-between items-center mb-2">
                        <div class="flex items-center">
                            <p class="inline-flex items-center mr-3 text-md text-gray-900 font-semibold">Are you sure?</p>
                        </div>
                        </footer>
                        <p class="text-gray-500"><strong>Warning:</strong> Deleting this post is permanent and cannot be undone. Once deleted, your content will be lost. Are you sure you want to proceed with the deletion?</p>
                        <div class="flex items-center mt-8 space-x-4 justify-between">
                        <a href="./confirm.php?post_id='.$post_id.'" class="button text-center text-zinc-600 w-1/2 bg-white border-2 py-2 px-6 focus:outline-zinc-600 hover:bg-zinc-700 hover:text-white rounded-lg text-lg transition ease-in-out delay-200 hover:scale-110 hover:-translate-y-1 duration-300">Delete</a>
                        <a href="./profile.php" class=" button text-center text-red-500 w-1/2 bg-white border-2 border-red py-2 px-6 focus:outline-red-500 hover:bg-red-500 hover:text-white rounded-lg text-lg transition ease-in-out delay-200 hover:scale-110 hover:-translate-y-1 duration-300">Cancel</a>
                </div>
                        </article>';
            } else {
                echo "<script>alert('Post not Found');</script>";
                echo "<script>window.location.href = './home.php';</script>";
            }
        } else {
            echo "<script>alert('Missing post id.');</script>";
            echo "<script>window.location.href = './home.php';</script>";
        }
        ?>
</div>
</section>
<script>
    
</script>
</body>
</html>