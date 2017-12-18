<?php
/*

//Clase : EVALUACION_EDIT
//Creado el : 26-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Vista para que el  usuario pueda crear editar los tabajos

*/
class EVALUACION_EDIT{

    var $IdTrabajo; //atributo para almacenar el IdTrabajo de un trabajo
    var $LoginEvaluador; //atributo para almacenar el LoginEvaluador del evaluador
    var $AliasEvaluado; //atributo para almacenar el AliasEvaluado del usuario evaluado
    var $IdHistoria; //atributo para almacenar el IdHistoria de la historia en cuestion
    var $CorrectoA; //atributo para almacenar el valor Correcto del alumno evaluador
    var $ComenIncorrectoA; //atributo para almacenar el comentario incorrecto del alumno evaluador
    var $CorrectoP; //atributo para almacenar el valor Correcto del profesor
    var $ComentIncorrectoP; //atributo para almacenar el comentario incorrecto del profesor
    var $OK; //atributo para almacenar el resultado (1 - 0) de la evaluacion de la QA
    

function __construct($lista){
    //asignación de valores de parámetro a los atributos de la clase
    $this->IdTrabajo = $lista['IdTrabajo'];
    $this->LoginEvaluador = $lista['LoginEvaluador'];
    $this->AliasEvaluado = $lista['AliasEvaluado'];
    $this->IdHistoria = $lista['IdHistoria'];
    $this->CorrectoA = $lista['CorrectoA'];
    $this->ComenIncorrectoA = $lista['ComenIncorrectoA'];
    $this->CorrectoP = $lista['CorrectoP'];
    $this->ComentIncorrectoP = $lista['ComentIncorrectoP'];
    $this->OK = $lista['OK'];

    $this->renderADMIN();
}

//funcion que muestra los datos al usuario

function render(){

include '../Views/Header.php';
?>

<script type="text/javascript">
    
    <?php 
        include '../Views/js/validacionesEVALUACION.js'; 
    ?>

</script>


     <section class="pagina">
         <fieldset class="edit" style="width: 70%; margin-left: 15%">
                <legend style="margin-left: 30%"><?php echo $strings['Editar evaluacion'] ?></legend>
            <form method="post" name="EDIT"  action="../Controllers/EVALUACION_Controller.php" enctype="multipart/form-data" >
                <div id="izquierda">
                    <label for="IdTrabajo"><?php echo $strings['IdTrabajo'] ?>: </label>
                        <input type="text" name="IdTrabajo" maxlength="6" value="<?php echo $this->IdTrabajo ?>" size="6" readonly  ><div id="IdTrabajo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="IdTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div>
                </div>
                <div id="izquierda">
                    <label for="LoginEvaluador"><?php echo $strings['LoginEvaluador'] ?>: </label>
                        <input type="text" name="LoginEvaluador" maxlength="9" size="9" readonly value="<?php echo $this->LoginEvaluador ?>"><div id="LoginEvaluador" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="LoginEvaluadorVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>
                <div id="izquierda">
                    <label for="AliasEvaluado"><?php echo $strings['AliasEvaluado'] ?>: </label>
                        <input type="text" name="AliasEvaluado" maxlength="9" size="9" readonly value="<?php echo $this->AliasEvaluado ?>"><div id="AliasEvaluado" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="AliasEvaluadoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>
                <div id="izquierda">
                    <label for="IdHistoria"><?php echo $strings['IdHistoria']?>:</label>
                        <input type="number" name="IdHistoria" maxlength="2" size="2" readonly value="<?php echo $this->IdHistoria ?>"><div id="IdHistoria" class="oculto" style="display:none"><?php echo $strings['div_numeros']?></div> <div id="IdHistoriaMax" class="oculto" style="display:none"><?php echo $strings['div_numerosRango']?> </div><div id="IdHistoriaVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div>
                </div>
                <div  id="izquierda">    
                    <label for="CorrectoA"><?php echo $strings['CorrectoA']?>: </label> 
                    <select name="CorrectoA" style="margin-left: 2%">
                        <option value="<?php echo $this->CorrectoA ?>" selected><?php echo $this->CorrectoA ?></option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                          
                    </select>
                </div>
                <div  id="izquierda">    
                    <label for="ComenIncorrectoA"><?php echo $strings['ComenIncorrectoA']?>: </label>
                    <textarea name="ComenIncorrectoA" maxlength="300" rows="6" cols="50" onblur="validarComentIncorrecto(this,300)" style="margin-left: 10px; border-radius: 20px; border-top-left-radius: 0px; border-width: 2px; border-color: darkblue;" > <?php echo $this->ComenIncorrectoA ?></textarea><div id="ComenIncorrectoA" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> 
                </div>

                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                    <a href="../Controllers/EVALUACION_Controller.php?action=SHOW&LoginEvaluador=<?php echo $this->LoginEvaluador ?>&IdTrabajo=<?php echo $this->IdTrabajo ?>&IdHistoria=<?php echo $this->IdHistoria ?>&AliasEvaluado=<?php echo $this->AliasEvaluado ?>"> <input type="image" name="action" value="SHOW" src="../Views/images/confirmar.png" title="<?php echo $strings['Enviar Formulario'] ?>" onclick="return validar('EDIT')"></a>
                </div>
             </form>                     
                <div class="acciones" style="float: left;">
                     <a href="../Controllers/EVALUACION_Controller.php?action=SHOW&LoginEvaluador=<?php echo $this->LoginEvaluador ?>&IdTrabajo=<?php echo $this->IdTrabajo ?>&IdHistoria=<?php echo $this->IdHistoria ?>&AliasEvaluado=<?php echo $this->AliasEvaluado ?>"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
                </div>
         </fieldset> 
    </section>
<?php
        include '../Views/Footer.php';
    }











