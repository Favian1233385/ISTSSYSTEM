# Guía profesional: Manejo de tildes y caracteres especiales en ISTS System

## 1. Configuración global
- El sistema y la base de datos están configurados para aceptar tildes y caracteres especiales automáticamente.
- Los usuarios y administradores pueden crear y editar contenidos con tildes sin preocuparse por validaciones extra.

## 2. ¿Qué hacer si aparecen entidades HTML (ej: &oacute; en vez de ó)?
- El usuario/administrador NO debe hacer nada.
- El área de soporte o desarrollo debe ejecutar el siguiente comando en el servidor:

```
php artisan fix:html-entities-global
```

- Este comando limpia todas las tablas y columnas de texto de la base de datos, restaurando tildes y caracteres especiales reales.

## 3. Recomendaciones para desarrolladores y soporte
- No usar funciones como `htmlentities`, `htmlspecialchars` ni convertir a entidades HTML al guardar datos.
- Si se usa un editor WYSIWYG (TinyMCE, CKEditor, etc.), revisar su configuración para que no convierta tildes a entidades HTML.
- Antes de subir a producción, hacer una prueba creando un contenido con tildes y verificar que se muestre correctamente.

## 4. Nuevas tablas o columnas
- El comando artisan global siempre limpiará todas las tablas y columnas de texto automáticamente, sin necesidad de modificarlo.

---

**Esta guía garantiza que el sistema siempre manejará tildes y caracteres especiales de forma profesional y automática.**
