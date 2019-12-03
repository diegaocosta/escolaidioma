<?php
    $l = explode("?", $_SERVER["REQUEST_URI"])[1];
    $nome = explode("&", $l)[0];
    $cpf = explode("&", $l)[1];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "select usuario.id as resp from usuario, funcionario where funcionario.id = usuario.idfun and cpf like '$cpf' and usuario.nome like '$nome'";
    $result = extrair($query);	
    $t = ""; $t1 = "";	
    // echo $query;
    // echo $result->num_rows;
    if ($result->num_rows > 0)
        while($row = $result->fetch_assoc())
        {
            // echo $row["resp"];
            if ($t != "") $t .= ",";
            $t .= "{";
            $t .= '"resp":"' . $row["resp"] . '"';
            $t .= "}";
        }
    else
        $t = '{"resp":"0"}';
    echo "[$t]";