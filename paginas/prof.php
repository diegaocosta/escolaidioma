
    <ul>
        <li class="menu1" onclick="showmenu('turma')">
            <label >Turma</label>
            <ul class="menu2"  id="turma">
                <?php
                    if ($r <= 1)
                        echo '<li>
                            <a href="turmaList.php">Listar</a>
                        </li>
                        <li>
                            <a href="turmaCad.php">Cadastrar</a>
                        </li>'; 
                    else
                    {
                        echo "<script>let usernome = '" . $_SESSION["login"] . "'</script>";
                        echo '<li>
                            <a href="turmaProList.php">Listar</a>
                        </li>'; 
                    }

                ?>
            </ul>
        </li>
    </ul>