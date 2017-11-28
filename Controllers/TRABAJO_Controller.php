
<?php

/*
//Script : TRABAJO_Controller.php
//Creado el : 25-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Controlador que recibe las acciones relacionadas con TRABAJO
*/
session_start(); //solicito trabajar con la session

include_once '../Functions/Authentication.php';

if (!IsAuthenticated()){
	header('Location:../index.php');
}
include '../Models/TRABAJO_Model.php';

include '../Views/TRABAJO/TRABAJO_SHOWALL_View.php';
include '../Views/TRABAJO/TRABAJO_SHOWCURRENT_View.php';
include '../Views/TRABAJO/TRABAJO_ADD_View.php';
include '../Views/TRABAJO/TRABAJO_EDIT_View.php';
include '../Views/TRABAJO/TRABAJO_SEARCH_View.php';
include '../Views/TRABAJO/TRABAJO_DELETE_View.php';
include '../Views/MESSAGE_View.php';



// funcion para coger los datos del formulario
function get_data_form(){
//TRABAJO: *IdTrabajo (NombreTrabajo, FechIniTrabajo, FechFinTrabajo, )

	$IdTrabajo = $_REQUEST['IdTrabajo'];
	$NombreTrabajo = $_REQUEST['NombreTrabajo'];
	$FechIniTrabajo = $_REQUEST['FechIniTrabajo'];
	$FechFinTrabajo = $_REQUEST['FechFinTrabajo'];
	$PorcetajeNota = $_REQUEST['PorcetajeNota'];
	
	$action = $_REQUEST['action'];

	$TRABAJO = new TRABAJO_Model(
		$IdTrabajo, 
		$NombreTrabajo, 
		$FechIniTrabajo, 
		$FechFinTrabajo, 
		$PorcetajeNota);

	return $TRABAJO;
}

//Funcion para coger los datos del formulario de un usuario ya almacenado
function get_data_UserBD(){

	$IdTrabajo = $_REQUEST['IdTrabajo'];
	$NombreTrabajo = $_REQUEST['NombreTrabajo'];
	$FechIniTrabajo = $_REQUEST['FechIniTrabajo'];
	$FechFinTrabajo = $_REQUEST['FechFinTrabajo'];
	$PorcetajeNota = $_REQUEST['PorcetajeNota'];

	$action = $_REQUEST['action'];

	$TRABAJO = new TRABAJO_Model(
		$IdTrabajo, 
		$NombreTrabajo, 
		$FechIniTrabajo, 
		$FechFinTrabajo, 
		$PorcetajeNota);

	return $TRABAJO;
}

