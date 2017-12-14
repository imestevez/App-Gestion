<!-- 

/*
//Script :Menu_Lateral.php
//Creado el : 16-10-2017
//Creado por: SOLFAMIDAS
    
    Esta clase es la vista de los usuarios de la BD

*/

-->
<?php
include_once '../Functions/ACL.php';
$funcionalidades = listaFuncionalidades();
$num=0;
?>

<div class="contenedor-menu">    
        <ul class="menu">
            <li><a href="../Controllers/Index_Controller.php"><i class="icono izquierda fa fa-home"></i><?php echo $strings['Inicio'] ?></a></li>
            <li ><a href="#"><i class="fa fa-archive" aria-hidden="true"></i></i> <?php echo $strings['Gestiones'] ?><i class="icono derecha fa fa-chevron-circle-down" aria-hidden="true"></i></a>
                <ul>
                <?php
                if($funcionalidades <> null){
                foreach ($funcionalidades as $key => $value) {
              
                    if ($value == 1) {
                    ?>
                    <li class="submenu" id="USUARIO"><a href="../Controllers/USUARIO_Controller.php"><?php echo $strings['Usuarios'] ?></a></li>

                    <?php
                    }
                    if ($value == 2) {
                    ?>
                     <li class="submenu" id="GRUPO"><a href="../Controllers/GRUPO_Controller.php"><?php echo $strings['Grupos'] ?></a></li>
                                
                    <?php
                    }
                    if ($value == 3) {
                    ?>
                    <li class="submenu" id="FUNCIONALIDAD"><a href="../Controllers/FUNCIONALIDAD_Controller.php"><?php echo $strings['Funcionalidades']?></a></li>
                
                    <?php
                    }
                      if ($value == 4) {
                    ?>
                    <li class="submenu" id="ACCION"><a href="../Controllers/ACCION_Controller.php"><?php echo $strings['Acciones'] ?></a></li>        
                    <?php
                    }
                    if ($value == 5) {
                    ?>
                    <li class="submenu" id="PERMISO"><a href="../Controllers/PERMISO_Controller.php"><?php echo $strings['Permisos'] ?></a></li>           
                    <?php
                    }       
                    if ($value == 6) {
                    ?>
                    <li class="submenu" id="TRABAJO"><a href="../Controllers/TRABAJO_Controller.php"><?php echo $strings['Trabajos'] ?></a></li>          
                    <?php
                    }
                    if ($value == 7) {
                    ?>
                     <li class="submenu" id="HISTORIA"><a href="../Controllers/HISTORIA_Controller.php"><?php echo $strings['Historias'] ?></a></li>           
                    <?php
                    }
                    if ($value == 8) {
                    ?>
                    <li class="submenu" id="ENTREGA"><a href="../Controllers/ENTREGA_Controller.php"><?php echo $strings['Entregas'] ?></a></li>         
                    <?php
                    }
                    if ($value == 9) {
                    ?>
                    <li class="submenu" id="ASIGNAC_QA"><a href="../Controllers/ASIGNAC_QA_Controller.php"><?php echo $strings['Asignación de QAs'] ?></a></li>          
                    <?php
                    }
                    if ($value == 10) {
                    ?>
                    <li class="submenu" id="EVALUACION"><a href="../Controllers/EVALUACION_Controller.php"><?php echo $strings['Evaluaciones'] ?></a></li>         
                    <?php
                    }
                    if ($value == 11) {
                    ?>
                    <li class="submenu" id="NOTA_TRABAJO"><a href="../Controllers/NOTA_TRABAJO_Controller.php"><?php echo $strings['Notas'] ?></a></li>
         
                    <?php
                    }
                    $num++;
                }
                }
           ?>
              
                
                </ul>   
            </li>

            <li><a href="#"><i class="icono izquierda fa fa-envelope" aria-hidden="true"></i> <?php echo $strings['Contacto'] ?></a>
            <li><a href="#"><i class="icono izquierda fa fa-cog" aria-hidden="true"></i> <?php echo $strings['Ajustes'] ?></a>
            </li>
        </ul>           
    </div>