
<?php

/*
//Script : ACCION_Controller.php
//Creado el : 13-10-2017
//Creado por: vugsj4
//-------------------------------------------------------

Controlador que recibe las peticiones del usuario y este ejectuta las acciones pertinentes sobre el Model de datos y las vistas
*/
session_start(); //solicito trabajar con la session

include_once '../Functions/Authentication.php';

if (!IsAuthenticated()){
	header('Location:../index.php');
}

include '../Models/ACCION_Model.php';

include '../Views/ACCION/ACCION_SHOWALL_View.php';
include '../Views/ACCION/ACCION_SHOWCURRENT_View.php';
include '../Views/ACCION/ACCION_ADD_View.php';
include '../Views/ACCION/ACCION_EDIT_View.php';
include '../Views/ACCION/ACCION_SEARCH_View.php';
include '../Views/ACCION/ACCION_DELETE_View.php';
include '../Views/MESSAGE_View.php';



// funcion para coger los datos del formulario
function get_data_form(){

	$IdAccion = '';
	$NombreAccion = '';
	$DescripAccion = '';
	
	$action = '';

	if(isset($_REQUEST['IdAccion'])){
	$IdAccion = $_REQUEST['IdAccion'];
	}
	if(isset($_REQUEST['NombreAccion'])){
	$NombreAccion = $_REQUEST['NombreAccion'];
	}
	if(isset($_REQUEST['DescripAccion'])){
	$DescripAccion = $_REQUEST['DescripAccion'];
	}
	if(isset($_REQUEST['action'])){
	$action = $_REQUEST['action'];
	}

	$ACCIONES = new ACCION_Model(
		$IdAccion, 
		$NombreAccion, 
		$DescripAccion);

	return $ACCIONES;
}

//Funcion para coger los datos del formulario de un usuario ya almacenado
function get_data_UserBD(){

	
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

				$form = new ACCION_ADD(); //Crea la vista ADD y muestra formulario para rellenar por el usuario
			}
			else{ //si viene del add 

				$ACCIONES = get_data_form(); //recibe datos
				$lista = $ACCIONES->ADD(); //mete datos en respuesta usuarios despues de ejecutar el add con los de ACCIONES
				$accion = new MESSAGE($lista, '../Controllers/ACCION_Controller.php'); //muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'DELETE': //Si quiere hacer un DELETE
			if (!$_POST){ //viene del showall con una clave
				$ACCIONES = new ACCION_Model($_REQUEST['IdAccion'], '',''); //crea un un USUARIOS_Model con el login del accion
				$valores = $ACCIONES->RellenaDatos(); //completa el resto de atributos a partir de la clave
				$accion = new ACCION_DELETE($valores); //Crea la vista de DELETE con los datos del accion
			}
			else{//si viene con un post
				$ACCIONES = get_data_form(); //coge los datos del formulario del accion que desea borrar
				$respuesta = $ACCIONES->DELETE(); //Ejecuta la funcion DELETE() en el USUARIOS_Model
				$mensaje = new MESSAGE($respuesta, '../Controllers/ACCION_Controller.php'); //muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'EDIT': //si el usuario quiere editar	
			if (!$_POST){
				$ACCIONES = new ACCION_Model($_REQUEST['IdAccion'],'',''); //crea un un ACCION_Model con el login del accion 
				$datos = $ACCIONES->RellenaDatos();  //A partir del login recoge todos los atributos
				$accion = new ACCION_EDIT($datos); //Crea la vista EDIT con los datos del accion
			}
			else{
				$ACCIONES = get_data_form(); //coge los datos del formulario del usuario que desea editar
				$respuesta = $ACCIONES->EDIT(); //Ejecuta la funcion EDIT() en el USUARIOS_Model
				$mensaje = new MESSAGE($respuesta, '../Controllers/ACCION_Controller.php');//muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'SEARCH': //si desea realizar una busqueda
			if (!$_POST){
				$ACCIONES = new ACCION_SEARCH();//Crea la vista SEARCH y muestra formulario para rellenar por el usuario
			}
			else{
				$ACCIONES = get_data_form(); //coge los datos del formulario del usuario que desea buscar
				$datos = $ACCIONES->SEARCH();//Ejecuta la funcion SEARCH() en el USUARIOS_Model
				$lista = array('IdAccion','NombreAccion','DescripAccion');
				$resultado = new ACCION_SHOWALL($lista, $datos, 0, 0, 0, 0, 'SEARCH', '../Controllers/ACCION_Controller.php');//Crea la vista SHOWALL y muestra los usuarios que cumplen los parámetros de búsqueda 
			}
			break;
		case 'SHOWCURRENT': //si desea ver un usuario en detalle
			$ACCIONES = new ACCION_Model($_REQUEST['IdAccion'], '','');//crea un un USUARIOS_Model con el login del usuario 
			$tupla = $ACCIONES->RellenaDatos();//A partir del login recoge todos los atributos
			$accion = new ACCION_SHOWCURRENT($tupla); //Crea la vista SHOWCURRENT del accion requerido
			break;
		default: //Por defecto, Se muestra la vista SHOWALL
			if (!$_POST){
				$ACCIONES = new ACCION_Model('','','');//crea un un USUARIOS_Model con el login del usuario 
			}
			else{
				$ACCIONES = get_data_form(); //Coge los datos del formulario
			}

			if(!isset($_REQUEST['num_pagina'])){ //Si es la 1a página del showall a mostrar
				$num_pagina = 0;
			}else{ //Si es otra página
				$num_pagina = $_REQUEST['num_pagina']; //coge el numero de página del formulario
			}
			$num_tupla = $num_pagina*10; //número de la 1º tupla a mostrar
			$max_tuplas = $num_tupla+10; // el número de tuplas a mostrar por página
			$totalTuplas = $ACCIONES->contarTuplas(); //Cuenta el número de tuplas que hay en la BD
			$datos = $ACCIONES->SHOWALL($num_tupla,$max_tuplas); //Ejecuta la funcion SHOWALL() en el USUARIOS_Model
			$lista = array('IdAccion','NombreAccion','DescripAccion');
			$AccionesBD = new ACCION_SHOWALL($lista, $datos, $num_tupla, $max_tuplas, $totalTuplas, $num_pagina, 'SHOWALL', '../Controllers/ACCION_Controller.php'); //Crea la vista SHOWALL de los usuarios de la BD	
	}

?>