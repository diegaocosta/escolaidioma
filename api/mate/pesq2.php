<?php
    $l = explode("?", $_SERVER["REQUEST_URI"])[1];
    $tipo = explode("&", $l)[1];
    $pesq = explode("&", $l)[0];
    $status = explode("&", $l)[2];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "select  id, nome, autor, valor, comprado, total, totalvendido from material";
    switch (intval($tipo))
    {
        case 0: $query .= " where nome like '%$pesq%'"; break;
        case 1: $query .= " where autor like '%$pesq%'"; break;
    }
    if ($status < 2)
        $query .= " and status = $status";
    // echo $query;
    $result = extrair($query);	
    $t = "";	
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= "{";
            $t .= '"id":"' . $row["id"] . '",';
            $t .= '"nome":"' . $row["nome"] . '",';
            $t .= '"autor":"' . $row["autor"] . '",';
            $t .= '"vendido":"' . $row["totalvendido"] . '",';
            $t .= '"comprado":"' . $row["comprado"] . '",';
            $t .= '"valor":"' . $row["valor"] . '",';
            $t .= '"total":"' . $row["total"] . '"';
        $t .= "}";
    }
    echo "[$t]";