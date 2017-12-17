/*
      script: validacionesTRABAJO.js
    Creado el: 28/11/2017
    Creado por: SOLFAMIDAS;
    
    El fichero validaciones.js contiene las funciones necesarias para validar los campos de los formularios de la GEstón de trabajos

*/


/*------------------------------------------------------------
---------- Funciones de comprobación propuestas---------------
-------------------------------------------------------------*/

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


//Función para comprobar que un campo de tipo texto no supera el máximo de caracteres
function comprobarTexto(campo, tamaño_max) {
    
 var idVacio = campo.name.concat('Vacio'); //concatena al nombre del campo 'Vacio' para acceder a los divs correspondientes a los campos vacios

     var expr_alfanum; //Expresión regular para comprobar que un campo es alfanumerico y puede incluir caracteres como 
    expr_alfanum =  /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚçÇ_.-\s]+$/; //letras y numeros _ . - y espacios
    
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

//Función para comprobar que un campo solo tiene letras (mayúsculas y minúsculas), números y los caracteres "- . _"
function comprobarAlfanumerico(campo, tamaño_max)
{

    var idVacio = campo.name.concat('Vacio'); //concatena al nombre del campo 'Vacio' para acceder a los divs correspondientes a los campos vacios

     var expr_alfanum; //Expresión regular para comprobar que un campo  es alfanumerico y puede incluir caracteres como 
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

//Función para comprobar que un campo es alfabético y no supera el tamaño máximo permitido. Acepta todas las letras, mayúsculas y minúsculas, incluida la ñ y ç, además depalabras acentuadas.
function comprobarAlfabetico(campo, tamaño_max) 
{
    var idVacio = campo.name.concat('Vacio'); //concatena al nombre del campo 'Vacio' para acceder a los divs correspondientes a los campos vacios

    var expr_alfabet; //Expresión regular para comprobar que solo tiene letras, numeros y(_ - .)
    expr_alfabet = /^[a-zA-ZñÑáéíóúÁÉÍÓÚçÇ\s]+$/; //solo letras
    
    if (expr_alfabet.test(campo.value) == false) //Si no cumple la expresión regular
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
          else //Si el tamaño está dentro del rango
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


//Función para validar un login
function validarlogin(login, tamaño_max){

   if(comprobarVacio(login))//Si el campo no está vacio el campo
      {
          if(comprobarAlfanumerico(login,tamaño_max))//Si login cumple la expresión regular de campo Alfabético
       {
           return true;
       }else{ //Si no cumple la expresión regular
           return false;
       }
      }else{//Si está vacio
          return false;
      }


}
//Función para validar un id del trabajo

function validarIdTrabajo(IdTrabajo, tamaño_max){

   if(comprobarVacio(IdTrabajo))//Si el campo no está vacio el campo
    {
        if(comprobarAlfanumerico(IdTrabajo,tamaño_max))//Si idtrabajo cumple la expresión regular de campo Alfabético
     {
         return true;
     }else{ //Si no cumple la expresión regular
         return false;
     }
    }else{//Si está vacio
        return false;
    }
}

//Función para validar un alias
function validarAlias(Alias, tamaño_max){

   if(comprobarVacio(Alias))//Si el campo no está vacio el campo
      {
          if(comprobarAlfanumerico(Alias,tamaño_max))//Si alias cumple la expresión regular de campo Alfabético
       {
           return true;
       }else{ //Si no cumple la expresión regular
           return false;
       }
      }else{//Si está vacio
          return false;
      }


}

//Función para validar un porcentaje de nota del trabajo

function validarHoras(Horas, min, max){
  
   if(comprobarVacioBuscar(Horas))//Si el campo no está vacio el campo
      {
          if(comprobarEntero(Horas, min, max))//Si horas cumple la expresión regular de campo Alfabético
       {
           return true;
       }else{ //Si no cumple la expresión regular
           return false;
       }
      }else{//Si está vacio
          return true;
      }


}

//funcion para la validar que la ruta introducida es válida

function validarRuta(Ruta, tamaño_max){
  if(Ruta.value.length > tamaño_max){ //si la ruta supera el máximo
    document.getElementById(Ruta.name).style.display="block";
    return false;
  }else { //si no supera el máximo
    document.getElementById(Ruta.name).style.display="none";
    return true;
  }
}

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
//Función para comprobar que un campo es alfabético y no supera el tamaño máximo permitido. Acepta todas las letras, mayúsculas y minúsculas, incluida la ñ y ç, además depalabras acentuadas  para el formulario SEARCH
function comprobarAlfabeticoBuscar(campo, tamaño_max) 
{

    var expr_alfabet; //Expresión regular para comprobar que solo tiene letras
    expr_alfabet = /^[a-zA-ZñÑáéíóúÁÉÍÓÚçÇ\s]+$/; // solo letras
    
    if (expr_alfabet.test(campo.value) == false) //Si no cumple la expresión regular
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
          else //Si el tamaño está dentro del rango
          {
            document.getElementById(campo.name).style.display = 'none';
            return true;
      }
    }
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
            document.getElementById(campo.name).style.display = 'none';
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

//Funcion para validar busquedas por ID
function validarloginBuscar(login, tamaño_max){

   if(comprobarVacioBuscar(login) )//Si el campo no está vacio el campo
      {
        if(comprobarAlfanumericoBuscar(login,tamaño_max))//Si IdTrabajo cumple la expresión regular de campo Alfabético
       {
           return true;
       }else{ //Si no cumple la expresión regular
           return false;
       }
      }else{//Si está vacio
          return true;
      }


}

//Función para validar la búsqueda por nombre
function validarNombreBuscar(nombre, tamaño_max)
{
      if(comprobarVacioBuscar(nombre))//Si el campo no está vacio el campo
      {
             if(comprobarAlfabeticoBuscar(nombre,tamaño_max))//Si nombre es alfabético no supera el tamaño maximo
                 {
                     return true;
                 }else{ //si no es alfabético o supera el máximo
                     return false;
                 }
      }
      else{//Si está vacío
          return true;
      }
    
}

//Funcion para validar busquedas por ID
function validarIdTrabajoBuscar(IdTrabajo, tamaño_max){

   if(comprobarVacioBuscar(IdTrabajo) )//Si el campo no está vacio el campo
      {
        if(comprobarAlfanumericoBuscar(IdTrabajo,tamaño_max))//Si IdTrabajo cumple la expresión regular de campo Alfabético
       {
           return true;
       }else{ //Si no cumple la expresión regular
           return false;
       }
      }else{//Si está vacio
          return true;
      }
}
//Funcion para validar busquedas por nombre

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

//Función para validar un alias
function validarAliasBuscar(Alias, tamaño_max){

   if(comprobarVacioBuscar(Alias))//Si el campo no está vacio el campo
      {
          if(comprobarAlfanumericoBuscar(Alias,tamaño_max))//Si login cumple la expresión regular de campo Alfabético
       {
           return true;
       }else{ //Si no cumple la expresión regular
           return false;
       }
      }else{//Si está vacio
          return true;
      }


}

//Funcion para validar numero de horas insertadas
function validarHorasBuscar(Horas, min, max){
  
   if(comprobarVacioBuscar(Horas))//Si el campo no está vacio el campo
      {
          if(comprobarEntero(Horas, min, max))//Si horas cumple la expresión regular de campo Alfabético
       {
           return true;
       }else{ //Si no cumple la expresión regular
           return false;
       }
      }else{//Si está vacio
          return true;
      }


}

//funcion para la validar que la ruta introducida es válida en la busqueda

function validarRutaBuscar(Ruta, tamaño_max){
  
   if(comprobarVacioBuscar(Ruta))//Si el campo no está vacio el campo
      {
          if(comprobarTextoBuscar(Ruta, tamaño_max))//Si ruta cumple la expresión regular de campo Alfabético
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
          (validarloginBuscar(form.login, 9)) &&
          (validarNombreBuscar(form.nombre, 30)) && 
          (validarIdTrabajoBuscar(form.IdTrabajo, 6)) && 
          (validarNombreTrabajoBuscar(form.NombreTrabajo, 60)) && 
          (validarAliasBuscar(form.Alias, 9)) && 
          (validarHorasBuscar(form.Horas, 0,99)) && 
          (validarRutaBuscar(form.Ruta,54))  ){

          alerta = false; //Se le asigna false a la variable alerta 
        }
      }else{ //si son EDIT O ADD
        //si todos los campos estan correctos y devuelven true

         if( 
          (validarlogin(form.login, 9)) && 
          (validarIdTrabajo(form.IdTrabajo, 6)) && 
          (validarAlias(form.Alias, 9)) &&  
          (validarHoras(form.Horas, 0, 99)) && 
          (validarRuta(form.Ruta,54))  ){

          alerta = false; //Se le asigna false a la variable alerta 
        }
    
    }

    if(alerta == true){ //Si hubo alguna alerta (campo no validado correctamente)
      alert('<?php echo $strings['No se puede enviar el formulario. Revise que todos los campos están correctos'] ?>');
      return false;
    }else{ //Si todos los campos están correctamente validados
      alert('<?php echo $strings['Formulario correcto']?>');
      return true;
    }
      
}

