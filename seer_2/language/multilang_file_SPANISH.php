<?php

/*
A TRANSLATION (LANGUAGE FILE) FOR S.E.E.R.
---------------------------------------------------------------------
System and Environment Effective Reports
Compatible with...
-- version 2, codename: Brahma Bull
     ________________
   `/    \-'  '-/    \`
          \    /
          (\||/)
---------------------------------------------------------------------
COPYRIGHT

 THE FOLLOWING 7 LINES MAY NOT BE REMOVED, but may be
     appended with additional contributor info.
 S.E.E.R. Language File Copyright (C) 2010, 2011, 2012, 2013, 2016
 V. Spinelli for SpinelliCreations. This program comes 
 with ABSOLUTELY NO WARRANTY. This is open code, released 
 under Creative Commons 3.0 Share Alike, Unported License,
 and you are welcome to redistribute it, with this tag 
 in tact.
	... http://www.spinellicreations.com
---------------------------------------------------------------------
---------------------------------------------------------------------
CONTACT		
		Author			Hakan Koni and Associates
				Email:	HakanKoni@Gmail.com
				Site:	n/a
				Handle:	n/a

		Copyright Holder	SpinelliCreations
				Email:	Vince@SpinelliCreations.com
				Site:	http://www.spinellicreations.com
---------------------------------------------------------------------
S.E.E.R. LANGUAGE FILE
-- SPANISH
---------------------------------------------------------------------
*/

	/* FILE SYSTEM NOTE */
	/* ---------------- */
	/* NOTE
	With regard to directory structure for UNIX versus WIN systems,
	S.E.E.R.'s implementation in PHP is operating system agnostic.
	Whether on WIN or UNIX, the syntax is the same.  For example...
	-- PHP call to folder... /my_folder/cheese
	-- will reference WIN folder... C:\my_folder\cheese
	-- will reference UNIX folder... /my_folder/cheese
	We rock the party that rocks the party.
	*/

/* S.E.E.R. LANGUAGE ENTRIES */
/* ------------------------------------------------------------------ */

/* RULES FOR MAKING AND EDITING LANGUAGE FILES */
/* ------------------------------------------------------------------ 	
	Unless otherwise noted, the ENGLISH language file is to be considered the 'Master Copy'
	upon which all other language files are to be based.

	-- If creating a NEW language file, then the file must be named...
		multilang_file_[LANGUAGE].php (located in the /seer_2/language folder)
	   Edit the /config/globaloptions_seer_0.php file to reflect the addition
	        of another available language.
	-- If editing an existing language file, or converting text for a language
		file, then all VARIABLES should be copied from the ENGLISH file, and
		defined appropriately in the OTHER language file(s).
	-- Observe case-sensitivity.
		-- -- If a variable is defined with uppercase-letters in ENGLISH, then
		      it should be defined with uppercase-letters in the translation.
		-- -- Example 1:
			$multilang_STATIC_0 = "Welcome";    (in ENGLISH)
			$multilang_STATIC_0 = "Bienvenido"; (in SPANISH)
		-- -- Example 2:
			$multilang_STATIC_HOURS = "HOURS";	(in ENGLISH)
			$multilang_STATIC_HOURS = "HORAS";	(in SPANISH)
		-- -- Failure to comply with case-sensitivity will result in skewed
		      otherwise odd-looking display behavior (where certain tags 
		      appear out of place).
	-- Observe special characters.
		-- -- If a variable is defined with "_" or "-" or "..." or 3another other
		      special characters, then they should be included in the
		      translation.
	-- Observe punctuation and capitalization.
		-- -- Some variables are sentences, which may or may-not start with a 
		      capital letter and may or may-not end with a period.  Whichever
		      is the case, carry it over with the translation.
	-- Observe character limits.
		-- -- Some variables are labeled with a limit on character number.  This
		      is because those variables have only a limited space within which
		      to be displayed.  A good example of this is the MENU tags, most of
		      which are limited to 21 characters.  Each is labeled as such.  If
		      you must abbreviate in the translation in order to preserve the
		      character limit, then do so.

	-- Use common sense.
		-- -- Some variables are abbreciations, such as "Temp" for "Temperature", or
		      "MPH" for "Miles per Hour".  Should you come across such a variable,
		      then we ask that you translate the phrase, and then provide an 
		      appropriate abbreviation in the translated language.
		-- -- Try to preserve roughly the same string length for variables.
		      Obviously, for longer sentences or paragraphs, this does not matter at
		      all.  However, tags, flags, and other "one or two word" variables should
		      be replaced with AS SHORT OF A TRANSLATION AS POSSIBLE.  For example,
		      	$multilang_STATIC_2 = "What is It?";	(ENGLISH)
			..., should not be replaced with a 10 word string unless absolutely
			necessary.
	-- Off limits.
		-- -- Any variable that is defined as another variable should not be edited
		      unless you intend to modify the program.  The purpose of these variables
		      acting redundantly is to allow portions of pages to be modified later
		      without major reconstruction if necessary.  That being said, these
		      variables are identified as...
			$master_variable = "SOMETHING";
			$slave_variable = $master variable;
					-- do not edit unless modifying program.
		-- -- DO NOT create additional slave variables, or link any variable
		      to another variable unless it has been done so already in the
		      ENGLISH version (master copy).
   ------------------------------------------------------------------ */

/*	-- STATIC PAGES */
/*	--------------- */
$multilang_STATIC_0 = "Bienvenido";
$multilang_STATIC_1 = "Acerca de";
$multilang_STATIC_2 = "Que es esto?";
$multilang_STATIC_3 = "es un completo Interfaz Maquina Humano (HMI), con todas las caracteristicas de un moderno Sistema de Control de Supervision y Adquisicion de Datos (SCADA), elevando el nivel mediante la integracion de Generacion de Informes.";
/*			-- to be read as... 'S.E.E.R. is a full featured... etc etc...' */
$multilang_STATIC_4 = "Para todos los efectos, S.E.E.R es un interfaz para mod_openopc (el motor detras de todas las maquinas en directa comunicacion OPC, registro de datos e instrucciones de maquina). En la mayoria de los casos, ofrece todas las caracteristicas de otras mas costosas, no compatibles que compite con cualquier plataforma... S.E.E.R es todo sobre USTED y su instalacion (o aplicacion).";
$multilang_STATIC_5 = "Compatibilidad para Usuarios";
$multilang_STATIC_6 = "Nos damos cuenta que, si bien es posible que pueda adquirir o construir un gran servidor, muchos de sus usuarios puede tener anticuados equipos, con los que entra y usa el sistema. No hay problema, hemos hecho a S.E.E.R compatible con la especificacion HTML DTD 4.01 Transicional... por lo que se ejecutara en cualquier equipo que pueda abrir un navegador compatible con los estandares de la web. Sin plugins, sin aplicaciones de Java, sin ocultar extensiones de terceros para descargar... sin mentiras.... Todo el trabajo se realiza del lado del servidor y los resultados aparecen en HTML puro. Esto significa que cualquier persona en cualquier sistema operativo puede ver S.E.E.R. Y, ya que cada sesion del explorador es un tema unico en un servidor compartido, un numero ilimitado de usuarios a la vez, pueden conectarse y usar S.E.E.R... Usted puede olvidarse de 'licencias de acceso de cliente.'";
$multilang_STATIC_7 = "Codigo Abierto para Estandares Abiertos";
$multilang_STATIC_8 = "Esta es la mejor parte. S.E.E.R se construye directamente para mod_openopc, basado en el trabajo previo del autor del proyecto. Mod_openopc se basa en el excelente trabajo de Barry Barnreiter para el proyecto OpenOPC. Estas tres herramientas individuales comparten un objetivo comun, patrimonio comun, y filosofia comun ...";
$multilang_STATIC_9 = "Todos son proyectos de codigo abierto, licenciados bajo  GNU GPL, de una forma u otra";
$multilang_STATIC_10 = "Esto significa que el codigo abierto esta completamente disponible para usted. Asi, se puede usar como es, modificar, o hacer cualquier otra cosa que sea necesaria para hacer su trabajo de aplicacion en particular";
$multilang_STATIC_11 = "Plataformas de Servidor";
$multilang_STATIC_12 = "mod_openopc esta escrito en Python puro, un lenguaje multiplataforma que le permite obtener un numero ilimitado de puntos de datos, desde un numero ilimitado de dispositivos OPC conectados. Conectarse a cualquier Servidor version 1.2 o 3 OPC (tales como RSLinx, Kepware, Matrikon, InGear, etc ..) con mod_openopc y empezar a tirar todos los datos de la maquina, que usted podria sonar en una buena y ordenada bases de datos Sun Microsystems MySQL, que luego son accesibles en cualquier forma que le guste (nosotros hemos elegido simplemente a S.E.E.R como una forma de acceder a esa base de datos). .";
$multilang_STATIC_13 = "Personalizacion Final";
$multilang_STATIC_14 = "Si usted esta dispuesto a trabajar con PHP (para la creacion de informes personalizados y panel de operador para las maquinas), entonces, S.E.E.R y mod_openopc le puede proporcionar control de planta de supervision completa y registro al alcance de cualquier persona con un explorador de la web";
$multilang_STATIC_15 = "Desarrollado por Pinguinos";
$multilang_STATIC_16 = "S.E.E.R es compatible con Unix. De hecho, S.E.E.R y mod_openopc fueron desarrollados originalmente en Fedora Core Linux (version 8), y posteriormente modificados para ser compatibles con Windows. Dicho esto, el rendimiento de Apache, PHP, MySQL y Python en Unix eclipsa completamente en Windows. Sin embargo, si usted no se siente comodo en movimiento, a una plataforma Unix, puede estar seguro, que la compatibilidad Win32/64 esta incluida";
$multilang_STATIC_17 = "Ultimas Noticias";
$multilang_STATIC_18 = "Para mas informacion o noticias sobre mod_openopc y SEER, visite la pagina del proyecto en ...";
$multilang_STATIC_19 = "Derechos de Autor y Licencia";
$multilang_STATIC_20 = "Gratis en Todos los Aspectos";
$multilang_STATIC_21 = "S.E.E.R y mod_openopc son software GRATIS. Si usted pago por algo, entonces usted es victima de un crimen. Mientras que, cualquier persona, en cualquier lugar, puede (y debe) cobrar una cuota de apoyo, reparacion, instalacion, asesoramiento tecnico u otros, sobre S.E.E.R o mod_openopc, todas las personas y entidades tienen PROHIBIDO COBRAR UNA CUOTA POR EL CODIGO FUENTE.";
$multilang_STATIC_22 = "Derechos de Autor";
$multilang_STATIC_23 = "Licencia";
$multilang_STATIC_24 = "Usted puede ver una copia de esta licencia y sus terminos aqui...";
$multilang_STATIC_25 = "Solicitud de Documentacion";
$multilang_STATIC_26 = "Documentos S.E.E.R.";
$multilang_STATIC_27 = "Documentos mod_openopc";
$multilang_STATIC_28 = "Toda la documentacion del sistema esta escrita en Ingles, que es el mismo idioma que todo el codigo fuente del sistema. Nos disculpamos por cualquier inconveniente.";
$multilang_STATIC_29 = "Exportar archivo";
$multilang_STATIC_30 = "Se ha producido un error al generar el archivo de exportacion El contenido no se especifico.";
$multilang_STATIC_31 = "Sugerimos";
/*			-- to be read as... 'We suggest this fine wine... */
$multilang_STATIC_32 = "para todas sus necesidades de Office";
/*			-- to be read as... 'This stapler is for all of your office needs' */
$multilang_STATIC_33 = "Su archivo de exportacion ya esta disponible para descarga ...";
$multilang_STATIC_34 = "Simplemente haga CLIC DERECHO sobre el archivo y seleccione:";
$multilang_STATIC_35 = "GUARDAR COMO para descargar el archivo.";
$multilang_STATIC_36 = "Policia de Transito";
/*			-- to be read as... 'Automatic Redirect' or 'Session Handler' */
$multilang_STATIC_37 = "Redirigir a su destino ...";
/*			-- to be read as... 'Redirecting [you] to your target [desired destination]'... */
$multilang_STATIC_38 = "Entrada de Usuario";
/*			-- to be read as... 'User Login' or 'User Sign On' */
$multilang_STATIC_39 = "Entrada con Exito...";
/*			-- to be read as... 'Successful Login...' or 'Successfully Signed On...' */
$multilang_STATIC_40 = "Entrada Fallida...";
/*			-- to be read as... 'Failed Login...' or 'Failed to Sign On...' */
$multilang_STATIC_41 = "Proceda usando el menu en la parte superior o base .";
$multilang_STATIC_42 = "Por favor, intentelo de nuevo. Recuerde, todos los nombres de usuario y contrasenas son sensibles entre mayusculas y minusculas!";
$multilang_STATIC_43 = "Lo sentimos. Alguien ya ha iniciado sesion desde esta terminal.";
$multilang_STATIC_44 = "Por favor, CERRAR SESION antes de intentar CONECTARSE nuevamente.";
$multilang_STATIC_45 = "La informacion del usuario activo de contacto es ...";
$multilang_STATIC_46 = "usuario:";
/*			-- prompt for login */
$multilang_STATIC_47 = "contrasena:";
/* 			-- prompt for login */
$multilang_STATIC_48 = "Si no tiene un nombre de usuario o contrasena, pongase en contacto con un administrador de sistema para obtener ayuda.";
$multilang_STATIC_49 = "Cierre de Sesion";
$multilang_STATIC_50 = "El usuario esta activo o ingreso en ...";
$multilang_STATIC_51 = "Adios.";
$multilang_STATIC_52 = "Maquina de Control y Estado Disponible";
$multilang_STATIC_53 = "Presentacion de Informes y Resumenes";
$multilang_STATIC_54 = "Ayuda y Contacto de Soporte";
$multilang_STATIC_55 = "Administradores";
$multilang_STATIC_56 = "Instrucciones de Contacto General";
$multilang_STATIC_57 = "Instrucciones de Contacto de Emergencia";
$multilang_STATIC_58 = "Preguntas Frecuentes";
$multilang_STATIC_59 = "Red Central de Fallas de Sistema";
$multilang_STATIC_60 = "disponible en";
/*			-- to be read as 'live at [time]' */
$multilang_STATIC_61 = "Felicitaciones!";
$multilang_STATIC_62 = "Hubo 0 (CERO) fallos registrados durante el periodo de tiempo que ha solicitado.";
$multilang_STATIC_63 = "Fechar";
$multilang_STATIC_64 = "Falla";
$multilang_STATIC_65 = "Ejecutar";
$multilang_STATIC_66 = "Servidor OPC";
$multilang_STATIC_67 = "Autorizado por";
$multilang_STATIC_68 = "En este momento hay 0 (CERO) fallas activas. El red central debe estar funcionando normalmente.";
$multilang_STATIC_69 = "Archivo de Software";
$multilang_STATIC_70 = "Los archivos encontrados coinciden con su criterio de busqueda en el servidor. Se enumeran a continuacion para su examen...";
$multilang_STATIC_71 = "NO se encontraron archivos que coinciden con su criterio de busqueda en el servidor.";
$multilang_STATIC_72 = "Su intento de busqueda de archivos dio como resultado lo siguiente...";
$multilang_STATIC_73 = "Su intento de carga de archivos resulto en lo siguiente...";
$multilang_STATIC_74 = "Bienvenido al Archivo de software. Aqui encontrara un repositorio de lo que debe considerarse Copias de Seguridad de Mision Critica de HMI, PLC, y otro controlador logico. Tambien, puede encontrar el software necesario para manipular el red central y ejecutar dichos programas.";
$multilang_STATIC_75 = "Como siempre, tenga en cuenta que el uso de estos archivos esta estrictamente prohibido fuera del ambito de aplicacion de (y posiblemente de ubicacion )de su lugar de trabajo. El acceso a estos archivos es intencionalmente limitado a Mantenimiento o Personal Experto, justamente por esa razon. Cualquier software que requiere una clave de licencia, debe ser instalado y [o] utilizado unicamente en virtud de la politica de manipulacion.";
$multilang_STATIC_76 = "Usted puede navegar por el RED CENTRAL DEL SOFTWARE (sistemas operativos, herramientas de autor, etc...) o por la VERSION EJECUTABLE (ejecutar software controlador disponible).";
$multilang_STATIC_77 = "Por ultimo, al subir nuevos archivos, por favor, elija la categoria que debe ser colocada, y observar la convencion de nomenclatura. Si no se puede descomprimir o hay paquete de archivos tar (similar a archivos 'zip'), el utilitario 7-zip es de libre acceso. Esta incluido para Windows y Unix. Maxima subida de archivos a la web es de 50 MB.";
$multilang_STATIC_78 = "Convencion de Nomenclatura";
$multilang_STATIC_79 = "TIPO";
$multilang_STATIC_80 = "CATEGORIA";
$multilang_STATIC_81 = "VENDEDOR o FABRICANTE";
$multilang_STATIC_82 = "NOMBRE";
$multilang_STATIC_83 = "VERSION";
$multilang_STATIC_84 = "FECHA-SUBIDO";
$multilang_STATIC_85 = "EXTENSION";
/*			-- to be read as... '[FILE] EXTENSION' */
$multilang_STATIC_86 = "para EJECUCION del software, se sustituira 'PROVEEDOR o FABRICANTE' con 'PLANTA' o 'UBICACION'";
$multilang_STATIC_87 = "por ejemplo...";
$multilang_STATIC_88 = "o";
/*			-- to be read as... '[OPTION A] or [OPTION B]' */
$multilang_STATIC_89 = "Busqueda de Archivo y Dialogo de Busqueda";
$multilang_STATIC_90 = "Criterios de ARCHIVO en el Servidor ...";
$multilang_STATIC_91 = "entrar en todos los campos conocidos, dejar desconocidos por defecto o en blanco";
$multilang_STATIC_92 = "SUBIDO-POR";
$multilang_STATIC_93 = "Ejecutar Busqueda de ARCHIVOS en el Servidor";
$multilang_STATIC_94 = "CUALQUIERA";
$multilang_STATIC_95 = "Seleccionar ARCHIVO para la Carga";
$multilang_STATIC_96 = "Nombre del ARCHIVO en el Servidor";
$multilang_STATIC_97 = "Cargar ARCHIVO al Servidor";
$multilang_STATIC_98 = "Manuales Tecnicos y Documentos";
$multilang_STATIC_99 = "Bienvenidos al ARCHIVO TECNICO. Aqui encontrara un repositorio de lo que se considera Copias de Seguridad de Mision Critica de Hardware y Software de Documentacion, que abarca Dispositivos Mecanicos y Electricos.";
$multilang_STATIC_100 = "Usted puede navegar por 'MECANICO', 'ELECTRICO', ' QUIMICO' u 'OTRO'.";
$multilang_STATIC_101 = "Carga de Archivos de Dialogo";
$multilang_STATIC_102 = "Si desea volver a intentarlo, haga clic aqui ...";
$multilang_STATIC_103 = "Configuracion: Agregar Usuarios";
$multilang_STATIC_104 = "Si desea agregar otro usuario, haga clic aqui ...";
$multilang_STATIC_105 = "Este usuario se ha anadido correctamente a la tabla de ACCESO.";
$multilang_STATIC_106 = "Configuracion: Quitar Usuarios";
$Multilang_STATIC_107 = "La eliminacion de USUARIO o GRUPO que solicita se realizo con exito. Por favor, revise la lista abajo, nuevamente, para asegurarse que hemos logrado el resultado deseado..";
$multilang_STATIC_108 = "Tenga en cuenta que no se puede eliminar un usuario que tiene un NIVEL DE ACCESO superior al suyo.";
$multilang_STATIC_109 = "Tenga en cuenta que no se puede modificar un usuario que tiene un NIVEL DE ACCESO superior al suyo.";
$multilang_STATIC_110 = "Portal Formacion de Quiosco";
$multilang_STATIC_111 = "Si la subida se ha realizado correctamente, asegurese de ANOTAR el nombre del archivo como aparece aqui en la pantalla. Usted lo necesitara mas adelante para vincular el archivo en su pagina de proyecto en curso dentro de Wiki..";
$multilang_STATIC_112 = "NOMBRE DE ARCHIVO ENLAZABLE"; 
$multilang_STATIC_113 = "Este es el Portal Formacion de Quiosco. Desde aqui se puede entrar en el Portal Formacion, o cargar datos en el REPOSITORIO DE FORMACION (requiere ADMINISTRADOR o nivel de acceso de SUPER USUARIO).";
$multilang_STATIC_114 = "Configuracion: Sistema y Usuarios";
$multilang_STATIC_115 = "Conectado como";
/*                      -- to be read as... 'Logged in as [username]' */
$multilang_STATIC_116 = "Plataforma de Desarrollo";
$multilang_STATIC_117 = "Servidor de Produccion";
$multilang_STATIC_118 = "El usuario no esta activo en este terminal.";
$multilang_STATIC_119 = "Bienvenido a ...";
/*                      -- to be read as... 'Welcome to... [some place]' */
$multilang_STATIC_120 = "Por favor INICIAR SESION primero, utilizando el boton en la parte superior derecha, luego, utilice la barra de menu, arriba, para navegar hasta su destino Si usted tiene algun problema, no dude en utilizar el enlace de AYUDA y SOPORTE TECNICO, abajo...";
$multilang_STATIC_121 = "Herramienta de Poder OPC";
$multilang_STATIC_122 = "Configuracion: Modificar Usuario";
$multilang_STATIC_123 = "Ultima Actividad";
$multilang_STATIC_124 = "WEB-INVITADO";
/*			-- to be read as... '[No user is logged in, so you have the default name] 'WEB-GUEST''. */
$multilang_STATIC_125 = "Mantenimiento del Servidor";
$multilang_STATIC_126 = "SIS_INFO";
/*			-- to be read as... '[abbreviation for] System Information' */
$multilang_STATIC_127 = "modificado e integrado en S.E.E.R.";
/*			-- to be read as... '[something was] modified and integrated into S.E.E.R.' */
$multilang_STATIC_128 = "Derechos de Autor";
/*			-- to be read as... '[something is] Copyright [years]' */
$multilang_STATIC_129 = "Licencia Exclusiva";
/*			-- to be interpreted as "there is only one license" */

