<?php

/*
//Clase : ACCION_SEARCH
//Creado el : 1-12-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Muestra el formulario de búsqueda de acciones con todos los campos
*/
class ACCION_SEARCH {
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
                <legend style="margin-left: 30%"><?php echo $strings['Búsqueda de acciones']?></legend>

         
            <form method="post" name="SEARCH" action="../Controllers/ACCION_Controller.php" enctype="multipart/form-data" >
                
                
                 <div id="izquierda">
                     <label for="IdAccion"><?php echo $strings['Id de la accion']?>: </label>
                        <input type="text" name="IdAccion" maxlength="6" size="6" onblur="javascript:void(validarIdAccionBuscar(this, 6))" ><div id="IdAccion" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="IdAccionVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 

                </div>

                <div id="izquierda">
                     <label for="NombreAccion"><?php echo $strings['Nombre de la accion']?>: </label>
                        <input type="text" name="NombreAccion" maxlength="60" size="60"  onblur="javascript:void(validarNombreAccionBuscar(this, 60))" ><div id="NombreAccion" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="NombreAccionVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                <div id="izquierda">
                     <label for="DescripAccion"><?php echo $strings['Descripcion de la accion']?>: </label>
                        <textarea name="DescripAccion" maxlength="100" rows="2" cols="50" onblur="javascript:void(validarDescripAccionBuscar(this, 100))" style="margin-left: 10px; border-radius: 20px; border-top-left-radius: 0px; border-width: 2px; border-color: darkblue;" ></textarea><div id="DescripAccion" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div><div id="DescripAccionVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>
                
                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                   
                     <a href="../Controllers/ACCION_Controller.php?action=SEARCH"><input type="image" name="action" value="SEARCH" action="#" src="../Views/images/search.png" title="<?php echo $strings['Buscar']?>" onclick=" return validar('SEARCH')" ></a>
                </div>
             </form>  
                   <div class="acciones" style="float: left;">
                     <a href="../Controllers/ACCION_Controller.php?action=SHOWALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
                </div>
            </fieldset>

    </section>
<?php

  include '../Views/Footer.php';


    }

}

?>
