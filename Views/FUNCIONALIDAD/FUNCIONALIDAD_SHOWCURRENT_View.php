<?php
/*
//Clase : FUNCIONALIDAD_SHOWCURRENT
//Creado el : 27-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Muestra la tabla en detalle de la funcionalidad seleccionada 

*/
class FUNCIONALIDAD_SHOWCURRENT{
    var $IdFuncionalidad; //declaración del atributo IdFuncionalidad
    var $NombreFuncionalidad; //declaración del atributo NombreFuncionalidad
    var $DescripFuncionalidad; //declaración del atributo DescripFuncionalidad

function __construct($tupla){
    $this->IdFuncionalidad = $tupla['IdFuncionalidad'];
    $this->NombreFuncionalidad = $tupla['NombreFuncionalidad'];
    $this->DescripFuncionalidad = $tupla['DescripFuncionalidad'];
    $this->render();
}

function render(){

    include '../Views/Header.php';

?>
    <section class="pagina" style="min-height: 900px">
        <table class="showcurrent">
            <caption><?php echo $strings['Funcionalidad'] ?></caption>
                <tr><th><?php echo $strings['Campo'] ?></th><th><?php echo $strings['Valor'] ?></th></tr>
                <tr><th><?php echo $strings['Id Funcionalidad'] ?></th><td><?php echo $this->IdFuncionalidad ?></td></tr>
                <tr><th><?php echo $strings['Nombre Funcionalidad'] ?></th><td><?php echo $this->NombreFuncionalidad ?></td></tr>
                <tr><th><?php echo $strings['Descripción Funcionalidad'] ?></th><td><?php echo $this->DescripFuncionalidad ?></td></tr>
        </table>

        <div class="accionesTable">
            <a href="../Controllers/FUNCIONALIDAD_Controller.php?action=ALL"><input type="image" name="action" value="SHOWALL" src="../Views/images/back.png" title="<?php echo $strings['Volver'] ?>"></a>
        </div>
    </section>	
<?php
  include '../Views/Footer.php';
}

}
?>