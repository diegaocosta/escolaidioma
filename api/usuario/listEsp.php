<?php
    $status = explode("?", $_SERVER["REQUEST_URI"])[1];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "select usuario.nome as nome, id from funcionario";
    if ($status < 2)
        $query .= " where status = $status";
    $result = extrair($query);	
    $t = ""; $t1 = "";	
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= "{";
        $t .= '"id":"' . $row["id"] . '",';
        $t .= '"nome":"' . $row["nome"] . '",';
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