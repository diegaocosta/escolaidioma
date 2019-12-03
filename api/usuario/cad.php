<?php
    $id = explode("?", $_SERVER["REQUEST_URI"])[1];
    include "../geralDAO.php";
    var_dump($_POST);
    $salt = md5(date('Y-m-d'));
    // echo $salt;
    $senha = $salt . md5($_POST["senha"]) . $salt;
    $senha = sha1($senha);
    $query = "insert into usuario values (" . getIdMax("usuario") . ",";
    $query .= "'" . $_POST["login"] . "',";
    $query .= "'" . $senha . "',";
    $query .= "'" . $salt . "',";
    $query .=  $_POST["cargoid"] . ",1,$id)";
    echo $query;
    inserir($query);
    session_start();
    if (isset($_SESSION["login"]))
    // echo "sim";
    header("Location: ../../paginas/userList.php");
    else
    // echo "naum";
        header("Location: ../../paginas/login.php");