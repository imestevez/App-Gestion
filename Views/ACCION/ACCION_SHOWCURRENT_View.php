<?php
/*
//Clase : ACCION_SHOWCURRENT
//Creado el : 1-12-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------
    
    Esta clase es la vista en detalle de un usuario

*/

class ACCION_SHOWCURRENT{

	
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
     <section class="pagina">
             <table class="showcurrent">
                 <caption><?php echo $strings['Vista en detalle de accion'] ?></caption>
                <tr><th><?php echo $strings['Campo'] ?></th><th>Valor</th></tr>
                 <tr><th><?php echo $strings['Id de la accion'] ?></th><td><?php echo $this->IdAccion ?></td></tr>
                 <tr><th><?php echo $strings['Nombre de la accion'] ?></th><td><?php echo $this->NombreAccion ?></td></tr>
                <tr><th><?php echo $strings['Descripcion de la accion'] ?></th><td><?php echo $this->DescripAccion ?></td></tr>

                </table>
                    <div class="accionesTable">
                     <a href="../Controllers/ACCION_Controller.php?action=SHOWALL"><input type="image" name="action" value="SHOWALL" src="../Views/images/back.png" title="<?php echo $strings['Volver'] ?>"></a>
                 </div>

        </section>	
<?php
  include '../Views/Footer.php';

    }//fin de render()
}//fin de la clase
?>