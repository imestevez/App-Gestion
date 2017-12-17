<?php

/*
//Script : ACL.php
//Creado el : 13-12-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Script que comprueba los permisos de los grupos de usuarios
*/

include '../Models/ACCION_Model.php';
include '../Models/ASIGNAC_QA_Model.php';
include '../Models/ENTREGA_Model.php';
include '../Models/EVALUACION_Model.php';
include '../Models/FUNC_ACCION_Model.php';
include '../Models/FUNC_GRUPO_Model.php';
include '../Models/FUNCIONALIDAD_Model.php';
include '../Models/GRUPO_Model.php';
include '../Models/HISTORIA_Model.php';
include '../Models/NOTA_TRABAJO_Model.php';
include '../Models/PERMISO_Model.php';
include '../Models/TRABAJO_Model.php';
include '../Models/USU_GRUPO_Model.php';
include '../Models/USUARIO_Model.php';


//Funcion que comprueeba si un usuario tiene permisos
function HavePermissions($IdFuncionalidad, $IdAccion){

	$USU_GRUPO = new USU_GRUPO_Model($_SESSION["login"], '');
	$listaGrupos = $USU_GRUPO->listagrupoUsuario();
	if($listaGrupos == null){
		return false;
	}

	foreach ($listaGrupos as $key => $IdGrupo) {

		if($IdGrupo == 'ADMIN'){
			return true;
		}else{
			if(($IdAccion == '') || ($IdAccion == 'ALL') || ($IdAccion == 'SHOWALL')){
				$PERMISO = new PERMISO_Model($IdGrupo, '', '', '', '','');
				$resultado = $PERMISO->permisosGrupo();
				$num_rows = mysqli_num_rows($resultado);
				if($num_rows > 0){
					while($row = mysqli_fetch_array($resultado)){
						if(($row["IdFuncionalidad"] == $IdFuncionalidad)){
							return true;
					}
				}

			}

			}else{
			$PERMISO = new PERMISO_Model($IdGrupo, '', '', '', '', '', '','');
			$resultado = $PERMISO->permisosGrupo();
			$num_rows = mysqli_num_rows($resultado);
			if($num_rows > 0){

				while($row = mysqli_fetch_array($resultado)){
					if(($row["IdFuncionalidad"] == $IdFuncionalidad) && ($row["IdAccion"] == $IdAccion) ){
						return true;
					}
				}
			}

			}
		}
	}
	return false;
}
//DEvuelve la lista de permisos de un grupo
function listaPermisos(){

	$lista = null; //array para almacenar los permisos
	$num=0; //variable para indexar el array lista
	$USU_GRUPO = new USU_GRUPO_Model($_SESSION["login"], '');
	$listaGrupos = $USU_GRUPO->listagrupoUsuario();
	if($listaGrupos == null){ //si no tiene ningun grupo
		return false;
	}

	foreach ($listaGrupos as $key => $IdGrupo) {

		$PERMISO = new PERMISO_Model($IdGrupo, '', '', '', '', '', '','');
		$resultado = $PERMISO->permisosGrupo();
		$num_rows = mysqli_num_rows($resultado);
		if($num_rows > 0){ //si hay alguna tupla
			
		while($row = mysqli_fetch_array($resultado)){
			$lista[$num] = array($row["IdGrupo"],$row["IdFuncionalidad"],$row["IdAccion"] );
			$num++;
		}
		return $lista;
		}
	}

	return $null;
}

//DEvuelve la lista de funcionalidades de un grupo
function listaFuncionalidades(){
	$lista = null;//array para almacenar las funcionalidades
	$num=0;   //variable para indexar el array lista
	$USU_GRUPO = new USU_GRUPO_Model($_SESSION["login"], '');
	$listaGrupos = $USU_GRUPO->listagrupoUsuario();
	if($listaGrupos == null){
		return false;
	}
	foreach ($listaGrupos as $key => $IdGrupo) {

		$PERMISO = new PERMISO_Model($IdGrupo, '', '', '', '', '', '','');
		$resultado = $PERMISO->funcionalidadesGrupo();
		$num_rows = mysqli_num_rows($resultado);
		if($num_rows > 0){
			while($row = mysqli_fetch_array($resultado)){
				$lista[$num] =$row["IdFuncionalidad"];
				$num++;
			}
		return $lista;
		}
	}
	return null;

}


//DEvuelve la lista de acciones de una funcionalidad
function listaAcciones($IdFuncionalidad){
	$lista = null;//array para almacenar las acciones
	$num =0;//variable para indexar el array lista
	$USU_GRUPO = new USU_GRUPO_Model($_SESSION["login"], '');
	$listaGrupos = $USU_GRUPO->listagrupoUsuario();

	foreach ($listaGrupos as $key => $IdGrupo) {
		$PERMISO = new PERMISO_Model($IdGrupo, $IdFuncionalidad, '', '', '', '', '','');
		$resultado = $PERMISO->accionesGrupo();
		$num_rows = mysqli_num_rows($resultado);

		if($num_rows > 0){

		while($row = mysqli_fetch_array($resultado)){
			$lista[$num] =$row["IdAccion"];
			$num++;
		}
		return $lista;
	}
}
	return null;
}


?>
