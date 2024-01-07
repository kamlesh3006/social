<?php
    include_once("db.php");

    session_start();

    if (!isset($_SESSION["user_id"])) {
        header("Location: login.php");
        exit();
    } else{
        $username = $_SESSION["name"];
        $user_id = $_SESSION["user_id"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwind CSS Dropdowns</title>
    <!-- Include Tailwind CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
<body x-data="{ open: false, showModal: false, authenticationModal: false}" x-bind:class="{ 'overflow-hidden': showModal || authenticationModal }" style="background-color: #FAFBFB; min-height: 100vh;">

<nav class="bg-white fixed w-full z-20 top-0 start-0 border-b border-gray-200 shadow-lg">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="./logo1.png" class="h-6" alt="Musewords Logo">
        </a>
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
        <a href="logout.php" class="button1 text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center">LOGOUT</a>
            <button @click="open = !open" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
        </div>
        <div x-show="open" class="items-center justify-between w-full md:hidden" id="navbar-sticky">
            <ul class="flex flex-col p-4 mt-4 font-medium border border-gray-100 rounded-lg bg-white space-y-2">
                <li>
                    <a href="./home.php" class="block py-1 px-1 border-b text-gray-500 rounded">Home</a>
                </li>
                <li>
                    
                    <!-- Dark overlay -->
    <div x-show="showModal" class="fixed top-0 left-0 w-full h-full bg-black opacity-75 z-40"></div>

    <!-- Modal toggle -->
    <a @click="showModal = true" class="block py-2 px-1 border-b text-gray-500 rounded hover:bg-gray-100">Write</a>

    <!-- Main modal -->
    <div x-show="showModal" id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full">
        <div @click.stop class="relative p-2 w-full max-w-2xl">
            <!-- Modal content -->
            <div @click.stop class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        What's on your mind?
                    </h3>
                    <button @click="showModal = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="py-5 md:p-5 space-y-4">
                    <div class="max-w-2xl mx-auto px-2">
                      <form class="mb-6" action="./write.php" method="POST">
                          <div class="py-2 px-4 mb-2 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                              <label for="comment" class="sr-only">Your comment</label>
                              <textarea id="comment" name="comment" rows="3"
                                  class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                  placeholder="Type here..." required></textarea>
                          </div>
                          <button @click="showModal = false" type="submit"
                              class=" button1 inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white  rounded-lg focus:ring-4 focus:ring-primary-200">
                              Post comment
                          </button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

                </li>
                <li>
                    <a href="" class="block py-1 px-1 text-gray-500 rounded hover:bg-gray-100">Profile</a>
                </li>
            </ul>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white">
                <li>
                    <a href="./home.php" class="flex flex-col items-center text-xs py-2 px-3 text-gray-700 rounded md:px-4 md:bg-transparent md:text-gray-500 md:hover:text-gray-900 md:p-0">
                        <svg fill="#3E3E3F" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 495.398 495.398" xml:space="preserve">

                        <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                        
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                        
                        <g id="SVGRepo_iconCarrier"> <g> <g> <g> <path d="M487.083,225.514l-75.08-75.08V63.704c0-15.682-12.708-28.391-28.413-28.391c-15.669,0-28.377,12.709-28.377,28.391 v29.941L299.31,37.74c-27.639-27.624-75.694-27.575-103.27,0.05L8.312,225.514c-11.082,11.104-11.082,29.071,0,40.158 c11.087,11.101,29.089,11.101,40.172,0l187.71-187.729c6.115-6.083,16.893-6.083,22.976-0.018l187.742,187.747 c5.567,5.551,12.825,8.312,20.081,8.312c7.271,0,14.541-2.764,20.091-8.312C498.17,254.586,498.17,236.619,487.083,225.514z"/> <path d="M257.561,131.836c-5.454-5.451-14.285-5.451-19.723,0L72.712,296.913c-2.607,2.606-4.085,6.164-4.085,9.877v120.401 c0,28.253,22.908,51.16,51.16,51.16h81.754v-126.61h92.299v126.61h81.755c28.251,0,51.159-22.907,51.159-51.159V306.79 c0-3.713-1.465-7.271-4.085-9.877L257.561,131.836z"/> </g> </g> </g> </g>
                        
                        </svg><span class="mt-1">Home</span></a>
                </li>
                <li>
                    <!-- Dark overlay -->
    <div x-show="showModal" class="fixed top-0 left-0 w-full h-full bg-black opacity-75 z-40"></div>

    <!-- Modal toggle -->
    <a @click="showModal = true"  class="flex flex-col items-center text-xs py-2 px-3 text-gray-700 rounded md:px-4 md:bg-transparent md:text-gray-500 md:hover:text-gray-900 md:p-0"><svg fill="#3E3E3F" width="20px" height="20px" viewBox="-0.5 -0.5 24 24" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin" class="jam jam-write-f">

        <g id="SVGRepo_bgCarrier" stroke-width="0"/>
        
        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
        
        <g id="SVGRepo_iconCarrier">
        
        <path d="M21.289.98l.59.59c.813.814.69 2.257-.277 3.223L9.435 16.96l-3.942 1.442c-.495.182-.977-.054-1.075-.525a.928.928 0 0 1 .045-.51l1.47-3.976L18.066 1.257c.967-.966 2.41-1.09 3.223-.276zM8.904 2.19a1 1 0 1 1 0 2h-4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-4a1 1 0 0 1 2 0v4a4 4 0 0 1-4 4h-12a4 4 0 0 1-4-4v-12a4 4 0 0 1 4-4h4z"/>
        
        </g>
        
    </svg><span class="mt-1">Write</span></a>

    <!-- Main modal -->
    <div x-show="showModal" id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed shadow-xl top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full">
        <div @click.stop class="relative p-4 w-full max-w-2xl">
            <!-- Modal content -->
            <div @click.stop class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        What's on your mind?
                    </h3>
                    <button @click="showModal = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="py-5 md:p-5 space-y-4">
                    <div class="max-w-2xl mx-auto px-2">
                      <form class="mb-6" action="./write.php" method="POST">
                          <div class="py-2 px-4 mb-2 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                              <label for="comment" class="sr-only">Your comment</label>
                              <textarea id="comment" name="comment" rows="5"
                                  class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none"
                                  placeholder="Type here..." required></textarea>
                          </div>
                          <button @click="showModal = false" type="submit"
                              class=" button1 mt-2 inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white  rounded-lg focus:ring-4 focus:ring-primary-200">
                              Post comment
                          </button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

                </li>
                <li>
                    <a href="" class="flex flex-col items-center text-xs py-2 px-3 text-gray-700 rounded md:px-4 md:bg-transparent md:text-gray-500 md:hover:text-gray-900 md:p-0"><svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

                        <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                        
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                        
                        <g id="SVGRepo_iconCarrier">
                        
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.5 7.063C16.5 10.258 14.57 13 12 13c-2.572 0-4.5-2.742-4.5-5.938C7.5 3.868 9.16 2 12 2s4.5 1.867 4.5 5.063zM4.102 20.142C4.487 20.6 6.145 22 12 22c5.855 0 7.512-1.4 7.898-1.857a.416.416 0 0 0 .09-.317C19.9 18.944 19.106 15 12 15s-7.9 3.944-7.989 4.826a.416.416 0 0 0 .091.317z" fill="#3E3E3F"/>
                        
                        </g>
                        
                    </svg><span class="mt-1">Profile</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container justify-content-center items-center mx-auto md:px-40 mt-24 px-4 md:mt-0">
<div class=" md:mt-20 sm:p-12">
	<div class="flex flex-col space-y-4 md:space-y-0 md:space-x-6 md:flex-row">
		<div class="flex flex-col">
			<h4 class="text-lg font-semibold text-center md:text-left"><?php echo $username; ?></h4>
			<p class="text-justify "><?php echo "Hey ".$username.",
                Musewords is designed for users to share inspirational, thought-provoking quotes without revealing their identity. We're committed to fostering a positive and respectful environment where users can freely express themselves. However, with this freedom comes responsibility."?></p>
		</div>
	</div>
	<div class="flex pt-4 space-x-4 align-center">
        <!-- Dark overlay -->
    <div x-show="authenticationModal" @click="authenticationModal = false" class="fixed top-0 left-0 w-full h-full bg-black opacity-50 z-40"></div>
		<button @click="authenticationModal = !authenticationModal"  type="button" class=" button1 text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center">Edit Profile</button>
        
    
    
    <!-- Main modal -->
    <div x-show="authenticationModal" id="authentication-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 right-0 left-0 z-50 flex items-center justify-center">
        <div class="relative p-4 w-full max-w-md">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Edit your profile
                    </h3>
                    <button @click="authenticationModal = false" type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
    
                  <form class="space-y-4" action="update.php" method="POST">
                      <div>
                          <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Change Password</label>
                          <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                      </div>
                      <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                        <input type="password" name="Cpassword" id="Cpassword" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                    </div>
                      <button @click="authenticationModal = false" type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                  </form>
              </div>
          </div>
      </div>
  </div> 
  
	</div>
</div>
</div>
<section class="antialiased">
    <div class="max-w-2xl mx-auto px-4">
        <article class="py-2 px-6 my-2 items-center justify-between border flex shadow-lg text-base bg-white rounded-lg">
            <button>Your Posts</button>
            <p class="text-gray-400">|</p>
            <button>Liked Posts</button>
            <p class="text-gray-400">|</p>
            <button>Saved Posts</button>
        </article>
        <?php 
        $getQuotesQuery = "SELECT post_id, quote, date, user_id FROM posts ORDER BY datetime DESC";
        $result = mysqli_query($conn, $getQuotesQuery);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $post_id = $row["post_id"];
                $quote = $row["quote"];
                $date = $row["date"];
                $postuser = $row["user_id"];
                if ($user_id == $postuser) {
                
        echo '<article class="p-6 mt-10 lg:mt-5 border shadow-lg text-base bg-white rounded-lg">
            <footer class="flex justify-between items-center mb-2">
                <div class="flex items-center">
                    <p class="inline-flex items-center mr-3 text-sm text-gray-900 font-semibold"> '.$username.'</p>
                    <p class="text-sm text-gray-600"><time pubdate datetime="2022-02-08"
                            title="February 8th, 2022">'.$date.'</time></p>
                </div>';
                
        echo '
                <a href="like.php" type="button"
                    class="flex items-center bg-white text-sm text-gray-500 hover:underline font-medium">
                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M12 9V14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M12.0001 21.41H5.94005C2.47005 21.41 1.02005 18.93 2.70005 15.9L5.82006 10.28L8.76006 5.00003C10.5401 1.79003 13.4601 1.79003 15.2401 5.00003L18.1801 10.29L21.3001 15.91C22.9801 18.94 21.5201 21.42 18.0601 21.42H12.0001V21.41Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M11.9945 17H12.0035" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                    Report
                </a>
            </footer>
            <p class="text-gray-500">'.$quote.'</p>
            <div class="flex items-center mt-4 space-x-4">
                </a>';
                echo '
                <a href="unlike.php" type="button"
                    class="flex items-center bg-white text-sm text-gray-500 hover:underline font-medium">
                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

<g id="SVGRepo_bgCarrier" stroke-width="0"/>

<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>

<g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12 6.00019C10.2006 3.90317 7.19377 3.2551 4.93923 5.17534C2.68468 7.09558 2.36727 10.3061 4.13778 12.5772C5.60984 14.4654 10.0648 18.4479 11.5249 19.7369C11.6882 19.8811 11.7699 19.9532 11.8652 19.9815C11.9483 20.0062 12.0393 20.0062 12.1225 19.9815C12.2178 19.9532 12.2994 19.8811 12.4628 19.7369C13.9229 18.4479 18.3778 14.4654 19.8499 12.5772C21.6204 10.3061 21.3417 7.07538 19.0484 5.17534C16.7551 3.2753 13.7994 3.90317 12 6.00019Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/> </g>

</svg>
<p class="ml-1">Like</p>
                </a>';
            echo '
                <button type="button"
                    class="flex items-center bg-white text-sm text-gray-500 hover:underline font-medium">
                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M20.5 3.5L3.5 9L10 12L17 7L12 14L15 20.5L20.5 3.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
<p class="ml-1">Share</p>
                </button>
                <button type="button"
                    class="flex items-center bg-white text-sm text-gray-500 hover:underline font-medium">
                    <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M6.75 6L7.5 5.25H16.5L17.25 6V19.3162L12 16.2051L6.75 19.3162V6ZM8.25 6.75V16.6838L12 14.4615L15.75 16.6838V6.75H8.25Z" fill="currentColor"/>
</svg>
                    Save
                </button>
            </div>
        </article>';
            }
        }
    }
        ?>
    </div></section>
</body>
</html>
