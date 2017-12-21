<?php
/*
//Clase : Calificacion_Model.php
//Creado el : 25-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Modelo de datos de usuarios que accede a la Base de Datos

*/

class Calificacion_Model { //declaración de la clase
	var $IdTrabajo; //atributo para almacenar el IdTrabajo de un trabajo
    var $listaEvaluadores; //atributo para almacenar los evaluados
    var $listaEvaluado; //atributo para almacenar e Evaluado
    var $IdHistoria; //atributo para almacenar el IdHistoria de la historia en cuestion
    var $AliasEvaluado;  //alias que es evaluado
    var $numHistorias; //numero de historias a evaluar
    var $numEvaluadores; //numero de evaluadores por historia

    var $LoginEvaluador; //atributo para almacenar el LoginEvaluador del evaluador
    var $CorrectoA; //atributo para almacenar el valor Correcto del alumno evaluador
    var $ComenIncorrectoA; //atributo para almacenar el comentario incorrecto del alumno evaluador
    var $CorrectoP; //atributo para almacenar el valor Correcto del profesor
    var $ComentIncorrectoP; //atributo para almacenar el comentario incorrecto del profesor
    var $OK; //atributo para almacenar el resultado (1 - 0) de la evaluacion de la QA
    var $listaComentarios;
    
	var $mysqli; // declaración del atributo manejador de la bd

//Constructor de la clase

function __construct($IdTrabajo, $AliasEvaluado, $listaEvaluadores, $listaEvaluado, $listaComentarios,$numHistorias, $numEvaluadores){
	//asignación de valores de parámetro a los atributos de la clase
	$this->IdTrabajo = $IdTrabajo;
	$this->AliasEvaluado = $AliasEvaluado;
	$this->listaEvaluadores = $listaEvaluadores;
	$this->listaEvaluado = $listaEvaluado;
	$this->numHistorias = $numHistorias;
	$this->$numEvaluadores = $numEvaluadores;
	$this->listaComentarios =  $listaComentarios;

	// incluimos la funcion de acceso a la bd
	include_once '../Functions/Access_DB.php';
	// conectamos con la bd y guardamos el manejador en un atributo de la clase
	$this->mysqli = ConnectDB();

} // fin del constructor

// funcion EDIT()
// Se comprueba que la tupla a modificar exista en base al valor de su clave primaria
// si existe se modifica
function CALIF()
{

	//Si todos los campos tienen valor
	if(
		 
		$this->IdTrabajo <> '' &&
		$this->AliasEvaluado <> '' &&
		$this->numHistorias <> '' ){


		// se construye la sentencia de busqueda de la tupla en la bd

		if(($this->numHistorias > 0) ){//&& ($this->numEvaluadores > 0)){

			if((count($this->listaEvaluadores) > 0) ){

				foreach ($this->listaEvaluadores as $key => $value) {

					$this->IdHistoria = $value[0];
					$this->LoginEvaluador = $value[1];
					$this->CorrectoA = $value[2];
					$this->OK = $value[3];
					$this->ComenIncorrectoA = $value[4];


					if($this->listaEvaluado <> null){
						//$this->ComentIncorrectoP =  $this->listaComentarios[$this->IdHistoria];
						if(array_key_exists($this->IdHistoria, $this->listaEvaluado)){
							$this->CorrectoP = $this->listaEvaluado[$this->IdHistoria];
						
						}
					}
					if($this->CorrectoP == 0){
						$this->CorrectoP = 1;
					}else{
						$this->CorrectoP = 0;
					}
					if($this->OK == 0){
						$this->OK =1;
					}else{
						$this->OK = 0;
					}


					$sql = "UPDATE EVALUACION SET 
							CorrectoA = '$this->CorrectoA',
							ComenIncorrectoA = '$this->ComenIncorrectoA',
							CorrectoP = '$this->CorrectoP',
							ComentIncorrectoP = '$this->ComentIncorrectoP',
							OK = '$this->OK'
						WHERE (IdTrabajo = '$this->IdTrabajo' AND LoginEvaluador = '$this->LoginEvaluador' AND AliasEvaluado = '$this->AliasEvaluado' AND IdHistoria = '$this->IdHistoria')";
					  
					  if (!($result = $this->mysqli->query($sql))){
						        		$this->lista['mensaje'] =  'ERROR: No se ha modificado'; 
										return $this->lista; 
				    	}
				    }
				}

				if(count($this->listaEvaluado) > 0){

					foreach ($this->listaEvaluado as $key => $value) {

						$this->IdHistoria = $key;
						//$this->ComentIncorrectoP = $this->listaComentarios[$this->IdHistoria];
						$this->CorrectoP = $value[0];

						if($this->CorrectoP == 0){
							$this->CorrectoP = 1;
						}else{
							$this->CorrectoP = 0;
						}
		
						$sql = "UPDATE EVALUACION SET 
								CorrectoP = '$this->CorrectoP',
								ComentIncorrectoP = '$this->ComentIncorrectoP'
							WHERE (IdTrabajo = '$this->IdTrabajo' AND AliasEvaluado = '$this->AliasEvaluado' AND IdHistoria = '$this->IdHistoria')";

			    	  if (!($result = $this->mysqli->query($sql))){
		        		$this->lista['mensaje'] =  'ERROR: No se ha modificado'; 
						return $this->lista; 
			    	}

				}


			}
				
		if(count($this->listaComentarios) > 0){
			foreach ($this->listaComentarios as $key => $value) {

			$this->IdHistoria = $key;
			$this->ComentIncorrectoP = $value;

			$sql = "UPDATE EVALUACION SET 
					ComentIncorrectoP = '$this->ComentIncorrectoP'
				WHERE (IdTrabajo = '$this->IdTrabajo' AND AliasEvaluado = '$this->AliasEvaluado' AND IdHistoria = '$this->IdHistoria')";

			  if (!($result = $this->mysqli->query($sql))){
					$this->lista['mensaje'] =  'ERROR: No se ha modificado'; 
					return $this->lista; 
				}
	
			}
		}

		$this->lista['mensaje'] =  'Modificado correctamente'; 
		return $this->lista; 
	}
}else{
	$this->lista['mensaje'] = 'ERROR: Fallo en la modificación. Introduzca todos los valores';
	return $this->lista; 

}
}
}
?>