<?php
    require_once("header.php");
?>
<title>Cadastrar Aluno</title>
<link rel="stylesheet" href="../css/basecad.css">
<link rel="stylesheet" href="../css/turmaver.css">
</head>
<body class="central" onload="init()">
    <?php
        require_once("nav.php");
        $_SESSION["turma"] = explode("?", $_SERVER["REQUEST_URI"])[1];
    ?>
    <button type="button" class="pdfgen" onclick="gerarPdfImpressao()">Gerar Pdf</button>
    <form action="../api/turma/edit.php" method="post" name="form" class="outrobox2 box">
        <div class="titulo">Consultar Turma</div>
        <div class="conteudo">
            <div class="size2 sizes">
                <div>
                    <label class="eldados">Curso:</label>
                    <input type="text" id="idcurso" name="idcurso"  readonly>
                </div>
                <div>
                    <label class="eldados">Professor:</label>
                    <input type="text" id="idfun" name="idfun"  readonly>
                </div>
            </div>
            <div class="size2 sizes">
                <div>
                    <label class="eldados">Nome:</label>
                    <input type="text" id="nome" name="nome" placeholder="Informe o nome">
                </div>
                <div>
                    <label class="eldados">Situação:</label>
                    <select name="status" id="status">
                        <option value="0">Desativado</option>
                        <option value="1">Ativado</option>
                    </select>
                </div>
            </div>
            <div class="size2 sizes">
                <div>
                    <label  class="eldados">Data de Abertura:</label>
                    <input type="date" id="dtabertura" name="dtabertura">
                </div>
                <div>
                    <label  class="eldados">Data de Fechamento:</label>
                    <input type="date" id="dtfechamento" name="dtfechamento">
                </div>
            </div>
            <div class="size2 sizes">
                <div>
                    <label  class="eldados">Ano:</label>
                    <input type="text" id="ano" name="ano"  readonly>
                </div>
                <div>
                    <label  class="eldados">Carga Horária:</label>
                    <input type="text" id="totalaulas"  readonly>
                </div>
            </div>
            <div class="size1 sizes">
                <div>
                    <label  class="eldados">Dias da semana que tem aula:</label>
                </div>
            </div>
            <div class="size5 sizes" id="dias"></div>
            <input type="hidden" name="semana" id="semana">
            <div class="size1 sizes">
                <div>
                    <label class="eldados">Observação:</label>
                    <textarea type="text" id="obs" name="obs" placeholder="Informe alguma observação"></textarea>
                </div>
            </div>
            <div class="size1 sizes">
                <div>
                    <div class="th">Alunos Matriculados</div>
                    <div id="lista">
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="btngrupo">
    <?php
        if ($_SESSION["cargo"] == 2)
            // echo '<button type="button" onclick="voltar()">Voltar</button>';
            echo '<a href="turmaProList.php">Voltar</a>';
        else
            echo '<a href="turmaList.php">Voltar</a>';
    ?>
        
        <button type="button"class="direita2 dir" id="btnAula">Quadro de Frequencia</button>
        <button type="button"class="direita2 dir" id="btnAval" >Avaliações</button>
    </div>
<script src="../js/validadores.js"></script>
<script src="../js/mask.js"></script>
<script src="../js/turma/ver.js"></script>
    <?php

        require_once("footer.php");
    ?>