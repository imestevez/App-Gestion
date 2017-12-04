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

            <script type="text/javascript">
    
            <?php include '../Views/js/validacionesS.js'; ?>

            </script>

    <section class="pagina">
         <fieldset class="EDIT" >
                <legend style="margin-left: 30%"><?php echo $strings['Editar historia'] ?></legend>
            <form method="post" name="EDIT"  action="../Controllers/HISTORIA_Controller.php" enctype="multipart/form-data" >
               
                <div id="izquierda">
                    <label for="IdTrabajo"><?php echo $strings['Id del trabajo'] ?>: </label>
                        <input type="text" name="IdTrabajo" maxlength="6" size="6" onblur="validarIdTrabajo(this,6)" value="<?php echo $this->IdTrabajo?>" ><div id="IdTrabajo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="IdTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                <div id="izquierda">
                    <label for="IdHistoria"><?php echo $strings['Id de la historia']?>:</label>
                        <input type="number" name="IdHistoria" maxlength="2" size="2" min="0" max="99" value="<?php echo $this->IdHistoria?>" readonly onblur="validarIdHistoria(this, 0,99)"><div id="IdHistoria" class="oculto" style="display:none"><?php echo $strings['div_numeros']?></div> <div id="IdHistoriaMax" class="oculto" style="display:none"><?php echo $strings['div_numerosRango']?> </div> <div id="IdHistoriaVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                <div id="izquierda">
                    <label for="TextoHistoria"><?php echo $strings['Texto de la historia'] ?>: </label>
                        <textarea name="TextoHistoria" maxlength="300" rows="6" cols="50" onblur="javascript:void(validarTextoHistoria(this, 300))" style="margin-left: 10px; border-radius: 20px; border-top-left-radius: 0px; border-width: 2px; border-color: darkblue;" ><?php echo $this->TextoHistoria?></textarea><div id="TextoHistoria" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div><div id="TextoHistoriaVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

               
                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                    <a href="../Controllers/HISTORIA_Controller.php?action=EDIT"> <input type="image" name="action" value="EDIT" src="../Views/images/confirmar.png" title="<?php echo $strings['Enviar Formulario'] ?>" onclick="return validar('EDIT') "></a>
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