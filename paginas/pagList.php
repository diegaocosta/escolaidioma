<?php
    require_once("header.php");
?>
<link rel="stylesheet" href="../css/baselist.css">
<link rel="stylesheet" href="../css/alunolist.css">
<link rel="stylesheet" href="../css/paglist.css">
</head>
<body class="central" onload="init()">
    <?php
        require_once("nav.php");
    ?>
    <div class="box">
        <div class="titulo">Pagamentos Feitos</div>
        <div class="pesq">
            <div id="pesqname">
                Aluno: 
            </div>
            <input type="text" id="alunonome" >
        </div>
        <div class="conteudo lista size5 sizes" id="lista">
        </div>
    </div>
<script src="../js/pag/list.js"></script>
    <?php
        require_once("footer.php");
    ?>