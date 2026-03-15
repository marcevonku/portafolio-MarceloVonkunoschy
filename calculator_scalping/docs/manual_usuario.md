# 📘 Manual de Usuario - Calculator Scalping

Bienvenido al sistema **Calculator Scalping**, tu herramienta de confianza para simular, proyectar y auditar operaciones de trading de forma precisa. Este manual te guiará paso a paso para sacarle el máximo provecho a la aplicación.

---

## 📑 Navegación Principal

El sistema se divide en tres pestañas o "Solapas" principales, diseñadas para seguir tu flujo de trabajo lógico:

1.  **Solapa 1: Historial de Operaciones**: Tu panel de control donde ves todas las operaciones guardadas, sus resultados finales y puedes gestionarlas.
2.  **Solapa 2: Calculadora / Previsualización**: El "laboratorio" donde simulas las operaciones antes de ejecutarlas.
3.  **Solapa 3: Brokers**: Donde configuras las "reglas del juego" (comisiones e impuestos) de cada plataforma que utilices.

---

## 🏛️ Solapa 3: Gestión de Brokers

**Paso 1: Configurar tu Broker**
Antes de operar, necesitas decirle al sistema cuánto te cuesta operar.

1.  Ve a la **Solapa 3**.
2.  En el formulario "Cargar Nuevo Broker":
    *   **Nombre del Broker**: Ej. *Bull Market*, *IOL*, *Cocos*.
    *   **Comisión sobre Movimiento (%)**: La tarifa que te cobra el broker por cada compra y venta (ej. 0.5%).
    *   **Derecho de Mercado (%)**: Arancel de BYMA (ej. 0.08%).
    *   **IVA (%)**: Impuesto sobre las comisiones (generalmente 21%).
3.  Haz clic en **"Guardar Broker"**.
4.  Verás tu broker listado en la tabla inferior. Puedes desactivarlo o editarlo si las comisiones cambian.

---

## 🧮 Solapa 2: Simulación de Operaciones

Aquí ocurre la magia. Sigue estos pasos para calcular una operación:

### 1. Datos de Referencia (Contexto)
*   **TNA Bancaria / Billeteras Virtuales HOY**: Ingresa la tasa anual de un plazo fijo o billetera virtual (ej. 33%). El sistema usará esto para decirte si tu operación rinde más o menos que dejar el dinero en el banco.

### 2. Configuración de la Operación
*   **Seleccione Broker**: Elige uno de los brokers que creaste en la Solapa 3. *Nota: Los porcentajes se cargarán automáticamente*.
*   **Nombre / Sigla de la Acción**: Ej. `GGAL`, `YPF`.
*   **Valor Neto (precio por acción)**: A cuánto cotiza la acción en este momento.
*   **Cantidad de Acciones**: Cuántas piensas comprar.
*   **Proyección Ganancia (%)**: Cuánto esperas ganar (ej. 1%, 2%, 0.5%).

### 3. Calcular
*   Haz clic en **"Cargar Pre Visualización"**.

### 4. Interpretación de Resultados
Se desplegará una tabla detallada con dos columnas: **Unitario (x1)** y **Total (xN)**.
*   **Coeficiente Base**: Es el "costo hundido" en porcentaje. Si suma 1.2%, tu acción tiene que subir al menos 1.2% para que no pierdas dinero.
*   **Punto de Equilibrio ($)**: El precio exacto al que tienes que vender para salir "hecho" (ni ganar ni perder, cubriendo comisiones e impuestos).
*   **Ganancia Neta**: Cuánto dinero limpio te quedará en el bolsillo si se cumple tu proyección.
*   **Comparativa TNA**:
    *   **Verde**: Tu operación supera la tasa bancaria.
    *   **Rojo**: Ganarías más (y con menos riesgo) dejando el dinero en el banco.

---

## 💾 Guardar Operación

Si la simulación te convence:
1.  Haz clic en el botón verde **"Guardar Operación"**.
2.  El sistema confirmará el guardado y te llevará automáticamente al Historial.

---

## 📋 Solapa 1: Historial de Operaciones

Aquí quedan registradas tus decisiones.

### Lectura de la Tabla
*   **Fechas**: Cuándo simulaste la operación.
*   **Valores**: Compra Total, Venta Total y **Ganancia Neta**.
*   **Coloreado**: Las ganancias positivas se ven en **verde**, las pérdidas en **rojo**.

### Acciones Disponibles
En la columna de la derecha (`Acciones`) tienes tres herramientas:

1.  **👁️ Detalle (Botón Azul)**:
    *   Abre una ventana emergente que recupera la "foto" exacta del momento en que operaste.
    *   **IMPORTANTE**: Muestra los porcentajes de comisión e impuestos que estaban vigentes *ese día*, no los actuales. Esto es vital para auditorías precisas.
2.  **Vigencia (Switch)**:
    *   Te permite marcar una operación como "Vigente" (pendiente de ejecutar/cerrar) o "No Vigente" (ya finalizada o descartada), sin borrarla.
3.  **🗑️ Eliminar (Botón Rojo)**:
    *   Borra permanentemente la operación de la base de datos. ¡Cuidado, no se puede deshacer!

---

## ❌ Solución de Problemas Comunes

*   **"No me aparecen los porcentajes en el detalle"**: Asegúrate de haber guardado la operación *después* de la actualización del sistema (Diciembre 2025). Las operaciones antiguas pueden no tener estos datos guardados.
*   **"El cálculo no coincide con mi broker"**: Verifica en la Solapa 3 si los porcentajes de IVA y Derechos de Mercado están actualizados según el tarifario vigente de tu broker.
*   **"Error al guardar"**: Si ves una alerta roja, verifica que no hayas dejado campos vacíos en la configuración (especialmente el nombre de la acción).

---
*Manual actualizado al 14 de Diciembre de 2025 - v1.0*
