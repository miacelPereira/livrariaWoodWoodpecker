<?php
    require_once('../functionsPHP/conexaoDB.php');
    require_once('header.php');

    $db = conexaoBD();

    /* Select para saber o total de click */
    $clicks = "select * from vw_somaclicks";
    $sql = mysqli_query($db, $clicks);
    $total = mysqli_fetch_array($sql);
    $total = $total['sum(clickHome)'];
    
    /* Selects no livros */
    $stringLivro = "select * from tbl_livro order by clickHome DESC LIMIT 5";
    $sqlLivro = mysqli_query($db, $stringLivro);    
    
?>
<setion id="alter_cms">
    <!-- Parte de alterar conteudos do site -->
    <div id="admConteudo">
        <nav id="nav_alter_cms">
            <a href="listlivros.php"><div class="item_menu_alter_cms">  Lista de produtos </div></a>
            <a href="insertLivro.php"> <div class="item_menu_alter_cms"> Adicionar Livro</div></a>
            <a href="estatistica.php"> <div class="item_menu_alter_cms"> Estatisticas </div></a>
            <a href="categoria.php"><div class="item_menu_alter_cms"> Categorias </div></a>
            <a href="subcategoria.php"><div class="item_menu_alter_cms"> Subcategorias  </div></a>
        </nav>
        <div id="alter_conteudo">
            <h1 id="titleGrafic"> Mapa de Livros lidos </h1>
            <div id="graficoClick">
                <!-- Porcentagem -->
                <table>
                    <?php while($rs = mysqli_fetch_array($sqlLivro)){ 
                        $aux = ($rs['clickHome']*100)/$total;
                    ?>
                    <tr>
                        <td id="nomeLivroEsta"><?php echo($rs['nomeLivro']) ?></td>
                        <td id="porcentagemLivroEsta"> <div class="dadosGraficos" style="width: <?php echo($aux) ?>%"> <?php echo($aux) ?>%</div></td>
                    <?php } ?>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</setion>
<?php
    require_once('footer.php');
?>
