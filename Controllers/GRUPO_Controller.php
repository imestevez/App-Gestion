
<?php

/*
//Script : GRUPO_Controller.php
//Creado el : 24-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Controlador que recibe las peticiones del usuario y este ejecuta las acciones pertinentes sobre el Model de datos y las vistas
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
	new MESSAGE('No tienes permisos para realizar esta accion', '../index.php');exit();
	//header('Location:../index.php'); //vuelve al index
	
}
//almacenamos un array de permidos del grupo
$permisos = listaPermisos();
$acciones = listaAcciones(2);

//Pnemos la variabla acceso  a false con la que se controla si el usuario puede ver un showall o no
$acceso=false;

include_once '../Models/GRUPO_Model.php';

include_once '../Views/GRUPO/GRUPO_SHOWALL_View.php';
include_once '../Views/GRUPO/GRUPO_SHOWCURRENT_View.php';
include_once '../Views/GRUPO/GRUPO_ADD_View.php';
include_once '../Views/GRUPO/GRUPO_EDIT_View.php';
include_once '../Views/GRUPO/GRUPO_SEARCH_View.php';
include_once '../Views/GRUPO/GRUPO_DELETE_View.php';
include_once '../Views/MESSAGE_View.php';



// funcion para coger los datos del formulario
function get_data_form(){

	$IdGrupo = $_REQUEST['IdGrupo'];
	$NombreGrupo = $_REQUEST['NombreGrupo'];
	$DescripGrupo = $_REQUEST['DescripGrupo'];
	$action = $_REQUEST['action'];

	$GRUPO = new GRUPO_Model(
		$IdGrupo, 
		$NombreGrupo, 
		$DescripGrupo);

	return $GRUPO;
}

//Funcion para coger los datos del formulario de un grupo ya almacenado
function get_data_GroupBD(){

	$IdGrupo = $_REQUEST['IdGrupo'];
	$NombreGrupo = $_REQUEST['NombreGrupo'];
	$DescripGrupo = $_REQUEST['DescripGrupo'];
	$action = $_REQUEST['action'];

	$GRUPO = new GRUPO_Model(
		$IdGrupo, 
		$NombreGrupo, 
		$DescripGrupo);

	return $GRUPO;
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

				$form = new GRUPO_ADD(); //Crea la vista ADD y muestra formulario para rellenar por el usuario
			}
			else{ //si viene del add 

				$GRUPO = get_data_form(); //recibe datos
				$lista = $GRUPO->ADD(); //mete datos en lista despues de ejecutar el add con los datos de GRUPO
				$grupo = new MESSAGE($lista, '../Controllers/GRUPO_Controller.php'); //muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'DELETE': //Si quiere hacer un DELETE
			if (!$_POST){ //viene del showall con una clave
				$GRUPO = new GRUPO_Model($_REQUEST['IdGrupo'], '',''); //crea un GRUPO_Model con el IdGrupo del grupo
				$valores = $GRUPO->RellenaDatos(); //completa el resto de atributos a partir de la clave
				$grupo = new GRUPO_DELETE($valores); //Crea la vista de DELETE con los datos del grupo
			}
			else{//si viene con un post
				$GRUPO = get_data_GroupBD(); //coge los datos del formulario del grupo que desea borrar
				$respuesta = $GRUPO->DELETE(); //Ejecuta la funcion DELETE() en el GRUPO_Model
				$mensaje = new MESSAGE($respuesta, '../Controllers/GRUPO_Controller.php'); //muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'EDIT': //si el usuario quiere editar un grupo
			if (!$_POST){
				$GRUPO = new GRUPO_Model($_REQUEST['IdGrupo'], '',''); //crea un GRUPO_Model con el IdGrupo del grupo 
				$datos = $GRUPO->RellenaDatos();  //A partir del IdGrupo recoge todos los atributos
				$grupo = new GRUPO_EDIT($datos); //Crea la vista EDIT con los datos del grupo
			}
			else{
				$GRUPO = get_data_GroupBD(); //coge los datos del formulario del grupo que desea editar
				$respuesta = $GRUPO->EDIT(); //Ejecuta la funcion EDIT() en el GRUPO_Model
				$mensaje = new MESSAGE($respuesta, '../Controllers/GRUPO_Controller.php');//muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'SEARCH': //si desea realizar una busqueda
			if (!$_POST){
				$GRUPO = new GRUPO_SEARCH();//Crea la vista SEARCH y muestra formulario para rellenar por el usuario
			}
			else{
				$GRUPO = get_data_GroupBD(); //coge los datos del formulario del grupo que desea buscar
				$datos = $GRUPO->SEARCH();//Ejecuta la funcion SEARCH() en el GRUPO_Model
				$lista = array('IdGrupo','NombreGrupo','DescripGrupo');
				$resultado = new GRUPO_SHOWALL($lista, $datos, 0, 0, 0, 0, 'SEARCH', '../Controllers/GRUPO_Controller.php',$acciones);//Crea la vista SHOWALL y muestra los grupos que cumplen los parámetros de búsqueda 
			}
			break;
		case 'SHOW': //si desea ver un grupo en detalle
			$GRUPO = new GRUPO_Model($_REQUEST['IdGrupo'], '','');//crea un GRUPO_Model con el IdGrupo del grupo 
			$tupla = $GRUPO->RellenaDatos();//A partir del IdGrupo recoge todos los atributos
			$grupo = new GRUPO_SHOWCURRENT($tupla); //Crea la vista SHOWCURRENT del grupo en cuestión
			break;
		default: //Por defecto, Se muestra la vista SHOWALL

			foreach ($acciones as $key => $value) {
				if($value == 'ALL'){ //si puede ver el showall
					$acceso = true; //acceso a true
				}
			}
			if($acceso == true){ //si tiene acceso, mostramos el showall
				if (!$_POST){
					$GRUPO = new GRUPO_Model('', '','');//crea un GRUPO_Model con el IdGrupo del grupo 
				}
				else{
					$GRUPO = get_data_form(); //Coge los datos del formulario
				}

				if(!isset($_REQUEST['num_pagina'])){ //Si es la 1a página del showall a mostrar
					$num_pagina = 0;
				}else{ //Si es otra página
					$num_pagina = $_REQUEST['num_pagina']; //coge el numero de página del formulario
				}
				$num_tupla = $num_pagina*10; //número de la 1º tupla a mostrar
				$max_tuplas = $num_tupla+10; // el número de tuplas a mostrar por página
				$totalTuplas = $GRUPO->contarTuplas(); //Cuenta el número de tuplas que hay en la BD
				$datos = $GRUPO->SHOWALL($num_tupla,$max_tuplas); //Ejecuta la funcion SHOWALL() en el GRUPO_Model
				$lista = array('IdGrupo', 'NombreGrupo', 'DescripGrupo');
				$GruposBD = new GRUPO_SHOWALL($lista, $datos, $num_tupla, $max_tuplas, $totalTuplas, $num_pagina, 'SHOWALL', '../Controllers/GRUPO_Controller.php',$acciones); //Crea la vista SHOWALL de los grupos de la BD
			}else{
				if (!$_POST){
					$GRUPO = new GRUPO_Model('', '','');//crea un GRUPO_Model con el IdGrupo del grupo 
				}
				else{
					$GRUPO = get_data_form(); //Coge los datos del formulario
				}

				if(!isset($_REQUEST['num_pagina'])){ //Si es la 1a página del showall a mostrar
					$num_pagina = 0;
				}else{ //Si es otra página
					$num_pagina = $_REQUEST['num_pagina']; //coge el numero de página del formulario
				}
				$num_tupla = $num_pagina*10; //número de la 1º tupla a mostrar
				$max_tuplas = $num_tupla+10; // el número de tuplas a mostrar por página
				$totalTuplas = $GRUPO->contarTuplas(); //Cuenta el número de tuplas que hay en la BD
				$datos = $GRUPO->SHOWALL_User($num_tupla,$max_tuplas); //Ejecuta la funcion SHOWALL() en el GRUPO_Model
				$lista = array('IdGrupo', 'NombreGrupo', 'DescripGrupo');
				$GruposBD = new GRUPO_SHOWALL($lista, $datos, $num_tupla, $max_tuplas, $totalTuplas, $num_pagina, 'ALL', '../Controllers/GRUPO_Controller.php',$acciones); //Crea la vista SHOWALL de los grupos de la BD
			}	
		}
	}

?>