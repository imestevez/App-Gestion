
<?php
/*
//Clase : FUNC_ACCION_Model.php
//Creado el : 9-12-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Modelo de datos de usuarios que accede a la Base de Datos
*/
class FUNC_ACCION_Model { //declaración de la clase

	var $IdFuncionalidad; //atributo IdFuncionalidad
	var $lista; // lista de grupos


//Constructor de la clase

function __construct($IdFuncionalidad, $lista){
	//asignación de valores de parámetro a los atributos de la clase
	$this->IdFuncionalidad = $IdFuncionalidad;
	$this->lista = $lista;

	
	// incluimos la funcion de acceso a la bd
	include_once '../Functions/Access_DB.php';
	// conectamos con la bd y guardamos el manejador en un atributo de la clase
	$this->mysqli = ConnectDB();

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
    } // si no existe el IdFuncionalidad a borrar se devuelve el mensaje de que no existe
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
	if($this->IdFuncionalidad <> ''){

		// se construye la sentencia de busqueda de la tupla en la bd
	    $sql = "SELECT * FROM FUNCIONALIDAD WHERE (IdFuncionalidad = '$this->IdFuncionalidad')";
	    // se ejecuta la query
	    $result = $this->mysqli->query($sql);
	    $num_rows = mysqli_num_rows($result);
	    // si el numero de filas es igual a uno es que lo encuentra

	    if ($num_rows == 1)
	    {	// se construye la sentencia de modificacion en base a los atributos de la clase
	    	$sql = "DELETE FROM FUNC_ACCION WHERE (IdFuncionalidad = '$this->IdFuncionalidad')";
	    	$result = $this->mysqli->query($sql);

	    	if(count($this->lista) > 0){
				foreach ($this->lista as $key => $value) {

		    	$sql = "INSERT INTO FUNC_ACCION (IdFuncionalidad, IdAccion)VALUES ('$this->IdFuncionalidad', '$value')";

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
		 return 'ERROR: Fallo en la modificación. El IdFuncionalidad está vacio'; 

	}
} // fin del metodo EDIT

/*
Funcion de SHOWALL
Devuelve las tuplas de la BD de 10 en 10
*/
function SHOWALL($num_tupla,$max_tuplas){

	$sql = "SELECT * FROM FUNCIONALIDAD
	LIMIT $num_tupla, $max_tuplas";
/*
	$sql = "SELECT * FROM FUNCIONALIDAD U, FUNC_ACCION UG, GRUPO G
					WHERE (U.IdFuncionalidad = UG.IdFuncionalidad AND
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