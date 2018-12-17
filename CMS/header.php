<?php
    session_start();

    if(!isset($_SESSION['nome'])){
        header('location:../index.php');
    }
    if(isset($_GET['logout'])){
        session_destroy();
        header('location:../index.php');
    }

?>
<!DOCTYPE>
<html lang="pt-br">
		<head>
			<meta charset="utf-8">
			<title>CMS</title>
			<link rel="stylesheet" type="text/css" href="css/style.css">
			<link rel="stylesheet" type="text/css" href="css/reset.css">
           
            <script src="js/jquery.js"></script>
            <script src="js/jsGeral.js"></script>
			<script type="text/javascript" src="js/script.js"></script>
            
		</head>
		<body>
			<main>
				<!-- Cabeçalho -->
				<header>
					<div id="title_header">
						<span id="cms_title">CMS </span> Sistema de gerenciamento do Site
					</div>
					<div id="logo_header">
						<img id="img_logo_header" src="image/cms.png"0>
					</div>
				</header>
				<!-- Fim do Cabeçalho -->
				<!-- Dados entre o cabeçalho e as alterações -->
				<section id="option_cms">
					<!-- Menu cms -->
					<nav id="nav_pages_site">
						<a href="livroMes.php"><div class="content_nav_pages_site" id="div_adm_conteudo" onclick="mudarTela(this.id)">
                            <div class="img_nav_pages_site">
                                <img class="img_nav_pages_site" id="item_conteudo">
                            </div>
                            Adm. Conteúdo
						</div></a>
						<a href="faleConosco.php"><div class="content_nav_pages_site" id="div_adm_fale_conosco" onclick="mudarTela(this.id)">
                            <div class="img_nav_pages_site">
                                <img class="img_nav_pages_site" id="item_faleConosco">
                            </div>
                            Adm. Fale Conosco
						</div></a>
						<a href="listlivros.php"> <div class="content_nav_pages_site" id="div_adm_produtos">
                            <div class="img_nav_pages_site">
                                <img class="img_nav_pages_site" id="item_produtos">
                            </div>
                            Adm. Produtos
						</div></a>
						<a href="alteracaousuario.php"><div class="content_nav_pages_site" id="div_adm_usuario">
                            <div class="img_nav_pages_site">
                                <img class="img_nav_pages_site" id="item_user">
                            </div>
                            Adm. Usuários 
						</div></a>
					</nav>
					<!-- Fim do menu cms -->
					<div id="cms_data_user">
						<div id="welcome_user">
							Bem-vindo <?php echo($_SESSION['nome']) ?>
						</div>
						<div id="logout_cms">
							<a href="header.php?logout=sim"><img src="image/sair.png" style="width:40px; height:40px;"></a>
						</div>
					</div>
				</section>