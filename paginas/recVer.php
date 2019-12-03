<?php
    require_once("header.php");
?>
<link rel="stylesheet" href="../css/basecad.css">
</head>
<body class="central" onload="init()">
    <?php
        require_once("nav.php");
    ?>
    <button type="button" class="pdfgen" onclick="gerarPdf()">Gerar Pdf</button>
    <form  class="box">
        <div class="titulo">Consultar Receita</div>
        <div class="conteudo">
            <div class="size1 sizes">
                <div>
                    <label class="eldados">Nome:</label>
                    <input type="text" id="nome" readonly name="nome" placeholder="Informe o nome">
                </div>
            </div>
            <div class="size2 sizes">
                <div>
                    <label class="eldados">Valor:</label>
                    <input type="text" id="valor"  readonly name="valor" maxlength="9" placeholder="Informe o valor">
                </div>
                <div>
                    <label class="eldados">Data:</label>
                    <input type="date" readonly id="data" name="data" >
                </div>
            </div>
            <div class="size1 sizes">
                <div>
                    <label class="eldados">Observação:</label>
                    <textarea type="text" id="obs"  readonly name="obs" placeholder="Informe alguma observação"></textarea>
                </div>
            </div>
        </div>
    </form>
    <div class="btngrupo">
        <button type="button" class="direita2" onclick="voltar()">Voltar</button>
        <!-- <input class="direita2"  type="submit" value="Logar"> -->
    </div>
<script src="../js/validadores.js"></script>
<script src="../js/mask.js"></script>
<script src="../js/rec/ver.js"></script>
    <?php
        require_once("footer.php");
    ?>