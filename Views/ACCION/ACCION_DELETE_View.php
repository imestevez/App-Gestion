<?php
/*
//Clase : ACCION_DELETE
//Creado el : 1-12-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Muestra la tabla de borrado de la accion seleccionada

*/
class ACCION_DELETE{

	 var $IdAccion; //declaración del atributo IdAccion de la accion
    var $NombreAccion; //declaración del atributo NombreAccion de la accion
    var $DescripAccion; //declaración del atributo DescripAccion de la accion


function __construct($tupla){

	//asignación de valores de parámetro a los atributos de la clase
	$this->IdAccion = $tupla['IdAccion'];
  $this->NombreAccion = $tupla['NombreAccion'];
	$this->DescripAccion = $tupla['DescripAccion'];
	
  $this->render();
}

//funcion que muestra los datos

function render(){
    include '../Views/Header.php';

?>
     <section class="pagina" style="min-height: 900px">

           <table class="showcurrent">
             <caption><?php echo $strings['Borrar Accion'] ?></caption>
                <tr><th><?php echo $strings['Campo'] ?></th><th><?php echo $strings['Valor'] ?></th></tr>
                <tr><th><?php echo $strings['Id de la accion'] ?></th><td><?php echo $this->IdAccion ?></td></tr>
                <tr><th><?php echo $strings['Nombre de la accion'] ?></th><td><?php echo $this->NombreAccion ?></td></tr>
                <tr><th><?php echo $strings['Descripcion de la accion'] ?></th><td><?php echo $this->DescripAccion ?></td></tr>

                </table>


       <form method="post" name="DELETE" action="../Controllers/ACCION_Controller.php" enctype="multipart/form-data" >
                <input class="del" type="text" name="IdAccion" maxlength="20" size="<?php echo strlen($this->IdAccion); ?>" readonly value="<?php echo $this->IdAccion ?>">
                <input class="del" type="text" name="NombreAccion" maxlength="20" size="<?php echo strlen($this->NombreAccion); ?>" readonly value="<?php echo $this->NombreAccion ?>">
                <input class="del" type="text"  name="DescripAccion" maxlength="20" size="<?php echo strlen($this->DescripAccion); ?>" readonly value="<?php echo $this->DescripAccion ?>">

                  <div class="accionesTable" style="margin-left: 0%; float: right; margin-right: 45%">

                    <a href="../Controllers/USUARIOS_Controller.php?action=DELETE&IdAccion=<?php echo $this->IdAccion ?>"><input type="image" name="action" value="DELETE" action="#" src="../Views/images/confirmar.png" title="<?php echo $strings['Borrar Accion'] ?>" ></a>
                    </div>
             </form>

                  <div class="accionesTable" style="float: left;">
                    <a href="../Controllers/ACCION_Controller.php?action=SHOWALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver'] ?>"></a>  
                    </div>    
		</section>
<?php

  include '../Views/Footer.php';

    }
}
?>