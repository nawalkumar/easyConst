<?php
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easyConst</title>
     
     <style>
            @keyframes bg-color-change {
            0% {
                background-color: #C3979F; 
            }
            50% {
                background-color: #023C40;
                color:green
            }
            100% {
                background-color: #78FFD6; 
                color: black; 
            }
            }

            .header {
            animation: bg-color-change 5s infinite;
            }
            @keyframes button-colorchange{
                0%{
                    transform: scale(1,1);
                }
                50%{ 
                    transform:scale(1.1,1.1);
                }
                100%{
                    transform:scale(1,1);
                }
            }
            .button{
                animation: button-colorchange 3s infinite linear;
            }
            .movecontent {
            position: absolute;
            white-space: nowrap;
            animation: moveRight 24s 0s infinite linear;
        }
        @keyframes moveRight {
            0% {
               left:-100%;
            }
            50%{
                left:100%;
            }
            100% {
                left:-100%;
            }
        }
</style>
     <link rel="stylesheet" href="include/assets/quiz.css" >
     <link rel="stylesheet" href="include/assets/chat.css" >
     <!-- <link rel="stylesheet" href="include/assets/news.css" > -->
</head>
<body  class=" h-full font-roboto bg-gray-300 flex flex-col items-center m-0 text-center">
    <script src=include/assets/tailwind.js></script>
    <div class=" bg-gray-600 w-full text-white flex items-center justify-between h-16 max-w-full break-words">
        <h1 class="ml-5 mb-4 text-3xl font-bold">easyConst</h1>
        <nav>
            <?php if (!isset($_SESSION['user_id'])): ?>
                <a href="index.php" class="text-white no-underline mr-5 font-bold hover:underline">Home</a>
                <a href="signup.php" class="text-white no-underline mr-5 font-bold hover:underline">Sign Up</a>
                <a href="login.php" class="text-white no-underline mr-5 font-bold hover:underline">Login</a>
            <?php else: ?>
                <a href="dashboard.php" class="text-white no-underline mr-5 font-bold hover:underline">Dashboard</a>
                <a href="logout.php" class="text-white no-underline mr-5 font-bold hover:underline">Logout</a>
            <?php endif; ?>
        </nav>
    </div>
    <!-- <script src="include/assets/news.js"></script> -->