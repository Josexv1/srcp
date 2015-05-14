# SRCP
Sistema de Registro y control de profesores en PHP MySQL y PDO

El sistema esta hecho en PHP MySQL. Utilizando PDO para realizar las conexiones a la base de datos.

# Cambios en version.
* Cambiado de usar SHA256 a SHA512
* Agregado Iteracion de 65536 para el hashing del password
* Agregado mcrypt_create_iv() como metodo para generar el salt.

# Listo
* Registro del docente
* Lista de docentes
* Perfil del docente (generico)
* Reporte de lista de profesores (Ver listar_profesor.php)

# TO-DO

* Cambiar metodo de encriptamiento de las password con nuevas funciones de php
* Mudar los errores desde "die" a un modal
* Modificar los mensajes de error para que el .$ex->getMessage() quede dentro del modal de error
* Agregar constancias
  * Constancias de profesores
  * Constancias de estudio (estudiantes) 
* Fotogragia y perfil profesional del profesor.
* Ausentismo. Control de entradas y salidas en salones o espacios restringidos mediante un lector de huella digital.
* Evaluación de docencia. Los estudiantes evalúan anónimamente a cada docente según los siguientes criterios personalizados.
* Asistente para la asignación de horarios escolares. Valida cruces, horas no asignadas y bloqueos.
* Informes, gráficos y estadísticas para la gestión docentes.
* Mejorar la percepcion de los datos en la programacion orientada a datos.
* Registro de matrícula estudiantil. Matrícula y promoción automática de alumnos al siguiente periodo lectivo según criterios.
* Ficha del alumno. Datos personales, fotografía, información familiar, enfermedades,  contraindicaciones, entre otros.
* Ausentismo. Control de entradas y salidas en salones o espacios restringidos mediante un lector de huella digital.
* Bitácora del alumno. Registro de incidencias y eventos del alumno en la Institución.
* Agrupamiento de alumnos por familias para facilitar la gestión de pagos y procedimientos académicos.
* Gestión de rutas de transporte escolar, programación de paradas y control de horarios.
* Informes, gráficos y estadísticas para la gestión de alumnos.