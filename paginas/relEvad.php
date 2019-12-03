<?php
    require_once("header.php");
?>
<link rel="stylesheet" href="../css/baselist.css">
<link rel="stylesheet" href="../css/alunolist.css">
<link rel="stylesheet" href="../css/evadlist.css">
<link rel="stylesheet" href="../css/modal.css">
</head>
<body class="central" onload="init()">
    <?php
        require_once("nav.php");
    ?>
    <button type="button" class="pdfgen2" onclick="gerarGrafico()">Gerar Gráfico</button>
    <button type="button" class="pdfgen" onclick="gerarPdf()">Gerar Pdf</button>
    <div class="box">
        <div class="titulo">Relatório de Evasão</div>
        <div class="pesq2">
            <div>
                Situação:
                <select name="status" id="status">
                    <option value="0">Desativado</option>
                    <option value="1">Ativo</option>
                    <option value="2">Tudo</option>
                </select>
            </div>
            <input type="text" id="pesq" placeholder="Pesquisar por Nome" >
        </div>
        <div class="conteudo lista" id="lista">
        </div>
    </div>
    <form  class="modal" id="modal0" name="form" method="post">
        <div class="titulo"> <label id="nomedoaluno"></label>Motivos de Evasão de Curso</div>
        <div class="conteudo">
            <label>Motivo:</label>
            <label><input type="checkbox" id="m0" disabled="disabled"><span>Falta de conexão com o curso</span></label>
            <label><input type="checkbox" id="m1" disabled="disabled"><span>Desempenho acadêmico</span></label>
            <label><input type="checkbox" id="m2" disabled="disabled"><span>Dificuldades financeiras</span></label>
            <label><input type="checkbox" id="m3" disabled="disabled"><span>Localização da escola em relação à moradia </span></label>
            <label><input type="checkbox" id="m4" disabled="disabled"><span>Oportunidades de emprego</span></label>
            <label><input type="checkbox" id="m5" disabled="disabled"><span>Outros</span></label>
            <input type="hidden" name="motivos" id="motivos">
            <div id="isoutros">
                <label  class="eldados">Outros:</label>
                <textarea type="text" id="outros" readonly name="outros" onclick="document.getElementById('m5').checked = true" placeholder="Informe alguma observação"></textarea>
            </div>
        </div>
        <div class="footer">
            <div class="btngroup">
                <button type="button" class="direita2"  onclick="cancelar(0)">Voltar</button>
            </div>
        </div>
    </form>
    <form  class="modal" id="modal1">
        <div class="titulo"> <label id="nomedoaluno"></label>Relatório de Evasão</div>
        <div class="conteudo">
            <div id="chart"></div>
        </div>
        <div class="footer">
            <div class="btngroup">
                <button type="button" class="direita2"  onclick="cancelar(1)">Voltar</button>
            </div>
        </div>
    </form>
<script src="../js/apexcharts.min.js"></script>
<script src="../js/rel/evad.js"></script>
    <?php
        require_once("footer.php");
    ?>