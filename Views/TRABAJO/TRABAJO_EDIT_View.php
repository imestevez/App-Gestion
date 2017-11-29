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
    var $FechaIniTrabajo; // declaración del atributo FechaIniTrabajo
    var $FechaFinTrabajo; //declaración del atributo FechaFinTrabajo
    var $PorcentajeNota; //declaración del atributo PorcentajeNota
    var $lista; // array para almacenar los datos del usuario
    var $mysqli; // declaración del atributo manejador de la bd

function __construct($tupla){
    //asignación de valores de parámetro a los atributos de la clase
    $this->IdTrabajo = $tupla['IdTrabajo'];
    $this->NombreTrabajo = $tupla['NombreTrabajo'];
    $this->FechaIniTrabajo = $tupla['FechaIniTrabajo'];
    $this->FechaFinTrabajo = $tupla['FechaFinTrabajo'];
    $this->PorcentajeNota = $tupla['PorcentajeNota'];

    //si la FechaIniTrabajo  viene vacia la asignamos vacia
    if ($this->FechaIniTrabajo == ''){
        $this->FechaIniTrabajo = NULL;
    }
    else{ // si no viene vacia 
        $this->FechaIniTrabajo = date_format(date_create($this->FechaIniTrabajo), 'd-m-Y');
    }
    //si la FechaFinTrabajo  viene vacia la asignamos vacia
    if ($this->FechaFinTrabajo == ''){
        $this->FechaFinTrabajo = NULL;
    }
    else{ // si no viene vacia 
        $this->FechaFinTrabajo = date_format(date_create($this->FechaFinTrabajo), 'd-m-Y');
    }

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
         <fieldset class="edit" >
                <legend style="margin-left: 30%"><?php echo $strings['Editar trabajo'] ?></legend>
            <form method="post" name="EDIT"  action="../Controllers/TRABAJO_Controller.php" enctype="multipart/form-data" >
                <div id="izquierda">
                    <label for="IdTrabajo"><?php echo $strings['IdTrabajo'] ?>: </label>
                        <input type="text" name="IdTrabajo" maxlength="6" size="6" readonly value="<?php echo $this->IdTrabajo?>" onblur=""  ><div id="IdTrabajo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="IdTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                <div id="izquierda">
                    <label for="NombreTrabajo"><?php echo $strings['NombreTrabajo']?>: </label>
                        <input type="text" name="NombreTrabajo" maxlength="60" size="60" value="<?php echo $this->NombreTrabajo?>" onblur="validarNombreTrabajo(this,60)"  ><div id="NombreTrabajo" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="NombreTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div> 
                </div>

                <div id="izquierda">
                
                <label for="FechaIniTrabajo"><?php echo $strings['FechaIniTrabajo']?>: </label>
                          <input type="text" id="fechnacuser" name="FechaIniTrabajo" class="tcal" size="10" value="<?php echo $this->FechaIniTrabajo?>" readonly onblur="javascript:void(validarFechaIniTrabajo(this))" onmouseover="javascript:void(validarFechaIniTrabajo(this))" ><div id="FechaIniTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div><div id="FechaIniTrabajo" class="oculto" style="display:none"><?php echo $strings['div_fecha']?></div> 
                </div>
                <div id="izquierda">

                 <label for="FechaFinTrabajo"><?php echo $strings['FechaFinTrabajo']?>: </label>
                          <input type="text" id="fechnacuser" name="FechaFinTrabajo" class="tcal" size="10" value="<?php echo $this->FechaFinTrabajo?>" readonly onblur="javascript:void(validarFechaFinTrabajo(this))" onmouseover="javascript:void(validarFechaFinTrabajo(this))" ><div id="FechaFinTrabajoVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div><div id="FechaFinTrabajo" class="oculto" style="display:none"><?php echo $strings['div_fecha']?></div> 
                </div>

                <div id="izquierda">
                    <label for="PorcentajeNota"><?php echo $strings['PorcentajeNota']?>:</label>
                        <input type="number" name="PorcentajeNota" size="2" min="0" max="99" value="<?php echo $this->PorcentajeNota?>" onblur="validarPorcentajeNota(this,0,99)"  ><div id="PorcentajeNota" class="oculto" style="display:none"><?php echo $strings['div_numeros']?></div> <div id="PorcentajeNotaMax" class="oculto" style="display:none"><?php echo $strings['div_numerosRango']?> </div> <div id="PorcentajeNotaVacio" class="oculto" style="display:none"><?php echo $strings['div_vacio']?></div>  
                </div>
                    
                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                    <a href="../Controllers/TRABAJO_Controller.php?action=EDIT"> <input type="image" name="action" value="EDIT" src="../Views/images/confirmar.png" title="<?php echo $strings['Enviar Formulario'] ?>" onclick="return validar('EDIT') "></a>
                </div>
             </form>                     
                <div class="acciones" style="float: left;">
                    <a href="../Controllers/TRABAJO_Controller.php?action=SHOWALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
                </div>
         </fieldset>
 
    </section>
<?php  
    include '../Views/Footer.php';
}   
}

?>