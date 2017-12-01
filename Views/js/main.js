/*

    script: main.js
    Creado el: 29/9/2017
    Creado por: SOLFAMIDAS;
    
    El fichero main.js contiene las funciones jQuery para conseguir que  el menu lateral sea desplegable al hacer click de EntregaET1.html
*/

$(document).ready(function(){
    $('.menu li:has(ul)').click(function (e){
        e.preventDefault();
        
        if($(this).hasClass('activado')){

            $(this).removeClass('activado');
            $(this).children('ul').slideUp();
            
        }else{
            $('.menu li ul').slideUp();
            $('.menu li').removeClass('activado');
            $(this).addClass('activado');
            $(this).children('ul').slideDown();
        }
    });  
});

$(document).ready(function() {

  $('form').keypress(function(e){   
    if(e == 13){
      return false;
    }
  });

  $('input').keypress(function(e){
    if(e.which == 13){
      return false;
    }
  });

});

$(document).ready(function(){

  $('.submenu').click(function (e){
        e.preventDefault();
        
        var $id = $(this).attr('id');
        window.location.href  = '../Controllers/'+$id+'_Controller.php';
         
  
  });
});
