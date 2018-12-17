<?php 
    require_once('functionsPHP/conexaoDB.php');
    $conexao = conexaoBD();

    require_once("functionsPHP/login.php");
    if(isset($_POST['btnFrmAutenticaHeader'])){
        
        $usuario = $_POST['txtUsuario'];
        $senha = $_POST['txtSenha'];
        FunctionLogin($usuario, $senha);
    }
    
    if(isset($_POST['btnFrmAutenticaHeader'])){
        $usuario =  $_POST['txtUsuario'];
        $senha = $_POST['txtSenha'];
        login($usuario, $senha); 
    }

    //VERIFICANDO SE A PESSOA APERTOU O BOTÃO E PEGANDO OS DADOS DOS CAMPOS
    if(isset($_POST["btn_frmFaleConosco"])) {
        $nome = $_POST["txtNome_faleConosco"];
        $telefone = $_POST["txtTelefone_faleConosco"];
        $celular = $_POST["txtCelular_faleConosco"];
        $email = $_POST["txtEmail_faleConosco"];
        $homepage = $_POST["txtHomePage_faleConosco"];
        $facebook = $_POST["txtLinkFacebook_faleConosco"];
        $sexo = $_POST["selectSexo_faleConosco"];
        $critica =  $_POST["txtSugestao_faleConosco"];
        $infomacaoProduto =  $_POST["txtInfProduto_faleConosco"];
        $profissao = $_POST["txtProfi_faleConosco"];
        
        //ENVIADO AS INFORMAÇÕES PARA O BANCO
        $sql = "insert into tbl_fale_conosco(nomeContato, emailContato, sexoContato, profissaoContato, telefoneContato, celularContato, homePageContato, contaFacebookContato, critica_e_sugestaoContato, infoProdutoContato) values('".$nome."', '".$email."', '".$sexo."', '".$profissao."', '".$telefone."', '".$celular."', '".$homepage."', '".$facebook."', '".$critica."', '".$infomacaoProduto."')";
        
        mysqli_query($conexao, $sql);
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
        
        <!-- INICIO DO CABEÇALHO -->
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
        <!-- FIM DO CABEÇALHO -->
        
        
        <div class="container_site">
            <div id="container_fale_conosco">
                <section id="fale_conosco">
                    <!-- TITULO DA PÁGINA -->
                    <h1 id="titulo_faleConosco"> Entre em contato com a Woody Woodpecker!</h1>
                   
                    <!-- CAMPOS PARA ENTRAR EM CONTATO || OS CAMPOS QUE ESTÃO COM "*" NO FINAL SÃO OBRIGATÓRIOS  -->
                    <form name="frm_fale_conosco" id="inf_FaleConosco" action="faleConosco.php" method="post">
                         <div id="textFaleConosco">
                            <label class="txtFaleConosco"> Nome: </label>
                            <input type="text" name="txtNome_faleConosco" class="txtfaleConosco" value="" required="required" onkeypress=" return validar(event, 'num', this.id);" maxlength="100"><span class="obrigatorio_FaleConosco">*</span>
                             
                            <br><label class="txtFaleConosco"> Telefone: </label><input type="tel" name="txtTelefone_faleConosco" class="txtfaleConosco" value="" required="required" onkeypress=" return validar(event, 'txt', this.id);" maxlength="15"><span class="obrigatorio_FaleConosco">*</span>
                            
                             
                            <br><label class="txtFaleConosco"> Celular: </label><input type="tel" name="txtCelular_faleConosco" class="txtfaleConosco" value="" required="required" onkeypress=" return validar(event, 'txt', this.id);" maxlength="15"><span class="obrigatorio_FaleConosco">*</span>
                             
                            <br><label class="txtFaleConosco"> Email: </label><input type="email" name="txtEmail_faleConosco" class="txtfaleConosco" value="" required="required" maxlength="100" ><span class="obrigatorio_FaleConosco">*</span>
                             
                            <br><label class="txtFaleConosco"> Home Page: </label><input type="text" name="txtHomePage_faleConosco" class="txtfaleConosco" value="" maxlength="50">
                             
                            <br><label class="txtFaleConosco"> Link Facebook: </label><input type="text" name="txtLinkFacebook_faleConosco" class="txtfaleConosco" value="" maxlength="60">
                             
                             <br><label class="txtFaleConosco"> Sugestões ou Críticas: </label><textarea  row="5" cols="50" name="txtSugestao_faleConosco" class="txtfaleConosco" value="" id="txtSugestoes"></textarea>
                             
                            <br><label class="txtFaleConosco"> Informação do produto: </label><input type="text" name="txtInfProduto_faleConosco" class="txtfaleConosco" value="" maxlength="50">
                             
                            <br><label class="txtFaleConosco"> Sexo: </label>
                             <select name="selectSexo_faleConosco" class="txtfaleConosco">
                                  <option value="outros">Outros</option>
                                  <option value="masculino">Masculino</option>
                                  <option value="feminino">Feminino</option>
                            </select><span class="obrigatorio_FaleConosco">*</span>
                             
                           <br><label class="txtFaleConosco"> Profissão: <input type="text" name="txtProfi_faleConosco" class="txtfaleConosco" value="" required="required" maxlength="50"><span class="obrigatorio_FaleConosco" onkeypress=" return validar(event, 'num', this.id);">*</span> </label>
                             
                            <input type="submit" id="btn_frmFaleConosco" name="btn_frmFaleConosco" value="Enviar">
                        </div>
                    </form>
                </section>
            </div>
        </div>
        <!-- FIM DOS CAMPOS DE INFORMAÇÕES -->
        
        
        <!-- RODAPÉ -->
        <footer>
            <div class="footer">
            
            </div>
        </footer>
        <!-- FIM DO RODAPÉ -->
    </body>
</html>
