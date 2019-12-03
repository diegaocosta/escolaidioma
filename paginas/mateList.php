<?php
    require_once("header.php");
?>
<link rel="stylesheet" href="../css/baselist.css">
<link rel="stylesheet" href="../css/alunolist.css">
<link rel="stylesheet" href="../css/matelist.css">
<link rel="stylesheet" href="../css/modal.css">
</head>
<body class="central" onload="init()">
    <?php
        require_once("nav.php");
    ?>
    <button type="button" class="pdfgen" onclick="gerarPdf()">Gerar Pdf</button>
    <div class="box">
        <div class="titulo">Materiais Cadastrados</div>
        <div class="pesq">
            <div>
                Situação:
                <select name="status" id="status">
                    <option value="0">Desativado</option>
                    <option value="1">Ativo</option>
                    <option value="2">Tudo</option>
                </select>
            </div>
            <select name="tipo" id="tipo" onchange="mudarPesqPlaceholder(event)"></select>
            <input type="text" id="pesq" placeholder="Pesquisar por Nome" >
            <a href="mateCad.php">Cadastrar</a>
        </div>
        <div class="conteudo lista" id="lista">
        </div>
    </div>
    <form  class="modal" id="modal" name="form" method="post">
        <div class="titulo">Aquisição de Material</div>
        <div class="conteudo">
            <div>
                <label >Valor de Pago:</label>
                <input type="text" maxlength="8" id="comprado" name="comprado" placeholder="Informe o valor pago">
            </div>
            <div>
                <label >Preço de Venda:</label>
                <input type="text" maxlength="8" id="valor" name="valor" placeholder="Informe o valor pago">
            </div>
            <div>
                <label >Total:</label>
                <input type="text"  maxlength="4" id="total" name="total" placeholder="Informe o total">
            </div>
        </div>
        <div class="footer">
            <div class="btngroup">
                <button type="button" onclick="cancelar()">Cancelar</button>
                <a type="button" class="direita2" onclick="registrar()">Registrar</a>
            </div>
        </div>
    </form>
<script src="../js/validadores.js"></script>
<script src="../js/mask.js"></script>
<script src="../js/modal.js"></script>
<script src="../js/mate/list.js"></script>
    <?php
        require_once("footer.php");
    ?>