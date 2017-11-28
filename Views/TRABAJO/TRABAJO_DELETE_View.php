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
     <section class="pagina" style="min-height: 500px">

           <table class="showcurrent">
             <caption><?php echo $strings[''] ?></caption>
                  <tr><th><?php echo $strings['Campo'] ?></th><th>Valor</th></tr>
                 <tr><th><?php echo $strings[''] ?></th><td><?php echo $this->IdTrabajo ?></td></tr>
                 <tr><th><?php echo $strings[''] ?></th><td><?php echo $this->NombreTrabajo ?></td></tr>
                <tr><th><?php echo $strings[''] ?></th><td><?php echo $this->FechIniTrabajo ?></td></tr>
                <tr><th><?php echo $strings[''] ?></th><td><?php echo $this->FechFinTrabajo ?></td></tr>
                  <tr><th><?php echo $strings[''] ?></th><td><?php echo $this->PorcetajeNota ?></td></tr>
                </table>


       <form method="post" name="DELETE" action="../Controllers/TRABAJO_Controller.php" enctype="multipart/form-data" >
                <input class="del" type="text" name="IdTrabajo" size="<?php echo strlen($this->IdTrabajo); ?>" readonly value="<?php echo $this->IdTrabajo ?>" >
                <input class="del" type="text" name="NombreTrabajo" size="<?php echo strlen($this->IdTrabajo); ?>" readonly value="<?php echo $this->NombreTrabajo ?>">
                <input class="del" type="text" name="FechIniTrabajo"  size="<?php echo strlen($this->FechIniTrabajo); ?>" readonly value="<?php echo $this->FechIniTrabajo ?>">
                <input class="del" type="text"  name="FechFinTrabajo" size="<?php echo strlen($this->FechFinTrabajo); ?>" readonly value="<?php echo $this->FechFinTrabajo ?>" >
                <input class="del" type="text" name="PorcetajeNota" size="<?php echo strlen($this->PorcetajeNota); ?>" readonly  value="<?php echo $this->PorcetajeNota ?>">

                  <div class="accionesTable" style="margin-left: 0%; float: right; margin-right: 45%;>

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