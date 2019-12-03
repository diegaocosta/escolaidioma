<?php
    require_once("header.php");
?>
<link rel="stylesheet" href="../css/basecad.css">
<link rel="stylesheet" href="../css/mensaluno.css">
</head>
<body class="central" onload="init()">
    <?php
        require_once("nav.php");
    ?>
    <form name="form" class="box">
        <div class="titulo" id="alunotitle"></div>
        <div class="conteudo" id="mens">
            <div id="lista" class="lista">
            </div>
        </div>
    </form>
    <div class="btngrupo">
        <button type="button" class="direita2" onclick="voltar()">Voltar</button>
        <!-- <input class="direita2"  type="submit" value="Logar"> -->
    </div>
<script src="../js/validadores.js"></script>
<script src="../js/mask.js"></script>
<script src="../js/mens/mensAluno.js"></script>
    <?php
        require_once("footer.php");
    ?>