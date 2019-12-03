<?php
    require_once("header.php");
?>
<link rel="stylesheet" href="../css/basecad.css">
</head>
<body class="central" onload="init()">
    <?php
        require_once("nav.php");
    ?>
    <form action="../api/des/cad.php" method="post" name="form" class="box">
        <div class="titulo">Cadastrar Despesa</div>
        <div class="conteudo">
            <div class="size1 sizes">
                <div>
                    <label for="">Nome:</label>
                    <input type="text" id="nome" name="nome" placeholder="Informe o nome">
                </div>
            </div>
            <div class="size2 sizes">
                <div>
                    <label for="">Valor:</label>
                    <input type="text" id="valor" name="valor" maxlength="9" placeholder="Informe o valor">
                </div>
                <div>
                    <label for="">Data:</label>
                    <input type="date" readonly id="data" name="data" >
                </div>
            </div>
            <div class="size1 sizes">
                <div>
                    <label for="">Observação:</label>
                    <textarea type="text" id="obs" name="obs" placeholder="Informe alguma observação"></textarea>
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
<script src="../js/des/cad.js"></script>
    <?php
        require_once("footer.php");
    ?>