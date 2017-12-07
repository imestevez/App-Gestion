
<?php

/*
//Script : USUARIO_Controller.php
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
include '../Models/USU_GRUPO_Model.php';
include '../Models/USUARIO_Model.php';

include '../Views/USUARIO/USUARIO_SHOWALL_View.php';
include '../Views/USU_GRUPO/USU_GRUPO_SHOWCURRENT_View.php';
include '../Views/USU_GRUPO/USU_GRUPO_EDIT_View.php';

include '../Views/MESSAGE_View.php';



// funcion para coger los datos del formulario
function get_data_form(){

	$login = null;
	$checkbox = null;
	$lista = null;
	$action = null;

	if(isset($_REQUEST['login'])){
		$login = $_REQUEST['login'];
	}
	//Si existen los checkbox
	if(isset($_REQUEST['checkbox'])){
		$checkbox = $_REQUEST['checkbox'];
		$num = count($checkbox);

		for ($i=0; $i<$num;$i++){
			$lista[$i] = $checkbox[$i]; //inserto en la lista cada uno de los IDS de los checkboxs seleccionados por el usuario
		}
	}
	

	$USU_GRUPO = new USU_GRUPO_Model(
		$login, 
		$lista);

	return $USU_GRUPO;
}

//Si el usuario no elige ninguna opción
if (!isset($_REQUEST['action'])){
	$action = ''; //la acctión se pone vacía
}else{
	$action = $_REQUEST['action']; //si no, se le asigna la accion elegida

}
	// En funcion de la accion elegida
	Switch ($action){
	
		case 'EDIT':
		if (!$_POST){
			$USUARIO = new USUARIO_Model($_REQUEST['login'], '','', '', '', '', '', '');//crea un un USUARIO_Model con el login del usuario 
			$propios = $USUARIO->rellenarGrupos();
			$todos = $USUARIO->todosGrupos();
			$lista = $USUARIO->rellenarLista();
			$resultado = new USU_GRUPO_EDIT($lista,$propios,$todos);
		}else{

			$USU_GRUPO = get_data_form();
			$respuesta = $USU_GRUPO->EDIT();
			$mensaje = new MESSAGE($respuesta, '../Controllers/USUARIO_Controller.php'); //muestra el mensaje despues de la sentencia sql


		}
		break;
		default: //Por defecto, Se muestra la vista SHOWALL
			$USUARIO = new USUARIO_Model($_REQUEST['login'], '','', '', '', '', '', '');//crea un un USUARIO_Model con el login del usuario 
			//$num_rows = $USUARIO->contarNumGruposUser();
			$recordset = $USUARIO->rellenarGrupos();
				$lista = $USUARIO->rellenarLista();

			$resultado = new USU_GRUPO_SHOWALL($lista,$recordset);
	}

?>