<?php
/*
//Clase : NOTA_TRABAJO_DELETE
//Creado el : 29-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Muestra la tabla de borrado de la nota seleccionada

*/
class NOTA_TRABAJO_DELETE{
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
    <section class="pagina" style="min-height: 500px">
        <table class="showcurrent">
            <caption><?php echo $strings['Borrar nota'] ?></caption>
                <tr><th><?php echo $strings['Campo'] ?></th><th><?php echo $strings['Valor'] ?></th></tr>
                <tr><th><?php echo $strings['Login'] ?></th><td><?php echo $this->login ?></td></tr>
                <tr><th><?php echo $strings['IdTrabajo'] ?></th><td><?php echo $this->IdTrabajo ?></td></tr>
                <tr><th><?php echo $strings['Nota Trabajo'] ?></th><td><?php echo $this->NotaTrabajo ?></td></tr>
        </table>

        <form method="post" name="DELETE" action="../Controllers/NOTA_TRABAJO_Controller.php">
            <input class="del" type="text" name="login" size="<?php echo strlen($this->login); ?>" readonly value="<?php echo $this->login ?>" >
            <input class="del" type="text" name="IdTrabajo" size="<?php echo strlen($this->IdTrabajo); ?>" readonly value="<?php echo $this->IdTrabajo ?>">
            <input class="del" type="text" name="NotaTrabajo"  size="<?php echo strlen($this->NotaTrabajo); ?>" readonly value="<?php echo $this->NotaTrabajo ?>">
              
            <div class="accionesTable" style="margin-left: 0%; float: right; margin-right: 45%">
                <a href="../Controllers/NOTA_TRABAJO_Controller.php?action=DELETE&login=<?php echo $this->login ?>&IdTrabajo=<?php echo $this->IdTrabajo ?>"><input type="image" name="action" value="DELETE" action="#" src="../Views/images/confirmar.png" title="<?php echo $strings['Borrar Nota'] ?>" ></a>
            </div>
        </form>

        <div class="accionesTable" style="float: left;">
            <a href="../Controllers/NOTA_TRABAJO_Controller.php?action=SHOWALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver'] ?>"></a>  
        </div>    
    </section>
<?php

  include '../Views/Footer.php';

    }
}
?>