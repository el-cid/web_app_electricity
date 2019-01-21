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
 Baja California | Baja California Norte 
 Baja California Sur | Baja California Sur
 Central | Ciudad de México, el Estado de México y municipios de Hidalgo, Morelos, Puebla, Michoacán y Guerrero.
 Noreste | Nuevo León, Tamaulipas, así como algunos municipios de Coahuila, el norte de Veracruz y de San Luis Potosí.
 Noroeste | Sinaloa y Sonora.  
 Norte | Chihuahua, Durango, así como la región de la Laguna en Coahuila y algunos de sus municipios.
 Occidental | Jalisco, Nayarit, Colima, Michoacán, Guanajuato, Aguascalientes, Zacatecas, Querétaro y San Luis Potosí.
 Oriental | Chiapas, Tabasco, Oaxaca, Veracruz, Puebla, Tlaxcala, Guerrero y Morelos.
 Peninsular | Yucatán, Campeche y Quintana Roo.

Hasta el año 2013, la Comisión Federal de Eléctricidad(CFE), a través del Centro Nacional de Control de Energía(CENACE), se encargaba de la operación del SEN. Su objetivo era realizar el despacho de energía eléctrica de tal manera que se asegurara el suministro de electricidad. La CFE generaba o compraba alrededor del 94% de toda la energía eléctrica en el país, en un modelo centralizado y autorregulado en el que las empresas privadas tenían muchas limitantes para participar en el sistema eléctrico mexicano, como por ejemplo:
* Sólo podían abastecerse a sí mismas o venderle sus excedentes de energía a la CFE.
* Únicamente podían establecer plantas de generación de energía eléctrica en las áreas dictaminadas por los planes de crecimiento de la CFE.
* Incentivos insuficientes para la generación de energía eléctrica a partir de energías renovables.

En el año 2014 se dio una importante reforma constitucional en Materia Energética en México, con el objetivo de modernizar y volver más competitivo el sector eléctrico nacional. Parte de esta reforma permitió una mayor participación de la iniciativa privada en la generación de energía eléctrica, al eliminar las limitantes mencionadas anteriormente y al crear el Mercado Eléctrico Mayorista(MEM); lo que habilitó la venta de energía eléctrica por parte de los generadores partículares.

La reforma energética trajo consigo la necesidad de contar con un modelo de asignación y despacho de unidades, propio de un Mercado Eléctrico Mayorista. Dentro de las múltiples funciones del CENACE está el operar de la forma más confiable y eficiente el SEN, así como coordinar la operación del MEM. Para el proceso de planeación de operación de corto plazo se creó el modelo del Mercado de un Día en Adelanto(MDA).

El objetivo del modelo MDA es poder, a partir de las ofertas de venta de energía de los participantes del mercado, de las ofertas de compra de energía y de los requerimients operativos del CENACE, determinar para un horizonte de 24 horas la asignación y despacho de las unidades generadoras, los niveles de demanda aceptados y las reservas, así como los precios marginales locales y los precios marginales de las reservas, entre otros.

El Precio Marginal Local(PML) se define como el precio de la energía eléctrica en un nodo determinado del SEN para un periodo definido, calculado de conformidad con las Reglas del Mercado y aplicable a las transacciones de energía eléctrica realizadas en el MEM.

## Descripción del problema

Actualmente el Centro Nacional de Control de Energía(CENACE) pone a disposición diversos conjuntos de datos del sistema eléctrico nacional de manera periódica a través del sitio web del gobierno de México, como por ejemplo: 
* Un catálogo con los productores de energía registrados a nivel nacional(nodos).
* El consumo mensual de energía eléctrica de las distintas regiones que componen el sistema eléctrico nacional.
* Los precios horarios de venta de cada nodo en el mercado eléctrico nacional.


Es de gran interés para la iniciativa privada conocer este tipo de datos por muchas razones, algunas de ellas son:
* Analizar posibles incidencias en el mercado eléctrico nacional, para cerciorarse de su correcto funcionamiento en base a los datos históricos del mismo.
* Encontrar regiones geográficas en las que exista un nicho de oportunidad de negocio y se puedan instalar nuevas plantas generadoras, para satisfacer la demanda de la región.
* Encontrar regiones geográficas en las que las condiciones de infraestructura del sistema eléctrico nacional se adapten a las necesidades de nuevos proyectos comerciales como hoteles, unidades habitacionales o parques industriales.


