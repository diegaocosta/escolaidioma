<?php
    include "../geralDAO.php";
    $id = explode("?", $_SERVER["REQUEST_URI"])[1];
    // var_dump($_POST);
    $_POST["comprado"] = str_replace(",",".", $_POST["comprado"]);
    $_POST["valor"] = str_replace(",",".", $_POST["valor"]);
    $query = "update material set comprado = " . $_POST["comprado"] . ",";
    $query .= "valor = " . $_POST["valor"] . ",";
    $query .= "total = (total + " . $_POST["total"] . ") where id = $id";
    echo $query;
    inserir($query);

    $query = "insert into despesa values (" . getIdMax("despesa") . ", 'Compra de Material'" . "," . (floatval($_POST["comprado"]) * intval($_POST["total"])) . ",'" . date("Y-m-d") . "',";
    $query .= "(select concat('Compra de material: ', material.nome) from material where id = $id))";
    echo $query;
    inserir($query);
    header("Location: ../../paginas/mateList.php");