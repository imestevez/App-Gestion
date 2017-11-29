/*
    script: validacionesFUNCIONALIDADES.js
    Creado el: 28/11/2017
    Creado por: SOLFAMIDAS;
    
    El fichero validacionesFUNCIONALIDADES.js contiene las funciones necesarias para validar los formularios de Funcionalidad.

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

//Función que admite alfanumérico y espacios
function comprobarTexto(campo, tamaño_max) {
    
 var idVacio = campo.name.concat('Vacio'); //concatena al nombre del campo 'Vacio' para acceder a los divs correspondientes a los campos vacios

     var expr_alfanum; //Expresión regular para comprobar que un campo (login y contraseña) es alfanumerico y puede incluir caracteres como 
    expr_alfanum =  /^[a-zA-Z0-9ñÑ_.-\s]+$/; //letras y numeros _ . - y espacios
    
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

//Función que comprueba que el IdFuncionalidad es de tipo alfanumérico y no supera el maximo permitido
function validarIdFuncionalidad(IdFuncionalidad, tamaño_max)
{  

  if(comprobarVacio(IdFuncionalidad))//Si el campo no está vacio el campo
      {
          if(comprobarAlfanumerico(IdFuncionalidad,tamaño_max))//Si login cumple la expresión regular de campo Alfabético
       {
           return true;
       }else{ //Si no cumple la expresión regular
           return false;
       }
      }else{//Si está vacio
          return false;
      }

}

//Función que comprueba que el NombreFuncionalidad es de tipo alfanumérico y no supera el maximo permitido
function validarNombreFuncionalidad(NombreFuncionalidad, tamaño_max)
{  

  if(comprobarVacio(NombreFuncionalidad))//Si el campo no está vacio el campo
      {
          if(comprobarTexto(NombreFuncionalidad,tamaño_max))//Si login cumple la expresión regular de campo Alfabético
       {
           return true;
       }else{ //Si no cumple la expresión regular
           return false;
       }
      }else{//Si está vacio
          return false;
      }

}

//Función que comprueba que la DescripFuncionalidad es de tipo alfanumérico y no supera el maximo permitido
function validarDescripFuncionalidad(DescripFuncionalidad, tamaño_max)
{  

  if(comprobarVacio(DescripFuncionalidad))//Si el campo no está vacio el campo
      {
          if(comprobarTexto(DescripFuncionalidad,tamaño_max))//Si login cumple la expresión regular de campo Alfabético
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

//Función para validar la búsqueda por IdFuncionalidad
function validarIdFuncionalidadBuscar(IdFuncionalidad, tamaño_max)
{
    if(comprobarVacioBuscar(IdFuncionalidad)){ //Si el IdFuncionalidad no está vacío
        if(comprobarAlfanumericoBuscar(IdFuncionalidad,tamaño_max)) //Si cumple la expresión regular de campo Alfabético
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

//Función para validar la búsqueda por NombreFuncionalidad
function validarNombreFuncionalidadBuscar(NombreFuncionalidad, tamaño_max)
{
    if(comprobarVacioBuscar(NombreFuncionalidad)){ //Si el IdFuncionalidad no está vacío
        if(comprobarTextoBuscar(NombreFuncionalidad,tamaño_max)) //Si cumple la expresión regular de campo Alfabético
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

//Función para validar la búsqueda por DescripFuncionalidad
function validarDescripFuncionalidadBuscar(DescripFuncionalidad, tamaño_max)
{
    if(comprobarVacioBuscar(DescripFuncionalidad)){ //Si el IdFuncionalidad no está vacío
        if(comprobarTextoBuscar(DescripFuncionalidad,tamaño_max)) //Si cumple la expresión regular de campo Alfabético
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
          (validarIdFuncionalidadBuscar(form.IdFuncionalidad, 6)) && 
          (validarNombreFuncionalidadBuscar(form.NombreFuncionalidad, 60)) && 
          (validarDescripFuncionalidadBuscar(form.DescripFuncionalidad, 100)) ){

          alerta = false; //Se le asigna false a la variable alerta 
        }
      }

    if(formulario == 'ADD'){ //Si es el formulario es el de añadir
        //si todos los campos estan correctos y devuelven true

        if( 
          (validarIdFuncionalidad(form.IdFuncionalidad, 6)) && 
          (validarNombreFuncionalidad(form.NombreFuncionalidad, 60)) && 
          (validarDescripFuncionalidad(form.DescripFuncionalidad, 100)) ){

          alerta = false; //Se le asigna false a la variable alerta 
        }
    }

    if(formulario == 'EDIT'){ //Si es el formulario es el de editar
        //si todos los campos estan correctos y devuelven true
        if( 
          (validarIdFuncionalidad(form.IdFuncionalidad, 6)) && 
          (validarNombreFuncionalidad(form.NombreFuncionalidad, 60)) && 
          (validarDescripFuncionalidad(form.DescripFuncionalidad, 100)) ){

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

