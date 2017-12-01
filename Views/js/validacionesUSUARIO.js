/*
    Script: validacionesUSUARIO.js
    Creado el: 30/11/2017
    Creado por: SOLFAMIDAS;
    
    El fichero validacionesUSUARIO.js contiene las funciones necesarias para validar los campos de los formularios de usuario

*/

//funcion para encriptar las contraseñas
  function encriptar(){
    //si el campo contraseña no está vacio
    if(document.getElementById('passwd').value.length > 0){ //si la longitud de la contraseña es mayor que 0
      document.getElementById('passwd').value = hex_md5(document.getElementById('passwd').value);
    }
    return true;
  }



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
    
    if (campo.value.length > tamaño_max) //Si el tamaño del campo supera el máximo establecido
    {
        alert('Número máximo de caracteres para el campo ' + campo.name + ' es ' + tamaño_max);
        return false;
    }
    else//si el tamaño esta dentro del rango establecido
    {
        return true;
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



//Función para comprobar que el DNI es válido. 8 dígitod y 1 letra, la cúal tiene que corresponderse con el número del DNI
function comprobarDNI(dni) 
{
    
  var numero;  //Almacena el numero del DNI
  var aux_letra; // almacena la letra del DNI
  var letra; //Almacena el conjunto de letras válidas de los DNIs
  var expr_dni; //Expresión válida de un DNI -> 8 dígitos y 1 letra
  var dniLetra = dni.name.concat('Letra'); //concatena al nombre del campo 'Letra' para acceder a los div que dice que la letra es incorrecta
  var idVacio = dni.name.concat('Vacio'); //concatena al nombre del campo 'Vacio' para acceder a los divs correspondientes a los campos vacios
  

  expr_dni = /^[0-9]{8}[a-zA-Z]$/; //8 digitos y 1 letra
 
  if(expr_dni.test(dni.value) == true) //Si el dni cumple la expresión regular
  {
      
     numero = dni.value.substring(0,dni.value.length - 1); // se coge el número del DNI
     aux_letra = dni.value.substring(dni.value.length - 1); //se coge la letra del DNI
     numero = numero % 23; // se hace múdulo 23 del número del DNI para saber que letra le corresponde
     letra='TRWAGMYFPDXBNJZSQVHLCKET'; //Todas las letras posibles de los DNIs
     letra=letra.substring(numero,numero+1);//Coge la letra que le corresponde al DNI 
      
    if (letra!=aux_letra.toUpperCase()) //Si las letras no coinciden
    {

        document.getElementById(dniLetra).style.display = 'block';
        document.getElementById(idVacio).style.display = 'none';
        document.getElementById(dni.name).style.display = 'none';


        return false;
     }
      else //Si la letra insertada coincide con la correspondiente al número de dni
      {

        document.getElementById(idVacio).style.display = 'none';
        document.getElementById(dniLetra).style.display = 'none';
        document.getElementById(dni.name).style.display = 'none';

          return true;
      }
   }
    else //Si dni no cumple la expresión regular
    {
      document.getElementById(dniLetra).style.display = 'none';
      document.getElementById(idVacio).style.display = 'none';
      document.getElementById(dni.name).style.display = 'block';
     return false;
   }   
  }

//Función para comprobar que un teléfono insertado es válido. Acepta 9 números o 13 siempre que compience por 0034 (teléfono internacional español)
function comprobarTelefono(telefono) {
    
      var expr_telf;//Expresión regular para comprobar que sea un telefono internacional español (puede llevar o no 0034 al comienzo) 
    expr_telf = /^(34)?\d{9}$/; //empiece por 34 o no seguido de 9 digitos

  var idVacio = telefono.name.concat('Vacio'); //concatena al nombre del campo 'Vacio' para acceder a los divs correspondientes a los campos vacios
    
    if(expr_telf.test(telefono.value) == false) //si no cumple la expresión regular
    {
      document.getElementById(idVacio).style.display = 'none';
      document.getElementById(telefono.name).style.display = 'block';
        
        return false;
    }
    else //Si cumple la expresión regular
    {
      document.getElementById(idVacio).style.display = 'none';
      document.getElementById(telefono.name).style.display = 'none';

  			return true;
        }
} 	


/*--------------------------------------------------------------------------------------------
-------------Funciones Necesarias para validar el formulario ADD y EDIT-----------------------
--------------------------------------------------------------------------------------------*/

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

//Función que comprueba que el login es de tipo alfanumérico y no supera el maximo permitido
function validarLogin(login, tamaño_max)
{  

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






//Función que comprueba que la contraseña es de tipo alfanumérico y no supera el maximo permitido
function validarPassword(password,tamaño_max)
{

     if(comprobarVacio(password))//Si el campo no está vacio el campo
      {
          if(comprobarAlfanumerico(password,tamaño_max))//Si contraseña cumple la expresión regular de campo Alfabético
           {
               return true;
           }else{ //Si no cumple la expresión regular
               return false;
           }
      }else{//Si está vacio
          return false;
  }
}
function validarNewPassword(campo, tamaño_max)
{
     var expr_alfanum; //Expresión regular para comprobar que un campo (login y contraseña) es alfanumerico y puede incluir caracteres como 
    expr_alfanum =  /^[a-zA-Z0-9ñÑ_.-]+$/; //letras y numeros _ . -
    if(campo.value.length == 0){ //si esta vacio el campo
        document.getElementById(campo.name).style.display = 'none';      
        return true;
    }else{

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
    
}

//Función para validar si se introdujo un DNI válido
function validarDNI(dni)
{

     if(comprobarVacio(dni))//Si el campo no está vacio el campo
      {
          if(comprobarDNI(dni))//Si el dni cumple la expresión regular de DNIo
           {
               return true;
           }else{ //Si no cumple la expresión regular
               return false;
           }
    } else{//Si está vacio
        return false;
  }
}


//Función que comprueba que el nombre es de tipo alfabético y no supera el maximo permitido
function validarNombre(nombre, tamaño_max)
{
    if(comprobarVacio(nombre))//Si el campo no está vacio el campo
    {
        if(comprobarAlfabetico(nombre,tamaño_max))//Si nombre es alfabético no supera el tamaño maximo
            {
                return true;
            }else{ //Si no es alfabético
               return false; 
            }
    }else{ //si está vacio
        return false;
    }
}

//Función que comprueba que los apellidos son de tipo alfabético y no superan el maximo permitido
function validarApellidos(apellidos, tamaño_max)
{
    if(comprobarVacio(apellidos))//Si el campo no está vacio el campo
        {
            if(comprobarAlfabetico(apellidos,tamaño_max)) //Si los apellidos son un campo albabético no supera el tamaño maximo
                {
                    return true;
                }else{ //si no es alfabético
                    return false;
                }
        }else{ //Si está vacío
            return false;
        }

}

//funcion para validar que el télefono tiene un formato internacional español
function validarTelefono(telefono)
{
     if(comprobarVacio(telefono))//Si el campo no está vacio el campo
      {
          if(comprobarTelefono(telefono))//Si el telefono cumple la expresión regular de DNIo
           {
               return true;
           }else{ //Si no cumple la expresión regular
               return false;
           }
    } else{//Si está vacio
        return false;
}
}


//Función que comprueba si un email es válido
function validarEmail(email, tamaño_max) 
{
    var idVacio = email.name.concat('Vacio'); //concatena al nombre del campo 'Vacio' para acceder a los divs correspondientes a los campos vacios
 
    if(comprobarVacio(email))  //Si el campo email no está vacío 
        {        
          document.getElementById(idVacio).style.display = 'none';

          if(email.value.length <= tamaño_max ) //Si el email no supera el máximo
          { 
            var expr_email; //Expresión regular para verificar si es un email correcto
            expr_email = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

            if (!expr_email.test(email.value)) //si no cumple la expresión regular
            {
                document.getElementById(email.name).style.display = 'block';
                return false;
            } 
            else { //Si cumple la expresión regular
                document.getElementById(email.name).style.display = 'none';
                 return true;
            }
          }
        }
        else //Si está vacío
        { 
            document.getElementById(email.name).style.display = 'none';
            return false;
            
        }
}


//Función para validar que el campo dirección es correcto
function validarDireccion(direccion, tamaño_max)
{
    if(comprobarVacio(direccion)) //Si el campo dirección no está vacío
    {
        if(comprobarAlfabetico(direccion,tamaño_max)) //Comprueba que sea un campo alfabético y no supere el máximo
            {
                return true;
            }else{ //Si no es alfabético
                return false;
            }
    }
     else{ //si está vacío
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
            return true;
      }
  }
}

//Función para validar la búsqueda por login
function validarLoginBuscar(login, tamaño_max)
{
    if(comprobarVacioBuscar(login)){ //Si el login no está vacío
        if(comprobarAlfanumericoBuscar(login,tamaño_max)) //Si cumple la expresión regular de campo Alfabético
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
//Funcion para validar la busqueda por dni
function validarDNIBuscar(dni)
{
  var expr_dni_parcial; // Expresión regular para permitir la búsqueda parcial por DNI
  expr_dni_parcial = /^[0-9]{0,8}[a-zA-Z]{0,1}$/; // Entre 0 y 8 digitos y 1 letra o ninguna
    if(comprobarVacioBuscar(dni)){ //Si el dni no está vacío
        if(dni.value.length == 9){ //si se inserta un dni completo
          if(comprobarDNI(dni)){ //Si cumple la expresion regular de DNI completo
            return true;
          }else{//si no la cumple
                document.getElementById(dni.name).style.display = 'block';
            return false;
          }
        }else{ //si no se inserta un dni completo
            if(expr_dni_parcial.test(dni.value) == true) //Si el dni cumple la expresión regular de dni parcial
            {
              document.getElementById(dni.name).style.display = 'none';
              return true;
            }else{//si no cumple la expresion regular de dni parcial
                document.getElementById(dni.name).style.display = 'block';
              return false;
            }
        }
      }else{//si está vacío
          
      document.getElementById(dni.name).style.display = 'none';
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

//Función para validar la búsqueda por apellidos
function validarApellidosBuscar(apellidos, tamaño_max)
{
    if(comprobarVacioBuscar(apellidos))//Si el campo no está vacio el campo
        {
            if(comprobarAlfabeticoBuscar(apellidos,tamaño_max)) //Si apellidos es alfabético y no supera el tamaño maximo
                {
                    return true;
                }else{ //Si no es alfabético o no supera el tamaño máximo
                    return false;
                }
        }else{ //Si está vacío
            return true;
        }
    
}

//Funcion para validar la búsqueda por telefono
function validarTelefonoBuscar(telefono)
{
    var expr_telf_parcial;//Expresión regular para valdar la búsqueda parcial por telefono
    expr_telf_parcial = /^(34)?\d{0,9}$/; // telefonos que emoiecen o no por 34 seguidos de un máximo de 9 digitos

  if(comprobarVacioBuscar(telefono)){//si el campo no está vacío

      if(expr_telf_parcial.test(telefono.value)){ //si cumple la expresion regular de telefono parcial        
        document.getElementById(telefono.name).style.display = 'none';
        return true;
      }else{ //si no cumple la expresion regular de telefono parcial
        document.getElementById(telefono.name).style.display = 'block';
        return false;
      }

  }else{//si está vacio
    document.getElementById(telefono.name).style.display = 'none';
    return true;
  }

}

//Funcion para validar la búsqueda por email
function validarEmailBuscar(email, tamaño_max){
    var expr_email; //Expresion para validar una busqueda parcial por email
    expr_email = /^[a-zA-Z0-9ñÑ.-_]{0,}@{0,1}[a-z]{0,}\.{0,1}[a-z]{0,3}$/;

       if(comprobarVacioBuscar(email))//Si el campo no está vacio el campo
       {
          if(email.value.length <= tamaño_max ) //Si el email no supera el máximo
          { 
            if(expr_email.test(email.value)) //Si email cumple la expresión regular 
                {
                    document.getElementById(email.name).style.display = 'none';
                    return true;
                }else{ //si no cumple la expresión regular
                document.getElementById(email.name).style.display = 'block';
                    return false;
                }
              }
        }
        else{ //Si está vacío
            document.getElementById(email.name).style.display = 'none';
            return true;
        }
}

//Función para validar la búsqueda por dirección 
function validarDireccionBuscar(direccion, tamaño_max)
{
    
    if(comprobarVacioBuscar(direccion)) //Si el campo dirección no está vacío
    {
        if(comprobarAlfabeticoBuscar(direccion,tamaño_max)) //Si direccion es alfabético y no supera el máximo
            {
                return true
            }else{//Si no es alfabético o supera el máximo
                return false;
            }
    }else{ //Si está vacío
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
   
    if(formulario == 'SEARCH'){ //Si es el formulario es el de buscar
        //si todos los campos estan correctos y devuelven true
      if( 
          (validarLoginBuscar(form.login, 9)) && 
          (validarDNIBuscar(form.DNI)) &&
          (validarNombreBuscar(form.nombre, 30)) && 
          (validarApellidosBuscar(form.apellidos,50)) && 
          (validarTelefonoBuscar(form.telefono)) &&
          (validarEmailBuscar(form.email,40)) && 
          (validarDireccionBuscar(form.direccion,60)) ){
          alerta = false; //Se le asigna false a la variable alerta 
        }
    }
    if(formulario == 'ADD'){ //Si es el formulario es el de añadir
        //si todos los campos estan correctos y devuelven true

        if( 
          (validarLogin(form.login, 9)) && 
          (validarPassword(form.password,20)) && 
          (validarDNI(form.DNI)) &&
          (validarNombre(form.nombre, 30)) && 
          (validarApellidos(form.apellidos,50)) && 
          (validarTelefono(form.telefono)) &&
          (validarEmail(form.email,40)) && 
          (validarDireccion(form.direccion,60)) ){

          alerta = false; //Se le asigna false a la variable alerta 
        }
      }

      if(formulario == 'EDIT'){ //Si es el formulario es el de editar
        //si todos los campos estan correctos y devuelven true
        if( 
         (validarNewPassword(form.newpassword,20)) &&
          (validarDNI(form.DNI)) &&
          (validarNombre(form.nombre, 30)) && 
          (validarApellidos(form.apellidos,50)) && 
          (validarTelefono(form.telefono)) &&
          (validarEmail(form.email,40)) && 
          (validarDireccion(form.direccion,60)) ){

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


