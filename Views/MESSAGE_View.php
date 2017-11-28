
<?php
/*
//Clase : MESSAGE_View
//Creado el : 16-10-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Muestra los mensajes al usuario por pantalla
*/
class MESSAGE{

	var $mensaje; // Almacena el mensaje enviado por el controlador
	var $msqli; //Almacena los datos de la coexión a la BD
	var $origen; //Almacena el origen de la orden
	var $resultado; // array para almacenar los datos del usuario


	function __construct($datos, $origen){
	if(is_string($datos)){ //Si en datos se envía unicamente un string
		$this->mensaje = $datos;
		$this->origen = $origen;
		$this->render();
	}else { //si es una lista con mas elementos
		$this->mensaje = $datos['mensaje'];
		$this->origen = $origen;
		$this->render(); //Se muestra el string
	}
	}

//funcion que muestra solo el mensaje

function render(){
	  include 'Header.php';
?>
     <section class="pagina" style="min-height: 400px">

     		<div style="margin-left: 5%; margin-top: 5%">
			<br><p  style="margin-left: 25%; margin-top: 2%"> <?php echo $strings[$this->mensaje]?></p>
			</div>
            <div class="acciones" style="margin-top: 20%">
			<a href= "<?php echo $this->origen?>" ><input type="image" name="" type="image" name="action" src="../Views/images/back.png" value="volver" title="<?php echo $strings['Volver'] ?>" ></a>
			</div>

	</section>
<?php
  include 'Footer.php';
} // fin mensaje()

}//fin clase
?>