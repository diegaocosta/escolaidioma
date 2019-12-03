<?php
    $aluno = explode("?", $_SERVER["REQUEST_URI"])[1];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "select turma.nome as turma, funcionario.nome as prof, curso.nome as curso, dtabertura as abertura, matricula.data as ingresso from curso, turma, matricula, aluno, funcionario where turma.idcurso = curso.id and matricula.idturma = turma.id and matricula.idaluno = 1 and matricula.idaluno = aluno.id and turma.idfun = funcionario.id group by curso.nome";
    //    echo $query;
    $result = extrair($query);	
    $t = "";	
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= "{";
        $t .= '"turma":"' . $row["turma"] . '",';
        $t .= '"prof":"' . $row["prof"] . '",';
        $t .= '"abertura":"' . $row["abertura"] . '",';
        $t .= '"ingresso":"' . $row["ingresso"] . '",';
        $t .= '"curso":"' . $row["curso"] . '"';
        $t .= "}";
    }
    echo "[$t]";