<?php
    require_once("header.php");
?>
<link rel="stylesheet" href="../css/baselist.css">
<link rel="stylesheet" href="../css/modal.css">
<link rel="stylesheet" href="../css/relfin.css">
</head>
<body class="central" onload="init()">
    <?php
        require_once("nav.php");
    ?>
    <button type="button" class="pdfgen2" onclick="gerarGrafico()">Gerar Gráfico</button>
    <button type="button" class="pdfgen" onclick="gerarPdf()">Gerar Pdf</button>
    <div class="box">
        <div class="titulo">Relatório Financeiro</div>
        <div class="pesq" id="pesq2">
            <div>
                De:
                <input type="date" id="d1" onchange="pesquisar()">
            </div>
            <div>
                Até:
                <input type="date" id="d2" onchange="pesquisar()">
            </div>
            <div>
                Filtro:
                <select id="filtro"  onchange="pesquisar()">
                    <option value="0">Diário</option>
                    <option value="1">Mensal</option>
                    <option value="2">Anual</option>
                </select>
            </div>
        </div>
        <div class="conteudo lista">
            <table>
                <tbody id="lista" ></tbody>
            </table>
        </div>
    </div>
    <form  class="modal" id="modal" name="form" method="post">
        <div class="titulo"> <label id="nomedoaluno"></label>Grafico</div>
        <div class="conteudo">
            <div id="chart"></div>
        </div>
        <div class="footer">
            <div class="btngroup">
                <a type="button"  class="direita2" onclick="cancelar()">Fechar</a>
            </div>
        </div>
    </form>
    <script src="../js/apexcharts.min.js"></script>
    <script src="../js/rel/list.js"></script>
    <script src="../js/modal.js"></script>
    <?php
        require_once("footer.php");
    ?>