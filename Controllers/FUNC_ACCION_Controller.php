
<?php

/*
//Script : FUNC_ACCION_Controller.php
//Creado el : 9-12-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Controlador que recibe las peticiones del usuario y este ejectuta las acciones pertinentes sobre el Model de datos y las vistas
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
if(!HavePermissions(3, $action)) {
	//new MESSAGE('No tienes permisos para realizar esta accion', '../index.php');
	header('Location:../index.php'); //vuelve al index
}
//almacenamos un array de permidos del grupo
$permisos = listaPermisos();
$acciones = listaAcciones(3);

//Pnemos la variabla acceso  a false con la que se controla si el usuario puede ver un showall o no
$acceso=false;

include_once '../Models/FUNC_ACCION_Model.php';
include_once '../Models/FUNCIONALIDAD_Model.php';

include_once '../Views/FUNCIONALIDAD/FUNCIONALIDAD_SHOWALL_View.php';
include_once '../Views/FUNC_ACCION/FUNC_ACCION_SHOWALL_View.php';
include_once '../Views/FUNC_ACCION/FUNC_ACCION_EDIT_View.php';

include_once '../Views/MESSAGE_View.php';



// funcion para coger los datos del formulario
function get_data_form(){

	$IdFuncionalidad = null;
	$checkbox = null;
	$lista = null;
	$action = null;

	if(isset($_REQUEST['IdFuncionalidad'])){
		$IdFuncionalidad = $_REQUEST['IdFuncionalidad'];
	}
	//Si existen los checkbox
	if(isset($_REQUEST['checkbox'])){
		$checkbox = $_REQUEST['checkbox'];
		$num = count($checkbox);

		for ($i=0; $i<$num;$i++){
			$lista[$i] = $checkbox[$i]; //inserto en la lista cada uno de los IDS de los checkboxs seleccionados por el usuario
		}
	}
	

	$FUNC_ACCION = new FUNC_ACCION_Model(
		$IdFuncionalidad, 
		$lista);

	return $FUNC_ACCION;
}

//Si el usuario no elige ninguna opción
if (!isset($_REQUEST['action'])){
	$action = ''; //la acctión se pone vacía
}else{
	$action = $_REQUEST['action']; //si no, se le asigna la accion elegida

}
	// En funcion de la accion elegida
	Switch ($action){
	
		case 'ASIG':
		if (!$_POST){
			$FUNCIONALIDAD = new FUNCIONALIDAD_Model($_REQUEST['IdFuncionalidad'], '','');//crea un un FUNCIONALIDAD_Model con el IdFUNCIONALIDAD de la funcionalidad
			$propios = $FUNCIONALIDAD->rellenarAcciones();
			$todos = $FUNCIONALIDAD->todosAcciones();
			$lista = $FUNCIONALIDAD->rellenarLista();
			$resultado = new FUNC_ACCION_EDIT($lista,$propios,$todos);
		}else{

			$FUNC_ACCION = get_data_form();
			$respuesta = $FUNC_ACCION->EDIT();
			$mensaje = new MESSAGE($respuesta, '../Controllers/FUNCIONALIDAD_Controller.php'); //muestra el mensaje despues de la sentencia sql


		}
		break;
		default: //Por defecto, Se muestra la vista SHOWALL
			$FUNCIONALIDAD = new FUNCIONALIDAD_Model($_REQUEST['IdFuncionalidad'], '','');//crea un un FUNCIONALIDAD_Model con el IdFUNCIONALIDAD de la funcionalidad
			//$num_rows = $FUNCIONALIDAD->contarNumAccionesFunc();
			$recordset = $FUNCIONALIDAD->rellenarAcciones();
				$lista = $FUNCIONALIDAD->rellenarLista();

			$resultado = new FUNC_ACCION_SHOWALL($lista,$recordset,$acciones);
	}
	}

?>