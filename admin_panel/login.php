<?php
include("../Includes/connect.php");
@session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-r from-indigo-400 via-purple-500 to-pink-500">

  <div class="flex w-4/5 max-w-5xl rounded-3xl overflow-hidden shadow-2xl bg-gradient-to-br from-indigo-200 via-purple-200 to-pink-200">
    <!-- Left side: image with overlay and gradient text background -->

    <!-- Right side: login form -->
    <div class="w-full md:w-1/2 bg-white/90 backdrop-blur-md p-14 flex flex-col justify-center rounded-r-3xl shadow-lg">
      <h2 class="text-4xl font-extrabold text-purple-700 mb-10 text-center drop-shadow">
        Sign In
      </h2>
      <form action="" method="post" class="space-y-8">
        <div>
          <label for="user_username" class="block text-gray-700 font-semibold mb-2">
            Username
          </label>
          <input
            type="text"
            id="user_username"
            name="user_username"
            placeholder="Enter your username"
            required
            class="w-full px-5 py-3 rounded-xl border-2 border-purple-400 focus:border-purple-600 focus:ring-2 focus:ring-purple-500 transition outline-none"
          />
        </div>
        <div>
          <label for="user_password" class="block text-gray-700 font-semibold mb-2">
            Password
          </label>
          <input
            type="password"
            id="user_password"
            name="user_password"
            placeholder="Enter your password"
            required
            class="w-full px-5 py-3 rounded-xl border-2 border-purple-400 focus:border-purple-600 focus:ring-2 focus:ring-purple-500 transition outline-none"
          />
        </div>
        <button
          type="submit"
          name="user_login"
          class="w-full py-4 mt-6 bg-gradient-to-r from-purple-600 via-indigo-600 to-pink-600 text-white text-xl font-extrabold rounded-xl shadow-lg hover:scale-105 hover:brightness-110 transition transform duration-300"
        >
          Login
        </button>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
if(isset($_POST['user_login'])){
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];

    $select_query = "SELECT * FROM admin_table WHERE username='$user_username' AND admin='no'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);

    if($row_count > 0){
        if(password_verify($user_password, $row_data['password'])){
            $_SESSION['username'] = $user_username;
            echo "<script>alert('Login Successful')</script>";
            echo "<script>window.open('./index.php','_self')</script>";
        } else {
            echo "<script>alert('Invalid Credentials!')</script>";
        }
    } else {
        echo "<script>alert('Invalid Credentials!')</script>";
    }
}
?>
