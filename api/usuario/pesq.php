<?php
    $l = explode("?", $_SERVER["REQUEST_URI"])[1];
    $pesq = explode("&", $l)[0];
    $status = explode("&", $l)[1];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "select nome, id, tipo from usuario where tipo != 0 and nome like '%$pesq%' ";
    if ($status < 2)
        $query .= " and status = $status";
    // echo $query;
    $result = extrair($query);	
    $t = ""; $t1 = "";	
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= "{";
        $t .= '"id":"' . $row["id"] . '",';
        $t .= '"nome":"' . $row["nome"] . '",';
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