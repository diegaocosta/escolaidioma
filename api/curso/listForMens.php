<?php
    $id = explode("?", $_SERVER["REQUEST_URI"])[1];
    include "../geralDAO.php";
    // var_dump($_POST);
    $query = "SELECT *  from (
        SELECT *, datediff(str_to_date(concat(ano, ' ', semana, ' 0'), '%X %V %w'), str_to_date(concat(year(CURRENT_DATE), ' ', week(CURRENT_DATE), ' 0'), '%X %V %w')) as dif from  (
        
            SELECT 'curso' as tipo, aluno.nome as aluno, if ((totaldemes + turma.mesabertura) > 12, mod((totaldemes + turma.mesabertura), 12), (totaldemes + turma.mesabertura)) as semana, if ((totaldemes + turma.mesabertura) > 12, year(CURRENT_DATE) + 1, year(CURRENT_DATE)) as ano, aluno.id as id, concat('Curso de ',curso.nome) as 'desc', curso.nome as curso, curso.valor as valor from aluno, matricula, turma, curso where aluno.id = matricula.idaluno and matricula.idturma = turma.id and turma.idcurso = curso.id
        
            -- UNION
        
            -- SELECT 'material' as tipo, aluno.nome as aluno, if (totaldesem + turma.semabertura > 52, mod(totaldesem + turma.semabertura, 52), totaldesem + turma.semabertura) as semana, if (totaldesem + turma.semabertura > 52, year(CURRENT_DATE) + 1, year(CURRENT_DATE)) as ano, aluno.id as id, concat('Material: ',curso.nome) as 'desc', curso.nome as curso, material.valor as valor from aluno, matricula, turma, curso, matecurso, material where aluno.id = matricula.idaluno and matricula.idturma = turma.id and turma.idcurso = curso.id and matecurso.idcurso = curso.id and material.id = matecurso.idmaterial
        
        
                ) as t1 where id = $id order by aluno, curso, tipo) as t2 where dif > 0";
    $result = extrair($query);	
    $t = "";	
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= "{";
        $t .= '"nome":"' . $row["desc"] . '",';
        $t .= '"valor":"' . $row["valor"] . '"';
        $t .= "}";
    }
    echo "[$t]";