
<?php
/*
//Clase : USUARIOS_Model.php
//Creado el : 27-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Modelo de datos de usuarios que accede a la Base de Datos
*/
class ASIGNAC_QA_Model { //declaración de la clase

	var $IdTrabajo; //declaración del atributo IdTrabajo de la accion
    var $NombreTrabajo; //declaración del atributo NombreTrabajo de la accion
    var $LoginEvaluador; //declaración del atributo LoginEvaluador
    var $LoginEvaluado; //declaración del atributo LoginEvaluado
    var $AliasEvaluado; //declaración del atributo AliasEvaluado

    var $lista; // array para almacenar los datos del usuario
	var $mysqli; // declaración del atributo manejador de la bd

	var $numEntregas; //almacenar las QAs a realizar por entrega

//Constructor de la clase

function __construct($IdTrabajo,$NombreTrabajo,$LoginEvaluador, $LoginEvaluado, $AliasEvaluado){
	//asignación de valores de parámetro a los atributos de la clase
	$this->IdTrabajo = $IdTrabajo;
	$this->NombreTrabajo = $NombreTrabajo;
	$this->LoginEvaluador = $LoginEvaluador;
	$this->LoginEvaluado = $LoginEvaluado;
	$this->AliasEvaluado = $AliasEvaluado;

	// incluimos la funcion de acceso a la bd
	include_once '../Functions/Access_DB.php';
	// conectamos con la bd y guardamos el manejador en un atributo de la clase
	$this->mysqli = ConnectDB();

	//lista con los datos del usuario
	$this->lista = array(
			"IdTrabajo"=>$this->IdTrabajo,
			"NombreTrabajo"=>$this->NombreTrabajo,
			"LoginEvaluador"=>$this->LoginEvaluador,
			"LoginEvaluado"=>$this->LoginEvaluado,
			"AliasEvaluado"=>$this->AliasEvaluado,
			"sql" => $this->mysqli, 
			"mensaje"=> '');
} // fin del constructor



function ADD(){

	if (($this->IdTrabajo <> '') && ($this->LoginEvaluador <> '') && ($this->AliasEvaluado <> '')){ // si el atributo clave de la entidad no esta vacio
		$sql = "SELECT * FROM ENTREGA WHERE (IdTrabajo = '$this->IdTrabajo') AND (Alias = '$this->AliasEvaluado')";
		if (!$result = $this->mysqli->query($sql)){ // si da error la ejecución de la query
			$this->lista['mensaje'] = 'ERROR: No se ha podido conectar con la base de datos';
			return $this->lista; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el controlador manejara

		}
		else{ // si la ejecución de la query no da error
			$num_rows = mysqli_num_rows($result);

			if ($num_rows == 0){ // miramos si el resultado de la consulta es vacio (no existe el AliasEvaluado)
				$this->lista['mensaje'] = 'ERROR: No existe esa entrega para evaluar.';
				return $this->lista; // error en la consulta (no existe el login). Devolvemos un mensaje que el controlador manejara	
			}
		    else{//Si existe la entrega comprobamos si existe el usuario al que se le asignará la QA

		    	$sql = "SELECT * FROM USUARIO WHERE (login = '$this->LoginEvaluador')";
		    	if (!$result = $this->mysqli->query($sql)){ // si da error la ejecución de la query
					$this->lista['mensaje'] = 'ERROR: No se ha podido conectar con la base de datos';
					return $this->lista; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el controlador manejara

				}
				else{ // si la ejecución de la query no da error
					$num_rows = mysqli_num_rows($result);

					if ($num_rows == 0){ // miramos si el resultado de la consulta es vacio (no existe el LoginEvaluador)
						$this->lista['mensaje'] = 'ERROR: No existe el usuario con LoginEvaluador';
						return $this->lista; // error en la consulta (no existe el login). Devolvemos un mensaje que el controlador manejara	
					}
		    		else{

						// construimos el sql para buscar esa clave en la tabla
		        		$sql = "SELECT * FROM ASIGNAC_QA WHERE (IdTrabajo = '$this->IdTrabajo') AND (LoginEvaluador = '$this->LoginEvaluador') AND (AliasEvaluado = '$this->AliasEvaluado')"; //comprobar que no hay claves iguales

						if (!$result = $this->mysqli->query($sql)){ // si da error la ejecución de la query
							$this->lista['mensaje'] = 'ERROR: No se ha podido conectar con la base de datos';
							return $this->lista; // error en la consulta (no se ha podido conectar con la bd). Devolvemos un mensaje que el controlador manejara

						}
						else { // si la ejecución de la query no da error

							$num_rows = mysqli_num_rows($result);

							if ($num_rows == 0){ // miramos si el resultado de la consulta es vacio (no existe la asignación de QA)
								$this->LoginEvaluado = $this->devolverLoginEvaluado();

								//construimos la sentencia sql de inserción en la bd
								$sql = "INSERT INTO ASIGNAC_QA(
										IdTrabajo,
										LoginEvaluador,
										LoginEvaluado,
										AliasEvaluado) VALUES(
															'$this->IdTrabajo',
															'$this->LoginEvaluador',
															'$this->LoginEvaluado',
															'$this->AliasEvaluado')";
				
							if (!($result = $this->mysqli->query($sql))){ //si da error la consulta se comrpueba el por que

								//Si no hay atributos Clave y unique duplicados es que hay campos sin completar
						       	return 'ERROR: Introduzca todos los valores de todos los campos'; // introduzca un valor para el usuario
							}

						    else{ //si no da error en la insercion devolvemos mensaje de exito
								$this->lista['mensaje'] = 'Inserción realizada con éxito';
								return $this->lista; //operacion de insertado correcta
							}

							}
							else{ //si hay un login igua
							    $this->lista['mensaje'] = 'ERROR: Fallo en la inserción. Ya existe esa asignación de QA'; 
								return $this->lista; 
							}
						}	 
					}
		    	}
		    }	
		}    	
	}
	else{
		//Si alguno de los atributos clave es vacío
			return 'ERROR: Introduzca todos los valores de todos los campos'; // introduzca valores para los campos vacíos
	}	

}// fin del metodo ADD

