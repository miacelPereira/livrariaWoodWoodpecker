<div id="containerModalEdit">
    <div id="auxModalEditLivro">
        <div id="closeModalEditLivro"> </div>
        <div id="contentModalEditLivro"> </div>
    </div>
</div>
<?php
    require_once('../functionsPHP/conexaoDB.php');
    require_once('header.php');

    $db = conexaoBD();

    $selectBooks = "select tbl_livro.*, tbl_autor.nomeAutor from tbl_livro, tbl_autor where tbl_autor.idAutor = tbl_livro.idAutor";
    $sqlBooks = mysqli_query($db, $selectBooks);

    if(isset($_POST['btnEditLivro'])){
      $idLivroEdit = $_GET['idEditLivro'];
      $nomeEdit = $_POST['txtNomeLivroEdit'];
      $autorEdit = $_POST['txtAutorLivroEdit'];
      $descricaoEdit = $_POST['txtDescricaoLivroEdit'];
      $precoEdit = $_POST['txtPrecoLivroEdit'];
      $subcategoriaEdit = $_POST['sltSubcategoriaLivroEdit'];

      if($_FILES['foto']['size'] != 0){
        $arquivo =  $_FILES['foto']['name'];

        $tamanho_arquivo = $_FILES['foto']['size'];
        $tamanho_arquivo = round($tamanho_arquivo/1024);
        $ext_arquivo = strrchr($arquivo, ".");
        $nome_arquivo = pathinfo($arquivo,PATHINFO_FILENAME);
        $nome_arquivo = md5(uniqid(time()).$nome_arquivo);
        $diretorioArquivo = "image/sobre/";
        $arquivos_permitidos = array(".jpg", ".png", ".jpeg");
          
        if(in_array($ext_arquivo, $arquivos_permitidos)){
            if($tamanho_arquivo <= 2000){
                $arquivo_tmp = $_FILES["foto"]['tmp_name'];
                $foto = $diretorioArquivo.$nome_arquivo.$ext_arquivo;
                if(move_uploaded_file($arquivo_tmp, "../".$foto)){
                    $sql = "update tbl_livro set nomeLivro = '".$nomeEdit."', imagemLivro = '".$foto."' , descricaoLivro = '".$descricaoEdit."', idAutor = ".$autorEdit." , precoLivro = ".$precoEdit.", id_subcategoria = ".$subcategoriaEdit." where idLivro = ".$idLivroEdit;
                    mysqli_query($db, $sql);
                    header("location:listlivros.php");
                }
            }else{
                echo("ERRO! Imagem grande demais.");
            }
        }else{
            echo("ERRO! Extensão da foto não é suportada.");
        }
      }else{
        $sql = "update tbl_livro set nomeLivro = '".$nomeEdit."', descricaoLivro = '".$descricaoEdit."', idAutor = ".$autorEdit." , precoLivro = ".$precoEdit.", id_subcategoria = ".$subcategoriaEdit." where idLivro = ".$idLivroEdit;
        mysqli_query($db, $sql);
        header("location:listlivros.php");
      }
    }

    if(isset($_GET['modo'])){
        $idLivro = $_GET['idBook'];
        $deleteSql = ("delete from tbl_livro where idLivro = ".$idLivro);
        mysqli_query($db, $deleteSql);
        header('location:listlivros.php');
    }

    if(isset($_GET['addHome'])){
        $idLivro = $_GET['idBook'];
        $addHome = $_GET['addHome'];
        if($addHome == 1){
            $updateSql = ("update tbl_livro set home = 1 where idLivro = ".$idLivro);
            mysqli_query($db, $updateSql);
            header('location:listlivros.php');
        }if($addHome == 0){
            $updateSqloff = ("update tbl_livro set home = 0 where idLivro = ".$idLivro);
            mysqli_query($db, $updateSqloff);
            header('location:listlivros.php');
        }
    }
?>
<setion id="alter_cms">
    <!-- Parte de alterar conteudos do site -->
    <div id="admConteudo">
        <nav id="nav_alter_cms">
            <a href="listlivros.php"><div class="item_menu_alter_cms">  Lista de produtos </div></a>
            <a href="insertLivro.php"> <div class="item_menu_alter_cms"> Adicionar Livro</div></a>
            <a href="estatistica.php"> <div class="item_menu_alter_cms"> Estatisticas </div></a>
            <a href="categoria.php"><div class="item_menu_alter_cms"> Categorias </div></a>
            <a href="subcategoria.php"><div class="item_menu_alter_cms"> Subcategorias  </div></a>
        </nav>
        <div id="alter_conteudo">
            <h1 id="titleViewBooks"> Visualização de produtos </h1>
            <div id="containerListBooks">
            <table id="viewTableBooks">
                <tr>
                    <td>

                    </td>
                    <td class="titleViewBooksTable" style="border-top-left-radius: 8px;">
                        Nome
                    </td>
                    <td class="titleViewBooksTable">
                        Autor
                    </td>
                    <td class="titleViewBooksTable">
                        Preço
                    </td>
                    <td colspan="3" class="titleViewBooksTable" style="border-top-right-radius: 8px;">
                        Opções
                    </td>
                </tr>
                <?php while ($rsBooks = mysqli_fetch_array($sqlBooks)) { ?>
                <tr class="lineTableViewBooks">
                    <td class="contentTableViewBooks">
                        <img src="../<?php echo($rsBooks['imagemLivro']) ?>" class="imgCapaLivroViewBooks">
                    </td>
                    <td class="contentTableViewBooks">
                       <?php echo($rsBooks['nomeLivro']) ?>
                    </td>
                    <td class="contentTableViewBooks">
                        <?php echo($rsBooks['nomeAutor']) ?>
                    </td>
                    <td class="contentTableViewBooks">
                        R$<?php echo($rsBooks['precoLivro']) ?>
                    </td>
                    <td class="contentTableViewBooks">
                        <a href="listlivros.php?modo=excluir&idBook=<?php echo($rsBooks['idLivro'])?>"><img src="image/deletar.png" title="Deletar"></a>
                    </td>
                    <td class="contentTableViewBooks">
                        <a href="#" class="editBookView" onclick="openModalLivro(<?php echo($rsBooks['idLivro']) ?>)"><img src="image/editar.png" title="Editar"></a>
                    </td>
                    <td class="contentTableViewBooks">
                       <?php if($rsBooks['home'] == 0){ ?>
                            <a href="listlivros.php?addHome=1&idBook=<?php echo($rsBooks['idLivro'])?>"> <img src="image/homenegative.fw.png"title="Adicionar na Home" style="width: 32px; height: 32px;"></a>
                        <?php } if($rsBooks['home'] == 1){ ?>
                            <a href="listlivros.php?addHome=0&idBook=<?php echo($rsBooks['idLivro'])?>"><img src="image/homeconfirm.fw.png" title="Tirar da Home" style="width: 32px; height: 32px;"></a>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
          </div>
        </div>
    </div>
</setion>
<?php
    require_once('footer.php');
?>
