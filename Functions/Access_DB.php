<?php
/*
//Script : Access_DB.php
//Creado el : 14-10-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Script que realiza la conexion a la BD con los datos de usuario y contraseña para poder acceder a ella
*/

//funcion para conectar a la BD
function ConnectDB(){
   $conexion = mysqli_connect("localhost", "userET3", "passET3", "IUET32017") or (new MESSAGE('ERROR: No se ha podido conectar con la base de datos', '../index.php')); //realiza la conexion

 if ($conexion->connect_errno) {//si se produce un error
    	return false;
 }else{
 	return $conexion;
 }
}
?>