/*
    script: validacionesHISTORIA.js
    Creado el: 28/11/2017
    Creado por: SOLFAMIDAS;
    
    El fichero validacionesHISTORIA.js contiene las funciones necesarias para validar los formularios de HISTORIA.

*/


//Comprueba si los campos estan vacios o si solo hay espacios
function comprobarVacio(campo)
{
    var expr;//Expresión regular para que no estén los campos vacios
    expr = /^\s+$/; //empiece y termine por cualquier caracter
    
    var idVacio = campo.name.concat('Vacio'); //concatena al nombre del campo 'Vacio' para acceder a los divs correspondientes a los campos vacios

  		if ((campo.value == null) || (campo.value.length == 0) )//si el valor del campo es nulo o la longitud es 0
        {
            document.getElementById(idVacio).style.display ='block';
            document.getElementById(campo.name).style.display ='none';
            return false;
  		}
        if(expr.test(campo.value))//si el valor del campo cumple la expresión regular
        {
            document.getElementById(idVacio).style.display ='block';
            document.getElementById(campo.name).style.display ='none';
            return false;
        }
        document.getElementById(idVacio).style.display = 'none';
  			return true;
}


//Función para comprobar que un campo solo tiene letras (mayúsculas y minúsculas), números y los caracteres "- . _"
function comprobarAlfanumerico(campo, tamaño_max)
{

    var idVacio = campo.name.concat('Vacio'); //concatena al nombre del campo 'Vacio' para acceder a los divs correspondientes a los campos vacios

     var expr_alfanum; //Expresión regular para comprobar que un campo (login y contraseña) es alfanumerico y puede incluir caracteres como 
     expr_alfanum =  /^[a-zA-Z0-9ñÑ_.-]+$/; //letras y numeros _ . -
    
     if (expr_alfanum.test(campo.value) == false) //Si no cumple la expresión regular
    { 
        document.getElementById(idVacio).style.display = 'none';
        document.getElementById(campo.name).style.display = 'block';      
        return false;
    }
      else //Si cumple la expresión regular
      {
        if (campo.value.length > tamaño_max) //Si el tamaño del campo supera el maximo
        {
          document.getElementById(idVacio).style.display = 'none';
          document.getElementById(campo.name).style.display = 'block';
            return false;
        }
        else //si el tamaño del campo no supera el máximo
        {     
            document.getElementById(campo.name).style.display = 'none';
            return true;
        }
  }
    
}

//Función para comprobar que un campo de tipo texto no supera el máximo de caracteres
function comprobarTexto(campo, tamaño_max) {
    
 var idVacio = campo.name.concat('Vacio'); //concatena al nombre del campo 'Vacio' para acceder a los divs correspondientes a los campos vacios

     var expr_alfanum; //Expresión regular para comprobar que un campo (login y contraseña) es alfanumerico y puede incluir caracteres como 
    expr_alfanum =  /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚçÇ_.,-\s]+$/; //letras y numeros _ . - y espacios
    
     if (expr_alfanum.test(campo.value) == false) //Si no cumple la expresión regular
    { 
        document.getElementById(idVacio).style.display = 'none';
        document.getElementById(campo.name).style.display = 'block';      
        return false;
    }
      else //Si cumple la expresión regular
      {
        if (campo.value.length > tamaño_max) //Si el tamaño del campo supera el maximo
        {
          document.getElementById(idVacio).style.display = 'none';
          document.getElementById(campo.name).style.display = 'block';
            return false;
        }
        else //si el tamaño del campo no supera el máximo
        {     
            document.getElementById(campo.name).style.display = 'none';
            return true;
        }
  }
    
}

//Comprueba que el valor de un campo de tipo entero está entre el limite establecido
function comprobarEntero(campo,valormenor,valormayor) 
{

    var idMax = campo.name.concat('Max'); //concatena al nombre del campo 'Max' para acceder a los divs correspondientes

  var expr_entero; //Variable para comprobar que se introduce un entero
  expr_entero = /^\d+$/;//que contenga solo digitos

  if(expr_entero.test(campo.value)){ //Si cumple la expresión regular

    if((campo.value < valormenor) || (campo.value > valormayor)) //Si el valor del campo es menor al mínimo o si es mayor al máximo
    {
        document.getElementById(campo.name).style.display = 'none';
        document.getElementById(idMax).style.display = 'block';

        return false;
    }
    else{//Si el valor está dentro del rango establecido
        document.getElementById(idMax).style.display = 'none';    
        document.getElementById(campo.name).style.display = 'none';
        return true;
     }
   }else{ //Si no cumple la expresión regular
        document.getElementById(idMax).style.display = 'none';    
     document.getElementById(campo.name).style.display = 'block';
      return false;
   }
}

