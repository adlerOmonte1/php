# ARCHITECTURE DECISION RECORD (ADR) 1

| Atributo | Detalle |
| :--- | :--- |
| **Fecha** | 09/05/2026 |
| **ADR-01** | Selección de Azure Functions sobre Container Apps para lógica de negocio |
| **Versión** | 1.0 |

## CONTEXTO
El backend actual de RapidGo es una aplicación monolítica en Node.js alojada en un servidor dedicado con un costo fijo ineficiente de $4.200.000 COP mensuales teniendo un cuello de botellas en horas pico, el servidor se satura, generando cancelaciones como el 12% del tráfico por respuestas lentas. Se requiere una arquitectura que garantice una escalabilidad de 500 req/seg automática, adopte un modelo de pago por uso, minimice la carga operativa y no supere el presupuesto piloto de $50 USD.

**Restricciones**
* Restricción 1: El equipo solo tiene experiencia en Node.js y Python
* Restricción 2: El servicio base no debe superar los $50 USD mensuales de la fase piloto.

## ALTERNATIVAS EVALUADAS

| Criterio Estratégico | Azure Functions | Azure App Service | Container Apps |
| :--- | :--- | :--- | :--- |
| **Modelo Financiero - Pago por Uso**<br>Peso [5] | 5<br>Pts: 25 | 1<br>Pts: 5 | 4<br>Pts: 20 |
| **Escalabilidad Autónoma**<br>Peso [5] | 5<br>Pts: 25 | 3<br>Pts: 15 | 5<br>Pts: 25 |
| **Minimizar Carga Operativa**<br>Peso [4] | 5<br>Pts: 20 | 5<br>Pts: 12 | 3<br>Pts: 12 |
| **Despliegues con tiempo de inactividad**<br>Peso [4] | 4<br>Pts: 16 | 5<br>Pts: 20 | 5<br>Pts: 25 |
| **Latencia en frío**<br>Peso [3] | 3<br>Pts: 9 | 5<br>Pts: 15 | 3<br>Pts: 9 |
| **Puntaje Total (105)** | **95** | **67** | **91** |

Se evaluaron tres servicios de cómputo mediante una matriz de decisión ponderada:

1. **Azure Functions (Opción Seleccionada - 95 pts):** Máxima puntuación en Modelo Financiero sobre el Pago por uso, Escalabilidad autónoma y Minimizar la carga operativa. Destaca por minimizar la carga operativa al permitir el despliegue directo de código fuente ya sea por Node.js o Python. Su debilidad radica en la latencia en frío durante las horas de baja demanda.
2. **Azure Container Apps ( 91 pts):** Tiene buen desempeño en escalabilidad y mitigación de Despliegues con tiempo de inactividad, pero tiene una desventaja con el criterio de Minimizar Carga Operativa ya que obliga a la única persona de infraestructura a crear y mantener imágenes de Docker y registros de contenedores.
3. **Azure App Service (67 pts):** Aunque ofrece la mejor latencia al evitar arranques en frío, pero no se alinea al modelo financiero por requerir instancias fijas encendidas, lo cual no aplica sobre el presupuesto piloto de $50 USD

---

## DECISIÓN Y JUSTIFICACIÓN
Se elige Azure Functions (Plan Consumption).

Su arquitectura orientada a eventos resuelve el problema de cuello de botella actual, escalando de forma instantánea y automática para soportar los picos de 500 req/seg sin intervención manual. Al ser un modelo Serverless puro y brindar soporte nativo para Node.js y Python cumple con los requerimientos y restricciones establecidas.

Por otro lado, el modelo de pago por uso real, elimina el desperdicio financiero durante horas de baja demanda y prioriza la capa gratuita de la fase piloto.

## CONSECUENCIAS Y TRADE-OFFS

### Ventajas obtenidas:
* **Soporte automático de picos de 500 req/seg.** Respaldado por el diseño de Functions: *"Escale de forma automática y flexible según el volumen de carga de trabajo"*.
* **Modelo de pago por uso.** Alineado a la promesa del plan de consumo: *"Pague solo por el tiempo de proceso durante la ejecución del código"*.
* **Baja carga operativa.** Cumpliendo la directiva central del servicio: *"Céntrese en el código, no en la infraestructura"*.

### Trade-offs asumidos:
* Impacto en la latencia en las madrugadas.
* Configuración cuidadosa de slots para lograr despliegues sin caídas
* Mayor complejidad para monitorear errores al dividir el monolito

# ARCHITECTURE DECISION RECORD (ADR) 2

| Atributo | Detalle |
| :--- | :--- |
| **Fecha** | 09/05/2026 |
| **ADR-02** | Cosmos DB vs Azure SQL Database para la persistencia de pedidos |
| **Versión** | 1.0 |

## CONTEXTO
Actualmente, la plataforma cuenta con una base de datos MySQL relacional que almacena 3 años de datos históricos. Para la nueva arquitectura, se requiere una capa de persistencia para centralizar los pedidos, usuarios y estados de entrega. Debido a la naturaleza del negocio (restaurantes y tiendas), la base de datos debe soportar un modelo flexible para atributos variables. Adicionalmente, se debe justificar cualquier cambio de paradigma estructural de relacional a NoSQL.