/*	-- FAQ */
/*	------ */
$multilang_FAQ_1Q = "Despues que ha actualizado un valor o pulsa un boton, parece que se tarda un minuto en aparecer en mi pantalla ¿Por que es tan lento?"; 
$multilang_FAQ_1A = "En realidad, la actualizacion o el comando fue enviado de inmediato a la maquina. Sin embargo, los datos se recogen cada 'X' segundos (10, 30, 60, o cualquier segundo). Asi que en realidad no ve el resultado hasta que el siguiente lote de datos han sido recogidos y su pagina se actualiza automaticamente.";
$multilang_FAQ_2Q = "Mi pantalla aparece como 'apagado' en Microsoft Internet Explorer 6, o, a veces simplemente no funciona bien ¿Porque?"; 
$multilang_FAQ_2A_11 = "S.E.E.R fue desarrollado para navegadores compatibles con estandares que se ajusten a la especificacion DTD HTML 4.01 Transicional. Se trata de un estandar abierto que es compatible con plataforma multiple (funciona en cualquier sistema operativo). Lamentablemente, MS-IE 6, no es compatible con los estandares. Nosotros Recomendamos que utilice S.E.E.R con un navegador robusto y completo"; 
$multilang_FAQ_2A_12 = "Si es absolutamente necesario utilizar un navegador no compatible con los estandares, tales como MS Internet Explorer ,entonces, al menos, por favor, actualice a la version de MS IE 8, que, aunque todavia no es ideal, rinde mucho mejor que las versiones anteriores de IE."; 
$multilang_FAQ_2A_21 = "S.E.E.R ha sido probado y demostrado contra"; 
$multilang_FAQ_2A_22 = "Apple Safari v. 3 y 4 [excelente]"; 
$multilang_FAQ_2A_23 = "Konqueror v.3.5.x [excelente]"; 
$multilang_FAQ_2A_24 = "Opera v.10 [bien]"; 
$multilang_FAQ_2A_25 = "Mozilla Firefox v.3.0.x [Excelente - Norma para Comparacion]"; 
$multilang_FAQ_2A_26 = "Google Chrome v.4.0.249 (Beta) [bien]"; 
$multilang_FAQ_2A_27 = "Microsoft Internet Explorer v.6 [pantalla pobre, algunos informes no se mostraran]"; 
$multilang_FAQ_2A_28 = "Microsoft Internet Explorer v.7 y 8 [Buena - (escalado de imagen es pobre)]"; 
$multilang_FAQ_2A_31 = "S.E.E.R ha sido probado y fallo contra ..."; 
$multilang_FAQ_2A_32 = "Opera v.9 y anteriores [Un-visible - navegador de manejo no apropiado de objetos de nivel de bloque]"; 
$multilang_FAQ_2A_33 = "Microsoft Internet Explorer v.5.5 [Una-visible - falta de soporte CSS 2, muchos otros problemas]"; 
$multilang_FAQ_3Q = "Estoy utilizando Microsoft Internet Explorer 8 o superior, y todos los campos de introduccion de texto (Nombre de usuario, entrada manual de datos, etc ..), aparecen como campos muy pequenos, con letras muy pequenas y numeros. ¿Como solucionar este problema?"; 
$multilang_FAQ_3A_11 = "Esto es un error / violacion de cumplimiento en MSIE. Se esta tratando de aplicar estilos visuales a los elementos de formulario, sin haber sido invitado por el sistema de S.E.E.R Para solucionar este problema, desde el interior de MSIE, vaya a..";
/*			-- read as '... go to [and then instructions to follow]' */
$multilang_FAQ_3A_12 = "HERRAMIENTAS";
/*			-- MSIE v8 menu item */
$multilang_FAQ_3A_13 = "OPCIONES DE INTERNET";
/*			-- MSIE v8 menu item */
$multilang_FAQ_3A_14 = "AVANZADO";
/*			-- MSIE v8 menu item */
$multilang_FAQ_3A_15 = "NAVEGACION";
/*			-- MSIE v8 menu item */
$multilang_FAQ_3A_16 = "y ASEGURAR QUE HABILITAR ESTILOS VISUALES O BOTONES Y CONTROLES es SALIDA [NO-Comprobado!]";
/*			-- MSIE v8 menu item */
$multilang_FAQ_4Q = "Si actualizo mi equipo, S.E.E.R funcionara mejor, mas rapido, etc?"; 
$multilang_FAQ_4A = "No. S.E.E.R se ejecuta con 'servidor' 100%, lo que significa que todo el trabajo se esta haciendo en un servidor remoto y no en el equipo local. Todas las PC en realidad lo que estan haciendo, es mostrar una pagina web sencilla. Esto permite a S.E.E.R de manera efectiva ser utilizado por clientes en hardware tan antiguos como la generacion Pentium II (circa 1995). Por lo general, cualquier ordenador que pueda ejecutar un navegador web moderno, puede efectivamente utilizar funcionalidad S.E.E.R. Si se pregunta como conseguir un navegador moderno en hardware antiguo? ... Eche un vistazo a ";
/*			-- last part of the statment is to read as... 'Take a look at [Damn Small Linux]'.  Link is embedded in source. */
/* 	-- FLAGS */
/*	-------- */
$multilang_STATIC_START = "Inicio";
$multilang_STATIC_END = "Fin";
$multilang_STATIC_LEVEL = "NIVEL";
/*			-- to be read as '[Access] LEVEL' or 'LEVEL [of Access]' */
$multilang_STATIC_NOTE = "NOTA"; 
$multilang_STATIC_DENIED = "Acceso Denegado"; 
$multilang_STATIC_ACCESS_SKILLED_TRADES = "RESTRINGIDO A PERSONAL EXPERTO CALIFICADO."; 
$multilang_STATIC_ACCESS_ADMIN_SUPER = "RESERVADO A ADMINISTRADORES Y SUPER USUARIOS."; 
$multilang_STATIC_ACCESS_LEVEL_LOW = "Usted no se HA REGISTRADO o su NIVEL DE ACCESO no es suficiente para ver esta seccion. Si usted cree que esto es un error, por favor, pongase en contacto con el ADMINISTRADOR DE SISTEMA";
$multilang_STATIC_YES = "SI";
$multilang_STATIC_NO = "NO";
$multilang_STATIC_AUTO = "AUTOMATICO";
$multilang_STATIC_MANUAL = "MANUAL";
$multilang_STATIC_MODEL_ID = "Identificacion de Modelo";
$multilang_STATIC_REPORT = "Informe";
$multilang_STATIC_HMI = "HMI";
$multilang_STATIC_NAME = "nombre";
$multilang_STATIC_TITLE = "titulo";
$multilang_STATIC_DEPT = "departamento";
$multilang_STATIC_EMAIL = "email";
$multilang_STATIC_PHONE = "telefono";
$multilang_STATIC_YEAR = "ANO";
$multilang_STATIC_MONTH = "MES";
$multilang_STATIC_DAY = "DIA";
$multilang_STATIC_HOUR = "HORA";
$multilang_STATIC_MINUTE = "MINUTO";
$multilang_STATIC_DATESTAMP = "Fechar";
$multilang_STATIC_DATESTAMP_CAPS = "FECHAR";
$multilang_STATIC_START_OF_LOG = "Inicio de Sesion";
$multilang_STATIC_END_OF_LOG = "Fin de Sesion";
$multilang_STATIC_SELECT = "SELECCIONAR";
$multilang_STATIC_DISPLAY_REPORT_TICKET = "MOSTRAR INFORME DE ENTRADA";
$multilang_STATIC_EXPORT_HEADER = "Exportar y guardar datos de Informe";
$multilang_STATIC_EXPORT_REPORT = "Exportar los datos de este informe como un archivo CSV (para uso de Hoja de Calculo Office)";
$multilang_STATIC_NONE = "NINGUNO";
$multilang_STATIC_AGGREGATE = "TOTAL";
$multilang_STATIC_DISCRETE = "DISCRETO";
$multilang_STATIC_SYNERGISTIC = "SINERGICO";
$multilang_STATIC_SNAPSHOT_LENGTH = "Longitud Instantanea";
$multilang_STATIC_SNAPSHOT = "Instantanea";
$multilang_STATIC_YEARS = "ANOS";
$multilang_STATIC_MONTHS = "MESES";
$multilang_STATIC_DAYS = "DIAS";
$multilang_STATIC_HOURS = "HORAS";
$multilang_STATIC_MINUTES = "MINUTOS";
$multilang_STATIC_RANGE = "RANGO";
$multilang_STATIC_CERTIFIED = "CERTIFICADO";
$multilang_STATIC_CERTIFIED_BY = "CERTIFICADO POR";
$multilang_STATIC_COMMENT = "COMENTARIO";
$multilang_STATIC_CERTIFIED_HIGHLIGHT = "Los registros que requieren CERTIFICACION estan DESTACADOS. Los que ESTAN CERTIFICADOS se han destacado en VERDE, los que NO ESTAN CERTIFICADOS han sido resaltados en ROJO...";
$multilang_STATIC_REPORT_TICKET_FOR = "Informe de entrada para";
$multilang_STATIC_AS_USER = "como usuario";
/*		-- to be read as... '[event XYZ -- Joe Smith -- ] as user [jsmith1]' */
/*		-- also acceptable... '[something] identified by [something else] */
$multilang_STATIC_DNE = "DESCONOCIDO o YA NO EXISTE";
$multilang_STATIC_NA = "N/A";
$multilang_STATIC_UNKNOWN = "DESCONOCIDO";
/*			-- to be read as... [abbreviation for] 'Not Applicable' */
$multilang_STATIC_REGULATORY = "Reglamentario";
$multilang_STATIC_AUTO_SCALE_DISPLAY = "Auto-escala de Visualizacion de Informe?";
/*			-- to be read as... 'Auto[matically] scale the Report Display' [YES OR NO]*/
$multilang_STATIC_DISPLAY_UNDER_ALARM_CONDITION_ONLY = "Datos registrados durante Alarmas del Sistema Solamente?";
/*			-- to be read as... '[Display] Data Recorded during System Alarms Only[any alarms]?' */
$multilang_STATIC_Y_OR_N = "S o N";
/*			-- to be read as... [abbreviation for] 'YES or NO' */
$multilang_STATIC_YES = "SI";
$multilang_STATIC_NO = "NO";
$multilang_STATIC_START_TIME = "Tiempo de inicio";
$multilang_STATIC_START_TIME_CAPS = "TIEMPO DE INICIO";
$multilang_STATIC_END_TIME = "Tiempo Final";
$multilang_STATIC_END_TIME_CAPS = "TIEMPO FINAL";
$multilang_STATIC_REPORT_TIME = "tenga en cuenta, este informe requiere de unos momentos para generarse. Por favor, sea paciente, y no salga de esta pagina, o bien se cerrara la sesion..";
$multilang_STATIC_ITEMIZED = "desglose";
$multilang_STATIC_RANK = "POSICION";
$multilang_STATIC_FREQUENCY = "FRECUENCIA";
$multilang_STATIC_SYNERGISTIC_PARETO = "Sinergico de Pareto";
$multilang_STATIC_DISCRETE_PARETO = "Discreto de Pareto";
$multilang_STATIC_DISCRETE_ITEMS = "Elemento Discreto";
$multilang_STATIC_SORTING_STATUS = "Estado de Clasificacion";
$multilang_STATIC_CONGRATULATIONS = "¡Felicidades!";
$multilang_STATIC_ITEM = "ELEMENTO";
$multilang_STATIC_ITEM_LOWER = "Elemento";
$multilang_STATIC_RERUN_REPORT = "Ejecutar este informe en otro articulo o sistema sobre el mismo periodo de tiempo";
$multilang_STATIC_NEXT_ITEM_ID = "ID del articulo siguiente";
$multilang_STATIC_ERROR_CALL_ADMIN = "Si usted cree que esto es un error, por favor pongase en contacto con un administrador para obtener ayuda.";
$multilang_STATIC_DATA_TICKET = "Entrada de Datos";
$multilang_STATIC_NO_DATA_AVAILABLE = "NO HAY DATOS DISPONIBLES";
$multilang_STATIC_RECORD_MANUALLY_ADDED = "El registro fue Anadido Manualmente";
$multilang_STATIC_CERTIFICATION_TICKET = "Entrada de Certificacion";
$multilang_STATIC_NUMBER_OF_RECORDS = "Numero de Registros";
$multilang_STATIC_SERVER = "Servidor";
$multilang_STATIC_DB_TABLE = "Tabla de Base de Datos";
$multilang_STATIC_DATE_RANGE = "Rango de fechas";
$multilang_STATIC_YOUR_USERNAME = "Su Nombre de Usuario";
$multilang_STATIC_CURRENT_TIME = "Tiempo Actual";
$multilang_STATIC_SERVER_TIME = "Tiempo de Servidor";
$multilang_STATIC_CONFIRMATION_OF_TICKET = "Confirmacion de Datos de Entrada";
$multilang_STATIC_AUTO_CERT_BY = "Automaticamente Certificado por";
$multilang_STATIC_CERT_STAMP = "Sello de Certificacion";
$multilang_STATIC_CERT_COMMENT = "Comentario de Certificacion";
$multilang_STATIC_INPUT_MORE_RECORDS = "Para mas registros de entrada, haga clic aqui.";
$multilang_STATIC_CERT_INSPECT_LIST = "Usted debe inspeccionar esta lista (o imprimir para su registro) y asegurese que todos los registros que usted queria ingresar han entrado realmente. El sistema auto-cae (ignora) los registros, por los datos 'malos' o incompletos que hayan ingresado. Siempre se puede volver atras y anadir mas registros, si este es el caso."; 
$multilang_STATIC_DISPLAY_RECORDS_FOR_CERT = "Mostrar Registros Elegibles para Certificacion";
$multilang_STATIC_SAVE_DATA_TICKET_TO_SERVER = "Guardar Datos de Entrada al Servidor";
$multilang_STATIC_ACTION_IS_PERMANENT = "esta accion es permanente";
$multilang_STATIC_MAN_RECORDS_INPUT_EVERY = "El Manual de registros debe consignarse en un intervalo (en minutos) de ...";
$multilang_STATIC_MAN_RECORDS_COUNT = "Numero de entradas que usted desea ingresar ..."; 
$multilang_STATIC_ENTRIES_CAPS = "ENTRADAS";
$multilang_STATIC_BUILD_DATA_TICKET = "Construir una Entrada de Datos";
$multilang_STATIC_REVIEW_CERT = "Revision de Certificacion de Entradas";
$multilang_STATIC_CERT_HIGHLIGHT_RED_GREEN = "Los registros previamente certificados (por algun usuario) o introducidos manualmente aparecen con un relieve en (rojo) de fondo. Estos registros no pueden ser re-certificados, ya que ahora estan 'bloqueados'. Si usted elige certificar una entrada donde algunos registros han sido previamente certificados, entonces, su certificacion solo se aplicara a aquellos registros que NO han sido previamente certificados (estan no 'bloqueados' / no destacados).";
$multilang_STATIC_CERT_TIME_LIMIT = "Los datos deberan estar certificados con regularidad, por ejemplo, cada turno. Sin embargo, es posible que se remonten a 2 dias (48 horas) para certificar mayores registros. Por su diseno, los registros mas antiguos que no pueden ser firmados, aseguran la integridad y honestidad en el proceso de firma.";
$multilang_STATIC_TICKET_COMMENT_ENTRY = "Comentarios de Entrada";
$multilang_STATIC_SELECT_FROM_DROPDOWN_MODEST_REPORT = "Seleccione el ELEMENTO en el menu desplegable, a continuacion, escriba su tiempo de INICIO y tiempo final. Un informe modesto sera mostrado, que se auto-escala para el periodo de tiempo que ha seleccionado. Si a usted le gustaria ver una mayor precision (menos tiempo entre los registros), solo tiene que elegir el tiempo  INICIO y FINAL que estan mas juntos.";
$multilang_STATIC_SELECT_FROM_DROPDOWN_BRIEF = "entrar en su tiempo de INICIO y tiempo FINAL, utilizando el menu desplegable de campos. Un resumen de actividad sera presentado...";
$multilang_STATIC_SELECT_FROM_DROPDOWN = "Seleccione el ELEMENTO en el menu desplegable, a continuacion, escriba su tiempo de INICIO y tiempo FINAL. Un resumen sera presentado, abarcando este el periodo de tiempo...";
$multilang_STATIC_SELECT_ENTER_START_AND_SNAPSHOT = "ingrese su fecha de INICIO y tiempo, entonces su longitud de COPIA INSTANTANEA deseada (duracion de tiempo desde el inicio del registro que desea examinar).";
$multilang_STATIC_CERT_NO_COMMENTS = "No hubo COMENTARIOS ofrecidos por los registros que se han mostrado.";
$multilang_STATIC_CERT_SIGNATURE_HEADER = "Certificacion de Firma";
$multilang_STATIC_CERT_NO_SIGS = "No hubo FIRMAS registradas para los registros que se han mostrado.";
$multilang_STATIC_DURATION = "Duracion";
$multilang_STATIC_DURATION_CAPS = "DURACION";
$multilang_STATIC_DURATION_IN_SECONDS = "DURACION en SEGUNDOS";
$multilang_STATIC_DURATION_IN_SECONDS_SMALL = "Duracion en segundos";
$multilang_STATIC_DETAIL_RUNDOWN_INDIVIDUAL = "Resumen de Detalle Clasificado Superior - Sistemas Individuales o elementos";
$multilang_STATIC_DETAIL_RUNDOWN_ALL = "Resumen de Detalle - Clasificados - Todos los sistemas o elementos";
$multilang_STATIC_PARETO_FREQUENCY_ALL = "Analisis de Frecuencia de Pareto - Todos los sistemas o elementos";
$multilang_STATIC_PARETO_DURATION_ALL = "Analisis de Duracion de Pareto - Todos los sistemas o elementos";
$multilang_STATIC_PARETO_EXPLAIN = "Los Diagramas de Analisis de Pareto seran mostrado en el tiempo total realizado por cada estado de alarma o averia, asi como la frecuencia (una es analizada por la duracion, la otra por frecuencia). El desglose de las fallas individuales pueden ser vistas en Resumen de Detalle,Clasificado Superior, seguida de una lista completa de alarmas y fallos de Sistemas Individuales, todos los cuales estan ordenados en orden de mayor duracion (mayor impacto).";
$multilang_STATIC_SORTING_STATUS_EXPLAIN = "El estado de ordenacion para cada matriz asociada, es indicado por 'verde' para Exito o 'Rojo' para Fallido ... El exito es necesario para la identificacion precisa de evento y tiempo.";
$multilang_STATIC_NO_FAULTS_IN_SNAPSHOT = "Hubo cero (0) fallos registrados durante el periodo de tiempo de la COPIA INSTANTANEA que ha solicitado."; 
$multilang_STATIC_EVENT = "EVENTO";
$multilang_STATIC_CURRENT_OR_HISTORICAL_INVENTORY = "Seleccione si desea ver niveles de inventario ACTUAL o HISTORICO. Si elige HISTORICO, a continuacion, escriba su tiempo de COPIA INSTANTANEA. Todo el inventario conocido en ese momento se mostrara. Si elige ACTUAL, entonces usted NO tiene que entrar en un tiempo de COPIA INSTANTANEA.";
$multilang_STATIC_INVENTORY_TYPE = "Tipo de Inventario";
$multilang_STATIC_CURRENT_BLIP = "Actual";
$multilang_STATIC_HISTORICAL_BLIP = "Historicos";
$multilang_STATIC_DATA_WITHIN_15 = "Los datos tienen una precision de 15 minutos de tiempo de entradas.";
$multilang_STATIC_DATESTAMP_START = "INICIO FECHAR";
$multilang_STATIC_DATESTAMP_END = "FINAL FECHAR";
$multilang_STATIC_DST_NOT_IN_EFFECT = "Tenga en cuenta, este servidor no utiliza el horario de verano, o cualquier otro cambio de tiempo, el tiempo que se muestra es GMT [mas o menos el ajuste de zona horaria del servidor de ubicacion de despliegue]..";
$multilang_STATIC_HOLD = "SOSTENER";
/*			-- to be read as... 'HOLD' or 'PAUSE' */
$multilang_STATIC_STEP = "SALTAR PASO";
/*			-- to be read as... 'JUMP STEP' or 'SKIP STEP' */
$multilang_STATIC_LOCKOUT_CAPS = "BLOQUEO";
/*			-- to be read as... 'LOCKOUT' or 'DISABLE' */
$multilang_STATIC_DISABLES_MANUAL_FUNCTIONS = "deshabilita funciones del manual";
$multilang_STATIC_FORCE_HOLD = "Mantener la Fuerza";
$multilang_STATIC_RELEASE_HOLD = "Version Mantener";
$multilang_STATIC_FORCE_STEP = "Paso de Fuerza";
$multilang_STATIC_LOCKOUT = "bloqueo";
$multilang_STATIC_RELEASE = "version";
$multilang_STATIC_FAULTS_CAPS = "DEFECTOS";
$multilang_STATIC_YorN_AUTOSCALE_REPORT_NOTICE = "seleccionar SI o NO para 'Mostrar informe de Auto Escala' ... seleccionar SI recortara el informe abajo para que encaje en 2 o 3 paginas (cuando se imprima). La fecha totalizada (flujo total / total de energia / etc...) seguira siendo correcta.  La Seleccion NO mostrara todos los registros recogidos, pero conlleva un informe mucho mas largo y mas grande. Si selecciona NO, entonces es altamente recomendable que no intente una longitud de captura de mas de 3 dias (72 horas).";
$multilang_STATIC_DISPLAY = "Mostrar";
$multilang_STATIC_HIDE = "Ocultar";
$multilang_STATIC_SHOW_DISCRETE_ALARM_INSTANCES = "de forma predeterminada, las instancias de alarmas se cuentan, al no aparecen de forma individual. La eleccion para mostrar discretos casos de alarma puede dar lugar a un informe mucho mas tiempo.";
$multilang_STATIC_ALARMS = "Alarmas";
$multilang_STATIC_HIGH_PRECISION = "de Alta Precision";
$multilang_ATMOSPHERICMODEL_15 = $multilang_STATIC_EXAMINATION_WINDOW;
/*		-- to be read as "examination window [of time]" */
$multilang_STATIC_PAGE_LOAD_TIME = "Tiempo de Carga de Pagina";
$multilang_STATIC_BROWSER_ENGINE = "Motor";
$multilang_STATIC_BROWSER_NAME = "Nombre";
$multilang_STATIC_BROWSER_VERSION = "Version";
$multilang_STATIC_THEME = "Tema";
$multilang_STATIC_PLUGINS = "Extension";
$multilang_STATIC_EXPORT_PDF_HEADER = "Exportar Informe en Formato PDF";
$multilang_STATIC_EXPORT_PDF_DESCRIPTION = "Imprima este informe como un archivo PDF (para archivos no controlada y el intercambio)";

