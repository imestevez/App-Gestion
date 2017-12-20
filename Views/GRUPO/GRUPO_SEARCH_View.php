<?php

/*
//Clase : GRUPO_SEARCH
//Creado el : 24-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Muestra el formulario de búsqueda de grupos con todos los campos
*/
class GRUPO_SEARCH {
   function __construct(){
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

             <fieldset class="search">
                <legend style="margin-left: 30%"><?php echo $strings['BuscaGrupo']?></legend>

         
            <form method="post" name="SEARCH" action="../Controllers/GRUPO_Controller.php" >
                
                <div id="izquierda">
                    <label for="IdGrupo"><?php echo $strings['IdGrupo']?>: </label>
                        <input type="text" name="IdGrupo" maxlength="6" size="6" onblur="javascript:void(validarIdGrupoBuscar(this, 100))"  ><div id="IdGrupo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="IdGrupoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>
                 <div id="izquierda">
                    <label for="NombreGrupo"><?php echo $strings['NombreGrupo']?>: </label>
                        <input type="text" name="NombreGrupo" maxlength="60" size="60" onblur="javascript:void(validarNombreGrupoBuscar(this, 100))" ><div id="NombreGrupo" class="oculto" style="display:none"><?php echo $strings['div_AlfanumericoTexto']?></div> <div id="NombreGrupoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>
                 <div id="izquierda">
                     <label for="DescripGrupo"><?php echo $strings['DescripGrupo']?>: </label>
                        <textarea name="DescripGrupo" maxlength="100" rows="2" cols="50" onblur="javascript:void(validarDescripGrupoBuscar(this, 100))" style="margin-left: 10px; border-radius: 20px; border-top-left-radius: 0px; border-width: 2px; border-color: darkblue;" ></textarea><div id="DescripGrupo" class="oculto" style="display:none"><?php echo $strings['div_AlfanumericoTexto']?></div> <div id="DescripGrupoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio'] ?></div>
                </div>
                
                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                   
                     <a href="../Controllers/GRUPO_Controller.php?action=SEARCH"><input type="image" name="action" value="SEARCH" action="#" src="../Views/images/search.png" title="<?php echo $strings['Buscar']?>" onclick=" return validar('SEARCH')" ></a>
                </div>
             </form>  
                   <div class="acciones" style="float: left;">
                     <a href="../Controllers/GRUPO_Controller.php?action=ALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
                </div>
            </fieldset>

    </section>
<?php

  include '../Views/Footer.php';


    }

}

?>
