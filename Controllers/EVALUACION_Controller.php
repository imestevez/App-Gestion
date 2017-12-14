
<?php

/*
//Script : EVALUACION_Controller.php
//Creado el : 29-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Controlador que recibe las acciones relacionadas con EVALUACION
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
if(!HavePermissions(10, $action)) {
	//new MESSAGE('No tienes permisos para realizar esta accion', '../index.php');
	header('Location:../index.php'); //vuelve al index
}
//almacenamos un array de permidos del grupo
$permisos = listaPermisos();
$acciones = listaAcciones(10);

//Pnemos la variabla acceso  a false con la que se controla si el usuario puede ver un showall o no
$acceso=false;

include_once '../Models/EVALUACION_Model.php';

include_once '../Views/EVALUACION/EVALUACION_SHOWALL_View.php';
include_once '../Views/EVALUACION/EVALUACION_SHOWCURRENT_View.php';
include_once '../Views/EVALUACION/EVALUACION_ADD_View.php';
include_once '../Views/EVALUACION/EVALUACION_EDIT_View.php';
include_once '../Views/EVALUACION/EVALUACION_SEARCH_View.php';
include_once '../Views/EVALUACION/EVALUACION_DELETE_View.php';
include_once '../Views/MESSAGE_View.php';



// funcion para coger los datos del formulario
function get_data_form(){

	$IdTrabajo = null;
	$LoginEvaluador = null;
	$AliasEvaluado = null;
	$IdHistoria = null;
	$CorrectoA = null;
	$ComenIncorrectoA = null;
	$CorrectoP = null;
	$ComentIncorrectoP = null;
	$OK = null;
	$origen = null;
	$action = null;


	if(isset($_REQUEST['IdTrabajo'])){
	$IdTrabajo = $_REQUEST['IdTrabajo'];
	}
	if(isset($_REQUEST['LoginEvaluador'])){
	$LoginEvaluador = $_REQUEST['LoginEvaluador'];
	}
	if(isset($_REQUEST['AliasEvaluado'])){
	$AliasEvaluado = $_REQUEST['AliasEvaluado'];
	}
	if(isset($_REQUEST['IdHistoria'])){
	$IdHistoria = $_REQUEST['IdHistoria'];
	}
	if(isset($_REQUEST['CorrectoA'])){
	$CorrectoA = $_REQUEST['CorrectoA'];
	}
	if(isset($_REQUEST['ComenIncorrectoA'])){
	$ComenIncorrectoA = $_REQUEST['ComenIncorrectoA'];
	}
	if(isset($_REQUEST['CorrectoP'])){
	$CorrectoP = $_REQUEST['CorrectoP'];
	}
	if(isset($_REQUEST['ComentIncorrectoP'])){
	$ComentIncorrectoP = $_REQUEST['ComentIncorrectoP'];
	}
	if(isset($_REQUEST['OK'])){
	$OK = $_REQUEST['OK'];
	}
	if(isset($_REQUEST['origen'])){
	$origen = $_REQUEST['origen'];
	}

		$EVALUACION = new EVALUACION_Model(
		$IdTrabajo, 
		$LoginEvaluador,
		$AliasEvaluado, 
		$IdHistoria, 
		$CorrectoA,
		$ComenIncorrectoA,
		$CorrectoP,
		$ComentIncorrectoP,
		$OK);

	return $EVALUACION;


}
//Funcion para coger los datos del formulario de un usuario ya almacenado
function get_data_UserBD(){

	$IdTrabajo = null;
	$LoginEvaluador = null;
	$AliasEvaluado = null;
	$IdHistoria = null;
	$CorrectoA = null;
	$ComenIncorrectoA = null;
	$CorrectoP = null;
	$ComentIncorrectoP = null;
	$OK = null;
	$origen = null;
	$action = null;


	if(isset($_REQUEST['IdTrabajo'])){
	$IdTrabajo = $_REQUEST['IdTrabajo'];
	}
	if(isset($_REQUEST['LoginEvaluador'])){
	$LoginEvaluador = $_REQUEST['LoginEvaluador'];
	}
	if(isset($_REQUEST['AliasEvaluado'])){
	$AliasEvaluado = $_REQUEST['AliasEvaluado'];
	}
	if(isset($_REQUEST['IdHistoria'])){
	$IdHistoria = $_REQUEST['IdHistoria'];
	}
	if(isset($_REQUEST['CorrectoA'])){
	$CorrectoA = $_REQUEST['CorrectoA'];
	}
	if(isset($_REQUEST['ComenIncorrectoA'])){
	$ComenIncorrectoA = $_REQUEST['ComenIncorrectoA'];
	}
	if(isset($_REQUEST['CorrectoP'])){
	$CorrectoP = $_REQUEST['CorrectoP'];
	}
	if(isset($_REQUEST['ComentIncorrectoP'])){
	$ComentIncorrectoP = $_REQUEST['ComentIncorrectoP'];
	}
	if(isset($_REQUEST['OK'])){
	$OK = $_REQUEST['OK'];
	}
	if(isset($_REQUEST['action'])){
	$action = $_REQUEST['action'];
	}

		$EVALUACION = new EVALUACION_Model(
		$IdTrabajo, 
		$LoginEvaluador,
		$AliasEvaluado, 
		$IdHistoria, 
		$CorrectoA,
		$ComenIncorrectoA,
		$CorrectoP,
		$ComentIncorrectoP,
		$OK);

	return $EVALUACION;
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
				$lista = array('IdTrabajo', 'LoginEvaluador', 'AliasEvaluado', 'IdHistoria', 'CorrectoA', 'ComenIncorrectoA', 'CorrectoP', 'ComentIncorrectoP', 'OK', 'origen');

				if( (isset($_REQUEST['IdTrabajo'])) && 
					(isset($_REQUEST['LoginEvaluador'])) && 
					(isset($_REQUEST['AliasEvaluado'])) &&
					(isset($_REQUEST['IdHistoria'])) &&
					(isset($_REQUEST['origen'])) ) {

					$EVALUACION = get_data_form(); //recibe datos
					
					$lista['IdTrabajo'] = $_REQUEST['IdTrabajo'];
					$lista['LoginEvaluador'] = $_REQUEST['LoginEvaluador'];
					$lista['AliasEvaluado'] = $_REQUEST['AliasEvaluado'];
					$lista['IdHistoria'] = $_REQUEST['IdHistoria'];
					$lista = $EVALUACION->rellenarLista();
					$lista['origen'] = $_REQUEST['origen'];

					$form = new EVALUACION_ADD($lista); //Crea la vista ADD y muestra formulario para rellenar por el usuario
				}else{
					$lista['IdTrabajo'] = '';
					$lista['LoginEvaluador'] = '';
					$lista['AliasEvaluado'] = '';
					$lista['IdHistoria'] = '';
					$lista['origen'] = '../Controllers/EVALUACION_Controller.php';
					$form = new EVALUACION_ADD($lista); //Crea la vista ADD y muestra formulario para rellenar por el usuario
				}
			}
			else{ //si viene del add 
				
				$EVALUACION = get_data_form(); //recibe datos
				$lista = $EVALUACION->ADD(); //mete datos en respuesta usuarios despues de ejecutar el add con los de EVALUACION
				$usuario = new MESSAGE($lista, '../Controllers/EVALUACION_Controller.php'); //muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'DELETE': //Si quiere hacer un DELETE
			if (!$_POST){ //viene del showall con una clave
				$lista = array('IdTrabajo', 'LoginEvaluador', 'AliasEvaluado', 'IdHistoria', 'CorrectoA', 'ComenIncorrectoA', 'CorrectoP', 'ComentIncorrectoP', 'OK', 'origen');
				$EVALUACION = new EVALUACION_Model($_REQUEST['IdTrabajo'], $_REQUEST['LoginEvaluador'], $_REQUEST['AliasEvaluado'], $_REQUEST['IdHistoria'], '', '', '', '', ''); //crea una EVALUACION_Model con los campos clave del usuario y del trabajo
				$lista = $EVALUACION->rellenarLista();
				if(isset($_REQUEST['origen'])){
					$lista['origen'] = $_REQUEST['origen'];
				}else{
					$lista['origen'] ='../Controllers/EVALUACION_Controller.php';
				}
				
				$usuario = new EVALUACION_DELETE($lista); //Crea la vista de DELETE con los datos del usuario
			}
			else{//si viene con un post
				$EVALUACION = get_data_UserBD(); //coge los datos del formulario del usuario que desea borrar
				$respuesta = $EVALUACION->DELETE(); //Ejecuta la funcion DELETE() en el EVALUACION_Model
				$mensaje = new MESSAGE($respuesta, '../Controllers/EVALUACION_Controller.php'); //muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'EDIT': //si el usuario quiere editar	
			if (!$_POST){
				$EVALUACION = new EVALUACION_Model($_REQUEST['IdTrabajo'], $_REQUEST['LoginEvaluador'], $_REQUEST['AliasEvaluado'], $_REQUEST['IdHistoria'], '', '', '', '', ''); //crea una EVALUACION_Model con los campos clave del usuario y del trabajo
				$lista = $EVALUACION->rellenarLista();  //Recoge todos los atributos
				$usuario = new EVALUACION_EDIT($lista); //Crea la vista EDIT con los datos del usuario
			}
			else{
				$EVALUACION = get_data_UserBD(); //coge los datos del formulario del usuario que desea editar
				$respuesta = $EVALUACION->EDIT(); //Ejecuta la funcion EDIT() en el EVALUACION_Model
				$mensaje = new MESSAGE($respuesta, '../Controllers/EVALUACION_Controller.php');//muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'SEARCH': //si desea realizar una busqueda
			if (!$_POST){
				$EVALUACION = new EVALUACION_SEARCH();//Crea la vista SEARCH y muestra formulario para rellenar por el usuario
			}
			else{
				$EVALUACION = get_data_UserBD(); //coge los datos del formulario del usuario que desea buscar
				$datos = $EVALUACION->SEARCH();//Ejecuta la funcion SEARCH() en el EVALUACION_Model
				$lista = array('IdTrabajo', 'LoginEvaluador', 'AliasEvaluado', 'IdHistoria', 'CorrectoA', 'ComenIncorrectoA', 'CorrectoP', 'ComentIncorrectoP', 'OK');
				$resultado = new EVALUACION_SHOWALL($lista, $datos, 0, 0, 0, 0, 'SEARCH', '../Controllers/EVALUACION_Controller.php');//Crea la vista SHOWALL y muestra los usuarios que cumplen los parámetros de búsqueda 
			}
			break;
		case 'SHOWCURRENT': //si desea ver un usuario en detalle
			$lista = array('IdTrabajo', 'LoginEvaluador', 'AliasEvaluado', 'IdHistoria', 'CorrectoA', 'ComenIncorrectoA', 'CorrectoP', 'ComentIncorrectoP', 'OK', 'origen');
			$EVALUACION = new EVALUACION_Model($_REQUEST['IdTrabajo'], $_REQUEST['LoginEvaluador'], $_REQUEST['AliasEvaluado'], $_REQUEST['IdHistoria'], '', '', '', '', ''); //crea una EVALUACION_Model con los campos clave del usuario y del trabajo
			$lista = $EVALUACION->rellenarLista();

			$usuario = new EVALUACION_SHOWCURRENT($lista); //Crea la vista SHOWCURRENT del usuario requerido
			break;
		default: //Por defecto, Se muestra la vista SHOWALL
			
			if (!$_POST){
				$EVALUACION = new EVALUACION_Model('', '', '', '', '', '', '', '', '');//crea una EVALUACION_Model
			}
			else{
				$EVALUACION = get_data_form(); //Coge los datos del formulario
			}

			if(!isset($_REQUEST['num_pagina'])){ //Si es la 1a página del showall a mostrar
				$num_pagina = 0;
			}else{ //Si es otra página
				$num_pagina = $_REQUEST['num_pagina']; //coge el numero de página del formulario
			}
			$num_tupla = $num_pagina*10; //número de la 1º tupla a mostrar
			$max_tuplas = $num_tupla+10; // el número de tuplas a mostrar por página
			$totalTuplas = $EVALUACION->contarTuplas(); //Cuenta el número de tuplas que hay en la BD
			$datos = $EVALUACION->SHOWALL($num_tupla,$max_tuplas); //Ejecuta la funcion SHOWALL() en el EVALUACION_Model
			$lista = array('IdTrabajo', 'LoginEvaluador', 'AliasEvaluado', 'IdHistoria', 'CorrectoA', 'ComenIncorrectoA', 'CorrectoP', 'ComentIncorrectoP', 'OK');
			$UsuariosBD = new EVALUACION_SHOWALL($lista, $datos, $num_tupla, $max_tuplas, $totalTuplas, $num_pagina, 'SHOWALL', '../Controllers/EVALUACION_Controller.php',$acciones); //Crea la vista SHOWALL de los usuarios de la BD	
	}
	}

?>