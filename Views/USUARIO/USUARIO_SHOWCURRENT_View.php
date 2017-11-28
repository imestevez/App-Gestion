<?php
/*
//Clase : USUARIO_SHOWCURRENT
//Creado el : 24-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------
    
    Esta clase es la vista en detalle de un usuario

*/

class USUARIO_SHOWCURRENT{

	
    var $login; //declaración del atributo login del usuario
    var $password; //declaración del atributo password del usuario
    var $DNI; //declaración del atributo DNI del usuario
    var $nombre; //declaración del atributo nombre
    var $apellidos; //declaración del atributo apellidos
    var $telefono; //declaración del atributo telefono
    var $email; //declaración del atributo email
    var $direccion; //declaración del atributo direccion

//constructor de la clase
function __construct($tupla){
	//asignación de valores de parámetro a los atributos de la clase
	$this->login = $tupla['login'];
    $this->DNI = $tupla['DNI'];
	$this->nombre = $tupla['Nombre'];
	$this->apellidos = $tupla['Apellidos'];
	$this->telefono = $tupla['Telefono'];
	$this->email = $tupla['Correo'];
	$this->direccion = $tupla['Direccion'];

    $this->render();
}

//funcion que muestra los datos al usuario
function render(){

  include '../Views/Header.php';

?>
    <section class="pagina">
            <table class="showcurrent">
                <caption><?php echo $strings['Vista en detalle de usuario'] ?></caption>
                <tr><th><?php echo $strings['Campo'] ?></th><th><?php echo $strings['Valor'] ?></th></tr>
                <tr><th><?php echo $strings['Login'] ?></th><td><?php echo $this->login ?></td></tr>
                <tr><th><?php echo $strings['DNI'] ?></th><td><?php echo $this->DNI ?></td></tr>
                <tr><th><?php echo $strings['Nombre'] ?></th><td><?php echo $this->nombre ?></td></tr>
                <tr><th><?php echo $strings['Apellidos'] ?></th><td><?php echo $this->apellidos ?></td></tr>
                <tr><th><?php echo $strings['Telefono'] ?></th><td><?php echo $this->telefono ?></td></tr>
                <tr><th><?php echo $strings['Email'] ?></th><td><?php echo $this->email ?></td></tr>
                <tr><th><?php echo $strings['Direccion'] ?></th><td><?php echo $this->direccion ?></td></tr>
            </table>
            <div class="accionesTable">
                <a href="../Controllers/USUARIO_Controller.php?action=SHOWALL"><input type="image" name="action" value="SHOWALL" src="../Views/images/back.png" title="<?php echo $strings['Volver'] ?>"></a>
            </div>

    </section>	
<?php
  include '../Views/Footer.php';

    }//fin de render()
}//fin de la clase
?>