
<?php
/*
//Clase : ENTREGA_Model.php
//Creado el : 25-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Modelo de datos de usuarios que accede a la Base de Datos

*/

class ENTREGA_Model { //declaración de la clase
	var $login; //declaración del atributo login
	var $IdTrabajo; //atributo IdTrabajo
	var $Alias; //atributo Alias
	var $Horas; // declaración del atributo Horas
	var $Nombre; //nombre usuario
	var $NombreTrabajo; //nombre trabajo
	var $Ruta; //declaración del atributo Ruta
	var $lista; // array para almacenar los datos del usuario
	var $mysqli; // declaración del atributo manejador de la bd

//Constructor de la clase

function __construct($login,$IdTrabajo, $Alias, $Horas,$Ruta, $Nombre,$NombreTrabajo){
	//asignación de valores de parámetro a los atributos de la clase
	$this->login = $login;
	$this->IdTrabajo = $IdTrabajo;
	$this->Alias = $Alias;
	$this->Nombre = $Nombre;
	$this->NombreTrabajo = $NombreTrabajo;
	$this->Horas = $Horas;
    $this->Ruta = $Ruta;


	// incluimos la funcion de acceso a la bd
	include_once '../Functions/Access_DB.php';
	// conectamos con la bd y guardamos el manejador en un atributo de la clase
	$this->mysqli = ConnectDB();

	//lista con los datos del usuario
	$this->lista = array(
			"login" => $this->login,
			"Nombre" => $this->Nombre,
			"IdTrabajo"=>$this->IdTrabajo,
			"NombreTrabajo"=>$this->NombreTrabajo,
			"Alias"=>$this->Alias,
			"Horas"=>$this->Horas,
			"Ruta" =>  $this->Ruta,
			"NotaTrabajo" => '',
			"origen" => '',
			"sql" => $this->mysqli, 
			"mensaje"=> '');
} // fin del constructor



//Metodo ADD()
//Inserta en la tabla  de la bd  los valores
// de los atributos del objeto. Comprueba si la clave/s esta vacia y si 
//existe ya en la tabla

function ADD()
{

    if (($this->login <> '') && ($this->IdTrabajo <> '') && ($this->Alias <> '')){ // si el atributos not null no estan vacios

	  $existenciaU = $this->comprobarExistenciaUsuario();
	  $existenciaT = $this->comprobarExistenciaTrabajo();
	  $existenciaE = $this->comprobarExistenciaEntrega();

	  if( (is_string($existenciaU)) || (is_string($existenciaT) ) || (is_string($existenciaE)) ) {
	  			$this->lista['mensaje'] = 'ERROR: No se ha podido conectar con la base de datos';
					return $this->lista; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el controlador manejara
	  }else{
		  if(  ($existenciaU == true) && ($existenciaT == true) && ($existenciaE == false) ){

		  	if($this->Horas <> ''){

				//construimos la sentencia sql de inserción en la bd
				$sql = "INSERT INTO ENTREGA(
				login,
				IdTrabajo,
				Alias,
				Horas,
				Ruta) VALUES(
									'$this->login',
									'$this->IdTrabajo',
									'$this->Alias',
									'$this->Horas',
									'$this->Ruta')";
			}else{
				//construimos la sentencia sql de inserción en la bd
				$sql = "INSERT INTO ENTREGA(
				login,
				IdTrabajo,
				Alias,
				Horas,
				Ruta) VALUES(
									'$this->login',
									'$this->IdTrabajo',
									'$this->Alias',
									0,
									'$this->Ruta')";

			}				

				if (!$result = $this->mysqli->query($sql)){ // si da error la ejecución de la query
						$this->lista['mensaje'] = 'ERROR: No se ha podido conectar con la base de datos';
						return $this->lista; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el controlador manejara
				}else{ //si no da error en la insercion devolvemos mensaje de exito

					$this->lista['mensaje'] = 'Inserción realizada con éxito';
					return $this->lista; //operacion de insertado correcta
				}
		  }else{

		  	if($existenciaU == false){
		  		$this->lista['mensaje'] = 'ERROR: El login no existe'; 
				return $this->lista; 
		  	}else{
		  		if($existenciaT == false){
		  			$this->lista['mensaje'] = 'ERROR: El IdTrabajo no existe'; 
					return $this->lista; 
		  		}else{
		  			$this->lista['mensaje'] = 'ERROR: Fallo en la inserción. Ya existe la entrega'; 
					return $this->lista; 
		  		}
		  	}

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

    $sql = "SELECT  
					E.login,
    				E.IdTrabajo,
    				U.Nombre,
    				T.NombreTrabajo,
    				E.Alias,
    				E.Horas,
					E.Ruta
       			FROM ENTREGA E, TRABAJO T, USUARIO U
    			WHERE 
    				(
    				(E.login LIKE '%$this->login%') &&
    				(E.IdTrabajo LIKE '%$this->IdTrabajo%') &&
    				(E.Alias LIKE '%$this->Alias%') &&
    				(E.Horas LIKE '%$this->Horas%') &&
	 				(E.Ruta LIKE '%$this->Ruta%') &&
	 				(E.IdTrabajo = T.IdTrabajo) &&
	 				(E.login = U.login) &&
	 				(U.Nombre LIKE '%$this->Nombre%') &&
	 				(T.NombreTrabajo LIKE '%$this->NombreTrabajo%')
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
    $sql = "SELECT * FROM ENTREGA WHERE (login = '$this->login' AND IdTrabajo = '$this->IdTrabajo')"; //comprobar que no hay claves iguales

    // se ejecuta la query
    $result = $this->mysqli->query($sql);
    // si existe una tupla con ese valor de clave
    if ($result->num_rows == 1)
    {
    	// se construye la sentencia sql de borrado
        $sql = "DELETE FROM ENTREGA WHERE (login = '$this->login' AND IdTrabajo = '$this->IdTrabajo')";
        // se ejecuta la query
        $this->mysqli->query($sql);
        // se devuelve el mensaje de borrado correcto
        $this->lista['mensaje'] = 'Borrado correctamente'; 
			return $this->lista;
    } // si no existe el IdTrabajo a borrar se devuelve el mensaje de que no existe
    else{
    	 $this->lista['mensaje'] = 'ERROR: No existe la entrega que desea borrar en la BD'; 
			return $this->lista;
		}	
} // fin metodo DELETE

// funcion RellenaDatos()
// Esta función obtiene de la entidad de la bd todos los atributos a partir del valor de la clave que esta
// en el atributo de la clase
function RellenaDatos()
{	// se construye la sentencia de busqueda de la tupla
    $sql = "SELECT * FROM ENTREGA E, TRABAJO T
    				 WHERE (E.login = '$this->login' AND 
    				 		T.IdTrabajo = '$this->IdTrabajo' AND
    				 		E.IdTrabajo = '$this->IdTrabajo')";
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
		
		$this->login <> '' && 
		$this->IdTrabajo <> '' &&
		$this->Alias <> '' ){

		// se construye la sentencia de busqueda de la tupla en la bd
	    $sql = "SELECT * FROM ENTREGA WHERE (login = '$this->login' AND IdTrabajo = '$this->IdTrabajo')";
	    // se ejecuta la query
	    $result = $this->mysqli->query($sql);
	    $num_rows = mysqli_num_rows($result);
	    // si el numero de filas es igual a uno es que lo encuentra

	    if ($num_rows == 1)
	    {	// se construye la sentencia de modificacion en base a los atributos de la clase
			$sql = "UPDATE ENTREGA SET 
						login = '$this->login',
						IdTrabajo = '$this->IdTrabajo',
						Alias = '$this->Alias',
						Horas = '$this->Horas',
						Ruta = '$this->Ruta'
					WHERE (login = '$this->login' AND IdTrabajo = '$this->IdTrabajo')";
					
			// si hay un problema con la query se envia un mensaje de error en la modificacion
	        if (!($result = $this->mysqli->query($sql))){
	        		$this->lista['mensaje'] =  'ERROR: No se ha modificado'; 
					return $this->lista; 
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

	$sql = "SELECT * FROM ENTREGA E, TRABAJO T, USUARIO U
	WHERE (E.IdTrabajo=T.IdTrabajo AND U.login=E.login )
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

function SHOWALL_User($num_tupla,$max_tuplas){
	$login = $_SESSION['login'];
	$sql = "SELECT * 
			FROM USUARIO U, ENTREGA E, TRABAJO T
			WHERE  (U.login = '$login' AND
					E.login = U.login AND
					E.IdTrabajo = T.IdTrabajo
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
	$sql = "SELECT * FROM ENTREGA";

	$datos = $this->mysqli->query($sql);

    $total_tuplas = mysqli_num_rows($datos);

    return $total_tuplas;


}

function comprobarExistenciaUsuario(){

	$sql = "SELECT * FROM USUARIO WHERE ( login = '$this->login')";
	
//Si se produce un error en la consulta
  if (!($result = $this->mysqli->query($sql))){
    	return 'ERROR'; 
	}else{//si no se produce un error
		$num_rows = mysqli_num_rows($result);//cogemos el numero de tuplas que coinciden con la consulta
		if($num_rows == 1){ //si hay 1 tupla es que existe algun usuario
			return true; //existe el usuario
		}else{
			return false; //no existe el usuario
		}
	}
}


function comprobarExistenciaTrabajo(){
	

	$sql = "SELECT * FROM TRABAJO WHERE ( IdTrabajo = '$this->IdTrabajo')";

	//Si se produce un error en la consulta
  if (!($result = $this->mysqli->query($sql))){
    	return  'ERROR'; 
	}else{//si no se produce un error
		$num_rows = mysqli_num_rows($result);//cogemos el numero de tuplas que coinciden con la consulta
		if($num_rows == 1){//si hay 1 tupla es que existe algun trabajo
			return true; //existe el trabajo
		}else{ //no existe ningun trabajo
			return false;
		}
	}
}

function comprobarExistenciaEntrega(){

	$sql = "SELECT * FROM ENTREGA WHERE (login = '$this->login' AND IdTrabajo = '$this->IdTrabajo' )";
	//Si se produce un error en la consulta
  if (!($result = $this->mysqli->query($sql))){
    	return  'ERROR'; 
	}else{//si no se produce un error
		$num_rows = mysqli_num_rows($result);//cogemos el numero de tuplas que coinciden con la consulta
		if($num_rows > 0){ //si hay mas de 0 tuplas es que existe alguna entrega
			return true; //devolvemos que existe alguna entrega
		}else{ //si es 0
			return false; // no existe ninguna entrega
		}
	}
}

function comprobarExistenciaAlias(){

	$sql = "SELECT * FROM ENTREGA WHERE (Alias = '$this->Alias' AND IdTrabajo = '$this->IdTrabajo')";
	//Si se produce un error en la consulta
  if (!($result = $this->mysqli->query($sql))){
    	return  'ERROR'; 
	}else{//si no se produce un error
		$num_rows = mysqli_num_rows($result);//cogemos el numero de tuplas que coinciden con la consulta
		if($num_rows > 0){ //si hay mas de 0 tuplas es que existe alguna entrega
			return true; //devolvemos que existe alguna entrega
		}else{ //si es 0
			return false; // no existe ninguna entrega
		}
	}
}

function rellenarLista(){

	$existenciaNota = $this->comprobarExistenciaNota();
	if($existenciaNota == 1){
		$sql = "SELECT * FROM ENTREGA E, USUARIO U, TRABAJO T, NOTA_TRABAJO N 
						WHERE (U.login = '$this->login' AND
								T.IdTrabajo = '$this->IdTrabajo' AND
								E.login = '$this->login' AND E.IdTrabajo = '$this->IdTrabajo' AND
								N.login = '$this->login' AND N.IdTrabajo = '$this->IdTrabajo'
						)";
		if (!($result = $this->mysqli->query($sql))){
	    	//return  'ERROR'; 
		}else{
			$row = mysqli_fetch_array($result);
			$this->lista['Nombre'] = $row['Nombre'];
			$this->lista['NombreTrabajo'] = $row['NombreTrabajo'];
			$this->lista['NotaTrabajo'] = $row['NotaTrabajo'];
			$this->lista['Alias'] = $row['Alias'];
			$this->lista['Horas'] = $row['Horas'];
			$this->lista['Ruta'] = $row['Ruta'];
		}

	}else{
		$sql = "SELECT * FROM ENTREGA E, USUARIO U, TRABAJO T 
						WHERE (U.login = '$this->login' AND
								T.IdTrabajo = '$this->IdTrabajo' AND
								E.login = '$this->login' AND E.IdTrabajo = '$this->IdTrabajo')";

	if (!($result = $this->mysqli->query($sql))){
	    	//return  'ERROR'; 
		}else{
			$row = mysqli_fetch_array($result);
			$this->lista['Nombre'] = $row['Nombre'];
			$this->lista['NombreTrabajo'] = $row['NombreTrabajo'];
			$this->lista['NotaTrabajo'] ='';
			$this->lista['Alias'] = $row['Alias'];
			$this->lista['Horas'] = $row['Horas'];
			$this->lista['Ruta'] = $row['Ruta'];

		}

	}
	return $this->lista;
}

function comprobarExistenciaNota(){

	$sql = "SELECT * FROM ENTREGA E, USUARIO U, TRABAJO T, NOTA_TRABAJO N 
			WHERE (U.login = '$this->login' AND
					T.IdTrabajo = '$this->IdTrabajo' AND
					E.login = '$this->login' AND E.IdTrabajo = '$this->IdTrabajo' AND
					N.login = '$this->login' AND N.IdTrabajo = '$this->IdTrabajo'
							)";

		if (!($result = $this->mysqli->query($sql))){
		//return  'ERROR'; 
		}else{//si no se produce un error
		$num_rows = mysqli_num_rows($result);//cogemos 

		return $num_rows;
	}
}

//Funcion para generar alias
function generadorAlias() {
	$length = 6;

	//Realizamos la greneración de alias mientras no se encuentre un alias unico
	$sql ="SELECT * FROM ENTREGA WHERE (login = '$this->login' AND 
	 									IdTrabajo = '$this->IdTrabajo')";

 	
 	 $result = $this->mysqli->query($sql);
	$num_rows = mysqli_num_rows($result); //cogemos el numero de tuplas que coinciden con la consulta
		if($num_rows > 0){
			$row = mysqli_fetch_array($this->result);
			return $row['Alias'] ;
		}else{
			do{

			    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			    $caracteresLength = strlen($caracteres);
			    $randomString = '';
			    
			    for ($i = 0; $i < $length; $i++) {
			        $randomString .= $caracteres[rand(0, $caracteresLength - 1)];
			    }
			     $sql ="SELECT * FROM ENTREGA WHERE ( Alias = '$randomString')";
 	
 	 			$result = $this->mysqli->query($sql); //si no se produce un error
				$rows = mysqli_num_rows($result); 
			
		   }
		 while($rows > 0);
   		 return $randomString;
	} 
}

//devuelve el alias asociado a un login e idtrabajo
function obtenerAlias(){
	$sql = "SELECT DISTINCT E.AliasEvaluado 
						FROM EVALUACION E, ENTREGA A
						 	WHERE (E.AliasEvaluado = A.Alias AND A.login = '$this->login')";

	// si se produce un error en la busqueda mandamos el mensaje de error en la consulta
    if (!($resultado = $this->mysqli->query($sql))){
    	$this->lista['mensaje'] =  'ERROR: Fallo en la consulta sobre la base de datos'; 
		return $this->lista; 
	}
    else{ // si la busqueda es correcta devolvemos el recordset resultado
		return $resultado;
	}
}




}//Fin clase

?>