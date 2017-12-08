<?php
/*
//Clase : ASIGNAC_QA_ADD
//Creado el : 07/12/2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Vista para que el  administrador pueda crear funcionalidades en el sistema

*/

class ASIGNAC_QA_ADD{
function __construct(){
    $this->render();
}


function render(){

    include '../Views/Header.php';

?>

    <script type="text/javascript">
    
        <?php include '../Views/js/validacionesASIGNAC_QA.js'; ?>

    </script>

     <section class="pagina" style="min-height: 900px" >
         <fieldset class="add">
                <legend style="margin-left: 30%"><?php echo $strings['Añadir asignación de QA'] ?></legend>
            <form method="post" name="ADD"  action="../Controllers/ASIGNAC_QA_Controller.php">
                <div id="izquierda">
                    <label for="IdTrabajo"><?php echo $strings['Id del trabajo'] ?>: </label>
                        <input type="text" name="IdTrabajo" maxlength="6" size="6" onblur="javascript:void(validarIdTrabajo(this, 6))" ><div id="IdTrabajo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="IdFuncionalidadVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                <div id="izquierda">
                    <label for="LoginEvaluador"><?php echo $strings['Login del evaluador']?>: </label>
                        <input type="text" name="LoginEvaluador" maxlength="9" size="9" onblur="javascript:void(validarLoginEvaluador(this, 9))" ><div id="LoginEvaluador" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="LoginEvaluadorVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                 <div id="izquierda">
                    <label for="AliasEvaluado"><?php echo $strings['Alias del evaluado']?>: </label>
                        <input type="text" name="AliasEvaluado" maxlength="6" size="6" onblur="javascript:void(validarAliasEvaluado(this, 6))" ><div id="AliasEvaluado" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="AliasEvaluadoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

               
                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                    <a href="../Controllers/ASIGNAC_QA_Controller.php?action=ADD"> <input type="image" name="action" value="ADD" src="../Views/images/confirmar.png" title="<?php echo $strings['Enviar Formulario'] ?>" onclick="return validar('ADD')"></a>
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