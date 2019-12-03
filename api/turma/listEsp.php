<?php
    $l = explode("?", $_SERVER["REQUEST_URI"])[1];
    $user = explode("&", $l)[0];
    $status = explode("&", $l)[1];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "select turma.id as id, turma.nome as turma, semana, curso.nome as curso, funcionario.nome as professor from curso, funcionario, turma where turma.idfun = funcionario.id and turma.idcurso = curso.id and cargo = 2 and turma.idfun = (select idfun from usuario where nome like '$user') ";
    if ($status < 2)
        $query .= " and turma.status = $status";
    //    echo $query;
    $result = extrair($query);	
    $t = ""; 	
    while($row = $result->fetch_assoc())
    {
        $t1 = "";
        for ($i=0; $i < 5; $i++) 
        {
            if ($row["semana"][$i] == 1)
            {
                if ($t1 != "") $t1 .= "-";
                $t1 .= dias($i);
            }
        }

        if ($t != "") $t .= ",";
        $t .= "{";
        $t .= '"id":"' . $row["id"] . '",';
        $t .= '"turma":"' . $row["turma"] . '",';
        $t .= '"professor":"' . $row["professor"] . '",';
        $t .= '"semana":"' . $t1 . '",';
        $t .= '"curso":"' . $row["curso"] . '"';
        $t .= "}";
    }
    echo "[$t]";


    function dias($dia)
    {
        return explode(",", "Seg,Ter,Qua,Qui,Sex")[$dia];
    }