<?php
/*
//Script : Register.Controller.php
//Creado el : 1-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Controlador del para llevar a cabo el proceso de registro de usuarios
*/
//sesion
session_start();
include_once '../Locales/Strings_'.$_SESSION['idioma'].'.php'; //se incluye los ficheros para el multidioma

if(!isset($_POST['login'])){ //si no se introdujo el login
	include '../Views/Registro_View.php';
	$register = new Register();//muestra la vista de registro
}
else{
		
	include '../Models/USUARIOS_Model.php'; //incluye el modelo de usuarios

	if($_REQUEST['action'] == 'BACK'){ //si el usuario pulsa en volver
		header('Location: ./Login_Controller.php'); //lo redirige al controlador de login

	}else{ //si envía el formulario

	$login = $_REQUEST['login'];
	$password = $_REQUEST['password'];
	$DNI = $_REQUEST['DNI'];
	$nombre = $_REQUEST['nombre'];
	$apellidos = $_REQUEST['apellidos'];
	$telefono = $_REQUEST['telefono'];
	$email = $_REQUEST['email'];
	$FechaNacimiento = $_REQUEST['FechaNacimiento'];
	$foto = $_FILES['fotopersonal']['name'];
	$ruta = $_FILES['fotopersonal']['tmp_name'];
	$fotopersonal = "../Files/".$foto;
	move_uploaded_file($ruta, $fotopersonal);
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

		$respuesta = $USUARIOS->comprobarRegistro(); //comprueba que los datos están correctamente

	if ($respuesta == 'true'){ //si estan correctamente
		$respuesta = $USUARIOS->ADD(); //añade al usuaurio en la BD
		Include '../Views/MESSAGE_View.php';
		new MESSAGE($respuesta['mensaje'], 'Login_Controller.php');
		}	
	}
}

?>