/*	-- MENU */
/*	------- */

/*	-- -- SIZE LIMITED VARIABLES */
/*	---------------------------- */
/*			-- ALL VARIABLES IN THIS BLOCK ARE... 20 characters MAX */
$multilang_MENU_MACHINE_CONTROL = "Control de Maquina";
$multilang_MENU_REPORTING = "Informacion";
$multilang_MENU_SETTINGS = "Configuracion";
$multilang_MENU_LOGIN = "Nombre";
$multilang_MENU_LOGOUT = "Cerrar Sesion";
$multilang_MENU_HOME = "Inicio";
$multilang_MENU_APPLICATION_DOCS = "Solicitud de Doc";
$multilang_MENU_ABOUT = "Acerca de";
$multilang_MENU_HELP = "Ayuda y Soporte Tec.";
$multilang_MENU_COPYRIGHT = "Autor y Licencia";
$multilang_MENU_TRAINING = "Portal de Formacion";
$multilang_MENU_TECHNICAL = "Archivo Tecnico";
$multilang_MENU_SOFTWARE = "Archivo de Software";
/*			-- ALL VARIABLES IN THIS BLOCK ARE... 20 characters MAX */

/*	-- -- STANDARD VARIABLES */
/*	------------------------ */
$multilang_MENU_BACK = "Volver";
$multilang_MENU_POWERED_BY = "Desarrollado por";
$multilang_MENU_BUILT_WITH = "Construido por";
$multilang_MENU_FOOTER_1 = "S.E.E.R y mod_openopc son software de CODIGO ABIERTO para plataformas LAMPP y AMPP .";
$multilang_MENU_CONFIDENTIAL = "Todos los datos son confidenciales";
$multilang_MENU_NO_PIRATES = "Este informe no puede ser utilizado en su totalidad o parcialmente, sin el permiso expreso de";
$multilang_MENU_DATACOPYRIGHTPOLICY = "La maquina, dispositivo o equipo (incluidos los resultados de los calculos y combinaciones basadas en los datos) incluidos en esta pantalla o generados por esta pantalla son propiedad de la persona, personas, organizacion, empresa o entidad que tenga implementado el sistema de S.E.E.R. Esto, por supuesto, no incluye datos de terceros que lleven su propia licencia o derecho de autor (por ejemplo, el propio sistema S.E.E.R, manuales de equipo creado por fabricante, y otros vinculados a los archivos).";

/*	-- SETTINGS DESCRIPTIONS */
/*	------------------------ */
$multilang_SETTINGS_USERNAME = "NOMBRE DE USUARIO";
$multilang_SETTINGS_USERNAME_D = "un unico nombre de usuario";
$multilang_SETTINGS_REALNAME = "NOMBRE REAL";
$multilang_SETTINGS_REALNAME_D = "primero nombre real del usuario, y luego apellido";
$multilang_SETTINGS_PASSWORD = "CONTRASENA";
$multilang_SETTINGS_PASSWORD_D = "contrasena de acceso";
$multilang_SETTINGS_PHONE = "TELEFONO";
$multilang_SETTINGS_PHONE_D = "numero de telefono de usuario, o nada";
$multilang_SETTINGS_EMAIL = "e-mail";
$multilang_SETTINGS_EMAIL_D = "direccion de correo electronico del usuario, o nada";
$multilang_SETTINGS_COMPANY = "COMPANIA";
$multilang_SETTINGS_COMPANY_D = "nombre de la compania, por ejemplo, 'Lactalis American Group'";
$multilang_SETTINGS_SHIFT = "Desplazamiento";
$multilang_SETTINGS_SHIFT_D = "Desplazamiento del trabajo del usuario";
$multilang_SETTINGS_SITE = "SITIO";
$multilang_SETTINGS_SITE_D = "sitio de la compania, por ejemplo, 'Sorrento (Buffalo, Nueva York).'";
$multilang_SETTINGS_DEPARTMENT = "DEPARTMENTO";
$multilang_SETTINGS_DEPARTMENT_D = "Departamento de la compania, por ejemplo, 'Produccion de Mozzarella'";
$multilang_SETTINGS_SUPERVISOR = "SUPERVISOR";
$multilang_SETTINGS_SUPERVISOR_D = "nombre de usuario del supervisor de este usuario";
$multilang_SETTINGS_ACCESS_LEVEL = "NIVEL DE ACCESO";
$multilang_SETTINGS_ACCESS_LEVEL_D = "nivel de acceso del usuario";
$multilang_SETTINGS_ACCESS_STATE = "ESTADO DEL ACCESO";
$multilang_SETTINGS_ACCESS_STATE_D = "estado de acceso del usuario";
$multilang_SETTINGS_COMMIT_USER_ADD = "Adicionar Confirmar Usuario";
$multilang_SETTINGS_ACCESS_GRANTED = "ACCESO CONCEDIDO"; 
$multilang_SETTINGS_ACCESS_GRANTED_BY = "ACCESO CONCEDIDO POR";
$multilang_SETTINGS_LAST_MODIFIED = "ULTIMA ACTUALIZACION";
$multilang_SETTINGS_LAST_MODIFIED_BY = "ULTIMA MODIFICACION POR";
$multilang_SETTINGS_LAST_LOGIN = "ULTIMO INICIO DE SESION";
$multilang_SETTINGS_LAST_ACTIVITY = "ULTIMA ACTIVIDAD";
$multilang_SETTINGS_HASH_KEY = "CLAVE NUMERICA";
$multilang_SETTINGS_REMOVE_SINGLE_USER = "Eliminar un Solo Usuario";
$multilang_SETTINGS_COMMIT_USER_REMOVE = "Confirmar Eliminacion de Usuario";
$multilang_SETTINGS_REMOVE_GROUP_OF_USERS = "Eliminar Grupo de Usuarios";
$multilang_SETTINGS_GROUP_ID_BY = "Grupo Identificado por ...";
$multilang_SETTINGS_COMMIT_GROUP_REMOVE = "Confirmar Eliminacion de Grupo";
$multilang_SETTINGS_COMMIT_USER_CHANGES = "Confirmar Cambios de Usuario";
$multilang_SETTINGS_INSTALLERS_ONLY = "INSTALADORES SOLAMENTE";
$multilang_SETTINGS_INSTALLERS_ONLY_WARNING_1 = "USO CON EXTREMA PRECAUCION!";
$multilang_SETTINGS_INSTALLERS_ONLY_WARNING_2 = "¡NO HAY RECUPERACION DE ESTE PUNTO";
$multilang_SETTINGS_INITIAL_INSTALLATION = "Instalacion Inicial";
$multilang_SETTINGS_WARNING_ERASES_ALL_DATA = "ADVERTENCIA: borra TODOS los datos.";
$multilang_SETTINGS_CREATE_BASIC_DATABASE = "crear base de datos de base a partir de cero";
$multilang_SETTINGS_DESTROY_DATABASE = "destruir base de datos existentes y todos los datos";
$multilang_SETTINGS_CREATE_TRAINING_PORTAL_DATABASE = "crear base de datos en Portal de Formacion a partir de cero";
$multilang_SETTINGS_CREATE_CORE_MODEL_TABLE = "crear tabla base de modelo";
$multilang_SETTINGS_ADMINISTRATORS_ONLY = "ADMNISTRADORES SOLAMENTE";
$multilang_SETTINGS_CORE_MODEL_SETUP = "Modelo basico de instalacion";
$multilang_SETTINGS_SUPER_USERS_ONLY = "USUARIOS SUPER SOLAMENTE";
$multilang_SETTINGS_ADD_AND_REMOVE_USERS = "Agregar y quitar usuarios";
$multilang_SETTINGS_ADD_SYSTEM_USERS = "anadir usuarios de sistema";
$multilang_SETTINGS_REMOVE_SYSTEM_USERS = "eliminar usuarios de sistema";
$multilang_SETTINGS_LOCKDOWN_CONTROL = "Bloqueo de Control";
$multilang_SETTINGS_LOCKDOWN_IN_EFFECT = "Todos los usuarios de sistema con un NIVEL DE ACCESO inferior a 2 (Super Usuario) han sido EXCLUIDOS del sistema. Gracias..";
$multilang_SETTINGS_LOCKDOWN_RELEASED = "Todos los usuarios del sistema con un NIVEL DE ACCESO inferior a 2 (Super Usuario) han sido RETORNADOS a su anterior ESTADO DE ACCESO. Gracias..";
$multilang_SETTINGS_LOCKDOWN_ENABLE_ACCESS = "permitir acceso, a los usuarios volver al estado anterior de acceso";
$multilang_SETTINGS_LOCKDOWN_DISABLE_ACCESS = "bloqueo de todos los usuarios - desactivar todos los accesos";
$multilang_SETTINGS_LEAD_PERSONS_ONLY = "PERSONAS LIDERES SOLAMENTE";
$multilang_SETTINGS_MODIFY_USER_ACCESS_AND_INFORMATION = "Modificar acceso de usuarios e Informacion";
$multilang_SETTINGS_DISPLAY_ALL_USERS = "mostrar todos los usuarios de sistema";
$multilang_SETTINGS_DISPLAY_SITE_USERS = "mostrar todos los usuarios registrados de su SITIO";
$multilang_SETTINGS_DISPLAY_DEPARTMENT_USERS = "mostrar todos los usuarios registrados a su DEPARTAMENTO";
$multilang_SETTINGS_DISPLAY_SHIFT_USERS = "mostrar todos los usuarios registrados a su desplazamiento";
$multilang_SETTINGS_OPERATORS_ONLY = "OPERADORES SOLAMENTE";
$multilang_SETTINGS_CHANGE_YOUR_PASSWORD = "Cambie su Contrasena de Sistema";
$multilang_SETTINGS_PASSWORD_UPDATED = "Su contrasena ha sido actualizada. Gracias..";
$multilang_SETTINGS_OLD_PASSWORD = "vieja contrasena";
$multilang_SETTINGS_NEW_PASSWORD = "nueva contrasena";
$multilang_SETTINGS_DATA_FRESH_AS_OF = "Nuevos Datos a Partir de";
$multilang_SETTINGS_SUPERVISORS_ONLY = "SUPERVISORES SOLAMENTE";
$multilang_SETTINGS_MANAGERS_ONLY = "GERENTES SOLAMENTE";

