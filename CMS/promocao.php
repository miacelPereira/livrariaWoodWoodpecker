<div id="modalEditPromo">
    <div id="auxModalEditPromo">
        <div id="closeModalEditPromo"></div>
        <div id="contentModalEditPromo"></div>
    </div>
</div>

<?php 
    require_once("header.php");
    require_once("../functionsPHP/conexaoDB.php");
    $db = conexaoBD();

/*****************************************************************/
/* Select de livros */
    $selectLivros="select * from tbl_livro";
    $rsLivro =  mysqli_query($db, $selectLivros);

/*****************************************************************/
/* Salvar promoção */

    if(isset($_GET['btnPromocaoSalvar'])){    
        $idLivroAdd = $_GET['sleLivros'];
        $porcentagem = $_GET['txtporcentagemdesconto'];
        if($porcentagem >=100){
             echo("<span style='margin-left:400px; color: red; font-weight:800;'> Descontos só podem ser feito abaixo de 100% do valor do produto </span>");
        }else{
            /*********************************************/
            /* Resgatando o preço do livro para efetuar a conta  do desconto */
            $sqlPreco = "select * from tbl_livro where idLivro = ".$idLivroAdd;
            $rsPreco = mysqli_query($db, $sqlPreco);
            $preco = mysqli_fetch_array($rsPreco);

            /*********************************************/
            /* calculando novo preço */
            $preco = $preco['precoLivro'];
            $precoaux = $preco * $porcentagem;
            $desconto = $precoaux/100;
            $precofinal = $preco - $desconto;


            /*********************************************/
            /* Select para verificar se já existe uma promoção para o livro */
            $sqlConfir = "select * from tbl_livropromocao where idLivro = ".$idLivroAdd;
            $rsPreco = mysqli_query($db, $sqlConfir);
            $confirm = mysqli_fetch_array($rsPreco);



            if($confirm == null){
                /*********************************************/
                /* Insert da promoção no banco */
                $insertPromo = "insert into tbl_livropromocao(idLivro, valor, ativado) values ('".$idLivroAdd."', '".$precofinal."', 1)";
                $promo = mysqli_query($db, $insertPromo);
                header('location:promocao.php');
             }else{
                echo("<span style='margin-left:510px; color: red; font-weight:800;'> O livro já tem uma promoção </span>");
             }

            }
        }
           
    /***************************************************/
    /* Select para preencher a tabela */
    $slcLivrosPromocao = "select tbl_livro.*, tbl_livropromocao.* from tbl_livro, tbl_livropromocao where tbl_livro.idLivro = tbl_livropromocao.idLivro";
    $rsLivroPromocao = mysqli_query($db, $slcLivrosPromocao);
    
    /***************************************************/
    /* Editar e Excluir promocao */
    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        $id = $_GET['idLivro'];
        
        if($modo == "excluir"){
            $stringDelete = "delete from tbl_livropromocao where idLivro = ".$id;
            mysqli_query($db, $stringDelete);
            header('location:promocao.php');
        }
    }
    /***************************************************/
    /* Ativar promoção */
    if(isset($_GET['ativado'])){
        $ativacao = $_GET['ativado'];
        $idAtivacao = $_GET['id'];
        if($ativacao == "ativar"){
            $updateAtivado = "update tbl_livropromocao set ativado = 1 where idLivro =".$idAtivacao;
            mysqli_query($db, $updateAtivado);
        }if($ativacao == "desativar"){
            $updateAtivado = "update tbl_livropromocao set ativado = 0 where idLivro =".$idAtivacao;
            mysqli_query($db, $updateAtivado);
        }
        header('location:promocao.php'); 
    }
?>
<setion id="alter_cms">
    <!-- Parte de alterar conteudos do site -->
    <div id="admConteudo">
        <nav id="nav_alter_cms">
            <a href="livroMes.php"> <div class="item_menu_alter_cms"> Livro do mês </div></a>
            <a href="autorMes.php"><div class="item_menu_alter_cms"> Autor em destaque </div></a>
            <a href="nossasLojas.php"><div class="item_menu_alter_cms"> Nossas lojas </div></a>
            <a href="sobre.php"><div class="item_menu_alter_cms"> Sobre </div></a>
            <a href="promocao.php"><div class="item_menu_alter_cms"> Promoção </div></a>
        </nav>
        <h1 id="titlePromocao"> Promoção </h1>
        <form name="frmAddPromocao" action="promocao.php" method="get">
            <table id="tblAddPromo">
                <tr>
                    <td>Livro</td>
                    <td>
                        <select name="sleLivros">
                            <?php while ($Livros = mysqli_fetch_array($rsLivro)){?>
                            <option value="<?php echo($Livros['idLivro'])?>"><?php echo($Livros['nomeLivro'])?> </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Porcentagem do desconto</td>
                    <td><input type="text" name="txtporcentagemdesconto" id="txtporcentagemdesconto" required="required" onkeypress="return validar(event, 'txt', this.id);" maxlength="2"></td>
                </tr>
            </table>
            <input type="submit" name="btnPromocaoSalvar" id="btnPromocaoSalvar">
        </form>
        <div id="containertblSobre">
            <table>
                <tr id="titleTblPromo">
                    <td style="border-top-left-radius:8px;">Nome</td>
                    <td>Imagem</td>
                    <td>Autor</td>
                    <td>Preço</td>
                    <td>Preço na promoção</td>
                    <td colspan="2">Opções</td>
                    <td  style="border-top-right-radius:8px;">Ativar/Desativar</td>
                </tr>
                <?php while($rsPromocao = mysqli_fetch_array($rsLivroPromocao)){ ?>
                <tr class="linecontentpromo">
                    <td><?php echo($rsPromocao['nomeLivro']); ?></td>
                    <td><img src="../<?php echo($rsPromocao['imagemLivro']) ?>" style="width: 50px; height: 70px;"></td>
                    <td><?php echo($rsPromocao['AutorLivro']); ?></td>
                    <td>R$<?php echo($rsPromocao['precoLivro']); ?></td>
                    <td>R$<?php echo($rsPromocao['valor']); ?></td>
                    <td><a href="#" class="modalPromocao" onClick="openModalPromocao(<?php echo($rsPromocao['idLivro']); ?>)" > <img src="image/editar.png" title="Editar" style="width: 20px; height: 20px;"></a></td>
                    <td><a href="promocao.php?modo=excluir&idLivro=<?php echo($rsPromocao['idLivro']); ?>"><img src="image/deletar.png" title="Excluir" style="width: 20px; height: 20px;"></a></td>
                    <td>
                        <?php if($rsPromocao["ativado"] == 0){?>
                        <a href="promocao.php?id=<?php echo($rsPromocao['idLivro']) ?>&ativado=ativar">
                             <img src="image/desativado.png" style="width: 20px; height: 20px;">
                        </a>
                        <?php
                        }if($rsPromocao["ativado"] == 1){?>
                        <a href="promocao.php?id=<?php echo($rsPromocao['idLivro']) ?>&ativado=desativar">
                            <img src="image/ativado.png" style="width: 20px; height: 20px;">
                        </a>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</setion>

<?php 
    require_once("footer.php");
?>