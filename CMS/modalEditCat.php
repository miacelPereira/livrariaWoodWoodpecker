<?php  

    require_once('../functionsPHP/conexaoDB.php');
    $db = conexaoBD();

    $idCat = $_GET['idCat'];
    
    /* SELECT NA TABELA DE CATEGORIA */  
    $string = "select * from tbl_categoria_produto where id_categoria = ".$idCat;
    $subCat = mysqli_query($db, $string);
    $rs = mysqli_fetch_array($subCat);

?>
<html>
    <head></head>
    <body>
        <h1> Editar categoria </h1>
        <form name="frmEditSubCat" action="categoria.php?id=<?php echo($rs['id_categoria']) ?>" method="post">
            <table>
                <tr>
                    <td>
                        Nome da Categoria:
                    </td>
                    <td>
                        <input type="text" name="txtCatEdit" id="txtCatEdit" value="<?php echo($rs['nome_categoria']) ?>">
                    </td>
                </tr>
            </table>
            <input type="submit" name="btnEditCat" id="btnEditSubCat" value="Editar">
        </form>
    
    </body>
</html>