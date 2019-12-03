<?php
    require_once("header.php");
?>
<link rel="stylesheet" href="../css/basecad.css">
<link rel="stylesheet" href="../css/reg.css">
</head>
<body  onload="init()">
    <form action="../api/usuario/cad.php" method="post" name="form" class="box">
        <div class="titulo">Criar Conta</div>
        <div class="conteudo">
            <div class="size2 sizes">
                <div>
                    <label for="">CPF:</label>
                    <input type="text" id="cpf" name="cpf" placeholder="Informe o cpf">
                </div>
                <div>
                    <label for="">Usuário:</label>
                    <input type="text" id="usuario" name="usuario" placeholder="Informe o usuário">
                </div>
            </div>
            <div class="size2 sizes">
                <div>
                    <label for="">Senha:</label>
                    <input type="password" id="senha" name="senha"  placeholder="Informe a senha">
                </div>
                <div>
                    <label for="">Confirmar senha:</label>
                    <input type="password" id="senha1" name="senha1"  placeholder="Informe a senha novamente">
                </div>
            </div>
        </div>
    <div class="btngrupo">
        <button type="button" onclick="voltar()">Voltar</button>
        <button type="button" class="direita2" onclick="enviar()">Criar</button>
        <!-- <input class="direita2"  type="submit" value="Logar"> -->
    </div>
    </form>
<script src="../js/validadores.js"></script>
<script src="../js/mask.js"></script>
<script src="../js/usuario/reg.js"></script>
    <?php
        require_once("footer.php");
    ?>