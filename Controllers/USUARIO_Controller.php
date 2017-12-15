
<?php

/*
//Script : USUARIO_Controller.php
//Creado el : 13-10-2017
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
if(!HavePermissions(1, $action)) {
	//new MESSAGE('No tienes permisos para realizar esta accion', '../index.php');
	header('Location:../index.php'); //vuelve al index
}
//almacenamos un array de permidos del grupo
$permisos = listaPermisos();
$acciones = listaAcciones(1);
//Pnemos la variabla acceso  a false con la que se controla si el usuario puede ver un showall o no
$acceso=false;

include_once '../Models/USUARIO_Model.php';

include_once '../Views/Registro_View.php';
include_once '../Views/USUARIO/USUARIO_SHOWALL_View.php';

include_once '../Views/USUARIO/USUARIO_SHOWCURRENT_View.php';
include_once '../Views/USUARIO/USUARIO_ADD_View.php';
include_once '../Views/USUARIO/USUARIO_EDIT_View.php';
include_once '../Views/USUARIO/USUARIO_SEARCH_View.php';
include_once '../Views/USUARIO/USUARIO_DELETE_View.php';



// funcion para coger los datos del formulario
function get_data_form(){

	$login = null;
	$password = null;
	$DNI = null;
	$nombre = null;
	$apellidos = null;
	$telefono = null;
	$email = null;
	$direccion = null;
	$action = null;

	if(isset($_REQUEST['login'])){
		$login = $_REQUEST['login'];
	}
	if(isset($_REQUEST['password'])){
		$password = $_REQUEST['password'];
	}
	if(isset($_REQUEST['DNI'])){
		$DNI = $_REQUEST['DNI'];
	}
	if(isset($_REQUEST['nombre'])){
		$nombre = $_REQUEST['nombre'];
	}
	if(isset($_REQUEST['apellidos'])){
		$apellidos = $_REQUEST['apellidos'];
	}
	if(isset($_REQUEST['telefono'])){
		$telefono = $_REQUEST['telefono'];
	}
	if(isset($_REQUEST['email'])){
		$email = $_REQUEST['email'];
	}
	if(isset($_REQUEST['direccion'])){
		$direccion = $_REQUEST['direccion'];
	}
	if(isset($_REQUEST['action'])){
		$action = $_REQUEST['action'];
	}

	$USUARIO = new USUARIO_Model(
		$login, 
		$password, 
		$DNI, 
		$nombre, 
		$apellidos,
		$telefono, 
		$email, 
		$direccion);

	return $USUARIO;
}


//Funcion para coger los datos del formulario de un usuario ya almacenado
function get_data_UserBD(){

	$login = $_REQUEST['login'];

	if( $_REQUEST['newpassword'] <> ''){
		$password = $_REQUEST['newpassword'];
	}else{
		$password = $_REQUEST['password'];
	}
	$DNI = $_REQUEST['DNI'];
	$nombre = $_REQUEST['nombre'];
	$apellidos = $_REQUEST['apellidos'];
	$telefono = $_REQUEST['telefono'];
	$email = $_REQUEST['email'];
	$direccion = $_REQUEST['direccion'];
	$action = $_REQUEST['action'];

	$USUARIO = new USUARIO_Model(
		$login, 
		$password, 
		$DNI, 
		$nombre, 
		$apellidos,
		$telefono, 
		$email, 
		$direccion);

	return $USUARIO;
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

				$form = new USUARIO_ADD(); //Crea la vista ADD y muestra formulario para rellenar por el usuario
			}
			else{ //si viene del add 

				$USUARIO = get_data_form(); //recibe datos
				$lista = $USUARIO->ADD(); //mete datos en respuesta usuarios despues de ejecutar el add con los de USUARIO
				$usuario = new MESSAGE($lista, '../Controllers/USUARIO_Controller.php'); //muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'DELETE': //Si quiere hacer un DELETE
			if (!$_POST){ //viene del showall con una clave
				$USUARIO = new USUARIO_Model($_REQUEST['login'], '','', '', '', '', '', ''); //crea un un USUARIO_Model con el login del usuario
				$valores = $USUARIO->RellenaDatos(); //completa el resto de atributos a partir de la clave
				$usuario = new USUARIO_DELETE($valores); //Crea la vista de DELETE con los datos del usuario
			}
			else{//si viene con un post
				$USUARIO = get_data_form(); //coge los datos del formulario del usuario que desea borrar
													//utilizamos esta funcion para que no salga el notice de password
				$respuesta = $USUARIO->DELETE(); //Ejecuta la funcion DELETE() en el USUARIO_Model
				$mensaje = new MESSAGE($respuesta, '../Controllers/USUARIO_Controller.php'); //muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'EDIT': //si el usuario quiere editar	
			if (!$_POST){
				$USUARIO = new USUARIO_Model($_REQUEST['login'], '','', '', '', '', '', ''); //crea un un USUARIO_Model con el login del usuario 
				$datos = $USUARIO->RellenaDatos();  //A partir del login recoge todos los atributos
				$usuario = new USUARIO_EDIT($datos); //Crea la vista EDIT con los datos del usuario
			}
			else{
				$USUARIO = get_data_UserBD(); //coge los datos del formulario del usuario que desea editar
				$respuesta = $USUARIO->EDIT(); //Ejecuta la funcion EDIT() en el USUARIO_Model
				$mensaje = new MESSAGE($respuesta, '../Controllers/USUARIO_Controller.php');//muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'SEARCH': //si desea realizar una busqueda
			if (!$_POST){
				$USUARIO = new USUARIO_SEARCH();//Crea la vista SEARCH y muestra formulario para rellenar por el usuario
			}
			else{
				$USUARIO = get_data_form(); //coge los datos del formulario del usuario que desea buscar
				$datos = $USUARIO->SEARCH();//Ejecuta la funcion SEARCH() en el USUARIO_Model
				$lista = array('login','password','DNI','nombre','apellidos','telefono','email','direccion');
				$resultado = new USUARIO_SHOWALL($lista, $datos, 0, 0, 0, 0, 'SEARCH', '../Controllers/USUARIO_Controller.php',$acciones);//Crea la vista SHOWALL y muestra los usuarios que cumplen los parámetros de búsqueda 
			}
			break;
		case 'SHOW': //si desea ver un usuario en detalle
			$USUARIO = new USUARIO_Model($_REQUEST['login'], '','', '', '', '', '', '');//crea un un USUARIO_Model con el login del usuario 
			$tupla = $USUARIO->RellenaDatos();//A partir del login recoge todos los atributos
			$usuario = new USUARIO_SHOWCURRENT($tupla); //Crea la vista SHOWCURRENT del usuario requerido
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
					$USUARIO = new USUARIO_Model('', '','','', '', '', '', '');//crea un un USUARIO_Model con el login del usuario 
				}
				else{
					$USUARIO = get_data_form(); //Coge los datos del formulario
				}

				if(!isset($_REQUEST['num_pagina'])){ //Si es la 1a página del showall a mostrar
					$num_pagina = 0;
				}else{ //Si es otra página
					$num_pagina = $_REQUEST['num_pagina']; //coge el numero de página del formulario
				}
				$num_tupla = $num_pagina*10; //número de la 1º tupla a mostrar
				$max_tuplas = $num_tupla+10; // el número de tuplas a mostrar por página
				$totalTuplas = $USUARIO->contarTuplas(); //Cuenta el número de tuplas que hay en la BD
				$datos = $USUARIO->SHOWALL($num_tupla,$max_tuplas); //Ejecuta la funcion SHOWALL() en el USUARIO_Model
				$lista = array('login', 'password', 'DNI','Nombre','Apellidos','Telefono','Email','Direccion');
				$UsuariosBD = new USUARIO_SHOWALL($lista, $datos, $num_tupla, $max_tuplas, $totalTuplas, $num_pagina, 'SHOWALL', '../Controllers/USUARIO_Controller.php',$acciones); //Crea la vista SHOWALL de los usuarios de la BD	
			}else{//si no tiene acceso solo mostramos los datos del usuario que entra en el sistema
			
				if (!$_POST){
					$USUARIO = new USUARIO_Model($_SESSION['login'], '','','', '', '', '', '');//crea un un USUARIO_Model con el login del usuario 
				}
				else{
					$USUARIO = get_data_form(); //Coge los datos del formulario
				}

				if(!isset($_REQUEST['num_pagina'])){ //Si es la 1a página del showall a mostrar
					$num_pagina = 0;
				}else{ //Si es otra página
					$num_pagina = $_REQUEST['num_pagina']; //coge el numero de página del formulario
				}
				$num_tupla = $num_pagina*10; //número de la 1º tupla a mostrar
				$max_tuplas = $num_tupla+10; // el número de tuplas a mostrar por página
				$totalTuplas = $USUARIO->contarTuplas(); //Cuenta el número de tuplas que hay en la BD
				$datos = $USUARIO->SHOWALL_User($num_tupla,$max_tuplas); //Ejecuta la funcion SHOWALL_User() en el USUARIO_Model para obtener solamente los datos de dicho usuario
				$lista = array('login', 'password', 'DNI','Nombre','Apellidos','Telefono','Email','Direccion');
				$UsuariosBD = new USUARIO_SHOWALL($lista, $datos, $num_tupla, $max_tuplas, $totalTuplas, $num_pagina, 'ALL', '../Controllers/USUARIO_Controller.php', $acciones); //Crea la vista SHOWALL de los usuarios de la BD	
				}	
		}
}


?>