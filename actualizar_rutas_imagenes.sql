-- Script SQL para actualizar rutas antiguas en la base de datos (ejemplo para tabla contents)
-- Cambia 'contents' y 'image_url' por el nombre de tu tabla/campo si es diferente

UPDATE contents
SET image_url = REPLACE(image_url, 'uploads/images/', 'uploads/images/')
WHERE image_url LIKE 'uploads/images/%';

-- Si tienes rutas absolutas o con public/ al inicio, puedes limpiar así:
UPDATE contents
SET image_url = REPLACE(image_url, 'public/uploads/images/', 'uploads/images/')
WHERE image_url LIKE 'public/uploads/images/%';

-- Repite para otros campos/tablas si es necesario
