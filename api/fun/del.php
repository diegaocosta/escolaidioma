<?php
    $id = explode("?", $_SERVER["REQUEST_URI"])[1];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "update funcionario set status = 5 where id = $id";
    echo $query;
    inserir($query);
    header("Location: ../../paginas/funList.php");
