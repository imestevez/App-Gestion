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
    
	<script type="text/javascript"><?php include '../Views/js/validaciones.js'; ?></script>

			<script type="text/javascript"><?php include '../Views/js/validacionesHISTORIA.js' ?></script>
			<section class="pagina" style="min-height: 500px">

				<fieldset class="add" style="width: 50%; margin-left: 20%">	 
                <legend><?php echo $strings['Buscar historia']; ?> </legend>

                	<form name="HISTORIA_SERACH" action="#" method="post" onsubmit="#">

                		<div id="izquierda">
                    		<label for="IdTrabajo"><?php echo $strings['Id del trabajo'] ?>: </label>
                        		<input type="text" name="IdTrabajo" maxlength="6" size="6" onblur="javascript:void(validarIdTrabajoBuscar(this, 6))"   ><div id="IdTrabajo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="IdTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                		</div>

                		<div id="izquierda">
                			<label for="IdHistoria"><?php echo $strings['Id de la historia'] ?>: </label>
                        		<input type="number" name="IdHistoria" maxlength="2" size="	2" onblur="javascript:void(validarIdHistoriaBuscar(this, 2))"  ><div id="IdHistoria" class="oculto" style="display:none"><?php echo $strings['div_Numerico']?></div> <div id="IdHistoriaVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                		</div>

                		<div id="izquierda">
                			<label for="TextoHistoria"><?php echo $strings['Texto de la historia'] ?>: </label>
                        		<input type="text" name="TextoHistoria" maxlength="300" size="50" onblur="javascript:void(validarTextoHistoriaBuscar(this, 300))"  ><div id="TextoHistoria" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="TextoHistoriaVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
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