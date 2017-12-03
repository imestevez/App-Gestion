
/*
    script: comprobarPermisos.js
    Creado el: 02/12/2017
    Creado por: SOLFAMIDAS;
    
    El fichero comprobarPermisos.js contiene la funcion
    de comprobacion de permisios del usuario loguado para 
    poder modificar campos de los formularios EDIT
*/

//Funcion para habilitar los campos readonly
function comprobarPermisos(usuario){

alert(usuario);
	var form;// almacena el formulario que se pase por parámetro del HMTL
    form =  document.forms['EDIT'];

	if(usuario == 'admin'){ //si el usuario es el administrador
		document.getElementById("lectura").readonly = false;
        return false;
	}else{ // si es otro 
	       document.getElementById("lectura").readOnly = true;
           return true;
	}
}