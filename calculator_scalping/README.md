# Calculator Scalping 📈

**Calculator Scalping** es una herramienta web financiera diseñada para simular, proyectar y gestionar operaciones de trading (scalping) de acciones. Permite calcular costos operativos, impuestos y comisiones en tiempo real, ofreciendo puntos de equilibrio y comparaciones contra tasas de interés bancarias (TNA).

![Estado del Proyecto](https://img.shields.io/badge/Estado-Activo-success)
![Versión](https://img.shields.io/badge/Versión-1.0.0-blue)
![PHP](https://img.shields.io/badge/PHP-8.0%2B-purple)
![MySQL](https://img.shields.io/badge/MySQL-MariaDB-orange)

---

## 📋 Tabla de Contenidos

1. [Características](#características)
2. [Tecnologías Utilizadas](#tecnologías-utilizadas)
3. [Estructura del Proyecto](#estructura-del-proyecto)
4. [Instalación y Configuración](#instalación-y-configuración)
5. [Uso](#uso)
6. [Contribución](#contribución)
7. [Licencia](#licencia)

---

<a name="características"></a>
## 🚀 Características

### 1. Gestión de Brokers 🏦
- Alta, baja y modificación de brokers.
- Configuración personalizada de aranceles:
  - Comisión de compra/venta (%).
  - Derecho de mercado (%).
  - IVA sobre comisiones (%).

### 2. Simulador de Operaciones 🧮
- **Cálculos en Tiempo Real**: Proyección de costos y ganancias al instante.
- **Doble Perspectiva**: Visualización de valores **"Por Acción"** (Unitario) y **"Total Operación"**.
- **Indicadores Clave**:
  - **Coeficiente Base**: Carga impositiva total.
  - **Punto de Equilibrio**: Incremento necesario para cubrir costos (Break-even).
  - **Comparativa TNA**: Referencia contra Tasa Nominal Anual (365 días) y días hábiles (260 días).

### 3. Historial y Seguimiento 📝
- Registro histórico de todas las operaciones.
- **Snapshot de Configuración**: Guarda los porcentajes exactos (Comisiones, IVA) vigentes al momento de la operación.
- **Acciones**:
  - **Detalle**: Vista modal completa con el desglose financiero histórico.
  - **Vigencia**: Toggle para marcar operaciones como activas/inactivas.
  - **Eliminar**: Gestión de limpieza de historial.

---

<a name="tecnologías-utilizadas"></a>
## 💻 Tecnologías Utilizadas

El proyecto implementa una arquitectura **MVC (Modelo-Vista-Controlador)** personalizada e independiente en PHP nativo.

- **Backend**:
  - PHP 7.4 / 8.0+
  - MySQL / MariaDB (PDO para consultas seguras).
  - Arquitectura MVC propia (Router, Controller, Model).
- **Frontend**:
  - HTML5 & CSS3.
  - **JavaScript (Vanilla)**: Lógica de cálculo del lado del cliente.
  - **Bootstrap 3**: Framework de UI para diseño responsivo y modales.
  - **jQuery**: Utilizado principalmente para manipulación DOM y AJAX.

---

<a name="estructura-del-proyecto"></a>
## 📂 Estructura del Proyecto

```bash
calculator_scalping/
├── App/
│   ├── Config/          # Configuración (DB, constantes)
│   ├── Controllers/     # PrincipalController.php (Lógica de negocio)
│   ├── Core/            # Router.php, Database.php (Núcleo)
│   ├── Models/          # OperacionesModel.php, BrokersModel.php
│   └── Views/           # Layouts y vistas (Principal/index.php)
├── public/              # Archivos públicos (CSS, JS, imágenes)
├── index.php            # Entry point (Router dispatch)
└── README.md            # Documentación
```

---

<a name="instalación-y-configuración"></a>
## ⚙️ Instalación y Configuración

### 1. Requisitos Previos
- Servidor Web (Apache/Nginx).
- PHP 7.4 o superior.
- MySQL o MariaDB.
- Composer (opcional, si se agregan dependencias).

### 2. Instalación
1. **Clonar el repositorio**:
   ```bash
   git clone https://github.com/tu-usuario/calculator_scalping.git
   ```
2. **Mover a la carpeta web**:
   Coloca la carpeta `calculator_scalping` en `C:\xampp\htdocs\` (o tu directorio web root).

### 3. Base de Datos
Crea una base de datos llamada `calculator_scalping` y ejecuta el siguiente script SQL para crear las tablas necesarias:

```sql
CREATE DATABASE IF NOT EXISTS calculator_scalping;
USE calculator_scalping;

-- Tabla Brokers
CREATE TABLE IF NOT EXISTS brokers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_broker VARCHAR(255) NOT NULL,
    comision DECIMAL(10,5) DEFAULT 0,
    derecho_mercado DECIMAL(10,5) DEFAULT 0,
    iva DECIMAL(10,5) DEFAULT 0,
    activo TINYINT(1) DEFAULT 1
);

-- Tabla Operaciones
CREATE TABLE IF NOT EXISTS operaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha_operacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    tasa_banco DECIMAL(10,5),
    tn_365 DECIMAL(10,6),
    tn_260 DECIMAL(10,6),
    broker_id INT,
    nombre_accion VARCHAR(50),
    cantidad_acciones INT,
    valor_neto_compra DECIMAL(15,2),
    valor_comision_compra DECIMAL(15,2),
    derecho_mercado_compra DECIMAL(15,2),
    iva_compra DECIMAL(15,2),
    valor_bruto_compra DECIMAL(15,2),
    comision_porcentaje DECIMAL(10,5),
    derecho_mercado_porcentaje DECIMAL(10,5),
    iva_porcentaje DECIMAL(10,5),
    ganancia_proyectada_porcentaje DECIMAL(10,5),
    ganancia_neta_por_accion DECIMAL(15,2),
    precio_neto_venta DECIMAL(15,2),
    valor_comision_venta DECIMAL(15,2),
    derecho_mercado_venta DECIMAL(15,2),
    iva_venta DECIMAL(15,2),
    precio_bruto_venta DECIMAL(15,2),
    ganancia_neta_total DECIMAL(15,2),
    fecha_operacion_venta DATE,
    vigente TINYINT(1) DEFAULT 1
);
```

4. **Configuración de Conexión**:
   Edita `App/Core/Database.php` (o `config.ini` si aplica) con tus credenciales:
   ```php
   'host' => 'localhost',
   'db_name' => 'calculator_scalping',
   'username' => 'root',
   'password' => ''
   ```

---

<a name="uso"></a>
## 📖 Uso

1. **Configuración Inicial (Solapa 3)**:
   - Carga tus brokers preferidos.
   - Define las comisiones y aranceles exactos para tener cálculos precisos.

2. **Simulación (Solapa 2)**:
   - Ingresa una **TNA** de referencia (Tasa Nominal Anual) para comparar rendimientos.
   - Selecciona un Broker.
   - Completa: **Acción**, **Precio Compra**, **Ganancia Esperada (%)**.
   - El sistema calculará automáticamente:
     - Costos de compra y venta.
     - Precio de venta necesario (Break-even).
     - Rendimiento comparado con plazo fijo.

3. **Guardar y Gestionar (Solapa 1)**:
   - **Guardar Operación**: Almacena el cálculo si es prometedor.
   - **Historial**: Revisa operaciones pasadas, consulta los detalles financieros exactos (incluyendo comisiones históricas) o elimina registros obsoletos.

---

<a name="contribución"></a>
## 🤝 Contribución

1. Haz un Fork del proyecto.
2. Crea una rama (`git checkout -b feature/AmazingFeature`).
3. Commit de tus cambios (`git commit -m 'Add some AmazingFeature'`).
4. Push a la rama (`git push origin feature/AmazingFeature`).
5. Abre un Pull Request.

---

<a name="licencia"></a>
## 📄 Licencia

Distribuido bajo la licencia MIT. Ver `LICENSE` para más información.
