<?php
    include "../geralDAO.php";
    $user = explode("?", $_SERVER["REQUEST_URI"])[1];
    session_start();
    $_SESSION["login"] = $user;
    $query = "select id, tipo from usuario where nome like '$user'";
    $result = extrair($query);	
    $tipo;
    while($row = $result->fetch_assoc())
    {
        $_SESSION["id"] = $row["id"];
        $_SESSION["cargo"] = $row["tipo"];
        $tipo = intval($row["tipo"]);
    }
    echo $tipo;
    switch($tipo)
    {
        case 0: header("Location: ../../paginas/alunoList.php"); break;
        case 1: header("Location: ../../paginas/alunoList.php"); break;
        case 2: header("Location: ../../paginas/turmaProList.php"); break;
    }

    