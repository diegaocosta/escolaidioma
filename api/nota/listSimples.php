<?php
    $id = explode("?", $_SERVER["REQUEST_URI"])[1];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "select id, (select nome from aluno, matricula where aluno.id = matricula.idaluno and idmatricula = matricula.id) as mat, nota from nota where idavaliacao = $id";
    $result = extrair($query);	
    $t = "";	
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= "{";
        $t .= '"id":"' . $row["id"] . '",';
        $t .= '"nome":"' . $row["mat"] . '",';
        $t .= '"nota":"' . $row["nota"] . '"';
        $t .= "}";
    }
    echo "[$t]";