/*--------------------------------------------------------------------------------------------
-------------Funciones Necesarias para validar el formulario ADD y EDIT-----------------------
--------------------------------------------------------------------------------------------*/

//Función que comprueba que el IdTrabajo es de tipo alfanumérico y no supera el maximo permitido
function validarIdTrabajo(IdTrabajo, tamaño_max)
{  

  if(comprobarVacio(IdTrabajo))//Si el campo no está vacio el campo
      {
          if(comprobarAlfanumerico(IdTrabajo,tamaño_max))//Si IdTrabajo cumple la expresión regular de campo Alfabético
       {

           return true;
       }else{ //Si no cumple la expresión regular
           return false;
       }
      }else{//Si está vacio
          return false;
      }

}

//Función que comprueba que el IdHistoria es de tipo alfanumérico y no supera el maximo permitido
function validarIdHistoria(IdHistoria, min, max)
{  

  if(comprobarVacio(IdHistoria))//Si el campo no está vacio el campo
      {
          if(comprobarEntero(IdHistoria,0,99))//Si IdHistoria cumple la expresión regular de campo Alfabético
       {

           return true;
       }else{ //Si no cumple la expresión regular
           return false;
       }
      }else{//Si está vacio
          return false;
      }

}

//Función que comprueba que la TextoHistoria es de tipo alfanumérico y no supera el maximo permitido
function validarTextoHistoria(TextoHistoria, tamaño_max)
{  

  if(comprobarVacio(TextoHistoria))//Si el campo no está vacio el campo
      {
          if(comprobarTexto(TextoHistoria,tamaño_max))//Si TextoHistoria cumple la expresión regular de campo Alfabético
       {

           return true;
       }else{ //Si no cumple la expresión regular
           return false;
       }
      }else{//Si está vacio
          return false;
      }

}


/*--------------------------------------------------------------------------------------------
-------------Funciones Necesarias para validar el formulario SEARCH------------------------------
--------------------------------------------------------------------------------------------*/


//Comprueba si los campos estan vacios o si solo hay espacios para el formulario SEARCH
function comprobarVacioBuscar(campo)
{
    var expr;//Expresión regular para que no estén los campos vacios
    expr = /^\s+$/; // que empice por algun caracter
    
      if ((campo.value == null) || (campo.value.length == 0) ){//si el valor del campo es nulo o la longitud es 0
        document.getElementById(campo.name).style.display = 'none';
        return false;
      }
        if(expr.test(campo.value))//si el valor del campo cumple la expresión regular
        {
            document.getElementById(campo.name).style.display = 'none';
            return false;
        }
         return true;
}


//Función para comprobar que un campo solo tiene letras (mayúsculas y minúsculas), números y los caracteres "- . _" para el formulario SEARCH
function comprobarAlfanumericoBuscar(campo, tamaño_max)
{
     var expr_alfanum; //Expresión regular para comprobar que un campo (login y contraseña) es alfanumerico y puede incluir caracteres como 
    expr_alfanum =  /^[a-zA-Z0-9ñÑ_.-]+$/; //letras números y caracteres -_ .
    
     if (expr_alfanum.test(campo.value) == false) //Si no cumple la expresión regular
    {
        document.getElementById(campo.name).style.display = 'block';
        return false;
    }
      else{//Si cumple la expresión regular
        if (campo.value.length > tamaño_max) //Si el tamaño del campo supera el maximo
        {
      
            document.getElementById(campo.name).style.display = 'block';
            return false;
        }
          else{// Si no supera el máximo
            return true;
      }
  }
}

//Función para comprobar que un campo de tipo texto no supera el máximo de caracteres
function comprobarTextoBuscar(campo, tamaño_max) {
    
     var expr_alfanum; //Expresión regular para comprobar que un campo (login y contraseña) es alfanumerico y puede incluir caracteres como 
    expr_alfanum =  /^[a-zA-Z0-9ñÑ_.-\s]+$/; //letras y numeros _ . - y espacios
    
     if (expr_alfanum.test(campo.value) == false) //Si no cumple la expresión regular
    { 
        document.getElementById(campo.name).style.display = 'block';      
        return false;
    }
      else //Si cumple la expresión regular
      {
        if (campo.value.length > tamaño_max) //Si el tamaño del campo supera el maximo
        {
          document.getElementById(campo.name).style.display = 'block';
            return false;
        }
        else //si el tamaño del campo no supera el máximo
        {     
            document.getElementById(campo.name).style.display = 'none';
            return true;
        }
  }
}


