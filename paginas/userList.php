<?php
    require_once("header.php");
?>
<link rel="stylesheet" href="../css/baselist.css">
<link rel="stylesheet" href="../css/modal.css">
<link rel="stylesheet" href="../css/userlist.css">
</head>
<body class="central" onload="init()">
    <?php
        require_once("nav.php");
    ?>
    <div class="box">
        <div class="titulo">Usuários Cadastrados</div>
        <div class="pesq2">
            <div>
                Situação:
                <select name="status" id="status">
                    <option value="0">Desativado</option>
                    <option value="1">Ativo</option>
                    <option value="2">Tudo</option>
                </select>
            </div>
            <input type="text" id="pesq" placeholder="Pesquisar por Nome" >
            <a href="userCad.php">Cadastrar</a>
        </div>
        <div class="conteudo lista" id="lista">
        </div>
    </div>
    <form  class="modal" id="modal0" name="form" method="post">
        <div class="titulo">Desativar Usuário?</div>
        <div class="footer">
            <div class="btngroup">
                <button type="button" onclick="cancelar(0)">Não</button>
                <a type="button" class="direita2" onclick="troca()">Sim</a>
            </div>
        </div>
    </form>
    <script src="../js/base.js"></script>
    <script src="../js/usuario/list.js"></script>
    <?php
        require_once("footer.php");
    ?>