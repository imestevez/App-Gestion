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
    var $AliasEvaluado; //atributo para almacenar el AliasEvaluado del usuario evaluado
    var $listaHistorias; //atributo para almacenar la lista de historiasdel trabajo del usuario evaluado
    var $datos; //atributo para almacenar los datos que necesitamos
    var $contar; //atributo para almacenar el número de evaluadores que evalúan a este alias
    var $contarHistorias; //atributo para almacenar el número de historias que tiene el trabajo del alias a evaluar
    var $rellenarHistorias; //atributo para almacenar los atributos de las historias

function __construct($lista, $listaHistorias, $contar, $contarHistorias, $rellenarHistorias){
    //asignación de valores de parámetro a los atributos de la clase
    $this->IdTrabajo = $lista['IdTrabajo'];
    $this->AliasEvaluado = $lista['AliasEvaluado'];
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

</script>


     <section class="pagina">
         <fieldset class="edit" style="width: 70%; margin-left: 15%">
                <legend style="margin-left: 30%"><?php echo $strings['Calificar evaluacion'] ?></legend>
            <form method="post" name="EDIT"  action="../Controllers/EVALUACION_Controller.php" enctype="multipart/form-data" >

            <table class="tablaRESULTS">
                 
                    
                <?php

                    $init = 0; //variable de inicio para for1
                    $fin = $init + $this->contar; //variable de fin para for1

                    $init2 = 0;
                    $fin2 = $init2 + $this->contar;

                    for ($j=0; $j < $this->contarHistorias ; $j++) { //mientras haya historias
                     
                ?>   
                        <tr>
                            <td class="InicialIzq"><?php echo $strings['IdHistoria']?></td>
                            <td class="InicialDer"><?php echo $strings['Texto de la historia'] ?></td>
                        </tr>
                        <tr> 
                            <td class="TstringsIzq"><?php echo $this->rellenarHistorias[$j][0]?></td> 
                            <td class="TstringsDer"><?php echo $this->rellenarHistorias[$j][1]?></td>
                        </tr>
                        <tr>
                            <td class="TstringsIzq"><?php echo $strings['LoginEvaluador']?></td>
                            <td class="TstringsDer">
                                <?php echo $strings['CorrectoAOK'] ?>  
                            </td>
                        </tr>

                    <?php
                       
                    ?>
                        
                        <?php
                            for ($i=$init; $i < $fin ; $i++) { 
                            ?>
                            <tr>
                                <td>
                                    <input class="calificar" type="text" readonly size="9" name="LoginEvaluador" value="<?php echo $this->datos[$i][1] ?>"> 
                                </td>
                            
                                <td>
                                    <input class="calificar" type="text" readonly size="1" name="CorrectoA" value="<?php echo $this->datos[$i][2] ?>"> 
                                
                                    <input class="calificar" type="text" readonly size="1" name="OK" value="<?php echo $this->datos[$i][6] ?>"> 

                                    <input type="checkbox" name="evaluadores[]" id="<?php echo $this->rellenarHistorias[$j][0] ?>" value="<?php echo $this->rellenarHistorias[$j][0]. "?" .$this->datos[$i][1]. "?" .$this->datos[$i][2]. "?" .$this->datos[$i][6]. "?" .$this->datos[$i][3]. "?" .$this->datos[$i][5] ?>" > 
                                </td>
                            </tr>
                            <?php
                              
                            }//fin for2
                            
                    $init = $i;
                    $fin = $init + $this->contar;

                        ?>
                        <tr>
                                <td class="Comments" colspan="2"><?php echo $strings['ComenIncorrectoAlumnos']?></td>
                        </tr>
                        <?php
                            for ($k=$init2; $k < $fin2 ; $k++) { 
                            ?>
                            <tr>
                                <td colspan="2">
                                   <textarea name="ComenIncorrectoA" readonly maxlength="300" rows="6" cols="50" onblur="" style="margin-left: 10px; border-radius: 20px; border-top-left-radius: 0px; border-width: 2px; border-color: darkblue; width: 90%;" ><?php echo $this->datos[$k][3] ?></textarea> 
                                    <!--<input class="calificar" type="text" name="ComenIncorrectoA" readonly value="<?php //echo $this->datos[$k][3]?>" > -->
                                </td>
                            </tr>
                            <?php
                              
                            }//fin for3
                            $init2 = $k;
                            $fin2 = $init2 + $this->contar;

                            $indiceComentarioP = $j* $this->contar;

                        ?>
                        <tr>
                                <td class="Comments" colspan="2"><?php echo $strings['ComentIncorrectoPCP']?></td>
                        </tr>
                        
                        <tr >
                                <td colspan="2">
                                    <textarea name="ComentIncorrectoP[<?php echo $this->rellenarHistorias[$j][0] ?>]" maxlength="300" rows="6" cols="50" style="margin-left: 10px; border-radius: 20px; border-top-left-radius: 0px; border-width: 2px; border-color: darkblue; width: 90%;" value="<?php echo $this->datos[$indiceComentarioP][5] ?>" ><?php echo $this->datos[$indiceComentarioP][5] ?></textarea>



                                    <!--<input type="text" name="ComentIncorrectoP[<?php //echo $this->rellenarHistorias[$j][0] ?>]" value="<?php //echo $this->datos[$indiceComentarioP][5] ?>" >  -->


                                    


                                </td>
                        </tr>
                        <tr>
                                <td colspan="2">
                                    <input class="calificar" type="text" readonly size="1" name="CorrectoP" value="<?php echo $this->datos[$indiceComentarioP][4] ?>">
                                    <input type="checkbox" name="evaluado[]" id="<?php echo $this->rellenarHistorias[$j][0] ?>" value="<?php echo $this->rellenarHistorias[$j][0]. "?" .$this->datos[$indiceComentarioP][4]. "?" . $this->datos[$indiceComentarioP][5] ?>" >

                                </td>
                        </tr>

                        <?php
                    }// fin for1
                  
                ?>

        </table>
                <input type="text" name="IdTrabajo" class="del" value="<?php echo $this->IdTrabajo ?>">
                <input type="text" name="AliasEvaluado" class="del" value="<?php echo $this->AliasEvaluado ?>">
                <input type="text" name="numHistorias" class="del" value="<?php echo $this->contarHistorias ?>">
                <input type="text" name="numEvaluadores" class="del" value="<?php echo $this->contar ?>">
                <div class="acciones" style="float: right; margin-left:0%; margin-right: 50%">
                    <a href="../Controllers/EVALUACION_Controller.php?action=CALIF"> <input type="image" name="action" value="CALIF" src="../Views/images/confirmar.png" title="<?php echo $strings['Enviar Formulario'] ?>"></a>
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