/*	-- FAULTS */
/*	--------- */
$multilang_FAULT_1 = "El NIVEL DE ACCESO no es suficiente para ver esta pagina."; 
$multilang_FAULT_2 = "variable que falta - 'ANO DE INICIO'"; 
$multilang_FAULT_3 = "variable que falta - 'MES DE INICIO'"; 
$multilang_FAULT_4 = "variable que falta - 'DIA DE INICIO'"; 
$multilang_FAULT_5 = "variable que falta - 'HORA DE INICIO'"; 
$multilang_FAULT_6 = "variable que falta - 'MINUTO DE INICIO'"; 
$multilang_FAULT_7 = "variable que falta - 'FIN DE ANO'"; 
$multilang_FAULT_8 = "variable que falta - 'FIN DE MES'"; 
$multilang_FAULT_9 = "variable que falta - 'FIN DEL DIA'"; 
$multilang_FAULT_10 = "variable que falta - 'HORA FINAL'"; 
$multilang_FAULT_11 = "variable que falta - 'MINUTO FINAL'"; 
$multilang_FAULT_12 = "Error de visualizacion o falla"; 
$multilang_FAULT_13 = "hemos detectado una falla al intentar procesar la informacion que ha proporcionado."; 
$multilang_FAULT_14 = "Las causas comunes incluyen campos de datos vacios o faltantes, cuadros desplegables en blanco. Normalmente, el sistema pasara por alto los errores, incluyendo los « malos » registros, y mostrara solo los buenos.."; 
$multilang_FAULT_15 = "Error Registrado como"; 
/*			-- to be read as... 'Fault Registered As [some fault]' */
$multilang_FAULT_16 = "Administrador o Reconocimiento de Fallo de Super Usuario."; 
$multilang_FAULT_17 = "Borrar Todas las Fallas Activas"; 
$multilang_FAULT_18 = "Fallos Activos Actuales y Notificaciones"; 
$multilang_FAULT_19 = "Historial de Busqueda de Fallos"; 
$multilang_FAULT_20 = "limpiar un fallo no lo elimina del sistema. Esto simplemente lo empuja al historial, donde cualquier usuario puede ver mas tarde algo y todas las fallas registradas entre un periodo de tiempo seleccionado (asi como los nombres de usuario de quien despejo las fallas)."; 
$multilang_FAULT_21 = "una vez que el administrador del sistema ha corregido la causa de las fallas, un administrador o un super usuario puede entonces despejar las fallas, mediante un formulario que aparecera debajo de cualquier falla activa. Este formulario solo es visible para el Nivel 2 y Nivel 1 de usuarios, asi que no se alarme si no lo ve.";
$multilang_FAULT_22 = "S.E.E.R se crea por una red central autonoma de entrada de datos y sistema de salida (mod_openopc). En el caso de un problema, un error se produce por la red central y se registra en el almacenamiento de datos. TODOS los fallos ACTUALMENTE ACTIVOS se enumeran a continuacion."; 
$multilang_FAULT_23 = "variable que falta - 'TIPO DE ARCHIVO'"; 
$multilang_FAULT_24 = "variable que falta - 'CATEGORIA DE ARCHIVO'"; 
$multilang_FAULT_25 = "variable que falta - 'ARCHIVO VENDEDOR o SITIO'"; 
$multilang_FAULT_26 = "variable que falta - 'NOMBRE DE ARCHIVO'"; 
$multilang_FAULT_27 = "variable que falta - 'REVISION DE ARCHIVO'"; 
$multilang_FAULT_28 = "falta variable - 'EXTENSION DE ARCHIVO'"; 
$multilang_FAULT_29 = "YA EXISTEN en el servidor. Usted no puede sobrescribir (Esto no deberia ocurrir, a menos que el reloj del servidor fuera alterado intencionalmente para forzar sobrescribir ilegalmente).";
$multilang_FAULT_30 = "Fallo al enviar al servidor."; 
/*			-- to be read as... '[something] FAILED TO POST to the server.' */
$multilang_FAULT_31 = "se ha subido correctamente al servidor.";
/*			-- to be read as... '[something] was successfully uploaded to the server.' */
$multilang_FAULT_32 = "EL NOMBRE DE USUARIO deseado ya existe. Si desea agregar un nuevo registro, primero debe eliminar el usuario existente!"; 
$multilang_FAULT_33 = "Todos los campos de variable de usuario deben ser llenados completamente antes que un usuario pueda ser agregado. Por favor revise el formulario, completarlo y enviarlo."; 
$multilang_FAULT_34 = "Usted no se ha REGISTRADO. Usted debe ser un USUARIO DE SISTEMA AUTORIZADO para acceder a esta pagina.."; 
$multilang_FAULT_35 = "Falla de sistema desconocido. Pongase en contacto con un administrador si esto persiste."; 
$multilang_FAULT_36 = "Entorno de Ejecucion DESCONOCIDO"; 
$multilang_FAULT_37 = "Esto es inaceptable. Ver archivo -globaloptions_seer_0 para mas informacion.."; 
$multilang_FAULT_38 = "variable que falta- ' SELECCION INSTANTANEA'"; 
$multilang_FAULT_39 = "No hay datos disponibles por el momento INSTANTANEO especificado. Si elige ACTUAL entonces el sistema puede caerse (por favor, contacte a un administrador), de lo contrario, usted ha entrado en un tiempo de historial incorrecto, o el sistema se redujo durante el tiempo que ha especificado.";
$multilang_FAULT_40 = "variable que falta - 'FECHAR AL INICIO'"; 
$multilang_FAULT_41 = "variable que falta - 'FECHAR AL FINAL'"; 
$multilang_FAULT_42 = "variable que falta - 'COMENTARIO DE ENTRADA'"; 
$multilang_FAULT_43 = "variable que falta - 'INFORME DE AUTO ESCALA'"; 
$multilang_FAULT_44 = "No habia actividad registrada durante el tiempo INSTANTANEO que ha solicitado."; 
$multilang_FAULT_45 = "O bien el SISTEMA en este MODELO esta fuera de servicio durante el periodo de tiempo solicitado, O, puede que haya seleccionado una fecha en el futuro."; 
$multilang_FAULT_46 = "Funciones de limpieza LIMPIA, mencionadas anteriormente, solo se aplican a los equipos y maquinas de AUTO-LIMPIEZA. Informacion general de limpieza LIMPIA para el resto del equipo se puede ver con los informes generados por el MODELO LIMPIA, y acceder al sistema de limpieza adecuado."; 
$multilang_FAULT_47 = "El modelo en cuestion no esta habilitado en este sytem.";
$multilang_FAULT_48 = "La base de datos es WORM protegida.";

/*	-- SETUP */
/*	-------- */
$multilang_SETUP_0 = "CONFIGURACION DE BASE DE DATOS"; 
$multilang_SETUP_1 = "Hemos encontrado un error!"; 
$multilang_SETUP_2 = "Parece que una de las siguientes condiciones es verdadera, y nos impide la creacion de la base de datos o tabla ..."; 
$multilang_SETUP_3 = "- la base de datos o tabla ya ha sido creada, y todavia existe."; 
$multilang_SETUP_4 = "- ha introducido nombre de usuario incorrecto o credenciales de contrasena para la base de datos MySQL."; 
$multilang_SETUP_5 = "- se ha introducido una incorrecta direccion IP o nombre de base de datos para la base de datos MySQL."; 
$multilang_SETUP_6 = "Por favor, consulte el archivo-globaloptions_seer_0 y haga que el administrador revise la base de datos a traves de la consola, si es necesario."; 
$multilang_SETUP_7 = "No salir de esta pagina!"; 
$multilang_SETUP_8 = "Lea el mensaje de abajo, y se le enviara de nuevo al menu de CONFIGURACION en 90 segundos."; 
$multilang_SETUP_9 = "La base de datos ya debe estar instalada y lista para usar. Usted puede comprobar esto, mediante la apertura de MySQL a traves de la consola y la emision de las consultas siguientes ..."; 
$multilang_SETUP_10 = "la salida debe incluir"; 
$multilang_SETUP_11 = "Si los resultados antes mencionados no estan presentes, a continuacion, revise el archivo-globaloptions_seer_0."; 
$multilang_SETUP_12 = "Si ya ha instalado la tabla de base de datos, a continuacion, debe quitarla antes de poder instalarla nuevamente."; 
$multilang_SETUP_13 = "DESTRUIR BASE DE DATOS"; 
$multilang_SETUP_14 = "La base de datos debe ser destruida y eliminada. Usted puede comprobar esto mediante la apertura de MySQL a traves de la consola y la emision de las consultas siguientes ..."; 
$multilang_SETUP_15 = "la salida NO deberia incluir"; 
$multilang_SETUP_16 = "la salida debe incluir SOLO el usuario por defecto"; 
$multilang_SETUP_17 = "Su informacion de ENTRADA por defecto es la siguiente..."; 
$multilang_SETUP_18 = "ADMINISTRADOR POR DEFECTO"; 
$multilang_SETUP_19 = "CONTRASENA POR DEFECTO"; 
$multilang_SETUP_20 = "Usted deberia cambiar estas, tan pronto como sea posible para ABRIR SESION, y luego cambiar la contrasena en el menu de CONFIGURACION."; 

/* PHPSYSINFO */
/* ------------------------------------------------------------------ */
$multilang_PHPSYSINFO_0 = "Informacion del Sistema"; 
$multilang_PHPSYSINFO_1 = "Sistema Vital"; 
$multilang_PHPSYSINFO_2 = "Nombre de Sistema Central Canonico"; 
$multilang_PHPSYSINFO_3 = "Escuchar IP"; 
$multilang_PHPSYSINFO_4 = "Version del Nucleo"; 
$multilang_PHPSYSINFO_5 = "Nombre Distro"; 
$multilang_PHPSYSINFO_6 = "Tiempo de Actividad"; 
$multilang_PHPSYSINFO_7 = "Usuarios Actuales"; 
$multilang_PHPSYSINFO_8 = "Promedios de Carga"; 
$multilang_PHPSYSINFO_9 = "Informacion de Hardware"; 
$multilang_PHPSYSINFO_10 = "Procesadores"; 
$multilang_PHPSYSINFO_11 = "Modelo"; 
$multilang_PHPSYSINFO_12 = "Velocidad de la CPU"; 
$multilang_PHPSYSINFO_13 = "Velocidad BUS"; 
$multilang_PHPSYSINFO_14 = "Tamano de Antememoria"; 
$multilang_PHPSYSINFO_15 = "Sistema BogoMips"; 
$multilang_PHPSYSINFO_16 = "Dispositivos PCI"; 
$multilang_PHPSYSINFO_17 = "Dispositivos IDE"; 
$multilang_PHPSYSINFO_18 = "Dispositivos SCSI"; 
$multilang_PHPSYSINFO_19 = "Dispositivos USB"; 
$multilang_PHPSYSINFO_20 = "Uso de la Red"; 
$multilang_PHPSYSINFO_21 = "Dispositivo"; 
$multilang_PHPSYSINFO_22 = "Fecha"; 
$multilang_PHPSYSINFO_23 = "Enviado"; 
$multilang_PHPSYSINFO_24 = "Error / Bajada"; 
/*			-- to be read as... '[abbreviation for] Errors/Dropped [packets]' */
$multilang_PHPSYSINFO_25 = "Conexiones de red Establecidas"; 
$multilang_PHPSYSINFO_26 = "Memoria"; 
$multilang_PHPSYSINFO_27 = "Memoria Fisica"; 
$multilang_PHPSYSINFO_28 = "Disco de Intercambio"; 
$multilang_PHPSYSINFO_29 = "Sistemas de Archivo Montados"; 
$multilang_PHPSYSINFO_30 = "Montaje"; 
$multilang_PHPSYSINFO_31 = "Particion"; 
$multilang_PHPSYSINFO_32 = "Porcentaje de Capacidad"; 
$multilang_PHPSYSINFO_33 = "Tipo"; 
$multilang_PHPSYSINFO_34 = "Gratis"; 
$multilang_PHPSYSINFO_35 = "Usado"; 
$multilang_PHPSYSINFO_36 = "Tamano"; 
$multilang_PHPSYSINFO_37 = "Totales"; 
$multilang_PHPSYSINFO_38 = "KB"; 
/*			-- to be read as... '[abbreviation for] Kilobytes' */
$multilang_PHPSYSINFO_39 = "MB";
/*			-- to be read as... '[abbreviation for] Megabytes' */
$multilang_PHPSYSINFO_40 = "GB";
/*			-- to be read as... '[abbreviation for] Gigabytes' */
$multilang_PHPSYSINFO_42 = "Capacidad"; 
$multilang_PHPSYSINFO_43 = "Plantilla"; 
$multilang_PHPSYSINFO_44 = "Lenguage"; 
$multilang_PHPSYSINFO_45 = "Enviar"; 
$multilang_PHPSYSINFO_46 = "Creado por"; 
$multilang_PHPSYSINFO_47 = "en_US"; 
/*			-- DO NOT EDIT $multilang_PHPSYSINFO_47 */
/*			-- SHOULD REMAIN THE SAME FOR ALL LANGUAGES */
/*			-- THIS IS A 'HACK' OF SORTS */
$multilang_PHPSYSINFO_48 = "%b %d, %Y @ %I:%M %p";
/*			-- DO NOT EDIT $multilang_PHPSYSINFO_48 */
/*			-- SHOULD REMAIN THE SAME FOR ALL LANGUAGES */
/*			-- THIS IS A 'HACK' OF SORTS */
$multilang_PHPSYSINFO_49 = "dias"; 
$multilang_PHPSYSINFO_50 = "hora"; 
$multilang_PHPSYSINFO_51 = "minutos"; 
$multilang_PHPSYSINFO_52 = "Temperatura"; 
$multilang_PHPSYSINFO_53 = "Tension"; 
$multilang_PHPSYSINFO_54 = "Fans"; 
$multilang_PHPSYSINFO_55 = "Valor"; 
$multilang_PHPSYSINFO_56 = "Min"; 
/*			-- to be read as... '[abbreviation for] Minimum' */
$multilang_PHPSYSINFO_57 = "Max";
/*			-- to be read as... '[abbreviation for] Maximum' */
$multilang_PHPSYSINFO_58 = "Histeresis"; 
$multilang_PHPSYSINFO_59 = "Limite"; 
$multilang_PHPSYSINFO_60 = "Etiqueta"; 
$multilang_PHPSYSINFO_61 = "C"; 
/*			-- to be read as... '[abbreviation for] Celsius' */
$multilang_PHPSYSINFO_62 = "F";
/*			-- to be read as... '[abbreviation for] Farenheit' */
$multilang_PHPSYSINFO_63 = "V";
/*			-- to be read as... '[abbreviation for] Voltage' */
$multilang_PHPSYSINFO_64 = "RPM";
/*			-- to be read as... '[abbreviation for] Rotations per Minute' */
$multilang_PHPSYSINFO_65 = "Nucleo y Aplicaciones";
$multilang_PHPSYSINFO_66 = "Buferes"; 
$multilang_PHPSYSINFO_67 = "Antememoria";
$multilang_PHPSYSINFO_68 = "grad";
/*			-- to be read as... '[abbreviation for] degrees' */

/* MODOPENOPC PLUGINS */
/* ------------------------------------------------------------------ */
$multilang_MODOPENOPC_SUCCESS = "ACIERTO"; 
$multilang_MODOPENOPC_FAILURE = "FALLA"; 
$multilang_MODOPENOPC_OPERATION_TYPE = "TIPO DE OPERACION"; 
$multilang_MODOPENOPC_DAEMON_FILE_CREATION = "... caso de creacion de archivos a traves de S.E.E.R. construido en la integracion."; 
$multilang_MODOPENOPC_READ_DAEMON_FUNCTION_PRESET = "Todas las funciones READ_DAEMON estan basadas en PREAJUSTES."; 
$multilang_MODOPENOPC_DATESTAMP = $multilang_STATIC_DATESTAMP_CAPS; 
$multilang_MODOPENOPC_CURRENT_DATESTAMP = "La fecha actual del sistema y el tiempo es"; 
$multilang_MODOPENOPC_ACTION_DATA = "DATOS DE ACCION"; 
/*			-- to be read as... 'ACTION DATA' or 'RESULTS OF ACTION' */
$multilang_MODOPENOPC_SEER_AUTO_GENERATED = "Este informe de accion ha sido generado automaticamente por S.E.E.R"; 
$multilang_MODOPENOPC_DEBUG = "DEPURACION DE DATOS"; 
$multilang_MODOPENOPC_ERROR = "ERROR"; 
$multilang_MODOPENOPC_BAD_INPUT = "MALA FORMA DE ENTRADA DE DATOS"; 
$multilang_MODOPENOPC_BAD_INPUT_REASON = "Esto es tipicamente causado por una incorrecta- referencia formada de pagina web. Por favor, cierre su navegador, navegue nuevamente en la pagina que estaba, y repita la misma operacion de nuevo. Si usted recibe este error mas de una vez, entonces deberia tomar las medidas siguientes:"; 
$multilang_MODOPENOPC_BAD_INPUT_REASON_1 = "Escribir la direccion de la pagina en la que estaba."; 
$multilang_MODOPENOPC_BAD_INPUT_REASON_2 = "Imprimir esta pagina para que usted tenga un registro de los datos a continuacion."; 
$multilang_MODOPENOPC_BAD_INPUT_REASON_3 = "Contacte a su ADMINISTRADOR DE SISTEMA con esta informacion."; 
$multilang_MODOPENOPC_BAD_INPUT_REASON_4 = "NO continue intentando forzar esta operacion nuevamente."; 
$multilang_MODOPENOPC_WRITE_DAEMON_FUNCTION_PRESET = "Escriba el tipo de utilizacion de esta funcion que deberia PREAJUSTARSE"; 
$multilang_MODOPENOPC_WRITE_DAEMON_FUNCTION_PRESET = "Escriba el tipo de utilizacion de esta funcion que deberia ser declarada."; 


/* MODEL LANGUAGE ENTRIES */
/* ------------------------------------------------------------------ */

/*	-- TANKMODEL */
/* 	------------ */

