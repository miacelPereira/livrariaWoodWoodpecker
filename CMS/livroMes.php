<?php 
    require_once("header.php");
    require_once("../functionsPHP/conexaoDB.php");
    
    $db = conexaoBD();
    /* select para o objeto select */
    $selectGeral = "select tbl_livro.*, tbl_autor.nomeAutor from tbl_livro, tbl_autor where tbl_livro.idAutor = tbl_autor.idAutor";
    $selectGeralDB = mysqli_query($db, $selectGeral);

/***************************************************************************************************/
    /* ATIVAR E DESATIVAR UM LIVRO */
    if(isset($_GET['ativado'])){
        $idLivro = $_GET['id'];
        $modo = $_GET['ativado'];
        
        if($modo == "ativar"){
            $updateLivro = "update tbl_livro set livroMes = 1 where idLivro = ".$idLivro;
            $selectGeralDB = mysqli_query($db, $updateLivro);
            $updateGeral = "update tbl_livro set livroMes = 0 where idLivro != ".$idLivro;
            $selectGeralDB = mysqli_query($db, $updateGeral);
            header('location:livroMes.php');
            
        }
    }
?>
<setion id="alter_cms">
    <!-- Parte de alterar conteudos do site -->
    <div id="admConteudo">
        <nav id="nav_alter_cms">
            <a href="livroMes.php"> <div class="item_menu_alter_cms"> Livro do mês </div></a>
            <a href="autorMes.php"><div class="item_menu_alter_cms"> Autor em destaque </div></a>
            <a href="nossasLojas.php"><div class="item_menu_alter_cms"> Nossas lojas </div></a>
            <a href="sobre.php"><div class="item_menu_alter_cms"> Sobre </div></a>
            <a href="promocao.php"><div class="item_menu_alter_cms"> Promoção </div></a>
        </nav>
    <div id="alter_conteudo">
        <h1 id="titleLivroMesEdit"> Livro do Mês</h1>
        <form action="alterarConteudo.php" name="frmLivros" method="get">
            <div id="containertbllivro">
                <table id="tableLivroMes">
                    <tr id="titleTableLivroMes">
                        <td id="firtsTitleTableLivroMes">Nome</td>
                        <td>Autor</td>
                        <td>Preço</td>
                        <td id="ultimoTitleTableLivroMes">Ativar</td>
                    </tr>
                    <?php while($rsLivros = mysqli_fetch_array($selectGeralDB)) { ?>
                    <tr class="lineTableLivroMes">
                        <td> <?php echo($rsLivros['nomeLivro'])?> </td>
                        <td> <?php echo($rsLivros['nomeAutor'])?> </td>
                        <td> <?php echo($rsLivros['precoLivro'])?> </td>
                        <td>
                            <?php 
                                if($rsLivros["livroMes"] == 0){?>
                                 <a href="livroMes.php?id=<?php echo($rsLivros['idLivro'])?>&ativado=ativar"> <img src="image/desativado.png" style="width: 20px; height: 20px;"></a>
                            <?php
                                }else{?>
                            <a href="livroMes.php?id=<?php echo($rsLivros['idLivro'])?>&ativado=desativar"><img src="image/ativado.png" style="width: 20px; height: 20px;"></a>
                                <?php }
                            ?>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </form>
    </div>
    </div>
</setion>
<?php 
    require_once("footer.php");
?>