
<?php
/*
//Clase : FUNCIONALIDAD_Model.php
//Creado el : 27-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Modelo de datos de funcionalidades que accede a la Base de Datos
*/

class FUNCIONALIDAD_Model {
	var $IdFuncionalidad;
    var $NombreFuncionalidad;
    var $DescripFuncionalidad; 
	var $lista;
	var $mysqli;

function __construct($IdFuncionalidad, $NombreFuncionalidad, $DescripFuncionalidad){
	$this->IdFuncionalidad = $IdFuncionalidad;
	$this->NombreFuncionalidad = $NombreFuncionalidad;
	$this->DescripFuncionalidad = $DescripFuncionalidad;

	// incluimos la funcion de acceso a la bd
	include_once '../Functions/Access_DB.php';
	// conectamos con la bd y guardamos el manejador en un atributo de la clase
	$this->mysqli = ConnectDB();

	$this->lista = array(
			"IdFuncionalidad"=>$this->IdFuncionalidad,
			"NombreFuncionalidad"=>$this->NombreFuncionalidad,
			"DescripFuncionalidad"=>$this->DescripFuncionalidad,
			"sql"=> $this->mysqli, 
			"mensaje"=> '');
} 



//Metodo ADD()
//Inserta en la tabla  de la bd  los valores
// de los atributos del objeto. Comprueba si la clave/s esta vacia y si 
//existe ya en la tabla

function ADD()
{

    if (($this->IdFuncionalidad <> '')){ // si el atributo clave de la entidad no esta vacio
		// construimos el sql para buscar esa clave en la tabla
        $sql = "SELECT * FROM FUNCIONALIDAD WHERE (IdFuncionalidad = '$this->IdFuncionalidad')"; //comprobar que no hay claves iguales

		if (!$result = $this->mysqli->query($sql)){ // si da error la ejecución de la query
			$this->lista['mensaje'] = 'ERROR: No se ha podido conectar con la base de datos';
			return $this->lista; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el controlador manejara

		}
		else { // si la ejecución de la query no da error

			$num_rows = mysqli_num_rows($result);

			if ($num_rows == 0){ // miramos si el resultado de la consulta es vacio (no existe el IdTrabajo)

				//construimos la sentencia sql de inserción en la bd
				$sql = "INSERT INTO FUNCIONALIDAD(
				IdFuncionalidad,
				NombreFuncionalidad,
				DescripFuncionalidad) VALUES(
									'$this->IdFuncionalidad',
									'$this->NombreFuncionalidad',
									'$this->DescripFuncionalidad')";

				$sql2 = "INSERT INTO FUNC_ACCION(
				IdFuncionalidad,
				IdAccion) VALUES (
								'$this->IdFuncionalidad',
								''
								)";
				 if (!($result = $this->mysqli->query($sql))){ //si da error la consulta se comrpueba el por que
					//Si no hay atributos Clave y unique duplicados es que hay campos sin completar
        			return 'ERROR: Introduzca todos los valores de todos los campos'; // introduzca un valor para el usuario
				}

    			else{ //si no da error en la insercion devolvemos mensaje de exito
					if($result2 = $this->mysqli->query($sql2)){
						$this->lista['mensaje'] = 'Inserción realizada con éxito';
						return $this->lista; //operacion de insertado correcta
					}else{//si se produce un error al insertarlo en alumnos lanzamos mensaje 
						$this->lista['mensaje'] = 'Error en la inserción'; 
					}
				}
			}else{ //si hay un IdTrabajo igual

	        	$this->lista['mensaje'] = 'ERROR: Fallo en la inserción. Ya existe el IdFuncionalidad'; 
				return $this->lista; 
			}
		}
    
	}else{ //Si no se introduce un IdTrabajo
			return 'ERROR: Introduzca todos los valores de todos los campos'; // introduzca un valor para el usuario
	}
				
} // fin del metodo ADD



//funcion de destrucción del objeto: se ejecuta automaticamente
//al finalizar el script
function __destruct()
{

} // fin del metodo destruct


