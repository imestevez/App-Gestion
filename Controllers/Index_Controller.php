<?php
/*
//Script : Index.Controller.php
//Creado el : 1-11-2017
//Creado por: vugsj4
//-------------------------------------------------------

Controlador del index.php,  en función de la situación del usuario en el sistema nos redirige a una página u a otra
*/
//session
session_start();
//incluir funcion autenticacion
include '../Functions/Authentication.php';
//si no esta autenticado
if (!IsAuthenticated()){
	header('Location: ../index.php'); //vuelve al index.php
}
//esta autenticado
else{
	include '../Views/USUARIO_INDEX_View.php'; 
	new Index(); //crea la vista de usuarios autenticados
}

?>