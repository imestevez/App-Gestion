<?php
/*
	Autor: SOLFAMIDAS
	Fecha de creación: 26/11/2017
	Descripción: Controlador para la entidad HISTORIA.

*/
session_start(); //solicito trabajar con la session


include_once '../Functions/Authentication.php';
include_once '../Functions/ACL.php';
include_once '../Views/MESSAGE_View.php';

if (!IsAuthenticated()){
	header('Location:../index.php');
}else{

if(isset($_REQUEST["action"]))  {
	$action = $_REQUEST["action"];
}else{

	$action = '';
}

//Si no tiene permisos para acceder a este controlador con la accion que trae
if(!HavePermissions(7, $action)) {
	//new MESSAGE('No tienes permisos para realizar esta accion', '../index.php');
	header('Location:../index.php'); //vuelve al index
}
//almacenamos un array de permidos del grupo
$permisos = listaPermisos();
$acciones = listaAcciones(7);

//Pnemos la variabla acceso  a false con la que se controla si el usuario puede ver un showall o no
$acceso=false;

include_once '../Models/HISTORIA_Model.php';

include_once '../Views/HISTORIA/HISTORIA_SHOWALL_View.php';
include_once '../Views/HISTORIA/HISTORIA_SHOWCURRENT_View.php';
include_once '../Views/HISTORIA/HISTORIA_ADD_View.php';
include_once '../Views/HISTORIA/HISTORIA_EDIT_View.php';
include_once '../Views/HISTORIA/HISTORIA_SEARCH_View.php';
include_once '../Views/HISTORIA/HISTORIA_DELETE_View.php';
include_once '../Views/MESSAGE_View.php';



// funcion para coger los datos del formulario
function get_data_form(){

	$IdTrabajo = '';
	$NombreTrabajo = '';
	$IdHistoria = '';
	$TextoHistoria = '';
	
	$action = $_REQUEST['action'];

	if(isset($_REQUEST['IdTrabajo'])){
	$IdTrabajo = $_REQUEST['IdTrabajo'];
	}
	if(isset($_REQUEST['NombreTrabajo'])){
	$NombreTrabajo = $_REQUEST['NombreTrabajo'];
	}
	if(isset($_REQUEST['IdHistoria'])){
	$IdHistoria = $_REQUEST['IdHistoria'];
	}
	if(isset($_REQUEST['TextoHistoria'])){
	$TextoHistoria = $_REQUEST['TextoHistoria'];
	}

	$HISTORIA = new HISTORIA_Model(
		$IdTrabajo, 
		$NombreTrabajo,
		$IdHistoria, 
		$TextoHistoria);

	return $HISTORIA;
}

//Funcion para coger los datos del formulario de un usuario ya almacenado
function get_data_UserBD(){

	$IdTrabajo = '';
	$NombreTrabajo = '';
	$IdHistoria = '';
	$TextoHistoria = '';

	$action = $_REQUEST['action'];

	if(isset($_REQUEST['IdTrabajo'])){
	$IdTrabajo = $_REQUEST['IdTrabajo'];
	}
	if(isset($_REQUEST['NombreTrabajo'])){
	$NombreTrabajo = $_REQUEST['NombreTrabajo'];
	}
	if(isset($_REQUEST['IdHistoria'])){
	$IdHistoria = $_REQUEST['IdHistoria'];
	}
	if(isset($_REQUEST['TextoHistoria'])){
	$TextoHistoria = $_REQUEST['TextoHistoria'];
	}

	$HISTORIA = new HISTORIA_Model(
		$IdTrabajo, 
		$NombreTrabajo,
		$IdHistoria, 
		$TextoHistoria);

	return $HISTORIA;
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
				$lista = array('IdTrabajo','NombreTrabajo');
				if((isset($_REQUEST['IdTrabajo']))){
					$HISTORIA = get_data_form();

					$lista = $HISTORIA->rellenarLista();
				
				$form = new HISTORIA_ADD($lista);
				}
				else{
					$lista['IdTrabajo'] = '';
					$form = new HISTORIA_ADD($lista);
				} //Crea la vista ADD y muestra formulario para rellenar por el usuario
			}
			else{ //si viene del add 

				$HISTORIA = get_data_form(); //recibe datos
				$lista = $HISTORIA->ADD(); //mete datos en respuesta usuarios despues de ejecutar el add con los de HISTORIA
				$usuario = new MESSAGE($lista, '../Controllers/HISTORIA_Controller.php'); //muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'DELETE': //Si quiere hacer un DELETE
			if (!$_POST){ //viene del showall con una clave
				$HISTORIA = new HISTORIA_Model($_REQUEST['IdTrabajo'],'', $_REQUEST['IdHistoria'],''); //crea un un HISTORIA_Model con el IdTrabajo y el IdHistoria
				$valores = $HISTORIA->RellenaDatos(); //completa el resto de atributos a partir de la clave
				$usuario = new HISTORIA_DELETE($valores); //Crea la vista de DELETE con los datos del usuario
			}
			else{//si viene con un post

				$HISTORIA = get_data_UserBD(); //coge los datos del formulario del usuario que desea borrar

				$respuesta = $HISTORIA->DELETE(); //Ejecuta la funcion DELETE() en el HISTORIA_Model
				$mensaje = new MESSAGE($respuesta, '../Controllers/HISTORIA_Controller.php'); //muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'EDIT': //si el usuario quiere editar	
			if (!$_POST){
				$HISTORIA = new HISTORIA_Model($_REQUEST['IdTrabajo'],'',  $_REQUEST['IdHistoria'],''); //crea un un HISTORIA_Model con el IdTrabajo del usuario 
				$datos = $HISTORIA->RellenaDatos(); //A partir del IdTrabajo recoge todos los atributos
				$usuario = new HISTORIA_EDIT($datos); //Crea la vista EDIT con los datos del usuario
			}
			else{
				$HISTORIA = get_data_UserBD(); //coge los datos del formulario del usuario que desea editar
				$respuesta = $HISTORIA->EDIT(); //Ejecuta la funcion EDIT() en el HISTORIA_Model
				$mensaje = new MESSAGE($respuesta, '../Controllers/HISTORIA_Controller.php');//muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'SEARCH': //si desea realizar una busqueda
			if (!$_POST){
				$HISTORIA = new HISTORIA_SEARCH();//Crea la vista SEARCH y muestra formulario para rellenar por el usuario
			}
			else{
				$HISTORIA = get_data_UserBD(); //coge los datos del formulario del usuario que desea buscar
				$datos = $HISTORIA->SEARCH();//Ejecuta la funcion SEARCH() en el HISTORIA_Model
				$lista = array('IdTrabajo','NombreTrabajo','IdHistoria','TextoHistoria');
				$resultado = new HISTORIA_SHOWALL($lista, $datos, 0, 0, 0, 0, 'SEARCH', '../Controllers/HISTORIA_Controller.php',$acciones);//Crea la vista SHOWALL y muestra los usuarios que cumplen los parámetros de búsqueda 
			}
			break;
		case 'SHOW': //si desea ver un usuario en detalle
			$HISTORIA = new HISTORIA_Model($_REQUEST['IdTrabajo'], '', $_REQUEST['IdHistoria'],'');//crea un un HISTORIA_Model con el IdTrabajo del usuario 
			$tupla = $HISTORIA->RellenaDatos();//A partir del IdTrabajo recoge todos los atributos
			$usuario = new HISTORIA_SHOWCURRENT($tupla); //Crea la vista SHOWCURRENT del usuario requerido
			break;

		default: //Por defecto, Se muestra la vista SHOWALL
			foreach ($acciones as $key => $value) {
				if($value == 'ALL'){ //si puede ver el showall
					$acceso = true; //acceso a true
				}
			}
			if($acceso == true){ //si tiene acceso, mostramos el showall
				if (!$_POST){
					$HISTORIA = new HISTORIA_Model('', '','','');//crea un un HISTORIA_Model con el IdTrabajo del usuario 
				}
				else{
					$HISTORIA = get_data_form(); //Coge los datos del formulario
				}

				if(!isset($_REQUEST['num_pagina'])){ //Si es la 1a página del showall a mostrar
					$num_pagina = 0;
				}else{ //Si es otra página
					$num_pagina = $_REQUEST['num_pagina']; //coge el numero de página del formulario
				}
				$num_tupla = $num_pagina*10; //número de la 1º tupla a mostrar
				$max_tuplas = $num_tupla+10; // el número de tuplas a mostrar por página
				$totalTuplas = $HISTORIA->contarTuplas(); //Cuenta el número de tuplas que hay en la BD
				$datos = $HISTORIA->SHOWALL($num_tupla,$max_tuplas); //Ejecuta la funcion SHOWALL() en el HISTORIA_Model
				$lista = array('IdTrabajo','NombreTrabajo', 'IdHistoria', 'TextoHistoria');
				$UsuariosBD = new HISTORIA_SHOWALL($lista, $datos, $num_tupla, $max_tuplas, $totalTuplas, $num_pagina, 'SHOWALL', '../Controllers/HISTORIA_Controller.php',$acciones); //Crea la vista SHOWALL de los usuarios de la BD	
			}else{
				if (!$_POST){
					$HISTORIA = new HISTORIA_Model('', '','','');//crea un un HISTORIA_Model con el IdTrabajo del usuario 
				}
				else{
					$HISTORIA = get_data_form(); //Coge los datos del formulario
				}

				if(!isset($_REQUEST['num_pagina'])){ //Si es la 1a página del showall a mostrar
					$num_pagina = 0;
				}else{ //Si es otra página
					$num_pagina = $_REQUEST['num_pagina']; //coge el numero de página del formulario
				}
				$num_tupla = $num_pagina*10; //número de la 1º tupla a mostrar
				$max_tuplas = $num_tupla+10; // el número de tuplas a mostrar por página
				$totalTuplas = $HISTORIA->contarTuplas(); //Cuenta el número de tuplas que hay en la BD
				$datos = $HISTORIA->SHOWALL_User($num_tupla,$max_tuplas); //Ejecuta la funcion SHOWALL() en el HISTORIA_Model
				$lista = array('IdTrabajo','NombreTrabajo', 'IdHistoria', 'TextoHistoria');
				$UsuariosBD = new HISTORIA_SHOWALL($lista, $datos, $num_tupla, $max_tuplas, $totalTuplas, $num_pagina, 'ALL', '../Controllers/HISTORIA_Controller.php',$acciones); //Crea la vista SHOWALL de los usuarios de la BD	
			}
		}
	}

?>