<?php
    $id = explode("?", $_SERVER["REQUEST_URI"])[1];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "select (select curso.nome from curso where curso.id = idcurso) as idcurso, (select funcionario.nome from funcionario where funcionario.id = idfun) as idfun, turma.nome as nome from turma where turma.id = $id";
    $result = extrair($query);	
    $t = "";	
    while($row = $result->fetch_assoc())
    {
        $t .= "{";
        $t .= '"nome":"' . $row["nome"] . '",'; 
        $t .= '"idcurso":"' . $row["idcurso"] . '",'; 
        $t .= '"idfun":"' . $row["idfun"] . '"'; 
        $t .= "}";
    }
    echo "[$t]";