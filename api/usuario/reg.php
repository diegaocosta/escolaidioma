<?php
    include "../geralDAO.php";
    $l = explode("?", $_SERVER["REQUEST_URI"])[1];
    $l = explode("&", $l);
    // var_dump($l);
    $d = md5(date('Y-m-d'));
    
    $query = "select id, cargo from funcionario where cpf like '$l[2]'";
    // echo $query;
    $result = extrair($query);		
    while($row = $result->fetch_assoc())
    {
        $query = "insert into usuario values (" . getIdMax("usuario");
        $query .= ", '" . $l[0] . "'";
        $query .= ", '" . sha1($d. md5($l[1]). $d) . "', '$d', ";
        $query .= $row["cargo"] . ",1," . $row["id"] . ")";
        echo $query;
        inserir($query);
        header("Location: ../../paginas/login.php");
    }

    