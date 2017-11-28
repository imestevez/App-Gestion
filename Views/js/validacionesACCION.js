/*
    script: validacionesFUNCIONALIDADES.js
    Creado el: 28/11/2017
    Creado por: SOLFAMIDAS;
    
    El fichero validacionesACCION.js contiene las funciones necesarias para validar los formularios de Funcionalidad.

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

/*--------------------------------------------------------------------------------------------
-------------Funciones Necesarias para validar el formulario ADD y EDIT-----------------------
--------------------------------------------------------------------------------------------*/

//Función que comprueba que el IdAccion es de tipo alfanumérico y no supera el maximo permitido
function validarIdAccion(IdAccion, tamaño_max)
{  

  if(comprobarVacio(IdAccion))//Si el campo no está vacio el campo
      {
          if(comprobarAlfanumerico(IdAccion,tamaño_max))//Si login cumple la expresión regular de campo Alfabético
       {
           return true;
       }else{ //Si no cumple la expresión regular
           return false;
       }
      }else{//Si está vacio
          return false;
      }

}

//Función que comprueba que el NombreAccion es de tipo alfanumérico y no supera el maximo permitido
function validarNombreAccion(NombreAccion, tamaño_max)
{  

  if(comprobarVacio(NombreAccion))//Si el campo no está vacio el campo
      {
          if(comprobarAlfanumerico(NombreAccion,tamaño_max))//Si login cumple la expresión regular de campo Alfabético
       {
           return true;
       }else{ //Si no cumple la expresión regular
           return false;
       }
      }else{//Si está vacio
          return false;
      }

}

//Función que comprueba que la DescripAccion es de tipo alfanumérico y no supera el maximo permitido
function validarDescripAccion(DescripAccion, tamaño_max)
{  

  if(comprobarVacio(DescripAccion))//Si el campo no está vacio el campo
      {
          if(comprobarAlfanumerico(DescripAccion,tamaño_max))//Si login cumple la expresión regular de campo Alfabético
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

//Función para validar la búsqueda por IdAccion
function validarIdAccionBuscar(IdAccion, tamaño_max)
{
    if(comprobarVacioBuscar(IdAccion)){ //Si el IdAccion no está vacío
        if(comprobarAlfanumericoBuscar(IdAccion,tamaño_max)) //Si cumple la expresión regular de campo Alfabético
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

//Función para validar la búsqueda por NombreAccion
function validarNombreAccionBuscar(NombreAccion, tamaño_max)
{
    if(comprobarVacioBuscar(NombreAccion)){ //Si el NombreAccion no está vacío
        if(comprobarAlfanumericoBuscar(NombreAccion,tamaño_max)) //Si cumple la expresión regular de campo Alfabético
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

//Función para validar la búsqueda por DescripAccion
function validarDescripAccionBuscar(DescripAccion, tamaño_max)
{
    if(comprobarVacioBuscar(DescripAccion)){ //Si el IdFuncionalidad no está vacío
        if(comprobarAlfanumericoBuscar(DescripAccion,tamaño_max)) //Si cumple la expresión regular de campo Alfabético
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
          (validarIdAccionBuscar(form.IdAccion, 6)) && 
          (validarNombreAccionBuscar(form.NombreAccion, 60)) && 
          (validarDescripAccionBuscar(form.DescripAccion, 100)) ){

          alerta = false; //Se le asigna false a la variable alerta 
        }
      }

    if(formulario == 'ADD'){ //Si es el formulario es el de añadir
        //si todos los campos estan correctos y devuelven true

        if( 
          (validarIdAccion(form.IdAccion, 6)) && 
          (validarNombreAccion(form.NombreAccion, 60)) && 
          (validarDescripAccion(form.DescripAccion, 100)) ){

          alerta = false; //Se le asigna false a la variable alerta 
        }
    }

    if(formulario == 'EDIT'){ //Si es el formulario es el de editar
        //si todos los campos estan correctos y devuelven true
        if( 
          (validarIdAccion(form.IdAccion, 6)) && 
          (validarNombreAccion(form.NombreAccion, 60)) && 
          (validarDescripAccion(form.DescripAccion, 100)) ){

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

