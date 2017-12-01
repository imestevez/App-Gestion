<?php
/*
//Clase : TRABAJO_SHOWCURRENT
//Creado el : 26-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Muestra la tabla de borrado del usuario seleccionado

*/
class TRABAJO_SHOWCURRENT{
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
     <section class="pagina">
             <table class="showcurrent">
             <caption><?php echo $strings['Mostrar trabajo'] ?></caption>
                  <tr><th><?php echo $strings['Campo'] ?></th><th><?php echo $strings['Valor'] ?></th></tr>
                 <tr><th><?php echo $strings['IdTrabajo'] ?></th><td><?php echo $this->IdTrabajo ?></td></tr>
                 <tr><th><?php echo $strings['NombreTrabajo'] ?></th><td><?php echo $this->NombreTrabajo ?></td></tr>
                <tr><th><?php echo $strings['FechaIniTrabajo'] ?></th><td><?php echo $this->FechaIniTrabajo ?></td></tr>
                <tr><th><?php echo $strings['FechaFinTrabajo'] ?></th><td><?php echo $this->FechaFinTrabajo ?></td></tr>
                  <tr><th><?php echo $strings['PorcentajeNota'] ?></th><td><?php echo $this->PorcentajeNota ?></td></tr>
                </table>
                    <div class="accionesTable">
                     <a href="../Controllers/TRABAJO_Controller.php?action=SHOWALL"><input type="image" name="action" value="SHOWALL" src="../Views/images/back.png" title="<?php echo $strings['Volver'] ?>"></a>
                 </div>

        </section>	
<?php
  include '../Views/Footer.php';

    }//fin de render()
}//fin de la clase
?>