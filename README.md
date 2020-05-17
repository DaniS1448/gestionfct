# gestionfct

PRIMEROS PASOS APLICACIÓN
-----------------
	1. Meter lista alumnos
	2. Elegir que día empezar y cuántos días (horas)
	3. Mostrar sugerencia asignación automática alumnos en prácticas
	4. Poder bloquear algunas empresas, filtrar por calidad y familia -> área
	5. Poder ajustar fácilmente alumnos en empresas


NECESITO
---------
	- Modelo ANEXO que Leticia manda a las empresas
	- BBDD/Modelo antiguo Guillermo
	- DUDA | Cuando se hace la práctica en 2 empresas, son en el mismo anexo o es un anexo por cada práctica en cada empresa?


PENDIENTE
-----------
- Calendarios de cada persona (fiestas por localidad) - Geolocalización en cada empresa
- Provisional (hay alumnos que no aprueban) - Viabilidad (1. Todo aprobado | 2. Al menos un suspenso | 3. Más de un suspenso)
- Referencia alumnos vayan junto a las prácticas (cercanía opcional para algunos)
- Almacenar información partes semanales
- ANEXO MADRID - PROGRAMA FORMATIO - CALENDARIO (fiestas localidad)



MODELO 1
-------
![Modelo1](https://github.com/DaniS1448/gestionfct/blob/master/modelo1.png)


FUNCIONALIDADES
------------------
- Alumnos asignados a cada empresa
- Historial alumnos contratados por dicha empresa
- Infromes de las empresas
- Trabajo con **posibles empresas** [enganchar a una feed de empresa (de convenios si es posible))
- Informar cuántas plazas faltan por buscar, zona no lejana..
- Asignación sugerida automática (empresa-alumno)
- La empresa más adecuada para cada persona
- Asignación inicial que pueda ir cambiando
- Cambio de alumno de empresa en medio de la prácticas
- Calendario fiestas automáticas localidades madrid (configurar alumno tantos días empezando tal día)
- Log estado de la conversacióin con la empresa (día 17 mandar o recibir un documento) - hitos prática estados
- Valoración de la empresa (por alumnos) [trato, si contrata o no, flexibilidad...]
- Perfil de la empresa (Back, Front, Peluquería) si son expernos en JAVA, C#... ÁREAS DE ENFOQUE
- Meter los alumnos de golpe y la APP haga un reparto provisional y luego poder cambiar de sitio a los alumnos.
- Filtrar por familia -> informática -> geolocalización (verde - convenio | naranja - posibles empresas)
- Historial alumnos prácticas en SMR y en DAW y otras...
- Empresa con convenio y sin convenio -> enviar gente por bolsa de empleo
- Gestion información convenios (empresas) y anexos(alumnos)


INFO EXTRA
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

