<?php
    $l = explode("?", $_SERVER["REQUEST_URI"])[1];
    $l = explode("&", $l);
    $pesq = $l[0];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "select nome, data, motivos, outros from evasao, aluno where idaluno = aluno.id  ";    
    if ($pesq  != "")
        $query .= " and  nome like '%$pesq%'";
        // echo $query;
    $result = extrair($query);	
    $t = "";	
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= "{";
        $t .= '"nome":"' . $row["nome"] . '",';
        $t .= '"data":"' . $row["data"] . '",';
        $t .= '"motivos":"' . $row["motivos"] . '",';
        $total = 0;
        for ($i=0; $i < 6; $i++)
            if ($row["motivos"][$i] == 1)
                $total++;
        $t .= '"total":"' . $total . '",';
        $t .= '"outros":"' . $row["outros"] . '"';
        $t .= "}";
    }
    echo "[$t]";