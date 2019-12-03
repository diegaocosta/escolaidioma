<?php
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "SELECT aluno.nome, aluno.id  FROM aluno WHERE aluno.id not IN (select idaluno from mensalidade, ficha where ficha.id = mensalidade.idficha and ano = (" . date("Y") . ") and mes = " . date("m") . "-1)";
    $result = extrair($query);	
    $t = "";	
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= "{";
        $t .= '"id":"' . $row["id"] . '",';
        $t .= '"nome":"' . $row["nome"] . '"';
        $t .= "}";
    }
    echo "[$t]";