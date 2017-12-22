
<?php
/*
//Clase : FUNC_GRUPO_Model.php
//Creado el : 9-12-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Modelo de datos de usuarios que accede a la Base de Datos
*/
class FUNC_GRUPO_Model { //declaración de la clase

	var $IdGrupo; //atributo IdGrupo
	var $lista; //lista de retorno
	var $listaF; // lista Funcionalidades de grupos
	var $listaA; //lista de acciones de funcionalidades


//Constructor de la clase

function __construct($IdGrupo, $listaF, $listaA){
	//asignación de valores de parámetro a los atributos de la clase
	$this->IdGrupo = $IdGrupo;
	$this->lista = null;
	$this->listaF = $listaF;
	$this->listaA = $listaA;

	
	// incluimos la funcion de acceso a la bd
	include_once '../Functions/Access_DB.php';
	// conectamos con la bd y guardamos el manejador en un atributo de la clase
	$this->mysqli = ConnectDB();

} // fin del constructor



// funcion RellenaDatos()
// Esta función obtiene de la entidad de la bd todos los atributos a partir del valor de la clave que esta
// en el atributo de la clase
function RellenaDatos()
{	// se construye la sentencia de busqueda de la tupla
    $sql = "SELECT * FROM GRUPO WHERE (IdGrupo = '$this->IdGrupo')";
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
	if($this->IdGrupo <> ''){

		// se construye la sentencia de busqueda de la tupla en la bd
	    $sql = "SELECT * FROM GRUPO WHERE (IdGrupo = '$this->IdGrupo')";
	    // se ejecuta la query
	    $result = $this->mysqli->query($sql);
	    $num_rows = mysqli_num_rows($result);
	    // si el numero de filas es igual a uno es que lo encuentra

	    if ($num_rows == 1)
	    {	// se construye la sentencia de modificacion en base a los atributos de la clase
	    	$sql = "DELETE FROM PERMISO WHERE (IdGrupo = '$this->IdGrupo')";
	    	$result = $this->mysqli->query($sql);

	    	if((count($this->listaF) > 0) && (count($this->listaF) ) == (count($this->listaA)) ){
				foreach ($this->listaF as $key => $value) {
						$aux = $this->listaA[$key];
		    	$sql = "INSERT INTO PERMISO (IdGrupo, IdFuncionalidad, IdAccion)VALUES ('$this->IdGrupo', '$value' , '$aux')";

		    	$result = $this->mysqli->query($sql);

				}
			}
			$this->lista['mensaje'] =  'Modificado correctamente'; 
				return $this->lista; 
		}
		else {// si no se encuentra la tupla se manda el mensaje de que no existe la tupla
	    	$this->lista['mensaje'] =  'ERROR: No existe en la base de datos'; 
			return $this->lista; 
			}
	}else{ //Si no se introdujeron todos los valores
		 return 'ERROR: Fallo en la modificación. El IdGrupo está vacio'; 

	}
} // fin del metodo EDIT

/*
Funcion de SHOWALL
Devuelve las tuplas de la BD de 10 en 10
*/
function SHOWALL($num_tupla,$max_tuplas){

} // fin metodo SHOWALL

//funcion que devuelve el numero de tuplas de la base de datos
function contarTuplas(){
	$sql = "SELECT * FROM GRUPO";

	$datos = $this->mysqli->query($sql);

    $total_tuplas = mysqli_num_rows($datos);

    return $total_tuplas;
}

//Funcion que completa los datos con el idGrupo
function rellenarlista(){
	$sql ="SELECT * FROM GRUPO WHERE(IdGrupo = '$this->IdGrupo')";
	$result = $this->mysqli->query($sql);
	$row = mysqli_fetch_array($result);
	$this->lista['IdGrupo'] = $row['IdGrupo'];
	$this->lista['NombreGrupo'] = $row['NombreGrupo'];
	$this->lista['DescripGrupo'] = $row['DescripGrupo'];

	return $this->lista;
}

//Funcion que devuelve los las acciones de funcionalidades de un grupo
function todosPermisos(){
		$sql = "SELECT * FROM  FUNC_ACCION FA, ACCION A, FUNCIONALIDAD F
								WHERE (FA.IdFuncionalidad = F.IdFuncionalidad AND
										FA.IdAccion = A.IdAccion)";


	$result = $this->mysqli->query($sql);
	/*
	while($row = mysqli_num_rows($result)){
		$lista[$row['IdGrupo']] =$row['NombreGrupo'];
	}*/
	return $result;
}

//Devuelve los permisos de un grupo
function rellenarPermisos(){
	$sql = "SELECT * FROM PERMISO P, FUNC_ACCION FA, GRUPO G, FUNCIONALIDAD F, ACCION A WHERE (P.IdGrupo = '$this->IdGrupo' AND
														P.IdFuncionalidad = FA.IdFuncionalidad AND
														P.IdAccion = FA.IdAccion AND
														G.IdGrupo = P.IdGrupo AND
														A.IdAccion = FA.IdAccion AND
														F.IdFuncionalidad = FA.IdFuncionalidad
														)";


	$result = $this->mysqli->query($sql);
	/*
	while($row = mysqli_num_rows($result)){
		$lista[$row['IdGrupo']] =$row['NombreGrupo'];
	}*/
	return $result;
}

}
?> 