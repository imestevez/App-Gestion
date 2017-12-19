<?php
/*
//Script : Informacion_View.php
//Creado el : 25-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

La vista de los usuarios que se autentican en el sistema
*/
		session_start(); //solicito trabajar con la session
		include_once '../Functions/Authentication.php';
		include_once '../Views/Header.php';
		
?>

		 <section class="pagina">
             <table class="showcurrent">
                <caption style="margin-bottom: 5%"><?php echo $strings['Componentes del grupo SOLFAMIDAS']?></caption>
                <tr><td>JOSE DANIEL FERNANDEZ SOTELO</td></tr>
                <tr><td>IVAN MARTINEZ ESTEVEZ</td></tr>
                <tr><td>CRISTINA MENO FERNANDEZ</td></tr>
                <tr><td>DIEGO MORENZA VAZQUEZ</td></tr>
                <tr><td>PABLO MOURE FRANCO</td></tr>

                </table>
                <div class="accionesTable">
                     <a href="../index.php"><input type="image" name="action" value="SHOWALL" src="../Views/images/back.png" title="<?php echo $strings['Volver'] ?>"></a>
                </div>
        </section>	




<?php    		
		include_once '../Views/Footer.php';

?>