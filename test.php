<?php
session_start();
$_SESSION['test'] = "HELLO";
echo $_SESSION['test'];
?>
