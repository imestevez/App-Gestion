
<?php

/*
//Script : ENTREGA_Controller.php
//Creado el : 29-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Controlador que recibe las acciones relacionadas con ENTREGA
*/
session_start(); //solicito trabajar con la session

include_once '../Functions/Authentication.php';

if (!IsAuthenticated()){
	header('Location:../index.php');
}
include '../Models/ENTREGA_Model.php';

include '../Views/ENTREGA/ENTREGA_SHOWALL_View.php';
include '../Views/ENTREGA/ENTREGA_SHOWCURRENT_View.php';
include '../Views/ENTREGA/ENTREGA_ADD_View.php';
include '../Views/ENTREGA/ENTREGA_EDIT_View.php';
include '../Views/ENTREGA/ENTREGA_SEARCH_View.php';
include '../Views/ENTREGA/ENTREGA_DELETE_View.php';
include '../Views/MESSAGE_View.php';



// funcion para coger los datos del formulario
function get_data_form(){

	$login = null;
	$IdTrabajo = null;
	$Alias = null;
	$Horas = null;
	$Ruta = null;
	$origen = null;
	$action = null;

	if(isset($_REQUEST['login'])){
	$login = $_REQUEST['login'];
	}
	if(isset($_REQUEST['IdTrabajo'])){
	$IdTrabajo = $_REQUEST['IdTrabajo'];
	}
	if(isset($_REQUEST['Alias'])){
	$Alias = $_REQUEST['Alias'];
	}
	if(isset($_REQUEST['Horas'])){
	$Horas = $_REQUEST['Horas'];
	}
	if(isset($_FILES['Ruta'])){
		if($_FILES['Ruta']['tmp_name'] <> ''){ //Si  fich tiene una ruta origen
			$fich = $_FILES['Ruta']['name'];
			$ruta = $_FILES['Ruta']['tmp_name'];
			$Ruta = "../Files/".$fich;

			move_uploaded_file($ruta, $Ruta); //se mueve  fich al directorio destino

		}else{ //si no tiene ruta origen
			$Ruta= '';
		}
}

	if(isset($_REQUEST['origen'])){
	$origen = $_REQUEST['origen'];
	}

		$ENTREGA = new ENTREGA_Model(
		$login,
		$IdTrabajo, 
		$Alias, 
		$Horas, 
		$Ruta);

	return $ENTREGA;


}
//Funcion para coger los datos del formulario de un usuario ya almacenado
function get_data_UserBD(){

	$login = null;
	$IdTrabajo = null;
	$Alias = null;
	$Horas = null;
	$Ruta = null;
	$origen = null;

	$action = null;


	if(isset($_REQUEST['login'])){
	$login = $_REQUEST['login'];
	}
	if(isset($_REQUEST['IdTrabajo'])){
	$IdTrabajo = $_REQUEST['IdTrabajo'];
	}
	if(isset($_REQUEST['Alias'])){
	$Alias = $_REQUEST['Alias'];
	}
	if(isset($_REQUEST['Horas'])){
	$Horas = $_REQUEST['Horas'];
	}
	if(isset($_FILES['newRuta']) && isset($_REQUEST['Ruta'])){ //si viene del formulario edit
		if($_FILES['newRuta']['tmp_name'] <> ''){ //Si la fich tiene una ruta origen
			$fich = $_FILES['newRuta']['name'];
			$ruta = $_FILES['newRuta']['tmp_name'];
			
			$Ruta = "../Files/".$fich;

			move_uploaded_file($ruta, $Ruta); //se mueve la fich al directorio destino

		}else{ //si no tiene ruta origen
			$Ruta= $_REQUEST['Ruta'];
		}
	}else{ //si viene del search
		if(isset($_REQUEST['Ruta']) && !isset($_FILES['newRuta'])) {
			$Ruta= $_REQUEST['Ruta'];
		}
	}
	if(isset($_REQUEST['action'])){
	$action = $_REQUEST['action'];
	}

	$ENTREGA = new ENTREGA_Model(
		$login,
		$IdTrabajo,
		$Alias, 
		$Horas, 
		$Ruta);

	return $ENTREGA;
}

