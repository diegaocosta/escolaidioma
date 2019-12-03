<?php
    include "../geralDAO.php";
    var_dump($_POST);
    foreach(explode(",", $_POST["hidden"]) as $i)
    {
        $q = "select month(dtabertura) as mesabertura, (week(dtfechamento) - week(dtabertura)) as dif, dtabertura, semana, totaldemes from turma, curso where turma.idcurso = curso.id  and turma.id = " . $_POST["id"];
        $result = extrair($q);	
        $t = ""; $t1 = ""; $total = 0;
        while($row = $result->fetch_assoc())
        {
            $dif = $row["dif"];
            for ($j = $row["mesabertura"]; $j < ((intval($row["mesabertura"]) + intval($row["totaldemes"])) - 1); $j++)
            {
                if ($t != "") $t .= ";";
                $t .= ($j % 12) . ",0";
            }            
            for ($k=0; $k < intval($dif); $k++)             
                for ($j=0; $j < 5; $j++) 
                    if ($row["semana"][$j] == 1)
                    {
                        if ($t1 != "") $t1 .= ";";
                        $t1 .= "0";
                        $total++;
                    }
        }
        $query = "insert into matricula values (" . getIdMax("matricula") . ", " . $_POST["id"] . ", $i,0,0, '" . date("Y-m-d") . "','$t','$t1')";
      //  echo $query . "<br>\n";
        inserir($query);
        // echo "$total<br>\n";
        // echo strlen($t1) . "<br>\n";
        // echo "$total<br>\n";
    }
     header("Location: ../../paginas/turmaList.php");