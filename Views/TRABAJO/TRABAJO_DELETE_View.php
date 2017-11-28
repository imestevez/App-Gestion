<?php
/*
//Clase : TRABAJO_DELETE
//Creado el : 26-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Muestra la tabla de borrado del usuario seleccionado

*/
class TRABAJO_DELETE{
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

  //si la PorcentajeNota  viene vacia la asignamos vacia
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
     <section class="pagina" style="min-height: 500px">

           <table class="showcurrent">
             <caption><?php echo $strings['Borrar trabajo'] ?></caption>
                  <tr><th><?php echo $strings['Campo'] ?></th><th><?php echo $strings['Valor'] ?></th></tr>
                 <tr><th><?php echo $strings['IdTrabajo'] ?></th><td><?php echo $this->IdTrabajo ?></td></tr>
                 <tr><th><?php echo $strings['NombreTrabajo'] ?></th><td><?php echo $this->NombreTrabajo ?></td></tr>
                <tr><th><?php echo $strings['FechaIniTrabajo'] ?></th><td><?php echo $this->FechaIniTrabajo ?></td></tr>
                <tr><th><?php echo $strings['FechaFinTrabajo'] ?></th><td><?php echo $this->FechaFinTrabajo ?></td></tr>
                  <tr><th><?php echo $strings['PorcentajeNota'] ?></th><td><?php echo $this->PorcentajeNota ?></td></tr>
                </table>


       <form method="post" name="DELETE" action="../Controllers/TRABAJO_Controller.php" enctype="multipart/form-data" >
                <input class="del" type="text" name="IdTrabajo" size="<?php echo strlen($this->IdTrabajo); ?>" readonly value="<?php echo $this->IdTrabajo ?>" >
                <input class="del" type="text" name="NombreTrabajo" size="<?php echo strlen($this->NombreTrabajo); ?>" readonly value="<?php echo $this->NombreTrabajo ?>">
                <input class="del" type="text" name="FechaIniTrabajo"  size="<?php echo strlen($this->FechaIniTrabajo); ?>" readonly value="<?php echo $this->FechaIniTrabajo ?>">
                <input class="del" type="text"  name="FechaFinTrabajo" size="<?php echo strlen($this->FechaFinTrabajo); ?>" readonly value="<?php echo $this->FechaFinTrabajo ?>" >
                <input class="del" type="text" name="PorcentajeNota" size="<?php echo strlen($this->PorcentajeNota); ?>" readonly  value="<?php echo $this->PorcentajeNota ?>">

                  <div class="accionesTable" style="margin-left: 0%; float: right; margin-right: 45%;">

                    <a href="../Controllers/TRABAJO_Controller.php?action=DELETE&IdTrabajo=<?php echo $this->IdTrabajo ?>"><input type="image" name="action" value="DELETE" action="#" src="../Views/images/confirmar.png" title="<?php echo $strings['Borrar Usuario'] ?>" ></a>
                    </div>
             </form>

                  <div class="accionesTable" style="float: left;">
                    <a href="../Controllers/TRABAJO_Controller.php?action=SHOWALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver'] ?>"></a>  
                  </div>    
    </section>
<?php

  include '../Views/Footer.php';

    }
}
?>