/*	-- -- NEW VARIABLES */
/*	------------------- */
$multilang_TANKMODEL_0 = "MODELO TANQUE";
$multilang_TANKMODEL_1 = "Monitor principal"; 
$multilang_TANKMODEL_2 = "Mezclador de Unidad de Monitores";
$multilang_TANKMODEL_3 = "Manual de Entrada de Registros";
$multilang_TANKMODEL_4 = "Registro de Certificacion";
$multilang_TANKMODEL_5 = "Mezclador de Reduccion";
$multilang_TANKMODEL_6 = "Cuadro de Temperatura";
$multilang_TANKMODEL_7 = "Nivel Grafico";
$multilang_TANKMODEL_8 = "Inventario de Productos";
$multilang_TANKMODEL_9 = "Ocupacion Tanque";
$multilang_TANKMODEL_10 = "Historia de Alarma";
$multilang_TANKMODEL_11 = "Actividad de Gantt";
$multilang_TANKMODEL_12 = "VERSION TANQUE DESDE ASISTENTE DE BLOQUEO";
$multilang_TANKMODEL_13 = "IDENTIFICACION DE TANQUE";
$multilang_TANKMODEL_14 = "VERSION?";
/*			-- to be read as... '[shall we] Release [this tank]?' */
$multilang_TANKMODEL_15 = "Tanque o Silo";
$multilang_TANKMODEL_16 = "Control de Bloqueo";
/*			-- to be read as... '[system] Lockdown Control' */
$multilang_TANKMODEL_17 = "MODIFICACION DE PARAMETROS DE TANQUE";
$multilang_TANKMODEL_18 = "NUEVO VALOR";
$multilang_TANKMODEL_19 = "Densidad";
$multilang_TANKMODEL_20 = "Producto";
$multilang_TANKMODEL_21 = "Mezclador en Nivel";
/* 			-- to be read as... 'Agitator [to turn] ON [at product] Level [in percent]' */
$multilang_TANKMODEL_22 = "Nivel";
/*			-- to be read as... 'Level [in tank]' */
$multilang_TANKMODEL_23 = "Mezclador FUERA de Nivel";
/*			-- to be read as... 'Agitator [to turn] OFF [at product] Level [in percent]' */
$multilang_TANKMODEL_24 = "Grupo enTanque";
$multilang_TANKMODEL_25 = "Modo Mezclador";
$multilang_TANKMODEL_26 = "Programar Mezclador";
/*			-- to be read as... 'Agitator Preset [or ReLIMPIAe]' */
$multilang_TANKMODEL_27 = "Programar Grupo";
/*			-- to be read as... 'Group Preset [or ReLIMPIAe]' */
$multilang_TANKMODEL_28 = "Velocidad del Mezclador";
$multilang_TANKMODEL_29 = "MODIFICAR TANUE o PARAMETROS DE SILO";
$multilang_TANKMODEL_30 = "INFORME DE PROGRAMA MEZCLADOR";
$multilang_TANKMODEL_31 = "MEZCLADOR de grupo ID";
$multilang_TANKMODEL_33 = "Nombre del Programa";
$multilang_TANKMODEL_34 = "Alta Velocidad";
$multilang_TANKMODEL_35 = "Baja Velocidad";
$multilang_TANKMODEL_37 = "VELOCIDAD SIMPLE";
$multilang_TANKMODEL_40 = "Tanque";
$multilang_TANKMODEL_42 = "Limpiar Desde HRS";
/*			-- to be read as... 'HRS [Hours] Since [Tank was] Clean[ed]' */
$multilang_TANKMODEL_43 = "Fuente";
$multilang_TANKMODEL_44 = "Destino";
$multilang_TANKMODEL_45 = "Volumen";
$multilang_TANKMODEL_46 = "Masa";
$multilang_TANKMODEL_47 = "LLENAR";
/*			-- to be read as... 'FILL [or LEVEL in percent]' */
$multilang_TANKMODEL_48 = "TEMP.";
/*			-- to be read as... 'TEMP [abbreviation for TEMPERATURE in degrees] */
$multilang_TANKMODEL_51 = "fabricante de VFD y modelo";
/*			-- to be read as... '[Variable Frequency] Drive Manufacturer and Model [Number]' */
$multilang_TANKMODEL_52 = "La unidad de orden interna http, de estado de pantalla se abrira en una ventana separada. Cuando desee volver a S.E.E.R, simplemente cierre la nueva ventana creada.";
$multilang_TANKMODEL_53 = "Seleccione la unidad mezcladora de tanque, de frecuencia variable debajo";
$multilang_TANKMODEL_54 = "Este sub-modelo no tiene control de mezclador habilitado Esto es generalmente debido a que los mezcladores incluidos en el modelo, no pueden tener control de velocidad dinamica. Por lo tanto, esta pantalla no se puede mostrar...";
$multilang_TANKMODEL_65 = "ESTADO TANQUE";
$multilang_TANKMODEL_70 = "Seleccione su tanque o silo en el menu desplegable, a continuacion, escriba TIEMPO de INICIO para entradas manuales. Cada entrada posterior de MARCA DE FECHA automaticamente se incrementara en el intervalo requerido..";
$multilang_TANKMODEL_75 = "variable que falta - 'NOMBRE TANQUE";
$multilang_TANKMODEL_78 = "Maquina";
$multilang_TANKMODEL_88 = "Seleccione su tanque, del menu desplegable, y luego entrar al rango de tiempo INICIO y FINAL. Cualquier registro que esta disponible para CERTIFICACION se mostrara a usted..";
$multilang_TANKMODEL_92 = "Estado";
$multilang_TANKMODEL_93 = "Mezclador nivel de ABRIR / CERRAR";
$multilang_TANKMODEL_95 = "Estado";
$multilang_TANKMODEL_96 = "LIMPIAR EN HRS";
/*			-- to be read as... 'HRS [Hours] SINCE [Tank was] CLEAN[ED]' */
$multilang_TANKMODEL_97 = "Temperatura";
$multilang_TANKMODEL_105 = "TANQUE";
$multilang_TANKMODEL_107 = "PRODUCTO";
$multilang_TANKMODEL_108 = "OCUPACIONES DISCRETAS";
$multilang_TANKMODEL_109 = "MASA";
$multilang_TANKMODEL_110 = "VOLUMEN";
$multilang_TANKMODEL_116 = "cualquier producto que muestra un Tanque 'vacio', o tiene un nivel de inventario positivo especificado en 'vacio', se ha de considerar <B><I> Desconocido </I> </B>. El tipo de producto es introducido manualmente por los operadores de maquinas en todo el dia, el producto que presente un Tanque 'vacio' suele deberse a un error del operador (no cambiar el tipo de producto en el tank despues del inicio de un relleno de tank).";
$multilang_TANKMODEL_117 = "Distribucion por producto";
$multilang_TANKMODEL_118 = "PORCENTAJE de INVENTARIO TOTAL";
$multilang_TANKMODEL_119 = "ALMACENADO EN TANK";
$multilang_TANKMODEL_120 = "TOTAL DE MASAS";
$multilang_TANKMODEL_121 = "VOLUMEN TOTAL";
$multilang_TANKMODEL_122 = "Distribucion de Tanque";
$multilang_TANKMODEL_123 = "Porcentaje de Inventario de Productos";
$multilang_TANKMODEL_124 = "Contencion de Falla";
$multilang_TANKMODEL_125 = "solo los registros que indican un nivel de producto por encima del nivel mínimo apreciable se muestran. Apreciable nivel mínimo es de";
$multilang_TANKMODEL_126 = "determinacion de la falta de contencion se basa en la temperatura del producto fuera del rango aceptable, que se define como";
$multilang_TANKMODEL_127 = "solo las fallas de contencion que abarca mayor que el umbral de error mínimo se muestran. El umbral de error es blanca";
$multilang_TANKMODEL_128 = "Base de Datos de Descarga";
$multilang_TANKMODEL_129 = "Volcado de la base de datos se ha completado. Usted puede acceder a la descarga mediante la opcion Exportar y Guardar Button, arriba.";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
$multilang_TANKMODEL_32 = $multilang_SETTINGS_DATA_FRESH_AS_OF;
$multilang_TANKMODEL_36 = $multilang_STATIC_NO_DATA_AVAILABLE;
$multilang_TANKMODEL_38 = $multilang_STATIC_CURRENT_TIME;
$multilang_TANKMODEL_39 = $multilang_TANKMODEL_32;
$multilang_TANKMODEL_41 = $multilang_STATIC_ALARMS;
$multilang_TANKMODEL_49 = $multilang_STATIC_ERROR_CALL_ADMIN;
$multilang_TANKMODEL_50 = $multilang_STATIC_DISPLAY;
$multilang_TANKMODEL_55 = $multilang_TANKMODEL_2;
$multilang_TANKMODEL_56 = $multilang_TANKMODEL_3;
$multilang_TANKMODEL_66 = $multilang_STATIC_DATA_TICKET;
$multilang_TANKMODEL_67 = $multilang_STATIC_SAVE_DATA_TICKET_TO_SERVER;
$multilang_TANKMODEL_68 = $multilang_STATIC_ACTION_IS_PERMANENT;
$multilang_TANKMODEL_69 = $multilang_STATIC_MAN_RECORDS_INPUT_EVERY;
$multilang_TANKMODEL_57 = $multilang_STATIC_RECORD_MANUALLY_ADDED;
$multilang_TANKMODEL_58 = $multilang_STATIC_CONFIRMATION_OF_TICKET;
$multilang_TANKMODEL_59 = $multilang_STATIC_AUTO_CERT_BY;
$multilang_TANKMODEL_60 = $multilang_STATIC_CERT_STAMP;
$multilang_TANKMODEL_61 = $multilang_STATIC_CERT_COMMENT;
$multilang_TANKMODEL_62 = $multilang_STATIC_INPUT_MORE_RECORDS;
$multilang_TANKMODEL_63 = $multilang_STATIC_CERT_INSPECT_LIST;
$multilang_TANKMODEL_64 = $multilang_STATIC_DATESTAMP_CAPS;
$multilang_TANKMODEL_66 = $multilang_STATIC_DATA_TICKET;
$multilang_TANKMODEL_67 = $multilang_STATIC_SAVE_DATA_TICKET_TO_SERVER;
$multilang_TANKMODEL_68 = $multilang_STATIC_ACTION_IS_PERMANENT;
$multilang_TANKMODEL_69 = $multilang_STATIC_MAN_RECORDS_INPUT_EVERY;
$multilang_TANKMODEL_71 = $multilang_STATIC_MAN_RECORDS_COUNT;
$multilang_TANKMODEL_72 = $multilang_STATIC_ENTRIES_CAPS;
$multilang_TANKMODEL_73 = $multilang_STATIC_BUILD_DATA_TICKET;
$multilang_TANKMODEL_74 = $multilang_TANKMODEL_4;
$multilang_TANKMODEL_76 = $multilang_STATIC_CERTIFICATION_TICKET;
$multilang_TANKMODEL_77 = $multilang_STATIC_NUMBER_OF_RECORDS;
$multilang_TANKMODEL_79 = $multilang_STATIC_SERVER;
$multilang_TANKMODEL_80 = $multilang_STATIC_DB_TABLE;
$multilang_TANKMODEL_81 = $multilang_STATIC_DATE_RANGE;
$multilang_TANKMODEL_82 = $multilang_STATIC_YOUR_USERNAME;
$multilang_TANKMODEL_83 = $multilang_STATIC_RERUN_REPORT;
$multilang_TANKMODEL_84 = $multilang_STATIC_NEXT_ITEM_ID;
$multilang_TANKMODEL_85 = $multilang_STATIC_REVIEW_CERT;
$multilang_TANKMODEL_86 = $multilang_STATIC_CERT_HIGHLIGHT_RED_GREEN;
$multilang_TANKMODEL_87 = $multilang_STATIC_CERT_TIME_LIMIT;
$multilang_TANKMODEL_89 = $multilang_STATIC_DISPLAY_RECORDS_FOR_CERT;
$multilang_TANKMODEL_90 = $multilang_STATIC_TICKET_COMMENT_ENTRY;
$multilang_TANKMODEL_91 = $multilang_TANKMODEL_5;
$multilang_TANKMODEL_94 = $multilang_STATIC_SELECT_FROM_DROPDOWN_MODEST_REPORT;
$multilang_TANKMODEL_98 = $multilang_STATIC_DETAIL_RUNDOWN_INDIVIDUAL;
$multilang_TANKMODEL_99 = $multilang_STATIC_DETAIL_RUNDOWN_ALL;
$multilang_TANKMODEL_100 = $multilang_STATIC_PARETO_FREQUENCY_ALL;
$multilang_TANKMODEL_101 = $multilang_STATIC_PARETO_DURATION_ALL;
$multilang_TANKMODEL_102 = $multilang_STATIC_PARETO_EXPLAIN;
$multilang_TANKMODEL_103 = $multilang_STATIC_SORTING_STATUS_EXPLAIN;
$multilang_TANKMODEL_104 = $multilang_STATIC_NO_FAULTS_IN_SNAPSHOT;
$multilang_TANKMODEL_106 = $multilang_STATIC_SELECT_ENTER_START_AND_SNAPSHOT;
$multilang_TANKMODEL_111 = $multilang_STATIC_CURRENT_OR_HISTORICAL_INVENTORY;
$multilang_TANKMODEL_112 = $multilang_STATIC_INVENTORY_TYPE;
$multilang_TANKMODEL_113 = $multilang_STATIC_CURRENT_BLIP;
$multilang_TANKMODEL_114 = $multilang_STATIC_HISTORICAL_BLIP;
$multilang_TANKMODEl_115 = $multilang_STATIC_DATA_WITHIN_15;
/*			-- do not edit this block unless modifying program */

/*	-- SPFMODEL */
/* 	----------- */

