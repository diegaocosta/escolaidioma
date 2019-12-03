<?php
    include "../geralDAO.php";
    $id = explode("?", $_SERVER["REQUEST_URI"])[1];
    session_start();
    $q = "select id from usuario where nome like '" . $_SESSION["login"] . "'";    
    $result = extrair($q);	
    $idfun;
    while($row = $result->fetch_assoc())
        $idfun = $row["id"];

    foreach (explode(",", "desconto,valor,pago,valororiginal") as $i)
        $_POST[$i] = floatval(str_replace(",", ".", $_POST[$i]));
        var_dump($_POST); 
        echo "<br>";

    $idmens = getIdMax("mensalidade");
    $idpag = getIdMax("pagamento");
    $query = "";

    $status = ($_POST["valor"] != $_POST["pago"])  ? 0 : 1;

    $query = "insert into mensalidade values ($idmens, ";
    $query .= "'" . $_POST["valororiginal"] . "',";
    $query .= "'" . $_POST["valor"] . "',";
    $query .= "'" . $_POST["pago"] . "',";
    $query .= "'" . $_POST["mes"] . "',";
    $query .= "'" . $_POST["ano"] . "',";
    $query .= "'" . $_POST["obs"] . "',";
    $query .= "'" . ($_POST["valor"] - $_POST["pago"]) . "',";
    $query .= "$status, $id, $idfun)";

    echo $query . "<br>";
    inserir($query);

    $query = "insert into pagamento values ($idpag, ";
    $query .= "'" . $_POST["nome"] . "',";
    $query .= "'" . $_POST["data"] . "',";
    $query .= "'" . $_POST["desconto"] . "',";
    $query .= "'" . $_POST["pago"] . "',";
    $query .= "'" . $_POST["percent"] . "', 0,$idmens)";
    echo $query;
    inserir($query);

    $query = "select meses from matricula where id = $id";
    $result = extrair($query);	
    $meses = "";
    while($row = $result->fetch_assoc())
        $meses = explode(";", $row["meses"]);
    for ($i=0; $i < sizeof($meses); $i++) 
        if (explode(",", $meses[$i])[0] == $_POST["mes"]) 
            $meses[$i] = $_POST["mes"] . "," . $status;
    $y = "";
    foreach($meses as $i)
    {
        if ($y != "") $y .= ";";
        $y .= $i;
    }
    $query = "update matricula set meses = '$y' where id = $id";
    echo ($query);
    inserir($query);
    header("Location: ../../paginas/mensList.php");