<?php
    include "../geralDAO.php";
    $l = explode("?", $_SERVER["REQUEST_URI"])[1];
    $l = explode("&", $l);
    // var_dump($l);

    $query = "select count(id) as id from funcionario where cpf like '$l[0]'";
    // echo $query;
    $result = extrair($query);		
    while($row = $result->fetch_assoc())
    {
        if ($row["id"] == 1)
        {
            $query = "select count(usuario.id) as id from funcionario, usuario where cpf like '$l[0]' and funcionario.id = usuario.idfun";
            $result = extrair($query);		
            while($row = $result->fetch_assoc())
            {
                if ($row["id"] == 0)
                {
                    if ($l[2] != $l[3])
                        echo '[{"r":"1"}]';
                    else
                        echo '[{"r":"2"}]';
                }
                else
                    echo '[{"r":"3"}]';
            }
        }
        else
            echo '[{"r":"0"}]';
    }