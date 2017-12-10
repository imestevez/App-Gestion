<?php
/*
//Clase : NOTA_TRABAJO_SHOWCURRENT
//Creado el : 29-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Muestra la tabla en detalle de la nota seleccionada 

*/
class NOTA_TRABAJO_SHOWCURRENT{
     var $login; 
    var $IdTrabajo; 
    var $NotaTrabajo; 

function __construct($tupla){
    $this->login = $tupla['login'];
    $this->IdTrabajo = $tupla['IdTrabajo'];
    $this->NotaTrabajo = $tupla['NotaTrabajo'];
    $this->render();
}

function render(){

    include '../Views/Header.php';

?>
    <section class="pagina" style="min-height: 900px">
        <table class="showcurrent">
            <caption><?php echo $strings['Nota'] ?></caption>
                <tr><th><?php echo $strings['Campo'] ?></th><th><?php echo $strings['Valor'] ?></th></tr>
                <tr><th><?php echo $strings['Login'] ?></th><td><?php echo $this->login ?></td></tr>
                <tr><th><?php echo $strings['IdTrabajo'] ?></th><td><?php echo $this->IdTrabajo ?></td></tr>
                <tr><th><?php echo $strings['Nota Trabajo'] ?></th><td><?php echo $this->NotaTrabajo ?></td></tr>
        </table>

        <div class="accionesTable">
            <a href="../Controllers/NOTA_TRABAJO_Controller.php?action=SHOWALL"><input type="image" name="action" value="SHOWALL" src="../Views/images/back.png" title="<?php echo $strings['Volver'] ?>"></a>
        </div>
    </section>	
<?php
  include '../Views/Footer.php';
}

}
?>