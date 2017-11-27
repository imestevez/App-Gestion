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
     <section class="pagina">
             <table class="showcurrent">
                 <caption><?php echo $strings[''] ?></caption>
                <tr><th><?php echo $strings['Campo'] ?></th><th>Valor</th></tr>
                 <tr><th><?php echo $strings[''] ?></th><td><?php echo $this->IdTrabajo ?></td></tr>
                 <tr><th><?php echo $strings[''] ?></th><td><?php echo $this->NombreTrabajo ?></td></tr>
                <tr><th><?php echo $strings[''] ?></th><td><?php echo $this->FechIniTrabajo ?></td></tr>
                <tr><th><?php echo $strings[''] ?></th><td><?php echo $this->FechFinTrabajo ?></td></tr>
                  <tr><th><?php echo $strings[''] ?></th><td><?php echo $this->PorcetajeNota ?></td></tr>
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