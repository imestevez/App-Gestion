<?php
/*
//Clase : ASIGNAC_QA_SHOWCURRENT
//Creado el : 08-12-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Muestra la tabla en detalle de la funcionalidad seleccionada 

*/
class ASIGNAC_QA_SHOWCURRENT{

    var $IdTrabajo; //declaración del atributo IdTrabajo de la accion
    var $NombreTrabajo; //declaración del atributo NombreTrabajo de la accion
    var $LoginEvaluador; //declaración del atributo LoginEvaluador
    var $LoginEvaluado; //declaración del atributo LoginEvaluado
    var $AliasEvaluado; //declaración del atributo AliasEvaluado 

function __construct($tupla){
    $this->IdTrabajo = $tupla['IdTrabajo'];
    $this->NombreTrabajo = $tupla['NombreTrabajo'];
    $this->LoginEvaluador = $tupla['LoginEvaluador'];
    $this->LoginEvaluado = $tupla['LoginEvaluado'];
    $this->AliasEvaluado = $tupla['AliasEvaluado'];
    $this->render();
}

function render(){

    include '../Views/Header.php';

?>
    <section class="pagina" style="min-height: 900px">
        <table class="showcurrent">
            <caption><?php echo $strings['Asignación de QA'] ?></caption>
                <tr><th><?php echo $strings['Campo'] ?></th><th><?php echo $strings['Valor'] ?></th></tr>
                <tr><th><?php echo $strings['Id del trabajo'] ?></th><td><?php echo $this->IdTrabajo ?></td></tr>
                <tr><th><?php echo $strings['Nombre del trabajo'] ?></th><td><?php echo $this->NombreTrabajo ?></td></tr>
                <tr><th><?php echo $strings['Login del evaluador'] ?></th><td><?php echo $this->LoginEvaluador ?></td></tr>
                <tr><th><?php echo $strings['Login del evaluado'] ?></th><td><?php echo $this->LoginEvaluado ?></td></tr>
                <tr><th><?php echo $strings['Alias del evaluado'] ?></th><td><?php echo $this->AliasEvaluado ?></td></tr>
        </table>

        <div class="accionesTable">
            <a href="../Controllers/ASIGNAC_QA_Controller.php?action=SHOWALL"><input type="image" name="action" value="SHOWALL" src="../Views/images/back.png" title="<?php echo $strings['Volver'] ?>"></a>
        </div>
    </section>	
<?php
  include '../Views/Footer.php';
}

}
?>