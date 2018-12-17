/******************************************************************/
// Validação dos campos
function validar(caracter, type, id) {
    //código para proibir números
     if(type == "num") {
        /*Transformando a letra em ascii, o código de identificação*/
        if(window.event)
            var letra = caracter.charCode;
        else
            var letra = caracter.which;

        if(letra > 47 && letra <= 57) {
            return false; /*Cancela a ação da tecla*/
        }

         //código para proibir caracteres não númericos
     } else if(type == "txt") {
         if(window.event)
            var letra = caracter.charCode;
        else
            var letra = caracter.which;

        if(letra < 47 || letra > 57) {
            return false; /*Cancela a ação da tecla*/
        }
     }
}

// Fale conosco
$(document).ready(function(){
        //Function para abrir a janela Modal
        $(".visualizar").click(function(){
           $("#containerModalFale").fadeIn(500);
        });
         $("#closeModal").click(function(){
           $("#containerModalFale").fadeOut(500);
        });
    });
function modal(idFale){
        $.ajax({
            type: "GET",
            url: "modalView.php",
            data: {idRegistro:idFale},
        success: function(dados){
             $('#ContentmodalFaleConosco').html(dados);
        }
    })
}
//*************************************************************//
// Nível de usuários
$(document).ready(function(){
   $(".editModalnivelUsuario").click(function(){
      $("#modalNivelUsuario").fadeIn(500);
   });
    $("#closeModalUserAlter").click(function(){
        $("#modalNivelUsuario").fadeOut(500);
    });
});
function modalUserAlter(idNivelUser){
    $.ajax({
        type: "GET",
        url: "modalNivelUser.php",
        data:{id:idNivelUser},
        success: function(retorno){
            $('#contentCntentModalNivelUsuario').html(retorno);
        }
    })
}
//*************************************************************//
// Alterar Usuário
$(document).ready(function(){
   $(".editUsuario").click(function(){
      $("#containerModalEditUser").fadeIn(500);
   });
    $("#closeModal").click(function(){
        $("#containerModalEditUser").fadeOut(500);
    });
});
function modalEditUser(idNivelUserEdit){
    $.ajax({
        type: "GET",
        url: "editUser.php",
        data:{id:idNivelUserEdit},
        success: function(conteudo){
            $('#contentModalEditUser').html(conteudo);
        }
    })
}
//*************************************************************//
// Alterar Endereço da Loja
$(document).ready(function(){
   $(".editLoja").click(function(){
      $("#containerModalEdit").fadeIn(500);
   });
    $("#closeModalEditLoja").click(function(){
        $("#containerModalEdit").fadeOut(500);
    });
});
function modalEditLoja(idLoja){
    $.ajax({
        type: "GET",
        url: "modalEditLoja.php",
        data:{id:idLoja},
        success: function(callback){
            $('#contentModalEdit').html(callback);
        }
    })
}
//*************************************************************//
// Visualizar Endereço da Loja
$(document).ready(function(){
   $(".viewLoja").click(function(){
      $("#containerModalViewLoja").fadeIn(500);
   });
    $("#closeModalViewLoja").click(function(){
        $("#containerModalViewLoja").fadeOut(500);
    });
});
function modalViewLoja(idLoja){
    $.ajax({
        type: "GET",
        url: "modalViewLoja.php",
        data:{id:idLoja},
        success: function(callback){
            $('#contentModalViewLoja').html(callback);
        }
    })
}
//*************************************************************//
// Alterar Autor
$(document).ready(function(){
   $(".editAutor").click(function(){
      $("#containerModalEditAutor").fadeIn(500);
   });
    $("#closeModalEditAutor").click(function(){
        $("#containerModalEditAutor").fadeOut(500);
    });
});
function editAutor(id){
    $.ajax({
        type: "GET",
        url: "modalEditAutor.php",
        data:{idAutor:id},
        success: function(callback){
            $('#contentModalEditAutor').html(callback);
        }
    })
}
//*************************************************************//
// Alterar Sobre
$(document).ready(function(){
   $(".editarSobre").click(function(){
      $("#modalEditSobre").fadeIn(500);
   });
    $("#closeModalEditSobre").click(function(){
        $("#modalEditSobre").fadeOut(500);
    });
});
function editarSobre(id){
    $.ajax({
        type: "GET",
        url: "modalEditSobre.php",
        data:{idSobre:id},
        success: function(callback){
            $('#contentModalEditSobre').html(callback);
        }
    })
}
//*************************************************************//
// Alterar Promoção
$(document).ready(function(){
   $(".modalPromocao").click(function(){
      $("#modalEditPromo").fadeIn(500);
   });
    $("#closeModalEditPromo").click(function(){
        $("#modalEditPromo").fadeOut(500);
    });
});
function openModalPromocao(id){
    $.ajax({
        type: "GET",
        url: "modalEditPromo.php",
        data:{idLivro:id},
        success: function(callback){
            $('#contentModalEditPromo').html(callback);
        }
    })
}
//*************************************************************//
// Alterar Livro
$(document).ready(function(){
   $(".editBookView").click(function(){
      $("#containerModalEdit").fadeIn(500);
   });
    $("#closeModalEditLivro").click(function(){
        $("#containerModalEdit").fadeOut(500);
    });
});
function openModalLivro(id){
    $.ajax({
        type: "GET",
        url: "modalEditLivro.php",
        data:{idLivro:id},
        success: function(callback){
            $('#contentModalEditLivro').html(callback);
        }
    })
}
//*************************************************************//
// Alterar Subcategoria
$(document).ready(function(){
   $(".editSubCat").click(function(){
      $("#containerModalSubCat").fadeIn(500);
   });
    $("#closeModalSubCat").click(function(){
        $("#containerModalSubCat").fadeOut(500);
    });
});

function openModalEditSubCat(id){
    $.ajax({
        type: "GET",
        url:"modalEditSubCat.php",
        data:{idSubCat:id},
        success: function(callback){
            $('#contentModalSubCat').html(callback);
        }
    })
}
//*************************************************************//
// Alterar Categoria
$(document).ready(function(){
   $(".editCat").click(function(){
      $("#containerModalCat").fadeIn(500);
   });
    $("#closeModalCat").click(function(){
        $("#containerModalCat").fadeOut(500);
    });
});

function openModalEditCat(id){
    $.ajax({
        type: "GET",
        url:"modalEditCat.php",
        data:{idCat:id},
        success: function(callback){
            $('#contentModalCat').html(callback);
        }
    })
}
