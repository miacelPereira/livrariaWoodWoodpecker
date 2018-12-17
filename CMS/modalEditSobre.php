<?php 
    require_once("../functionsPHP/conexaoDB.php");
    $db = conexaoBD();
    
    if(isset($_GET['idSobre'])){
        $id = $_GET['idSobre'];
        
        $select = "select * from tbl_sobrewood where idSobre = '".$id."'";
        $sql = mysqli_query($db, $select);
        $rs = mysqli_fetch_array($sql);
    }
?>
<html>
    <head>
        <style>
            body{
                text-align: center;
            }
            table{
                width: 400px;
                margin-left: 200px;
                text-align: center;
            }
            tr{
                height: 65px;
            }
            .txtEditSobre{
                text-align: center;
                width: 300px;
                border: none;
                border-bottom: 1px solid #4286f4;
                
            }
            #btnEditSobre{
                width: 150px;
                height: 40px;
                border: none;
                border-radius: 8px;
                background-color: #415982;
                color: #ffffff;
            }
            #btnEditSobre:hover{
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <h1> Editar informações sobre </h1>
        <form name="frmEditSobre" action="sobre.php?idSobre=<?php echo($id) ?>&modo=editar" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Título</td>
                    <td><input type="text" name="txtTituloEditSobre" class="txtEditSobre" value="<?php echo($rs['tituloSobre']) ?>" required="required" onkeypress=" return validar(event, 'num', this.id);" maxlength="45"> </td>
                </tr>
                <tr>
                    <td>Imagem</td>
                    <td><input type="file" name="fleFotoEditSobre" required="required"> </td>
                </tr>
                <tr>
                    <td>Descrição</td>
                    <td><textarea name="txtDescricaoEditSobre" rows="5" cols="40" required="required"> <?php echo($rs['descricaoSobre']) ?>"</textarea> </td>
                </tr>
                <tr>
                    <td>Nº vendas</td>
                    <td><input type="text" name="txtVendaEditSobre" class="txtEditSobre" value="<?php echo($rs['vendaSobre']) ?>" required="required" onkeypress=" return validar(event, 'txt', this.id);" maxlength="11"> </td>
                </tr>
                <tr>
                    <td>Nº funcionários</td>
                    <td><input type="text" name="txtFuncionarioEditSobre" class="txtEditSobre" value="<?php echo($rs['funcionarioSobre']) ?>" required="required" onkeypress=" return validar(event, 'txt', this.id);" maxlength="11"> </td>
                </tr>
                <tr>
                    <td>Tempo de Entrega</td>
                    <td><input type="text" name="txtTempoEditSobre" class="txtEditSobre" value="<?php echo($rs['tempoEntrega']) ?>" required="required" onkeypress=" return validar(event, 'txt', this.id);" maxlength="11"> </td>
                </tr>   
            </table>
            <input type="submit" name="btnEditSobre" id="btnEditSobre" value="Salvar">
        </form>
    </body>
</html>