<?php
    $l = explode("?", $_SERVER["REQUEST_URI"])[1];
    $l = explode("&", $l);
    $id = $l[0];
    include "../geralDAO.php";
    // echo $id;
    // var_dump($_POST);
    $query = "select mat as id, aluno as nome, if(nota is null, 0, nota) as media from (select matricula.id as mat, aluno.nome as aluno from aluno, matricula where matricula.idaluno = aluno.id and matricula.idturma = $id group by matricula.id) as t1 left join (select sum(nota * peso * .01) as nota,nota.idmat as mat2 from nota, avaliacao WHERE nota.idaval = avaliacao.id group by nota.idmat) as t2 on t1.mat = t2.mat2";
    $result = extrair($query);	
    // echo $query;
    $t = "";	
    while($row = $result->fetch_assoc())
    {
        if ($t != "") $t .= ",";
        $t .= "{";
        $t .= '"id":"' . $row["id"] . '",';
        $t .= '"media":"' . $row["media"] . '",';
        $t .= '"nome":"' . $row["nome"] . '"';
        $t .= "}";
    }
    echo "[$t]";