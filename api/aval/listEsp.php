<?php
    $turma = explode("?", $_SERVER["REQUEST_URI"])[1];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "select nome, peso, id from avaliacao where idturma = $turma ";
    //    echo $query;

    $result = extrair($query);	
    $t = "";	
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= "{";
        $t .= '"nome":"' . $row["nome"] . '",';
        $t .= '"id":"' . $row["id"] . '",';
        $t .= '"peso":"' . $row["peso"] . '"';
        $t .= "}";
    }
    echo "[$t]";