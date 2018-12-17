<?php
    require_once("functionsPHP/conexaoDB.php");
    $db = conexaoBD();

    require_once("functionsPHP/login.php");
    if(isset($_POST['btnFrmAutenticaHeader'])){
        
        $usuario = $_POST['txtUsuario'];
        $senha = $_POST['txtSenha'];
        FunctionLogin($usuario, $senha);
    }

    $stringSelect="select * from tbl_sobrewood where ativado = 1";
    $select = mysqli_query($db, $stringSelect);
    $rs = mysqli_fetch_array($select);

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
            <section id="section_sobre">
               <h1 id="titulo_sobre"> <?php echo($rs['tituloSobre']) ?> </h1> 
                
                <!-- Imagem da sede da empresa -->
                <div id="figure_sobre_sede" style="background-size: 90% 60%;background-repeat: no-repeat;background-image: url(<?php echo($rs['imagemSobre']) ?>);background-attachment: fixed;">
                </div>
                
                <!-- Descrição da Wood -->
                <div id="descrição_sobre">
                    <p> <?php echo($rs['descricaoSobre']) ?></p>
                </div>
                
                <!-- Informações sobre vendas, funcionarios e entrega -->
                <div id="container_info_sobre">
                    <div class="content_info_sobre">
                        <figure class="figure_info_sobre">
                            <img src="image/sobre/colaboradores.png" alt="Colaboradores Wood" title="Colaboradores Wood" class="img_sobre_info"/>
                        </figure>
                        <div class="desc_info_sobre">
                            Mais de <?php echo($rs['funcionarioSobre']) ?> colaboradores
                        </div>
                    </div>
                    <div class="content_info_sobre">
                        <figure class="figure_info_sobre">
                            <img src="image/sobre/venda.png" alt="Carrinho de venda" title="Vendas Wood" class="img_sobre_info"/>
                        </figure>
                        <div class="desc_info_sobre">
                            Desde 2005, já foram mais de <?php echo($rs['vendaSobre']) ?> de vendas
                        </div>
                    </div>
                    <div class="content_info_sobre">
                        <figure class="figure_info_sobre">
                            <img src="image/sobre/envio.png" alt="Avião" title="Entregas Wood" class="img_sobre_info"/>
                        </figure>
                        <div class="desc_info_sobre">
                            Aproximadamente <?php echo($rs['tempoEntrega']) ?> dias para entregar o seu produto
                        </div>
                    </div>
                    <!-- Fim das informações sobre vendas, funcionarios e entrega -->
                    
                    <!-- Parte de agradecimento a empresas parceiras -->
                    <section id="agradecimentos_sobre">
                        <h1 id="agradecimento_sobre"> Agradecimentos </h1>
                        <figure class="img_agradecimento_sobre">
                            <img src="image/sobre/abril.png" alt="Logo Abril" title="Editora Abril" class="adradecimento_sobre"/>
                        </figure>
                        <figure class="img_agradecimento_sobre">
                            <img src="image/sobre/bph.png" alt="Logo BPH" title="Editora BPH" class="adradecimento_sobre"/>
                        </figure>
                        <figure class="img_agradecimento_sobre">
                            <img src="image/sobre/saraiva.png" alt="Logo Saraiva" title="Editora Saraiva" class="adradecimento_sobre"/>
                        </figure>
                        <figure class="img_agradecimento_sobre">
                            <img src="image/sobre/peru.png" alt="Logo Perú" title="Editora Perú" class="adradecimento_sobre"/>
                        </figure>
                        <figure class="img_agradecimento_sobre">
                            <img src="image/sobre/intrinseca.png" alt="Logo Intrinseca" title="Editora Intrinseca" class="adradecimento_sobre"/>
                        </figure>
                        <figure class="img_agradecimento_sobre">
                            <img src="image/sobre/sextante.png" alt="Logo Sextante" title="Editora Sextante" class="adradecimento_sobre"/>
                        </figure>
                    </section>
                    <!-- Fim parte de agradecimento a empresas parceiras -->
                </div>
            </section>
        </div>
        
        <!-- Rodapé -->
        <footer>
            <div class="footer">
            
            </div>
        </footer>
        <!-- Fim do rodapé -->
    </body>
</html>
