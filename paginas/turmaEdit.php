<?php
    require_once("header.php");
?>
<title>Cadastrar Aluno</title>
<link rel="stylesheet" href="../css/basecad.css">
<link rel="stylesheet" href="../css/turmacad.css">
</head>
<body class="central" onload="init()">
    <?php
        require_once("nav.php");
    ?>
    <form action="../api/turma/edit.php" method="post" name="form" class="box">
        <div class="titulo">Editar Turma</div>
        <div class="conteudo">
            <div class="size2 sizes">
                <div>
                    <label for="">Curso:</label>
                    <select name="idcurso" id="idcurso"></select>
                </div>
                <div>
                    <label for="">Professor:</label>
                    <select name="idfun" id="idfun"></select>
                </div>
            </div>
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
            <div class="size3 sizes">
                <div>
                    <label >Data de Abertura:</label>
                    <input type="date" id="dtabertura" name="dtabertura">
                </div>
                <div>
                    <label >Data de Fechamento:</label>
                    <input type="date" id="dtfechamento" name="dtfechamento">
                </div>
                <div>
                    <label >Ano:</label>
                    <input type="text" id="ano" name="ano"  readonly>
                </div>
            </div>
            <div class="size1 sizes">
                <div>
                    <label >Dias da semana que tem aula:</label>
                </div>
            </div>
            <div class="size5 sizes" id="dias"></div>
            <input type="hidden" name="semana" id="semana">
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
        <button type="button" class="direita2 dir" onclick="enviar()">Alterar</button>
        <!-- <input class="direita2"  type="submit" value="Logar"> -->
    </div>
<script src="../js/validadores.js"></script>
<script src="../js/mask.js"></script>
<script src="../js/turma/edit.js"></script>
    <?php
        require_once("footer.php");
    ?>