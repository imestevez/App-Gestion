/*
      script: validacionesCheckbox.js
    Creado el: 16/12/2017
    Creado por: SOLFAMIDAS;
    
    El fichero validacionesCheckbox.js contiene las funciones necesarias para validar los campos checkbox de las acciones de asignar


*/

//Funcion para validar que haya al menos un checbox seleccionado

function validarCheck(formulario){

	alert("dhsaldj");

 var alerta = true; //Variable para controlar si alguna validacion por campo no es correcta

    var form;// almacena el formulario que se pase por parámetro del HMTL
    form =  document.forms[formulario];
	var checkboxes; //Variable para almacenar los campos tipo checkbox
	checkboxes = document.getElementById(form).checkbox;
	var cont = 0; //Variable contador inicializada a 0
		 
		for (var x=0; x < checkboxes.length; x++) { //Recorrer desde 0 hasta el número de checkbox qe haya en el formulario
		 if (checkboxes[x].checked) { //si esta seleccionado
		  cont++; //sumamos 1
		 }
		}
		if(cont == 0){ //si no hay ningun campo seleccionado
			alert('<?php echo $strings['Debe de seleccionar al menos 1 campo'] ?>');
			return false;
		}else{//Si al menos hay 1 campo seleccionado
          alert('<?php echo $strings['Formulario correcto']?>');
          return true;

		}
}