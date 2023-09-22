<?php
session_start();
$name=$_SESSION['name'];

echo "<h1>Hi $name Welcome</h1>";
?>