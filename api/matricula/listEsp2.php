<?php
    $id = explode("?", $_SERVER["REQUEST_URI"])[1];
    include "../geralDAO.php";
    // echo $id;
    // var_dump($_POST);
    $query = "select (select aluno.nome from aluno where aluno.id = idaluno) as nome, matricula.id, freqs from matricula where idturma = $id";
    $result = extrair($query);	
    $t = "";	
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= "{";
        $t .= '"id":"' . $row["id"] . '",';
        $t .= '"freqs":"' . $row["freqs"] . '",';
        $t .= '"nome":"' . $row["nome"] . '"';
        $t .= "}";
    }
    echo "[$t]";