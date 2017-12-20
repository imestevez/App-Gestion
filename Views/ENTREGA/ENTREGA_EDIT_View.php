<?php
/*

//Clase : ENTREGA_EDIT
//Creado el : 26-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Vista para que el  usuario pueda crear editar los tabajos

*/
class ENTREGA_EDIT{

   var $login; //declaración del atributo login
    var $Nombre; //declaración del atributo nombre
    var $IdTrabajo; //atributo IdTrabajo
    var $NombreTrabajo; //atributo NombreTrabajo
    var $Alias; //atributo Alias
    var $Horas; // declaración del atributo Horas
    var $Ruta; //declaración del atributo Ruta
    var $lista; // array para almacenar los datos del usuario
    var $mysqli; // declaración del atributo manejador de la bd

function __construct($lista){
    //asignación de valores de parámetro a los atributos de la clase
     $this->login = $lista['login'];
    $this->Nombre = $lista['Nombre'];
    $this->IdTrabajo = $lista['IdTrabajo'];
    $this->NombreTrabajo = $lista['NombreTrabajo'];
    $this->Alias = $lista['Alias'];
    $this->Horas = $lista['Horas'];
    $this->Ruta = $lista['Ruta'];
    $this->render();
}

//funcion que muestra los datos al usuario

function render(){

include '../Views/Header.php';
?>

<script type="text/javascript">
    
    <?php 
        include '../Views/js/validacionesENTREGA.js'; 
    ?>

</script>


     <section class="pagina">
         <fieldset class="edit" style="width: 70%; margin-left: 15%">
                <legend style="margin-left: 30%"><?php echo $strings['Editar entrega'] ?></legend>
            <form method="post" name="EDIT"  action="../Controllers/ENTREGA_Controller.php" enctype="multipart/form-data" >
                 <div id="izquierda">
                    <label for="login"><?php echo $strings['Login'] ?>: </label>
                        <input type="text" name="login" readonly value="<?php echo $this->login ?>" maxlength="9" size="9">
                </div>
                  <div id="izquierda">
                     <label for="Nombre"><?php echo $strings['Nombre']?>: </label>
                        <input type="text" name="Nombre" readonly maxlength="30" size="30" value="<?php echo $this->Nombre ?>">
                </div>
              <div id="izquierda">
                    <label for="IdTrabajo"><?php echo $strings['IdTrabajo'] ?>: </label>
                        <input type="text" name="IdTrabajo" readonly value="<?php echo $this->IdTrabajo ?>"> 
                </div>
                <div id="izquierda">
                    <label for="NombreTrabajo"><?php echo $strings['NombreTrabajo']?>: </label>
                        <input type="text" name="NombreTrabajo" readonly maxlength="60" size="60" value="<?php echo $this->NombreTrabajo ?>">
                 <div id="izquierda">
                    <label for="Alias"><?php echo $strings['Alias'] ?>: </label>
                        <input type="text" id="lectura" name="Alias" readonly  value="<?php echo $this->Alias?>"  maxlength="6" size="6" onblur="validarlogin(this,6)"  ><div id="Alias" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="AliasVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>


                <div id="izquierda">
                    <label for="Horas"><?php echo $strings['Horas']?>:</label>
                        <input type="number" name="Horas" value="<?php echo $this->Horas?>"  maxlength="2" size="2" min="0" max="99"  onblur="validarHoras(this, 0,99)"><div id="Horas" class="oculto" style="display:none"><?php echo $strings['div_numeros']?></div> <div id="HorasMax" class="oculto" style="display:none"><?php echo $strings['div_numerosRango']?> </div> 
                </div>
               

               <div id="izquierda">
                     <label for="Ruta"><?php echo $strings['Ruta']?>: </label>
                     <input type="text" name="Ruta" size="60" readonly value="<?php echo $this->Ruta ?>" >

               </div>
                <!-- Se coloca un maxlength 54 porque se añaden 6 caracteres a mayores de Files/ al almacenar en la BD-->
             <div  id="izquierda">    
                    <label for="newRuta"><?php echo $strings['Cambiar la ruta']?>: </label>
                    <input type="file" name="newRuta" maxlength="54" size="54" onblur="javascript:void(validarRuta(this,54))"  ><div id="newRuta" class="oculto" style="display:none"><?php echo $strings['div_Ruta_Max']?></div>  
                </div>

                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                    <a href="../Controllers/ENTREGA_Controller.php?action=EDIT"> <input type="image" name="action" value="EDIT" src="../Views/images/confirmar.png" title="<?php echo $strings['Enviar Formulario'] ?>" onclick="return validar('EDIT') "></a>
                </div>
             </form>                     
                <div class="acciones" style="float: left;">
                     <a href="../Controllers/ENTREGA_Controller.php?action=SHOWALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
                </div>
         </fieldset> 
    </section>
<?php
        include '../Views/Footer.php';
    }

}

?>
