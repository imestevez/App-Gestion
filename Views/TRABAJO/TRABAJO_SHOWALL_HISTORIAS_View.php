<?php
/*
	Autor: SOLFAMIDAS
	Fecha de creación: 06/12/2017
	Descripción: Vista para añadir historias de usuario.

*/

	class TRABAJO_SHOWALL_HISTORIAS{

		var $IdTrabajo;
		var $NombreTrabajo;

		var $listaHistorias;

		function __construct($IdTrabajo,$NombreTrabajo, $listaHistorias){
			$this->IdTrabajo = $IdTrabajo;
			$this->NombreTrabajo = $NombreTrabajo;

			$this->listaHistorias = $listaHistorias;

			$this->render();
		}

		function render(){

			  include '../Views/Header.php';   

?>
		<section class="pagina" style="min-height: 500px">

            <table class="showcurrent">
            	<caption><?php echo $strings['Historias'] ?></caption>
            	    <tr>
                		<th ><?php echo $strings['Campo'] ?></th>
                		<th ><?php echo $strings['Valor'] ?></th>
                	</tr>
                	<tr><th style="width: 5%"><?php echo $strings['Id del trabajo'] ?></th><td><?php echo $this->IdTrabajo ?></td></tr>
                    <tr><th style="width: 5%"><?php echo $strings['Nombre del trabajo'] ?></th><td><?php echo $this->NombreTrabajo ?></td></tr>

                	<tr><th colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $strings['Historias'] ?></th></tr>
                	
                	<tr>
                		<th ><?php echo $strings['Id de la historia'] ?></th>
                		<th ><?php echo $strings['Texto de la historia'] ?></th>
                	</tr>

                	
	<?php		
 
			while($row = mysqli_fetch_array($this->listaHistorias)) { //Mientras haya tuplas en la BD
	?>
                <tr>
                <td style="width: 5%"><?php echo $row["IdHistoria"]; ?></td>
                <td><?php echo $row["TextoHistoria"]; ?></td>
                </tr>              
           
<?php
	}//fin del while
?>

            </table>
                  <div class="accionesTable" style="float: left;">
                    <a href="../Controllers/TRABAJO_Controller.php?action=SHOWALL"><input type="image" src="../Views/images/back.png" title="<?php echo $strings['Volver'] ?>"></a>  
                  </div>    
    </section>
<?php

  include '../Views/Footer.php';

    }
}

?>