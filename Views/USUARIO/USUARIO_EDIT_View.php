<?php

/*
//Clase : USUARIO_EDIT
//Creado el : 24-11-2017
//Creado por: SOLFAMIDAS
//-----------------
Muestra el formulario con los datos del usuario indicado permitiendo modificarlos

*/
class USUARIO_EDIT{

   
    var $login; //declaración del atributo login del usuario
    var $password; //declaración del atributo password del usuario
    var $DNI; //declaración del atributo DNI del usuario
    var $nombre; //declaración del atributo nombre
    var $apellidos; //declaración del atributo apellidos
    var $telefono; //declaración del atributo telefono
    var $email; //declaración del atributo email
    var $direccion; //declaración del atributo direccion

function __construct($tupla){
    //asignación de valores de parámetro a los atributos de la clase
    $this->login = $tupla['login'];
    $this->DNI = $tupla['DNI'];
    $this->password = $tupla['password'];
    $this->nombre = $tupla['Nombre'];
    $this->apellidos = $tupla['Apellidos'];
    $this->telefono = $tupla['Telefono'];
    $this->email = $tupla['Correo'];
    $this->direccion = $tupla['Direccion'];

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

           <fieldset class="edit">
                <legend style="margin-left: 30%"><?php echo $strings['Editar Usuario'] ?></legend>


            <form method="post" name="EDIT" action="../Controllers/USUARIO_Controller.php" enctype="multipart/form-data">
         

                <div id="izquierda">
                    <label for="login"><?php echo $strings['Login']?>: </label>
                    <input type="text" name="login" maxlength="9" readonly size="9" value="<?php echo $this->login ?>" >
                </div>

                <div id="izquierda">
                    <label for="password" "><?php echo $strings['Contraseña']?>: </label>
                    <input type="text" name="password" readonly maxlength="20" size="<?php echo strlen($this->password)?>" value="<?php echo $this->password ?>" >
                </div>

                <div id="izquierda">
                    <label for="newpassword"><?php echo $strings['Nueva Contraseña']?>: </label>
                    <input type="text" id="passwd" name="newpassword" maxlength="20" size="20" onblur="javascript:void(validarNewPassword(this, 20))"  ><div id="newpassword" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div>
                </div>

                <div id="izquierda">
                    <label for="DNI"><?php echo $strings['DNI']?>: </label>
                    <input type="text" name="DNI" maxlength="9" size="9" value="<?php echo $this->DNI ?>"  onblur="javascript:void(validarDNI(this))" ><div id="DNI" class="oculto" style="display:none"><?php echo $strings['div_dni']?></div> <div id="DNIVacio" class="oculto" style="display:none"><?php echo $strings['div_dni_vacio'] ?></div><div id="DNILetra" class="oculto" style="display:none"><?php echo $strings['div_dni_letra']?></div> 
                </div>

                 <div id="izquierda">
                     <label for="nombre"><?php echo $strings['Nombre']?>: </label>
                    <input type="nombre" name="nombre" maxlength="30" size="30" value="<?php echo $this->nombre ?>"  onblur="javascript:void(validarNombre(this, 30))"  ><div id="nombre" class="oculto" style="display:none"><?php echo $strings['div_Alfabetico'] ?></div><div id="nombreVacio" class="oculto" style="display:none"><?php echo $strings['div_nombre_vacio'] ?></div> 
                </div>
            
                <div id="izquierda">

                    <label for="apellidos"><?php echo $strings['Apellidos']?>:</label>
                    <input type="text" name="apellidos" maxlength="50" size="50" value="<?php echo $this->apellidos ?>"  onblur="javascript:void(validarApellidos(this, 50))" ><div id="apellidos" class="oculto" style="display:none"><?php echo $strings['div_Alfabetico'] ?></div> <div id="apellidosVacio" class="oculto" style="display:none"><?php echo $strings['div_apellidos_vacio'] ?></div> 
                </div>

                <div id="izquierda">
                    <label for="telefono"><?php echo $strings['Telefono']?>:</label>
                    <input type="text" name="telefono" maxlength="11" size="11" value="<?php echo $this->telefono ?>"  onblur="javascript:void(validarTelefono(this))" ><div id="telefono" class="oculto" style="display:none"><?php echo $strings['div_telefono']?></div> <div id="telefonoVacio" class="oculto" style="display:none"><?php echo $strings['div_telefono_vacio']?></div> 
                </div>
                <div  id="izquierda">
                        <label for="email"><?php echo $strings['Email']?>: </label>
                        <input type="text" name="email" maxlength="40" size="40" value="<?php echo $this->email ?>"  placeholder="<?php echo $strings['ejemplo']?>@email.com" onblur="javascript:void(validarEmail(this, 40))"  ><div id="email" class="oculto" style="display:none"><?php echo $strings['div_email']?></div> <div id="emailVacio" class="oculto" style="display:none"><?php echo $strings['div_email_vacio']?></div> 
                </div>
                <div  id="izquierda">
                        <label for="direccion"><?php echo $strings['Direccion']?>: </label>
                         <input type="text" name="direccion" maxlength="60" size="60" value="<?php echo $this->direccion ?>" onblur="javascript:void(validarDireccion(this, 60))" ><div id="direccion" class="oculto" style="display:none"><?php echo $strings['div_direccion']?></div> <div id="direccionVacio" class="oculto" style="display:none"><?php echo $strings['div_direccion_vacio']?></div> 
                </div>
                    
                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                    <a href="../Controllers/USUARIO_Controller.php?action=EDIT"> <input type="image" name="action" value="EDIT" src="../Views/images/confirmar.png" title="<?php echo $strings['Enviar Formulario'] ?>" onclick="return validar('EDIT') && encriptar()"></a>
                </div>
             </form>                     
                <div class="acciones" style="float: left;">
                    <a href="../Controllers/USUARIO_Controller.php?action=SHOWALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
                </div>
         </fieldset>
 
    </section>
<?php  
    include '../Views/Footer.php';
}   
}

?>