//Función para validar la búsqueda por IdTrabajo
function validarIdTrabajoBuscar(IdTrabajo, tamaño_max)
{
    if(comprobarVacioBuscar(IdTrabajo)){ //Si el IdTrabajo no está vacío
        if(comprobarAlfanumericoBuscar(IdTrabajo,tamaño_max)) //Si cumple la expresión regular de campo Alfabético
            {
                return true;
            }else{ //si no cumple la expresión regular
                return false;
            }
    }
    else{ //Si está vacio
        return true;
    }

}

//Función para validar la búsqueda por IdHistoria
function validarIdHistoriaBuscar(IdHistoria, min, max)
{
    if(comprobarVacioBuscar(IdHistoria)){ //Si el IdHistoria no está vacío
        if(comprobarEntero(IdHistoria,0,99)) //Si cumple la expresión regular de campo Alfabético
            {
                return true;
            }else{ //si no cumple la expresión regular
                return false;
            }
    }
    else{ //Si está vacio
        return true;
    }

}

//Función para validar la búsqueda por TextoHistoria
function validarTextoHistoriaBuscar(TextoHistoria, tamaño_max)
{
    if(comprobarVacioBuscar(TextoHistoria)){ //Si el TextoHistoria no está vacío
        if(comprobarTextoBuscar(TextoHistoria,tamaño_max)) //Si cumple la expresión regular de campo Alfabético
            {
                return true;
            }else{ //si no cumple la expresión regular
                return false;
            }
    }
    else{ //Si está vacio
        return true;
    }

}

function validarNombreTrabajoBuscar(NombreTrabajo, min, max){
  
   if(comprobarVacioBuscar(NombreTrabajo))//Si el campo no está vacio el campo
      {
          if(comprobarTextoBuscar(NombreTrabajo,min, max))//Si login cumple la expresión regular de campo Alfabético
       {
           return true;
       }else{ //Si no cumple la expresión regular
           return false;
       }
      }else{//Si está vacio
          return true;
      }


}

/*-----------------------------------------------------------------
--------------VALIDACIONES DE TODO EL FORMULARIO--------------------
-----------------------------------------------------------------*/

//Función para validar todos los campos. Se pasa el  nombre del formulario como parámetro
function validar(formulario) 
{
  var alerta = true; //Variable para controlar si alguna validacion por campo no es correcta

    var form;// almacena el formulario que se pase por parámetro del HMTL
    form =  document.forms[formulario];
    if(formulario == 'SEARCH'){ //Si es el formulario es el de añadir
        //si todos los campos estan correctos y devuelven true

        if( 
          (validarIdTrabajoBuscar(form.IdTrabajo, 6)) && 
          (validarNombreTrabajoBuscar(form.NombreTrabajo,60)) &&
          (validarIdHistoriaBuscar(form.IdHistoria, 0,99)) && 
          (validarTextoHistoriaBuscar(form.TextoHistoria, 300)) ){

          alerta = false; //Se le asigna false a la variable alerta 
        }
    }
    else if(formulario == 'ADD_FROM_TRABAJO'){
        if(  
          (validarIdHistoria(form.IdHistoria, 0,99)) && 
          (validarTextoHistoria(form.TextoHistoria, 300)) 
          ){
          alerta = false; //Se le asigna false a la variable alerta 
        }
    }  
      else{ //si es edit o add
          if( 
            (validarIdTrabajo(form.IdTrabajo, 6)) && 
            (validarIdHistoria(form.IdHistoria, 0,99)) && 
            (validarTextoHistoria(form.TextoHistoria, 300)) ){

            alerta = false; //Se le asigna false a la variable alerta 
          }
    }
    if(alerta == true){ //Si hubo alguna alerta (campo no validado correctamente)
      alert('<?php echo $strings['No se puede enviar el formulario. Revise que todos los campos están correctos'] ?>');
      return false;
    }
    else{ //Si todos los campos están correctamente validados
      alert('<?php echo $strings['Formulario correcto']?>');
      return true;
    }
      
}

