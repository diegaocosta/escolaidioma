<?php
    require_once("header.php");
?>
<link rel="stylesheet" href="../css/baselist.css">
<link rel="stylesheet" href="../css/basecad.css">
<link rel="stylesheet" href="../css/menslist.css">
</head>
<body class="central" onload="init()">
    <?php
        require_once("nav.php");
    ?>
    <div class="box">
        <div class="titulo">Mensalidades por Alunos</div>
        <div class="conteudo lista" id="lista">
       </div>
    </div>
    <script src="../js/modal.js"></script>
    <script src="../js/mens/list.js"></script>
    <?php
        require_once("footer.php");
    ?>