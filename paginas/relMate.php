<?php
    require_once("header.php");
?>
<link rel="stylesheet" href="../css/baselist.css">
<link rel="stylesheet" href="../css/basecad.css">
<link rel="stylesheet" href="../css/alunolist.css">
<link rel="stylesheet" href="../css/matelist2.css">
<link rel="stylesheet" href="../css/modal.css">
</head>
<body class="central" onload="init()">
    <?php
        require_once("nav.php");
    ?>
    <button type="button" class="pdfgen" onclick="gerarPdf()">Gerar Pdf</button>
    <div class="box">
        <div class="titulo">Relatório de Materiais</div>
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
        </div>
        <div class="conteudo lista" id="lista">
        </div>
    </div>
    <form  class="modal" id="modal" name="form" method="post">
        <div class="titulo" id="materialnomeform"></div>
        <div class="conteudo">
            <div class="size1 sizes">
                <div>
                    <label >Nome:</label>
                    <input type="text" readonly id="nome" name="nome" placeholder="Informe o nome">
                </div>
            </div>
            <div class="size2 sizes">
                <div>
                    <label >Tipo:</label>
                    <input type="text" readonly id="tipo1" name="tipo1" placeholder="Informe o tipo, ex: russo">
                </div>
                <div>
                    <label >Valor:</label>
                    <input type="text" readonly id="valor" name="valor" placeholder="Informe o valor">
                </div>
            </div>
            <div class="size3 sizes">
                <div>
                    <label >Valor Pago:</label>
                    <input type="text" readonly id="comprado" name="comprado" placeholder="Informe o valor de compra">
                </div>
                <div>
                    <label >Total:</label>
                    <input type="text" readonly id="total" name="total" placeholder="Informe o total">
                </div>
                <div>
                    <label >Total Vendido:</label>
                    <input type="text" readonly id="totalvendido" name="totalvendido" placeholder="Informe o total">
                </div>
            </div>
            <div class="size3 sizes">
                <div>
                    <label >Editora:</label>
                    <input type="text" readonly id="editora" name="editora" placeholder="Informe a editora">
                </div>
                <div>
                    <label >Autor:</label>
                    <input type="text" readonly id="autor" name="autor" placeholder="Informe o autor">
                </div>
                <div>
                    <label >ISBN:</label>
                    <input type="text" readonly id="isbn" name="isbn" placeholder="Informe o ISBN">
                </div>
            </div>
            <div class="size1 sizes">
                <div>
                    <label >Observação:</label>
                    <textarea type="text" readonly id="obs" name="obs" placeholder="Informe alguma observação"></textarea>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="btngroup">
                <a type="button" class="direita2"  onclick="cancelar()">Cancelar</a>
            </div>
        </div>
    </form>
    <script src="../js/modal.js"></script>
    <script src="../js/mate/rellist.js"></script>
    <?php
        require_once("footer.php");
    ?>