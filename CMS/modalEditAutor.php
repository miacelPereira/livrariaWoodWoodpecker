<?php 
    require_once("../functionsPHP/conexaoDB.php");
    $db = conexaoBD();

    if(isset($_GET['idAutor'])){
        $idAutor = $_GET['idAutor'];
        $sql = "select * from tbl_autor where idAutor = ".$idAutor;
        $select= mysqli_query($db, $sql);
        $rs = mysqli_fetch_array($select);
    }
?>
<html>
    <head>
        <style>
            body{
                text-align: center;
            }
            #tblEditAutor{
                width: 500px;
                margin:auto;
                text-align: center;
            }
            #tblEditAutor tr{
                height: 50px;
            }
            .txtEditAutor{
                border: none;
                width: 300px;
                border-bottom: 1px solid #4286f4;
                text-align: center;
            }
            #btnFrmEditAutor{
                width: 200px;
                height: 50px;
                border: none;
                font-size: 15px;
                border-radius: 8px;
                background-color: #415982;
                margin-left: 250px;
                margin-top: 50px;
                color: #ffffff;
            }
        </style>
    </head>
    <body>
        <h1> Editar informações do autor </h1>
        <form action="autorMes.php?idAutorEdit=<?php echo($rs['idAutor']); ?>&modo=editarAutor" method="post" enctype="multipart/form-data" name="frmEditAutor">
            <table id="tblEditAutor">
                <tr>
                    <td>Nome</td>
                    <td><input type="text" name="txtNomeEditAutor" class="txtEditAutor" value="<?php echo($rs['nomeAutor']) ?> " required="required" onkeypress=" return validar(event, 'num', this.id);" maxlength="60"></td>
                </tr>
                <tr>
                    <td>Gênero Literário</td>
                    <td><input type="text" name="txtGeneroEditAutor" class="txtEditAutor" value="<?php echo($rs['generoAutor']) ?>" required="required" onkeypress=" return validar(event, 'num', this.id);" maxlength="55"></td>
                </tr>
                <tr>
                    <td>Site</td>
                    <td><input type="text" name="txtSiteEditAutor" class="txtEditAutor" value="<?php echo($rs['siteAutor']) ?>" required="required" onkeypress=" return validar(event, 'num', this.id);" maxlength="255"></td>
                </tr>
                <tr>
                    <td>País onde nasceu</td>
                    <td><input type="text" name="txtPaisEditAutor" class="txtEditAutor" value="<?php echo($rs['paisAutor']) ?>" required="required" onkeypress=" return validar(event, 'num', this.id);" maxlength="25"></td>
                </tr>
                <tr>
                    <td>Imagem</td>
                    <td><input type="file" name="fleFotoEditAutor" class="txtEditAutorFile"></td>
                </tr>
                <tr>
                    <td>Descrição</td>
                    <td><textarea cols="40" rows="5" name="txtDescricaoEditAutor"  required="required"><?php echo($rs['descricaoAutor']) ?></textarea></td>
                </tr>
            </table>
            <input type="submit" name="btnFrmEditAutor" id="btnFrmEditAutor" value="Salvar Alteração">
        </form>
    </body>
</html>