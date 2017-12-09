<?php
/*
//Clase : ASIGNAC_QA_EDIT
//Creado el : 07-12-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Vista para editar una asignación de QA

*/
class ASIGNAC_QA_EDIT{

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

    <script type="text/javascript">
    
        <?php include '../Views/js/validacionesASIGNAC_QA.js'; ?>

    </script>

    <section class="pagina" style="min-height: 900px" >
        <fieldset class="edit" style="width: 70%; margin-left: 15%">
                <legend style="margin-left: 30%"><?php echo $strings['Editar asignación de QA'] ?></legend>
            <form method="post" name="EDIT"  action="../Controllers/ASIGNAC_QA_Controller.php">
                <div id="izquierda">
                    <label for="IdTrabajo"><?php echo $strings['Id del trabajo'] ?>: </label>
                        <input type="text" name="IdTrabajo" maxlength="6" size="6" readonly value="<?php echo $this->IdTrabajo?>">
                </div>

               

                <div id="izquierda">
                    <label for="IdTrabajo"><?php echo $strings['Id del trabajo'] ?>: </label>
                        <input type="text" name="IdTrabajo" maxlength="6" size="6" readonly value="<?php echo $this->IdTrabajo?>" onblur="javascript:void(validarIdFuncionalidad(this, 6))" ><div id="IdTrabajo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="IdFuncionalidadVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                <div id="izquierda">
                    <label for="IdTrabajo"><?php echo $strings['Id del trabajo'] ?>: </label>
                        <input type="text" name="IdTrabajo" maxlength="6" size="6" readonly value="<?php echo $this->IdTrabajo?>" onblur="javascript:void(validarIdFuncionalidad(this, 6))" ><div id="IdTrabajo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="IdFuncionalidadVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                
        
                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                    <a href="../Controllers/ASIGNAC_QA_Controller.php?action=EDIT"> <input type="image" name="action" value="EDIT" src="../Views/images/confirmar.png" title="<?php echo $strings['Enviar Formulario'] ?>" onclick="return validar('EDIT')"></a>
                </div>
            </form>                     
            <div class="acciones" style="float: left;">
                <a href="../Controllers/ASIGNAC_QA_Controller.php?action=SHOWALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
            </div>
        </fieldset>
    </section>
<?php  
    include '../Views/Footer.php';
}   

}
?>