<?php 
    require_once("functionsPHP/conexaoDB.php");
    $db = conexaoBD();
    
    require_once("functionsPHP/login.php");
    if(isset($_POST['btnFrmAutenticaHeader'])){
        
        $usuario = $_POST['txtUsuario'];
        $senha = $_POST['txtSenha'];
        FunctionLogin($usuario, $senha);
    }
    
    $selectAutorDestaque = "select * from tbl_autor where ativado = 1";
    $autorDestaque = mysqli_query($db, $selectAutorDestaque);
    $rs = mysqli_fetch_array($autorDestaque);

    $selectLivrosAutor = "select tbl_livro.* from tbl_livro where idAutor =  '" .$rs['idAutor']."'";
    $livro = mysqli_query($db, $selectLivrosAutor);
    
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
            <section id="autor_destaque">
                
                <!-- Foto do Autor -->
                <div id="image_autor">
                    <img  class="image_autor" src="<?php echo($rs['imagemAutor'])?>" alt="<?php echo($rs['nomeAutor'])?>">
                </div>
                
                <!-- Descrição do autor -->
                <div id="descricao_autor_destaque">
                    <div id="nome_autor">
                        <h1> <?php echo($rs['nomeAutor'])?></h1>
                    </div>

                    <div class="container_info_autor">
                        <div class="info_autor">
                             País de origem:
                        </div>
                        <div class="info_autor_respostas">
                             <?php echo($rs['paisAutor'])?> 
                        </div>
                    </div>

                    <div class="container_info_autor">
                        <div class="info_autor">
                             Site: 
                        </div>
                        <div class="info_autor_respostas">
                            <a href="<?php echo($rs['siteAutor'])?>"><?php echo($rs['siteAutor'])?> </a>
                        </div>
                    </div>

                    <div class="container_info_autor">
                        <div class="info_autor">
                             Gêneros: 
                        </div>
                        <div class="info_autor_respostas">
                             <?php echo($rs['generoAutor'])?>   
                        </div>
                    </div>
                    <div id="descricao_autor">
                        <?php echo($rs['descricaoAutor'])?>             
                    </div>
                </div>
            </section>
            <!-- Fim da descrição do autor -->
            
            <!-- Livros escritos pelo autor -->
            <section id="section_livrosAutorDestaque">
                <div id="container_livrosAutordestaque">
                <?php while($rsLivros = mysqli_fetch_array($livro)){ ?>
                    <div class="livroAutorDestaque">
                        <div class="img_AutorDestaque">
                            <img src="<?php echo($rsLivros['imagemLivro']) ?>" class="img_livroAutor" alt=" <?php echo($rsLivros['nomeLivro'])  ?>" title=" <?php echo($rsLivros['nomeLivro'])  ?>">
                        </div>
                        <div class="descricao_Autordestaque">
                            <p> <?php echo($rsLivros['nomeLivro'])  ?></p>
                        </div>
                    </div>
                    <?php } ?> 
                </div>
            </section>
            <!-- Fim do livros escritos pelo autor -->
        </div>
        
        <!-- Rodapé -->
        <footer>
            <div class="footer">
            
            </div>
        </footer>
        <!-- Fim do rodapé -->
    </body>
</html>
