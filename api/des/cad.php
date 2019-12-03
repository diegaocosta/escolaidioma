<?php
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "insert into despesa values (" . getIdMax("despesa") . ",";
    $query .= "'" . $_POST["nome"] . "',";
    $query .= str_replace(",", ".", $_POST["valor"]) . ",";
    $query .= "'" . $_POST["data"] . "',";
    $query .= "'" . $_POST["obs"] . "')";
    echo $query;
    inserir($query);
    header("Location: ../../paginas/desList.php");