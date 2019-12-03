<?php
    include "../geralDAO.php";
    $salario = array_splice($_POST, count($_POST) - 2, 1);
    $obs = array_splice($_POST, count($_POST) - 1, 1);
    // var_dump($_POST);
    var_dump($salario);
    var_dump($obs);


    $query = "insert into funcionario values (" . getIdMax("funcionario") . ",";
    foreach ($_POST as $i)
        $query .= "'$i', ";
    $query .= str_replace(",",".",$salario["salario"]) . ", 1,'" . $obs["obs"] ."')";
    echo $query;
    inserir($query);
    header("Location: ../../paginas/funList.php");