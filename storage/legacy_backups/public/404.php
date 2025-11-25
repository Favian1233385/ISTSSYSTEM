<?php
/**
 * Vista 404 - Página no encontrada
 * Sistema ISTS - Página de error 404 personalizada
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title ?? 'Página no encontrada - ISTS Sucúa'); ?></title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/harvard-style.css">
    <style>
        .not-found-container {
            min-height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem;
        }
        
        .not-found-content {
            max-width: 600px;
            background: white;
            padding: 3rem;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        
        .not-found-icon {
            font-size: 6rem;
            color: #0066cc;
            margin-bottom: 1rem;
        }
        
        .not-found-title {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 1rem;
            font-weight: 600;
        }
        
        .not-found-subtitle {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        
        .not-found-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .btn-primary {
            background: #0066cc;
            color: white;
        }
        
        .btn-primary:hover {
            background: #0052a3;
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            background: #f8f9fa;
            color: #333;
            border: 1px solid #dee2e6;
        }
        
        .btn-secondary:hover {
            background: #e9ecef;
            transform: translateY(-2px);
        }
        
        .suggestions {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #dee2e6;
        }
        
        .suggestions h3 {
            color: #333;
            margin-bottom: 1rem;
        }
        
        .suggestions ul {
            list-style: none;
            padding: 0;
        }
        
        .suggestions li {
            margin-bottom: 0.5rem;
        }
        
        .suggestions a {
            color: #0066cc;
            text-decoration: none;
        }
        
        .suggestions a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php include 'app/views/public/header.php'; ?>
    
    <main class="not-found-container">
        <div class="not-found-content">
            <div class="not-found-icon">🔍</div>
            <h1 class="not-found-title">404</h1>
            <h2 class="not-found-subtitle">Página no encontrada</h2>
            <p>Lo sentimos, la página que buscas no existe o ha sido movida.</p>
            
            <div class="not-found-actions">
                <a href="/" class="btn btn-primary">Volver al inicio</a>
                <a href="/contacto" class="btn btn-secondary">Contactar soporte</a>
            </div>
            
            <div class="suggestions">
                <h3>Páginas que podrían interesarte:</h3>
                <ul>
                    <li><a href="/carreras">Nuestras Carreras</a></li>
                    <li><a href="/noticias">Noticias y Eventos</a></li>
                    <li><a href="/nosotros">Sobre Nosotros</a></li>
                    <li><a href="/contacto">Contacto</a></li>
                </ul>
            </div>
        </div>
    </main>
    
    <?php include 'app/views/public/footer.php'; ?>
</body>
</html>
