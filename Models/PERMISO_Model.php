
<?php
/*
//Clase : PERMISO_Model.php
//Creado el : 27-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Modelo de datos de usuarios que accede a la Base de Datos
*/
class PERMISO_Model { //declaración de la clase

	var $IdGrupo; //declaración del atributo IdGrupo
    var $IdFuncionalidad; //declaración del atributo IdFuncionalidad
    var $IdAccion; //declaración del atributo IdAccion
    var $lista; // array para almacenar los datos del usuario
    var $NombreGrupo; //nombre del grupo
    var $NombreFuncionalidad; //nombre de la funcionalidad
    var $NombreAccion; //nombre de la accion
	var $mysqli; // declaración del atributo manejador de la bd

//Constructor de la clase

function __construct($IdGrupo, $IdFuncionalidad, $IdAccion, $NombreGrupo, $NombreFuncionalidad, $NombreAccion){
	//asignación de valores de parámetro a los atributos de la clase

	$this->IdGrupo = $IdGrupo;
	$this->IdFuncionalidad = $IdFuncionalidad;
	$this->IdAccion = $IdAccion;
	$this->NombreGrupo= $NombreGrupo;
	$this->NombreFuncionalidad = $NombreFuncionalidad;
	$this->NombreAccion = $NombreAccion;

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


//funcion SEARCH: hace una búsqueda en la tabla con
//los datos proporcionados. Si van vacios devuelve todos. Se busca por nombres, no por ids.
function SEARCH()
{ 	// construimos la sentencia de busqueda con LIKE y los atributos de la entidad
    $sql = "SELECT  G.NombreGrupo,
    				F.NombreFuncionalidad,
    				A.NombreAccion
       			FROM PERMISO P, GRUPO G, FUNCIONALIDAD F, ACCION A
    			WHERE P.IdGrupo=G.IdGrupo AND P.IdFuncionalidad=F.IdFuncionalidad AND P.IdAccion=A.IdAccion AND
    				(
    				(G.NombreGrupo LIKE '%$this->NombreGrupo%') &&
    				(F.NombreFuncionalidad LIKE '%$this->NombreFuncionalidad%') &&
    				(A.NombreAccion LIKE '%$this->NombreAccion%') 
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


/*
Funcion de SHOWALL
Devuelve las tuplas de la BD de 10 en 10
*/
function SHOWALL($num_tupla,$max_tuplas){

	//$sql = "SELECT * FROM USUARIO";

	$sql = "SELECT 	G.NombreGrupo,
    				F.NombreFuncionalidad,
    				A.NombreAccion

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

//Funcion que muestra un showall particular del usuario que está conectado a la aplicacion
function SHOWALL_User($num_tupla,$max_tuplas){
	$login = $_SESSION['login'];
	$sql = "SELECT * 
			FROM USUARIO U, USU_GRUPO UG, GRUPO G, FUNCIONALIDAD F, ACCION A, PERMISO P
			WHERE  (U.login = '$login' AND
					UG.login = U.login AND
					UG.IdGrupo = G.IdGrupo AND
					UG.IdGrupo = P.IdGrupo AND
					P.IdFuncionalidad = F.IdFuncionalidad AND
					P.IdAccion = A.IdAccion 
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
	$sql = "SELECT * FROM PERMISO";

	$datos = $this->mysqli->query($sql);

    $total_tuplas = mysqli_num_rows($datos);

    return $total_tuplas;
}
//permidos de un grupo
function permisosGrupo(){
	$sql = "SELECT * FROM PERMISO WHERE (IdGrupo = '$this->IdGrupo')";

	$resultado = $this->mysqli->query($sql);

	
    return $resultado;
}
//funcionalidades de un grupo
function funcionalidadesGrupo(){
	$sql = "SELECT DISTINCT IdFuncionalidad FROM PERMISO WHERE (IdGrupo = '$this->IdGrupo')";

	$resultado = $this->mysqli->query($sql);

    return $resultado;
}
//acciones de un grupo
function accionesGrupo(){
	$sql = "SELECT DISTINCT IdAccion FROM PERMISO WHERE (IdGrupo = '$this->IdGrupo' AND IdFuncionalidad = '$this->IdFuncionalidad')";

	$resultado = $this->mysqli->query($sql);
	
    return $resultado;
}

}
?> 