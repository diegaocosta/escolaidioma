<?php
    $id = explode("?", $_SERVER["REQUEST_URI"])[1];
    include "../geralDAO.php";
    $query = "";
    foreach ($_POST as $i=>$j)
    {
        if ($query != "") $query .= ", ";
        $query .= "$i = '$j'";
    }
    $query = "update turma set " . $query . " where id = $id";
    echo $query;
    inserir($query);


    header("Location: ../../paginas/turmaList.php");