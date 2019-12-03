<?php
    $l = explode("?", $_SERVER["REQUEST_URI"])[1];
    $tipo = explode("&", $l)[1];
    $pesq = explode("&", $l)[0];
    $status = explode("&", $l)[2];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "select id, nome, telcel, nomeresp, telresp, status from aluno where status != 3";
    switch (intval($tipo))
    {
        case 0: $query .= " and nome like '%$pesq%'"; break;
        case 1: $query .= " and nomeresp like '%$pesq%'"; break;
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
        $t .= '"status":"' . $row["status"] . '",';
        $t .= '"nome":"' . $row["nome"] . '",';
        $t .= '"nomeresp":"' . $row["nomeresp"] . '",';
        $t .= '"telresp":"' . $row["telresp"] . '"';
        $t .= "}";
    }
    echo "[$t]";