**Restricciones**
* Restricción 1: El presupuesto no debe superar los $50 USD mensuales durante la fase piloto, priorizando servicios con capa gratuita.
* Restricción 2: Los datos deben almacenarse obligatoriamente en la región Brazil South o East US por consideraciones de latencia y soberanía.
* Restricción 3: El equipo de infraestructura es de una sola persona, por lo que se debe minimizar la carga operativa.

## ALTERNATIVAS EVALUADAS

| Criterio Estratégico | Azure Cosmos DB (NoSQL) | Azure SQL Database | Azure Database for MySQL |
| :--- | :--- | :--- | :--- |
| **Modelo flexible para atributos variables**<br>Peso [5] | 5<br>Pts: 25 | 2<br>Pts: 10 | 2<br>Pts: 10 |
| **Presupuesto y Capa Gratuita**<br>Peso [5] | 5<br>Pts: 25 | 5<br>Pts: 25 | 1<br>Pts: 5 |
| **Minimizar Carga Operativa**<br>Peso [4] | 5<br>Pts: 20 | 5<br>Pts: 20 | 3<br>Pts: 12 |
| **Transición de datos históricos (3 años)**<br>Peso [4] | 2<br>Pts: 8 | 4<br>Pts: 16 | 5<br>Pts: 20 |
| **Puntaje Total (90)** | **78** | **71** | **47** |

Se evaluaron tres servicios de persistencia de datos mediante una matriz de decisión ponderada:

1. **Azure Cosmos DB (Opción Seleccionada - 78 pts):** Máxima puntuación en adaptabilidad del modelo de datos y alineación presupuestal que por su motor NoSQL maneja documentos JSON que se adaptan nativamente a las variaciones de los pedidos entre tiendas y restaurantes, tambien cuenta con un Free Tier robusto que asegura la viabilidad financiera, pero tiene una debilidad en la transición de los datos históricos acumulados durante los 3 años de operación.
2. **Azure SQL Database (71 pts):** Excelente opción financiera al ofrecer un tier alternativo gratuito de 32 GB, y facilita en gran medida la migración del esquema desde el motor actual. Sin embargo, su naturaleza relacional penaliza fuertemente el requerimiento de atributos variables, exigiendo diseños complejos como tablas genéricas que degradan el rendimiento.
3. **Azure Database for MySQL (47 pts):** Aunque sería la opción natural para mantener el histórico de datos intacto, queda descartada al no contar con un plan gratuito vitalicio consumiendo el presupuesto del piloto y al mantener la rigidez del modelo relacional frente a las nuevas necesidades de atributos variables.

---

## DECISIÓN Y JUSTIFICACIÓN
Se elige **Azure Cosmos DB** con la API de NoSQL, activando el *Free tier* (1.000 RU/s y 25 GB).

La justificación técnica de este cambio de paradigma de relacional a NoSQL radica en el núcleo del negocio de RapidGo: los atributos de un pedido de restaurante difieren estructuralmente de los de una tienda local lo que obliga a un esquema relacional a comportarse de forma dinámica que por eso genera cuellos de botella e índices ineficientes. Cosmos DB, al trabajar nativamente con JSON, se alinea de forma transparente con los contratos de endpoints de la app móvil en React Native.

A nivel de negocio, la adopción de la capa gratuita garantiza el cumplimiento estricto del límite presupuestal de $50 USD, mientras que su naturaleza totalmente administrada de forma Serverless cumple con la restricción de no sobrecargar al único administrador de infraestructura.

## CONSECUENCIAS Y TRADE-OFFS

### Ventajas obtenidas:
* **Modelo flexible para atributos variables.** Respaldado por la arquitectura agnóstica de Microsoft: *"Azure Cosmos DB indexa automáticamente todos los datos sin necesidad de administrar esquemas ni índices"*.
* **Alineación total al presupuesto.** Garantizado por las políticas del servicio: *"Obtenga los primeros 1000 RU/s y 25 GB de almacenamiento de forma gratuita en su cuenta"*.
* **Baja carga operativa.** Al ser una base de datos Serverless, elimina la necesidad de configurar servidores de bases de datos o aplicar parches de seguridad al sistema operativo.

### Trade-offs asumidos:
* **Complejidad de migración:** Se requiere diseñar y ejecutar procesos ETL complejos para transformar los 3 años de datos históricos estructurados en MySQL hacia las nuevas colecciones orientadas a documentos NoSQL.
* **Acoplamiento de SDK:** El código en las Azure Functions dependerá del SDK propietario de Cosmos DB para las operaciones CRUD, limitando la portabilidad futura a otras nubes.
* **Riesgo por consumo de RU/s.** Consultas mal diseñadas sin la clave de partición correcta pueden agotar rápidamente los 1.000 RU/s gratuitos, generando latencia adicional.


# ARCHITECTURE DECISION RECORD (ADR) 5

| Atributo | Detalle |
| :--- | :--- |
| **Fecha** | 09/05/2026 |
| **ADR-05** | Notification Hubs vs Azure Communication Services para notificaciones push |
| **Versión** | 1.0 |

