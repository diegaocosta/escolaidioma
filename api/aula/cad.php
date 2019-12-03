<?php
    include "../geralDAO.php";
    $l = explode("?", $_SERVER["REQUEST_URI"])[1];
    $l = explode("&", $l);
    $id = $l[0];

    var_dump($id);
    var_dump($_POST);
    $mat = explode(";", $_POST["hidden"]);
    // var_dump($mat);

    foreach ($mat as $i)
    {
        
        $j = explode("/", $i);
        var_dump($j);
        $q = "select freqs from matricula where id = $j[0]";
        $result = extrair($q);	
        while($row = $result->fetch_assoc())
        {
            $t = "";
            $freqs = explode(";", $row["freqs"]);
            $freqs[$_POST["poshj"]] = $j[1];
            foreach ($freqs as $k)
            {
                if ($t != "") $t .= ";";
                $t .= $k;
            }
            $q = "update matricula set freqs = '$t' where id = $j[0]";
            echo $q;
            inserir($q);

        }

    }

    header("Location: ../../paginas/aulaList.php?$id");