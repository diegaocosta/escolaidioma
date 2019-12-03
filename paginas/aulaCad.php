<?php
    require_once("header.php");
?>
<title>Cadastrar Aluno</title>
<link rel="stylesheet" href="../css/basecad.css">
<link rel="stylesheet" href="../css/aulacad.css">
</head>
<body class="central" onload="init()">
    <?php
        require_once("nav.php");
    ?>
    <form action="../api/aula/cad.php" method="post" name="form" class="box">
        <div class="titulo">Cadastrar Aula</div>
        <div class="conteudo">
            <div class="size2 sizes">
                <div>
                    <label for="">Turma:</label>
                    <input type="text" id="turmanome"  readonly>
                    <input type="hidden" id="idturma" name="idturma">
                    <input type="hidden" id="freq" name="freq">
                </div>
                <div>
                    <label for="">Data da Aula:</label>
                    <input type="date" id="data" name="data" readonly>
                </div>
            </div>
            <div class="size1 sizes">
                <div>
                    <label for="">Observação:</label>
                    <textarea type="text" id="obs" name="obs" placeholder="Informe alguma observação"></textarea>
                </div>
            </div>
            <div class="size1 sizes">
                <div>
                    <label for="" id="ddc"  class="th">Diário de Classe</label>
                    <div class="lista" id="lista"></div>
                </div>
            </div>
        </div>
    </form>
    <div class="btngrupo">
        <button type="button" onclick="voltar()">Voltar</button>
        <button type="button" class="direita2" onclick="enviar()">Cadastrar</button>
        <!-- <input class="direita2"  type="submit" value="Logar"> -->
    </div>
<script src="../js/validadores.js"></script>
<script src="../js/mask.js"></script>
<script src="../js/aula/cad.js"></script>
    <?php
        require_once("footer.php");
    ?>