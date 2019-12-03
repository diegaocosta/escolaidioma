<?php
    $status = explode("?", $_SERVER["REQUEST_URI"])[1];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "select id, nome, valor, autor, comprado, total, totalvendido from material";
    if ($status < 2)
        $query .= " where status = $status";
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