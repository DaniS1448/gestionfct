# gestionfct

NECESITO
---------
	- [ ] Necesito excel ejemplo con los alumnos de otro sitio (Leticia de la lista de alumnos del centro)
	- [ ] DUDA | En el mismo anexo, pueden haber alumnos con diferentes horarios y diferentes fechas inicio y fin?
	- [ ] DUDA | Una empresa que tiene convenio con dos institutos, es el mismo convenio o uno con cada instituto?
	- [x] Modelo ANEXO que Leticia manda a las empresas
	- [x] DUDA | PrevisionPuestos vinculada con Empresa o con Sede
	- [x] BBDD/Modelo antiguo Guillermo
	- [x] DUDA | Cuando se hace la práctica en 2 empresas, son en el mismo anexo o es un anexo por cada práctica en cada empresa

PENDIENTE
-----------
- Calendarios de cada persona (fiestas por localidad) - Geolocalización en cada empresa
- ANEXO MADRID - PROGRAMA FORMATIO - CALENDARIO (fiestas localidad)
- <del>Provisional (hay alumnos que no aprueban) - Viabilidad (1. Todo aprobado | 2. Al menos un suspenso | 3. Más de un suspenso)</del>
- <del>¿Distribución? dieferntes simulaciones/borradores y uno final (real/hipotético)</del>
- Dashboard admin/auth acciones + estadísticas

