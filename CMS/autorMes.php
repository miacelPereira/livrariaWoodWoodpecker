<div id="containerModalEditAutor">
    <div id="auxModalEditAutor">
        <div id="closeModalEditAutor"></div>
        <div id="contentModalEditAutor" ></div>
    </div>
</div>
<?php
    require_once('header.php');
    require_once('../functionsPHP/conexaoDB.php');
    $conexao = conexaoBD();

    if(isset($_POST['btnAddAutor'])){
        $nomeAdd = $_POST['txtNomeAutorAdd'];
        $paisAdd = $_POST['txtPaisAutorAdd'];
        $descricaoAdd = $_POST['txtDescricaoAutorAdd'];
        $siteAdd = $_POST['txtSiteAutorAdd'];
        $generoAdd = $_POST['txtGeneroAutorAdd'];
    
        /*******************************************************/
        /*UPLOAD DA FOTO*/
        $arquivo =  $_FILES['fleFoto']['name']; 
        
        $tamanho_arquivo = $_FILES['fleFoto']['size']; 
        $tamanho_arquivo = round($tamanho_arquivo/1024); 
        
        $ext_arquivo = strrchr($arquivo, "."); 
        
        $nome_arquivo = pathinfo($arquivo,PATHINFO_FILENAME); 
        
        $nome_arquivo = md5(uniqid(time()).$nome_arquivo); 
        
        $diretorioArquivo = "image/autorDestaque/"; 
        
        $arquivos_permitidos = array(".jpg", ".png", ".jpeg", ".JPG", ".PNG", ".JPEG");
        
        if(in_array($ext_arquivo, $arquivos_permitidos)){             
            if($tamanho_arquivo <= 2000){
                $arquivo_tmp = $_FILES["fleFoto"]['tmp_name'];
                $foto = $diretorioArquivo.$nome_arquivo.$ext_arquivo; 
                
                if(move_uploaded_file($arquivo_tmp, "../".$foto)){
                    $sql = "insert into tbl_autor (nomeAutor, imagemAutor, descricaoAutor, paisAutor, ativado, generoAutor, siteAutor) values ('".$nomeAdd."','".$foto."','".$descricaoAdd."','".$paisAdd."', 0, '".$generoAdd."','".$siteAdd."')";
                    mysqli_query($conexao, $sql);
                    header("location:autorMes.php");    
                }
                
            }else{echo("<span style='margin-left:400px; color: red; font-weight:800;'> O tamanho do arquivo é muito grande </span>");}

            }else{echo("<span style='margin-left:480px; color: red; font-weight:800;'> Extensão de imagem não suportada </span>");} 
        
    }
/****************************************************************/
    /* SELECT PARA EXIBIR O AUTOR */
    $select="select * from tbl_autor";
    $rsAllAutor=mysqli_query($conexao, $select);
/****************************************************************/
    /* ATIVAR OU DESATIVAR AUTOR DO MÊS */
    if(isset($_GET['ativado'])){
        $ativacao = $_GET['ativado'];
        $idAtivação = $_GET['id'];
        if($ativacao == "ativar"){
            $updateAtivado = "update tbl_autor set ativado = 1 where idAutor =".$idAtivação;
            mysqli_query($conexao, $updateAtivado);
            $updateAtivado = "update tbl_autor set ativado = 0 where idAutor !=".$idAtivação;
            mysqli_query($conexao, $updateAtivado);
        }
        header('location:autorMes.php'); 
    }
