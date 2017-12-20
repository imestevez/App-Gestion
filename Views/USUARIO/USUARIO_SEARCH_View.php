<?php

/*
//Clase : USUARIO_SEARCH
//Creado el : 24-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Muestra el formulario de búsqueda de usuarios con todos los campos
*/
class USUARIO_SEARCH {
   function __construct(){
    $this->render();
   }

//funcion que muestra los datos al usuario
function render(){

  include '../Views/Header.php';

?>

<script type="text/javascript"> 
    <?php include '../Views/js/validacionesUSUARIO.js' ?>
</script>
     <section class="pagina">

             <fieldset class="search">
                <legend style="margin-left: 30%"><?php echo $strings['Búsqueda de usuario']?></legend>

         
            <form method="post" name="SEARCH" action="../Controllers/USUARIO_Controller.php" enctype="multipart/form-data" >
                
                <div id="izquierda">
                    <label for="login"><?php echo $strings['Login']?>: </label>
                        <input type="text" name="login" maxlength="9" size="9" onblur="javascript:void(validarLoginBuscar(this, 9))" ><div id="login" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div>
                </div>
                 <div id="izquierda">
                    <label for="DNI"><?php echo $strings['DNI']?>: </label>
                        <input type="text" name="DNI" maxlength="9" size="9"  onblur="javascript:void(validarDNIBuscar(this))" ><div id="DNI" class="oculto" style="display:none"><?php echo $strings['div_dni']?></div> <div id="DNILetra" class="oculto" style="display:none"><?php echo $strings['div_dni_letra']?></div> 
                </div>
                 <div id="izquierda">
                     <label for="nombre"><?php echo $strings['Nombre']?>: </label>
                        <input type="nombre" name="nombre" maxlength="30" size="30"  onblur="javascript:void(validarNombreBuscar(this, 30))"  ><div id="nombre" class="oculto" style="display:none"><?php echo $strings['div_Alfabetico'] ?></div>
                </div>
                <div id="izquierda">
                    <label for="apellidos"><?php echo $strings['Apellidos']?>:</label>
                        <input type="text" name="apellidos" maxlength="50" size="50"  onblur="javascript:void(validarApellidosBuscar(this, 50))"  ><div id="apellidos" class="oculto" style="display:none"><?php echo $strings['div_Alfabetico'] ?></div>
                </div>
                <div id="izquierda">

                    <label for="telefono"><?php echo $strings['Telefono']?>:</label>
                        <input type="text" name="telefono" maxlength="11" size="11"  onblur="javascript:void(validarTelefonoBuscar(this, 11))"  ><div id="telefono" class="oculto" style="display:none"><?php echo $strings['div_telefono']?></div>
                </div>
               <div  id="izquierda">
                        <label for="email"><?php echo $strings['Email']?>: </label>
                         <input type="text" name="email" maxlength="40" size="40" placeholder="<?php echo $strings['ejemplo']?>@email.com"  onblur="javascript:void(validarEmailBuscar(this, 40))" ><div id="email" class="oculto" style="display:none"><?php echo $strings['div_email']?></div> 
                </div>
                <div  id="izquierda">
                        <label for="direccion"><?php echo $strings['Direccion']?>: </label>
                         <input type="text" name="direccion" maxlength="60" size="60" onblur="javascript:void(validarDireccionBuscar(this, 60))" ><div id="direccion" class="oculto" style="display:none"><?php echo $strings['div_direccion']?></div>
                </div>
                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                   
                     <a href="../Controllers/USUARIO_Controller.php?action=SEARCH"><input type="image" name="action" value="SEARCH" action="SEARCH" src="../Views/images/search.png" title="<?php echo $strings['Buscar']?>" onclick="return validar('SEARCH')" ></a>
                </div>
             </form>  
                   <div class="acciones" style="float: left;">
                     <a href="../Controllers/USUARIO_Controller.php?action=ALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
                </div>
            </fieldset>

    </section>
<?php

  include '../Views/Footer.php';


    }

}

?>
