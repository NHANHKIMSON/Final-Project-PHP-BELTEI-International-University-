
<?php
session_start();
$conn = mysqli_connect('localhost','root','','login_php_asignment');
if(!isset($conn)){
  echo "
  <scritpt>
  alert('Error Connection');
  </scritpt>
  ";
}
if(isset($_POST['btn'])){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $query = "SELECT * FROM admin WHERE username = '$username' and password = '$password'";
  $excute =  mysqli_query($conn, $query);
  $count = mysqli_fetch_array($excute);
  $usertype = $count['key'];
  if($count>1){
    if($usertype=='admin'){
      $_SESSION['login'] = true;
      header('location: ./cms/index.php');
    }else{ 
      $_SESSION['login'] = true;
      header('location: ../Home.php');
    }
  }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="Main.css">
</head>
<body>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900">
        <div class="dark:bg-gray-800 p-6 rounded-lg shadow-lg w-96">
          <h1 class="text-2xl font-bold text-gray-900 dark:text-slate-100 text-center mb-6">
            Welcome back
          </h1>
          <form class="flex flex-col space-y-4" method="post">
            <div>
              <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-1">Username</label>
              <input name="username" type="text" id="username" class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your username" required />
            </div>
            <div>
              <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-400 mb-1">Password</label>
              <input name="password" type="password" id="password" class="w-full px-3 py-2 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your password" required />
            </div>
            <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400">
              <label class="flex items-center">
                <input type="checkbox" class="form-checkbox text-blue-500 rounded mr-2" />
                Remember me
              </label>
              <a href="#" class="hover:underline text-blue-400">Forgot password?</a>
            </div>
            <button name="btn" type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white py-2 rounded font-medium">
              Sign in to your account
            </button>
          </form>
          <div class="flex items-center mb-4">
            <hr class="flex-grow border-gray-300 dark:border-gray-600" />
            <span class="px-2 text-gray-500 dark:text-gray-400">or</span>
            <hr class="flex-grow border-gray-300 dark:border-gray-600" />
          </div>
          <p class="text-sm text-center text-gray-500 dark:text-gray-400 mt-4">
            Don’t have an account yet? <a href="Register.html" class="text-blue-400 hover:underline">Sign up here</a>
          </p>
          <div class="flex justify-between mt-4">
            <button class="flex items-center justify-center bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-900 dark:text-white py-2 px-4 rounded w-1/2 mr-2">
              <img src="/img/image.png" alt="Google" class="w-5 h-5 mr-2" />
              Log in with Google
            </button>
            <button class="flex items-center justify-center bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-900 dark:text-white py-2 px-4 rounded w-1/2 ml-2">
              <img src="/img/image-copy.png" alt="Apple" class="w-5 h-5 mr-2" />
              Log in with Apple
            </button>
          </div>
          
        </div>
      </div>
</body>
</html>