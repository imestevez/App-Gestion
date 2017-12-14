
<?php
/*
//Clase : PERMISO_Model.php
//Creado el : 27-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Modelo de datos de usuarios que accede a la Base de Datos
*/
class PERMISO_Model { //declaración de la clase

	var $IdGrupo; //declaración del atributo IdGrupo de la accion
    var $IdFuncionalidad; //declaración del atributo IdFuncionalidad de la accion
    var $IdAccion; //declaración del atributo IdAccion
    var $lista; // array para almacenar los datos del usuario
	var $mysqli; // declaración del atributo manejador de la bd

//Constructor de la clase

function __construct($IdGrupo, $IdFuncionalidad, $IdAccion){
	//asignación de valores de parámetro a los atributos de la clase

	$this->IdGrupo = $IdGrupo;
	$this->IdFuncionalidad = $IdFuncionalidad;
	$this->IdAccion = $IdAccion;

	// incluimos la funcion de acceso a la bd
	include_once '../Functions/Access_DB.php';
	// conectamos con la bd y guardamos el manejador en un atributo de la clase
	$this->mysqli = ConnectDB();

	//lista con los datos del usuario
	$this->lista = array(
			"IdGrupo"=>$this->IdGrupo,
			"IdFuncionalidad"=>$this->IdFuncionalidad,
			"IdAccion"=>$this->IdAccion,
			"sql" => $this->mysqli, 
			"mensaje"=> '');
} // fin del constructor



//Metodo ADD()
//Inserta en la tabla  de la bd  los valores
// de los atributos del objeto. Comprueba si la clave/s esta vacia y si 
//existe ya en la tabla
function ADD()
{
				
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
    				IdFuncionalidad,
    				IdAccion
       			FROM PERMISO P, GRUPO G, FUNCIONALIDAD F, ACCION A
    			WHERE P.IdGrupo=G.IdGrupo AND P.IdFuncionalidad=F.IdFuncionalidad AND P.IdAccion=A.IdAccion AND
    				(
    				(IdGrupo LIKE '%$this->IdGrupo%') &&
    				(IdFuncionalidad LIKE '%$this->IdFuncionalidad%') &&
    				(IdAccion LIKE '%$this->IdAccion%') 
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
} // fin metodo DELETE

// funcion RellenaDatos()
// Esta función obtiene de la entidad de la bd todos los atributos a partir del valor de la clave que esta
// en el atributo de la clase
function RellenaDatos()
{	// se construye la sentencia de busqueda de la tupla
    $sql = "SELECT * FROM PERMISO WHERE (IdGrupo = '$this->IdGrupo'
											IdFuncionalidad = '$this->IdFuncionalidad'
											IdAccion = '$this->IdAccion')";
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
	
} // fin del metodo EDIT

/*
Funcion de SHOWALL
Devuelve las tuplas de la BD de 10 en 10
*/
function SHOWALL($num_tupla,$max_tuplas){

	//$sql = "SELECT * FROM USUARIO";

	$sql = "SELECT 	IdGrupo,
    				IdFuncionalidad,
    				IdAccion
    				FROM PERMISO P, GRUPO G, FUNCIONALIDAD F, ACCION A
    				WHERE P.IdGrupo=G.IdGrupo AND P.IdFuncionalidad=F.IdFuncionalidad AND P.IdAccion=A.IdAccion
    				LIMIT $num_tupla, $max_tuplas";


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
	$sql = "SELECT * FROM PERMISO";

	$datos = $this->mysqli->query($sql);

    $total_tuplas = mysqli_num_rows($datos);

    return $total_tuplas;
}

function permisosGrupo(){
	$sql = "SELECT * FROM PERMISO WHERE (IdGrupo = '$this->IdGrupo')";

	$resultado = $this->mysqli->query($sql);

	
    return $resultado;
}
function funcionalidadesGrupo(){
	$sql = "SELECT DISTINCT IdFuncionalidad FROM PERMISO WHERE (IdGrupo = '$this->IdGrupo')";

	$resultado = $this->mysqli->query($sql);

	
    return $resultado;
}

function accionesGrupo(){
	$sql = "SELECT DISTINCT IdAccion FROM PERMISO WHERE (IdGrupo = '$this->IdGrupo' AND IdFuncionalidad = '$this->IdFuncionalidad')";

	$resultado = $this->mysqli->query($sql);

	
    return $resultado;
}

}
?> 