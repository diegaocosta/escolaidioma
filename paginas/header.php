<?php
session_start();
    if (!isset($_SESSION["login"]))
        header("login.php");
    // echo $_SESSION["login"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../js/jquery.js"></script>
    <script src="../js/base.js"></script>
    <script src="../js/pdfmake.js"></script>
    <script src="../js/vfs_fonts.js"></script>
    <link rel="stylesheet" href="../css/base.css">