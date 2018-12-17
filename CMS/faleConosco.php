
<div id="containerModalFale">
    <div id="modalFaleConosco">
        <div id="closeModal"> </div>
        <div id="ContentmodalFaleConosco"></div>    
    </div>
</div>
<?php  
    require_once('header.php');
    require_once('../functionsPHP/conexaoDB.php');
    $conexao = conexaoBD();
    
    //Excluir
    if(isset($_GET['id']) && isset($_GET['modo'])){
        $id = $_GET['id'];
        $modo = $_GET['modo'];
        if($modo == 'excluir'){
                $sqlExcluir = "DELETE FROM tbl_fale_conosco WHERE id=".$id;
                mysqli_query($conexao, $sqlExcluir);
            }
        }
    
    $sql2 = "select * from tbl_fale_conosco";
    $select = mysqli_query($conexao, $sql2);
?>
<div id="admFaleConosco">
    <table id="tbl_faleConosco">
        <tr id="title_table">
            <th class="line_table_title">Nome</th>  
            <th class="line_table_title">Sexo</th>  
            <th class="line_table_title">E-mail</th> 
            <th class="line_table_title">Excluir</th>
            <th class="line_table_title">Visualizar</th>  
        </tr>
        <?php
            while($rsContatos=mysqli_fetch_array($select)){ 
        ?>
        <tr class="nomes_form">
            <td class="line_table">
                <?php echo($rsContatos['nomeContato'])?>
            </td>
            <td class="line_table">
                <?php echo($rsContatos['sexoContato'])?>
            </td>
            <td class="line_table">
                <?php echo($rsContatos['emailContato'])?>
            </td>
            <td class="line_table">
                <a href="faleConosco.php?modo=excluir&id=<?php echo($rsContatos['id'])?>">
                <img src="image/deletar.png" title="Excluir" style="width: 20px; height: 20px;">
                </a>
            </td>
            <td class="line_table">
                <a href="#" class="visualizar" onclick="modal(<?php echo($rsContatos['id'])?>)">
                <img src="image/visualizar.png" title="Visualizar" style="width: 20px; height: 20px;">
                </a>
            </td>
        <tr>
        <?php
            }
        ?>
    </table>
</div>
    <?php require_once('footer.php');?>