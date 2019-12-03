<?php
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "insert into receita values (" . getIdMax("receita") . ",";
    $query .= "'" . $_POST["nome"] . "',";
    $query .= str_replace(",", ".", $_POST["valor"]) . ",";
    $query .= "'" . $_POST["data"] . "',";
    $query .= "'" . $_POST["obs"] . "')";
    echo $query;
    inserir($query);
    header("Location: ../../paginas/recList.php");