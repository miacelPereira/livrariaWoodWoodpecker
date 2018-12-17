<?php 
    require_once('../functionsPHP/conexaoDB.php');
    $conexao = conexaoBD();
    
    $sql2 = "select * from tbl_fale_conosco";
    $select = mysqli_query($conexao, $sql2);
    
    require_once('header.php');

?>	
            <div id="imgHome"> <img src="image/home.png">  </div>
            <?php require_once('footer.php'); ?>
    