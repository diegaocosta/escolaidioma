<?php
    $status = explode("?", $_SERVER["REQUEST_URI"])[1];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "select nome, id, tipo, status from usuario where tipo != 0 ";
    if ($status < 2)
        $query .= " and status = $status";
    $result = extrair($query);	
    $t = ""; $t1 = "";	
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= "{";
        $t .= '"id":"' . $row["id"] . '",';
        $t .= '"nome":"' . $row["nome"] . '",';
        $t .= '"status":"' . $row["status"] . '",';
        $t .= '"cargo":"';
        switch (intval($row["tipo"]))
        {
            case 1: $t1 = "Professor"; break;
            case 2: $t1 = "Secretaria"; break;
        }
        $t .= $t1 . '"';
        $t .= "}";
    }
    echo "[$t]";