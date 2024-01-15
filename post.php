<?php
include_once("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MuseWords - Post</title>
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
        
            $getQuoteQuery = "SELECT * FROM posts WHERE post_id = $post_id";
            $quoteResult = mysqli_query($conn, $getQuoteQuery);
        
            if ($quoteResult && mysqli_num_rows($quoteResult) > 0) {
                $quoteDetails = mysqli_fetch_assoc($quoteResult);
                $quote = $quoteDetails["quote"];
                $date = $quoteDetails["date"];
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
                echo '<article class="p-6  md:mx-8 mt-24 lg:mt-5 border shadow-2xl text-base bg-white rounded-lg">
                    <footer class="flex justify-between items-center mb-2">
                        <div class="flex items-center">
                            <p class="inline-flex items-center mr-3 text-sm text-gray-900 font-semibold"> '.$animalNames[array_rand($animalNames)].'</p>
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
                    <a href="javascript:void(0);" onclick="shareOnWhatsApp('.$post_id.')" class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">
                        Share
                    </a>
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
    function shareOnWhatsApp(postId) {
        var postUrl = encodeURIComponent(window.location.href);
        var whatsappMessage = "Check out this quote: " + postUrl;
        window.open('https://wa.me/?text=' + whatsappMessage);
    }
</script>
</body>
</html>