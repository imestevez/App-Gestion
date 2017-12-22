<?php
/*
	Autor: SOLFAMIDAS
	Fecha de creación: 24/11/2017
	Descripción: Vista para mostrar una historia en concreto

*/

class HISTORIA_SHOWCURRENT{

    var $IdTrabajo; //atributo IdTrabajo
	var $IdHistoria; //atributo IdHistoria
    var $NombreTrabajo; 
	var $TextoHistoria; //atributo TextoHistoria
    var $lista; // array para almacenar los datos del usuario
    var $mysqli; // declaración del atributo manejador de la bd

function __construct($tupla){
    
    //Asignación de valores de parámetro a los atributos de la clase
		$this->IdTrabajo =  $tupla['IdTrabajo'];
        $this->NombreTrabajo =  $tupla['NombreTrabajo'];
		$this->IdHistoria = $tupla['IdHistoria'];
		$this->TextoHistoria = $tupla['TextoHistoria'];

    $this->render();
}


//funcion que muestra los datos al usuario

function render(){

  include '../Views/Header.php';   

?>
     <section class="pagina">
             <table class="showcurrent">
                 <caption><?php echo $strings['Vista en detalle historia'] ?></caption>
                 <tr><th><?php echo $strings['Campo'] ?></th><th><?php echo $strings['Valor'] ?></th></tr>
                 <tr><th><?php echo $strings['Id del trabajo'] ?></th><td><?php echo $this->IdTrabajo ?></td></tr>
                 <tr><th><?php echo $strings['Nombre del trabajo'] ?></th><td><?php echo $this->NombreTrabajo ?></td></tr>
                 <tr><th><?php echo $strings['Id de la historia'] ?></th><td><?php echo $this->IdHistoria ?></td></tr>
                 <tr><th><?php echo $strings['Texto de la historia'] ?></th><td><?php echo $this->TextoHistoria ?></td></tr>
                </table>
                    <div class="accionesTable">
                     <a href="../Controllers/HISTORIA_Controller.php?action=ALL"><input type="image" name="action" value="SHOWALL" src="../Views/images/back.png" title="<?php echo $strings['Volver'] ?>"></a>
                 </div>

        </section>	
<?php
  include '../Views/Footer.php';

    }//fin de render()
}//fin de la clase
?>