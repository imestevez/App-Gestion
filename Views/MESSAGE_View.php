
<?php
/*
//Clase : MESSAGE_View
//Creado el : 16-10-2017
//Creado por: vugsj4
//-------------------------------------------------------

Muestra los mensajes al usuario por pantalla
*/
class MESSAGE{

	var $login; //declaración del atributo login del usuario
	var $password; //declaración del atributo password del usuario
	var $DNI; //declaración del atributo DNI del usuario
	var $nombre; //declaración del atributo nombre
	var $apellidos; //declaración del atributo apellidos
	var $telefono; //declaración del atributo telefono
	var $email; //declaración del atributo email
	var $FechaNacimiento; // declaración del atributo FechaNacimiento
	var $fotopersonal; //declaracion del atributo fotopersonal
	var $sexo; //declaración del atributo titulación
	var $mensaje; // Almacena el mensaje enviado por el controlador
	var $msqli; //Almacena los datos de la coexión a la BD
	var $origen; //Almacena el origen de la orden
	var $resultado; // array para almacenar los datos del usuario


	function __construct($datos, $origen){
	
	if(is_string($datos)){ //Si en datos se envía unicamente un string
		$this->mensaje = $datos;
		$this->origen = $origen;
		$this->mensaje(); //Se muestra el string


	}else{ // si en $datos están los atributos de un usuario
		$this->login = $datos['login'];
		$this->password = $datos['password'];
		$this->DNI = $datos['DNI'];
		$this->nombre = $datos['nombre'];
		$this->apellidos =  $datos['apellidos'];
		$this->telefono = $datos['telefono'];
		$this->email = $datos['email'];
		$this->FechaNacimiento =  $datos['FechaNacimiento'];
		$this->fotopersonal = $datos['fotopersonal'];
		$this->sexo = $datos['sexo'];
		$this->mensaje = $datos['mensaje'];
		$this->msqli = $datos['sql'];
		$this->origen = $origen;
		$this->FechaNacimiento = date_format(date_create($this->FechaNacimiento), 'd-m-Y');
		$this->render();
		}
	}
//funcion que muestra los datos al usuario
function render(){

  include 'Header_View.php';
?>
     <section class="pagina" style="min-height: 450px">

			<br><p style="margin-left: 25%; margin-top: 2%"> <?php echo $strings[$this->mensaje] . " " .$strings['del usuario'].": "?></p>
			<table class="showcurrent">
                <tr><th><?php echo $strings['Campo'] ?></th><th>Valor</th></tr>
                 <tr><th><?php echo $strings['Login'] ?></th><td><?php echo $this->login ?></td></tr>
                 <tr><th><?php echo $strings['DNI'] ?></th><td><?php echo $this->DNI ?></td></tr>
                <tr><th><?php echo $strings['Nombre'] ?></th><td><?php echo $this->nombre ?></td></tr>
                <tr><th><?php echo $strings['Apellidos'] ?></th><td><?php echo $this->apellidos ?></td></tr>
                  <tr><th><?php echo $strings['Telefono'] ?></th><td><?php echo $this->telefono ?></td></tr>
                <tr><th><?php echo $strings['Email'] ?></th><td><?php echo $this->email ?></td></tr>
                 <tr><th><?php echo $strings['Fecha de Nacimiento'] ?></th><td><?php echo $this->FechaNacimiento ?></td></tr>
                <tr><th><?php echo $strings['Foto personal'] ?></th><td><img src="<?php echo $this->fotopersonal ?>" width="150px" heigth="150px"></td></tr>
                 <tr><th><?php echo $strings['Sexo'] ?></th><td><?php echo $strings[$this->sexo] ?></td></tr>
                </table>
            <div class="accionesTable">
			<a href= "<?php echo $this->origen?>" ><input type="image" name="" type="image" name="action" src="../Views/images/back.png" value="volver" title="<?php echo $strings['Volver'] ?>" ></a>
			</div>

</section>
<?php
  include 'Footer_View.php';
	
}//fin render()

//funcion que muestra solo el mensaje

function mensaje(){
	  include 'Header_View.php';
?>
     <section class="pagina" style="min-height: 400px">

     		<div style="margin-left: 5%; margin-top: 5%">
			<br><p  style="margin-left: 25%; margin-top: 2%"> <?php echo $strings[$this->mensaje]?></p>
			</div>
            <div class="acciones" style="margin-top: 20%">
			<a href= "<?php echo $this->origen?>" ><input type="image" name="" type="image" name="action" src="../Views/images/back.png" value="volver" title="Volver a la página anterior" ></a>
			</div>

	</section>
<?php
  include 'Footer_View.php';
} // fin mensaje()

}//fin clase
?>