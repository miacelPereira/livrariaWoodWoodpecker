<?php 
    require_once("../functionsPHP/conexaoDB.php");
    $db = conexaoBD();

    if(isset($_GET['idLivro'])){
        
        $idLivro= $_GET['idLivro'];
        
        $sql="select tbl_livro.*, tbl_livropromocao.valor from tbl_livro, tbl_livropromocao where tbl_livro.idLivro = ".$idLivro;

        $select = mysqli_query($db, $sql);
        $rs = mysqli_fetch_array($select);
        
    }

?>
<html>
    <head>
        <meta charset="utf-8">
        <style>
            body{
                text-align: center;
            }
            h1{
                text-align: center;
            }
            table{
                width: 400px;
                text-align: center;
                margin: auto;
            }
            table tr{
                height: 50px;
            }
            #trImagem{
                height: 100px;
            }
            #btnEditPromo{
                width: 150px;
                height: 40px;
                border: none;
                border-radius: 8px;
                background-color: #415982;
                color: #ffffff;
                margin-top: 40px;
            }
            img{
                width: 80px;
                height: 100px;
            }
            #txtNovoDesconto{
                border: none;
                border-bottom: 1px solid #4286f4;
                text-align: center;
                width: 100px;
            }
        </style>
    
    </head>
    <body>
        <h1> Editar Promoção </h1>
        <form name="frmEditPromo" action="promocao.php?idLivro=<?php echo($idLivro); ?>&modo=editar" method="post">
            <table>
                <tr>
                    <td>Nome do Livro</td>
                    <td> <?php echo($rs['nomeLivro']) ?> </td>
                </tr>
                <tr id="trImagem">
                    <td>Capa</td>
                    <td> <img src="../<?php echo($rs['imagemLivro']) ?>"> </td>
                </tr>
                <tr>
                    <td>Preço</td>
                    <td> <?php echo($rs['precoLivro']) ?> </td>
                </tr>
                <tr>
                    <td>Preço da Promoção</td>
                    <td> <?php echo($rs['valor']) ?> </td>
                </tr>
                <tr>
                    <td>Alterar porcentagem de desconto</td>
                    <td> <input type="text" name="txtNovoDesconto" id="txtNovoDesconto"  required="required" onkeypress=" return validar(event, 'txt', this.id);" maxlength="2"> </td>
                </tr>
            </table>
        <input type="submit" name="btnEditPromo" id="btnEditPromo" value="Salvar">
        </form>
    </body>


</html>