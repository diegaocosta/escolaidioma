<?php
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "insert into aluno values (" . getIdMax("aluno") . ",";
    foreach ($_POST as $i)
        $query .= "'$i', ";
    $query .= 1 . ")";
    echo $query;
    inserir($query);
    header("Location: ../../paginas/alunoList.php");