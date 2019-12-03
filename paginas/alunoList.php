<?php
    require_once("header.php");
?>
<link rel="stylesheet" href="../css/baselist.css">
<link rel="stylesheet" href="../css/modal.css">
<link rel="stylesheet" href="../css/alunolist.css">
</head>
<body class="central" onload="init()">
    <?php
        require_once("nav.php");
    ?>
    <button type="button" class="pdfgen" onclick="gerarPdf()">Gerar Pdf</button>
    <div class="box">
        <div class="titulo">Alunos Cadastrados</div>
        <div class="pesq">
            <div>
                Situação:
                <select name="status" id="status">
                    <option value="0">Evadido</option>
                    <option value="1">Ativo</option>
                    <option value="2">Tudo</option>
                </select>
            </div>
            <select name="tipo" id="tipo" onchange="mudarPesqPlaceholder(event)"></select>
            <input type="text" id="pesq" placeholder="Pesquisar por Nome" >
            <a href="alunoCad.php">Cadastrar</a>
        </div>
        <div class="conteudo lista" id="lista">
        </div>
    </div>
    <form  class="modal" id="modal" name="form" method="post">
        <div class="titulo"> <label id="nomedoaluno"></label>, desistir do curso?</div>
        <div class="conteudo">
            <label>Motivo:</label>
            <label><input type="checkbox" id="m0"><span>Falta de conexão com o curso</span></label>
            <label><input type="checkbox" id="m1"><span>Desempenho acadêmico</span></label>
            <label><input type="checkbox" id="m2"><span>Dificuldades financeiras</span></label>
            <label><input type="checkbox" id="m3"><span>Localização da escola em relação à moradia </span></label>
            <label><input type="checkbox" id="m4"><span>Oportunidades de emprego</span></label>
            <label><input type="checkbox"  id="m5"><span>Outros</span></label>
            <input type="hidden" name="motivos" id="motivos">
            <div id="isoutros">
                <label  class="eldados">Outros:</label>
                <textarea type="text" id="outros" name="outros" onclick="document.getElementById('m5').checked = true" placeholder="Informe alguma observação"></textarea>
            </div>
        </div>
        <div class="footer">
            <div class="btngroup">
                <button type="button" onclick="cancelar()">Não</button>
                <a type="button" class="direita2" onclick="confirmar()">Sim</a>
            </div>
        </div>
    </form>
    <script src="../js/modal.js"></script>
    <script src="../js/aluno/list.js"></script>
    <?php
        require_once("footer.php");
    ?>