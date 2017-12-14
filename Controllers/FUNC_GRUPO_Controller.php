
<?php

/*
//Script : FUNC_GRUPO_Controller.php
//Creado el : 9-12-2017
//Creado por: solfamidas
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
if(!HavePermissions(2, $action)) {
	//new MESSAGE('No tienes permisos para realizar esta accion', '../index.php');
	header('Location:../index.php'); //vuelve al index
}
//almacenamos un array de permidos del grupo
$permisos = listaPermisos();
$acciones = listaAcciones(2);

//Pnemos la variabla acceso  a false con la que se controla si el usuario puede ver un showall o no
$acceso=false;
include_once '../Models/FUNC_GRUPO_Model.php';


include_once '../Views/GRUPO/GRUPO_SHOWALL_View.php';
include_once '../Views/FUNC_GRUPO/FUNC_GRUPO_SHOWALL_View.php';
include_once '../Views/FUNC_GRUPO/FUNC_GRUPO_EDIT_View.php';


include_once '../Views/MESSAGE_View.php';



// funcion para coger los datos del formulario
function get_data_form(){

	$IdGrupo = null;
	$checkbox = null;
	$listaF = null;
	$listaA = null;
	$action = null;

	if(isset($_REQUEST['IdGrupo'])){
		$IdGrupo = $_REQUEST['IdGrupo'];
	}
	//Si existen los checkbox
	if(isset($_REQUEST['checkbox'])){
		$checkbox = $_REQUEST['checkbox'];
		$num = count($checkbox);
		for ($i=0; $i<$num;$i++){


			//echo $checkbox[$i];

			$check =explode("+" ,  $checkbox[$i]);
			$listaF[$i] = $check[0]; //inserto en la lista cada uno de los IDS Funcionalidad de los checkboxs seleccionados por el usuario
			$listaA[$i] = $check[1]; //inserto en la lista cada uno de los IDS Accion de los checkboxs seleccionados por el usuario
		}
	}
	

	$FUNC_GRUPO = new FUNC_GRUPO_Model(
		$IdGrupo, 
		$listaF,
		$listaA);
	return $FUNC_GRUPO;
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
			$GRUPO = new FUNC_GRUPO_Model($_REQUEST['IdGrupo'], '','');//crea un un FUNCIONALIDAD_Model con el IdFUNCIONALIDAD de la funcionalidad
			$propios = $GRUPO->rellenarPermisos();
			$todos = $GRUPO->todosPermisos();
			$lista = $GRUPO->rellenarLista();
			$resultado = new FUNC_GRUPO_EDIT($lista,$propios,$todos);
		}else{

			 $FUNC_GRUPO = get_data_form();
			$respuesta =  $FUNC_GRUPO->EDIT();
			$mensaje = new MESSAGE($respuesta, '../Controllers/GRUPO_Controller.php'); //muestra el mensaje despues de la sentencia sql
		}
		break;
		default: //Por defecto, Se muestra la vista SHOWALL
			$GRUPO = new FUNC_GRUPO_Model($_REQUEST['IdGrupo'], '','');//crea un un FUNCIONALIDAD_Model con el IdFUNCIONALIDAD de la funcionalidad
			//$num_rows = $GRUPO->contarNumAccionesFunc();
			$recordset = $GRUPO->rellenarPermisos();
				$lista = $GRUPO->rellenarLista();

			$resultado = new FUNC_GRUPO_SHOWCURRENT($lista,$recordset,$acciones);
	}
	}

?>