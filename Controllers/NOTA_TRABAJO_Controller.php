
<?php
/*
//Script : NOTA_TRABAJO_Controller.php
//Creado el : 08-12-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Controlador que recibe las acciones relacionadas con notas

*/
session_start(); //solicito trabajar con la session


include_once '../Functions/Authentication.php';
include_once '../Functions/ACL.php';
include_once '../Views/MESSAGE_View.php';

if (!IsAuthenticated()){
	header('Location:../index.php');
}else{

if(isset($_REQUEST["action"]))  {
	$action = $_REQUEST["action"];
}else{

	$action = '';
}

//Si no tiene permisos para acceder a este controlador con la accion que trae
if(!HavePermissions(11, $action)) {
	//new MESSAGE('No tienes permisos para realizar esta accion', '../index.php');
	header('Location:../index.php'); //vuelve al index
}
//almacenamos un array de permidos del grupo
$permisos = listaPermisos();
$acciones = listaAcciones(11);

//Pnemos la variabla acceso  a false con la que se controla si el usuario puede ver un showall o no
$acceso=false;
include_once '../Models/NOTA_TRABAJO_Model.php';

include_once '../Views/NOTA_TRABAJO/NOTA_TRABAJO_SHOWALL_View.php';
include_once '../Views/NOTA_TRABAJO/NOTA_TRABAJO_SHOWCURRENT_View.php';
include_once '../Views/NOTA_TRABAJO/NOTA_TRABAJO_ADD_View.php';
include_once '../Views/NOTA_TRABAJO/NOTA_TRABAJO_EDIT_View.php';
include_once '../Views/NOTA_TRABAJO/NOTA_TRABAJO_SEARCH_View.php';
include_once '../Views/NOTA_TRABAJO/NOTA_TRABAJO_DELETE_View.php';
include_once '../Views/MESSAGE_View.php';



// funcion para coger los datos del formulario
function get_data_form(){

	$login = null;
	$IdTrabajo = null;
	$NotaTrabajo = null;

	if(isset($_REQUEST['login'])){
	$login = $_REQUEST['login'];
	}
	if(isset($_REQUEST['IdTrabajo'])){
	$IdTrabajo = $_REQUEST['IdTrabajo'];
	}
	if(isset($_REQUEST['NotaTrabajo'])){
	$NotaTrabajo = $_REQUEST['NotaTrabajo'];
	}

	
	$NOTA_TRABAJO = new NOTA_TRABAJO_Model(
		$login, 
		$IdTrabajo, 
		$NotaTrabajo);

	return $NOTA_TRABAJO;
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

					$form = new NOTA_TRABAJO_ADD(); //Crea la vista ADD y muestra formulario para rellenar por el usuario
			}
			else{ //si viene del add 
				/*echo $_REQUEST['login'];
				echo $_REQUEST['IdTrabajo'];
				*/
				$NOTA_TRABAJO = get_data_form(); //recibe datos
				$lista = $NOTA_TRABAJO->ADD(); //mete datos en respuesta usuarios despues de ejecutar el add con los de NOTA_TRABAJO
				$usuario = new MESSAGE($lista, '../Controllers/NOTA_TRABAJO_Controller.php'); //muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'DELETE': //Si quiere hacer un DELETE
			if (!$_POST){ //viene del showall con una clave
				$lista = array('login','IdTrabajo','NotaTrabajo');
				$NOTA_TRABAJO = new NOTA_TRABAJO_Model($_REQUEST['login'],$_REQUEST['IdTrabajo'],'');//crea un un NOTA_TRABAJO_Model con el IdTrabajo del usuario
				$lista = $NOTA_TRABAJO->rellenarLista();
				//$tupla = $NOTA_TRABAJO->RellenaDatos();//A partir del IdTrabajo recoge todos los atributos
				$usuario = new NOTA_TRABAJO_DELETE($lista); //Crea la vista de DELETE con los datos del usuario
			}
			else{//si viene con un post
				$NOTA_TRABAJO = get_data_form(); //coge los datos del formulario del usuario que desea borrar
				$respuesta = $NOTA_TRABAJO->DELETE(); //Ejecuta la funcion DELETE() en el NOTA_TRABAJO_Model
				$mensaje = new MESSAGE($respuesta, '../Controllers/NOTA_TRABAJO_Controller.php'); //muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'EDIT': //si el usuario quiere editar	
			if (!$_POST){
				$NOTA_TRABAJO = new NOTA_TRABAJO_Model($_REQUEST['login'],$_REQUEST['IdTrabajo'],''); //crea un un NOTA_TRABAJO_Model con el IdTrabajo del usuario 
				$lista = $NOTA_TRABAJO->rellenarLista();  //A partir del IdTrabajo recoge todos los atributos
				$usuario = new NOTA_TRABAJO_EDIT($lista); //Crea la vista EDIT con los datos del usuario
			}
			else{
				$NOTA_TRABAJO = get_data_form(); //coge los datos del formulario del usuario que desea editar
				$respuesta = $NOTA_TRABAJO->EDIT(); //Ejecuta la funcion EDIT() en el NOTA_TRABAJO_Model
				$mensaje = new MESSAGE($respuesta, '../Controllers/NOTA_TRABAJO_Controller.php');//muestra el mensaje despues de la sentencia sql
			}
			break;
		case 'SEARCH': //si desea realizar una busqueda
			if (!$_POST){
				$NOTA_TRABAJO = new NOTA_TRABAJO_SEARCH();//Crea la vista SEARCH y muestra formulario para rellenar por el usuario
			}
			else{
				$NOTA_TRABAJO = get_data_form(); //coge los datos del formulario del usuario que desea buscar
				$datos = $NOTA_TRABAJO->SEARCH();//Ejecuta la funcion SEARCH() en el NOTA_TRABAJO_Model
				$lista = array('login', 'IdTrabajo','NotaTrabajo');
				$resultado = new NOTA_TRABAJO_SHOWALL($lista, $datos, 0, 0, 0, 0, 'SEARCH', '../Controllers/NOTA_TRABAJO_Controller.php',$acciones);//Crea la vista SHOWALL y muestra los usuarios que cumplen los parámetros de búsqueda 
			}
			break;
		case 'SHOW': //si desea ver un usuario en detalle
			$lista = array('login','IdTrabajo','NotaTrabajo');
			$NOTA_TRABAJO = new NOTA_TRABAJO_Model($_REQUEST['login'],$_REQUEST['IdTrabajo'], '');//crea un un NOTA_TRABAJO_Model con el IdTrabajo del usuario
			$lista = $NOTA_TRABAJO->rellenarLista();
			//$tupla = $NOTA_TRABAJO->RellenaDatos();//A partir del IdTrabajo recoge todos los atributos
			$usuario = new NOTA_TRABAJO_SHOWCURRENT($lista); //Crea la vista SHOWCURRENT del usuario requerido
			break;
		default: //Por defecto, Se muestra la vista SHOWALL
			foreach ($acciones as $key => $value) {
				if($value == 'ALL'){ //si puede ver el showall
					$acceso = true; //acceso a true
				}
			}
			if($acceso == true){ //si tiene acceso, mostramos el showall
				if (!$_POST){
					$NOTA_TRABAJO = new NOTA_TRABAJO_Model('','','');//crea un NOTA_TRABAJO_Model
				}
				else{
					$NOTA_TRABAJO = get_data_form(); //Coge los datos del formulario
				}

				if(!isset($_REQUEST['num_pagina'])){ //Si es la 1a página del showall a mostrar
					$num_pagina = 0;
				}else{ //Si es otra página
					$num_pagina = $_REQUEST['num_pagina']; //coge el numero de página del formulario
				}
				$num_tupla = $num_pagina*10; //número de la 1º tupla a mostrar
				$max_tuplas = $num_tupla+10; // el número de tuplas a mostrar por página
				$totalTuplas = $NOTA_TRABAJO->contarTuplas(); //Cuenta el número de tuplas que hay en la BD
				$datos = $NOTA_TRABAJO->SHOWALL($num_tupla,$max_tuplas); //Ejecuta la funcion SHOWALL() en el ENTREGA_Model
				$lista = array('login','IdTrabajo','NotaTrabajo');
				$UsuariosBD = new NOTA_TRABAJO_SHOWALL($lista, $datos, $num_tupla, $max_tuplas, $totalTuplas, $num_pagina, 'SHOWALL', '../Controllers/NOTA_TRABAJO_Controller.php',$acciones); //Crea la vista SHOWALL de los usuarios de la BD	
			}else{
				if (!$_POST){
					$NOTA_TRABAJO = new NOTA_TRABAJO_Model('','','');//crea un NOTA_TRABAJO_Model
				}
				else{
					$NOTA_TRABAJO = get_data_form(); //Coge los datos del formulario
				}

				if(!isset($_REQUEST['num_pagina'])){ //Si es la 1a página del showall a mostrar
					$num_pagina = 0;
				}else{ //Si es otra página
					$num_pagina = $_REQUEST['num_pagina']; //coge el numero de página del formulario
				}
				$num_tupla = $num_pagina*10; //número de la 1º tupla a mostrar
				$max_tuplas = $num_tupla+10; // el número de tuplas a mostrar por página
				$totalTuplas = $NOTA_TRABAJO->contarTuplas(); //Cuenta el número de tuplas que hay en la BD
				$datos = $NOTA_TRABAJO->SHOWALL_User($num_tupla,$max_tuplas); //Ejecuta la funcion SHOWALL() en el ENTREGA_Model
				$lista = array('login','IdTrabajo','NotaTrabajo');
				$UsuariosBD = new NOTA_TRABAJO_SHOWALL($lista, $datos, $num_tupla, $max_tuplas, $totalTuplas, $num_pagina, 'ALL', '../Controllers/NOTA_TRABAJO_Controller.php',$acciones); //Crea la vista SHOWALL de los usuarios de la BD	
			}
		}
	}

?>