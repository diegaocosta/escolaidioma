<?php
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "select id, nome, valor, data from receita order by data";
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