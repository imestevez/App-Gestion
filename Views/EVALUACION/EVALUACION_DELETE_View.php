<?php
/*
//Clase : EVALUACION_DELETE
//Creado el : 26-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Muestra la tabla de borrado del usuario seleccionado

*/
class EVALUACION_DELETE{
    var $IdTrabajo; //atributo para almacenar el IdTrabajo de un trabajo
    var $LoginEvaluador; //atributo para almacenar el LoginEvaluador del evaluador
    var $AliasEvaluado; //atributo para almacenar el AliasEvaluado del usuario evaluado
    var $IdHistoria; //atributo para almacenar el IdHistoria de la historia en cuestion
    var $CorrectoA; //atributo para almacenar el valor Correcto del alumno evaluador
    var $ComenIncorrectoA; //atributo para almacenar el comentario incorrecto del alumno evaluador
    var $CorrectoP; //atributo para almacenar el valor Correcto del profesor
    var $ComentIncorrectoP; //atributo para almacenar el comentario incorrecto del profesor
    var $OK; //atributo para almacenar el resultado (1 - 0) de la evaluacion de la QA
   
    

function __construct($lista){
    //asignación de valores de parámetro a los atributos de la clase
    $this->IdTrabajo = $lista['IdTrabajo'];
    $this->LoginEvaluador = $lista['LoginEvaluador'];
    $this->AliasEvaluado = $lista['AliasEvaluado'];
    $this->IdHistoria = $lista['IdHistoria'];
    $this->CorrectoA = $lista['CorrectoA'];
    $this->ComenIncorrectoA = $lista['ComenIncorrectoA'];
    $this->CorrectoP = $lista['CorrectoP'];
    $this->ComentIncorrectoP = $lista['ComentIncorrectoP'];
    $this->OK = $lista['OK'];

    $this->render();
}


//funcion que muestra los datos al usuario

function render(){

  include '../Views/Header.php';   

?>
     <section class="pagina" style="min-height: 500px">

          <table class="showcurrent">
           
            <caption><?php echo $strings['Borrar evaluacion'] ?></caption>
              <tr><th><?php echo $strings['Campo'] ?></th><th><?php echo $strings['Valor'] ?></th></tr>
              <tr><th><?php echo $strings['IdTrabajo'] ?></th><td><?php echo $this->IdTrabajo ?></td></tr>  
              <tr><th><?php echo $strings['AliasEvaluado'] ?></th><td><?php echo $this->AliasEvaluado ?></td></tr>
                  
          </table>


       <form method="post" name="DELETE" action="../Controllers/EVALUACION_Controller.php" enctype="multipart/form-data" >

            <input class="del" type="text" name="IdTrabajo" size="<?php echo strlen($this->IdTrabajo); ?>" readonly value="<?php echo $this->IdTrabajo ?>" >
            <input class="del" type="text" name="AliasEvaluado" size="<?php echo strlen($this->AliasEvaluado); ?>" readonly value="<?php echo $this->AliasEvaluado ?>">

                  <div class="accionesTable" style="margin-left: 0%; float: right; margin-right: 45%; margin-top: 2%">

                      <a href="../Controllers/EVALUACION_Controller.php?action=DELETE&IdTrabajo=<?php echo $this->IdTrabajo ?>"><input type="image" name="action" value="DELETE" action="#" src="../Views/images/confirmar.png" title="<?php echo $strings['Borrar Evaluacion'] ?>" ></a>
                    </div>
             </form>

                  <div class="accionesTable" style="float: left;">
                    <a href="../Controllers/EVALUACION_Controller.php?action=ALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver'] ?>"></a>  
                  </div>    
    </section>
<?php

  include '../Views/Footer.php';

    }
}
?>