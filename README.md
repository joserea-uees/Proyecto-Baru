<p align="center">
  <img src="portada.png" alt="Vista previa del proyecto">
</p>

# 🍽️ Barú Food Lounge

**Barú Food Lounge** es una aplicación web que facilita a los estudiantes de la UEES realizar pedidos sin tener que hacer largas filas.  
A través del sistema pueden reservar productos y retirarlos en el horario que ellos elijan.

---

## 🚀 Características principales
- Permite **iniciar sesión y registrarse**.
- Sistema con **roles de usuario y administrador**:
  - El usuario accede a su panel personal.
  - El administrador puede gestionar la configuración general del sistema.
- Los usuarios pueden:
  - Agregar productos al carrito y realizar reservas.
  - Ver sus reservas y detalles.
  - Cancelar sus reservas.
  - Cambiar contraseña, nombre o eliminar su cuenta.
- El administrador puede **agregar, editar o eliminar productos**.

---

## 🛠️ Tecnologías utilizadas
- HTML / CSS / JavaScript  
- Laravel / PHP  
- MySQL  

---

## ⚙️ Instalación y uso

```bash
# Clonar el repositorio
git clone https://github.com/joserea-uees/Proyecto-Baru.git

# Crear una base de datos y configurar el archivo .env
# Recomendación de nombre: restaurante_baru

# Instalar dependencias
composer install

# Ejecutar migraciones y seeders
php artisan migrate:fresh --seed

# Iniciar el servidor
php artisan serve
