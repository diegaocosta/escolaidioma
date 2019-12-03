<?php
    $l = explode("?", $_SERVER["REQUEST_URI"])[1];
    $l = explode("&", $l);
    $tipo = intval($l[0]);
    $d1 = $l[1];
    $d2 = $l[2];
    include "../geralDAO.php";
    // var_dump($_POST);
    switch ($tipo)
    {
        case 0: $grupo = " year(data), month(data), day(data) asc"; break;
        case 1: $grupo = " year(data), month(data) "; break;
        case 2: $grupo = " year(data) "; break;
    }
    switch ($tipo)
    {
        case 0: $order = " year(data), month(data), DAYOFMONTH(data), tipo "; break;
        case 1: $order = " year(data), month(data), tipo, day(data) "; break;
        case 2: $order = " year(data), month(data), tipo "; break;
    }

    $datareturn = "";
    switch($tipo)
    {
        case 0: $datareturn = " data "; break;
        case 1: $datareturn = " concat(year(data),'-',lpad(month(data),2,0),'-', day(last_day(data))) as data "; break;
        case 2: $datareturn = " concat(year(data),'-12-31') "; break;
    }

    $dt = "";
    if ($d1 != "" && $d2 == "")
        $dt = " where data >= '$d1' ";
    if ($d1 == "" && $d2 != "")
        $dt = " where data <= '$d2' ";
    if ($d1 != "" && $d2 != "")
        $dt = " where data between '$d1' and '$d2' ";
        
    $query = "";
    
    if ($l[0] != 2)
    {

        $query .= "select * from (    
            select 0 as tipo, data as nome, 0 as entrada, 0 as saida, data, 0 as total from (
                SELECT nome, valor as entrada, 0 as saida, data FROM `pagamento`
                union
                SELECT nome, valor as entrada, 0 as saida, data FROM `receita`
                UNION
                SELECT nome, 0 as entrada, (valor * -1) as valor, data FROM `despesa`
               ) as t3  $dt GROUP by $grupo
    
            union ";
    

        $query .= "select 1 as tipo, nome, entrada, saida, data, (entrada + saida) as total from (
                SELECT nome, valor as entrada, 0 as saida, data FROM `pagamento`
                union
                SELECT nome, valor as entrada, 0 as saida, data FROM `receita`
                UNION
                SELECT nome, 0 as entrada, (valor * -1) as valor, data FROM `despesa`
               ) as t1 $dt
           
            UNION ";

        $query .= "select 2 as tipo, 'total' as nome, sum(entrada) as entrada, sum(saida) as saida, $datareturn, (sum(entrada) + sum(saida)) as total from (
            SELECT nome, valor as entrada, 0 as saida, data FROM `pagamento`
            union
            SELECT nome, valor as entrada, 0 as saida, data FROM `receita`
            UNION
            SELECT nome, 0 as entrada, (valor * -1) as valor, data FROM `despesa`
           ) as t2  $dt GROUP by $grupo
            union ";
    }
    else
    {
        $query .= "select * from (    
            select 0 as tipo, concat(year(data),'-01-01') as nome, 0 as entrada, 0 as saida, concat(year(data),'-01-01') as data, 0 as total from (
                SELECT nome, valor as entrada, 0 as saida, data FROM `pagamento`
                union
                SELECT nome, valor as entrada, 0 as saida, data FROM `receita`
                UNION
                SELECT nome, 0 as entrada, (valor * -1) as valor, data FROM `despesa`
               ) as t3  $dt GROUP by $grupo
    
            union ";

        $query .= "select 1 as tipo, month(data) - 1, sum(entrada) as entrada, sum(saida) as saida, data, (sum(entrada) + sum(saida)) as total from (
            SELECT nome, valor as entrada, 0 as saida, data FROM `pagamento`
            union
            SELECT nome, valor as entrada, 0 as saida, data FROM `receita`
            UNION
            SELECT nome, 0 as entrada, (valor * -1) as valor, data FROM `despesa`
           ) as t2  $dt GROUP by year(data), month(data)
        union ";
        
        $query .= "select 2 as tipo, 'total' as nome, sum(entrada) as entrada, sum(saida) as saida, $datareturn, (sum(entrada) + sum(saida)) as total from (
            SELECT nome, valor as entrada, 0 as saida, data FROM `pagamento`
            union
            SELECT nome, valor as entrada, 0 as saida, data FROM `receita`
            UNION
            SELECT nome, 0 as entrada, (valor * -1) as valor, data FROM `despesa`
           ) as t2  $dt GROUP by $grupo
            union";
    }
    $query .= "                    
        select 3 as tipo, 'TOTAL' as nome, sum(entrada) as entrada, sum(saida) as saida, '2999-12-31' as data, (sum(entrada) + sum(saida)) as total from (
            SELECT nome, valor as entrada, 0 as saida, data FROM `pagamento`
            union
            SELECT nome, valor as entrada, 0 as saida, data FROM `receita`
            UNION
            SELECT nome, 0 as entrada, (valor * -1) as valor, data FROM `despesa`
           ) as t3  $dt 
                   
                   ) as t4 order by $order" ;
                //    echo $query;
    $result = extrair($query);	
    // echo $query
    $t = "";	
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= "{";
        $t .= '"nome":"' . $row["nome"] . '",';
        $t .= '"data":"' . $row["data"] . '",';
        $t .= '"tipo":"' . $row["tipo"] . '",';
        $t .= '"entrada":"R$ ' . str_replace(".", ",", $row["entrada"]) . '",';
        $t .= '"saida":"R$ ' . str_replace(".", ",", $row["saida"]) . '",';
        $t .= '"total":"R$ ' . str_replace(".", ",", $row["total"]) . '"';
        $t .= "}";
    }
    echo "[$t]";