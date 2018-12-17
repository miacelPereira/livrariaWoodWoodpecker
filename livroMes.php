<?php 
    require_once("functionsPHP/conexaoDB.php");
    $db = conexaoBD();
    
    require_once("functionsPHP/login.php");
    if(isset($_POST['btnFrmAutenticaHeader'])){
        
        $usuario = $_POST['txtUsuario'];
        $senha = $_POST['txtSenha'];
        FunctionLogin($usuario, $senha);
    }
    
    $selectLivroMes = "select tbl_livro.*, tbl_autor.nomeAutor from tbl_livro, tbl_autor where tbl_livro.idAutor = tbl_autor.idAutor and livroMes = 1";
    $sqlLivroMes = mysqli_query($db, $selectLivroMes);
    $rs = mysqli_fetch_array($sqlLivroMes);

    if(isset($_POST['btnFrmAutenticaHeader'])){
        $usuario =  $_POST['txtUsuario'];
        $senha = $_POST['txtSenha'];
        login($usuario, $senha); 
    }
/***************************************************************************************************/

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
            
            <!-- Informações do livro -->
            <section id="livroMes">
                
                <!-- Nome do livro -->
                <div id="livroMes_titulo">
                    <?php
                        echo($rs['nomeLivro']);
                    ?>
                </div>
                
                <!-- Nome do Autor -->
                <div id="livroMes_autor">
                    <?php
                        echo($rs['nomeAutor']);
                    ?>
                </div>
                
                <!-- Imagem do livro -->
                <div id="livroMes_img">
                    <img src="<?php echo($rs['imagemLivro']) ?>"  id="img_livroMes"alt="Capa Kotlin com Android" title="Kotlin com Android">
                </div>
                <!-- Descrição do livro -->
                <div id="livroMes_descricao">
                     <?php
                        echo($rs['descricaoLivro']);
                    ?>
                </div>
            </section>
            <!-- Fim das informações do livro -->
        </div>
        
        <!-- Rodapé -->
        <footer>
            <div class="footer">
            
            </div>
        </footer>
        <!-- Fim do Rodapé -->
    </body>
</html>
