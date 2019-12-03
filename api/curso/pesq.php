<?php
    $l = explode("?", $_SERVER["REQUEST_URI"])[1];
    $pesq = explode("&", $l)[0];
    $status = explode("&", $l)[1];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "select id, nome, totaldemes,valor, status from curso where nome like '%$pesq%'";
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
        $t .= '"status":"' . $row["status"] . '",';
        $t .= '"total":"' . $row["totaldemes"] . '",';
        $t .= '"valor":"' . $row["valor"] . '"';
        $t .= "}";
    }
    echo "[$t]";