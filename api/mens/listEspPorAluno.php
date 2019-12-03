<?php
    $l = explode("?", $_SERVER["REQUEST_URI"])[1];
    $l = explode("&", $l);

    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "SELECT mensalidade.id as id, valororiginal as total, faltando, mes, ano , if(mensalidade.status = 0, 'Devendo', 'Pago') as tipo  from mensalidade, aluno where aluno.id = mensalidade.idaluno and mensalidade.idaluno = $l[0]";
    //    echo $query;
    $result = extrair($query);	
    $t = "";	
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= "{";
        $t .= '"id":"' . $row["id"] . '",';
        $t .= '"tipo":"' . $row["tipo"] . '",';
        $t .= '"ref":"' . getMesNome(intval($row["mes"]) - 1) . '/' . $row["ano"] . '",';
        $t .= '"total":"' . str_replace(".", ",",$row["total"]) . '",';
        $t .= '"faltando":"' . str_replace(".", ",",$row["faltando"]) . '"';
        $t .= "}";
    }
    echo "[$t]";