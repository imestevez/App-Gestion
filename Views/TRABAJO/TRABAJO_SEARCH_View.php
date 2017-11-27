<?php

/*
//Clase : TRABAJO_SEARCH
//Creado el : 26-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Muestra el formulario de búsqueda de usuarios con todos los campos de trabajo
*/
class TRABAJO_SEARCH {
   function __construct(){
    $this->render();
   }

//funcion que muestra los datos al usuario
function render(){

  include '../Views/Header.php';

?>

<script type="text/javascript"> 
    <?php include '../Views/js/validaciones.js' ?>
</script>
     <section class="pagina">

             <fieldset class="search" style="width: 70%; margin-left: 15%">
                <legend style="margin-left: 30%"><?php echo $strings['']?></legend>

         
            <form method="post" name="SEARCH" action="../Controllers/TRABAJO_Controller.php" enctype="multipart/form-data" >
                
                    <label for="IdTrabajo"><?php echo $strings[''] ?>: </label>
                        <input type="text" name="IdTrabajo" maxlength="20" size="20" onblur=""  ><div id="IdTrabajo" class="oculto" style="display:none"><?php echo $strings['']?></div> <div id="IdTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['']?></div> 
                </div>

                <div id="izquierda">
                    <label for="NombreTrabajo"><?php echo $strings['']?>: </label>
                        <input type="text" name="NombreTrabajo" maxlength="20" size="20" onblur=""  ><div id="NombreTrabajo" class="oculto" style="display:none"><?php echo $strings['']?></div>  
                </div>

                <div id="izquierda">
                
                <label for="FechIniTrabajo"><?php echo $strings['']?>: </label>
                          <input type="text" id="fechnacuser" name="FechIniTrabajo" size="10"  onblur="javascript:void(validarFecha(this))" onmouseover="javascript:void(validarFecha(this))" ><div id="FechIniTrabajo" class="oculto" style="display:none"><?php echo $strings['']?></div> 
                </div>

                 <label for="FechFinTrabajo"><?php echo $strings['']?>: </label>
                          <input type="text" id="fechnacuser" name="FechFinTrabajo"  size="10"  onblur="javascript:void(validarFecha(this))" onmouseover="javascript:void(validarFecha(this))" ><div id="FechFinTrabajo" class="oculto" style="display:none"><?php echo $strings['']?></div> 
                </div>

                <div id="izquierda">
                    <label for="PorcetajeNota"><?php echo $strings['']?>:</label>
                        <input type="text" name="PorcetajeNota" maxlength="20" size="20"  onblur=""  ><div id="PorcetajeNota" class="oculto" style="display:none"><?php echo $strings['']?></div>  
                </div>
                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                   
                     <a href="../Controllers/TRABAJO_Controller.php?action=SEARCH"><input type="image" name="action" value="SEARCH" action="#" src="../Views/images/search.png" title="<?php echo $strings['Buscar']?>" onclick=" return validar('SEARCH')" ></a>
                </div>
             </form>  
                   <div class="acciones" style="float: left;">
                     <a href="../Controllers/TRABAJO_Controller.php?action=SHOWALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
                </div>
            </fieldset>

    </section>
<?php

  include '../Views/Footer.php';


    }

}

?>
