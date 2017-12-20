<?php
/*

//Clase : ENTREGA_SEARCH
//Creado el : 29-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Vista para que el  usuario pueda crear trabajos en el sistema

*/

class ENTREGA_SEARCH {
   function __construct(){
    $this->render();
   }

//funcion que muestra los datos al usuario

function render(){

include '../Views/Header.php';
?>

<script type="text/javascript">
    
    <?php include '../Views/js/validacionesENTREGA.js'; ?>

</script>


     <section class="pagina">
         <fieldset class="add" style="width: 70%; margin-left: 15%">
                <legend style="margin-left: 30%"><?php echo $strings['Buscar entrega'] ?></legend>
            <form method="post" name="SEARCH"  action="../Controllers/ENTREGA_Controller.php" enctype="multipart/form-data" >
                 <div id="izquierda">
                    <label for="login"><?php echo $strings['Login'] ?>: </label>
                        <input type="text" name="login" maxlength="9" size="9" onblur="validarloginBuscar(this,9)"  ><div id="login" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> 
                </div>

                 <div id="izquierda">
                     <label for="nombre"><?php echo $strings['Nombre']?>: </label>
                        <input type="nombre" name="nombre" maxlength="30" size="30"  onblur="javascript:void(validarNombreBuscar(this, 30))"  ><div id="nombre" class="oculto" style="display:none"><?php echo $strings['div_Alfabetico'] ?></div>
              
              <div id="izquierda">
                    <label for="IdTrabajo"><?php echo $strings['IdTrabajo'] ?>: </label>
                        <input type="text" name="IdTrabajo" maxlength="6" size="6" onblur="validarIdTrabajoBuscar(this,6)"  ><div id="IdTrabajo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> 
                </div>

                <div id="izquierda">
                    <label for="NombreTrabajo"><?php echo $strings['NombreTrabajo']?>: </label>
                        <input type="text" name="NombreTrabajo" maxlength="60" size="60" onblur="validarNombreTrabajoBuscar(this,60)"  ><div id="NombreTrabajo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> 
                </div>
                
                 <div id="izquierda">
                    <label for="Alias"><?php echo $strings['Alias'] ?>: </label>
                        <input type="text" name="Alias" maxlength="6" size="6" onblur="validarAliasBuscar(this,9)"  ><div id="Alias" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> 
                </div>


                <div id="izquierda">
                    <label for="Horas"><?php echo $strings['Horas']?>:</label>
                        <input type="number" name="Horas" maxlength="2" size="2" min="0" max="99"  onblur="validarHorasBuscar(this, 0,99)"><div id="Horas" class="oculto" style="display:none"><?php echo $strings['div_numeros']?></div> <div id="HorasMax" class="oculto" style="display:none"><?php echo $strings['div_numerosRango']?> </div>
                </div>
               
                <!-- Se coloca un maxlength 54 porque se añaden 6 caracteres a mayores de Files/ al almacenar en la BD-->
                <div  id="izquierda">    
                    <label for="Ruta"><?php echo $strings['Ruta']?>: </label>
                    <input type="text" name="Ruta" maxlength="54" size="54" onblur="validarRutaBuscar(this, 54)" ><div id="Ruta" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> 
                </div>

               <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                   
                     <a href="../Controllers/ENTREGA_Controller.php?action=SEARCH"><input type="image" name="action" value="SEARCH" action="#" src="../Views/images/search.png" title="<?php echo $strings['Buscar']?>" onclick=" return validar('SEARCH')" ></a>
                </div>
             </form>                     
                <div class="acciones" style="float: left;">
                     <a href="../Controllers/ENTREGA_Controller.php?action=ALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
                </div>
         </fieldset> 
    </section>
<?php
        include '../Views/Footer.php';
    }

}

?>