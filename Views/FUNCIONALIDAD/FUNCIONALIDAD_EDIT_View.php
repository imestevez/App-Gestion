<?php
/*
//Clase : FUNCIONALIDAD_EDIT
//Creado el : 27-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Vista para que el administrador pueda editar las funcionalidades

*/
class FUNCIONALIDAD_EDIT{
    var $IdFuncionalidad;
    var $NombreFuncionalidad;
    var $DescripFuncionalidad; 

function __construct($tupla){
    $this->IdFuncionalidad = $tupla['IdFuncionalidad'];
    $this->NombreFuncionalidad = $tupla['NombreFuncionalidad'];
    $this->DescripFuncionalidad = $tupla['DescripFuncionalidad'];
    $this->render();
}

function render(){

    include '../Views/Header.php';

?>

    <script type="text/javascript">
    
        <?php include '../Views/js/validacionesFUNCIONALIDAD.js'; ?>

    </script>

    <section class="pagina" style="min-height: 900px" >
        <fieldset class="edit" style="width: 70%; margin-left: 15%">
                <legend style="margin-left: 30%"><?php echo $strings['Editar Funcionalidad'] ?></legend>
            <form method="post" name="EDIT"  action="../Controllers/FUNCIONALIDAD_Controller.php">
                <div id="izquierda">
                    <label for="IdFuncionalidad"><?php echo $strings['Id Funcionalidad'] ?>: </label>
                        <input type="text" name="IdFuncionalidad" maxlength="6" size="6" readonly value="<?php echo $this->IdFuncionalidad?>" onblur="javascript:void(validarIdFuncionalidad(this, 6))" ><div id="IdFuncionalidad" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="IdFuncionalidadVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                <div id="izquierda">
                    <label for="NombreFuncionalidad"><?php echo $strings['Nombre Funcionalidad']?>: </label>
                        <input type="text" name="NombreFuncionalidad" maxlength="60" size="60" value="<?php echo $this->NombreFuncionalidad?>"  onblur="javascript:void(validarNombreFuncionalidad(this, 60))" ><div id="NombreFuncionalidad" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="NombreFuncionalidadVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                 <div id="izquierda">
                    <label for="DescripFuncionalidad"><?php echo $strings['Descripción Funcionalidad']?>: </label>
                        <textarea name="DescripFuncionalidad" maxlength="100" rows="2" cols="50" onblur="javascript:void(validarDescripFuncionalidad(this, 100))" style="margin-left: 10px; border-radius: 20px; border-top-left-radius: 0px; border-width: 2px; border-color: darkblue;" ><?php echo $this->DescripFuncionalidad?></textarea><div id="DescripFuncionalidad" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div><div id="DescripFuncionalidadVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>
        
                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                    <a href="../Controllers/FUNCIONALIDAD_Controller.php?action=EDIT"> <input type="image" name="action" value="EDIT" src="../Views/images/confirmar.png" title="<?php echo $strings['Enviar Formulario'] ?>" onclick="return validar('EDIT')"></a>
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