<?php
session_start();
if (!isset($_SESSION["isAuthenticated"])) {
  header("Location: /zuri-auth/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to the homepage</title>
  <?php require("./style.php") ?>
</head>

<body>
  <div class="container">
    <div id="index">
      <h1>Hello, Welcome to the homepage</h1>
      <main>
        <?php
        $about;
        $name;
        $email = $_SESSION["email"];
        $dbFile = fopen("db.txt", "r");
        while (!feof($dbFile)) {
          $line = fgets($dbFile);
          if (strpos($line, $email) != false) {
            $user = explode("_", $line);
            $name = $user[0];
            $about = $user[2];
            break;
          }
        }
        fclose($dbFile);
        ?>
        <div>
          <h3><?php echo $name ?></h3>
          <p><?php echo $email ?></p>
        </div>
        <div>
          <p><?php echo $about ?></p>
        </div>
        <a href="/zuri-auth/logout.php">Log out</a>
      </main>
    </div>
  </div>
</body>

</html>