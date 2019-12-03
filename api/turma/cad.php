<?php
    include "../geralDAO.php";
    var_dump($_POST);
    $id = getIdMax("turma");
    $total = 0;
    for ($i=0; $i < strlen($_POST["semana"]); $i++) 
        if (intval($_POST["semana"][$i]) == 1)
            $total++;
    $query = "insert into turma values (" . $id;
    foreach ($_POST as $i=>$j)
    {
        echo "$i<br>";
        if ($query != "") $query .= ", ";
        if ($i == "semana")
            $query .= "'$j', ceiling((week('" . $_POST["dtfechamento"] . "') - week('" . $_POST["dtabertura"] . "')) * 0.$total) * 10";
        else
            $query .= "'$j'";
    }
    $query .= ",1)";
    echo $query;
    inserir($query);
    header("Location: ../../paginas/turmaList.php");