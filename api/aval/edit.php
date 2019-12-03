<?php
    include "../geralDAO.php";
    $notas = explode(",", $_POST["notas"]);
    var_dump($notas);
    // var_dump($_POST);
    // $id = getIdMax("aula");
    $query = "update avaliacao set obs = '" . $_POST["obs"] . "',";
    $query .= "nome = '" . $_POST["nome"] . "' where id = " . $_POST["idaval"];
    echo $query;    
    inserir($query);
    foreach ($notas as $i)
    {
        $query = "update nota set nota = " . explode(";", $i)[1] . " where id = " . explode(";", $i)[0];
        echo $query;
        inserir($query);
    }
    header("Location: ../../paginas/avalList.php?" . $_POST["idturma"]);