/****************************************************************/
    /* EXCLUIR E EDITAR AUTOR */
    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        
        if($modo == 'excluirAutor'){
            $idEdit = $_GET['idAutor'];
            $delete = "delete from tbl_autor where idAutor = ".$idEdit;
            mysqli_query($conexao, $delete);
            echo($delete);
            header('location:autorMes.php');
            
        }else if($modo == 'editarAutor'){
            /* Editar */
            $id = $_GET['idAutorEdit'];
            $nomeEdit = $_POST['txtNomeEditAutor'];
            $paisEdit = $_POST['txtPaisEditAutor'];
            $descricaoEdit = $_POST['txtDescricaoEditAutor'];
            $generoAutor = $_POST['txtGeneroEditAutor'];
            $siteAutor = $_POST['txtSiteEditAutor'];
            
            
            if($_FILES['fleFotoEditAutor']['size'] == 0){
                $updateEdit = "update tbl_autor set nomeAutor = '".$nomeEdit."', paisAutor = '".$paisEdit."', descricaoAutor = '".$descricaoEdit."', generoAutor = '".$generoAutor."', siteAutor = '".$siteAutor."' where idAutor = ".$id;
                mysqli_query($conexao, $updateEdit);
                header('location:autorMes.php');
            }else{
                $arquivo =  $_FILES['fleFotoEditAutor']['name']; 
                $tamanho_arquivo = $_FILES['fleFotoEditAutor']['size']; 
                $tamanho_arquivo = round($tamanho_arquivo/1024); 
                $ext_arquivo = strrchr($arquivo, "."); 
                $nome_arquivo = pathinfo($arquivo,PATHINFO_FILENAME); 
                $nome_arquivo = md5(uniqid(time()).$nome_arquivo); 
                $diretorioArquivo = "image/autorDestaque/"; 
                $arquivos_permitidos = array(".jpg", ".png", ".jpeg");
                if(in_array($ext_arquivo, $arquivos_permitidos)){             
                    if($tamanho_arquivo <= 2000){
                        $arquivo_tmp = $_FILES["fleFotoEditAutor"]['tmp_name'];
                        $foto = $diretorioArquivo.$nome_arquivo.$ext_arquivo; 
                        if(move_uploaded_file($arquivo_tmp, "../".$foto)){
                            $updateEdit = "update tbl_autor set nomeAutor = '".$nomeEdit."', paisAutor = '".$paisEdit."', descricaoAutor = '".$descricaoEdit."', imagemAutor = '".$foto."',  generoAutor = '".$generoAutor."', siteAutor = '".$siteAutor."' where idAutor = ".$id;
                            mysqli_query($conexao, $updateEdit);
                            header("location:autorMes.php");    
                        }
                    }else{echo("<span style='margin-left:400px; color: red; font-weight:800;'> O tamanho do arquivo é muito grande </span>");}

                }else{echo("<span style='margin-left:400px; color: red; font-weight:800;'> Extensão de imagem não suportada </span>");} 
            }            
            
        }
        
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
            <h1 id="titleConfigAutor">Adicionar Autor(a)</h1>
            <form action="autorMes.php" method="post" name="frmAddAutor" enctype="multipart/form-data">
                <table id="tblAutorMesAdd">
                    <tr>
                        <td>Nome do autor(a)</td>
                        <td><input type="text" name="txtNomeAutorAdd" class="txtAddAutor" required="required" onkeypress="return validar(event, 'num', this.id);" maxlength="60"> </td>
                        
                        <td>País onde nasceu</td>
                        <td><input type="text" name="txtPaisAutorAdd" class="txtAddAutor" required="required" onkeypress="return validar(event, 'num', this.id);"  maxlength="25"> </td>
                    </tr>
                    <tr>
                        <td>Gênero Literário</td>
                        <td><input type="text" name="txtGeneroAutorAdd" class="txtAddAutor" required="required" onkeypress="return validar(event, 'num', this.id);"  maxlength="55"> </td>
                        
                        <td>Site</td>
                        <td><input type="text" name="txtSiteAutorAdd" class="txtAddAutor" required="required" onkeypress="return validar(event, 'num', this.id);"  maxlength="255"> </td>
                    
                    </tr>
                    <tr>
                        <td>Foto</td>
                        <td><input type="file" name="fleFoto" required="required"></td>
                        <td>Descrição</td>
                        
                        <td><textarea rows="5" cols="50" name="txtDescricaoAutorAdd" class="" required="required"></textarea></td>
                    </tr>
                </table>
                <input type="submit" name="btnAddAutor" id="btnAddAutor" value="Salvar">
            </form>
            <div id="scrollTable">
            <table id="tblAutorMesSelect">
                <tr id="lineTitleTblSelectAutorMes">
                    <td style="border-top-left-radius: 8px">Nome</td>
                    <td>Imagem</td>
                    <td>Descrição</td>
                    <td>Nacionalidade</td>
                    <td>Destaque</td>
                    <td style="border-top-right-radius: 8px" colspan="2"> Opções </td>
                </tr>
                <?php while($rsSelect=mysqli_fetch_array($rsAllAutor)){ ?>
                <tr class="lineTableSelectAutorMesContent">
                    <td><?php echo($rsSelect['nomeAutor']);?> </td>
                    <td><img style="width: 70px; height: 90px;" src="../<?php echo($rsSelect['imagemAutor']);?>" alt="autor(a)<?php echo($rsSelect['nomeAutor']);?>" title="<?php echo($rsSelect['nomeAutor']); ?>"></td>
                    <td><textarea rows="4" cols="40" disabled="true"> <?php echo($rsSelect['descricaoAutor']);?></textarea></td>
                    <td><?php echo($rsSelect['paisAutor']);?></td>
                    <td><?php 
                        if($rsSelect["ativado"] == 0){?>
                         <a href="autorMes.php?id=<?php echo($rsSelect['idAutor'])?>&ativado=ativar">
                             <img src="image/desativado.png" style="width: 20px; height: 20px;">
                        </a>
                    <?php
                        }else{?>
                        <a href="autorMes.php?id=<?php echo($rsSelect['idAutor'])?>&ativado=desativar">
                            <img src="image/ativado.png" style="width: 20px; height: 20px;">
                        </a>
                        <?php }
                    ?></td>
                    <td><a href="#" class="editAutor" onclick="editAutor(<?php echo($rsSelect['idAutor']) ?>)"><img src="image/editar.png" title="Editar" style="width: 20px; height: 20px;"></a></td>
                    <td><a href="autorMes.php?idAutor=<?php echo($rsSelect['idAutor']);?>&modo=excluirAutor"><img src="image/deletar.png" title="Excluir" style="width: 20px; height: 20px;"></a></td>
                </tr>
                <?php } ?>
            </table>
            </div>
        </div>
    </div>
</setion>



<?php require_once('footer.php');?>