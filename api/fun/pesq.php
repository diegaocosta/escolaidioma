<?php
    $l = explode("?", $_SERVER["REQUEST_URI"])[1];
    $tipo = explode("&", $l)[1];
    $pesq = explode("&", $l)[0];
    $status = explode("&", $l)[2];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "select id, nome, telcel, cargo, status from funcionario";
    switch (intval($tipo))
    {
        case 0: $query .= " where nome like '%$pesq%'"; break;
        case 1: $query .= " where cargo like '%$pesq%'"; break;
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
            $t .= '"status":"' . $row["status"] . '",';
            $t .= '"cargo":"';
            switch (intval($row["cargo"]))
            {
                case 1: $t1 = "Professor"; break;
                case 2: $t1 = "Secretaria"; break;
            }
            $t .= $t1 . '",';
            $t .= '"telcel":"' . $row["telcel"] . '"';
            $t .= "}";
    }
    echo "[$t]";