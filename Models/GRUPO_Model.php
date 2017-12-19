
<?php
/*
//Clase : GRUPO_Model.php
//Creado el : 24-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Modelo de datos de grupo que accede a la Base de Datos
*/
class GRUPO_Model { //declaración de la clase

	var $idgrupo; //atributo id de grupo
	var $nombregrupo; //atributo nombre de grupo
	var $descripgrupo; // declaración del atributo descripcion de grupo
	var $lista; // array para almacenar los datos del grupo
	var $mysqli; // declaración del atributo manejador de la bd

//Constructor de la clase

function __construct($idgrupo, $nombregrupo, $descripgrupo){
	//asignación de valores de parámetro a los atributos de la clase
	$this->idgrupo = $idgrupo;
	$this->nombregrupo = $nombregrupo;
	$this->descripgrupo = $descripgrupo;
		
	// incluimos la funcion de acceso a la bd
	include_once '../Functions/Access_DB.php';
	// conectamos con la bd y guardamos el manejador en un atributo de la clase
	$this->mysqli = ConnectDB();

	//lista con los datos del grupo
	$this->lista = array(
			"IdGrupo"=>$this->idgrupo,
			"NombreGrupo"=>$this->nombregrupo,
			"DescripGrupo"=>$this->descripgrupo,
			"sql" => $this->mysqli, 
			"mensaje"=> '');
} // fin del constructor



//Metodo ADD()
//Inserta en la tabla  de la bd  los valores
// de los atributos del objeto. Comprueba si la clave/s esta vacia y si 
//existe ya en la tabla
function ADD()
{

    if (($this->idgrupo <> '')){ // si el atributo clave de la entidad no esta vacio
		// construimos el sql para buscar esa clave en la tabla
        $sql = "SELECT * FROM GRUPO WHERE (IdGrupo = '$this->idgrupo')"; //comprobar que no hay claves iguales

		if (!$result = $this->mysqli->query($sql)){ // si da error la ejecución de la query
			$this->lista['mensaje'] = 'ERROR: No se ha podido conectar con la base de datos';
			return $this->lista; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el controlador manejara

		}
		else { // si la ejecución de la query no da error

			$num_rows = mysqli_num_rows($result);

			if ($num_rows == 0){ // miramos si el resultado de la consulta es vacio (no existe el idgrupo)

				//construimos la sentencia sql de inserción en la bd
				$sql = "INSERT INTO GRUPO(
				IdGrupo,
				NombreGrupo,
				DescripGrupo) VALUES(
									'$this->idgrupo',
									'$this->nombregrupo',
									'$this->descripgrupo'
								)";
				
				 if (!($result = $this->mysqli->query($sql))){ //si da error la consulta se comrpueba el por que

			        $sql = "SELECT * FROM GRUPO WHERE (NombreGrupo = '$this->nombregrupo')"; //comprobar que no hay un nombregrupo igual en la BD
				 	$result = $this->mysqli->query($sql); ;// numero de tuplas de la consulta
					$num_rows = mysqli_num_rows($result);
				
				    if ($num_rows > 0)    // si el numero de filas es mayor que 0 es que existe un nombregrupo duplicado
				    {
			        	$this->lista['mensaje'] = 'ERROR: Fallo en la inserción. Ya existe el Nombre de Grupo'; 
						return $this->lista; 
					}
				
					//Si no hay atributos Clave y unique duplicados es que hay campos sin completar
        			return 'ERROR: Introduzca todos los valores de todos los campos'; // introduzca un valor para el grupo
				}

    			else{ //si no da error en la insercion devolvemos mensaje de exito
					$this->lista['mensaje'] = 'Inserción realizada con éxito';
					return $this->lista; //operacion de insertado correcta
				}
			}else{ //si hay un idgrupo igual

	        	$this->lista['mensaje'] = 'ERROR: Fallo en la inserción. Ya existe el ID de Grupo'; 
				return $this->lista; 
			}
		}
    
	}else{ //Si no se introduce un idgrupo
			return 'ERROR: Introduzca todos los valores de todos los campos'; // introduzca un valor para el grupo
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
    $sql = "SELECT  IdGrupo,
    				NombreGrupo,
					DescripGrupo
       			FROM GRUPO 
    			WHERE 
    				(
    				(IdGrupo LIKE '%$this->idgrupo%') &&
    				(NombreGrupo LIKE '%$this->nombregrupo%') &&
	 				(DescripGrupo LIKE '%$this->descripgrupo%')
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
    $sql = "SELECT * FROM GRUPO WHERE (IdGrupo = '$this->idgrupo')";
    // se ejecuta la query
      // se ejecuta la query
    $result = $this->mysqli->query($sql);
    $num_rows = mysqli_num_rows($result);
    // si existe una tupla con ese valor de clave
    if ($num_rows == 1)
    {
    	// se construye la sentencia sql de busqueda con los atributos de la clase
  
    	 $sql = "SELECT * FROM USU_GRUPO WHERE (idgrupo = '$this->idgrupo')";
      	if($resultado =  $this->mysqli->query($sql)){
	       	$sql = "DELETE FROM USU_GRUPO WHERE (idgrupo = '$this->idgrupo')";
        	// se ejecuta la query
       		$resultado =  $this->mysqli->query($sql);
       	}

    	 $sql = "SELECT * FROM PERMISO WHERE (idgrupo = '$this->idgrupo')";
    	 	if($resultado =  $this->mysqli->query($sql)){
    	 		$sql = "DELETE FROM PERMISO WHERE (idgrupo = '$this->idgrupo')";
       		 // se ejecuta la query
       			$resultado = $this->mysqli->query($sql);
        	}
	    
    	// se construye la sentencia sql de borrado
        $sql = "DELETE FROM GRUPO WHERE (IdGrupo = '$this->idgrupo')";
        // se ejecuta la query
        $resultado = $this->mysqli->query($sql);
        // se devuelve el mensaje de borrado correcto
        $this->lista['mensaje'] = 'Borrado correctamente'; 
			return $this->lista;
    } // si no existe el idgrupo a borrar se devuelve el mensaje de que no existe
    else{
    	 $this->lista['mensaje'] = 'ERROR: No existe el grupo que desea borrar en la BD'; 
			return $this->lista;
		}	
} // fin metodo DELETE

// funcion RellenaDatos()
// Esta función obtiene de la entidad de la bd todos los atributos a partir del valor de la clave que esta
// en el atributo de la clase
function RellenaDatos()
{	// se construye la sentencia de busqueda de la tupla
    $sql = "SELECT * FROM GRUPO WHERE (IdGrupo = '$this->idgrupo')";
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
		$this->idgrupo <> '' &&
		$this->nombregrupo <> '' &&
		$this->descripgrupo <> ''
	){

		// se construye la sentencia de busqueda de la tupla en la bd
	    $sql = "SELECT * FROM GRUPO WHERE (IdGrupo = '$this->idgrupo')";
	    // se ejecuta la query
	    $result = $this->mysqli->query($sql);
	    $num_rows = mysqli_num_rows($result);
	    // si el numero de filas es igual a uno es que lo encuentra

	    if ($num_rows == 1)
	    {	// se construye la sentencia de modificacion en base a los atributos de la clase
			$sql = "UPDATE GRUPO SET 
						IdGrupo = '$this->idgrupo',
						NombreGrupo = '$this->nombregrupo',
						DescripGrupo = '$this->descripgrupo'	
					WHERE ( IdGrupo = '$this->idgrupo')";
					
			// si hay un problema con la query se envia un mensaje de error en la modificacion
	        if (!($result = $this->mysqli->query($sql))){

			        		// se construye la sentencia de busqueda de la tupla en la bd
			    $sql = "SELECT * FROM GRUPO WHERE (NombreGrupo = '$this->nombregrupo')";
			    // se ejecuta la query
			    $result = $this->mysqli->query($sql);
			    $num_rows = mysqli_num_rows($result);
			    $row = $result->fetch_array();

			    if( ($num_rows == 1) && ( $row['IdGrupo'] != $this->idgrupo) ){ //Si devuelve 1 tupla y no coinciden los idgrupo
			    	$this->lista['mensaje'] = 'ERROR: Fallo en la modificación. Ya existe el ID de Grupo'; 
					return $this->lista;
				}

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


	$sql = "SELECT * FROM GRUPO LIMIT $num_tupla, $max_tuplas";

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

function SHOWALL_User($num_tupla,$max_tuplas){
	$login = $_SESSION['login'];
	$sql = "SELECT * 
			FROM USUARIO U, USU_GRUPO UG, GRUPO G
			WHERE  (U.login = '$login' AND
					UG.login = U.login AND
					UG.IdGrupo = G.IdGrupo 
					)
			LIMIT $num_tupla, $max_tuplas";
/*
	$sql = "SELECT * FROM USUARIO U, USU_GRUPO UG, GRUPO G
					WHERE (U.login = UG.login AND
							UG.IdGrupo = G.IdGrupo )
					LIMIT $num_tupla, $max_tuplas";
*/
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
	$sql = "SELECT * FROM GRUPO";

	$datos = $this->mysqli->query($sql);

    $total_tuplas = mysqli_num_rows($datos);

    return $total_tuplas;
}
//funcion que comprueba si el login y la password son correctos

/*
function login(){

	$sql = "SELECT *
			FROM USUARIO
			WHERE (
				(login = '$this->login') 
			)";
	$resultado = $this->mysqli->query($sql);
	$num_rows = mysqli_num_rows($resultado);

	if ($num_rows == 0){ //si hay 0 tuplas con ese login
		return 'ERROR: El login no existe';
	}
	else{//si no hay 0 tuplas
		$tupla = $resultado->fetch_array();
		if ($tupla['password'] == $this->password){//si coinciden las contraseñas
			return true;
		}
		else{//si no coinciden las contraseñas
			return 'ERROR: La contraseña para este usuario no es correcta';
		}
	}
}//fin metodo login
*/

//Funcion para comprobar si se realiza un registro correctamente
function comprobarRegistro(){

		$sql = "SELECT * FROM GRUPO WHERE IdGrupo = '$this->idgrupo'";

		$result = $this->mysqli->query($sql);
		$total_tuplas = mysqli_num_rows($result);

		if ($total_tuplas > 0){  // si hay mas de 0 tuplas, ya existe el grupo
			$this->lista['mensaje'] = 'ERROR: El grupo ya existe';
			return $this->lista;
			}
		else{
	    	return true; //no existe el grupo
		}

	}
}
?> 
