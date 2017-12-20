<?php
/*
	Autor: SOLFAMIDAS
	Fecha de creación: 15/12/2017
	Descripción: Vista para la generación de historias a evaluar en EVALUACIÓN para un trabajo.

*/

	class ASIGNAC_QA_GENEV{

		function __construct(){

			$this->render();
		}

		//Función que muestra el formulario de asignación automática de QAs a usuarios
		function render(){
			include '../Views/Header.php';

?>
         <script type="text/javascript">
    
        <?php include '../Views/js/validacionesASIGNAC_QA.js'; ?>

        </script>


			<section class="pagina" style="min-height: 900px" >
       		<fieldset class="edit" style="width: 70%; margin-left: 15%">
                <legend style="margin-left: 30%"><?php echo $strings['Generación de historias a evaluar'] ?></legend>
            <form method="post" name="GENEV"  action="../Controllers/ASIGNAC_QA_Controller.php">

                <div id="izquierda">
                    <label for="IdTrabajo"><?php echo $strings['Id del trabajo'] ?>: </label>
                        <input type="text" name="IdTrabajo" maxlength="6" size="6" onblur="javascript:void(validarIdTrabajo(this, 6))" ><div id="IdTrabajo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="IdTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                 
            <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                    <a href="../Controllers/ASIGNAC_QA_Controller.php?action=GENEV"> <input type="image" name="action" value="GENEV" src="../Views/images/confirmar.png" title="<?php echo $strings['Enviar Formulario'] ?>" onclick="return validar('GENEV')"></a>
                </div>
            </form>                     
            <div class="acciones" style="float: left;">
                <a href="../Controllers/ASIGNAC_QA_Controller.php?action=ALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
            </div>
        </fieldset>
    </section>
<?php			
		}

	}

?>