<?php
    $l = explode("?", $_SERVER["REQUEST_URI"])[1];
    $status = explode("&", $l)[1];
    $id = explode("&", $l)[0];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "update usuario set status = " . (($status == 1) ? 0 : 1) . " where id = $id";
    inserir($query);
    echo $query;
    header("Location: ../../paginas/userList.php");
    