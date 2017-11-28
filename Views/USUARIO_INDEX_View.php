<?php
/*
//Clase : Index
//Creado el : 25-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

La vista de los usuarios que se autentican en el sistema
*/
class Index {

	function __construct(){
		$this->render();
	}
//funcion que muestra los datos al usuario

	function render(){

	
		include_once '../Locales/Strings_SPANISH.php';
		//include_once '../Views/Header_View.php';
		include '../Controllers/USUARIO_Controller.php';

		//include '../Controllers/TRABAJO_Controller.php';		
		//include_once '../Views/Footer_View.php';


	}
}

?>