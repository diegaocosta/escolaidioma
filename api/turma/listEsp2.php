<?php
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "select id, nome from (SELECT turma.id as id, turma.nome as nome, (select count(matricula.id)  from matricula  where idturma = turma.id) as total from turma, matricula  group by turma.id) as t1 where total > 0";
    //    echo $query;
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
