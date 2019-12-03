<?php
    $l = explode("?", $_SERVER["REQUEST_URI"])[1];
    $l = explode("&", $l);
    $id = $l[0];
    $idcurso = $l[1];
    include "../geralDAO.php";
    // echo $id;
    // var_dump($_POST);
    $query = "select (select aluno.nome from aluno where aluno.id = idaluno) as nome, matricula.id from matricula where idturma = $id
        union 
        
        select aluno.nome as nome, matricula.id from matricula ,turma, aluno WHERE matricula.idturma = turma.id and idcurso = $idcurso and matricula.idaluno = aluno.id
        
        ";
    $result = extrair($query);	
    $t = "";	
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= "{";
        $t .= '"id":"' . $row["id"] . '",';
        $t .= '"nome":"' . $row["nome"] . '"';
        $t .= "}";
    }
    echo "[$t]";