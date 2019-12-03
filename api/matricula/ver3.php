<?php
    $aluno = explode("?", $_SERVER["REQUEST_URI"])[1];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "select matricula.idaluno as idaluno, matricula.id as id, matepag, turma.nome as turma, (month(matricula.data) - 1) as mesi, totaldemes as total, funcionario.nome as prof, meses, turma.idcurso as idcurso, curso.nome as curso, dtabertura as abertura, matricula.data as ingresso from curso, turma, matricula, aluno, funcionario where turma.idcurso = curso.id and matricula.idturma = turma.id and matricula.id = $aluno and matricula.idaluno = aluno.id and turma.idfun = funcionario.id group by curso.nome";
    //    echo $query;
    $result = extrair($query);	
    $t = "";	
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= "{";
        $t .= '"id":"' . $row["id"] . '",';
        $t .= '"turma":"' . $row["turma"] . '",';
        $t .= '"idaluno":"' . $row["idaluno"] . '",';
        $t .= '"meses":"' . $row["meses"] . '",';
        $t .= '"idcurso":"' . $row["idcurso"] . '",';
        $t .= '"matepag":"' . $row["matepag"] . '",';
        $t .= '"total":"' . $row["total"] . '",';
        $t .= '"mesi":"' . $row["mesi"] . '",';
        $t .= '"prof":"' . $row["prof"] . '",';
        $t .= '"abertura":"' . $row["abertura"] . '",';
        $t .= '"ingresso":"' . $row["ingresso"] . '",';
        $t .= '"curso":"' . $row["curso"] . '"';
        $t .= "}";
    }
    echo "[$t]";