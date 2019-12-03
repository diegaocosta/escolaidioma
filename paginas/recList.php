<?php
    require_once("header.php");
?>
<link rel="stylesheet" href="../css/baselist.css">
<link rel="stylesheet" href="../css/alunolist.css">
<link rel="stylesheet" href="../css/reclist.css">
</head>
<body class="central" onload="init()">
    <?php
        require_once("nav.php");
    ?>
    <button type="button" class="pdfgen" onclick="gerarPdf()">Gerar Pdf</button>
    <div class="box">
        <div class="titulo">Receitas Cadastradas</div>
        <div class="pesq2" id="pesq2">
            <div>
                <label>De:</label> 
                <input type="date" id="d1" onchange="pesquisar()">
            </div>
            <div>
                <label>Até:</label> 
                <input type="date" id="d2" onchange="pesquisar()">
            </div>
            <a href="recCad.php" id="btncad">Cadastrar</a>
        </div>
        <div class="conteudo lista" id="lista">
        </div>
    </div>
<script src="../js/rec/list.js"></script>
    <?php
        require_once("footer.php");
    ?>