    //funcion que muestra los datos al usuario

function renderADMIN(){

include '../Views/Header.php';
?>

<script type="text/javascript">
    
    <?php 
        include '../Views/js/validacionesEVALUACION.js'; 
    ?>

</script>


     <section class="pagina">
         <fieldset class="edit" style="width: 70%; margin-left: 15%">
                <legend style="margin-left: 30%"><?php echo $strings['Editar evaluacion'] ?></legend>
            <form method="post" name="EDITP"  action="../Controllers/EVALUACION_Controller.php" enctype="multipart/form-data" >
                <div id="izquierda">
                    <label for="IdTrabajo"><?php echo $strings['IdTrabajo'] ?>: </label>
                        <input type="text" name="IdTrabajo" maxlength="6" value="<?php echo $this->IdTrabajo ?>" size="6" readonly  ><div id="IdTrabajo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="IdTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div>
                </div>
                <div id="izquierda">
                    <label for="LoginEvaluador"><?php echo $strings['LoginEvaluador'] ?>: </label>
                        <input type="text" name="LoginEvaluador" maxlength="9" size="9" readonly value="<?php echo $this->LoginEvaluador ?>"><div id="LoginEvaluador" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="LoginEvaluadorVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>
                <div id="izquierda">
                    <label for="AliasEvaluado"><?php echo $strings['AliasEvaluado'] ?>: </label>
                        <input type="text" name="AliasEvaluado" maxlength="9" size="9" readonly value="<?php echo $this->AliasEvaluado ?>"><div id="AliasEvaluado" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="AliasEvaluadoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>
                <div id="izquierda">
                    <label for="IdHistoria"><?php echo $strings['IdHistoria']?>:</label>
                        <input type="number" name="IdHistoria" maxlength="2" size="2" readonly value="<?php echo $this->IdHistoria ?>"><div id="IdHistoria" class="oculto" style="display:none"><?php echo $strings['div_numeros']?></div> <div id="IdHistoriaMax" class="oculto" style="display:none"><?php echo $strings['div_numerosRango']?> </div><div id="IdHistoriaVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div>
                </div>
                <div  id="izquierda">    
                    <label for="CorrectoA"><?php echo $strings['CorrectoA']?>: </label> 
                    <select name="CorrectoA" style="margin-left: 2%">
                        <option value="<?php echo $this->CorrectoA ?>" selected><?php echo $this->CorrectoA ?></option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                          
                    </select>
                </div>
                <div  id="izquierda">    
                    <label for="ComenIncorrectoA"><?php echo $strings['ComenIncorrectoA']?>: </label>
                    <textarea name="ComenIncorrectoA" maxlength="300" rows="6" cols="50" onblur="validarComentIncorrecto(this,300)" style="margin-left: 10px; border-radius: 20px; border-top-left-radius: 0px; border-width: 2px; border-color: darkblue;" > <?php echo $this->ComenIncorrectoA ?></textarea><div id="ComenIncorrectoA" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> 
                </div>
                <div  id="izquierda">    
                    <label for="CorrectoP"><?php echo $strings['CorrectoP']?>: </label> 
                    <select name="CorrectoP" style="margin-left: 2%">
                        <option value="<?php echo $this->CorrectoP ?>" selected><?php echo $this->CorrectoP ?></option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                          
                    </select>
                </div>
                <div  id="izquierda">    
                    <label for="ComentIncorrectoP"><?php echo $strings['ComentIncorrectoP']?>: </label>
                    <textarea name="ComentIncorrectoP" maxlength="300" rows="6" cols="50" onblur="validarComentIncorrecto(this,300)" style="margin-left: 10px; border-radius: 20px; border-top-left-radius: 0px; border-width: 2px; border-color: darkblue;" > <?php echo $this->ComentIncorrectoP ?></textarea><div id="ComentIncorrectoP" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> 
                </div>
                <div  id="izquierda">    
                    <label for="OK"><?php echo $strings['OK']?>: </label>
                    <select name="OK" style="margin-left: 2%">
                        <option value="<?php echo $this->OK ?>" selected><?php echo $this->OK ?></option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                          
                    </select>  
                </div>

                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                    <a href="../Controllers/EVALUACION_Controller.php?action=SHOW&LoginEvaluador=<?php echo $this->LoginEvaluador ?>&IdTrabajo=<?php echo $this->IdTrabajo ?>&IdHistoria=<?php echo $this->IdHistoria ?>&AliasEvaluado=<?php echo $this->AliasEvaluado ?>"> <input type="image" name="action" value="SHOW" src="../Views/images/confirmar.png" title="<?php echo $strings['Enviar Formulario'] ?>" onclick="return validar('EDITP')"></a>
                </div>
             </form>                     
                <div class="acciones" style="float: left;">
                     <a href="../Controllers/EVALUACION_Controller.php?action=SHOW&LoginEvaluador=<?php echo $this->LoginEvaluador ?>&IdTrabajo=<?php echo $this->IdTrabajo ?>&IdHistoria=<?php echo $this->IdHistoria ?>&AliasEvaluado=<?php echo $this->AliasEvaluado ?>"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
                </div>
         </fieldset> 
    </section>
<?php
        include '../Views/Footer.php';
    }



}

?>
