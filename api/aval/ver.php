<?php
    $id = explode("?", $_SERVER["REQUEST_URI"])[1];
    include "../geralDAO.php";
    // var_dump($_POST);
    $colunas = explode(",","nome,turma,data,obs");
    $query = "select nome,(select nome from turma where id = idturma) as turma, data, obs from avaliacao where id = $id";
    $result = extrair($query);	
    $t = "";	
    while($row = $result->fetch_assoc())
    {
        $t2 = "";
        if ($t != "") $t .= ",";
        $t .= "{";
        foreach($colunas as $i)
        {
            if ($t2 != "") $t2 .= ",";
            $t2 .= '"' . $i . '":"' . $row[$i] . '"';
        }
        $t .= $t2;
        $t .= "}";
    }
    echo "[$t]";