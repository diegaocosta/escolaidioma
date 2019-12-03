<?php
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "select matricula.id as id, curso.nome as curso, aluno.nome as aluno, if(cursopag = 0, 'Devendo', 'Pago') as cursopag, if(matepag = 0, 'Devendo', 'Pago') as matepag from matricula, aluno, turma, curso where matricula.idaluno = aluno.id and matricula.idturma = turma.id and turma.idcurso = curso.id";
    //    echo $query;
    $result = extrair($query);	
    $t = "";	
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= "{";
        $t .= '"id":"' . $row["id"] . '",';
        $t .= '"aluno":"' . $row["aluno"] . '",';
        $t .= '"cursopag":"' . $row["cursopag"] . '",';
        $t .= '"curso":"' . $row["curso"] . '",';
        $t .= '"matepag":"' . $row["matepag"] . '"';
        $t .= "}";
    }
    echo "[$t]";