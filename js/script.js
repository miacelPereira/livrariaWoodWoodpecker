/* Submit */
function submitBusca(){
   frmBusca.submit();
}

/* Modal de detalhes */
$(document).ready(function(){
   $(".openModalHome").click(function(){
      $("#containerModalHome").fadeIn(500);
   });
    $("#closeModalHome").click(function(){
        $("#containerModalHome").fadeOut(500);
    });
});
function openModalHome(id){
    $.ajax({
        type: "GET",
        url: "modalDetalhes.php",
        data:{idLivro:id},
        success: function(callback){
            $('#infoModalHome').html(callback);
        }
    })
}

function myMap() {
    var mapOptions = {
        center: new google.maps.LatLng(-23.5285483, -46.8979954),
        zoom: 17,
        mapTypeId: google.maps.MapTypeId.HYBRID
    }
var map = new google.maps.Map(document.getElementById("map"), mapOptions);
}

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



