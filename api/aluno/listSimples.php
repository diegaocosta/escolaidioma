<?php
    $status = explode("?", $_SERVER["REQUEST_URI"])[1];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "select id, nome, telcel, nomeresp, telresp, status from aluno where status != 3 ";
    if ($status < 2)
        $query .= " and status = $status";
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