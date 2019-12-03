<nav>
<?php
    // session_start();     
    include "../api/geralDAO.php";
    $query = "select tipo from usuario where nome like '" . $_SESSION["login"] . "'";
    $result = extrair($query);		
    while($row = $result->fetch_assoc())
        $r = $row["tipo"];
    if ($r == 0)
        require_once("adm.php");
    if ($r <= 1 )
        require_once("sec.php");
    if ($r <= 2 )
        require_once("prof.php");    
    require_once("deslogagem.php");
?>
</nav>