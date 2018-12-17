<div id="modalEditSobre">
    <div id="auxModalEditSobre">
        <div id="closeModalEditSobre"></div>
        <div id="contentModalEditSobre"></div>
    </div>
</div>

<?php
    require_once('header.php');
    require_once('../functionsPHP/conexaoDB.php');
    $db = conexaoBD();

    if(isset($_POST['btnSalvarSobre'])){
        $titulo = $_POST['txtTituloAddSobre'];
        $descricao = $_POST['txtDescricaoAddSobre'];
        $venda = $_POST['txtVendaAddSobre'];
        $funcionario = $_POST['txtFuncionarioAddSobre'];
        $entrega = $_POST['txtTempoAddSobre'];
        
        $arquivo =  $_FILES['fleFotoAddSobre']['name']; 
        
        $tamanho_arquivo = $_FILES['fleFotoAddSobre']['size']; 
        $tamanho_arquivo = round($tamanho_arquivo/1024); 
        $ext_arquivo = strrchr($arquivo, ".");         
        $nome_arquivo = pathinfo($arquivo,PATHINFO_FILENAME); 
        $nome_arquivo = md5(uniqid(time()).$nome_arquivo); 
        $diretorioArquivo = "image/sobre/"; 
        $arquivos_permitidos = array(".jpg", ".png", ".jpeg");
        if(in_array($ext_arquivo, $arquivos_permitidos)){           
            if($tamanho_arquivo <= 2000){
                $arquivo_tmp = $_FILES["fleFotoAddSobre"]['tmp_name'];
                $foto = $diretorioArquivo.$nome_arquivo.$ext_arquivo; 
                if(move_uploaded_file($arquivo_tmp, "../".$foto)){
                    $sql = "insert into tbl_sobrewood (tituloSobre, imagemSobre, descricaoSobre, vendaSobre, funcionarioSobre, tempoEntrega, ativado) values ('".$titulo."','".$foto."','".$descricao."','".$venda."', '".$funcionario."','".$entrega."', 0)";
                    mysqli_query($db, $sql);
                    header("location:sobre.php");
                }
                
            }else{
                echo("ERRO! Imagem grande demais.");
            }
            
        }else{
            echo("ERRO! Extensão da fot não é suportada.");
        }
    }

/*************************************************************/
/* Select */
    $selectSobre = "select * from tbl_sobrewood";
    $result = mysqli_query($db, $selectSobre);

/*************************************************************/
/* Editar e excluir */
    if(isset($_GET['modo'])){
        if($_GET['modo'] == "excluir"){
            $id = $_GET['idSobre'];
            $delete = "delete from tbl_sobrewood where idSobre = '".$id."'";
            mysqli_query($db, $delete);
            header("location:sobre.php");
        }
        if($_GET['modo'] == "editar"){
            $id = $_GET['idSobre'];
            $titulo = $_POST['txtTituloEditSobre'];
            $descricao = $_POST['txtDescricaoEditSobre'];
            $venda = $_POST['txtVendaEditSobre'];
            $funcionario = $_POST['txtFuncionarioEditSobre'];
            $tempo = $_POST['txtTempoEditSobre'];
            
            if($_FILES['fleFotoEditSobre']['size'] == 0){
                $updateSOBRE = "update tbl_sobrewood set tituloSobre = '".$titulo."', descricaoSobre = '".$descricao."', vendaSobre = '".$venda."', funcionarioSobre = '".$funcionario."', tempoEntrega = '".$tempo."' where idSobre = ".$id;
                mysqli_query($db, $updateSOBRE);
                header('location:sobre.php');
            }else{
                $arquivo =  $_FILES['fleFotoEditSobre']['name']; 
                $tamanho_arquivo = $_FILES['fleFotoEditSobre']['size']; 
                $tamanho_arquivo = round($tamanho_arquivo/1024); 
                $ext_arquivo = strrchr($arquivo, "."); 
                $nome_arquivo = pathinfo($arquivo,PATHINFO_FILENAME); 
                $nome_arquivo = md5(uniqid(time()).$nome_arquivo); 
                $diretorioArquivo = "image/sobre/"; 
                $arquivos_permitidos = array(".jpg", ".png", ".jpeg");
                if(in_array($ext_arquivo, $arquivos_permitidos)){             
                    if($tamanho_arquivo <= 2000){
                        $arquivo_tmp = $_FILES["fleFotoEditSobre"]['tmp_name'];
                        $foto = $diretorioArquivo.$nome_arquivo.$ext_arquivo; 
                        if(move_uploaded_file($arquivo_tmp, "../".$foto)){
                            $updateSOBRE = "update tbl_sobrewood set tituloSobre = '".$titulo."', descricaoSobre = '".$descricao."', vendaSobre = '".$venda."', funcionarioSobre = '".$funcionario."', tempoEntrega = '".$tempo."', imagemSobre = '".$foto."' where idSobre = ".$id;
                            mysqli_query($db, $updateSOBRE);
                            header('location:sobre.php');   
                        }
                    }else{echo("ERRO! Imagem grande demais.");}

                }else{echo("ERRO! Extensão da fot não é suportada.");} 
            }            
            
            
        }
        
        
    }