//funcion SEARCH: hace una búsqueda en la tabla con
//los datos proporcionados. Si van vacios devuelve todos
function SEARCH()
{ 	// construimos la sentencia de busqueda con LIKE y los atributos de la entidad
    $sql = "SELECT  IdFuncionalidad,
    				NombreFuncionalidad,
    				DescripFuncionalidad
       			FROM FUNCIONALIDAD 
    			WHERE 
    				(
    				(IdFuncionalidad LIKE '%$this->IdFuncionalidad%') &&
    				(NombreFuncionalidad LIKE '%$this->NombreFuncionalidad%') &&
    				(DescripFuncionalidad LIKE '%$this->DescripFuncionalidad%') 
	 				)";
    				

    // si se produce un error en la busqueda mandamos el mensaje de error en la consulta
    if (!($resultado = $this->mysqli->query($sql))){
			$this->lista['mensaje'] = 'ERROR: Fallo en la consulta sobre la base de datos'; 
			return $this->lista; //
	}
    else{ // si la busqueda es correcta devolvemos el recordset resultado
		return $resultado;
	}
} // fin metodo SEARCH

// funcion DELETE()
// comprueba que exista el valor de clave por el que se va a borrar,si existe se ejecuta el borrado, sino
// se manda un mensaje de que ese valor de clave no existe
function DELETE()
{	// se construye la sentencia sql de busqueda con los atributos de la clase
    $sql = "SELECT * FROM FUNCIONALIDAD WHERE (IdFuncionalidad = '$this->IdFuncionalidad')";
    // se ejecuta la query
    $result = $this->mysqli->query($sql);
    // si existe una tupla con ese valor de clave
    if ($result->num_rows == 1)
    {
    	// se construye la sentencia sql de borrado
        $sql = "DELETE FROM FUNCIONALIDAD WHERE (IdFuncionalidad = '$this->IdFuncionalidad')";
        // se ejecuta la query
        $this->mysqli->query($sql);
        // se devuelve el mensaje de borrado correcto
        $this->lista['mensaje'] = 'Borrado correctamente'; 
			return $this->lista;
    } // si no existe el IdTrabajo a borrar se devuelve el mensaje de que no existe
    else{
    	 $this->lista['mensaje'] = 'ERROR: No existe la funcionalidad que desea borrar en la BD'; 
			return $this->lista;
		}	
} // fin metodo DELETE

// funcion RellenaDatos()
// Esta función obtiene de la entidad de la bd todos los atributos a partir del valor de la clave que esta
// en el atributo de la clase
function RellenaDatos()
{	// se construye la sentencia de busqueda de la tupla
    $sql = "SELECT * FROM FUNCIONALIDAD WHERE (IdFuncionalidad = '$this->IdFuncionalidad')";
    // Si la busqueda no da resultados, se devuelve el mensaje de que no existe
    if (!($resultado = $this->mysqli->query($sql))){
		$this->lista['mensaje'] = 'ERROR: No existe en la base de datos'; 
			return $this->lista; // 
	}
    else{ // si existe se devuelve la tupla resultado
		$result = $resultado->fetch_array();
		return $result;
	}
} // fin del metodo RellenaDatos()

