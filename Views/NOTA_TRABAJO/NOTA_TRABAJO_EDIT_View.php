<?php
/*
//Clase : NOTA_TRABAJO_EDIT
//Creado el : 29-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Vista para que el administrador pueda editar las notas

*/
class NOTA_TRABAJO_EDIT{
    var $login; 
    var $IdTrabajo; 
    var $NotaTrabajo; 

function __construct($tupla){
    $this->login = $tupla['login'];
    $this->IdTrabajo = $tupla['IdTrabajo'];
    $this->NotaTrabajo = $tupla['NotaTrabajo'];
    $this->render();
}

function render(){

    include '../Views/Header.php';

?>

    <script type="text/javascript">
    
        <?php include '../Views/js/validacionesNOTA_TRABAJO.js'; ?>

    </script>

    <section class="pagina" style="min-height: 900px" >
        <fieldset class="edit" style="width: 70%; margin-left: 15%">
                <legend style="margin-left: 30%"><?php echo $strings['Editar Nota'] ?></legend>
            <form method="post" name="EDIT"  action="../Controllers/NOTA_TRABAJO_Controller.php">
                <div id="izquierda">
                    <label for="login"><?php echo $strings['Login'] ?>: </label>
                        <input type="text" name="login" maxlength="9" size="9" readonly value="<?php echo $this->login?>" onblur="javascript:void(validarLogin(this, 9))" ><div id="login" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="loginVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                <div id="izquierda">
                    <label for="IdTrabajo"><?php echo $strings['IdTrabajo']?>: </label>
                        <input type="text" name="IdTrabajo" maxlength="6" size="6" value="<?php echo $this->IdTrabajo?>"  onblur="javascript:void(validarIdTrabajo(this, 6))" ><div id="IdTrabajo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="IdTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                <div id="izquierda">
                    <label for="NotaTrabajo"><?php echo $strings['Nota Trabajo']?>: </label>
                        <input type="text" name="NotaTrabajo" maxlength="4" size="4" value="<?php echo $this->NotaTrabajo?>"  onblur="" ><div id="NotaTrabajo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="NotaTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>
        
                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                    <a href="../Controllers/NOTA_TRABAJO_Controller.php?action=EDIT"> <input type="image" name="action" value="EDIT" src="../Views/images/confirmar.png" title="<?php echo $strings['Enviar Formulario'] ?>" onclick="return validar('EDIT')"></a>
                </div>
            </form>                     
            <div class="acciones" style="float: left;">
                <a href="../Controllers/NOTA_TRABAJO_Controller.php?action=SHOWALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
            </div>
        </fieldset>
    </section>
<?php  
    include '../Views/Footer.php';
}   

}
?>