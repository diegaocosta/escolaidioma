<?php
    $l = explode("?", $_SERVER["REQUEST_URI"])[1];
    $l = explode("&", $l);

    include "../geralDAO.php";
    // echo $id;
    // var_dump($_POST);
    $query = "select mes from mensalidade where idaluno = $l[0] and ano = $l[1]";
    $result = extrair($query);	
    $t = "";	
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= "{";
        $t .= '"mes":"' . $row["mes"] . '"';
        $t .= "}";
    }
    echo "[$t]";