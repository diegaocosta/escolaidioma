<?php
    $l = explode("?", $_SERVER["REQUEST_URI"])[1];
    $tipo = explode("&", $l)[1];
    $pesq = explode("&", $l)[0];
    $status = explode("&", $l)[2];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "select turma.id as id, turma.nome as turma, curso.nome as curso, funcionario.nome as professor from curso, funcionario, turma where turma.idfun = funcionario.id and turma.idcurso = curso.id and cargo = 1";
    switch (intval($tipo))
    {
        case 0: $query .= " and turma.nome like '%$pesq%'"; break;
        case 1: $query .= " and funcionario.nome like '%$pesq%'"; break;
        case 2: $query .= " and curso.nome like '%$pesq%'"; break;
    }
    if ($status < 2)
        $query .= " and turma.status = $status";
    // echo $query;
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