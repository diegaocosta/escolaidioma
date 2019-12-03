<?php
    $l = explode("?", $_SERVER["REQUEST_URI"])[1];
    $l = explode("&", $l);
    $aluno = $l[0];

    include "../geralDAO.php";
    // echo $id;
    // var_dump($_POST);
    $query = "select date_format(data,'%d/%m/%Y') as data,valor,desconto,tipo from pagamento where id = $l[0]";
    $result = extrair($query);	
    $t = "";	
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= "{";
        $t .= '"data":"' . $row["data"] . '",';
        $t .= '"valor":"R$ ' . str_replace(".",",", $row["valor"]) . '",';
        if ($row["tipo"] == 0)
            $t .= '"desconto":"R$ ' . $row["desconto"] . '"';
        else
            $t .= '"desconto":"' . $row["desconto"] . '%"';            
        $t .= "}";
    }
    echo "[$t]";