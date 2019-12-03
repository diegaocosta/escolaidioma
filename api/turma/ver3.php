<?php
    $id = explode("?", $_SERVER["REQUEST_URI"])[1];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "select (week(dtfechamento) - week(dtabertura)) as dif, dtabertura, semana from turma where id = $id";
    $result = extrair($query);	
    $t = ""; $t1 = "";	
    // echo $query;
    while($row = $result->fetch_assoc())
    {
        for ($i=0; $i < intval($row["dif"]); $i++)             
            for ($j=0; $j < 5; $j++) 
                if ($row["semana"][$j] == 1)
                {
                    if ($t1 != "") $t1 .= ",";
                    $t1 .= date('d/m', strtotime($row["dtabertura"] . "$i week +$j day"));
                }
        $t .= "{";
        $t .= '"datas":"' . $t1 . '"'; 
        $t .= "}";
    }
    echo "[$t]";