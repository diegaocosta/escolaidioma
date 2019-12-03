<?php
    $status = explode("?", $_SERVER["REQUEST_URI"])[1];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "select id, nome, telcel, cargo from funcionario";
    if ($status < 2)
        $query .= " where status = $status and cargo = 2";
    $result = extrair($query);	
    $t = "";	
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= "{";
        $t .= '"id":"' . $row["id"] . '",';
        $t .= '"nome":"' . $row["nome"] . '",';
        $t .= '"cargo":"' . $row["cargo"] . '",';
        $t .= '"telcel":"' . $row["telcel"] . '"';
        $t .= "}";
    }
    echo "[$t]";