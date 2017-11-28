<!-- 

/*
//Script :Menu_Lateral.php
//Creado el : 16-10-2017
//Creado por: SOLFAMIDAS
    
    Esta clase es la vista de los usuarios de la BD

*/

-->
<div class="contenedor-menu">    
        <ul class="menu">
            <li><a href="../Controllers/USUARIO_Controller.php"><i class="icono izquierda fa fa-home"></i><?php echo $strings['Inicio'] ?></a></li>
            <li><a href="#"><i class="fa fa-archive" aria-hidden="true"></i></i> <?php echo $strings['Gestiones'] ?><i class="icono derecha fa fa-chevron-circle-down" aria-hidden="true"></i></a>
                <ul>
                <li><a href="../Controllers/USUARIO_Controller.php"><?php echo $strings['Usuarios'] ?></a></li>
                <li><a href="../Controllers/TRABAJO_Controller.php"><?php echo $strings['Trabajos'] ?></a></li>
                <li><a href="#">Lamborghini Aventador SV</a></li>
                <li><a href="#">Ferrari 488 GTB Coupé</a></li>
                </ul>   
            </li>

            <li><a href="#"><i class="icono izquierda fa fa-envelope" aria-hidden="true"></i> <?php echo $strings['Contacto'] ?></a>
            <li><a href="#"><i class="icono izquierda fa fa-cog" aria-hidden="true"></i> <?php echo $strings['Ajustes'] ?></a>
            </li>
        </ul>           
    </div>