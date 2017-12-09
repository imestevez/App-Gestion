
<?php

/*
//Script : PERMISO_Controller.php
//Creado el : 27-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Controlador que recibe las peticiones del usuario y este ejectuta las acciones pertinentes sobre el Model de datos y las vistas
*/
session_start(); //solicito trabajar con la session

include_once '../Functions/Authentication.php';

if (!IsAuthenticated()){
	header('Location:../index.php');
}

include '../Models/ACCION_Model.php';
include '../Models/PERMISO_Model.php';

include '../Views/PERMISO/PERMISO_SHOWALL_View.php';
include '../Views/PERMISO/PERMISO_SEARCH_View.php';
include '../Views/MESSAGE_View.php';



// funcion para coger los datos del formulario
function get_data_form(){


	$NombreGrupo = '';
	$NombreFuncionalidad = '';
	$NombreAccion = '';
	$action = '';

	if(isset($_REQUEST['NombreGrupo'])){
	$NombreGrupo = $_REQUEST['NombreGrupo'];
	}
	if(isset($_REQUEST['NombreFuncionalidad'])){
	$NombreFuncionalidad = $_REQUEST['NombreFuncionalidad'];
	}
	if(isset($_REQUEST['NombreAccion'])){
	$NombreAccion = $_REQUEST['NombreAccion'];
	}
	if(isset($_REQUEST['action'])){
	$action = $_REQUEST['action'];
	}

	$PERMISOS = new PERMISO_Model(
		$NombreGrupo, 
		$NombreFuncionalidad, 
		$NombreAccion);

	return $PERMISOS;
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
		case 'SEARCH': //si desea realizar una busqueda
			if (!$_POST){
				$PERMISOS = new PERMISO_SEARCH();//Crea la vista SEARCH y muestra formulario para rellenar por el usuario
			}
			else{
				$PERMISOS = get_data_form(); //coge los datos del formulario del usuario que desea buscar
				$datos = $PERMISOS->SEARCH();//Ejecuta la funcion SEARCH() en el USUARIOS_Model
				$lista = array('NombreGrupo','NombreFuncionalidad','NombreAccion');
				$resultado = new PERMISO_SHOWALL($lista, $datos, 0, 0, 0, 0, 'SEARCH', '../Controllers/ACCION_Controller.php');//Crea la vista SHOWALL y muestra los usuarios que cumplen los parámetros de búsqueda 
			}
			break;
		default: //Por defecto, Se muestra la vista SHOWALL
			if (!$_POST){
				$PERMISOS = new PERMISO_Model('','','');//crea un un USUARIOS_Model con el login del usuario 
			}
			else{
				$PERMISOS = get_data_form(); //Coge los datos del formulario
			}

			if(!isset($_REQUEST['num_pagina'])){ //Si es la 1a página del showall a mostrar
				$num_pagina = 0;
			}else{ //Si es otra página
				$num_pagina = $_REQUEST['num_pagina']; //coge el numero de página del formulario
			}
			$num_tupla = $num_pagina*10; //número de la 1º tupla a mostrar
			$max_tuplas = $num_tupla+10; // el número de tuplas a mostrar por página
			$totalTuplas = $PERMISOS->contarTuplas(); //Cuenta el número de tuplas que hay en la BD
			$datos = $PERMISOS->SHOWALL($num_tupla,$max_tuplas); //Ejecuta la funcion SHOWALL() en el USUARIOS_Model
			$lista = array('NombreGrupo','NombreFuncionalidad','NombreAccion');
			$AccionesBD = new PERMISO_SHOWALL($lista, $datos, $num_tupla, $max_tuplas, $totalTuplas, $num_pagina, 'SHOWALL', '../Controllers/PERMISO_Controller.php'); //Crea la vista SHOWALL de los usuarios de la BD	
	}

?>