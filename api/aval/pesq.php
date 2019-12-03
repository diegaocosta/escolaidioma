<?php
    $l = explode("?", $_SERVER["REQUEST_URI"])[1];
    $d1 = explode("&", $l)[0];
    $d2 = explode("&", $l)[1];
    $status = explode("&", $l)[2];
    $turma = explode("&", $l)[3];
    include "../geralDAO.php";
    // echo $d1;
    // echo $d2;

    $query = "select id, data, obs, nome from avaliacao where idturma = $turma ";
    if ($d1 == "" && $d2 != "")
        $query .= " and data <= '$d2'";
    if ($d2 == "" && $d1 != "")
        $query .= " and data >= '$d1'";
    if ($d2 != "" && $d1 != "")
        $query .= " and data between '$d1' and '$d2'";
    // echo $query;
        $result = extrair($query);	
        $t = "";	
        $c = 0;
        while($row = $result->fetch_assoc())
        {
            if ($t != "") $t .= ",";
            $t .= "{";
            $t .= '"id":"' . $row["id"] . '",';
            $t .= '"nome":"' . $row["nome"] . '",';
            $t .= '"data":"' . $row["data"] . '",';
            $t .= '"obs":"' . $row["obs"] . '"';
            $t .= "}";
        }
        echo "[$t]";