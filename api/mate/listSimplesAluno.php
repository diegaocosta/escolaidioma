<?php
    $status = explode("?", $_SERVER["REQUEST_URI"])[1];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "SELECT material.nome as 'desc', curso.nome as curso, material.valor as valor from aluno, matricula, turma, curso, matecurso, material where aluno.id = matricula.idaluno and matricula.idturma = turma.id and turma.idcurso = curso.id and matecurso.idcurso = curso.id and material.id = matecurso.idmaterial and aluno.id = 1";
    $result = extrair($query);	
    $t = "";	
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= "{";
        $t .= '"desc":"' . $row["desc"] . '",';
        $t .= '"curso":"' . $row["curso"] . '",';
        $t .= '"valor":"' . $row["valor"] . '"';
        $t .= "}";
    }
    echo "[$t]";