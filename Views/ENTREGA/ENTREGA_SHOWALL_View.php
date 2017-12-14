<?php
/*
//Clase : ENTREGA_SHOWALL
//Creado el : 16-10-2017
//Creado por: vugsj4
//-------------------------------------------------------
    
    Esta clase es la vista de los usuarios de la BD

*/
class ENTREGA_SHOWALL{

    var $datos;  //tuplas almacenadas en la BD
    var $origen; //Almacena el origen de la orden
    var $lista; // array para almacenar los datos del usuario
    var $total_tuplas; //El numero te tuplas del recordset
    var $num_tupla; //Variable para almacenar el número de tuplas mostradas
    var $max_tuplas ; //Máximo de tuplas a mostrar por página
    var $num_pagina; //Numero de página a mostrar
    var $orden ; //Vista desde la que se envia la orden
    var $acciones; //accioes del usuario

//constructor de la clase
function __construct($lista, $datos,$num_tupla,$max_tuplas,$totalTuplas,$num_pagina, $orden, $origen,$acciones){
    //asignación de valores de parámetro a los atributos de la clase
    $this->datos = $datos;
    $this->origen = $origen;
    $this->lista = $lista;
    $this->total_tuplas = $totalTuplas;
    $this->num_tupla = $num_tupla;
    $this->max_tuplas = $max_tuplas;
    $this->num_pagina = $num_pagina;
    $this->orden = $orden ;
    $this->acciones = $acciones;
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
                <caption><?php echo $strings['Entregas']?></caption>
                <tr>
                <th><?php echo $strings["Login"]; ?></th>
                <th><?php echo $strings["Nombre"]; ?></th>
                <th><?php echo $strings["IdTrabajo"]; ?></th>
                <th><?php echo $strings["NombreTrabajo"]; ?></th>
                <th><?php echo $strings["Alias"]; ?></th>
                <th><?php echo $strings["Horas"]; ?></th>
                <th><?php echo $strings["Ruta"]; ?></td>

            <td>
                      <?php 

                foreach ($this->acciones as $key => $value) {
                    if($value == 'SEARCH'){
                        ?>
                    <a href="../Controllers/ENTREGA_Controller.php?action=SEARCH"><input type="image" src="../Views/images/search.png" name="action" title="<?php echo $strings['Buscar']?>" value="SEARCH"></a>

                        <?php
                    }

                     if($value == 'ADD'){
                        ?>
                    <a href="../Controllers/ENTREGA_Controller.php?action=ADD" ><input type="image" src="../Views/images/anadir.png" name="action" title="<?php echo $strings['Añadir']?>" value="ADD" ></a>

                <?php
                    }
                }
                ?>
                </td>
                </tr>
<?php		
 
			while( ($this->num_tupla < $this->max_tuplas) && ($row = mysqli_fetch_array($this->datos)) ) { //Mientras el numero de tuplas no llegue al máximo y haya tuplas en la BD
?>
                <td><?php echo $row["login"]; ?></td>
                <td><?php echo $row["Nombre"]; ?></td>
                <td><?php echo $row["IdTrabajo"]; ?></td>
                <td><?php echo $row["NombreTrabajo"]; ?></td>
                <td><?php echo $row["Alias"]; ?></td>
                <td><?php echo $row["Horas"]; ?></td>
                <td><?php echo $row["Ruta"]; ?></td>

                  <td class="edit_tabla">

                     <?php 

                    foreach ($this->acciones as $key => $value) {
                        if($value == 'SHOW'){
                            ?>
                    <a href="../Controllers/ENTREGA_Controller.php?action=SHOW&login=<?php echo $row["login"]?>&IdTrabajo=<?php echo $row["IdTrabajo"]?>"><input type="image" src="../Views/images/ojo.png" name="action" title="<?php echo $strings['Mostrar en detalle'] ?>" value="SHOW" action=""></a>

                            <?php
                        }

                         if($value == 'EDIT'){
                            ?>
                    <a href="../Controllers/ENTREGA_Controller.php?action=EDIT&login=<?php echo $row["login"]?>&IdTrabajo=<?php echo $row["IdTrabajo"]?>"><input type="image" src="../Views/images/edit.png" name="action" title="<?php echo $strings['Editar'] ?>" value="EDIT"></a>
                    
                    <?php
                        }
                           if($value == 'DELETE'){
                            ?>
                    
                    <a href="../Controllers/ENTREGA_Controller.php?action=DELETE&login=<?php echo $row["login"]?>&IdTrabajo=<?php echo $row["IdTrabajo"]?>""><input type="image" src="../Views/images/delete.png" name="action" title="<?php echo $strings['Eliminar'] ?>" value="DELETE"></a>
                   
                    <?php
                        }
                    }
                    ?>  
                </td>
                </tr>               
           
<?php
	$this->num_tupla++;//incremento del numero de tupla
	}//fin del while
?>
     </table>
    <div class="acciones">

<?php


        if($this->num_pagina > 0){ // Si la tupla 1 mostrada es la primera de la BD
?>
         <a href="../Controllers/ENTREGA_Controller.php?num_pagina=<?php echo $this->num_pagina-1?>&action=ALL"><input type="image" src="../Views/images/prev.png" name="action" title="<?php echo $strings['Anterior'] ?>" value="PREV"></a>
<?php
        } //Fin del if si es la 1ª tupla

        if($this->max_tuplas < $this->total_tuplas){ //Si la tupla mostrada es la última de la BD
?>
        <a href="../Controllers/ENTREGA_Controller.php?num_pagina=<?php echo $this->num_pagina+1?>&action=ALL"><input type="image" src="../Views/images/next.png" name="action" title="<?php echo $strings['Siguiente'] ?>" value="NEXT"></a>
<?php
        }//Fin del if si es la ultima tupla

?>
    </div>
</section>


<?php
  include '../Views/Footer.php';
    
	}//fin render()

function renderSearch(){
  include '../Views/Header.php';

?>
     <section class="pagina"  style="min-height: 500px; height: 100%;">
                <table class="showAll">
                 <caption><?php echo $strings['Entregas']?></caption>
                 <tr>
                <th><?php echo $strings["login"]; ?></th>
                <th><?php echo $strings["IdTrabajo"]; ?></th>
                <th><?php echo $strings["NombreTrabajo"]; ?></th>
                <th><?php echo $strings["Alias"]; ?></th>
                <th><?php echo $strings["Horas"]; ?></th>
                <th><?php echo $strings["Ruta"]; ?></th>
             
                <td>

                     <?php 

                foreach ($this->acciones as $key => $value) {
                    if($value == 'SEARCH'){
                        ?>
                    <a href="../Controllers/ENTREGA_Controller.php?action=SEARCH"><input type="image" src="../Views/images/search.png" name="action" title="<?php echo $strings['Buscar']?>" value="SEARCH"></a>
                        
                        <?php
                    }

                     if($value == 'ADD'){
                        ?>
                    <a href="../Controllers/ENTREGA_Controller.php?action=ADD" ><input type="image" src="../Views/images/anadir.png" name="action" title="<?php echo $strings['Añadir']?>" value="ADD" ></a>
                        
                <?php
                    }
                }
                ?>
                </td>
                </tr>
<?php
            while( $row = mysqli_fetch_array($this->datos)) { //Mientras el numero de tuplas no llegue al máximo y haya tuplas en la BD
?>  <tr>
                <td><?php echo $row["login"]; ?></td>
                <td><?php echo $row["IdTrabajo"]; ?></td>
                <td><?php echo $row["NombreTrabajo"]; ?></td>
                <td><?php echo $row["Alias"]; ?></td>
                <td><?php echo $row["Horas"]; ?></td>
                <td><?php echo $row["Ruta"]; ?></td>

            <td class="edit_tabla">
                 <?php 

                    foreach ($this->acciones as $key => $value) {
                        if($value == 'SHOW'){
                            ?>
                    <a href="../Controllers/ENTREGA_Controller.php?action=SHOW&login=<?php echo $row["login"]?>&IdTrabajo=<?php echo $row["IdTrabajo"]?>"><input type="image" src="../Views/images/ojo.png" name="action" title="<?php echo $strings['Mostrar en detalle'] ?>" value="SHOW" action=""></a>
                        
                            <?php
                        }

                         if($value == 'EDIT'){
                            ?>
                    <a href="../Controllers/ENTREGA_Controller.php?action=EDIT&login=<?php echo $row["login"]?>&IdTrabajo=<?php echo $row["IdTrabajo"]?>"><input type="image" src="../Views/images/edit.png" name="action" title="<?php echo $strings['Editar'] ?>" value="EDIT"></a>

                    <?php
                        }
                           if($value == 'DELETE'){
                            ?>
                    <a href="../Controllers/ENTREGA_Controller.php?action=DELETE&login=<?php echo $row["login"]?>&IdTrabajo=<?php echo $row["IdTrabajo"]?>""><input type="image" src="../Views/images/delete.png" name="action" title="<?php echo $strings['Eliminar'] ?>" value="DELETE"></a>
                    
                    <?php
                        }
                    }
                    ?>                    
            
                </td>

                
                </tr>               
           
<?php
    }
?>
     </table>
    <div class="acciones">

<?php

    if(isset($_REQUEST['action'])){ //si viene de un formulario
        if($_REQUEST['action'] == 'SEARCH'){  //Si se muestra a partir de un SEARCH
?>
           <a href="../Controllers/ENTREGA_Controller.php?action=ALL"><input type="image" src="../Views/images/back.png" name="action" title="<?php echo $strings['Volver'] ?>" value="BACK"></a>
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
