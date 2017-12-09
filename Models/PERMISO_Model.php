
<?php
/*
//Clase : PERMISO_Model.php
//Creado el : 27-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Modelo de datos de usuarios que accede a la Base de Datos
*/
class PERMISO_Model { //declaración de la clase

	var $NombreGrupo; //declaración del atributo NombreGrupo de la accion
    var $NombreFuncionalidad; //declaración del atributo NombreFuncionalidad de la accion
    var $NombreAccion; //declaración del atributo NombreAccion
    var $lista; // array para almacenar los datos del usuario
	var $mysqli; // declaración del atributo manejador de la bd

//Constructor de la clase

function __construct($NombreGrupo, $NombreFuncionalidad, $NombreAccion){
	//asignación de valores de parámetro a los atributos de la clase
	$this->NombreGrupo = $NombreGrupo;
	$this->NombreFuncionalidad = $NombreFuncionalidad;
	$this->NombreAccion = $NombreAccion;

	// incluimos la funcion de acceso a la bd
	include_once '../Functions/Access_DB.php';
	// conectamos con la bd y guardamos el manejador en un atributo de la clase
	$this->mysqli = ConnectDB();

	//lista con los datos del usuario
	$this->lista = array(
			"NombreGrupo"=>$this->NombreGrupo,
			"NombreFuncionalidad"=>$this->NombreFuncionalidad,
			"NombreAccion"=>$this->NombreAccion,
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
    $sql = "SELECT  NombreGrupo,
    				NombreFuncionalidad,
    				NombreAccion
       			FROM PERMISO P, GRUPO G, FUNCIONALIDAD F, ACCION A
    			WHERE P.IdGrupo=G.IdGrupo AND P.IdFuncionalidad=F.IdFuncionalidad AND P.IdAccion=A.IdAccion AND
    				(
    				(NombreGrupo LIKE '%$this->NombreGrupo%') &&
    				(NombreFuncionalidad LIKE '%$this->NombreFuncionalidad%') &&
    				(NombreAccion LIKE '%$this->NombreAccion%') 
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

	$sql = "SELECT 	NombreGrupo,
    				NombreFuncionalidad,
    				NombreAccion
    				FROM PERMISO P, GRUPO G, FUNCIONALIDAD F, ACCION A
    				WHERE P.IdGrupo=G.IdGrupo AND P.IdFuncionalidad=F.IdFuncionalidad AND P.IdAccion=A.IdAccion
    				LIMIT $num_tupla, $max_tuplas";

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
	$sql = "SELECT * FROM PERMISO";

	$datos = $this->mysqli->query($sql);

    $total_tuplas = mysqli_num_rows($datos);

    return $total_tuplas;
}

}
?> 