/*	-- -- NEW VARIABLES */
/*	---------------------- */
$multilang_SPFMODEL_0 = "MODELO SPF";
/*		-	-- where SPF stands for 'SEPARATION, PASTEURIZATION, and FILTRATION'*/
$multilang_SPFMODEL_1 = "Monitor principal";
$multilang_SPFMODEL_2 = "Configuracion de Maquina";
$multilang_SPFMODEL_3 = "Manual de Entrada de Registros";
$multilang_SPFMODEL_4 = "Registro de Certificacion";
$multilang_SPFMODEL_5 = "Resumen de Produccion";
$multilang_SPFMODEL_6 = "Consumo de Energia";
$multilang_SPFMODEL_7 = "Drenaje de Turbidez Grafico";
$multilang_SPFMODEL_8 = "Analisis de Produccion";
/* $multilang_SPFMODEL_9 -- DELETED */
$multilang_SPFMODEL_10 = "Uso de Agua LIMPIA";
$multilang_SPFMODEL_11 = "Grafico de Temperatura LIMPIA";
$multilang_SPFMODEL_12 = "Grafico de rendimiento completo LIMPIA";
$multilang_SPFMODEL_13 = "Historial de Alarma";
$multilang_SPFMODEL_14 = "Actividad de Gantt";
$multilang_SPFMODEL_15 = "Maquina_ID";
/*			-- to be read as... 'Machine_[Identification - abbreviation]' */
$multilang_SPFMODEL_16 = "Tipo";
$multilang_SPFMODEL_18 = "Limpieza en HRS";
$multilang_SPFMODEL_19 = "Auto-limpieza de la Maquina";
$multilang_SPFMODEL_20 = "Paso del LIMPIA";
$multilang_SPFMODEL_21 = "Tipo de agua"; 
$multilang_SPFMODEL_22 = "Uso de Agua";
$multilang_SPFMODEL_23 = "TEMP.";
$multilang_SPFMODEL_24 = "FLUJO";
$multilang_SPFMODEL_25 = "LIMPIA a traves de otra fuente";
$multilang_SPFMODEL_26 = "Esta maquina se limpia por otra maquina, o por un sistema de lavado LIMPIA. Por favor, consulte la siguiente fuente de informacion sobre el estado de limpieza de la maquina o historial ...";
$multilang_SPFMODEL_27 = "Fuente";
$multilang_SPFMODEL_28 = "Destino_1";
$multilang_SPFMODEL_29 = "Destino_2";
$multilang_SPFMODEL_30 = "Fuente FLUJO";
$multilang_SPFMODEL_31 = "Dest_1 FLUJO";
$multilang_SPFMODEL_32 = "Dest_2 FLUJO";
$multilang_SPFMODEL_33 = "Tarifa de Energia";
$multilang_SPFMODEL_34 = "Turbidez de Drenaje";
$multilang_SPFMODEL_35 = "Alarma de Confirmacion de Turbidez";
$multilang_SPFMODEL_36 = "Velocidad Tazon";
$multilang_SPFMODEL_37 = "Entrada de Temperatura.";
$multilang_SPFMODEL_38 = "Entrada TEMP.";
$multilang_SPFMODEL_39 = "PRESION Bruta";
$multilang_SPFMODEL_40 = "Pasteurizar PRESION";
$multilang_SPFMODEL_41 = "Linea de Base PRES";
/*			-- to be read as '[abbreviation for] Baseline PRESS[URE]' */
$multilang_SPFMODEL_42 = "Posicion de Valvula de Concentracion";
$multilang_SPFMODEL_43 = "Coeficiente de Concentracion";
$multilang_SPFMODEL_44 = "MANUAL DE RETENCION y CONTROLES DE CONFIGURACION";
$multilang_SPFMODEL_45 = "Manual de Accion";
$multilang_SPFMODEL_46 = "Maquina";
$multilang_SPFMODEL_57 = "Seleccione el equipo en el menu desplegable, a continuacion, escriba TIEMPO de inicio de entradas manuales y MARCA DE FECHA .Cada a posteriori automaticamente se incrementara en el intervalo requerido..";
$multilang_SPFMODEL_58 = "Identificacion de Maquina";
$multilang_SPFMODEL_62 = "para Pasteurizadores";
$multilang_SPFMODEL_63 = "para todas las otras maquinas ";
$multilang_SPFMODEL_65 = "La Maquina que ha seleccionado no requiere registros certificados. Por lo tanto, el Manual de Registro de Entrada se ha deshabilitado para esta maquina..";
$multilang_SPFMODEL_67 = "LIMPIA_STEP";
$multilang_SPFMODEL_68 = "LIMPIA_TEMP";
$multilang_SPFMODEL_69 = "Estado";
$multilang_SPFMODEL_77 = "variable que falta - ' NOMBRE SPF";
$multilang_SPFMODEL_93 = "presion diferencial";
$multilang_SPFMODEL_95 = "Seleccione su maquina (sin importar el tipo) del menu desplegable, y luego entrar en el rango de tiempo INICIO y FINAL. Cualquier registro que esta disponible para CERTIFICACION se mostrara a usted..";
$multilang_SPFMODEL_109 = "TURBIDEZ";
$multilang_SPFMODEL_111 = "falta variable - 'DISPLAY_UNDER_ALARM_CONDITION_ONLY'";
$multilang_SPFMODEL_112 = "seleccione la opcion SI o NO para 'los datos registrados durante las alarmas del sistema solamente'... seleccionar SI recortara el informe por lo que las lecturas de turbidez, se muestran solo cuando una maquina de eventos de alarma se ha producido. Esto podria ser cualquier tipo de alarma, no se limita a la turbidez de alarmas (las alarmas se identifican por su nombre para desambiguacion).";
$multilang_SPFMODEL_113 = "La Maquina de haber seleccionado NO tiene instalado un sensor de turbidez Por lo tanto, este informe no se puede generar. Si usted cree que esto es un error, pongase en contacto con el administrador del sistema, y pida que revisen el - archivo Localoptions - para este modelo.";
$multilang_SPFMODEL_114 = "PASO";
$multilang_SPFMODEL_115 = "TOTALES para esta instancia de lavado";
$multilang_SPFMODEL_117 = "Alarmas y fallos (si procede)";
$multilang_SPFMODEL_118 = "Total de uso de agua";
$multilang_SPFMODEL_120 = "El Uso es degradado por una combinacion unica de AUTO-SISTEMA DE LIMPIEZA e INSTANCIA  de LAVADO (en orden) cada tipo de agua se muestra y se suma para cada instancia. Entonces cada tipo de agua se suma para cada SISTEMA.";
$multilang_SPFMODEL_121 = "Resumen Global - El consumo de agua total de Maquina y Tipo";
$multilang_SPFMODEL_122 = "Resumen en Detalle - MAQUINA individual, instancias AGUA TIPO, secuencial";
$multilang_SPFMODEL_123 = "TODOS_SISTEMAS_LIMPIEZA_UNO_MISMO";
$multilang_SPFMODEL_124 = "Ninguna de las maquinas en esta particular instancia de modelo se auto-limpia. Todas las maquinas se limpian por si o por sistemas de limpieza. Por lo tanto, un informe no generara forma en este punto. Por favor, consulte la tabla siguiente para obtener mas informacion ...";
$multilang_SPFMODEL_125 = "... es limpiado por ...";
$multilang_SPFMODEL_126 = "LINEA"; 
$multilang_SPFMODEL_127 = "TOTALES para esta maquina";
$multilang_SPFMODEL_128 = "Resumen Global  - En general uso de ENERGIA por MAQUINA";
$multilang_SPFMODEL_129 = "Resumen en Detalle - MAQUINA Individual e instancias de ESTADO, secuencial";
$multilang_SPFMODEL_130 = "el uso es degradado por combinaciones unicas de la maquina y ESTADO (en secuencia) Luego ENERGIA se suma para cada SISTEMA..";
$multilang_SPFMODEL_131 = "USO DE ENERGIA";
$multilang_SPFMODEL_132 = "TODOS_SISTEMAS_PROPULSION";
$multilang_SPFMODEL_133 = "Detalle de Pareto - Uso de maquina Individual de ENERGIA.";
$multilang_SPFMODEL_134 = "Diagrama de Pareto - El uso de energia [Esta maquina]";
$multilang_SPFMODEL_135 = "Pareto Global - En general CONSUMO DE ENERGIA POR ESTADO";
$multilang_SPFMODEL_136 = "Porcentaje de Uso del total de energia [Todas las maquinas]";
/*			- to be read as '[machine A] ... is cleaned by ... [machine b]' */
$multilang_SPFMODEL_137 = "TOTALES para este ciclo de produccion"; 
$multilang_SPFMODEL_138 = "ALARMAS para este ciclo de produccion";
$multilang_SPFMODEL_139 = "Felicitaciones - No hay alarmas presentes.";
$multilang_SPFMODEL_140 = "Fuente FLUJO TOTAL";
$multilang_SPFMODEL_141 = "Dest_1 FLUJO TOTAL";
$multilang_SPFMODEL_142 = "Dest_2 FLUJO TOTAL";
$multilang_SPFMODEL_143 = "Fuente DELTA";
$multilang_SPFMODEL_144 = "Dest_1 DELTA";
$multilang_SPFMODEL_145 = "Dest_2 DELTA";
$multilang_SPFMODEL_146 = "Flujo de Materiales";
$multilang_SPFMODEL_147 = "Eficiencia";
$multilang_SPFMODEL_148 = "Utilidad";
/*			-- to be read as '[building] Utility [such as steam or power]' */
$multilang_SPFMODEL_149 = "Presion Diferencial";
$multilang_SPFMODEL_150 = "Resumen de Error Matematico";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
$multilang_SPFMODEL_17 = $multilang_STATIC_ALARMS;
$multilang_SPFMODEL_47 = $multilang_STATIC_HOLD;
$multilang_SPFMODEL_48 = $multilang_STATIC_STEP;
$multilang_SPFMODEL_49 = $multilang_STATIC_LOCKOUT_CAPS;
$multilang_SPFMODEL_50 = $multilang_STATIC_DISABLES_MANUAL_FUNCTIONS;
$multilang_SPFMODEL_51 = $multilang_STATIC_FORCE_HOLD;
$multilang_SPFMODEL_52 = $multilang_STATIC_RELEASE_HOLD;
$multilang_SPFMODEL_53 = $multilang_STATIC_FORCE_STEP;
$multilang_SPFMODEL_54 = $multilang_STATIC_LOCKOUT;
$multilang_SPFMODEL_55 = $multilang_STATIC_RELEASE;
$multilang_SPFMODEL_56 = $multilang_STATIC_MAN_RECORDS_INPUT_EVERY;
$multilang_SPFMODEL_59 = $multilang_STATIC_MAN_RECORDS_COUNT;
$multilang_SPFMODEL_60 = $multilang_STATIC_ENTRIES_CAPS;
$multilang_SPFMODEL_61 = $multilang_STATIC_BUILD_DATA_TICKET;
$multilang_SPFMODEL_64 = $multilang_STATIC_DATA_TICKET;
$multilang_SPFMODEL_66 = $multilang_STATIC_DATESTAMP_CAPS;
$multilang_SPFMODEL_70 = $multilang_STATIC_RECORD_MANUALLY_ADDED;
$multilang_SPFMODEL_71 = $multilang_STATIC_CONFIRMATION_OF_TICKET;
$multilang_SPFMODEL_72 = $multilang_STATIC_AUTO_CERT_BY;
$multilang_SPFMODEL_73 = $multilang_STATIC_CERT_STAMP;
$multilang_SPFMODEL_74 = $multilang_STATIC_CERT_COMMENT;
$multilang_SPFMODEL_75 = $multilang_STATIC_INPUT_MORE_RECORDS;
$multilang_SPFMODEL_76 = $multilang_STATIC_CERT_INSPECT_LIST;
$multilang_SPFMODEL_78 = $multilang_STATIC_CERTIFICATION_TICKET;
$multilang_SPFMODEL_79 = $multilang_STATIC_NUMBER_OF_RECORDS;
$multilang_SPFMODEL_80 = $multilang_SPFMODEL_46;
$multilang_SPFMODEL_81 = $multilang_STATIC_SERVER;
$multilang_SPFMODEL_82 = $multilang_STATIC_DB_TABLE;
$multilang_SPFMODEL_83 = $multilang_STATIC_DATE_RANGE;
$multilang_SPFMODEL_84 = $multilang_STATIC_YOUR_USERNAME;
$multilang_SPFMODEL_85 = $multilang_STATIC_CURRENT_TIME;
$multilang_SPFMODEL_86 = $multilang_STATIC_RERUN_REPORT;
$multilang_SPFMODEL_87 = $multilang_STATIC_NEXT_ITEM_ID;
$multilang_SPFMODEL_88 = $multilang_STATIC_SAVE_DATA_TICKET_TO_SERVER;
$multilang_SPFMODEL_89 = $multilang_STATIC_ACTION_IS_PERMANENT;
$multilang_SPFMODEL_90 = $multilang_STATIC_TICKET_COMMENT_ENTRY;
$multilang_SPFMODEL_91 = $multilang_STATIC_REVIEW_CERT;
$multilang_SPFMODEL_92 = $multilang_STATIC_CERT_HIGHLIGHT_RED_GREEN;
$multilang_SPFMODEL_94 = $multilang_STATIC_CERT_TIME_LIMIT;
$multilang_SPFMODEL_96 = $multilang_STATIC_SELECT_ENTER_START_AND_SNAPSHOT;
$multilang_SPFMODEL_97 = $multilang_STATIC_FAULTS_CAPS;
$multilang_SPFMODEL_98 = $multilang_STATIC_DATESTAMP_START;
$multilang_SPFMODEL_99 = $multilang_STATIC_DATESTAMP_END;
$multilang_SPFMODEL_100 = $multilang_STATIC_DURATION_CAPS;
$multilang_SPFMODEL_101 = $multilang_STATIC_DURATION_IN_SECONDS;
$multilang_SPFMODEL_102 = $multilang_STATIC_NO_FAULTS_IN_SNAPSHOT;
$multilang_SPFMODEL_103 = $multilang_STATIC_PARETO_EXPLAIN;
$multilang_SPFMODEL_104 = $multilang_STATIC_SORTING_STATUS_EXPLAIN;
$multilang_SPFMODEL_105 = $multilang_STATIC_PARETO_DURATION_ALL;
$multilang_SPFMODEL_106 = $multilang_STATIC_PARETO_FREQUENCY_ALL;
$multilang_SPFMODEL_107 = $multilang_STATIC_DETAIL_RUNDOWN_ALL;
$multilang_SPFMODEL_108 = $multilang_STATIC_DETAIL_RUNDOWN_INDIVIDUAL;
$multilang_SPFMODEL_110 = $multilang_STATIC_SELECT_FROM_DROPDOWN_MODEST_REPORT;
$multilang_SPFMODEL_116 = $multilang_STATIC_DURATION;
$multilang_SPFMODEL_119 = $multilang_STATIC_YorN_AUTOSCALE_REPORT_NOTICE;
/*			-- do not edit this block unless modifying program */

/*	-- CIPMODEL */
/* 	----------- */

/*	-- -- NEW VARIABLES */
/*	------------------- */
$multilang_CIPMODEL_0 = "MODELO LIMPIA";
$multilang_CIPMODEL_1 = "Monitor principal";
$multilang_CIPMODEL_2 = "Manual de Entrada de Registros";
$multilang_CIPMODEL_3 = "Registro de Certificacion";
$multilang_CIPMODEL_4 = "Uso de agua";
$multilang_CIPMODEL_5 = "Cuadro de Temperatura";
$multilang_CIPMODEL_6 = "Grafico de Rendimiento Completo";
/*			-- read as 'Full Report' or 'Full System Analysis' */
$multilang_CIPMODEL_7 = "Historial de Alarma";
$multilang_CIPMODEL_8 = "Actividad de Gantt";
$multilang_CIPMODEL_18 = "LINEA";
$multilang_CIPMODEL_23 = "Seleccione el sistema LIMPIA en el menu desplegable, a continuacion, escriba tiempo de INICIO de entradas manuales. Cada entrada posterior de MARCA DE FECHA automaticamente se incrementara en el intervalo requerido..";
$multilang_CIPMODEL_25 = "PASO";
$multilang_CIPMODEL_26 = "VOLVER TEMP";
/*			-- to be read as... 'RETURN TEMP[erature]' */
$multilang_CIPMODEL_29 = "Sistema de Identificacion";
$multilang_CIPMODEL_33 = "Seleccione el sistema LIMPIA desde el menu desplegable, y luego entrar al rango de tiempo INICIO y FINAL . Cualquier registro que esta disponibles para CERTIFICACION se mostrara a usted..";
$multilang_CIPMODEL_36 = "Sistema";
$multilang_CIPMODEL_37 = "TIPO DE AGUA";
$multilang_CIPMODEL_38 = "variable que falta - 'NOMBRE LIMPIA'";
$multilang_CIPMODEL_51 = "MANUAL DE MANTENIMIENTO y AVANCE DE CONTROLES";
$multilang_CIPMODEL_52 = "Manual de Accion";
$multilang_CIPMODEL_59 = "La linea esta siendo limpiada"; 
$multilang_CIPMODEL_60 = "SUMINISTRO DE TEMP";
/*			-- to be read as... 'SUPPLY TEMP[erature]' */
$multilang_CIPMODEL_61 = "SUMINISTRO DE FLUJO";
$multilang_CIPMODEL_62 = "VOLVER CONDUCTIVIDAD";
$multilang_CIPMODEL_63 = "estado de funcionamiento";
$multilang_CIPMODEL_64 = "USO DE AGUA";
$multilang_CIPMODEL_68 = "SISTEMA";
$multilang_CIPMODEL_72 = "INICIO DE AGUA";
$multilang_CIPMODEL_73 = "FIN DE AGUA";
$multilang_CIPMODEL_74 = "AGUA USADA";
$multilang_CIPMODEL_75 = "TOTALES para esta instancia de lavado";
$multilang_CIPMODEL_76 = "ALL_LIMPIA_SYSTEMS";
$multilang_CIPMODEL_77 = "el uso es degradado por una combinacion unica del SISTEMA DE AGUA TIPO LIMPIA, Y el CIRCUITO DE LINEA. Entonces cada tipo de agua se suma para cada SISTEMA..";
$multilang_CIPMODEL_78 = "Resumen Global - Uso de Agua Total por Sistema y Tipo";
$multilang_CIPMODEL_79 = "Resumen en Detalle - SISTEMA individual , LINE e instancias AGUA TIPO";
$multilang_CIPMODEL_87 = "Alarmas y Fallas (si procede)";
$multilang_CIPMODEL_88 = "Total de Uso de agua";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
$multilang_CIPMODEL_9 = $multilang_CIPMODEL_2;
$multilang_CIPMODEL_10 = $multilang_STATIC_RECORD_MANUALLY_ADDED;
$multilang_CIPMODEL_11 = $multilang_STATIC_CONFIRMATION_OF_TICKET;
$multilang_CIPMODEL_12 = $multilang_STATIC_AUTO_CERT_BY;
$multilang_CIPMODEL_13 = $multilang_STATIC_CERT_STAMP;
$multilang_CIPMODEL_14 = $multilang_STATIC_CERT_COMMENT;
$multilang_CIPMODEL_15 = $multilang_STATIC_INPUT_MORE_RECORDS;
$multilang_CIPMODEL_16 = $multilang_STATIC_CERT_INSPECT_LIST;
$multilang_CIPMODEL_17 = $multilang_STATIC_DATESTAMP_CAPS;
$multilang_CIPMODEL_19 = $multilang_STATIC_DATA_TICKET;
$multilang_CIPMODEL_20 = $multilang_STATIC_SAVE_DATA_TICKET_TO_SERVER;
$multilang_CIPMODEL_21 = $multilang_STATIC_ACTION_IS_PERMANENT;
$multilang_CIPMODEL_22 = $multilang_STATIC_MAN_RECORDS_INPUT_EVERY;
$multilang_CIPMODEL_24 = $multilang_STATIC_MAN_RECORDS_COUNT;
$multilang_CIPMODEL_27 = $multilang_STATIC_ENTRIES_CAPS;
$multilang_CIPMODEL_28 = $multilang_STATIC_BUILD_DATA_TICKET;
$multilang_CIPMODEL_30 = $multilang_STATIC_REVIEW_CERT;
$multilang_CIPMODEL_31 = $multilang_STATIC_CERT_HIGHLIGHT_RED_GREEN;
$multilang_CIPMODEL_32 = $multilang_STATIC_CERT_TIME_LIMIT;
$multilang_CIPMODEL_34 = $multilang_STATIC_DISPLAY_RECORDS_FOR_CERT;
$multilang_CIPMODEL_35 = $multilang_STATIC_TICKET_COMMENT_ENTRY;
$multilang_CIPMODEL_39 = $multilang_STATIC_RERUN_REPORT;
$multilang_CIPMODEL_40 = $multilang_STATIC_NEXT_ITEM_ID;
$multilang_CIPMODEL_41 = $multilang_STATIC_CERTIFICATION_TICKET;
$multilang_CIPMODEL_42 = $multilang_STATIC_NUMBER_OF_RECORDS;
$multilang_CIPMODEL_43 = $multilang_CIPMODEL_36;
$multilang_CIPMODEL_44 = $multilang_STATIC_SERVER;
$multilang_CIPMODEL_45 = $multilang_STATIC_DB_TABLE;
$multilang_CIPMODEL_46 = $multilang_STATIC_DATE_RANGE;
$multilang_CIPMODEL_47 = $multilang_STATIC_YOUR_USERNAME;
$multilang_CIPMODEL_48 = $multilang_STATIC_CURRENT_TIME;
$multilang_CIPMODEL_49 = $multilang_CIPMODEL_3;
$multilang_CIPMODEL_50 = $multilang_CIPMODEL_1;
$multilang_CIPMODEL_53 = $multilang_STATIC_HOLD;
$multilang_CIPMODEL_54 = $multilang_STATIC_STEP;
$multilang_CIPMODEL_55 = $multilang_STATIC_LOCKOUT_CAPS;
$multilang_CIPMODEL_56 = $multilang_STATIC_DISABLES_MANUAL_FUNCTIONS;
$multilang_CIPMODEL_57 = $multilang_SETTINGS_DATA_FRESH_AS_OF;
$multilang_CIPMODEL_58 = $multilang_STATIC_FAULTS_CAPS;
$multilang_CIPMODEL_65 = $multilang_STATIC_NO_DATA_AVAILABLE;
$multilang_CIPMODEL_66 = $multilang_STATIC_ERROR_CALL_ADMIN;
$multilang_CIPMODEL_67 = $multilang_CIPMODEL_4;
$multilang_CIPMODEL_69 = $multilang_STATIC_DATESTAMP_START;
$multilang_CIPMODEL_70 = $multilang_STATIC_DATESTAMP_END;
$multilang_CIPMODEL_71 = $multilang_STATIC_DURATION_CAPS;
$multilang_CIPMODEL_80 = $multilang_STATIC_SELECT_ENTER_START_AND_SNAPSHOT;
$multilang_CIPMODEL_81 = $multilang_STATIC_SELECT_FROM_DROPDOWN_MODEST_REPORT;
$multilang_CIPMODEL_82 = $multilang_STATIC_CERT_NO_COMMENTS;
$multilang_CIPMODEL_83 = $multilang_STATIC_CERT_SIGNATURE_HEADER;
$multilang_CIPMODEL_84 = $multilang_STATIC_CERT_NO_SIGS;
$multilang_CIPMODEL_85 = $multilang_STATIC_YorN_AUTOSCALE_REPORT_NOTICE;
$multilang_CIPMODEL_86 = $multilang_STATIC_DURATION;
$multilang_CIPMODEL_89 = $multilang_STATIC_DETAIL_RUNDOWN_INDIVIDUAL;
$multilang_CIPMODEL_90 = $multilang_STATIC_DETAIL_RUNDOWN_ALL;
$multilang_CIPMODEL_91 = $multilang_STATIC_PARETO_FREQUENCY_ALL;
$multilang_CIPMODEL_92 = $multilang_STATIC_PARETO_DURATION_ALL;
$multilang_CIPMODEL_93 = $multilang_STATIC_PARETO_EXPLAIN;
$multilang_CIPMODEL_94 = $multilang_STATIC_SORTING_STATUS_EXPLAIN;
$multilang_CIPMODEL_95 = $multilang_STATIC_NO_FAULTS_IN_SNAPSHOT;
$multilang_CIPMODEL_96 = $multilang_STATIC_DURATION_IN_SECONDS;
$multilang_CIPMODEL_100 = $multilang_STATIC_FORCE_HOLD;
$multilang_CIPMODEL_102 = $multilang_STATIC_RELEASE_HOLD;
$multilang_CIPMODEL_103 = $multilang_STATIC_FORCE_STEP;
$multilang_CIPMODEL_104 = $multilang_STATIC_LOCKOUT;
$multilang_CIPMODEL_105 = $multilang_STATIC_RELEASE;

/*	-- BULKMODEL */
/* 	------------ */

