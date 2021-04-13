<?php
session_start();
session_destroy();
header("Location: /zuri-auth/login.php");
exit;
