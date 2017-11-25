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
         <fieldset class="add">
                <legend style="margin-left: 30%"><?php echo $strings[''] ?></legend>
            <form method="post" name="ADD"  action="../Controllers/TRABAJO_Controller.php" enctype="multipart/form-data" >
                <div id="izquierda">
                    <label for="IdTrabajo"><?php echo $strings[''] ?>: </label>
                        <input type="text" name="IdTrabajo" maxlength="20" size="20" onblur=""  ><div id="IdTrabajo" class="oculto" style="display:none"><?php echo $strings['']?></div> <div id="IdTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['']?></div> 
                </div>

                <div id="izquierda">
                    <label for="NombreTrabajo"><?php echo $strings['']?>: </label>
                        <input type="text" name="NombreTrabajo" maxlength="20" size="20" onblur=""  ><div id="NombreTrabajo" class="oculto" style="display:none"><?php echo $strings['']?></div> <div id="NombreTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['']?></div> 
                </div>

				<div id="izquierda">
                
                <label for="FechIniTrabajo"><?php echo $strings['']?>: </label>
                          <input type="text" id="fechnacuser" name="FechIniTrabajo" class="tcal" size="10" readonly onblur="javascript:void(validarFecha(this))" onmouseover="javascript:void(validarFecha(this))" ><div id="FechIniTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['']?></div><div id="FechIniTrabajo" class="oculto" style="display:none"><?php echo $strings['']?></div> 
                </div>

                 <label for="FechFinTrabajo"><?php echo $strings['']?>: </label>
                          <input type="text" id="fechnacuser" name="FechFinTrabajo" class="tcal" size="10" readonly onblur="javascript:void(validarFecha(this))" onmouseover="javascript:void(validarFecha(this))" ><div id="FechFinTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['']?></div><div id="FechFinTrabajo" class="oculto" style="display:none"><?php echo $strings['']?></div> 
                </div>

                <div id="izquierda">
                    <label for="PorcetajeNota"><?php echo $strings['']?>:</label>
                        <input type="text" name="PorcetajeNota" maxlength="20" size="20"  onblur=""  ><div id="PorcetajeNota" class="oculto" style="display:none"><?php echo $strings['']?></div> <div id="PorcetajeNotaVacio" class="oculto" style="display:none"><?php echo $strings['div_telefono_vacio']?></div> 
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