// funcion EDIT()
// Se comprueba que la tupla a modificar exista en base al valor de su clave primaria
// si existe se modifica
function EDIT()
{
	//Si todos los campos tienen valor
	if(
		$this->IdFuncionalidad <> '' &&
		$this->NombreFuncionalidad <> '' &&
		$this->DescripFuncionalidad <> ''){

		// se construye la sentencia de busqueda de la tupla en la bd
	    $sql = "SELECT * FROM FUNCIONALIDAD WHERE (IdFuncionalidad = '$this->IdFuncionalidad')";
	    // se ejecuta la query
	    $result = $this->mysqli->query($sql);
	    $num_rows = mysqli_num_rows($result);
	    // si el numero de filas es igual a uno es que lo encuentra

	    if ($num_rows == 1)
	    {	// se construye la sentencia de modificacion en base a los atributos de la clase
			$sql = "UPDATE FUNCIONALIDAD SET 
						IdFuncionalidad = '$this->IdFuncionalidad',
						NombreFuncionalidad = '$this->NombreFuncionalidad',
						DescripFuncionalidad = '$this->DescripFuncionalidad'
					WHERE ( IdFuncionalidad = '$this->IdFuncionalidad')";
					
			// si hay un problema con la query se envia un mensaje de error en la modificacion
	        if (!($result = $this->mysqli->query($sql))){

			    // se construye la sentencia de busqueda de la tupla en la bd
			    $sql = "SELECT * FROM FUNCIONALIDAD WHERE (IdFuncionalidad = '$this->IdFuncionalidad')";
			    // se ejecuta la query
			    $result = $this->mysqli->query($sql);
			    $num_rows = mysqli_num_rows($result);
			    $row = $result->fetch_array();

			    if( ($num_rows == 1) && ( $row['IdFuncionalidad'] != $this->IdFuncionalidad) ){ //Si devuelve 1 tupla y no coinciden los IdTrabajo
			    	$this->lista['mensaje'] = 'ERROR: Fallo en la modificación. Ya existe IdFuncionalidad'; //añadir a strings
					return $this->lista;
				}
		    }	
			else{ // si no hay problemas con la modificación se indica que se ha modificado
				$this->lista['mensaje'] =  'Modificado correctamente'; 
				return $this->lista; 
			}
	    }
	    else {// si no se encuentra la tupla se manda el mensaje de que no existe la tupla
	    	$this->lista['mensaje'] =  'ERROR: No existe en la base de datos'; 
			return $this->lista; 
			}
	}else{ //Si no se introdujeron todos los valores
		 return 'ERROR: Fallo en la modificación. Introduzca todos los valores'; 

	}
} // fin del metodo EDIT


//Funcion de SHOWALL
//Devuelve las tuplas de la BD de 10 en 10

function SHOWALL($num_tupla,$max_tuplas){

	//$sql = "SELECT * FROM TRABAJO";

	$sql = "SELECT * FROM FUNCIONALIDAD LIMIT $num_tupla, $max_tuplas";

	

	    // si se produce un error en la busqueda mandamos el mensaje de error en la consulta
    if (!($resultado = $this->mysqli->query($sql))){
    	$this->lista['mensaje'] =  'ERROR: Fallo en la consulta sobre la base de datos'; 
		return $this->lista; 
	}
    else{ // si la busqueda es correcta devolvemos el recordset resultado
		return $resultado;
	}
} // fin metodo SHOWALL

//funcion que devuelve el numero de tuplas de la base de datos
function contarTuplas(){
	$sql = "SELECT * FROM FUNCIONALIDAD";

	$datos = $this->mysqli->query($sql);

    $total_tuplas = mysqli_num_rows($datos);

    return $total_tuplas;
}

function rellenarLista(){
	$sql ="SELECT * FROM FUNCIONALIDAD WHERE(IdFuncionalidad = '$this->IdFuncionalidad')";
	$result = $this->mysqli->query($sql);
	$row = mysqli_fetch_array($result);
	$this->lista['IdFuncionalidad'] = $row['IdFuncionalidad'];
	$this->lista['NombreFuncionalidad'] = $row['NombreFuncionalidad'];
	$this->lista['DescripFuncionalidad'] = $row['DescripFuncionalidad'];

	return $this->lista;
}

function contarNumAccionesFunc(){

	$sql = "SELECT COUNT(*) FROM FUNC_ACCION WHERE (IdFuncionalidad = '$this->IdFuncionalidad')";

	$result = $this->mysqli->query($sql);
	$num_rows = mysqli_num_rows($result);
	return $num_rows;
	}
function todosAcciones(){
		$sql = "SELECT * FROM  ACCION ";


	$result = $this->mysqli->query($sql);
	/*
	while($row = mysqli_num_rows($result)){
		$lista[$row['IdGrupo']] =$row['NombreGrupo'];
	}*/
	return $result;
}
function rellenarAcciones(){
	$sql = "SELECT * FROM FUNC_ACCION FA, ACCION A WHERE (FA.IdFuncionalidad = '$this->IdFuncionalidad' AND
														FA.IdAccion = A.IdAccion)";


	$result = $this->mysqli->query($sql);
	/*
	while($row = mysqli_num_rows($result)){
		$lista[$row['IdGrupo']] =$row['NombreGrupo'];
	}*/
	return $result;
}

}

?> 