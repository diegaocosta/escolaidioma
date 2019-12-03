<?php
    require_once("header.php");
?>
<title>Cadastrar Aluno</title>
<link rel="stylesheet" href="../css/basecad.css">
<link rel="stylesheet" href="../css/turmamontar.css">
</head>
<body class="central" onload="init()">
    <?php
        require_once("nav.php");
    ?>
    <form action="../api/matricula/cad.php" method="post" name="form" class="box">
        <div class="titulo">Montar Turma</div>
        <div class="conteudo">
            <input type="hidden" id="hidden" name="hidden">
            <input type="hidden" id="id" name="id">
            <div class="size3 sizes">
                <div>
                    <label for="">Turma:</label>
                    <input type="text" id="nome" name="nome">
                </div>
                <div>
                    <label for="">Curso:</label>
                    <input type="text" id="idcurso" name="idcurso">
                </div>
                <div>
                    <label for="">Professor:</label>
                    <input type="text" id="idfun" name="idfun" >
                </div>
            </div>
            <div class="size2 sizes">
                <div>
                    <div class="infos">Alunos</div><div></div>
                    <div id="lista1" class="lista">                        
                    </div>
                </div>
                <div>
                    <div class="infos">Matriculados</div><div></div>
                    <div id="lista2" class="lista">
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="btngrupo">
        <button type="button" onclick="voltar()">Voltar</button>
        <button type="button" class="direita2" onclick="enviar()">Adicionar</button>
        <!-- <input class="direita2"  type="submit" value="Logar"> -->
    </div>
<script src="../js/validadores.js"></script>
<script src="../js/mask.js"></script>
<script src="../js/turma/montar.js"></script>
    <?php
        require_once("footer.php");
    ?>