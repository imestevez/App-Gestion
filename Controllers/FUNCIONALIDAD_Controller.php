
<?php
/*
//Script : FUNCIONALIDAD_Controller.php
//Creado el : 27-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Controlador que recibe las acciones relacionadas con funcionalidad

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
	new MESSAGE('No tienes permisos para realizar esta accion', '../index.php');exit();
	//header('Location:../index.php'); //vuelve al index
}
//almacenamos un array de permidos del grupo
$permisos = listaPermisos();
$acciones = listaAcciones(3);

//Pnemos la variabla acceso  a false con la que se controla si el usuario puede ver un showall o no
$acceso=false;
include_once '../Models/FUNCIONALIDAD_Model.php';

include_once '../Views/FUNCIONALIDAD/FUNCIONALIDAD_SHOWALL_View.php';
include_once '../Views/FUNCIONALIDAD/FUNCIONALIDAD_SHOWCURRENT_View.php';
include_once '../Views/FUNCIONALIDAD/FUNCIONALIDAD_ADD_View.php';
include_once '../Views/FUNCIONALIDAD/FUNCIONALIDAD_EDIT_View.php';
include_once '../Views/FUNCIONALIDAD/FUNCIONALIDAD_SEARCH_View.php';
include_once '../Views/FUNCIONALIDAD/FUNCIONALIDAD_DELETE_View.php';
include_once '../Views/MESSAGE_View.php';



// funcion para coger los datos del formulario
function get_data_form(){

	$IdFuncionalidad = $_REQUEST['IdFuncionalidad'];
	$NombreFuncionalidad = $_REQUEST['NombreFuncionalidad'];
	$DescripFuncionalidad = $_REQUEST['DescripFuncionalidad'];
	
	$action = $_REQUEST['action'];

	$FUNCIONALIDAD = new FUNCIONALIDAD_Model(
		$IdFuncionalidad, 
		$NombreFuncionalidad, 
		$DescripFuncionalidad);

	return $FUNCIONALIDAD;
}

//Funcion para coger los datos del formulario de un usuario ya almacenado
function get_data_UserBD(){

	$IdFuncionalidad = $_REQUEST['IdFuncionalidad'];
	$NombreFuncionalidad = $_REQUEST['NombreFuncionalidad'];
	$DescripFuncionalidad = $_REQUEST['DescripFuncionalidad'];
	
	$action = $_REQUEST['action'];

	$FUNCIONALIDAD = new FUNCIONALIDAD_Model(
		$IdFuncionalidad, 
		$NombreFuncionalidad, 
		$DescripFuncionalidad);

	return $FUNCIONALIDAD;
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

				$form = new FUNCIONALIDAD_ADD(); //Crea la vista ADD y muestra formulario para rellenar por el usuario
			}
			else{ //si viene del add 

				$FUNCIONALIDAD = get_data_form(); //recibe datos
				$lista = $FUNCIONALIDAD->ADD(); //mete datos en respuesta usuarios despues de ejecutar el add con los de funcionalidad
				$usuario = new MESSAGE($lista, '../Controllers/FUNCIONALIDAD_Controller.php'); //muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'DELETE': //Si quiere hacer un DELETE
			if (!$_POST){ //viene del showall con una clave
				$FUNCIONALIDAD = new FUNCIONALIDAD_Model($_REQUEST['IdFuncionalidad'], '',''); //crea un un FUNCIONALIDAD_Model con el IdFuncionalidad del usuario
				$valores = $FUNCIONALIDAD->RellenaDatos(); //completa el resto de atributos a partir de la clave
				$usuario = new FUNCIONALIDAD_DELETE($valores); //Crea la vista de DELETE con los datos del usuario
			}
			else{//si viene con un post
				$FUNCIONALIDAD = get_data_form(); //coge los datos del formulario del usuario que desea borrar
				$respuesta = $FUNCIONALIDAD->DELETE(); //Ejecuta la funcion DELETE() en el FUNCIONALIDAD_Model
				$mensaje = new MESSAGE($respuesta, '../Controllers/FUNCIONALIDAD_Controller.php'); //muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'EDIT': //si el usuario quiere editar	
			if (!$_POST){
				$FUNCIONALIDAD = new FUNCIONALIDAD_Model($_REQUEST['IdFuncionalidad'], '',''); //crea un un FUNCIONALIDAD_Model con el IdFuncionalidad del usuario 
				$datos = $FUNCIONALIDAD->RellenaDatos();  //A partir del IdFuncionalidad recoge todos los atributos
				$usuario = new FUNCIONALIDAD_EDIT($datos); //Crea la vista EDIT con los datos del usuario
			}
			else{
				$FUNCIONALIDAD = get_data_form(); //coge los datos del formulario del usuario que desea editar
				$respuesta = $FUNCIONALIDAD->EDIT(); //Ejecuta la funcion EDIT() en el FUNCIONALIDAD_Model
				$mensaje = new MESSAGE($respuesta, '../Controllers/FUNCIONALIDAD_Controller.php');//muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'SEARCH': //si desea realizar una busqueda
			if (!$_POST){
				$FUNCIONALIDAD = new FUNCIONALIDAD_SEARCH();//Crea la vista SEARCH y muestra formulario para rellenar por el usuario
			}
			else{
				$FUNCIONALIDAD = get_data_form(); //coge los datos del formulario del usuario que desea buscar
				$datos = $FUNCIONALIDAD->SEARCH();//Ejecuta la funcion SEARCH() en el FUNCIONALIDAD_Model
				$lista = array('IdFuncionalidad','NombreFuncionalidad','DescripFuncionalidad');
				$resultado = new FUNCIONALIDAD_SHOWALL($lista, $datos, 0, 0, 0, 0, 'SEARCH', '../Controllers/FUNCIONALIDAD_Controller.php',$acciones);//Crea la vista SHOWALL y muestra los usuarios que cumplen los parámetros de búsqueda 
			}
			break;
		case 'SHOW': //si desea ver un usuario en detalle
			$FUNCIONALIDAD = new FUNCIONALIDAD_Model($_REQUEST['IdFuncionalidad'], '','');//crea un un FUNCIONALIDAD_Model con el IdFuncionalidad del usuario 
			$tupla = $FUNCIONALIDAD->RellenaDatos();//A partir del IdFuncionalidad recoge todos los atributos
			$usuario = new FUNCIONALIDAD_SHOWCURRENT($tupla); //Crea la vista SHOWCURRENT del usuario requerido
			break;
		default: //Por defecto, Se muestra la vista SHOWALL
		//recorremos el array de permisos
			foreach ($acciones as $key => $value) {
				if($value == 'ALL'){ //si puede ver el showall
					$acceso = true; //acceso a true
				}
			}
			if($acceso == true){ //si tiene acceso, mostramos el showall
				if (!$_POST){
					$FUNCIONALIDAD = new FUNCIONALIDAD_Model('', '','');//crea un un FUNCIONALIDAD_Model con el IdFuncionalidad del usuario 
				}
				else{
					$FUNCIONALIDAD = get_data_form(); //Coge los datos del formulario
				}

				if(!isset($_REQUEST['num_pagina'])){ //Si es la 1a página del showall a mostrar
					$num_pagina = 0;
				}else{ //Si es otra página
					$num_pagina = $_REQUEST['num_pagina']; //coge el numero de página del formulario
				}
				$num_tupla = $num_pagina*10; //número de la 1º tupla a mostrar
				$max_tuplas = $num_tupla+10; // el número de tuplas a mostrar por página
				$totalTuplas = $FUNCIONALIDAD->contarTuplas(); //Cuenta el número de tuplas que hay en la BD
				$datos = $FUNCIONALIDAD->SHOWALL($num_tupla,$max_tuplas); //Ejecuta la funcion SHOWALL() en el FUNCIONALIDAD_Model
				$lista = array('IdFuncionalidad','NombreFuncionalidad','DescripFuncionalidad');
				$UsuariosBD = new FUNCIONALIDAD_SHOWALL($lista, $datos, $num_tupla, $max_tuplas, $totalTuplas, $num_pagina, 'SHOWALL', '../Controllers/FUNCIONALIDAD_Controller.php',$acciones); //Crea la vista SHOWALL de los usuarios de la BD	
			}else{
				if (!$_POST){
					$FUNCIONALIDAD = new FUNCIONALIDAD_Model('', '','');//crea un un FUNCIONALIDAD_Model con el IdFuncionalidad del usuario 
				}
				else{
					$FUNCIONALIDAD = get_data_form(); //Coge los datos del formulario
				}

				if(!isset($_REQUEST['num_pagina'])){ //Si es la 1a página del showall a mostrar
					$num_pagina = 0;
				}else{ //Si es otra página
					$num_pagina = $_REQUEST['num_pagina']; //coge el numero de página del formulario
				}
				$num_tupla = $num_pagina*10; //número de la 1º tupla a mostrar
				$max_tuplas = $num_tupla+10; // el número de tuplas a mostrar por página
				$totalTuplas = $FUNCIONALIDAD->contarTuplas(); //Cuenta el número de tuplas que hay en la BD
				$datos = $FUNCIONALIDAD->SHOWALL_User($num_tupla,$max_tuplas); //Ejecuta la funcion SHOWALL() en el FUNCIONALIDAD_Model
				$lista = array('IdFuncionalidad','NombreFuncionalidad','DescripFuncionalidad');
				$UsuariosBD = new FUNCIONALIDAD_SHOWALL($lista, $datos, $num_tupla, $max_tuplas, $totalTuplas, $num_pagina, 'ALL', '../Controllers/FUNCIONALIDAD_Controller.php',$acciones); //Crea la vista SHOWALL de los usuarios de la BD	
			}
		}
	}

?>