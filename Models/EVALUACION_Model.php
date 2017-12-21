
<?php
/*
//Clase : EVALUACION_Model.php
//Creado el : 25-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Modelo de datos de usuarios que accede a la Base de Datos

*/

class EVALUACION_Model { //declaración de la clase
	var $IdTrabajo; //atributo para almacenar el IdTrabajo de un trabajo
    var $LoginEvaluador; //atributo para almacenar el LoginEvaluador del evaluador
    var $AliasEvaluado; //atributo para almacenar el AliasEvaluado del usuario evaluado
    var $IdHistoria; //atributo para almacenar el IdHistoria de la historia en cuestion
    var $CorrectoA; //atributo para almacenar el valor Correcto del alumno evaluador
    var $ComenIncorrectoA; //atributo para almacenar el comentario incorrecto del alumno evaluador
    var $CorrectoP; //atributo para almacenar el valor Correcto del profesor
    var $ComentIncorrectoP; //atributo para almacenar el comentario incorrecto del profesor
    var $OK; //atributo para almacenar el resultado (1 - 0) de la evaluacion de la QA
	var $lista; // array para almacenar los datos del usuario
	var $listaIdHistoria;
	var $mysqli; // declaración del atributo manejador de la bd

//Constructor de la clase

function __construct($IdTrabajo, $LoginEvaluador, $AliasEvaluado, $IdHistoria, $CorrectoA, $ComenIncorrectoA, $CorrectoP, $ComentIncorrectoP, $OK){
	//asignación de valores de parámetro a los atributos de la clase
	$this->IdTrabajo = $IdTrabajo;
	$this->LoginEvaluador = $LoginEvaluador;
	$this->AliasEvaluado = $AliasEvaluado;
	$this->IdHistoria = $IdHistoria;
	$this->CorrectoA = $CorrectoA;
	$this->ComenIncorrectoA = $ComenIncorrectoA;
	$this->CorrectoP = $CorrectoP;
	$this->ComentIncorrectoP = $ComentIncorrectoP;
	$this->OK = $OK;


	// incluimos la funcion de acceso a la bd
	include_once '../Functions/Access_DB.php';
	// conectamos con la bd y guardamos el manejador en un atributo de la clase
	$this->mysqli = ConnectDB();

	//lista con los datos del usuario
	$this->lista = array(
			"IdTrabajo"=>$this->IdTrabajo,
			"LoginEvaluador"=>$this->LoginEvaluador,
			"AliasEvaluado"=>$this->AliasEvaluado,
			"IdHistoria"=>$this->IdHistoria,
			"CorrectoA" => '',
			"ComenIncorrectoA" => '',
			"CorrectoP" => '',
			"ComentIncorrectoP" => '',
			"OK" => '',
			"sql" => $this->mysqli, 
			"mensaje"=> '');
} // fin del constructor



//Metodo ADD()
//Inserta en la tabla  de la bd  los valores
// de los atributos del objeto. Comprueba si la clave/s esta vacia y si 
//existe ya en la tabla

function ADD()
{

    if (($this->LoginEvaluador <> '') && ($this->IdTrabajo <> '') && ($this->AliasEvaluado <> '') && ($this->IdHistoria <> '')){ // si los atributos clave no estan vacios

	  $existenciaU = $this->comprobarExistenciaUsuario();
	  $existenciaT = $this->comprobarExistenciaTrabajo();
	  $existenciaA = $this->comprobarExistenciaAlias();
	  $existenciaH = $this->comprobarExistenciaHistoria();

	  if( (is_string($existenciaU)) || (is_string($existenciaT) ) || (is_string($existenciaA)) || (is_string($existenciaH)) ) {
	  			$this->lista['mensaje'] = 'ERROR: No se ha podido conectar con la base de datos';
					return $this->lista; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el controlador manejara
	  }else{
		  if(  ($existenciaU == true) && ($existenciaT == true) && ($existenciaA == true) && ($existenciaH == true)){

				//construimos la sentencia sql de inserción en la bd
				$sql = "INSERT INTO EVALUACION(
				IdTrabajo,
				LoginEvaluador,
				AliasEvaluado,
				IdHistoria,
				CorrectoA,
				ComenIncorrectoA,
				CorrectoP,
				ComentIncorrectoP,
				OK) VALUES(
									'$this->IdTrabajo',
									'$this->LoginEvaluador',
									'$this->AliasEvaluado',
									'$this->IdHistoria',
									'$this->CorrectoA',
									'$this->ComenIncorrectoA',
									'$this->CorrectoP',
									'$this->ComentIncorrectoP',
									'$this->OK')";				

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
		  			if($existenciaA == false){
		  				$this->lista['mensaje'] = 'ERROR: El alias no existe'; 
						return $this->lista; 
		  			}else{
		  				if($existenciaH == false){
		  					$this->lista['mensaje'] = 'ERROR: La historia no existe'; 
							return $this->lista;
		  				}else{
		  					$this->lista['mensaje'] = 'ERROR: Fallo en la inserción. Ya existe la evaluacion'; 
							return $this->lista;
						}
					} 
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

    $sql = "SELECT DISTINCT
					E.IdTrabajo,
					T.NombreTrabajo,					
					E.LoginEvaluador,
					E.AliasEvaluado
							
       			FROM EVALUACION E, TRABAJO T, HISTORIA H
    			WHERE 
    				(
    				(E.IdTrabajo LIKE '%$this->IdTrabajo%') &&
    				(E.LoginEvaluador LIKE '%$this->LoginEvaluador%') &&
    				(E.AliasEvaluado LIKE '%$this->AliasEvaluado%') &&
    				(E.IdHistoria LIKE '%$this->IdHistoria%') &&
    				(E.CorrectoA LIKE '%$this->CorrectoA%') &&
    				(E.ComenIncorrectoA LIKE '%$this->ComenIncorrectoA%') &&
    				(E.CorrectoP LIKE '%$this->CorrectoP%') &&
    				(E.ComentIncorrectoP LIKE '%$this->ComentIncorrectoP%') &&
	 				(E.OK LIKE '%$this->OK%') &&
	 				(E.IdTrabajo = T.IdTrabajo) &&
	 				(E.IdTrabajo = H.IdTrabajo) &&
	 				(E.IdHistoria = H.IdHistoria)
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
    $sql = "SELECT * FROM EVALUACION WHERE (IdTrabajo = '$this->IdTrabajo' AND AliasEvaluado = '$this->AliasEvaluado')"; //comprobar que no hay claves iguales

    // se ejecuta la query
    $resultado = $this->mysqli->query($sql);
    $num_rows = mysqli_num_rows($resultado);
    // si existe una tupla con ese valor de clave
    if ($num_rows > 0)
    {

    	 $sql = "SELECT * FROM USUARIO WHERE (Alias = '$this->AliasEvaluado')";
      	if($resultado =  $this->mysqli->query($sql)){
	    	$row = mysqli_fetch_array($resultado);
	       	$login = $row['login'];

    	  $sql = "SELECT * FROM NOTA_TRABAJO WHERE (login = '$login')";
       	if($resultado = $this->mysqli->query($sql)){
       		// se construye la sentencia sql de borrado
	        $sql = "DELETE FROM NOTA_TRABAJO WHERE (login = '$login')";
	        // se ejecuta la query
	        $result = $this->mysqli->query($sql);
    	}
   	}

    	// se construye la sentencia sql de borrado
        $sql = "DELETE FROM EVALUACION WHERE (IdTrabajo = '$this->IdTrabajo' AND AliasEvaluado = '$this->AliasEvaluado')";
        // se ejecuta la query
        $resultado = $this->mysqli->query($sql);
        // se devuelve el mensaje de borrado correcto
        $this->lista['mensaje'] = 'Borrado correctamente'; 
			return $this->lista;
    } // si no existe el IdTrabajo a borrar se devuelve el mensaje de que no existe
    else{
    	 $this->lista['mensaje'] = 'ERROR: No existe la evaluacion que desea borrar en la BD'; 
			return $this->lista;
		}	
} // fin metodo DELETE

// funcion RellenaDatos()
// Esta función obtiene de la entidad de la bd todos los atributos a partir del valor de la clave que esta
// en el atributo de la clase
function RellenaDatos()
{	// se construye la sentencia de busqueda de la tupla
    $sql = "SELECT * FROM EVALUACION E, ASIGNAC_QA A, TRABAJO T, HISTORIA H WHERE (E.IdTrabajo = '$this->IdTrabajo') AND (E.LoginEvaluador = '$this->LoginEvaluador') AND (E.AliasEvaluado = '$this->AliasEvaluado') AND (E.IdHistoria = '$this->IdHistoria') AND (E.IdTrabajo = T.IdTrabajo) AND (E.LoginEvaluador = A.LoginEvaluador) AND (E.AliasEvaluado = A.AliasEvaluado) AND (E.IdHistoria = H.IdHistoria)";
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
		 
		$this->IdTrabajo <> '' &&
		$this->LoginEvaluador <> '' &&
		$this->AliasEvaluado <> '' &&
		$this->IdHistoria <> '' ){

		// se construye la sentencia de busqueda de la tupla en la bd
	    $sql = "SELECT * FROM EVALUACION WHERE (IdTrabajo = '$this->IdTrabajo' AND LoginEvaluador = '$this->LoginEvaluador' AND AliasEvaluado = '$this->AliasEvaluado' AND IdHistoria = '$this->IdHistoria' )";
	    // se ejecuta la query
	    $result = $this->mysqli->query($sql);
	    $num_rows = mysqli_num_rows($result);
	    // si el numero de filas es igual a uno es que lo encuentra

	    if ($num_rows == 1)
	    {	// se construye la sentencia de modificacion en base a los atributos de la clase
			if(($this->CorrectoP <> '') && ($this->ComentIncorrectoP <> '') && ($this->OK <> '')){

				$sql = "UPDATE EVALUACION SET 
							IdTrabajo = '$this->IdTrabajo',
							LoginEvaluador = '$this->LoginEvaluador',
							AliasEvaluado = '$this->AliasEvaluado',
							IdHistoria = '$this->IdHistoria',
							CorrectoA = '$this->CorrectoA',
							ComenIncorrectoA = '$this->ComenIncorrectoA',
							CorrectoP = '$this->CorrectoP',
							ComentIncorrectoP = '$this->ComentIncorrectoP',
							OK = '$this->OK'
						WHERE (IdTrabajo = '$this->IdTrabajo' AND LoginEvaluador = '$this->LoginEvaluador' AND AliasEvaluado = '$this->AliasEvaluado' AND IdHistoria = '$this->IdHistoria')";
			}else{

				$sql = "UPDATE EVALUACION SET 
							IdTrabajo = '$this->IdTrabajo',
							LoginEvaluador = '$this->LoginEvaluador',
							AliasEvaluado = '$this->AliasEvaluado',
							IdHistoria = '$this->IdHistoria',
							CorrectoA = '$this->CorrectoA',
							ComenIncorrectoA = '$this->ComenIncorrectoA'
						WHERE (IdTrabajo = '$this->IdTrabajo' AND LoginEvaluador = '$this->LoginEvaluador' AND AliasEvaluado = '$this->AliasEvaluado' AND IdHistoria = '$this->IdHistoria')";
			}			
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

	$sql = "SELECT DISTINCT E.IdTrabajo, T.NombreTrabajo, E.LoginEvaluador, E.AliasEvaluado
					 FROM EVALUACION E, TRABAJO T, HISTORIA H
						WHERE (E.IdTrabajo=T.IdTrabajo AND E.IdTrabajo=H.IdTrabajo AND H.IdHistoria=E.IdHistoria )
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

	$sql = "SELECT Alias FROM ENTREGA WHERE login = '$login'";

	$resultado = $this->mysqli->query($sql);
	$row = mysqli_fetch_array($resultado);
	$alias = $row['Alias'];

	$sql = "SELECT DISTINCT E.IdTrabajo, T.NombreTrabajo, E.LoginEvaluador, E.AliasEvaluado
					 FROM EVALUACION E, TRABAJO T, HISTORIA H
						WHERE (E.IdTrabajo=T.IdTrabajo AND E.IdTrabajo=H.IdTrabajo AND H.IdHistoria=E.IdHistoria AND  E.LoginEvaluador = '$login'   )
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
	$sql = "SELECT * FROM EVALUACION";

	$datos = $this->mysqli->query($sql);

    $total_tuplas = mysqli_num_rows($datos);

    return $total_tuplas;


}

function comprobarExistenciaUsuario(){

	$sql = "SELECT * FROM USUARIO WHERE ( login = '$this->LoginEvaluador')";
	
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

function comprobarExistenciaAlias(){

	$sql = "SELECT * FROM ENTREGA WHERE (Alias = '$this->AliasEvaluado' AND IdTrabajo = '$this->IdTrabajo')";
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

function comprobarExistenciaHistoria(){

	$sql = "SELECT * FROM HISTORIA WHERE (
        							(IdTrabajo = '$this->IdTrabajo') AND 
        							(IdHistoria = '$this->IdHistoria'))"; //comprobar que existe la historia en el trabajo
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

//Rellenamos la lista con los datos de la entidad
function rellenarListaIdHistoria(){

	$sql = "SELECT  E.IdHistoria, E.IdTrabajo, T.NombreTrabajo, E.LoginEvaluador, E.AliasEvaluado, E.CorrectoA, E.ComenIncorrectoA, E.CorrectoP, E.ComentIncorrectoP, E.OK FROM EVALUACION E, TRABAJO T, HISTORIA H  
						WHERE (
								E.IdTrabajo = '$this->IdTrabajo' AND	
								E.LoginEvaluador = '$this->LoginEvaluador' AND
								E.AliasEvaluado = '$this->AliasEvaluado' AND 
								E.IdHistoria = '$this->IdHistoria'

							)";

	if (!($result = $this->mysqli->query($sql))){
	    	$this->lista['mensaje'] =  'ERROR: No existe en la base de datos'; 
	    	return $this->lista;
		}else{
			$row = mysqli_fetch_array($result);
			$this->listaIdHistoria['IdTrabajo'] = $row['IdTrabajo'];
			$this->listaIdHistoria['LoginEvaluador'] = $row['LoginEvaluador'];
			$this->listaIdHistoria['AliasEvaluado'] = $row['AliasEvaluado'];
			$this->listaIdHistoria['IdHistoria'] = $row['IdHistoria'];
			$this->listaIdHistoria['CorrectoA'] = $row['CorrectoA'];
			$this->listaIdHistoria['ComenIncorrectoA'] = $row['ComenIncorrectoA'];
			$this->listaIdHistoria['CorrectoP'] = $row['CorrectoP'];
			$this->listaIdHistoria['ComentIncorrectoP'] = $row['ComentIncorrectoP'];
			$this->listaIdHistoria['OK'] = $row['OK'];

			return $this->listaIdHistoria;
		}

	
}


//Rellenamos la lista con los datos de la entidad
function rellenarLista(){

	$sql = "SELECT * FROM EVALUACION E, TRABAJO T, HISTORIA H  
						WHERE (
								E.IdTrabajo = '$this->IdTrabajo' AND	
								E.LoginEvaluador = '$this->LoginEvaluador' AND
								E.AliasEvaluado = '$this->AliasEvaluado' 

							)";

	if (!($result = $this->mysqli->query($sql))){
	    	$this->lista['mensaje'] =  'ERROR: No existe en la base de datos'; 
	    	return $this->lista;
		}else{
			$row = mysqli_fetch_array($result);
			$this->lista['IdTrabajo'] = $row['IdTrabajo'];
			$this->lista['LoginEvaluador'] = $row['LoginEvaluador'];
			$this->lista['AliasEvaluado'] = $row['AliasEvaluado'];
			$this->lista['IdHistoria'] = $row['IdHistoria'];
			$this->lista['CorrectoA'] = $row['CorrectoA'];
			$this->lista['ComenIncorrectoA'] = $row['ComenIncorrectoA'];
			$this->lista['CorrectoP'] = $row['CorrectoP'];
			$this->lista['ComentIncorrectoP'] = $row['ComentIncorrectoP'];
			$this->lista['OK'] = $row['OK'];

			return $this->lista;
		}

	
}

//Nos devuelve un recordset con todas las historias de una evaluacion
function listarHistorias(){

	$sql = "SELECT E.IdHistoria, H.TextoHistoria, E.LoginEvaluador, E.ComenIncorrectoA, E.CorrectoA, E.ComentIncorrectoP, E.CorrectoP, E.OK FROM EVALUACION E, TRABAJO T, HISTORIA H
						 WHERE (
						 		
						 		E.IdTrabajo = '$this->IdTrabajo' AND
						 		E.IdTrabajo = T.IdTrabajo AND
						 		E.IdTrabajo = H.IdTrabajo AND 
						 		E.IdHistoria = H.IdHistoria
															) ORDER BY 1"; 
	    // si se produce un error en la busqueda mandamos el mensaje de error en la consulta

    if (!($resultado = $this->mysqli->query($sql))){
    	$this->lista['mensaje'] =  'ERROR: Fallo en la consulta sobre la base de datos'; 
		return $this->lista; 
	}
    else{ // si la busqueda es correcta devolvemos el recordset resultado
		return $resultado;
	}
}



//Nos devuelve un recordset con todas las historias de una evaluacion
function listarHistoriasCalificar(){

	$sql = "SELECT E.IdHistoria, H.TextoHistoria, E.LoginEvaluador, E.ComenIncorrectoA, E.CorrectoA, E.ComentIncorrectoP, E.CorrectoP, E.OK FROM EVALUACION E, TRABAJO T, HISTORIA H
						 WHERE (
						 		
						 		E.IdTrabajo = '$this->IdTrabajo' AND
						 		E.IdTrabajo = T.IdTrabajo AND
						 		E.IdTrabajo = H.IdTrabajo AND 
						 		E.IdHistoria = H.IdHistoria AND
						 		E.AliasEvaluado = '$this->AliasEvaluado'
															)  ORDER BY 1"; 

			
	    // si se produce un error en la busqueda mandamos el mensaje de error en la consulta

    if (!($resultado = $this->mysqli->query($sql))){
    	$this->lista['mensaje'] =  'ERROR: Fallo en la consulta sobre la base de datos'; 
		return $this->lista; 
	}
    else{ // si la busqueda es correcta devolvemos el recordset resultado
		return $resultado;
	}
}

//Nos devuelve un recordset con todas las historias de una evaluacion
function listarHistoriasSHOWCURRENT(){

	$sql = "SELECT E.IdHistoria, H.TextoHistoria, E.LoginEvaluador, E.ComenIncorrectoA, E.CorrectoA, E.ComentIncorrectoP, E.CorrectoP, E.OK FROM EVALUACION E, TRABAJO T, HISTORIA H
						 WHERE (
						 		
						 		E.IdTrabajo = '$this->IdTrabajo' AND
						 		E.IdTrabajo = T.IdTrabajo AND
						 		E.IdTrabajo = H.IdTrabajo AND 
						 		E.IdHistoria = H.IdHistoria AND
						 		E.AliasEvaluado = '$this->AliasEvaluado' AND
						 		E.LoginEvaluador = '$this->LoginEvaluador'

															)  ORDER BY 1"; 

			
	    // si se produce un error en la busqueda mandamos el mensaje de error en la consulta

    if (!($resultado = $this->mysqli->query($sql))){
    	$this->lista['mensaje'] =  'ERROR: Fallo en la consulta sobre la base de datos'; 
		return $this->lista; 
	}
    else{ // si la busqueda es correcta devolvemos el recordset resultado
		return $resultado;
	}
}

//Nos devuelve un recordset con todas las historias de una evaluacion
function rellenarHistorias(){
	$lista = null;
	$sql = "SELECT DISTINCT E.IdHistoria, H.TextoHistoria FROM EVALUACION E, TRABAJO T, HISTORIA H
						 WHERE (
						 		
						 		E.IdTrabajo = '$this->IdTrabajo' AND
						 		E.IdTrabajo = T.IdTrabajo AND
						 		E.IdTrabajo = H.IdTrabajo AND 
						 		E.IdHistoria = H.IdHistoria
															) ORDER BY 1"; 
			
	    // si se produce un error en la busqueda mandamos el mensaje de error en la consulta
		$resultado = $this->mysqli->query($sql);
		$num=0;
		while ($row = mysqli_fetch_array($resultado)) {
			$lista[$num] = array($row['IdHistoria'], $row['TextoHistoria']);
			$num++;
		}
		return $lista;
		    
    

}


//Nos devuelve un recordset con todos los comentarios, correctoA de todas las evaluaciones
function listarComentarios(){

	$sql = "SELECT E.CorrectoA, E.ComenIncorrectoA FROM EVALUACION E, TRABAJO T, HISTORIA H, ASIGNAC_QA A
						 WHERE (
						 		E.IdTrabajo = '$this->IdTrabajo' AND
						 		E.IdTrabajo = T.IdTrabajo AND
						 		E.IdTrabajo = H.IdTrabajo AND 
						 		E.IdTrabajo = A.IdTrabajo AND
						 		E.AliasEvaluado = '$this->AliasEvaluado' AND
						 		E.AliasEvaluado = A.AliasEvaluado AND
						 		E.IdHistoria = H.IdHistoria
															)"; 
	    // si se produce un error en la busqueda mandamos el mensaje de error en la consulta

    if (!($resultado = $this->mysqli->query($sql))){
    	$this->lista['mensaje'] =  'ERROR: Fallo en la consulta sobre la base de datos'; 
		return $this->lista; 
	}
    else{ // si la busqueda es correcta devolvemos el recordset resultado
		return $resultado;
	}
}


//Obtiene una tupla de EVALUACION para calificar
function listarEvaluadores(){

	$sql = "SELECT * FROM EVALUACION E, ASIGNAC_QA A
					WHERE (
							A.AliasEvaluado = '$this->AliasEvaluado' AND
							A.LoginEvaluador = E.LoginEvaluador AND
							A.IdTrabajo = T.IdTrabajo 


										)";

	$result = $this->mysqli->query($sql);
	$num_rows = mysqli_num_rows($result);

	if($num_rows > 0){
		$num = 0;
		while($row=mysqli_fetch_array($result)){
			$lista[$num] = array ($row["LoginEvaluador"] = array ($row["ComenIncorrectoA"], $row["CorrectoA"], $row["ComentIncorrectoP"], $row["CorrectoP"], $row["OK"]));
		}
	}
}

//cuenta el numero de logins que evaluan una entrega
function contar(){
	$aux = 0;
	$sql = "SELECT COUNT(*) 
					FROM ASIGNAC_QA
							WHERE IdTrabajo = '$this->IdTrabajo'
								GROUP BY LoginEvaluador";

	$result = $this->mysqli->query($sql);
	
	$row=mysqli_fetch_array($result);
	$aux= $row['COUNT(*)'];
	

	return $aux;
	

}

//cuenta el numero de historias de trabajo
function contarHistorias(){
	$aux = 0;
	$sql = "SELECT COUNT(*) 
					FROM EVALUACION
							WHERE IdTrabajo = '$this->IdTrabajo' AND 
									AliasEvaluado = '$this->AliasEvaluado'
								GROUP BY LoginEvaluador";

	$result = $this->mysqli->query($sql);
	
	$row=mysqli_fetch_array($result);
	$aux= $row['COUNT(*)'];
	

	return $aux;
	

}

//rellena las QAs realizadas sobre un trabajo
function listaEntregasQA(){
	$sql = "SELECT * FROM EVALUACION WHERE (LoginEvaluador = '$this->login' AND IdTrabajo = '$this->IdTrabajo') 
						ORDER BY AliasEvaluado, IdHistoria";

	$resultado = $this->mysqli->query($sql);
	$num = 0;
	while($row = mysqli_fetch_array($resultado)){
		$this->lista[$num] = array($row['AliasEvaluado'] );
	}
}

}//Fin clase

?>