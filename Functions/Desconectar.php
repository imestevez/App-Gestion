<?php
/*
//Script : Desconectar.php
//Creado el : 14-10-2017
//Creado por: vugsj4
//-------------------------------------------------------

Script que realiza la desconexión al sistema de un usuario logeado
*/
session_start();
session_destroy();
header('Location:../index.php');

?>
