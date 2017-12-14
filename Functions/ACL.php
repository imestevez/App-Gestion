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
	$IdGrupo = $USU_GRUPO->grupoUsuario();
	if($IdGrupo == null){
		return false;
	}

	if($IdGrupo == 'ADMIN'){
		return true;
	}else{
		if(($IdAccion == '') || ($IdAccion == 'ALL') || ($IdAccion == 'SHOWALL')){
			$PERMISO = new PERMISO_Model($IdGrupo, '', '');
			$resultado = $PERMISO->permisosGrupo();
			$num_rows = mysqli_num_rows($resultado);
			if($num_rows == 0){
				return false;
			}
			

			while($row = mysqli_fetch_array($resultado)){

				if(($row["IdFuncionalidad"] == $IdFuncionalidad)){
					return true;
			}
		}
		return false;

		}else{
		$PERMISO = new PERMISO_Model($IdGrupo, '', '');
		$resultado = $PERMISO->permisosGrupo();
		$num_rows = mysqli_num_rows($resultado);
			if($num_rows == 0){
				return false;
			}

		while($row = mysqli_fetch_array($resultado)){
			if(($row["IdFuncionalidad"] == $IdFuncionalidad) && ($row["IdAccion"] == $IdAccion) ){
				return true;
			}
		}
		return false;
		}
	}
}

function listaPermisos(){

	$lista = null;
	$USU_GRUPO = new USU_GRUPO_Model($_SESSION["login"], '');
	$IdGrupo = $USU_GRUPO->grupoUsuario();
	$PERMISO = new PERMISO_Model($IdGrupo, '', '');
	$resultado = $PERMISO->permisosGrupo();
	$num_rows = mysqli_num_rows($resultado);
	if($num_rows == 0){
				return null;
	}
	$num=0;
	while($row = mysqli_fetch_array($resultado)){
		$lista[$num] = array($row["IdGrupo"],$row["IdFuncionalidad"],$row["IdAccion"] );
		$num++;
	}
	return $lista;
}

function listaFuncionalidades(){
	$lista = null;
	$USU_GRUPO = new USU_GRUPO_Model($_SESSION["login"], '');
	$IdGrupo = $USU_GRUPO->grupoUsuario();
	$PERMISO = new PERMISO_Model($IdGrupo, '', '');
	$resultado = $PERMISO->funcionalidadesGrupo();
	$num_rows = mysqli_num_rows($resultado);
	if($num_rows == 0){
				return null;
	}
	$num=0;
	while($row = mysqli_fetch_array($resultado)){
		$lista[$num] =$row["IdFuncionalidad"];
		$num++;
	}
	return $lista;

}

function listaAcciones($IdFuncionalidad){
	$lista = null;
	$USU_GRUPO = new USU_GRUPO_Model($_SESSION["login"], '');
	$IdGrupo = $USU_GRUPO->grupoUsuario();
	$PERMISO = new PERMISO_Model($IdGrupo, $IdFuncionalidad, '');
	$resultado = $PERMISO->accionesGrupo();
	$num_rows = mysqli_num_rows($resultado);
	if($num_rows == 0){
				return null;
	}
	$num=0;
	while($row = mysqli_fetch_array($resultado)){
		$lista[$num] =$row["IdAccion"];
		$num++;
	}
	return $lista;

}
?>