/****************************************************************/
    /* ATIVAR OU DESATIVAR SOBRE */
    if(isset($_GET['ativado'])){
        $ativacao = $_GET['ativado'];
        $idAtivação = $_GET['id'];
        if($ativacao == "ativar"){
            $updateAtivado = "update tbl_sobrewood set ativado = 1 where idSobre =".$idAtivação;
            mysqli_query($db, $updateAtivado);
            $updateAtivado = "update tbl_sobrewood set ativado = 0 where idSobre !=".$idAtivação;
            mysqli_query($db, $updateAtivado);
        }
        header('location:sobre.php'); 
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
        <form name="frmAddSobre" action="sobre.php" method="post" enctype="multipart/form-data">
            <h1 id='titleSobre'> Novos dados da Wood </h1>
            <table id="tblAddSobre">
                <tr>    
                    <td>Título</td>
                    <td> <input type="text" name="txtTituloAddSobre" class="addSobre" required="required" onkeypress="return validar(event, 'num', this.id);"  maxlength="45"> </td>
                    <td>Imagem de fundo</td>
                    <td><input type="file" name="fleFotoAddSobre" required="required"></td>
                    <td>Descrição</td>
                    <td> <textarea cols="30" rows="5" name="txtDescricaoAddSobre" required="required"></textarea></td>
                </tr>
                <tr>    
                    <td>Nº de vendas</td>
                    <td> <input type="text" name="txtVendaAddSobre" class="addSobre" required="required" onkeypress="return validar(event, 'txt', this.id);" maxlength="11"> </td>
                    <td>Nº de funcionários</td>
                    <td> <input type="text" name="txtFuncionarioAddSobre" class="addSobre" required="required" onkeypress="return validar(event, 'txt', this.id);" maxlength="11"> </td>
                    <td>Tempo de Entrega</td>
                    <td> <input type="text" name="txtTempoAddSobre" class="addSobre" required="required" onkeypress="return validar(event, 'txt', this.id);" maxlength="11"> </td>
                </tr>
            </table>
            <input type="submit" name="btnSalvarSobre" id="btnSalvarSobre" value="Salvar">
        </form>
        
        <div id="containertblSobre">
        <table>
            <tr id="titletableSobre">
                <td style="border-top-left-radius:8px;">Título</td>
                <td>Imagem</td>
                <td>Descrição</td>
                <td>Vendas</td>
                <td>Funcionários</td>
                <td>Tempo de entrega</td>
                <td colspan="2">Opções</td>
                <td style="border-top-right-radius:8px;">Ativado</td>
            </tr>
            <?php while($rsSobre = mysqli_fetch_array($result)){ ?>
            <tr id="linecontentSobre">
                <td> <?php echo($rsSobre['tituloSobre']) ?> </td>
                <td><img style="width: 70px; height: 90px;" src="../<?php echo($rsSobre['imagemSobre']) ?>"></td>
                <td><?php echo($rsSobre['descricaoSobre']) ?> </td>
                <td><?php echo($rsSobre['vendaSobre']) ?> </td>
                <td><?php echo($rsSobre['funcionarioSobre']) ?></td>
                <td><?php echo($rsSobre['tempoEntrega']) ?> </td>
                <td><a href="sobre.php?idSobre=<?php echo($rsSobre['idSobre'])?>&modo=excluir"><img src="image/deletar.png" title="Excluir" style="width: 20px; height: 20px;"></a></td>
                <td><a href="#" class="editarSobre" onclick="editarSobre(<?php echo($rsSobre['idSobre']) ?>)"><img src="image/editar.png" title="Editar" style="width: 20px; height: 20px;"></a></td>
                <td>
                <?php 
                    if($rsSobre["ativado"] == 0){?>
                     <a href="sobre.php?id=<?php echo($rsSobre['idSobre'])?>&ativado=ativar">
                         <img src="image/desativado.png" style="width: 20px; height: 20px;">
                    </a>
                    <?php
                    }else{?>
                    <a href="sobre.php?id=<?php echo($rsSobre['idSobre'])?>&ativado=desativar">
                        <img src="image/ativado.png" style="width: 20px; height: 20px;">
                    </a>
                    <?php }
                    ?>
                </td>
            </tr>
        <?php }?>
        </table>
        </div>
    </div>
</setion>
<?php require_once('footer.php');?>