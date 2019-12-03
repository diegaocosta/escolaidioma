<?php
    include "../geralDAO.php";
    $l = explode("?", $_SERVER["REQUEST_URI"])[1];
    $nome = explode("&", $l)[0];
    $senha = base64_decode(explode("&", $l)[1]);

    $query = "select count(id) as id from usuario where nome like '$nome'";
    $result = extrair($query);		
    while($row = $result->fetch_assoc())
    {
        if ($row["id"] == 1)
        {
            $query = "select count(id) as id from usuario where senha like sha1(concat(salt, md5('$senha'), salt))";
            $result = extrair($query);		
            while($row = $result->fetch_assoc())
                echo '[{"r":"' . (($row["id"] == 1) ? "2" : "1"). '"}]';
        }
        else
            echo '[{"r":"0"}]';
    }