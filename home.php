<?php
    include_once("db.php");

    session_start();

    if (isset($_SESSION["user_id"])) {
        if($_SESSION["user_role"] == 2){
            echo "<script>window.location.href = './admin.php';</script>";
          }
        $username = $_SESSION["name"];
        $user_id = $_SESSION["user_id"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MuseWords - Home</title>
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
        .content {
            flex: 1;
        }
    </style>
</head>
<body x-data="{ open: false, showModal: false }" x-bind:class="{ 'overflow-hidden': showModal }" style="background-color: #FAFBFB; min-height: 100vh; display: flex; flex-direction: column;">
<div class="content">
    <nav class="bg-white fixed w-full z-20 top-0 start-0 border-b border-gray-200 shadow-lg">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="./index.html" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="./logo1.png" class="h-6" alt="Musewords Logo">
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            
            <?php if(isset($_SESSION['user_id'])){
                echo '<a href="logout.php" class="button1 text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center">LOGOUT</a>';
            } else {
                echo '<a href="login.php" class="button1 text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-xl text-sm px-6 py-2 text-center">LOGIN</a>';
            }
            ?>
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
                        <a href="" class="block py-1 px-1 border-b text-gray-500 rounded">Home</a>
                    </li>
                    <?php
                    if(!isset($_SESSION['user_id'])){
                        echo '
                    <li>
                        
                        <!-- Dark overlay -->
        <div x-show="showModal" class="fixed top-0 left-0 w-full h-full bg-black opacity-75 z-40"></div>
    
        <!-- Modal toggle -->
        <a @click="showModal = true" class="pointer-events-none opacity-50 block py-2 px-1 border-b text-gray-500 rounded hover:bg-gray-100">Write</a>
    
        <!-- Main modal -->
        <div x-show="showModal" id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full">
            <div @click.stop class="relative p-2 w-full max-w-2xl">
                <!-- Modal content -->
                <div @click.stop class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            What\'s on your mind?
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
                          <form class="mb-6" method="POST" action="write.php">
                              <div class="py-2 px-4 mb-2 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                  <label for="comment" class="sr-only">Your comment</label>
                                  <textarea id="comment" name="comment" rows="3"
                                      class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none resize-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                      placeholder="Type here..." required style="white-space: pre-wrap;"></textarea>
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
                        <a href="./profile.php" class="pointer-events-none opacity-50 block py-1 px-1 text-gray-500 rounded hover:bg-gray-100">Profile</a>
                    </li>';
                    } else {
                        echo '
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
                            What\'s on your mind?
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
                          <form class="mb-6" method="POST" action="write.php">
                              <div class="py-2 px-4 mb-2 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                  <label for="comment" class="sr-only">Your comment</label>
                                  <textarea id="comment" name="comment" rows="3"
                                      class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none resize-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                      placeholder="Type here..." required style="white-space: pre-wrap;"></textarea>
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
                        <a href="./profile.php" class="block py-1 px-1 text-gray-500 rounded hover:bg-gray-100">Profile</a>
                    </li>';
                    }
                    ?>
                </ul>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white">
                    <li>
                        <a href="" class="flex flex-col items-center text-xs py-2 px-3 text-gray-700 rounded md:px-4 md:bg-transparent md:text-gray-500 md:hover:text-gray-900 md:p-0">
                            <svg fill="#3E3E3F" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 495.398 495.398" xml:space="preserve">
    
                            <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                            
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                            
                            <g id="SVGRepo_iconCarrier"> <g> <g> <g> <path d="M487.083,225.514l-75.08-75.08V63.704c0-15.682-12.708-28.391-28.413-28.391c-15.669,0-28.377,12.709-28.377,28.391 v29.941L299.31,37.74c-27.639-27.624-75.694-27.575-103.27,0.05L8.312,225.514c-11.082,11.104-11.082,29.071,0,40.158 c11.087,11.101,29.089,11.101,40.172,0l187.71-187.729c6.115-6.083,16.893-6.083,22.976-0.018l187.742,187.747 c5.567,5.551,12.825,8.312,20.081,8.312c7.271,0,14.541-2.764,20.091-8.312C498.17,254.586,498.17,236.619,487.083,225.514z"/> <path d="M257.561,131.836c-5.454-5.451-14.285-5.451-19.723,0L72.712,296.913c-2.607,2.606-4.085,6.164-4.085,9.877v120.401 c0,28.253,22.908,51.16,51.16,51.16h81.754v-126.61h92.299v126.61h81.755c28.251,0,51.159-22.907,51.159-51.159V306.79 c0-3.713-1.465-7.271-4.085-9.877L257.561,131.836z"/> </g> </g> </g> </g>
                            
                            </svg><span class="mt-1">Home</span></a>
                    </li>
                    <?php if(isset($_SESSION['user_id'])) {
                        echo '<li>
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
                            What\'s on your mind?
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
                                      class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none resize-none"
                                      placeholder="Type here..." required style="white-space: pre-wrap;"></textarea>
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
                        <a href="./profile.php" class="flex flex-col items-center text-xs py-2 px-3 text-gray-700 rounded md:px-4 md:bg-transparent md:text-gray-500 md:hover:text-gray-900 md:p-0"><svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    
                            <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                            
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                            
                            <g id="SVGRepo_iconCarrier">
                            
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.5 7.063C16.5 10.258 14.57 13 12 13c-2.572 0-4.5-2.742-4.5-5.938C7.5 3.868 9.16 2 12 2s4.5 1.867 4.5 5.063zM4.102 20.142C4.487 20.6 6.145 22 12 22c5.855 0 7.512-1.4 7.898-1.857a.416.416 0 0 0 .09-.317C19.9 18.944 19.106 15 12 15s-7.9 3.944-7.989 4.826a.416.416 0 0 0 .091.317z" fill="#3E3E3F"/>
                            
                            </g>
                            
                        </svg><span class="mt-1">Profile</span></a>
                    </li>';
                    } else {
                        echo '<li>
                        <!-- Dark overlay -->
        <div x-show="showModal" class="fixed top-0 left-0 w-full h-full bg-black opacity-75 z-40"></div>
    
        <!-- Modal toggle -->
        <a @click="showModal = true" class="pointer-events-none opacity-50 flex flex-col items-center text-xs py-2 px-3 text-gray-700 rounded md:px-4 md:bg-transparent md:text-gray-500 md:hover:text-gray-900 md:p-0"><svg fill="#3E3E3F" width="20px" height="20px" viewBox="-0.5 -0.5 24 24" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin" class="jam jam-write-f">
    
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
                            What\'s on your mind?
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
                                      class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none resize-none"
                                      placeholder="Type here..." required style="white-space: pre-wrap;"></textarea>
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
                        <a href="./profile.php" class="pointer-events-none opacity-50 flex flex-col items-center text-xs py-2 px-3 text-gray-700 rounded md:px-4 md:bg-transparent md:text-gray-500 md:hover:text-gray-900 md:p-0"><svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    
                            <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                            
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                            
                            <g id="SVGRepo_iconCarrier">
                            
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.5 7.063C16.5 10.258 14.57 13 12 13c-2.572 0-4.5-2.742-4.5-5.938C7.5 3.868 9.16 2 12 2s4.5 1.867 4.5 5.063zM4.102 20.142C4.487 20.6 6.145 22 12 22c5.855 0 7.512-1.4 7.898-1.857a.416.416 0 0 0 .09-.317C19.9 18.944 19.106 15 12 15s-7.9 3.944-7.989 4.826a.416.416 0 0 0 .091.317z" fill="#3E3E3F"/>
                            
                            </g>
                            
                        </svg><span class="mt-1">Profile</span></a>
                    </li>';
                    } ?>
                    
                    
                </ul>
            </div>
        </div>
    </nav>
<section class="py-8 mt-6 lg:mt-2 lg:py-16 antialiased">
    <div class="max-w-2xl mx-auto px-4 my-8">
        <?php 
        $animalNames = array(
            'Luna Lynx',
            'Stellar Stallion',
            'Azure Albatross',
            'Celestial Cheetah',
            'Safari Serpent',
            'Nova Nectar',
            'Polar Panther',
            'Aurora Avian',
            'Jungle Jaguar',
            'Galactic Gecko',
            'Amber Arctic',
            'Quasar Quokka',
            'Savannah Sparrow',
            'Marine Meerkat',
            'Whispering Wolf',
            'Zephyr Zebra',
            'Ethereal Elephant',
            'Solar Squirrel',
            'Luminous Lemur',
            'Sapphire Seahorse',
            'Tranquil Toucan',
            'Mystic Moose',
            'Cerulean Chameleon',
            'Frosty Fox',
            'Lush Llama',
            'Cosmic Cobra',
            'Jubilant Jellyfish',
            'Arctic Armadillo',
            'Amethyst Aardvark',
            'Emerald Eagle',
            'Quirky Quail',
            'Radiant Raccoon',
            'Abyssal Alpaca',
            'Tropical Turtle',
            'Sphinx Snail',
            'Pondering Penguin',
            'Lively Lynx',
            'Vibrant Vulture',
            'Serenity Seahorse',
            'Whimsical Wombat',
            'Crimson Coyote',
            'Infinite Iguana',
            'Zestful Zebra',
            'Lively Lemur',
            'Panoramic Parrot',
            'Bountiful Bobcat',
            'Velvet Viper',
            'Majestic Mantis',
            'Magnetic Marmoset',
            'Iridescent Ibis',
            'Nebula Numbat',
            'Quasar Quail',
            'Epic Elephant',
            'Soothing Sloth',
            'Blissful Butterfly',
            'Harmonic Hedgehog',
            'Eclipsed Echidna',
            'Radiant Rabbit',
            'Nautical Narwhal',
            'Jovial Jellyfish',
            'Zenith Zebra',
            'Mellow Manatee',
            'Opulent Owl',
            'Placid Pangolin',
            'Furry Ferret',
            'Lunar Lemur',
            'Vivid Viper',
            'Sylvan Salamander',
            'Whispering Walrus',
            'Enigmatic Eel',
            'Quizzical Quokka',
            'Cascade Chameleon',
            'Serene Seahorse',
            'Tranquil Tiger',
            'Lively Lizard',
            'Lunar Llama',
            'Frosty Falcon',
            'Radiant Raptor',
            'Gentle Giraffe',
            'Eclipsed Eagle',
            'Arctic Albatross',
            'Mystic Meerkat',
            'Whimsical Whale',
            'Placid Pangolin',
            'Dazzling Dingo',
            'Celestial Cheetah',
            'Pondering Puma',
            'Lagoon Lizard',
            'Lustrous Lynx',
            'Soothing Stingray',
            'Majestic Moth',
            'Harmonic Hummingbird',
            'Tranquil Tarsier',
            'Crimson Crane',
            'Glowing Gazelle'
        );
        $getQuotesQuery = "SELECT post_id, quote, date, user_id FROM posts ORDER BY datetime DESC";
        $result = mysqli_query($conn, $getQuotesQuery);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $post_id = $row["post_id"];
                $quote = $row["quote"];
                $date = $row["date"];
                $postuserid = $row["user_id"];
                $userQuery = "SELECT name, email from users WHERE user_id = $postuserid";
                $postedquote = mysqli_fetch_assoc(mysqli_query($conn, $userQuery));
                $postusername = $postedquote["name"];
                $postemail = $postedquote["email"];
                if(isset($_SESSION['user_id']))
                if($_SESSION['user_role'] == 1){
                    if($username != $postusername){
                        echo '<article class="p-6 mx-4 lg:mx-8 mt-5 lg:mt-5 border shadow-lg text-base bg-white rounded-lg">
                            <footer class="flex justify-between items-center mb-2">
                                <div class="flex items-center cursor-default">
                                    <p class="inline-flex items-center mr-3 text-sm text-gray-900 font-semibold"> '.$postusername.'</p>
                                    <p class="text-sm text-gray-600"><time pubdate datetime="2022-02-08"
                                            title="February 8th, 2022">'.$postemail.' - '.$date.'</time></p>
                                </div>';
                                echo '
                                </footer>
                                <p class="text-gray-500 cursor-default">'.$quote.'</p>';
                                echo '
                                <div class="flex items-center justify-between">
                        <div class="flex items-center mt-8 space-x-4">
                            <a href="./post.php?post_id='.$post_id.'" class="flex items-center text-xs text-gray-500 hover:underline dark:text-gray-400 font-sm">
                                <svg width="17px" height="17px" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="48" height="48" fill="white" fill-opacity="0.01"/>
                    <path d="M6 6L16 15.8995" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6 41.8995L16 32" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M42.0001 41.8995L32.1006 32" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M41.8995 6L32 15.8995" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M33 6H42V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M42 33V42H33" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M15 42H6V33" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6 15V6H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>    
                                
                                <p class="ml-1">View</p>
                                </a>
                                <a href="javascript:void(0);" onclick="shareOnWhatsApp('.$post_id.')" class="flex items-center text-xs text-gray-500 hover:underline dark:text-gray-400 font-sm">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.5 3.5L3.5 9L10 12L17 7L12 14L15 20.5L20.5 3.5Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>    
                                
                    <p class="ml-1">Share</p>
                                </a>
                            </div> 
                            <div class="flex items-center mt-8">';
                            if(!isset($_SESSION['user_id'])){
                                echo'    <a href="./report.php?post_id='.$post_id.'" class=" pointer-events-none opacity-50 flex ml-1 items-center bg-white text-xs text-gray-500 hover:underline font-small">
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 9V14" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12.0001 21.41H5.94005C2.47005 21.41 1.02005 18.93 2.70005 15.9L5.82006 10.28L8.76006 5.00003C10.5401 1.79003 13.4601 1.79003 15.2401 5.00003L18.1801 10.29L21.3001 15.91C22.9801 18.94 21.5201 21.42 18.0601 21.42H12.0001V21.41Z" stroke="#6B7280" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M11.9945 17H12.0035" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                                                <p class="ml-1">Report</p>
                                            </a></div></div>
                                    </article>';
                            } else {
                                echo'    <a href="./report.php?post_id='.$post_id.'" class="flex ml-1 items-center bg-white text-xs text-gray-500 hover:underline font-small">
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 9V14" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12.0001 21.41H5.94005C2.47005 21.41 1.02005 18.93 2.70005 15.9L5.82006 10.28L8.76006 5.00003C10.5401 1.79003 13.4601 1.79003 15.2401 5.00003L18.1801 10.29L21.3001 15.91C22.9801 18.94 21.5201 21.42 18.0601 21.42H12.0001V21.41Z" stroke="#6B7280" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M11.9945 17H12.0035" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                                                <p class="ml-1">Report</p>
                                            </a></div></div>
                                    </article>';
                            }
                            } else {
                                echo '<article class="p-6 mt-5 lg:mt-5 border shadow-lg text-base bg-white rounded-lg">
                            <footer class="flex justify-between items-center mb-2">
                                <div class="flex items-center cursor-default">
                                    <p class="inline-flex items-center mr-3 text-sm text-gray-900 font-semibold">  '.$postusername.'</p>
                                    <p class="text-sm text-gray-600"><time pubdate datetime="2022-02-08"
                                            title="February 8th, 2022">'.$date.'</time></p>
                                </div>
                                <a
                                    title="Your Post" class="flex items-center cursor-default bg-white text-xs text-gray-500 font-medium">
                                    M
                                </a>
                                ';
                                echo '
                                </footer>
                                <p class="text-gray-500 cursor-default">'.$quote.'</p>';
                                echo '
                        <div class="flex items-center mt-8 space-x-4">
                            <a href="./post.php?post_id='.$post_id.'" class="flex items-center text-xs text-gray-500 hover:underline dark:text-gray-400 font-sm">
                                <svg width="17px" height="17px" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="48" height="48" fill="white" fill-opacity="0.01"/>
                    <path d="M6 6L16 15.8995" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6 41.8995L16 32" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M42.0001 41.8995L32.1006 32" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M41.8995 6L32 15.8995" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M33 6H42V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M42 33V42H33" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M15 42H6V33" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6 15V6H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>    
                                
                                <p class="ml-1">View</p>
                                </a>
                                <a href="javascript:void(0);" onclick="shareOnWhatsApp('.$post_id.')" class="flex items-center text-xs text-gray-500 hover:underline dark:text-gray-400 font-sm">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.5 3.5L3.5 9L10 12L17 7L12 14L15 20.5L20.5 3.5Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>    
                                
                    <p class="ml-1">Share</p>
                                </a>
                            </div> 
                            </article>';
                                
                            }
                } else {
                if($username != $postusername){
        echo '<article class="p-6 mx-4 lg:mx-8 mt-5 lg:mt-5 border shadow-lg text-base bg-white rounded-lg">
            <footer class="flex justify-between items-center mb-2">
                <div class="flex items-center cursor-default">
                    <p class="inline-flex items-center mr-3 text-sm text-gray-900 font-semibold"> '.$animalNames[array_rand($animalNames)].'</p>
                    <p class="text-sm text-gray-600"><time pubdate datetime="2022-02-08"
                            title="February 8th, 2022">'.$date.'</time></p>
                </div>';
                echo '
                </footer>
                <p class="text-gray-500 cursor-default">'.$quote.'</p>';
                echo '
                <div class="flex items-center justify-between">
        <div class="flex items-center mt-8 space-x-4">
            <a href="./post.php?post_id='.$post_id.'" class="flex items-center text-xs text-gray-500 hover:underline dark:text-gray-400 font-sm">
                <svg width="17px" height="17px" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
    <rect width="48" height="48" fill="white" fill-opacity="0.01"/>
    <path d="M6 6L16 15.8995" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M6 41.8995L16 32" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M42.0001 41.8995L32.1006 32" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M41.8995 6L32 15.8995" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M33 6H42V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M42 33V42H33" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M15 42H6V33" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M6 15V6H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>    
                
                <p class="ml-1">View</p>
                </a>
                <a href="javascript:void(0);" onclick="shareOnWhatsApp('.$post_id.')" class="flex items-center text-xs text-gray-500 hover:underline dark:text-gray-400 font-sm">
                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M20.5 3.5L3.5 9L10 12L17 7L12 14L15 20.5L20.5 3.5Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>    
                
    <p class="ml-1">Share</p>
                </a>
            </div> 
            <div class="flex items-center mt-8">';
            if(!isset($_SESSION['user_id'])){
                echo'    <a href="./report.php?post_id='.$post_id.'" class=" pointer-events-none opacity-50 flex ml-1 items-center bg-white text-xs text-gray-500 hover:underline font-small">
                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 9V14" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M12.0001 21.41H5.94005C2.47005 21.41 1.02005 18.93 2.70005 15.9L5.82006 10.28L8.76006 5.00003C10.5401 1.79003 13.4601 1.79003 15.2401 5.00003L18.1801 10.29L21.3001 15.91C22.9801 18.94 21.5201 21.42 18.0601 21.42H12.0001V21.41Z" stroke="#6B7280" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M11.9945 17H12.0035" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
                                <p class="ml-1">Report</p>
                            </a></div></div>
                    </article>';
            } else {
                echo'    <a href="./report.php?post_id='.$post_id.'" class="flex ml-1 items-center bg-white text-xs text-gray-500 hover:underline font-small">
                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 9V14" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M12.0001 21.41H5.94005C2.47005 21.41 1.02005 18.93 2.70005 15.9L5.82006 10.28L8.76006 5.00003C10.5401 1.79003 13.4601 1.79003 15.2401 5.00003L18.1801 10.29L21.3001 15.91C22.9801 18.94 21.5201 21.42 18.0601 21.42H12.0001V21.41Z" stroke="#6B7280" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M11.9945 17H12.0035" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
                                <p class="ml-1">Report</p>
                            </a></div></div>
                    </article>';
            }
            } else {
                echo '<article class="p-6 mt-5 lg:mt-5 border shadow-lg text-base bg-white rounded-lg">
            <footer class="flex justify-between items-center mb-2">
                <div class="flex items-center cursor-default">
                    <p class="inline-flex items-center mr-3 text-sm text-gray-900 font-semibold">  '.$postusername.'</p>
                    <p class="text-sm text-gray-600"><time pubdate datetime="2022-02-08"
                            title="February 8th, 2022">'.$date.'</time></p>
                </div>
                <a
                    title="Your Post" class="flex items-center cursor-default bg-white text-xs text-gray-500 font-medium">
                    M
                </a>
                ';
                echo '
                </footer>
                <p class="text-gray-500 cursor-default">'.$quote.'</p>';
                echo '
        <div class="flex items-center mt-8 space-x-4">
            <a href="./post.php?post_id='.$post_id.'" class="flex items-center text-xs text-gray-500 hover:underline dark:text-gray-400 font-sm">
                <svg width="17px" height="17px" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
    <rect width="48" height="48" fill="white" fill-opacity="0.01"/>
    <path d="M6 6L16 15.8995" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M6 41.8995L16 32" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M42.0001 41.8995L32.1006 32" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M41.8995 6L32 15.8995" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M33 6H42V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M42 33V42H33" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M15 42H6V33" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M6 15V6H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>    
                
                <p class="ml-1">View</p>
                </a>
                <a href="javascript:void(0);" onclick="shareOnWhatsApp('.$post_id.')" class="flex items-center text-xs text-gray-500 hover:underline dark:text-gray-400 font-sm">
                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M20.5 3.5L3.5 9L10 12L17 7L12 14L15 20.5L20.5 3.5Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>    
                
    <p class="ml-1">Share</p>
                </a>
            </div> 
            </article>';
                
            }
            } else {
                if($username != $postusername){
                    echo '<article class="p-6 mx-4 lg:mx-8 mt-5 lg:mt-5 border shadow-lg text-base bg-white rounded-lg">
                        <footer class="flex justify-between items-center mb-2">
                            <div class="flex items-center cursor-default">
                                <p class="inline-flex items-center mr-3 text-sm text-gray-900 font-semibold"> '.$animalNames[array_rand($animalNames)].'</p>
                                <p class="text-sm text-gray-600"><time pubdate datetime="2022-02-08"
                                        title="February 8th, 2022">'.$date.'</time></p>
                            </div>';
                            echo '
                            </footer>
                            <p class="text-gray-500 cursor-default">'.$quote.'</p>';
                            echo '
                            <div class="flex items-center justify-between">
                    <div class="flex items-center mt-8 space-x-4">
                        <a href="./post.php?post_id='.$post_id.'" class="flex items-center text-xs text-gray-500 hover:underline dark:text-gray-400 font-sm">
                            <svg width="17px" height="17px" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="48" height="48" fill="white" fill-opacity="0.01"/>
                <path d="M6 6L16 15.8995" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M6 41.8995L16 32" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M42.0001 41.8995L32.1006 32" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M41.8995 6L32 15.8995" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M33 6H42V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M42 33V42H33" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M15 42H6V33" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M6 15V6H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>    
                            
                            <p class="ml-1">View</p>
                            </a>
                            <a href="javascript:void(0);" onclick="shareOnWhatsApp('.$post_id.')" class="flex items-center text-xs text-gray-500 hover:underline dark:text-gray-400 font-sm">
                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20.5 3.5L3.5 9L10 12L17 7L12 14L15 20.5L20.5 3.5Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>    
                            
                <p class="ml-1">Share</p>
                            </a>
                        </div> 
                        <div class="flex items-center mt-8">';
                        if(!isset($_SESSION['user_id'])){
                            echo'    <a href="./report.php?post_id='.$post_id.'" class=" pointer-events-none opacity-50 flex ml-1 items-center bg-white text-xs text-gray-500 hover:underline font-small">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 9V14" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12.0001 21.41H5.94005C2.47005 21.41 1.02005 18.93 2.70005 15.9L5.82006 10.28L8.76006 5.00003C10.5401 1.79003 13.4601 1.79003 15.2401 5.00003L18.1801 10.29L21.3001 15.91C22.9801 18.94 21.5201 21.42 18.0601 21.42H12.0001V21.41Z" stroke="#6B7280" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M11.9945 17H12.0035" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                                            <p class="ml-1">Report</p>
                                        </a></div></div>
                                </article>';
                        } else {
                            echo'    <a href="./report.php?post_id='.$post_id.'" class="flex ml-1 items-center bg-white text-xs text-gray-500 hover:underline font-small">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 9V14" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12.0001 21.41H5.94005C2.47005 21.41 1.02005 18.93 2.70005 15.9L5.82006 10.28L8.76006 5.00003C10.5401 1.79003 13.4601 1.79003 15.2401 5.00003L18.1801 10.29L21.3001 15.91C22.9801 18.94 21.5201 21.42 18.0601 21.42H12.0001V21.41Z" stroke="#6B7280" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M11.9945 17H12.0035" stroke="#6B7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                                            <p class="ml-1">Report</p>
                                        </a></div></div>
                                </article>';
                        }
                        } else {
                            echo '<article class="p-6 mt-5 lg:mt-5 border shadow-lg text-base bg-white rounded-lg">
                        <footer class="flex justify-between items-center mb-2">
                            <div class="flex items-center cursor-default">
                                <p class="inline-flex items-center mr-3 text-sm text-gray-900 font-semibold">  '.$postusername.'</p>
                                <p class="text-sm text-gray-600"><time pubdate datetime="2022-02-08"
                                        title="February 8th, 2022">'.$date.'</time></p>
                            </div>
                            <a
                                title="Your Post" class="flex items-center cursor-default bg-white text-xs text-gray-500 font-medium">
                                M
                            </a>
                            ';
                            echo '
                            </footer>
                            <p class="text-gray-500 cursor-default">'.$quote.'</p>';
                            echo '
                    <div class="flex items-center mt-8 space-x-4">
                        <a href="./post.php?post_id='.$post_id.'" class="flex items-center text-xs text-gray-500 hover:underline dark:text-gray-400 font-sm">
                            <svg width="17px" height="17px" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="48" height="48" fill="white" fill-opacity="0.01"/>
                <path d="M6 6L16 15.8995" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M6 41.8995L16 32" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M42.0001 41.8995L32.1006 32" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M41.8995 6L32 15.8995" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M33 6H42V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M42 33V42H33" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M15 42H6V33" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M6 15V6H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>    
                            
                            <p class="ml-1">View</p>
                            </a>
                            <a href="javascript:void(0);" onclick="shareOnWhatsApp('.$post_id.')" class="flex items-center text-xs text-gray-500 hover:underline dark:text-gray-400 font-sm">
                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20.5 3.5L3.5 9L10 12L17 7L12 14L15 20.5L20.5 3.5Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>    
                            
                <p class="ml-1">Share</p>
                            </a>
                        </div> 
                        </article>';
                            
                        }
            }
        }}
        ?>
    </div>
</section>
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
<script>
    function shareOnWhatsApp(postId) {
        var postUrl = encodeURIComponent(window.location.origin + '/social/post.php?post_id=' + postId);
        var whatsappMessage = "Check out this quote: " + postUrl;
        window.open('https://wa.me/?text=' + whatsappMessage);
    }
</script>

</body>
</html>
