<?php
    $id = explode("?", $_SERVER["REQUEST_URI"])[1];
    include "../geralDAO.php";
    var_dump($_POST);
    $query = "update aluno set status = 3 where id = $id";
    inserir($query);
    $query = "insert into evasao values (" . getIdMax("evasao") . ", $id, '" . $_POST["motivos"] . "', '" . $_POST["outros"] . "','" . date("Y-m-d") . "')";
    echo $query;
    inserir($query);
    header("Location: ../../paginas/alunoList.php");
