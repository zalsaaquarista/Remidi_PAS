<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login Karyawan</title>
    <link rel="stylesheet" href="Login.css">
  </head>
  <body>
    <div class="loginBox">
      <img src="aset/gambar/iconfinder.png" class="user">
      <h2>Log In Here</h2>
      <form action="proses_karyawan.php" method="post">
        <input type="hidden" action="proses_karyawan.php" value="">
        <p>Username</p>
        <input type="text" name="username" placeholder="Enter Username" required>
        <p>Password</p>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit">LOGIN</button>
      </form>
    </div>
  </body>
</html>
