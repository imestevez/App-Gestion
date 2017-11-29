<?php
/*
	Autor: SOLFAMIDAS
	Fecha de creación: 24/11/2017
	Descripción: Vista para añadir historias de usuario.

*/

class HISTORIA_EDIT{

   
    var $IdTrabajo; //atributo IdTrabajo
	var $IdHistoria; //atributo IdHistoria
	var $TextoHistoria; //atributo TextoHistoria
    var $lista; // array para almacenar los datos del usuario
    var $mysqli; // declaración del atributo manejador de la bd

function __construct($tupla){
    //Asignación de valores de parámetro a los atributos de la clase
		$this->IdTrabajo =  $tupla['IdTrabajo'];
		$this->IdHistoria = $tupla['IdHistoria'];
		$this->TextoHistoria = $tupla['TextoHistoria'];

    $this->render();
}

//funcion que muestra los datos al usuario

function render(){

include '../Views/Header.php';
?>

            <script type="text/javascript">
    
            <?php include '../Views/js/validacionesHISTORIA.js'; ?>

            </script>

    <section class="pagina">
         <fieldset class="edit" style="width: 70%; margin-left: 15%">
                <legend style="margin-left: 30%"><?php echo $strings['Editar historia'] ?></legend>
            <form method="post" name="ÈDIT"  action="../Controllers/HISTORIA_Controller.php" enctype="multipart/form-data" >
                <div id="izquierda">
                    <label for="IdTrabajo"><?php echo $strings['Id del trabajo'] ?>: </label>
                        <input type="text" name="IdTrabajo" maxlength="6" size="6" readonly value="<?php echo $this->IdTrabajo?>" ><div id="IdTrabajo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="IdTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                <div id="izquierda">
                    <label for="IdHistoria"><?php echo $strings['Id de la historia']?>: </label>
                        <input type="number" name="IdHistoria" maxlength="2" size="2" value="<?php echo $this->IdHistoria?>"  readonly  ><div id="IdHistoria" class="oculto" style="display:none"><?php echo $strings['div_Numerico']?></div> <div id="IdHistoriaVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                <div id="izquierda">
                            <label for="TextoHistoria"><?php echo $strings['Texto de la historia'] ?>: </label>
                                <input type="text" name="TextoHistoria" maxlength="300" size="50" value="<?php echo $this->TextoHistoria?>" onblur="javascript:void(validarTextoHistoria(this, 300))"  ><div id="TextoHistoria" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="TextoHistoriaVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                        </div>
                    
                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                    <a href="../Controllers/HISTORIA_Controller.php?action=EDIT"> <input type="image" name="action" value="EDIT" src="../Views/images/confirmar.png" title="<?php echo $strings['Editar historia'] ?>" onclick="return validar('EDIT')"></a>
                </div>
             </form>                     
                <div class="acciones" style="float: left;">
                    <a href="../Controllers/HISTORIA_Controller.php?action=SHOWALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
                </div>
         </fieldset>
 
    </section>
<?php  
    include '../Views/Footer.php';
}   
}

?>