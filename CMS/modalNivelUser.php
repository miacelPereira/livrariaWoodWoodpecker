<?php 
    require_once('../functionsPHP/conexaoDB.php');
    $dbEditLoja = conexaoBD();
    
    if(isset($_GET['id'])){
       $id = $_GET['id'];
    
       $sqlPesquisa = "select nivelUsuario from tbl_niveisusuario where id_nivelUsuario = ".$id;
       $select = mysqli_query($dbEditLoja, $sqlPesquisa);

        $rs = mysqli_fetch_array($select);
    }
?>
<html>
    <head>
        
        <style>
            body{
                width: 600px;
                height: 500px;
                text-align: center;
            }
            #btnfrmEditar{
                background-color: blue;
                width: 100px;
                height: 70px;
                color: white;
            }
        </style>
        
    </head>
    <body>
        <h1> Tela de edição </h1>
        <p> <?php echo($rs['nivelUsuario'])  ?> </p>
        <form method="POST" name="frmEditar" action="nivelUsuario.php?id=<?php echo($id) ?>" >
            Novo nome: <input type="text" name="txtNomeNovo" id="txtNomeNovo" required="required" onkeypress=" return validar(event, 'num', this.id);" maxlength="15"><br>
            <input type="submit" name="btnfrmEditar" id="btnfrmEditar" value="Editar">
        </form>
    </body>
</html>