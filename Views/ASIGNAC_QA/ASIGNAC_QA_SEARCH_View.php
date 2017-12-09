<?php
/*
//Clase : ASIGNAC_QA_SEARCH
//Creado el : 08-12-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Muestra el formulario de búsqueda de funcionalidades con todos los campos de funcionalidades

*/
class ASIGNAC_QA_SEARCH{
function __construct(){
    $this->render();
}

function render(){

  include '../Views/Header.php';

?>

    <script type="text/javascript"> 
        <?php include '../Views/js/validacionesASIGNAC_QA.js' ?>
    </script>

    <section class="pagina" style="min-height: 900px" >
        <fieldset class="search">
                <legend style="margin-left: 30%"><?php echo $strings['Buscar asignación de QA']?></legend>
            <form method="post" name="SEARCH" action="../Controllers/ASIGNAC_QA_Controller.php">
                <div id="izquierda">
                    <label for="IdTrabajo"><?php echo $strings['Id del trabajo'] ?>: </label>
                        <input type="text" name="IdTrabajo" maxlength="6" size="6" onblur="javascript:void(validarIdTrabajoBuscar(this, 6))" ><div id="IdTrabajo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="IdTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                <div id="izquierda">
                    <label for="NombreTrabajo"><?php echo $strings['Nombre del trabajo']?>: </label>
                        <input type="text" name="NombreTrabajo" maxlength="60" size="60"  onblur="javascript:void(validarNombreTrabajoBuscar(this, 60))" ><div id="NombreTrabajo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="NombreTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                 <div id="izquierda">
                    <label for="LoginEvaluador"><?php echo $strings['Login del evaluador']?>: </label>
                        <input type="text" name="LoginEvaluador" maxlength="9" size="9" onblur="javascript:void(validarLoginEvaluadorBuscar(this, 9))"><div id="LoginEvaluador" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div><div id="LoginEvaluadorVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                <div id="izquierda">
                    <label for="LoginEvaluado"><?php echo $strings['Login del evaluado']?>: </label>
                        <input type="text" name="LoginEvaluado" maxlength="9" size="9" onblur="javascript:void(validarLoginEvaluadoBuscar(this, 9))" ><div id="LoginEvaluado" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div><div id="LoginEvaluadoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                <div id="izquierda">
                    <label for="AliasEvaluado"><?php echo $strings['Alias del evaluado']?>: </label>
                        <input type="text" name="AliasEvaluado" maxlength="6" size="6" onblur="javascript:void(validarAliasEvaluadoBuscar(this, 6))"  ><div id="AliasEvaluado" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div><div id="AliasEvaluadoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>
        
                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                     <a href="../Controllers/ASIGNAC_QA_Controller.php?action=SEARCH"><input type="image" name="action" value="SEARCH" action="#" src="../Views/images/search.png" title="<?php echo $strings['Buscar']?>" onclick="return validar('SEARCH')"></a>
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