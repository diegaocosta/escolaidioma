<?php
    $l = explode("?", $_SERVER["REQUEST_URI"])[1];
    $id = explode("&", $l)[0];
    $senha = explode("&", $l)[1];
    $query = "update usuario set senha = sha1(concat(salt, md5('$senha'), salt)) where id = $id";
    echo $query;
    include "../geralDAO.php";
    header("Location: ../../paginas/login.php");