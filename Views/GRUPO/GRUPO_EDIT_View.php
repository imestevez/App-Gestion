<?php

/*
//Clase : GRUPO_EDIT
//Creado el : 24-11-2017
//Creado por: SOLFAMIDAS
//-----------------
Muestra el formulario con los datos del grupo indicado permitiendo modificarlos

*/
class GRUPO_EDIT{

   
    var $IdGrupo; //declaración del atributo identificador del grupo
    var $NombreGrupo; //declaración del atributo nombre del grupo
    var $DescripGrupo; //declaración del atributo descripcion del grupo
    
function __construct($tupla){
    //asignación de valores de parámetro a los atributos de la clase
    $this->IdGrupo = $tupla['IdGrupo'];
    $this->NombreGrupo = $tupla['NombreGrupo'];
    $this->DescripGrupo = $tupla['DescripGrupo'];

    $this->render();
}

//funcion que muestra los datos al usuario

function render(){

    
    include '../Views/Header.php';
?>

<script type="text/javascript">  
    <?php include '../Views/js/validacionesGRUPO.js' ?>
</script>

    <section class="pagina" style="min-height: 900px">

           <fieldset class="edit">
                <legend style="margin-left: 30%"><?php echo $strings['EditarGrupo'] ?></legend>


            <form method="post" name="EDIT" action="../Controllers/GRUPO_Controller.php">
         

                <div id="izquierda">
                    <label for="IdGrupo"><?php echo $strings['IdGrupo']?>: </label>
                    <input type="text" name="IdGrupo" maxlength="15" readonly size="6" value="<?php echo $this->IdGrupo ?>" onblur="javascript:void(validarIdGrupo(this, 6))"><div id="IdGrupo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="IdGrupoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                <div id="izquierda">
                    <label for="NombreGrupo" "><?php echo $strings['NombreGrupo']?>: </label>
                    <input type="text" name="NombreGrupo" maxlength="60" size="<?php echo strlen($this->NombreGrupo)?>" value="<?php echo $this->NombreGrupo ?>" onblur="javascript:void(validarNombreGrupo(this, 60))" ><div id="NombreGrupo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="NombreGrupoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                 <div id="izquierda">
                     <label for="DescripGrupo"><?php echo $strings['DescripGrupo']?>: </label>
                    <textarea name="DescripGrupo" maxlength="100" rows="2" cols="50" value="<?php echo $this->DescripGrupo ?>" onblur="javascript:void(validarDescripGrupo(this, 100))" style="margin-left: 10px; border-radius: 20px; border-top-left-radius: 0px; border-width: 2px; border-color: darkblue;" ></textarea><div id="DescripGrupo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="DescripGrupoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio'] ?></div>
                </div>
                    
                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                    <a href="../Controllers/GRUPO_Controller.php?action=EDIT"> <input type="image" name="action" value="EDIT" src="../Views/images/confirmar.png" title="<?php echo $strings['Enviar Formulario'] ?>" onclick="return validar('EDIT')"></a>
                </div>
             </form>                     
                <div class="acciones" style="float: left;">
                    <a href="../Controllers/GRUPO_Controller.php?action=SHOWALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
                </div>
         </fieldset>
 
    </section>
<?php  
    include '../Views/Footer.php';
}   
}

?>