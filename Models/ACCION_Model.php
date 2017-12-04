
<?php
/*
//Clase : USUARIOS_Model.php
//Creado el : 27-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Modelo de datos de usuarios que accede a la Base de Datos
*/
class ACCION_Model { //declaración de la clase

	var $IdAccion; //declaración del atributo IdAccion de la accion
    var $NombreAccion; //declaración del atributo NombreAccion de la accion
    var $DescripAccion; //declaración del atributo DescripAccion
    var $lista; // array para almacenar los datos del usuario
	var $mysqli; // declaración del atributo manejador de la bd

//Constructor de la clase

function __construct($IdAccion, $NombreAccion, $DescripAccion){
	//asignación de valores de parámetro a los atributos de la clase
	$this->IdAccion = $IdAccion;
	$this->NombreAccion = $NombreAccion;
	$this->DescripAccion = $DescripAccion;

	// incluimos la funcion de acceso a la bd
	include_once '../Functions/Access_DB.php';
	// conectamos con la bd y guardamos el manejador en un atributo de la clase
	$this->mysqli = ConnectDB();

	//lista con los datos del usuario
	$this->lista = array(
			"IdAccion"=>$this->IdAccion,
			"NombreAccion"=>$this->NombreAccion,
			"DescripAccion"=>$this->DescripAccion,
			"sql" => $this->mysqli, 
			"mensaje"=> '');
} // fin del constructor



//Metodo ADD()
//Inserta en la tabla  de la bd  los valores
// de los atributos del objeto. Comprueba si la clave/s esta vacia y si 
//existe ya en la tabla
function ADD()
{

    if (($this->IdAccion <> '')){ // si el atributo clave de la entidad no esta vacio
		// construimos el sql para buscar esa clave en la tabla
        $sql = "SELECT * FROM ACCION WHERE (IdAccion = '$this->IdAccion')"; //comprobar que no hay claves iguales

		if (!$result = $this->mysqli->query($sql)){ // si da error la ejecución de la query
			$this->lista['mensaje'] = 'ERROR: No se ha podido conectar con la base de datos';
			return $this->lista; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el controlador manejara

		}
		else { // si la ejecución de la query no da error

			$num_rows = mysqli_num_rows($result);

			if ($num_rows == 0){ // miramos si el resultado de la consulta es vacio (no existe el login)

				//construimos la sentencia sql de inserción en la bd
				$sql = "INSERT INTO ACCION(
				IdAccion,
				NombreAccion,
				DescripAccion) VALUES(
									'$this->IdAccion',
									'$this->NombreAccion',
									'$this->DescripAccion')";
				
				 if (!($result = $this->mysqli->query($sql))){ //si da error la consulta se comrpueba el por que

					//Si no hay atributos Clave y unique duplicados es que hay campos sin completar
        			return 'ERROR: Introduzca todos los valores de todos los campos'; // introduzca un valor para el usuario
				}

    			else{ //si no da error en la insercion devolvemos mensaje de exito
					$this->lista['mensaje'] = 'Inserción realizada con éxito';
					return $this->lista; //operacion de insertado correcta
				}
			}else{ //si hay un login igual

	        	$this->lista['mensaje'] = 'ERROR: Fallo en la inserción. Ya existe el login'; 
				return $this->lista; 
			}
		}
    
	}else{ //Si no se introduce un login
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
    $sql = "SELECT  IdAccion,
    				NombreAccion,
    				DescripAccion
       			FROM ACCION 
    			WHERE 
    				(
    				(IdAccion LIKE '%$this->IdAccion%') &&
    				(NombreAccion LIKE '%$this->NombreAccion%') &&
    				(DescripAccion LIKE '%$this->DescripAccion%') 
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
    $sql = "SELECT * FROM ACCION WHERE (IdAccion = '$this->IdAccion')";
    // se ejecuta la query
    $result = $this->mysqli->query($sql);
    // si existe una tupla con ese valor de clave
    if ($result->num_rows == 1)
    {
    	// se construye la sentencia sql de borrado
        $sql = "DELETE FROM ACCION WHERE (IdAccion = '$this->IdAccion')";
        // se ejecuta la query
        $this->mysqli->query($sql);
        // se devuelve el mensaje de borrado correcto
        $this->lista['mensaje'] = 'Borrado correctamente'; 
			return $this->lista;
    } // si no existe el login a borrar se devuelve el mensaje de que no existe
    else{
    	 $this->lista['mensaje'] = 'ERROR: No existe el usuario que desea borrar en la BD'; 
			return $this->lista;
		}	
} // fin metodo DELETE

// funcion RellenaDatos()
// Esta función obtiene de la entidad de la bd todos los atributos a partir del valor de la clave que esta
// en el atributo de la clase
function RellenaDatos()
{	// se construye la sentencia de busqueda de la tupla
    $sql = "SELECT * FROM ACCION WHERE (IdAccion = '$this->IdAccion')";
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
		$this->IdAccion <> '' &&
		$this->NombreAccion <> '' &&
		$this->DescripAccion <> ''){

		// se construye la sentencia de busqueda de la tupla en la bd
	    $sql = "SELECT * FROM ACCION WHERE (IdAccion = '$this->IdAccion')";
	    // se ejecuta la query
	    $result = $this->mysqli->query($sql);
	    $num_rows = mysqli_num_rows($result);
	    // si el numero de filas es igual a uno es que lo encuentra

	    if ($num_rows == 1)
	    {	// se construye la sentencia de modificacion en base a los atributos de la clase
			$sql = "UPDATE ACCION SET 
						IdAccion = '$this->IdAccion',
						NombreAccion = '$this->NombreAccion',
						DescripAccion = '$this->DescripAccion'
					WHERE ( IdAccion = '$this->IdAccion')";
					
			// si hay un problema con la query se envia un mensaje de error en la modificacion
	        if (!($result = $this->mysqli->query($sql))){

			    	return 'ERROR: Fallo en la modificación. Introduzca todos los valores'; 
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

/*
Funcion de SHOWALL
Devuelve las tuplas de la BD de 10 en 10
*/
function SHOWALL($num_tupla,$max_tuplas){

	//$sql = "SELECT * FROM USUARIO";

	$sql = "SELECT * FROM ACCION LIMIT $num_tupla, $max_tuplas";

	//echo $sql;

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
	$sql = "SELECT * FROM ACCION";

	$datos = $this->mysqli->query($sql);

    $total_tuplas = mysqli_num_rows($datos);

    return $total_tuplas;
}
//funcion que comprueba si el login y la password son correctos
function IdAccion(){

}//fin metodo login

//Funcion para comprobar si se realiza un registro correctamente
function comprobarRegistro(){

		$sql = "SELECT * FROM ACCION WHERE IdAccion = '$this->IdAccion'";

		$result = $this->mysqli->query($sql);
		$total_tuplas = mysqli_num_rows($result);

		if ($total_tuplas > 0){  // esi hay mas de 0 tuplas, existe ya el usuarios
			$this->lista['mensaje'] = 'ERROR: El usuario ya existe';
			return $this->lista;
			}
		else{
	    	return true; //no existe el usuario
		}

	}
}
?> 
