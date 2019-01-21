# Tablero para el sistema eléctrico nacional
## Introducción
En un sistema eléctrico la energía eléctrica pasa por al menos cinco etapas para llegar de las centrales generadoras a los usuarios finales:
1. Generación a partir de combustibles o fuentes renovables.
2. Despacho por medio de un centro computarizado que ordena a dónde debe dirigirse la energía eléctrica.
3. Transmisión a través de la red eléctrica de alta tensión.
4. Distribución a través de la red eléctrica de baja tensión, abasteciendo así a las ciudades y pueblos.
5. Comercialización.


El Sistema Eléctrico de México está dividido en subsistemas interconectados, el control y la gestión de estos subsistemas se divide a su vez por regiones geográficas: 

  Sistema Interconectado | Región geográfica
  ---------------------- | --------------------------
 Sistema Interconectado Baja California | Baja California
 Sistema Interconectado Baja California Sur | Baja California Sur
 Sistema Interconectado Nacional | Occidental, Central, Oriental, Peninsular, Norte, Noreste, Noroeste 
 

![Mapa](https://github.com/el-cid/sistema_electrico_nacional/blob/el-cid-patch-1/mapav3.png)

 Gerencia de Control Regional | Ambito geográfico que controla
  ---------------------- | --------------------------
 Baja California | Baja California 
 Baja California Sur | Baja California Sur
 Central | Ciudad de México, el Estado de México y municipios de Hidalgo, Morelos, Puebla, Michoacán y Guerrero.
 Noreste | Nuevo León, Tamaulipas, así como algunos municipios de Coahuila, el norte de Veracruz y de San Luis Potosí.
 Noroeste | Sinaloa y Sonora.  
 Norte | Chihuahua, Durango, así como la región de la Laguna en Coahuila y algunos de sus municipios.
 Occidental | Jalisco, Nayarit, Colima, Michoacán, Guanajuato, Aguascalientes, Zacatecas, Querétaro y San Luis Potosí.
 Oriental | Chiapas, Tabasco, Oaxaca, Veracruz, Puebla, Tlaxcala, Guerrero y Morelos.
 Peninsular | Yucatán, Campeche y Quintana Roo.

Hasta el 2013, la Comisión Federal de Eléctricidad(CFE) generaba o compraba alrededor del 94% de toda la energía eléctrica en el país, en un modelo centralizado y autorregulado en el que las empresas privadas tenían muchas limitantes para participar en el sistema eléctrico mexicano, como por ejemplo:
* Sólo podían abastecerse a sí mismas o venderle sus excedentes de energía a la CFE.
* Únicamente podían establecer plantas de generación de energía eléctrica en las áreas dictaminadas por los planes de crecimiento de la CFE.
* Incentivos insuficientes para la generación de energía eléctrica a partir de energías renovables.

En el año 2014 se dio una importante reforma constitucional en Materia Energética en México, con el objetivo de modernizar y volver más competitivo el sector eléctrico nacional. Parte de esta reforma permitió una mayor participación de la iniciativa privada en la generación de energía eléctrica, al eliminar las limitantes mencionadas anteriormente y al crear el Mercado Eléctrico Mayorista; lo que habilitó la venta de energía eléctrica por parte de los generadores partículares.

## Descripción del problema

Actualmente el Centro Nacional de Control de Energía(CENACE) pone a disposición diversos conjuntos de datos del sistema eléctrico nacional de manera periódica a través del sitio web del gobierno de México, como por ejemplo: 
* Un catálogo con los productores de energía registrados a nivel nacional(nodos).
* El consumo mensual de energía eléctrica de las distintas regiones que componen el sistema eléctrico nacional.
* Los precios horarios de venta de cada nodo en el mercado eléctrico nacional.


Es de gran interés para la iniciativa privada conocer este tipo de datos por muchas razones, algunas de ellas son:
* Analizar posibles incidencias en el mercado eléctrico nacional, para cerciorarse de su correcto funcionamiento en base a los datos históricos del mismo.
* Encontrar regiones geográficas en las que exista un nicho de oportunidad de negocio y se puedan instalar nuevas plantas generadoras, para satisfacer la demanda de la región.
* Encontrar regiones geográficas en las que las condiciones de infraestructura del sistema eléctrico nacional se adapten a las necesidades de nuevos proyectos comerciales como hoteles, unidades habitacionales o parques industriales.
* Pronosticar los precios de venta en el mercado eléctrico nacional para apoyar la planificación de operaciones de las plantas generadoras. 


Pese a que el gobierno pone a disposición del publico los conjuntos de datos mencionados anteriormente, el acceso a estos es complicado ya que el sitio web de la CENACE tiene muchas páginas y es dificil encontrar la información correcta si no se es familiar con el mismo debido a que también hay muchas páginas con contenido desactualizado. 

Aunado a esta situación, la CENACE publica todos los días los precios de venta de la energía eléctrica, por hora, para cada uno de los nodos que participan en el mercado eléctrico nacional, por lo que se vuelve necesario tener mecanismos para la gestión de estos datos.

## Alcance del proyecto

Se desarrollara un sistema que permita la gestión y visualización de los datos de la infraestructara del sistema eléctrico nacional y del consumo mensual bruto de energía eléctrica a nivel nacional. 

## Objetivos del proyecto

* Diseñar e implementar una base de datos distribuida con datos de la infraestructura del sistema eléctrico nacional y del consumo mensual de energía eléctrica a nivel nacional.
* Diseñar e implementar un sistema para la gestión de los fragmentos de la base de datos.
* Diseñar e implementar una aplicación web para la gestión, interacción y visualización de la base de datos distribuida, por parte del usuario final.

## Tecnología a utilizar

En la capa de datos del sistema se utilizará el sistema gestor de bases de datos PostgreSQL, junto a psql para la gestión de la base de datos. La capa de presentación del sistema se realizará enfocada a un entorno web utilizando HTML, CSS y Javascript. Finalmente, se utilizara Java, con el fin de implementar la capa del modelo de dominio del sistema y de coordinar la interacción con la capa de datos y la capa de presentación.

## Operaciones del sistema

* Operaciones de escritura:
  1. Inserción de un nuevo nodo.
  2. Inserción de una nueva tupla del consumo mensual de alguna región.
  3. Modificación del nivel de tensión de un nodo.
* Operaciones de lectura:
  1. Busqueda de un nodo por su clave.
  2. Busqueda de los nodos de una región.
  3. Busqueda de los nodos de un sistema interconectado.
  4. Busqueda de las 5 regiones con mayor consumo mensual.
  5. Busqueda del consumo mensual bruto de un sistema interconectado.

## Diagrama Entidad-Relación:

![Diagrama entidad relación](https://github.com/el-cid/sistema_electrico_nacional/blob/bases_distribuidas/diagrama_er_bddv5.png)

## Fuente de los datos:

### Catálogo de los productores de energía registrados a nivel nacional:

En la siguiente página web se tiene acceso al catálogo de nodos, definidos en cada uno de los tres Sistemas Interconectados que conforman el Sistema Eléctrico Nacional: Sistema Interconectado Nacional (SIN), Sistema Interconectado Baja California (BCA), y Sistema Eléctrico Baja California Sur (BCS). 

https://www.cenace.gob.mx/paginas/publicas/mercadooperacion/nodosp.aspx

### Catálogo de Entidades Federativas de México:

La ubicación de los nodos mencionados anteriormente se describe de acuerdo al catálogo de entidades federativas del Instituto Nacional de Estadística y Geografía(INEGI) de México, se puede acceder a dicho catálogo a través de la siguiente página web:

http://www3.inegi.org.mx/rnm/index.php/catalog/78/download/3289

### Consumo mensual bruto de energía eléctrica de las regiones geográficas del sistema eléctrico nacional:

Estos datos se pueden descargar en el portal de datos abiertos del gobierno de México, en la sección de datos del CENACE.

https://datos.gob.mx/busca/dataset/consumo-mensual-bruto-del-sistema-electrico-nacional

