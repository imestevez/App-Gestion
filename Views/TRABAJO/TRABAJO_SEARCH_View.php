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
    
    <?php include '../Views/js/validacionesTRABAJO.js'; ?>

</script>

     <section class="pagina">

             <fieldset class="search" >
                <legend style="margin-left: 30%"><?php echo $strings['Buscar trabajo']?></legend>

         
            <form method="post" name="SEARCH" action="../Controllers/TRABAJO_Controller.php" enctype="multipart/form-data" >
                <div id="izquierda">
                    <label for="IdTrabajo"><?php echo $strings['IdTrabajo'] ?>: </label>
                        <input type="text" name="IdTrabajo" maxlength="6" size="6"  onblur="validarIdTrabajoBuscar(this,6)"  ><div id="IdTrabajo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> 
                </div>

                <div id="izquierda">
                    <label for="NombreTrabajo"><?php echo $strings['NombreTrabajo']?>: </label>
                        <input type="text" name="NombreTrabajo" maxlength="60" size="60" onblur="validarNombreTrabajoBuscar(this,60)"  ><div id="NombreTrabajo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> 
                </div>

                <div id="izquierda">
                
                <label for="FechaIniTrabajo"><?php echo $strings['FechaIniTrabajo']?>: </label>
                          <input type="text" id="fechnacuser" name="FechaIniTrabajo" maxlength="10" size="10"  onblur="javascript:void(validarFechaIniTrabajoBuscar(this))" onmouseover="javascript:void(validarFechaIniTrabajoBuscar(this))" ><div id="FechaIniTrabajo" class="oculto" style="display:none"><?php echo $strings['div_fecha']?></div><div id="FechaIniTrabajoParcial" class="oculto" style="display:none"><?php echo $strings['div_fechaParcial']?></div>
                </div>
                <div id="izquierda">
                 <label for="FechaFinTrabajo"><?php echo $strings['FechaFinTrabajo']?>: </label>
                          <input type="text" id="fechnacuser" name="FechaFinTrabajo" maxlength="10" size="10"  onblur="javascript:void(validarFechaFinTrabajoBuscar(this))" onmouseover="javascript:void(validarFechaFinTrabajoBuscar(this))" ><div id="FechaFinTrabajo" class="oculto" style="display:none"><?php echo $strings['div_fecha']?></div><div id="FechaIniTrabajoParcial" class="oculto" style="display:none"><?php echo $strings['div_fechaParcial']?></div>  
                </div>

                <div id="izquierda">
                    <label for="PorcentajeNota"><?php echo $strings['PorcentajeNota']?>:</label>
                        <input type="number" name="PorcentajeNota" maxlength="2" size="2" min="0" max="99" onblur="validarPorcentajeNotaBuscar(this, 0, 99)"  ><div id="PorcentajeNota" class="oculto" style="display:none"><?php echo $strings['div_numeros']?></div><div id="PorcentajeNotaMax" class="oculto" style="display:none"><?php echo $strings['div_numerosRango']?></div>
                </div>
                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                   
                     <a href="../Controllers/TRABAJO_Controller.php?action=SEARCH"><input type="image" name="action" value="SEARCH" action="#" src="../Views/images/search.png" title="<?php echo $strings['Buscar']?>" onclick=" return validar('SEARCH')" ></a>
                </div>
             </form>  
                   <div class="acciones" style="float: left;">
                     <a href="../Controllers/TRABAJO_Controller.php?action=ALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
                </div>
            </fieldset>

    </section>
<?php

  include '../Views/Footer.php';


    }

}

?>
