<?php
    require_once("functionsPHP/conexaoDB.php");
    $db = conexaoBD();
    
    require_once("functionsPHP/login.php");
    if(isset($_POST['btnFrmAutenticaHeader'])){
        
        $usuario = $_POST['txtUsuario'];
        $senha = $_POST['txtSenha'];
        FunctionLogin($usuario, $senha);
    }


    $selectLivro = "select tbl_livro.*, tbl_autor.nomeAutor, tbl_livropromocao.*  from tbl_autor, tbl_livro, tbl_livropromocao where tbl_livro.idLivro = tbl_livropromocao.idLivro and tbl_livro.idAutor = tbl_autor.idAutor and tbl_livropromocao.ativado = 1 ";
    $livros = mysqli_query($db, $selectLivro);


    if(isset($_POST['btnFrmAutenticaHeader'])){
        $usuario =  $_POST['txtUsuario'];
        $senha = $_POST['txtSenha'];
        login($usuario, $senha); 
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">   
        <title> Livraria - Woody Woodpecker </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <script src="js/function.js"></script>
        
        <!-- Cabeçalho -->
        <header>
            <div id="container_header">
                <div id="logo_header">
                    <img id="logo_image_header" src="image/logo.png" title="Woody Woodpecker" alt="logo">
                </div>
                <nav id="nav_header">
                    <div class="item_menu_header">
                        <a href="index.php">Home</a>
                    </div>
                    <div class="item_menu_header">
                        <a href="autorDestaque.php">Autores</a>
                    </div>
                    <div class="item_menu_header">
                        <a href="promocao.php">Promoções</a>
                    </div>
                    <div class="item_menu_header">
                        <a href="nossasLojas.php">Lojas</a>
                    </div>
                    <div class="item_menu_header">
                        <a href="livroMes.php">Livro do mês</a>
                    </div>
                    <div class="item_menu_header">
                        <a href="sobre.php">Sobre</a>
                    </div>
                    <div class="item_menu_header">
                        <a href="faleConosco.php">Contato </a>
                    </div>
                </nav>
                <div id="autentica_header">
                    <form name="autentica_header" action="index.php" method="post">
                        <div class="item_autentica_header">
                            <p>Usuário
                            <input type="text" name="txtUsuario" class="txtAutentica">
                        </div>
                        <div class="item_autentica_header">
                            <p>Senha
                            <input type="password" name="txtSenha" class="txtAutentica">
                        </div>
                            <input type="submit" name="btnFrmAutenticaHeader" id="btnHeader" value="OK">
                    </form>
                </div>
            </div>
        </header>
        <!-- Fim do cabeçalho -->
        
        <div class="container_site">
            <div id="container_promocao">
                
                <!-- Foto da promoção do mês -->
                <div id="img_promocao">
                    <img src="image/promocao.jpg" id="imgPromocao" alt="Imagem das promoções" title="Promoções de até 70%">
                </div>
                
                <!-- Livros em promoção -->
                <section id="promocao_section">
                    <?php
                        while($rs = mysqli_fetch_array($livros)){
                    ?>
                    <div class="item_promocao">
                        <div class="imgPromocao"> 
                            <img src="<?php echo($rs['imagemLivro']) ?>" alt="<?php echo($rs['nomeLivro']) ?>" title="Capa <?php echo($rs['nomeLivro']) ?>" class="imgLivroPromacao">
                        </div>
                        <div class="descricaoLivro_promocao">
                            Nome:
                        </div>
                        <div class="descricaoLivroResposta_promocao">
                            <?php echo($rs['nomeLivro']) ?>
                        </div>
                        <div class="descricaoLivro_promocao">
                            Descrição:
                        </div>
                        <div class="descricaoLivroResposta_promocao">
                            Escrito por <?php echo($rs['AutorLivro']) ?>...
                        </div>
                        <div class="descricaoLivro_promocao">
                            Preço:
                        </div>
                        <div class="descricaoLivroResposta_promocao ">
                            <span class="preçoOriginal">R$ <?php echo($rs['precoLivro']) ?></span><span class="preçoDesconto">R$ <?php echo($rs['valor']) ?> </span>
                        </div>
                    </div>
                    <?php } ?>
                    
                </section>
                <!-- Fim do livros em promoção -->
            </div>
        </div>
        
        <!-- Rodapé -->
        <footer>
            <div class="footer">
            
            </div>
        </footer>
        <!-- Fim do rodapé -->
    </body>
</html>
