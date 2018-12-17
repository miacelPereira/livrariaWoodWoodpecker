<?php
    /* LOGAR */
    function FunctionLogin($usuario, $senha){
        require_once("functionsPHP/conexaoDB.php");
        $db = conexaoBD();
        
        $sqlLogin = "select * from tbl_usuario where login_usuario ='".$usuario."' and senha_usuario='".$senha."' and ativado = 1";
        $login = mysqli_query($db, $sqlLogin);
        
        if($rsLogin = mysqli_fetch_array($login)){
            /* Iniciado as variaveis de sessão */
            session_start();
            $_SESSION['nome'] = $rsLogin['firstname_usuario'];
            $_SESSION['nivel'] = $rsLogin['tbl_niveisUsuario_id_nivelUsuario'];
            header("location:CMS/index.php");
        }else{
            echo("<script>alert('Usuário ou senha inválido')</script>");
        }
    }
    
?>