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
    var $rellenarHistorias;

function __construct($lista, $listaHistorias, $contar, $contarHistorias, $rellenarHistorias){
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
    $this->rellenarHistorias = $rellenarHistorias;
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
                
                   
                    
                    <?php
                    for ($j=0; $j < $this->contarHistorias ; $j++) { 
                     
                    ?>   
                        <tr>
                            <td><?php echo $strings['IdHistoria']?></td>
                            <td><?php echo $strings['Texto de la historia'] ?></td>
                        </tr>
                        <tr> 
                            <td><?php echo $this->rellenarHistorias[$j][0]?></td> 
                            <td><?php echo $this->rellenarHistorias[$j][1]?></td>
                        </tr>

                    <?php
                       // echo $lista[$j][0] //id
                       // echo $lista[$j][1] //texto 
                    ?>
                        
                        <?php
                            for ($i=0; $i < $this->contar ; $i++) { 
                            ?>
                            <tr>
                                <td>
                                    <input class="calificar" type="text" readonly size="10" name="LoginEvaluador" value="<?php echo $this->datos[$i][1] ?>"> 
                                </td>
                            
                                <td>
                                    <input class="calificar" type="text" readonly size="1" name="CorrectoA" value="<?php echo $this->datos[$i][2] ?>"> 
                                
                                    <input class="calificar" type="text" readonly size="1" name="OK" value="<?php echo $this->datos[$i][6] ?>"> 
                                    <input type="checkbox" name="evaluadores[]" id="<?php echo $this->rellenarHistorias[$j][0] ?>" value="<?php echo $this->datos[$i][0]. "+" .$this->datos[$i][1]. "+" .$this->datos[$i][2]. "+" .$this->datos[$i][6]. "+" .$this->datos[$i][5] ?>" > 
                                </td>
                            </tr>
                            <?php
                              
                            }//fin for2

                        ?>
                        
                        <?php
                            for ($k=0; $k < $this->contar ; $k++) { 
                            ?>
                            <tr>
                                <td>
                                    <input class="calificar" type="text" readonly size="20" name="ComenIncorrectoA" value="<?php echo $this->datos[$i][3] ?>"> 
                                </td>
                            </tr>
                            <?php
                              
                            }//fin for3

                        ?>

                        <tr>
                                <td>
                                    <input class="calificar" type="text" size="20" name="ComentIncorrectoP" value="<?php echo $this->datos[$i][5] ?>"> 
                                </td>
                                <td>
                                    <input class="calificar" type="text" readonly size="1" name="CorrectoP" value="<?php echo $this->datos[$i][4] ?>">
                                    <input type="checkbox" name="evaluado[]" id="<?php echo $this->rellenarHistorias[$j][0] ?>" value="<?php echo $this->datos[$i][0]. "+" .$this->datos[$i][4]. "+" .$this->datos[$i][5] ?>" >
                                </td>
                            </tr>

                        <?php
                    }// fin for1
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
                          
                    </select 
                </div>
                 <div  id="izquierda">    
                    <label for="ComentIncorrectoP"><?php //echo $strings['ComentIncorrectoP']?>: </label>
                    <textarea name="ComentIncorrectoP" maxlength="300" rows="6" cols="50" onblur="" style="margin-left: 10px; border-radius: 20px; border-top-left-radius: 0px; border-width: 2px; border-color: darkblue;" > <?php// echo $row['ComentIncorrectoP'] ?></textarea><div id="ComentIncorrectoP" class="oculto" style="display:none"><?php// echo $strings['div_Alfanumerico']?></div> 
                </div>-->

        </table>

                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                    <a href="../Controllers/EVALUACION_Controller.php?action=SHOW&IdTrabajo=<?php echo $this->IdTrabajo ?>&AliasEvaluado=<?php echo $this->AliasEvaluado ?>&numHistorias=<?php echo $this->contarHistorias ?>&numEvaluadores=<?php echo $this->contar ?>"> <input type="image" name="action" value="SHOW" src="../Views/images/confirmar.png" title="<?php echo $strings['Enviar Formulario'] ?>"></a>
                </div>
             </form>                     
                <div class="acciones" style="float: left;">
                     <a href="../Controllers/EVALUACION_Controller.php?action=ALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver']?>"></a>
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
