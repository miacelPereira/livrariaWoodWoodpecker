<?php 
    require_once("functionsPHP/conexaoDB.php");
    $db = conexaoBD();

    require_once("functionsPHP/login.php");
    if(isset($_POST['btnFrmAutenticaHeader'])){
        
        $usuario = $_POST['txtUsuario'];
        $senha = $_POST['txtSenha'];
        FunctionLogin($usuario, $senha);
    }
    
    $select = "select * from tbl_enderecoloja where ativada != 0";
    $rsSelect = mysqli_query($db, $select);

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
        <script src="js/script.js"></script>
        
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
                
                <!-- Autenticação do funcionario -->
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
            <div id="container_nossasLojas">
                
                <!-- Menu dos endereços -->
                <nav id="menu_nossasLojas">
                    <?php while($rs = mysqli_fetch_array($rsSelect)){ ?>
                    <div class="containerContent_menuNossasLojas">
                        <div class="image_menuNossasLojas">
                            <img class="img_menuNossasLojas" src="image/logo_menu.png" alt="Logo Wood Woodpecker" title="Wood Woodpecker">
                        </div>
                        <div class="title_menuNossasLojas">
                            <h3> <?php echo($rs['cidadeLoja']." - ".$rs['estadoLoja'] ) ?></h3>
                        </div>
                        <div class="text_menuNossasLojas">
                            <p> <?php echo($rs['logradouroLoja']." ".$rs['nomeLogradouro'].", ".$rs['numeroLoja'].", ". $rs['bairroLoja'].", ".$rs['cidadeLoja']." - ".$rs['estadoLoja']);?> </p>
                        </div>
                    </div>
                    <?php }?>
                    <div class="containerContent_menuNossasLojas">
                        <div class="image_menuNossasLojas">
                            <img class="img_menuNossasLojas" src="image/logo_menu.png" alt="Logo Wood Woodpecker" title="Wood Woodpecker">
                        </div>
                        <div class="title_menuNossasLojas">
                            <h3> BARUERI - SP</h3>
                        </div>
                        <div class="text_menuNossasLojas">
                            <p> ESTRADA DAS MARINAS, 200 , LOJA 139 LOJA 140 LOJA 141 - PRAIA DO JARDIM
                                ANGRA DOS REIS - RJ </p>
                        </div>
                    </div>
                    
                </nav>
                <!-- Fim do menu dos endereços -->
                
                <!-- Mapa das lojas usando a API do Google Maps -->
                <div id="mapa_nossasLojas">
                    <div id="map"></div>
                    <script src="https://maps.googleapis.com/maps/api/js?callback=myMap"></script>
                </div>
            </div>
            <!-- Fim do mapa -->
        </div>
        
        <!-- Rodapé -->
        <footer>
            <div class="footer">
                
            </div>
        </footer>
        <!-- Fim do rodapé -->
        
    </body>
</html>
