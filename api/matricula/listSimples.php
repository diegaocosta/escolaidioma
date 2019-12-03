<?php
    $status = explode("?", $_SERVER["REQUEST_URI"])[1];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "select turma.id as id, turma.nome as turma, curso.nome as curso, funcionario.nome as professor from curso, funcionario, turma where turma.idfun = funcionario.id and turma.idcurso = curso.id and cargo = 1";
    if ($status < 2)
        $query .= " and turma.status = $status";
    //    echo $query;
    $result = extrair($query);	
    $t = "";	
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= "{";
        $t .= '"id":"' . $row["id"] . '",';
        $t .= '"turma":"' . $row["turma"] . '",';
        $t .= '"professor":"' . $row["professor"] . '",';
        $t .= '"curso":"' . $row["curso"] . '"';
        $t .= "}";
    }
    echo "[$t]";