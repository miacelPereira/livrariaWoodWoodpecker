<?php
    require_once("../functionsPHP/conexaoDB.php");
    $db = conexaoBD();
    $id = $_GET['id'];
    $sql = "select * from tbl_enderecoloja where idLoja = ".$id;
    $select = mysqli_query($db, $sql);
    $rs = mysqli_fetch_array($select);
?>
<html>
    <head>
        <style>
            body{
                text-align: center;
            }
            body table{
                width: 400px;
                height: auto;
                margin: auto;
                text-align: center;
                margin-top: 20px;
            }
            tr{
                height: 40px;
                border: 1px solid #000;
                line-height: 30px;
            }
            td{
                width: 150px;
                border: 1px solid #000;
            }
        </style>    
    </head>
    <body>
        <h1> Visualizar dados da Livraria <?php echo($rs['idLoja'])?></h1>
        <table>
            <tr>
                <td> Nº da livraria </td>
                <td class="resultViewLoja"> <?php echo($rs['idLoja'])?> </td>
            </tr>
            <tr>
                <td> Logradouro </td>
                <td class="resultViewLoja"> <?php echo($rs['logradouroLoja'])?> </td>
            </tr>
            <tr>
                <td> Nome do logradouro </td>
                <td class="resultViewLoja"> <?php echo($rs['nomeLogradouro'])?></td>
            </tr>
            <tr>
                <td> Número </td>
                <td class="resultViewLoja"> <?php echo($rs['numeroLoja'])?> </td>
            </tr>
            <tr>
                <td> Bairro </td>
                <td class="resultViewLoja"> <?php echo($rs['bairroLoja'])?> </td>
            </tr>
            <tr>
                <td> Cidade </td>
                <td class="resultViewLoja"> <?php echo($rs['cidadeLoja'])?> </td>
            </tr>
            <tr>
                <td> Estado </td>
                <td class="resultViewLoja"> <?php echo($rs['estadoLoja'])?> </td>
            </tr>
        </table>
    </body>
</html>