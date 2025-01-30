# GMAO - Gestión de Mantenimiento por Ordenador

## Descripción
GMAO es una aplicación web desarrollada para **Egibide**, un centro educativo especializado en Formación Profesional. Su objetivo es mejorar la gestión de incidencias y mantenimientos dentro de la escuela, optimizando el flujo de trabajo y la organización del equipo técnico.

Actualmente, la gestión se realiza manualmente a través de un cuaderno, lo que genera dificultades debido a la creciente carga de trabajo. Con esta aplicación, se busca:
- Permitir que docentes y alumnado reporten incidencias de manera sencilla.
- Facilitar la asignación de tareas a técnicos.
- Optimizar el control de mantenimientos preventivos.
- Reducir la carga del responsable de taller.
- Incorporar un administrador para la gestión de datos clave del sistema.

## Tecnologías Utilizadas
### **Frontend:**
- Vue.js
- Bootstrap
- Sass

### **Backend:**
- Laravel (PHP)
- MySQL

### **Herramientas de Desarrollo:**
- Laragon (entorno de desarrollo)
- Visual Studio Code
- PhpMyAdmin (gestión de base de datos)
- GitHub (control de versiones)
- WhatsApp y Discord (comunicación del equipo)

## Instalación y Configuración
### **Requisitos Previos:**
- PHP 8.x
- Composer
- Node.js y npm
- MySQL

### **Pasos para la Instalación:**
1. Clonar el repositorio:
   ```sh
   git clone https://github.com/tu_usuario/tu_repositorio.git
   cd tu_repositorio
   ```
2. Instalar dependencias del backend:
   ```sh
   composer install
   ```
3. Instalar dependencias del frontend:
   ```sh
   npm install
   ```
4. Configurar el archivo `.env`:
   ```sh
   cp .env.example .env
   ```
   - Configurar la conexión a la base de datos en `.env`

5. Generar clave de aplicación y migrar base de datos:
   ```sh
   php artisan key:generate
   php artisan migrate --seed
   ```

6. Ejecutar el servidor de desarrollo:
   ```sh
   php artisan serve
   ```
7. Iniciar el frontend:
   ```sh
   npm run dev
   ```

## Funcionalidades Principales
### **Gestión de Incidencias**
- Reporte de incidencias por docentes y alumnado.
- Registro de detalles: tipo, descripción y fecha de reporte.
- Estado de la incidencia (pendiente/resuelta).

### **Asignación de Tareas**
- Asignación eficiente de incidencias a técnicos.
- Actualización del estado de cada tarea por parte de los técnicos.

### **Mantenimientos Preventivos**
- Creación y programación de mantenimientos periódicos.
- Generación automática de incidencias para mantenimientos planificados.

### **Roles y Permisos**
- **Docentes/Alumnado:** Pueden reportar incidencias.
- **Técnicos:** Gestionan y solucionan incidencias.
- **Administrador:** Gestiona datos del sistema (máquinas, usuarios, mantenimientos, etc.).

## Diseño
### **Guía de Estilos y Gama Cromática**
La interfaz sigue la identidad visual de Egibide, garantizando coherencia con otras herramientas del centro.
- **Colores principales:**
  - Morado: `#84005d` (Identidad de Egibide)
  - Azul: `#414d5b`
  - Negro: `#373a3c`

### **Arquitectura del Proyecto**
- **Frontend:** SPA desarrollada con Vue.js y Bootstrap.
- **Backend:** API REST con Laravel y MySQL.
- **Control de versiones:** GitHub.

## Futuras Implementaciones
- **Despliegue:** Implementar la aplicación en un servidor en producción.
- **Optimización del código:** Unificación de métodos y mejoras de rendimiento.
- **Mejoras en la responsividad:** Adaptación completa a dispositivos móviles.

## Contribución
Si deseas contribuir al proyecto:
1. Haz un fork del repositorio.
2. Crea una nueva rama (`git checkout -b feature-nueva-funcionalidad`).
3. Realiza tus cambios y haz un commit (`git commit -m "Añadir nueva funcionalidad"`).
4. Sube los cambios a tu rama (`git push origin feature-nueva-funcionalidad`).
5. Abre un Pull Request.

## Licencia
Este proyecto está bajo la licencia **MIT**. Consulta el archivo `LICENSE` para más información.

## Contacto
- **Desarrolladores:** Joseba Fernández, Oier Albéniz, Leire de las Heras
- **Correo Electrónico:** contacto@egibide.com
# GMAO - Gestión de Mantenimiento por Ordenador

