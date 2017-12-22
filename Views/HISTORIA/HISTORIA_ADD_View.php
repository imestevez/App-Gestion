
<?php
/*

//Clase : HISTORIA_ADD
//Creado el : 25-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Vista para que el  usuario pueda crear historias en el sistema

*/

class HISTORIA_ADD {

    var $IdTrabajo;
    var $NombreTrabajo;

   function __construct($lista){
    if($lista['IdTrabajo'] <> ''){
        $this->IdTrabajo = $lista['IdTrabajo'];
        $this->NombreTrabajo = $lista['NombreTrabajo'];

        $this->render_add_from_trabajo();
    }

    else $this->render();
   }

//funcion que muestra los datos al usuario

function render(){

include '../Views/Header.php';
?>

<script type="text/javascript">
    
    <?php include '../Views/js/validacionesHISTORIA.js'; ?>

</script>

     <section class="pagina">
         <fieldset class="add" >
                <legend style="margin-left: 30%"><?php echo $strings['Añadir historia'] ?></legend>
            <form method="post" name="ADD"  action="../Controllers/HISTORIA_Controller.php" enctype="multipart/form-data" >
               
                <div id="izquierda">
                    <label for="IdTrabajo"><?php echo $strings['Id del trabajo'] ?>: </label>
                        <input type="text" name="IdTrabajo" maxlength="6" size="6" onblur="validarIdTrabajo(this,6)"  ><div id="IdTrabajo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="IdTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                <div id="izquierda">
                    <label for="IdHistoria"><?php echo $strings['Id de la historia']?>:</label>
                        <input type="number" name="IdHistoria" maxlength="2" size="2" min="0" max="99"  onblur="validarIdHistoria(this, 0,99)"><div id="IdHistoria" class="oculto" style="display:none"><?php echo $strings['div_numeros']?></div> <div id="IdHistoriaMax" class="oculto" style="display:none"><?php echo $strings['div_numerosRango']?> </div> <div id="IdHistoriaVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>
        
                <div id="izquierda">
                    <label for="TextoHistoria"><?php echo $strings['Texto de la historia'] ?>: </label>
                        <textarea name="TextoHistoria" maxlength="300" rows="6" cols="50" onblur="javascript:void(validarTextoHistoria(this, 300))" style="margin-left: 10px; border-radius: 20px; border-top-left-radius: 0px; border-width: 2px; border-color: darkblue;" ></textarea><div id="TextoHistoria" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div><div id="TextoHistoriaVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>



               
                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                    <a href="../Controllers/HISTORIA_Controller.php?action=ADD"> <input type="image" name="action" value="ADD" src="../Views/images/confirmar.png" title="<?php echo $strings['Enviar Formulario'] ?>" onclick="return validar('ADD') "></a>
                </div>
             </form>                     
                <div class="acciones" style="float: left;">
                     <a href="../Controllers/HISTORIA_Controller.php?action=ALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
                </div>
         </fieldset> 
    </section>

<?php
        include '../Views/Footer.php';
    }

function render_add_from_trabajo(){
    include '../Views/Header.php';
?>

            <script type="text/javascript">
    
            <?php include '../Views/js/validacionesHISTORIA.js'; ?>

            </script>

     <section class="pagina">
         <fieldset class="add" >
                <legend style="margin-left: 30%"><?php echo $strings['Añadir historia'] ?></legend>
            <form method="post" name="ADD_FROM_TRABAJO"  action="../Controllers/HISTORIA_Controller.php" enctype="multipart/form-data" >
               
                <div id="izquierda">
                    <label for="IdTrabajo"><?php echo $strings['Id del trabajo'] ?>: </label>
                        <input type="text" name="IdTrabajo" maxlength="6" size="6" value="<?php echo $this->IdTrabajo?>" readonly >
                </div>

                <div id="izquierda">
                    <label for="NombreTrabajo"><?php echo $strings['Nombre del trabajo']?>: </label>
                        <input type="text" name="NombreTrabajo" maxlength="60" size="60" value="<?php echo $this->NombreTrabajo?>" readonly>
                </div>

                <div id="izquierda">
                    <label for="IdHistoria"><?php echo $strings['Id de la historia']?>:</label>
                        <input type="number" name="IdHistoria" maxlength="2" size="2" min="0" max="99"  onblur="validarIdHistoria(this, 0,99)"><div id="IdHistoria" class="oculto" style="display:none"><?php echo $strings['div_numeros']?></div> <div id="IdHistoriaMax" class="oculto" style="display:none"><?php echo $strings['div_numerosRango']?> </div> <div id="IdHistoriaVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>
        
                <div id="izquierda">
                    <label for="TextoHistoria"><?php echo $strings['Texto de la historia'] ?>: </label>
                        <textarea name="TextoHistoria" maxlength="300" rows="6" cols="50" onblur="javascript:void(validarTextoHistoria(this, 300))" style="margin-left: 10px; border-radius: 20px; border-top-left-radius: 0px; border-width: 2px; border-color: darkblue;" ></textarea><div id="TextoHistoria" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div><div id="TextoHistoriaVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>
               
                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                    <a href="../Controllers/TRABAJO_Controller.php?action=ADD"> <input type="image" name="action" value="ADD" src="../Views/images/confirmar.png" title="<?php echo $strings['Enviar Formulario'] ?>" onclick="return validar('ADD_FROM_TRABAJO') "></a>
                </div>
             </form>                     
                <div class="acciones" style="float: left;">
                     <a href="../Controllers/TRABAJO_Controller.php?action=ALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
                </div>
         </fieldset> 
    </section>
<?php
        include '../Views/Footer.php';
}    


}


?>