<?php
    session_start();
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/base.css">
<link rel="stylesheet" href="../css/login.css">
<link rel="stylesheet" href="../css/modal.css">
</head>
<body onload="init()">
    <form action="../api/usuario/login.php" method="post" name="form" class="box">
        <div class="titulo">
            Realizar Login
        </div>
        <div class="conteudo">
            <div>
                <label for="">Usuário:</label>
                <input type="text" id="nome" name="nome" placeholder="Informe o usuário">
            </div>
            <div>
                <label for="">Senha:</label>
                <input type="password" id="senha" name="senha" placeholder="Informe a senha" >
            </div>
        </div>
        <div class="resto">
            <button type="button" id="reg" onclick="registrar()">Registrar</button>
            <button type="button" onclick="mostrarMsg(0)">Trocar Senha</button>
            <button type="button" class="direita2" onclick="logar()">Logar</button>
            <!-- <input class="direita2"  type="submit" value="Logar"> -->
        </div>
    </form>
    <form  class="modal" id="modal" name="form" method="post">
        <div class="titulo">Trocar Senha</div>
        <div class="conteudo">
            <div>
                <label for="">Usuário:</label>
                <input type="text" id="usuarionome" placeholder="Informe o usuário">
            </div>
            <div>
                <label for="">CPF:</label>
                <input type="text" id="cpf" placeholder="Informe o cpf">
            </div>
            <div>
                <label for="">Senha:</label>
                <input type="password" id="senha2" disabled="disabled" placeholder="Informe a senha">
            </div>
            <div>
                <label for="">Confirmar Senha:</label>
                <input type="password" id="senha1" disabled="disabled"  placeholder="Confirmar senha">
            </div>

        </div>
        <div class="footer">
            <div class="btngroup">
                <button type="button" onclick="cancelar()">Não</button>
                <a type="button" class="direita2" onclick="trocar()">Sim</a>
            </div>
        </div>
    </form>
    <script src="../js/jquery.js"></script>
    <script src="../js/base.js"></script>
    <script src="../js/modal.js"></script>
    <script src="../js/mask.js"></script>
    <script src="../js/validadores.js"></script>
    <script src="../js/usuario/login.js"></script>
<?php
    require_once("footer.php");
?>