## CONTEXTO
El sistema actual de notificaciones de RapidGo es inestable, presentando una tasa de entrega del 67% debido a la falta de integración directa con FCM y APNs. Esto genera confusión en los clientes respecto al estado de sus pedidos. Se requiere una arquitectura de mensajería que cumpla con el requerimiento de garantizar una tasa de entrega superior al 95%, mejorando la experiencia del cliente con estados en tiempo real. 

**Restricciones**
* Restricción 1: El presupuesto no debe superar los $50 USD mensuales durante el piloto, priorizando servicios con capa gratuita.
* Restricción 2: El equipo de infraestructura es de una sola persona, exigiendo minimizar la carga operativa.
* Restricción 3: Se debe notificar simultáneamente a dispositivos Android e iOS integrados en la aplicación React Native actual.

## ALTERNATIVAS EVALUADAS

| Criterio Estratégico | Azure Notification Hubs | Azure Communication Services | Azure Web PubSub |
| :--- | :--- | :--- | :--- |
| **Integración nativa FCM/APNs**<br>Peso [5] | 5<br>Pts: 25 | 4<br>Pts: 20 | 2<br>Pts: 10 |
| **Presupuesto y Capa Gratuita**<br>Peso [5] | 5<br>Pts: 25 | 3<br>Pts: 15 | 3<br>Pts: 15 |
| **Confiabilidad de entrega (>95%)**<br>Peso [4] | 5<br>Pts: 20 | 5<br>Pts: 20 | 4<br>Pts: 16 |
| **Minimizar Carga Operativa**<br>Peso [3] | 4<br>Pts: 12 | 3<br>Pts: 9 | 2<br>Pts: 6 |
| **Puntaje Total (85)** | **82** | **64** | **47** |

El análisis de las tres herramientas de mensajería en tiempo real revela un contraste significativo en su enfoque operativo. 

La alternativa ganadora es la opción de **Azure Notification Hubs** con un total de 82 puntos. Su arquitectura está diseñada específicamente para ser un motor de orquestación push, alcanzando la máxima puntuación al abstraer por completo la complejidad de conectarse a Google y Apple de forma simultánea. Además, su alineación con el presupuesto es perfecta gracias a su nivel gratuito.

Por otro lado, **Azure Communication Services** alcanza 64 puntos, presentándose como una plataforma omnicanal sumamente robusta que incluye SMS y llamadas. Sin embargo, su enfoque es demasiado amplio para el problema puntual de RapidGo, carece de una capa gratuita generosa para notificaciones push exclusivas y añade una complejidad innecesaria para un equipo pequeño.

Finalmente, se evaluó **Azure Web PubSub** que obtuvo 47 puntos. Aunque es excelente para conexiones bidireccionales en tiempo real mediante WebSockets, fue penalizado fuertemente debido a que no utiliza los servicios push nativos de los sistemas operativos móviles estando la app en segundo plano, obligando al desarrollador a mantener conexiones activas que drenan la batería del dispositivo del cliente.

---

## DECISIÓN Y JUSTIFICACIÓN
Se elige **Azure Notification Hubs** activando el plan Free tier para la gestión de alertas.

La justificación técnica se fundamenta en su capacidad para unificar la carga útil de los mensajes. En lugar de que las Azure Functions deban compilar un mensaje con el formato específico que exige Google y otro distinto para Apple, Notification Hubs recibe una única solicitud genérica y se encarga de traducirla y enrutarla automáticamente a FCM o APNs. Esto reduce drásticamente las líneas de código a mantener y minimiza la carga operativa del equipo.

A nivel de negocio, la plataforma garantiza el cumplimiento del requerimiento de entrega superior al 95% al contar con reintentos automáticos y telemetría exacta. Simultáneamente, su capa gratuita de un millón de notificaciones al mes absorbe la totalidad del tráfico proyectado para la fase piloto, blindando el presupuesto de los $50 USD.

## CONSECUENCIAS Y TRADE-OFFS

### Ventajas obtenidas:
* **Alta confiabilidad multiplataforma.** Microsoft respalda este servicio asegurando un motor de enrutamiento capaz de enviar alertas masivas de forma rápida y segura a cualquier plataforma móvil.
* **Viabilidad financiera del piloto.** El modelo de precios ofrece un millón de operaciones iniciales sin costo, eliminando cualquier riesgo de impacto en el presupuesto mensual de la empresa.
* **Desacoplamiento del código backend.** Las funciones serverless se liberan de gestionar las credenciales de seguridad individuales de Google y Apple, centralizándolas en el hub.

### Trade-offs asumidos:
* Límite estricto en la capa gratuita que requerirá un monitoreo constante, ya que superar el millón de eventos generará costos adicionales imprevistos.
* Gestión de credenciales de terceros al obligar al equipo de infraestructura a renovar manualmente los certificados de Apple y las claves de Firebase anualmente.
* Dificultad para rastrear errores de entrega individuales si un dispositivo específico pierde la conexión, requiriendo activar configuraciones de telemetría avanzadas.
