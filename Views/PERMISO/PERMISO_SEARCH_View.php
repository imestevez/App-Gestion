<?php

/*
//Clase : PERMISO_SEARCH
//Creado el : 1-12-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Muestra el formulario de búsqueda de acciones con todos los campos
*/
class PERMISO_SEARCH {
   function __construct(){
    $this->render();
   }

//funcion que muestra los datos
function render(){

  include '../Views/Header.php';

?>

<script type="text/javascript"> 
    <?php include '../Views/js/validacionesACCION.js' ?>
</script>
     <section class="pagina">

             <fieldset class="search">
                <legend style="margin-left: 30%"><?php echo $strings['Busqueda de permisos']?></legend>

         
            <form method="post" name="SEARCH" action="../Controllers/PERMISO_Controller.php" enctype="multipart/form-data" >
                
                
                 <div id="izquierda">
                     <label for="NombreGrupo"><?php echo $strings['Nombre del grupo']?>: </label>
                        <input type="text" name="NombreGrupo" maxlength="60" size="60" onblur="javascript:void(validarNombreAccionBuscar(this, 60))" ><div id="NombreGrupo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="NombreGrupoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 

                </div>

                <div id="izquierda">
                     <label for="NombreFuncionalidad"><?php echo $strings['Nombre de la funcionalidad']?>: </label>
                        <input type="text" name="NombreFuncionalidad" maxlength="60" size="60"  onblur="javascript:void(validarNombreAccionBuscar(this, 60))" ><div id="NombreFuncionalidad" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="NombreFuncionalidadVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                <div id="izquierda">
                     <label for="NombreAccion"><?php echo $strings['Nombre de la accion']?>: </label>
                        <input type="text" name="NombreAccion" maxlength="60" size="60"  onblur="javascript:void(validarNombreAccionBuscar(this, 60))" ><div id="NombreAccion" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="NombreAccionVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>
                
                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                   
                     <a href="../Controllers/PERMISO_Controller.php?action=SEARCH"><input type="image" name="action" value="SEARCH" action="#" src="../Views/images/search.png" title="<?php echo $strings['Buscar']?>" onclick=" return validar('SEARCH')" ></a>
                </div>
             </form>  
                   <div class="acciones" style="float: left;">
                     <a href="../Controllers/PERMISO_Controller.php?action=ALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
                </div>
            </fieldset>

    </section>
<?php

  include '../Views/Footer.php';


    }

}

?>
