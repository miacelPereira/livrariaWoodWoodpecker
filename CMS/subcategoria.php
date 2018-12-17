<div id="containerModalSubCat">
    <div id="containerAuxSubCat">
        <div id="closeModalSubCat"></div>
        <div id="contentModalSubCat"></div>
    </div>
</div>
<?php
    require_once('../functionsPHP/conexaoDB.php');
    require_once('header.php');

    $db = conexaoBD();
    
    /* CATEGORIAS */
    $stringCat = "select * from tbl_categoria_produto";
    $categorias = mysqli_query($db, $stringCat);

    /* SUBCATEGORIAS */
    $stringSubCat = "select tbl_subcategoria_produto.*, tbl_categoria_produto.nome_categoria from tbl_subcategoria_produto, tbl_categoria_produto where tbl_subcategoria_produto.id_categoria = tbl_categoria_produto.id_categoria";
    $subCategorias = mysqli_query($db, $stringSubCat);

    /* SALVANDO UMA SUBCATEGORIA */
    if(isset($_POST['btnAddSub'])){
        $idCatAdd = $_POST['sltCategoriaAddSub'];
        $nomeSubAdd = $_POST['txtNomeSub'];
        
        $insertSub = "insert into tbl_subcategoria_produto (nome_subcategoria, id_categoria, status_subcategoria) values ('".$nomeSubAdd."', '".$idCatAdd."', 1)";
        mysqli_query($db, $insertSub);
        header('location:subcategoria.php');
    }

    /* EXCLUINDO OU ATIVANDO UMA SUBCATEGORIA */
    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        $idSub = $_GET['id'];
        if($modo == "excluir"){
            $deleteSub = "delete from tbl_subcategoria_produto where id_subcategoria = ".$idSub;
            $sltLivro =  "select * from tbl_livro where id_subcategoria = ".$idSub;
            $controlLivro = mysqli_query($db, $sltLivro);
            if(!mysqli_query($db, $deleteSub)){
                echo("<script> alert('Não é possível apagar essa subcategoria pois ela está sendo utilizada por um livro.') </script>");
            }else{
                header('location:subcategoria.php');
            }
        }
        if(isset($_GET['ativado'])){
            $control = $_GET['ativado'];
            if($control == 0){
                $statusSub = "update tbl_subcategoria_produto set status_subcategoria = 1 where id_subcategoria = ".$idSub;
            }else{
                $statusSub = "update tbl_subcategoria_produto set status_subcategoria = 0 where id_subcategoria = ".$idSub;
            }
            mysqli_query($db, $statusSub);
            header('location:subcategoria.php');
        }
    }

    /* UPDATE DA SUBCATEGORIA */
    if(isset($_POST['btnEditSubCat'])){
        $idSubCat = $_GET['idSub'];
        $idCat = $_POST['sltCatEditSub'];
        $nomeSub = $_POST['txtSubCatEdit'];
        
        $updateSubCat = "update tbl_subcategoria_produto set nome_subcategoria = '".$nomeSub."', id_categoria = '".$idCat."' where id_subcategoria = ".$idSubCat;
        mysqli_query($db, $updateSubCat);
        header('location:subcategoria.php');
    }

   
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
            <h1 class="titleSubCat"> Adicionar subcategoria</h1>
            <form name="fmrSubcatAdd" method="post" action="subcategoria.php">
                <table id="tblAddSubCategoria">
                    <tr>
                        <td class="tblLineAddSub">Nome da categoria que ela pertence: </td>
                        <td class="tblLineAddSub">
                            <select name="sltCategoriaAddSub">
                                <?php while($rsCat = mysqli_fetch_array($categorias)){ ?>
                                    <option value="<?php echo($rsCat['id_categoria'])?>"><?php echo($rsCat['nome_categoria'])?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td class="tblLineAddSub">Nome da nova subcategoria:</td>
                        <td class="tblLineAddSub"> <input type="text" name="txtNomeSub" id="txtAddSubCat"> </td>
                    </tr>
                </table>
                <input type="submit" name="btnAddSub" id="btnAddSub" value="Salvar">
            </form>
            <h1  class="titleSubCat"> Configurações de subcategorias </h1>
            <div id="containerSubADDTable">
                <table id="viewSubCat"> 
                    <tr class="titleViewSubCat"> 
                        <td id="firtsTitleTableLivroMes">Nome</td>
                        <td>Categoria</td>
                        <td colspan="3" id="ultimoTitleTableLivroMes">Opções</td>
                    </tr>
                    <?php while($rsSub = mysqli_fetch_array($subCategorias)){ ?>
                        <tr class="lineViewSubCateTbl">
                            <td> <?php echo($rsSub['nome_subcategoria']) ?> </td>
                            <td> <?php echo($rsSub['nome_categoria']) ?> </td>
                            <td> <a href="subcategoria.php?modo=excluir&id=<?php echo($rsSub['id_subcategoria']) ?>"> <img src="image/deletar.png" title="Excluir" class="imgSubCat"> </a> </td>

                            <td> <a href="subcategoria.php?modo=ativar&id=<?php echo($rsSub['id_subcategoria']) ?>&ativado=<?php echo($rsSub['status_subcategoria']) ?>"> 
                                <?php  
                                    if($rsSub['status_subcategoria'] == 1){ ?>
                                        <img src="image/ativado.png" title="Desativar" class="imgSubCat">
                                    <?php }else{ ?>
                                        <img src="image/desativado.png" title="Ativar" class="imgSubCat">
                                    <?php } ?> </a> </td>

                            <td> <a href="#" class="editSubCat" onclick="openModalEditSubCat(<?php echo($rsSub['id_subcategoria']) ?>)"> <img src="image/editar.png" title="Editar" class="imgSubCat"> </a> </td>
                        </tr>
                    <?php }?>
                </table>
            </div>
        </div>
    </div>
</setion>
<?php
    require_once('footer.php');
?>
