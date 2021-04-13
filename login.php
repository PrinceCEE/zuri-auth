<?php
session_start();
if (isset($_SESSION["isAuthenticated"])) {
  header("Location: /zuri-auth/index.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login page</title>
  <?php require("./style.php") ?>
</head>

<body>
  <div class="container">
    <div>
      <h1>Log to Zuri Authentication</h1>
      <main>
        <form method="POST">
          <div>
            <label>Email address</label>
            <input type="email" name="email" placeholder="example@joe.com" required>
          </div>
          <div>
            <label>Password</label>
            <input type="password" name="password" placeholder="******" required>
          </div>
          <p>
            <a href="/zuri-auth/registration.php">Don't have an account? Register</a>
          </p>
          <p>
            <a href="/zuri-auth/reset-password.php">Reset password</a>
          </p>
          <button>Login</button>
          <?php
          $isFound = false;
          $userDetail;
          $email = strtolower($_POST["email"]);
          $pwd = $_POST["password"];
          $dbFile = fopen("db.txt", "r");
          while (!feof($dbFile)) {
            $line = fgets($dbFile);
            if (strpos($line, $email) != false) {
              $userDetail = $line;
              $isFound = true;
              break;
            }
          }

          fclose($dbFile);

          if (strlen($email . $pwd) != 0) {
            if ($isFound) {
              // check if the password matches the password stored
              $user = explode("_", $userDetail);
              $storedPassword = trim($user[count($user) - 1]);
              if ($storedPassword == $pwd) {
                // store user email to the session and redirect them to the index page
                $_SESSION["isAuthenticated"] = true;
                $_SESSION["email"] = $email;
                header("Location: /zuri-auth/index.php");
              } else {
                echo "<p class=\"error\">Invalid login details, did you forget anything?</p>";
              }
            } else {
              echo "<p class=\"error\">Email not registered, please go and register</p>";
            }
          }
          ?>
        </form>
      </main>
    </div>
  </div>
</body>

</html>