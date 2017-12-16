<?php
/*

//Clase : EVALUACION_CALIFICAR_View
//Creado el : 26-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Vista para que el  usuario pueda crear editar los tabajos

*/
class EVALUACION_CALIFICAR{

    var $IdTrabajo; //atributo para almacenar el IdTrabajo de un trabajo
    var $LoginEvaluador; //atributo para almacenar el LoginEvaluador del evaluador
    var $AliasEvaluado; //atributo para almacenar el AliasEvaluado del usuario evaluado
    var $IdHistoria; //atributo para almacenar el IdHistoria de la historia en cuestion
    var $CorrectoA; //atributo para almacenar el valor Correcto del alumno evaluador
    var $ComenIncorrectoA; //atributo para almacenar el comentario incorrecto del alumno evaluador
    var $CorrectoP; //atributo para almacenar el valor Correcto del profesor
    var $ComentIncorrectoP; //atributo para almacenar el comentario incorrecto del profesor
    var $OK; //atributo para almacenar el resultado (1 - 0) de la evaluacion de la QA
    var $listaHistorias;
    var $listaComentarios;
    var $datos;
    var $contar;
    var $contarHistorias;

function __construct($lista, $listaHistorias, $contar, $contarHistorias){
    //asignación de valores de parámetro a los atributos de la clase
    //$this->IdTrabajo = $lista['IdTrabajo'];
    //$this->LoginEvaluador = $lista['LoginEvaluador'];
    //$this->AliasEvaluado = $lista['AliasEvaluado'];
    //$this->IdHistoria = $lista['IdHistoria'];
    //$this->CorrectoA = $lista['CorrectoA'];
    //$this->ComenIncorrectoA = $lista['ComenIncorrectoA'];
    //$this->CorrectoP = $lista['CorrectoP'];
    //$this->ComentIncorrectoP = $lista['ComentIncorrectoP'];
    //$this->OK = $lista['OK'];
    $this->lista = $lista;
    $this->listaHistorias = $listaHistorias;
    $this->contar = $contar;
    $this->contarHistorias = $contarHistorias;
    $this->rellenarLista();


    $this->render();
}

//funcion que muestra los datos al usuario

function render(){

include '../Views/Header.php';
?>

<script type="text/javascript">
    
    <?php 
        //include '../Views/js/validacionesEVALUACION.js'; 
    ?>

</script>


     <section class="pagina">
         <fieldset class="edit" style="width: 70%; margin-left: 15%">
                <legend style="margin-left: 30%"><?php echo $strings['Calificar evaluacion'] ?></legend>
            <form method="post" name="EDIT"  action="../Controllers/EVALUACION_Controller.php" enctype="multipart/form-data" >

            <table>
                <tr>
                   
                        
                        <?php
                         //   for ($j=0; $j < $this->contarHistorias ; $j++) { 
                            echo $lista[$j][0] //id
                            echo $lista[$j][1] //texto 
                        ?>
                        <td>
                        <?php
                            for ($i=0; $i < $this->contar ; $i++) { 
                            ?>
                              <input type="text" readonly name="LoginEvaluador" value="<?php echo $this->datos[$i][1] ?>"> 
                            <?php
                              
                            }

                        ?>
                              </td>
                        <?php
                  //  }
                ?>


                        <!--div id="izquierda">
                            <label for="IdHistoria"><?php// echo $strings['IdHistoria']?>:</label>
                                <input type="number" name="IdHistoria" maxlength="2" size="2" readonly value="<?php //echo $row['IdHistoria'] ?>"><div id="IdHistoria" class="oculto" style="display:none"><?php// echo $strings['div_numeros']?></div> <div id="IdHistoriaMax" class="oculto" style="display:none"><?php //echo $strings['div_numerosRango']?> </div><div id="IdHistoriaVacio" class="oculto" style="display:none"><?php// echo $strings['div_vacio']?></div>
                        </div>
                    </td>
                    <td>
                        <div id="izquierda">
                            <label for="TextoHistoria"><?php // echo $strings['Texto de la historia'] ?>: </label>
                                <textarea name="TextoHistoria" maxlength="300" rows="6" cols="50" readonly style="margin-left: 10px; border-radius: 20px; border-top-left-radius: 0px; border-width: 2px; border-color: darkblue;" ><?php// echo $row['TextoHistoria'] ?></textarea> 
                        </div>
                    </td>   
                </tr>
                <div  id="izquierda">    
                    <label for="CorrectoA"><?php //echo $strings['CorrectoA']?>: </label> 
                    <select name="CorrectoA" style="margin-left: 2%">
                        <option value="<?php //echo $row['CorrectoA'] ?>" selected><?php //echo //$row['CorrectoA'] ?></option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                          
                    </select>
                </div>
                <div  id="izquierda">    
                    <label for="ComenIncorrectoA"><?php //echo $strings['ComenIncorrectoA']?>: </label>
                    <textarea name="ComenIncorrectoA" maxlength="300" rows="6" cols="50" onblur="" style="margin-left: 10px; border-radius: 20px; border-top-left-radius: 0px; border-width: 2px; border-color: darkblue;" > <?php //echo $row['ComenIncorrectoA'] ?></textarea><div id="ComenIncorrectoA" class="oculto" style="display:none"><?php// echo $strings['div_Alfanumerico']?></div> 
                </div>
                <div  id="izquierda">    
                    <label for="OK"><?php //echo $strings['OK']?>: </label> 
                    <select name="OK" style="margin-left: 2%">
                        <option value="<?php //echo $row['OK'] ?>" selected><?php //echo //$row['OK'] ?></option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                          
                    </select>
                </div>
                <div  id="izquierda">    
                    <label for="CorrectoP"><?php// echo $strings['CorrectoP']?>: </label> 
                    <select name="CorrectoP" style="margin-left: 2%">
                        <option value="<?php// echo $row['CorrectoP'] ?>" selected><?php //echo $row['CorrectoP'] ?></option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                          
                    </select -->
                </div>
                 <div  id="izquierda">    
                    <label for="ComentIncorrectoP"><?php echo $strings['ComentIncorrectoP']?>: </label>
                    <textarea name="ComentIncorrectoP" maxlength="300" rows="6" cols="50" onblur="" style="margin-left: 10px; border-radius: 20px; border-top-left-radius: 0px; border-width: 2px; border-color: darkblue;" > <?php echo $row['ComentIncorrectoP'] ?></textarea><div id="ComentIncorrectoP" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> 
                </div>

        </table>

                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                    <a href="../Controllers/EVALUACION_Controller.php?action=SHOW&LoginEvaluador=<?php echo $this->LoginEvaluador ?>&IdTrabajo=<?php echo $this->IdTrabajo ?>&IdHistoria=<?php echo $this->IdHistoria ?>&AliasEvaluado=<?php echo $this->AliasEvaluado ?>"> <input type="image" name="action" value="SHOW" src="../Views/images/confirmar.png" title="<?php echo $strings['Enviar Formulario'] ?>" onclick=""></a>
                </div>
             </form>                     
                <div class="acciones" style="float: left;">
                     <a href="../Controllers/EVALUACION_Controller.php?action=SHOW&LoginEvaluador=<?php echo $this->LoginEvaluador ?>&IdTrabajo=<?php echo $this->IdTrabajo ?>&IdHistoria=<?php echo $this->IdHistoria ?>&AliasEvaluado=<?php echo $this->AliasEvaluado ?>"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
                </div>
         </fieldset> 
    </section>
<?php
        include '../Views/Footer.php';
    }


//rellenarLista)()
function rellenarLista(){
    $num = 0;
    while ($row = mysqli_fetch_array($this->listaHistorias)) {
        $this->datos[$num] = array($row['IdHistoria'], $row['LoginEvaluador'], $row['CorrectoA'], $row['ComenIncorrectoA'], $row['CorrectoP'], $row['ComentIncorrectoP'], $row['OK']);
        $num++;
    }

}

}

?>
