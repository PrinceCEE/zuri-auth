<?php
session_start();
// check if the email is set to the session
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
  <title>Registration page</title>
  <?php require("./style.php") ?>
</head>

<body>
  <div class="container">
    <div>
      <h1>Register with your details to Zuri Authentication</h1>
      <main>
        <form method="POST">
          <div>
            <label>Names</label>
            <input type="text" name="names" placeholder="John Doe" required>
          </div>
          <div>
            <label>Email address</label>
            <input type="email" name="email" placeholder="example@joe.com" required>
          </div>
          <div>
            <label>About me</label>
            <textarea name="about" placeholder="Please tell us about you" cols="48" rows="10" required></textarea>
          </div>
          <div>
            <label>Password</label>
            <input type="password" name="password" placeholder="******" required>
          </div>
          <p>
            <a href="/zuri-auth/login.php">Already have an account? Login</a>
          </p>
          <button>Register</button>
        </form>
        <?php
        // retrieve the user details
        $names = $_POST["names"];
        $email = strtolower($_POST["email"]);
        $about = $_POST["about"];
        $pwd = $_POST["password"];

        $userDetail = trim($names . $email . $about . $pwd);
        if (strlen($userDetail) != 0) {
          // check the file to know if there's an email like that of the user
          $dbFile = fopen("db.txt", "a+");
          $isFound = false;
          while (!feof($dbFile)) {
            $content = fgets($dbFile);
            if (strpos($content, $email) !== false) {
              $isFound = true;
              break;
            }
          }

          // if there's take them to the login page
          // if not, store their details to the file and log them in
          if ($isFound) {
            fclose($dbFile);
            header("Location: /zuri-auth/login.php");
            exit;
          } else {
            // saving the user's detail with a "_" separator
            fwrite($dbFile, $names . "_" . $email . "_" . $about . "_" . $pwd . "\n");
            fclose($dbFile);

            // store user email to the session and redirect them to the index page
            $_SESSION["isAuthenticated"] = true;
            $_SESSION["email"] = $email;
            header("Location: /zuri-auth/index.php");
          }
        }
        ?>
      </main>
    </div>
  </div>
</body>

</html>