<?php
/*
	Autor: SOLFAMIDAS
	Fecha de creación: 24/11/2017
	Descripción: Vista para añadir historias de usuario.

*/

class HISTORIA_DELETE{

    var $IdTrabajo; //atributo IdTrabajo
	var $IdHistoria; //atributo IdHistoria
	var $TextoHistoria; //atributo TextoHistoria
	
    var $lista; // array para almacenar los datos del usuario
    var $mysqli; // declaración del atributo manejador de la bd

function __construct($tupla){
    //Asignación de valores de parámetro a los atributos de la clase
		$this->IdTrabajo =  $tupla['IdTrabajo'];
		$this->IdHistoria = $tupla['IdHistoria'];
		$this->TextoHistoria = $tupla['TextoHistoria'];

    $this->render();
}


//funcion que muestra los datos al usuario

function render(){

  include '../Views/Header.php';   

?>
     <section class="pagina" style="min-height: 500px">

            <table class="showcurrent">
            	<caption><?php echo $strings['Eliminar historia'] ?></caption>
                	<tr><th><?php echo $strings['Campo'] ?></th><th>Valor</th></tr>
                	<tr><th><?php echo $strings['Id del trabajo'] ?></th><td><?php echo $this->IdTrabajo ?></td></tr>
                	<tr><th><?php echo $strings['Id de la historia'] ?></th><td><?php echo $this->IdHistoria ?></td></tr>
                	<tr><th><?php echo $strings['Texto de la historia'] ?></th><td><?php echo $this->TextoHistoria ?></td></tr>
            </table>


       <form method="post" name="DELETE" action="../Controllers/HISTORIA_Controller.php" enctype="multipart/form-data" >
                <input class="del" type="text" name="IdTrabajo" size="<?php echo strlen($this->IdTrabajo); ?>" readonly value="<?php echo $this->IdTrabajo ?>">
                <input class="del" type="text" name="IdHistoria"  size="<?php echo strlen($this->IdHistoria); ?>" readonly value="<?php echo $this->IdHistoria ?>">
                <input class="del" type="text"  name="TextoHistoria" size="<?php echo strlen($this->TextoHistoria); ?>" readonly value="<?php echo $this->TextoHistoria ?>" >

                  <div class="accionesTable" style="margin-left: 0%; float: right; margin-right: 45%;>

                    <a href="../Controllers/HISTORIA_Controller.php?action=DELETE&IdTrabajo=<?php echo $this->IdTrabajo ?>&IdHistoria=<?php echo $this->IdHistoria ?>" ><input type="image" name="action" value="DELETE" action="#" src="../Views/images/confirmar.png" title="<?php echo $strings['Eliminar historia'] ?>" ></a>
                    </div>
             </form>

                  <div class="accionesTable" style="float: left;">
                    <a href="../Controllers/HISTORIA_Controller.php?action=SHOWALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver'] ?>"></a>  
                  </div>    
    </section>
<?php

  include '../Views/Footer.php';

    }
}
?>