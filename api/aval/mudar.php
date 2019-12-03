<?php
    include "../geralDAO.php";
    $id = explode("?", $_SERVER["REQUEST_URI"])[1];
    var_dump($_POST);
    $pesos = explode(";", $_POST["pesos"]);
    foreach ($pesos as $i)
    {
        $j = explode(",", $i);
        $query = "update avaliacao set peso = $j[1] where id = $j[0]";
        echo $query  . "<br>" ;
        inserir($query);
    }
    header("Location: ../../paginas/avalList.php?$id");