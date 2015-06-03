<?php
session_start();
unset($_SESSION['id']);
setcookie('remember_me', '', time()-1);

header("Location:login.php");
