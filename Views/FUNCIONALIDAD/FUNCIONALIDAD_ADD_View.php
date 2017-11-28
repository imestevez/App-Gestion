<?php
/*
//Clase : FUNCIONALIDAD_ADD
//Creado el : 27-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Vista para que el  administrador pueda crear funcionalidades en el sistema

*/

class FUNCIONALIDAD_ADD{
function __construct(){
    $this->render();
}


function render(){

    include '../Views/Header.php';

?>

    <script type="text/javascript">
    
        <?php include '../Views/js/validacionesFUNCIONALIDAD.js'; ?>

    </script>

     <section class="pagina" style="min-height: 900px" >
         <fieldset class="add">
                <legend style="margin-left: 30%"><?php echo $strings['Añadir Funcionalidad'] ?></legend>
            <form method="post" name="ADD"  action="../Controllers/FUNCIONALIDAD_Controller.php">
                <div id="izquierda">
                    <label for="IdFuncionalidad"><?php echo $strings['Id Funcionalidad'] ?>: </label>
                        <input type="text" name="IdFuncionalidad" maxlength="6" size="6" onblur="javascript:void(validarIdFuncionalidad(this, 6))" ><div id="IdFuncionalidad" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="IdFuncionalidadVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                <div id="izquierda">
                    <label for="NombreFuncionalidad"><?php echo $strings['Nombre Funcionalidad']?>: </label>
                        <input type="text" name="NombreFuncionalidad" maxlength="60" size="60" onblur="javascript:void(validarNombreFuncionalidad(this, 60))" ><div id="NombreFuncionalidad" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="NombreFuncionalidadVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

				<div id="izquierda">
                    <label for="DescripFuncionalidad"><?php echo $strings['Descripción Funcionalidad']?>: </label>
                        <input type="text"  name="DescripFuncionalidad" maxlength="100"  size="100" onblur="javascript:void(validarDescripFuncionalidad(this, 100))" ><div id="DescripFuncionalidad" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div><div id="DescripFuncionalidadVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>
               
                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                    <a href="../Controllers/FUNCIONALIDAD_Controller.php?action=ADD"> <input type="image" name="action" value="ADD" src="../Views/images/confirmar.png" title="<?php echo $strings['Enviar Formulario'] ?>" onclick="return validar('ADD')"></a>
                </div>
            </form>                     
            <div class="acciones" style="float: left;">
                <a href="../Controllers/FUNCIONALIDAD_Controller.php?action=SHOWALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
            </div>
        </fieldset> 
    </section>
<?php
    include '../Views/Footer.php';
}

}

?>