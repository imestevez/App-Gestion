<?php
/*
//Clase : Index
//Creado el : 25-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

La vista de los usuarios que se autentican en el sistema
*/
class Index {

	function __construct(){
		$this->render();
	}
//funcion que muestra los datos al usuario

	function render(){

	
		include_once '../Locales/Strings_SPANISH.php';
		include_once '../Views/Header.php';
?>

		 <section class="pagina" style="min-height: 800px">

		 	   <div class="texto" style=" width: 70%; margin-left: 15%">
            <h2 style="text-align: center;"><strong><?php echo $strings['Grupo SOLFAMIDAS'] ?></strong></h2><br>
       
            <img style="margin-left: 26%;" src="../Views/images/index.jpg" width="380px" height="280px" alt="<?php echo $strings['Imagen Solfamidas'] ?>"><br>

          <script type='text/javascript' src='http://www.aemet.es/es/eltiempo/prediccion/municipios/launchwidget/ourense-id32054?w=g4p01110001ohmffffffw890z190x4f86d9t95b6e9r1s8n2'></script><noscript><a target='_blank' style='font-weight: bold;font-size: 1.20em;' href='http://www.aemet.es/es/eltiempo/prediccion/municipios/ourense-id32054'>Ourense</a></noscript>
               
            </div>
		 </section>




<?php    		
		include_once '../Views/Footer.php';

	}
}

?>