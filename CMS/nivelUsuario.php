<div id="modalNivelUsuario">
    <div id="contentModalNivelUsuario"> 
        <div id="closeModalUserAlter"> </div>
        <div id="contentCntentModalNivelUsuario"></div>
    </div>
</div>
<?php 
    require_once('header.php');?>   
<?php 
    require_once('../functionsPHP/conexaoDB.php');
    $conexao = conexaoBD();

    /* INSERT */
   if(isset($_POST['btnFrmnivelUsuario'])){
       $nomeNivel = $_POST['txtNomeNivelUsuario'];
       $sqlAddNivel = "INSERT INTO tbl_niveisusuario (nivelUsuario) values ('".$nomeNivel."')";
       mysqli_query($conexao, $sqlAddNivel);
   }
   
    
 /* UPDATE  NIVEL */
    if(isset($_POST['btnfrmEditar'])){
        $id = $_GET['id'];
        $novoNome = $_POST['txtNomeNovo'];
        
        $sqlUpdate = "update tbl_niveisusuario set nivelUsuario = '".$novoNome."' where id_nivelUsuario = ".$id;
        mysqli_query($conexao, $sqlUpdate);
        header('location:nivelUsuario.php');
    }
    

    /* DELETE */
    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        $id = $_GET['id'];
        
        if($modo == "excluir"){
            $deleteNivel = "delete from tbl_niveisusuario where id_nivelUsuario =".$id;
            mysqli_query($conexao, $deleteNivel);
        }
    }
    $niveis="select * from tbl_niveisusuario";
    $SelectNiveis = mysqli_query($conexao, $niveis);
    
?>

<nav id="nav_alter_cms">
        <a href="adicionarUsuario.php"><div class="item_menu_alter_cms"> Adicionar </div></a>
        <a href="alteracaousuario.php"> <div class="item_menu_alter_cms"> Alterar </div> </a>
        <a href="nivelUsuario.php"><div class="item_menu_alter_cms"> Nível de usuário </div></a>
    </nav>
    <section id="admnivelUser">  
        <h1 style="font-size: 28px; margin-top: 10px; margin-bottom: 10px;">Adicionar nível de usuário</h1>
        <div id="novoNivelUser">
            <form name="frmnivelUser" action="nivelUsuario.php" method="post">
                <table id="tblAddnivelUser">
                    <tr>
                        <td style="text-align: right;">
                            Nome do nível:   
                        </td>
                        <td style="text-align: left;">
                            <input type="text" name="txtNomeNivelUsuario" id="txtNomeNivelUsuario" maxlength="15">
                        </td>
                    </tr>
                </table>
                <input type="submit" name="btnFrmnivelUsuario" id="btnFrmnivelUsuario" value="Salvar">
            </form>
        </div>            
    </section>
    <section id="exibirNivelUser">
        <h1 style="font-size: 23px; margin-top: 10px; margin-bottom: 10px;">Todos os níveis</h1>
        <table id="tblDetalhesUser"> 
            <tr style="border-bottom: 1px solid #b2b2b2;">
                <td>Nível</td>
                <td colspan="2">Opções</td>
            </tr>
            <?php while($rsNiveis=mysqli_fetch_array($SelectNiveis)){ ?>
            <tr style="line-height: 40px; border-bottom: 1px solid #b2b2b2;">
                <td><?php
                    echo($rsNiveis['nivelUsuario'])?>
                </td>
                <td class="editModalnivelUsuario" onclick="modalUserAlter(<?php echo($rsNiveis['id_nivelUsuario'])?>)">Editar</td>
                <td> <a href="nivelUsuario.php?modo=excluir&id=<?php echo($rsNiveis['id_nivelUsuario'])?>">excluir</a></td>
                
            </tr>
            <?php } ?>
        </table>
        


    </section>
<?php 
    require_once('footer.php');
?>