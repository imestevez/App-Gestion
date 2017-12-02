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

		 <section class="pagina" style="min-height: 400px">

		 	   <div class="texto" style=" width: 70%; margin-left: 15%">
            <h2 style="text-align: center;"><strong><?php echo $strings['Grupo SOLFAMIDAS'] ?></strong></h2><br>
       
            <img style="margin-left: 26%;" src="../Views/images/index.jpg" width="380px" height="280px" alt="<?php echo $strings['Imagen Solfamidas'] ?>"><br>
          
               
            </div>
		 </section>




<?php    		
		include_once '../Views/Footer.php';

	}
}

?>