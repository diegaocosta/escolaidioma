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
    <form action="../api/mate/cad.php" method="post" name="form" class="box">
        <div class="titulo">Cadastrar Material</div>
        <div class="conteudo">
            <div class="size1 sizes">
                <div>
                    <label for="">Nome:</label>
                    <input type="text" id="nome" name="nome" placeholder="Informe o nome">
                </div>
            </div>
            <div class="size2 sizes">
                <div>
                    <label for="">Tipo:</label>
                    <input type="text" id="tipo" name="tipo" placeholder="Informe o tipo, ex: russo">
                </div>
                <div>
                    <label for="">Valor:</label>
                    <input type="text"  maxlength="8" id="valor" name="valor" placeholder="Informe o valor a ser vendido">
                </div>
            </div>
            <div class="size2 sizes">
                <div>
                    <label for="">Valor Pagado para Aquisição:</label>
                    <input maxlength="8" type="text" id="comprado" name="comprado" placeholder="Informe o valor de compra">
                </div>
                <div>
                    <label for="">Total:</label>
                    <input type="text" id="total" name="total" placeholder="Informe o total">
                </div>
            </div>
            <div class="size3 sizes">
                <div>
                    <label for="">Editora:</label>
                    <input type="text" id="editora" name="editora" placeholder="Informe a editora">
                </div>
                <div>
                    <label for="">Autor:</label>
                    <input type="text" id="autor" name="autor" placeholder="Informe o autor">
                </div>
                <div>
                    <label for="">ISBN:</label>
                    <input type="text" maxlength="13" id="isbn" name="isbn" placeholder="Informe o ISBN">
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
<script src="../js/mate/cad.js"></script>
    <?php
        require_once("footer.php");
    ?>