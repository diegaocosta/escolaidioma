<?php
    $l = explode("?", $_SERVER["REQUEST_URI"])[1];
    $status = explode("&", $l)[0];
    $turma = explode("&", $l)[1];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "select id, data, obs, nome from aula where idturma = $turma ";
    if ($status < 2)
        $query .= " and status = $status";
    //    echo $query;

    $result = extrair($query);	
    $t = "";	
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