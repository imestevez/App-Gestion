
<?php

/*
//Script : USUARIOS_Controller.php
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
include '../Models/USUARIOS_Model.php';

include '../Views/Register_View.php';
include '../Views/USUARIOS_SHOWALL_View.php';
include '../Views/USUARIOS_SHOWCURRENT_View.php';
include '../Views/USUARIOS_ADD_View.php';
include '../Views/USUARIOS_EDIT_View.php';
include '../Views/USUARIOS_SEARCH_View.php';
include '../Views/USUARIOS_DELETE_View.php';
include '../Views/MESSAGE_View.php';



// funcion para coger los datos del formulario
function get_data_form(){

	$login = $_REQUEST['login'];
	$password = $_REQUEST['password'];
	$DNI = $_REQUEST['DNI'];
	$nombre = $_REQUEST['nombre'];
	$apellidos = $_REQUEST['apellidos'];
	$telefono = $_REQUEST['telefono'];
	$email = $_REQUEST['email'];
	$FechaNacimiento = $_REQUEST['FechaNacimiento'];

	if($_FILES['fotopersonal']['tmp_name'] <> ''){ //Si la foto tiene una ruta origen
		$foto = $_FILES['fotopersonal']['name'];
		$ruta = $_FILES['fotopersonal']['tmp_name'];
		
		$fotopersonal = "../Files/".$foto;

		move_uploaded_file($ruta, $fotopersonal); //se mueve la foto al directorio destino

	}else{ //si no tiene ruta origen
		$fotopersonal= '';
	}

	$sexo = $_REQUEST['sexo'];
	$action = $_REQUEST['action'];

	$USUARIOS = new USUARIOS_Model(
		$login, 
		$password, 
		$DNI, 
		$nombre, 
		$apellidos,
		$telefono, 
		$email, 
		$FechaNacimiento, 
		$fotopersonal,
		$sexo);

	return $USUARIOS;
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
	$FechaNacimiento = $_REQUEST['FechaNacimiento'];
	
	if($_FILES['newfotopersonal']['tmp_name'] <> ''){ //Si la foto tiene una ruta origen
		$foto = $_FILES['newfotopersonal']['name'];
		$ruta = $_FILES['newfotopersonal']['tmp_name'];
		
		$fotopersonal = "../Files/".$foto;

		move_uploaded_file($ruta, $fotopersonal); //se mueve la foto al directorio destino

	}else{
		$fotopersonal = $_REQUEST['fotopersonal'];
	}
	$sexo = $_REQUEST['sexo'];
	$action = $_REQUEST['action'];

	$USUARIOS = new USUARIOS_Model(
		$login, 
		$password, 
		$DNI, 
		$nombre, 
		$apellidos,
		$telefono, 
		$email, 
		$FechaNacimiento, 
		$fotopersonal,
		$sexo);

	return $USUARIOS;
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

				$form = new USUARIOS_ADD(); //Crea la vista ADD y muestra formulario para rellenar por el usuario
			}
			else{ //si viene del add 

				$USUARIOS = get_data_form(); //recibe datos
				$lista = $USUARIOS->ADD(); //mete datos en respuesta usuarios despues de ejecutar el add con los de USUARIOS
				$usuario = new MESSAGE($lista, '../Controllers/USUARIOS_Controller.php'); //muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'DELETE': //Si quiere hacer un DELETE
			if (!$_POST){ //viene del showall con una clave
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'], '','', '', '', '', '', '', '', '', ''); //crea un un USUARIOS_Model con el login del usuario
				$valores = $USUARIOS->RellenaDatos(); //completa el resto de atributos a partir de la clave
				$usuario = new USUARIOS_DELETE($valores); //Crea la vista de DELETE con los datos del usuario
			}
			else{//si viene con un post
				$USUARIOS = get_data_UserBD(); //coge los datos del formulario del usuario que desea borrar
				$respuesta = $USUARIOS->DELETE(); //Ejecuta la funcion DELETE() en el USUARIOS_Model
				$mensaje = new MESSAGE($respuesta, '../Controllers/USUARIOS_Controller.php'); //muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'EDIT': //si el usuario quiere editar	
			if (!$_POST){
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'], '','', '', '', '', '', '', '', '', ''); //crea un un USUARIOS_Model con el login del usuario 
				$datos = $USUARIOS->RellenaDatos();  //A partir del login recoge todos los atributos
				$usuario = new USUARIOS_EDIT($datos); //Crea la vista EDIT con los datos del usuario
			}
			else{
				$USUARIOS = get_data_UserBD(); //coge los datos del formulario del usuario que desea editar
				$respuesta = $USUARIOS->EDIT(); //Ejecuta la funcion EDIT() en el USUARIOS_Model
				$mensaje = new MESSAGE($respuesta, '../Controllers/USUARIOS_Controller.php');//muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'SEARCH': //si desea realizar una busqueda
			if (!$_POST){
				$USUARIOS = new USUARIOS_SEARCH();//Crea la vista SEARCH y muestra formulario para rellenar por el usuario
			}
			else{
				$USUARIOS = get_data_UserBD(); //coge los datos del formulario del usuario que desea buscar
				$datos = $USUARIOS->SEARCH();//Ejecuta la funcion SEARCH() en el USUARIOS_Model
				$lista = array('login','password','DNI','nombre','apellidos','telefono','email','FechaNacimiento','fotopersonal','sexo');
				$resultado = new USUARIOS_SHOWALL($lista, $datos, 0, 0, 0, 0, 'SEARCH', '../Controllers/USUARIOS_Controller.php');//Crea la vista SHOWALL y muestra los usuarios que cumplen los parámetros de búsqueda 
			}
			break;
		case 'SHOWCURRENT': //si desea ver un usuario en detalle
			$USUARIOS = new USUARIOS_Model($_REQUEST['login'], '','', '', '', '', '', '', '', '', '');//crea un un USUARIOS_Model con el login del usuario 
			$tupla = $USUARIOS->RellenaDatos();//A partir del login recoge todos los atributos
			$usuario = new USUARIOS_SHOWCURRENT($tupla); //Crea la vista SHOWCURRENT del usuario requerido
			break;
		default: //Por defecto, Se muestra la vista SHOWALL
			if (!$_POST){
				$USUARIOS = new USUARIOS_Model($_REQUEST['login'], '','','', '', '', '', '', '', '', '');//crea un un USUARIOS_Model con el login del usuario 
			}
			else{
				$USUARIOS = get_data_form(); //Coge los datos del formulario
			}

			if(!isset($_REQUEST['num_pagina'])){ //Si es la 1a página del showall a mostrar
				$num_pagina = 0;
			}else{ //Si es otra página
				$num_pagina = $_REQUEST['num_pagina']; //coge el numero de página del formulario
			}
			$num_tupla = $num_pagina*10; //número de la 1º tupla a mostrar
			$max_tuplas = $num_tupla+10; // el número de tuplas a mostrar por página
			$totalTuplas = $USUARIOS->contarTuplas(); //Cuenta el número de tuplas que hay en la BD
			$datos = $USUARIOS->SHOWALL($num_tupla,$max_tuplas); //Ejecuta la funcion SHOWALL() en el USUARIOS_Model
			$lista = array('login', 'password', 'DNI','nombre','apellidos','telefono','email','FechaNacimiento','fotopersonal','sexo');
			$UsuariosBD = new USUARIOS_SHOWALL($lista, $datos, $num_tupla, $max_tuplas, $totalTuplas, $num_pagina, 'SHOWALL', '../Controllers/USUARIOS_Controller.php'); //Crea la vista SHOWALL de los usuarios de la BD	
	}

?>