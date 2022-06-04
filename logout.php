<?php
session_start();
session_destroy();
if (isset($_COOKIE['userdata'])) {
    unset($_COOKIE['userdata']);
    setcookie('userdata', null, -1, '/');
} 
header('Location:index.php');
?>