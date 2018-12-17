<?php
    require_once('../functionsPHP/conexaoDB.php');
    $db = conexaoBD();

    $id = $_GET['id'] ;
    
    $stringSelectUser = "select * from tbl_usuario where id = ".$id;
    $selectUser = mysqli_query($db, $stringSelectUser);
    $rsUsuario = mysqli_fetch_array($selectUser);

    $stringSelectNivel = "select * from tbl_niveisusuario";
    $selectNivel = mysqli_query($db, $stringSelectNivel);
    

?>


<html>
    <head> 
        <style>
            body{
                width: 100%;
                height: 100%;
                text-align: center;
                font-family: sans-serif;
            }
            #tblEditUser{
                width: 500px;
                font-size: 20px;
                margin: auto;
                margin-top: 50px;
                text-align: center;
            }
            td{
                text-align: left;
                height: 50px;
                line-height: 50px;
            }
            .txtResposta{
                width: 300px;
                text-align: center;
                border: none;
                font-size: 20px;
                border-bottom: 1px solid #608bd1;
            }
            #btnFrmAlterUser{
                width: 150px;
                height: 40px;
                border: none;
                font-size: 18px;
                color: #ffffff;
                margin-top: 10px;
                margin-left: 310px;
                background-color: #415982;
                border-radius: 8px;
                
            }
            #btnFrmAlterUser:hover{
                cursor: pointer;
            }
            
        </style>
    </head>
    <body>
        <h1> Editar Usuário </h1>
        <form name="frmEditUser" method="POST" action="alteracaousuario.php?idUserEdit=<?php echo($id)?>">
            <table id="tblEditUser">
                <tr>
                    <td>Primeiro nome:</td>
                    <td><input type="text" name="txtPrimeiroNomeEdit" id="txtPrimeiroNome" class="txtResposta" value="<?php echo($rsUsuario['firstname_usuario']) ?>" required="required" onkeypress=" return validar(event, 'num', this.id);" maxlength="15"> </td>
                </tr>
                <tr>
                    <td>Último nome:</td>
                    <td><input type="text" name="txtUltimoNomeEdit" id="txtUltimoNome" class="txtResposta"  value="<?php echo($rsUsuario['lastname_usuario']) ?>" required="required" onkeypress=" return validar(event, 'num', this.id);" maxlength="20">  </td>
                </tr>
                <tr>
                    <td>Login:</td>
                    <td><input type="text" name="txtLoginEdit" id="txtLogin" class="txtResposta" value="<?php echo($rsUsuario['login_usuario']) ?>" required="required" maxlength="20"> </td>
                </tr>
                <tr>
                    <td>Senha:</td>
                    <td><input type="password" name="txtSenhaEdit" id="txtSenha" class="txtResposta"  value="<?php echo($rsUsuario['senha_usuario']) ?>" required="required" maxlength="15"></td>
                </tr>
                <tr>
                    <td>Confirme a senha: </td>
                    <td><input type="password" name="txtConfSenhaEdit" id="txtConfSenha" class="txtResposta" value="<?php echo($rsUsuario['senha_usuario']) ?>" required="required" maxlength="15"></td>
                </tr>
                <tr>
                    <td>Nível:</td>
                    <td>
                        <select name="sltFrmEditUser" class="txtResposta">
                            <?php while($rsNivel=mysqli_fetch_array($selectNivel)){ ?>
                            <option value="<?php echo($rsNivel['id_nivelUsuario'])?>"> <?php echo($rsNivel['nivelUsuario']) ?> <?php $rsNivel['id_nivelUsuario']?></option>
                            <?php }?>
                        </select>
                    </td>
                </tr>
            </table>
            <input type="submit" name="btnFrmAlterUser" id="btnFrmAlterUser"  value="Salvar">
        </form>
    </body>
</html>