<?php
    $turma = explode("?", $_SERVER["REQUEST_URI"])[1];
    $lista = array();
    include "../geralDAO.php";
    // var_dump($_POST);
    // $query = "select * from (SELECT aluno.nome as aluno, peso, nota.nota, avaliacao.nome as aval, avaliacao.id as tipo from aluno, matricula, avaliacao, nota where aluno.id = matricula.idaluno and matricula.id = nota.idmatricula and nota.idaval = avaliacao.id and matricula.idturma = $turma

    // UNION
    
    // SELECT aluno.nome as aluno, '' as peso, sum(nota.nota * peso * .01) as nota, 'media' as aval, 0 as tipo from aluno, matricula, avaliacao, nota where aluno.id = matricula.idaluno and matricula.id = nota.idmatricula and nota.idaval = avaliacao.id and matricula.idturma = $turma GROUP by  aluno) as t1 order by  aval , aluno";
    //    echo $query;

    $query = "
    SELECT * from (
        SELECT aluno.nome as aluno, nota, idaval from matricula, avaliacao, nota, aluno where matricula.id = nota.idmat and aluno.id = matricula.idaluno and matricula.idturma = $turma and nota.idaval = avaliacao.id
        
        UNION    
            
        SELECT aluno.nome as aluno, sum(nota * peso * .01) as nota, 0 as idaval from matricula, avaliacao, nota, aluno where matricula.id = nota.idmat and aluno.id = matricula.idaluno and matricula.idturma = $turma and nota.idaval = avaliacao.id group by aluno.nome) as t1 order by aluno, idaval
    ";

    $result = extrair($query);	
    $t = "";	
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= '{"aluno":"' . $row["aluno"] . '",';
        $t .= '"nota":"' . str_replace('.',',',$row["nota"]) . '",';
        $t .= '"idaval":"' . $row["idaval"] . '"}';
    }
    echo "[$t]";