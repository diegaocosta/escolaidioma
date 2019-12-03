<?php
    include "../geralDAO.php";
    // echo $id;
    // var_dump($_POST);
    $query = "SELECT aluno.nome as aluno, aluno.id from aluno, mensalidade WHERE mensalidade.idaluno = aluno.id group by aluno.nome";
    $result = extrair($query);	
    $t = "";	
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= "{";
        $t .= '"aluno":"' . $row["aluno"] . '",';
        $t .= '"id":"' . $row["id"] . '"';
        $t .= "}";
    }
    echo "[$t]";