MODELO 1 - UML Simplificado
-------
![Modelo1-uml-simplificado](https://github.com/DaniS1448/gestionfct/blob/master/gestionfct_simplificado.jpg)

MODELO 1 - UML Completo
-------
![Modelo1-uml-completo](https://github.com/DaniS1448/gestionfct/blob/master/gestionfct.jpg)

FUNCIONALIDADES (marcadas las posibles con el modelo 1 completo)
------------------
- [x] Alumnos asignados a cada empresa
- [x] Historial alumnos contratados por dicha empresa
- [x] Perfil de la empresa (Back, Front, Peluquería) si son expernos en JAVA, C#... ÁREAS DE ENFOQUE
- [x] Perfiles de interés por el alumno
- [x] Historial alumnos prácticas en SMR y en DAW y otras...
- [x] Empresa con convenio y sin convenio -> enviar gente por bolsa de empleo
- [x] Filtrar por familia -> informática -> geolocalización (verde - convenio | naranja - posibles empresas)
- [x] Infromes de las empresas
- [x] Informar cuántas plazas faltan por buscar, zona no lejana..
- [x] Valoración de la empresa (por alumnos) [trato, si contrata o no, flexibilidad...]
- [x] Asignación sugerida automática (empresa-alumno)
- [x] La empresa más adecuada para cada persona
- [x] Asignación inicial que pueda ir cambiando
- [x] Cambio de alumno de empresa en medio de la prácticas
- [x] Log estado de la conversacióin con la empresa (día 17 mandar o recibir un documento) - hitos prática estados
- [x] Meter los alumnos de golpe y la APP haga un reparto provisional y luego poder cambiar de sitio a los alumnos.
- [x] Referencia alumnos vayan junto a las prácticas (cercanía opcional para algunos)
- [x] Almacenar información partes semanales
- [x] Gestion información convenios (empresas) y anexos(alumnos)
- [ ] Calendario fiestas automáticas localidades madrid (configurar alumno tantos días empezando tal día)
- [ ] Trabajo con **posibles empresas** [enganchar a una feed de empresa (de convenios si es posible))
- [ ] Tutorial primeros pasos que indique cada función en parte en la página web


PRIMEROS PASOS APLICACIÓN
-----------------
	1. Meter lista alumnos
	2. Elegir que día empezar y cuántos días (horas)
	3. Mostrar sugerencia asignación automática alumnos en prácticas
	4. Poder bloquear algunas empresas, filtrar por calidad y familia -> área
	5. Poder ajustar fácilmente alumnos en empresas


SEXTA REUNIÓN (17 de junio de 2020)
-----------------
- [ ] Nombre grupo no pueda ser duplicado en el mismo curso académico (temporalmente con CSV)

QUINTA REUNIÓN (9 de junio de 2020)
-----------------
- [ ] Nombre grupo no pueda ser duplicado en el mismo curso académico
- [ ] Grupo duplicar solo los usuarios(profesores) sin alumnos
- [ ] Método transporte para calcular la distancia en coche/transporte público
- [ ] Google API guardado en la BBDD

CUARTA REUNIÓN (2 de junio de 2020)
-----------------
- [x] El usuario administre solo sus prácticas, al volver a hacer login vuelva a conectar con sus practicas
- [x] Que el usuario solo tenga acceso a los alumnos de los grupos a los que pertenece
- [ ] alumnos en el futuro pueden tener alumnos.dominio.es y tener su propia app para votar los aspectos de las empresas (solamente se añadiría un campo contraseña)

TERCERA REUNIÓN (26 de mayo de 2020)
-----------------
- [ ] CRUD | Añadir, borrar fiestas
- [ ] Mokcup
	- [ ] Add alumnos por inputs o archivo csv(excel)
	- [ ] Al añadir alumno que ya existe (avisar y decidir qué hacer con él)
	- [x] ASIGNACIÓN PASO 1 - Solo nombres
	- [x] ASIGNACIÓN PASO 2 - con fecha comienzo, horas/día y horas totales
	- [ ] ASIGNACIÓN PASO 3 - con horario laborable y tutor
	- [ ] ASIGNACIÓN PASO FINAL - Resúmen últil para alumno, días de fiestas, y horario laborable, etc...)
	- [ ] Historial empresas de años pasados (cuántos alumnos han tenido, cuántos han contratado)
- [x] Responsable -> TutorEmpresa y quitar entidad tipo
- [x] Add campos empresa (ResponsableConvenio, ResponsableRRHH (nombre, telefono, email))
- [x] Anexo puede tener modificaciones (diferentes archivos para subir) identificados por NumeroAnexo
	- Resúmen anexo
		- [ ] Nº del ANEXO
		- [ ] Empresa(sede):
		- [ ] Fehca inicio:
		- [ ] Fecha fin:
		- [ ] Días de la semana: Lunes,Martes,Miércoles,Jueves,Viernes
		- [ ] Horario (Por días con horario mañana (hora inicio y hora fin) + horario tarde (hora inicio y hora fin) = total horas
		- [ ] Listado Alumnos (Apellidos y Nombre + DNI)
		- [ ] Tutor centro de trabajo y tutor instituto (opcional)

SEGUNDA REUNIÓN (19 de mayo de 2020)
-----------------
- [x] Empresa -> sede (pueden ser varias)
- [x] Responsables en empresa (Resp. convenio, contacto - RRHH, tutor - puede ser por cada alumno)
- [x] Anexo (GrupoPracticas) => sede | anexo es un grupo de prácticas que van a una sede
- [x] practica => usuario (tutor profesor instituto)
- [x] practica => responsable (tutor)
- [x] Convenio/Anexo - add campo subir archivo(foto/pdf)
- [x] campo distancia_opcional debe ir en práctica
- [x] practica add convocatoria - ordinaria/extraordinaria (marzo/septiembre)
- [x] renombrar matricula a CursoAcademico
- [x] practica add campo horas/día
- [x] perfil renombrar tags (many to many)
- [x] ANEXO add campo numero


PRIMERA REUNIÓN (12 de mayo de 2020)
----------
- Familias profesionales en cada empresas
- El anexo se crea en la APP de la Comunidad de Madrid (el papeleo de firmar anexo)
- Direcciones de alumno y empresas para cálculo automático de la distancia
- Estados por los que pasa los ANEXOS y CONVENIOS (firmados en cada etapa)
- INFO CONVENIO (Nombre empresa, Dirección, CIF, Responsable empresa)
- Una empresa cada año quiere un número de alumnos (Previsión provisional)
- 370 horas de práctica (que sea abierto, horas por prática)
- Se manda el documento del convenio a la empresa, lo firman (puede ser digital) y pasa por estados
	1. Firmado por la directora
	2. Firmado por el responsable de la empresa
	3. Mandar a la DAT (Dirección de Áreas Territoriales de Educación de la Comunida de Madrid)
	4. Gefe DAT firma convenio y es válido, se manda de vuelta
- Los convenios no tienen caducidad (solo altas y bajas)
- Convenio (Insitituto - Empresa - DAT)
- Práctica - Realización de una estancia en un periodo en una empresa de un alumno. Si cambia en medio de la práctica sería otra práctica
- Para intranet centro (seguridad no crítica) / Poder acceder desde fuera
- Roles

###### EJEMPLO FAMILIA PROFESIONAL (Informática y comunicaciones)
![EjemploFamiliaProf](https://github.com/DaniS1448/gestionfct/blob/master/famili_profesional_informatica_y_comunicaciones.JPG)

###### EJEMPLO INSTITUTO (Rey Fernando VI)
![EjemploInstitutoo](https://github.com/DaniS1448/gestionfct/blob/master/instituto.PNG)

###### DEMO APLICACIONES (25 jun 2020)
Demo GestionFCT - APP: https://youtu.be/Zc3vDIzFK4s
Demo GestionFCT - Mockup: : https://youtu.be/9z__H6XsHgU

# [yuml!](https://yuml.me/)
https://github.com/DaniS1448/gestionfct/blob/master/gestionfct.txt
https://github.com/DaniS1448/gestionfct/blob/master/gestionfct_simplificado.txt
