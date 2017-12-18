<?php
/*
	Autor: SOLFAMIDAS
	Fecha de creación: 07/12/2017
	Descripción: Controlador para la entidad ASIGNAC_QA.

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
if(!HavePermissions(9, $action)) {
	new MESSAGE('No tienes permisos para realizar esta accion', '../index.php');exit();
	//header('Location:../index.php'); //vuelve al index
}
//almacenamos un array de permidos del grupo
$permisos = listaPermisos();
$acciones = listaAcciones(9);

//Pnemos la variabla acceso  a false con la que se controla si el usuario puede ver un showall o no
$acceso=false;
include_once '../Models/ASIGNAC_QA_Model.php';

include_once '../Views/ASIGNAC_QA/ASIGNAC_QA_SHOWALL_View.php';
include_once '../Views/ASIGNAC_QA/ASIGNAC_QA_SHOWCURRENT_View.php';
include_once '../Views/ASIGNAC_QA/ASIGNAC_QA_ADD_View.php';
include_once '../Views/ASIGNAC_QA/ASIGNAC_QA_EDIT_View.php';
include_once '../Views/ASIGNAC_QA/ASIGNAC_QA_SEARCH_View.php';
include_once '../Views/ASIGNAC_QA/ASIGNAC_QA_DELETE_View.php';
include_once '../Views/ASIGNAC_QA/ASIGNAC_QA_GENQA_View.php';
include_once '../Views/ASIGNAC_QA/ASIGNAC_QA_GENEV_View.php';
include_once '../Views/MESSAGE_View.php';



// funcion para coger los datos del formulario
function get_data_form(){

	$IdTrabajo = '';
	$NombreTrabajo = '';
	$LoginEvaluador = '';
	$LoginEvaluado = '';
	$AliasEvaluado = '';
	
	$action = $_REQUEST['action'];

	if(isset($_REQUEST['IdTrabajo'])){
	$IdTrabajo = $_REQUEST['IdTrabajo'];
	}
	if(isset($_REQUEST['NombreTrabajo'])){
	$NombreTrabajo = $_REQUEST['NombreTrabajo'];
	}
	if(isset($_REQUEST['LoginEvaluador'])){
	$LoginEvaluador = $_REQUEST['LoginEvaluador'];
	}
	if(isset($_REQUEST['LoginEvaluado'])){
	$LoginEvaluado = $_REQUEST['LoginEvaluado'];
	}
	if(isset($_REQUEST['AliasEvaluado'])){
	$AliasEvaluado = $_REQUEST['AliasEvaluado'];
	}

	$ASIGNAC_QA = new ASIGNAC_QA_Model(
		$IdTrabajo, 
		$NombreTrabajo,
		$LoginEvaluador,
		$LoginEvaluado, 
		$AliasEvaluado);

	return $ASIGNAC_QA;
}

//Funcion para coger los datos del formulario de un usuario ya almacenado
function get_data_UserBD(){

	$IdTrabajo = '';
	$NombreTrabajo = '';
	$LoginEvaluador = '';
	$LoginEvaluado = '';
	$AliasEvaluado = '';
	
	$action = $_REQUEST['action'];

	if(isset($_REQUEST['IdTrabajo'])){
	$IdTrabajo = $_REQUEST['IdTrabajo'];
	}
	if(isset($_REQUEST['NombreTrabajo'])){
	$NombreTrabajo = $_REQUEST['NombreTrabajo'];
	}
	if(isset($_REQUEST['LoginEvaluador'])){
	$LoginEvaluador = $_REQUEST['LoginEvaluador'];
	}
	if(isset($_REQUEST['LoginEvaluado'])){
	$LoginEvaluado = $_REQUEST['LoginEvaluado'];
	}
	if(isset($_REQUEST['AliasEvaluado'])){
	$AliasEvaluado = $_REQUEST['AliasEvaluado'];
	}

	$ASIGNAC_QA = new ASIGNAC_QA_Model(
		$IdTrabajo, 
		$NombreTrabajo,
		$LoginEvaluador,
		$LoginEvaluado, 
		$AliasEvaluado);

	return $ASIGNAC_QA;
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

				$form = new ASIGNAC_QA_ADD(); //Crea la vista ADD y muestra formulario para rellenar por el usuario
			}
			else{ //si viene del add 

				$ASIGNAC_QA = get_data_form(); //recibe datos
				$lista = $ASIGNAC_QA->ADD(); //mete datos en respuesta usuarios despues de ejecutar el add con los de funcionalidad
				$usuario = new MESSAGE($lista, '../Controllers/ASIGNAC_QA_Controller.php'); //muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'DELETE': //Si quiere hacer un DELETE
			if (!$_POST){ //viene del showall con una clave
				$ASIGNAC_QA = new ASIGNAC_QA_Model($_REQUEST['IdTrabajo'],'', $_REQUEST['LoginEvaluador'],'',$_REQUEST['AliasEvaluado']); //crea un un ASIGNAC_QA_Model con las claves
				$valores = $ASIGNAC_QA->RellenaDatos(); //completa el resto de atributos a partir de la clave
				$usuario = new ASIGNAC_QA_DELETE($valores); //Crea la vista de DELETE con los datos del usuario
			}
			else{//si viene con un post
				$ASIGNAC_QA = get_data_form(); //coge los datos del formulario del usuario que desea borrar
				$respuesta = $ASIGNAC_QA->DELETE(); //Ejecuta la funcion DELETE() en el ASIGNAC_QA_Model
				$mensaje = new MESSAGE($respuesta, '../Controllers/ASIGNAC_QA_Controller.php'); //muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'EDIT': //si el usuario quiere editar	
			if (!$_POST){
				$ASIGNAC_QA = new ASIGNAC_QA_Model($_REQUEST['IdTrabajo'],'', $_REQUEST['LoginEvaluador'], '',$_REQUEST['AliasEvaluado']); //crea un un ASIGNAC_QA_Model 
				$datos = $ASIGNAC_QA->RellenaDatos();  //A partir del IdFuncionalidad recoge todos los atributos
				$usuario = new ASIGNAC_QA_EDIT($datos); //Crea la vista EDIT con los datos del usuario
			}
			else{
				$ASIGNAC_QA = get_data_form(); //coge los datos del formulario del usuario que desea editar
				$respuesta = $ASIGNAC_QA->EDIT(); //Ejecuta la funcion EDIT() en el ASIGNAC_QA_Model
				$mensaje = new MESSAGE($respuesta, '../Controllers/ASIGNAC_QA_Controller.php');//muestra el mensaje despues de la sentencia sql
			}
			break;
			$asigna = new ASIGNAC_QA_Model('','','','','');
			$respuesta = $asigna->asig_QAS($_REQUEST['IdTrabajo']);

			break;
		case 'SEARCH': //si desea realizar una busqueda
			if (!$_POST){
				$ASIGNAC_QA = new ASIGNAC_QA_SEARCH();//Crea la vista SEARCH y muestra formulario para rellenar por el usuario
			}
			else{
				$ASIGNAC_QA = get_data_form(); //coge los datos del formulario del usuario que desea buscar
				$datos = $ASIGNAC_QA->SEARCH();//Ejecuta la funcion SEARCH() en el ASIGNAC_QA_Model
				$lista = array('IdTrabajo','NombreTrabajo','LoginEvaluador','LoginEvaluado','AliasEvaluado');
				$resultado = new ASIGNAC_QA_SHOWALL($lista, $datos, 0, 0, 0, 0, 'SEARCH', '../Controllers/ASIGNAC_QA_Controller.php',$acciones);//Crea la vista SHOWALL y muestra los usuarios que cumplen los parámetros de búsqueda 
			}
			break;
		case 'SHOW': //si desea ver un usuario en detalle
			$ASIGNAC_QA = new ASIGNAC_QA_Model($_REQUEST['IdTrabajo'],'', $_REQUEST['LoginEvaluador'],'',$_REQUEST['AliasEvaluado']);//crea un un ASIGNAC_QA_Model con el IdFuncionalidad del usuario 
			$tupla = $ASIGNAC_QA->RellenaDatos();//A partir del IdFuncionalidad recoge todos los atributos
			$usuario = new ASIGNAC_QA_SHOWCURRENT($tupla); //Crea la vista SHOWCURRENT del usuario requerido
			break;

		case 'GENQA':
			if (!$_POST){
				$form = new ASIGNAC_QA_GENQA(); //Muestra el formmulario para la asignación automática
			}
			else{
				$ASIGNAC_QA = new ASIGNAC_QA_Model('','','','','');
				$lista = $ASIGNAC_QA->asig_QAS($_REQUEST['IdTrabajo'],$_REQUEST['numEntregas']); //mete datos en respuesta usuarios despues de ejecutar el add con los de funcionalidad
				$usuario = new MESSAGE($lista, '../Controllers/ASIGNAC_QA_Controller.php'); //muestra el mensaje despues de la sentencia sql
			}
			break;	
		case 'GENEV':
			if (!$_POST){
				$form = new ASIGNAC_QA_GENEV(); //Muestra el formmulario para la generación de historias a evaluar
			}
			else{
				$ASIGNAC_QA = new ASIGNAC_QA_Model('','','','','');
				$lista = $ASIGNAC_QA->historiasEvaluación($_REQUEST['IdTrabajo']); 
				$usuario = new MESSAGE($lista, '../Controllers/ASIGNAC_QA_Controller.php'); //muestra el mensaje despues de la sentencia sql
			}
			break;	
		default: //Por defecto, Se muestra la vista SHOWALL
		
			if (!$_POST){
				$ASIGNAC_QA = new ASIGNAC_QA_Model('', '','', '', '');//crea un un ASIGNAC_QA_Model  
			}
			else{
				$ASIGNAC_QA = get_data_form(); //Coge los datos del formulario
			}

			if(!isset($_REQUEST['num_pagina'])){ //Si es la 1a página del showall a mostrar
				$num_pagina = 0;
			}else{ //Si es otra página
				$num_pagina = $_REQUEST['num_pagina']; //coge el numero de página del formulario
			}
			$num_tupla = $num_pagina*10; //número de la 1º tupla a mostrar
			$max_tuplas = $num_tupla+10; // el número de tuplas a mostrar por página
			$totalTuplas = $ASIGNAC_QA->contarTuplas(); //Cuenta el número de tuplas que hay en la BD
			$datos = $ASIGNAC_QA->SHOWALL($num_tupla,$max_tuplas); //Ejecuta la funcion SHOWALL() en el ASIGNAC_QA_Model
			$lista = array('IdTrabajo','NombreTrabajo','LoginEvaluador','LoginEvaluado','AliasEvaluado');
			$UsuariosBD = new ASIGNAC_QA_SHOWALL($lista, $datos, $num_tupla, $max_tuplas, $totalTuplas, $num_pagina, 'SHOWALL', '../Controllers/ASIGNAC_QA_Controller.php',$acciones); //Crea la vista SHOWALL de los usuarios de la BD	
	}
	}
	

?>