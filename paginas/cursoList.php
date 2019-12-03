<?php
    require_once("header.php");
?>
<link rel="stylesheet" href="../css/baselist.css">
<link rel="stylesheet" href="../css/alunolist.css">
<link rel="stylesheet" href="../css/cursolist.css">
</head>
<body class="central" onload="init()">
    <?php
        require_once("nav.php");
    ?>
    <button type="button" class="pdfgen" onclick="gerarPdf()">Gerar Pdf</button>
    <div class="box">
        <div class="titulo">Cursos Cadastrados</div>
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
            <a href="cursoCad.php">Cadastrar</a>
        </div>
        <div class="conteudo lista" id="lista">
        </div>
    </div>
<script src="../js/curso/list.js"></script>
    <?php
        require_once("footer.php");
    ?>