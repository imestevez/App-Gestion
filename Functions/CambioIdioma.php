<?php

/*
//Script : CambioIdioma.php
//Creado el : 14-10-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Script que realiza el cambio de idioma al pulsar en los respectivos iconos multilenguaje
*/

//sesion
session_start();
$idioma = $_POST['idioma']; //recoge el idioma que tiene el sistema
$_SESSION['idioma'] = $idioma; //asigna a la sesion el idioma
header('Location:' . $_SERVER["HTTP_REFERER"]);
?>