//Si el usuario no elige ninguna opción
if (!isset($_REQUEST['action'])){
	$action = ''; //la acctión se pone vacía
}else{
	$action = $_REQUEST['action']; //si no, se le asigna la accion elegida

}


	// En funcion de la accion elegida
	Switch ($action){
		case 'ADD': //Si quiere hacer un ADD
			if (!$_POST){ //si viene del showall (no es un post)

				$form = new TRABAJO_ADD(); //Crea la vista ADD y muestra formulario para rellenar por el usuario
			}
			else{ //si viene del add 

				$TRABAJO = get_data_form(); //recibe datos
				$lista = $TRABAJO->ADD(); //mete datos en respuesta usuarios despues de ejecutar el add con los de TRABAJO
				$usuario = new MESSAGE($lista, '../Controllers/TRABAJO_Controller.php'); //muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'DELETE': //Si quiere hacer un DELETE
			if (!$_POST){ //viene del showall con una clave
				$TRABAJO = new TRABAJO_Model($_REQUEST['IdTrabajo'], '','', '', ''); //crea un un TRABAJO_Model con el IdTrabajo del usuario
				$valores = $TRABAJO->RellenaDatos(); //completa el resto de atributos a partir de la clave
				$usuario = new TRABAJO_DELETE($valores); //Crea la vista de DELETE con los datos del usuario
			}
			else{//si viene con un post
				$TRABAJO = get_data_UserBD(); //coge los datos del formulario del usuario que desea borrar
				$respuesta = $TRABAJO->DELETE(); //Ejecuta la funcion DELETE() en el TRABAJO_Model
				$mensaje = new MESSAGE($respuesta, '../Controllers/TRABAJO_Controller.php'); //muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'EDIT': //si el usuario quiere editar	
			if (!$_POST){
				$TRABAJO = new TRABAJO_Model($_REQUEST['IdTrabajo'], '','', '', ''); //crea un un TRABAJO_Model con el IdTrabajo del usuario 
				$datos = $TRABAJO->RellenaDatos();  //A partir del IdTrabajo recoge todos los atributos
				$usuario = new TRABAJO_EDIT($datos); //Crea la vista EDIT con los datos del usuario
			}
			else{
				$TRABAJO = get_data_UserBD(); //coge los datos del formulario del usuario que desea editar
				$respuesta = $TRABAJO->EDIT(); //Ejecuta la funcion EDIT() en el TRABAJO_Model
				$mensaje = new MESSAGE($respuesta, '../Controllers/TRABAJO_Controller.php');//muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'SEARCH': //si desea realizar una busqueda
			if (!$_POST){
				$TRABAJO = new TRABAJO_SEARCH();//Crea la vista SEARCH y muestra formulario para rellenar por el usuario
			}
			else{
				$TRABAJO = get_data_UserBD(); //coge los datos del formulario del usuario que desea buscar
				$datos = $TRABAJO->SEARCH();//Ejecuta la funcion SEARCH() en el TRABAJO_Model
				$lista = array('IdTrabajo','NombreTrabajo','FechIniTrabajo','FechFinTrabajo','PorcetajeNota');
				$resultado = new TRABAJO_SHOWALL($lista, $datos, 0, 0, 0, 0, 'SEARCH', '../Controllers/TRABAJO_Controller.php');//Crea la vista SHOWALL y muestra los usuarios que cumplen los parámetros de búsqueda 
			}
			break;
		case 'SHOWCURRENT': //si desea ver un usuario en detalle
			$TRABAJO = new TRABAJO_Model($_REQUEST['IdTrabajo'], '','', '', '');//crea un un TRABAJO_Model con el IdTrabajo del usuario 
			$tupla = $TRABAJO->RellenaDatos();//A partir del IdTrabajo recoge todos los atributos
			$usuario = new TRABAJO_SHOWCURRENT($tupla); //Crea la vista SHOWCURRENT del usuario requerido
			break;
		default: //Por defecto, Se muestra la vista SHOWALL
			if (!$_POST){
				$TRABAJO = new TRABAJO_Model($_REQUEST['IdTrabajo'], '','','', '');//crea un un TRABAJO_Model con el IdTrabajo del usuario 
			}
			else{
				$TRABAJO = get_data_form(); //Coge los datos del formulario
			}

			if(!isset($_REQUEST['num_pagina'])){ //Si es la 1a página del showall a mostrar
				$num_pagina = 0;
			}else{ //Si es otra página
				$num_pagina = $_REQUEST['num_pagina']; //coge el numero de página del formulario
			}
			$num_tupla = $num_pagina*10; //número de la 1º tupla a mostrar
			$max_tuplas = $num_tupla+10; // el número de tuplas a mostrar por página
			$totalTuplas = $TRABAJO->contarTuplas(); //Cuenta el número de tuplas que hay en la BD
			$datos = $TRABAJO->SHOWALL($num_tupla,$max_tuplas); //Ejecuta la funcion SHOWALL() en el TRABAJO_Model
			$lista = array('IdTrabajo', 'NombreTrabajo', 'FechIniTrabajo','FechFinTrabajo','PorcetajeNota');
			$UsuariosBD = new TRABAJO_SHOWALL($lista, $datos, $num_tupla, $max_tuplas, $totalTuplas, $num_pagina, 'SHOWALL', '../Controllers/TRABAJO_Controller.php'); //Crea la vista SHOWALL de los usuarios de la BD	
	}

?>