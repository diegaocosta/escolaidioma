<?php
    require_once("header.php");
?>
<link rel="stylesheet" href="../css/basecad.css">
<link rel="stylesheet" href="../css/menscad.css">
</head>
<body class="central" onload="init()">
    <?php
        require_once("nav.php");
    ?>
    <form action="../api/mens/cad.php" method="post" name="form" class="box">
        <div class="titulo">Cadastrar Mensalidade</div>
        <div class="conteudo" id="mens">
            <div class="size1 sizes">
                <div>                    
                    <label >Aluno:</label>
                    <input type="text" readonly id="alunonome">
                </div>  
            </div>  
            <div class="size1 sizes">
                <div>                    
                    <label >Nome:</label>
                    <input type="text" id="nome" readonly name="nome" placeholder="Informe o nome">
                </div>
            </div>
            <div class="size2 sizes">
                <div>                    
                    <label >Curso:</label>
                    <input type="text" readonly id="cursonome" >
                </div>
                <div>                    
                    <label >Valor:</label>
                    <input type="text" readonly id="cursovalor" >
                </div>
            </div>
            <div class="size3 sizes">
                <div>                    
                    <label >Data:</label>
                    <input readonly type="date" id="data" name="data">
                </div>
                <div>                    
                    <label >Desconto:</label>
                    <input value="0" type="text" onkeyup="checarDesconto()" maxlength="8" id="desconto" name="desconto">
                </div>
                <div>                    
                    <label >Forma do Desconto:</label>
                    <select id="percent" name="percent"  onchange="checarDesconto()">
                        <option value="0">Decimal</option>
                        <option value="1">porcentagem</option>
                    </select>
                </div>
            </div>
            <div class="size3 sizes">
                <div>                    
                    <label >Total:</label>
                    <input type="text" readonly maxlength="8" id="valororiginal" name="valororiginal">
                </div>
                <div>                    
                    <label >Total com Desconto:</label>
                    <input type="text" maxlength="8" id="valor" name="valor">
                </div>
                <div>                    
                    <label >Valor Pago:</label>
                    <input type="text" onkeyup="checarPago()" maxlength="8" id="pago" name="pago">
                </div>
            </div>
            <div class="size2 sizes">
                <div>                    
                    <label >Mês:</label>
                    <select disabled="disabled" name="mes" id="mes"></select>
                </div>
                <div>                    
                    <label >Ano:</label>
                    <input readonly type="text" id="ano" name="ano">
                </div>
            </div>
            <div class="size1 sizes">
                <div>
                    <label >Observação:</label>
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
<script src="../js/mens/cad.js"></script>
    <?php
        require_once("footer.php");
    ?>