<?php
/*
//Clase : NOTA_TRABAJO_SHOWALL
//Creado el : 29-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------
    
    Esta clase es la vista showall de las notas

*/
class NOTA_TRABAJO_SHOWALL{

    var $datos;  //tuplas almacenadas en la BD
    var $origen; //Almacena el origen de la orden
    var $lista; // array para almacenar los datos del usuario
    var $total_tuplas; //El numero te tuplas del recordset
    var $num_tupla; //Variable para almacenar el número de tuplas mostradas
    var $max_tuplas ; //Máximo de tuplas a mostrar por página
    var $num_pagina; //Numero de página a mostrar
    var $orden ; //Vista desde la que se envia la orden
    var $acciones; //acciones del usuario

    var $trabajos; //Todos los trabajos existentes en la BD
    var $num_trabajos; //Número de trabajos

    var $trabajosNota;
    var $alumnos;

    var $notas;

function __construct($lista, $datos,$num_tupla,$max_tuplas,$totalTuplas,$num_pagina, $orden, $origen,$acciones,$trabajos,$num_trabajos, $trabajosNota, $alumnos, $notas){
    //asignación de valores de parámetro a los atributos de la clase
    $this->datos = $datos;
    $this->origen = $origen;
    $this->lista = $lista;
    $this->total_tuplas = $totalTuplas;
    $this->num_tupla = $num_tupla;
    $this->max_tuplas = $max_tuplas;
    $this->num_pagina = $num_pagina;
    $this->orden = $orden ;
    $this->acciones = $acciones ;

    $this->trabajos = $trabajos;
    $this->num_trabajos = $num_trabajos;
    $this->trabajosNota = $trabajosNota;
    $this->alumnos = $alumnos;
    $this->notas = $notas;
    
    if( $this->orden <>'SEARCH'){ //si no viene del search
        $this->render();
    }else{//si viene del search
        $this->renderSearch();
    }
}

//funcion que muestra los datos al usuario
function render(){

  include '../Views/Header.php';

?>
    <section class="pagina" style="min-height: 800px; height: 100%;" >

				<table class="showAll">
                <caption><?php echo $strings['Notas']?></caption>
                <tr>
                
                    <th rowspan="2"><?php echo $strings['Login']?></th>   
                    <th rowspan="2"><?php echo $strings["Nombre"]; ?></th>
                    <th colspan="<?php echo (($this->num_trabajos)+1)?>"><?php echo $strings['Nota Trabajo']?></th>
                    <th rowspan="2"><?php echo $strings['Nota Total']; ?></th> 
                    <td rowspan="2">
                     <?php 

                    foreach ($this->acciones as $key => $value) {
                        if($value == 'SEARCH'){
                            ?>
                        <a href="../Controllers/NOTA_TRABAJO_Controller.php?action=SEARCH"><input type="image" src="../Views/images/search.png" name="action" title="<?php echo $strings['Buscar']?>" value="SEARCH"></a>

                            <?php
                        }

                         if($value == 'ADD'){
                            ?>
                        <a href="../Controllers/NOTA_TRABAJO_Controller.php?action=ADD" ><input type="image" src="../Views/images/anadir.png" name="action" title="<?php echo $strings['Añadir']?>" value="ADD" ></a>

                    <?php
                        }
                         if($value == 'GENNOT'){
                        ?>
                        <a href="../Controllers/NOTA_TRABAJO_Controller.php?action=GENNOT" ><input type="image" src="../Views/images/flecha.png" name="action" title="<?php echo $strings['Generación automática de notas']?>" value="GENNOT" ></a>
                        <?php
                          }
                      }
                    ?>
                    </td>
                </tr>    
                <tr>  
                    <th style="width: 5%; padding: 2px"><?php echo $strings["IdTrabajo"]; ?></th>
                    <?php 
                        while($row = mysqli_fetch_array($this->trabajos)){
                    ?>
                        <th><?php echo $row['IdTrabajo']; ?></th>
                    <?php        
                        }
                    ?>
                </tr>   
                
                
<?php		
            //Mientras el numero de tuplas no llegue al máximo y haya tuplas en la BD
			while($row = mysqli_fetch_array($this->alumnos)) {

                //echo "o ".$row['login'];
                if($row['login'] <> ''){
                
?>          
                    <tr>
                    <td><?php echo $this->datos[$row['login']]["login"]; ?></td>
                    <td><?php echo $this->datos[$row['login']]["Nombre"]; ?></td>
                    <th></th>
                    <?php
                        for($i = 0; $i < sizeof($this->trabajosNota); $i++){
                            $datos_log = $this->datos[$row['login']];

                            if(array_key_exists($this->trabajosNota[$i], $datos_log)) {

                    ?>
                        <td><a href="../Controllers/NOTA_TRABAJO_Controller.php?action=SHOW&login=<?php echo $this->datos[$row['login']]["login"]; ?>&IdTrabajo=<?php  echo $this->trabajosNota[$i]; ?>"><?php echo $this->datos[$row['login']][$this->trabajosNota[$i]]; ?></a></td>
                    <?php 
                            }
                        else{
                    ?>
                        <td></td>
                    <?php            
                            } 
                        }    
                    ?>
                    <td><?php if($this->notas <> false ) echo $this->notas[$row['login']]; ?></td>
                    <td class="edit_tabla">

                         <?php 

                        foreach ($this->acciones as $key => $value) {
                    
                               if($value == 'DELETE'){
                                ?>     
                        <a href="../Controllers/NOTA_TRABAJO_Controller.php?action=DELETE&login=<?php echo $this->datos[$row['login']]["login"]?>&Nombre=<?php echo $this->datos[$row['login']]["Nombre"]; ?>"><input type="image" src="../Views/images/delete.png" name="action" title="<?php echo $strings['Eliminar'] ?>" value="DELETEALL"></a>
                        
                        <?php
                            }
                        }
                        ?>   
                    </td>
                    </tr>              
           
<?php
        }
	}//fin del while
?>
     </table>
    
</section>


<?php
  include '../Views/Footer.php';
    
	}//fin render()

function renderSearch(){
  include '../Views/Header.php';

?>
     <section class="pagina"  style="min-height: 500px; height: 100%;">
                <table class="showAll">
                <caption><?php echo $strings['Notas']?></caption>
                <tr>
                    <th rowspan="2"><?php echo $strings['Login']?></th>   
                    <th rowspan="2"><?php echo $strings["Nombre"]; ?></th>
                    <th colspan="<?php echo (($this->num_trabajos)+1)?>"><?php echo $strings['Nota Trabajo']?></th>
                    <th rowspan="2"><?php echo $strings['Nota Total']; ?></th> 
                    <td rowspan="2">
                     <?php 

                    foreach ($this->acciones as $key => $value) {
                        if($value == 'SEARCH'){
                    ?>
                        <a href="../Controllers/NOTA_TRABAJO_Controller.php?action=SEARCH"><input type="image" src="../Views/images/search.png" name="action" title="<?php echo $strings['Buscar']?>" value="SEARCH"></a>

                            <?php
                        }

                         if($value == 'ADD'){
                            ?>
                        <a href="../Controllers/NOTA_TRABAJO_Controller.php?action=ADD" ><input type="image" src="../Views/images/anadir.png" name="action" title="<?php echo $strings['Añadir']?>" value="ADD" ></a>

                    <?php
                        }
                         if($value == 'GENNOT'){
                        ?>
                        <a href="../Controllers/NOTA_TRABAJO_Controller.php?action=GENNOT" ><input type="image" src="../Views/images/flecha.png" name="action" title="<?php echo $strings['Generación automática de notas']?>" value="GENNOT" ></a>
                        <?php
                          }
                      }
                    ?>


                </td>
                </tr>
                <tr>  
                    <th style="width: 5%; padding: 2px"><?php echo $strings["IdTrabajo"]; ?></th>
                    <?php 
                        while($row = mysqli_fetch_array($this->trabajos)){
                    ?>
                        <th><?php echo $row['IdTrabajo']; ?></th>
                    <?php        
                        }
                    ?>
                </tr> 
<?php       
            //Mientras el numero de tuplas no llegue al máximo y haya tuplas en la BD

echo "LOGIN: ".$this->datos[$row['login']];
            while($row = mysqli_fetch_array($this->alumnos)) {

                //echo "o ".$row['login'];
                if(($row['login'] <> '') && (array_key_exists($row['login'], $this->datos))){
                
?>          
                    <tr>
                    <td><?php echo $this->datos[$row['login']]["login"]; ?></td>
                    <td><?php echo $this->datos[$row['login']]["Nombre"]; ?></td>
                    <th></th>
                    <?php
                        for($i = 0; $i < sizeof($this->trabajosNota); $i++){
                            $datos_log = $this->datos[$row['login']];

                            if(array_key_exists($this->trabajosNota[$i], $datos_log)) {

                    ?>
                        <td><a href="../Controllers/NOTA_TRABAJO_Controller.php?action=SHOW&login=<?php echo $this->datos[$row['login']]["login"]; ?>&IdTrabajo=<?php  echo $this->trabajosNota[$i]; ?>"?><?php echo $this->datos[$row['login']][$this->trabajosNota[$i]]; ?></a></td>
                    <?php
                            }
                            else{
                    ?>
                        <td></td>
                    <?php            
                            } 
                        } 
                    ?>
                    <td><?php if($this->notas <> false ) echo $this->notas[$row['login']]; ?></td>
                    <td class="edit_tabla">

                         <?php

                    foreach ($this->acciones as $key => $value) {
    
                           if($value == 'DELETE'){
                            ?>
                    <a href="../Controllers/NOTA_TRABAJO_Controller.php?action=DELETE&login=<?php echo $row["login"]?>&IdTrabajo=<?php echo $row["IdTrabajo"]?>"><input type="image" src="../Views/images/delete.png" name="action" title="<?php echo $strings['Eliminar'] ?>" value="DELETE"></a>
                    
                    <?php
                        }
                    }
                    ?>   
                </td>
                </tr>               
           
<?php
    }
}
?>
     </table>
    <div class="acciones">

<?php

    if(isset($_REQUEST['action'])){ //si viene de un formulario
        if($_REQUEST['action'] == 'SEARCH'){  //Si se muestra a partir de un SEARCH
?>
           <a href="../Controllers/NOTA_TRABAJO_Controller.php?action=ALL"><input type="image" src="../Views/images/back.png" name="action" title="<?php echo $strings['Volver'] ?>" value="BACK"></a>
<?php
        }
    }//Fin del if si es SEARCH
?>
    </div>
</section>


<?php
  include '../Views/Footer.php';
    
    }    //fin renderSearch()

} //fin de la clase SHOWALL
?>