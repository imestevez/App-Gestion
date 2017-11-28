<?php
/*

//Clase : TRABAJO_EDIT
//Creado el : 26-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Vista para que el  usuario pueda crear editar los tabajos

*/
class TRABAJO_EDIT{

   
    var $IdTrabajo; //atributo IdTrabajo
    var $NombreTrabajo; //atributo NombreTrabajo
    var $FechIniTrabajo; // declaración del atributo FechIniTrabajo
    var $FechFinTrabajo; //declaración del atributo FechFinTrabajo
    var $PorcetajeNota; //declaración del atributo PorcetajeNota
    var $lista; // array para almacenar los datos del usuario
    var $mysqli; // declaración del atributo manejador de la bd

function __construct($tupla){
    //asignación de valores de parámetro a los atributos de la clase
    $this->IdTrabajo = $tupla['IdTrabajo'];
    $this->NombreTrabajo = $tupla['NombreTrabajo'];
    $this->FechIniTrabajo = $tupla['FechIniTrabajo'];
    $this->FechFinTrabajo = $tupla['FechFinTrabajo'];
    $this->PorcetajeNota = $tupla['PorcetajeNota'];

    //si la FechIniTrabajo  viene vacia la asignamos vacia
    if ($this->FechIniTrabajo == ''){
        $this->FechIniTrabajo = NULL;
    }
    else{ // si no viene vacia 
        $this->FechIniTrabajo = date_format(date_create($this->FechIniTrabajo), 'd-m-Y');
    }
    //si la FechFinTrabajo  viene vacia la asignamos vacia
    if ($this->FechFinTrabajo == ''){
        $this->FechFinTrabajo = NULL;
    }
    else{ // si no viene vacia 
        $this->FechFinTrabajo = date_format(date_create($this->FechFinTrabajo), 'd-m-Y');
    }

    $this->render();
}

//funcion que muestra los datos al usuario

function render(){

include '../Views/Header.php';
?>

<script type="text/javascript">
    
    <?php include '../Views/js/validaciones.js'; ?>

</script>

    <section class="pagina">
         <fieldset class="edit" style="width: 70%; margin-left: 15%">
                <legend style="margin-left: 30%"><?php echo $strings[''] ?></legend>
            <form method="post" name="ADD"  action="../Controllers/TRABAJO_Controller.php" enctype="multipart/form-data" >
                <div id="izquierda">
                    <label for="IdTrabajo"><?php echo $strings[''] ?>: </label>
                        <input type="text" name="IdTrabajo" maxlength="20" size="20" readonly value="<?php echo $this->IdTrabajo?>" onblur=""  ><div id="IdTrabajo" class="oculto" style="display:none"><?php echo $strings['']?></div> <div id="IdTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['']?></div> 
                </div>

                <div id="izquierda">
                    <label for="NombreTrabajo"><?php echo $strings['']?>: </label>
                        <input type="text" name="NombreTrabajo" maxlength="20" size="20" value="<?php echo $this->NombreTrabajo?>"  onblur=""  ><div id="NombreTrabajo" class="oculto" style="display:none"><?php echo $strings['']?></div> <div id="NombreTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['']?></div> 
                </div>

                <div id="izquierda">
                
                <label for="FechIniTrabajo"><?php echo $strings['']?>: </label>
                          <input type="text" id="fechnacuser" name="FechIniTrabajo" class="tcal" size="10" value="<?php echo $this->FechIniTrabajo?>" readonly onblur="javascript:void(validarFecha(this))" onmouseover="javascript:void(validarFecha(this))" ><div id="FechIniTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['']?></div><div id="FechIniTrabajo" class="oculto" style="display:none"><?php echo $strings['']?></div> 
                </div>
                <div id="izquierda">

                 <label for="FechFinTrabajo"><?php echo $strings['']?>: </label>
                          <input type="text" id="fechnacuser" name="FechFinTrabajo" class="tcal" size="10" value="<?php echo $this->FechFinTrabajo?>" readonly onblur="javascript:void(validarFecha(this))" onmouseover="javascript:void(validarFecha(this))" ><div id="FechFinTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['']?></div><div id="FechFinTrabajo" class="oculto" style="display:none"><?php echo $strings['']?></div> 
                </div>

                <div id="izquierda">
                    <label for="PorcetajeNota"><?php echo $strings['']?>:</label>
                        <input type="text" name="PorcetajeNota" maxlength="20" size="20" value="<?php echo $this->PorcetajeNota?>" onblur=""  ><div id="PorcetajeNota" class="oculto" style="display:none"><?php echo $strings['']?></div> <div id="PorcetajeNotaVacio" class="oculto" style="display:none"><?php echo $strings['']?></div> 
                </div>
                    
                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                    <a href="../Controllers/USUARIOS_Controller.php?action=EDIT"> <input type="image" name="action" value="EDIT" src="../Views/images/confirmar.png" title="<?php echo $strings['Enviar Formulario'] ?>" onclick="return validar('EDIT')""></a>
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