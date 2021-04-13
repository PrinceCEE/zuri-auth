<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset password page</title>
  <?php require("./style.php") ?>
</head>

<body>
  <div class="container">
    <div>
      <h1>Reset your password</h1>
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
          <div>
            <label>Confirm assword</label>
            <input type="password" name="cpassword" placeholder="******" required>
          </div>
          <button>Reset</button>
          <?php
          $email = strtolower($_POST["email"]);
          $pwd = $_POST["password"];
          $cPwd = $_POST["cpassword"];

          if (strlen($email . $pwd . $cPwd) != 0) {
            if ($pwd !== $cPwd) {
              echo "<p class=\"error\">The passwords don't match.</p>";
              exit;
            }
            $dbFile = fopen("db.txt", "r+");
            $usersDetails = "";
            $emailFound = false;

            // check if the email exists
            while (!feof($dbFile)) {
              $line = fgets($dbFile);
              if (strpos($line, $email) != false) {
                $emailFound = true;
                break;
              }
            }

            fclose($dbFile);

            if (!$emailFound) {
              echo "<p class=\"error\">Email not registered.</p>";
              exit;
            }

            $dbFile = fopen("db.txt", "r+");
            while (!feof($dbFile)) {
              $line = fgets($dbFile);
              if (strpos($line, $email) != false) {
                $user = explode("_", $line);
                $user[count($user) - 1] = $pwd;
                $line = implode("_", $user) . "\n";
              }

              $usersDetails .= $line;
            }

            file_put_contents("db.txt", $usersDetails);
            fclose($dbFile);
            header("Location: /zuri-auth/login.php");
          }
          ?>
        </form>
      </main>
    </div>
  </div>
</body>

</html>