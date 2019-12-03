<?php
    $l = explode("?", $_SERVER["REQUEST_URI"])[1];
    $d = explode("&", $l)[0];
    $turma = explode("&", $l)[1];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "select count(id) as resp from avaliacao where data like '$d' and idturma = $turma";
    $result = extrair($query);	
    $t = "";
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= "{";
        $t .= '"resp":"' . $row["resp"] . '"';
        $t .= "}";
    }
    echo "[$t]";