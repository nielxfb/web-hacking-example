<?php

session_start();

// Clears current session's user
unset($_SESSION['user']);
header("Location: index.php");
exit();
