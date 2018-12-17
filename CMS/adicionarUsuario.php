<?php 
    require_once('header.php');
    require_once('../functionsPHP/conexaoDB.php');
    
    $conexao = conexaoBD();

    $sqlNiveis = "select * from tbl_niveisusuario";
    $niveis = mysqli_query($conexao, $sqlNiveis);
    

    
    if(isset($_POST["btnAdicionarUsuario"])){
        $firstname = $_POST['txtFirstName'];
        $lastname = $_POST['txtLasttName'];
        $login = $_POST['txtLogin'];
        $senha = $_POST['txtSenha'];
        $nivelUser = $_POST['selectUsuario'];
        
        $mysqlInsert = "insert into tbl_usuario (firstname_usuario, lastname_usuario, login_usuario, senha_usuario, tbl_niveisUsuario_id_nivelUsuario, ativado) values('".$firstname."','".$lastname."','".$login."','".$senha."','".$nivelUser."', 0)"; 
        mysqli_query($conexao, $mysqlInsert);
    }
?>
<div id="admUsuario">
    <nav id="nav_alter_cms">
        <a href="adicionarUsuario.php"><div class="item_menu_alter_cms"> Adicionar </div></a>
        <a href="alteracaousuario.php"> <div class="item_menu_alter_cms"> Alterar </div> </a>
        <a href="nivelUsuario.php"><div class="item_menu_alter_cms"> Nível de usuário </div></a>
    </nav>
    <div id="alter_user">
        <div id="bodyAdicionarUser">
            <h1 id="title_admUsuariosCadastrar">Cadastro de usuário</h1>
            <form method="post" action="adicionarUsuario.php" name="frmAdicionarContato">
                <table id="table_cadastrarUser">
                    <tr class="line_tableUser">
                        <td>Primeiro nome:</td>
                        <td><input type="text" name="txtFirstName" class="txtFrmAdicionarContato" onkeypress=" return validar(event, 'num', this.id);" required="required" maxlength="15"></td>
                    </tr>
                    <tr class="line_tableUser">
                        <td>Sobrenome:</td>
                        <td><input type="text" name="txtLasttName" class="txtFrmAdicionarContato" onkeypress=" return validar(event, 'num', this.id);" required="required" maxlength="20"></td>
                    </tr>
                    <tr class="line_tableUser">
                        <td>Login:</td>
                        <td><input type="text" name="txtLogin" class="txtFrmAdicionarContato" required="required" maxlength="20"></td>
                    </tr>
                    <tr class="line_tableUser">
                        <td>Senha:</td>
                        <td><input type="password" name="txtSenha" class="txtFrmAdicionarContato" required="required" maxlength="15"></td>
                    </tr>
                    <tr class="line_tableUser">
                        <td>Nível de Usuário:</td>
                        <td><select name="selectUsuario" class="txtFrmAdicionarContato">
                            <?php while ($rsNiveis = mysqli_fetch_array($niveis)){ ?>
                                <option value="<?php echo($rsNiveis['id_nivelUsuario'])?>"> <?php echo($rsNiveis['nivelUsuario'])  ?></option>
                            <?php } ?>
                        </select></td>
                    </tr>
                </table>
                <input type="submit" name="btnAdicionarUsuario" id="btnAdicionarUsuario" value="Salvar">
            </form>
        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>