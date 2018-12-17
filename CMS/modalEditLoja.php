<?php 
    require_once("../functionsPHP/conexaoDB.php");
    $db = conexaoBD();

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        
        $sql = "select * from tbl_enderecoloja where idLoja = ".$id;
        $select = mysqli_query($db, $sql);
        $rs = mysqli_fetch_array($select);
    }
?>
<html>
    <head>
        <style>
            body{
                text-align: center;
            }
            #tblEditLoja{
                width: 400px;
                height: 300px;
                margin: auto;
                text-align: center;
            }
            #tblEditLoja input{
                text-align: center;
                width: 200px;
                height: 30px;
                border: none;
                border-bottom: 1px solid #2359af;
                
            }
            #tblEditLoja tr{
                line-height: 50px;
            }
            #btnEditLoja{
                width: 150px;
                height: 50px;
                border: none;
                border-radius: 8px;
                color: #ffffff;
                background-color: #415982;
            }
            #btnEditLoja:hover{
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <h1> Editar Loja </h1>
        <form action="nossasLojas.php?idEditLoja=<?php echo($id)?>&ativado=<?php echo($rs['ativada'])?>" method="post" name="frmEditLoja">
            <table id="tblEditLoja">
                <tr>
                    <td>Logradouro</td>
                    <td> <input type="text" name="txtEditLogradouro" value="<?php echo($rs['logradouroLoja'])?>" required="required" onkeypress=" return validar(event, 'num', this.id);" maxlength="10" > </td>
                </tr>
                <tr>
                    <td>Nome Logradouro</td>
                    <td><input type="text" name="txtEditNomeLogradouro" value="<?php echo($rs['nomeLogradouro'])?>" required="required" onkeypress=" return validar(event, 'num', this.id);" maxlength="40"></td>
                </tr>
                <tr>
                    <td> Número </td>
                    <td><input type="text" name="txtEditNumero" value="<?php echo($rs['numeroLoja'])?>" required="required" maxlength="10"></td>
                </tr>
                <tr>
                    <td> Bairro </td>
                    <td><input type="text" name="txtEditBairro" value="<?php echo($rs['bairroLoja'])?>" required="required" onkeypress=" return validar(event, 'num', this.id);" maxlength="45"></td>
                </tr>
                <tr>
                    <td> Cidade </td>
                    <td><input type="text" name="txtEditCidade" value="<?php echo($rs['cidadeLoja'])?>" required="required" onkeypress=" return validar(event, 'num', this.id);" maxlength="45"></td>
                </tr>
                <tr>
                    <td> Estado </td>
                    <td><input type="text" name="txtEditEstado" value="<?php echo($rs['estadoLoja'])?>" required="required" onkeypress=" return validar(event, 'num', this.id);" maxlength="45"></td>
                </tr>
            </table>
            <input type=submit name="btnEditLoja" id="btnEditLoja">
        </form>
    </body>
</html>