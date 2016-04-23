# SRCP
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/d1179279-7d9a-4960-a8e3-4a033b7aa5e6/big.png)](https://insight.sensiolabs.com/projects/d1179279-7d9a-4960-a8e3-4a033b7aa5e6)
[![Code Climate](https://codeclimate.com/github/Josexv1/srcp/badges/gpa.svg)](https://codeclimate.com/github/Josexv1/srcp)
[![Test Coverage](https://codeclimate.com/github/Josexv1/srcp/badges/coverage.svg)](https://codeclimate.com/github/Josexv1/srcp/coverage)
[![Issue Count](https://codeclimate.com/github/Josexv1/srcp/badges/issue_count.svg)](https://codeclimate.com/github/Josexv1/srcp)

Sistema de control de profesores. (Active Development.)

El sistema esta hecho en PHP MySQL. Utilizando PDO para realizar las conexiones a la base de datos.

# Cambios en version.
* Creado modulo de registro de profesor, con un wizard mejorado.
* Reconstruido el sistema a un sistema modular.
* Cambiado de usar SHA256 a SHA512
* Agregado Iteracion de 65536 para el hashing del password
* Agregado mcrypt_create_iv() como metodo para generar el salt.
* Agregando una entrada a la DB cuando el user esta logueado y cuando no. (con mensajes)
* Agregada una nueva capa de seguridad, que evita el secuestro de Cookies
* Agregado mensaje de error cuando se intenta loguear y el usuario ya esta logueado.

# Listo
* Modificado. Pronto se acomodara.

# TO-DO

* Actualizar el README.MD
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
