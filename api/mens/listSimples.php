<?php
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "SELECT mensalidade.id as id, aluno.nome as aluno, concat('R$ ',valor,'/R$ ',valor) as total, concat(mes,'/',ano) as ref, if(mensalidade.status = 0, 'Devendo', 'Pago') as tipo  from mensalidade, aluno where aluno.id = mensalidade.idaluno";
    //    echo $query;
    $result = extrair($query);	
    $t = "";	
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= "{";
        $t .= '"id":"' . $row["id"] . '",';
        $t .= '"aluno":"' . $row["aluno"] . '",';
        $t .= '"tipo":"' . $row["tipo"] . '",';
        $t .= '"ref":"' . $row["ref"] . '",';
        $t .= '"total":"' . str_replace(".", ",",$row["total"]) . '"';
        $t .= "}";
    }
    echo "[$t]";