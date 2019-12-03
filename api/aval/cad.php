<?php
    include "../geralDAO.php";
    $notas = explode(",", $_POST["notas"]);
    // var_dump($notas);
    // var_dump($_POST);
    $id = getIdMax("avaliacao");

    $query = "insert into avaliacao values (" . $id . ",";
    $query .= "'" . $_POST["idturma"] . "', ";
    $query .= "'" . $_POST["nome"] . "', ";
    $query .= "'" . $_POST["data"] . "', ";
    $query .= "'" . $_POST["peso"] . "', ";
    $query .= "'" . $_POST["obs"] . "') ";
    echo $query;

    inserir($query);
    foreach ($notas as $i)
    {
        $query = "insert into nota values (" . getIdMax("nota");
        $query .= "," . explode(";", $i)[0];
        $query .= ", $id" ;
        $query .= "," . explode(";", $i)[1];
        $query .= ")";
        echo $query;
        inserir($query);
    }
    header("Location: ../../paginas/avalList.php?" . $_POST["idturma"]);