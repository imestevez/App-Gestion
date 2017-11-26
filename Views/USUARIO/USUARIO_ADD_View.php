<?php

/*
//Clase : USUARIOS_ADD
//Creado el : 15-10-2017
//Creado por: vugsj4
//-------------------------------------------------------

Muestra el formulario de registro que permite al usuario añadir sus datos al sistema

*/
class USUARIOS_ADD {
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
         <fieldset class="add">
                <legend style="margin-left: 30%"><?php echo $strings['Registro de usuario'] ?></legend>
            <form method="post" name="ADD"  action="../Controllers/USUARIOS_Controller.php" enctype="multipart/form-data" >
                <div id="izquierda">
                    <label for="login"><?php echo $strings['Login']?>: </label>
                        <input type="text" name="login" maxlength="15" size="15" onblur="javascript:void(validarLogin(this, 25))"  ><div id="login" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="loginVacio" class="oculto" style="display:none"><?php echo $strings['div_login_vacio']?></div> 
                </div>

                <div id="izquierda">
                    <label for="password"><?php echo $strings['Contraseña']?>: </label>
                        <input type="password" id="passwd" name="password" maxlength="20" size="20" onblur="javascript:void(validarPassword(this, 20))"  ><div id="password" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="passwordVacio" class="oculto" style="display:none"><?php echo $strings['div_password_vacia']?></div> 
                </div>

                <div id="izquierda">
                    <label for="DNI"><?php echo $strings['DNI']?>: </label>
                        <input type="text" name="DNI" maxlength="9" size="9" onblur="javascript:void(validarDNI(this))" ><div id="DNI" class="oculto" style="display:none"><?php echo $strings['div_dni']?></div> <div id="DNIVacio" class="oculto" style="display:none"><?php echo $strings['div_dni_vacio'] ?></div><div id="DNILetra" class="oculto" style="display:none"><?php echo $strings['div_dni_letra']?></div> 
                </div>

                 <div id="izquierda">
                     <label for="nombre"><?php echo $strings['Nombre']?>: </label>
                        <input type="nombre" name="nombre" maxlength="30" size="30"  onblur="javascript:void(validarNombre(this, 30))" ><div id="nombre" class="oculto" style="display:none"><?php echo $strings['div_Alfabetico'] ?></div><div id="nombreVacio" class="oculto" style="display:none"><?php echo $strings['div_nombre_vacio'] ?></div> 
                </div>
            
                <div id="izquierda">

                    <label for="apellidos"><?php echo $strings['Apellidos']?>:</label>
                        <input type="text" name="apellidos" maxlength="50" size="50"  onblur="javascript:void(validarApellidos(this, 50))"  ><div id="apellidos" class="oculto" style="display:none"><?php echo $strings['div_Alfabetico'] ?></div> <div id="apellidosVacio" class="oculto" style="display:none"><?php echo $strings['div_apellidos_vacio'] ?></div> 
                </div>
                <div id="izquierda">

                    <label for="telefono"><?php echo $strings['Telefono']?>:</label>
                        <input type="text" name="telefono" maxlength="11" size="11"  onblur="javascript:void(validarTelefono(this))"  ><div id="telefono" class="oculto" style="display:none"><?php echo $strings['div_telefono']?></div> <div id="telefonoVacio" class="oculto" style="display:none"><?php echo $strings['div_telefono_vacio']?></div> 
                </div>
               <div  id="izquierda">
                        <label for="email"><?php echo $strings['Email']?>: </label>
                         <input type="email" name="email" maxlength="60" size="60" placeholder="<?php echo $strings['ejemplo']?>@email.com" onblur="javascript:void(validarEmail(this, 60))" ><div id="email" class="oculto" style="display:none"><?php echo $strings['div_email']?></div> <div id="emailVacio" class="oculto" style="display:none"><?php echo $strings['div_email_vacio']?></div> 
                </div>
                <div  id="izquierda">
                        <label for="direccion"><?php echo $strings['Direccion']?>: </label>
                         <input type="text" name="direccion" maxlength="60" size="60"><div id="direccion" class="oculto" style="display:none"><?php echo $strings['div_direccion']?></div> <div id="direccionVacio" class="oculto" style="display:none"><?php echo $strings['div_direccion_vacio']?></div> 
                </div>
                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                    <a href="../Controllers/USUARIOS_Controller.php?action=ADD"> <input type="image" name="action" value="ADD" src="../Views/images/confirmar.png" title="<?php echo $strings['Enviar Formulario'] ?>" onclick="return validar('ADD') && encriptar() "></a>
                </div>
             </form>                     
                <div class="acciones" style="float: left;">
                     <a href="../Controllers/USUARIOS_Controller.php?action=SHOWALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
                </div>
         </fieldset> 
    </section>
<?php
        include '../Views/Footer.php';
    }

}

?>
