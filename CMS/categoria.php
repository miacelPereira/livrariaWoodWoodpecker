<div id="containerModalCat">
    <div id="containerAuxCat">
        <div id="closeModalCat"></div>
        <div id="contentModalCat"></div>
    </div>
</div>
<?php
    require_once('../functionsPHP/conexaoDB.php');
    require_once('header.php');

    $db = conexaoBD();
    
    /* CATEGORIAS */
    $stringCat = "select * from tbl_categoria_produto";
    $categorias = mysqli_query($db, $stringCat);

    /* SALVANDO UMA CATEGORIA */
    if(isset($_POST['btnAddCat'])){
        $nomeCatAdd = $_POST['txtNomeCat'];
        
        $insertCat = "insert into tbl_categoria_produto (nome_categoria, status_categoria) values ('".$nomeCatAdd."', 1)";
        mysqli_query($db, $insertCat);
        header('location:categoria.php');
    }

    /* EXCLUINDO OU ATIVANDO UMA CATEGORIA */
    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        $id = $_GET['id'];
        if($modo == "excluir"){
            $deleteSub = "delete from tbl_categoria_produto where id_categoria = ".$id;
            $sltSub =  "select * from tbl_subcategoria_produto where id_categoria = ".$id;
            $controlSub = mysqli_query($db, $sltSub);
            if(!mysqli_query($db, $deleteSub)){
                echo("<script> alert('Não é possível apagar essa categoria pois ela está sendo utilizada por uma subcategoria.') </script>");
            }else{
                header('location:categoria.php');
            }
        }
        if(isset($_GET['ativado'])){
            $control = $_GET['ativado'];
            if($control == 0){
                $statusSub = "update tbl_categoria_produto set status_categoria = 1 where id_categoria = ".$id;
            }else{
                $statusSub = "update tbl_categoria_produto set status_categoria = 0 where id_categoria = ".$id;
            }
            mysqli_query($db, $statusSub);
            header('location:categoria.php');
        }
    }

    /* UPDATE DA SUBCATEGORIA */
    if(isset($_POST['btnEditCat'])){
        $idCat = $_GET['id'];
        $nome = $_POST['txtCatEdit'];
        
        $updateCat = "update tbl_categoria_produto set nome_categoria = '".$nome."' where id_categoria = ".$idCat;
        mysqli_query($db, $updateCat);
        header('location:categoria.php');
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
            <h1 class="titleSubCat"> Adicionar categoria</h1>
            <form name="fmrSubcatAdd" method="post" action="categoria.php">
                <table id="tblAddSubCategoria">
                    <tr>
                        <td class="tblLineAddSub">Nome da nova categoria:</td>
                        <td class="tblLineAddSub"> <input type="text" name="txtNomeCat" id="txtAddCat"> </td>
                    </tr>
                </table>
                <input type="submit" name="btnAddCat" id="btnAddSub" value="Salvar">
            </form>
            <h1  class="titleSubCat"> Configurações de categorias </h1>
            <div id="containerSubADDTable">
                <table id="viewSubCat"> 
                    <tr class="titleViewSubCat"> 
                        <td id="firtsTitleTableLivroMes">Nome</td>
                        <td colspan="3" id="ultimoTitleTableLivroMes">Opções</td>
                    </tr>
                    <?php while($rsSub = mysqli_fetch_array($categorias)){ ?>
                        <tr class="lineViewSubCateTbl">
                            <td> <?php echo($rsSub['nome_categoria']) ?> </td>
                            <td> <a href="categoria.php?modo=excluir&id=<?php echo($rsSub['id_categoria']) ?>"> <img src="image/deletar.png" title="Excluir" class="imgSubCat"> </a> </td>

                            <td> <a href="categoria.php?modo=ativar&id=<?php echo($rsSub['id_categoria']) ?>&ativado=<?php echo($rsSub['status_categoria']) ?>"> 
                                <?php  
                                    if($rsSub['status_categoria'] == 1){ ?>
                                        <img src="image/ativado.png" title="Desativar" class="imgSubCat">
                                    <?php }else{ ?>
                                        <img src="image/desativado.png" title="Ativar" class="imgSubCat">
                                    <?php } ?> </a> </td>

                            <td> <a href="#" class="editCat" onclick="openModalEditCat(<?php echo($rsSub['id_categoria']) ?>)"> <img src="image/editar.png" title="Editar" class="imgSubCat"> </a> </td>
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
