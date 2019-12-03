<?php
    $id = explode("?", $_SERVER["REQUEST_URI"])[1];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "SELECT idaval from nota, avaliacao where nota.idaval = avaliacao.id and avaliacao.idturma = $id
    group by idaval";
    $result = extrair($query);	
    $t = "";	
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= "{";
        $t .= '"id":"' . $row["idaval"] . '"';
        $t .= "}";
    }
    echo "[$t]";