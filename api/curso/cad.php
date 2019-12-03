<?php
    include "../geralDAO.php";
    var_dump($_POST);
    $id = getIdMax("curso");
    $query = "insert into curso values (" . $id . ",";
    $query .= "'" . $_POST["nome"] . "',";
    $query .= $_POST["totaldemes"] . ",";
    $query .= str_replace(",", ".", $_POST["valor"]) . ",";
    $query .= $_POST["tipomulta"] . ",";
    $query .= str_replace(",", ".", $_POST["multa"]) . ",1,";
    $query .= "'" . $_POST["obs"] . "')";

    $mate = explode(",", $_POST["matelist"]);
    array_splice($_POST,4,1);
    echo $query;
    inserir($query);
    foreach ($mate as $i)
    {
        $query = "insert into matecurso values(" . getIdMax("matecurso") . ", $i, $id)";
        echo $query;
        inserir($query);
    }
    header("Location: ../../paginas/cursoList.php");