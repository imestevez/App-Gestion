<?php 

/*
//Script : Strings_SPANISH.php
//Creado el : 18-10-2017
//Creado por: SOLFAMIDAS
//-------------------------------------------------------

Script que contiene el array de las palabras clave en español
*/
$strings = 
array(
	'No se puede enviar el formulario. Revise que todos los campos están correctos' => 'No se puede enviar el formulario. Revise que todos los campos están correctos',
	'Formulario correcto' => 'Formulario correcto',
	'Sesión iniciada' => 'Sesión iniciada',
	'Desconectar' => 'Desconectar',
	'Portal de Gestión' => 'Portal de Gestión',
	'Usuario no autenticado' => 'Usuario no autenticado',
	'Registro de usuario' => 'Registro de usuario',
	'Búsqueda de usuario' => 'Búsqueda de usuario',
	'Editar Usuario' => 'Editar Usuario',
	'Borrar Usuario' => 'Borrar Usuario',
	'Usuarios' => 'Usuarios',
	'Identificarse' => 'Identificarse',
	'Iniciar Sesión' => 'Iniciar Sesión',
	'Login' => 'Usuario',
	'login' => 'usuario',
	'Contraseña' => 'Contraseña',
	'contraseña' => 'contraseña',
	'Nueva Contraseña' => 'Nueva Contraseña',
	'DNI' => 'DNI',
	'dni' => 'dni',
	'Nombre' => 'Nombre',
	'nombre' => 'nombre',
	'Apellidos' => 'Apellidos',
	'apellidos' => 'apellidos',
	'Telefono' => 'Teléfono',
	'telefono' => 'teléfono',
	'Email' => 'Email',
	'email' => 'email',
	'Fecha de Nacimiento' => 'Fecha de Nacimiento',
	'Sexo' => 'Sexo',
	'Foto personal' => 'Foto personal',
	'Cambiar la foto personal' => 'Cambiar la foto personal',
	'Hombre' => 'Hombre',
	'Mujer' => 'Mujer',
	'hombre' => 'hombre',
	'mujer' => 'mujer',
	'Nombre de la foto personal' => 'Nombre de la foto personal',
	'ejemplo' => 'ejemplo',
	'Direccion' => 'Dirección',

	/* Divs de validacion*/
	'div_Alfanumerico' => 'Solo se aceptan letras, números y los caracteres . _ -',
	'div_login_vacio' => 'El Login no puede estar vacío',
	'div_password_vacia' => 'La Contraseña no puede estar vacía',
	'div_dni' => 'Solo se aceptan 8 números seguidos de 1 letra',
	'div_dni_vacio' => 'El DNI no puede estar vacío',
	'div_dni_letra' => 'La letra no se corresponde con el número',
	'div_Alfabetico' => 'Solo se aceptan letras',
	'div_nombre_vacio' => 'El Nombre no puede estar vacío',
	'div_apellidos_vacio' => 'Los Apellidos no pueden estar vacíos',
	'div_telefono' => 'Teléfono internacional español (34XXXXXXXXX)',
	'div_telefono_vacio' => 'El Teléfono no pueden estar vacío',
	'div_email' => 'Solo se aceptan letras, números y los caracteres @ . _ -',
	'div_email_vacio' => 'El Email no puede estar vacío',
	'div_fecha_vacia' => 'La Fecha de Nacimiento no puede estar vacía',
	'div_fecha' => 'La fecha debe ser inferior a la actual',
	'div_foto_vacia' => 'La Foto personal no puede estar vacía',
	'div_sexo_vacio' => 'El Sexo no puede estar vacío',
	'div_tam' => 'El tamaño del campo supera el máximo permitido, 50 caracteres',
	'div_direccion' => 'Solo se aceptan letras, números y los caracteres , - / ',
	'div_direccion_vacio' => 'La dirección no puede estar vacía',
	/*showcurrent*/
	'Vista en detalle de usuario' => 'Vista en detalle de usuario',
	'Campo' => 'Campo',
	'Valor' => 'Valor',

	/*ACCIONES*/
	'Volver' => 'Volver',
	'Enviar Formulario' => 'Enviar Formulario',
	'Buscar' => 'Buscar',
	'Añadir' => 'Añadir',
	'Mostrar en detalle' => 'Mostrar en detalle',
	'Editar' => 'Editar',
	'Eliminar' => 'Eliminar',
	'Anterior' => 'Anterior',
	'Siguiente' => 'Siguiente',
	
	/*Menu lateral*/
	'Inicio'  => 'Inicio',
	'Otros Coches' => 'Otros Coches',
	'Contacto' => 'Contacto',
	'Ajustes' => 'Ajustes',
	/*footer*/
	'Alias' => 'Alias',
	'Fecha de creación' => 'Fecha de creación',

	/*Model*/
	'ERROR: No se ha podido conectar con la base de datos' => 'ERROR: No se ha podido conectar con la base de datos',
	'ERROR: Fallo en la inserción. Ya existe el DNI' => 'ERROR: Fallo en la inserción. Ya existe el DNI',
	'ERROR: Fallo en la inserción. Ya existe el email' => 'ERROR: Fallo en la modificación. Ya existe el email', 
	'ERROR: Fallo en la inserción. Ya existe el login' => 'ERROR: Fallo en la modificación. Ya existe el nombre de usuario',
	'ERROR: Introduzca todos los valores de todos los campos' => 'ERROR: Introduzca todos los valores de todos los campos',
	'ERROR: Fallo en la consulta sobre la base de datos' => 'ERROR: Fallo en la consulta sobre la base de datos',
	'ERROR: No existe el usuario que desea borrar en la base de datos' => 'ERROR: No existe el usuario que desea borrar en la base de datos',
	'ERROR: No existe en la base de datos' => 'ERROR: No existe en la base de datos',
	'ERROR: Fallo en la modificación. Ya existe el DNI' => 'ERROR: Fallo en la modificación. Ya existe el DNI',
	'ERROR: Fallo en la modificación. Ya existe el email' => 'ERROR: Fallo en la modificación. Ya existe el email',
	'ERROR: Fallo en la modificación. Introduzca todos los valores' => 'ERROR: Fallo en la modificación. Introduzca todos los valores',
	'ERROR: Fallo en la consulta sobre la base de datos' => 'ERROR: Fallo en la consulta sobre la base de datos',
	'ERROR: El login no existe' => 'ERROR: El usuario no existe',
	'ERROR: La contraseña para este usuario no es correcta' => 'ERROR: La contraseña para este usuario no es correcta',
	'ERROR: El usuario ya existe' => 'ERROR: El usuario ya existe',
	'Modificado correctamente' => 'Modificado correctamente',
	'Borrado correctamente' => 'Borrado correctamente',
	'Inserción realizada con éxito' => 'Inserción realizada con éxito',


	


	'del usuario' => 'de',
	'div_vacio' => 'El campo no puede estar vacío',

	'idiomaSeleccionado' => 'ESPAÑOL',




	'idioma' => 'Idioma',
	'Usuario' => 'Usuario',
	'ENTREGAS' => 'Entregas',
	'QA' => 'QA',
	'INGLES' => 'INGLES',
	'ESPAÑOL' => 'ESPAÑOL',
	'GALLEGO' => 'GALLEGO',
	'El login no existe' => 'El usuario no existe',
	'Volver' => 'Volver',
	'La password para este usuario no es correcta' => 'La contraseña para este usuario no es correcta',
	'Registro' => 'Registro',
	'Error en la inserción' => 'Error en la inserción',
	'Gestión Asignatura IU' => 'Gestión Asignatura IU',






// ----------------- ESPACIO DE TRABAJO PARA DANIEL -------------------------
	'AñadirGrupo' => 'Añadir Grupo',
	'NombreGrupo' => 'Nombre Grupo',
	'DescripGrupo' => 'Descripción Grupo',
	'IdGrupo' => 'IdGrupo',
	'BorrarGrupo' => 'Borrar Grupo',
	'EditarGrupo' => 'Editar Grupo',
	'BuscaGrupo' => 'Buscar Grupo',
	'Grupos' => 'Grupos',
	'Vista en detalle de grupo' => 'Vista en detalle de Grupo',
	'ERROR: Fallo en la inserción. Ya existe el Nombre de Grupo' => 'ERROR: Fallo en la inserción. Ya existe el Nombre de Grupo',
	'ERROR: Fallo en la inserción. Ya existe el ID de Grupo' => 'ERROR: Fallo en la inserción. Ya existe el ID de Grupo',
	'ERROR: No existe el grupo que desea borrar en la BD' => 'ERROR: No existe el grupo que desea borrar en la BD',
	'ERROR: Fallo en la modificación. Ya existe el ID de Grupo' => 'ERROR: Fallo en la modificación. Ya existe el ID de Grupo',
	'ERROR: El grupo ya existe' => 'ERROR: El grupo ya existe',



































 // ------------------------ ESPACIO DE TRABAJO PARA IVAN ---------------------------
'Gestiones' => 'Gestiones',
'Trabajos' => 'Trabajos',
'Añadir trabajo' => 'Añadir trabajo',
'IdTrabajo' => 'ID trabajo',
'NombreTrabajo' => 'Nombre trabajo',
'FechaIniTrabajo' => 'Fecha Inicio',
'FechaFinTrabajo' => 'Fecha Fin',
'PorcentajeNota' => 'Porcentaje nota',
'Borrar trabajo' => 'Borrar trabajo',
'Buscar trabajo' => 'Buscar trabajo',
'Editar trabajo' => 'Editar trabajo',
'div_numeros' => 'Solo se aceptan numeros',
'div_numerosRango' => 'El numero tiene que estar entre 0 y 99',
'div_textoRango' => 'El numero de caracteres supera el maximo',
'div_fechaParcial'=> 'Solo se aceptan numeros y -',
'Borrar trabajo' => 'Borrar trabajo',




















'ERROR: Fallo en la inserción. Ya existe el IdTrabajo' => 'ERROR: Fallo en la inserción. Ya existe el ID trabajo',
'ERROR: No existe la entrega que desea borrar en la BD' => 'ERROR: No existe la entrega que desea borrar en la BD',
'ERROR: No se ha modificado' => 'ERROR: No se ha modificado',
'Añadir entrega' => 'Añadir entrega',
'Borrar entrega' => 'Borrar entrega',
'Buscar entrega' => 'Buscar entrega',
'Editar entrega' => 'Editar entrega',
'div_AlfanumericoTexto' => 'Solo se aceptan letras, espacios, números y los caracteres . _ -',
'div_Ruta_vacia' => 'La ruta no puede estar vacia',
'Horas' => 'Horas',
'Ruta' => 'Ruta',
'Cambiar la ruta' => 'Cambiar la ruta',
'Mostrar trabajo' => 'Mostrar trabajo',
'Entregas' => 'Entregas',
'Mostrar entrega' => 'Mostrar entrega',
'div_Ruta_Max' => 'La ruta de la entrega supera el máximo de caracteres permitidos',
'ERROR: El IdTrabajo no existe' => 'ERROR: El IdTrabajo no existe',
'ERROR: Fallo en la inserción. Ya existe la entrega' => 'ERROR: Fallo en la inserción. Ya existe la entrega',
'Historia' => 'Historia',
'Grupo SOLFAMIDAS' => 'Grupo SOLFAMIDAS',
'Imagen Solfamidas' => 'Imagen Solfamidas',
'ERROR: Fallo en la modificacion. Ya existe la entrega' => 'ERROR: Fallo en la modificacion. Ya existe la entrega',












// ------------------------ ESPACIO DE TRABAJO PARA PABLO ---------------------------
//Funcionalidades
	'div_vacio' => 'El campo no puede estar vacío.',
	'Funcionalidades' => 'Funcionalidades',
	'Id Funcionalidad' => 'Id Funcionalidad',
	'Nombre Funcionalidad' => 'Nombre Funcionalidad',
	'Descripción Funcionalidad' => 'Descripción Funcionalidad',
	'Añadir Funcionalidad' => 'Añadir Funcionalidad',
	'Borrar Funcionalidad' => 'Borrar Funcionalidad',
	'Editar Funcionalidad' => 'Editar Funcionalidad',
	'Buscar Funcionalidad' => 'Buscar Funcionalidad',
	'Funcionalidad' => 'Funcionalidad',


//Nota_Trabajo
	'Añadir Nota' => 'Añadir Nota',
	'Nota Trabajo' => 'Nota Trabajo',
	'Borrar Nota' => 'Borrar Nota',
	'Editar Nota' => 'Editar Nota',
	'Buscar Nota' => 'Buscar Nota',
	'Nota' => 'Nota',
	'Notas' => 'Notas',




























// ------------------------ ESPACIO DE TRABAJO PARA CRISTINA ---------------------------
//Historias de usuario:
'Añadir historia' => 'Añadir historia',
'Id del trabajo' => 'Id del trabajo',
'Id de la historia' => 'Id de la historia',
'Texto de la historia' => 'Texto de la historia',

'Eliminar historia' => 'Eliminar historia',

'Editar historia' => 'Editar historia',

'Buscar historia' => 'Buscar historia',

'Historias' => 'Historias',

'IdHistoria' => 'IdHistoria',
'TextoHistoria' => 'TextoHistoria',

'Vista en detalle historia' => 'Vista en detalle historia',

'div_Numerico' => 'Sólo se aceptan números',

'ERROR: No existe ningún trabajo con ese IdTrabajo' => 'ERROR: No existe ningún trabajo con ese IdTrabajo',
'ERROR: Fallo en la inserción. Ya existe una historia con esos parámetros' => 'ERROR: Fallo en la inserción. Ya existe una historia con esos parámetros',
'ERROR: No existe la historia que desea borrar en la BD' => 'ERROR: Fallo en la inserción. Ya existe una historia con esos parámetros',














































// ------------------------ ESPACIO DE TRABAJO PARA DIEGO ---------------------------
	
	'Id de la accion' => 'Id de la accion',
	'Nombre de la accion' => 'Nombre de la accion',
	'Descripcion de la accion' => 'Descripcion de la accion',
	'Acciones'=> 'Acciones',
	'Búsqueda de acciones' => 'Búsqueda de acciones',
	'Editar Accion' => 'Editar Accion',
	'Añadir accion' => 'Añadir accion',
	'Vista en detalle de accion' => 'Vista en detalle de accion',
	'Borrar Accion' => 'Borrar Accion'

)
;
 ?>
