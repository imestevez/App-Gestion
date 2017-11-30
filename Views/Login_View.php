<?php
/*
//Clase : Login
//Creado el : 24-11-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Vista para que el  usuario se se loguee en el sistema

*/
class Login{


	function __construct(){	
		$this->render();
	}


function render(){

include 'Header.php'; 
?>

<script type="text/javascript">
    <?php include '../Views/js/validaciones.js'; ?>
</script>

		<section class="pagina" style="min-height: 500px">
        
      <label style="margin-left: 25%; margin-top: 5%"> <strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $strings['Usuario no autenticado']?></strong>&nbsp;&nbsp;&nbsp;&nbsp;

			 <a href='../Controllers/Registro_Controller.php'><input type="image" name="registrar" src="../Views/images/anadir.png" name="action" title="<?php echo $strings['Registro de usuario'] ?>" value="ADD" ></a></label>
		  <fieldset class="add" style="width: 50%; margin-left: 20%">	 
                <legend><?php echo $strings['Identificarse']; ?> </legend>


			<form name="REGISTRO" action="../Controllers/Login_Controller.php" method="post" onsubmit="return encriptar()">


				<div id="izquierda">
				 	<label for="login"><?php echo $strings['Login'];?>:</label> 
				 	<input type="text" name="login"  size="9" maxlength="9" onblur="javascript:void(validarLogin(this, 9))"  ><div id="login" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="loginVacio" class="oculto" style="display:none"><?php echo $strings['div_login_vacio']?></div> 
				 </div>
				 <div id="izquierda">
					<label for="password"><?php echo $strings['Contraseña'] ?>:</label>
					<input type="password" id="passwd" name="password" size="20" maxlength="20" onblur="javascript:void(validarPassword(this, 20))" ><div id="password" class="oculto" style="display:none"><?php echo $strings['div_Alfanumerico']?></div> <div id="passwordVacio" class="oculto" style="display:none"><?php echo $strings['div_password_vacia']?></div> 
				</div>

				<div class="acciones">					
                    <a href="../Controllers/Login_Controller.php"><input type="image" name="action" value="LOGIN" action="action" src="../Views/images/login.png" title="<?php echo $strings['Iniciar Sesión']?>" ></a>
				</div>
			</form>
		</fieldset>
	</section>
							
<?php
			include 'Footer.php';
		} //fin metodo render

	} //fin Login

?>
