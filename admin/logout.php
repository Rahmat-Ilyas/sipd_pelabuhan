<?php 
session_start();
unset($_SESSION['login_admin']);
header("location: index.php");