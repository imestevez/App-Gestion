<?php
/*
//Script : index.php
//Creado el : 1-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

// index.php es la entrada a la aplicación. El primer script que se ejecuta
*/
//se va usar la session de la conexion
session_start();

//funcion de autenticacion
include './Functions/Authentication.php';

//si no ha pasado por el login de forma correcta
if (!IsAuthenticated()){
	header('Location:./Controllers/Login_Controller.php');
}
//si ha pasado por el login de forma correcta 
else{
	header('Location:./Controllers/Index_Controller.php');
}

?>
