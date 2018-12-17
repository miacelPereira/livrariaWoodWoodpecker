<?php
    require_once("functionsPHP/conexaoDB.php");
    require_once("functionsPHP/login.php");
    $db = conexaoBD();

    /******** SELECT DE LIVROS ********/
    $stringLivros = "select tbl_livro.*, tbl_autor.nomeAutor from tbl_livro, tbl_autor where home = 1 and tbl_autor.idAutor = tbl_livro.idAutor order by rand()";
    $livros = mysqli_query($db, $stringLivros);

    /******** SELECT DAS CATEGORIAS ********/
    $stringCategoria = "select * from tbl_categoria_produto where status_categoria = 1";
    $categoria = mysqli_query($db, $stringCategoria);

    if(isset($_POST['btnFrmAutenticaHeader'])){
        $usuario = $_POST['txtUsuario'];
        $senha = $_POST['txtSenha'];
        FunctionLogin($usuario, $senha);
    }

    /***** MENU ******/
    if(isset($_GET['categoria'])){
        $idcat = $_GET['categoria'];
        $stringcats = "select tbl_livro.* from tbl_livro, tbl_subcategoria_produto, tbl_categoria_produto where tbl_subcategoria_produto.id_categoria = tbl_categoria_produto.id_categoria and tbl_livro.id_subcategoria = tbl_subcategoria_produto.id_subcategoria and tbl_categoria_produto.id_categoria = ".$idcat;
        $livros = mysqli_query($db, $stringcats);
    } 

    if(isset($_GET['subCategoria'])){
        $idSub = $_GET['subCategoria'];
        $stringLivros = "select tbl_livro.*, tbl_autor.nomeAutor from tbl_livro, tbl_autor where tbl_autor.idAutor = tbl_livro.idAutor and tbl_livro.id_subcategoria = ".$idSub;
        $livros = mysqli_query($db, $stringLivros);
        
    }   
    if(isset($_GET['txtBusca'])) {
        $q = $_GET['txtBusca']; 
        $sqlLivro ="select tbl_livro.* from tbl_livro where tbl_livro.nomeLivro like '%$q%' or tbl_livro.descricaoLivro like '%$q%'";
        $livros = mysqli_query($db, $sqlLivro);
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
        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/script.js"></script>
        <script src="js/function.js"></script>
        
        <div id="containerModalHome">
            <div id="contentModalHome">
                <div id="closeModalHome"></div>
                <div id="infoModalHome"></div>
            </div>
        </div>
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
                
                <!-- Altenticação do funcionário -->
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
            <div class="container_content">
                
                <!-- Slider -->
                <div id="slider_container">
                        <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
                <script src="js/jssor.slider-27.5.0.min.js" type="text/javascript"></script>
                <script type="text/javascript">
                    jQuery(document).ready(function ($) {

                        var jssor_1_SlideshowTransitions = [
                          {$Duration:800,$Opacity:2}
                        ];

                        var jssor_1_options = {
                          $AutoPlay: 1,
                          $SlideshowOptions: {
                            $Class: $JssorSlideshowRunner$,
                            $Transitions: jssor_1_SlideshowTransitions,
                            $TransitionsOrder: 1
                          },
                          $ArrowNavigatorOptions: {
                            $Class: $JssorArrowNavigator$
                          },
                          $BulletNavigatorOptions: {
                            $Class: $JssorBulletNavigator$
                          }
                        };

                        var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

                        /*#region responsive code begin*/

                        var MAX_WIDTH = 1100;

                        function ScaleSlider() {
                            var containerElement = jssor_1_slider.$Elmt.parentNode;
                            var containerWidth = containerElement.clientWidth;

                            if (containerWidth) {

                                var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                                jssor_1_slider.$ScaleWidth(expectedWidth);
                            }
                            else {
                                window.setTimeout(ScaleSlider, 30);
                            }
                        }

                        ScaleSlider();

                        $(window).bind("load", ScaleSlider);
                        $(window).bind("resize", ScaleSlider);
                        $(window).bind("orientationchange", ScaleSlider);
                        /*#endregion responsive code end*/
                    });
                </script>
                <style>

                    .jssorl-009-spin img {
                        animation-name: jssorl-009-spin;
                        animation-duration: 1.6s;
                        animation-iteration-count: infinite;
                        animation-timing-function: linear;
                    }

                    @keyframes jssorl-009-spin {
                        from { transform: rotate(0deg); }
                        to { transform: rotate(360deg); }
                    }

                    /*jssor slider bullet skin 051 css*/
                    .jssorb051 .i {position:absolute;cursor:pointer;}
                    .jssorb051 .i .b {fill:#fff;fill-opacity:0.5;}
                    .jssorb051 .i:hover .b {fill-opacity:.7;}
                    .jssorb051 .iav .b {fill-opacity: 1;}
                    .jssorb051 .i.idn {opacity:.3;}

                    /*jssor slider arrow skin 051 css*/
                    .jssora051 {display:block;position:absolute;cursor:pointer;}
                    .jssora051 .a {fill:none;stroke:#fff;stroke-width:360;stroke-miterlimit:10;}
                    .jssora051:hover {opacity:.8;}
                    .jssora051.jssora051dn {opacity:.5;}
                    .jssora051.jssora051ds {opacity:.3;pointer-events:none;}
                </style>
                <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:270px;overflow:hidden;visibility:hidden;">
                    <!-- Loading Screen -->
                    <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                        <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/spin.svg" />
                    </div>
                    <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:270px;overflow:hidden;">
                        <div>
                            <img class="img_slider" data-u="image" src="img/001.jpg" alt="Imagem Slider" title="Imagem Slider"/>
                        </div>
                        <div>
                            <img data-u="image" src="img/002.jpg" alt="Imagem Slider" title="Imagem Slider"/>
                        </div>
                        <div>
                            <img data-u="image" src="img/003.jpg" alt="Imagem slider" title="Imagem slider"/>
                        </div>
                        <div>
                            <img data-u="image" src="img/004.jpg" alt="Imagem slider" title="Imagem slider"/>
                        </div>
                        <div>
                            <img data-u="image" src="img/005.jpg" alt="Imagem slider" title="Imagem slider"/>
                        </div>
                        <div>
                            <img data-u="image" src="img/006.jpg" alt="Imagem slider" title="Imagem slider"/>
                        </div>
                        <div>
                            <img data-u="image" src="img/007.jpg" alt="Imagem slider" title="Imagem slider"/>
                        </div>
                        <div>
                            <img data-u="image" src="img/008.jpg" alt="Imagem slider" title="Imagem slider"/>
                        </div>
                        <div>
                            <img data-u="image" src="img/009.jpg" alt="Imagem slider" title="Imagem slider"/>
                        </div>
                        <div>
                            <img data-u="image" src="img/010.jpg" alt="Imagem slider" title="Imagem slider"/>
                        </div>
                        <div>
                            <img data-u="image" src="img/011.jpg" alt="Imagem slider" title="Imagem slider"/>
                        </div>
                        <div>
                            <img data-u="image" src="img/012.jpg" alt="Imagem slider" title="Imagem slider"/>
                        </div>
                    </div>
                    <!-- Bullet Navigator -->
                    <div data-u="navigator" class="jssorb051" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
                        <div data-u="prototype" class="i" style="width:16px;height:16px;">
                            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                            </svg>
                        </div>
                    </div>
                    <!-- Arrow Navigator -->
                    <div data-u="arrowleft" class="jssora051" style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                        <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                            <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
                        </svg>
                    </div>
                    <div data-u="arrowright" class="jssora051" style="width:55px;height:55px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                        <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                            <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
                        </svg>
                    </div>
                </div>
                </div>
                <!-- Fim do slider -->
                
                <!-- Menu lateral -->
                <div id="menu_container_content">
                    <form name="frmBusca" id="frmBusca" method="get" action="index.php">
                        <input type="search" id="txtBusca" name="txtBusca" placeholder="Buscar...">
                        <div id="btnBusca" name="btnBusca" onclick="submitBusca()"></div>
                    </form>
                    <nav id="menu_content">
                        <ul id="menu_container">
                            <?php while($rsCat = mysqli_fetch_array($categoria)){?>
                                <a href="index.php?categoria=<?php echo($rsCat['id_categoria']) ?>" > 
                                    <li class="menu_container_item"> <?php echo($rsCat['nome_categoria']) ?> 
                                        <ul id='submenuHome'> 
                                            <?php 
                                                    $idcat = $rsCat['id_categoria'];
                                                    $stringcats = "select * from tbl_subcategoria_produto where id_categoria = ".$idcat;
                                                    $sub = mysqli_query($db, $stringcats);
                                                    while($rsSub = mysqli_fetch_array($sub)){ ?>
                                                        <a href="index.php?subCategoria=<?php echo($rsSub['id_subcategoria']) ?>"><li><?php echo($rsSub['nome_subcategoria']) ?></li> </a>

                                                    <?php } ?>
                                        </ul>
                                    </li>
                                </a>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
                <!-- Fim do menu lateral -->
                
                <!-- Produtos -->
                <section id="section_produto_container_content">
                    <?php  while($rsLivro = mysqli_fetch_array($livros)){ ?>
                    
                    <div class="produto">
                        <div class="produto_imagem">
                            <img src="<?php echo($rsLivro['imagemLivro']) ?>"  class="img_produto_home" alt="Clock Dance" title="Clock Dance">
                        </div>
                        <div class="detalhes_produto">
                            <div class="descricaoLivro_home">
                                Nome:
                            </div>
                            <div class="descricaoLivroResposta_home">
                                <?php echo($rsLivro['nomeLivro']) ?>
                            </div>
                            <div class="descricaoLivro_home">
                                Descrição:
                            </div>
                            <div class="descricaoLivroResposta_home">
                                O livro <?php echo($rsLivro['nomeLivro']) ?>...
                            </div>
                            <div class="descricaoLivro_home">
                                Preço:
                            </div>
                            <div class="descricaoLivroResposta_home">
                                R$ <?php echo($rsLivro['precoLivro']) ?>
                            </div>
                            <div class="detalhesDescricaoLivro_home">
                                <a href="#" class="openModalHome" onclick="openModalHome(<?php echo($rsLivro['idLivro']) ?>)"> Detalhes </a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </section>
            </div>
            <!-- Fim dos Produtos -->
            
            <!-- Redes Sociais -->
            <div id="redes_sociais">
                 <section id="container_redes_sociais">
                    <div class="rede_social">
                       <a href="https://pt-br.facebook.com/"> <img src="image/facebook.png" class="img_redesSociais" title="Facebook" alt="Facebook"></a>
                    </div>
                    <div class="rede_social">
                        <a href="https://plus.google.com/discover"><img src="image/google.png" class="img_redesSociais" title="Google+" alt="Google plus"></a>
                    </div>
                    <div class="rede_social">
                        <a href="https://twitter.com/"><img src="image/twitter.png" class="img_redesSociais" title="Twitter" alt="Twitter"></a>
                    </div>
                </section>
            </div>
            <!-- Fim redes Sociais -->
            
        </div>
        
        <!-- Rodapé -->
        <footer>
            <div class="footer">
            </div>
        </footer>
        <!-- Fim do rodapé -->
        
    </body>
</html>
