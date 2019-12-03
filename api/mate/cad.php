<?php
    include "../geralDAO.php";
    // var_dump($_POST);
    $_POST["valor"] = str_replace(",", ".", $_POST["valor"]);

    $query = "insert into material values (" . getIdMax("material") . ",";
    foreach ($_POST as $j => $i)
    {
        if ($j == "total")
            $query .= "'$i', 0,";
        else
        $query .= "'$i', ";
    }
        $query .= "1)";
    echo $query;
    inserir($query);
    header("Location: ../../paginas/mateList.php");