Pese a que el gobierno pone a disposición del publico los conjuntos de datos mencionados anteriormente, el acceso a estos es complicado ya que el sitio web de la CENACE tiene muchas páginas y es dificil encontrar la información correcta si no se es familiar con el mismo debido a que también hay muchas páginas con contenido desactualizado. 

Aunado a esta situación, la CENACE publica todos los días los precios de venta de la energía eléctrica, por hora, para cada uno de los nodos que participan en el mercado eléctrico nacional, por lo que se vuelve necesario tener mecanismos para la gestión de estos datos.

## Alcance del proyecto

Se desarrollara un sistema que permita la gestión y visualización de los datos de la infraestructara del sistema eléctrico nacional, del consumo mensual bruto de energía eléctrica a nivel nacional y de los precios marginales locales del mercado de un día en adelanto.

## Objetivos del proyecto

* Diseñar e implementar una base de datos con datos de la infraestructura del sistema eléctrico nacional, del consumo mensual de energía eléctrica a nivel nacional y de los PML del MDA.
* Diseñar e implementar una aplicación web para la gestión, interacción y visualización de la base de datos, por parte del usuario final.

## Diagrama Entidad-Relación:

![Diagrama entidad relación](https://github.com/el-cid/sistema_electrico_nacional/blob/el-cid-patch-1/diagrama_er_webv5.png)

## Tablas

### Sistemas Interconectados

Clave | Nombre
  ---------------------- | --------------------------
  BCA | Sistema Interconectado Baja California
  BCS | Sistema Interconectado Baja California Sur
  SIN | Sistema Interconectado Nacional

### Regiones

Clave | Nombre
------|-------------------
BCA | Baja California 
BCS | Baja California 
CEL | Central 
NES | Noreste 
NOR | Noroeste 
NTE | Norte 
OCC | Occidental  
ORI | Oriental  
PEN | Peninsular  

### Consumo Mensual Bruto

Centro de Control Regional | Año | Mes | Cantidad(GWh)
-------------------------- | --- | --- | -------------
BCA | 2018 | Enero |  966824
BCS | 2018 | Enero | 190916
CEL | 2018 | Enero | 5125053
NES | 2018 | Enero | 4129793
NOR | 2018 | Enero | 1460979
NTE | 2018 | Enero | 1914899
OCC | 2018 | Enero | 5617172
ORI | 2018 | Enero | 3669703
PEN | 2018 | Enero | 810675

### Estados

Clave | Nombre
------|------
1 | Aguascalientes
2 | Baja California
3 | Baja California Sur
4 | Campeche
5 | Coahuila
6 | Colima
7 | Chiapas
8 | Chihuahua
9 | Ciudad de México
10 | Durango
11 | Guanajuato
12 | Guerrero
13 | Hidalgo
14 | Jalisco
15 | México
16 | Michoacán
17 | Morelos
18 | Nayarít
19 | Nuevo León
20 | Oaxaca
21 | Puebla
22 | Querétaro
23 | Quintana Roo
24 | San Luis Potosí
25 | Sinaloa
26 | Sonora
27 | Tabasco
28 | Tamaulipas
29 | Tlaxcala
30 | Veracruz
31 | Yucatán
32 | Zacatecas

### Precios Marginales Locales del Mercado de un Día en Adelanto

Fecha | Hora | Clave del nodo | Precio marginal local ($/MWh)
------|------|----------------|-----------------------
 16/09/2018 | 1 | 01AAN-85	| 1057.57 |	973.38 | 84.19 | 0
 16/09/2018 | 2 | 01AAN-85 | 988.75	| 911.62 | 77.42 | -0.28
 16/09/2018 | 3 | 01AAN-85	| 922.79  |	852.02 | 70.77 | 0
 16/09/2018 | 4 | 01AAN-85 |	789.67	| 730.46 | 60.18 | -0.96

### Nodo

Clave | Tension | Región | Estado
------|---------|--------|-------
01AAN-85 | 85 | CEL | 13
07TCB-115 | 115 | BCS | 3