## Descripción
GMAO es una aplicación web desarrollada para **Egibide**, un centro educativo especializado en Formación Profesional. Su objetivo es mejorar la gestión de incidencias y mantenimientos dentro de la escuela, optimizando el flujo de trabajo y la organización del equipo técnico.

Actualmente, la gestión se realiza manualmente a través de un cuaderno, lo que genera dificultades debido a la creciente carga de trabajo. Con esta aplicación, se busca:
- Permitir que docentes y alumnado reporten incidencias de manera sencilla.
- Facilitar la asignación de tareas a técnicos.
- Optimizar el control de mantenimientos preventivos.
- Reducir la carga del responsable de taller.
- Incorporar un administrador para la gestión de datos clave del sistema.

## Tecnologías Utilizadas
### **Frontend:**
- Vue.js
- Bootstrap
- Sass

### **Backend:**
- Laravel (PHP)
- MySQL

### **Herramientas de Desarrollo:**
- Laragon (entorno de desarrollo)
- Visual Studio Code
- PhpMyAdmin (gestión de base de datos)
- GitHub (control de versiones)
- WhatsApp y Discord (comunicación del equipo)

## Instalación y Configuración
### **Requisitos Previos:**
- PHP 8.x
- Composer
- Node.js y npm
- MySQL

### **Pasos para la Instalación:**
1. Clonar el repositorio:
   ```sh
   git clone https://github.com/tu_usuario/tu_repositorio.git
   cd tu_repositorio
   ```
2. Instalar dependencias del backend:
   ```sh
   composer install
   ```
3. Instalar dependencias del frontend:
   ```sh
   npm install
   ```
4. Configurar el archivo `.env`:
   ```sh
   cp .env.example .env
   ```
   - Configurar la conexión a la base de datos en `.env`

5. Generar clave de aplicación y migrar base de datos:
   ```sh
   php artisan key:generate
   php artisan migrate --seed
   ```

6. Ejecutar el servidor de desarrollo:
   ```sh
   php artisan serve
   ```
7. Iniciar el frontend:
   ```sh
   npm run dev
   ```

## Funcionalidades Principales
### **Gestión de Incidencias**
- Reporte de incidencias por docentes y alumnado.
- Registro de detalles: tipo, descripción y fecha de reporte.
- Estado de la incidencia (pendiente/resuelta).

### **Asignación de Tareas**
- Asignación eficiente de incidencias a técnicos.
- Actualización del estado de cada tarea por parte de los técnicos.

### **Mantenimientos Preventivos**
- Creación y programación de mantenimientos periódicos.
- Generación automática de incidencias para mantenimientos planificados.

### **Roles y Permisos**
- **Docentes/Alumnado:** Pueden reportar incidencias.
- **Técnicos:** Gestionan y solucionan incidencias.
- **Administrador:** Gestiona datos del sistema (máquinas, usuarios, mantenimientos, etc.).

## Diseño
### **Guía de Estilos y Gama Cromática**
La interfaz sigue la identidad visual de Egibide, garantizando coherencia con otras herramientas del centro.
- **Colores principales:**
  - Morado: `#84005d` (Identidad de Egibide)
  - Azul: `#414d5b`
  - Negro: `#373a3c`

### **Arquitectura del Proyecto**
- **Frontend:** SPA desarrollada con Vue.js y Bootstrap.
- **Backend:** API REST con Laravel y MySQL.
- **Control de versiones:** GitHub.

## Futuras Implementaciones
- **Despliegue:** Implementar la aplicación en un servidor en producción.
- **Optimización del código:** Unificación de métodos y mejoras de rendimiento.
- **Mejoras en la responsividad:** Adaptación completa a dispositivos móviles.

## Contribución
Si deseas contribuir al proyecto:
1. Haz un fork del repositorio.
2. Crea una nueva rama (`git checkout -b feature-nueva-funcionalidad`).
3. Realiza tus cambios y haz un commit (`git commit -m "Añadir nueva funcionalidad"`).
4. Sube los cambios a tu rama (`git push origin feature-nueva-funcionalidad`).
5. Abre un Pull Request.

## Licencia
Este proyecto está bajo la licencia **MIT**. Consulta el archivo `LICENSE` para más información.

## Contacto
- **Desarrolladores:** Joseba Fernández, Oier Albéniz, Leire de las Heras
- **Correo Electrónico:** contacto@egibide.com