/*	-- -- NEW VARIABLES */
/*	---------------------- */
$multilang_BULKMODEL_0 = "MODELO A GRANEL";
$multilang_BULKMODEL_1 = "Monitor principal";
$multilang_BULKMODEL_2 = "Tiendas de Inventario";
$multilang_BULKMODEL_3 = "Resumen de Elementos de Tiendas";
$multilang_BULKMODEL_4 = "Resumen de Inventario";
$multilang_BULKMODEL_9 = "Volumen";
/*			-- to be read as... 'Volume [measure of quantity, typically liquid or mass]'*/
$multilang_BULKMODEL_10 = "Stock de Porcentaje";;
/*			-- to be read as... 'Percent Stock [of Capacity]' */
$multilang_BULKMODEL_12 = "Inventario Historico instantaneo";
$multilang_BULKMODEL_14 = "INVENTARIO DE PORCENTAJE";
$multilang_BULKMODEL_15 = "INVENTARIO DE CANTIDAD";
$multilang_BULKMODEL_23 = "Tiempo Instantaneo";
$multilang_BULKMODEL_25 = "Inventario";
$multilang_BULKMODEL_29 = "variable que falta - ' NOMBRE A GRANEL";
$multilang_BULKMODEL_30 = "Historial de articulo unico";
$multilang_BULKMODEL_31 = "Uso del Elemento";
$multilang_BULKMODEL_33 = "Cantidad Usada";
$multilang_BULKMODEL_34 = "este elemento usado utiliza informes de 'logica difusa' para dar cuenta de reposicion de existencias de inventario (que no se registra) y se utilizan normalmente censores de material a granel (en general una discrepancia 2-5 por ciento en precision). En consecuencia, este informe debe tener una precision del 5 por ciento, pero puede variar. Se pretende utilizar como no es una «estimacion», propicia para facturacion o ventas comerciales. Si usted sospecha una discrepancia razonable, entonces, utilizar INFORME-1 (RESUMEN DE ELEMENTO) para ver las reales lecturas de los censores durante el periodo de tiempo solicitado.";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
$multilang_BULKMODEL_5 = $multilang_STATIC_NO_DATA_AVAILABLE;
$multilang_BULKMODEL_6 = $multilang_STATIC_CURRENT_TIME;
$multilang_BULKMODEL_7 = $multilang_SETTINGS_DATA_FRESH_AS_OF;
$multilang_BULKMODEL_8 = $multilang_STATIC_ITEM_LOWER;
$multilang_BULKMODEL_11 = $multilang_STATIC_ERROR_CALL_ADMIN;
$multilang_BULKMODEL_16 = $multilang_STATIC_DATESTAMP_CAPS;
$multilang_BULKMODEL_17 = $multilang_STATIC_REPORT_TICKET_FOR;
$multilang_BULKMODEL_13 = $multilang_STATIC_ITEM;
$multilang_BULKMODEL_18 = $multilang_STATIC_DATA_WITHIN_15;
$multilang_BULKMODEL_19 = $multilang_STATIC_CURRENT_OR_HISTORICAL_INVENTORY;
$multilang_BULKMODEL_20 = $multilang_STATIC_INVENTORY_TYPE;
$multilang_BULKMODEL_21 = $multilang_STATIC_CURRENT_BLIP;
$multilang_BULKMODEL_22 = $multilang_STATIC_HISTORICAL_BLIP;
$multilang_BULKMODEL_24 = $multilang_STATIC_SELECT_FROM_DROPDOWN_MODEST_REPORT;
$multilang_BULKMODEL_26 = $multilang_STATIC_DATESTAMP;
$multilang_BULKMODEL_27 = $multilang_STATIC_NEXT_ITEM_ID;
$multilang_BULKMODEL_28 = $multilang_STATIC_RERUN_REPORT;
$multilang_BULKMODEL_32 = $multilang_STATIC_SELECT_FROM_DROPDOWN;
/*			-- do not edit this block unless modifying program */

/*	-- ATMOSPHERICMODEL */
/* 	------------------- */

/*	-- -- NEW VARIABLES */
/*	------------------- */
$multilang_ATMOSPHERICMODEL_0 = "MODELO ATMOSFERICO";
$multilang_ATMOSPHERICMODEL_1 = "Monitor principal";
$multilang_ATMOSPHERICMODEL_2 = "Medio Ambiente y Resumen Grafico";
$multilang_ATMOSPHERICMODEL_3 = "variable que falta - 'NOMBRE DE ZONA'";
$multilang_ATMOSPHERICMODEL_4 = "Zona";
$multilang_ATMOSPHERICMODEL_5 = "Temperatura";
$multilang_ATMOSPHERICMODEL_6 = "Humedad";
$multilang_ATMOSPHERICMODEL_7 = "Presion";
$multilang_ATMOSPHERICMODEL_8 = "TEMPERATURA MEDIA";
$multilang_ATMOSPHERICMODEL_9 = "HUMEDAD PROMEDIO";
$multilang_ATMOSPHERICMODEL_10 = "PRESION MEDIA";
$multilang_ATMOSPHERICMODEL_11 = "REGISTROS EXAMINADOS";
$multilang_ATMOSPHERICMODEL_12 = "TEMPERATURA ACTUAL";
$multilang_ATMOSPHERICMODEL_13 = "HUMEDAD ACTUAL";
$multilang_ATMOSPHERICMODEL_14 = "PRESION ACTUAL";
$multilang_ATMOSPHERICMODEL_16 = "min.";
/*		-- to be read as "[abbreviation for] minutes" */

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
$multilang_ATMOSPHERICMODEL_15 = $multilang_STATIC_EXAMINATION_WINDOW;
/*			-- do not edit this block unless modifying program */

/*	-- CHECKWEIGHERMODEL */
/* 	-------------------- */

/*	-- -- NEW VARIABLES */
/*	------------------- */
$multilang_CHECKWEIGHERMODEL_0 = "MODELO CONTROLADORA DE PESO";
$multilang_CHECKWEIGHERMODEL_1 = "modificar RECETA";
$multilang_CHECKWEIGHERMODEL_2 = "receta para MODIFICAR";
$multilang_CHECKWEIGHERMODEL_3 = "eliminar RECETA";
$multilang_CHECKWEIGHERMODEL_4 = "receta para QUITAR";
$multilang_CHECKWEIGHERMODEL_5 = "anadir RECETA y parametros";
$multilang_CHECKWEIGHERMODEL_6 = "receta";
$multilang_CHECKWEIGHERMODEL_7 = "Todos los campos variables de RECETA deben ser llenados completamente antes de una receta pueda anadirse. Por favor revisar el formulario, completarlo y enviarlo..";
$multilang_CHECKWEIGHERMODEL_8 = "restringido a los administradores y super usuarios.";
$multilang_CHECKWEIGHERMODEL_9 = "Configuracion: anadir receta";
$multilang_CHECKWEIGHERMODEL_10 = "NOMBRE RECETA";
$multilang_CHECKWEIGHERMODEL_11 = "un nombre unico para la receta";
$multilang_CHECKWEIGHERMODEL_12 = "OBJETIVO";
$multilang_CHECKWEIGHERMODEL_13 = "masa deseada"; 
$multilang_CHECKWEIGHERMODEL_14 = "DELTA Min";
$multilang_CHECKWEIGHERMODEL_15 = "rechazo a esta cantidad por DEBAJO DEL OBJETIVO";
$multilang_CHECKWEIGHERMODEL_16 = "DELTA MAX";
$multilang_CHECKWEIGHERMODEL_17 = "rechazo a esta cantidad por ENCIMA DEL OBJETIVO";
$multilang_CHECKWEIGHERMODEL_18 = "Confirmar Anadir RECETA";
$multilang_CHECKWEIGHERMODEL_19 = "Esta receta se ha anadido correctamente a la base de datos.";
$multilang_CHECKWEIGHERMODEL_20 = "Si desea anadir otra receta, haga clic aqui ...";
$multilang_CHECKWEIGHERMODEL_21 = "eliminar RECETA";
$multilang_CHECKWEIGHERMODEL_22 = "La receta ha sido eliminada, como usted pidio. Usted deberia haber sido redirigido automaticamente a la pagina de configuracion de S.E.E.R ya ... si no, ir hasta alli con el menu, en la parte superior de la pagina..";
$multilang_CHECKWEIGHERMODEL_23 = "Configuracion: modificar RECETA";
$multilang_CHECKWEIGHERMODEL_24 = "Confirmar modificacion de RECETA";
$multilang_CHECKWEIGHERMODEL_25 = "FECHA CREADA";
$multilang_CHECKWEIGHERMODEL_26 = "CREADA POR";
$multilang_CHECKWEIGHERMODEL_27 = "FECHA ACTUALIZADA";
$multilang_CHECKWEIGHERMODEL_28 = "ACTUALIZADA POR";
$multilang_CHECKWEIGHERMODEL_29 = "RELLENAR TABLA SIFON";
$multilang_CHECKWEIGHERMODEL_30 = "rellenar tabla SIFON";
$multilang_CHECKWEIGHERMODEL_31 = "La salida deberia incluir una entrada para cada maquina en la lista, en cada uno de sus archivos localoptions.";
$multilang_CHECKWEIGHERMODEL_32 = "Departamento Monitor";
$multilang_CHECKWEIGHERMODEL_33 = "Analisis de Ejecucion y Sintesis";
$multilang_CHECKWEIGHERMODEL_34 = "TARA";
$multilang_CHECKWEIGHERMODEL_35 = "masa de no productos";
$multilang_CHECKWEIGHERMODEL_36 = "Control  de Receta";
$multilang_CHECKWEIGHERMODEL_37 = "La Controladora de Peso que esta buscando no existe en el sifon de la maquina de la base de datos. Consulte con el administrador del sistema, y asegurese que el o ella ha de ejecutar el comando 'Rellenar Tabla SIFON' de la pestana 'Configuracion de S.E.E.R.'";
$multilang_CHECKWEIGHERMODEL_38 = "La controladora de Peso esta programada fuera de servicio o no esta en uso en la actualidad.";
$multilang_CHECKWEIGHERMODEL_39 = "La controladora de peso esta en servicio, no obstante no se ha registrado ninguno peso de elementos durante el tiempo de copia instantaneo (historial reciente). Normalmente, esto indica que la linea de produccion esta fuera de servicio por alguna razon. Sin embargo, si se esta ejecutando, entonces esto indica que la comunicacion de la controladora de peso con sifon esta caida y debe ser corregida (pongase en contacto con un administrador del sistema).";
$multilang_CHECKWEIGHERMODEL_40 = "NO EXISTE!";
$multilang_CHECKWEIGHERMODEL_41 = "Inactivo / Fuera de servicio";
$multilang_CHECKWEIGHERMODEL_42 = "Inactivo / En servicio, pero sin Actividad";
$multilang_CHECKWEIGHERMODEL_43 = "Ventana de tiempo Historial Reciente";
$multilang_CHECKWEIGHERMODEL_44 = "Minimo";
$multilang_CHECKWEIGHERMODEL_45 = "Maximo";
$multilang_CHECKWEIGHERMODEL_46 = "Cantidad";
$multilang_CHECKWEIGHERMODEL_47 = "Masa Total";
$multilang_CHECKWEIGHERMODEL_48 = "Masa Promedio";
$multilang_CHECKWEIGHERMODEL_49 = "Tarifa de Escala";
$multilang_CHECKWEIGHERMODEL_50 = "min.";
/*			-- to be read as abbreviation for 'minute' */
$multilang_CHECKWEIGHERMODEL_51 = "Aceptado";
$multilang_CHECKWEIGHERMODEL_52 = "Rechazado";
$multilang_CHECKWEIGHERMODEL_53 = "La controladora de peso esta programada fuera de servicio o no esta en uso en la actualidad -. Sin embargo, la controladora de peso esta reportando  datos al sistema de grabacion. Esto suele ocurrir cuando la linea esta actualmente en funcionamiento, pero el operador no ha querido entrar en la Receta de la controladora de peso actual en S.E.E.R. Se recomienda inspeccionar la controladora de peso en persona y determinar si este es el caso.";
$multilang_CHECKWEIGHERMODEL_54 = "receta para EMPUJAR la controladora de peso / actualizar RECETA EN MARCHA";
$multilang_CHECKWEIGHERMODEL_55 = "Ultimas 10 Muestras";
$multilang_CHECKWEIGHERMODEL_56 = "Salida de Peso Individual";
$multilang_CHECKWEIGHERMODEL_57 = "Escala a examinar";
$multilang_CHECKWEIGHERMODEL_58 = "Controladora de Peso";
$multilang_CHECKWEIGHERMODEL_59 = "ESCALA A EXAMINAR no fue seleccionada. Usted debe seleccionar la controladora de peso que desea examinar antes que pueda generar un informe.Por favor volver al menu anterior, y rellenar el formulario por completo...";
$multilang_CHECKWEIGHERMODEL_60 = "MASA BRUTA";
$multilang_CHECKWEIGHERMODEL_61 = "MASA NETA";
$multilang_CHECKWEIGHERMODEL_62 = "RESULTADO";
$multilang_CHECKWEIGHERMODEL_63 = "CONTROLADORA DE PESO";
$multilang_CHECKWEIGHERMODEL_64 = "usted puede elegir ver solo una muestra de los registros devueltos (grandes o pequenos), distribuidos uniformemente a lo largo del tiempo, o bien, puede optar por ver todos y cada registro. Tenga en cuenta, que ver todos los registros es un voluminoso informe., y si selecciona mas de una hora o si (dependiendo de la cantidad de productos por minuto, que su escala puede ejecutar), puede bloquear el navegador. El metodo recomendado es ver un 'muestreo', y luego volver y ver ' todos los registros 'solo para periodos de tiempo que se mostraron interesados en el' muestreo.";
$multilang_CHECKWEIGHERMODEL_65 = "Metodo de Informe";
$multilang_CHECKWEIGHERMODEL_66 = "Muestra Periodica Pequeno";
$multilang_CHECKWEIGHERMODEL_67 = "Examinar todos los registros";
$multilang_CHECKWEIGHERMODEL_68 = "El METODO DEINFORME no se ha seleccionado. Usted debe seleccionar el metodo de informe que desea utilizar, antes que pueda generarse un informe. Por favor volver al menu anterior, y rellenar el formulario por completo...";
$multilang_CHECKWEIGHERMODEL_69 = "Muestra Periodica Grande";
$multilang_CHECKWEIGHERMODEL_70 = "Tasa";
$multilang_CHECKWEIGHERMODEL_71 = "Desviacion Estandar";
$multilang_CHECKWEIGHERMODEL_72 = "DIAGRAMA DE DISTRIBUCION NORMAL";
$multilang_CHECKWEIGHERMODEL_73 = "RECHAZO DE LA UNIDAD REGISTRADA DURANTE ESTE CASO DE RECETA";
$multilang_CHECKWEIGHERMODEL_74 = "DAR, o QUITAR";
$multilang_CHECKWEIGHERMODEL_75 = "Dar";
$multilang_CHECKWEIGHERMODEL_76 = "Quitar";
$multilang_CHECKWEIGHERMODEL_77 = "Produccion Aceptada Esperada";
$multilang_CHECKWEIGHERMODEL_78 = "Produccion Aceptada Real";
$multilang_CHECKWEIGHERMODEL_79 = "Diferencia";
$multilang_CHECKWEIGHERMODEL_80 = "Mostrar Articulos Rechazados";
$multilang_CHECKWEIGHERMODEL_81 = "MODO";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
/*	-- none as of yet */
/*			-- do not edit this block unless modifying program */

/*	-- WARRIOR */
/*	---------- */

