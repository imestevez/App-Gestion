<?php

/*
//Clase : ACCION_EDIT
//Creado el : 17-10-2017
//Creado por: vugsj4
//-----------------
Muestra el formulario con los datos del usuario indicado permitiendo modificarlos

*/
class ACCION_EDIT{

   
    var $IdAccion; //declaración del atributo IdAccion de la accion
    var $NombreAccion; //declaración del atributo NombreAccion de la accion
    var $DescripAccion; //declaración del atributo DescripAccion

function __construct($tupla){

    //asignación de valores de parámetro a los atributos de la clase
    $this->IdAccion = $tupla['IdAccion'];
  $this->NombreAccion = $tupla['NombreAccion'];
    $this->DescripAccion = $tupla['DescripAccion'];
    
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

           <fieldset class="edit">
                <legend style="margin-left: 30%"><?php echo $strings['Editar Usuario'] ?></legend>


            <form method="post" name="EDIT" action="../Controllers/ACCION_Controller.php" enctype="multipart/form-data">
         

                 <div id="izquierda">
                     <label for="IdAccion"><?php echo $strings['Id de la accion']?>: </label>
                        <input type="text" name="IdAccion" maxlength="20" size="20" value="<?php echo $this->IdAccion ?>"  onblur="javascript:void(validarNombre(this, 20))" ><div id="nombre" class="oculto" style="display:none"><?php echo $strings['div_Alfabetico'] ?></div><div id="nombreVacio" class="oculto" style="display:none"><?php echo $strings['div_nombre_vacio'] ?></div> 
                </div>
                 <div id="izquierda">
                     <label for="NombreAccion"><?php echo $strings['Nombre de la accion']?>: </label>
                        <input type="text" name="NombreAccion" maxlength="20" size="20" value="<?php echo $this->NombreAccion ?>"  onblur="javascript:void(validarNombre(this, 20))"  ><div id="nombre" class="oculto" style="display:none"><?php echo $strings['div_Alfabetico'] ?></div><div id="nombreVacio" class="oculto" style="display:none"><?php echo $strings['div_nombre_vacio'] ?></div> 
                </div>
            
                <div id="izquierda">
                     <label for="DescripAccion"><?php echo $strings['Descripcion de la accion']?>: </label>
                        <input type="text" name="DescripAccion" maxlength="20" size="20" value="<?php echo $this->DescripAccion ?>"  onblur="javascript:void(validarNombre(this, 20))"  ><div id="nombre" class="oculto" style="display:none"><?php echo $strings['div_Alfabetico'] ?></div><div id="nombreVacio" class="oculto" style="display:none"><?php echo $strings['div_nombre_vacio'] ?></div> 
                </div>
            
            
               
                    
                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                    <a href="../Controllers/ACCION_Controller.php?action=EDIT"> <input type="image" name="action" value="EDIT" src="../Views/images/confirmar.png" title="<?php echo $strings['Enviar Formulario'] ?>" onclick=""></a>
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