<?php
    $id = explode("?", $_SERVER["REQUEST_URI"])[1];
    include "../geralDAO.php";
    $mate = explode(",",$_POST["matelist"]);
    echo "novos <br>";
    var_dump($mate);
    // array_splice($_POST, 6, 1);
    var_dump($_POST);
    $query = "update curso set ";
    $query .= "nome = '" . $_POST["nome"] . "',";
    $query .= "totaldemes = " . $_POST["totaldemes"] . ",";
    $query .= "status = " . $_POST["status"] . ",";
    $query .= "tipomulta = '" . $_POST["tipomulta"] . "',";
    $query .= "multa = " .str_replace(",", ".", $_POST["multa"]) . ",";
    $query .= "valor = " .str_replace(",", ".", $_POST["valor"]) . ",";
    $query .= "obs = '" . $_POST["obs"] . "'";
    $query .= " where id = $id";
    echo $query;
    inserir($query);

    $velhos = array();

    $query = "select idmaterial as id from matecurso where idcurso = $id";    
    $result = extrair($query);	
    while($row = $result->fetch_assoc())
        array_push($velhos, $row["id"]);
        echo "<br>";
        echo "db <br>";
        var_dump($velhos);
        echo "<br>";
    
    if ($_POST["matelist"] != "")
    {
        foreach ($mate as $i)
            if (!in_array($i, $velhos))
            {
                $query = "insert into matecurso values (" . getIdMax("matecurso") . ", $i, $id)";
                echo "<br>";
                echo $query;
                inserir($query);
            }
        foreach ($velhos as $i)
            if (!in_array($i, $mate))
            {
                $query = "delete from matecurso where idmaterial = $i and idcurso = $id";
                echo "<br>";
                echo $query;
                inserir($query);
            }
        
    }





    header("Location: ../../paginas/cursoList.php");