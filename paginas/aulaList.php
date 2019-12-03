<?php
    require_once("header.php");
?>
<link rel="stylesheet" href="../css/baselist.css">
<link rel="stylesheet" href="../css/alunolist.css">
<link rel="stylesheet" href="../css/aulalist.css">
</head>
<body class="central" onload="init()">
    <?php
        require_once("nav.php");
    ?>
    <form class="box" method='post' name="form">
        <div class="titulo">Quadro de Frequência</div>
        <input type="hidden"  id="hidden" name="hidden">
        <input type="hidden"  id="poshj" name="poshj">
        <div class="pesq" id="pesq2">
        
            <div></div>
            <div></div>
            <!-- <div>
                De:
                <input type="date" id="d1" onchange="pesquisar()">
            </div>
            <div>
                Até:
                <input type="date" id="d2" onchange="pesquisar()">
            </div> -->
            <button type="button" onclick='enviar()' href="" id="btncad">Registrar</button>
        </div>
        <div class="size2a">
            <div class="nomes" id="nomes"></div>
            <div class="lista" id="lista"></div>
        </div>
    </form>
    <div class="btngrupo">
        <button type="button" onclick="voltar()">Voltar</button>
    </div>
<script src="../js/aula/list.js"></script>
    <?php
        require_once("footer.php");
    ?>