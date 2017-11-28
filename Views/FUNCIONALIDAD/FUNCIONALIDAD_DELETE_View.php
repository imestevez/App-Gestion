<?php
/*
//Clase : FUNCIONALIDAD_DELETE
//Creado el : 27-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Muestra la tabla de borrado de la funcionalidad seleccionada

*/
class FUNCIONALIDAD_DELETE{
    var $IdFuncionalidad; 
    var $NombreFuncionalidad; 
    var $DescripFuncionalidad; 

function __construct($tupla){
    $this->IdFuncionalidad = $tupla['IdFuncionalidad'];
    $this->NombreFuncionalidad = $tupla['NombreFuncionalidad'];
    $this->DescripFuncionalidad = $tupla['DescripFuncionalidad'];
    $this->render();
}


function render(){

  include '../Views/Header.php';   

?>
    <section class="pagina" style="min-height: 500px">
        <table class="showcurrent">
            <caption><?php echo $strings['Borrar Funcionalidad'] ?></caption>
                <tr><th><?php echo $strings['Campo'] ?></th><th><?php echo $strings['Valor'] ?></th></tr>
                <tr><th><?php echo $strings['Id Funcionalidad'] ?></th><td><?php echo $this->IdFuncionalidad ?></td></tr>
                <tr><th><?php echo $strings['Nombre Funcionalidad'] ?></th><td><?php echo $this->NombreFuncionalidad ?></td></tr>
                <tr><th><?php echo $strings['Descripción Funcionalidad'] ?></th><td><?php echo $this->DescripFuncionalidad ?></td></tr>
        </table>

        <form method="post" name="DELETE" action="../Controllers/FUNCIONALIDAD_Controller.php">
            <input class="del" type="text" name="IdFuncionalidad" size="<?php echo strlen($this->IdFuncionalidad); ?>" readonly value="<?php echo $this->IdFuncionalidad ?>" >
            <input class="del" type="text" name="NombreFuncionalidad" size="<?php echo strlen($this->NombreFuncionalidad); ?>" readonly value="<?php echo $this->NombreFuncionalidad ?>">
            <input class="del" type="text" name="DescripFuncionalidad"  size="<?php echo strlen($this->DescripFuncionalidad); ?>" readonly value="<?php echo $this->DescripFuncionalidad ?>">
              
            <div class="accionesTable" style="margin-left: 0%; float: right; margin-right: 45%">
                <a href="../Controllers/FUNCIONALIDAD_Controller.php?action=DELETE&IdFuncionalidad=<?php echo $this->IdFuncionalidad ?>"><input type="image" name="action" value="DELETE" action="#" src="../Views/images/confirmar.png" title="<?php echo $strings['Borrar Funcionalidad'] ?>" ></a>
            </div>
        </form>

        <div class="accionesTable" style="float: left;">
            <a href="../Controllers/FUNCIONALIDAD_Controller.php?action=SHOWALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver'] ?>"></a>  
        </div>    
    </section>
<?php

  include '../Views/Footer.php';

    }
}
?>