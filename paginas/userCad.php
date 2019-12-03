<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../js/jquery.js"></script>
    <script src="../js/base.js"></script>
    <link rel="stylesheet" href="../css/base.css">
    <title>Cadastrar Aluno</title>
    <link rel="stylesheet" href="../css/basecad.css">
    <link rel="stylesheet" href="../css/alunocad.css">
    <link rel="stylesheet" href="../css/usercad.css">
    <?php
    
        if (!isset($_SESSION["login"]))
            echo '<link rel="stylesheet" href="../css/usercad2.css">';
    
    ?>
    
</head>
<body class="central" onload="init()">
    <?php
        if (isset($_SESSION["login"]))
            require_once("nav.php");
    ?>
    <form action="../api/usuario/cad.php" method="post" name="form" class="box">
        <div class="titulo">Cadastrar Usuário</div>
        <div class="conteudo">
            <div id="s1" class="size2a sizes">
                <div>
                    <input type="text" id="nome" placeholder="Informe o usuario a ser buscado">
                </div>
                <div>
                    <button id="bscbtn" type="button" onclick="buscar()">Buscar</button>
                </div>
            </div>
            <div class="size2 sizes">
                <div>
                    <label >Nome:</label>
                    <input type="text" readonly id="nomefun" >
                </div>
                <div>
                    <label >Cargo:</label>
                    <input type="text" readonly id="cargofun">
                    <input type="hidden" id="cargoid" name="cargoid">
                </div>
            </div>
            <div class="size1 sizes">
                <div>
                    <label >Login:</label>
                    <input type="text" name="login" id="login" >
                </div>
            </div>
            <div class="size2 sizes">
                <div>
                    <label >Senha:</label>
                    <input type="password" id="senha" name="senha" placeholder="Informe a senha">
                </div>
                <div>
                    <label >Confirmar Senha:</label>
                    <input type="password" id="senha1"  placeholder="Confirmar senha">
                </div>
            </div>
        </div>
    </form>
    <div class="btngrupo">
    <?php    
        if (isset($_SESSION["login"]))
            echo '<button type="button" onclick="voltar()">Voltar</button>';
        else
            echo "<button type='button' onclick='location.href = \"login.php\"'>Voltar</button>";

    ?>

        <button type="button" class="direita2" onclick="enviar()">Cadastrar</button>
        <!-- <input class="direita2"  type="submit" value="Logar"> -->
    </div>
    <script src="../js/validadores.js"></script>
    <script src="../js/mask.js"></script>
    <script src="../js/usuario/cad.js"></script>
    <?php
        require_once("footer.php");
    ?>