<div id="containerModalEditUser">
    <div id="modalEdituser">
        <div id="closeModal"> </div>
        <div id="contentModalEditUser"></div>
    </div>
</div>
<?php 
    require_once('header.php');
    require_once('../functionsPHP/conexaoDB.php');
    
    $db = conexaoBD();
/**************************************************************************************************************************************/

    /* SELECT USUARIO */
    $sqlSelect = "select tbl_usuario.*, tbl_niveisusuario.nivelUsuario from tbl_usuario, tbl_niveisusuario where tbl_usuario.tbl_niveisusuario_id_nivelUsuario = tbl_niveisusuario.id_nivelUsuario";
    $select = mysqli_query($db, $sqlSelect);
/**************************************************************************************************************************************/
    
    /*DELETE USUARIO*/
    if(isset($_GET['id']) && isset($_GET['modo'])){
        $id = $_GET['id'];
        $modo = $_GET['modo'];
        if($modo == 'excluir'){
            $sqlExcluir = "DELETE FROM tbl_usuario WHERE id=".$id;
            mysqli_query($db, $sqlExcluir);
            header('location:alteracaousuario.php');
            }
        }
/**************************************************************************************************************************************/

    /* UPDATE USUARIO */
    if(isset($_POST['btnFrmAlterUser'])){
        $idEdit = $_GET['idUserEdit'];
        $primeiroNome = $_POST['txtPrimeiroNomeEdit'];
        $ultimoNome = $_POST['txtUltimoNomeEdit'];
        $login = $_POST['txtLoginEdit'];
        $senha = $_POST['txtSenhaEdit'];
        $confSenha = $_POST['txtConfSenhaEdit'];
        $nivelEdit = $_POST['sltFrmEditUser'];
        
        if($senha == $confSenha){
            $stringUpdate = "update tbl_usuario set firstname_usuario = '".$primeiroNome."', lastname_usuario = '".$ultimoNome."', login_usuario = '".$login."', senha_usuario = '".$senha."', tbl_niveisusuario_id_nivelUsuario = '".$nivelEdit."' where id=".$idEdit;
            echo($stringUpdate);
            mysqli_query($db, $stringUpdate);
            header('location:alteracaousuario.php');
        }else{
            echo("Erro em salvar usuário, senhas incompativeis");
        }
    }
/**************************************************************************************************************************************/
     
    /* ATIVAR OU DESATIVAR USUARIO */
    if(isset($_GET['ativado'])){
        $ativacao = $_GET['ativado'];
        $idAtivação = $_GET['id'];
        if($ativacao == "ativar"){
            $updateAtivado = "update tbl_usuario set ativado = 1 where id=".$idAtivação;
            mysqli_query($db, $updateAtivado);
        }else if($ativacao == "desativar"){
            $updateAtivado = "update tbl_usuario set ativado = 0 where id=".$idAtivação;
            mysqli_query($db, $updateAtivado);
        }
        header('location:alteracaousuario.php'); 
    }
    

    
?>
<div id="admUsuario">
    <nav id="nav_alter_cms">
        <a href="adicionarUsuario.php"><div class="item_menu_alter_cms"> Adicionar </div></a>
        <a href="alteracaousuario.php"> <div class="item_menu_alter_cms"> Alterar </div> </a>
        <a href="nivelUsuario.php"><div class="item_menu_alter_cms"> Nível de usuário </div></a>
    </nav>
    <div id="alter_user">
        <h1 style="font-size: 28px; margin-top: 15px; margin-bottom: 15px;"> Alterar usuário </h1>
        <table id="table_editarUser">
            <tr id="lineTileTable_editarUser">
                <td style="border-top-left-radius: 8px;"> Nome </td>
                <td> Login </td>
                <td> Nível </td>
                <td colspan="2"> Opções </td>
                <td style="border-top-right-radius: 8px;"> Ativado </td>
            </tr>
            <?php while($rs = mysqli_fetch_array($select)){ ?>
            <tr class = "lineTable_editarUser">
                <td> <?php echo($rs['firstname_usuario'].' '.$rs['lastname_usuario'])?></td>
                <td> <?php echo($rs['login_usuario'])?></td>
                <td> <?php echo($rs['nivelUsuario'])?></td>
                <td><a href="#" class="editUsuario" onclick="modalEditUser(<?php echo($rs['id'])?>)"> <img src="image/editar.png" title="Editar" style="width: 20px; height: 20px;"> </a></td>
                <td><a href="alteracaousuario.php?id=<?php echo($rs['id'])?>&modo=excluir"> <img src="image/deletar.png" title="Excluir" style="width: 20px; height: 20px;"> </a></td>
                <td><?php 
                        if($rs["ativado"] == 0){?>
                         <a href="alteracaousuario.php?id=<?php echo($rs['id'])?>&ativado=ativar"> <img src="image/desativado.png" style="width: 20px; height: 20px;"></a>
                    <?php
                        }else{?>
                    <a href="alteracaousuario.php?id=<?php echo($rs['id'])?>&ativado=desativar"><img src="image/ativado.png" style="width: 20px; height: 20px;"></a>
                        <?php }
                    ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>
<?php require_once('footer.php'); ?>