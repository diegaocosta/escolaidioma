<?php
    require_once("header.php");
?>
<link rel="stylesheet" href="../css/baselist.css">
<link rel="stylesheet" href="../css/alunolist.css">
<link rel="stylesheet" href="../css/aulalist.css">
<link rel="stylesheet" href="../css/avalist.css">
</head>
<body class="central" onload="init()">
    <?php
        require_once("nav.php");
    ?>
    <div class="box">
        <div class="titulo">Atividades Cadastradas</div>
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
            <!-- <a class="dir" onclick="showmsg()" id="btnshow">Alterar Peso das Notas</a> -->
            <a href="avalCad.php" id="btncad">Cadastrar</a>
        </div>
        <form class="size2a" method="post" name="form">
            <div class="nomes" id="nomes"></div>
            <div class="lista" id="lista"></div>
            <input type="hidden" name="pesos" id="pesos">
        </form>
    </div>
    <div class="btngrupo">
        <button type="button" onclick="voltar()">Voltar</button>
    </div>
<script src="../js/aval/list.js"></script>
    <?php
        require_once("footer.php");
    ?>