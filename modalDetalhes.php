<?php
    require_once("functionsPHP/conexaoDB.php");
    $db = conexaoBD();

    $idLivro = $_GET['idLivro'];

    /* Select no livro */
    $string = "select tbl_livro.*, tbl_autor.nomeAutor from tbl_livro, tbl_autor where tbl_livro.idAutor = tbl_autor.idAutor and tbl_livro.idLivro = ".$idLivro;
    $livro = mysqli_query($db, $string);
    $rs = mysqli_fetch_array($livro);
    
    /* Update para contabilizar o click */
    $click = $rs['clickHome'] + 1;
    $update = "update tbl_livro set clickHome = ".$click." where idLivro = ".$idLivro;
    mysqli_query($db, $update);
?>

<html>
    <head>
        <style>
            #foto{
                width: 200px;
                height: 230px;
            }
            h1{
                font-size: 25px;
            }
            .line{
                margin-top: 15px;
                margin-bottom: 15px;
            }
        
        </style>
    </head>
    <body>
        <div class="line"> <h1> <?php echo($rs['nomeLivro']) ?> </h1> </div>
        <div class="line"> <img src="<?php echo($rs['imagemLivro']) ?>" id="foto"> </div>
        <div class="line"> <?php echo($rs['nomeAutor']) ?> </div>
        <div class="line"> <textarea  readonly="readonly">  <?php echo($rs['descricaoLivro']) ?> </textarea> </div>
        <div class="line"> R$ <?php echo($rs['precoLivro']) ?> </div>
    </body>
</html>