<?php
  require_once("../functionsPHP/conexaoDB.php");
  $db = conexaoBD();
  $idLivro = $_GET['idLivro'];
  /**** SELECT NAS CATEGORIAS ****/
  $selectCategoria = "select * from tbl_categoria_produto";
  $categorias = mysqli_query($db, $selectCategoria);
  /**** SELECT NAS SUBCATEGORIAS ****/
  $selectSubcategoria = "select * from tbl_subcategoria_produto";
  $subcategorias = mysqli_query($db, $selectSubcategoria);
  /**** SELECT NO LIVRO ****/
  $stringLivro = "select tbl_livro.*, tbl_autor.nomeAutor from tbl_livro, tbl_autor where tbl_autor.idAutor = tbl_livro.idAutor and tbl_livro.idLivro = ".$idLivro;
  $livro = mysqli_query($db, $stringLivro);
  $rsLivro = mysqli_fetch_array($livro);

  $stringAutores = "select * from tbl_autor where idAutor != ".$rsLivro['idAutor'];
  $autores = mysqli_query($db, $stringAutores);
  $rsAutor = mysqli_fetch_array($autores);
 ?>
<html>
<head>
  <style>
    body{
      text-align: center;
    }
    table{
      width: 600px;
      height: auto;
      margin: auto;
      text-align: center;
      font-size: 18px;
      border-collapse: collapse;
    }
    table tr{
      height: 50px;
      min-height: 50px;
      padding: 50px;
      border-bottom: 1px solid #c2c2c2;
    }
    #imgCapa{
      width: 110px;
      height: 150px;
    }
    .imgAtivadoDesativado{
      width: 24px;
      height: 24px;
    }
    #btnEditLivro{
      width: 100px;
      height: 40px;
      margin: 8px;
      color: #ffffff;
      border: none;
      border-radius: 8px;
      background-color: #415982;
      cursor: pointer;
    }
    .lineText{
      width: 250px;
      border: none;
      border-bottom: 1px solid #415982;
      text-align: center;
      height: 35px;
    }
  </style>
</head>
  <body>
    <h1> Editar Livro </h1>
    <form enctype="multipart/form-data" action="listlivros.php?idEditLivro=<?php echo($idLivro)?>" method="post" name="frmEditLivro">
      <table>
        <tr>
          <td>Nome:</td>
          <td><input type="text" name="txtNomeLivroEdit" class="lineText" value="<?php echo($rsLivro['nomeLivro']) ?>"></td>
        </tr>
        <tr>
          <td>Capa:</td>
          <td><input type="file" name="foto"></td>
        </tr>
        <tr>
          <td>Autor:</td>
          <td>
            <select name="txtAutorLivroEdit">
              <option value="<?php echo($rsLivro['idAutor'])?>"> <?php echo($rsLivro['nomeAutor'])?> </option>
              <?php while($rsAutor = mysqli_fetch_array($autores)){?>
                <option value="<?php echo($rsAutor['idAutor'])?>"> <?php echo($rsAutor['nomeAutor'])?> </option>
              <?php } ?>
              <option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Descrição:</td>
          <td><textarea name="txtDescricaoLivroEdit" rows="4" cols="40"><?php echo($rsLivro['descricaoLivro']) ?> </textarea></td>
        </tr>
        <tr>
          <td>Preço</td>
          <td><input type="text" name="txtPrecoLivroEdit" class="lineText" value="<?php echo($rsLivro['precoLivro']) ?>"></td>
        </tr>
        <tr>
          <td>Categoria:</td>
          <td>
            <select name="sltCategoriaLivroEdit">
              <?php while ($rsCategoria = mysqli_fetch_array($categorias)) {?>
                <option value="<?php echo($rsCategoria['id_categoria']) ?>"><?php echo($rsCategoria['nome_categoria']) ?></option>
              <?php } ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>Subcategoria:</td>
          <td>
            <select name="sltSubcategoriaLivroEdit">
              <?php while ($rsSubcategoria = mysqli_fetch_array($subcategorias)) {?>
                <option value="<?php echo($rsSubcategoria['id_subcategoria']) ?>"><?php echo($rsSubcategoria['nome_subcategoria']) ?></option>
              <?php } ?>
            </select>
          </td>
        </tr>
      </table>
      <input type="submit" name="btnEditLivro" value="Editar" id="btnEditLivro">
    </form>
  </body>
</html>
