<!-- Modal de Edit -->
<div id="containerModalEdit">
    <div id="auxModalEditLoja">
        <div id="closeModalEditLoja"> </div>
        <div id="contentModalEdit"> </div>
    </div>
</div>
<!-- Modal de view -->
<div id="containerModalViewLoja" >
    <div id="auxModalViewLoja">
        <div id="closeModalViewLoja"> </div> 
        <div id="contentModalViewLoja"> </div>
    </div>
    
</div>
<?php 
    require_once("header.php");
    require_once("../functionsPHP/conexaoDB.php");
    $db = conexaoBD();

    $sqlSelect = "select * from tbl_enderecoloja";
    $select = mysqli_query($db, $sqlSelect);
    

    if(isset($_GET["btnSalvarLoja"])){
        
        $logradouro = $_GET['txtLogradouro'];
        $nomeLogradouro = $_GET['txtNomeLogradouro'];
        $numero = $_GET['txtNumero'];
        $bairro = $_GET['txtBairro'];
        $cidade = $_GET['txtCidade'];
        $estado = $_GET['txtEstado'];
        
        $sql = "insert into tbl_enderecoloja (logradouroLoja, nomeLogradouro, bairroLoja, cidadeLoja, estadoLoja, numeroLoja, ativada) values ('".$logradouro."','".$nomeLogradouro."','".$bairro."','".$cidade."','".$estado."','".$numero."', 1)";
        mysqli_query($db, $sql);
        
        header("Location: nossasLojas.php");
    }
    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        $id = $_GET['id'];
        
        
        /*excluir*/
        if($modo == 'excluir'){
            $delete = "delete from tbl_enderecoloja where idLoja = ".$id;
            mysqli_query($db, $delete);
            header("Location: nossasLojas.php");
        }
    }
    /* editar Loja */
    if(isset($_GET['idEditLoja'])){
        $id = $_GET['idEditLoja'];
        $ativada = $_GET['ativado'];

        $logradouro = $_POST['txtEditLogradouro'];
        $nomeLogradouro = $_POST['txtEditNomeLogradouro'];
        $numero = $_POST['txtEditNumero'];
        $bairro = $_POST['txtEditBairro'];
        $cidade = $_POST['txtEditCidade'];
        $estado = $_POST['txtEditEstado'];

        $update = "update tbl_enderecoloja set logradouroLoja = '".$logradouro."', nomeLogradouro = '".$nomeLogradouro."', bairroLoja = '".$bairro."', cidadeLoja = '".$cidade."', estadoLoja = '".$estado."', numeroLoja = '".$numero."', ativada = '".$ativada."'";
        mysqli_query($db, $update);
        header("Location: nossasLojas.php");

    }
    /* Ativar e destaivar */
    if(isset($_GET['ativada'])){
        $idLoja = $_GET['id'];
        $modo = $_GET['ativada'];
        
        if($modo == "ativar"){
            $updateLoja = "update tbl_enderecoloja set ativada = 1 where idLoja = ".$idLoja;
        }else if($modo == "desativar"){
            $updateLoja = "update tbl_enderecoloja set ativada = 0 where idLoja = ".$idLoja;
        }
        mysqli_query($db, $updateLoja);
        header('location:nossasLojas.php');
    }
?>

<setion id="alter_cms">
    <!-- Parte de alterar conteudos do site -->
    <div id="admConteudo">
        <nav id="nav_alter_cms">
            <a href="livroMes.php"> <div class="item_menu_alter_cms"> Livro do mês </div></a>
            <a href="autorMes.php"><div class="item_menu_alter_cms"> Autor em destaque </div></a>
            <a href="nossasLojas.php"><div class="item_menu_alter_cms"> Nossas lojas </div></a>
            <a href="sobre.php"><div class="item_menu_alter_cms"> Sobre </div></a>
            <a href="promocao.php"><div class="item_menu_alter_cms"> Promoção </div></a>
        </nav>
        <div id="alter_conteudo">
            <h1 id="titleNossasLojas"> Nova livraria </h1>
            <form action="nossasLojas.php" name="frmNossasLojas" method="get">
                <table id="tblNossasLojas">
                    <tr>
                        <td>Logradouro</td>
                        <td> <input type="text" name="txtLogradouro" class="txtNovaLoja" required="required" onkeypress="return validar(event, 'num', this.id);" maxlength="10"> </td>
                        <td> Nome do logradouro </td>
                        <td> <input type="text" name="txtNomeLogradouro" class="txtNovaLoja" required="required" onkeypress="return validar(event, 'num', this.id);"  maxlength="40"> </td>
                        <td> Número </td>
                        <td> <input type="text" name="txtNumero" class="txtNovaLoja" required="required" maxlength="10"> </td>
                    </tr>
                    <tr>
                        <td> Bairro </td>
                        <td> <input type="text" name="txtBairro" class="txtNovaLoja" required="required" onkeypress="return validar(event, 'num', this.id);" maxlength="45"> </td>
                        <td> Cidade </td>
                        <td> <input type="text" name="txtCidade" class="txtNovaLoja" required="required" onkeypress="return validar(event, 'num', this.id);" maxlength="45"> </td>
                        <td> Estado </td>
                        <td> <input type="text" name="txtEstado" class="txtNovaLoja" required="required" onkeypress="return validar(event, 'num', this.id);" maxlength="45"> </td>
                    </tr>
                </table>    
                <input type="submit" value="Salvar" name="btnSalvarLoja" id="btnSalvarLoja">
            </form>
            <div id="containerTblLojas">
                <table id="tblNossasLojasView">
                    <tr id="titleTblNossasLojasView">
                        <td style="border-top-left-radius: 8px;"> Código </td>
                        <td> Cidade </td>
                        <td> Estado </td>
                        <td colspan="3"> Opções </td>
                        <td style="border-top-right-radius: 8px;"> Ativação </td>
                    </tr>
                    <?php while ($rs = mysqli_fetch_array($select)){ ?>
                    <tr class="lineTitleTblNossasLojasView">
                        <td> <?php echo($rs['idLoja']); ?> </td>
                        <td> <?php echo($rs['cidadeLoja']); ?> </td>
                        <td> <?php echo($rs['estadoLoja']); ?> </td>
                        <td> <a href="nossasLojas.php?modo=excluir&id=<?php echo($rs['idLoja'])?>"> <img src="image/deletar.png" title="Excluir" style="width: 20px; height: 20px;"> </a></td>
                        <td> <a href='#' onclick="modalEditLoja(<?php echo($rs['idLoja'])?>)" class="editLoja">  <img src="image/editar.png" title="Editar" style="width: 20px; height: 20px;"> </a> </td>
                        <td> <a href='#' onclick="modalViewLoja(<?php echo($rs['idLoja'])?>)" class="viewLoja"> <img src="image/visualizar.png" title="Visualizar" style="width: 20px; height: 20px;"> </a> </td>
                        <td>
                            <?php 
                                if($rs["ativada"] == 0){?>
                                 <a href="nossasLojas.php?id=<?php echo($rs['idLoja'])?>&ativada=ativar"> <img src="image/desativado.png" style="width: 20px; height: 20px;"></a>
                            <?php
                                }else{?>
                            <a href="nossasLojas.php?id=<?php echo($rs['idLoja'])?>&ativada=desativar"><img src="image/ativado.png" style="width: 20px; height: 20px;"></a>
                                <?php }
                            ?>

                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</setion>
<?php 
    require_once("footer.php");
?>