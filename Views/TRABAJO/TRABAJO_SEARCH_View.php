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

             <fieldset class="search" >
                <legend style="margin-left: 30%"><?php echo $strings['Buscar trabajo']?></legend>

         
            <form method="post" name="SEARCH" action="../Controllers/TRABAJO_Controller.php" enctype="multipart/form-data" >
                <div id="izquierda">
                    <label for="IdTrabajo"><?php echo $strings['IdTrabajo'] ?>: </label>
                        <input type="text" name="IdTrabajo" maxlength="6" size="6" onblur=""  ><div id="IdTrabajo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div>
                </div>

                <div id="izquierda">
                    <label for="NombreTrabajo"><?php echo $strings['NombreTrabajo']?>: </label>
                        <input type="text" name="NombreTrabajo" maxlength="60" size="60" onblur=""  ><div id="NombreTrabajo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div>  
                </div>

                <div id="izquierda">
                
                <label for="FechaIniTrabajo"><?php echo $strings['FechaIniTrabajo']?>: </label>
                          <input type="text" id="fechnacuser" name="FechaIniTrabajo" size="10"  onblur="javascript:void(validarFecha(this))" onmouseover="javascript:void(validarFecha(this))" ><div id="FechaIniTrabajo" class="oculto" style="display:none"><?php echo $strings['div_fecha']?></div> 
                </div>
                <div id="izquierda">
                 <label for="FechaFinTrabajo"><?php echo $strings['FechaFinTrabajo']?>: </label>
                          <input type="text" id="fechnacuser" name="FechaFinTrabajo"  size="10"  onblur="javascript:void(validarFecha(this))" onmouseover="javascript:void(validarFecha(this))" ><div id="FechaFinTrabajo" class="oculto" style="display:none"><?php echo $strings['div_fecha']?></div> 
                </div>

                <div id="izquierda">
                    <label for="PorcentajeNota"><?php echo $strings['PorcentajeNota']?>:</label>
                        <input type="text" name="PorcentajeNota" maxlength="2" size="2"  onblur=""  ><div id="PorcentajeNota" class="oculto" style="display:none"><?php echo $strings['div_letras']?></div>  
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