/*	-- -- NEW VARIABLES */
/*	------------------- */
$multilang_WARRIOR_0 = "WARRIOR"; 
$multilang_WARRIOR_1 = "anadir TRABAJO y descripcion"; 
$multilang_WARRIOR_2 = "modificar TRABAJO"; 
$multilang_WARRIOR_3 = "Configuracion: anadir TRABAJO"; 
$multilang_WARRIOR_4 = "NUMERO DE TRABAJO"; 
$multilang_WARRIOR_5 = "un unico numero de recurso";  
$multilang_WARRIOR_6 = "DESCRIPCION DE TRABAJO"; 
$multilang_WARRIOR_7 = "una descripcion de trabajo"; 
$multilang_WARRIOR_8 = "Confirmar Anadir TRABAJO"; 
$multilang_WARRIOR_9 = "El NUMERO DE TRABAJO deseado ya existe Si desea agregar un nuevo registro, primero debe eliminar el TRABAJO existente!."; 
$multilang_WARRIOR_10 = "TODOS los campos variables TRABAJO debe ser llenados completamente antes que un trabajo puede ser agregado. Por favor revisar el formulario, completarlo y enviarlo.."; 
$multilang_WARRIOR_11 = "restringido a los administradores, SUPER USUARIOS, y gerentes."; 
$multilang_WARRIOR_12 = "Este trabajo se ha anadido correctamente a la base de datos."; 
$multilang_WARRIOR_13 = "Si desea agregar otro trabajo, haga clic aqui ..."; 
$multilang_WARRIOR_14 = "Configuracion: modificar TRABAJO"; 
$multilang_WARRIOR_15 = "Confirmar Modificacion TRABAJO";  
$multilang_WARRIOR_16 = "eliminar TRABAJO";  
$multilang_WARRIOR_17 = "El trabajo ha sido eliminado, como usted pidio. Usted deberia haber sido redirigido automaticamente a la pagina de configuracion de S.E.E.R ya ... si no, ir hasta alli con el menu, en la parte superior de la pagina.."; 
$multilang_WARRIOR_18 = "Numero de trabajo para MODIFICAR"; 
$multilang_WARRIOR_19 = "Numero de trabajo para QUITAR"; 
$multilang_WARRIOR_20 = "O.E.E."; 
$multilang_WARRIOR_21 = "Monitor principal y control"; 
$multilang_WARRIOR_22 = "SELECCIONAR MAQUINA"; 
$multilang_WARRIOR_23 = "Iniciar consola"; 
$multilang_WARRIOR_24 = "Identificacion de maquina"; 
$multilang_WARRIOR_25 = "Seleccione el equipo del menu desplegable, y lanzar la Consola Viva."; 
$multilang_WARRIOR_26 = "Operaciones"; 
$multilang_WARRIOR_27 = "SELECCIONAR"; 
$multilang_WARRIOR_28 = "ACCION CORRECTIVA"; 
$multilang_WARRIOR_29 = "Actualizar"; 
$multilang_WARRIOR_30 = "OPERADOR o COMERCIANTE"; 
$multilang_WARRIOR_31 = "Abandonar Maquina"; 
$multilang_WARRIOR_32 = "Asumir Control de Maquina"; 
$multilang_WARRIOR_33 = "MODO o MANTENIMIENTO"; 
$multilang_WARRIOR_34 = "Introduzca Modo de Mantenimiento"; 
$multilang_WARRIOR_35 = "Lanzamiento a la Produccion"; 
$multilang_WARRIOR_36 = "NUMERO DE PROGRAMA"; 
$multilang_WARRIOR_37 = "El operador debe asumir el control de una maquina antes que pueda modificar el ACCION_CORRECTIVA, PROGRAMA_NUMERO, NUMERO_DE_TRABAJO, o similar, comerciantes calificados deben asumir el control de una maquina antes que puedan ponerlo en MAINTENANCE_MODE (o RELEASE_TO_PRODUCTION).."; 
$multilang_WARRIOR_38 = "Estado de maquina"; 
$multilang_WARRIOR_39 = "Estado no se puede determinar en este momento debido a falta de datos suficientes. Si usted cree que se trata de un error, por favor comuniquese con un administrador del sistema para asistencia.."; 
$multilang_WARRIOR_40 = "DATOS NUEVOS A PARTIR DE"; 
$multilang_WARRIOR_41 = "OPERADOR ACTUAL"; 
$multilang_WARRIOR_44 = "ESTADO DE  MAQUINA"; 
$multilang_WARRIOR_45 = "ESTADO DE ALARMA"; 
$multilang_WARRIOR_47 = "CLASE DE PAQUETE"; 
$multilang_WARRIOR_48 = "PAQUETE POR CICLO"; 
$multilang_WARRIOR_49 = "CICLOS [este trabajo y programa]"; 
$multilang_WARRIOR_50 = "UNIDADES"; 
$multilang_WARRIOR_51 = "MASA"; 
$multilang_WARRIOR_52 = "Resumen de Produccion Recientes"; 
$multilang_WARRIOR_53 = "min."; 
/*			-- to be read as [abbreviation for] 'minutes' */
$multilang_WARRIOR_54 = "tiempo de TRABAJO"; 
$multilang_WARRIOR_55 = "tiempo de EJECUCION"; 
$multilang_WARRIOR_56 = "UNIDADES recientes"; 
$multilang_WARRIOR_57 = "NO PROGRAMADO"; 
$multilang_WARRIOR_58 = "tiempo INACTIVO"; 
$multilang_WARRIOR_59 = "hora"; 
$multilang_WARRIOR_60 = "RENDIMIENTO"; 
$multilang_WARRIOR_61 = "DISPONIBILIDAD"; 
$multilang_WARRIOR_62 = "O.E.E."; 
$multilang_WARRIOR_63 = "T.E.E.P."; 
$multilang_WARRIOR_64 = "CARGANDO"; 
$multilang_WARRIOR_65 = "EJECUTAR"; 
$multilang_WARRIOR_66 = "INACTIVO"; 
$multilang_WARRIOR_68 = "Departamento Monitor"; 
$multilang_WARRIOR_69 = "Linea"; 
/*			-- to be read as... [production]'line' */
$multilang_WARRIOR_70 = "VELOCIDAD DE LINEA EFECTIVA"; 
$multilang_WARRIOR_71 = "TASA DE LINEA DE OBJETIVO"; 
$multilang_WARRIOR_72 = "TOTALES, ESTE TRABAJO PROGRAMADO"; 
$multilang_WARRIOR_73 = "Rendimiento bruto"; 
$multilang_WARRIOR_74 = "escribe la fecha de INICIO y FINALIZACION. Usted puede optar por ver los datos de TODOS los cambios, un cambio en particular, o seleccionar una FORMA de tiempo (turno) rango. Si usted elige utilizar un cambio de FORMA, entonces usted debe seleccionar un HORA DE INICIO DE FORMA y HORA FIN DE FORMA, de lo contrario, puede dejar estos campos en blanco.";
$multilang_WARRIOR_75 = "CAMBIO"; 
$multilang_WARRIOR_76 = "FORMA"; 
$multilang_WARRIOR_77 = "TODO"; 
$multilang_WARRIOR_78 = "Horas INICIO de Forma"; 
$multilang_WARRIOR_79 = "Horas FIN de Forma"; 
$multilang_WARRIOR_80 = "Al seleccionar el cambio de 'FORMA' de trabajo, debe especificar un INICIO y hora FINAL como un intervalo de tiempo para examinar. Uno de ellos esta en blanco.."; 
$multilang_WARRIOR_81 = "Maquina"; 
$multilang_WARRIOR_82 = "Unidades TOTALES"; 
$multilang_WARRIOR_83 = "Masa TOTAL"; 
$multilang_WARRIOR_84 = "TOTALES SINERGISTICOS"; 
$multilang_WARRIOR_85 = "Departamento de Produccion General"; 
$multilang_WARRIOR_86 = "TOTALES DISCRETOS"; 
$multilang_WARRIOR_87 = "TRABAJO PROGRAMADO a instancia de maquina individual"; 
$multilang_WARRIOR_88 = "Fin de Ejecucion"; 
$multilang_WARRIOR_89 = "el INICIO y FIN de horas NO puede ser el mismo, esto resulta en un cambio de duracion de de horas cero."; 
$multilang_WARRIOR_90 = "este totalizador ha sido probado en un  0.15% de precision, los resultados se prometieron en un 0.25% de precision, esta desviacion es pequena debido al tiempo 'redondeo' hacia arriba o hacia abajo en los puntos de cambio."; 
$multilang_WARRIOR_91 = "Modo Mantenimiento de Historial"; 
$multilang_WARRIOR_92 = "INICIO Mantenimiento"; 
$multilang_WARRIOR_93 = "FINAL Mantenimiento"; 
$multilang_WARRIOR_94 = "Duracion"; 
$multilang_WARRIOR_95 = "Tipo de Mantenimiento"; 
$multilang_WARRIOR_96 = "Modo de mantenimiento a instancia de maquina individual"; 
$multilang_WARRIOR_97 = "Modo de mantenimiento a instancia de departamento de estadisticas general"; 
$multilang_WARRIOR_98 = "Desglose de Tiempo TOTAL"; 
$multilang_WARRIOR_99 = "Tiempo Programado TOTAL"; 
$multilang_WARRIOR_100 = "Tiempo de Mantenimiento TOTAL"; 
$multilang_WARRIOR_101 = "horas"; 
/*			-- to be read as [abbreviation for] 'hours' */
$multilang_WARRIOR_102 = "O.E.E, T.E.E.P, y analisis de Inactividad"; 
$multilang_WARRIOR_103 = "Desempeno del Departamento en General"; 
$multilang_WARRIOR_104 = "Periodo de Tiempo"; 
/*			-- to be read as 'length of time' or 'time period' */
$multilang_WARRIOR_105 = "Alarma Individual y e Instancias de Inactividad"; 
$multilang_WARRIOR_108 = "Detalle Bajo - RESUMEN SOLAMENTE"; 
$multilang_WARRIOR_109 = "Detalle Medio - Incidente de sucesos que dura mas de 10 minutos"; 
$multilang_WARRIOR_110 = "Detalle Alto - Incidente de sucesos que dura mas de 5 minutos"; 
$multilang_WARRIOR_111 = "Detalle Extremo - Incidente de sucesos para TODO (independientemente de la duracion)"; 
$multilang_WARRIOR_112 = "NIVEL DE DETALLE"; 
$multilang_WARRIOR_113 = "Tipo de Alarma"; 
$multilang_WARRIOR_114 = "Inactividad de la maquina como estaba programado"; 
$multilang_WARRIOR_115 = "Inactividad de la maquina para el almuerzo o descanso en otros trabajos"; 
$multilang_WARRIOR_116 = "Inactividad de la maquina debido a un fallo o averia"; 
$multilang_WARRIOR_117 = "maquina individual de PARETO o sucesos de INACTIVIDAD"; 
$multilang_WARRIOR_118 = "GRADO"; 
$multilang_WARRIOR_119 = "maquina individual de PARETO o sucesos NO PROGRAMADO"; 
$multilang_WARRIOR_120 = "ANALISIS HIBRIDO"; 
$multilang_WARRIOR_121 = "ANALISIS DISCRETO"; 
$multilang_WARRIOR_122 = "maquina individual de PARETO o sucesos NO PROGRAMADOS"; 
$multilang_WARRIOR_123 = "maquina individual de PARETO o sucesos CLASIFICADO NO PROGRAMADOS"; 
$multilang_WARRIOR_124 = "Clase ALARMA"; 
$multilang_WARRIOR_125 = "El nombre, 'Warrior', es una marca registrada / copyright of Ultimate Creations, Inc 1997 - 2010"; 
$multilang_WARRIOR_126 = "El nombre eponimo de la S.E.E.R. Todos los Equipos de Eficiencia General / Total de Equipo de modulo de Rendimiento Eficaz es una combinacion de varias cosas - un acronimo ([W] orkplace [A] uthenticated [R] esource [R] untime [I] nput y [O] utput [R] eporter), un comentario sobre las circunstancias que rodearon la creacion del modulo y lo que representa para el autor, asi como un homenaje al hombre (del mismo nombre) que trae el enfoque y la inspiracion para muchos."; 
$multilang_WARRIOR_127 = "estado de ordenacion para cada matriz asociada es indicado por 'verde' para aciertos o 'Roja' para fallas ... El acierto no es necesario para la identificacion precisa de evento y tiempo."; 
$multilang_WARRIOR_128 = "llenar tabla de PROGRAMA"; 
$multilang_WARRIOR_129 = "llenar tabla de PROGRAMA"; 
$multilang_WARRIOR_130 = "La salida debe incluir una entrada para cada maquina en la lista en cada uno de los archivos de opciones locales"; 
$multilang_WARRIOR_131 = "porcentaje de TIEMPO de INACTIVIDAD";
$multilang_WARRIOR_132 = "porcentaje del TIEMPO TOTAL";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
$multilang_WARRIOR_42 = $multilang_WARRIOR_36;
$multilang_WARRIOR_43 = $multilang_WARRIOR_4;
$multilang_WARRIOR_46 = $multilang_WARRIOR_28;
$multilang_WARRIOR_67 = $multilang_WARRIOR_57;
$multilang_WARRIOR_106 = $multilang_STATIC_START; 
$multilang_WARRIOR_107 = $multilang_STATIC_END; 
$multilang_WARRIOR_133 = $multilang_CHECKWEIGHERMODEL_12;
$multilang_WARRIOR_134 = $multilang_WARRIOR_60;
$multilang_WARRIOR_135 = $multilang_CHECKWEIGHERMODEL_81;
$multilang_WARRIOR_136 = $multilang_CIPMODEL_18;
/*			-- do not edit this block unless modifying program */

/*	-- WARRIOR FOR LABEL PLUGINS */
/*	---------------------------- */

/*	-- -- NEW VARIABLES */
/*	------------------- */
$multilang_WARRIOR_LABEL_1 = "IMPRESION";
$multilang_WARRIOR_LABEL_2 = "DETENIDO";
$multilang_WARRIOR_LABEL_3 = "SOLICITUD DE LAS ETIQUETAS DE NUEVO";
$multilang_WARRIOR_LABEL_4 = "CANCELAR LAS ETIQUETAS";
$multilang_WARRIOR_LABEL_5 = "LOTE";
$multilang_WARRIOR_LABEL_6 = "Situacion Actual";
$multilang_WARRIOR_LABEL_12 = "CODIGO de FECHA";
$multilang_WARRIOR_LABEL_13 = "Paletizacion Final del Estado de Ejecucion";
$multilang_WARRIOR_LABEL_14 = "FINALES de EJECUTAR";
$multilang_WARRIOR_LABEL_15 = "FINALES PENDIENTES de EJECUTAR";
$multilang_WARRIOR_LABEL_16 = "invalida numero de calendario";
$multilang_WARRIOR_LABEL_17 = "Errores o Mensajes";
$multilang_WARRIOR_LABEL_18 = "etiquetas cancelado";
$multilang_WARRIOR_LABEL_19 = "etiqueta con exito la peticion";
$multilang_WARRIOR_LABEL_20 = "datos no validos de entrada del usuario";
$multilang_WARRIOR_LABEL_21 = "MODIFAR LAS ETIQUETAS";
$multilang_WARRIOR_LABEL_22 = "etiqueta de actualizacion con exito";
$multilang_WARRIOR_LABEL_23 = "no para cambiar el numero de lote";
$multilang_WARRIOR_LABEL_24 = "FECHA DE PRODUCCION";
$multilang_WARRIOR_LABEL_25 = "error al iniciar el sistema de etiquetado";
$multilang_WARRIOR_LABEL_26 = "FUERZA DE CANCELAR";
$multilang_WARRIOR_LABEL_27 = "no para anular la accion del sistema de etiquetado";
$multilang_WARRIOR_LABEL_28 = "estado actual del sistema de etiquetado no se puede determinar, sin comentarios";
$multilang_WARRIOR_LABEL_29 = "el numero de error generado por el sistema de etiquetado";
$multilang_WARRIOR_LABEL_30 = "no comunicarse correctamente con el servidor de un sistema de etiquetado";
$multilang_WARRIOR_LABEL_31 = "FUERZA TODOS CANCELAR";
$multilang_WARRIOR_LABEL_32 = "accion pendiente en el progreso!";
$multilang_WARRIOR_LABEL_33 = "Las acciones de APlus plugins se ha autentificado. Esto incluye dos botones de comando de usuario y la extension de las acciones del sistema resultante. Debido a la serializacion de las acciones, que no es util para mostrar las fallas solamente. Por el contrario, usted debe seleccionar un rango de tiempo para ver, y todas las acciones se mostrara en ese rango de tiempo.";
$multilang_WARRIOR_LABEL_34 = "Accion de busqueda Historia";
$multilang_WARRIOR_LABEL_35 = "variable que falta - 'LINEA'";
$multilang_WARRIOR_LABEL_36 = "da reserva";
$multilang_WARRIOR_LABEL_37 = "un sistema de etiquetado no responder a la solicitud para confirmar el estado del sistema, comuníquese con el administrador";
$multilang_WARRIOR_LABEL_38 = "un sistema de etiquetado informa de un cambio de estado inesperado en tiempo de ejecucion, el etiquetado ha sido re-sincronizado";
$multilang_WARRIOR_LABEL_39 = "Paquete Contra el Destino";
$multilang_WARRIOR_LABEL_40 = "PILA MANO PESO del PALET";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
$multilang_WARRIOR_LABEL_7 = $multilang_TANKMODEL_95;
$multilang_WARRIOR_LABEL_8 = $multilang_WARRIOR_36;
$multilang_WARRIOR_LABEL_9 = $multilang_WARRIOR_4;
$multilang_WARRIOR_LABEL_10 = $multilang_WARRIOR_LABEL_5;
$multilang_WARRIOR_LABEL_11 = $multilang_CHECKWEIGHERMODEL_81;
/*			-- do not edit this block unless modifying program */

/*	-- THIN CHART */
/* 	------------- */

/*	-- -- NEW VARIABLES */
/*	------------------- */
$multilang_THINCHART_0 = "TABLA DE DELGADO";
$multilang_THINCHART_4 = "Trazado Grafico";
$multilang_THINCHART_5 = "variable que falta - 'nombre del esquema'";
$multilang_THINCHART_8 = "Nombre del EVENTO";
$multilang_THINCHART_9 = "EVENTO";
$multilang_THINCHART_10 = "Seleccione el Sistema desde el menu desplegable, y luego entrar al rango de tiempo INICIO y FINAL . Cualquier registro que esta disponibles para CERTIFICACION se mostrara a usted..";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
$multilang_THINCHART_1 = $multilang_TANKMODEL_1;
$multilang_THINCHART_2 = $multilang_TANKMODEL_3;
$multilang_THINCHART_3 = $multilang_TANKMODEL_4;
$multilang_THINCHART_6 = $multilang_CIPMODEL_68;
$multilang_THINCHART_7 = $multilang_CIPMODEL_36;
$multilang_THINCHART_11 = $multilang_TANKMODEL_128;
$multilang_THINCHART_12 = $multilang_TANKMODEL_129;
$multilang_THINCHART_13 = $multilang_WARRIOR_77;
/*			-- do not edit this block unless modifying program */

/*	-- CANVAS */
/* 	--------- */

/*	-- -- NEW VARIABLES */
/*	------------------- */
$multilang_CANVAS_0 = "PopUP LIENZO";
$multilang_CANVAS_1 = "ERROR - contenido de este lienzo no ha sido declararse no.";
$multilang_CANVAS_2 = "Cerrar esta ventana o pestana de PopUP para volver a la sesion.";
$multilang_CANVAS_3 = "ERROR - el titulo no declarado";
$multilang_CANVAS_4 = "Escala PopUP para la Vista de Precision";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */

/*			-- do not edit this block unless modifying program */

/*	-- TTY PERFORMANCE MODEL */
/* 	------------------------ */

/*	-- -- NEW VARIABLES */
/*	------------------- */
$multilang_TTYPERFORMANCEMODEL_0 = "TTY RENDIMIENTO MODELO";
$multilang_TTYPERFORMANCEMODEL_2 = "Entrada Salida Individual";
$multilang_TTYPERFORMANCEMODEL_16 = "rendimiento del dispositivo individual";
$multilang_TTYPERFORMANCEMODEL_18 = "TODOS LOS DISPOSITIVOS INCLUIDOS";
$multilang_TTYPERFORMANCEMODEL_19 = "DISPOSITIVOS DE EXCLUIDOS";
$multilang_TTYPERFORMANCEMODEL_22 = "faltan variables - 'MAQUINA'";

/*	-- -- LINKED VARIABLES */
/*	---------------------- */
/*			-- do not edit this block unless modifying program */
$multilang_TTYPERFORMANCEMODEL_1 = $multilang_CHECKWEIGHERMODEL_33;
$multilang_TTYPERFORMANCEMODEL_3 = $multilang_CHECKWEIGHERMODEL_32;
$multilang_TTYPERFORMANCEMODEL_4 = $multilang_CHECKWEIGHERMODEL_42;
$multilang_TTYPERFORMANCEMODEL_5 = $multilang_FAULT_39;
$multilang_TTYPERFORMANCEMODEL_6 = $multilang_STATIC_123;
$multilang_TTYPERFORMANCEMODEL_7 = $multilang_STATIC_FAULTS_CAPS;
$multilang_TTYPERFORMANCEMODEL_8 = $multilang_WARRIOR_60;
$multilang_TTYPERFORMANCEMODEL_9 = $multilang_SPFMODEL_46;
$multilang_TTYPERFORMANCEMODEL_10 = $multilang_STATIC_SELECT_FROM_DROPDOWN_BRIEF;
$multilang_TTYPERFORMANCEMODEL_11 = $multilang_CHECKWEIGHERMODEL_67;
$multilang_TTYPERFORMANCEMODEL_12 = $multilang_STATIC_NO_DATA_AVAILABLE;
$multilang_TTYPERFORMANCEMODEL_13 = $multilang_SPFMODEL_15;
$multilang_TTYPERFORMANCEMODEL_14 = $multilang_STATIC_ENTRIES_CAPS;
$multilang_TTYPERFORMANCEMODEL_15 = $multilang_WARRIOR_86;
$multilang_TTYPERFORMANCEMODEL_17 = $multilang_WARRIOR_84;
$multilang_TTYPERFORMANCEMODEL_20 = $multilang_WARRIOR_103;
$multilang_TTYPERFORMANCEMODEL_21 = $multilang_STATIC_SELECT_FROM_DROPDOWN;
/*			-- do not edit this block unless modifying program */

?>

