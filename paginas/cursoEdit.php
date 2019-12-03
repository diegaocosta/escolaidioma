<?php
    require_once("header.php");
?>
<title>Cadastrar Aluno</title>
<link rel="stylesheet" href="../css/basecad.css">
<link rel="stylesheet" href="../css/turmacad.css">
<link rel="stylesheet" href="../css/cursocad.css">
</head>
<body class="central" onload="init()">
    <?php
        require_once("nav.php");
    ?>
    <form action="../api/curso/edit.php" method="post" name="form" class="box outrobox2">
        <div class="titulo">Editar Curso</div>
        <div class="conteudo">
            <div class="size2 sizes">
                <div>
                    <label for="">Nome:</label>
                    <input type="text" id="nome" name="nome" placeholder="Informe o nome">
                </div>
                <div>
                    <label for="">Situação:</label>
                    <select name="status" id="status">
                        <option value="0">Desativado</option>
                        <option value="1">Ativado</option>
                    </select>
                </div>
            </div>
            <div class="size2 sizes">
                <div>
                    <label >Total de Meses:</label>
                    <input type="text" id="totaldemes" name="totaldemes" maxlength="2" placeholder="Informe o total de semanas">
                </div>
                <div>
                    <label for="">Valor do Curso:</label>
                    <input type="text" id="valor" name="valor" placeholder="Informe o valor do curso">
                </div>
            </div>
            <div class="size2 sizes">
                <div>
                    <label >Tipo de Multa:</label>
                    <select name="tipomulta" id="tipomulta">
                        <option value="0">Mensal Decimal</option>
                        <option value="1">Mensal Porcentagem</option>
                        <option value="2">Diário Decimal</option>
                    </select>
                </div>
                <div>
                    <label >Valor da Multa:</label>
                    <input type="text" id="multa" name="multa" placeholder="Informe o valor da multa">
                </div>
            </div>
            <div class="size1 sizes">
                <div>
                    <label for="">Observação:</label>
                    <textarea type="text" id="obs" name="obs" placeholder="Informe alguma observação"></textarea>
                </div>
            </div>
            <div class="size2 sizes materiais">
                <div>
                    <input type="text" id="pesqcampo" onkeyup="pesquisar()" placeholder="Digite para filtrar">
                    <div id="lista1" class="lista">
                        
                    </div>
                </div>
                <div>                
                    <input type="text" readonly placeholder="Materiais" id="materiais">
                    <input type="hidden" readonly id="matelist" name="matelist">
                    <div id="lista2" class="lista">
                        
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="btngrupo">
        <button type="button" onclick="voltar()">Voltar</button>
        <button type="button" class="direita2" onclick="enviar()">Alterar</button>
        <!-- <input class="direita2"  type="submit" value="Logar"> -->
    </div>
<script src="../js/validadores.js"></script>
<script src="../js/mask.js"></script>
<script src="../js/curso/edit.js"></script>
    <?php
        require_once("footer.php");
    ?>