<?php
/*
//Script : Login.Controller.php
//Creado el : 1-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Controlador del para llevar a cabo el proceso de autenticaciones cuando el usuario quiere acceder al sistema con su login y password
*/
//sesión
session_start();
if(!isset($_REQUEST['login']) && !(isset($_REQUEST['password']))){ // si no se introdujo un login y contrasña
	include '../Views/Login_View.php';
	$login = new Login(); // muestra la vista de Login
}
else{ //si se introdujeron

	include '../Views/MESSAGE_View.php'; //incluye la vista de mensajes 
	include '../Functions/Access_DB.php'; //incluye la conexión a la BD
	include '../Models/USUARIO_Model.php'; //incluye el Modelo de usuarios

	$usuario = new USUARIO_Model($_REQUEST['login'],$_REQUEST['password'],'','','','','',''); //crea un usuario con el login y password insertados
	$respuesta = $usuario->login(); //Comprueba que existe el login y se corresponde con las contraseña introducida

	if ($respuesta == 'true'){ //si se introdujeron correctamente
		session_start(); //inicia sesion
		$_SESSION['login'] = $_REQUEST['login']; //guarda en la variable $_SESSION el nombre de usuario
		header('Location:../index.php'); //redirige al index.php (estando autenticado)
	}
	else{//si no se introdujeron correctamente
		new MESSAGE($respuesta, './Login_Controller.php'); //muestra el mensaje correspondiente al usuario y vuelve al Login controller
	}

}
?>

