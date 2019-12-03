<?php
    require_once("header.php");
?>
<title>Cadastrar Aluno</title>
<link rel="stylesheet" href="../css/basecad.css">
<link rel="stylesheet" href="../css/avalcad.css">
</head>
<body class="central" onload="init()">
    <?php
        require_once("nav.php");
    ?>
    <form action="../api/aval/edit.php" method="post" name="form" class="box">
        <div class="titulo">Editar Avaliação</div>
        <div class="conteudo">
            <div class="size1 sizes">
                <div>                    
                    <label for="">Nome:</label>
                    <input type="hidden" id="idturma" name="idturma">
                    <input type="hidden" id="idaval" name="idaval">
                    <input type="hidden" id="notas" name="notas">
                    <input type="text" id="nome" name="nome" placeholder="Informe o nome">
                </div>
            </div>
            <div class="size2 sizes">
                <div>
                    <label for="">Turma:</label>
                    <input type="text" id="turmanome"  readonly>
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
                    <label for="" id="ddc"  class="th">Notas</label>
                    <div class="lista size2" id="lista"></div>
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
    <script src="../js/aval/edit.js"></script>
    <?php
        require_once("footer.php");
    ?>