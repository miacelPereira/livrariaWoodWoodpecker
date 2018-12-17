<?php
    require_once('../functionsPHP/conexaoDB.php');
    $conexaoModal = conexaoBD();

    $id = $_GET['idRegistro'];

    $sql = "select * from tbl_fale_conosco where id=".$id;
    
    $select = mysqli_query($conexaoModal, $sql);

    if($rs=mysqli_fetch_array($select)){
        $nome = $rs['nomeContato'];
        $email = $rs['emailContato'];
        $sexo = $rs['sexoContato'];
        $profissao = $rs['profissaoContato'];
        $telefone = $rs['telefoneContato'];
        $celular = $rs['celularContato'];
        $homePage = $rs['homePageContato'];
        $contaFacebook = $rs['contaFacebookContato'];
        $sugestoes = $rs['critica_e_sugestaoContato'];
        $produto = $rs['infoProdutoContato'];
    }
    
?>

<html>
    <head>
        <style type="text/css">
            body{
                text-align: center;
            }
        </style>
    </head>
    <body>
        <h1 style="font-size: 25px"> Dados da mensagem </h1>
    <table  style="width: 800px; text-align:center; margin-top: 50px;">
        <tr style="height: 30px">
            <td> Nome: </td>
            <td> <?php echo($nome)?></td>
        </tr>
        <tr style="height: 30px">
            <td> Telefone </td>
            <td> <?php echo($telefone)?> </td>
        </tr>
        <tr style="height: 30px">
            <td> Celular </td>
            <td> <?php echo($celular)?> </td>
        </tr>
        <tr style="height: 30px">
            <td> E-mail </td>
            <td> <?php echo($email)?> </td>
        </tr>
        <tr style="height: 30px">
            <td> Home page </td>
            <td> <?php echo($homePage)?> </td>
        </tr>
        <tr style="height: 30px">
            <td> Link Facebook </td>
            <td> <?php echo($contaFacebook)?> </td>
        </tr>
        <tr style="height: 30px">
            <td> Sugestão/Críticas </td>
            <td> <?php echo($sugestoes)?> </td>
        </tr>
        <tr style="height: 30px">
            <td> Produto </td>
            <td> <?php echo($produto)?> </td>
        </tr>
        <tr style="height: 30px">
            <td> Sexo </td>
            <td><?php echo($sexo)?></td>
        </tr>
        <tr style="height: 30px">
            <td> Profissão </td>
            <td><?php echo($profissao)?></td>
        </tr>
    </table>
    </body>
</html>