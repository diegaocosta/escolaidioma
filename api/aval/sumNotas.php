<?php
    $l = explode("?", $_SERVER["REQUEST_URI"])[1];
    $l = explode("&", $l);
    $idturma = $l[0];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "select sum(peso) as peso from avaliacao where idturma = $idturma";
    $result = extrair($query);	
    $t = "";
    while($row = $result->fetch_assoc())
    {
        $t .= "{";
        $t .= '"resp":"' . $row["peso"] . '"';
        $t .= "}";
    }
    echo "[$t]";