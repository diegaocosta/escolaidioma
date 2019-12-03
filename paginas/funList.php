<?php
    require_once("header.php");
?>
<link rel="stylesheet" href="../css/baselist.css">
<link rel="stylesheet" href="../css/modal.css">
<link rel="stylesheet" href="../css/alunolist.css">
</head>
<body class="central" onload="init()">
    <?php
        require_once("nav.php");
    ?>
    <button type="button" class="pdfgen" onclick="gerarPdf()">Gerar Pdf</button>
    <div class="box">
        <div class="titulo">Funcionários Cadastrados</div>
        <div class="pesq">
            <div>
                Situação:
                <select name="status" id="status">
                    <option value="0">Desativado</option>
                    <option value="1">Ativo</option>
                    <option value="2">Tudo</option>
                </select>
            </div>
            <select name="tipo" id="tipo" onchange="mudarPesqPlaceholder(event)"></select>
            <input type="text" id="pesq" placeholder="Pesquisar por Nome" >
            <a href="funCad.php">Cadastrar</a>
        </div>
        <div class="conteudo lista" id="lista">
        </div>
    </div>
    <form  class="modal" id="modal" name="form" method="post">
        <div class="titulo">Deletar Aluno?</div>
        <div class="footer">
            <div class="btngroup">
                <button type="button" onclick="cancelar()">Não</button>
                <a type="button" class="direita2" onclick="confirmar()">Sim</a>
            </div>
        </div>
    </form>
<script src="../js/modal.js"></script>
<script src="../js/fun/list.js"></script>
    <?php
        require_once("footer.php");
    ?>