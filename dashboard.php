<?php
include 'include/header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<div class="flex justify-center items-center w-11/12 md:w-7/10 lg:w-full mb-1 break-words rounded-lg bg-cover bg-center" style="background-image: url('include/assets/par.jpg'); height: 70vh;">
    <div class="mx-auto p-6 rounded-lg shadow-lg bg-gray-200 bg-opacity-75 h-auto flex flex-col justify-center items-center">
        <h1 class="text-4xl font-bold mb-4 text-black text-center">Welcome to your own Website</h1>
        <p class="mb-6 text-black text-center">Discover our amazing features and benefits.</p>
        <a href="artic.php" class=" button bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">explore</a>
    </div>
</div>


<div class="bg-gray-200 p-5 mt-5 shadow-lg rounded-lg w-11/12 md:w-7/10 lg:w-full mx-auto mb-13 break-words">
    <div class="flex flex-col lg:flex-row lg:gap-2 justify-around mb-5 text-center">
        <div class="bg-red-500 p-5 rounded-lg w-full mb-5 lg:mb-0 hover-grow transition-transform duration-300 ease-in-out">
           
            <a href="" class="mr-2 p-3 rounded-lg no-underline bg-red-400 mb-6 text-white bg-green-900 hover:bg-green-600">Indian constitution</a>
        </div>
        <div class="bg-yellow-600 p-5 py-10 rounded-lg w-full mb-5 lg:mb-0 hover-grow transition-transform duration-300 ease-in-out">
           
            <a href="" class="p-3 rounded-lg bg-red-400 mb-6 text-white bg-green-900 hover:bg-green-600">game play</a>
        </div>
        <div class="bg-gray-600 p-5 rounded-lg w-full hover-grow transition-transform duration-300 ease-in-out">
            
            <a href="" class="mr-2 p-3 rounded-lg bg-red-400 mb-6 text-white bg-green-900 hover:bg-green-600">debate</a>
        </div>
    </div>
</div>
<div class="bg-gray-200 p-5 mt-5 shadow-lg rounded-lg w-11/12 md:w-7/10 lg:w-full mx-auto mb-13 break-words">
    <div class="flex flex-col lg:flex-row lg:gap-2 justify-around mb-5 text-center">
        <div class="bg-yellow-600 p-5 py-10 rounded-lg w-full mb-5 lg:mb-0 hover-grow transition-transform duration-300 ease-in-out">
           
            <a href="" class="p-3 rounded-lg bg-red-400 mb-6 text-white bg-green-900 hover:bg-green-600">discussion</a>
        </div>
        <div class="bg-gray-600 p-5 rounded-lg w-full hover-grow transition-transform duration-300 ease-in-out">
            
            <a href="" class="mr-2 p-3 rounded-lg bg-red-400 mb-6 text-white bg-green-900 hover:bg-green-600">explore recent event</a>
        </div>
        <div class="bg-red-500 p-5 rounded-lg w-full mb-5 lg:mb-0 hover-grow transition-transform duration-300 ease-in-out">
           
            <a href="" class="mr-2 p-3 rounded-lg no-underline bg-red-400 mb-6 text-white bg-green-900 hover:bg-green-600"> query chatbot</a>
        </div>
    </div>
</div>
<div class="bg-gray-200 p-5 mt-5 shadow-lg rounded-lg w-11/12 md:w-7/10 lg:w-full mx-auto mb-13 break-words">
<div class="bg-blue-200 bg-opacity-50 p-5 mt-5 shadow-lg rounded-lg w-11/12 md:w-7/10 lg:w-1/2 mx-auto mb-14 break-words hover-grow transition-transform duration-300 ease-in-out rounded-lg">
    <h1 class="ml-5 mb-12 text-4xl font-bold">user feedback</h1>
    <form action="login.php" method="POST">
       
        <input type="longtext" name="desc" placeholder="enter your feedback" required class="block w-11/12 mb-4 ml-6 p-2 border border-gray-300 rounded-lg">
        <button type="submit" class="block w-11/12 mb-4 ml-6 p-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700 ">Submit</button>
    </form>
    
</div>
</div>



<?php
include 'include/footer.php'; 
?>

</body>
</html>