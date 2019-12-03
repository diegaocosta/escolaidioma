<?php
    require_once("header.php");
?>
<title>Cadastrar Aluno</title>
<link rel="stylesheet" href="../css/basecad.css">
</head>
<body class="central" onload="init()">
    <?php
        require_once("nav.php");
    ?>
    <button type="button" class="pdfgen" onclick="gerarPdf()">Gerar Pdf</button>
    <form action="../api/mate/edit.php" method="post" name="form" class="box outrobox2">
        <div class="titulo">Consultar Material</div>
        <div class="conteudo">
            <div class="size2 sizes">
                <div>
                    <label  class="eldados" >Nome:</label>
                    <input type="text" id="nome" name="nome"placeholder="Informe o nome">
                </div>
                <div>
                    <label  class="eldados" >Situação:</label>
                    <select name="status" id="status">
                        <option value="0">Desativado</option>
                        <option value="1">Ativado</option>
                    </select>
                </div>
            </div>
            <div class="size2 sizes">
                <div>
                    <label  class="eldados" >Tipo:</label>
                    <input type="text" id="tipo" name="tipo" placeholder="Informe o tipo, ex: russo">
                </div>
                <div>
                    <label  class="eldados" >Valor:</label>
                    <input type="text" id="valor" name="valor" placeholder="Informe o valor">
                </div>
            </div>
            <div class="size2 sizes">
                <div>
                    <label  class="eldados" >Valor Pago:</label>
                    <input type="text" id="comprado" name="comprado" placeholder="Informe o valor de compra">
                </div>
                <div>
                    <label  class="eldados" >Total:</label>
                    <input type="text" id="total" name="total" placeholder="Informe o total">
                </div>
            </div>
            <div class="size3 sizes">
                <div>
                    <label  class="eldados" >Editora:</label>
                    <input type="text" id="editora" name="editora" placeholder="Informe a editora">
                </div>
                <div>
                    <label  class="eldados" >Autor:</label>
                    <input type="text" id="autor" name="autor" placeholder="Informe o autor">
                </div>
                <div>
                    <label  class="eldados" >ISBN:</label>
                    <input type="text" id="isbn" name="isbn" placeholder="Informe o ISBN">
                </div>
            </div>
            <div class="size1 sizes">
                <div>
                    <label  class="eldados" >Observação:</label>
                    <textarea type="text" id="obs" name="obs" placeholder="Informe alguma observação"></textarea>
                </div>
            </div>
        </div>
    </form>
    <div class="btngrupo">
        <button type="button"  class="direita2" onclick="voltar()">Voltar</button>
        <!-- <input class="direita2"  type="submit" value="Logar"> -->
    </div>
<script src="../js/validadores.js"></script>
<script src="../js/mask.js"></script>
<script src="../js/mate/ver.js"></script>
    <?php
        require_once("footer.php");
    ?>