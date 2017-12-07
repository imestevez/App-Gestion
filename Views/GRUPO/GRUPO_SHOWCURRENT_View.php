<?php
/*
//Clase : GRUPO_SHOWCURRENT
//Creado el : 24-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------
    
    Esta clase es la vista en detalle de un grupo

*/

class GRUPO_SHOWCURRENT{

	
    var $IdGrupo; //declaración del atributo identificador del grupo
    var $NombreGrupo; //declaración del atributo nombre del grupo
    var $DescripGrupo; //declaración del atributo descripcion del grupo
    

//constructor de la clase
function __construct($tupla){
	//asignación de valores de parámetro a los atributos de la clase
	$this->IdGrupo = $tupla['IdGrupo'];
    $this->NombreGrupo = $tupla['NombreGrupo'];
	$this->DescripGrupo = $tupla['DescripGrupo'];

    $this->render();
}

//funcion que muestra los datos al usuario
function render(){

  include '../Views/Header.php';

?>
    <section class="pagina">
            <table class="showcurrent">
                <caption><?php echo $strings['Vista en detalle de grupo'] ?></caption>
                <tr><th><?php echo $strings['Campo'] ?></th><th><?php echo $strings['Valor'] ?></th></tr>
                <tr><th><?php echo $strings['IdGrupo'] ?></th><td><?php echo $this->IdGrupo ?></td></tr>
                <tr><th><?php echo $strings['NombreGrupo'] ?></th><td><?php echo $this->NombreGrupo ?></td></tr>
                <tr><th><?php echo $strings['DescripGrupo'] ?></th><td><?php echo $this->DescripGrupo ?></td></tr>
                
            </table>
            <div class="accionesTable">
                <a href="../Controllers/GRUPO_Controller.php?action=SHOWALL"><input type="image" name="action" value="SHOWALL" src="../Views/images/back.png" title="<?php echo $strings['Volver'] ?>"></a>
            </div>

    </section>	
<?php
  include '../Views/Footer.php';

    }//fin de render()
}//fin de la clase
?>