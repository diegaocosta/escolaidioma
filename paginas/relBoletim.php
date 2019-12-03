<?php
    require_once("header.php");
?>
<link rel="stylesheet" href="../css/baselist.css">
<link rel="stylesheet" href="../css/aulalist.css">
<link rel="stylesheet" href="../css/relbol.css">
</head>
<body class="central" onload="init()">
    <?php
        require_once("nav.php");
    ?>
    <button type="button" class="pdfgen" onclick="gerarPdf()">Gerar Pdf</button>
    <div class="box">
        <div class="titulo">Relatório de Boletins</div>
        <div class="pesq" id="pesq">
            <select id="turmas"></select>
            <!-- <div>
                De:
                <input type="date" id="d1" onchange="pesquisar()">
            </div>
            <div>
                Até:
                <input type="date" id="d2" onchange="pesquisar()">
            </div> -->
            <!-- <a class="dir" onclick="showmsg()" id="btnshow">Alterar Peso das Notas</a> -->
            <!-- <a href="turmaVer.php" id="btncad">Ver Turma</a> -->
        </div>
        <div class="size2a" method="post" name="form" id="boletim">
            <div id="nomesdiv"></div>
            <div>
                <label class="bolth">NOTAS</label>
                <div id="notasdiv">
                    <div id="medias"></div>
                    <div id="notas"></div>
                </div>
            </div>
            <div>
                <label class="bolth">FREQUÊNCIAS</label>
                <div id="freqsdiv">
                    <div id="total"></div>
                    <div id="perc"></div>
                    <div id="freqs"></div>
                </div>
            
            </div>
        </div>
    </div>
<script src="../js/rel/listbol.js"></script>
    <?php
        require_once("footer.php");
    ?>