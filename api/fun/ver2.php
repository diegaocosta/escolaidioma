<?php
    $nome = explode("?", $_SERVER["REQUEST_URI"])[1];
    include "../geralDAO.php";
    // var_dump($_POST);
    $colunas = lerColunas('funcionario');
    $query = "select count(funcionario.id) as resp from funcionario, usuario where funcionario.id = usuario.idfun and funcionario.nome like '$nome' ";
    $result = extrair($query);	
    while($row = $result->fetch_assoc())
    {
        if ($row["resp"] == 0)
        {
            $query = "select id, nome, cargo from funcionario where nome like '$nome'";
            $result = extrair($query);	
            $t = "";	
            while($row = $result->fetch_assoc())
            {        
                $t .= "{";
                $t .= '"cargo":"' . $row["cargo"] . '",';
                $t .= '"id":"' . $row["id"] . '",';
                $t .= '"nome":"' . $row["nome"] . '"';
                $t .= "}";
            }
        }
        else
            $t = '{"cargo":"0","nome":"0"}';
    }
    echo "[$t]";