# XVendor 2

**XVendor 2** es un sistema moderno de Ventas y Punto de Venta (POS) de propósito general sin manejo de inventario desarrollado en **PHP 8** y **MySQL**.

---

## 🚀 Arquitectura y Tecnologías (2026)

- **Arquitectura MVC con Enrutamiento Limpio**: Implementación de **FastRoute** para URLs amigables (`/home`, `/pos`, `/products`, `/sells`, `/box`, `/profile`, `/settings`).
- **Motor de Plantillas Twig**: Vistas desacopladas, herencia de layouts y renderizado seguro contra XSS.
- **Seguridad Integrada**: Protección contra ataques **CSRF** en todos los formularios mediante tokens únicos por sesión.
- **Capa de Servicios**: Desacoplamiento de la lógica de negocio en clases de servicio dedicadas (`ProductService`, `SellService`, `BoxService`, `ConfigurationService`, etc.).
- **Venta Sin Inventario**: Venta ágil de productos sin restricciones ni bloqueos de existencias, ideal para servicios, productos sobre pedido o comercio directo.
- **Gestión de Caja**: Control de cortes de caja, registro de turnos y cálculo automático de totales ingresados.
- **Interfaz de Usuario Moderna**: Plantilla integrada con **CoreUI v4**, componentes **Bootstrap 5**, **Bootstrap Icons**, **DataTables** y notificaciones con **SweetAlert2**.

---

## 📦 Módulos Principales

- **Dashboard / Inicio**: Métricas de resumen del negocio y gráficas de ventas.
- **Vender POS**: Punto de venta ágil con carrito interactivo, cálculo de cambio y venta directa sin control de existencias.
- **Ventas**: Historial detallado de operaciones de venta y generación de tickets térmicos (80mm) y reportes en PDF.
- **Caja**: Apertura, registro de ventas del turno y cortes de caja con historial.
- **Catálogos**: Productos (precios, presentación e imágenes), Categorías, Clientes y Proveedores.
- **Reportes**: Reporte de ventas filtrable por rango de fechas y clientes en PDF.
- **Administración**: Gestión de usuarios, perfiles y ajustes del sistema.

---

## 🛠️ Requisitos del Sistema

- **Servidor Web**: Apache (con módulo `mod_rewrite` activado) o Nginx.
- **PHP**: versión 8.0 o superior con extensión PDO/MySQLi.
- **Base de Datos**: MySQL 5.7+ / MariaDB 10.3+.
- **Gestor de dependencias**: Composer.

---

## ⚙️ Instalación y Configuración

1. **Clonar o descargar el repositorio**:
   Coloca el proyecto en el directorio raíz de tu servidor web (ej. `htdocs` en XAMPP/LAMPP).

2. **Instalar dependencias de Composer**:
   ```bash
   composer install
   ```

3. **Base de Datos**:
   Crea la base de datos `xvendorlite` en MySQL e importa la estructura y datos iniciales del archivo `schema.sql`:
   ```sql
   CREATE DATABASE xvendorlite;
   USE xvendorlite;
   SOURCE schema.sql;
   ```

4. **Configuración de Conexión**:
   Edita los parámetros de conexión a la base de datos en [`core/controller/Database.php`](core/controller/Database.php):
   ```php
   $this->user = "root";
   $this->pass = "";
   $this->host = "localhost";
   $this->ddbb = "xvendorlite";
   ```

5. **Acceso**:
   Abre tu navegador web e ingresa a `http://localhost/xvendor2/`.

6. **Credenciales por defecto**:
   - **Usuario**: `admin`
   - **Contraseña**: `admin`

---

## 📄 Créditos

Desarrollado por [Evilnapsis](https://evilnapsis.com/).