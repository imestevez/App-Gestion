<?php
/*
//Clase : ASIGNAC_QA_DELETE
//Creado el : 27-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Muestra la tabla de borrado de la funcionalidad seleccionada

*/
class ASIGNAC_QA_DELETE{

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
    <section class="pagina" style="min-height: 500px">
        <table class="showcurrent">
            <caption><?php echo $strings['Borrar asignación de QA'] ?></caption>
                <tr><th><?php echo $strings['Campo'] ?></th><th><?php echo $strings['Valor'] ?></th></tr>

                <tr>
                    <th><?php echo $strings['Id del trabajo'] ?></th><td><?php echo $this->IdTrabajo ?></td>
                </tr>
                <tr>
                    <th><?php echo $strings['Nombre del trabajo'] ?></th><td><?php echo $this->NombreTrabajo ?></td>
                </tr>
                <tr>
                    <th><?php echo $strings['Login del evaluador'] ?></th><td><?php echo $this->LoginEvaluador ?></td>
                </tr>
                <tr>
                    <th><?php echo $strings['Login del evaluado'] ?></th><td><?php echo $this->LoginEvaluado ?></td>
                </tr>
                <tr>
                    <th><?php echo $strings['Alias del evaluado'] ?></th><td><?php echo $this->AliasEvaluado ?></td>
                </tr>

        </table>

        <form method="post" name="DELETE" action="../Controllers/ASIGNAC_QA_Controller.php">
            <input class="del" type="text" name="IdTrabajo" size="<?php echo strlen($this->IdTrabajo); ?>" readonly value="<?php echo $this->IdTrabajo ?>" >
            <input class="del" type="text" name="NombreTrabajo" size="<?php echo strlen($this->NombreTrabajo); ?>" readonly value="<?php echo $this->NombreTrabajo ?>" >
            <input class="del" type="text" name="LoginEvaluador" size="<?php echo strlen($this->LoginEvaluador); ?>" readonly value="<?php echo $this->LoginEvaluador ?>" >
            <input class="del" type="text" name="LoginEvaluado" size="<?php echo strlen($this->LoginEvaluado); ?>" readonly value="<?php echo $this->LoginEvaluado ?>" >
            <input class="del" type="text" name="AliasEvaluado" size="<?php echo strlen($this->AliasEvaluado); ?>" readonly value="<?php echo $this->AliasEvaluado ?>" >
            
              
            <div class="accionesTable" style="margin-left: 0%; float: right; margin-right: 45%">
                <a href="../Controllers/ASIGNAC_QA_Controller.php?action=DELETE&IdTrabajo=<?php echo $this->IdTrabajo ?>&LoginEvaluador=<?php echo $this->LoginEvaluador ?>&AliasEvaluado=<?php echo $this->AliasEvaluado ?>"><input type="image" name="action" value="DELETE" action="#" src="../Views/images/confirmar.png" title="<?php echo $strings['Borrar asignación de QA'] ?>" ></a>
            </div>
        </form>

        <div class="accionesTable" style="float: left;">
            <a href="../Controllers/ASIGNAC_QA_Controller.php?action=ALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver'] ?>"></a>  
        </div>    
    </section>
<?php

  include '../Views/Footer.php';

    }
}
?>