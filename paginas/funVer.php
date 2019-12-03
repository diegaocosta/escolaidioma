<?php
    require_once("header.php");
?>
<title>Cadastrar Aluno</title>
<link rel="stylesheet" href="../css/basecad.css">
<link rel="stylesheet" href="../css/alunocad.css">
</head>
<body class="central" onload="init()">
    <?php
        require_once("nav.php");
    ?>
    <button type="button" class="pdfgen" onclick="gerarPdf()">Gerar Pdf</button>
    <form action="../api/fun/edit.php" method="post" name="form" class="box outrobox2">
        <div class="titulo">Consultar Funcionário</div>
        <div class="conteudo">
            <div class="size2 sizes">
                <div>
                    <label  class="eldados" >Nome:</label>
                    <input type="text" id="nome" name="nome" placeholder="Informe o nome">
                </div>
                <div>
                    <label  class="eldados" >Situação:</label>
                    <select name="status" id="status">
                        <option value="0">Desativado</option>
                        <option value="1">Ativado</option>
                    </select>
                </div>
            </div>
            <div class="size2 sizes">
                <div>
                    <label  class="eldados" >RG:</label>
                    <input type="text" id="rg" name="rg" placeholder="Informe o RG">
                </div>
                <div>
                    <label  class="eldados" >CPF:</label>
                    <input type="text" id="cpf" name="cpf" placeholder="Informe o CPF">
                </div>
            </div>
            <div class="size2 sizes">
                <div>
                    <label  class="eldados" >Telefone Fixo:</label>
                    <input type="text" id="telfixo" name="telfixo" placeholder="Informe o número de telefone">
                </div>
                <div>
                    <label  class="eldados" >Telefone Celular:</label>
                    <input type="text" id="telcel" name="telcel" placeholder="Informe o número de telefone">
                </div>
            </div>
            <div class="size2 sizes">
                <div>
                    <label  class="eldados" >Data de Nascimento:</label>
                    <input type="date" id="datanasc" name="datanasc" placeholder="Informe a data de nascimento">
                </div>
                <div>
                    <label  class="eldados" >CEP:</label>
                    <input type="text" id="cep" name="cep" placeholder="Informe o cep">
                </div>
            </div>
            <div class="size1 sizes">
                <div>
                    <label  class="eldados" >Endereco:</label>
                    <input type="text" id="endereco" name="endereco" placeholder="Informe o endereço">
                </div>
            </div>
            <div class="size2 sizes">
                <div>
                    <label  class="eldados" >Cidade:</label>
                    <input type="text" id="cidade" name="cidade" placeholder="Informe a cidade">
                </div>
                <div>
                    <label  class="eldados" >Estado:</label>
                    <select name="estado" id="estado"></select>
                </div>
            </div>
            <div class="size2 sizes">
                <div>
                    <label  class="eldados" >Bairro:</label>
                    <input type="text" id="bairro" name="bairro" placeholder="Informe o bairro">
                </div>
                <div>
                    <label  class="eldados" >Complemento:</label>
                    <input type="text" id="complemento" name="complemento" placeholder="Informe o complemento">
                </div>
            </div>
            <div class="size2 sizes">
                <div>
                    <label  class="eldados" >Cargo:</label>
                    <select name="cargo" id="cargo">
                        <option value="1">Secretária</option>
                        <option value="2">Professor</option>
                    </select>
                </div>
                <div>
                    <label  class="eldados" >Salário:</label>
                    <input type="text" id="salario" name="salario" maxlength="9" placeholder="Informe o salário">
                </div>
            </div>
            <div class="size1 sizes">
                <div>
                    <label  class="eldados" >Observação:</label>
                    <textarea type="text" id="obs" name="obs" placeholder="Informe alguma observação"></textarea>
                </div>
            </div>
        </div>
    </form>
    <div class="btngrupo">
        <button type="button" class="direita2" onclick="voltar()">Voltar</button>
        <!-- <button type="button" class="direita2" onclick="enviar()">Alterar</button> -->
        <!-- <input class="direita2"  type="submit" value="Logar"> -->
    </div>
<script src="../js/validadores.js"></script>
<script src="../js/mask.js"></script>
<script src="../js/fun/ver.js"></script>
    <?php
        require_once("footer.php");
    ?>