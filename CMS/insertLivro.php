<?php
    require_once('../functionsPHP/conexaoDB.php');
    require_once('header.php');

    $db = conexaoBD();

    $stringSlcCategoria = "select * from tbl_categoria_produto where status_categoria = 1";
    $slcCategoria = mysqli_query($db, $stringSlcCategoria);

    $stringSlcSubCategoria = "select * from tbl_subcategoria_produto where status_subcategoria = 1";
    $slcSubCategoria = mysqli_query($db, $stringSlcSubCategoria);

    $stringSlcAutor = "select * from tbl_autor";
    $slcAutor = mysqli_query($db, $stringSlcAutor);

    if(isset($_POST['btnLivro'])){
        $nome = $_POST['txtnome'];
        $descricao = $_POST['txtdescricao'];
        $autor = $_POST['txtautor'];
        $preco = $_POST['txtpreco'];
        $subcategoria = $_POST['slc_subcategoria'];
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
                    $sql = "insert into tbl_livro (nomeLivro, imagemLivro, descricaoLivro, idAutor , precoLivro, id_subcategoria, livroMes, home, clickHome) values ('".$nome."','".$foto."','".$descricao."','".$autor."', '".$preco."', '".$subcategoria."', 0, 0, 0)";
                    mysqli_query($db, $sql);
                    header("location:insertLivro.php");
                }

            }else{
                echo("ERRO! Imagem grande demais.");
            }

        }else{
            echo("ERRO! Extensão da foto não é suportada.");
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
        <form name="frmName" method="post" enctype="multipart/form-data" action="insertLivro.php">
            <h1 id="titleAddLivro"> Adicionar um livro </h1>
            <table id="tblAddLivro">
                <tr>
                    <td>
                        Nome do livro: <input type="text" name="txtnome" class="txtAddLivro">
                    </td>
                    <td colspan="2">
                        Autor: <select name="txtautor">
                                <?php while($rsAutor = mysqli_fetch_array($slcAutor)){ ?>
                                    <option value="<?php echo($rsAutor['idAutor']) ?>"><?php echo($rsAutor['nomeAutor'])?> </option>
                                <?php } ?>
                            </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Preço: <input type="text" name="txtpreco" class="txtAddLivro">
                    </td>

                    <td>
                        Categoria: <select name="slc_categoria">
                            <?php while($rsCategoria = mysqli_fetch_array($slcCategoria)){ ?>
                                 <option value="<?php echo($rsCategoria['id_categoria']) ?>"><?php echo($rsCategoria['nome_categoria'])?>
                            <?php } ?>
                        </select>
                    </td>
                    <td>
                        Sub-categoria: <select name="slc_subcategoria" id="subCategoriaProduto">
                            <?php while($rsSubCategoria = mysqli_fetch_array($slcSubCategoria)) {?>
                                <option value="<?php echo($rsSubCategoria['id_subcategoria'])?>"> <?php echo($rsSubCategoria['nome_subcategoria']) ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Descrição: <textarea rows="6" cols="35" name="txtdescricao"></textarea>
                    </td>
                    <td colspan="2">
                        Capa do livro: <input type="file" name="foto">
                    </td>
                </tr>
            </table>
            <input type="submit" name="btnLivro" id="btnAddLivro" value="SALVAR">
        </form>
    </div>
        </div>
</setion>
<?php
    require_once('footer.php');
?>
