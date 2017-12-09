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

    $this->render();
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
                        <input type="text" name="IdTrabajo" maxlength="6" value="<?php echo $this->IdTrabajo ?>" size="6" readonly  >
                </div>
                <div id="izquierda">
                    <label for="LoginEvaluador"><?php echo $strings['LoginEvaluador'] ?>: </label>
                        <input type="text" name="LoginEvaluador" maxlength="9" size="9" readonly value="<?php echo $this->LoginEvaluador ?>"> 
                </div>
                <div id="izquierda">
                    <label for="AliasEvaluado"><?php echo $strings['AliasEvaluado'] ?>: </label>
                        <input type="text" name="AliasEvaluado" maxlength="9" size="9" readonly value="<?php echo $this->AliasEvaluado ?>"> 
                </div>
                <div id="izquierda">
                    <label for="IdHistoria"><?php echo $strings['IdHistoria']?>:</label>
                        <input type="number" name="IdHistoria" maxlength="2" size="2" readonly value="<?php echo $this->IdHistoria ?>"> 
                </div>
                <div  id="izquierda">    
                    <label for="CorrectoA"><?php echo $strings['CorrectoA']?>: </label>
                    <input type="number" name="CorrectoA" maxlength="1" min="0" max="1" size="1" onblur="validarCorrecto(this,0,1)"  ><div id="CorrectoAMax" class="oculto" style="display:none"><?php echo $strings['div_CorrectoA']?></div>  
                </div>
                <div  id="izquierda">    
                    <label for="ComenIncorrectoA"><?php echo $strings['ComenIncorrectoA']?>: </label>
                    <textarea name="ComenIncorrectoA" maxlength="300" rows="6" cols="50" onblur="validarComentIncorrecto(this,300)" style="margin-left: 10px; border-radius: 20px; border-top-left-radius: 0px; border-width: 2px; border-color: darkblue;" ></textarea><div id="ComenIncorrectoAVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div>  
                </div>
                <div  id="izquierda">    
                    <label for="CorrectoP"><?php echo $strings['CorrectoP']?>: </label>
                    <input type="number" name="CorrectoP" maxlength="1" min="0" max="1" size="1" onblur="validarCorrecto(this,0,1)"  ><div id="CorrectoPMax" class="oculto" style="display:none"><?php echo $strings['div_CorrectoA']?></div>  
                </div>
                <div  id="izquierda">    
                    <label for="ComentIncorrectoP"><?php echo $strings['ComentIncorrectoP']?>: </label>
                    <textarea name="ComentIncorrectoP" maxlength="300" rows="6" cols="50" onblur="validarComentIncorrecto(this,300)" style="margin-left: 10px; border-radius: 20px; border-top-left-radius: 0px; border-width: 2px; border-color: darkblue;" ></textarea><div id="ComentIncorrectoPVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div>  
                </div>
                <div  id="izquierda">    
                    <label for="OK"><?php echo $strings['OK']?>: </label>
                    <input type="number" name="OK" maxlength="1" min="0" max="1" size="1" onblur="validarOK(this,0,1)"  ><div id="OK" class="oculto" style="display:none"><?php echo $strings['div_CorrectoA']?></div>  
                </div>

                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                    <a href="../Controllers/EVALUACION_Controller.php?action=EDIT"> <input type="image" name="action" value="EDIT" src="../Views/images/confirmar.png" title="<?php echo $strings['Enviar Formulario'] ?>" onclick="return validar('EDIT')"></a>
                </div>
             </form>                     
                <div class="acciones" style="float: left;">
                     <a href="../Controllers/EVALUACION_Controller.php?action=SHOWALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
                </div>
         </fieldset> 
    </section>
<?php
        include '../Views/Footer.php';
    }

}

?>
