<!DOCTYPE html>
<html>
    <head>
        <title>Halaman Login</title>
        <link rel="stylesheet" type="text/css" href="aset/css/Login.css">
    </head>
    <body>
    <div class="loginBox">
      <img src="aset/gambar/iconfinder.png" class="user">
      <h2>Log In Here</h2>
      <form action="proses_login_admin.php" method="POST">
        <p>Username</p>
        <input type="text" name="username" placeholder="Enter Username" required>
        <p>Password</p>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit" value="Sign In">Login</button>
      </form>
    </div>
    </body>
</html>