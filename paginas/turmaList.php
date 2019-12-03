<?php
    require_once("header.php");
?>
<link rel="stylesheet" href="../css/baselist.css">
<link rel="stylesheet" href="../css/turmalist.css">
</head>
<body class="central" onload="init()">
    <?php
        require_once("nav.php");
    ?>
    <button type="button" class="pdfgen" onclick="gerarPdf()">Gerar Pdf</button>
    <div class="box">
        <div class="titulo">Turmas Cadastradas</div>
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
            <a href="turmaCad.php">Cadastrar</a>
        </div>
        <div class="conteudo lista" id="lista">
        </div>
    </div>
<script src="../js/turma/list.js"></script>
    <?php
        require_once("footer.php");
    ?>