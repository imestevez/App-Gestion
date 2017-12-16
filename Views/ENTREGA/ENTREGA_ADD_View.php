<?php
/*

//Clase : ENTREGA_ADD
//Creado el : 29-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Vista para que el  usuario pueda crear trabajos en el sistema

*/

class ENTREGA_ADD {
    var $login; //atributo para almacenar el login de un usuario
    var $Nombre; // atributo para almacenar el nombre de un usuario
    var $IdTrabajo; // atributo para almacenar el codigo del trabajo
    var $NombreTrabajo; //atributo para almacenar el nombre de un trabajo
    var $Alias; //atributo para almacenar el alias de un usuario al realizar una entrega
    var $origen; //atributo para almacenar el origen de la peticion
   function __construct($lista){
    $this->origen = $lista['origen'];

    if($lista['login'] <> ''){
        $this->login = $lista['login'];
        $this->Nombre = $lista['Nombre'];
        $this->IdTrabajo = $lista['IdTrabajo'];
        $this->NombreTrabajo = $lista['NombreTrabajo'];
        $this->Alias = $lista['Alias'];
        $this->origen = $lista['origen'];
    }else{
           $this->render();
    }

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
                <legend style="margin-left: 30%"><?php echo $strings['Añadir entrega'] ?></legend>
            <form method="post" name="ADD"  action="../Controllers/ENTREGA_Controller.php" enctype="multipart/form-data" >
                 <div id="izquierda">
                    <label for="login"><?php echo $strings['Login'] ?>: </label>
                        <input type="text" name="login" maxlength="9" size="9" onblur="validarlogin(this,9)"  ><div id="login" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="loginVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>
              <div id="izquierda">
                    <label for="IdTrabajo"><?php echo $strings['IdTrabajo'] ?>: </label>
                        <input type="text" name="IdTrabajo" maxlength="6" size="6" onblur="validarIdTrabajo(this,6)"  ><div id="IdTrabajo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="IdTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                 <div id="izquierda">
                    <label for="Alias"><?php echo $strings['Alias'] ?>: </label>
                        <input type="text" name="Alias" maxlength="6" size="6" onblur="validarAlias(this,9)"  ><div id="Alias" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="AliasVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>


                <div id="izquierda">
                    <label for="Horas"><?php echo $strings['Horas']?>:</label>
                        <input type="number" name="Horas" maxlength="2" size="2" min="0" max="99"  onblur="validarHoras(this, 0,99)"><div id="Horas" class="oculto" style="display:none"><?php echo $strings['div_numeros']?></div> <div id="HorasMax" class="oculto" style="display:none"><?php echo $strings['div_numerosRango']?> </div> 
                </div>
               
                <!-- Se coloca un maxlength 54 porque se añaden 6 caracteres a mayores de Files/ al almacenar en la BD-->
                <div  id="izquierda">    
                    <label for="Ruta"><?php echo $strings['Ruta']?>: </label>
                    <input type="file" name="Ruta" maxlength="54" size="54" onblur="javascript:void(validarRuta(this,54))"  ><div id="Ruta" class="oculto" style="display:none"><?php echo $strings['div_Ruta_Max']?></div>  
                </div>

                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                    <a href="../Controllers/ENTREGA_Controller.php?action=ADD"> <input type="image" name="action" value="ADD" src="../Views/images/confirmar.png" title="<?php echo $strings['Enviar Formulario'] ?>" onclick="return validar('ADD') "></a>
                </div>
             </form>                     
                <div class="acciones" style="float: left;">
                     <a href="<?php echo $this->origen?>"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
                </div>
         </fieldset> 
    </section>
<?php
        include '../Views/Footer.php';
    }

    function renderLogin(){


include '../Views/Header.php';
?>

<script type="text/javascript">
    
    <?php include '../Views/js/validacionesENTREGA.js'; ?>

</script>


     <section class="pagina">
         <fieldset class="add" style="width: 70%; margin-left: 15%">
                <legend style="margin-left: 30%"><?php echo $strings['Añadir entrega'] ?></legend>
            <form method="post" name="ADD"  action="../Controllers/ENTREGA_Controller.php" enctype="multipart/form-data" >
                 <div id="izquierda">
                    <label for="login"><?php echo $strings['Login'] ?>: </label>
                        <input type="text" name="login" maxlength="9" value="<?php echo $this->login ?>" size="9" readonly  ><div id="login" class="oculto" style="display:none">
                </div>
              <div id="izquierda">
                    <label for="IdTrabajo"><?php echo $strings['IdTrabajo'] ?>: </label>
                        <input type="text" name="IdTrabajo" maxlength="6" size="6" readonly value="<?php echo $this->IdTrabajo ?>"> 
                </div>

                 <div id="izquierda">
                    <label for="Alias"><?php echo $strings['Alias'] ?>: </label>
                        <input type="text" name="Alias" maxlength="9" size="9" readonly value="<?php echo $this->Alias ?>"> 
                </div>


                <div id="izquierda">
                    <label for="Horas"><?php echo $strings['Horas']?>:</label>
                        <input type="number" name="Horas" maxlength="2" size="2" min="0" max="99"  onblur="validarHoras(this, 0,99)"><div id="Horas" class="oculto" style="display:none"><?php echo $strings['div_numeros']?></div> <div id="HorasMax" class="oculto" style="display:none"><?php echo $strings['div_numerosRango']?> </div> 
                </div>
               
                <!-- Se coloca un maxlength 54 porque se añaden 6 caracteres a mayores de Files/ al almacenar en la BD-->
                <div  id="izquierda">    
                    <label for="Ruta"><?php echo $strings['Ruta']?>: </label>
                    <input type="file" name="Ruta" maxlength="54" size="54" onblur="javascript:void(validarRuta(this,54))"  ><div id="Ruta" class="oculto" style="display:none"><?php echo $strings['div_Ruta_Max']?></div>  
                </div>

                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                    <a href="../Controllers/ENTREGA_Controller.php?action=ADDAL"> <input type="image" name="action" value="ADDAL" src="../Views/images/confirmar.png" title="<?php echo $strings['Enviar Formulario'] ?>" onclick="return validar('ADD') "></a>
                </div>
             </form>                     
                <div class="acciones" style="float: left;">
                     <a href="<?php echo $this->origen?>"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
                </div>
         </fieldset> 
    </section>
<?php
        include '../Views/Footer.php';

    }//fin renderLogin

}

?>
