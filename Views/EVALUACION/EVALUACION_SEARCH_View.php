<?php
/*

//Clase : EVALUACION_SEARCH
//Creado el : 29-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Vista para que el  usuario pueda crear trabajos en el sistema

*/

class EVALUACION_SEARCH {
   function __construct(){
    $this->render();
   }

//funcion que muestra los datos al usuario

function render(){

include '../Views/Header.php';
?>

<script type="text/javascript">
    
    <?php include '../Views/js/validacionesEVALUACION.js'; ?>

</script>


     <section class="pagina">
         <fieldset class="add" style="width: 70%; margin-left: 15%">
                <legend style="margin-left: 30%"><?php echo $strings['Buscar evaluacion'] ?></legend>
            <form method="post" name="SEARCH"  action="../Controllers/EVALUACION_Controller.php" enctype="multipart/form-data" >
                <div id="izquierda">
                    <label for="LoginEvaluador"><?php echo $strings['LoginEvaluador'] ?>: </label>
                        <input type="text" name="LoginEvaluador" maxlength="9" size="9" onblur="validarloginBuscar(this,9)"  ><div id="LoginEvaluador" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> 
                </div>
              
                <div id="izquierda">
                    <label for="IdTrabajo"><?php echo $strings['IdTrabajo'] ?>: </label>
                        <input type="text" name="IdTrabajo" maxlength="6" size="6" onblur="validarIdTrabajoBuscar(this,6)"  ><div id="IdTrabajo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> 
                </div>

                 <div id="izquierda">
                    <label for="AliasEvaluado"><?php echo $strings['AliasEvaluado'] ?>: </label>
                        <input type="text" name="AliasEvaluado" maxlength="9" size="9" onblur="validarAliasBuscar(this,9)"  ><div id="AliasEvaluado" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> 
                </div>


                <div id="izquierda">
                    <label for="IdHistoria"><?php echo $strings['IdHistoria']?>:</label>
                        <input type="number" name="IdHistoria" maxlength="2" size="2" min="0" max="99"  onblur="validarIdHistoriaBuscar(this)"><div id="IdHistoria" class="oculto" style="display:none"><?php echo $strings['div_numeros']?></div> <div id="IdHistoriaMax" class="oculto" style="display:none"><?php echo $strings['div_numerosRango']?> </div> 
                </div>
                <div  id="izquierda">    
                    <label for="CorrectoA"><?php echo $strings['CorrectoA']?>: </label>
                    <input type="number" name="CorrectoA" maxlength="1" min="0" max="1" size="1" onblur="validarCorrectoBuscar(this)"  ><div id="CorrectoA" class="oculto" style="display:none"><?php echo $strings['div_numeros']?></div><div id="CorrectoAMax" class="oculto" style="display:none"><?php echo $strings['div_CorrectoA']?></div>  
                </div>
                <div  id="izquierda">    
                    <label for="ComenIncorrectoA"><?php echo $strings['ComenIncorrectoA']?>: </label>
                    <textarea name="ComenIncorrectoA" maxlength="300" rows="6" cols="50" onblur="validarComentIncorrectoBuscar(this, 300)" style="margin-left: 10px; border-radius: 20px; border-top-left-radius: 0px; border-width: 2px; border-color: darkblue;" ></textarea><div id="ComenIncorrectoA" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div>
                </div>
                <div  id="izquierda">    
                    <label for="CorrectoP"><?php echo $strings['CorrectoP']?>: </label>
                    <input type="number" name="CorrectoP" maxlength="1" min="0" max="1" size="1" onblur="validarCorrectoBuscar(this)"  ><div id="CorrectoP" class="oculto" style="display:none"><?php echo $strings['div_numeros']?></div><div id="CorrectoPMax" class="oculto" style="display:none"><?php echo $strings['div_CorrectoA']?></div>  
                </div>
                <div  id="izquierda">    
                    <label for="ComentIncorrectoP"><?php echo $strings['ComentIncorrectoP']?>: </label>
                    <textarea name="ComentIncorrectoP" maxlength="300" rows="6" cols="50" onblur="validarComentIncorrectoBuscar(this, 300)" style="margin-left: 10px; border-radius: 20px; border-top-left-radius: 0px; border-width: 2px; border-color: darkblue;" ></textarea><div id="ComentIncorrectoP" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div>  
                </div>
                <div  id="izquierda">    
                    <label for="OK"><?php echo $strings['OK']?>: </label>
                    <input type="number" name="OK" maxlength="1" min="0" max="1" size="1" onblur="validarOKBuscar(this)"  ><div id="OK" class="oculto" style="display:none"><?php echo $strings['div_numeros']?></div><div id="OKMax" class="oculto" style="display:none"><?php echo $strings['div_CorrectoA']?></div>  
                </div>

               <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                   
                     <a href="../Controllers/EVALUACION_Controller.php?action=SEARCH"><input type="image" name="action" value="SEARCH" action="#" src="../Views/images/search.png" title="<?php echo $strings['Buscar']?>" onclick="return validar('SEARCH')" ></a>
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