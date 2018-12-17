<?php  

    require_once('../functionsPHP/conexaoDB.php');
    $db = conexaoBD();

    $idSubCat = $_GET['idSubCat'];
    
    /* SELECT NA TABELA DE SUBCATEGORIA */  
    $string = "select tbl_subcategoria_produto.*, tbl_categoria_produto.nome_categoria from tbl_subcategoria_produto, tbl_categoria_produto where  tbl_categoria_produto.id_categoria = tbl_subcategoria_produto.id_categoria and tbl_subcategoria_produto.id_subcategoria = ".$idSubCat;
    $subCat = mysqli_query($db, $string);
    $rs = mysqli_fetch_array($subCat);

    /* SELECT NA TABELA DE CATEGORIA */
    $stringCat="select * from tbl_categoria_produto where id_categoria != ".$rs['id_categoria'];
    $cats = mysqli_query($db, $stringCat);
?>
<html>
    <head></head>
    <body>
        <h1> Editar subcategoria </h1>
        <form name="frmEditSubCat" action="subcategoria.php?idSub=<?php echo($rs['id_subcategoria']) ?>" method="post">
            <table>
                <tr>
                    <td>
                        Nome da Categoria:
                    </td>
                    <td>
                        <select name="sltCatEditSub">
                            <option value="<?php echo($rs['id_categoria']) ?>" selected="selected"><?php echo($rs['nome_categoria']) ?></option>
                            <?php while($rsCat = mysqli_fetch_array($cats)) { ?>
                                <option value="<?php echo($rsCat['id_categoria']) ?>"><?php echo($rsCat['nome_categoria']) ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Nome da subcategoria:
                    </td>
                    <td>
                        <input type="text" name="txtSubCatEdit" id="txtSubCatEdit" value="<?php echo($rs['nome_subcategoria']) ?>">
                    </td>
                </tr>
            </table>
            <input type="submit" name="btnEditSubCat" id="btnEditSubCat" value="Editar">
        </form>
    
    </body>
</html>