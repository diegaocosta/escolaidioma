<?php
    require_once("header.php");
?>
<link rel="stylesheet" href="../css/basecad.css">
<link rel="stylesheet" href="../css/turmaver.css">
<link rel="stylesheet" href="../css/mensver.css">
</head>
<body class="central" onload="init()">
    <?php
        require_once("nav.php");
    ?>
    <form action="../api/mens/cad.php" method="post" name="form" class="box">
        <div class="titulo">Cosnultar Mensalidade</div>
        <div class="conteudo" id="mens">
            <div class="size1 sizes">
                <div>
                    <div>                    
                        <label >Aluno:</label>
                        <input type="text" readonly id="alunonome" name="alunonome">
                    </div>
                </div>
            </div>
            <div class="size2 sizes">
                <div>                    
                    <label >Total:</label>
                    <input type="text" readonly maxlength="8" id="valororiginal" name="valororiginal">
                </div>
                <div>                    
                    <label >Situação:</label>
                    <input readonly type="text" id="status" name="status">
                </div>
            </div>
            <div class="size3 sizes">
                <div>                    
                    <label >Total com Descontos:</label>
                    <input type="text" readonly maxlength="8" id="valor" name="valor">
                </div>
                <div>                    
                    <label >Faltando:</label>
                    <input type="text" readonly id="faltando" name="faltando">
                </div>
                <div>                    
                    <label >Pagado:</label>
                    <input type="text" readonly id="pagado" name="pagado">
                </div>
            </div>
            <div class="size2 sizes">
                <div>                    
                    <label >Mês:</label>
                    <select name="mes" readonly id="mes"></select>
                </div>
                <div>                    
                    <label >Ano:</label>
                    <input readonly type="text" id="ano" name="ano">
                </div>
            </div>
            <div class="size1 sizes">
                <div>
                    <label >Observação:</label>
                    <textarea type="text" readonly id="obs" name="obs" placeholder="Informe alguma observação"></textarea>
                </div>
            </div>
            <div class="size1 sizes">
                <div>
                    <div class="th">Pagamentos</div>
                    <div id="lista">
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="btngrupo">
        <button type="button" onclick="voltar()">Voltar</button>
        <button type="button" class="direita2" onclick="ver()">Pagar</button>
        <!-- <input class="direita2"  type="submit" value="Logar"> -->
    </div>
<script src="../js/validadores.js"></script>
<script src="../js/mask.js"></script>
<script src="../js/mens/ver.js"></script>
    <?php
        require_once("footer.php");
    ?>