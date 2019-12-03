<?php
    $id = explode("?", $_SERVER["REQUEST_URI"])[1];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "select matecurso.id as idmatecurso, nome, valor, autor, idmaterial as id from matecurso, material where idcurso = $id and material.id = idmaterial";
    $result = extrair($query);	
    // echo $query;
    $t = "";	
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= "{";
        $t .= '"id":"' . $row["id"] . '",';
        $t .= '"idmatecurso":"' . $row["idmatecurso"] . '",';
        $t .= '"nome":"' . $row["nome"] . '",';
        $t .= '"valor":"' . $row["valor"] . '",';
        $t .= '"autor":"' . $row["autor"] . '",';
        $t .= '"id":"' . $row["id"] . '"';
        $t .= "}";
    }
    echo "[$t]";