//funcion de destrucción del objeto: se ejecuta automaticamente
//al finalizar el script
function __destruct()
{

} // fin del metodo destruct


//funcion SEARCH: hace una búsqueda en la tabla con
//los datos proporcionados. Si van vacios devuelve todos
function SEARCH()
{ 	// construimos la sentencia de busqueda con LIKE y los atributos de la entidad
    $sql = "SELECT  A.IdTrabajo,
    				NombreTrabajo,
    				LoginEvaluador,
    				LoginEvaluado,
    				AliasEvaluado
       			FROM ASIGNAC_QA A, TRABAJO T
    			WHERE 
    				(
    				(A.IdTrabajo = T.IdTrabajo) &&
    				(A.IdTrabajo LIKE '%$this->IdTrabajo%') &&
    				(NombreTrabajo LIKE '%$this->NombreTrabajo%') &&
    				(LoginEvaluador LIKE '%$this->LoginEvaluador%') &&
    				(LoginEvaluado LIKE '%$this->LoginEvaluado%') &&
    				(AliasEvaluado LIKE '%$this->AliasEvaluado%')
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
    $sql = "SELECT * FROM ASIGNAC_QA WHERE (IdTrabajo = '$this->IdTrabajo') AND (LoginEvaluador = '$this->LoginEvaluador') AND (AliasEvaluado = '$this->AliasEvaluado')";
    // se ejecuta la query
    $result = $this->mysqli->query($sql);
    // si existe una tupla con ese valor de clave
    if ($result->num_rows == 1)
    {
    	// se construye la sentencia sql de borrado
        $sql = "DELETE FROM ASIGNAC_QA WHERE (IdTrabajo = '$this->IdTrabajo') AND (LoginEvaluador = '$this->LoginEvaluador') AND (AliasEvaluado = '$this->AliasEvaluado')";
        // se ejecuta la query
        $this->mysqli->query($sql);
        // se devuelve el mensaje de borrado correcto
        $this->lista['mensaje'] = 'Borrado correctamente'; 
			return $this->lista;
    } // si no existe el login a borrar se devuelve el mensaje de que no existe
    else{
    	 $this->lista['mensaje'] = 'ERROR: No existe la asignación de QA que desea borrar en la BD'; 
			return $this->lista;
		}	
} // fin metodo DELETE

// funcion RellenaDatos()
// Esta función obtiene de la entidad de la bd todos los atributos a partir del valor de la clave que esta
// en el atributo de la clase
function RellenaDatos()
{	// se construye la sentencia de busqueda de la tupla
    $sql = "SELECT * FROM ASIGNAC_QA A, TRABAJO T WHERE (A.IdTrabajo = '$this->IdTrabajo') AND (LoginEvaluador = '$this->LoginEvaluador') AND (AliasEvaluado = '$this->AliasEvaluado') AND (A.IdTrabajo = T.IdTrabajo)";
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
	if(	$this->IdTrabajo <> '' &&
		$this->LoginEvaluador <> '' &&
		$this->AliasEvaluado <> '' &&
		$this->LoginEvaluado <> '' ){

		// se construye la sentencia de busqueda de la tupla en la bd
	    $sql = "SELECT * FROM ASIGNAC_QA WHERE (IdTrabajo = '$this->IdTrabajo') AND
											   (LoginEvaluador = '$this->IdTrabajo') AND
											   (AliasEvaluado = '$this->AliasEvaluado')";
	    // se ejecuta la query
	    $result = $this->mysqli->query($sql);
	    $num_rows = mysqli_num_rows($result);
	    // si el numero de filas es igual a uno es que lo encuentra

	    if ($num_rows == 1)
	    {	// se construye la sentencia de modificacion en base a los atributos de la clase
			$sql = "UPDATE ASIGNAC_QA SET 
						IdTrabajo = '$this->IdTrabajo',
						LoginEvaluador = '$this->LoginEvaluador',
						LoginEvaluado = '$this->LoginEvaluado',
						AliasEvaluado = '$this->AliasEvaluado'
						
					WHERE (IdTrabajo = '$this->IdTrabajo') AND
							(LoginEvaluador = '$this->IdTrabajo') AND
							(AliasEvaluado = '$this->AliasEvaluado')";
					
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

	$sql = "SELECT * FROM ASIGNAC_QA A, TRABAJO T 
				WHERE (T.IdTrabajo = A.IdTrabajo)
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
	$sql = "SELECT * FROM ASIGNAC_QA";

	$datos = $this->mysqli->query($sql);

    $total_tuplas = mysqli_num_rows($datos);

    return $total_tuplas;
}

function devolverLoginEvaluado(){

	$sql = "SELECT * FROM ENTREGA WHERE Alias = '$this->AliasEvaluado'";

    // si se produce un error en la busqueda mandamos el mensaje de error en la consulta
    if (!($resultado = $this->mysqli->query($sql))){
    	$this->lista['mensaje'] =  'ERROR: Fallo en la consulta sobre la base de datos'; 
		return $this->lista; 
	}
    else{ // si la busqueda es correcta devolvemos el recordset resultado
    	$result = $resultado->fetch_array();
		return $result['login'];
	}
	}	

//Función con la cual a partir de un IdTrabajo dado, para todas los usuarios que hayan subido una entrega de ese trabajo se le asginan otras cinco para QA
function asig_QAS($IdTrabajo, $numEntregas){

	//Comprobamos si ya se ha realizado la generación automática de evaluaciones
	$sql_cmp_reset = "SELECT * FROM ASIGNAC_QA WHERE IdTrabajo = '$IdTrabajo'";
	$cmp_reset = $this->mysqli->query($sql_cmp_reset);
	$num_cmp_reset = mysqli_num_rows($cmp_reset);

	if($num_cmp_reset > 0){
			$sql_reset = "DELETE FROM ASIGNAC_QA WHERE IdTrabajo = '$IdTrabajo'";
			$cmp_reset = $this->mysqli->query($sql_reset);
	}

	$sql = "SELECT * FROM TRABAJO WHERE IdTrabajo = '$IdTrabajo'";

	$result = $this->mysqli->query($sql);
	$num_rows = mysqli_num_rows($result);

	if($num_rows > 0){

		//Selecciona todas las entregas del IdTrabajo
		$sql = "SELECT * FROM ENTREGA WHERE IdTrabajo = '$IdTrabajo'"; 


		// si se produce un error en la busqueda mandamos el mensaje de error en la consulta
	    if (!($resultado = $this->mysqli->query($sql))){
	    	$this->lista['mensaje'] =  'ERROR: Fallo en la consulta sobre la base de datos'; 
			return $this->lista; 
		}
	    else{ // si la busqueda es correcta devolvemos el recordset resultado
	    	
	    	$num_rows = mysqli_num_rows($resultado);
	    	if($numEntregas < $num_rows){

		    	$lista; //Matriz que contendrá todas las entregas de un trabajo con los atributos necesarios para la ASIG_QA
		    	$num = 0; //Índice del array
		    	$posiciones = $numEntregas; //Número de QA a corregir por cada alumno
		    	while ($row = mysqli_fetch_array($resultado)) { //Copiamos el recordset en lista
		    		$lista[$num] = array($row['IdTrabajo'],$row['login'],$row['Alias']);
		    		$num++;
		    	}

		    	$cont_exito = 0; //Cuenta las inserciones realizadas con éxito

		    	for ($i = 0; $i < sizeof($lista); $i++) {//Para cada alumno que entregó un trabajo con IdTrabajo
					
					$LoginEvaluador = $lista[$i][1]; //Cogemos el login al que se le asignarán las QAs 
					$aux = $i;	//Comenzamos a recorrer la lista por la posición de esa entrega	

					$cont = 0;
					$rep = 0;

					while($cont < $posiciones){ //Tantas veces como QAs se le vayan a asignar
			   			
			   		$aux += $posiciones; //Sumamos a la posición actual tantos posiciones como indique $posiciones

			   			if($aux > sizeof($lista)-1){ //Si el índice supera el número máximo de entregas volvemos a empezar por el comienzo de la lista
			   				$aux =$aux - sizeof($lista);
			   			}
			   			

			   			$AliasEvaluado = $lista[$aux][2]; //Guardamos el alias de la Qa
			   			$LoginEvaluado = $lista[$aux][1]; //Guardamos el login de la Qa
			   			//Comprobamos si ya existe esa entrega previamente
			   			$sql = "SELECT * FROM ASIGNAC_QA WHERE IdTrabajo = '$IdTrabajo' AND 
			   												LoginEvaluador = '$LoginEvaluador' AND
			   												AliasEvaluado = '$AliasEvaluado'";	
			   			if ($result = $this->mysqli->query($sql)) {
			   				$num_rows = mysqli_num_rows($result);}
			   			else {$num_rows = 0;}

			   			if(($num_rows > 0) || ($LoginEvaluador === $LoginEvaluado)){
		   						$aux++;
						}
						else{
									
				   			$sql = "INSERT INTO ASIGNAC_QA(
													IdTrabajo,
													LoginEvaluador,
													LoginEvaluado,
													AliasEvaluado) VALUES(
																		'$IdTrabajo',
																		'$LoginEvaluador',
																		'$LoginEvaluado',
																		'$AliasEvaluado')";	

							if ($result = $this->mysqli->query($sql)){
								$cont_exito++;	
								$cont++;
							}
						}	
		   			}
				}

				$sql = "SELECT * FROM ASIGNAC_QA WHERE IdTrabajo = '$IdTrabajo'";
				$result = $this->mysqli->query($sql);
				$num_rows = mysqli_num_rows($result);
				if($num_rows == $cont_exito){
					$this->lista['mensaje'] =  'Asignación automática de QAs realizada correctamente'; 
					return $this->lista; 
				}
				else{
					$this->lista['mensaje'] =  'ERROR: La Asignación automática de QAs no ha sido realizada correctamente'; 
					return $this->lista; 
				}

			}
			else{
				$this->lista['mensaje'] =  'ERROR: El número de entregas no es suficiente para realizar la asignacion de QA'; 
				return $this->lista; 
			}
		}
	}
	else{
		$this->lista['mensaje'] =  'ERROR: No existe ningún trabajo con ese IdTrabajo'; 
		return $this->lista;
	}
}

//Función para calcular el múmero de entregas de un trabajo
function numEntregasTrabajo($IdTrabajo){
	$sql = "SELECT * FROM ENTREGAS WHERE IdTrabajo = '$IdTrabajo'";
	$result = $this->mysqli->query($sql);
	if($num_rows > 0){	
		$num_rows = mysqli_num_rows($result); 
		return $num_rows;
	}
	else{
		return 0;
	}
}

//Función para la generción automática de historias de usuario a evaluar en EVALUACIÓN
function historiasEvaluación($IdTrabajo){

	//Comprobamos que se hayan generado primero las asignaciones de qas para ese trabajo
	$sql_cmp_asig = "SELECT * FROM ASIGNAC_QA WHERE IdTrabajo = '$IdTrabajo'";
	$cmp_asig = $this->mysqli->query($sql_cmp_asig);
	$num_cmp_asig = mysqli_num_rows($cmp_asig);

	if($num_cmp_asig > 0){
	

		//Comprobamos si ya se ha realizado la generación automática de evaluaciones
		$sql_cmp_reset = "SELECT * FROM EVALUACION WHERE IdTrabajo = '$IdTrabajo'";
		$cmp_reset = $this->mysqli->query($sql_cmp_reset);
		$num_cmp_reset = mysqli_num_rows($cmp_reset);
		if($num_cmp_reset > 0){
			$sql_reset = "DELETE FROM EVALUACION WHERE IdTrabajo = '$IdTrabajo'";
			$cmp_reset = $this->mysqli->query($sql_reset);
		}

		$sql = "SELECT * FROM TRABAJO WHERE IdTrabajo = '$IdTrabajo'";

		$result = $this->mysqli->query($sql);
		$num_rows = mysqli_num_rows($result);

		if($num_rows > 0){

			//Cogemos todas las asignaciones generadas para un trabajo y las juntamos con las historias del mismo
			$sql = "SELECT * FROM HISTORIA H, ASIGNAC_QA A
						WHERE (H.IdTrabajo = A.IdTrabajo AND
								 H.IdTrabajo = '$IdTrabajo')";

			$result = $this->mysqli->query($sql);
			$num_rows = mysqli_num_rows($result);
			
			//Contador de evaluaciones creadas con éxito
			$cont_exito = 0;

			while($row = mysqli_fetch_array($result)){

				$LoginEvaluador = $row['LoginEvaluador'];
				$AliasEvaluado = $row['AliasEvaluado'];
				$IdHistoria = $row['IdHistoria'];

				//Creamos una evaluación de la historia para una determinada asignación de QAs

				$sql = "INSERT INTO EVALUACION 
										(IdTrabajo, 
										 LoginEvaluador,
										  AliasEvaluado,
										   IdHistoria,
										    CorrectoA,
										     ComenIncorrectoA,
										      CorrectoP,
										       ComentIncorrectoP,
										        OK)
										         VALUES 
										         ('$IdTrabajo',
										           '$LoginEvaluador',
										            '$AliasEvaluado',
										             '$IdHistoria',
										              '0',
										               '',
										                '0',
										                 '',
										                  '0')";	
										                  
				if ($result_insert = $this->mysqli->query($sql)){
					$cont_exito++;	
				}
				else{
					$this->lista['mensaje'] =  'ERROR: La generación de historias a evaluar no ha sido realizada correctamente'; 
					return $this->lista;	
				}						                  					                  
			}	

			$sql = "SELECT * FROM EVALUACION WHERE IdTrabajo = '$IdTrabajo'";
			$result = $this->mysqli->query($sql);
			$num_rows = mysqli_num_rows($result);
			if($num_rows == $cont_exito){

				$this->lista['mensaje'] =  'Generación de historias a evaluar realizada correctamente'; 
					return $this->lista; 
			}
			else{

				$this->lista['mensaje'] =  'ERROR: La generación de historias a evaluar no ha sido realizada correctamente'; 
				return $this->lista; 
			}

		}
		else{
			$this->lista['mensaje'] =  'ERROR: No existe ningún trabajo con ese IdTrabajo'; 
			return $this->lista;
		}	
	}
	else{
		$this->lista['mensaje'] =  'ERROR: No hay asignaciones de qas para este trabajo'; 
			return $this->lista;
	}	
}

}
?> 
