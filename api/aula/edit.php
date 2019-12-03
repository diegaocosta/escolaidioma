<?php
    include "../geralDAO.php";
    $freq = explode(";", array_splice($_POST,1,1)["freq"]);
    var_dump($freq);
    var_dump($_POST);
    // $id = getIdMax("aula");
    $query = "update aula set obs = '" . $_POST["obs"] . "'";
    echo $query;    
    inserir($query);
    foreach ($freq as $i)
    {
        $query = "update frequencia set falta = " . explode(",", $i)[1] . " where id = " . explode(",", $i)[0];
        echo $query;
        inserir($query);
    }
    header("Location: ../../paginas/aulaList.php?" . $_POST["idturma"]);