//Si el usuario no elige ninguna opción
if (!isset($_REQUEST['action'])){
	$action = ''; //la acctión se pone vacía
}else{
	$action = $_REQUEST['action']; //si no, se le asigna la accion elegida

}


	// En funcion de la accion elegida
	Switch ($action){
		case 'ADD': //Si quiere hacer un ADD
			if (!$_POST){ //si viene del showall (no es un post)
				$lista = array('login', 'Nombre','IdTrabajo', 'NombreTrabajo', 'Alias', 'origen');

				if( (isset($_REQUEST['login'])) && 
					(isset($_REQUEST['IdTrabajo'])) && 
					(isset($_REQUEST['origen'])) ) {

					$ENTREGA = get_data_form(); //recibe datos
					
					$lista['login'] = $_REQUEST['login'];
					$lista['IdTrabajo'] = $_REQUEST['IdTrabajo'];
					$lista = $ENTREGA->rellenarLista();
					$lista['Alias'] = $ENTREGA->generadorAlias();
					$lista['origen'] = $_REQUEST['origen'];

					$form = new ENTREGA_ADD($lista); //Crea la vista ADD y muestra formulario para rellenar por el usuario
				}else{
					$lista['login'] = '';
					$lista['origen'] = '../Controllers/ENTREGA_Controller.php';
					$form = new ENTREGA_ADD($lista); //Crea la vista ADD y muestra formulario para rellenar por el usuario
				}
			}
			else{ //si viene del add 
				/*echo $_REQUEST['login'];
				echo $_REQUEST['IdTrabajo'];
				echo $_REQUEST['Alias'];
*/
				$ENTREGA = get_data_form(); //recibe datos
				$lista = $ENTREGA->ADD(); //mete datos en respuesta usuarios despues de ejecutar el add con los de ENTREGA
				$usuario = new MESSAGE($lista, '../Controllers/ENTREGA_Controller.php'); //muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'DELETE': //Si quiere hacer un DELETE
			if (!$_POST){ //viene del showall con una clave
				$ENTREGA = new ENTREGA_Model($_REQUEST['login'],$_REQUEST['IdTrabajo'],'', '',''); //crea un un ENTREGA_Model con el IdTrabajo del usuario
				$valores = $ENTREGA->RellenaDatos(); //completa el resto de atributos a partir de la clave
				$usuario = new ENTREGA_DELETE($valores); //Crea la vista de DELETE con los datos del usuario
			}
			else{//si viene con un post
				$ENTREGA = get_data_UserBD(); //coge los datos del formulario del usuario que desea borrar
				$respuesta = $ENTREGA->DELETE(); //Ejecuta la funcion DELETE() en el ENTREGA_Model
				$mensaje = new MESSAGE($respuesta, '../Controllers/ENTREGA_Controller.php'); //muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'EDIT': //si el usuario quiere editar	
			if (!$_POST){
				$ENTREGA = new ENTREGA_Model($_REQUEST['login'],$_REQUEST['IdTrabajo'],'', '',''); //crea un un ENTREGA_Model); //crea un un ENTREGA_Model con el IdTrabajo del usuario 
				$datos = $ENTREGA->RellenaDatos();  //A partir del IdTrabajo recoge todos los atributos
				$usuario = new ENTREGA_EDIT($datos); //Crea la vista EDIT con los datos del usuario
			}
			else{
				$ENTREGA = get_data_UserBD(); //coge los datos del formulario del usuario que desea editar
				$respuesta = $ENTREGA->EDIT(); //Ejecuta la funcion EDIT() en el ENTREGA_Model
				$mensaje = new MESSAGE($respuesta, '../Controllers/ENTREGA_Controller.php');//muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'SEARCH': //si desea realizar una busqueda
			if (!$_POST){
				$ENTREGA = new ENTREGA_SEARCH();//Crea la vista SEARCH y muestra formulario para rellenar por el usuario
			}
			else{
				$ENTREGA = get_data_UserBD(); //coge los datos del formulario del usuario que desea buscar
				$datos = $ENTREGA->SEARCH();//Ejecuta la funcion SEARCH() en el ENTREGA_Model
				$lista = array('login', 'IdTrabajo','Alias','Horas','Ruta');
				$resultado = new ENTREGA_SHOWALL($lista, $datos, 0, 0, 0, 0, 'SEARCH', '../Controllers/ENTREGA_Controller.php');//Crea la vista SHOWALL y muestra los usuarios que cumplen los parámetros de búsqueda 
			}
			break;
		case 'SHOWCURRENT': //si desea ver un usuario en detalle
			$lista = array('login', 'Nombre','IdTrabajo', 'NombreTrabajo', 'Alias','NotaTrabajo', 'origen');
			$ENTREGA = new ENTREGA_Model($_REQUEST['login'],$_REQUEST['IdTrabajo'], '', '',''); //crea un un ENTREGA_Model);//crea un un ENTREGA_Model con el IdTrabajo del usuario
			$lista = $ENTREGA->rellenarLista();
			echo $lista['login'];
			//$tupla = $ENTREGA->RellenaDatos();//A partir del IdTrabajo recoge todos los atributos
			$usuario = new ENTREGA_SHOWCURRENT($lista); //Crea la vista SHOWCURRENT del usuario requerido
			break;
		default: //Por defecto, Se muestra la vista SHOWALL
			if (!$_POST){
				$ENTREGA = new ENTREGA_Model('','','', '','','','','');//crea un un ENTREGA_Model con el IdTrabajo del usuario 
			}
			else{
				$ENTREGA = get_data_form(); //Coge los datos del formulario
			}

			if(!isset($_REQUEST['num_pagina'])){ //Si es la 1a página del showall a mostrar
				$num_pagina = 0;
			}else{ //Si es otra página
				$num_pagina = $_REQUEST['num_pagina']; //coge el numero de página del formulario
			}
			$num_tupla = $num_pagina*10; //número de la 1º tupla a mostrar
			$max_tuplas = $num_tupla+10; // el número de tuplas a mostrar por página
			$totalTuplas = $ENTREGA->contarTuplas(); //Cuenta el número de tuplas que hay en la BD
			$datos = $ENTREGA->SHOWALL($num_tupla,$max_tuplas); //Ejecuta la funcion SHOWALL() en el ENTREGA_Model
			$lista = array('login','IdTrabajo', 'Alias', 'Horas','Ruta');
			$UsuariosBD = new ENTREGA_SHOWALL($lista, $datos, $num_tupla, $max_tuplas, $totalTuplas, $num_pagina, 'SHOWALL', '../Controllers/ENTREGA_Controller.php'); //Crea la vista SHOWALL de los usuarios de la BD	
	}

?>