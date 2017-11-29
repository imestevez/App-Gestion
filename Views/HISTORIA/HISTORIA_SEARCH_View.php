<?php
/*
	Autor: SOLFAMIDAS
	Fecha de creación: 27/11/2017
	Descripción: Vista para buscar historias de usuario.

*/

		class HISTORIA_SEARCH{

		function __construct(){

			$this->render();

		}

		function render(){
			include '../Views/Header.php'; 
?>
    
	<script type="text/javascript">
    
            <?php include '../Views/js/validacionesHISTORIA.js'; ?>

            </script>
			<section class="pagina">
         <fieldset class="SEARCH" >
                <legend style="margin-left: 30%"><?php echo $strings['Buscar historia'] ?></legend>
            <form method="post" name="SEARCH"  action="../Controllers/HISTORIA_Controller.php" enctype="multipart/form-data" >
               
                <div id="izquierda">
                    <label for="IdTrabajo"><?php echo $strings['Id del trabajo'] ?>: </label>
                        <input type="text" name="IdTrabajo" maxlength="6" size="6" onblur="validarIdTrabajoBuscar(this,6)"  ><div id="IdTrabajo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="IdTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                <div id="izquierda">
                    <label for="IdHistoria"><?php echo $strings['Id de la historia']?>:</label>
                        <input type="number" name="IdHistoria" maxlength="2" size="2" min="0" max="99"  onblur="validarIdHistoriaBuscar(this, 0,99)"><div id="IdHistoria" class="oculto" style="display:none"><?php echo $strings['div_numeros']?></div> <div id="IdHistoriaMax" class="oculto" style="display:none"><?php echo $strings['div_numerosRango']?> </div> <div id="IdHistoriaVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                <div id="izquierda">
                    <label for="TextoHistoria"><?php echo $strings['Texto de la historia'] ?>: </label>
                        <textarea name="TextoHistoria" maxlength="300" rows="6" cols="50" onblur="javascript:void(validarTextoHistoriaBuscar(this, 300))" style="margin-left: 10px; border-radius: 20px; border-top-left-radius: 0px; border-width: 2px; border-color: darkblue;" ></textarea><div id="TextoHistoria" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div><div id="TextoHistoriaVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

               
                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                    <a href="../Controllers/HISTORIA_Controller.php?action=SEARCH"> <input type="image" name="action" value="SEARCH" src="../Views/images/confirmar.png" title="<?php echo $strings['Buscar'] ?>" onclick="return validar('SEARCH') "></a>
                </div>
             </form>                     
                <div class="acciones" style="float: left;">
                     <a href="../Controllers/HISTORIA_Controller.php?action=SHOWALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
                </div>
         </fieldset> 
    </section>
		}

	}
<?php

		include '../Views/Footer.php';
    }

}

?>