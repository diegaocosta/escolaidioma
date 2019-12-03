<?php
    $l = explode("?", $_SERVER["REQUEST_URI"])[1];
    $d1 = explode("&", $l)[0];
    $d2 = explode("&", $l)[1];
    include "../geralDAO.php";
    // echo $d1;
    // echo $d2;

    $query = "select id, data, valor, nome from receita  ";
    if ($d1 == "" && $d2 != "")
        $query .= " where data <= '$d2'";
    if ($d2 == "" && $d1 != "")
        $query .= " where data >= '$d1'";
    if ($d2 != "" && $d1 != "")
        $query .= " where data between '$d1' and '$d2'";
    $result = extrair($query);	
    $t = "";	
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= "{";
            $t .= '"id":"' . $row["id"] . '",';
            $t .= '"nome":"' . $row["nome"] . '",';
            $t .= '"data":"' . $row["data"] . '",';
            $t .= '"valor":"' . $row["valor"] . '"';
        $t .= "}";
    }
    echo "[$t]";