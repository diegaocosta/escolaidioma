<?php
    include "../geralDAO.php";
    $id = explode("?", $_SERVER["REQUEST_URI"])[1];
    // $l = explode("?", $_SERVER["REQUEST_URI"])[1];
    // $idaluno = explode("&", $l)[0];
    // $idmens = explode("&", $l)[1];

    foreach(explode(",","valor,pago,valororiginal,desconto") as $i)
        $_POST[$i] = floatval(str_replace(",",".", $_POST[$i]));
    $_POST["nome"] .= " com " . str_replace(".", ",", $_POST["desconto"]) . (($_POST["percent"] == 1) ? "%" : "") . " de desconto.";
    
    var_dump($_POST);
    $query = "insert into pagamento values (" . getIdMax("pagamento") . ", ";
    $query .= "'" . $_POST["nome"] . "',";
    $query .= "'" . $_POST["data"] . "',";
    $query .= "'" . $_POST["desconto"] . "',";
    $query .= "'" . $_POST["pago"] . "',";
    $query .= "'" . $_POST["percent"] . "', 1, $id)";
    echo $query;
    inserir($query);

    $query = "update matricula set  matepag = 1 where id = $id";
    inserir($query);

    header("Location: ../../paginas/mensList.php");