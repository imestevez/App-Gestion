
<?php
/*
//Clase : USUARIO_Model.php
//Creado el : 13-10-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Modelo de datos de usuarios que accede a la Base de Datos
*/
class USU_GRUPO_Model { //declaración de la clase

	var $login; //atributo login
	var $lista; // lista de grupos
	VAR $IdGrupo; //ID 	del grupo


//Constructor de la clase

function __construct($login, $lista){
	//asignación de valores de parámetro a los atributos de la clase
	$this->login = $login;
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
    $sql = "SELECT * FROM USUARIO WHERE (login = '$this->login')";
    // se ejecuta la query
    $resultado = $this->mysqli->query($sql);
    $num_rows = mysqli_num_rows($resultado);

    // si existe una tupla con ese valor de clave
    if ($num_rows > 0 )
    {
    	// se construye la sentencia sql de borrado
        $sql = "DELETE FROM USUARIO WHERE (login = '$this->login')";
        // se ejecuta la query
       $resultado = $this->mysqli->query($sql);
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
    $sql = "SELECT * FROM USUARIO WHERE (login = '$this->login')";
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
	if($this->login <> ''){

		// se construye la sentencia de busqueda de la tupla en la bd
	    $sql = "SELECT * FROM USUARIO WHERE (login = '$this->login')";
	    // se ejecuta la query
	    $result = $this->mysqli->query($sql);
	    $num_rows = mysqli_num_rows($result);
	    // si el numero de filas es igual a uno es que lo encuentra

	    if ($num_rows == 1)
	    {	// se construye la sentencia de modificacion en base a los atributos de la clase
	    	$sql = "DELETE FROM USU_GRUPO WHERE (login = '$this->login')";
	    	$result = $this->mysqli->query($sql);

	    	if(count($this->lista) > 0){
				foreach ($this->lista as $key => $value) {

		    	$sql = "INSERT INTO USU_GRUPO (login, IdGrupo)VALUES ('$this->login', '$value')";

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
		 return 'ERROR: Fallo en la modificación. El login está vacio'; 

	}
} // fin del metodo EDIT

/*
Funcion de SHOWALL
Devuelve las tuplas de la BD de 10 en 10
*/
function SHOWALL($num_tupla,$max_tuplas){

	$sql = "SELECT * FROM USUARIO
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
	$sql = "SELECT * FROM USUARIO";

	$datos = $this->mysqli->query($sql);

    $total_tuplas = mysqli_num_rows($datos);

    return $total_tuplas;
}
//funcion que comprueba si el login y la password son correctos
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

//Funcion para comprobar si se realiza un registro correctamente
function comprobarRegistro(){

		$sql = "SELECT * FROM USUARIO WHERE login = '$this->login'";

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

function rellenarLista(){
	$sql ="SELECT * FROM USUARIO WHERE(login = '$this->login')";
	$result = $this->mysqli->query($sql);
	$row = mysqli_fetch_array($result);
	$this->lista['login'] = $row['login'];
	$this->lista['Nombre'] = $row['Nombre'];
	$this->lista['Apellidos'] = $row['Apellidos'];

	return $this->lista;



}



function contarNumGruposUser(){

	$sql = "SELECT COUNT(*) FROM USU_GRUPO WHERE (login = '$this->login')";

	$result = $this->mysqli->query($sql);
	$num_rows = mysqli_num_rows($result);
	return $num_rows;
	}
function todosGrupos(){
		$sql = "SELECT * FROM  GRUPO ";


	$result = $this->mysqli->query($sql);
	/*
	while($row = mysqli_num_rows($result)){
		$lista[$row['IdGrupo']] =$row['NombreGrupo'];
	}*/
	return $result;
}
function rellenarGrupos(){
	$sql = "SELECT * FROM USU_GRUPO UG, GRUPO G WHERE (UG.login = '$this->login' AND
														UG.IdGrupo = G.IdGrupo)";


	$result = $this->mysqli->query($sql);
	/*
	while($row = mysqli_num_rows($result)){
		$lista[$row['IdGrupo']] =$row['NombreGrupo'];
	}*/
	return $result;
}

function grupoUsuario(){
	$sql = "SELECT * FROM USU_GRUPO WHERE (login = '$this->login')";
	$result = $this->mysqli->query($sql);
	while ($row = mysqli_fetch_array($result)) {
		$this->IdGrupo =  $row['IdGrupo'];

	}
	return $this->IdGrupo;

}

function listagrupoUsuario(){

	$sql = "SELECT * FROM USU_GRUPO WHERE (login = '$this->login')";
	$result = $this->mysqli->query($sql);
	$num=0;
	$lista=null;
	while ($row = mysqli_fetch_array($result)) {
		$lista[$num] =  $row['IdGrupo'];
		$num++;
	}
	return $lista;

}
}
?> 
