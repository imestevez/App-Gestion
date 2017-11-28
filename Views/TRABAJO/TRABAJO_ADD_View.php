<?php
/*

//Clase : TRABAJO_ADD
//Creado el : 25-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Vista para que el  usuario pueda crear trabajos en el sistema

*/

class TRABAJO_ADD {
   function __construct(){
    $this->render();
   }

//funcion que muestra los datos al usuario

function render(){

include '../Views/Header.php';
?>

<script type="text/javascript">
    
    <?php include '../Views/js/validaciones.js'; ?>

</script>

     <section class="pagina">
         <fieldset class="add" >
                <legend style="margin-left: 30%"><?php echo $strings['Añadir trabajo'] ?></legend>
            <form method="post" name="ADD"  action="../Controllers/TRABAJO_Controller.php" enctype="multipart/form-data" >
                <div id="izquierda">
                    <label for="IdTrabajo"><?php echo $strings['IdTrabajo'] ?>: </label>
                        <input type="text" name="IdTrabajo" maxlength="6" size="6" onblur=""  ><div id="IdTrabajo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="IdTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                <div id="izquierda">
                    <label for="NombreTrabajo"><?php echo $strings['NombreTrabajo']?>: </label>
                        <input type="text" name="NombreTrabajo" maxlength="60" size="60" onblur=""  ><div id="NombreTrabajo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="NombreTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

				<div id="izquierda">
                
                <label for="FechaIniTrabajo"><?php echo $strings['FechaIniTrabajo']?>: </label>
                          <input type="text" id="fechnacuser" name="FechaIniTrabajo" class="tcal" size="10" readonly onblur="javascript:void(validarFecha(this))" onmouseover="javascript:void(validarFecha(this))" ><div id="FechaIniTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div><div id="FechaIniTrabajo" class="oculto" style="display:none"><?php echo $strings['div_fecha']?></div> 
                </div>

                <div id="izquierda">
                
                 <label for="FechaFinTrabajo"><?php echo $strings['FechaFinTrabajo']?>: </label>
                          <input type="text" id="fechnacuser" name="FechaFinTrabajo" class="tcal" size="10" readonly onblur="javascript:void(validarFecha(this))" onmouseover="javascript:void(validarFecha(this))" ><div id="FechaFinTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div><div id="FechaFinTrabajo" class="oculto" style="display:none"><?php echo $strings['div_fecha']?></div> 
                </div>

                <div id="izquierda">
                    <label for="PorcentajeNota"><?php echo $strings['PorcentajeNota']?>:</label>
                        <input type="text" name="PorcentajeNota" maxlength="2" size="2"  onblur=""  ><div id="PorcentajeNota" class="oculto" style="display:none"><?php echo $strings['div_letras']?></div> <div id="PorcentajeNotaVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>
               
                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                    <a href="../Controllers/TRABAJO_Controller.php?action=ADD"> <input type="image" name="action" value="ADD" src="../Views/images/confirmar.png" title="<?php echo $strings['Enviar Formulario'] ?>" onclick="return validar('ADD') "></a>
                </div>
             </form>                     
                <div class="acciones" style="float: left;">
                     <a href="../Controllers/TRABAJO_Controller.php?action=SHOWALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
                </div>
         </fieldset> 
    </section>
<?php
        include '../Views/Footer.php';
    }

}

?>
